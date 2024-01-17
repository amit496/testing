@extends('theme::layouts.main')

@section('content')
  <!-- PAGE COVER IMAGE -->
  @include('theme::banners.page_cover')

  <!-- CONTENT SECTION -->
  <div class="clearfix space20"></div>
  <section>
    <div class="container">
      <div class="row">
        <div class="col-12">
          {!! $page->content !!}
        </div><!-- /.col-12 -->
      </div><!-- /.row -->
    </div><!-- /.container -->
  </section>

  <!-- For contact page only -->
  <input type="hidden" id="customer_last_anwser" value="<?php if(isset($customer_last_anwser) && ($customer_last_anwser != '')){echo $customer_last_anwser;}else{echo '';} ?>">
  @if (\App\Models\Page::PAGE_CONTACT_US == $page->slug)
    @include('theme::contents.contact_us')
  @endif

  <!-- BROWSING ITEMS -->
  {{-- @include('theme::sections.recent_views') --}}
@endsection
