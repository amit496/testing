var stf_custom_modal_id_selector = "#stf_custom_details_modal";
var stf_custom_modal_class_selector = "stf_modal_class";
jQuery(document).ready(function () {



	// jQuery(document).on('paste', '.pro_description_text',function(){

	// 	convertHtmlToText();
	// });

	jQuery.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	jQuery(document).on('click', '.stf_functionality_pending', function () {
		alert('Functionality is pending');
	});

	if (jQuery(document).find('.stf_outer_page_load').length != 0) {
		jQuery(document).find('.stf_outer_page_load').show();
		jQuery(document).find('.stf_outer_page_load').removeClass('stf_outer_page_load');
	}


	var stf_side_bar_hide = true;
	// check need to hide side bar or not
	if (jQuery('.stf_side_bar_not_hide').length != 0) {
		stf_side_bar_hide = false;
	}
	// hide side bar
	if (stf_side_bar_hide) {
		jQuery('body').addClass('sidebar-collapse');
		jQuery('body').find('.stf_product_window_hide_class .sidebar').hide();
		jQuery('body').find('.sidebar_stylist_section').show();
	}




	// call event functions
	stfProdFilterByAttibuteAndCategory();
	stfProductsModalPagination();

	jQuery(document).on('change', 'input[name="reveal_video_update"]', function () {
		jQuery(this).addClass('stf_input_trigger');
		jQuery(this).closest('.revel_save_steps.revel_save_steps_2').find('.action_btn_section_bottom .stf_anchor_btn').addClass('not_reload_page').trigger('click');

	});



});



function stfCustomerRequestFilter(obj = '', name = '', value = '', text = '') {
	jQuery(obj).closest('.style_cr_filter_drop_down').hide();
	jQuery('input[name="' + name + '"]').val(value);
	jQuery('.' + name + '_label').text(text);

}

function stfSummerNote(class_name = '') {

	if (jQuery('.' + class_name).length != 0) {
		if (class_name == 'sft_pro_summernote') {
			jQuery('.' + class_name).summernote({
				callbacks: {
					onPaste: function () {
						setTimeout(function () {
							convertHtmlToText();
							// $('#product_description').text();
						}, 500);
					}
				}
			});
		} else {
			jQuery('.' + class_name).summernote();
		}
	}
}

function stf_add_screen_show_employer_onboarding_questionnaire() {
	jQuery('.stf_table_employer_onboarding').hide();
	jQuery('.stf_add_employer_onboarding').show('slow');
}
function stf_manage_screen_show_employer_onboarding_questionnaire() {
	jQuery('.stf_add_employer_onboarding').hide();
	jQuery('.stf_table_employer_onboarding').show('slow');

}

function stfSearchProductByName(obj) {
	var product_name_serach = jQuery(obj).val();
	jQuery('.stf_products_list_ul li').show();
	jQuery('.stf_products_list_ul li').each(function (index, val) {
		var product_name = jQuery(this).attr('data-product-name');
		if (product_name.indexOf(product_name_serach) != -1) {
			console.log(" found");
			jQuery(this).show();
		} else {
			jQuery(this).hide();
		}

	});
}




function stfAddProduct(product_id, price, image_src) {

}




function stfShowRevealsPage(obj, hide = 'N') {
	if (hide == 'Y') {
		jQuery('.stf_reveal_item_list_top_nav_btn').hide();
		jQuery('.reveal_add_items_section').hide();
		jQuery('.stylist_reveals_section').show();
		return false;
	} else {
		if (jQuery('.revel_save_steps.revel_save_steps_1').hasClass('step_not_save_yet') ||
			jQuery('.revel_save_steps.revel_save_steps_2').hasClass('step_not_save_yet')) {
			var modal = jQuery('#stf_save_product_video_modal');
			modal.modal('show');
			return false;

		}
	}
	jQuery('.stf_reveal_item_list_top_nav_btn').hide();
	jQuery('.reveal_add_items_section').hide();
	jQuery('.stylist_reveals_section').show();

}

function stfErrorAlert(msg = 'something wrong!') {
	alert(msg);
}


function stfGetRevealItemsHtmlAjax(reveal_id = 0, obj = '') {
	if (obj != '') {

		if (jQuery(obj).hasClass('delete_action_is_trigger')) {
			jQuery(obj).removeClass('delete_action_is_trigger');
			return false;
		}
		jQuery('.revels_html_section').find('.reveal_section_list_active').removeClass('reveal_section_list_active');
		jQuery(obj).closest('.owl-item').addClass('reveal_section_list_active');

	}
	var booking_id = jQuery('.stylist_reveals_section input[type="hidden"][name="request_id"]').val();
	console.log(booking_id);

	$.ajax({
		url: dapper_base_url + '/admin/stylist/reveal/info',
		type: 'POST',
		data: { booking_id: booking_id, reveal_id: reveal_id },
		success: function (response) {
			console.log(response);
			if (response.success) {
				jQuery('.stylist_reveals_section').hide();
				jQuery('.reveal_add_items_section').html(response.data);
				jQuery('.reveal_add_items_section').show();
				jQuery('.stf_reveal_item_list_top_nav_btn').show();
				window.scrollTo({ top: 0, behavior: 'smooth' });
				jQuery('body.sidebar-mini').addClass('sidebar-collapse');


			} else {
				stfErrorAlert();

			}
		}
	});
}

function stfGetProductDetailsHtmlAjax(product_id = 0) {

	$.ajax({
		url: dapper_base_url + '/admin/stylist/product/details/' + product_id,
		type: 'GET',
		success: function (response) {
			console.log(response);
			if (response.product_details.prodcut_details_html) {
				var modal = jQuery(stf_custom_modal_id_selector);
				modal.html(response.product_details.prodcut_details_html);
				modal.modal('show');
			} else {
				stfErrorAlert();

			}
		}
	});
}




function stf_reveal_edit_item(obj) {
	var current_obj = jQuery(obj);

	jQuery('.reveal_add_items_section').find('.products_items_section').find('.reveal_item_details').removeClass('reveal_item_details_active');
	if (current_obj.closest('.reveal_item_details').length != 0) {
		current_obj.closest('.reveal_item_details').addClass('reveal_item_details_active');
	}

	var product_id = current_obj.closest('.reveal_item_details').find('input[name="revel_item_prodcut_id"]').val();
	if (product_id != 0) {
		stfEditProductModalShowById('', product_id);
	} else {
		stfGetProductListHtmlAjax();
		stfProductWindowShowHide('Y');
		jQuery('.stf_reveal_item_list_top_nav_btn').hide();
	}




	var action_item_add_to = 'item';
	if (current_obj.closest('.products_items_section').hasClass('reveals_alertnative_items_section_pop')) {
		action_item_add_to = 'alernative';
	}
	jQuery('input[type="hidden"][name="add_product_to_alernative_or_item"]').val(action_item_add_to);

}





function stf_reveal_delete_item(obj) {
	var current_obj = jQuery(obj);
	if (confirm("Are you sure want to delete?")) {
		//current_obj.closest('.reveal_item_details').remove();
		//stfRevealItemNoRearrange();
		var parent_selector = current_obj.closest('.reveal_item_details');
		var empty_plush_img = dapper_base_url + '/images/stylist/add-plus.jpg';
		parent_selector.find('.stf_delete_edit_product img').remove();
		parent_selector.find('.stf_delete_edit_product ').append('<img src="' + empty_plush_img + '" alt="Add Product" title="Add Product" style="width: 100%;" onclick="stf_reveal_edit_item(this);">');
		parent_selector.addClass('stf_reveal_item_empty');
		parent_selector.find('.line-heading').attr('attr-product-id', 0);
		parent_selector.find('.line-heading input[name="revel_item_prodcut_id"]').val(0);
		parent_selector.find('.overlay').remove();
		parent_selector.find('.line-heading-1').remove();
		parent_selector.find('.stf_anchor_btn').remove();
		return false;
	}

	console.log("stf_reveal_delete_item call 132")
}


