<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class MyResetPassword extends Notification
{
    use Queueable;
    protected $token;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($token)
    {
        $this->token = $token;
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
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Restablecer Contraseña')
                    ->greeting('Hola')
                    ->line('Recibió este correo electrónico porque recibimos una solicitud de
                    restablecimiento de contraseña para su cuenta.')
                    ->action('Reiniciar Contraseña', url('/password/reset/'.$this->token))
                    ->line('Si no realizaste la solicitud para el cambio de contraseña, solo ignora este mensaje.')
                    ->line('Este enlace solo es válido dentro de los proximos 60 minutos.')
                    ->salutation('• Consultorio Médico San Benito •');
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
