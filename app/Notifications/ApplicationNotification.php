<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class ApplicationNotification extends Notification
{
    use Queueable;

    protected $titre;
    protected $message;
    protected $type;
    protected $url;

    public function __construct(
        $titre,
        $message,
        $type,
        $url = null
    ) {
        $this->titre = $titre;
        $this->message = $message;
        $this->type = $type;
        $this->url = $url;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'titre' => $this->titre,
            'message' => $this->message,
            'type' => $this->type,
            'url' => $this->url,
        ];
    }
}