function stfTopSubMenuShowHide(obj) {
	jQuery(obj).closest('.dropdown').siblings('.dropdown').find('.dropdown-content').hide();
	jQuery(obj).closest('.dropdown').find('.dropdown-content').toggle();
}


function stfRevealItemAdd(img_src = '', id = '0', name = '', price = '0', img_src2 = '', qty = 0) {
	stfHideAlertMsg(0);

	if (qty == 0 || qty == '0') {
		var modal = jQuery(stf_custom_modal_id_selector);
		modal.html(' <div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document"><div class=" col-md-11 col-sm-12 m-auto modal-content"><div class="modal-header"> <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button></div><div class="modal-body modal-body-style"><div class="row "><div class=""><div class="reveal_item_stock_error">Check item stock availability with retailer and adjust quantity</div></div></div></div>');
		modal.modal('show');
		return false;

	}
	if (qty < 0) {
		var modal = jQuery(stf_custom_modal_id_selector);
		modal.html(' <div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document"><div class=" col-md-11 col-sm-12 m-auto modal-content"><div class="modal-header"> <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button></div><div class="modal-body modal-body-style"><div class="row "><div class=""><div class="reveal_item_stock_error">Check item stock availability with retailer and adjust quantity</div></div></div></div>');
		modal.modal('show');
		return false;

	}

	stfGetRevealItemsStepHtml(this, 1, 'no');
	var action_item_add_to = jQuery('input[type="hidden"][name="add_product_to_alernative_or_item"]').val();

	var parent_selector = jQuery('.reveal_add_items_section').find('.reveals_items_section_pop');
	var title = 'Item';
	if (action_item_add_to == 'alernative') {
		parent_selector = jQuery('.reveal_add_items_section').find('.reveals_alertnative_items_section_pop');
		title = 'Alternative item';
	}

	var parent_selector = jQuery('.revel_save_steps_1');



	jQuery('.stf_products_list_section').hide();
	jQuery('.reveal_add_items_section').show();
	var validation = false;
	parent_selector.find('.reveal_item_details').each(function () {

		var product_id = jQuery(this).find('input[type="hidden"][name="revel_item_prodcut_id"]').val();
		if (typeof product_id !== "undefined") {

			// skip validation for same product update
			if (parent_selector.find('.reveal_item_details.reveal_item_details_active').length != 0) {
				var old_product_id = parent_selector.find('.reveal_item_details.reveal_item_details_active').find('input[name="revel_item_prodcut_id"]').val();
				if (typeof old_product_id !== "undefined" && old_product_id != 0 && old_product_id == product_id) {
					return true;
				}
			}

			if (product_id == id) {
				validation = true;
				console.log(product_id);
				stfShowAlertMsg('Product already added in reveal', 'error');

				setInterval(function () { stfHideAlertMsg(); }, 2000);

				return false;
			}
		}

	});
	if (validation) {
		stfModelHide();
		return false;
	}
	var i = 1;
	var img_src2_html = '';
	var img_src2_has_class = "";
	if (img_src2 != '') {
		img_src2_html = '<img class="stf_default-img-hover-show" src="' + img_src2 + '" alt="" style="width: 100%;">';
		img_src2_has_class = " has_prod_hover_images  ";

	}
	var reveal_items_html = '';
	reveal_items_html += '<div class="line-heading mb-3" >';
	reveal_items_html += '<input type="hidden" name="revel_item_prodcut_id" value="' + id + '">';
	reveal_items_html += '<h4 class="item_no">' + title + ' <span> ' + i + '</span></h4>';
	reveal_items_html += '</div>';
	reveal_items_html += '<div class="img-product shadow rounded stf_delete_edit_product ' + img_src2_has_class + '">';
	reveal_items_html += '<img class="stf_default-img" src="' + img_src + '" alt=""  style="width: 100%;">';
	reveal_items_html += img_src2_html;

	reveal_items_html += '<a href_rename="javascript:void(0)" onclick="stf_reveal_edit_item(this);return false;" class="stf_anchor_btn"><div class="overlay-edit-btn"><p> EDIT PRODUCT</p></div></a>';
	reveal_items_html += '<div class="overlay">';
	reveal_items_html += '<a href="javascript:void(0)" class="btn btn-light padding-0 " onclick="stf_reveal_delete_item(this)">';
	reveal_items_html += '<i class="fa fa-trash"></i>';
	reveal_items_html += '</a>';
	reveal_items_html += '<a href_rename="javascript:void(0)" class="btn btn-light padding-0 shadow stf_hide_section" onclick="stf_reveal_edit_item(this);return false;">';
	reveal_items_html += '<i class="fa fa-edit"></i>';
	reveal_items_html += '</a>';
	reveal_items_html += '</div>';
	reveal_items_html += '</div>';
	reveal_items_html += '<div class="line-heading-1">';
	reveal_items_html += '<h4>' + name + '</h4>';
	reveal_items_html += '<span class="text-dark text-center">';
	reveal_items_html += '<p><strong>Price</strong> ' + price + '</p>';
	reveal_items_html += '</span>';
	reveal_items_html += '</div>';


	if (parent_selector.find('.reveal_item_details.reveal_item_details_active').length != 0) {

		parent_selector.find('.reveal_item_details.reveal_item_details_active').html(reveal_items_html);

	} else if (parent_selector.find('.reveal_item_details.stf_reveal_item_empty').length != 0) {

		parent_selector.find('.reveal_item_details.stf_reveal_item_empty').first().html(reveal_items_html).removeClass('stf_reveal_item_empty');

	} else {
		parent_selector.find('.reveal_item_details').closest('.just_content_space').append("<div class='col_with reveal_item_details'>" + reveal_items_html + '</div>');
	}

	stfModelHide();
	stfRevealItemNoRearrange();
	jQuery('.revel_save_steps.revel_save_steps_1').addClass('step_not_save_yet');
	stfProductWindowShowHide(show = 'N');

}
function stfOWLCarouselSliderCall(class_name = '', iteam_min = 4) {
	if (jQuery('.' + class_name).length != 0) {
		if (jQuery('.' + class_name).find('.stf_owl_carousel_slider_item').length > iteam_min) {
			jQuery('.' + class_name).owlCarousel({
				items: 5,
				loop: false,
				margin: 30,
				nav: true,
				autoplay: false,
				autoplayTimeout: 1000,
				autoplayHoverPause: true,
				navText: ["<i class='fa fa-arrow-left'></i>", "<i class='fa fa-arrow-right'></i>"]
			});
		}
	}
}


function stfModelShow() {
	var modal = jQuery(stf_custom_modal_id_selector);

	modal.modal('show');
}
function stfModelHide() {
	var modal = jQuery(stf_custom_modal_id_selector);
	modal.modal('hide');
}



