@extends('theme::layouts.main')
@section('content')
<link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="{{ url('css/frotend-stylist-form-common.css?').rand(10,1000) }}" rel="stylesheet">
<style>
    p.pt-3.mb-1.question_name_text span:first-child { padding-right: 12px; }
    p.pt-3.mb-1.question_name_text { align-items: center; }
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<input type="hidden" value="{{$customer_give_question_get_all_ans}}" id="all_text_answer">
<div class="container-fluid stf_outer_body stylist_step_frontend stf_questeions_screen_wrappr" style="margin:-40px 0 0 0; display: @php if(isset($show_question_answer_screen)) { echo $show_question_answer_screen;}else { echo 'none'; } @endphp">
    <input type="hidden" name="appointment_response_id" value="">

    <div class="container-fluid px-0">
        <div class="w-100">
            <section class="stf_start_screen p-2" style="display: @php if(isset($show_quesiton_answer_fisrt_screen) ) { echo $show_quesiton_answer_fisrt_screen;}else { echo 'none'; } @endphp">
                <?php
                    if($customer_give_question_obj)
                    {
                        $start_screen_btn_text = "CONTINUE EDITING";
                        $start_screen_subheading_text = "You haven't quite completed your Getting to Know You questionnaire. Ready to finish and receive your first reveal? Continue editing";
                        $start_screen_subheading_text_2 = '';
                    }
                    else
                    {
                        $start_screen_subheading_text_2 = "<p>This questionnaire is a once-off to ensure a comprehensive and personalised service with your stylist. It will take roughly 10 min to complete.</p><p> At the end of the questionnaire choose the stylist you'd like to work with, and arrange a time with them for a video call.</p>";
                        $start_screen_btn_text = "COMPLETE GETTING TO KNOW YOU";
                        // $start_screen_subheading_text = "We need to get to know you better";
                        $start_screen_subheading_text = "Firstly, we need to get to know you. Let's get you looking DAPPR!";
                    }
                ?>
                <div class="row" >
                    <div class="col-lg-5 card mb-5 border-0 m-auto">
                        <div class="p-md-4">
                            <div class="mb-4 dappr-text-h pt-0">
                                <h3><u>Welcome {!! $login_cutomer_obj->name !!}!</u></h3>
                                {{-- <p>Firstly, we need to get to know you. Let's get you looking DAPPR!</p> --}}
                            </div>
                            {{-- <h3 class="haeading_sub_1">In Progress</h3> --}}
                            <div class="row stylist_field_outer  product_box_wrappr m-auto ">
                                <div class="style-field-checkbox-outer_rename col-md-12 my-2 p-0">
                                    <div class=" merchant_item product_box_outer">
                                        <div class=" product_box  ">
                                            <div class=" my-1">
                                                <p>{!! $start_screen_subheading_text; !!}</p>
                                            </div>
                                            <div class=" mb-3 custom_product_img_box pro_img_has">
                                                <div class="getting_to_know_btn editing_btn">
                                                    <a onclick="stylist_question_start();return false;"  >GETTING TO KNOW YOU</a>
                                                </div>
                                                <div class="">
                                                    <img src="{{ url('images/stylist/15.png?').rand(10,100) }}" alt="" class="getting_to_know_image" style="width: 100%;">
                                                </div>
                                            </div>
                                            <div class=" my-3">
                                                {!!  $start_screen_subheading_text_2; !!}
                                            </div>
                                        </div>
                                        <div class="pt-2 justify-content-between botom-style-previous-rename">
                                            <a onclick="stylist_question_start();return false;" class="btn stf_save_btn d-block  editing_btn">{{ $start_screen_btn_text; }}</a>
                                        </div>
                                    </div>
                                </div>

                                {{-- <div class="pt-3 preview_reveal_info preview_sub_heading_info">
                                    <div class="mb-1 dappr-text-h">
                                        <h3> Previous Reveals</h3>
                                    </div>
                                    <p>Nothing to show here yet</p>
                                </div> --}}

                                <div class="preview_order_info preview_sub_heading_info p-0">
                                    <div class="mb-1 dappr-text-h ">
                                        <h3 style="text-decoration: underline;">Your DAPPR Wardrobe</h3>
                                    </div>
                                    {!! $buy_html; !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- <div class="row my-md-5 align-items-center">
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
                </div> --}}
                {{-- <div class="py-4 px-5 justify-content-between botom-style-previous-rename">
                    <a href="#"></a>
                    <span class="d-flex">
                        <a href="javascript:void(0)" >01</a>
                        <div class="border-btn-footer px-3">______</div>
                        <a href="javascript:void(0)">07</a>
                    </span>
                    <a href="javascript:void(0)" class="btn stf_save_btn d-none" onclick="stylist_question_start()">START</a>
                </div> --}}
            </section>

            <section class="stylist_qeustions_list" style="display: @php if(isset($show_quesiton_answer_edit_screen)) { echo $show_quesiton_answer_edit_screen;}else { echo 'none'; } @endphp";">
                <div class="stf_questions_top_pagination" style_rename="display: none;">
                    <ul class="position-relative d-md-flex_rename align-items-center female-style-menu text-nowrap overflow-auto py-3 mt-3  "  style_rename="display: none;">
                        <div class="progress progress-custom">
                            <div class="progress-bar" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width:0%"></div>
                        </div>
                        @php
                            $already_take_questions_section_heading_arr = array();
                            if($questions)
                            {
                                foreach($questions as $key => $question)
                                {
                                    if($question->customerQuestions->isNotEmpty())
                                    {
                                        if(!in_array((int)$question->section_heading, $already_take_questions_section_heading_arr))
                                        {
                                            $already_take_questions_section_heading_arr[] = (int)$question->section_heading;
                                        }
                                    }
                                }
                            }
                        @endphp
                        <li class="pr-4 stylist_step_progress stylist_step_progress_1 stylist_step_progress_active stylist_step_progress_active_tab  @php if(in_array(0, $already_take_questions_section_heading_arr)){ echo ' stylist_step_progress_active_already '; } @endphp " q_section="0" progress_bar_width = '0' >
                            <div class="menu-link stf_anchor_btn">
                                <i class="fal  fa-circle pr-2 " ></i>
                                <span > APPEARANCE </span>
                            </div>
                        </li>
                        <li class="pr-4 stylist_step_progress stylist_step_progress_2  @php if(in_array(1, $already_take_questions_section_heading_arr)){ echo ' stylist_step_progress_active_already '; } @endphp " q_section="1" progress_bar_width = '17' >
                            <div class="menu-link stf_anchor_btn">
                                <i class="fal fa-circle pr-2"></i>
                                <span>BODY SHAPE AND FIT</span>
                            </div>
                        </li>
                        <li class="pr-4 stylist_step_progress stylist_step_progress_3  @php if(in_array(2, $already_take_questions_section_heading_arr)){ echo ' stylist_step_progress_active_already '; } @endphp " q_section="2" progress_bar_width = '37' >
                            <div class="menu-link stf_anchor_btn">
                                <i class="fal fa-circle pr-2"></i>
                                <span>PERSONAL STYLE</span>
                            </div>
                        </li>
                        <li class="pr-4 stylist_step_progress stylist_step_progress_4  @php if(in_array(3, $already_take_questions_section_heading_arr)){ echo ' stylist_step_progress_active_already '; } @endphp "  q_section="3" progress_bar_width = '58' >
                            <div class="menu-link stf_anchor_btn" >
                               <i class="fal fa-circle pr-2"></i>
                                <span>CLOTHING STYLE AND FIT</span>
                            </div>
                        </li>
                        <li class="pr-4 stylist_step_progress stylist_step_progress_6  @php if(in_array(4, $already_take_questions_section_heading_arr)){ echo ' stylist_step_progress_active_already '; } @endphp " q_section="4" progress_bar_width = '83' >
                            <div class="menu-link stf_anchor_btn">
                                <i class="fal fa-circle pr-2"></i>
                                <span>COLOUR AND FABRIC</span>
                            </div>
                        </li>
                        <li class="pr-4 stylist_step_progress stylist_step_progress_7  @php if(in_array(5, $already_take_questions_section_heading_arr) || in_array(6, $already_take_questions_section_heading_arr)){ echo ' stylist_step_progress_active_already '; } @endphp " q_section="5"  progress_bar_width = '100'>
                            <div class="menu-link stf_anchor_btn">
                                <i class="fal fa-circle pr-2"></i>
                                <span>BUDGET</span>
                            </div>
                        </li>
                    </ul>
                </div>

                <form action="/storeAnswers" method="post">
                    @csrf
                    @method('POST')
                    {{-- <input type="hidden" value="{{$customer_give_question_obj_get_all_ans}}" id="all_text_answer" > --}}
                    @php
                    $question_no = 1;
                    $html  = '';
                    $questions_in_one_screen_ids = array(2,3);
                    $questions_bottom_not_show = array(1,2);
                    $categoryies_ids_depend_ids = array(3,4);
                    $show_booking_scrren_cat_ids = array(3,4);
                    $question_count_var2 = 0;
                    $question_count_var3 = 0;
                    $question_total_var2 = 0;
                    $sections_screen_arr =  array();
                    $sections_screen_arr[0] = array('title' => 'Getting to know you', 'title_1' => 'Female Fitting', 'title_2' => 'Let\'s get started '. $login_cutomer_obj->name, 'description' => 'A large part of our service is having a detailed understanding of you so we can start building a wardrobe aligned with your personality and style preferences.<br><br>This questionnaire is a once-off to ensure a comprehensive and personalised service with your stylist. It will take roughly 10min to complete.<br><br> Upon completion we\'ll arrange a time for a quick video chat with your stylist within the next few days.','womens_screen_image' => '', 'img_desktop' => 'images/stylist/questions/section/1_appearance.webp', 'img_mobile' => 'images/stylist/questions/section/1_appearance.webp','section_id' => 0,'progress_bar_start' => 0,'progress_bar_end' => 17, 'button_text'=>'Start');
                    $sections_screen_arr[1] = array('title' => 'Sizing & BodyShape', 'title_1' => 'We wouldn\'t be stylists if we didn\'t ask there questions '.$login_cutomer_obj->name.'!', 'title_2' => '', 'description' => 'Let us know what you believe best describes your proportions.<br><br>Just to give you a heads up '."$login_cutomer_obj->name" .',  we\'ll be asking for a full-length photo in this section.<br><br>To style you, we need to see you!', 'womens_screen_image' => 'images/stylist/questions/section/women_body_shape_and_fit_section_image.webp','img_desktop' => 'images/stylist/questions/section/1_body_shape_and_fit.webp', 'img_mobile' => 'images/stylist/questions/section/1_body_shape_and_fit.webp','section_id' => 1,'progress_bar_start' => 17,'progress_bar_end' => 37, 'button_text'=>'SAVE & CONTINUE LATER');
                    $sections_screen_arr[2] = array('title' => 'Personal Style', 'title_1' => 'Let us know a bit more about your current style',  'title_2' => '', 'description' => $login_cutomer_obj->name.', tell us a bit about your current personal style. What you like, what you dislike, or specific advice you\'d like on how we can develop your personal image.','img_desktop' => 'images/stylist/questions/section/1_personal_style.webp','womens_screen_image' => 'images/stylist/questions/section/Dappr_animal.jpg' , 'img_mobile' => 'images/stylist/questions/section/1_personal_style.webp','section_id' => 2,'progress_bar_start' => 37,'progress_bar_end' => 59, 'button_text'=>'SAVE & CONTINUE LATER');
                    $sections_screen_arr[3] = array('title' => 'Preferred Styles', 'title_1' => ' ', 'title_2' => '' , 'description' => 'As you know, there are countless styles in each category of clothing. We want to know what you typically choose.',  'img_desktop' => 'images/stylist/questions/section/1_clothing_style_and_fit.webp', 'womens_screen_image' => 'images/stylist/questions/section/women_clothing_style_and_fit_section_image.webp' ,'img_mobile' => 'images/stylist/questions/section/1_clothing_style_and_fit.webp','section_id' => 3,'progress_bar_start' => 59,'progress_bar_end' => 84, 'button_text'=>'SAVE & CONTINUE LATER');
                    $sections_screen_arr[4] = array('title' => 'COLOUR & FABRIC ', 'title_1' => '', 'title_2' => '', 'description' => 'Are you adverse to any colour or patterns? We\'ll make sure we don\'t add them!','womens_screen_image' => 'images/stylist/questions/section/women_colour_and_fabric_section_image.webp' ,'img_desktop' => 'images/stylist/questions/section/1_colour_and_fabric.webp', 'img_mobile' => 'images/stylist/questions/section/1_colour_and_fabric.webp','section_id' => 4,'progress_bar_start' => 84,'progress_bar_end' => 100, 'button_text'=>'SAVE & CONTINUE LATER');
                    $sections_screen_arr[5] = array('title' => 'BUDGET', 'title_1' => '', 'title_2' => '', 'description' => 'Let\'s talk about how much you\'d like to spend on your items so we can work out a budget per DAPPR delivery to stick too.','womens_screen_image' => 'images/stylist/questions/section/women_bught_sction_image.webp' ,'img_desktop' => 'images/stylist/questions/section/1_budget.webp', 'img_mobile' => 'images/stylist/questions/section/1_budget.webp','section_id' => 5,'progress_bar_start' => 100,'progress_bar_end' => 100,'button_text'=>'SAVE & CONTINUE LATER');
                    $hide_questons_on_the_base_of_pre_ans = array();
                    if($questions)
                    {
                        $section_heading_ids = array();
                        $total_question_no = count($questions);
                        foreach($questions as $key => $question)
                        {
                            $section_heading_id = (int)$question->section_heading;
                            if($section_heading_id == 6)
                            {
                                $section_heading_id = 5;
                            }
                            if(!in_array($section_heading_id, $section_heading_ids))
                            {
                                $section_heading_ids[$section_heading_id] = $section_heading_id;
                                if(isset($sections_screen_arr[$section_heading_id]))
                                {
                                    $section_info = $sections_screen_arr[$section_heading_id];
                                    $progress_bar_start = $section_info['progress_bar_start'];
                                    $progress_bar_end = $section_info['progress_bar_end'];
                                    $button_text = $section_info['button_text'];
                                    $q_skip_id_rand_no = $section_heading_id.'_'.date('dmy_his').'_'.rand(10,100);
                                    $screen_category_base_class = '';
                                    if(isset($hide_questons_on_the_base_of_pre_ans['category']))
                                    {
                                        if($hide_questons_on_the_base_of_pre_ans['category'] == 4)
                                        {
                                            $screen_category_base_class = ' stylist_wom_category_questions_selected ';
                                        }
                                        else if($hide_questons_on_the_base_of_pre_ans['category'] == 3)
                                        {
                                            $screen_category_base_class = ' stylist_men_category_questions_selected ';
                                        }
                                        else if($hide_questons_on_the_base_of_pre_ans['category'] == 5)
                                        {
                                            $screen_category_base_class = ' stylist_com_category_questions_selected ';
                                        }
                                    }
                                    $html  .= ' <section class="q_section_screen q_section_screen_step_'.$section_heading_id.'  q_stylist_step stylist_step stylist_step_nn_'.$question_no.' '.$screen_category_base_class.' " question_no="" category_id=""  is_question_belong="" prev_question_no="0" skip_id="'.$q_skip_id_rand_no.'" q_type=""  section_heading_id="'.$section_heading_id.'"  multiple_answer_limit="" progress_bar_start="'.$progress_bar_start.'" progress_bar_end="'.$progress_bar_end.'">';
                                    $has_womens_screen_image_class = '';
                                    $womens_screen_image = '';
                                    if($section_info['womens_screen_image'])
                                    {
                                        $womens_screen_image = ' <img class="Dappr_femenine-imgs womens_screen_image" src="'.url( $section_info['womens_screen_image']).'?'.rand(10,100).'" alt=""  width: 100%;>';
                                        $has_womens_screen_image_class = ' has_womens_screen_image_class ';
                                    }
                                    $html  .= ' <div class="container-flude question_section_screen" section_id="'.$section_info['section_id'].'">
                                                    <div class="">
                                                        <div class="row">
                                                            <div class="col-md-6 order-md-1 order-2 p-0">
                                                                <div class="row">
                                                                    <div class="col-lg-12">
                                                                        <div class="style-field-checkbox-outer_rename my-2 pad-mar-merchant">
                                                                            <div class=" merchant_item product_box_outer">
                                                                                <div class=" product_box">
                                                                                    <div class=" my-3">
                                                                                        <p class="text-uppercase" style="font-weight: 600;">'.$section_info['title'].'</p>
                                                                                        <p>'.$section_info['title_2'].'</p>
                                                                                    </div>
                                                                                    <div class=" my-3 first_question_screen">'.$section_info['description'].'</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6  order-md-2 order-1 pr-0  p-0">
                                                                <div class="custom_product_img_box pro_img_has '.$has_womens_screen_image_class.'">
                                                                    <div class="Dappr_femenine-img-costom">
                                                                        <div class="Dappr_femenine-costom-img " >
                                                                            <img class="Dappr_femenine-imgs Dappr_femenine-imgs-common" src="'.url( $section_info['img_desktop']).'?'.rand(10,100).'" alt=""  width: 100%;>
                                                                           '.$womens_screen_image .'
                                                                            <img class="Dappr_femenine1-imgs Dappr_femenine-imgs-common"   src="'.url( $section_info['img_mobile']).'?'.rand(10,100).'" alt=""  width: 100%;>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row stylist_field_outer  product_box_wrappr m-auto"></div>
                                                        </div>
                                                        <div class="next_footer_btn"></div>
                                                    </div>
                                                </div>
                                                <div class=" py-4 px-4 botom-style-previous">
                                                    <div class="d-flex justify-content-between px-3"><a href_renam="javascript:void(0)" onclick="stylist_step_prev_show(this,\''.$section_info['section_id'].'\');return false;" class="stf_anchor_btn stf_anchor_btn_q_pre">';
                                                        if($section_heading_id)
                                                        {
                                                            $html  .= 'Previous';
                                                        }
                                                        if($key == 0)
                                                        {
                                                            $html  .= '</a>
                                                                        <a href_rename="javascript:void(0)" onclick="stylist_step_show(this,\'\');return false;" class="stf_anchor_btn  question_save_btn">Next</a>
                                                    </div>
                                                    <button onclick="stylist_step_show(this,\'\');return false;" class=" mt-3 btn stf_save_btn d-block w-100 ">'.$button_text.'</button>
                                                </div> ';
                                                        }
                                                        else
                                                        {
                                                            $html  .= '</a>
                                                                        <a href_rename="javascript:void(0)" onclick="stylist_step_show(this,\'\');return false;" class="stf_anchor_btn  question_save_btn">Next</a>
                                                    </div>
                                                    <button onclick="stylist_save_and_continue_later_skip_new(this,\'\');return false;" class=" mt-3 btn stf_save_btn d-block w-100 ">'.$button_text.'</button>
                                                </div> ';
                                                        }

                                                //  if('BODY SHAPE AND FIT')
                                    $html  .= '</section>';
                                }
                            }
                            $alredy_naswer_text = '';
                            $alredy_naswer_ids = '';
                            $alredy_naswer_ids_arr = '';
                            $alredy_selected_class_img = '';
                            $has_logn_text_ans_text = '';
                            $question_already_attempt_class = '';
                            if($question->customerQuestions->isNotEmpty())
                            {
                                $question_already_attempt_class = ' question_already_attempt_class ';
                                $customer_answer = $question->customerQuestions->first();
                                $alredy_naswer_ids = $customer_answer->answer_ids;
                                if(in_array($customer_answer->type,array('text','textarea','file')))
                                {
                                    $alredy_naswer_text = $customer_answer->answer_ids;
                                }else if($customer_answer->type == 'checkbox' || $customer_answer->type == 'radio')
                                {
                                    $alredy_naswer_ids_arr = explode(',',$alredy_naswer_ids);
                                    $has_logn_text_ans_text = $customer_answer->text_ans;
                                }
                                if($question->skip_id == 'men_women_combine_q')
                                {
                                    foreach($question->answers as $answer_key => $answer)
                                    {
                                        if($answer->id == $alredy_naswer_ids)
                                        {
                                            if($answer->value == 'wom')
                                            {
                                                $hide_questons_on_the_base_of_pre_ans['category'] = 4;
                                            }
                                            else if($answer->value == 'men' )
                                            {
                                                $hide_questons_on_the_base_of_pre_ans['category'] = 3;
                                            }
                                            else if($answer->value == 'com')
                                            {
                                                $hide_questons_on_the_base_of_pre_ans['budget'] = 4;
                                            }
                                        }
                                    }
                                 }
                            }
                            $question_id = $question->id;
                            // echo $question_id;
                            $next_quesiton_add = true;
                            $prev_quetions_no = $question_no - 1;
                            $next_quetions_no = $question_no+1;
                            $not_show_question_one_screen = true;
                            $outer_common_class = '';
                            if(in_array($question_id,$questions_in_one_screen_ids))
                            {
                                $not_show_question_one_screen = false;
                                $next_quesiton_add = false;
                            }
                            if($not_show_question_one_screen)
                            {
                                $category_id = 0;
                                $category_class = '';
                                $category_belong_on_class = '';
                                if($question->category)
                                {
                                    $category_id = $question->category->id;
                                    if(in_array($category_id,$categoryies_ids_depend_ids))
                                    {
                                        $category_belong_on_class = ' stf_is_depend_on_answer ';
                                    }
                                }
                                $category_class = 'category_belong_id_'.$category_id;
                                $question_depend_on_ans_class = '';
                                if($question->depend_on_ans == 'Y')
                                {
                                    $question_depend_on_ans_class = ' question_depend_on_ans ';
                                }
                                if(in_array($category_id,$show_booking_scrren_cat_ids))
                                {
                                    // $outer_common_class = $outer_common_class.' show_booking_screen ';
                                }
                                $is_question_belong = 'N';
                                if($question->anwer_type == 'belog')
                                {
                                    $is_question_belong = 'Y';
                                }
                                $q_skip_id = $question->skip_id;
                                if($q_skip_id == '')
                                {
                                    $q_skip_id = $question->id.'_'.date('dmy_his').'_'.rand(10,100);
                                }
                                $q_type = $question->q_type;
                                $fix_rand_id = $question->fix_rand_id;
                                $fix_rand_id = $fix_rand_id.'_class';
                                $multiple_answer_limit = 0;
                                if($question->multiple_select == 'Y')
                                {
                                    $multiple_answer_limit = $question->multiple_answer_limit;
                                }
                                if(in_array($category_id,$hide_questons_on_the_base_of_pre_ans))
                                {
                                    $hide_question_key = array_search ($category_id, $hide_questons_on_the_base_of_pre_ans);
                                    if($hide_question_key == 'category')
                                    {
                                        $category_class .= ' stylist_do_not_show_this_questions ';
                                    }
                                    else if($hide_question_key == 'budget' &&  ($section_heading_id == 5 ))
                                    {
                                        $category_class .= ' stylist_do_not_show_this_questions ';
                                    }
                                }
                                $html  .= ' <section class="q_stylist_step stylist_step stylist_step_'.$question_no.' '.$category_class.' '.$question_already_attempt_class.' '.$category_belong_on_class.$question_depend_on_ans_class.' '.$outer_common_class.' '.$fix_rand_id.'" question_no="'.$question_no.'" category_id="'.$category_id.'"  is_question_belong="'.$is_question_belong.'" prev_question_no="0" skip_id="'.$q_skip_id.'" q_type="'.$q_type.'"  section_heading_id="'.$section_heading_id.'"  multiple_answer_limit="'.$multiple_answer_limit.'">';
                                $html  .= ' <div class="container ">';
                                $html  .= ' <div class="row my-md-5 align-items-center">';
                                $html  .= '  <div class="col-md-10 m-auto">';
                                $html  .= '   <div class="gett-text-ptw" style="/*max-height: 100vh*/;    overflow-y: auto;">';
                                $html  .= '<h1 class="category_name" style="display:none">'.$question->category->name.'</h1>';
                                if($question->sectionHeading)
                                {
                                    if($question->fix_rand_id == '140' || $question->fix_rand_id == 'fix_rand_id_144')
                                    {
                                        $html  .= '<h1>BUDGET</h1>';
                                    }
                                    elseif($question->fix_rand_id == '145' || $question->fix_rand_id == 'fix_rand_id_153')
                                    {
                                        $html  .= '<h1>FINAL THOUGHTS</h1>';
                                    }
                                    elseif($question->fix_rand_id == '149' || $question->fix_rand_id == 'fix_rand_id_157')
                                    {
                                        $html  .= '<h1>FINAL THOUGHTS</h1>';
                                    }
                                    else
                                    {
                                        $html  .= '<h1>'.$question->sectionHeading->name.'</h1>';
                                    }
                                }
                                else if($question->category)
                                {
                                    $html  .= '<h1>'.$question->category->name.'</h1>';
                                }
                            }

                            $question_inline_error = '';
                            $question_required_class = '';
                            $question_required_label_html = '';
                            $question_required_icon = '';
                            $question_error_hide = '';
                            if($question->description != '')
                            {
                                $question_error_hide = 'style=display:none';
                            }
                            if($question->required == 'Y' )
                            {
                                $question_required_class = 'stylist_field_required';
                                $question_required_label_html = ' <p class="py-2 gett-text-pque stylist_field_error">THIS QUESTION IS REQUIRED.*</p>';
                                // $question_required_label_html = '';
                                $question_required_icon = '<span class="py-2 gett-text-pque ">*</span>';
                                $question_inline_error = '<span class="py-2 gett-text-pque stylist_field_error2" '.$question_error_hide.'>THIS QUESTION IS REQUIRED. *</span>';
                                $question_inline_error_des = '<span class="py-2 gett-text-pque stylist_field_error3">THIS QUESTION IS REQUIRED. *</span>';
                            }
                            if($question->q_type == 'budget_calculate_price_update')
                            {
                                $question->name = str_replace('$---',  $bg_price, $question->name);
                                // $html = $replace;
                            }
                            // echo $stylist_user_data->budget_price;
                            if($question->name)
                            {
                                // $html  .= '<p class="pt-3 mb-1 question_name_text"> '.$question->name.$question_required_icon. ' </p>';
                                $html  .= '<p class="pt-3 mb-1 question_name_text">'.$question->name.$question_required_icon.''.$question_inline_error.' </p>';
                            }
                            if($question->description != '')
                            {
                                $html  .= '<p class="m-0 q_description question_description ">'.$question->description.'<br>'.$question_inline_error_des.'</p>';
                            }
                            if($question->multiple_answer_limit == '2' )
                            {
                                $html  .= '<p class=" m-0 q_description question_description">If you regularly find you are a mix of two sizes, please select both</p>';
                            }
                            $answer_html  = '';
                            $answer_id = 0;
                            $q_has_logn_text_ans = 'N';
                            if($question->type == 'text')
                            {
                                $html  .= '<div class="stylist_field_outer">';
                                $answer_html .= '<input placeholder="Type your answer here" type="text" class="stylist_field stylist_field_text '.$question_required_class.'" name="question['.$question_id.']" answer_id="'.$answer_id.'" question_id="'.$question_id.'" value="'.$alredy_naswer_text.'" />';
                            }
                            else if($question->type == 'longtext')
                            {
                                $html  .= '<div class="stylist_field_outer">';
                                $answer_html .= '<textarea placeholder="Type your answer here" style="width: 100%;"  class="stylist_field stylist_field_text custom-stylist_field '.$question_required_class.'  answer_type_textarea" name="question['.$question_id.']"  answer_id="'.$answer_id.'" question_id="'.$question_id.'" />'.$alredy_naswer_text.'</textarea>';
                            }
                            else if($question->anwer_type == 'upload')
                            {
                                $html  .= '<div class="stylist_field_outer  stylsit_file_upload_field">';
                                $answer_html .= '<input placeholder="Type your answer here" type="file" class="stylist_field stylist_field_text '.$question_required_class.'" name="question['.$question_id.']" answer_id="'.$answer_id.'"
                                question_id="'.$question_id.'" / value="" onchange="stfUploadfileShow(this)" >';
                                $question_required_label_html = ' <p class="py-2 gett-text-pque stylist_field_error_image"></p>';
                                $alredy_naswer_img = '';
                                $alredy_naswer_img_display = 'none';
                                $answer_img = '';
                                if($alredy_naswer_text != '')
                                {
                                    $alredy_naswer_img = url('uploads/'.$alredy_naswer_text.'?').rand(10,100);
                                    $alredy_naswer_img_display = 'block';
                                    $answer_img = $alredy_naswer_text;
                                }
                                $answer_html .= '<input type="hidden" name="file_image">';
                                $answer_html .= '<div class="stylsit_file_upload_field_img_preview" style="display:'.$alredy_naswer_img_display.'"><img src="'. $alredy_naswer_img.'"></div>';
                            }
                            else if($question->answers)
                            {
                                $answers_label_hide_class = '';
                  if($question->hide_answer_label == 'Y'){

                     $answers_label_hide_class = ' answers_label_hide ';
                  }
                     // $answer_html .= $question_required_label_html;
                   $html  .= '<div class="mt-5 row stylist_field_outer stylist_field_required_one product_box_wrappr m-auto '.$answers_label_hide_class.'" >';



                   $random_ans_list = [];
                     if(($question->fix_rand_id == 'fix_rand_id_66') || ($question->fix_rand_id == 'fix_rand_id_58')){
                         foreach($question->answers as $answer_key => $answer){
                           $random_ans_list[] = $answer;
                       }

                    }



                  foreach($question->answers as $answer_key => $answer){

                      if(($question->fix_rand_id == 'fix_rand_id_66') || ($question->fix_rand_id == 'fix_rand_id_58')){

                        shuffle($random_ans_list);
                        if(count($random_ans_list)){
                           $answer = $random_ans_list[0];
                           unset($random_ans_list[0]);
                           $random_ans_list = array_values($random_ans_list);
                        }

                      }

                     $alredy_selected_class_img = '';
                     $alredy_selected_class_box = '';
                     $alredy_selected_checked = '';

                     $answer_value = $answer->value;
                     $answer_id = $answer->id;
                     $has_logn_text_ans_class = '';
                     $has_logn_text_ans = $answer->has_logn_text_ans;
                     $auto_skip_class = $answer->skip_automatic_class;

                     $has_logn_text_ans_display = 'none';
                     if($has_logn_text_ans == 'Y' ){
                        $has_logn_text_ans_class = ' has_logn_text_ans_y ';
                     }

                     if($q_has_logn_text_ans != 'Y' ){
                        $q_has_logn_text_ans = $answer->has_logn_text_ans;
                     }
                     $answer_skip_question_id = $answer->skip_question_id;
                     $depend_cat_id = $answer->depend_cat_id;
                     $answer_belong_to = $answer->belong_to;

                     $box_select_class = ' style-field-checkbox-outer-box ';

                     if($question->anwer_type == 'img'){
                        $box_select_class = ' ';
                     }

                     if(is_array($alredy_naswer_ids_arr) && in_array($answer->id,$alredy_naswer_ids_arr)){

                        if($question->anwer_type == 'img'){
                           $alredy_selected_class_img = ' active ';
                        }else{
                            $alredy_selected_class_box = ' box_selected ';
                        }
                        $alredy_selected_checked = 'checked="checked"';

                        if($has_logn_text_ans == 'Y' ){
                           $has_logn_text_ans_display = 'block';

                        }

                     }


                     $answer_skip_question_id_class = '';

                     if(!empty($answer_skip_question_id)){
                        $answer_skip_question_id_class = ' answer_skip_question_enable ';
                     }



                     $answer_html .= '<div class="style-field-checkbox-outer col-md-3 '. $box_select_class.$has_logn_text_ans_class.' " depend_cat_id="'.$depend_cat_id.'" answer_belong_to = "'.$answer_belong_to.'" answer_skip_question_id="'.$answer_skip_question_id.'">';


                     $type = 'radio';
                     $ans_class = ' product_box ';
                     $ans_box_class = ' product_box_single_select ';

                     if($question->multiple_select == 'Y'){
                        $type = 'checkbox';
                        $ans_class = ' product_box-overlay ';
                        $ans_box_class = ' product_box_multi_select ' .$auto_skip_class ;
                     }
                     $answer_html .= '<div class="product_box_outer '.$ans_class.$alredy_selected_class_box.' ">';
                     $answer_img_html = '';
                     if($question->anwer_type == 'img'){

                        $img_url  = url('').'/images/stylist/questions/no-image.jpg?'.rand(10,100);
                        if($answer->image_name != ''){
                           $img_url  = url('').'/images/stylist/questions/'.$answer->image_name.'?'.rand(10,100);
                        }

                        $answer_img_html = '<img src="'.$img_url.'"  width="inherit" height="inherit">';
                        $ans_box_class .=  ' product_img_box pro_img_has ';

                     }else{
                        $ans_box_class .=  ' product_select_box ';
                     }


                     $answer_html .= '<div class=" '.$ans_box_class.' '. $alredy_selected_class_img.' ">';
                     $answer_html .= $answer_img_html;

                     $answer_html .= '</div>';
                     if($question->anwer_type != 'img'){
                        $answer_html .= '<h6 class="text-center mt-2 '.$ans_box_class.' ">'.($answer->name).'</h6>';
                     }else{
                        $answer_html .= '<h6 class="text-center mt-2">'.($answer->name).'</h6>';
                     }

                     if($question->multiple_select == 'Y'){
                        $answer_html .= '<input type="'.$type.'" class="stylist_field style-field-hide style-options-checkbox '.$question_required_class.' '.$answer_skip_question_id_class.'"  name="question['.$question_id.']['.$answer->id.']" value="'.$answer->id.'" answer_id="'.$answer_id.'" answer_value="'.$answer_value.'"
                   question_id="'.$question_id.'" '.$alredy_selected_checked.' >';
                     }else{
                         $answer_html .= '<input type="'.$type.'" class="stylist_field style-field-hide style-options-checkbox '.$question_required_class.'"  name="question['.$question_id.']" value="'.$answer->id.'" answer_id="'.$answer_id.'"
                   question_id="'.$question_id.'" answer_value="'.$answer_value.'" '.$alredy_selected_checked.'  >';
                     }

                     $answer_html .= '</div>';


                     $answer_html .= '</div>';
                  }
               }
               if($q_has_logn_text_ans == 'Y'){
                   $answer_html .= '<div class="other_long_text_wrapper" style="display:'.$has_logn_text_ans_display.'"><textarea class="other_long_text">'.trim($has_logn_text_ans_text).'</textarea></div>';
               }
               $answer_html .= $question_required_label_html;
               $html  .= $answer_html;
               $html  .= "</div>";
                $not_show_question_one_screen = true;
               if(in_array($question_id,$questions_bottom_not_show)){
                $not_show_question_one_screen = false;
                //$next_quesiton_add = false;

               }
               if($not_show_question_one_screen){



                  if(in_array($question->question_catogary,$show_booking_scrren_cat_ids)){


                     if(isset($questions_obj_cat_arr[$question->question_catogary])){
                        $question_total_var2 = count($questions_obj_cat_arr[$question->question_catogary]);

                        $question_total_var2 = $question_total_var2 + $question_count_var2;

                        $question_count_var3 = $question_count_var2+1;
                        unset($questions_obj_cat_arr[$question->question_catogary]);

                     }else{

                        $question_count_var3 = $question_count_var3+1;
                     }

                  }else{
                     $question_count_var2 = $question_no;
                  }



                  $html  .= "</div>";
                  $html  .= "</div>";
                  $html  .= "</div>";
                  $html  .= "</div>";
                   $html  .= "<div class=' py-4 px-4 botom-style-previous'>";
                  $html  .= "<div class='d-flex justify-content-between px-3'>";
                  $html  .= '<a href_renam="javascript:void(0)" onclick="stylist_step_prev_show(this,'.$question_no.');return false;" class="stf_anchor_btn stf_anchor_btn_q_pre" >Previous</a>';
                     $html  .= '<span class="d-flex_1" style="display:none">';


                    $html  .= '<div class="cat_base_pagination " style="display:none">';
                      $html  .= '<div class="d-flex">';
                    $html  .= '<a href_rename="javascript:void(0)" onclick="return false;" class="stf_anchor_btn">'.$question_count_var3.'</a>';
                   $html  .= '<div class="border-btn-footer px-3">______</div>';
                   $html  .= '<a href_rename="javascript:void(0)" onclick="return false;" class="stf_anchor_btn">'.$question_total_var2.'</a>';
                    $html  .= '</div>' ;

                    $html  .= '</div>' ;

                  $html  .= '<div class="without_cat_base_pagination">';
                  $html  .= '<div class="d-flex_1"  style="display:none">';

                  if(in_array($question_id,$questions_in_one_screen_ids)){
                      $html  .= '<a href_rename="javascript:void(0)" onclick="return false;" class="stf_anchor_btn">1</a>';
                  }else{
                      $html  .= '<a href_rename="javascript:void(0)" onclick="return false;" class="stf_anchor_btn">'.$question_no.'</a>';

                     }



                  $html  .= '<div class="border-btn-footer px-3">______</div>';
                  $html  .= '<a href_rename="javascript:void(0)" onclick="return false;" class="stf_anchor_btn">'.$total_question_no.'sdfjsdjfkldsfjlksdfj</a>';
                 $html  .= '</div>' ;
                  $html  .= '</div>' ;

                  $html  .= '</span>';

                  $html  .= '<a href_rename="javascript:void(0)" onclick="stylist_step_show(this,'.$next_quetions_no.');return false;" class="stf_anchor_btn  question_save_btn">Next</a>';
                  $html  .= '</div>';
                  $html  .= '<button type="button" class=" mt-3 btn stf_save_btn d-block w-100  save_continue_btn" onclick="stylist_step_show(this,'.$next_quetions_no.',\'no\')">SAVE & CONTINUE LATER</button>';
                  $html  .= '</div>';
                  $html  .= ' </section>';
               }
               if($next_quesiton_add){
                   $question_no++;
               }

            }

         }
         echo $html;

         @endphp





         </form>
      </section>
      </div><!-- stylist_qeustions_list closed -->



   </div>
</div>



<!-- stylist booking screen stat -->
<div class="stf_stylist_booking_screen" style="display:@php if(isset($show_booknig_screen)) {echo $show_booknig_screen;}else { echo 'none'; } @endphp ">
   @php
      $class_list = ' ';
      $class_form = ' ';
      if($errors->any()){
         $class_list = ' hide_marchant_list_section';
         $class_form = ' show_merchant_booking_section';
      }
   @endphp
   <section class="marchant_list_section  section_class {{ $class_list }}">
   <div class="container">
     <div class="mb-5">
     <div class="container p-md-4">

         <div class="pb-3 row dappr-text-h m-auto pt-0">
            <div class="col-lg-7 m-auto">
            <h3>Booking</h3>
            <p class="pt-3">One final step, let's book in a quick chat!<br><br>Select a stylist and schedule in a quick 15min video chat (it might not even take that long!)  with your selected stylist within the next 2 weeks.<br><br>Your stylist will be finalising your image profile so they can get to work selecting your items. They'll be asking you questions, and you can ask or request any items you need as a priority. <br><br><i>Please select a stylist and book an available time.</i></p>
             <div class=" mt-3 btn stf_save_btn d-block w-100 show_questions_screen_btn col-md-5" onclick="stylist_show_questions_answers_screen(this)">BACK TO QUESTIONNAIRE</div>
            </div>
         </div>

         @php


         $html = '';
         $html ='<div class=" stylist_field_outer stylist_field_required_one product_box_wrappr m-auto" >';
         $html .= '<div class="row">';

         if($merchants_obj->isNotEmpty()){
              $required_label_html = ' <p class="py-2 gett-text-pque stylist_field_error">THIS IS REQUIRED.*</p>';

         foreach($merchants_obj as $merchant_obj){
             $profile_img_url = url('images/stylist/dummy-profile-pic.png?').rand(10,100);
             if(isset($images_array[$merchant_obj->id])) {
                $profile_img_url = url('image/'.$images_array[$merchant_obj->id]).'?'.rand(10,100);
             }



          $html  .= '<div class="style-field-checkbox-outer my-2 col-lg-5 col-lg-7 m-auto">';
          $html  .= '<div class=" merchant_item product_box_outer">';
          $html  .= '   <div class="product_box ">';
          $html  .= '<div class="pt-4">';
          $html  .= '<h4>'.$merchant_obj->name.'</h4>';
          $html  .= '<p>'.$merchant_obj->email.'</p>';
          $html  .= '</div>';
          $html  .= '   <div class=" product_box_single_select  product_img_box pro_img_has ">';
          $html  .= '<img src="'.$profile_img_url.'" onclick="stf_type_form_booking_form(this,'.$merchant_obj->id.')">';


          $html  .= '</div>';
         $html .= '<input type="radio" class="stylist_field style-field-hide style-options-checkbox stylist_field_required"  name="select_merchant" value="'.$merchant_obj->id.'">';
          $html  .= '</div>';
          $html  .= ' </div> ';
          $html  .= ' </div> ';
         }
         //$html  .= $required_label_html;
         $html  .= ' </div> ';
       }else{
          $html = '<div class="no_data text-center">No Any Stylist found</div>';
       }
         @endphp
         {!!  $html !!}

         <div class="col-lg-5 col-lg-7 m-auto customer_booking_date_time_wrapper" style="display: none;">
            <div class=" pt-3 pb-2 dappr-text-h">
               <h3>SELECT A TIME & DATE</h3>
            </div>
            <div class="form-group">
               <div class=' date  pt-2 pb-2' >
                  <div id='stf_booking_date'  onchange_rename="stfBookingTimeShowByDate(this)"></div>
               </div>
            </div>

            <div class="customer_booking_time_wrapper" style="display:none">
              <div class="stylist_field_outer stylist_field_required_one product_box_wrappr m-auto" >

               </div>
            </div> <!-- customer_booking_time_wrapper closed -->

            {{-- <div class=" py-4 booking_btn  m-auto" style="display:none"><div  class=" mt-3 btn stf_save_btn d-block " onclick="stylist_save_booking(this)">Click to book</div> --}}
            </div>

         </div>
         {{-- </div> --}}
      </div>
     </div>
   </div>
</section>
<section class="booking_appointment_list_section section_class {{ $class_form }}" >

<div class="container ">
   <div class="col-md-7 m-auto w-75 my-5">
      <div class=" pt-3 pb-2 dappr-text-h">
         <h3>SELECT A TIME & DATE</h3>
      </div>


      <div class="row ">
      <div class="card mb-5 w-50 m-auto mt-3">

         <form action="{{ url('/stylist/client/submit_booking')}}" method="post"  class="p-3 dappr-text-h2 text-left" name="booking_appoinment_form">

         @csrf
         <input type="hidden" value="" name="merchant_id">
            <div class="form-group d-flex align-items-center">
               <label for="email">Name:</label>
               <input type="name" class="form-control ml-5" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">

            </div>
             @error('name')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
            <br>
            <div class="form-group d-flex align-items-center">
               <label for="email">Email:</label>
               <input type="email" class="form-control ml-5" id="email" placeholder="Enter Email" name="email" value="{{ old('email') }}">

            </div>
              @error('email')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror
            <br>
            <div class="form-group d-flex align-items-center">
               <label for="date">Date:</label>
               <input type="date"  class="form-control ml-5"  id="date" name="booking_appoinment_date" value="{{ old('booking_appoinment_date') }}">

            </div>
             @error('booking_appoinment_date')
               <span class="invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
               </span>
            @enderror

            <div class="justify-content-end">
               <button type="submit" class="btn btn-primary t-flot ">Click to Book</button>
            </div>


         </form>
      </div>
      </div>
   </div>
</div>
</section>



    {{-- {{$class_form}} --}}

<section class="booking_appointment_list_section section_class {{ $class_form }}" >

    <div class="container ">
       <div class="col-md-7 m-auto w-75 my-5">
          <div class=" pt-3 pb-2 dappr-text-h">
             <h3>SELECT A TIME & DATE</h3>
          </div>


          <div class="row ">
          <div class="card mb-5 w-50 m-auto mt-3">

             <form action="{{ url('/stylist/client/submit_booking')}}" method="post"  class="p-3 dappr-text-h2 text-left" name="booking_appoinment_form">

             @csrf
             <input type="hidden" value="" name="merchant_id">
                <div class="form-group d-flex align-items-center">
                   <label for="email">Name:</label>
                   <input type="name" class="form-control ml-5" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">

                </div>
                 @error('name')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                   </span>
                @enderror
                <br>
                <div class="form-group d-flex align-items-center">
                   <label for="email">Email:</label>
                   <input type="email" class="form-control ml-5" id="email" placeholder="Enter Email" name="email" value="{{ old('email') }}">

                </div>
                  @error('email')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                   </span>
                @enderror
                <br>
                <div class="form-group d-flex align-items-center">
                   <label for="date">Date:</label>
                   <input type="date"  class="form-control ml-5"  id="date" name="booking_appoinment_date" value="{{ old('booking_appoinment_date') }}">

                </div>
                 @error('booking_appoinment_date')
                   <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                   </span>
                @enderror

                <div class="justify-content-end">
                   <button type="submit" class="btn btn-primary t-flot ">Click to Book</button>
                </div>


             </form>
          </div>
          </div>
       </div>
    </div>
    </section>


</div>

<!-- stylist booking screen closed -->


<section class="booking_review_form" style="display:@php if(isset($show_booknig_review_screen)) { echo $show_booknig_review_screen;}else { echo 'none'; }
@endphp; margin-bottom:40px;">
   @php

   if(isset($booking_review_html)){
      echo $booking_review_html;
   }
   @endphp
</section>  <!-- booking_review_form closed -->


<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">

@endsection
@section('scripts')
<script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="//code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

<script>
    @php
    if(isset($bookingData->id)){
    @endphp
        var actionName = 'redirectBookingConfirm';
    @php
    }else{
    @endphp
        var actionName = 'ShowBookingScreen';
    @php
    }
    @endphp
</script>

<script  type="text/javascript" src="{{ url('js/stylist-form-frontend-custom.js?').rand(10,1000) }}" ></script>
@endsection
