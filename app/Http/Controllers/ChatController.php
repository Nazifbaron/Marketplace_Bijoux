<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Models\ArtisanApplication;
use App\Models\Conversation;
use App\Models\Message;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ChatController extends Controller
{

    public function index()
    {
        $user = Auth::user();
        $vendorApplication = ArtisanApplication::where('user_id', $user->id)->first();

        // Construire la requête selon le rôle de l'utilisateur
        $query = Conversation::query()->with(['buyer', 'vendor.user', 'latestMessage']);

        if ($vendorApplication) {
            // L'utilisateur est un vendeur → ses conversations en tant que vendeur
            $query->where('artisan_application_id', $vendorApplication->id);
        } else {
            // L'utilisateur est un acheteur → ses conversations en tant qu'acheteur
            $query->where('buyer_id', $user->id);
        }

        $conversations = $query->orderByDesc('last_message_at')->get();

        return view('chat.index', compact('conversations', 'vendorApplication'));
    }

    /**
     * Affiche le fil de messages d'une conversation précise
     */
    public function show(Conversation $conversation)
    {
        $this->authorizeConversation($conversation);

        $conversation->load(['messages.sender', 'buyer', 'vendor.user', 'product']);

        // Marquer comme lus tous les messages envoyés par l'AUTRE personne
        $conversation->messages()
            ->where('sender_id', '!=', Auth::id())
            ->whereNull('read_at')
            ->update(['read_at' => now()]);

        return view('chat.show', compact('conversation'));
    }

    /**
     * Démarre une nouvelle conversation (ou récupère l'existante)
     * Appelé depuis le bouton "Contacter le vendeur" d'une fiche produit
     */
    public function startWithVendor(Request $request, ArtisanApplication $vendor)
    {
        
        $buyer = Auth::user();

        // findOrCreate : s'il existe déjà une conversation avec ce vendeur, on la réutilise
        $conversation = Conversation::firstOrCreate(
            [
                'buyer_id'                 => $buyer->id,
                'artisan_application_id'   => $vendor->id,
            ],
            [
                'product_id'      => $request->get('product_id'),
                'last_message_at' => now(),
            ]
        );

        return redirect()->route('chat.show', $conversation);
    }

    /**
     * Envoie un message dans une conversation
     *
     * C'est ici que la magie temps réel se produit : sauvegarde DB
     * PUIS diffusion immédiate via WebSocket aux navigateurs connectés.
     */
    public function send(Request $request, Conversation $conversation)
    {
        $this->authorizeConversation($conversation);

        $validated = $request->validate([
            'body'       => ['required_without:attachment', 'nullable', 'string', 'max:2000'],
            'attachment' => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:4096'],
        ]);

        $attachmentPath = null;
        if ($request->hasFile('attachment')) {
            $attachmentPath = $request->file('attachment')->store('chat-attachments', 'public');
        }

        // 1. Sauvegarder le message en base de données
        $message = Message::create([
            'conversation_id' => $conversation->id,
            'sender_id'       => Auth::id(),
            'body'            => $validated['body'] ?? '',
            'attachment_path' => $attachmentPath,
        ]);

        // 2. Mettre à jour la date de dernière activité (pour le tri de la liste)
        $conversation->update(['last_message_at' => now()]);

        // 3. DIFFUSION TEMPS RÉEL — l'autre participant le reçoit instantanément
        broadcast(new MessageSent($message))->toOthers();
        // ->toOthers() évite que l'expéditeur reçoive son propre message en double
        // (il l'affiche déjà directement via le JS après l'envoi du formulaire)

        // Si la requête est en AJAX (fetch JS), retourner du JSON
        if ($request->wantsJson()) {
            return response()->json([
                'id'               => $message->id,
                'body'             => $message->body,
                'attachment_url'   => $message->attachment_url,
                'sender_id'        => $message->sender_id,
                'created_at_human' => $message->created_at->format('H:i'),
            ]);
        }

        return back();
    }

    private function authorizeConversation(Conversation $conversation): void
    {
        $user = Auth::user();

        $isBuyer  = $conversation->buyer_id === $user->id;
        $isVendor = $conversation->vendor && $conversation->vendor->user_id === $user->id;

        if (!$isBuyer && !$isVendor) {
            abort(403, 'Cette conversation ne vous appartient pas.');
        }
    }
}