function stfSaveRevealsForm(obj, save_action = '', reload_page) {
	stfHideAlertMsg(0);
	var current_obj = jQuery(obj);
	if (jQuery('.reveal_add_items_section .products_items_section').length == 0) {
		return false;
	}
	var reveal_name = jQuery('.reveal_add_items_section  input[type="text"][name="reveal_name"]').val();
	var reveal_id_selector = jQuery('.reveal_add_items_section .products_items_section input[type="hidden"][name="reveal_id"]');
	var reveal_id = reveal_id_selector.val();
	var booking_id = jQuery('.stylist_reveals_section input[type="hidden"][name="request_id"]').val();

	var product_ids = [];
	var product_id = '';
	var not_selected_any_porduct = true;

	jQuery('.reveals_items_section_pop.products_items_section .reveal_item_details ').each(function () {
		product_id = jQuery(this).find('input[type="hidden"][name="revel_item_prodcut_id"]').val();

		if (typeof product_id !== "undefined") {

		} else {
			product_id = 0;

		}
		if (product_id != 0) {
			not_selected_any_porduct = false;
		}

		product_ids.push(product_id);

	});

	if (not_selected_any_porduct) {
		stfShowAlertMsg('Please add item', 'error');
		return false;
	}

	var alernative_product_ids = [];
	var alernative_product_id = '';
	var alernative_porduct_select_error = false;
	jQuery('.reveals_alertnative_items_section_pop.products_items_section .reveal_item_details ').each(function (alternate_index) {
		alernative_product_id = jQuery(this).find('input[type="hidden"][name="revel_item_prodcut_id"]').val();
		if (typeof alernative_product_id !== "undefined") {

		} else {
			alernative_product_id = 0;
		}
		if (product_ids[alternate_index]) {
			if (save_action == 'draft' && reload_page == 'reload_page') {

			}
			else {
				if (alernative_product_id != 0 && product_ids[alternate_index] == 0) {
					alernative_porduct_select_error = true;
					stfShowAlertMsg('Please add item ' + (alternate_index + 1), 'error' );
					return false;
				}
				if (alernative_product_id == 0 &&  product_ids[alternate_index] != 0) {
					stfShowAlertMsg('Please add alternative item ' + (alternate_index + 1), 'error');
					alernative_porduct_select_error = true;
					return false;
				}
			}

		}



		alernative_product_ids.push(alernative_product_id);

	});

	if (alernative_porduct_select_error) {
		return false;
	}



	$.ajax({
		url: dapper_base_url + '/admin/stylist/save_reveal/items',
		type: 'POST',
		data: { booking_id: booking_id, reveal_id: reveal_id, reveal_name: reveal_name, save_action: save_action, product_ids: product_ids, alernative_product_ids: alernative_product_ids },
		success: function (response) {
			console.log(response);

			if (response.error) {
				stfShowAlertMsg(response.error, 'error');
			}

			if (response.success) {
				jQuery('.revel_save_steps.revel_save_steps_1').removeClass('step_not_save_yet');
				stfShowAlertMsg(response.success, 'success');
				reveal_id_selector.val(response.records.id);

				if (reload_page == 'reload_page') {
					stfReloadPage(reload_page);
					return false;
				}

				if (response.reveal_html_item) {
					if (jQuery('.revels_html_section .reveal_section_list_active').length != 0) {
						jQuery('.revels_html_section .reveal_section_list_active').html(response.reveal_html_item);
					} else if (jQuery('.revels_html_section .reveal_section_list.reveal_section_empty').length != 0) {
						jQuery('.revels_html_section .reveal_section_list.reveal_section_empty').first().html(response.reveal_html_item).removeClass('reveal_section_empty');
					}
					if (response.reveal_item_upload_step_html) {
						stfRevealFormProressbarActive(2, response.reveal_item_upload_step_html);
					}

				}
			}
			stfHideAlertMsg();

		}
	});

}

function strTriggerByInputName(input_name = '') {
	jQuery('.revel_save_steps,.revel_save_steps_2').addClass('step_not_save_yet');
	jQuery(document).find('input[name="' + input_name + '"]').addClass('stf_input_trigger').trigger('click');
}

function stfRevealFormProressbarActive(step_active_no = 1, next_step_html = '') {
	jQuery('.reveal_item_save_progress_section .dot.current').removeClass('current').addClass('completed');
	jQuery('.reveal_item_save_progress_section .reveal_item_save_progress_section_setp_' + step_active_no + ' .dot').addClass('current').removeClass('completed');
	jQuery('.revel_save_steps').hide();
	jQuery('.revel_save_steps.revel_save_steps_' + step_active_no).show();
	if (next_step_html != '') {
		jQuery('.revel_save_steps.revel_save_steps_' + step_active_no).html(next_step_html);
	}
}

function stfSaveRevealsFormVideo(obj, save_action = '', reload_page = '') {

	var current_obj = jQuery(obj);
	var parent_class = 'revel_save_steps_2';
	var parent_selector = current_obj.closest('.' + parent_class);
	stfHideAlertMsg(0, parent_class);

	if (current_obj.hasClass('not_reload_page')) {

		reload_page = 'No';
		current_obj.removeClass('not_reload_page')

	}


	if (!parent_selector.find('input[type="file"][name="reveal_video_update"]:visible').hasClass('stf_input_trigger')) {
		if (reload_page == 'reload_page') {
			stfReloadPage(reload_page);
			return false;
		}
		stfGetRevealItemsStepHtml(this, 3, 'yes');
		return false;
	}

	var filedata = parent_selector.find('input[type="file"][name="reveal_video_update"]:visible')[0].files[0];
	var form_data = new FormData();
	form_data.append('file', filedata);


	var reveal_id_selector = jQuery('.reveal_add_items_section .products_items_section input[type="hidden"][name="reveal_id"]');
	var reveal_id = reveal_id_selector.val();
	var booking_id = jQuery('.stylist_reveals_section input[type="hidden"][name="request_id"]').val();
	console.log(booking_id);


	form_data.append('reveal_id', reveal_id);
	form_data.append('booking_id', booking_id);
	form_data.append('save_action', save_action);
	stfShowloader();
	jQuery.ajax({
		url: dapper_base_url + '/admin/stylist/save_reveal/item/add_video',
		type: 'POST',
		data: form_data,

		cache: false,
		contentType: false,
		processData: false,
		error: function (response) {
			stfHideloader();
			console.log("error");

			if (response.responseJSON && response.responseJSON.errors.file) {

				stfShowAlertMsg(response.responseJSON.errors.file, 'error', parent_class);
			}

			stfHideAlertMsg(5000, parent_class);
		},
		success: function (response) {
			stfHideloader();
			console.log(response);
			if (response.error) {
				stfShowAlertMsg(response.error, 'error', parent_class);
			}

			if (response.success) {
				stfShowAlertMsg(response.success, 'success', parent_class);
				stfReloadPage(reload_page);
				if (response.video_html) {
					console.log(response.video_html);
					parent_selector.find('.stf_video_uploaded_section').show();
					parent_selector.find('.stf_video_upload_btn_section').hide();
					parent_selector.find('.stf_delete_edit_product-video1').html(response.video_html);
					jQuery('.revel_save_steps.revel_save_steps_2').removeClass('step_not_save_yet');
					stfGetRevealItemsStepHtml(this, 3, 'yes');
				}
			}

			stfHideAlertMsg(5000, parent_class);

		}
	});


}

function stfGetRevealItemsReviewHtml(obj) {

	var reveal_id_selector = jQuery('.reveal_add_items_section .products_items_section input[type="hidden"][name="reveal_id"]');
	var reveal_id = reveal_id_selector.val();
	var booking_id = jQuery('.stylist_reveals_section input[type="hidden"][name="request_id"]').val();

	$.ajax({
		url: dapper_base_url + '/admin/stylist/save_reveal/itemsReview',
		type: 'POST',
		data: { booking_id: booking_id, reveal_id: reveal_id },
		success: function (response) {
			console.log(response);

			if (response.error) {
				stfShowAlertMsg(response.error, 'error');
			}
		}
	});


}

function stfGetRevealItemsStepHtml(obj, step_no = 0, with_data = 'yes') {
	console.log("stfGetRevealItemsStepHtml call")
	if (step_no == 0) {
		return false;
	}

	// video is required
	if (step_no == 3) {
		var video_parent_selector_class = 'revel_save_steps_2';
		video_parent_selector = jQuery('.revel_save_steps.' + video_parent_selector_class);
		has_video = video_parent_selector.find('.stf_video_uploaded_section video').length;
		if (has_video == 0) {
			stfShowAlertMsg('Please upload video.', 'error', video_parent_selector_class);
			stfHideAlertMsg(5000, video_parent_selector_class);
			return false;
		}
	}


	var parent_class = 'revel_save_steps_' + step_no;
	var parent_selector = jQuery('.' + parent_class);
	if (parent_selector.length == 0) {
		return false;
	}

	if (with_data == 'yes') {

		var reveal_id_selector = jQuery('.reveal_add_items_section .products_items_section input[type="hidden"][name="reveal_id"]');
		var reveal_id = reveal_id_selector.val();
		var booking_id = jQuery('.stylist_reveals_section input[type="hidden"][name="request_id"]').val();
		stfHideAlertMsg(0, parent_class);
		$.ajax({
			url: dapper_base_url + '/admin/stylist/save_reveal/steps',
			type: 'POST',
			data: { booking_id: booking_id, reveal_id: reveal_id, step_no: step_no },

			error: function (response) {

				if (response.responseJSON && response.responseJSON.message) {
					stfShowAlertMsg(response.responseJSON.message, 'error', parent_class);
				}
				stfHideAlertMsg(5000, parent_class);
			},
			success: function (response) {

				if (response.error) {
					stfShowAlertMsg(response.error, 'error', parent_class);
				}

				if (response.success) {
					stfShowAlertMsg(response.success, 'success', parent_class);
				}

				if (response.html) {
					stfRevealFormProressbarActive(step_no, response.html)
				}

				stfHideAlertMsg(5000, parent_class);

			}
		});
	} else if (with_data == 'no') {
		stfRevealFormProressbarActive(step_no, '');
	}
}


