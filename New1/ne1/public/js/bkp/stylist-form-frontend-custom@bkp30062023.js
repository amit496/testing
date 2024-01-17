jQuery(window).ready(function () {
	var stf_start_screen_css = $('.stf_start_screen').css('display');
	var stylist_qeustions_list_css = $('.stylist_qeustions_list').css('display');
	var hide_bottom_css = $('.hide-bottom').css('display');
	console.log('stf_start_screen_css ' + stf_start_screen_css);
	console.log('stylist_qeustions_list_css ' + stylist_qeustions_list_css);
	console.log('hide_bottom_css ' + hide_bottom_css);
	setTimeout(function () {
		if ((stf_start_screen_css == 'none') && (stylist_qeustions_list_css == 'block') && (hide_bottom_css == 'block')) {
			$('.hide-bottom').removeAttr('style');
			$('.hide-bottom').addClass('force_hide_footer');
			// console.log('hide_bottom_css 1111' + hide_bottom_css );
			// $('.hide-bottom').removeAttr('display', 'none !important');
		}
	}, 3000);
	jQuery('body').addClass('stylist_page_view')
	stylistSelectMultipleOption();
	stylistAddRemoveToCart();
	stylistRevealProdoctSliderOwl();

	jQuery('.product_box_multi_select').on('click', function () {
		console.log("product_box_multi_select call");
		if (jQuery(this).closest('.q_stylist_step').length == 1) {
			if (!jQuery(this).closest('.style-field-checkbox-outer').find('.product_box_outer').hasClass('box_selected')) {
				var q_stylist_step_parent = jQuery(this).closest('.q_stylist_step');

				var multiple_answer_limit = q_stylist_step_parent.attr('multiple_answer_limit');
				console.log("product_box_multi_select call multiple_answer_limit " + multiple_answer_limit);
				if (multiple_answer_limit != 0 && multiple_answer_limit != '') {
					var selected_ans_length = q_stylist_step_parent.find('.style-field-checkbox-outer').find('.style-options-checkbox:checked').length;
					selected_ans_length = parseInt(selected_ans_length);
					multiple_answer_limit = parseInt(multiple_answer_limit);

					console.log("selected_ans_length " + selected_ans_length);
					console.log("multiple_answer_limit " + multiple_answer_limit);
					if (selected_ans_length > (multiple_answer_limit - 1)) {
						return false;
					}
				}
			}
		}


		if (jQuery(this).hasClass('product_select_box')) {
			jQuery(this).closest('.style-field-checkbox-outer').find('.product_box_outer').toggleClass('box_selected');
		} else {
			jQuery(this).toggleClass('active');
		}


		if (jQuery(this).closest('.style-field-checkbox-outer').hasClass('has_logn_text_ans_y')) {
			var other_nox = jQuery(this).closest('.stylist_field_outer').find('.other_long_text_wrapper').toggle();
		}

		console.log('now');
		console.log(jQuery(this).closest('.product_box_wrappr').find('.style-field-checkbox-outer').last().find('.product_box_multi_select.product_box_single_select').length);
		console.log('now');
		jQuery(this).closest('.product_box_wrappr').find('.style-field-checkbox-outer:nth-child(16)').find('.product_box_multi_select.product_box_single_select').removeClass('active');
		jQuery(this).closest('.product_box_wrappr').find('.style-field-checkbox-outer').last().find('.product_box_multi_select.product_box_single_select').removeClass('active');

		jQuery(this).closest('.style-field-checkbox-outer').find('.style-options-checkbox').trigger('click');

	});
	jQuery(document).on('click', '.product_box_single_select', function () {
		console.log("product_box_single_select call");

		if (jQuery(this).hasClass('product_select_box')) {
			jQuery(this).closest('.product_box_wrappr').find('.product_box_outer').removeClass('box_selected');
			jQuery(this).closest('.style-field-checkbox-outer').find('.product_box_outer').toggleClass('box_selected');
		} else {
			jQuery(this).closest('.product_box_wrappr').find('.product_box_single_select').removeClass('active');
			jQuery(this).addClass('active');
		}
		if (jQuery(this).closest('.style-field-checkbox-outer').hasClass('has_logn_text_ans_y')) {
			jQuery(this).closest('.stylist_field_outer').find('.other_long_text_wrapper').show();
		} else {
			jQuery(this).closest('.stylist_field_outer').find('.other_long_text_wrapper').hide();
		}
		jQuery(this).closest('.style-field-checkbox-outer').find('.style-options-checkbox').trigger('click');

		// if questions is single click, on select need to show the next question.

		if (jQuery(this).closest('.q_stylist_step.stylist_step').length != 0) {
			if (!jQuery(this).closest('.style-field-checkbox-outer').hasClass('has_logn_text_ans_y')) {
				jQuery(this).closest('.q_stylist_step.stylist_step').find('.question_save_btn').trigger('click');
			}
		}
	});

	// ------------------------------------------------------------------------------------------------
	jQuery(document).on('click', '.product_box_multi_select.product_box_single_select', function () {
		console.log("product_box_single_select call");

		if (jQuery(this).hasClass('product_select_box')) {
			jQuery(this).closest('.product_box_wrappr').find('.product_box_outer').removeClass('box_selected');
			jQuery(this).closest('.style-field-checkbox-outer').find('.product_box_outer').toggleClass('box_selected');
		} else {
			jQuery(this).closest('.product_box_wrappr').find('.product_box_multi_select.product_box_single_select').removeClass('active');
			jQuery(this).closest('.product_box_wrappr').each(function(){
				jQuery(this).closest('.product_box_wrappr').find('.style-field-checkbox-outer').find('.product_box_multi_select').removeClass('active');
			});
			jQuery(this).addClass('active');
		}

		if (jQuery(this).hasClass('product_select_box')) {
		}

		if (jQuery(this).closest('.style-field-checkbox-outer').hasClass('has_logn_text_ans_y')) {
			jQuery(this).closest('.stylist_field_outer').find('.other_long_text_wrapper').show();
		} else {
			jQuery(this).closest('.stylist_field_outer').find('.other_long_text_wrapper').hide();
		}
		jQuery(this).closest('.style-field-checkbox-outer').find('.style-options-checkbox').trigger('click');

		// if questions is single click, on select need to show the next question.

		if (jQuery(this).closest('.q_stylist_step.stylist_step').length != 0) {
			if (!jQuery(this).closest('.style-field-checkbox-outer').hasClass('has_logn_text_ans_y')) {
				jQuery(this).closest('.q_stylist_step.stylist_step').find('.question_save_btn').trigger('click');
			}
		}
	});
	// ------------------------------------------------------------------------------------------------

	if (jQuery("#stf_booking_date").length == 1) {
		jQuery("#stf_booking_date").datepicker({
			dateFormat: 'dd/mm/yy',
			minDate: 1, maxDate: '+13D',
			onSelect: function (dateText) {
				stfBookingTimeShowByDate();
			}
		});
	}

	if (jQuery('.stf_questions_top_pagination').length == 1) {
		jQuery('.stf_questions_top_pagination').on('click', '.stylist_step_progress.stylist_step_progress_active,.stylist_step_progress.stylist_step_progress_active_already', function () {
			var q_section = jQuery(this).attr('q_section');
			console.log("q_section 86: " + q_section);
			jQuery('.stylist_qeustions_list').find('.q_stylist_step.stylist_step').hide();
			jQuery('.stylist_qeustions_list').find('.q_stylist_step.stylist_step[section_heading_id="' + q_section + '"]:first').show();
			jQuery('.stf_questions_top_pagination .stylist_step_progress').removeClass('stylist_step_progress_active');
			jQuery('.stf_questions_top_pagination .stylist_step_progress_active_tab').removeClass('stylist_step_progress_active_tab');
			jQuery(this).addClass('stylist_step_progress_active stylist_step_progress_active_already');
			jQuery('.stf_questions_top_pagination .stylist_step_progress').each(function () {

				if (jQuery(this).hasClass('stylist_step_progress_active')) {
					jQuery(this).addClass('stylist_step_progress_active_tab');
					return false;
				}
				jQuery(this).addClass('stylist_step_progress_active');
			});

			var progress_bar_width = jQuery('.stf_questions_top_pagination .stylist_step_progress.stylist_step_progress_active:last').attr('progress_bar_width');
			if (typeof progress_bar_width === "undefined") {

			}
			else {
				progress_bar_width = parseInt(progress_bar_width);
				jQuery('.stf_questions_top_pagination .progress-bar').css('width', progress_bar_width + '%');
			}


		});
	}

});


