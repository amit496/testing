@extends('admin.layouts.master')

@section('content')
	@if(session('success'))
		<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show">
			{{session('success')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	 @endif
	 @if(session('error'))
		<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-danger  fade show">
			{{session('error')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>


	 @endif





	<div class="box stf_outer_body stf_outer_page_load" style="display:none">
		<div class="row "style="display: flex; margin-left: 0;">

		<div class=""style="width: 96%; ">
			<div class="box-header with-border">
				<!-- <h3 class="box-title">Manage Stylist Form</h3>
				<div class="box-tools pull-right">
					<a href="{{ url('admin/stylist/add') }}" class=" btn btn-new btn-flat">Add a New Form</a>

				</div> -->


				<form action="{{ url('admin/stylist/customer_request'); }}" method="get">

					@php
						$page_no = 1;
						$search_booking_status= '';
						$search_company_id = 0;
						$search_company_label = 'Company';
						$search_app_date_label = 'Date';
						if(isset($_GET['page'])){
							$page_no = $_GET['page'];
						}

						if(isset($filter_values['search_company_name'])){
							$search_company_label = $filter_values['search_company_name'];
							$company_id = $filter_values['search_company_id'];
						}
						if(isset($filter_values['search_app_date_ids'])){
							$search_app_date_label = $filter_values['search_app_date_text'];

						}

					@endphp

					<input type="hidden" name="page" value="{{ $page_no }} ">
					<input type="hidden" name="company_id" value="{{ $search_company_id }} ">
					<input type="hidden" name="app_date" value="{{ $search_app_date_label }} ">
					<input type="hidden" name="booking_status" value="{{ $search_booking_status }} ">

				<div class="d-flex justify-content-center align-items-center">
					<div class="col-md-6 stf_outer_body-input ">
						<div class="form">
						<i class="fa fa-search" style="top: 15px;"></i>
						<input type="text" class="form-control form-input-1 "  style="/*border-radius: 7px !important;*/">
						</div>

					</div>

					</div>



				<div class="stf_dropdown_with_submenu">
					<div class="dropdown1 dropdown">
						<button type="button" onclick="stfTopSubMenuShowHide(this)" class="dropbtn booking_status_label">Status <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i></button>
						<div  class="dropdown-content style_cr_filter_drop_down">

							<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,'booking_status','Active','Active')" >Active</a>
							<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,'booking_status','De-Active','De-Active')" >De-Active</a>
						</div>
					</div>
					<div class="dropdown">
						<button type="button" onclick="stfTopSubMenuShowHide(this)" class="dropbtn app_date_label">{{ $search_app_date_label }} <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i></button>
						<div  class="dropdown-content myDropdown  style_cr_filter_drop_down">
						<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,'app_date','','All')">All</a>
							@if($all_booking_date_list->isNotEmpty())
							@foreach($all_booking_date_list as $key=>$info)
							<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,'app_date','{{ $info->appointment_date}}','{{ $info->appointment_date}}')"> {{ $info->appointment_date }}</a>
							@endforeach
							@endif

						</div>
					</div>
					<div class="dropdown myDropdown">
						<button type="button" onclick="stfTopSubMenuShowHide(this)" class="dropbtn company_id_label">{{ $search_company_label }} <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i>
						</button>
						<div  class="dropdown-content style_cr_filter_drop_down">
							 @php

							 $html_company_list = '';
							$html_company_list .= '<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,\'company_id\',0,\'All\')">All</a>';
								if($employerOnboarding){
									foreach($employerOnboarding as $employerOnboarding_info){


										$company_name = $employerOnboarding_info['company_name'];
										$company_id = $employerOnboarding_info['id'];
										 $html_company_list .= '<a href="javascript:void(0)" onclick="stfCustomerRequestFilter(this,\'company_id\',\''.$company_id.'\',\''.$company_name.'\')">'.$company_name.'</a>';
									}

								}
							    echo $html_company_list;
	 						@endphp
						</div>
					</div>


					<button  class="dropbtn ">Search</button>

				</div>


			</div> <!-- /.box-header -->

			<div class="box-body stf_table_hide_serarch_bar">
				<table class="table table-hover table-no-sort" id="stf_request_list">

					<tbody>
						<tr class="stf_outer_body_table_style articles">
						<th><h3>Profile</h3></th>
						<th><h3>Name</h3></th>
						<th><h3>Company</h3></th>
						<th class="c-text-center"><h3>Task Due</h3></th>
						<th class="c-text-center"><h3>Reveal Status</h3></th>
						<th class="c-text-center"><h3>Time Left</h3></th>
						<th class="c-text-center"><h3>Action Status</h3></th>

						<th class="c-text-center"> </th>


					</tr>


					@if($list->count() > 0)
						@foreach($list as $key=>$info)

						@php

						$reveal_status = 'not_started';
						$reveal_status = $info->status;
						$reveal_status_text_new = ucwords(str_replace('_', ' ',$reveal_status));


						$reveals_info = $info->listJoinWithRevealsItems()->first();

						$stylist_call_complete = $info->statusHistory()->where('status', '=', 'call_complete')->first();

						$stylistUser = $info->stylistUser()->first();
						$company_name = '';



						if(isset($stylistUser)){
							$company_obj = $info->stylistUser->company()->first();
							if(isset($company_obj)){
								$company_name =  $company_obj->company_name;

							}
						}


						$name = '';
						$profile_img_url = url('images/stylist/dummy-profile-pic.png');



 						$customer_obj = $info->customer()->first();
						if(isset($customer_obj)){
							$name = $customer_obj->name;
							$customer_image_obj = $info->customerImage()->first();
							if(isset($customer_image_obj)){
								$profile_img_url  = url('image/'.$customer_image_obj->path);
							}
						}

						$reveal_action_btn = '';
						$reveal_status_button_class = '';
						$reveal_status_button_text = '';
						$reveal_action_status_text = '';
						$reveal_action_btn = '<a  href="'.url('admin/stylist/customer_request/'.$info->id).'" title="Manage" class="custom-manage-reveal-btn">Manage <a>';



							if($reveal_status == 'not_started'){
								$reveal_status_button_text = 'Not started';
								$reveal_action_status_text = 'Create reveal';
								//$reveal_action_status_text = 'Manage';
									$reveal_action_btn = '<a  href="'.url('admin/stylist/customer_request/'.$info->id).'" title="Manage" class="custom-manage-reveal-btn">Manage </i><a>';
							}else if($reveal_status == 'sent'){
								$reveal_status_button_text = 'Sent';
								$reveal_action_status_text = 'Relax';
							}else if($reveal_status == 'complete'){


                                $reveal_status_button_text = 'complete';
								$reveal_action_status_text = 'Relax';
							}else if($reveal_status == 'draf'){
								$reveal_status_button_text = 'Draf';
								$reveal_status_button_class = 'text-warning-style-two';

							}else if($reveal_status == 'awaiting_response'){
								$reveal_status_button_text = 'Awaiting Response';
								$reveal_status_button_class = 'text-warning-style-two';

							}else if($reveal_status == 'preparing_order'){
								$reveal_status_button_text = 'Preparing Order';
								$reveal_action_status_text = 'Manage reveal';
								$reveal_status_button_class = 'text-warning-style-two';

							}else if($reveal_status == 'decline'){
								$reveal_status_button_text = 'Decline';
								$reveal_action_status_text = 'Create new reveal';
								$reveal_status_button_class = 'text-warning-style';

							}else{
								$reveal_status_button_text = 'In Progress';
								$reveal_status_button_text = $reveal_status_text_new;
								$reveal_action_status_text = 'Create reveal';
								$reveal_status_button_class = 'text-warning-style-two';
							}


							if(isset($stylist_call_complete)){


									$reveal_list = $info->reveal()->get();
									if($reveal_list->isNotEmpty()){
										$reveal_has_not_draft = $info->reveal()->where('status', '!=', 'draft')->first();

										if(isset($reveal_has_not_draft)){

										}else{
											//  all reveal in draft
											$reveal_status_button_text = 'draft';
										}
									}

							}else{
								$reveal_status_button_text = 'Not started';
								$reveal_action_status_text = 'Call Upcoming';
								$reveal_status_button_text = $reveal_status_text_new;
								//$reveal_action_btn = '<a  href="'.url('admin/stylist/booking_call_complete/'.$info->id).'" title="Manage" class="custom-manage-reveal-btn">Mark as Call Complete </i><a>';
							}


							$appointment_date = $info->appointment_date;
							$month = '';
							$month_date = '';
							if($appointment_date != ''){
								$appointment_date_arr = explode('-',$appointment_date);
								if(isset($appointment_date_arr[1])){
									$month = $appointment_date_arr[1];
								}
								if(isset($appointment_date_arr[0])){
									$month_date = $appointment_date_arr[0];
								}

								if($month == ''){
									$appointment_date_arr = explode('/',$appointment_date);

									if(isset($appointment_date_arr[1])){
										$month = $appointment_date_arr[1];
									}
									if(isset($appointment_date_arr[0])){
										$month_date = $appointment_date_arr[0];
									}

								}



							}

							$reveal_status_button = ' <td class="c-text-left"><span class="badge badge-pill badge-warning  text-warning-style '.$reveal_status.'_status_btn  '.$reveal_status_button_class.'">'.$reveal_status_button_text.'</span></td>';

							@endphp
														<tr class="stf_outer_body_table_style">
															<td><div class="stf_outer_body_img"><img src="{{ $profile_img_url }}" alt="" style="border-radius:500%"></div></td>
															<td   class="c-text-left"> {{ $name }} </td>
															<td   class="c-text-left"> {{ $company_name }} </td>
															{{-- <td   class="c-text-left"> @php echo $month_date.'/'.$month; @endphp </td> --}}
															<td   class="c-text-left"> @if ($reveal_action_status_text == 'Call Upcoming' )
                                                                {{$month_date.'/'.$month}}
                                                            @endif</td>

														{!! $reveal_status_button !!}

															<td class="c-text-left"></td>

															<td class="c-text-left">
																@php echo $reveal_action_status_text; @endphp


															</td>
															<td>@php echo $reveal_action_btn; @endphp </td>

														</tr>
													@endforeach
												@else

												@endif



					</tbody>
				</table>
				{{ $list->links() }}
				</div> <!-- /.box-body -->
			</div> <!-- /.box -->
		</div>
	</div>

@endsection

@section('page-style')
<style>
#DataTables_Table_0 .c-text-left{text-align:left!important}
#DataTables_Table_0 .c-text-center{text-align:center!important}
</style>
@section('page-script')
@include('admin.stylist_form.common')
 <script>
 jQuery(document).ready(function(){

 });



 function stf_select_stylist_form(obj){
	 console.log(jQuery(obj).val());
 }

 </script>
@endsection