function stfSaveRevealsFormSend(obj, save_action = '', text = '') {
	var current_obj = jQuery(obj);
	var parent_class = 'revel_save_steps_2';
	var parent_selector = current_obj.closest('.' + parent_class);
	stfHideAlertMsg(0, parent_class);



	var reveal_id_selector = jQuery('.reveal_add_items_section .products_items_section input[type="hidden"][name="reveal_id"]');
	var reveal_id = reveal_id_selector.val();
	var booking_id = jQuery('.stylist_reveals_section input[type="hidden"][name="request_id"]').val();
	console.log(booking_id);



	jQuery.ajax({
		url: dapper_base_url + '/admin/stylist/save_reveal/item/send',
		type: 'POST',
		data: { reveal_id: reveal_id, booking_id: booking_id, save_action: save_action },

		cache: false,
		contentType: false,
		processData: false,
		error: function (response) {
			console.log("error");

			if (response.responseJSON && response.responseJSON.errors.file) {

				stfShowAlertMsg(response.responseJSON.errors.file, 'error', parent_class);
			}

			stfHideAlertMsg(5000, parent_class);
		},
		success: function (response) {
			console.log(response);
			if (response.error) {
				stfShowAlertMsg(response.error, 'error', parent_class);
			}

			if (response.success) {
				stfShowAlertMsg(response.success, 'success', parent_class);

			}

			stfHideAlertMsg(5000, parent_class);


		}
	});



}

function stfShowAlertMsg(msg = '', type = '', parent_class = '') {
	var alert_class = '';
	if (type == 'error') {
		alert_class = ' alert-danger ';
	} else if (type == 'success') {
		alert_class = ' alert-success ';
	} else {
		return false;
	}
	var msg_html = '<div class="alert ' + alert_class + '" role="alert">' + msg + '</div>';

	if (parent_class != '') {
		jQuery("." + parent_class).find('.stf_eorr_success_msg').html(msg_html).show();
	} else {
		jQuery('.stf_eorr_success_msg').html(msg_html).show();
	}
}

function stfHideAlertMsg(time = 3000, parent_class = '') {
	var selected_msg_section = jQuery('.stf_eorr_success_msg');
	if (parent_class != '') {
		var selected_msg_section = jQuery('.' + parent_class).find('.stf_eorr_success_msg');
	}
	if (time == 0) {
		selected_msg_section.html('').hide();
	} else {
		setTimeout(function () { selected_msg_section.html('').hide(); }, time);
	}
}



function stfRevealItemNoRearrange() {

	var parent_selector = jQuery('.reveal_add_items_section').find('.reveals_items_section_pop');
	var action_item_add_to = jQuery('input[type="hidden"][name="add_product_to_alernative_or_item"]').val();
	if (action_item_add_to == 'alernative') {
		parent_selector = jQuery('.reveal_add_items_section').find('.reveals_alertnative_items_section_pop');
	}
	if (parent_selector.find('.reveal_item_details').length != 0) {
		parent_selector.find('.reveal_item_details').each(function (index) {
			jQuery(this).find('.item_no span').html(index + 1);
		});
	}
}

function stf_select_email_template(obj, customername = false) {
	var emial_temp_id = jQuery(obj).val();
	if (emial_temp_id != '' && emial_temp_id != 0)
		jQuery.ajax({
			url: dapper_base_url + "/admin/stylist/customer_request_response/select_email_template/" + emial_temp_id,
			success: function (result) {
				result = JSON.parse(result);
				if (result.success) {
					var form_selector = jQuery(document).find('form[name="stf_send_mail_to_client"]');
					form_selector.find("#subject").val(result.success.subject);
					//form_selector.find(".note-editable").html(result.success.body);
					//form_selector.find("#body").html(result.success.body);
                    let customername = $('#customername').val();
                    let customerhtml  =  "<p>"+ customername +"</p>";
                    htmlContent = result.html;

                    // htmlContent1 = htmlContent.replace('<p>Hi,','<p>Hi, ' + customername+' ');
                    // htmlContent1 = $(htmlContent).find('textarea').closest('p:first').prepend(customerhtml);
					form_selector.find(".body_html").html(htmlContent);
                    // console.log(htmlContent1);
                    // console.log(htmlContent1);

					// form_selector.find(".body_html").html(result.html);
					form_selector.find('.summernote-long').summernote({
                        height: 200
					});

                    setTimeout(()=>{
                        // console.log($('.note-editing-area').html(),   customerhtml);
                        $('.note-editable').find('p:first').prepend(customerhtml);
                    },5000);
				}
			}
		});
}


function stfErrorBootStrap(msg = '', parent_class = '') {

	if (parent_class != '') {
		jQuery('.' + parent_class).find('.stf_success_error_div').html('<div class="alert alert-danger" role="alert">' + msg + '</div>');
	}

}
function stfSuccessBootStrap(msg = '', parent_class = '') {

	if (parent_class != '') {
		jQuery('.' + parent_class).find('.stf_success_error_div').html('<div class="alert alert-success" role="alert">' + msg + '</div>');
	}

}

function stfRevealSendToCustomer(obj) {

	parent_class = 'stf_reveal_send_email_template';
	var parent_selector = jQuery(obj).closest('.' + parent_class);
	parent_selector.find('.stf_success_error_div').html('');
	var emial_temp_id = parent_selector.find('select[name="selected_email_template"]').val();
	console.log(emial_temp_id);

	if (emial_temp_id == '' || emial_temp_id == 0) {
		stfErrorBootStrap('Please Select Template', parent_class);
		return false;
	}



	var subject = parent_selector.find('input[name="subject"]').val();
	if (subject == '' || subject == 0) {
		stfErrorBootStrap('Please Enter Subject', parent_class);
		return false;
	}
	var body = parent_selector.find('textarea[name="body"]').val();
	var booking_id = parent_selector.find('input[name="booking_id"]').val();
	var reveal_id = parent_selector.find('input[name="reveal_id"]').val();

	jQuery.ajax({
		url: dapper_base_url + '/admin/stylist/customer_request_response/send_mail',
		type: 'POST',
		data: { selected_email_template: emial_temp_id, subject: subject, body: body, booking_id: booking_id, reveal_id: reveal_id },

		error: function (response) {
			console.log("error");

			if (response.responseJSON && response.responseJSON.message) {

				stfErrorBootStrap(response.responseJSON.message, parent_class);
				return false;
			}


		},
		success: function (response) {
			console.log(response);
			if (response.error) {

				stfErrorBootStrap(response.error, parent_class);

			}

			if (response.success) {
				stfSuccessBootStrap(response.success, parent_class);
				location.reload();
				return false;
				stfShowRevealsPage(obj, hide = 'N');
				var modal = jQuery('#myDynamicModal');
				modal.modal('hide');
			}


		}
	});

}


function stfGetImportProductModaltmlAjax(obj) {

	$.ajax({
		url: dapper_base_url + '/admin/stylist/import_produt_modal_html/',
		type: 'GET',
		success: function (response) {
			console.log(response);
			if (response.html) {
				var modal = jQuery(stf_custom_modal_id_selector);
				modal.html(response.html);
				modal.modal('show');
			} else {
				stfErrorAlert();

			}
		}
	});

	console.log('stfGetImportProductModaltmlAjax');
}