function stylistGetBookingSelectedDate() {
	var booking_inst = jQuery("#stf_booking_date").datepicker('getDate');
	var booking_date = '';
	if (booking_inst !== null) { // if any date selected in datepicker
		booking_inst instanceof Date; // -> true


		booking_date = booking_inst.getDate() + '-' + (booking_inst.getMonth() + 1) + '-' + booking_inst.getFullYear();
		if (booking_inst.getDate() == 'NaN') {
			booking_date = '';
		}

		jQuery(".customer_booking_time_wrapper, .booking_btn").show();

	}

	return booking_date;
}

function stylistRevealProdoctSliderOwl() {
	jQuery('.stylist_pro_images_owl').owlCarousel({
		items: 1,
		animateOut: 'fadeOut',
		loop: true,
		margin: 10,
		dots: true,
		autoplay: true,
		autoPlaySpeed: 5000,
		autoPlayTimeout: 5000,
		autoplayHoverPause: true,
		nav: true
	});
}

function stylistAddRemoveToCart() {
	jQuery('.remove_add_to_card').on('click', function () {
		jQuery(this).hide();
		jQuery('.products_feedback_wrappr .product_feedback_' + jQuery(this).val()).show();
		jQuery(this).closest('.dappr-altenative-style').find('.add_to_card').show().removeClass('product_selected');
		jQuery('.add_to_cart_product_select_' + jQuery(this).val()).prop('checked', false);
	});
	jQuery('.add_to_card').on('click', function () {
		jQuery('.products_feedback_wrappr .product_feedback_' + jQuery(this).val()).hide();

		jQuery('.add_to_cart_product_select_' + jQuery(this).val()).prop('checked', true);
		jQuery(this).hide().addClass('product_selected');
		jQuery(this).closest('.dappr-altenative-style').find('.remove_add_to_card').show();
	});
}


function stylist_step_prev_show(obj = '', next_step_no = '') {
	var parent_selector_outer = jQuery(obj).closest('.q_stylist_step');



	if (parent_selector_outer.length != 0) {

		var previous_q_skip_id = parent_selector_outer.attr('previous_q_skip_id');
		if (typeof previous_q_skip_id != 'undefined' && previous_q_skip_id != '') {
			console.log("previous_q_skip_id " + previous_q_skip_id);
			jQuery('.stylist_qeustions_list .q_stylist_step').hide();
			jQuery('.stylist_qeustions_list').find('.q_stylist_step[skip_id="' + previous_q_skip_id + '"]:first').show();
		} else {
			var dont_show_questions = parent_selector_outer.prevAll('.stylist_do_not_show_this_questions').length;
			console.log('dont_show_questions 180 length ' + dont_show_questions);
			for (stylist_i = 0; stylist_i <= dont_show_questions; stylist_i++) {
				if (!parent_selector_outer.prev().hasClass('stylist_do_not_show_this_questions')) {
					jQuery('.stylist_step_frontend .stylist_step').hide();
					parent_selector_outer.prev().show();
					return false;
				} else {
					parent_selector_outer = parent_selector_outer.prev();
				}
			}
		}

		/* if(parent_selector_outer.hasClass('q_section_screen')){
			  jQuery('.stylist_step_frontend .stylist_step').hide();
					jQuery(obj).closest('.q_stylist_step').prev().show();
					stylist_questions_screen_progress_bar_set_active();
					return false;
			 }else if(jQuery(obj).closest('.q_stylist_step').prev().hasClass('q_section_screen')){
			jQuery('.stylist_step_frontend .stylist_step').hide();
					jQuery(obj).closest('.q_stylist_step').prev().show();
					stylist_questions_screen_progress_bar_set_active();
					return false;
			 }
		var current_step_no = parent_selector_outer.attr('question_no');
		jQuery('.stylist_step_frontend .stylist_step').hide();
		var previous_question_no  = parent_selector_outer.attr('previous_question_no');
		if(typeof previous_question_no != 'undefined'){
			jQuery('.q_stylist_step.stylist_step_'+previous_question_no).show();
		}else{

			var prev_question_no = jQuery(obj).closest('.q_stylist_step').attr('prev_question_no');
			console.log('prev_question_no'+prev_question_no);
			if(prev_question_no != 0){
				jQuery('.stylist_step_'+prev_question_no).show();
				stylist_questions_screen_progress_bar_set_active();
				return false;
			}

			jQuery(obj).closest('.q_stylist_step').prev().show();
		}*/
		stylist_questions_screen_progress_bar_set_active('previous_button_click');

	}

}

function stylistSelectMultipleOption() {

	jQuery('.style-options').on('click', function () {

		if (jQuery(this).hasClass('style-options-selected')) {
			jQuery(this).removeClass('style-options-selected');
			jQuery(this).closest('.style-field-checkbox-outer').find('.style-options-checkbox').prop('checked', false);
			if (jQuery(this).hasClass('field_name_other')) {
				jQuery(this).closest('.stylist_field_outer').find('.other_feedback_field').hide();
				console.log("f88");
			}
		} else {

			jQuery(this).addClass('style-options-selected');

			jQuery(this).closest('.style-field-checkbox-outer').find('.style-options-checkbox').prop('checked', true);
			if (jQuery(this).hasClass('field_name_other')) {
				console.log("ff");
				jQuery(this).closest('.stylist_field_outer').find('.other_feedback_field').css('display', 'flex');
			}
		}
	});
}


