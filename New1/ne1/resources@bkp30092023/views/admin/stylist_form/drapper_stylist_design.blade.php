@extends('admin.layouts.master')
@section('content')
@if(session('success'))
<link href="cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
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
<div class="box stf_outer_body">
   <div class="box-header with-border">
      <!-- <h3 class="box-title">Manage Stylist Form</h3>
         <div class="box-tools pull-right">
         	<a href="{{ url('admin/stylist/add') }}" class=" btn btn-new btn-flat">Add a New Form</a>

         </div> -->
      <div class="d-flex justify-content-center align-items-center">
         <div class="col-md-6">
            <div class="form">
               <i class="fa fa-search" style="top: 15px;"></i>
               <input type="text" class="form-control form-input-1 " style="border-radius: 7px !important;">
            </div>
         </div>
      </div>
      <!-- <input type="text" placeholder="Search.." name="search">
         <button type="submit"><i class="fa fa-search" style="padding:3px;"></i></button> -->
      <div>
         <div class="dropdown1 dropdown">
            <button onclick="myFunction(this)" class="dropbtn">Select <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i></button>
            <div id="myDropdown" class="dropdown-content">
               <a href="#home">Home</a>
               <a href="#about">About</a>
               <a href="#contact">Contact</a>
            </div>
         </div>
         <div class="dropdown">
            <button onclick="myFunction()" class="dropbtn">Task <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px; "></i></button>
            <div id="myDropdown" class="dropdown-content myDropdown">
               <a href="#home">Home</a>
               <a href="#about">About</a>
               <a href="#contact">Contact</a>
            </div>
         </div>
         <div class="dropdown myDropdown">
            <button onclick="myFunction()" class="dropbtn">Company <i class="fa fa-angle-down" aria-hidden="true" style="font-size:14px; margin-left:5px;"></i>
            </button>
            <div id="myDropdown" class="dropdown-content">
               <a href="#home">data</a>
               <a href="#about">About</a>
               <a href="#contact">Contact</a>
            </div>
         </div>
      </div>
   </div>
   <!-- /.box-header -->
   <div class="box-body stf_table_hide_serarch_bar">
      <table class="table table-hover table-no-sort table-bordered ">
         <tbody>
            <tr class="stf_outer_body_table_style articles">
               <th>
                  <h3>Profile</h3>
               </th>
               <th>
                  <h3>Name</h3>
               </th>
               <th>
                  <h3>Company</h3>
               </th>
               <th>
                  <h3>Task</h3>
               </th>
               <th>
                  <h3>Status</h3>
               </th>
               <th class="text-center">
                  <h3>Date Assigned</h3>
               </th>
               <th class="c-text-center-th" rowspan="1">
                  <h3>Action </h3>
               </th>
            </tr>
            <tr class="stf_outer_body_table_style">
               <th scope="row">
                  <div class="stf_outer_body_img">
                     <img src="https://www.gravatar.com/avatar/f82262222694aaf364eae2a611272f7b?s=30&d=mm " style="width: 100%;" alt="">
                  </div>
               </th>
               <td>Dappr</td>
               <td>Otto</td>
               <td>@quickinfgmail.com</td>
               <td><span class="badge badge-pill badge-warning text-warning-style">Warning</span></td>
               <td class="text-center"> 24/04/22</td>
               <td>
                  <div class="dropdown-drapp">
                     <a title="View Details" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/add/6"><i class="fa fa-solid fa-edit"></i></a>
                  </div>
               </td>
            </tr>
            <tr class="stf_outer_body_table_style">
               <th scope="row"><img src="https://www.gravatar.com/avatar/f82262222694aaf364eae2a611272f7b?s=30&d=mm " alt="" style="border-radius:500%"></th>
               <td>Dappr</td>
               <td>Otto</td>
               <td>@quickinfgmail.com</td>
               <td><span class="badge badge-pill badge-warning text-warning-style-two">Draft</span></td>
               <td class="text-center">24/04/22</td>
               <td>
                  <div class="dropdown-drapp">
                     <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                     <div class="dropdown-content-text">
                        <a class="btn btn-info" title="Edit" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/add/6"><i class="fa fa-solid fa-edit"></i></a>
                        <a class="btn btn-danger" title="Delete" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/delete/6"><i class="fa fa-solid fa-trash"></i> </a>
                        <a class="btn btn-info" title="Visit Page" href="http://192.168.0.102/chris/dappr-new/public/stylist/best-products-collection" target="_blank"><i class="fa-solid fa-eye fa"></i></a>
                     </div>
                  </div>
               </td>
            </tr>
            <tr class="stf_outer_body_table_style">
               <th scope="row"><img src="https://www.gravatar.com/avatar/f82262222694aaf364eae2a611272f7b?s=30&d=mm " alt="" style="border-radius:500%"></th>
               <td>Dappr</td>
               <td>Otto</td>
               <td>@quickinfgmail.com</td>
               <td><span class="badge badge-pill badge-warning">Draft</span></td>
               <td class="text-center">24/04/22</td>
               <td>
                  <div class="dropdown-drapp">
                     <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                     <div class="dropdown-content-text">
                        <a class="btn btn-info" title="Edit" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/add/6"><i class="fa fa-solid fa-edit"></i></a>
                        <a class="btn btn-danger" title="Delete" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/delete/6"><i class="fa fa-solid fa-trash"></i> </a>
                        <a class="btn btn-info" title="Visit Page" href="http://192.168.0.102/chris/dappr-new/public/stylist/best-products-collection" target="_blank"><i class="fa-solid fa-eye fa"></i></a>
                     </div>
                  </div>
               </td>
            </tr>
            <tr class="stf_outer_body_table_style">
               <th scope="row"><img src="https://www.gravatar.com/avatar/f82262222694aaf364eae2a611272f7b?s=30&d=mm " alt="" style="border-radius:500%"></th>
               <td>Dappr</td>
               <td>Otto</td>
               <td>@quickinfgmail.com</td>
               <td><span class="badge badge-pill badge-warning" style="background-color: #BA715B; padding: 5px 10px;">Warning</span></td>
               <td class="text-center">24/04/22</td>
               <td>
                  <div class="dropdown-drapp">
                     <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                     <div class="dropdown-content-text">
                        <a class="btn btn-info" title="Edit" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/add/6"><i class="fa fa-solid fa-edit"></i></a>
                        <a class="btn btn-danger" title="Delete" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/delete/6"><i class="fa fa-solid fa-trash"></i> </a>
                        <a class="btn btn-info" title="Visit Page" href="http://192.168.0.102/chris/dappr-new/public/stylist/best-products-collection" target="_blank"><i class="fa-solid fa-eye fa"></i></a>
                     </div>
                  </div>
               </td>
            </tr>
            <tr class="stf_outer_body_table_style">
               <th scope="row"><img src="https://www.gravatar.com/avatar/f82262222694aaf364eae2a611272f7b?s=30&d=mm " alt="" style="border-radius:500%"></th>
               <td>Dappr</td>
               <td>Otto</td>
               <td>@quickinfgmail.com</td>
               <td><span class="badge badge-pill badge-warning">Draft</span></td>
               <td class="text-center">24/04/22</td>
               <td>
                  <div class="dropdown-drapp">
                     <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                     <div class="dropdown-content-text">
                        <a class="btn btn-info" title="Edit" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/add/6"><i class="fa fa-solid fa-edit"></i></a>
                        <a class="btn btn-danger" title="Delete" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/delete/6"><i class="fa fa-solid fa-trash"></i> </a>
                        <a class="btn btn-info" title="Visit Page" href="http://192.168.0.102/chris/dappr-new/public/stylist/best-products-collection" target="_blank"><i class="fa-solid fa-eye fa"></i></a>
                     </div>
                  </div>
               </td>
            </tr>
            <tr class="stf_outer_body_table_style">
               <th scope="row"><img src="https://www.gravatar.com/avatar/f82262222694aaf364eae2a611272f7b?s=30&d=mm " alt="" style="border-radius:500%"></th>
               <td>Dappr</td>
               <td>Otto</td>
               <td>@quickinfgmail.com</td>
               <td><span class="badge badge-pill badge-warning">Draft</span></td>
               <td class="text-center">24/04/22</td>
               <td>
                  <div class="dropdown-drapp">
                     <span><i class="fa fa-ellipsis-v" aria-hidden="true"></i></span>
                     <div class="dropdown-content-text">
                        <a class="btn btn-info" title="Edit" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/add/6"><i class="fa fa-solid fa-edit"></i></a>
                        <a class="btn btn-danger" title="Delete" href="http://192.168.0.102/chris/dappr-new/public/admin/stylist/delete/6"><i class="fa fa-solid fa-trash"></i> </a>
                        <a class="btn btn-info" title="Visit Page" href="http://192.168.0.102/chris/dappr-new/public/stylist/best-products-collection" target="_blank"><i class="fa-solid fa-eye fa"></i></a>
                     </div>
                  </div>
               </td>
            </tr>
            <!-- @if($list->count() > 0)
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

               @endif -->
         </tbody>
      </table>
      <td colspan="6">
         {{ $list->links() }}
      </td>
   </div>
   <!-- /.box-body -->
