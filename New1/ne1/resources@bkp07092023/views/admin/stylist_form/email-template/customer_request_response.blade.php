<div class="modal-dialog modal-md  stf_reveal_send_email_template">
   <div class="modal-content">
      <form method="POST" action="#" id="form"  name="stf_send_mail_to_client">
         @csrf
         
         <input type="hidden" name="booking_id" value="{{ $booking_id }}">
          <input type="hidden" name="reveal_id" value="{{ $reveal_id }}">
         
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            Send Response 
         </div>
         <div class="modal-body">
         	<div class="stf_success_error_div"></div>
         
			
            <div class="col-md-12 nopadding-left">
				<div class="col-md-12 nopadding-left">
					<div class="form-group">
					   <label for="action_text">Select Email Template</label>
					   <div class="input-group"  >
						   <select class="form-control" required="" name="selected_email_template" onchange="stf_select_email_template(this)">
								<option value="">Select</option>
								 @if($email_template_list)
									@foreach($email_template_list as $email_template_info)
										<option value="{{ $email_template_info->id }}">{{$email_template_info->name }}</option>
									@endforeach
							   @endif
						   </select>
						    <div class="help-block with-errors"></div>
					   </div>
					</div>
				</div>
				
				
			</div>
			<div class="form-group" style="">
               <label for="body" class="with-help">Subject*</label>
               <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Add ** bothside of important keyword to highlight"></i>
              <input class="form-control" placeholder="Enter email subject" required="" name="subject" type="text" id="subject" required="">
            </div>
			<div class="form-group body_html" style="">
               <label for="body" class="with-help">Body*</label>
               <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" title="Add ** bothside of important keyword to highlight"></i>
               <textarea class="form-control summernote-long" placeholder="Enter email body" rows="2" required="" name="body" cols="50" id="body"></textarea>
               <div class="help-block with-errors"></div>
            </div>
            
           
            
            <p class="help-block">* Required fields.</p>
         </div>
         <div class="modal-footer">
            <input class="btn btn-flat btn-new" type="button" value="Send" onclick="stfRevealSendToCustomer(this)">
         </div>
      </form>
   </div>
   <!-- / .modal-content -->
</div>