function stylist_step_show(obj = '', next_step_no = '', show_next_screen = 'yes') {
	var field_validation = true;
	var parent_selector_outer = jQuery(obj).closest('.q_stylist_step');
	console.log(parent_selector_outer);
	// return false;
	var skip_id = parent_selector_outer.attr('skip_id');
	var not_skip_validaiton_and_saving_part = true;
	var field_validation = true;
	if (parent_selector_outer.hasClass('q_section_screen') || (show_next_screen == 'no')) {
		not_skip_validaiton_and_saving_part = false;
	}
	var current_step_no = jQuery(obj).closest('.q_stylist_step').attr('question_no');
	console.log('current_step_no :- ' + current_step_no);
	if ((jQuery('.stylist_step_frontend .stylist_step_' + current_step_no).length != 0) || (parent_selector_outer.hasClass('q_section_screen'))) {
		console.log(1);
		console.log(jQuery('.stylist_step_frontend .stylist_step_' + current_step_no));
		console.log(2);
		var parent_selector = jQuery('.stylist_step_frontend .stylist_step_' + current_step_no);
		console.log('parent_selector ' + parent_selector);
		if (not_skip_validaiton_and_saving_part) {
			console.log("current_step_no 2 " + current_step_no);
			if (parent_selector.find('.stylist_field_text').length != 0) {
				// bottom error
				parent_selector.find('.stylist_field_outer').find('.stylist_field_error').removeClass('stylist_field_error_has');

				// jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2')
				// var errro_class2 = parent_selector_outer.find('.question_name_text').closest('.stylist_field_error2');
				// second error
				var errro_class2 = jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2');

				var error_class_3 = jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error3');

				// description
				var get_descritpion = jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.question_description');
				if (get_descritpion) {
					console.log('yesssssss');
				}
				if (errro_class2) {
					console.log('YES CLASS');
					jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').removeClass('stylist_field_error_has');
				}

				if (error_class_3) {
					console.log('description error');
					jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error3').removeClass('stylist_field_error_has');
				}

				parent_selector.find('.stylist_field_text').each(function () {
					var field_value = jQuery(this).val();
					var field_type = jQuery(this).attr('type');
					console.log("current_step_no 3 " + current_step_no);
					if (field_type == 'file') {
						file_image = jQuery(this).closest('.stylsit_file_upload_field').find('input[name="file_image"]').val();
						if (file_image != '') {
							field_value = file_image;
						}
					}
					if (field_value == '' && jQuery(this).hasClass('stylist_field_required')) {
						jQuery(this).closest('.stylist_field_outer').find('.stylist_field_error').addClass('stylist_field_error_has');
						// jQuery(this).closest('.stylist_field_outer').prev().find('.stylist_field_error2').addClass('stylist_field_error_has');
						// jQuery(this).closest('.stylist_field_outer').prev().find('.stylist_field_error3').addClass('stylist_field_error_has');
						field_validation = false;
					}
				});
				if (!field_validation) {
					return false;
				}
			}
			else if (parent_selector.find('.style-options-checkbox').length != 0) {
				console.log('style-options-checkbox call');
				parent_selector.find('.stylist_field_outer').find('.stylist_field_error').removeClass('stylist_field_error_has');
				// -----------------------------------------------------------------------------------------------

				var errro_class2 = jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2');
				var error_class_3 = jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error3');
				var get_descritpion = jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.question_description');
				jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').removeClass('stylist_field_error_has');
				console.log('desc classs');
				jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error3').removeClass('stylist_field_error_has');
				// -----------------------------------------------------------------------------------------------
				var checkbox_validate = false;
				if (parent_selector.find('.stylist_field_outer').hasClass('stylist_field_required_one')) {
					var checkbox_selcted_length = parent_selector.find('.style-options-checkbox:checked').length;
					console.log('style-options-checkbox call checkbox_selcted_length' + checkbox_selcted_length);
					if (checkbox_selcted_length == 0) {
						field_validation = false;
						parent_selector.find('.stylist_field_outer').find('.stylist_field_error').addClass('stylist_field_error_has');
						if (errro_class2) {
							console.log('add_error_calss1111');
							jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').addClass('stylist_field_error_has');
							jQuery(obj).closest('.q_stylist_step').find('.stylist_field_error3').addClass('stylist_field_error_has');
						}
						// if((!get_descritpion))
						// {
						// 	console.log('add_error_calss2');
						// 	jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').addClass('stylist_field_error_has');
						// 	jQuery(obj).closest('.q_stylist_step').find('.stylist_field_error3').removeClass('stylist_field_error_has');
						// }	


						console.log("checkbox_selcted_length " + checkbox_selcted_length);
						return false;
					}
					else if ((checkbox_selcted_length > 0)) {
						console.log(checkbox_selcted_length > 0);
						parent_selector.find('.stylist_field_outer').find('.stylist_field_error').removeClass('stylist_field_error_has');
						if (errro_class2 && get_descritpion) {
							jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').removeClass('stylist_field_error_has');
							jQuery(obj).closest('.q_stylist_step').find('.stylist_field_error3').removeClass('stylist_field_error_has');
						}
						else if (errro_class2 && !get_descritpion) {
							console.log('add_error_calss2');
							jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').removeClass('stylist_field_error_has');
						}

						other_ans_text = parent_selector.find('.stylist_field_outer').find('textarea.other_long_text').val();

						console.log('other_ans_textother_ans_textother_ans_text ' + other_ans_text);
						// get_css = parent_selector.find('.stylist_field_outer').find('textarea.other_long_text').css('display');
						get_css = parent_selector.find('.stylist_field_outer').find('.other_long_text_wrapper').css('display');
						console.log('get_cssget_cssget_cssget_cssget_css ' + get_css);
						if ((other_ans_text == '') && (get_css == 'block')) {
							parent_selector.find('.stylist_field_outer').find('.stylist_field_error').addClass('stylist_field_error_has');
							if (errro_class2) {
								jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').addClass('stylist_field_error_has');
								jQuery(obj).closest('.q_stylist_step').find('.stylist_field_error3').addClass('stylist_field_error_has');
							}

							return false;
						}


					}
					// || parent_selector.find('.stylist_field_outer').hasClass('has_logn_text_ans_y')
					// if((checkbox_selcted_length == 1))
					// {

					// ----------------------------------------------------------------
					// remove all class if lenght == 1;

					// ----------------------------------------------------------------



					// other_ans_text = parent_selector.find('.stylist_field_outer').find('textarea.other_long_text').val();
					// console.log('other_ans_textother_ans_textother_ans_textother_ans_text' + other_ans_text);
					// get_css = parent_selector.find('.stylist_field_outer').find('textarea.other_long_text').css('display');

					// console.log('get_cssget_cssget_cssget_cssget_cssget_css' + get_css);
					// if(other_ans_text == '' && get_css == 'inline-block' || get_css == 'block')
					// {
					// 	parent_selector.find('.stylist_field_outer').find('.stylist_field_error').addClass('stylist_field_error_has');
					// 	// jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').addClass('stylist_field_error_has');
					// 	if(errro_class2 && get_descritpion)
					// 	{
					// 		jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').removeClass('stylist_field_error_has');
					// 		jQuery(obj).closest('.q_stylist_step').find('.stylist_field_error3').addClass('stylist_field_error_has');
					// 	}
					// 	else if(errro_class2 && !get_descritpion)
					// 	{
					// 		console.log('add_error_calss2');
					// 		jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').addClass('stylist_field_error_has');
					// 	}
					// 	return false;
					// }
					// else if(other_ans_text != '' && get_css == 'inline-block' || get_css == 'block')
					// {
					// 	console.log('asdsadasd');
					// 	parent_selector.find('.stylist_field_outer').find('.stylist_field_error').removeClass('stylist_field_error_has');
					// 	// jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').addClass('stylist_field_error_has');
					// 	if(errro_class2 && get_descritpion)
					// 	{
					// 		jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').removeClass('stylist_field_error_has');
					// 		jQuery(obj).closest('.q_stylist_step').find('.stylist_field_error3').removeClass('stylist_field_error_has');
					// 	}
					// 	else if(errro_class2 && !get_descritpion)
					// 	{
					// 		console.log('add_error_calss2');
					// 		jQuery(obj).closest('.q_stylist_step').find('.question_name_text').find('.stylist_field_error2').removeClass('stylist_field_error_has');
					// 	}
					// }

					// }
				}
			}
		}
		if (show_next_screen == 'no') {
			var input_values_1 = {};
			input_values_1[0] = { question_id: 'save_and_continue_later', answer_id: 'save_and_continue_later', type: '' };
			var data_send = { method_name: 'save_question_answers', data: input_values_1 };
			response = stfFeDataAjax(obj = '', data_send);
			window.location.href = dapper_base_url + '/stylist/customer/info';
			return false;
		}
		console.log("++++++1++++++++");
		if (field_validation) {
			console.log("++++++2++++++++");
			var depend_cat_id = 0;
			if (not_skip_validaiton_and_saving_part) {
				var save_response = stf_save_question_answers(parent_selector_outer);
				if (save_response.success && show_next_screen == 'no') {
					stfErrorAlert(save_response.continue_later, 'success');
					stfSaveAndContinueQuestionContinueScreen();
					window.location.href = dapper_base_url + '/stylist/customer/info';
					return false;
				}
				if (!save_response.success) {
					return false;
				}
				if (save_response.budget_cal) {
					jQuery('.q_stylist_step.stylist_step[skip_id="' + save_response.budget_cal.skip_id + '"] .question_name_text').html(save_response.budget_cal.name);
				}
			}
			// if next questions is question screen
			if (jQuery(obj).closest('.q_stylist_step').next().hasClass('q_section_screen')) {
				console.log("q_stylist_step 123===" + skip_id);
				jQuery('.stylist_step_frontend .stylist_step').hide();
				jQuery(obj).closest('.q_stylist_step').next().attr('previous_q_skip_id', skip_id).show();
				stylist_questions_screen_progress_bar_set_active();
				if (skip_id == 'men_women_combine_q') {
					jQuery('.q_section_screen').removeClass('stylist_com_category_questions_selected stylist_wom_category_questions_selected');
					var answer_value = jQuery('.q_stylist_step[skip_id="men_women_combine_q"]').find('input.style-options-checkbox:checked').attr('answer_value');
					if (answer_value == 'com') {
						jQuery('.q_section_screen').addClass('stylist_com_category_questions_selected');
					}
					else if (answer_value == 'wom') {
						jQuery('.q_section_screen').addClass('stylist_wom_category_questions_selected');
					}
					else if (answer_value == 'men') {
						jQuery('.q_section_screen').addClass('stylist_men_category_questions_selected');
					}
				}
				return false;
			}
			var previous_q_skip_id = jQuery(obj).closest('.q_stylist_step').attr('previous_q_skip_id');
			if (previous_q_skip_id == 'men_women_combine_q') {
				depend_cat_id = jQuery('.q_stylist_step[skip_id="men_women_combine_q"]').find('input.style-options-checkbox:checked').closest('.style-field-checkbox-outer-box').attr('depend_cat_id');
				var answer_value = jQuery('.q_stylist_step[skip_id="men_women_combine_q"]').find('input.style-options-checkbox:checked').attr('answer_value');
				// don't show the questions on the behafe of men, women and combin answer select
				jQuery('.stylist_qeustions_list  .q_stylist_step.stylist_step').removeClass('stylist_do_not_show_this_questions');
				if (answer_value == 'com') {
					jQuery('.category_belong_id_4[section_heading_id="5"]').addClass('stylist_do_not_show_this_questions');
				}
				else if (answer_value == 'wom') {
					jQuery('.category_belong_id_4').addClass('stylist_do_not_show_this_questions');
				}
				else if (answer_value == 'men') {
					jQuery('.category_belong_id_3').addClass('stylist_do_not_show_this_questions');
				}
			}
			// console.log("+++++++3++++++++");
			var answer_skip_question_id = 0;
			var answer_skip_question_status = 'N';
			if (parent_selector_outer.find('input[type="radio"].stylist_field:checked').length != 0) {
				var selected_ans_parent = parent_selector_outer.find('input[type="radio"].stylist_field:checked').closest('.style-field-checkbox-outer');
				answer_skip_question_id = selected_ans_parent.attr('answer_skip_question_id');
				console.log("answer_skip_question_id " + answer_skip_question_id);
				if (typeof answer_skip_question_id === "undefined") {
					//return false;
				}
				if (answer_skip_question_id != '' && answer_skip_question_id != 0) {
					answer_skip_question_status = 'Y';
				}
			}
			else if (parent_selector_outer.find('input[type="checkbox"].stylist_field.answer_skip_question_enable:checked').length != 0) { // skip question for multiple selector 
				if (parent_selector_outer.find('input[type="checkbox"].stylist_field:checked:not(.answer_skip_question_enable)').length != 0) {
				}
				else {
					var selected_ans_parent = parent_selector_outer.find('input[type="checkbox"].stylist_field:checked').closest('.style-field-checkbox-outer');
					answer_skip_question_id = selected_ans_parent.attr('answer_skip_question_id');
					//console.log("answer_skip_question_id "+answer_skip_question_id);
					if (typeof answer_skip_question_id === "undefined") {
						//return false;
					}
					if (answer_skip_question_id != '' && answer_skip_question_id != 0) {
						answer_skip_question_status = 'Y';
					}
				}
			}
			//console.log("+++++++4++++++++");
			if (parent_selector_outer.hasClass('question_depend_on_ans')) {
				depend_cat_id = parent_selector_outer.find('input.style-options-checkbox:checked').closest('.style-field-checkbox-outer-box').attr('depend_cat_id');
				console.log("depend_cat_id : " + depend_cat_id);
				//jQuery('.stylist_step_frontend .q_stylist_step').find('.cat_base_pagination').hide();
				//jQuery('.stylist_step_frontend .q_stylist_step').find('.without_cat_base_pagination').show();
				if (typeof depend_cat_id === "undefined") {
					return false;
				}
			}
			else if (parent_selector_outer.hasClass('show_booking_screen')) {
				var category_id = parent_selector_outer.attr('category_id');
				if (jQuery(obj).closest('.q_stylist_step').next('.category_belong_id_' + category_id).length == 0) {
					stylist_questions_screen_progress_bar_set_active();
					stf_show_booking_screen();
					return false;
				}
			}
			jQuery('.stylist_step_frontend .stylist_step').hide();
			if (depend_cat_id == 0) {
				if (jQuery(obj).closest('.q_stylist_step').next('.q_stylist_step').length != 0) {
					var pre_question_no = 0;
					if (jQuery(obj).closest('.q_stylist_step').next().attr('is_question_belong') == 'Y') {
						var show_depended_ans = 'N';
						parent_selector_outer.find('input.style-options-checkbox:checked').each(function () {
							if (jQuery(this).closest('.style-field-checkbox-outer').attr('answer_belong_to') == 'answer_id') {
								show_depended_ans = 'Y';
							}
						});
						if (show_depended_ans == 'N') {
							var pre_question_no = jQuery(obj).closest('.q_stylist_step').attr('question_no');
							jQuery(obj).closest('.q_stylist_step').next().next().attr('previous_q_skip_id', skip_id).attr('prev_question_no', pre_question_no).show();
						}
						else {
							jQuery(obj).closest('.q_stylist_step').next().attr('previous_q_skip_id', skip_id).attr('prev_question_no', pre_question_no).show();
						}
					}
					else {
						if (answer_skip_question_status == 'Y') {
							console.log('1');
							console.log("answer_skip_question_status--- " + answer_skip_question_status);
							var pre_question_no = jQuery(obj).closest('.q_stylist_step').attr('question_no');
							console.log(pre_question_no + 2);
							jQuery('.q_stylist_step.stylist_step[skip_id="' + answer_skip_question_id + '"]:last').next().attr('previous_q_skip_id', skip_id).attr('prev_question_no', pre_question_no).show();
						}
						else {
							console.log('3')
							jQuery(obj).closest('.q_stylist_step').next().attr('prev_question_no', pre_question_no).attr('previous_q_skip_id', skip_id).show();
						}
					}
					stylist_questions_screen_progress_bar_set_active();
					return false;
				}
				stylist_questions_screen_progress_bar_set_active();
				stf_show_booking_screen();
			}
			else {
				jQuery('.stylist_step_frontend .category_belong_id_' + depend_cat_id).first().attr('previous_q_skip_id', skip_id).attr('previous_question_no', current_step_no).show();
				//jQuery('.stylist_step_frontend .category_belong_id_'+depend_cat_id).find('.cat_base_pagination').show();
				//jQuery('.stylist_step_frontend .category_belong_id_'+depend_cat_id).find('.without_cat_base_pagination').hide();
				stylist_questions_screen_progress_bar_set_active();
			}
		}
	}
}

