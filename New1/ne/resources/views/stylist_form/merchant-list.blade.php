@extends('theme::layouts.main')
@section('content')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<style>
.dappr-img{
width: 150px;
  height: 150px;  
  border-radius: 50%;
  margin: auto;
  overflow: hidden;
  border: 2px solid white;
  
}
.dappr-img:hover{
  border: 1px solid #848484;
  transition: 1s;
  
}
.btn-my-style {   
  background-color: white;
  padding: 2px 23px 5px 23px;
  border-radius: 101px;
  text-align: center;
  border: 2px solid green;
  color: green;
}
.btn-my-style:hover {
   background-color: #848484;    
  border: 2px solid #848484;
  color: white;

}
.dappr-text-h{
border-bottom: 2px solid #84848430;
}
.dappr-text-h h3{
   font-weight: 600;
  font-size: 28px;
  line-height: 38px;
  text-transform: capitalize;
  font-family: Arimo,sans-serif;
  text-align: center;

}
.dappr-text-h2 h3{
   font-weight: 600;
  font-size: 18px;
  line-height: 38px;
  text-transform: capitalize;
  font-family: Arimo,sans-serif;
  text-align: left;
}
a
.card{
   box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}
.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
.t-flot{
   float: right;
   margin-top: 15px;
}
.form-control:focus,.btn-primary:focus,.btn-primary:active:focus {
  box-shadow: none;
}

.booking_appointment_list_section,.hide_marchant_list_section{display:none}
.show_merchant_booking_section{display:block}
.booking_appointment_list_section .invalid-feedback{display:block}
</style>
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
     <div class="card  my-5">
     <div class="row p-4">
         <div class="col-md-12 pb-3 mb-5 dappr-text-h">
            <h3>Our Stylist List</h3>
         </div>
         
         @php
         $html = '';
         if($merchants_obj->isNotEmpty()){
			foreach($merchants_obj as $merchant_obj){
			 $profile_img_url = url('images/stylist/dummy-profile-pic.png');
			 if(isset($images_array[$merchant_obj->id]))	{
				 $profile_img_url = url('image/'.$images_array[$merchant_obj->id]);
			 }
			 $html  .= '<div class="col-md-3 my-2 merchant_item">';
			 $html  .= '	<div class="dappr-img ">';
			 $html  .= '<img  data-qa-loaded="true" src="'.$profile_img_url.'"class="m-auto d-block">';
			 $html  .= '	</div>';
			 $html  .= '<div class="text-center my-3">';
			 $html  .= '<strong><h6>'.$merchant_obj->name.'</h6></strong>';
			 $html  .= '<strong><h6>'.$merchant_obj->email.'</h6></strong>';
			 $html  .= '<button class="btn-my-style" type="submit" onclick="type_form_booking_form(this,'.$merchant_obj->id.')">Book Appointment</button>';
			 $html  .= '</div>';
			 $html  .= ' </div> ';
			}
		 }else{
			 $html = '<div class="no_data text-center">No Any Stylist found</div>';
		 }
         @endphp
         {!!  $html !!}        
      </div>
     </div>
   </div>
</section>
<section class="booking_appointment_list_section section_class {{ $class_form }}" >
	
<div class="container">
   <div class="card m-auto w-75 my-5">
      <div class="col-md-12 pt-3 pb-2s dappr-text-h">
         <h3>Appointment Details</h3>
      </div>
     
      
      <div class="row">
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
            </br>
            <div class="form-group d-flex align-items-center">
               <label for="email">Email:</label>
               <input type="email" class="form-control ml-5" id="email" placeholder="Enter Email" name="email" value="{{ old('email') }}">
             
            </div>  
              @error('email')
					<span class="invalid-feedback" role="alert">
						<strong>{{ $message }}</strong>
					</span>
				@enderror 
            </br>
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

@endsection

@section('scripts')
<script>
function type_form_booking_form(obj, merchant_id = 0){
	var current_obj = jQuery(obj);
	var parent_selector = current_obj.closest('.section_class');
	parent_selector.hide();
	parent_selector.next().show();
	jQuery('.booking_appointment_list_section').find('input[name="merchant_id"]').val(merchant_id);
	type_form_scroll_top();
}

function type_form_scroll_top( top = 0){
		jQuery([document.documentElement, document.body]).animate({
        scrollTop: top
    }, 100);
	}
</script>
@endsection



