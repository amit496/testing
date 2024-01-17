@extends('theme::layouts.main')
@section('content')

<style type="text/css">
   section {
   margin: 0 0 35px 0;
   }
   *{
   padding:0;
   margin:0;
   }
   /*my style */ 
   .button-continue button {
    padding: 6px 20px;
    border-radius: 2pc;
    color: white;
    background: yellowgreen;
   }
   
   /********model************/
   .modal-body{
   padding: 0;
   }
   .modal-header{
   background: -moz-linear-gradient(top, #f8f8f8, #f2f2f2);
   }
   .modal-dialog {
   max-width: 600px;
   }
   /*************btn*********************/
   .btn-theme{
   display: block;
   /* padding: 8px 15px;*/
   text-decoration: none;
   border: 2px solid #1b716a;
   color: #1b716a;
   border-radius: 2em !important;
   max-width: 540px;
   margin: 20px;
   font-weight: 600;
   font-size: 22px;
   font-family: 'Philosopher', sans-serif;
   letter-spacing: 1px;
   }
   .btn-theme:hover, .active{
   background: #1b716a;
   color: #fff;
   transition: all 0.4s ease-in;
   }
   .btn_payment{
   color: #fff;
   font-weight: bold;
   }
   .btn_payment:hover i{
   padding-left: 10px;
   transition: all 0.3s ease-in;
   }
   /*****************heading style************/
   .heading h2{
   display: inline-block;
   text-align: center;
   padding: 10px 10px 15px; / bottom padding should be higher to make up for pseudo border height /
   background: linear-gradient(90deg, transparent 25%, #1a6e68 25%, #2e827c 75%, transparent 75%);
   background-size: 100% 5px;
   background-position: 0% 100%;
   background-repeat: no-repeat;
   font-weight: bold;
   }
   .heading-2 h2 {
   display: inline-block;
   text-align: center;
   padding: 10px 10px 15px;
   background: linear-gradient(90deg, transparent 25%, #1a6e68 25%, #2e827c 75%, transparent 75%);
   background-size: 100% 3px;
   background-position: 0% 100%;
   background-repeat: no-repeat;
   /*text-transform: capitalize;*/
   color: #222222;
   font-family: Cairo;
   font-size: 50px;
   }
   .heading-2 h2 span {
   font-weight: 800;
   color: #1b716a;
   }
   .heading-3 h2 {
   display: inline-block;
   text-align: center;
   padding: 10px 10px 15px;
   background: linear-gradient(90deg, transparent 25%, #1a6e68 25%, #2e827c 75%, transparent 75%);
   background-size: 100% 3px;
   background-position: 0% 100%;
   background-repeat: no-repeat;
   /*text-transform: capitalize;*/
   color: #222222;
   font-family: 'Philosopher', sans-serif;
   font-size: 40px;
   }
   /********************my_home_modal*******************/
   /*
   .form-control:focus {
   color: #495057;
   background-color: #fff;
   border-color: #25aaea;
   outline: 0;
   box-shadow: none;
   }
   #my_home_modal .modal-header {
   background: #25aaea;
   color: #fff;
   }
   #my_home_modal .input-group-text .fas{
   color: #25aaea;
   }*/
   /**************form******************/
   .q-main{
   /* width:100vh;
   height:100vh;*/
   }
   /* .q-container{
   padding:10%;
   } */
   .q-navigator{
   position:fixed;
   bottom:5%;
   right:5%;
   z-index:999;
   }
   .q-disabled{
   color:#999;
   pointer-events: none;
   }
   .q-container .q-question{
   font-family: 'Philosopher', sans-serif;
   font-size: 26px;
   /*text-transform: capitalize;*/
   color: #363636;
   font-weight: 500;
   margin-bottom: 10px;
   }
   .section-body .q-answer .form-control:focus {
   color: #495057;
   background-color: #fff;
   border-color: #1b716a !important;
   outline: 0;
   box-shadow: none;
   }
   .q-container .q-answer{
   }
   .q-container .q-answer .form-control{
   border-radius: 0;
   border: none;
   border-bottom: 2px solid #5d5e5e;
   height: 45px;
   font-size: 20px;
   /*text-transform: capitalize;*/
   padding-left: 5px;
   font-family: 'Philosopher', sans-serif;
   /* background: #f1f1f1;*/
   }
   .q-container .q-answer label.form-check-label {
   font-size: 20px;
   /*text-transform: capitalize;*/
   color: #707375;
   font-family: 'Philosopher', sans-serif;
   }
   .q-container .q-answer input[type="file"]{
   border: 2px dotted #5d5e5e;
   padding: 30px;
   height: 100px;
   }
   /**********check-box****/
   .custom-switch .custom-control-label::after{
   background-color: #20746e;
   height: 25px;
   width: 30px;
   }
   .custom-control-label::before{
   border: #20746e solid 1px;
   width: 70px !important;
   height: 30px;
   }
   /********btn************/
   .btn-green {
   padding: 5px 10px;
   color: #fff;
   background: #1b716a;
   border: 1px solid #1b716a;
   margin-top: 5px;
   font-size: 18PX;
   font-weight: 600;
   font-family: 'Philosopher', sans-serif;
   }
   .btn-gray {
   padding: 10px 15px;
   color: #fff;
   background: rgb(130,235,227);
   background: linear-gradient(90deg, rgba(130,235,227,1) 0%, rgba(45,204,192,1) 33%, rgba(13,198,236,1) 100%);
   border: 1px solid #1b716a;
   margin-top: 5px;
   font-size: 18PX;
   font-weight: 600;
   font-family: 'Philosopher', sans-serif;
   }
   /**************/
   .q-navigator a{
   padding: 8px 15px;
   color: #fff;
   border-radius: 5px;
   background-color: #20746e;
   width: 40px;
   height: 40px;
   }
   .q-disabled {
   color: #ccc !important;
   pointer-events: none;
   }
   .card{
   -webkit-box-shadow: 0px 1px 5px 1px rgba(105,103,105,0.22);
   -moz-box-shadow: 0px 1px 5px 1px rgba(105,103,105,0.22);
   box-shadow: 0px 1px 5px 1px rgba(105,103,105,0.22);
   }
   /*************payment*******/
   .payment h4{
   font-family: 'Philosopher', sans-serif;
   /*color: #1b716a;*/
   }
   .payment .total{
   font-weight: bold;
   }
   .payment td{
   border-bottom: 1px solid lightgray;
   font-size: 18px;
   }
   .total-payment p{
   font-size: 20px;
   font-weight: bold;
   color:  #fff;
   font-family: 'Philosopher', sans-serif;
   }
   .total-payment{
   background: #ffc107;
   padding: 15px 0;
   }
   .total-payment a{
   text-decoration: none;
   color: #fff;
   font-size: 20px;
   }
   .payment_header{
   background: #e9ecef;
   padding: 15px 0;
   }
   /***********customer_page_box************/
   .customer_page_box .far{
   font-size: 40px;
   color: #1b716a;
   }
   .customer_page_box{
   padding: 30px;
   font-family: 'Philosopher', sans-serif;
   box-shadow: 0 2px 5px 3px lightgrey;
   }
   .customer_page_box .plan_btn a{
   text-decoration: none;
   color: #222222;
   }
   input[type=checkbox], input[type=radio] {
   box-sizing: border-box;
   padding: 0;
   width: 20px !important;
   height: 20px !important;
   }
   .form-check-inline{
   display: block;
   }
   .form-check-inline label{
   display: inline;
   }
/* 14-04-22 */
.Just-quickly-f {
    padding-left: 40px;
    padding-right: 40px;
    text-align: left;
}
.Just-quickly-u {
    width: 100%;
    max-width: 720px;
    margin: 0px auto;
    padding-left: 0px;
    padding-right: 0px;
}
.Just-quickly-d {
    margin-top: 120px;
    margin-bottom: 184px;
}

.Just-quickly-l {
    position: relative;
    -webkit-font-smoothing: antialiased;
    display: flex;
    overflow-wrap: break-word;
}
    .Just-quickly-D {
    position: relative;
    height: 32px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
}
.Just-quickly-es {
font-size: 26px;
    margin-bottom: 16px;
}
.Just-quickly-c {
    margin: 0px;
    max-width: 100%;
    font-weight: unset;
    font-size: 24px;
    line-height: 32px;
    color: rgb(8, 8, 8);
}
.Just-quickly-Jp {
    position: absolute;
    right: 100%;
}
.Just-quickly-Gu {
    margin-right: 12px;
}
.Just-quickly-qw {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    color: rgb(61, 61, 61);
    font-size: 14px;
    line-height: 20px;
    height: 100%;
    outline: none;
}
.Just-quickly-fa {
    margin: 0px;
    max-width: 100%;
    font-weight: unset;
    font-size: 16px;
    line-height: 24px;
}
.Just-quickly-LQ {
    margin-left: 4px;
}
.cgeuGb {
    position: relative;
    font-family: inherit;
    line-height: inherit;
    font-weight: 700;
    cursor: pointer;
    transition-duration: 0.1s;
    transition-property: background-color, color, border-color, opacity, box-shadow;
    transition-timing-function: ease-out;
    outline: none;
    border: 1px solid transparent;
    margin: 0px;
    box-shadow: rgb(0 0 0 / 10%) 0px 3px 12px 0px;
    padding: 6px 14px;
    min-height: 40px;
    background-color: rgb(2, 144, 173);
    color: rgb(255, 255, 255);
    border-radius: 4px;
}
.Just-quickly-ky {
    display: block;
    width: 100%;
    font-family: inherit;
    color: rgb(61, 61, 61);
    padding: 0px 0px 8px;
    border: none;
    outline: none;
    border-radius: 0px;
    appearance: none;
    background-image: none;
    background-position: initial;
    background-size: initial;
    background-repeat: initial;
    background-attachment: initial;
    background-origin: initial;
    background-clip: initial;
    transform: translateZ(0px);
    font-size: 30px;
    -webkit-font-smoothing: antialiased;
    line-height: unset;
  
    animation: 1ms ease 0s 1 normal none running native-autofill-in;
    transition: background-color 1e+08s ease 0s, box-shadow 0.1s ease-out 0s;
    box-shadow: rgb(61 61 61 / 30%) 0px 1px;
    background-color: transparent !important;
}
.Just-quickly-se{
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    align-items: center;
}
.Just-quickly-p{
    margin: 0px;
    max-width: 100%;
    font-weight: unset;
    font-size: 20px;
    line-height: 28px;
    color: rgba(8, 8, 8, 0.7);    
}

.Just-quickly-Whc{
    position: absolute;
    inset: 0px 0px 0px 50%;
}
.Just-quickly-rgi{
    position: relative;
    height: 100%;
    width: 100%;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    overflow: hidden;
    padding-right: 80px;
    padding-left: 52px;
    -webkit-box-pack: start;
    justify-content: flex-start;
}
}
.jJust-quickly-xm{
    width: 100%;
    max-width: 720px;
    filter: contrast(1) brightness(1);
}
.jJust-quickly-lj{
    max-height: 100%;
    max-width: 100%;
    transition: object-position 0.3s ease 0s;
    position: relative;
    pointer-events: auto;
}
.jJust-quickly-dh {
    margin-top:80px;
    margin-bottom: 144px;
}
.CRgKN {
    position: relative;
}
.fVbsUI {
    display: inline-flex;
    margin: 0px -8px -8px 0px;
    list-style: none;
    padding: 0px;
    flex-flow: row wrap;
    -webkit-box-align: stretch;
    align-items: stretch;
    width: 100%;
}
.hziRJr {
    outline: none;
}

.jZGSfV {
    min-height: 100%;
}


.ipZQle {
    position: relative;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    border-radius: 4px;
    background-color: rgba(61, 61, 61, 0.1);
    box-shadow: rgb(61 61 61 / 60%) 0px 0px 0px 1px inset;
    color: rgb(61, 61, 61);
    max-width: 100%;
    min-width: 75px;
   
    outline: 0px;
    padding: 9px;
    transition-duration: 0.1s;
    transition-property: background-color, color, border-color, opacity, box-shadow;
    transition-timing-function: ease-out;
    width: 100%;
    cursor: pointer;
    opacity: 1;
}
.LefjA {
    display: flex;
    flex-direction: column;
    align-self: flex-start;
    width: 100%;
}
.cBxtLE {
    padding: 4px;
    height: 160px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    -webkit-box-pack: center;
    justify-content: center;
    overflow: hidden;
}
.bXMvPU img {
    max-width: 100%;
}
.fFBOFU {
    margin-bottom: 4px;
}
.gBsNqQ {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    min-height: 32px;
    -webkit-box-pack: center;
    justify-content: center;
}
.cnUTTh {
    display: flex;
    align-self: flex-start;
    margin: 4px 8px 0px 4px;
}
.fMZrXl {
    position: relative;
    width: 24px;
    min-width: 22px;
    height: 24px;
    border-radius: 2px;
    font-size: 12px;
    line-height: 16px;
    font-family: sans-serif;
    border-color: rgba(61, 61, 61, 0.6);
    background-color: rgba(255, 255, 255, 0.8);
    color: rgb(61, 61, 61);
}

.hSsPVu {
    position: absolute;
    right: 0px;
}
.bUlCTb {
    height: 24px;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    align-items: center;
    border-width: 1px;
    border-style: solid;
    border-radius: 2px;
    border-color: rgba(61, 61, 61, 0.6);
    background-color: rgb(255, 255, 255);
}
.iXvsqW {
    display: none;
    padding-left: 7px;
    white-space: nowrap;
}
.iXvsqW {
    display: none;
    padding-left: 7px;
    white-space: nowrap;
}
.bTVerN {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    overflow: hidden;
    flex: 1 1 0%;
}
.bFxsfa {
    margin: 0px;
    max-width: 100%;
    font-weight: unset;
    font-size: 16px;
    line-height: 24px;
}
.gNeKcF {
    display: inline-flex;
    margin: 0px 0px -8px;
    list-style: none;
    padding: 0px;
    flex-flow: column wrap;
    -webkit-box-align: stretch;
    align-items: stretch;
    max-width: 100%;
    min-width: 300px;
}
.gNROmT:hover:not, .gNROmT {
    background-color: rgba(61, 61, 61, 0.3);
}
.ipZQle:hover{
    background-color: rgba(61, 61, 61, 0.3);
}
.gNROmT {
    position: relative;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    border-radius: 4px;
    background-color: rgba(61, 61, 61, 0.1);
    box-shadow: rgb(61 61 61 / 80%) 0px 0px 0px 2px inset;
    color: rgb(61, 61, 61);
    max-width: 100%;
    min-width: 75px;   
    outline: 0px;
    padding: 4px;
    transition-duration: 0.1s;
    transition-property: background-color, color, border-color, opacity, box-shadow;
    transition-timing-function: ease-out;
    width: 100%;
    animation: 0.25s ease 0s 2 normal none running jBPXGM;
    cursor: pointer;
    opacity: 1;
}
.kpEaVv {
    width: 22px;
    height: 22px;
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    font-weight: 700;
    -webkit-box-pack: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
}
.gfCRIG {
    display: flex;
    -webkit-box-align: center;
    align-items: center;
    flex: 1 1 0%;
    min-width: 75px;
    text-align: left;
}
.kCzCGH {
    margin-right: -4px;
    flex-shrink: 0;
    padding: 0px 12px 0px 20px;
    opacity: 1;
}
.gaXqWO::before {
    content: "";
    display: block;
    width: 0px;
    height: 0px;
    border-width: 24px;
    border-style: solid;
    border-image: initial;
    border-color: rgb(61, 61, 61) rgb(61, 61, 61) transparent transparent;
    position: absolute;
    right: 0px;
    top: 0px;
}
.cBPamU {
    height: 100%;
}
.cWGYGJ {
    position: relative;
    width: 24px;
    min-width: 22px;
    height: 24px;
    border-radius: 2px;
    font-size: 12px;
    line-height: 16px;
    font-family: sans-serif;
    border-color: rgb(61, 61, 61);
    background-color: rgb(61, 61, 61);
    color: rgb(255, 255, 255);
}
.hSsPVu {
    position: absolute;
    right: 0px;
}
.gwjYpg {
    height: 24px;
    display: flex;
    -webkit-box-pack: center;
    justify-content: center;
    -webkit-box-align: center;
    align-items: center;
    border-width: 1px;
    border-style: solid;
    border-radius: 2px;
    border-color: rgb(61, 61, 61);
    background-color: rgb(61, 61, 61);
}
.iWzvOe {
    display: none;
    padding-left: 7px;
    white-space: nowrap;
    color: rgb(255, 255, 255);
}

.jHaAto svg {
    display: block;
    fill: rgb(255, 255, 255);
    transition: fill 0.2s ease 0s;
}
.fXbgJQ {
    position: absolute;
    right: 6px;
    top: 7px;
}
/* 18-04-2022 */
.dappr-text-s h3{
   font-weight: 600;
  font-size: 28px;
  line-height: 38px;
  text-transform: capitalize;
  font-family: Arimo,sans-serif;
  text-align: center;

}
.reject_reason_textarea_field {
    border: 1px solid #938a8a;
    max-width: 600px;   
    padding: 0px 13px;
    color: #333e48;
    font-size: 20px;
}
.border-start-l{
    border-left: 2px solid #dddddd;
}
/* -------------- */


   /***************media Quary********/
   @media  only screen and (max-width: 768px) { 
   .btn-theme {   width: auto;   font-size: 16px;   }
   .heading-2 h2, .heading-3 h2{   font-size: 36px;   }
   }
   @media  only screen and (max-width: 600px) { 
   .q-container .q-answer label.form-check-label {   font-size: 16px;   }
   .q-container{   padding:5%;   }
   }
   @media  only screen and (max-width: 488px) {    .heading-2 h2, .heading-3 h2{   font-size: 26px;   }   }
   @media  screen and (max-width: 991px) {	section {   margin: 0 0 30px 0;   }   }
</style>
<style>
	.q-main{display:none;}
	.product_des{max-height: 340px;overflow: auto;}
	.client_select_option{width: 100%;    margin-top: 10px;    padding-right: 14px;    border-top: 2px solid red;    padding: 14px;}
	.client_select_option input{    float: left;    padding: 0;    margin: 0;}
	.client_select_option span{    margin-left: 9px;    padding: 0;        margin-top: 19px;}
	.client_select_option_single{margin-bottom: 9px;}
	.error-section-div {margin-top:10px}
	.hide_section_class{display:none}
	.reject_reason_list_div{    padding-left: 13px;    margin-top: 10px;}
	 
	 ul.reject_reason_list_div li {    margin-bottom: 10px;}
	.reject_reason_list_div {    padding-left: 13px;    margin-top: 10px;}
	.reject_reason.hide_section_class span {    font-weight: 600;}
	 ul.reject_reason_list_div li span {   font-size: 13px;}
	.reject_reason.hide_section_class {    margin-top: 10px;    padding-left: 20px;}
	.reject_reason_textarea_field {    border: 1px solid #938a8a;    width: 600px;    height: 82px;}
    .img_section {        display: block;    margin: 0px auto;    height: 300px;    /*width: 130.4px;*/}

</style>
@php 


	$from_name = $name;
	$name = $stylist_info->name;
	$video_name = $stylist_info->video_name;
	$product_ids = $stylist_info->product_ids;
	$video_url = url('').'/uploads/'.$video_name;
	$products_html  = '';
	$prod_list_c = 0;
	foreach($products_obj_array as $product_obj2){
		$prod_list_c ++;
		$last_screen_class= '';
		
		if(count($products_obj_array) == $prod_list_c){
			$last_screen_class  = ' product_last_screen ';
		}
		$qty = 0;
		$price = 0;
		$product_obj = $product_obj2['product_obj'];
		
		$inventory = $product_obj2['inventory_obj'];
		$attributes = $product_obj2['attributes'];
		$img_html= '';
		$product_slug = '';
		if($inventory){
			$product_slug = $inventory->slug;
			$qty  = $inventory->stock_quantity;
			$price =  $inventory->current_sale_price();
			
			foreach($inventory->images as $img){
				
				$img_src  = url('').'/image/'.$img->path;
				$img_html  = "<img src='".$img_src."'>";
			}
			if($img_html == ''){
				
				foreach($product_obj->images as $img){
				
				$img_src  = url('').'/image/'.$img->path;
				$img_html  = "<img src='".$img_src."'>";
				}
			}
			
			
			
		}
		$price =  get_formated_price($price, config('system_settings.decimals', 2));
		$products_html .= '<div class="q-main products_screen error-validate  '.$last_screen_class.' " data-product-id="'.$product_obj->id.'" data-screen-name="product" data-screen-step="'.$prod_list_c.'" data-error-validate="product_select['.$product_obj->id.']">';
		$products_html .= '<div class="q-container">';
		$products_html .= '<div class="row">';
		$products_html .= '<div class="col-6 pt-5">';
		$products_html .= '<div class="dappr-text-s"><h3 style="text-align: inherit;">'.$product_obj->name.'</h3></div>';
		$products_html .= '<div>Slug: '.$product_slug.'</div>';
		//$products_html .= '<div>Price: '.$product_obj->min_price.'</div>';
		if($product_obj->brand != ''){
		$products_html .= '<div><b>Brand: </b>'.$product_obj->brand.'</div>';
		}
		if($product_obj->model_number != ''){
		$products_html .= '<div><b>Model Number: </b>'.$product_obj->model_number.'</div>';
		}
		if($product_obj->mpn != ''){
		$products_html .= '<div><b>MPN: </b>'.$product_obj->mpn.'</div>';
		}
		if($product_obj->gtin != ''){
		$products_html .= '<div><b>GTIN: </b>'.$product_obj->gtin.'</div>';
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
				 $products_html .= '<div><b>'.$attribute_name.':</b> '.$attribute_value_text.'</div>';
			 }
		}
		
		$products_html .= ' <div class="product-info-availability" style="di1splay:none">';
        $products_html .= '<b>Qty: </b>'.$qty;
        $products_html .= '</div>';
        $products_html .= '<div class="product-info-price">';
		$products_html .= '<span class="product-info-price-new">';
		$products_html .= $price;
		$products_html .= '</span>';
		$products_html .= '<div class="mt-2 mb-2"><a target="_blank" class="btn-sm btn-green" href="'.url('product').'/'.$product_slug.'">View More Details</a></div>	';
		
		 //foreach ($product_obj->getLabels() as $label){
         //$products_html .= '   <li>'.$label.'</li>';
		 //}

		
		 $products_html .= ' </div>';


		
		$products_html .= '<div class="product_des my-3" >'.$product_obj->description.'</div>';
		$products_html .= '</div>';
	
		$products_html .= '<div class="col-6 border-start-l my-3 text-center img_section">';
		
		$products_html .= '<div>';
		$products_html .= $img_html;
		
		
		
		$products_html .= '</div>';
        $products_html .= '</div>';
		$products_html .= '<div class="client_select_option">';
		$products_html .= '<div class="client_select_option_single"> <input type="radio" class="reject_select_prod" name="product_select['.$product_obj->id.']" value="approve"><span> Approve, please send</span></div>';
		
		
		$products_html .= '<div class="client_select_option_single"> <input class="reject_select_prod" type="radio" name="product_select['.$product_obj->id.']" value="alternative"><span> Alternative, source another option before sending</span>';
		$html_reject_reason = '';
		$html_reject_reason .= '<span>Why`d you skip this one?</span><br>';
		$html_reject_reason .= '<span>Help us refine your profile by telling us why you chose not to take the previous item.</span>';
		$html_reject_reason .= '<span>Choose as many as you like</span>';
		
		$alternative_option_btn_name = 'product_select_alternative['.$product_obj->id.'][]';
		$alternative_option_other_btn_name = 'product_select_alternative_other['.$product_obj->id.']';
		$decline_option_btn_name = 'product_select_decline['.$product_obj->id.'][]';
		$decline_option_other_btn_name = 'product_select_decline_other['.$product_obj->id.']';
		$html_reject_reason .=' 
		<ul  class="reject_reason_list_div">
			<li><span>Style</span>  <input type="checkbox" value="style" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Colour</span> <input type="checkbox"  value="colour" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Pattern</span> <input type="checkbox"  value="pattern" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Fabric</span> <input type="checkbox"  value="fabric" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Brand</span> <input type="checkbox"  value="brand" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Own Similar</span> <input type="checkbox"  value="own_smilar" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Too expensive</span> <input type="checkbox"  value="too_expensive" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Don`t need now</span> <input type="checkbox"  value="don_not_need_now" name="'.$alternative_option_btn_name.'"></li>
			<li><span>Other </span><input type="checkbox"  value="other" name="'.$alternative_option_btn_name.'" onclick="show_reject_reason_text_div(this)" ><div class="reject_reason_text_div hide_section_class"><div class="Just-quickly-es"><div class="Just-quickly-l"><span>Oh, I see - any extra specifics you`d like us to know?</span></div></div><textarea class="Just-quickly-ky reject_reason_textarea_field" name="'.$alternative_option_other_btn_name.'" placeholder="Type your answer here..."></textarea></div>
			</li>
		</ul>	
		';
		$products_html .= '<div class="reject_reason hide_section_class">'.$html_reject_reason.'</div>';
		$products_html .= '</div>';
		
		$products_html .= '<div class="client_select_option_single"> <input class="reject_select_prod" type="radio" name="product_select['.$product_obj->id.']" value="decline"><span>Decline, please don`t send & I don`t want an alternative</span>';
		
		
		
		$html_reject_reason = '';
		$html_reject_reason .= '<span>Why`d you skip this one?</span><br>';
		$html_reject_reason .= '<span>Help us refine your profile by telling us why you chose not to take the previous item.</span>';
		$html_reject_reason .= '<span>Choose as many as you like</span>';
		$html_reject_reason .=' 
		<ul  class="reject_reason_list_div">
			<li><span>Style</span>  <input type="checkbox" value="style" name="'.$decline_option_btn_name.'"></li>
			<li><span>Colour</span> <input type="checkbox"  value="colour" name="'.$decline_option_btn_name.'"></li>
			<li><span>Pattern</span> <input type="checkbox"  value="pattern" name="'.$decline_option_btn_name.'"></li>
			<li><span>Fabric</span> <input type="checkbox"  value="fabric" name="'.$decline_option_btn_name.'"></li>
			<li><span>Brand</span> <input type="checkbox"  value="brand" name="'.$decline_option_btn_name.'"></li>
			<li><span>Own Similar</span> <input type="checkbox"  value="own_similar" name="'.$decline_option_btn_name.'"></li>
			<li><span>Too expensive</span> <input type="checkbox"  value="too_expensive" name="'.$decline_option_btn_name.'"></li>
			<li><span>Don`t need now</span> <input type="checkbox"  value="don_not_need now" name="'.$decline_option_btn_name.'"></li>
			<li><span>Other </span><input type="checkbox"  value="other" name="'.$decline_option_btn_name.'" onclick="show_reject_reason_text_div(this)"><div class="reject_reason_text_div hide_section_class"><div class="Just-quickly-es"><div class="Just-quickly-l"><span>Oh, I see - any extra specifics you`d like us to know?</span></div></div><textarea class="Just-quickly-ky reject_reason_textarea_field"  name="'.$decline_option_other_btn_name.'" placeholder="Type your answer here..."></textarea></div>
			</li>
		</ul>	
		';
		$products_html .= '<div class="reject_reason hide_section_class">'.$html_reject_reason.'</div>';
		
		$products_html .= '</div>';
		$products_html .= ' <div class="error-section-div"></div>   '; 
		$products_html .= '</div>';
		
		$products_html .= '<div class="my-3 button-continue"><button  class="btn btn-sm btn-green next_section_show" type="button"> <span > <span class="">OK</span> </span> </button></div>';
		$products_html .= '</div>';
		$products_html .= '</div>';
		$products_html .= '</div>';
	}
	
@endphp

<div class="container">
   <section class="section pt-50">
      <div class="section-body">
         <div class="row">
            <div class="col-12">
              <form action="{{ url('/stylist/client/submit_selection')}}" method="post"  name="stylist_client_form">
					@csrf
					
					<input type="hidden" name="merchant_id" value="{{ $stylist_info->merchant_id}}">
					<input type="hidden" name="stylist_form_id" value="{{ $stylist_info->id}}">
					<input type="hidden" name="booking_id" value="{{ $booking_id }}">
					<input type="hidden" name="appointment_response_id" value="{{ $appointment_response_id }}">
                  <div class="p-0 ">
					
                     <div class="q-main q-active" style="display: block;" data-screen-name="video">
                        <div class="q-container">
                           <div class="section-header pb-50 text-center dappr-text-s">
                              <h3 style="margin-top:15px;">{{ $name }}</h3>
                           </div>
                           <div class="q-answer my-3">
                              <div class="section-body">
                                 <div class="w-75 text-center">
                                    <video width="800px" controls >
                                       <source src="{{ $video_url }}" type="video/mp4">
                                       <source src="{{ $video_url }}" type="video/ogg">
                                       Your browser does not support HTML video.
                                    </video>
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex button-continue"style="padding-left: 210px;">
                              <button class="btn btn-sm btn-green next_section_show" type="button">Continue</button>
                           </div>
                        </div>
                     </div>
                    
                   
                     <div class="q-main error-validate" data-error-validate="client_name" data-screen-name="name">
                        <div class="q-container">
                           <div class="Just-quickly-u">
                              <div class="Just-quickly-d">
                                 <div class="Just-quickly-es">
                                    <div class="Just-quickly-l">         <span>1.&nbsp;</span>                                                                <span>Just quickly, please type your full name*</span>                                             
                                    </div>
                                 </div>
                                 <input type="text" autocomplete="name" placeholder="Type your answer here..." name="client_name"  class="Just-quickly-ky " value="{{ $from_name }}" >
                                 <div class="error-section-div"></div>
                                 
                                 <div class="my-3 button-continue">
                                    <button  class="btn btn-sm btn-green next_section_show" type="button">
                                    <span class="">OK</span>                                                    
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                    <div class="q-main error-validate" data-error-validate="client_email"  data-screen-name="email">
                        <div class="q-container">
                           <div class="Just-quickly-u">
                              <div class="Just-quickly-d">
                                 <div class="Just-quickly-es">
                                    <div class="Just-quickly-l mx-n5">
                                       <span>2.&nbsp;</span>                                                        
                                    
                                       <span>And your email address *</span>                                            
                                    </div>
                                 </div>
                                 <input  type="email" autocomplete="email" placeholder="name@example.com" maxlength="256" name="client_email"  class="Just-quickly-ky" value="{{ $email }}">  
                                 <div class="error-section-div"></div>                                      
                                 <div data-qa-button-visible="true" class="my-3 button-continue">
                                    <button tabindex="0" class="ok-btn btn btn-sm btn-green next_section_show" type="button">
                                       <span class="">OK</span>                                                    
                                      
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                    
                     {!! $products_html  !!}
                    
                 
                  <div class="q-main" data-screen-name="last-screen">
                        <div class="q-container">
                           <div class="Just-quickly-u">
                              <div class="Just-quickly-d">
                                 <div class="Just-quickly-es">
                                    <div class=" dynamic_msg_section">
                                                                            
                                    </div>
                                 </div>
                                 
                                 <div data-qa-button-visible="true" class="my-3 button-continue">
                                    <button class="ok-btn btn btn-sm btn-green" type="button" onclick="type_form_submit(this)">
                                       <span class="">Submit</span>                                                    
                                       
                                    </button>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div> 
                   
                   
                  <div class="q-navigator">
                     <a href="javascript:void(0);" class="q-up q-disabled"><span><i class="fa fa-arrow-up"></i></span></a>
                     <a href="javascript:void(0);" class="q-down"><span><i class="fa fa-arrow-down"></i></span></a>
                  </div>
            </div>
           
         </div>
      </div>
</div>
</section>
</div>




@endsection
@section('scripts')
<script >
	
	function type_form_submit(obj){
		jQuery('form[name="stylist_client_form"]').submit();
		
	}
	
	jQuery(document).ready(function(){
		
	jQuery('.client_select_option_single .reject_select_prod').on('click',function(){
		jQuery(this).closest('.q-main').find('.reject_reason ').slideUp("slow");
		jQuery(this).closest('.q-main').find('.error-section-div').html('');
		jQuery(this).closest('.client_select_option_single').find('.reject_reason ').slideToggle("slow");
		
	});
	
	jQuery('.q-up').on('click',function(){
		jQuery('.q-main.q-active').removeClass('q-active').slideToggle("slow").prev().addClass('q-active').slideToggle("slow");
		screenPagination();
	});
	
	jQuery('.q-down').on('click',function(){
		jQuery('.q-main.q-active').find('.next_section_show').trigger('click');
		
	});
	
	jQuery(document).on('click','.next_section_show',function(){
		console.log("next_section_show call");
		var error_status = false;
		var parent_selector = jQuery(this).closest('.q-main');
		if(parent_selector.next().hasClass('q-main')){
			if(parent_selector.hasClass('error-validate')){
				if(parent_selector.attr('data-screen-name') == 'name'){
					error_status = type_form_name_screen_validate(parent_selector, this);
				}else if(parent_selector.attr('data-screen-name') == 'email'){
					error_status = type_form_email_screen_validate(parent_selector, this)
				}else if(parent_selector.attr('data-screen-name') == 'product'){
					error_status = type_form_product_screen_validate(parent_selector, this)
				}
				
				
				
				
				if(error_status){
					return false;
				}
				
			}
			
			type_form_scroll_top();
			
			jQuery(this).closest('.q-main').removeClass('q-active').hide();
			jQuery(this).closest('.q-main').next().addClass('q-active').show();
			screenPagination();
			
		}
		
        
	});
	
	});
	
	
	function type_form_name_screen_validate(parent_selector, obj){
		
		parent_selector.find('.error-section-div').html('');
		var error_status = false;
		var input_value = parent_selector.find('input[name="'+parent_selector.attr('data-error-validate')+'"]').val();
		if(input_value == ''){
			parent_selector.find('.error-section-div').html('<div class="alert alert-danger" role="alert" >Please Enter Name</div>');
			error_status = true;
		}
		return error_status;
		
	}
	
	function type_form_email_screen_validate(parent_selector, obj){
		
		parent_selector.find('.error-section-div').html('');
		var error_status = false;
		var input_value = parent_selector.find('input[name="'+parent_selector.attr('data-error-validate')+'"]').val();
		if(input_value == ''){
			parent_selector.find('.error-section-div').html('<div class="alert alert-danger" role="alert" >Please Enter Email</div>');
			error_status = true;
		}else if(!checkValidEmail(input_value)){
			parent_selector.find('.error-section-div').html('<div class="alert alert-danger" role="alert" >Please Enter a Valid Email</div>');
			error_status = true;
		}
		return error_status;
		
	}
	
	function type_form_product_screen_validate(parent_selector, obj){
	
		parent_selector.find('.error-section-div').html('');
		var error_status = false;
		var input_value = parent_selector.find('input[name="'+parent_selector.attr('data-error-validate')+'"]:checked').val();
				
		if(typeof input_value == 'undefined'){
			parent_selector.find('.error-section-div').html('<div class="alert alert-danger" role="alert" >Please Select option</div>');
			error_status = true;
		}
		
		if(!error_status && jQuery(parent_selector).hasClass('product_last_screen')){
			
			type_form_last_screen_validate();
		}
		
		
		return error_status;
		
	}
	
	
	
	
	function type_form_last_screen_validate(){
		
		var total_product = 0;
			var product_approve = 0;
			var product_alternative = 0;
			var product_decline = 0;
			jQuery('.q-main.products_screen').each(function(index,value){
				total_product++;
				var product_select_type = jQuery(this).find('input[name="'+jQuery(this).attr('data-error-validate')+'"]:checked').val();
				if(typeof product_select_type != 'undefined'){
					if(product_select_type == 'approve'){
						product_approve = product_approve+1;
					}else if(product_select_type = 'alternative'){
							product_alternative = product_alternative+1;
					}else if(product_select_type = 'decline'){
							product_decline = product_decline+1;
					}
				}
				
			});
			var msg = '';
			if(product_approve == 0){
				msg += "<span>Oh no - You don't like anything! Expect a call from us within 48hrs to get to the bottom of it.</span>";
			}else{
				msg += "";
			}
			
			if(total_product == product_approve){
					msg += "Nice one! You've approved "+total_product+" items";
			}
			
			if(total_product == product_decline){
				msg += "<span>Oh no - You don't like anything! Expect a call from us within 48hrs to get to the bottom of it.</span>";
			}
			
			msg += "<div >If you need to alter your choices, use arrow buttons in the bottom right hand corner of screen.</div>";
			
			if(product_approve == 0){
				msg += "<br><div class=''>Otherwise select Submit! </div>";
			}else{
				msg += "<div class=''>Otherwise, we'll will be redirecting to our payment page</div>";
			}
			
			jQuery('.dynamic_msg_section').html(msg);
	}
	
	function screenPagination(){
		
		jQuery('.q-main').each(function(key,value){
			
			if(jQuery(this).hasClass('q-active')){
				if(key == 0){
					jQuery('.q-navigator .q-up').addClass('q-disabled');
					if(jQuery('.q-main').length > 0){
						jQuery('.q-navigator .q-down').removeClass('q-disabled');
					}
					return false;
				}else if(jQuery('.q-main').length == (key + 1)){
					jQuery('.q-navigator .q-up').removeClass('q-disabled');
					jQuery('.q-navigator .q-down').addClass('q-disabled');
				}else{
					jQuery('.q-navigator .q-up').removeClass('q-disabled');
				}
			}
		});
	}
	
	function show_reject_reason_text_div(obj){
		var current_obj = jQuery(obj);
		
		if(current_obj.prop('checked')){
		
			current_obj.closest('li').find('.reject_reason_text_div ').show('slow');
		}else{
			
			current_obj.closest('li').find('.reject_reason_text_div ').hide('slow');
		}
		
	}
	
	function checkValidEmail(email){
		
			var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
			return regex.test(email);

	}
	
	function type_form_scroll_top( top = 0){
		jQuery([document.documentElement, document.body]).animate({
        scrollTop: top
    }, 100);
	}

</script>

@endsection