</div>
<!-- /.box -->
<div class="container-fluid stf_outer_body">
   <div class="row">
      <div class="col-md-9">
         <div class='shadow line-container-1'>
            <div class="col-md-12 line-heading">
               <h4>Overview</h4>
            </div>
            </br>
            <div class='progress-line'>
               <div class='progress' style="width: 50%;">
               </div>
               <div class='status'>
                  <div class='dot completed'>
                  </div>
                  <p>Getting to</br> Know you</p>
               </div>
               <div class='status'>
                  <div class='dot completed'>
                  </div>
                  <p>15min call</p>
               </div>
               <div class='status'>
                  <div class='dot current'>
                  </div>
                  <p>Revels</p>
               </div>
               <div class='status'>
                  <div class='dot'>
                  </div>
                  <p>Feedback</p>
               </div>
               <div class='status'>
                  <div class='dot'>
                  </div>
                  <p>Return Period</p>
               </div>
               <div class='status'>
                  <div class='dot'>
                  </div>
                  <p>Complete</p>
               </div>
            </div>
         </div>
         <div class=" shadow px-4 mt-5">
            <div class="row">
               <div class="col-md-12">
                  <div class="Getting-dapp-dash d-flex m-2">
                     <span>
                        <b>Getting to know you</b>
                        <p class="ml-4">Completed on 22 January Stylish Brand</p>
                     </span>
                     <div class="dash-butn text-center mt-2">
                        <Span>View Response <i class="fas fa-angle-right"></i></Span>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="shadow px-4 mt-5">
            <div class="line-heading mb-3 articles">
               <h3>Items</h3>
            </div>
            <div class="row justify-content-md-center">
               <div class="align-self-center">
                  <div class="owl-dappr-slider ">
                     <div class="owl-carousel product-slider owl-theme">
                        <div class="item ">
                           <div class="img-product shadow rounded stf_delete_edit_product">
                              <img src="{{ url('images/stylist/delete-1.jpeg') }}" alt="" style="width: 100%;">
                           </div>
                           <div class="row button-slider">
                              <div class="col-md-8 articles product-slider-text-d">
                                 <h3>{client a}</h3>
                                 <h3>{Date}</h3>
                              </div>
                              <div class="col-md-4 button-drapp text-center ">
                                 <span>Send</span>
                              </div>
                           </div>
                        </div>
                        <div class="item ">
                           <div class="img-product shadow rounded stf_delete_edit_product">
                              <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           </div>
                           <div class="text-center button-slider ">
                              <div class=" text-center mt-3 ">
                                 <span>Name</span>
                                 <div class="button-drapp btn-warning text-center mt-3 ">
                                    <Span>Draft</Span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item ">
                           <div class="img-product shadow rounded stf_delete_edit_product">
                              <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                           </div>
                           <div class="text-center button-slider ">
                              <div class=" text-center mt-3 ">
                                 <span>Name</span>
                                 <div class="button-drapp text-center mt-3 ">
                                    <Span>Send</Span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item ">
                           <div class="img-product shadow rounded stf_delete_edit_product">
                              <img src="{{ url('images/stylist/delete-1.jpeg') }}" alt="" style="width: 100%;">
                           </div>
                           <div class="text-center button-slider ">
                              <div class=" text-center mt-3 ">
                                 <span>Name</span>
                                 <div class="button-drapp text-center mt-3 ">
                                    <Span>Send</Span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item ">
                           <div class="img-product shadow rounded stf_delete_edit_product">
                              <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           </div>
                           <div class="text-center button-slider">
                              <div class=" text-center mt-3 ">
                                 <span>Name</span>
                                 <div class="button-drapp text-center mt-3 ">
                                    <Span>Send</Span>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="item">
                           <div class="img-product shadow rounded stf_delete_edit_product">
                              <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                           </div>
                           <div class="text-center button-slider ">
                              <div class=" text-center mt-3 ">
                                 <span>Name</span>
                                 <div class="button-drapp text-center mt-3 ">
                                    <Span>Send</Span>
                                 </div>
                              </div>
                           </div>
                        </div>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="shadow px-4 mt-5">
            <div class="line-heading ">
               <h4>Overview</h4>
               <p>22 January Stylish Brand </p>
            </div>
            <div class="owl-dappr-slider">
               <ul class="nav nav-pills" role="tablist">
                  <li class="nav-item">
                     <a class="nav-link active" data-toggle="pill" href="#home">Home</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#menu1">Menu 1</a>
                  </li>
                  <li class="nav-item">
                     <a class="nav-link" data-toggle="pill" href="#menu2">Menu 2</a>
                  </li>
               </ul>
               <div class="tab-content">
                  <div id="home" class=" row tab-pane active">
                     <div class="col-md-2 img-product-1 ">
                        <div class="rounded">
                           <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                        </div>
                        <div class="articles">
                           <h3>{client a}</h3>
                           <h3>{Date}</h3>
                        </div>
                     </div>
                     <div class="col-md-2 img-product-1">
                        <div class="rounded">
                           <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                        </div>
                        <div class="articles">
                           <h3>{client a}</h3>
                           <h3>{Date}</h3>
                        </div>
                     </div>
                     <div class="col-md-2 img-product-1">
                        <div class="rounded">
                           <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                        </div>
                        <div class="articles">
                           <h3>{client a}</h3>
                           <h3>{Date}</h3>
                        </div>
                     </div>
                     <div class="col-md-2 img-product-1 ">
                        <div class="rounded">
                           <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                        </div>
                        <div class="articles">
                           <h3>{client a}</h3>
                           <h3>{Date}</h3>
                        </div>
                     </div>
                     <div class="col-md-2 img-product-1">
                        <div class="rounded">
                           <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                        </div>
                        <div class="articles">
                           <h3>{client a}</h3>
                           <h3>{Date}</h3>
                        </div>
                     </div>
                     <div class="col-md-2 img-product-1">
                        <div class="rounded">
                           <img src="{{ url('images/stylist/delete-3.jpeg') }}" alt="" style="width: 100%;">
                        </div>
                        <div class="articles">
                           <h3>{client a}</h3>
                           <h3>{Date}</h3>
                        </div>
                     </div>
                  </div>
                  <div id="menu1" class="row tab-pane fade">
                     <br>
                     <div class=" col-md-2 img-product-1 shadow ">
                        <div class="rounded">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                        </div>
                     </div>
                  </div>
                  <div id="menu2" class="tab-pane fade">
                     <br>
                     <div id="feedback_section">
                        <div class="card img-product shadow">
                           <!-- <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/dumy-img.jpg" alt=""> -->
                           <span class="img-product-pad">
                              <h3>Lorem ipsum dolor</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit saepe nihil quam dignissimos tempora incidunt ipsum minima deleniti magnam nobis nisi, qui, numquam totam reiciendis odit commodi velit provident harum!
                              </p>
                           </span>
                        </div>
                        <div class="card img-product shadow">
                           <!-- <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/dumy-img.jpg" alt=""> -->
                           <span class="img-product-pad">
                              <h3>Lorem ipsum dolor</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit saepe nihil quam dignissimos tempora incidunt ipsum minima deleniti magnam nobis nisi, qui, numquam totam reiciendis odit commodi velit provident harum!
                              </p>
                           </span>
                        </div>
                        <div class="card img-product shadow">
                           <!-- <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/dumy-img.jpg" alt=""> -->
                           <span class="img-product-pad">
                              <h3>Lorem ipsum dolor</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit saepe nihil quam dignissimos tempora incidunt ipsum minima deleniti magnam nobis nisi, qui, numquam totam reiciendis odit commodi velit provident harum!
                              </p>
                           </span>
                        </div>
                        <div class="card img-product shadow">
                           <!-- <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/dumy-img.jpg" alt=""> -->
                           <span class="img-product-pad">
                              <h3>Lorem ipsum dolor</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit saepe nihil quam dignissimos tempora incidunt ipsum minima deleniti magnam nobis nisi, qui, numquam totam reiciendis odit commodi velit provident harum!
                              </p>
                           </span>
                        </div>
                        <div class="card img-product shadow">
                           <!-- <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/dumy-img.jpg" alt=""> -->
                           <span class="img-product-pad">
                              <h3>Lorem ipsum dolor</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit saepe nihil quam dignissimos tempora incidunt ipsum minima deleniti magnam nobis nisi, qui, numquam totam reiciendis odit commodi velit provident harum!
                              </p>
                           </span>
                        </div>
                        <div class="card img-product shadow">
                           <!-- <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/dumy-img.jpg" alt=""> -->
                           <span class="img-product-pad">
                              <h3>Lorem ipsum dolor</h3>
                              <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit saepe nihil quam dignissimos tempora incidunt ipsum minima deleniti magnam nobis nisi, qui, numquam totam reiciendis odit commodi velit provident harum!
                              </p>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <!-- dapper -card -->
         <!-- <div class="items-dapper shadow px-4">
            <div class="line-heading mb-3">
            	<h4>Items</h4>

            </div>
            <div class="row">
            	<div class="col">
            	<div class="card img-product shadow ">
            				<img src="{{ url('images/dumy-img.jpg') }}" alt="">

            			</div>
            			<div class="text-center button-slider ">
            				<div class=" text-center mt-3 ">
            					<span>Name</span>
            				</div>
            				<div class="button-drapp btn-info text-center mt-3 ">

            					<Span>Send</Span>
            				</div>
            			</div>
            	</div>
            </div>

            </div> -->
      </div>
      <div class="col-md-3">
         <div class="dappr-box  align-items-center">
            <div class="card shadow align-card-dappr-box">
               <div class="card-dappr">
                  <div class="dappr-img-dash">
                     <img src="{{ url('images/dumy-img.jpg') }}" alt="">
                  </div>
                  <div class="person-info text-center mb-2 articles">
                     <h3>Emly Edo</h3>
                     <span><i class="far fa-star"></i></span>
                     <span><i class="far fa-star"></i></span>
                     <span><i class="far fa-star"></i></span>
                     <span><i class="far fa-star"></i></span>
                     <span><i class="far fa-star"></i></span>
                  </div>
                  <div class="button-drapp text-center ">
                     <Span>$23.44</Span>
                  </div>
                  <div class="text-center mt-2">
                     <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                        industry's standard dummy text ever since the 1500s
                     </p>
                  </div>
                  <div class="stf_close_btn">
                     <button class="btn"><i class="fa fa-close"></i> Pear</button>
                     <button class="btn"><i class="fa fa-close"></i> Blue</button>
                     <button class="btn"><i class="fa fa-close"></i> S</button>
                     <button class="btn"><i class="fa fa-close"></i> Green Eyes</button>
                     <button class="btn"><i class="fa fa-close"></i> Oval Face</button>
                     <button class="btn"><i class="fa fa-close"></i> Casual</button>
                  </div>
                  <div class="stf_add_tag_btn">
                     <a><i class="fa fa-plus"></i>Add a tag</a>
                  </div>
               </div>
            </div>
         </div>
         <div class="align-card-dappr-box-s card shadow  mt-5">
            <div class="card-dappr">
               <div class="line-heading-box-s articles">
                  <h3>Product Name</h3>
                  <h3>2 May 2022</h3>
                  <h5>{Product Name}</h5>
               </div>
               <div class="text-justify mt-2">
                  <h5>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the
                     industry's standard dummy text ever since the 1500s
                  </h5>
               </div>
               <div class="stf_add_tag_btn">
                  <a><i class="fa fa-plus"></i>Add a tag</a>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- <div class="stf_outer_body container-fluid mar-top-body ">
   <div class="row">
      <div class="col-md-12">
         <div class="shadow px-4">
            <div class="line-heading mb-3">
               <h4>Alternative</h4>
            </div>
            <div class="row disply_flex_div">
               <div class="col-md-11 mar-auto">
                  <div class="row just_content_space">
                     <div class="col_with">
                        <div class="line-heading mb-3">
                           <h4>Alternative Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_add_alertnative_item">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                              <div class="overlays">
                                 <a href="">
                                    <i class="fa fa-plus"></i>
                                 </a>
                              </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark text-center">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="line-heading mb-3">
                           <h4>Alternative Items2</h4>
                        </div>
                        <div class="img-product shadow rounded stf_add_alertnative_item">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark text-center">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="line-heading mb-3">
                           <h4>Alternative Items3</h4>
                        </div>
                        <div class="img-product shadow rounded stf_add_alertnative_item">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                              <div class="overlays">
                                 <a href="">
                                    <i class="fa fa-plus"></i>
                                 </a>
                              </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark text-center">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="line-heading mb-3">
                           <h4>Alternative Items4</h4>
                        </div>
                        <div class="img-product shadow rounded stf_add_alertnative_item">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                              <div class="overlays">
                                 <a href="">
                                    <i class="fa fa-plus"></i>
                                 </a>
                              </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark text-center">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="line-heading mb-3">
                           <h4>Alternative Items5</h4>
                        </div>
                        <div class="img-product shadow rounded stf_add_alertnative_item">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                              <div class="overlays">
                                 <a href="">
                                    <i class="fa fa-plus"></i>
                                 </a>
                              </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark text-center">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <button class="stf-save-btn-1" onclick="stfShowRevealsPage(this)"><i class="fa fa-arrow-left padding-right-2" aria-hidden="true"></i> Previous</button>
                     <span style="float: right;">
                     <button class="stf-save-btn stf-save-draf-btn btn-warning" onclick="stfSaveRevealsForm(this,'save')">Save as Draf</button>
                     <button class="stf-save-btn" onclick="stfSaveRevealsForm(this,'save')">Save</button>
                     <button class="stf-save-btn btn-info" onclick="stfSaveRevealsForm(this,'save_send')">Save &amp; Send</button>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div> -->
