@extends('theme::layouts.main')
@section('content')

<link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="{{ url('css/frotend-stylist-form-common.css?').rand(10,1000) }}" rel="stylesheet">
@php

echo "<pre>";
print_r($categry_question_array);

$name = $cutomer_obj->name;

@endphp
<div class="container-fluid stf_outer_body stylist_step_frontend">
    <div class="row">
        <div class="col-lg-12 m-auto mt-3 p-0 stf_screen_1">
            <section >
            <div class="container-fluid ">
               <div class="row my-md-5 align-items-center">
                  <div class="col-md-6 order-2 order-md-1 pt-3 pt-md-0" >
                    <h1>Welcome {{$name}}</h1>
                     <div class="gett-text-p">
                        <h1>GETTING TO KNOW YOU</h1>
                        <p>A large part of our service is having a detailed understanding of you so we can start building a wardrobe aligned with your personality and style preferences. This questionnaire is a once-off to ensure a comprehensive and personalised service with your stylist. It will take roughly 10min to complete. Upon completion we’ll arrange a time for a quick video chat with your stylist within the next few days.</p>
                     </div>
                  </div>
                  <div class="col-md-6 gett-text-img p-0 order-1 order-md-2">
                     <img src="{{ url('images/stylist/15.png') }}" alt=""  style="width: 100%;">
                  </div>
               </div>
            </div>

            <span class="btn"  onclick="stfShowScreenWrapper('stf_screen_1','stf_screen_2')"> COMPLETE GETING TO KNOW YOU</span>
         </section>
        </div>


        <div class="col-lg-12 m-auto mt-3 p-0 stf_screen_2" style="display:none">
            <ul class="d-md-flex align-items-center female-style-menu text-nowrap overflow-auto py-3">

                <li class="pr-4 stylist_step_progress stylist_step_progress_1">
                <a class="menu-link" href="#">
                <i class="fa fa-solid fa-circle pr-2"></i>
                <span style="font-weight: 600;"> FEMALE FITTING</span>
                </a>
                </li>
                <li class="pr-4 stylist_step_progress stylist_step_progress_2">
                <a class="menu-link" href="#">
                <i class="fal fa-regular fa-circle pr-2"></i>
                <span>BODY SHAPE AND FIT</span>
                </a>
                </li>
                <li class="pr-4 stylist_step_progress stylist_step_progress_3">
                <a class="menu-link" href="#">
                <i class="fal fa-solid fa-circle pr-2"></i>
                <span>CURRENT PERSONAL STYLE</span>
                </a>
                </li>
                <li class="pr-4 stylist_step_progress stylist_step_progress_4">
                <a class="menu-link" href="#">
                <i class="fal fa-solid fa-circle pr-2"></i>
                <span>CLOTHING STYLE AND FIT</span>
                </a>
                </li>
                <li class="pr-4 stylist_step_progress stylist_step_progress_5">
                <a class="menu-link" href="#">
                <i class="fal fa-solid fa-circle pr-2"></i>
                <span>BODY SHAPE & FIT</span>
                </a>
                </li>
                <li class="pr-4 stylist_step_progress stylist_step_progress_6">
                <a class="menu-link" href="#">
                <i class="fal fa-solid fa-circle pr-2"></i>
                <span>COLOUR AND FABRIC</span>
                </a>
                </li>
                <li class="pr-4 stylist_step_progress stylist_step_progress_7">
                <a class="menu-link" href="#">
                <i class="fal fa-solid fa-circle pr-2"></i>
                <span>BUDGET</span>
                </a>
                </li>
            </ul>
            <section class="stylist_step stylist_step_1 " style="display:block;">
                <div class="container-fluid ">
                <div class="row my-md-5 align-items-center">
                    <div class="col-md-6 order-2 order-md-1 pt-3 pt-md-0" >
                        <div class="gett-text-p">
                            
                            <h1>GETTING TO KNOW YOU</h1>
                            <h3>FEMALE FITTING</h3>
                            <p>Let us know what you believe best describes your proportions. Just to give you a heads up Marcia, we’ll be asking for a full length photo in this section. To style you we need to see you!</p>
                        </div>
                    </div>
                    <div class="col-md-6 gett-text-img p-0 order-1 order-md-2">
                        <img src="{{ url('images/stylist/15.png') }}" alt=""  style="width: 100%;">
                    </div>
                </div>
                </div>

                <div class="d-flex py-4 px-5 justify-content-between botom-style-previous">
                    <a href="#"></a>
                    <span class="d-flex">
                        <a href="javascript:void(0)" >01</a>
                        <div class="border-btn-footer px-3">______</div>
                        <a href="javascript:void(0)">07</a>
                    </span>
                    <a href="javascript:void(0)" onclick="stylist_step_show(1,2)">Next</a>
                </div>
             </section>
        </div>

    </div>


</div>
@endsection
@section('scripts')

<script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script  type="text/javascript" src="{{ url('js/stylist-form-frontend-custom.js?').rand(10,1000) }}" ></script>


@endsection
