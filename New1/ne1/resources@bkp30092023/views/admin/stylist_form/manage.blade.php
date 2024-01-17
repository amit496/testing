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
	      <h3 class="box-title">Manage Stylist Form</h3>
	      <div class="box-tools pull-right">
				<a href="{{ url('admin/stylist/add') }}"  class=" btn btn-new btn-flat">Add a New Form</a>
	      </div>
	    </div> <!-- /.box-header -->
	    <div class="box-body">
	      <table class="table table-hover table-no-sort">
	        <thead>
	        <tr>
	          <th>#</th>
	          <th>Name</th>
	          <th>Slug</th>
	          <th>Status</th>
	          <th>Date</th>
	         
	          <th>Action </th>
	         
	        </tr>
	        </thead>
	        <tbody>
				
			
		       @if($list->count() > 0)
                                            @foreach($list as $key=>$info)
                                                <tr>
                                                    <td scope="row" class="checkbox-cell"> {{ ($list->currentpage()-1) * $list->perpage() + $key + 1 }} </td>
                                                    <td> {{ $info->name }} </td>
                                                    <td> {{ $info->slug }} </td>
                                                    
                                                    <td>

                                                            @if($info->status)
                                                               <a href="{{ url($action_base_url.'/update/id/'.$info->id, ['status',0]) }}">
                                                               <span class="badge bg-label-primary me-1">Active</span>
                                                            @else
                                                               <a href="{{ url($action_base_url.'/update/id/'.$info->id, ['status',1]) }}">
                                                            <span class="badge bg-label-warning me-1">Inactive</span>
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td> {{ $info->updated_at }} </td>

                                                    <td> {{ $info->code }} </td>

                                                    <td>
                                                    <a class="btn btn-info" title="Edit" href="{{ url($action_base_url.'/add', $info->id) }}"><i class="fa fa-solid fa-edit"></i></a>
                                                     <a class="btn btn-danger" title="Delete" href="{{ url($action_base_url.'/delete/'.$info->id) }}"><i class="fa fa-solid fa-trash"></i> </a>
                                                     <a class="btn btn-info" title="Visit Page" href="{{ url('stylist/'.$info->slug) }}" target="_blank"><i class="fa-solid fa-eye fa"></i></a>

                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            
                                        @endif

                                        
		       
	        </tbody>
	      </table>
	      <td colspan="6">
                                                {{ $list->links() }}
                                            </td>
	    </div> <!-- /.box-body -->
	</div> <!-- /.box -->
@endsection

@section('page-script')
 
@endsection
