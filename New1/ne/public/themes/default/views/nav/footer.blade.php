<style>
    *
    {
        text-decoration: none !important;
    }
    .footer__content-box-titles h3 {
        /* font-weight: 600; */
        font-weight:bold;
        letter-spacing: 1px;
        margin-bottom: 15px;
        /* font-size: 18px; */
        font-size:12px;
        line-height: 27px;
        color: #fff;
        /* font-family: Arimo, sans-serif; */
        font-family: 'Open Sans';
    }

    .footer__content-box-link a {
        font-weight:
        text-decoration: none !important;
        color: #fff;
        font-family: 'Open Sans';
        -webkit-transition: all .2s;
        -moz-transition: all .2s;
        -ms-transition: all .2s;
        -o-transition: all .2s;
        transition: all .2s;
        font-style: normal;
        font-weight: 400;
        font-size: 12px;
        line-height: 16px;

    }

    .force_hide_footer
    {
        display: none !important;
    }
</style>
{{-- <footer class="hide-bottom" id='common-footer'
    style="display: @php if(isset($hide_bottom)) { echo $hide_bottom;}else { echo 'none'; } @endphp" ;"> --}}
    <footer class="hide-bottom" id='common-footer'
    style="display: @php  if(isset($hide_bottom)) { echo $hide_bottom; } elseif(isset($show_footer_qa_incomplete_edit_time)) { echo $show_footer_qa_incomplete_edit_time; } else { echo 'block'; } @endphp" ;">

        <div class="footer" style="background-color: #000000;">
            <div class="container">
                <div class="footer__inner">

                    <div class="footer__content" style="padding: 38px 0">
                        <div class="row">
                            <div class="col-lg-6 col-md-4 col-sm-6 col-12">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-logo my-2">
                                            <a href="{{ url('/') }}">
                                                <img src="{{url('images/stylist/header_logo.jpg')}}" class="brand-logo"
                                                    alt="{{ trans('app.logo') }}" title="{{ trans('app.logo') }}"
                                                    style="max-width: 35%; margin-bottom: 10px;">
                                            </a>
                                        </div>

                                        @if (config('system_settings.support_phone'))
                                        <div class="footer__content-box-number">
                                            <a href="tel: {!! config('system_settings.support_phone') !!}"><i
                                                    class="fas fa-phone-alt"></i> {!!
                                                config('system_settings.support_phone') !!}</a>
                                        </div>
                                        @endif

                                        {{-- <div class="footer__content-box-website">
                                            <a href="{{ url('/') }}">{{ config('app.url') }}</a>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-titles">
                                            <h3>{{ trans('theme.nav.dappr') }}</h3>
                                        </div>
                                        <div class="footer__content-box-link">
                                            <ul style="padding-left: 0px">
                                                <li>
                                                    <a href="{{url('/my/account')}}" rel="nofollow">{{
                                                        trans('theme.nav.your_account') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('account', 'orders') }}" rel="nofollow">{{
                                                        trans('theme.nav.your_orders') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{url('stylist/customer/info?q=show_quesiton_answer_edit_screen')}}" oncontextmenu="return false">{{ trans('theme.nav.edit_question') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-titles">
                                            {{-- <h3>{{ trans('theme.nav.make_money') }}</h3> --}}
                                            <h3>Help & Support</h3>
                                        </div>
                                        <div class="footer__content-box-link">
                                            <ul style="padding-left: 0px">
                                                <li>
                                                    {{-- <a href="{{ url('/selling#faqs') }}" rel="nofollow">{{
                                                        trans('theme.nav.faq') }}</a> --}}
                                                    <a href="{{ url('/selling#faqs') }}" rel="nofollow">FAQ's</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/page/delivery-info') }}" rel="nofollow">{{
                                                        trans('theme.nav.delivery') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/page/return-and-refund-policy') }}" rel="nofollow">Returns</a>
                                                    {{-- <a href="{{ url('/page/return-and-refund-policy') }}" rel="nofollow">{{
                                                        trans('theme.nav.return') }}</a> --}}
                                                </li>

                                                <li>
                                                    <a href="{{ url('/page/terms-of-use-customer') }}" rel="nofollow">{{
                                                        trans('theme.nav.term_and_conditions') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/page/privacy-policy') }}" rel="nofollow">{{
                                                        trans('theme.nav.privacy_policy') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-titles">
                                            <h3>{{ trans('theme.nav.follow_us') }}</h3>
                                        </div>
                                        <div class="footer__content-box-link">
                                            <ul style="padding-left: 0px">
                                                <li>
                                                    {{-- <a href="{{ route('account', 'disputes') }}">{{
                                                        trans('theme.social.facebook') }}</a> --}}
                                                    <a href="#">{{trans('theme.social.facebook') }}</a>
                                                </li>
                                                <li>
                                                    {{-- <a href="{{ route('account', 'orders') }}">{{
                                                        trans('theme.social.instagram') }}</a> --}}
                                                        <a href="#">{{trans('theme.social.instagram') }}</a>
                                                </li>
                                                <li>
                                                    {{-- <a href="{{ route('account', 'orders') }}">{{
                                                        trans('theme.social.tik_tok') }}</a> --}}
                                                    <a href="#">{{
                                                        trans('theme.social.tik_tok') }}</a>
                                                </li>
                                                {{-- @foreach ($pages->where('position', 'footer_3rd_column') as $page)
                                                <li>
                                                    <a href="{{ get_page_url($page->slug) }}" rel="nofollow"
                                                        target="_blank">
                                                        {{ $page->title }}
                                                    </a>
                                                </li>
                                                @endforeach --}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div> <!-- /.row -->
                    </div> <!-- /.footer__content -->
                </div> <!-- /.footer__inner -->
            </div> <!-- /.container -->
        </div> <!-- /.footer -->
    </footer>




    {{-- <footer class="d-none">
        <div class="footer">
            <div class="container">
                <div class="footer__inner">
                    <div class="footer__news">
                        <div class="footer__news-inner">
                            <div class="row">
                                <div class="col-lg-6 col-12">
                                    <div class="footer__news-content">
                                        <div class="footer__news-icon">
                                            <img src="{{ theme_asset_url('img/mail.png') }}" alt="">
                                        </div>
                                        <div class="footer__news-text">
                                            <h3>{{ trans('theme.subscription') }}</h3>
                                            <p>{{ trans('theme.help.subscribe_to_newsletter') }}</p>
                                        </div>
                                    </div>
                                </div> <!-- /.col-lg-6 col-12 -->

                                <div class="col-lg-6 col-12">
                                    <div class="footer__news-form">
                                        {!! Form::open(['route' => 'newsletter.subscribe', 'class' => 'form-inline',
                                        'id' => 'form', 'data-toggle' => 'validator']) !!}
                                        <div class="footer__news-form-box">
                                            {!! Form::email('email', null, ['placeholder' =>
                                            trans('theme.placeholder.email'), 'required']) !!}
                                            <button type="submit">{{ trans('theme.button.subscribe') }}</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div> <!-- /.col-lg-6 col-12 -->
                            </div> <!-- /.row -->
                        </div> <!-- /.footer__news-inner -->
                    </div> <!-- /.footer__news -->

                    {<div class="footer__content">
                        <div class="row">
                            <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-logo">
                                            <a href="{{ url('/') }}">
                                                <img src="{{ get_logo_url('platform', 'full') }}" class="brand-logo"
                                                    alt="{{ trans('app.logo') }}" title="{{ trans('app.logo') }}"
                                                    style="max-width: 70%; margin-bottom: 10px;">
                                            </a>
                                        </div>
                                        <div class="footer__content-box-text">
                                            <p>{!! config('system_settings.slogan') !!}</p>
                                        </div>

                                        <div class="footer__content-box-location">
                                            <p><i class="fas fa-map-marker-alt"></i> {!! get_platform_address_string()
                                                !!}</p>
                                        </div>

                                        @if (config('system_settings.support_phone'))
                                        <div class="footer__content-box-number">
                                            <a href="tel: {!! config('system_settings.support_phone') !!}"><i
                                                    class="fas fa-phone-alt"></i> {!!
                                                config('system_settings.support_phone') !!}</a>
                                        </div>
                                        @endif

                                        {{-- <div class="footer__content-box-website">
                                            <a href="{{ url('/') }}">{{ config('app.url') }}</a>
                                        </div> --}}
                                        {{--
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-title">
                                            <h3>{{ trans('theme.nav.let_us_help') }}</h3>
                                        </div>
                                        <div class="footer__content-box-links">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('account', 'dashboard') }}" rel="nofollow">{{
                                                        trans('theme.nav.your_account') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('account', 'orders') }}" rel="nofollow">{{
                                                        trans('theme.nav.your_orders') }}</a>
                                                </li>
                                                @foreach ($pages->where('position', 'footer_1st_column') as $page)
                                                <li>
                                                    <a href="{{ get_page_url($page->slug) }}" rel="nofollow"
                                                        target="_blank">
                                                        {{ $page->title }}
                                                    </a>
                                                </li>
                                                @endforeach
                                                <li>
                                                    <a href="{{ route('blog') }}" target="_blank">{{
                                                        trans('theme.nav.blog') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-title">
                                            <h3>{{ trans('theme.nav.make_money') }}</h3>
                                        </div>
                                        <div class="footer__content-box-links">
                                            <ul>
                                                <li>
                                                    <a href="{{ url('/selling') }}">{{ trans('theme.nav.sell_on',
                                                        ['platform' => get_platform_title()]) }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/selling#pricing') }}">{{
                                                        trans('theme.nav.become_merchant') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ url('/selling#howItWorks') }}">{{
                                                        trans('theme.nav.how_it_works') }}</a>
                                                </li>
                                                @foreach ($pages->where('position', 'footer_2nd_column') as $page)
                                                <li>
                                                    <a href="{{ get_page_url($page->slug) }}" rel="nofollow"
                                                        target="_blank">
                                                        {{ $page->title }}
                                                    </a>
                                                </li>
                                                @endforeach
                                                <li>
                                                    <a href="{{ url('/selling#faqs') }}" rel="nofollow">{{
                                                        trans('theme.nav.faq') }}</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-2 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-title">
                                            <h3>{{ trans('theme.nav.customer_service') }}</h3>
                                        </div>
                                        <div class="footer__content-box-links">
                                            <ul>
                                                <li>
                                                    <a href="{{ route('account', 'disputes') }}">{{
                                                        trans('theme.nav.refunds_disputes') }}</a>
                                                </li>
                                                <li>
                                                    <a href="{{ route('account', 'orders') }}">{{
                                                        trans('theme.nav.contact_seller') }}</a>
                                                </li>
                                                @foreach ($pages->where('position', 'footer_3rd_column') as $page)
                                                <li>
                                                    <a href="{{ get_page_url($page->slug) }}" rel="nofollow"
                                                        target="_blank">
                                                        {{ $page->title }}
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3 col-md-4  col-sm-6 col-6">
                                <div class="footer__content-box">
                                    <div class="footer__content-box-inner">
                                        <div class="footer__content-box-title">
                                            <h3>{{ trans('theme.stay_connected') }}</h3>
                                        </div>

                                        @if ($social_media_links = get_social_media_links())
                                        <div class="footer__content-box-social">
                                            <ul>
                                                @foreach ($social_media_links as $social_media => $link)
                                                <li>
                                                    <a href="{{ $link }}" target="_blank">
                                                        <i class="fab fa-{{ $social_media }}"></i>
                                                    </a>
                                                </li>
                                                @endforeach
                                            </ul>

                                            @if ($trust_badge = get_trust_badge_url())
                                            <div class="mt-4 mb-2">
                                                <img src="{{ $trust_badge }}" />
                                            </div>
                                            @endif
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div> <!-- /.row -->
                    </div> <!-- /.footer__content -->
                </div> <!-- /.footer__inner -->
            </div> <!-- /.container -->
        </div> <!-- /.footer -->
    </footer> --}}
    {{-- --}}
    <!-- COPYRIGHT AREA -->
    {{-- @include('theme::nav.copyright') --}}


