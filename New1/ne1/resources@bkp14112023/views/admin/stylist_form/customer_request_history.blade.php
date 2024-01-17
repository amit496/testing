<div class="modal-dialog modal-md">
   <div class="modal-content">
     
         
         
         
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
            View Hitory
         </div>
         <div class="modal-body">
			
           
				 @php 
				   $html = '';
					if($history->isNotEmpty()){
						$ic = 0;
						foreach($history as $history_info)
                        {
							$ic++;
							$display_list = "block";
							if($ic == 1){
								$display_list = "block";
							}
							$stylist_form_name = '';
							if($history_info->StylistForm ){
								$stylist_form_name = $history_info->StylistForm->name;
							}
							
							$html .= '<div class="box">
										<div class="box-header with-border">
										  <h3 class="box-title"><i class="fa-solid fa-envelope fa"></i>  '.$stylist_form_name.' ( '.$history_info->created_at.' )</h3>
										  <div class="box-tools pull-right">
											 <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											 <button type="button" class="btn btn-box-tool" style="display:none" data-widget="remove"><i class="fa fa-remove"></i></button>
										  </div>
										</div>
										<div class="box-body" style="display: '.$display_list.';">
										  <h4>Subject: '.$history_info->subject.'</h4>
										  <pre>'.$history_info->body.'</pre>
										</div>
										</div>';
						}
					}
				@endphp
			{!! $html !!}
         </div>
      </form>
   </div>
   <!-- / .modal-content -->
</div>
