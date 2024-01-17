@extends('theme::layouts.main')
@section('content')

<link href="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link rel="stylesheet" href="{{ url('css/owl.theme.default.css') }}">
<link rel="stylesheet" href="{{ url('css/owl.carousel.css') }}">


<link href="{{ url('css/frotend-stylist-form-common.css?').rand(10,1000) }}" rel="stylesheet">

@php


$product_details_html = '';
$product_ids_in_list_value = '';
if(is_array($products_details)){
   $product_ids = $reveal_info->product_ids;
   $alernative_product_ids = $reveal_info->alernative_product_ids;
   $product_ids_arr = explode(',',$product_ids);
   $alernative_product_ids_arr = explode(',',$alernative_product_ids);
   $product_feedback_array =  array();
   $sty_i = 0;
   $sty_j = 0;
   
   $product_ids_in_list ='<input type="hidden" id="all_add_to_bag_items_skip" value="';
   $product_details_html= '';
   if(isset($select_product_info_repalce))
   {
      // $product_ids_in_list = $select_product_info_repalce.',';
      $product_details_html .= '<input type="hidden" id="all_add_to_bag_items" value="'.$select_product_info_repalce.'">';
   }
   else {      
      $product_details_html .= '<input type="hidden" id="all_add_to_bag_items" value="">';
   }
      
   foreach($products_details as $product_id_key => $product_details_outer){
      $sty_j++;
      $alernative_key = array_search ($product_id_key, $product_ids_arr);
      $product_loop_length = array($product_details_outer);
      if(isset($alernative_product_ids_arr[$alernative_key])){
         $alernative_product_id =  $alernative_product_ids_arr[$alernative_key];
            if(is_array($alernative_products_details) && isset($alernative_products_details[$alernative_product_id])){
               $product_loop_length[] = $alernative_products_details[$alernative_product_id];
            }
      }
      $product_details_html .= ' <div class="product_details_outer">';
      $has_alternative_prodcut  = false;
      if(count($product_loop_length) == 2){
         $has_alternative_prodcut  = true;
      }

      foreach($product_loop_length as $product_loop_key => $product_details){

            $is_alernate_product = false;
            $alernate_tag = '';
            $product_type_class = '';
            if($product_loop_key == 0){
               $product_details_html .= ' <div class="row main_product_details">';
               $product_type_class = 'alternate_product_details';
            }else if($product_loop_key == 1){
            $product_details_html .= ' <div class="row alternate_product_details" style="display:none">';
               $is_alernate_product = true;
               $alernate_tag = '<div class="ref-btn-two"><i class="fal fa-crown menu-icon"><span class="pl-2">Alternative</span></i></div>';
               $product_type_class = 'main_product_details';
            }else{
               continue;
            }


            $product_obj = $product_details['product_obj'];
            $inventory_obj = $product_details['inventory_obj'];
            $attributes = $product_details['attributes'];
            $qty = 0;
            $price = 0;
            $product_slug = '';
            $html_image ='<div class="custom1 owl-carousel owl-theme stylist_pro_images_owl">';
            $img_src = '';

            $inventory_id = 0;
            if($inventory_obj){

               $inventory_id = $inventory_obj->id;
               $product_slug = $inventory_obj->slug;
               $qty  = $inventory_obj->stock_quantity;
               $price =  $inventory_obj->current_sale_price();

               foreach($inventory_obj->images as $img){
                  $img_src  = url('').'/image/'.$img->path;
                  $html_image .='<div class="item"><div class="pro_img_item "><img src="'.$img_src.'" alt=""  ></div></div>';
               }

               if($img_src == ''){

                  foreach($product_obj->images as $img){
                    $img_src  = url('').'/image/'.$img->path;
                    $html_image .='<div class="item"><div class="pro_img_item "><img src="'.$img_src.'" alt="" ></div></div>';
                  }

               }
            }


           if($img_src == ''){
               $img_src = url('images/stylist/product-placeholder.jpg');
                $html_image .='<div class="item"><div class="pro_img_item "><img src="'.$img_src.'" ></div></div>';
            }
             $html_image .='</div>';
            $attribute_html = '';

             if($product_obj->brand != ''){

               $attribute_html .= '<div><b>Brand: </b>'.$product_obj->brand.'</div>';
            }
            if($attributes->isNotEmpty()){
                foreach($attributes as $attribute){

                   $attribute_name = $attribute->name;

                   $attribute_value_arr = array();
                    $attribute_arr = $attribute->toArray();

                   if(isset($attribute_arr['attribute_values']) && count($attribute_arr['attribute_values']) ){
                       $attribute_values = $attribute_arr['attribute_values'];
                     foreach($attribute_values as $attribute_value){
                        $attribute_value_arr[] = $attribute_value['value'];
                     }
                  }
                   $attribute_value_text = implode(',', $attribute_value_arr);
                   if(strtolower($attribute_name) == 'size'){
                      $attribute_html .= '<div><b>'.$attribute_name.':</b> '.$attribute_value_text.'</div>';
                   }
                }
            }
            $price =  get_formated_price($price, config('system_settings.decimals', 2));
            if(1 || count($product_ids_arr) && in_array($product_obj->id,$product_ids_arr) && !isset($product_feedback_array[$product_obj->id]) ){

                $product_feedback_array[$product_obj->id] = array('name'=>$product_obj->name, 'price'=>$price,'html_image'=>$html_image,'brand'=>$product_obj->brand,'inventory_id'=>$inventory_id);
            }
             $sty_i++;

            $product_details_html .= '<div class="col-md-6 pl-md-5  pt-0 p-0   " style="overflow: hidden;">
            <span class="ref-btn-2" >'. $html_image.' </span>';

            if($has_alternative_prodcut){
                $product_details_html .= '<div class="ref-btn" onclick="stylist_show_alertive_product(this,\''.$product_type_class.'\')"><img src="'.url('images/stylist/sync.png').'" alt="" style="width: 100%;">
               <span class="pl-2" style="color: #ffffff73;">Alternative</span>
               </div>';
            }

            $product_is_selected_checked = '';
            $product_is_selected_checked_class = '';
            $product_add_cart_btn_display = 'block';
            $product_remove_add_cart_btn_display = 'none';
            if(isset($cart_items_inventory_id) && is_array($cart_items_inventory_id)){
               if(in_array($inventory_id,$cart_items_inventory_id)){
                  $product_is_selected_checked = ' checked ';
                    $product_is_selected_checked_class = 'product_selected';
                    $product_add_cart_btn_display = 'none';
                    $product_remove_add_cart_btn_display = 'block';
               }

            }

            $product_ids_in_list_value .=$product_obj->id.',';
            $product_details_html .= $alernate_tag.'</div>
            <div class="col-md-6 dappr-altenative-style">
              
                <div class="dappr-altenative-style_display_view">
                    <h1 class="mt-4">'.$product_obj->name.'</h1>
                    <p>Price '.$price.'</p>
                    <p>'.$attribute_html.'</p>
                </div>
                <button type="button" class="btn btn-dark add_cart add_to_card '.$product_is_selected_checked_class.'" name="stylist[\'product_in_cart\'][]"  value="'.$product_obj->id.'" style="display:'.$product_add_cart_btn_display.'" onclick="addtobag_list(this)">ADD TO BAG</button>
               <input type="checkbox" class="style-field-hide  add_to_cart_product_select_'.$product_obj->id.'" name="product_select['.$product_obj->id.']" '.$product_is_selected_checked.'>


                <button type="button" class="btn btn-dark remove_add_to_card " name="stylist[\'product_in_cart_remove\'][]" style="display:'.$product_remove_add_cart_btn_display.'" value="'.$product_obj->id.'" onclick="removetobag_list(this)" >REMOVE FROM BAG</button>


            ';
            $according_rand_no = $product_obj->id.'_'.rand(1,100);
            $according_details = '<div class="" id="stylist_accordion_id_'.$according_rand_no.'">
           <div class="">
            <div class="dappr-altenative-style_mobiel_view" style="display:none;">
                    <h1 class="mt-4">'.$product_obj->name.'</h1>
                    <p>Price '.$price.'</p>
                    <p>'.$attribute_html.'</p>
                </div>
             <p class="mt-5">DESCRIPTION</p>
             <div class="stylist-product-description">

                 '.$product_obj->description.'

             </div>


           </div>';




            $products_details_1 = '<div>Slug: '.$product_slug.'</div>';

            if($product_obj->brand != ''){

               $products_details_1 .= '<div><b>Brand: </b>'.$product_obj->brand.'</div>';
            }

            if($product_obj->model_number != ''){
               $products_details_1 .= '<div><b>Model Number: </b>'.$product_obj->model_number.'</div>';
            }
            if($product_obj->mpn != ''){
                $products_details_1 .= '<div><b>MPN: </b>'.$product_obj->mpn.'</div>';
            }
            if($product_obj->gtin != ''){
               $products_details_1 .= '<div><b>GTIN: </b>'.$product_obj->gtin.'</div>';
            }

             if($products_details_1 != ''){



        }

        if(0 && $attribute_html != ''){

           $according_details .= '<div class="accordion-item">
             <h2 class="accordion-header" id="stylist_accordion_item_'.$according_rand_no.'_3">
               <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                 More Features
               </button>
             </h2>
             <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="stylist_accordion_item_'.$according_rand_no.'_3" data-bs-parent="#stylist_accordion_id_'.$according_rand_no.'">
               <div class="accordion-body">
                '.$attribute_html.'
               </div>
             </div>
           </div>';

        }

        $product_ids_in_list.= $product_ids_in_list_value;
        $according_details .= '</div>';
        $product_details_html .= $according_details;
        $product_details_html .= '</div>';
        
        $product_details_html .= '</div>';
        
      }// product loop end
      




     $next_btn_text = 'Next';

     $previous_btn_text_html = ' <a href_renam="javascript:void(0)" onclick="stylist_checkout_from_step_prev_show(this);return false;" class="stf_anchor_btn stf_anchor_btn_q_pre">Previous</a>';
     if($sty_j == 1){
       $previous_btn_text_html = ' <a href_renam="javascript:void(0)" onclick="stylist_checkout_video_step(this);return false;" class="stf_anchor_btn stf_anchor_btn_q_pre">Previous</a>';

     }

     if(count($products_details) == $sty_j){
         $next_btn_text = '';
     }




     $product_details_html .= '
      <div class=" py-4 px-4 botom-style-previous ">
      <div class="d-flex justify-content-between px-3">
         '.$previous_btn_text_html.'
         <a href_rename="javascript:void(0)" onclick="stylist_checkout_from_step_next_show(this);return false;" class="stf_anchor_btn  question_save_btn">'.$next_btn_text.' </a>
      </div>';
      if(count($products_details) == $sty_j){
         $product_details_html .= ' <a href="javascript:void(0)" class="text-decoration-none px-0">
            <div class="p-3 my-3 text-center proceed-checkout-style m-auto  w-100"style="   " onclick="stylist_proceed_checkout_page(this)">PROCEED TO CHECKOUT</div>
            </a>';
     }

    $product_details_html .= '</div>';

      //$product_details_html .= '<div class="col-md-12 m-md-5 my-3 border-botom-style"></div>';
      $product_details_html .= '</div>';
   }
   
   $product_ids_in_list.='">';
   $product_details_html .=$product_ids_in_list;
}



