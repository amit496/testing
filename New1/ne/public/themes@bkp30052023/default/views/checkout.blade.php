@php
 $stylist_body_class = ' checkout_page_container hide_header_footer  ';
@endphp

@extends('theme::layouts.main')
<div class="product_check_out">
    @section('content')
    <!-- breadcrumb -->
    @include('theme::headers.checkout_page')

    <!-- CONTENT SECTION -->
    @include('theme::contents.checkout_page')

    <div class="space30"></div>
    @endsection
</div>

@section('scripts')
@include('scripts.checkout')
@include('theme::scripts.dynamic_checkout')
@endsection
