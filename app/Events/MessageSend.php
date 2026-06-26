<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;


class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public Message $message;

    public function __construct(Message $message)
    {
        // On charge la relation sender pour l'envoyer directement
        // dans le payload (évite une requête supplémentaire côté front)
        $this->message = $message->load('sender:id,name');
    }

    /**
     * Le canal sur lequel cet event est diffusé.
     * Format : conversation.{id} → un canal unique par fil de discussion.
     */
    public function broadcastOn(): array
    {
        return [
            new PrivateChannel('conversation.' . $this->message->conversation_id),
        ];
    }


    public function broadcastAs(): string
    {
        return 'MessageSent';
    }

    
    public function broadcastWith(): array
    {
        return [
            'id'              => $this->message->id,
            'conversation_id' => $this->message->conversation_id,
            'body'            => $this->message->body,
            'attachment_url'  => $this->message->attachment_url,
            'sender_id'       => $this->message->sender_id,
            'sender_name'     => $this->message->sender->name,
            'created_at'      => $this->message->created_at->toIso8601String(),
            'created_at_human'=> $this->message->created_at->format('H:i'),
        ];
    }
}
