<?php

use App\Models\Conversation;
use Illuminate\Support\Facades\Broadcast;


Broadcast::channel('conversation.{conversationId}', function ($user, $conversationId) {
    $conversation = Conversation::find($conversationId);

    if (!$conversation) {
        return false;
    }

    if ($conversation->buyer_id === $user->id) {
        return true;
    }

    $vendorApplication = $conversation->vendor; // relation belongsTo ArtisanApplication
    if ($vendorApplication && $vendorApplication->user_id === $user->id) {
        return true;
    }

    return false;
});
