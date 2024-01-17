<?php 

use App\Http\Controllers\StylistForm;

// cron links
Route::get('/stylist/cron/reveal_update_status_from_dispatch', [StylistForm\StylistCronController::class, 'revealUpdateStatusFromDispatch']);

Route::get('/stylist/cron/booking_status_reset', [StylistForm\StylistCronController::class, 'BookingStatusReset']);

Route::get('/stylist/cron/customer_notify_not_booking_stylist', [StylistForm\StylistCronController::class, 'stylistNotifyCustomerIfNotBookAnyStylist']);