function stylist_questions_screen_progress_bar_set_active(action_name = '') {


	// show questions according to women, men and combination

	if (action_name == '' && jQuery('.stylist_qeustions_list  .q_stylist_step:visible').length != 0) {
		if (jQuery('.stylist_qeustions_list  .q_stylist_step:visible').hasClass('stylist_do_not_show_this_questions')) {

			var parent_selector_visible_q = jQuery('.stylist_qeustions_list  .q_stylist_step:visible');
			var previous_q_skip_id = parent_selector_visible_privious_skip_id = parent_selector_visible_q.attr('previous_q_skip_id');

			var dont_show_questions = parent_selector_visible_q.nextAll('.stylist_do_not_show_this_questions').length;
			console.log('dont_show_questions 491 length ' + dont_show_questions);
			for (stylist_i = 0; stylist_i <= dont_show_questions; stylist_i++) {

				if (parent_selector_visible_q.hasClass('stylist_do_not_show_this_questions')) {

					parent_selector_visible_q.attr('previous_q_skip_id', '').hide().addClass('plppl').next().show();
					parent_selector_visible_q = jQuery('.stylist_qeustions_list  .q_stylist_step:visible');
				} else {
					//return false;
				}

				// console.log("++++++++++ stylist_i "+stylist_i);

			}
			parent_selector_visible_q.attr('previous_q_skip_id', previous_q_skip_id);

			console.log('dont_show_questions 507 11111111111111');
			// if last screen will be show
			if (parent_selector_visible_q.hasClass('stylist_do_not_show_this_questions') || jQuery('.stylist_qeustions_list  .q_stylist_step:visible').length == 0) {
				console.log('dont_show_questions 510 --------------------');
				console.log('dont_show_questions 511 ---------11111===========' + parent_selector_visible_q.hasClass('stylist_do_not_show_this_questions'));
				console.log('dont_show_questions 512 --------0000======' + jQuery('.stylist_qeustions_list  .q_stylist_step:visible').length);
				jQuery('.stylist_qeustions_list  .q_stylist_step').hide();
				jQuery('.stylist_qeustions_list  .q_stylist_step[skip_id="' + parent_selector_visible_privious_skip_id + '"]').show();
				stf_show_booking_screen();
				return false;
			}

		}
		console.log('dont_show_questions 000000000');


	}

	// progress bar flow from one question to other
	if (jQuery('.stylist_qeustions_list  .q_stylist_step:visible').length != 0) {
		var active_class = 'progress_active_screen_class';
		var q_done_active_class = 'progress_active_question_class';
		jQuery('.stylist_qeustions_list  .q_stylist_step').removeClass(active_class);
		jQuery('.stylist_qeustions_list  .q_stylist_step').removeClass(q_done_active_class);
		var parent_selector = jQuery('.stylist_qeustions_list  .q_stylist_step:visible');
		var progress_bar_width = 0;
		if (parent_selector.hasClass('q_section_screen')) {
			progress_bar_width = parseInt(parent_selector.attr('progress_bar_start'));
			// console.log("--------------");
		} else {
			// console.log("+++++++++++++");


			parent_selector.prevUntil('.q_section_screen').addClass(q_done_active_class);
			jQuery('.stylist_qeustions_list  .q_stylist_step.' + q_done_active_class).prev().addClass(active_class);
			var progress_bar_start = jQuery('.stylist_qeustions_list  .q_stylist_step.' + active_class).attr('progress_bar_start');
			progress_bar_start = parseInt(progress_bar_start);
			var progress_bar_end = jQuery('.stylist_qeustions_list  .q_stylist_step.' + active_class).attr('progress_bar_end');
			progress_bar_end = parseInt(progress_bar_end);
			var section_heading_id = jQuery('.stylist_qeustions_list  .q_stylist_step.' + active_class).attr('section_heading_id');

			var total_q_for_screen = jQuery('.stylist_qeustions_list .q_stylist_step.stylist_step[section_heading_id="' + section_heading_id + '"]').not('.stylist_do_not_show_this_questions').length;
			if (total_q_for_screen > 1) {
				// remove screen question
				total_q_for_screen = total_q_for_screen - 1;
				progress_bar_end = progress_bar_end - progress_bar_start;
				var per_question_progress = parseFloat(progress_bar_end / total_q_for_screen);

				var q_done_length = jQuery('.stylist_qeustions_list  .q_stylist_step.' + q_done_active_class).not('.stylist_do_not_show_this_questions').length;

				// console.log("total_q_for_screen "+total_q_for_screen);
				// console.log("q_done_length "+q_done_length);
				// console.log("progress_bar_end "+progress_bar_end);
				// console.log("per_question_progress "+per_question_progress);
				// console.log("q_done_length "+parseFloat(per_question_progress*q_done_length));
				progress_bar_width = (progress_bar_start) + parseFloat(per_question_progress * q_done_length);
				console.log("progress_bar_width " + progress_bar_width);

			} else {
				progress_bar_width = progress_bar_start;
			}


		}

		if (typeof progress_bar_width === "undefined") {
			progress_bar_width = 0;
		}

		jQuery('.stf_questions_top_pagination .progress-bar').css('width', progress_bar_width + '%');


	}
	// set progress bar active in circle  point.
	console.log("stylist_questions_screen_progress_bar_set_active call");
	var section_heading_id = jQuery('.stylist_qeustions_list').find('.q_stylist_step.stylist_step:visible').attr('section_heading_id');
	if (section_heading_id != '') {
		var q_section = jQuery('.stf_questions_top_pagination .stylist_step_progress_1').attr('q_section');
		console.log("q_section 585: " + q_section);
		console.log("section_heading_id " + section_heading_id);
		if (1 || section_heading_id != q_section) {
			jQuery('.stf_questions_top_pagination .stylist_step_progress_active').removeClass('stylist_step_progress_active');
			jQuery('.stf_questions_top_pagination .stylist_step_progress_active_tab').removeClass('stylist_step_progress_active_tab');
			jQuery('.stf_questions_top_pagination .stylist_step_progress[q_section="' + section_heading_id + '"]').addClass('stylist_step_progress_active');
			jQuery('.stf_questions_top_pagination .stylist_step_progress').each(function () {

				if (jQuery(this).hasClass('stylist_step_progress_active')) {
					jQuery(this).addClass('stylist_step_progress_active_tab');
					return false;
				}
				jQuery(this).addClass('stylist_step_progress_active');
			});
		}
	}

}


