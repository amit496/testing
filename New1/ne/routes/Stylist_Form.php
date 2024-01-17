<?php

use App\Http\Controllers\Mailcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StylistForm;
use App\Http\Controllers\ContactUsController;
// use App\Http\Controllers\quick_Controller;

Route::get('stylist/email', [App\Http\Controllers\Mailcontroller::class, 'sendmail']);

Route::middleware('auth')->name('admin.')->prefix('admin')->group(function () {
    Route::get('stylist/dashboard', [StylistForm\StylistFormController::class, 'dashboard'])->name('admin.stylist.dashboard');
    Route::get('stylist', [StylistForm\StylistFormController::class, 'index'])->name('admin.stylist');
    Route::get('stylist/add/{id?}', [StylistForm\StylistFormController::class, 'add'])->name('admin.stylist_add');
    Route::post('stylist/add', [StylistForm\StylistFormController::class, 'add']);
    Route::get('/stylist/update/id/{row_id}/{column_name}/{update_value}', [StylistForm\StylistFormController::class, 'update'])->name('update.stylist');
    Route::get('/stylist/delete/{id}', [StylistForm\StylistFormController::class, 'delete'])->name('delete.stylist');
    Route::get('/stylist/customer_request', [StylistForm\StylistFormController::class, 'customerRequestList'])->name('customer_request.stylist');
    Route::get('/stylist/customer_request/{id}', [StylistForm\StylistFormController::class, 'customerRequestTypeFormDetails']);
    Route::post('/stylist/customer_request/ratings', [StylistForm\StylistFormController::class, 'customerRequestTypeFormDetailsForRatings']);
    Route::post('/stylist/customer_request/addnote', [StylistForm\StylistFormController::class, 'customerRequestTypeFormDetailsForAddNote']);

    Route::get('/stylist/booking_call_complete/{id}', [StylistForm\StylistFormController::class, 'StylistAndCustomerBookingCallComplete']);

    Route::get('/stylist/drapper_stylist_design', [StylistForm\StylistFormController::class, 'drapperStylistDesign']);
    Route::post('/stylist/products_list', [StylistForm\StylistFormController::class, 'productsListAjax']);

    Route::get('/stylist/import_produt_modal_html', [StylistForm\StylistFormController::class, 'importProductModalAjax']);

    Route::post('/stylist/get_data', [StylistForm\StylistFormController::class, 'getDataAjax']);

    Route::get('/stylist/product/details/{product_id}/', [StylistForm\StylistFormController::class, 'productDetailsAjax']);
    Route::post('/stylist/reveal/info', [StylistForm\StylistFormController::class, 'getRevealInfomationHtmlAjax']);

    Route::post('/stylist/save_reveal/items', [StylistForm\StylistFormController::class, 'saveRevealItems']);

    Route::post('/stylist/save_reveal/item/add_video', [StylistForm\StylistFormController::class, 'saveRevealItemAddVideo']);
    Route::post('/stylist/save_reveal/steps', [StylistForm\StylistFormController::class, 'getRevealItemStepLoadHtml']);

    Route::post('/stylist/save_reveal/item/send', [StylistForm\StylistFormController::class, 'sendRevealItemToClient']);

    Route::get('/stylist/customer_response', [StylistForm\StylistFormController::class, 'customerResponseList']);

    Route::get('/stylist/customer_request_response/load_email_template/{booking_id}/{reveal_id}', [StylistForm\StylistFormController::class, 'customerRequestResponseEmailTemplateload']);
    Route::get('/stylist/customer_request_response/load_history/{booking_id}', [StylistForm\StylistFormController::class, 'customerRequestResponseloadHistory']);

    Route::post('/stylist/customer_request_response/send_mail', [StylistForm\StylistFormController::class, 'customerRequestResponseSendMail']);

    Route::get('/stylist/customer_request_response/select_email_template/{id}', [StylistForm\StylistFormController::class, 'customerRequestResponseEmailTemplateloadById']);
    Route::get('/stylist/send_mail', [StylistForm\StylistFormController::class, 'sendmail']);
    Route::get('/stylist/booking_dates', [StylistForm\StylistFormController::class, 'ShowBookingDates']);


    Route::get('/stylist/customer', [StylistForm\StylistFormController::class, 'showCustomerList']);

// List page
    Route::get('/employer_onboarding_questionnaire', [StylistForm\StylistFormController::class, 'employerOnboardingQuestionnaire']);

    Route::get('/stylist/super-admin/products', [StylistForm\StylistFormController::class, 'superAdminManageProduct']);

// edit page
    Route::get('/employer_onboarding_questionnaire/{id}', [StylistForm\StylistFormController::class, 'stf_edit_employer_onboarding_questionnaire']);

// save and update function
    Route::post('/employer-onboarding-questionnaire-store', [StylistForm\StylistFormController::class, 'updateEmployerOnboardingQuestionnaire'])->name('employer-onboarding-questionnaire-store');

// for delete
    Route::get('/employer-onboarding-questionnaire/delete/{id}', [StylistForm\StylistFormController::class, 'deleteEmployerOnboardingQuestionnaire']);

    Route::get('/stylist/manage_questions', [StylistForm\StylistFormController::class, 'updateQuestionAnswerinfo']);

    Route::get('/stylist/post_dashboard', [StylistForm\StylistFormController::class, 'postdetails']);

    Route::get('/stylist/availability/{id?}', [StylistForm\StylistFormController::class, 'merchantAvailability']);
    Route::post('/stylist/availability/time', [StylistForm\StylistFormController::class, 'save_merchant_availability']);
    // Route::get('/datedemo', [StylistForm\StylistFormController::class, 'checkdate']);
    // Route::get('/stylist/availabilitydelete/{id}', [StylistForm\StylistFormController::class, 'delete'])->name('delete.stylist');
    Route::get('/stylist/availability/delete/{id}', [StylistForm\StylistFormController::class, 'deleteavailability'])->name('delete.stylist');  
    
    
    Route::get('/show/contactus', [ContactUsController::class, 'show_contact']);
    Route::delete('/contactus/{contactus}/trash', [ ContactUsController::class,'PermanentalyTrash'])->name('contactus.trash');
    Route::get('/contactus/{contactus}/readed', [ContactUsController::class, 'readed'])->name('contactus.readed');
});

// Route::get('/admin/show/contactus', [ContactUsController::class, 'show_contact']);