function stfShowModalProductImportBy(obj, class_show_modal_body) {
	console.log('model class----1   :'+class_show_modal_body);
	if (jQuery('.' + class_show_modal_body).length != 0) {
		jQuery(obj).closest('.modal-body-style').hide();
		jQuery('.' + class_show_modal_body).show();
	}
}

function stfImportProductModalShow(obj, screen = '') {
	var data_send = { method_name: 'get_import_product_html', product_import_by_img: 'y' };
	var response = stfGetDataAjax(obj, data_send);
	if (response == false) {
		return false;

	}
	console.log(11111);
	console.log(response);
	if (response && response.html) {
		var modal = jQuery(stf_custom_modal_id_selector);
		modal.html(response.html);
		modal.modal('show');
		stfSummerNote('sft_pro_summernote');
		if (screen == 'img_upload') {
			//stfTriggerImageButton('addProductImage');
		}
	}

}

function stfGetDataAjax(obj = '', data_send = '', request_url = '') {
	console.log(data_send);
	data_send.booking_id = window.location.pathname.split("/").pop();
	if (request_url == '') {
		request_url = '/admin/stylist/get_data';
	}

	var output = false;
	stfShowloader();
	jQuery.ajax({
		url: dapper_base_url + request_url,
		type: 'POST',
		async: false,
		data: data_send,
		error: function (response) {
			stfHideloader();
			if (response && response.responseJSON && response.responseJSON.errors) {
				stfErrorAlert(response.responseJSON.message);
				return false;
			}
			stfErrorAlert();
		},
		success: function (response) {
			stfHideloader();
			if (response.errors) {
				stfErrorAlert(response.message);
				return false;
			}
			if (response.error) {
				stfErrorAlert(response.error);
				return false;
			}
			console.log(response);
			output = response;
		}

	});
	return output;
}


function stfGetDataAjaxForm(obj = '', data_send = '', request_url = '') {
	console.log(data_send);
	if (request_url == '') {
		request_url = '/admin/stylist/get_data';
	}
	stfShowloader();
	var output = false;
	var token='{{csrf_token()}}';

	jQuery.ajax({
		url: dapper_base_url + request_url,
		type: 'POST',
		CSRF: token,
		async: false,
		data: data_send,
		contentType: false,
		cache: false,
		processData: false,
		error: function (response) {
			stfHideloader();
			if (response && response.responseJSON && response.responseJSON.errors) {
				stfErrorAlert(response.responseJSON.message);
				return false;
			}
			stfErrorAlert();
		},
		success: function (response) {
			stfHideloader();
			if (response.errors) {
				stfErrorAlert(response.message);
				return false;
			}
			if (response.error) {
				stfErrorAlert(response.error);
				return false;
			}
			console.log(response);
			output = response;
		}

	});
	return output;
}


function stfModalAddProductdb(obj = '') {
	console.log(jQuery(obj).closest('.add_prod_model_fields_outer').length);
	if (jQuery(obj).closest('.add_prod_model_fields_outer').length == 1) {
		var parent_selector = jQuery(obj).closest('.add_prod_model_fields_outer');
		var validation_status = stfValidationNew('add_prod_model_fields_outer');
		if (validation_status) {
			return false;
		}
		// one image is requried
		var image_has = jQuery(obj).closest('.stf_modal_class').find('.file-preview-thumbnails.clearfix .file-preview-frame').length;
		parent_selector.find('.product_add_message').hide().html('');
		if (image_has = 0) {
			console.log("image_has " + image_has)
			parent_selector.find('.product_add_message').show().html('<div class="alert alert-error" role="alert">Please upload image</div>');
			return false;
		}
		var pro_name = parent_selector.find('input[name="pro_name"]').val();
		var pro_slug = parent_selector.find('input[name="pro_slug"]').val();
		var pro_brand = parent_selector.find('input[name="pro_brand"]').val();
		var pro_description = parent_selector.find('textarea[name="pro_description"]').val();
		var pro_material = parent_selector.find('input[name="pro_material"]').val();
		var pro_care = parent_selector.find('input[name="pro_care"]').val();
		var pro_price = parent_selector.find('input[name="pro_price"]').val();
		var pro_quantity = parent_selector.find('input[name="pro_quantity"]').val();
		var pro_img_url = parent_selector.find('input[name="pro_img_url"]').val();
		var pro_id = parent_selector.find('input[name="pro_id"]').val();
		var categories = parent_selector.find('select[name="categories"]:visible').val();
		var colour_description = parent_selector.find('textarea[name="pro_colour_description"]').val();
		var pro_sub_group = parent_selector.find('select[name="pro_sub_group"]:visible').val();
		var pro_group = parent_selector.find('select[name="pro_group"]:visible').val();
		var form_data = new FormData();
		var add_product_image = jQuery("input[name='addProductImage']").prop("files")[0];
		//form_data.append("file", add_product_image);
		form_data.append("name", pro_name);
		form_data.append("slug", pro_slug);
		form_data.append("brand", pro_brand);
		form_data.append("description", pro_description);
		form_data.append("material", pro_material);
		form_data.append("care", pro_care);
		form_data.append("price", pro_price);
		form_data.append("quantity", pro_quantity);
		form_data.append("img_url", pro_img_url);
		form_data.append("pro_id", pro_id);
		form_data.append("categories", categories);
		form_data.append("colour_description", colour_description);
		form_data.append("pro_sub_group", pro_sub_group);
		form_data.append("pro_group", pro_group);
		var attr_varients = [];
		parent_selector.find('.product_attribute_wrapper').find('select.stf_field_prod_attribute').each(function () {
			var attr_id = jQuery(this).attr('attr-id');
			var attr_val = jQuery(this).find(' option:selected').val();
			attr_varients.push({ attr_id: attr_id, attr_val: attr_val, type: 'select' });
		});
		parent_selector.find('.product_attribute_wrapper').find('input[type="text"].stf_field_prod_attribute').each(function () {
			var attr_id = jQuery(this).attr('attr-id');
			var attr_val = jQuery(this).val();
			attr_varients.push({ attr_id: attr_id, attr_val: attr_val, type: 'text' });

		});

		attr_varients = JSON.stringify(attr_varients)
		console.log(attr_varients);
		form_data.append("attr_varients", attr_varients);
		form_data.append("method_name", 'save_product_by_modal');
		var request_url = '';
		parent_selector.find('.product_add_message').hide();
		var output = stfGetDataAjaxForm(obj, form_data, request_url);
		if (output && output.success) {
			parent_selector.find('.product_add_message').show().html('<div class="alert alert-success" role="alert">' + output.msg + '</div>').delay(1000).fadeOut('slow');
			parent_selector.find('input[name="pro_id"]').val(output.product.id);
			var pro_id = output.product.id;
			var product_status_is_new = parent_selector.find('input[name="product_status_is_new"]').val();
			var node = $('#dropzone-input');
			console.log(node + '++++++++');
			var is_update_or_crate = '';
			if (output.product_updated) {
				is_update_or_crate = 'updated';
			} else {
				is_update_or_crate = 'created';
			}
			if (output.inventory && output.inventory.id) {
				parent_selector.find('input[name="inventory_id"]').val(output.inventory.id);
			}

			if (output.attr_html && output.attr_html != '') {
				parent_selector.find('.product_attribute_wrapper').show().html(output.attr_html);
			}

			parent_selector.find('input[name="product_stats_in_modal"]').val(is_update_or_crate);;
			if ($('#dropzone-input').length && node.fileinput("getFilesCount") > 0) { // Upload only if there is files

				node.fileinput('upload').fileinput('enable');
				console.log("++++++++test++++++++++++++");


			} else {
				// is upate by manage product
				if (jQuery('.stf_outer_body.stf_manage_products_list').length == 1) {
					stfGetProductListHtmlAjax();
					stfModelHide();
					return false;
				}
				if (product_status_is_new == 'Y') {
					stfGetProductListHtmlAjax();
				}

				stfCreatedProductAddInReveal(pro_id);
				stfModelHide();
				return false;



			}



		}
	}
}


