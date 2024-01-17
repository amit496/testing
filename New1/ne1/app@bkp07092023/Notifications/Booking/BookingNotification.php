<?php

namespace App\Notifications\Booking;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\User;
use App\Models\StylistClientBookingAppointments;
use App\Models\Customer;
use App\Notifications\Push\HasNotifications;
class BookingNotification extends Notification  implements ShouldQueue
{
    use Queueable;
    public $records_obj;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($records_obj)
    {
        //
        $this->records_obj = $records_obj;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
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
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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

            // $this->records_obj = $records_obj;
            'booking_id' => $this->records_obj->id,
            'customer_id' =>  $this->records_obj->customer_id,
            'merchant_id' => $this->records_obj->merchant_id,
            'appointment_date' => $this->records_obj->appointment_date,
            'appointment_time' => $this->records_obj->appointment_time,


        ];
    }
}