<style>
    #common-footer li{
        line-height:24px;
    }
    #common-footer .container {
        width: 100%!important;
        padding-right: var(--bs-gutter-x,.75rem);
        padding-left: var(--bs-gutter-x,.75rem);
        margin-right: auto;
        margin-left: auto;
    }

    @media (min-width: 576px){
        #common-footer .container, #common-footer .container-sm {
            max-width: 540px;
        }
    }
    @media (min-width: 768px){
        #common-footer .container, #common-footer .container-md, #common-footer .container-sm {
            max-width: 720px;
        }
    }
    @media (min-width: 992px){
        #common-footer .container, #common-footer .container-lg, #common-footer .container-md, #common-footer .container-sm {
            max-width: 960px;
        }
    }
    @media (min-width: 1200px){
        #common-footer .container, #common-footer .container-lg, #common-footer .container-md, #common-footer .container-sm, #common-footer .container-xl {
            max-width: 1140px;
        }
    }
    @media (min-width: 1400px){
        #common-footer .container, #common-footer .container-lg, #common-footer .container-md, #common-footer .container-sm, #common-footer .container-xl, #common-footer .container-xxl {
            max-width: 1320px;
        }
    }

    #common-footer ul {
        margin-top: 0;
        margin-bottom: 1rem;
    }

    #common-footer .row {
        --bs-gutter-x: 1.5rem;
        --bs-gutter-y: 0;
        display: flex;
        flex-wrap: wrap;
        margin-top: calc(var(--bs-gutter-y) * -1);
        margin-right: calc(var(--bs-gutter-x) * -.5);
        margin-left: calc(var(--bs-gutter-x) * -.5);
    }
</style>
