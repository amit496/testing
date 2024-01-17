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
	<div class="box stf_outer_body stf_outer_page_load stf_side_bar_not_hide stf_manage_products_list  stf_products_list_section stf_product_window_show_class" style="display:none">
		<div class="stf_products_list_section">
			
			{!! $data['product_list_html']; !!}
		</div>
		
	</div>
@endsection
@section('page-style')
<style>
#DataTables_Table_0 .c-text-left{text-align:left!important}
#DataTables_Table_0 .c-text-center{text-align:center!important}
</style>
@section('page-script')
jQuery(document).ready(function(){
	con
	stfGetProductListHtmlAjax();
});
@include('admin.stylist_form.common')

@endsection
