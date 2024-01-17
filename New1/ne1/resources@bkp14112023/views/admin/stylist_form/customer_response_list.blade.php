@extends('admin.layouts.master')

@section('content')
	@if(session('success'))
		<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-dismissible fade show">
			{{session('success')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	 @endif
	 @if(session('error'))
		<div class="alert {{ Session::get('alert-class', 'alert-info') }} alert-danger  fade show">
			{{session('error')}}
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
			</button>
		</div>
	 @endif
	<div class="box">
	    <div class="box-header with-border">
	      <h3 class="box-title">Manage Customer Response Form</h3>
	    
	    </div>
		 <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-no-sort">
	        <thead>
	        <tr>
	          <th>#</th>
	          <th>Name</th>
	          <th>Email</th>
	          <th class="c-text-align-center">Details</th>
	          <th class="c-text-align-center">Date</th>
	          
	        </tr>
	        </thead>
	        <tbody>
				
			
		       @if($list->count() > 0)
                                            @foreach($list as $key=>$info)
                                            @php
												$html = '';
												
												if(isset($html_array[$info->id])){
													$html = $html_array[$info->id];
												}
                                            @endphp
                                                <tr>
                                                    <td scope="row" class="checkbox-cell"> {{ ($list->currentpage()-1) * $list->perpage() + $key + 1 }} </td>
                                                    <td> {{ $info->name }} </td>
                                                    <td> {{ $info->email }} </td>
                                                   <td> {!! $html !!} </td>
                                                   <td> {{ $info->updated_at  }} </td>
                                                  

                                                </tr>
                                            @endforeach
                                        @else
                                           
                                        @endif

                                      
		       
	        </tbody>
	      </table>
	      {{ $list->links() }}
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection

@section('page-script')
@endsection
@section('page-style')
<style>
.prod_detail_items {     overflow: auto;    height: 200px;}
.prod_detail_item {    text-align: left;    border-bottom: 1px solid #555555;    padding-left: 15px;}
p.stylist_form_name {    border-bottom: 1px solid #555555;    text-align: left;    padding-bottom: 9px;    font-size: 16px;}
#DataTables_Table_0 .c-text-align-center {       text-align: center !important;}
</style>
 
@endsection