<!-- <section>
   <div class="stf_outer_body container-fluid mar-top-body ">
      <div class="row">
         <div class="modal fade stf_outer_body stf_modal_class" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Add Product</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="row shadow px-4">
                        <div class="col-md-4">
                           <div class="img-product-2 shadow rounded">
                              <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%; ">
                           </div>
                           <div style="padding: 15px 0px;">
                              <button class="stf-save-btn-2">Add</button>
                              <button class="stf-save-btn-3" style="float: right;">Cancel</button>
                           </div>
                        </div>
                        <div class="col-md-8">
                           <form>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Title</label>
                                 <div class="form-group-input-text">
                                    <p>Title</p>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">Brand</label>
                                 <div class="form-group-input-text">
                                    <p>Brand</p>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">price</label>
                                 <div class="form-group-input-text">
                                    <p>price</p>
                                 </div>
                              </div>
                              <div class="form-group">
                                 <label for="exampleInputEmail1">tags</label>
                                 <div class="form-group-input-text">
                                    <p>Tags</p>
                                 </div>
                              </div>
                           </form>
                        </div>
                     </div>
                  </div >
               </div>
            </div>
         </div>
      </div>
   </div>
   </section> -->
<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
   Launch demo modal
   </button>
   <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal-1">
   ADD PRODUCT MODAL
   </button> -->
