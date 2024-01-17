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

	<div class="container-fluid stf_outer_body stylist_reveals_section stf_outer_page_load" style="display:none">
	 </div>



@endsection

@section('page-style')

<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.3/css/all.css" />

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />

@endsection

@section('page-script')
@include('admin.stylist_form.common');
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
	


</script>

@endsection
