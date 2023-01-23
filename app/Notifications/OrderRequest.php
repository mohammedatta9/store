<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\Order;
use Illuminate\Notifications\Messages\BroadcastMessage;

class OrderRequest extends Notification
{
    use Queueable;

    protected $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct( Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)//notifiable=> الشخص الي هبعتله الاشعار
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

       
         $body = sprintf('تم استلام طلبك رقم %s الذي مجموعة %s . لتتبع الطلب اضف رقم الطلب بخانة تتبع الطلب',
            $this->order->number,
            $this->order->total,
            
                 ); 
        $message =new MailMessage;
        $message->subject('تم استلام الطلب')
                ->line( $body)//عباره عن فقره بالرساله كل لاين فقرة
                ->action('متجر الوان الطيف', url('/'));//rout('profile.session',$this->session->id)
                 //->from('a@a.com','name')
         return $message;
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