<!-- Modal -->
<!-- <section >
   <div class="stf_outer_body container-fluid mar-top-body ">
      <div class="row">
         <div class="modal fade stf_outer_body stf_modal_class" id="exampleModal-1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
               <div class="modal-content">
                  <div class="modal-header">
                     <h4 class="modal-title" id="exampleModalLabel">Add Product</h4>
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                     </button>
                  </div>
                  <div class="modal-body">
                     <div class="search__container">
                        <input class="search__input" type="text" placeholder="Search">
                     </div>
                  </div>
                  <div class="search__container_body">

   		<ul class="list-group   stf_products_list_ul">
   			<li class="list-group-item d-flex justify-content-between align-items-center">
   				<div class="row search__container_hover" style="margin: 0px 19px;">
   					<div class="col-md-2 search__container_text">
   					   <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
   					</div>
   					<div class="col-md-10 ">
   					   <h4>Lorem ipsum dolor sit amet</h4>
   					</div>
   				 </div>
   			</li>
   			<li class="list-group-item d-flex justify-content-between align-items-center">
   				<div class="row search__container_hover" style="margin: 0px 19px;">
   					<div class="col-md-2 search__container_text">
   					   <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
   					</div>
   					<div class="col-md-10 ">
   					   <h4>Lorem ipsum dolor sit amet</h4>
   					</div>
   				 </div>
   			</li>
   			<li class="list-group-item d-flex justify-content-between align-items-center">
   				<div class="row search__container_hover" style="margin: 0px 19px;">
   					<div class="col-md-2 search__container_text">
   					   <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
   					</div>
   					<div class="col-md-10 ">
   					   <h4>Lorem ipsum dolor sit amet</h4>
   					</div>
   				 </div>
   			</li>
   			</ul>
                  </div>
                  <div class="modal-footer">
                     <button type="button" class="btn btn-secondary stf-modal-close-btn" data-dismiss="modal">Close</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </section> -->
<!-- <div class="stf_outer_body container-fluid mar-top-body ">
   <div class="row">
      <div class="col-md-12">
         <div class="shadow px-4">
            <div class="row disply_flex_div">
               <div class="col-md-12">
                  <div class="row just_content_space">
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                     <div class="col_with">
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-trash"></i>
                              </a>
                              <a href="#" class="btn btn-light padding-0 shadow">
                              <i class="fa fa-edit"></i>
                              </a>
                           </div>
                        </div>
                        <div class="row line-heading-align-items">
                           <div class="col-md-10 line-heading-img">
                              <h4>Product Name</h4>
                              <span class="text-dark ">
                                 <p><strong>Price</strong> $25</p>
                              </span>
                           </div>
                           <div class=" col-md-2 line-heading-img-btn">
                              <a><i class="fa fa-plus"></i></a>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div  >
                     <button class="stf-save-btn-1" ><i class="fa fa-arrow-left padding-right-2" aria-hidden="true"></i> Previous</button>
                     <button class="stf-save-btn"style="float: right;">Save</button>


                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div> -->
<!-- <div class="stf_outer_body container-fluid mar-top-body ">
   <div class="row">
      <div class="col-md-12">
         <div class="shadow-border px-4">
            <div class="row disply_flex_div">
               <div class="col-md-4 ">
                  <div class="col-md-3 ">
                    <div style="display: flex;">
                       <div class="col-md-8 stf_outer_calender shadow">
                       <a href=""><i class="fa fa-calendar" aria-hidden="true"></i></a>
                          <a href=""><i class="fas fa-calendar-alt"></i></a>
                          <a href=""> <i class="fa fa-user"></i></i></a>
                       </div>
                    </div>
                  </div>
                  <div class="col-md-9 shadow"style="padding: px;">
                     <div class="stf_outer_Font"font-family:>
                        <h1>Calendar</h1>
                     </div>
                     <div id='calendar'></div>
                  </div>
               </div>
               <div class="col-md-8 .stf_outer_body mar-auto shadow">
                  <div class="stf_outer_Font_to">
                     <div class="row"style="display: flex;justify-content: flex-end;align-items: center; padding-right: 3%;">
                        <h3>Hello Fran!</h3>
                        <div class="stf_outer_img_style"> <img src="{{ url('images/stylist/delete-2.jpg') }}" alt=""  style="width: 100%;"></div>
                          <div>
                          <span class="fa-stack fa-3x" data-count="28">
                              <i class="fa fa-circle fa-stack-2x"></i>
                              <i class="far fa-bell fa-stack-1x fa-inverse"></i>
                           </span>
                          </div>
                     </div>
                  </div>
                     <div id='calendargrid'></div>
               </div>
            </div>
         </div>
      </div>
   </div>
   </div> -->
