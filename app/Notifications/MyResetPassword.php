<?php

namespace MissVote\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Lang;

class MyResetPassword extends Notification
{
    use Queueable;


    private $token;

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
        // dd(new MailMessage());
        return (new MailMessage)
                    ->subject(trans('auth.forgot_password_email.subject',['appname'=>config('app.name')]))
                    ->line(Lang::get('auth.forgot_password_email.recivied'))
                    ->action(Lang::get('auth.forgot_password_email.action'), url('auth/reset', $this->token))
                    ->line(Lang::get('auth.forgot_password_email.if_not_require'));
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