function stylist_show_alertive_product(obj, show_product_type_class = '') {

	if (show_product_type_class == 'main_product_details') {

		jQuery(obj).closest('.product_details_outer').find('.alternate_product_details').hide();
	} else {
		jQuery(obj).closest('.product_details_outer').find('.main_product_details').hide();
	}
	jQuery(obj).closest('.product_details_outer').find('.' + show_product_type_class).show();


}

function stylist_client_form(obj) {

	jQuery('form#stylist_client_form').submit();


}

function stfShowScreenWrapper(hide_screen_class = '', show_screen_class = '') {

	jQuery('.' + hide_screen_class).hide();
	jQuery('.' + show_screen_class).show('slow');
}



function stylist_back_reveal_list_page(obj = '') {

	jQuery('.stylist_step_7').show();
	jQuery('.products_feedback_wrappr').hide();

}


function addtobag_list(obj = '') {
	var newval = obj.value;
	temparr = [];
	var numbersString = jQuery("#all_add_to_bag_items").val();
	if (numbersString != '') {
		preval = numbersString.split(',');
		jQuery.each(preval, function (index, value) {
			temparr.push(value);
		});

		if (jQuery.inArray(newval, temparr) === -1) {
			temparr.push(newval);
		}
	} else {
		temparr.push(newval);
	}
	jQuery("#all_add_to_bag_items").val(temparr);
}

function removeFromArray(arr, val) {
	var index = arr.indexOf(val);
	if (index > -1) {
		arr.splice(index, 1);
	}
}

function removetobag_list(obj = '') {
	var idval = obj.value;
	temparr = [];
	var numbersString = jQuery("#all_add_to_bag_items").val();
	if (numbersString != '') {
		preval = numbersString.split(',');
		jQuery.each(preval, function (index, value) {
			temparr.push(value);
		});
		removeFromArray(temparr, idval);
	}
	jQuery("#all_add_to_bag_items").val(temparr);
}