<!--
   <div class="stf_outer_body container-fluid mar-top-body ">
      <div class="row">
         <div class="col-md-12">
            <div class="shadow px-4">
               <div class="line-heading-tow mb-3">
                  <div class="line-heading mb-3">
                     <h4>Reveal</h4>
                     <p class="ml-4">Create new reveals and alter saved</p>
                  </div>
                  <span >
                     <a class="stf_add_tag_btn_item">
                     <span><i class="fa fa-plus"></i>Add a Item</span>
                     </a>
                  </span>
               </div>
               <div class="row">
                  <div class="col-md-6 stf_add_tag_item_margin">
                   <div class="stf_outer_nodata">
                     <h1>No Any Reveals Created</h1>
                     <h3>Click to  create "Reval"</h3>
                    <div class="em-and">
                    <a class="stf_add_tag_btn_items">
                        <i class="fa fa-plus"></i>
                        </a>
                    </div>
                   </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div> -->
<!-- <div class="articles">
   <h3>Click to  create "Reval"</h3>
   </div>

      <div class="btn button-drapps-red-bor text-center ">
         <span>DRAFT</span>
      </div>

      <div class="btn button-drapps-green-bor text-center ">
         <span>DRAFT</span>
      </div> -->
<!-- ================================================================================================== -->



<div class="stf_outer_body  mar-top-body ">
   <div class="row">
      <div class="m-5">
         <ul class="text-nowrap line-heading-tow-style ">
            <li class="pr-5">
               <a class="menu-link" href="#">
                  <i class="fa fa-solid fa-circle pr-2"></i>
                  <span style="font-weight: 600;"> STEP 1 </span>ADD PRODUCTS
               </a>
            </li>
            <li class="pr-5">
               <a class="menu-link" href="#">
                  <i class="far fa-circle"></i>
                  <span style="font-weight: 600;"> STEP 2 </span>ADD PRODUCTS
               </a>
            </li>
            <li class="pr-">
               <a class="menu-link" href="#">
                  <i class="far fa-circle"></i>
                  <span style="font-weight: 600;"> STEP 3 </span>ADD PRODUCTS
               </a>
            </li>
         </ul>
      </div>
      <div class=" ">
         <div class="col-md-11 m-auto">
            <div class="row just_content_space">
               <div class="col-md-2 col-sm-6">
                  <div class="line-heading mb-3">
                     <h4>Items1</h4>
                  </div>
                  <div class="img-product shadow rounded stf_delete_edit_product">
                     <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                     <div class="overlay">
                        <a href="#" class="btn btn-light padding-0 ">
                           <i class="fa fa-trash"></i>
                        </a>
                     </div>
                  </div>
                  <div class="line-heading-1">
                     <h4>Product Name</h4>
                     <span class="text-dark ">
                        <p><strong>Price</strong> $25</p>
                     </span>
                  </div>
               </div>
               <div class="col-md-2 col-sm-6">
                  <div class="line-heading mb-3">
                     <h4>Items1</h4>
                  </div>
                  <div class="img-product shadow rounded stf_delete_edit_product">
                     <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                     <div class="overlay">
                        <a href="#" class="btn btn-light padding-0 ">
                           <i class="fa fa-trash"></i>
                        </a>
                     </div>
                  </div>
                  <div class="line-heading-1">
                     <h4>Product Name</h4>
                     <span class="text-dark ">
                        <p><strong>Price</strong> $25</p>
                     </span>
                  </div>
               </div>
               <div class="col-md-2 col-sm-6">
                  <div class="line-heading mb-3">
                     <h4>Items1</h4>
                  </div>
                  <div class="img-product shadow rounded stf_delete_edit_product">
                     <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                     <div class="overlay">
                        <a href="#" class="btn btn-light padding-0 ">
                           <i class="fa fa-trash"></i>
                        </a>
                     </div>
                  </div>
                  <div class="line-heading-1">
                     <h4>Product Name</h4>
                     <span class="text-dark ">
                        <p><strong>Price</strong> $25</p>
                     </span>
                  </div>
               </div>
               <div class="col-md-2 col-sm-6">
                  <div class="line-heading mb-3">
                     <h4>Items1</h4>
                  </div>
                  <div class="img-product shadow rounded stf_delete_edit_product">
                     <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                     <div class="overlay">
                        <a href="#" class="btn btn-light padding-0 ">
                           <i class="fa fa-trash"></i>
                        </a>
                     </div>
                  </div>
                  <div class="line-heading-1">
                     <h4>Product Name</h4>
                     <span class="text-dark ">
                        <p><strong>Price</strong> $25</p>
                     </span>
                  </div>
               </div>
               <div class="col-md-2 col-sm-6">
                  <div class="line-heading mb-3">
                     <h4>Items1</h4>
                  </div>
                  <div class="img-product shadow rounded stf_delete_edit_product">
                     <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                     <div class="overlay">
                        <a href="#" class="btn btn-light padding-0 ">
                           <i class="fa fa-trash"></i>
                        </a>
                     </div>
                  </div>
                  <div class="line-heading-1">
                     <h4>Product Name</h4>
                     <span class="text-dark  ">
                        <p><strong>Price</strong> $25</p>
                     </span>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->
<div class="stf_outer_body ">
   <div class="row">
      <div class="col-md-12 action_btn_section">
         <span><a href=""> Previous</a>
            <a href=""> Next</a> </span>
         <a href="">
            <div class="action_btn_section-b">SAVE & CONTINUE LATER</div>
         </a>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->
<div class="stf_outer_body mar-top-body ">
   <div class="row">
      <div class="col-md-12 m-auto">
         <div class="position-relative">
            <div class="line-container-t">
               <div class="progress-line-i">
                  <div class="progress">
                  </div>
                  <div class="status ">
                     <div class="dot completed">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 1 </span>ADD PRODUCTS</p>
                  </div>
                  <div class="status">
                     <div class="dot completed">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 2 </span>UPLOAD VIDEO</p>
                  </div>
                  <div class="status">
                     <div class="dot current">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 3 </span>REVIEW AND SUBMIT</p>
                  </div>
               </div>
            </div>
            <div class="row disply_flex_div">
               <div class="col-md-11 m-auto">
                  <div class="row just_content_space">
                     <div class="col-md-2">
                        <!-- <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div> -->
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                  </div>
                  <div class="row just_content_space">
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                     <div class="col-md-2">
                        <div class="line-heading mb-3">
                           <h4>Items1</h4>
                        </div>
                        <div class="img-product shadow rounded stf_delete_edit_product">
                           <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                           <div class="overlay">
                              <a href="#" class="btn btn-light padding-0 ">
                                 <i class="fa fa-trash"></i>
                              </a>
                           </div>
                        </div>
                        <div class="line-heading-1">
                           <h4>Product Name</h4>
                           <span class="text-dark ">
                              <p><strong>Price</strong> $25</p>
                           </span>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="position-absolute-style top-0 end-0">
               <a href=""><span>&#8594;</span></i></a>
               <br>
               <span>
                  0<strong>STEP 2 </strong></br> UPLOAD VIDEO
               </span>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->
