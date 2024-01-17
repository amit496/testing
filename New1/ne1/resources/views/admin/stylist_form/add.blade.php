@extends('admin.layouts.master')

@section('content')


<div class="white-box">

<form action="{{ url('admin/stylist/add')}}" method="post"  enctype="multipart/form-data">
	@csrf
	<input type="hidden" name="id" value="{{ old('id') }}">
 <div class="row">
	  <div class="col-md-6 form-group c-w-50">
    <label for="name">Enter Name</label>
    <input type="text" class="form-control" name="name"  id="name" placeholder="Enter Name" value="{{ old('name') }}">
  </div>
  <div class="col-md-6 form-group c-w-50">
	   <label for="slug">Slug</label>
    <input type="text" class="form-control" name="slug"  id="slug" placeholder="Enter Name of slug" value="{{ old('slug') }}">
  </div>
 </div>
   
  
  <div class="form-group col-md-6 ">
    <label for="response_file">Upload Vedio</label>
    <input type="file" name="response_vedio" class="form-control-file" id="response_vedio" >
      @php 
		
		if(old('video_name') != ''){
			$video_url =  url('').'/uploads/'.old('video_name');
		echo '<div class="video_section_div">
			<input type="hidden" name="video_url" value="'.$video_url.'">
			<video width="200" height="150" controls><source src="movie.mp4" type="video/mp4"><source src="'.$video_url.'" type="video/ogg"></video>
			</div>';
		}
	@endphp		
  </div>
  
  <div class="form-group col-md-6 ">
    <label for="status">Status</label>
    <select class="form-control" id="status" name="status">
      <option value="1" @if(old('status') == '1') selected @endif >Yes</option>
      <option value="0" @if(old('status') == '0') selected @endif >No</option>
    </select>
  </div>
  
  
  
	    <div class="col-sm-12 my-5 select_prodcuts_outger_div">
			
            <div class="col-sm-6 select_prodcuts_div">
               <h4 class="">Select Products</h4>
              <a data-link="{{ url('admin/stylist/products_list_modal') }}" class="ajax-modal-btn btn btn-new btn-flat" >Add more product</a>
               <div class="w-100 overflow-auto" style="height: 200px;overflow: auto;">
                  <ul class="list-group">
					   @if($products->isNotEmpty())
					    @php 
							$selected_product_html = '';
							$selected_product_section_show_hide = 'none';
							$product_ids_array = array();
							if(old('product_ids') != ''){

								if(is_array(old('product_ids'))){
									$product_ids_array = old('product_ids');
								}else{
									$product_ids_array = explode(',',old('product_ids'));
								}
								$selected_product_section_show_hide = 'block';
							}
					    @endphp
							@foreach($products as $product)
							   @php 
									$product_selected = '';
									if(in_array($product->id,$product_ids_array)){
										$product_selected = ' checked';
										
										$selected_product_html .= '<li class="list-group-item d-flex justify-content-between align-items-center"  for="select_prod_li_{{ $product->id }}" data-prod-id="'.$product->id.'" >'.$product->name.'<input '.$product_selected.' type="checkbox" name="product_ids[]" value="'.$product->id.'" data-prod-name = "'.$product->name.'" o id="select_prod_li_'.$product->id.'"></li>';
										
										
									}
									$html = '<li class="list-group-item d-flex justify-content-between align-items-center"  for="select_prod_li_{{ $product->id }}" data-prod-id="'.$product->id.'" >'.$product->name.'<input '.$product_selected.' type="checkbox" name="select_products[]" value="'.$product->id.'" data-prod-name = "'.$product->name.'" onclick="select_product(this)"  id="select_prod_li_'.$product->id.'"></li>';
									echo $html;
							   @endphp
							 
							@endforeach
						@else
							<span>No any product found</span>	
						@endif
                     
                    
                  </ul>
               </div>
            </div>
            <div class="col-sm-6 selected_prodcuts_div" style="display:@php $selected_product_section_show_hide; @endphp">
               <h4 class="">Selected Products</h4>
               <div class="w-100 overflow-auto" style="height: 200px;overflow: auto;">
                  <ul class="list-group">
                     @php  
						echo $selected_product_html; 
                     @endphp
                  </ul>
               </div>
            </div>
         </div>
         
		 <div class="col-sm-12 ">
  
  
			<button type="submit" class="btn btn-primary">Save</button>
			</div>
</form>
</div>
@endsection

@section('page-style')
<style>
	.selected_prodcuts_div ul li input{ display:none}
	.select_prodcuts_div ul li input{float: right;    margin-left: 24px;}
	.video_section_div{margin-top:10px;}
	.white-box {background: #fff;padding: 25px;margin-bottom: 15px;box-shadow: 0 2px 10px lightgrey; float:left}
	.c-w-50{width: 50%;}
	.white-box-t{background: #fff;padding: 25px;margin-bottom: 15px;box-shadow: 0 2px 10px lightgrey;}
	.select_prodcuts_outger_div{    border: 1px solid #222d32;    margin-bottom: 20px;    padding-bottom: 28px;}
</style>
@endsection
@section('page-script')
@include('admin.stylist_form.common');


<script>
jQuery(document).ready(function(){
	jQuery('input[name="response_vedio"]').on('change',function(){
		jQuery('.video_section_div').remove();
	});
});

function select_product(obj){
	var current_obj = jQuery(obj);
	var prod_id = current_obj.val();
	var prod_name = current_obj.attr('data-prod-name');
	var selected_obj = jQuery('.selected_prodcuts_div ul.list-group');
	if(current_obj.prop('checked')){
		var html = '<li class="list-group-item d-flex justify-content-between align-items-center" data-prod-id="'+prod_id+'">'+prod_name+'<input type="checkbox" name="product_ids[]" value="'+prod_id+'" checked></li>';
		selected_obj.append(html);
	}else{
		selected_obj.find('input[type="checkbox"][value="'+prod_id+'"]').closest('li').remove();
	}
	if(selected_obj.find('li').length == 0){
		jQuery('.selected_prodcuts_div').hide();
	}else{
		jQuery('.selected_prodcuts_div').show();
	}
}

</script>
 
@endsection
