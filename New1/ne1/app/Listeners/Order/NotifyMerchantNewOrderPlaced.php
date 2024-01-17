<?php

namespace App\Listeners\Order;

use App\Events\Order\OrderCreated;
use App\Notifications\Order\MerchantOrderCreatedNotification as OrderCreatedNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Notification;


class NotifyMerchantNewOrderPlaced implements ShouldQueue
{
    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 5;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  OrderCreated  $event
     * @return void
     */
    public function handle(OrderCreated $event)
    {   
        // \Log::info('testing'. config('shop_settings'));
        if (! config('shop_settings')) {
            setShopConfig($event->order->shop_id);
        }
        // \Log::info('testing2'. config('shop_settings.notify_new_order'));
        if (config('shop_settings.notify_new_order')) {
            \Log::info('test++++++++++++++'. $event->order->shop->owner);
            $event->order->shop->owner->notify(new OrderCreatedNotification($event->order));
        }
    }
}