<div class="stf_outer_body ">
   <div class="row">
      <div class="col-md-12 action_btn_section-two">
         <a href="">SAVE & CONTINUE LATER </a>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->
<div class="stf_outer_body mar-top-body ">
   <div class="row">
      <div class="col-md-12 m-auto">
         <div class="position-relative">
            <div class="line-container-t">
               <div class="progress-line-i">
                  <div class="progress" style="width: 50%;">
                  </div>
                  <div class="status ">
                     <div class="dot completed">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 1 </span>ADD PRODUCTS</p>
                  </div>
                  <div class="status">
                     <div class="dot completed">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 2 </span>UPLOAD VIDEO</p>
                  </div>
                  <div class="status">
                     <div class="dot current">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 3 </span>REVIEW AND SUBMIT</p>
                  </div>
               </div>
            </div>
            <div class="row disply_flex_div">
               <div class="col-md-11 m-auto">
                  <div class="row just_content_space-t ">
                     <div class="col-md-4 my-5">
                        <div class="stf_delete_edit_product-video1">
                           <video width="100%" controls>
                              <source src="mov_bbb.mp4" type="video/mp4">
                              <source src="mov_bbb.ogg" type="video/ogg">
                              Your browser does not support HTML video.
                           </video>
                           <!-- <a href="">
                              <p>UPLOAD VIDEO</p>
                           </a> -->
                        </div>
                            <div class="stf_outer_body ">
                                <div class="col-md-12 stf_outer_padding">
                                    <a href="javascript:void(0)" onclick="strTriggerByInputName('reveal_video_update')" class=" action_btn_section-two">REUPLOAD VIDEO</a>
                                </div>
                            </div>
                     </div>
                  </div>
               </div>
            </div>

            <!-- ************************************* -->

            <div class="row disply_flex_div">
               <div class="col-md-11 m-auto">
                  <div class="row just_content_space-t ">
                     <div class="col-md-4 my-5">
                        <div class="stf_delete_edit_product-video">
                           <!-- <video width="100%" controls>
                           <source src="mov_bbb.mp4" type="video/mp4">
                           <source src="mov_bbb.ogg" type="video/ogg">
                           Your browser does not support HTML video.
                        </video> -->
                           <a href="">
                              <p>UPLOAD VIDEO</p>
                           </a>
                        </div>
                        <!-- <div class="stf_outer_body ">
                           <div class="col-md-12 action_btn_section-two">
                              <a href="">REUPLOAD VIDEO</a>
                           </div>
                        </div> -->
                     </div>
                  </div>
               </div>
            </div>

            <!-- ************************************* -->

            <div class="position-absolute-styles top-0 end-0">
               <a href=""><span>&#8594;</span></i></a>
               <br>
               <span>
                  0<strong>STEP 2 </strong></br> UPLOAD VIDEO
               </span>
            </div>
            <div class="position-absolute-styles-2 top-0 end-0">
               <a href=""><span>&#8592;</span></i></a>
               <br>
               <span>
                  0<strong>STEP 1 </strong></br> UPLOAD VIDEO
               </span>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->
<div class="stf_outer_body ">
   <div class="row">
      <div class="col-md-12 action_btn_section-two">
         <a href="">SAVE & CONTINUE LATER </a>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->
<div class="stf_outer_body mar-top-body ">
   <div class="row">
      <div class="col-md-12 m-auto">
         <div class="position-relative">
            <div class="line-container-t">
               <div class="progress-line-i">
                  <div class="progress" style="width: 50%;">
                  </div>
                  <div class="status ">
                     <div class="dot completed">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 1 </span>ADD PRODUCTS</p>
                  </div>
                  <div class="status">
                     <div class="dot completed">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 2 </span>UPLOAD VIDEO</p>
                  </div>
                  <div class="status">
                     <div class="dot current">
                     </div>
                     <p class="text-nowrap"> <span style="font-weight: 600;"> STEP 3 </span>REVIEW AND SUBMIT</p>
                  </div>
               </div>
            </div>
            <div class="row disply_flex_div">
               <div class="col-md-11 m-auto">
                  <div class="row " style="margin: 40px 0px;">
                     <div class="col-md-8 ">
                        <div class="row just_content_space ">
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="{{ url('images/stylist/delete-2.jpg') }}" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="row just_content_space ">
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                           <div class="col-md-2">
                              <div class="line-heading mb-3">
                                 <h4>Items1</h4>
                              </div>
                              <div class="img-product shadow round-style stf_delete_edit_product">
                                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                                 <a href="#">
                                    <div class="overlay-edit-btn">
                                       <p> EDIT PRODUCT </p>
                                    </div>
                                 </a>
                              </div>
                              <div class="line-heading-1">
                                 <h4>Product Name</h4>
                                 <span class="text-dark ">
                                    <p><strong>Price</strong> $25</p>
                                 </span>
                              </div>
                           </div>
                        </div>
                     </div>
                     <div class="col-md-4 ">
                        <div class="stf_delete_edit_product-video-2">
                           <video width="100%" controls>
                              <source src="mov_bbb.mp4" type="video/mp4">
                              <source src="mov_bbb.ogg" type="video/ogg">
                              Your browser does not support HTML video.
                           </video>
                        </div>

                        <div class="stf_outer_body ">
                           <div class="col-md-12 action_btn_section-two">
                              <a href="">REUPLOAD VIDEO</a>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
            <div class="position-absolute-styles-2 top-0 end-0">
               <a href=""><span>&#8592;</span></i></a>
               <br>
               <span>
                  0<strong>STEP 1 </strong></br> UPLOAD VIDEO
               </span>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->
<div class="stf_outer_body container-fluid ">
   <div class="row">
      <div class="col-md-12 action_btn_section-two">
         <a href="">SAVE & CONTINUE LATER </a>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">
   UPLOAD NEW PRODUCT
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document">
      <div class=" col-md-5 m-auto modal-content">
         <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">UPLOAD NEW PRODUCT</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body modal-body-style">
            <h5 class="modal-title text-center" id="exampleModalLongTitle">UPLOAD NEW PRODUCT</h5>

            <div class="row my-5">
               <div class="col-md-6 text-center modal-dialog-font-siz my-5">
                  <a href="">
                     <!-- <i class="fa fa-upload" aria-hidden="true"></i> --> <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/Manual Upload.png" alt="" style="width: 20%;">
                  </a>
                  <h4>Manual <br>Upload</h4>
               </div>
               <div class="col-md-6 text-center modal-dialog-font-siz my-5">
                  <a href="">
                     <!-- <i class="fa fa-upload" aria-hidden="true"></i> --> <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/Upload VIA URL.png" alt="" style="width: 20%;">
                  </a>
                  <h4>Manual <br>Upload</h4>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- ================================================================================================== -->

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter1">
   UPLOAD YOUR IMAGE
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter1" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle1" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document">
      <div class=" col-md-5 m-auto modal-content">
         <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">UPLOAD NEW PRODUCT</h5> -->
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body modal-body-style">
            <h5 class="modal-title text-center" id="exampleModalLongTitle">UPLOAD YOUR IMAGE</h5>

            <div class="row my-5">
               <div class="col-md-12 text-center modal-dialog-font-siz my-5">
                  <h5>PNG and JPEG files allowed</h5>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter2">
   ADD PRODUCT
