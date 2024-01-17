{{-- <div class="copyright-area hide-bottom"
  style="display: @php if(isset($show_footer_qa_incomplete_edit_time)) { echo $show_footer_qa_incomplete_edit_time; }  else if(isset($hide_bottom)) { echo $hide_bottom; } else { echo 'none'; } @endphp;">
  --}}
  {{-- <div class="copyright-area hide-bottom"
    style="display: @php if(isset($show_footer_qa_incomplete_edit_time)) { echo $show_footer_qa_incomplete_edit_time; }  else if(isset($hide_bottom)) { echo $hide_bottom; } else { echo 'block'; } @endphp;">
    --}}
    <div class="copyright-area hide-bottom"
      style="display: @php if(isset($show_footer_qa_incomplete_edit_time)) { echo $show_footer_qa_incomplete_edit_time; }  else if(isset($hide_bottom)) { echo $hide_bottom; } else { echo 'block'; } @endphp;">
      <div class="footer" style="background-color: #000000;">



        <div class="container">
          <div class="row">
            <!-- <div class="col-md-8">
        <ul class="links-list">
          @foreach ($pages->where('position', 'copyright_area') as $page)
            <li><a href="{{ get_page_url($page->slug) }}" target="_blank">{{ $page->title }}</a></li>
          @endforeach
          <li><a href="{{ url('admin/dashboard') }}">{{ trans('theme.nav.merchant_dashboard') }}</a></li>
        </ul>
      </div> -->
            <div class="col-md-12">
              <p class="copyright-text text-center">© {{ date('Y') }} <a href="{{ url('/') }}">{{ get_platform_title()
                  }}</a></p>
            </div>
          </div>
        </div>
      </div> <!-- /.copyright-area -->