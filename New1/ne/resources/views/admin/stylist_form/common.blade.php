
<script src="{{ url('/js/stylist-form-custom.js?').rand(10,1000) }}"></script>
<link href="{{ url('/css/backend-stylist-form.css?').rand(10,1000) }}" rel="stylesheet">
<script>
var dapper_base_url = '{{   url('')  }}';
</script>

<!-- Modal -->
<div class="modal fade stf_outer_body mar-top-body stf_modal_class" id="stf_custom_details_modal" tabindex="-1" role="dialog" aria-labelledby="stf_custom_details_modal" aria-hidden="true">
  
</div>


<div class="modal fade stf_outer_body mar-top-body stf_modal_class" id="stf_save_product_video_modal" tabindex="-1" role="dialog" aria-labelledby="stf_save_product_video_modal" aria-hidden="true">
   <div class="modal-dialog"><div class=" modal-content">
	    <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          <span aria-hidden="true">×</span>
	        </button>
	    </div>
	    <div class="modal-body modal-body-style">
	    	  <h5 class="modal-title text-center">Would You like to save as a draft	</h5>
	    	  <div class="row my-5 modal-content-between">
            	  <button type="button" class="btn btn-primary add-btn-prod" onclick="stfsaveNotsaveTabsOfAddProductsAndVideoScreen()">Yes</button>
            	  <button type="button" class="btn btn-primary add-btn-prod" onclick="stfShowRevealsPage(this,'Y');" data-dismiss="modal" aria-label="Close">No</button>
              </div>
	    </div>
	</div>
</div>