@endphp


<div class="container-fluid stf_outer_body stylist_step_frontend">
   <form action="{{ url('/stylist/client/submit_selection')}}" id="stylist_proceed_checkout_page" method="post">
      @csrf

      <input type="hidden" name="merchant_id" value="{{ $reveal_info->merchant_id}}">
               <input type="hidden" name="stylist_form_id" value="{{ $reveal_info->id}}">
               <input type="hidden" name="booking_id" value="{{ $reveal_info->booking_id }}">
               <input type="hidden" name="appointment_response_id" value="">
               <input type="hidden" name="skip_feedback" value="N">

      <div class="row">

         <div class="col-lg-12 m-auto mt-3 p-0">

            <section class="stylist_step stylist_step_7 " style="display:block;">
               <div class="container-fluid ">
                     <div class="row my-md-5 align-items-start  ">

                        <div class="col-md-4 sticky-div p-md-0 m-md-0 px-md-5 video_html_outer" >
                           <div class="row">
                              @php
                              echo $video_html;
                              @endphp
                              <h1 class="py-4 dappr-altenative">Your Winter DAPPR Preview! Press play for a talk through on what I’ve chosen and why</h1>

                              <div class=" py-4 px-4 botom-style-previous ">
                                 <div class="d-flex justify-content-between px-3">
                                    <a href_renam="javascript:void(0)"  class="stf_anchor_btn stf_anchor_btn_q_pre"></a>
                                    <a href_rename="javascript:void(0)" onclick="stylist_checkout_video_next_step(this);return false;" class="stf_anchor_btn  question_save_btn">Next </a>
                                 </div>
                              </div>

                           </div>
                        </div>
                        <div class="col-md-8 ">
                           <div class="row  stf_products_list mx-md-4">
                              @php
                              echo $product_details_html;
                              @endphp

                              <a href="javascript:void(0)" class="text-decoration-none px-0 sty_mobile_hide">
                                 <div class="p-3 my-3 text-center proceed-checkout-style m-auto  w-100" onclick="stylist_proceed_checkout_page(this)">PROCEED TO CHECKOUT</div>
                              </a>
                              {{-- <span style="    display: block; text-align: center; padding: 2em 0 3em 0;">Didn't see anything you liked in your Reveal? Contact us here to book a quick chat with your Stylist. <a href="mailto:hello@dappr.com.au">hello@dappr.com.au</a></span> --}}
                              <span style="display: block; text-align: center; padding: 2em 0 3em 0;">
                                 Didn't see anything you liked in your Reveal? Contact us <a href="mailto:hello@dappr.com.au">hello@dappr.com.au</a> here to book a quick chat with your stylist. </span>
                           </div>
                        </div>
                     </div>
               </div>

            </section>

            <section class="stylist_step stylist_step_8 products_feedback_wrappr " style="display:none;">
               <div class="container-fluid ">
                  <div class="px-md-3">
                     <div class="row pt-md-5">
                        <span class="col-sm-3 stf_anchor_btn " onclick="stylist_back_reveal_list_page(this)"> <i class="fas fa-angle-left px-2" ></i>  Back to Reveal Page </span>
                     </div>
                     <div class="row pt-md-5 products_feedback_top_section">
                        <div class="col-md-6 h-100 products_feedback_top_section-col" >
                           <div class="row ">
                              <div class="">
                                 <div class="col-md-6 p-0">
                                    <h6>FEEDBACK</h6>
                                    <p>Help us refine your profile by telling us why you chose not to take these items.</p>
                                 </div>
                              </div>
                           </div>
                        </div>
                        
                        <div class="col-md-4 px-lg-4 sm-p-my-t offset-md-2 products_feedback_top_section-col-2">
                           <div class="w-md-75 px-xl-4 px-md-3 py-md-3 border border-dark ">
                              <span class="text-uppercase">Skip feedback and go to checkout </span>
                              {{-- <p>Don't want give feedback?<br> Thats fine, hit proceed to checkout to continue</p> --}}
                              <span class="btn stf_save_btn w-100 stf_anchor_btn ml-auto" onclick="stylist_proceed_feedback_page(8,8,'N')">Proceed to checkout</span>
                           </div>
                        </div>
                     </div>
                

                     @php
                     $customer_id = $customer_id;
                     $stylist_reveal_product_feedback =  Session::get('stylist_reveal_product_feedback.'.$customer_id);
                     $stylist_reveal_product_feedback_other_mesg =  Session::get('stylist_reveal_product_feedback_other_mesg.'.$customer_id);
                  
                  
                     if(!isset($stylist_reveal_product_feedback)){
                        $stylist_reveal_product_feedback = array();
                     }
                     if(!isset($stylist_reveal_product_feedback_other_mesg))
                     {
                        $stylist_reveal_product_feedback_other_mesg = '';
                     }
                 


                     $product_feedback_option_array = array('style'=>'STYLE','colour'=>'COLOUR','pattern'=>'PATTERN','fabric'=>'FABRIC','brand'=>'BRAND','other'=>'OTHER', 'too_expensive' => 'TOO EXPENSIVE', 'own_similar' => 'OWN SIMILAR','do_not_need_right_now'=>'DON\'T NEED RIGHT NOW', 'does_not_feel_like_me' => 'DOESN\'T FEEL LIKE ME', "LIKED_ALT_ITEM_MORE"=>"LIKED ALT ITEM MORE");
                     foreach($product_feedback_array as $product_id => $product_feedback_info){

                        $inventory_id = $product_feedback_info['inventory_id'];


                        $product_add_cart_btn_display = 'block';

                        if(isset($cart_items_inventory_id) && is_array($cart_items_inventory_id)){
                           if(in_array($inventory_id,$cart_items_inventory_id)){

                                $product_add_cart_btn_display = 'none';

                           }
                        }
                        $selected_option = '';
                        $select_product_ids = '';
                        $already_selected_feedback_arr = array();

                        if(is_array($stylist_reveal_product_feedback) && isset($stylist_reveal_product_feedback[$product_id])){
                           $already_selected_feedback_arr = explode('||',$stylist_reveal_product_feedback[$product_id]);
                        }
                        // print_r($already_selected_feedback_arr);
                        // $feedback_msg = array();
                        
                        // if(is_array($stylist_reveal_product_feedback_other_mesg) && isset($stylist_reveal_product_feedback_other_mesg[$product_id.'.other_reason']))
                        // {
                        //    $feedback_msg = explode('',$stylist_reveal_product_feedback_other_mesg[$product_id.'.other_reason']);
                        // }
                        // print_r($feedback_msg);
                        

                        
                        
                                                
                     @endphp
                        <div class="row ">
                           <div class="col-md-12">
                           <div class="row my-md-5 product_feedback_item product_feedback_{{$product_id}}" style="display:{{ $product_add_cart_btn_display; }}">
                                 <div class="col-md-3  p-md-0 m-md-0 px-md-5 " >
                                    <div class="row">
                                       {!! $product_feedback_info['html_image'] !!}
                                    </div>
                                 </div>
                                 <div class="col-md-5 ">
                                    <div class="row">
                                       <div class="gett-text-ptw stylist_field_outer stylist_field_required_one">
                                          <h1> {!! $product_feedback_info['name'] !!}</h1>
                                          <p class=""><b>Price: </b>{!! $product_feedback_info['price'] !!}</p>
                                          <p class=""><b>Brand: </b>{!! $product_feedback_info['brand'] !!}</p>
                                          <p class="product_feedback_question_text" style="font-weight: normal">Tell us why you did <b>not</b> chose this item</p>
                                          <p class="py-3 stylist_field_error" style="text-align: inherit;">PLEASE MAKE BETWEEN 1 AND MORE CHOICES. THIS QUESTION IS REQUIRED.*</p>
                                          <span class="row ">
                                          @php 
                                             $other_text_msg = '';
                                             $other_text_msg_style = '';
                                          @endphp
                                             @foreach($product_feedback_option_array as $option_key => $option_value)

                                             @php
                                             $already_feedback_checked = '';
                                             $already_feedback_checked_class = '';

                                          
                                             if(in_array($option_key,$already_selected_feedback_arr)){
                                                $already_feedback_checked = ' checked';
                                                $already_feedback_checked_class = 'style-options-selected';

                                             }

                                          
                                             if( $option_key == 'other' && in_array($option_key,$already_selected_feedback_arr)){
                                             
                                             $other_text_msg= $stylist_reveal_product_feedback_other_mesg[$product_id]['other_reason'];

                                             $other_text_msg_style = "style='display:flex'";

                                             }
                                          
                                             @endphp
                                             <div class="col-md-6 style-field-checkbox-outer ">
                                                <button type="button" class="btn btn-pr-style-tow style-options my-2 mr-3  field_name_{{$option_key}}  {{ $already_feedback_checked_class }}">{{$option_value}}</button>
                                                <input type="checkbox" class="style-field-hide style-options-checkbox stylist_field_required '". $product_is_selected_checked_class ."'" name="stylist_feedback[{{$product_id}}][{{$option_key}}]" value="{{$option_key}}" {{ $already_feedback_checked }}>
                                             </div>
                                             @endforeach
                                             <div class="col-sm-12">
                                                <textarea  class="style-field-hide form-control other_feedback_field" name="stylist_feedback_other[{{$product_id}}][other]" {!! $other_text_msg_style !!}>{{$other_text_msg}}</textarea>
                                             </div>
                                          </span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     @php }
                     @endphp
                        <a href="javascript:void(0)" class="text-decoration-none">
                        <div class="p-3 my-3 text-center proceed-checkout-style m-auto "style="width: 100%;" onclick="stylist_proceed_feedback_page(8,8)">PROCEED TO CHECKOUT</div></a>
               </div>
            </section>
         </div>
      </div>
     </div>
   </form>
</div>

@endsection
@section('scripts')

<script src="//cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script src="{{ url('js/owl.carousel.js') }}"></script>
<script  type="text/javascript" src="{{ url('js/stylist-form-frontend-custom.js?').rand(10,1000) }}" ></script>


@endsection