function stylist_proceed_checkout_page(obj = '') {
	var show_feedback_div = false;
	var uniqueNames = [];
	var selected_item_list = jQuery("#all_add_to_bag_items").val();
	var products_from_list = jQuery("#all_add_to_bag_items_skip").val();
	products_from_list = products_from_list.slice(0, -1);
	var selected_item_list_arr = selected_item_list.split(',');
	var products_from_list_arr = products_from_list.split(',');
	selected_item_list_arr.sort();
	products_from_list_arr.sort();

	$.each(products_from_list_arr, function (i, el) {
		if ($.inArray(el, uniqueNames) === -1) uniqueNames.push(el);
	});

	if (JSON.stringify(selected_item_list_arr) == JSON.stringify(uniqueNames)) {
		stylist_proceed_feedback_page(8, 8);
	}
	else {

		// show feedback always
		var show_feedback_div = true;
		jQuery('.product_details_outer').each(function () {
			if (jQuery(this).find('.product_selected').length == 0) {
				show_feedback_div = true;
			}

		});

		if (show_feedback_div) {
			jQuery('.stylist_step_7').hide();
			jQuery('.products_feedback_wrappr').show();

			jQuery('html, body').animate({
				scrollTop: $("body").offset().top
			}, 100);
		} else {
			jQuery('.products_feedback_wrappr').hide();
			console.log("All Product is selected");
			jQuery("#stylist_proceed_checkout_page").submit();
		}
	}

}

function stylist_proceed_feedback_page(current_step_no = '', next_step_no = '', validate_form = 'Y') {
	var field_validation = true;
	console.log("call 1 next_step_no " + next_step_no)
	if (jQuery('.stylist_step_frontend .stylist_step_' + next_step_no).length != 0) {
		var parent_selector = jQuery('.stylist_step_frontend .stylist_step_' + current_step_no);
		if (validate_form == 'Y') {
			console.log("call 1")
			if (parent_selector.find('.style-options-checkbox').length != 0) {
				parent_selector.find('.product_feedback_item:visible').find('.style-options-checkbox').each(function () {
					console.log('style-options-checkbox call');
					var parent_selector_inner = jQuery(this).closest('.stylist_field_outer');
					parent_selector_inner.find('.stylist_field_error').removeClass('stylist_field_error_has');
					var checkbox_validate = false;
					// if(parent_selector_inner.hasClass('stylist_field_required_one')){
					//   var checkbox_selcted_length = parent_selector_inner.find('.style-options-checkbox:checked').length;
					// //   if(checkbox_selcted_length == 0){
					// //   		field_validation = false;
					// //   		parent_selector_inner.find('.stylist_field_error').addClass('stylist_field_error_has');
					// //   		console.log("checkbox_selcted_length "+checkbox_selcted_length);

					// // 	}
					// }

				});
			}
		}
	}

	if (field_validation) {
		if (validate_form == 'N') {
			jQuery('#stylist_proceed_checkout_page input[name="skip_feedback"]').val('Y');
		}
		jQuery("#stylist_proceed_checkout_page").submit();
	} else {
		console.log("field submited");
		jQuery('.stylist_step.products_feedback_wrappr .product_feedback_item').each(function () {
			if (jQuery(this).find('.stylist_field_error').hasClass('stylist_field_error_has')) {
				jQuery('html, body').animate({
					scrollTop: jQuery(this).find('.stylist_field_error').closest('.product_feedback_item').offset().top
				}, 100);
				return false;
			}

		});

	}


}

function stylist_question_start() {
	jQuery('.stf_start_screen').hide();
	jQuery('.hide-bottom').css("display", "none");
	//jQuery('.stf_questions_top_pagination').css('display','block');
	jQuery('.stylist_qeustions_list').show();
	/*if(jQuery('.stf_questions_top_pagination  ul .stylist_step_progress.stylist_step_progress_active_already').length != 0){
			jQuery('.q_section_screen_step_0 .botom-style-previous .stf_save_btn').trigger('click');
	}*/

	if (jQuery('.q_stylist_step.question_already_attempt_class').length != 0) {
		jQuery('.stf_questions_top_pagination  ul .stylist_step_progress.stylist_step_progress_active_already:last').trigger('click');
		jQuery('.q_stylist_step.question_already_attempt_class:last').show();
		jQuery('.q_section_screen').hide();
		jQuery('.q_stylist_step.question_already_attempt_class:last .question_save_btn').trigger('click');


	}

}



function stf_type_form_booking_form(obj, merchant_id = 0) {
	var current_obj = jQuery(obj);

	jQuery('.customer_booking_date_time_wrapper').show();

	jQuery('html, body').animate({
		scrollTop: $(".customer_booking_date_time_wrapper").offset().top
	}, 100);


	/*
	var parent_selector = current_obj.closest('.section_class');
	parent_selector.hide();
	parent_selector.next().show();
	jQuery('.booking_appointment_list_section').find('input[name="merchant_id"]').val(merchant_id);
	stf_type_form_scroll_top();
	*/
}

function stf_type_form_scroll_top(top = 0) {
	jQuery([document.documentElement, document.body]).animate({
		scrollTop: top
	}, 100);
}

function stf_show_booking_screen() {
	stf_save_question_answers(parent_selector_outer_obj = '', all_question_complete = 'Y');
	jQuery('.stf_questeions_screen_wrappr').hide();
	if (actionName === 'redirectBookingConfirm') {
		window.location.href = dapper_base_url + '/stylist/customer/info';
	} else {
		jQuery('.stf_stylist_booking_screen').show('slow');
	}
}


function stf_fullCalendarcall(selector_id = '') {
	if (jQuery('#' + selector_id).length == 1) {
		var fullCalendarcall = jQuery('#' + selector_id);
		fullCalendarcall.fullCalendar({
			//weekends: false, // will hide Saturdays and Sundays
			header: { right: 'prev,next' },
		});
	}

}

