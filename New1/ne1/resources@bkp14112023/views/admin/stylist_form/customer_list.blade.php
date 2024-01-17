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
		
			<div class="box-body stf_table_hide_serarch_bar">
				<table class="table table-hover" id="stf_data_table_id">

					<tbody>
						<tr class="stf_outer_body_table_style articles">
						<th ><h3>Profile</h3></th>
						<th><h3>Name</h3></th>
						<th class="c-text-center"><h3>View Quetions</h3></th>
						
					</tr>


					@if($list->count() > 0)
						@foreach($list as $customer_id=>$info)

						@php

						$reveal_status = 'not_started';

						$reveals_info = $info->listJoinWithRevealsItems()->first();
						if(isset($reveals_info)){

							$reveal_status = $reveals_info->status;

						}
						$name = '';
						$profile_img_url = url('images/stylist/dummy-profile-pic.png');
						if(isset($user_info_array[$info->customer_id])){
							$profile_img_url = $user_info_array[$info->customer_id]['image_url'];
							$name = $user_info_array[$info->customer_id]['name'];
						}
						
					@endphp
					<tr class="stf_outer_body_table_style">
						<td><div class="stf_outer_body_img"><img src="{{ $profile_img_url }}" alt="" style="border-radius:500%"></div></td>
						<td   class="c-text-left"> {{ $name }} </td>
						<td   class="c-text-left"> <button type="button" class="btn btn-primary " onclick="stfViewCustomerQuestions({{ $info->customer_id }})">View Profile</button> </td>
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

@endsection