function stfCreatedProductAddInReveal(product_id = '') {

	var obj = '';
	var data_send = { method_name: 'get_product_info_by_id', product_id: product_id };
	var response = stfGetDataAjax(obj, data_send);
	console.log("stfCreatedProductAddInReveal call");
	console.log(response);
	if (response == false) {
		return false;
	}

	if (!response.img_src) {
		return false;
	}
	var product_id = response.id;
	var img_src = response.img_src;
	var name = response.name;
	var sale_price = response.sale_price;
	var img_src2 = response.img_src2;
	var qty = response.qty;

	if (jQuery('.revel_save_steps.revel_save_steps_1').length == 1) {
		var ps_obj = jQuery('.revel_save_steps.revel_save_steps_1');
		if (ps_obj.find('.reveal_item_details').hasClass('reveal_item_details_active')) {
			console.log('need to add product');
			stfRevealItemAdd(img_src, product_id, name, sale_price, img_src2, qty);

			if (response.reveal_add_btn) {


				if (jQuery('.stf_products_list_section  .stf_product_info_modal_single[data-product-id="' + product_id + '"]').length == 1) {

					jQuery('.stf_products_list_section  .stf_product_info_modal_single[data-product-id="' + product_id + '"] .stf-add-new-product-plus-btn').html(response.reveal_add_btn);
					console.log(response.reveal_add_btn);

				}
			}
		}
	}

}

function stfValidationNew(form_id = '') {
	if (jQuery("#" + form_id).length == 1) {
		var validation_status = false;
		jQuery("#" + form_id).find('.stf_field_error_outer').removeClass('stf_field_error_outer');
		jQuery("#" + form_id).find('.stf_field_error_inner').remove();
		jQuery("#" + form_id).find('.add_prod_required:visible').each(function () {
			var value = jQuery(this).val();
			if (value == '') {
				jQuery(this).closest('.add-pro-input').addClass('stf_field_error_outer');
				var error_msg = jQuery(this).attr('error-msg');
				var error_msg_html = "<div class='stf_field_error_inner'>" + error_msg + "</div>";
				jQuery(this).after(error_msg_html);
				validation_status = true;
			}
		});
		return validation_status;

	}
}


function stfValidation(form_id = '') {
	if (jQuery("#" + form_id).length == 1) {
		var validation_status = false;
		jQuery("#" + form_id).find('.stf_field_error_outer').removeClass('stf_field_error_outer');
		jQuery("#" + form_id).find('.stf_field_error_inner').remove();
		jQuery("#" + form_id).find('.add_prod_required').each(function () {
			var value = jQuery(this).val();
			if (value == '') {
				jQuery(this).closest('.add-pro-input').addClass('stf_field_error_outer');
				var error_msg = jQuery(this).attr('error-msg');
				var error_msg_html = "<div class='stf_field_error_inner'>" + error_msg + "</div>";
				jQuery(this).after(error_msg_html);
				validation_status = true;
			}


		});
		return validation_status;

	}
}

function stfUploadfileShow(file_field_name = '', show_image_class = '') {

	console.log("stfUploadfileShow");
	console.log(file_field_name);
	console.log(show_image_class);
	var image_selector = jQuery("input[name=" + file_field_name + "]");
	if (image_selector.length == 1) {
		console.log("stfUploadfileShow 1111111");
		var validation_status = false;
		var image = image_selector.get(0).files;
		if (image && image[0]) {
			var image_url_base64 = window.URL.createObjectURL(image[0]);
			console.log(image_url_base64);
			var extension = image_selector.val().replace(/^.*\./, '');
			console.log(extension);
			if (!(/\.(png|jpg|jpeg)$/i).test(image_selector.val())) {
				stfErrorAlert('PNG and JPEG files allowed');
				image_selector.val('');
				validation_status = true;
			} else {
				jQuery('.' + show_image_class).attr('src', image_url_base64);
			}
		}

		return validation_status;

	}

}

function stfTriggerImageButton(file_field_name = '') {
	var image_selector = jQuery("input[name=" + file_field_name + "]");
	if (image_selector.length == 1) {
		image_selector.trigger('click');
	}

}

function stfGetProuctsDetailById(obj) {
	var validation_status = stfValidation('stf_product_import_by_url_modal_id');
	if (validation_status) {
		return false;
	}
	var upload_product_link_url = jQuery('#stf_product_import_by_url_modal_id').find(".upload_image_by_url").val();
	console.log('upload function from url------------');
	console.log(upload_product_link_url);
	var data_send = { method_name: 'get_import_product_by_url', upload_product_link_url: upload_product_link_url };
	console.log('data send variable----');
	console.log(data_send);
	var response = stfGetDataAjax(obj, data_send);
	if (response == false) {
		return false;
	}

	if (response.success) {
		//stfGetProductListHtmlAjax();
		// stfModelHide();
		var modal = jQuery(stf_custom_modal_id_selector);
		if (response.html) {
			modal.html(response.html);
			modal.modal('show');
		}
	}

}


function stfShowloader() {
	console.log("stfShowloader call");
	jQuery('.stylist_loader_outer').show();
	jQuery('.stylist_loader_outer').addClass('stylist_loader_outer_show');
}

function stfHideloader() {
	console.log("stfHideloader call");
	jQuery('.stylist_loader_outer').hide();
	jQuery('.stylist_loader_outer').removeClass('stylist_loader_outer_show');
}

function stfProductWindowShowHide(show = '') {
	console.log("stfProductWindowShowHide call" + show);
	if (show == 'Y') {
		jQuery('.stf_product_window_show_class').show();
		jQuery('.stf_product_window_hide_class').hide();
		jQuery('.content-wrapper').addClass('stf-full-width');
	} else if (show == 'N') {

		jQuery('.stf_product_window_hide_class').show();

		jQuery('.stf_product_window_show_class').hide();
		jQuery('.content-wrapper').removeClass('stf-full-width');
		jQuery('.stf_reveal_item_list_top_nav_btn').show();


	}
}



function stfEditProductModalShowById(obj = '', product_id = 0) {
	console.log("stfEditProductModalShowById call ");
	console.log(product_id);
	var data_send = { method_name: 'edit_product_by_id_modal', product_id: product_id };
	var response = stfGetDataAjax(obj, data_send);
	if (response == false) {
		return false;
	}
	if (response.html) {
		var modal = jQuery(stf_custom_modal_id_selector);
		modal.html(response.html);
		stfSummerNote('sft_pro_summernote');
		modal.modal('show');
	}
}


function stfGetProductsWithFilter() {
	var obj = '';
	var data_send = { method_name: 'products_list_with_filter' };
	var response = stfGetDataAjax(obj, data_send);
	if (response == false) {
		return false;
	}
}


function stfGetProductListHtmlAjax() {


	var obj = '';
	var data_send = { method_name: 'products_list_with_filter' };
	var response = stfGetDataAjax(obj, data_send);
	if (response == false) {
		return false;
	}
	if (response.product_list_html) {

		jQuery('.stf_products_list_section').html(response.product_list_html).show();
		jQuery('.reveal_add_items_section').hide();
	}

	return false;
}