</button>

<!-- Modal -->
<div class="modal fade stf_outer_body" id="exampleModalCenter2" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle2" aria-hidden="true">
   <div class="modal-dialog modal-dialog-centered modal-dialog-style" role="document">
      <div class=" col-md-11 col-sm-12 m-auto modal-content">
         <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLongTitle">UPLOAD NEW PRODUCT</h5> -->
            <button type="button" class="close close-b-style" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body modal-body-style">


            <div class="row my-5">
               <h5 class="modal-title modal-title-add-pro" id="exampleModalLongTitle">ADD PRODUCT</h5>
               <div class="col-md-4 text-center modal-dialog-img-style  my-5">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-1.jpeg" alt="" style="width: 100%;">
                  <a href="#">
                     <div class="overlay-edit-btn">
                        <p> EDIT PRODUCT</p>
                     </div>
                  </a>
               </div>
               <div class="col-md-8  my-5 ">
                  <form>
                     <div class="mb-md-3 my-sm-3 add-pro-input">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                     </div>
                     <div class="my-3 add-pro-input">
                        <label for="exampleInputEmail1" class="form-label">Brand</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                     </div>
                     <div class="my-3 add-pro-input">
                        <label for="exampleInputEmail1" class="form-label">Description</label>
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                     </div>
                     <div class="my-3 add-pro-input">
                        <label for="exampleInputEmail1" class="form-label">Material</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                     </div>
                     <div class="my-3 add-pro-input">
                        <label for="exampleInputEmail1" class="form-label">Care</label>
                        <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                     </div>


                     <div class="row my-5 modal-content-between">
                        <button type="submit" class="btn btn-primary add-btn-prod">ADD PRODUCT</button>
                        <button type="submit" class="btn btn-primary add-btn-prod">CANCEL</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!--====================================================================== 20-07-2022 ====================================================================== -->


<div class="sidenav sidenav-filter-menu">
   <span>FILTER</span>
   <button class="dropdown-btn">Category
      <i class="fa fa-caret-down"></i>
   </button>
   <div class="dropdown-container">
      <a href="#">Category 1</a>
      <a href="#">Category 2</a>
      <a href="#">Category 3</a>
   </div>
   <button class="dropdown-btn">Colour
      <i class="fa fa-caret-down"></i>
   </button>
   <div class="dropdown-container">
      <a href="#">Colour 1</a>
      <a href="#">Colour 2</a>
      <a href="#">Colour 3</a>
   </div>
   <button class="dropdown-btn">Brand
      <i class="fa fa-caret-down"></i>
   </button>
   <div class="dropdown-container">
      <a href="#">Brand</a>
      <a href="#">Brand 2</a>
      <a href="#">Brand 3</a>
   </div>
   <button class="dropdown-btn">Size
      <i class="fa fa-caret-down"></i>
   </button>
   <div class="dropdown-container">
      <a href="#">Size 1</a>
      <a href="#">Size 2</a>
      <a href="#">Size 3</a>
   </div>
   <!-- <a href="#contact">Search</a> -->
</div>


<div class="main stf_outer_body ">
   <div class="stf-add-new-product d-flex">
      <div class="col-md-11 m-auto">
         <div class="row ">
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
               </div>
               <div class="line-heading-1">
                  <h4>Add new product</h4>
               </div>
            </div>
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
               </div>
               <div class="line-heading-1">
                  <h4>Add new product</h4>
               </div>
            </div>
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                  <a href="#">
                     <div class="overlay-add-new-btn">
                        <p> EDIT PRODUCT</p>
                     </div>
                  </a>
               </div>
               <div class="line-heading-1">
                  <div class="row">
                     <div class="col-md-8">
                        <h4>Product Name</h4>
                        <span class="text-dark ">
                           <p><strong>Price</strong> $25</p>
                        </span>
                     </div>
                     <div class="col-md-4 stf-add-new-product-plus-btn">
                        <a href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                  <a href="#">
                     <div class="overlay-add-new-btn">
                        <p> EDIT PRODUCT</p>
                     </div>
                  </a>
               </div>
               <div class="line-heading-1">
                  <div class="row">
                     <div class="col-md-8">
                        <h4>Product Name</h4>
                        <span class="text-dark ">
                           <p><strong>Price</strong> $25</p>
                        </span>
                     </div>
                     <div class="col-md-4 stf-add-new-product-plus-btn">
                        <a href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                  <a href="#">
                     <div class="overlay-add-new-btn">
                        <p> EDIT PRODUCT</p>
                     </div>
                  </a>
               </div>
               <div class="line-heading-1">
                  <div class="row">
                     <div class="col-md-8">
                        <h4>Product Name</h4>
                        <span class="text-dark ">
                           <p><strong>Price</strong> $25</p>
                        </span>
                     </div>
                     <div class="col-md-4 stf-add-new-product-plus-btn">
                        <a href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                  <a href="#">
                     <div class="overlay-add-new-btn">
                        <p> EDIT PRODUCT</p>
                     </div>
                  </a>
               </div>
               <div class="line-heading-1">
                  <div class="row">
                     <div class="col-md-8">
                        <h4>Product Name</h4>
                        <span class="text-dark ">
                           <p><strong>Price</strong> $25</p>
                        </span>
                     </div>
                     <div class="col-md-4 stf-add-new-product-plus-btn">
                        <a href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                  <a href="#">
                     <div class="overlay-add-new-btn">
                        <p> EDIT PRODUCT</p>
                     </div>
                  </a>
               </div>
               <div class="line-heading-1">
                  <div class="row">
                     <div class="col-md-8">
                        <h4>Product Name</h4>
                        <span class="text-dark ">
                           <p><strong>Price</strong> $25</p>
                        </span>
                     </div>
                     <div class="col-md-4 stf-add-new-product-plus-btn">
                        <a href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
            </div>
            <div class="col-md-3 px-2">
               <div class="img-product shadow round-style stf_delete_edit_product">
                  <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-2.jpg" alt="" style="width: 100%;">
                  <a href="#">
                     <div class="overlay-add-new-btn">
                        <p> EDIT PRODUCT</p>
                     </div>
                  </a>
               </div>
               <div class="line-heading-1">
                  <div class="row">
                     <div class="col-md-8">
                        <h4>Product Name</h4>
                        <span class="text-dark ">
                           <p><strong>Price</strong> $25</p>
                        </span>
                     </div>
                     <div class="col-md-4 stf-add-new-product-plus-btn">
                        <a href=""><i class="fa fa-plus" aria-hidden="true"></i></a>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- alpana code here -->
