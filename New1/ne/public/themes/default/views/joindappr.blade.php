@extends('theme::layouts.main')

@section('content')
  <!-- Blog COVER IMAGE -->
  {{-- @include('theme::banners.blog_cover') --}}

  <!-- CONTENT SECTION -->
  {{-- @includeWhen(isset($blogs), 'theme::contents.blog_page') --}}
    <p class="Join_dappr" style="font-size: 20px; text-align:center; margin-top:90px;">How To Join Dappr</p>
  @includeWhen(isset($blog), 'theme::contents.blog_single')
@endsection
