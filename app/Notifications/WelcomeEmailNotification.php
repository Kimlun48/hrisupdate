<?php

namespace App\Notifications;

use app\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Crypt;

class WelcomeEmailNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user)
    {
        $this->user = $user;
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
        $tkn = $this->user->id;
        $notel = $this->user->phone_number;
        $tgl = date('Y M d');
        $jm = date('H:i:s');

	$encript_id = Crypt::encryptString($tkn);
	$encript_notel = Crypt::encryptString($notel);

        return (new MailMessage)
            ->line('Verifikasi email Anda')
            ->line(' ')
            ->line('Dear,' .$this->user->name)
	    ->line('Anda baru saja log in ke akun HRIS PT Anyar Retail Indonesia, anda pada '.$tgl.' pukul '.$jm.' Waktu Indonesia Barat (WIB). Untuk memastikan email Anda resmi dan terverifikasi, silakan klik tombol "Activate Code" di bawah ini.')
            ->action('Activate Code', url('https://hris.anyargroup.co.id/api/verify/'.$encript_id.'/'.$encript_notel))
            #->action('Activate Code', url('https://hris.anyargroup.co.id/api/verify/'.$tkn.'/'.$notel))
            #->action('Activate Code', url('http://10.1.1.155:8008/api/verify/'.$tkn))
            ->line('Setelah klik "Activate Code", Anda akan dibawa ke website HRIS PT Anyar Retail Indonesia.')
            ->line('')
            ->line('Jika Anda butuh bantuan, silakan hubungi tim support PT Anyar Retail Indonesia.');
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