<section id="form-personal">
   <div class="container-fluid">
      <h4>Let’s get personal </h4>
      <form action="/action_page.php">
         <div class="form-group">
            <label for="email">Where do you work ?</label>
            <input type="email" class="form-control form_input" placeholder="Enter company name" id="email">
         </div>


         <div class="form-group">
            <label for="pwd">Where your's position ?</label>
            <input type="password" class="form-control form_input" placeholder="Enter your Position name" id="pwd">
         </div>
         <div class="form-group">
            <label for="pwd"> Where are your career aspirations ?</label>
            <input type="password" class="form-control form_input" placeholder="Enter Your goals" id="pwd">
         </div>

      </form>

      <!-- <button class="btn btn-primary btn-lg">Save & Continue Later</button> -->


   </div>
</section>

<section id="colors_apperance">
   <div class="container-fluid">
      <h4>TELL US ABOUT YOUR APPEARANCE </h4>
      <p>To ensure we respectfully communicate with you & build an authentic wardrobe that represents you  </p>
      <h4 class="apperance-heading">Hair Colour</h4>

      <div class="row product_check">
         <div class="col-md-2">
            <div class="product_box ">
               <div class="product_img_box active">
                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-3.jpeg">
               </div>
               <h6 class="text-center">Black</h6>
            </div>

         </div>
      </div>

      <div class="row product_check">
         <div class="col-md-2">
            <div class="product_box-overlay ">
               <div class="product_img_box active">
                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-3.jpeg">
               </div>
               <h6 class="text-center">Black</h6>
            </div>

         </div>

         <div class="col-md-2">
            <div class="product_box-overlay ">
               <div class="product_img_box">
                 <img src="http://192.168.0.102/chris/dappr-new/public/images/stylist/delete-3.jpeg">
               </div>
               <h6 class="text-center">Black</h6>
            </div>

         </div>
      </div>







      <div class="row">
         <div class="col-md-2">
            <div class="color_box appearance-color-bx1 active " >

            </div>
            <h6 class="text-center">Black</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx2" >

            </div>
            <h6 class="text-center">Dark Brown</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx3" ></div>
            <h6 class="text-center">Light Brown</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx4" ></div>
            <h6 class="text-center">Blonde</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx5" ></div>
            <h6 class="text-center">Auburn</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx6" ></div>
            <h6 class="text-center">Ginger</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx7" ></div>
          <h6 class="text-center">Grey</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx8" ></div>
            <h6 class="text-center">white</h6>
         </div>
         <div class="col-md-2">
            <div class="color_box appearance-color-bx9" ></div>
            <h6 class="text-center">White</h6>
         </div>
      </div>
   </div>
</section>

<section id="Submit_colors">
   <div class="container-fluid">
      <h4>Let’s get personal </h4>
      <form action="/action_page.php">
         <div class="form-group">
            <label for="email">Please tell us what colour best describe your skin tone. </label>
            <input type="email" class="form-control form_input" placeholder="Type your answer here…" id="email">
         </div>

      </form>
      <!-- <button class="btn btn-primary btn-lg">Save & Continue Later</button> -->


   </div>
</section>
<div class="pagination-next">
   <div class="row">
   <div class="col-md-12 action_btn_section-two">

<ul class="pagination justify-content-center mb-5">
         <li class="page-item page_group"><a class="page-link" href="javascript:void(0);">Previous</a></li>
         <li class="page-item page_group"><a class="page-link" href="javascript:void(0);">1</a></li>
         <!-- <li class="page-item"><a class="page-link pagination__arrow-half " href="javascript:void(0);"></a></li> -->
         <li class="page-item page_group"><a class="page-link" href="javascript:void(0);">2</a></li>
         <li class="page-item page_group"><a class="page-link" href="javascript:void(0);">Next</a></li>
      </ul>
      </div>
   </div>

   </div>

<div class="stf_outer_body container-fluid ">
   <div class="row">
      <div class="col-md-12 action_btn_section-two">
         <a href="">SAVE &amp; CONTINUE LATER </a>
      </div>
   </div>
</div>







<script>
   var dropdown = document.getElementsByClassName("dropdown-btn");
   var i;

   for (i = 0; i < dropdown.length; i++) {
      dropdown[i].addEventListener("click", function() {
         this.classList.toggle("active");
         var dropdownContent = this.nextElementSibling;
         if (dropdownContent.style.display === "block") {
            dropdownContent.style.display = "none";
         } else {
            dropdownContent.style.display = "block";
         }
      });
   }
</script>

@endsection
@section('page-style')
<link rel="stylesheet" href="//use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
<!-- OwlCarousel cdnlink -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" integrity="sha512-KXkS7cFeWpYwcoXxyfOumLyRGXMp7BTMTjwrgjMg0+hls4thG2JGzRgQtRfnAuKTn2KWTDZX4UdPg+xTs8k80Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
@endsection
@section('page-script')
@include('admin.stylist_form.common')
<script src="jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.js" integrity="sha512-o0rWIsZigOfRAgBxl4puyd0t6YKzeAw9em/29Ag7lhCQfaaua/mDwnpE2PVzwqJ08N7/wqrgdjc2E0mwdSY2Tg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
<script>
   $(document).ready(function() {
      $('#calendar').fullCalendar({
         weekends: false, // will hide Saturdays and Sundays
      });
      var $fc = $("#calendargrid");

      var options = { // Create an options object

         header: {
            right: 'prev,title,next'
         },
         eventBackgroundColor: 'transparent',
         eventBorderColor: '#08c',
         eventTextColor: 'black',
         height: 'auto',
         allDaySlot: false,
      }
      $fc.fullCalendar(options);
   });


   // jQuery(document).ready(function() {
   // 	$('.owl-carousel').owlCarousel({
   // 		loop: true,
   // 		margin: 10,
   // 		nav: true,
   // 		autoplay: true,
   // 		autoplayTimeout: 3000,
   // 		autoplayHoverPause: true,



   // 	})
   // 	$('.product-slider').owlCarousel({
   // 		responsive: {
   // 			0: {
   // 				items: 1
   // 			},
   // 			600: {
   // 				items: 5
   // 			},
   // 			1000: {
   // 				items: 5
   // 			}
   // 		}
   // 	});
   // });


   $(document).ready(function() {
      $(".owl-carousel").owlCarousel({
         autoplay: true,
         margin: 10,
         autoplayTimeout: 3000,
         items: 4,
         itemsDesktop: [1199, 3],
         itemsDesktopSmall: [979, 3],
         center: true,
         nav: true,
         loop: true,
         responsive: {
            0: {
               items: 1
            },
            600: {
               items: 3
            },
            1000: {
               items: 3
            }
         }

      });
   });

   function myFunction() {
      document.getElementById("myDropdown").classList.toggle("show");
   }


   window.onclick = function(event) {
      if (!event.target.matches('.dropbtn')) {
         var dropdowns = document.getElementsByClassName("dropdown-content");
         var i;
         for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
               openDropdown.classList.remove('show');
            }
         }
      }
   }
</script>
@endsection
