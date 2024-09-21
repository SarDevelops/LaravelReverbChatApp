<?php

namespace App\Livewire;

use App\Events\MessageSendEvent;
use App\Models\Message;
use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class ChatComponent extends Component
{
    public $user;
    public $sender_id;
    public $receiver_id;
    public $message = '';
    public $messages = [];
    public function render()
    {
        return view('livewire.chat-component');
    }

    protected $rules = [
        'message' => 'required',
    ];

    public function mount($user_id)
    {
        $this->sender_id = auth()->user()->id;
        $this->receiver_id = $user_id;

        $messages = Message::where(function ($query) {
            $query->where('sender_id', $this->sender_id)
                ->where('receiver_id', $this->receiver_id);
        })->orWhere(function ($query) {
            $query->where('sender_id', $this->receiver_id)
                ->where('receiver_id', $this->sender_id);
        })->with('sender:id,name,image,created_at', 'receiver:id,name,image,created_at')->get();

        foreach ($messages as $key => $message) {
            $this->appendChatMessage($message);
        }
        $this->user = User::find($user_id);
    }
    public function sendMessage()
    {
        $this->validate();

        $chat = new Message();
        $chat->sender_id = $this->sender_id;
        $chat->receiver_id = $this->receiver_id;
        $chat->message = $this->message;
        $chat->save();
        $this->appendChatMessage($chat);
        broadcast(new MessageSendEvent($chat))->toOthers();
        $this->message = "";
    }

    #[On('echo-private:chat-channel.{sender_id},MessageSendEvent')]
    public function listenForMessage($event)
    {
        $chatMessage = Message::whereId($event['message']['id'])->with('sender:id,name,image', 'receiver:id,name,image')->first();
        $this->appendChatMessage($chatMessage);
    }
    public function appendChatMessage($message)
    {
        $this->messages[] = [
            'id' => $message->id,
            'message' => $message->message,
            'created_at' => $message->created_at,
            'sender' => $message->sender,
            'receiver' => $message->receiver,
        ];

    }
}