function stfProdFilterByAttibuteAndCategory() {
	jQuery(document).on('click', '.prod_filter_checkbox_outer', function () {
		jQuery(this).closest('.stf_product_filter_value_list').find('.prod_filter_active').removeClass('prod_filter_active');
		var filter_name = jQuery(this).closest('.stf_product_filter_value_list').attr('filter-name');
		var is_checked = jQuery(this).find('.prod_filter_checkbox').prop('checked');
		if (is_checked) {
			if (filter_name == 'category') {
				console.log("category name ");
				jQuery('.group_categories_filter').find('.prod_filter_checkbox_outer').removeClass('prod_filter_active');
				jQuery('.group_categories_filter').find('.prod_filter_checkbox').prop('checked', false);
				jQuery(this).addClass('prod_filter_active');
				jQuery(this).find('.prod_filter_checkbox').prop('checked', true);
				return false;
			} else {
				jQuery(this).find('.prod_filter_checkbox').prop('checked', false);
				jQuery(this).removeClass('prod_filter_active');
				//jQuery(this).addClass('prod_filter_active');
			}

		} else {
			jQuery('.group_categories_filter').find('.prod_filter_checkbox_outer').removeClass('prod_filter_active');
			jQuery('.group_categories_filter').find('.prod_filter_checkbox').prop('checked', false);
			jQuery(this).find('.prod_filter_checkbox').prop('checked', true);
			jQuery(this).addClass('prod_filter_active');
		}

		var data_send = stfGetProductFilters();
		data_send['method_name'] = 'products_list_with_filter_values';
		data_send['filter_values'] = 'filter_values';

		//	var data_send = {method_name:'products_list_with_filter_values', filter_values:filter_values};
		var response = stfGetDataAjax(this, data_send);
		if (response == false) {
			return false;
		}

		if (response.product_list_filter_html) {

			jQuery('.stf-add-new-product').html(response.product_list_filter_html);

		}
		jQuery('.sidenav_heading_top_bar .paginate_html').html('');
		if (response.pagination_html) {

			jQuery('.sidenav_heading_top_bar .paginate_html').html(response.pagination_html);

		}

	});

}


function stfGetProductFilters() {
	var stf_prod_filter_value_array = {};
	jQuery(document).find('.stf_product_window_show_class .sidenav').find('.stf_product_filter_value_list .prod_filter_checkbox:checked').each(function () {
		var filter_name = jQuery(this).closest('.stf_product_filter_value_list').attr('filter-name');
		var filter_checked_val = jQuery(this).val();
		var values = {};
		values[filter_checked_val] = 'ON';
		stf_prod_filter_value_array[filter_name] = values;
		//stf_prod_filter_value_array[filter_name][filter_checked_val]= 'on';

	});
	console.log(stf_prod_filter_value_array);
	return stf_prod_filter_value_array;
}


function stfViewCustomerQuestions(customer_id = 0) {


	var data_send = { method_name: 'customer_questions_answers_view', customer_id: customer_id };

	var response = stfGetDataAjax(this, data_send);
	if (response == false) {
		return false;
	}
	if (response.html) {
		var modal = jQuery(stf_custom_modal_id_selector);
		modal.html(response.html);
		modal.modal('show');
	}
}


function stfsaveNotsaveTabsOfAddProductsAndVideoScreen() {
	var modal = jQuery('#stf_save_product_video_modal');
	modal.modal('hide');
	if (jQuery('.revel_save_steps.revel_save_steps_1').hasClass('step_not_save_yet') && jQuery('.revel_save_steps.revel_save_steps_2').hasClass('step_not_save_yet')) {
		jQuery('.revel_save_steps.revel_save_steps_1').show();
		jQuery('.revel_save_steps.revel_save_steps_1').find('.action_btn_section-two:last a').addClass('stf_trigger_btn_event').trigger('click');
		return false;
	}

	if (jQuery('.revel_save_steps.revel_save_steps_1').hasClass('step_not_save_yet')) {
		jQuery('.revel_save_steps.revel_save_steps_1').show();
		jQuery('.revel_save_steps.revel_save_steps_1').find('.action_btn_section-two:last').addClass('stf_trigger_btn_event').trigger('click');
		//stfShowRevealsPage('','Y');
		return false;
	}

	if (jQuery('.revel_save_steps.revel_save_steps_2').hasClass('step_not_save_yet')) {
		jQuery('.revel_save_steps.revel_save_steps_2').show();
		jQuery('.revel_save_steps.revel_save_steps_2').find('.action_btn_section-two:last').addClass('stf_trigger_btn_event').trigger('click');
		//stfShowRevealsPage('','Y');
		return false;
	}

}

function stfProductsModalPagination() {

	jQuery(document).on('click', '.stf_outer_body.stf_products_list_section  .pagination a', function (event) {
		event.preventDefault();
		var page = $(this).attr('href').split('page=')[1];

		var data_send = stfGetProductFilters();
		data_send['method_name'] = 'products_list_with_filter_values';
		data_send['filter_values'] = 'filter_values';
		data_send['filter_page_no'] = page;
		var response = stfGetDataAjax(this, data_send);
		if (response == false) {
			return false;
		}

		if (response.product_list_filter_html) {

			jQuery('.stf-add-new-product').html(response.product_list_filter_html);

		}
		jQuery('.sidenav_heading_top_bar .paginate_html').html('');
		if (response.pagination_html) {

			jQuery('.sidenav_heading_top_bar .paginate_html').html(response.pagination_html);

		}


	});


}


function stfDeleteUserTagById(user_id, tag_id, obj) {

	if (confirm("Are you sure want to delete?")) {
		var data_send = { method_name: 'delete_user_tag_by_id', user_id: user_id, tag_id: tag_id };
		var response = stfGetDataAjax(this, data_send);
		if (response == false) {
			return false;
		}
		if (response.success) {
			jQuery('.user_tag_list_ul').html(response.list_tag);

		}
	}

}

function stfAddTagToUser(user_id, obj) {

	var tag_name = jQuery('input[name="add_tag_to_user"]').val();
	if (tag_name == '') {
		return false;
	}

	var data_send = { method_name: 'create_tag_add_tag_to_user', user_id: user_id, tag_name: tag_name };
	var response = stfGetDataAjax(this, data_send);
	if (response == false) {
		return false;
	}
	if (response.success) {
		jQuery('.user_tag_list_ul').html(response.list_tag);
		jQuery('input[name="add_tag_to_user"]').val('');

	}
}



function stf_reveal_delete(obj = '', reveal_id = 0) {
	var current_obj = jQuery(obj);
	if (jQuery(obj).length != 0) {


	}
	current_obj.closest('.stf_anchor_mouse_over_effect').addClass('delete_action_is_trigger');
	if (confirm("Are you sure want to delete?")) {
		var data_send = { method_name: 'delete_reveal_by_id', reveal_id: reveal_id, };
		var response = stfGetDataAjax(this, data_send);
		if (response == false) {
			return false;
		}
		if (response.success) {
			location.reload();
		}
	}
	//current_obj.closest('.stf_anchor_mouse_over_effect').removeClass('delete_action_is_trigger');

}

function stfReloadPage(is_reload_page = '') {
	if (is_reload_page == 'reload_page') {
		location.reload();
		return false;
	}
}



function stf_comapany_add_users(id = 0) {


	var data_send = { method_name: 'company_add_users_modal', company_id: id, };
	var response = stfGetDataAjax(this, data_send);

	if (response.success) {
		var modal = jQuery(stf_custom_modal_id_selector);
		modal.html(response.html);
		modal.modal('show');
	}
}


function stfModalAddUsertoCustomer(obj, company_id = 0) {
	var parent_selector = jQuery(obj).closest('.company_add_user_modal');
	console.log(jQuery(obj).closest('.company_add_user_modal').length);
	if (parent_selector.length == 1) {
		let selected_users_ids = [];
		parent_selector.find('.members_list input[name="company_user_id"]:checked').each(function () {
			selected_users_ids.push(jQuery(this).val());

		});

		var data_send = { method_name: 'company_add_users', company_id: company_id, selected_users_ids: selected_users_ids };
		var response = stfGetDataAjax(this, data_send);
		parent_selector.find('.modal-message').html('');
		if (response.success) {
			var msg = parent_selector.find('.modal-message').html('<div class="alert alert-success" role="alert">Save Successully</div>');
		}
	}
}




function question_update_select_cat(obj) {
	var cat_id = jQuery(obj).val();
	if (jQuery.isNumeric(cat_id)) {
		jQuery('.question_list option').hide();
		jQuery('.question_list option[categroy_id= "' + cat_id + '"]').show();
	} else {
		jQuery('.question_list option').show();
	}


}



function question_update_select_question(obj) {
	var q_id = jQuery(obj).val();
	if (jQuery.isNumeric(q_id)) {
		var data_send = { method_name: 'udpate_question_text_html', q_id: q_id, };
		var response = stfGetDataAjax(this, data_send);
		if (response.success) {
			var modal = jQuery(stf_custom_modal_id_selector);
			modal.html(response.html);
			modal.modal('show');
			stfSummerNote('sft_pro_summernote');
		}
	}

}


