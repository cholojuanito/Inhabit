<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Conversation;

class CommunicationsController extends Controller
{
    /**
     * Create a new CommunicationsController instance.
     */
    public function _construct()
    {
        $this->middleware('auth');
    }

    /**
     * Gets all the authenticated users conversations
     * 
     * @return \Illuminate\Http\Response
     */
    public function getAllConversations()
    {
        $user = Auth::user();
        return $user->conversations()->latest()->get();
    }

    /**
     * Gets all the messages for a conversation
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function getAllMessages(Request $request)
    {
        $convoId = request('conversation_id');
        return Conversation::findOrFail($convoId)->messages()->latest()->get();
    }

    /**
     * Creates a new conversation and stores it
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createConversation(Request $request)
    {
        // Make a new conversation
        $conversation = Conversation::create();


        // Sync the new conversation to both users'
        // exisiting conversations
        $user = Auth::user();

        $participantId = request('participant_id');
        $participant = User::findOrFail($participantId);

        $user->conversations()->syncWithoutDetaching($conversation->id);
        $participant->conversation()->syncWithoutDetaching($conversation->id);

        return ['success' => 'Started a new conversation with ' + $participant->name];
    }

    /**
     * Adds a new participant to a conversation
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function addParticipants(Request $request)
    {
        $convoId = request('conversation_id');
        $convo = Conversation::findOrFail($convoId)->get();

        $newParticipantId = request('participant_id');
        $newParticipant = User::findOrFail($newParticipantId);

        $convo->participants()->syncWithoutDetaching($newParticipantId);

        return ['success' => 'Added ' + $newParticipant->name + ' to the conversation'];
    }

    /**
     * Creates and sends a new message to the conversation
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function sendMessage(Request $request)
    {
        $message = Message::create([
            'user_id' => auth()->id(),
            'conversation_id' => request('conversation_id'),
            'data' => request('data'),
        ]);

        // Then send out notifications

        return ['success' => 'Message sent'];
    }
}
