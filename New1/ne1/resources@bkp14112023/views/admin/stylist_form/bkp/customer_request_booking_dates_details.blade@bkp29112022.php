@extends('admin.layouts.master')

@section('content')




<div class="stf_outer_body container-fluid mar-top-body stf_outer_page_load " style="display:none">
   <div class="row">
      <div class="col-lg-12">
         <div class="shadow-border px-4">
            <div class="row disply_flex_div">
               <div class="col-md-3 ">                  
                  <div class="col-md-12 shadow"style="padding: px;">
                     <div class="stf_outer_Font"font-family:>
                        <h1>Calendar</h1>
                     </div>
                     <div id='booking_calendar_left_side' class="booking_calendar_left_side booking_calendar_outer"></div>
                  </div>
               </div>
               <div class="col-md-9 .stf_outer_body mar-auto shadow">
                  <div class="stf_outer_Font_to d-none">
                     <div class="row"style="display: flex;justify-content: flex-end;align-items: center; padding-right: 3%;">
                        <h3>Hello {{Auth::user()->getName() }}</h3>
                        <div class="stf_outer_img_style"> <img src="{{ url('images/stylist/dummy-profile-pic.png') }}" alt=""  style="width: 100%;"></div>
                        <div>
                           <span class="fa-stack fa-3x" data-count="28">
                           <!-- <i class="fa fa-circle fa-stack-2x"></i> -->
                           <i class="far fa-bell fa-stack-1x fa-inverse"></i>
                           </span>
                        </div>
                     </div>
                  </div>
				  
                  <div class='booking_calendar_grid booking_calendar_outer' ></div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
	
	
	
	


	
@endsection

@section('page-style')

<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.3/css/all.css" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />


@endsection

@section('page-script')
@include('admin.stylist_form.common');

 <script  src="//cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" ></script>
<script>	
    jQuery(document).ready(function () {
	
		var booking_calendar_left_side =  jQuery('#booking_calendar_left_side');
		  booking_calendar_left_side.fullCalendar({
			//weekends: false, // will hide Saturdays and Sundays
			 header: {right: 'prev,next'},
		  });
		 
		 
		  var booking_calendar_grid = jQuery(".booking_calendar_grid");

		  var options = { // Create an options object
			   header: {right: 'prev,title,next'},
			//    defaultView: 'month',
			// locale: 'es',
			   eventBackgroundColor: 'transparent',
			   slotEventOverlap:true,
			//    eventBorderColor: '#08c',
			   eventTextColor: 'black',
			   height: 'auto',
			   allDaySlot: false,
			   editable: true,			  
			   	events: @php echo json_encode($data['booked_list']); @endphp,
				color: 'yellow',   // an option!
				textColor: 'black', // an option!,
				viewDisplay: function (view) {
					console.log('alert view display');
				},
				eventRender: function (event,element){ 
                    console.log('alert render event');
            },
		   }
			booking_calendar_grid.fullCalendar(options);
	
	stfShowEventsHtml();
	jQuery(document).on('click','.booking_calendar_grid .fc-prev-button span,.booking_calendar_grid .fc-next-button span',function(){
		console.log(' booking_calendar_grid click')
		stfShowEventsHtml();
		
	});
	
	jQuery(document).on('click','.booking_calendar_left_side .fc-prev-button span, .booking_calendar_left_side  .fc-next-button span',function(){
		console.log('booking_calendar_left_side click')
		if(jQuery(this).closest('button').hasClass('fc-prev-button')){
			jQuery('.booking_calendar_grid .fc-prev-button span').trigger('click');
		}else{
			jQuery('.booking_calendar_grid .fc-next-button span').trigger('click');
		}
		// stfShowEventsHtml();
		
	});

	
});

function stfShowEventsHtml(){
	
	jQuery('table tr td.fc-event-container').each(function(){
		
		var text = jQuery(this).find('.fc-content').text();
		jQuery(this).find('.fc-content').html(text);
	});
	jQuery(window).trigger('resize');
}
</script>

@endsection

