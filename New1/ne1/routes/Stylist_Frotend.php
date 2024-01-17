<?php
use App\Http\Controllers\StylistForm;



Route::get('/stylist/customer/info', [StylistForm\StylistFrontController::class, 'customerInformation']);

Route::get('/stylist/customer/info/email', [StylistForm\StylistFrontController::class, 'sendemail']);

Route::post('/stylist/fe_save_data', [StylistForm\StylistFrontController::class, 'saveDataAjax']);

Route::get('/stylist/reveal/{booking_id?}/{reveal_id?}/{rand_code?}', [StylistForm\StylistFrontController::class, 'index']);

Route::get('/stylist-list', [StylistForm\StylistFrontController::class, 'merchantList'])->name('merchantList.stylist');

Route::get('/stylist-reveal', [StylistForm\StylistFrontController::class, 'reveal']);

Route::post('/stylist/client/submit_selection/', [StylistForm\StylistFrontController::class, 'clientSubmitProductsSelection'])->name('client_selection.stylist');

Route::post('/stylist/client/submit_booking/', [StylistForm\StylistFrontController::class, 'clientSubmitBooking']);

Route::get('/stylist/create/coupon', [StylistForm\StylistFrontController::class, 'createCouponForCompanyByUser']);

Route::get('/stylist/getquestion/',[StylistForm\StylistFrontController::class, 'getquestion']);

Route::get('/stylist/order/cancel', [StylistForm\StylistFrontController::class ,'cancel_order']);
Route::post('/stylist/order/cancel/submit', [StylistForm\StylistFrontController::class ,'order_cancel_request']);
// test

// Route::get('/stylist/uploadimage_test', [StylistForm\StylistFrontController::class ,'upload_image_test']);
// Route::post('/stylist/uploadimage_page', [StylistForm\StylistFrontController::class ,'upload_image_form']);