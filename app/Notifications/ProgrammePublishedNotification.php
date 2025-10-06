<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Programe;

class ProgrammePublishedNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public $programme;

    public function __construct(Programe $programme)
    {
        $this->programme = $programme;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Nouveau programme de pharmacie de garde disponible')
            ->greeting('Bonjour ' . $notifiable->name . ',')
            ->line('Les programmes des pharmacies de garde de votre ville sont maintenant disponibles.')
            ->action('👉 Cliquez ici pour télécharger', url('/programmes/' . $this->programme->id))
            ->line('Merci d’utiliser notre application !');
    }
    
    public function toDatabase(object $notifiable): array
    {
        return [
            'programme_id' => $this->programme->id,
            'name'         => $this->programme->name,
            'message'      => 'Un nouveau programme de pharmacie de garde est disponible.',
            'url'          => url('/programmes/' . $this->programme->id),
        ];
    }
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