function stf_save_question_answers(parent_selector_outer_obj = '', all_question_complete = 'N') {
	var input_values = {};
	if (parent_selector_outer_obj != '') {
		console.log("stf_save_question_answers call 1");
		var value = '';
		var name = '';
		var answer_id = '';
		var question_id = '';
		var type = '';
		var other_ans_text = '';
		if (parent_selector_outer_obj.hasClass('q_stylist_step')) {
			parent_selector_outer_obj.find('.stylist_field').each(function (index) {
				value = jQuery(this).val();
				// console.log('value1 ' + value);
				type = jQuery(this).attr('type');
				// console.log('type1 ' + type);
				answer_id = jQuery(this).attr('answer_id');
				question_id = jQuery(this).attr('question_id');
				// console.log('question_id' + question_id);


				if (type == 'radio') {
					if (jQuery(this).prop('checked')) {
						if (jQuery(this).closest('.style-field-checkbox-outer').length == 1 && jQuery(this).closest('.style-field-checkbox-outer').hasClass('has_logn_text_ans_y')) {
							other_ans_text = jQuery(this).closest('.stylist_field_outer').find('textarea.other_long_text').val();
							// get_css = jQuery(this).closest('.stylist_field_outer').find('textarea.other_long_text').css('display');
							// console.log('get_css ' + get_css);
							// if(other_ans_text == '' && question_id && get_css == 'inline-block' || get_css == 'block')
							// {

							// 	parent_selector_inner.find('.stylist_field_error').addClass('stylist_field_error_has');
							// 	// $('.stylist_field_error').css('display', 'block');
							// 	// $('.stylist_field_error').css('color', 'red');
							// 	return false;
							// }
							// else if (other_ans_text != '' && question_id )	
							// {
							// 	parent_selector_inner.find('.stylist_field_error').removeClass('stylist_field_error_has');
							// 	// $('.stylist_field_error').css('display', 'none');
							// }


						}
					} else {
						return true;
					}
				} else if (type == 'checkbox') {
					var answer_ids = []
					parent_selector_outer_obj.find('.stylist_field:checked').each(function (index_2) {
						answer_id = jQuery(this).attr('answer_id');
						answer_ids[index_2] = answer_id;
						if (jQuery(this).closest('.style-field-checkbox-outer').length == 1 && jQuery(this).closest('.style-field-checkbox-outer').hasClass('has_logn_text_ans_y')) {
							other_ans_text = jQuery(this).closest('.stylist_field_outer').find('textarea.other_long_text').val();
							// get_css = jQuery(this).closest('.stylist_field_outer').find('textarea.other_long_text').css('display');
							// console.log('get_css ' + get_css);
							// if(other_ans_text == '' && question_id && get_css == 'inline-block' || get_css == 'block'	)
							// {
							// 	// $('.stylist_field_error').css('display', 'block');
							// 	// $('.stylist_field_error').css('color', 'red');
							// 	parent_selector_inner.find('.stylist_field_error').addClass('stylist_field_error_has');
							// 	return false;
							// }
							// else if (other_ans_text != '' && question_id )	
							// {
							// 	parent_selector_inner.find('.stylist_field_error').removeClass('stylist_field_error_has');
							// 	// $('.stylist_field_error').css('display', 'none');
							// }

						}
					});
					answer_id = answer_ids.toString();
				} else if (jQuery(this).hasClass('answer_type_textarea')) {
					type = 'textarea';

				}

				// text_field = jQuery(this).closest('.stylist_field_outer').find('.stylist_field_text').val();
				// if(text_field == '' && question_i)
				// {
				// text_css =	jQuery(this).closest('.stylist_field_outer').find('.stylist_field_error_has').css();
				// console.log('text_css+ ' + text_css );
				// 	// $('.stylist_field_error').css('display', 'block');
				// 	// $('.stylist_field_error').css('color', 'red');
				// 	// return false;
				// }

				if (answer_id == 0) {
					answer_id = value;
				}
				input_values[index] = { question_id: question_id, answer_id: answer_id, type: type, other_ans_text: other_ans_text };

				if (type == 'checkbox') {
					return false;
				}
			});
			console.log('123456789');
			console.log(input_values);

			if (type == 'file') {
				var input_obj = jQuery("input[name='question[" + question_id + "]']");
				var file_image = input_obj.closest('.stylsit_file_upload_field').find('input[name="file_image"]').val();
				if (file_image == '') {
					var form_data = new FormData();
					var a_image = input_obj.prop("files")[0];
					form_data.append("file", a_image);
					form_data.append("method_name", 'save_question_answers');
					form_data.append("date_type", 'file');
					form_data.append('data', input_values);
					form_data.append('question_id', question_id);
					return response = stfFeDatFormaAjax(obj = '', form_data);
				} else {
					input_values[0] = { question_id: question_id, answer_id: file_image, type: type };
				}
			}
			var data_send = { method_name: 'save_question_answers', data: input_values };
			return response = stfFeDataAjax(obj = '', data_send);
			// console.log();

		}

	}
	if (all_question_complete == 'Y') {
		input_values[0] = { question_id: 'all', answer_id: 'all', type: '' };
		if (all_question_complete == 'Y') {
			var data_send = { method_name: 'save_question_answers', data: input_values };
			return response = stfFeDataAjax(obj = '', data_send);
		}
	}
}


