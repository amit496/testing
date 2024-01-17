@php
 $stylist_body_class = ' order_complete_place  ';
@endphp


@extends('theme::layouts.main')

@section('content')
  <!-- HEADER SECTION -->
  @include('theme::headers.order_detail')

  <!-- CONTENT SECTION -->
  @include('theme::contents.order_complete')


  {{-- @include('theme::contents.order_complete') --}}
  <!-- BROWSING ITEMS -->
  {{-- @include('theme::sections.recent_views') --}}
@endsection