function question_update_text_by_id(obj) {

	var q_id = jQuery('.update_question_info_modal .q_id').val();
	var q_text = jQuery('.update_question_info_modal textarea[name="question_text"]').val();


	var data_send = { method_name: 'udpate_question_info_update', q_id: q_id, q_text: q_text };
	var response = stfGetDataAjax(this, data_send);
	if (response.success) {

		jQuery('.update_question_info_modal .response_msg').html(response.msg);
		setInterval(function () { location.reload(); return false; }, 2000);

	}

}


function companydetailsview(company_id = 0) {


	var data_send = { method_name: 'compnay_details_view', company_id: company_id };

	var response = stfGetDataAjax(this, data_send);
	if (response == false) {
		return false;
	}
	if (response.html) {
		var modal = jQuery(stf_custom_modal_id_selector);
		modal.html(response.html);
		modal.modal('show');
	}
}



function qty_check(qty, btn_id) {
	var qtyval = qty.value;


	if (qtyval < 0) {
		jQuery('#' + btn_id).attr("style", "pointer-events:none !important;");

	} else {
		jQuery('#' + btn_id).removeAttr("style");
	}
}




// function convertHtmlToText(btn_id)
// {
// 	var inputText = document.getElementById("product_description").value;
//     var returnText = "" + inputText;
// 	returnText = returnText.replace(/<o:p>\s*<\/o:p>/g, "");
// 	returnText = returnText.replace(/<o:p>.*?<\/o:p>/g, " ");
// 	returnText = returnText.replace(/\s*mso-[^:]+:[^;"]+;?/gi, "");
// 	returnText = returnText.replace(/\s*MARGIN: 0cm 0cm 0pt\s*;/gi, "");
// 	returnText = returnText.replace(/\s*MARGIN: 0cm 0cm 0pt\s*"/gi, '"');
// 	returnText = returnText.replace(/\s*TEXT-INDENT: 0cm\s*;/gi, "");
// 	returnText = returnText.replace(/\s*TEXT-INDENT: 0cm\s*"/gi, '"');
// 	returnText = returnText.replace(/\s*TEXT-ALIGN: [^\s;]+;?"/gi, '"');
// 	returnText = returnText.replace(/\s*PAGE-BREAK-BEFORE: [^\s;]+;?"/gi, '"');
// 	returnText = returnText.replace(/\s*FONT-VARIANT: [^\s;]+;?"/gi, '"');
// 	returnText = returnText.replace(/\s*tab-stops:[^;"]*;?/gi, "");
// 	returnText = returnText.replace(/\s*tab-stops:[^"]*/gi, "");
// 	returnText = returnText.replace(/\s*face="[^"]*"/gi, "");
// 	returnText = returnText.replace(/\s*face=[^ >]*/gi, "");
// 	returnText = returnText.replace(/\s*FONT-FAMILY:[^;"]*;?/gi, "");
// 	returnText = returnText.replace(/<(\w[^>]*) class=([^ |>]*)([^>]*)/gi, "<$1$3");
// 	returnText = returnText.replace(/<(\w[^>]*) style="([^\"]*)"([^>]*)/gi, "<$1$3");
// 	returnText = returnText.replace(/\s*style="\s*"/gi, "");
// 	returnText = returnText.replace(/<SPAN\s*[^>]*>\s* \s*<\/SPAN>/gi, " ");
// 	returnText = returnText.replace(/<SPAN\s*[^>]*><\/SPAN>/gi, "");
// 	returnText = returnText.replace(/<(\w[^>]*) lang=([^ |>]*)([^>]*)/gi, "<$1$3");
// 	returnText = returnText.replace(/<SPAN\s*>(.*?)<\/SPAN>/gi, "$1");
// 	returnText = returnText.replace(/<FONT\s*>(.*?)<\/FONT>/gi, "$1");
// 	returnText = returnText.replace(/<\\?\?xml[^>]*>/gi, "");
// 	returnText = returnText.replace(/<\/?\w+:[^>]*>/gi, "");
// 	returnText = returnText.replace(/<H\d>\s*<\/H\d>/gi, "");
// 	returnText = returnText.replace(/<H1([^>]*)>/gi, "");
// 	returnText = returnText.replace(/<H2([^>]*)>/gi, "");
// 	returnText = returnText.replace(/<H3([^>]*)>/gi, "");
// 	returnText = returnText.replace(/<H4([^>]*)>/gi, "");
// 	returnText = returnText.replace(/<H5([^>]*)>/gi, "");
// 	returnText = returnText.replace(/<H6([^>]*)>/gi, "");
// 	returnText = returnText.replace(/<\/H\d>/gi, "<br>"); //remove this to take out breaks where Heading tags were
// 	returnText = returnText.replace(/<(U|I|STRIKE)> <\/\1>/g, " ");
// 	returnText = returnText.replace(/<(B|b)> <\/\b|B>/g, "");
// 	returnText = returnText.replace(/<([^\s>]+)[^>]*>\s*<\/\1>/g, "");
// 	returnText = returnText.replace(/<([^\s>]+)[^>]*>\s*<\/\1>/g, "");
// 	returnText = returnText.replace(/<([^\s>]+)[^>]*>\s*<\/\1>/g, "");
// 	//some RegEx code for the picky browsers
// 	// var re = new RegExp("(<P)([^>]*>.*?)(</P>)", "gi");
// 	// returnText = returnText.replace(re, "<div$2</div>");
// 	// var re2 = new RegExp("(<font|<FONT)([^*>]*>.*?)(</FONT>|</font>)", "gi");
// 	// returnText = returnText.replace(re2, "<div$2</div>");
// 	// returnText = returnText.replace(/size|SIZE = ([\d]{1})/g, "");
// 	document.getElementById("product_description").returnText;
// }

// var item = <p>Hi there</p> ~ wifi free <p>this is test</p> ~ breakfast free <p>This is another test</p>;
function convertHtmlToText() {
	var inputText = $("#product_description").summernote("code");
	console.log("inputText html");
	console.log(inputText);

	inputText = jQuery('.pro_description_text').html(inputText).text();

	console.log("inputText text");
	console.log(inputText);

	jQuery('#product_description').val(inputText);
	$("#product_description").summernote("code", inputText);

	// item = inputText.replace(/<[^>]+>/g, '');
	// item = inputText.replace(/~/g, '');
	// item = inputText.replace(/<p>/g, '');
	// item = iinputTexttem.replace('</p>'/g, '');
	// item = inputText.replace(/<H1>/g, '');
	// item = inputText.replace('</H1>'/g, '<p>');
	// var splitArray = inputText.split('<br />');
	// var l = splitArray.length;
	// for (var i = 0; i < l; i++) {
	// 	out =  splitArray[i].trim();
	// }
	// console.log(inputText);
}




function groupoption(){
	var group_option = $('.category_group_option').val();
	console.log(group_option);
	$("#add_prod_model_fields_outer").find('.sub_group_list,.sub_category_group_list').hide();
	$("#add_prod_model_fields_outer").find('.sub_group_list_id_'+group_option).show();

}


function sub_category_group_select(obj){
	var sub_group_options = $(obj).val();
	//var booking_id = $('#re_booking_id').val();

	// console.log($("#add_prod_model_fields_outer").find('.sub_category_group_list_id_'+sub_group_options));
	console.log(booking_id);
	console.log(sub_group_options);
	$("#add_prod_model_fields_outer").find('.sub_category_group_list').hide();
	$("#add_prod_model_fields_outer").find('.sub_category_group_list_id_'+sub_group_options).show();

	/*$.ajax({
		type: "GET",
		url: dapper_base_url + '/admin/stylist/customer_request/'+booking_id,
		data: sub_group_options,
		success: function(data){
			if(sub_group_options)
			{
				$("#add_prod_model_fields_outer").find('.sub_category_group_list').hide();
				$("#add_prod_model_fields_outer").find('.sub_category_group_list_id_'+sub_group_options).html(data);
			}
			// $("#loader").hide();
		}
		// if(option_id)
	});*/
}