function stfFeDatFormaAjax(obj = '', data_send = '', request_url = '') {

	if (request_url == '') {
		request_url = '/stylist/fe_save_data';
	}

	var output = false;
	stfShowloader();
	jQuery.ajax({
		url: dapper_base_url + request_url,
		type: 'POST',
		async: false,
		data: data_send,
		timeout: 3000,
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

function stfFeDataAjax(obj = '', data_send = '', request_url = '') {

	console.log(data_send);
	if (request_url == '') {
		request_url = '/stylist/fe_save_data';
	}
	console.log(dapper_base_url + request_url);
	var output = false;
	stfShowloader();
	jQuery.ajax({
		url: dapper_base_url + request_url,
		type: 'POST',
		async: false,
		data: data_send,
		timeout: 3000,
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

// function stfErrorAlert(msg = 'something wrong!',type = ''){
function stfErrorAlert(msg = '', type = '') {
	// alert(msg);
}


function stfShowloader() {
	console.log("stfShowloader call");

}

function stfHideloader() {
	console.log("stfHideloader call");

}



function stfBookingTimeShowByDate() {
	var parent_selector_inner = jQuery('.marchant_list_section .stylist_field_required_one');
	parent_selector_inner.find('.stylist_field_error').removeClass('stylist_field_error_has');
	var stylist_selected = parent_selector_inner.find('.merchant_item input[name="select_merchant"]:checked').length;
	var stylist_id = 0;
	if (stylist_selected == 0) {
		console.log("stylist_selected " + stylist_selected);
		parent_selector_inner.find('.stylist_field_error').addClass('stylist_field_error_has');
		//jQuery(obj).val('');
		return false;
	}
	stylist_id = parent_selector_inner.find('.merchant_item input[name="select_merchant"]:checked').val();


	var booking_date = stylistGetBookingSelectedDate()
	if (booking_date == '') {
		stfErrorAlert('Please select booking date', 'error');
		return false;
	}
	jQuery('.booking_btn').hide();
	jQuery('.customer_booking_time_wrapper .stylist_field_outer').html('');
	var data_send = { method_name: 'get_booking_time_list', booking_date: booking_date, stylist_id: stylist_id };
	response = stfFeDataAjax(obj = '', data_send);

	if (response.booking_time_html) {
		jQuery('.booking_btn').show();
		jQuery('.customer_booking_time_wrapper .stylist_field_outer').html(response.booking_time_html);
		jQuery('html, body').animate({
			scrollTop: $(".customer_booking_time_wrapper").offset().top
		}, 100);

	}

}

function stylist_save_booking(obj) {
	console.log("stylist_save_booking +++");
	var parent_selector_inner = jQuery('.marchant_list_section .stylist_field_required_one');
	parent_selector_inner.find('.stylist_field_error').removeClass('stylist_field_error_has');
	var stylist_selected = parent_selector_inner.find('.merchant_item input[name="select_merchant"]:checked').length;
	var stylist_id = 0;
	if (stylist_selected == 0) {
		console.log("stylist_selected " + stylist_selected);
		parent_selector_inner.find('.stylist_field_error').addClass('stylist_field_error_has');
		jQuery(obj).val('');
		return false;
	}

	stylist_id = parent_selector_inner.find('.merchant_item input[name="select_merchant"]:checked').val();


	var booking_date = stylistGetBookingSelectedDate();
	if (booking_date == '') {
		stfErrorAlert('Please select booking date', 'error');
		return false;
	}

	var booking_time = '';
	var booking_time_select = jQuery(".marchant_list_section .customer_booking_time_wrapper input[name='booking_time']:checked").length;
	if (booking_time_select == 0) {
		stfErrorAlert('Please select booking time', 'error');
		return false;
	}
	booking_time = jQuery(".marchant_list_section .customer_booking_time_wrapper input[name='booking_time']:checked").val();


	jQuery("#loading").show();
	var data_send = { method_name: 'save_booking_date_time', booking_date: booking_date, stylist_id: stylist_id, booking_time: booking_time };
	response = stfFeDataAjax(obj = '', data_send);
	if (response.review_html) {
		jQuery('.stf_stylist_booking_screen').hide();
		// jQuery('.booking_review_form').html(response.review_html).show('slow');
		jQuery('.booking_review_form').html(response.review_html).show('');
		jQuery("#loading").hide();
	}

}


function stfUploadfileShow(obj = '') {

	console.log("stfUploadfileShow");
	var show_image_class = '';
	var image_selector = jQuery(obj);
	if (image_selector.length == 1) {
		jQuery(obj).closest('.stylsit_file_upload_field').find('.stylsit_file_upload_field_img_preview').hide().find('img').attr('src', '');
		jQuery(obj).closest('.stylsit_file_upload_field').find('input[name="file_image"]').val();

		console.log("stfUploadfileShow 1111111");
		var validation_status = false;
		var image = image_selector.get(0).files;
		if (image && image[0]) {
			var image_url_base64 = window.URL.createObjectURL(image[0]);
			console.log(image_url_base64);
			var extension = image_selector.val().replace(/^.*\./, '');
			console.log(extension);
			if (!(/\.(png|jpg|jpeg|webp|heic)$/i).test(image_selector.val())) {
				stfErrorAlert('PNG and JPEG files allowed');
				image_selector.val('');
				validation_status = true;
			} else {
				jQuery(obj).closest('.stylsit_file_upload_field').find('.stylsit_file_upload_field_img_preview').show().find('img').attr('src', image_url_base64);
			}
		}

		return validation_status;

	}

}



function stylist_show_change_booking_screen() {
	jQuery('.booking_review_form').hide();
	jQuery('.stf_stylist_booking_screen').show();

}


function stylist_show_questions_answers_screen() {

	var stf_start_screen_css = $('.stf_start_screen').css('display');
	var stylist_qeustions_list_css = $('.stylist_qeustions_list').css('display');
	var hide_bottom_css = $('.hide-bottom').css('display');
	console.log('stf_start_screen_css ' + stf_start_screen_css);
	console.log('stylist_qeustions_list_css ' + stylist_qeustions_list_css);
	console.log('hide_bottom_css ' + hide_bottom_css);
	if ((stf_start_screen_css == 'none') && (stylist_qeustions_list_css == 'none') && (hide_bottom_css == 'block')) {
		$('.hide-bottom').removeAttr('style');
		$('.hide-bottom').addClass('force_hide_footer');
	}
	jQuery('.stf_questeions_screen_wrappr').show();
	jQuery('.stf_questeions_screen_wrappr .stylist_qeustions_list').show();
	jQuery('.booking_review_form, .stf_stylist_booking_screen').hide();
}

function stylist_step_prev_show_rename(obj = '', section_heading_id = 0) {

	if (jQuery('.stf_questions_top_pagination .stylist_step_progress[q_section="' + section_heading_id + '"]').length != 0) {
		jQuery('.stf_questions_top_pagination .stylist_step_progress_active').removeClass('stylist_step_progress_active');
		jQuery('.stf_questions_top_pagination .stylist_step_progress[q_section="' + section_heading_id + '"]').trigger('click');
	}

}


function stylist_checkout_from_step_prev_show(obj = '') {
	jQuery(obj).closest('.product_details_outer').hide().prev().show();
}


function stylist_checkout_from_step_next_show(obj = '') {
	jQuery(obj).closest('.product_details_outer').hide().next().show();
}

function stylist_checkout_video_next_step(obj = '') {
	jQuery('.stylist_step .stylist_step_7  .video_html_outer').hide();
	jQuery('.stylist_step .stylist_step_7  .product_details_outer:first').show();
}


function stylist_checkout_video_step(obj = '') {
	jQuery('.stylist_step .stylist_step_7  .video_html_outer').show();
	jQuery('.stylist_step .stylist_step_7  .product_details_outer').hide();
}



// $(document).ready(function () {
//     $('.save_continue_btn').click(function () {
//         $('.stf_start_screen').show();
//     });
//     $('.save_continue_btn').click(function () {
//         $('stylist_qeustions_list , form, ul').hide();
//     });
// });
$(document).ready(function () {
	$('.editing_btn').click(function () {
		$('.stf_start_screen').hide();
	});
	$('.editing_btn').click(function () {
		$('stylist_qeustions_list , form, ul').show();
	});
});



function stfSaveAndContinueQuestionContinueScreen() {
	var input_values_1 = {};
	input_values_1[0] = { question_id: 'save_and_continue_later', answer_id: 'save_and_continue_later', type: '' };

	var data_send = { method_name: 'save_question_answers', data: input_values_1 };
	response = stfFeDataAjax(obj = '', data_send);
}
function stylist_save_and_continue_later_skip(obj, nextm) {
	window.location.href = dapper_base_url + '/stylist/customer/info';

}


function stylist_save_and_continue_later_skip_new(obj, nextm) {
	// window.location.href = dapper_base_url+'/stylist/customer/info';
	// jQuery(this).closest('.stylist_field_outer').find('.stf_start_screen ').show();
	// stf_start_screen 
	var parent_selector_outer_css = jQuery(obj).closest('.q_stylist_step').css('display');
	console.log('parent_selector_outer_css parent_selector_outer_css' + parent_selector_outer_css);
	if (parent_selector_outer_css == 'block') {
		console.log('jQuery(obj) ' + jQuery(obj));
		var getscreen = jQuery(obj).closest('.stylist_field_outer').find('.stf_start_screen');
		console.log('_getscreen  _getscreen ' + getscreen);
		// location.reload();
		if (getscreen) {

			// $('.stf_start_screen').css('display','block');
			setTimeout(function () {
				$('.stf_start_screen').show();
				jQuery(obj).closest('.stylist_qeustions_list').hide();
			}, 5000);
			console.log(1 + '1');
		}
		location.reload();
	}
}

// jQuery(document).on('click','.q_stylist_step.fix_rand_id_7_class  .product_box_outer ',function(){
// 	var ans_value = jQuery(this).find('.style-options-checkbox').attr('answer_value');
// 	if( ans_value != 'com'){
// 		jQuery(this).closest('.product_box_wrappr ').find('.style-field-checkbox-outer-box:last').hide();
// 	}
//  })




// jQuery(document).on('click','.q_stylist_step.fix_rand_id_7_class  .product_box_outer ',function(){
// 	var ans_value = jQuery(this).find('.style-options-checkbox').attr('answer_value');
// 	if( ans_value != 'com'){
// 		jQuery(this).closest('.product_box_wrappr ').find('.style-field-checkbox-outer-box:last').hide();
// 	}
//  })

$(document).ready(function () {
	var ans_value = jQuery('.q_stylist_step.fix_rand_id_7_class  .product_box_outer:last').find('.style-options-checkbox').attr('answer_value');
	console.log(ans_value);
	if (ans_value == 'com') {
		jQuery('.q_stylist_step.fix_rand_id_7_class  .product_box_outer:last').hide();
	}
});


// $(document).ready(function () {
// 	// var base_url = dapper_base_url+'/stylist/customer/info';
// 	var base_url = dapper_base_url+ '/my/dashboard';
// 	var get_text = base_url.search("/my/dashboard");
// 	if(get_text)
// 	{
// 		console.log('sdfjkhsdfk11211111111111111');
// 	}
// 	// var base_url = dapper_base_url;
// 		// console.log('sdfhsflkfurl')
// 	console.log(base_url);
// 	// if( ans_value == 'com'){	
// 	// 	jQuery('.q_stylist_step.fix_rand_id_7_class  .product_box_outer:last').hide();
// 	// }
// 	if(base_url ==  dapper_base_url+ '/my/dashboard')
// 	{
// 		console.log('123133');
// 		console.log(base_url);
// 		window.location.href = dapper_base_url+'/my/account';	
// 	}
// });

$(document).ready(function () {
	var base_url = dapper_base_url + '/my/dashboard';
	// console.log(base_url);
	// console.log(dapper_base_url);
	var get_url = document.URL;
	// console.log('url '+ get_url);
	if (get_url == base_url) {
		// console.log('yes1111');
		window.location.href = dapper_base_url + '/my/account';
	}
});