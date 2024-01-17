{{-- @extends('admin.layouts.master')

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
	 @endif --}}
{{-- 
@php
    $company_name = '';
    $physical_address = '';
    $primary_contact = '';
    $primary_email= '';
    $primary_direct_phone_number= '';
    $secondary_phone_number= '';
    $secondary_email= '';
    $secondary_direct_phone_number= '';
    $workplace_dress_policy_file= '';
    $workplace_dress_upto_date= '';
    $workplace_dress_communication= '';
    $diversity_inclusion_policy= '';
    $diversity_inclusion_policy_file= '';
    $diversity_inclusion_policy_upto_date= '';
    $currently_poor_staff_description= '';
    $percentage_of_emp_believe='';
    $scenario_for_men='';
    $scenario_for_women='';
    $scenario_for_other='';
    $appropriate_germents_description='';
    $client_facing_team_members='';
    $more_casual='';
    $impression_description='';
    $vision_statement='';
    $vision_statement_file='';
    $vision_statement_description='';
    $additional_info='';
    $additional_info_file='';
    $additional_info_description='';
    $hope_description='';
    $additional_amount_status='';

    if(isset($db_data)){
       $company_name = $db_data->company_name;
       $physical_address = $db_data->physical_address;
       $primary_contact = $db_data->primary_contact;
       $primary_email = $db_data->primary_email;
       $primary_direct_phone_number = $db_data->primary_direct_phone_number;
       $secondary_phone_number = $db_data->secondary_contact;
       $secondary_email = $db_data->secondary_email;
       $secondary_direct_phone_number = $db_data->secondary_direct_phone_number;
       $workplace_dress_policy_file = '';
       $workplace_dress_upto_date = '';
       $workplace_dress_communication = '';
       $diversity_inclusion_policy = '';
       $currently_poor_staff_description="";
       $scenario_for_men="";
       $scenario_for_women="";
       $scenario_for_other="";
       $appropriate_germents_description="";
       $client_facing_team_members="";
       $more_casual="";
       $impression_description="";
       $vision_statement="";
       $vision_statement_file="";
       $vision_statement_description="";
       $additional_info="";
       $additional_info_file="";
       $additional_info_description="";
       $hope_description="";
       $additional_amount_status="";


    }
@endphp

<div class="box stf_outer_body stf_side_bar_not_hide">


            <ul class="nav nav-tabs">
                <li class="nav-item active">
                  <a class="nav-link " data-toggle="pill" href="#company_information">Company Information</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#current_professional">Current Professional Image & Personal Branding</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#image_presentation">Image Presentation Requirements</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" data-toggle="pill" href="#service_accounting">Service & Accounting Requirements</a>
                </li>
            </ul> --}}

            <!-- Tab panes -->
            {{-- <form method="post" action="{{route('admin.employer-onboarding-questionnaire-store')}}" enctype="multipart/form-data"> --}}
                {{-- @method('PUT') --}}
                {{-- @csrf
                <input type="hidden" name="edit_id"  value="{{$edit_id}}" > --}}
                {{-- {{$edit_id die}} --}}
            {{-- <div class="tab-content form-tab">

                    <div class="tab-pane active" id="company_information"> --}}
                        <!-- <form class="row"> -->
                            {{-- <div class="form-group col-md-6">
                                <label for="company_name">Company Name </label>
                                <input type="text" class= "form-control" placehlder="Company Name"  name="company_name" value="{{ $company_name; }}">

                                @error('company_name')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label >Physical address</label>
                                <input type="text" class= "form-control"  placehlder="Physical address" name="physical_address" value="{{ $physical_address; }}">
                                @error('physical_address')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group col-md-4">
                                <label >Primary Contact </label>
                                <input type="number" class= "form-control" name="primary_contact" placeholder="Primary Contact " value="{{ $primary_contact; }}" >
                                @error('primary_contact')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label >Primary Email  </label>
                                <input type="text" class= "form-control"  placeholder="Email" name="primary_email" value="{{$primary_email}}">
                                @error('primary_email')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label >Primary phone number  </label>
                                <input type="number" class= "form-control" name="primary_direct_phone_number"   placeholder="Primary phone number" value="{{$primary_direct_phone_number}}">
                                @error('primary_direct_phone_number')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label>Secondary Contact   </label>
                                <input type="number" class= "form-control" name="secondary_phone_number"  placeholder="Secondary Contact " value="{{$secondary_phone_number}}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label>Secondary Email  </label>
                                <input type="text" class= "form-control"  placeholder="Email" name="secondary_email" value="{{$secondary_email}}">
                                @error('secondary_email')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label >Secondary phone number  </label>
                                <input type="number" class= "form-control" name="secondary_direct_phone_number"   placeholder="Direct phone number" value="{{$secondary_direct_phone_number}}" >
                                @error('secondary_direct_phone_number')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <a href="#current_professional"  data-toggle="pill" onclick="toggleTabPill(this,'current_professional')" class="btn btn-primary btn-lg">Next</a>
                            </div> --}}
                        <!-- </form> -->
                    {{-- </div>
                    <div class="tab-pane fade" id="current_professional"> --}}
                        <!-- <form class="row"> -->
                            {{-- <div class="row">
                                <div class="form-group col-md-4">
                                    <label >  Do you currently have a workplace  dress policy?</label>
                                    <div class="form-check"> --}}
                                        {{-- <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="workplace_dress_policy" value="{{$field_data[$vl->name] = $vl->value;}}";  @if(old('workplace_dress_policy') == 1 || old('workplace_dress_policy',NULL) == NULL) checked @endif onclick="toggleRadioButtonDressPolicy(this)">Yes
                                        </label> --}}
                                        {{-- <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="workplace_dress_policy" value="1"  @if (isset($field_data['workplace_dress_policy']) && ($field_data['workplace_dress_policy'] == 1) )
                                            checked
                                            @endif  onclick="toggleRadioButtonDressPolicy(this)">Yes
                                        </label>
                                    </div>
                                    <div class="form-check"> --}}
                                        {{-- <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="workplace_dress_policy" value="0" value="{{$field_data[$vl->name] = $vl->value;}}"; @if(old('workplace_dress_policy',NULL) != NULL && old('workplace_dress_policy') == 0) checked @endif onclick="toggleRadioButtonDressPolicy(this)">No
                                        </label> --}}

                                        {{-- <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="workplace_dress_policy" value="0"  @if (isset($field_data['workplace_dress_policy']) && ($field_data['workplace_dress_policy'] == 0) ) checked @endif onclick="toggleRadioButtonDressPolicy(this)">No
                                        </label>
                                        @error('workplace_dress_policy')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="form-group col-md-4 dress-policy-yes @if(old('workplace_dress_policy') == 1 || old('workplace_dress_policy',NULL) == NULL) '' @else d-none @endif" id="workplace_dress_policy_file">
                                    <div class="form-group">
                                        <label >Choose workplace dress policy attachment</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="file" class="form-check-input" name="workplace_dress_policy_file"   >
                                                <input type="hidden" class="form-check-input"  name="workplace_dress_policy_file"  value="{{$workplace_dress_policy_file}}" >
                                                <span>

                                                    @if ('uploads/stylist/'.$field_data['workplace_dress_policy_file'])

                                                      <img src="{{url('uploads/stylist/'. $field_data['workplace_dress_policy_file'])}}"   alt="" srcset="" style="width: 100px">

                                                    @endif
                                                </span>
                                                @error('workplace_dress_policy_file')
                                                <div class="error">
                                                    {{$message}}
                                                </div>
                                                @enderror
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group col-md-4 dress-policy-yes @if(old('workplace_dress_policy') == 1 || old('workplace_dress_policy',NULL) == NULL) '' @else d-none @endif">
                                    <label >Is this policy current and up to date?</label>
                                    <div class="form-check"> --}}
                                    {{-- <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="workplace_dress_upto_date"  value="{{$field_data[$vl->name] = $vl->value}}"    @if(old('workplace_dress_upto_date') == 1 || old('workplace_dress_upto_date',NULL) == NULL) checked @endif>Yes
                                    </label> --}}

                                    {{-- <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="workplace_dress_upto_date"  value="1"    @if(isset($field_data['workplace_dress_upto_date']) && $field_data['workplace_dress_upto_date']==1) checked @endif>Yes
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="workplace_dress_upto_date" value="0"   @if(isset($field_data['workplace_dress_upto_date']) && $field_data['workplace_dress_upto_date']==0) checked @endif>No
                                    </label>
                                    </div>
                                    @error('workplace_dress_upto_date')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-8 dress-policy-no @if(old('workplace_dress_policy',NULL) != NULL && old('workplace_dress_policy') == 0) '' @else d-none @endif">
                                    <label >How do you currently communicate expectations around workplace presentation?</label>
                                    <input type="text" value="{{$field_data[$vl->name] = $vl->value}}" class= "form-control" name="workplace_dress_communication">
                                    @error('workplace_dress_communication')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label > Do you have a diversity and inclusion
                                    policy?</label>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy" value="1" onclick="toggleRadioButtonDiversityPolicy(this)" @if(isset($field_data['diversity_inclusion_policy']) && $field_data['diversity_inclusion_policy']==1)
                                        checked
                                        @endif>Yes
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy"  onclick="toggleRadioButtonDiversityPolicy(this)"value="0" value="{{$field_data[$vl->name] = $vl->value}}"  @if(isset($field_data['diversity_inclusion_policy']) && $field_data['diversity_inclusion_policy']==0) --}}
                                        {{-- checked
                                        @endif>No
                                    </label>
                                    </div>
                                    @error('diversity_inclusion_policy')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-4 diversity-policy-yes @if(old('diversity_inclusion_policy') == 1 || old('diversity_inclusion_policy',NULL) == NULL) '' @else d-none @endif" id="diversity_inclusion_policy_file">

                                    <div class="form-group">
                                        <label >Choose diversity and inclusion Attachment</label>
                                        <div class="form-check">
                                            <label class="form-check-label"> --}}
                                                {{-- <input type="file" class="form-check-input" name="diversity_inclusion_policy_file" value="" > --}}

                                                {{-- <input type="hidden" class="form-check-input" name="diversity_inclusion_policy_file" value="{{$diversity_inclusion_policy_file}}" >


                                                <span>
                                                    @if ('uploads/stylist/'. $field_data[$vl->name] = $vl->value)

                                                      <img src="{{ url('uploads/stylist/'. $field_data['diversity_inclusion_policy_file'])}}"   alt="" srcset="" style="width: 100px">

                                                    @endif
                                                </span>
                                                @error('diversity_inclusion_policy_file')
                                                    <div class="error">
                                                        {{$message}}
                                                    </div>
                                                @enderror
                                            </label>
                                        </div>

                                    </div>
                                </div>


                                <div class="form-group col-md-4 diversity-policy-yes @if(old('diversity_inclusion_policy') == 1 || old('diversity_inclusion_policy',NULL) == NULL) '' @else d-none @endif">
                                    <label>Is this policy current and up to date?</label>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy_upto_date" value="1"  @if(isset($field_data['diversity_inclusion_policy_upto_date']) && $field_data['diversity_inclusion_policy_upto_date']==1)
                                        checked
                                        @endif>Yes
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy_upto_date" value="0" @if(isset($field_data['diversity_inclusion_policy_upto_date']) && $field_data['diversity_inclusion_policy_upto_date']==0)
                                        checked
                                        @endif>No
                                    </label>

                                    </div>
                                    @error('diversity_inclusion_policy_upto_date')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">

                                    <label >Are there currently poor staff
                                    presentation challenges within the
                                    organisation?</label>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="currently_poor_staff" value="1"  onclick="toggleRadioButton(this,'text')" @if(isset($field_data['currently_poor_staff']) && $field_data['currently_poor_staff']==1)
                                            checked
                                            @endif>Yes
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="0" name="currently_poor_staff" value="0" onclick="toggleRadioButton(this,'text')" @if(isset($field_data['currently_poor_staff']) && $field_data['currently_poor_staff']==0)
                                            checked
                                            @endif>No
                                        </label>
                                    </div>
                                    @error('currently_poor_staff')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-8 @if(old('currently_poor_staff') == 1 || old('currently_poor_staff',NULL) == NULL) '' @else d-none @endif" id="currently_poor_staff_text">
                                    <div class="form-group">
                                        <label >Describe</label>
                                        <textarea class="form-check-input form-control" name="currently_poor_staff_description" value="{{$currently_poor_staff_description}}">

                                            @if (isset($field_data['currently_poor_staff_description']) )
                                               {{$field_data['currently_poor_staff_description']}}
                                            @endif
                                        </textarea>
                                        @error('currently_poor_staff_description')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-6">
                                    <div class="form-group">
                                        <label >What percentage of employees do you believe present well within the
                                        organisation?</label>
                                        <select class= "form-control"  id="sel1" name="percentage_of_emp_believe">
                                        <option value="Less that 25%" @if(isset($field_data['percentage_of_emp_believe']) && $field_data['percentage_of_emp_believe'] == "Less that 25%") selected="selected" @endif>Less that 25%</option>

                                        <option value="25-50%" @if(isset($field_data['percentage_of_emp_believe']) && $field_data['percentage_of_emp_believe']  == "25-50%") selected="selected" @endif>25-50%</option>

                                        <option value="50-75%" @if(isset($field_data['percentage_of_emp_believe']) && $field_data['percentage_of_emp_believe'] == "50-75%") selected="selected" @endif>50-75%</option>

                                        <option value="Above 75%" @if( isset($field_data['percentage_of_emp_believe']) && $field_data['percentage_of_emp_believe'] == "Above 75%") selected="selected" @endif>Above 75%</option>

                                        </select>
                                        @error('percentage_of_emp_believe')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>


                                <div class="form-group col-md-6">
                                    <label >Do different positions or business
                                    activities require a different standard of presentation or dress code?Eg. Client facing require suit. WFH video conferencing require neat presentation.</label>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="different_position_business" value="1" @if( isset($field_data['different_position_business']) && $field_data['different_position_business'] == 1) checked @endif>Yes
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="0" name="different_position_business" @if( isset($field_data['different_position_business']) && $field_data['different_position_business'] == 0) checked @endif>No
                                    </label>
                                    </div>
                                    @error('different_position_business')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label >scenarios for men?</label>
                                        <textarea class="form-check-input form-control" name="scenario_for_men">
                                            @if (isset($field_data['scenario_for_men']))
                                                {{$field_data['scenario_for_men']}}
                                            @endif
                                        </textarea>
                                        @error('scenario_for_men')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label >scenarios for women?</label>
                                        <textarea class="form-check-input form-control" name="scenario_for_women">
                                            @if (isset($field_data['scenario_for_women']))
                                                {{$field_data['scenario_for_women']}}
                                            @endif
                                        </textarea>
                                        @error('scenario_for_women')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label >scenarios for other gender?</label>
                                        <textarea class="form-check-input form-control" name="scenario_for_other">
                                            @if (isset($field_data['scenario_for_other']))
                                                {{$field_data['scenario_for_other']}}
                                            @endif
                                        </textarea>
                                        @error('scenario_for_other')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label >Are there any OH&S requirements
                                        that DAPPR needs to know about for
                                        the purpose of choosing appropriate
                                        garments & accessories?</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="1" name="appropriate_germents" onclick="toggleRadioButton(this,'div')"  @if(isset($field_data['appropriate_germents']) && $field_data['appropriate_germents']== 1) checked @endif>Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="0" name="appropriate_germents" onclick="toggleRadioButton(this,'div')" @if(isset($field_data['appropriate_germents']) && $field_data['appropriate_germents']== 0) checked @endif>No
                                        </label>
                                    </div>
                                    @error('appropriate_germents')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-8  @if(old('appropriate_germents') == 1 || old('appropriate_germents',NULL) == NULL)  @else d-none @endif" id="appropriate_germents_div">
                                    <div class="form-group">
                                        <label >Describe</label>

                                        <textarea class="form-check-input form-control" name="appropriate_germents_description" >@if(isset($field_data['appropriate_germents_description']) ) {{$field_data['appropriate_germents_description']}} @endif</textarea>
                                        @error('appropriate_germents_description')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror

                                    </div>
                                </div>
                            </div>


                            <div class="col-md-12">
                            <a href="#image_presentation"  data-toggle="pill" onclick="toggleTabPill(this,'image_presentation')" class="btn btn-primary btn-lg">Next</a>
                            </div> --}}
                            <!-- </form> -->
                    {{-- </div>
                    <div class="tab-pane fade" id="image_presentation"> --}}
                        <!-- <form class="row"> -->
                        {{-- <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label >Select images you would be happy to
                                        see team members wear in client
                                        facing roles
                                    </label> --}}
                                    <!-- <select class= "form-control"  id="sel1">
                                        <option>Categories</option>
                                        <option>Corporate</option>
                                        <option>Smart Business </option>
                                        <option>Casual </option>
                                        <option>Combination </option>
                                    </select> -->
                                    {{-- <div class="row product_check">
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Corporate" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>
                                                </div>
                                                <h6 class="text-center">Corporate</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Smart Business" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>
                                                </div>
                                                <h6 class="text-center">Smart Business</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Smart Casual" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>
                                                </div>
                                                <h6 class="text-center">Smart Casual</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Casual" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>
                                                </div>
                                                <h6 class="text-center">Casual</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Combination" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>
                                                </div>
                                                <h6 class="text-center">Combination</h6>
                                            </div>
                                        </div> --}}
                                        {{-- <input type="hidden" class="image-selection-hidden" name="client_facing_team_members" id="client_facing_team_members" @if (isset($field_data['client_facing_team_members'] ))
                                        {{  $field_data['client_facing_team_members'] }}
                                            checked
                                        @endif> --}}
                                        {{-- <input type="hidden" class="image-selection-hidden" name="client_facing_team_members" id="client_facing_team_members" value="'uploads/stylist/'. $field_data['client_facing_team_members'])" @if(isset($field_data['client_facing_team_members']) && (($field_data['client_facing_team_members']== "Corporate") || ($field_data['client_facing_team_members']== "Smart Business") || ($field_data['client_facing_team_members']== "Smart Casual") || ($field_data['client_facing_team_members']== "Casual") || ($field_data['client_facing_team_members']== "Combination"))) --}}
                                        {{-- {{$field_data['client_facing_team_members'] }} --}}
                                            {{-- checked
                                        @endif>
                                        <input type="hidden" class="image-selection-hidden" name="client_facing_team_members" id="client_facing_team_members" value="'uploads/stylist/'. $field_data['client_facing_team_members'])">
                                    </div>
                                    @error('client_facing_team_members')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label >Can team members be more casual
                                    when not facing clients?</label>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="more_casual_status" value="1" onclick="toggleRadioButton(this,'div')"  @if(isset($field_data['more_casual_status'])&& ($field_data['more_casual_status']) == 1) checked @endif>Yes
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="more_casual_status" value="0" onclick="toggleRadioButton(this,'div')" @if(isset($field_data['more_casual_status']) && ($field_data['more_casual_status']) == 0) checked @endif>No
                                </label>
                                </div>
                                @error('more_casual_status')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-8  @if(old('more_casual_status') == 1 || old('more_casual_status',NULL) == NULL)  @else d-none @endif" id="more_casual_status_div">
                                <div class="form-group">
                                    <label >Select images you would be happy to
                                        see team members wear internally
                                    </label>
                                    <div class="row product_check">
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Corporate" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>
                                                </div>
                                                <h6 class="text-center">Corporate</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Smart Business" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>

                                                </div>
                                                <h6 class="text-center">Smart Business</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Smart Casual" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>

                                                </div>
                                                <h6 class="text-center">Smart Casual</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Casual" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>

                                                </div>
                                                <h6 class="text-center">Casual</h6>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="product_box ">
                                                <div class="product_img_box">
                                                    <img data-for="Combination" src="../../../public/images/stylist/employe_onbording_stylist_defaut.jpg" checked>

                                                </div>
                                                <h6 class="text-center">Combination</h6>
                                            </div>
                                        </div>
                                        <input type="hidden" class="image-selection-hidden" value="$field_data['more_casual'])"  name="more_casual" id="more_casual"  @if(isset($field_data['more_casual']) && (($field_data['more_casual']== "Corporate") || ($field_data['more_casual']== "Smart Business") || ($field_data['more_casual']== "Smart Casual") || ($field_data['more_casual']== "Casual") || ($field_data['more_casual']== "Combination"))) --}}
                                        {{-- {{$field_data['client_facing_team_members'] }} --}}
                                            {{-- checked
                                        @endif >
                                        <input type="hidden" class="image-selection-hidden" name="more_casual" id="more_casual" value="$field_data['more_casual'])" >
                                    </div>

                                    @error('more_casual')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">

                                <label>In a few words can you describe what
                                impression you’d like your team
                                members to leave on your clients
                                and fellow collegues?Eg. Approachable, neat, forward thinking</label>

                                <textarea name="impression_description" class="form-control">
                                    @if (isset($field_data['impression_description']))
                                        {{$field_data['impression_description']}}
                                    @endif
                                </textarea>
                                @error('impression_description')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Does the company have a vision
                                and/or mission statement?
                                </label>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="vision_statement" class="form-check-input"  onclick="toggleRadioButtonVisionStatement(this)" value="1" @if (isset($field_data['vision_statement']) && $field_data['vision_statement']==1) checked  @endif>Yes
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="vision_statement" value="0" onclick="toggleRadioButtonVisionStatement(this)" @if (isset($field_data['vision_statement']) && $field_data['vision_statement']==0) checked  @endif>No
                                </label>
                                </div>
                                @error('vision_statement')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 vision-statement-yes @if(old('vision_statement') == 1 || old('vision_statement',NULL) == NULL) '' @else d-none @endif">

                                <div class="form-group">
                                    <label >Vision Statement Attachment</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="file" class="form-check-input" name="vision_statement_file" value="uploads/stylist/'. $field_data['vision_statement_file'])">

                                            <input type="hidden" class="form-check-input" name="vision_statement_file" value="uploads/stylist/'. $field_data['vision_statement_file'])">
                                            <span>
                                                @if ('uploads/stylist/'. $field_data['vision_statement_file'])

                                                  <img src="{{ url('uploads/stylist/'. $field_data['vision_statement_file'])}}"   alt="" srcset="" style="width: 100px">

                                                @endif
                                            </span>

                                            @error('vision_statement_file')
                                                <div class="error">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </label>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group col-md-4 vision-statement-yes @if(old('vision_statement') == 1 || old('vision_statement',NULL) == NULL) '' @else d-none @endif">
                                <div class="form-group">
                                    <label >Vision Statement Description</label>

                                    <textarea class="form-check-input form-control" name="vision_statement_description">
                                        @if (isset($field_data['vision_statement_description'])
                                        )
                                        {{$field_data['vision_statement_description']}}
                                        @endif
                                    </textarea>

                                    @error('vision_statement_description')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="form-group col-md-4">
                                <label>Is there any additional information about the company brand or marketing strategy/documents that is relevant for DAPPR to know when selecting an image for your team members?</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="additional_info" class="form-check-input"  onclick="toggleRadioButtonAdditionalInfo(this)" value="1" @if (isset($field_data['additional_info']) && $field_data['additional_info']==1)
                                            checked
                                        @endif>Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="additional_info" value="0" onclick="toggleRadioButtonAdditionalInfo(this)" @if (isset($field_data['additional_info']) && $field_data['additional_info']==0)
                                    checked
                                @endif>No
                                </label>
                                </div>

                                @error('additional_info')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4 additional-info-yes @if(old('additional_info') == 1 || old('additional_info',NULL) == NULL) '' @else d-none @endif">

                                <div class="form-group">
                                    <label >Additional Information Attachment</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="file" class="form-check-input" name="additional_info_file" >

                                            <input type="hidden" class="form-check-input" name="additional_info_file" value="'uploads/stylist/'. $field_data['additional_info_file']">
                                        </label>
                                        <span>
                                            @if ('uploads/stylist/'. $field_data['additional_info_file'])

                                            <img src="{{ url('uploads/stylist/'. $field_data['additional_info_file'])}}"   alt="" srcset="" style="width: 100px">
                                            @endif
                                        </span>
                                        @error('additional_info_file')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>

                                </div>
                            </div>


                            <div class="form-group col-md-4 additional-info-yes @if(old('additional_info') == 1 || old('additional_info',NULL) == NULL) '' @else d-none @endif">
                                <div class="form-group">
                                    <label >Additional Information Description</label>

                                    <textarea class="form-check-input form-control" name="additional_info_description">
                                        @if(isset($field_data['additional_info_description']))
                                        {{$field_data['additional_info_description']}}
                                        @endif
                                    </textarea>
                                    @error('additional_info_description')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror

                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">

                                <label>What would you hope to see to
                                deem the rollout of the DAPPR
                                program a success for the company?
                                </label>

                                <textarea class="form-control" name="hope_description">
                                    @if(isset($field_data['hope_description']))
                                    {{$field_data['hope_description']}}
                                    @endif
                                </textarea>

                                @error('hope_description')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                        <a href="#service_accounting"  data-toggle="pill" onclick="toggleTabPill(this,'service_accounting')" class="btn btn-primary btn-lg">Next</a>
                        </div>
                        <!-- </form> -->
                    </div>
                    <div class="tab-pane fade" id="service_accounting"> --}}
                        <!-- <form class="row"> -->

                        {{-- <div class="row">
                            <div class="form-group col-md-8">
                                <label >As part of the DAPPR program,
                            organisations have the choice to
                            contribute an additional dollar value
                            on top of the service cost toward
                            clothing purchases for each employee involved with the DAPPR
                            program. Would you like to contribute an additional amount to employees clothing allowance per annum? <i>This amount will be evenly distributed over the 4 quarterly deliveries. Unspent will be carried over to the following quarter for each employee.</i></label>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="additional_amount_status" value="1" onclick="toggleRadioButton(this,'div')"  @if (isset($field_data['additional_amount_status']) && $field_data['additional_amount_status']==1)
                                    checked
                                @endif>Yes
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="additional_amount_status" value="0" onclick="toggleRadioButton(this,'div')" @if (isset($field_data['additional_amount_status']) && $field_data['additional_amount_status']==0)
                                    checked
                                @endif>No
                                </label>
                                </div>

                                @error('additional_amount_status')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4  @if(old('additional_amount_status') == 1 || old('additional_amount_status',NULL) == NULL)  @else d-none @endif" id="additional_amount_status_div">
                                <div class="form-group">
                                    <label >How much would the company like to contribute per employee, per annum?
                                    </label>
                                    <input type="text" name="additional_amount" class= "form-control"  value="{{$field_data['additional_amount']}}" @if(isset($field_data['additional_amount']))
                                    {{$field_data['additional_amount']}}

                                @endif>

                                    @error('additional_amount')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div> --}}




                        <!-- </form> -->
                       {{-- <div class="col-md-12 d-none">
                            <h4 class="text-center">
                                <b>Thanks for taking the time to complete this questionnaire. We collate this information, confirm contracts and accounts and be in contact.
                                </b>
                            </h4>
                        </div>
                    </div> --}}

            {{-- </div>

            </form>
           </div> --}}

			{{-- </div> <!-- /.box -->
		</div>
	</div>
</div>
@endsection

@section('page-style')
<style>
#DataTables_Table_0 .c-text-left{text-align:left!important}
#DataTables_Table_0 .c-text-center{text-align:center!important}
</style>
@section('page-script')
@include('admin.stylist_form.common')
<script>
    function toggleTabPill(elem,id){
        a = $('.nav-tabs').find('a');
        for(i=0;i<=a.length; i++){
            tabid = $(a[i]).attr('href');
            if(tabid == '#'+id){
                $(a[i]).parent().addClass('active');
                $(a[i]).addClass('active');
            }else{
                $(a[i]).parent().removeClass('active');
                $(a[i]).removeClass('active');
            }
        }
    }
    function toggleRadioButton(elem,ext){
        name = $(elem).attr('name');
        if($(elem).val() == 1){
            $('#'+name+'_'+ext).removeClass('d-none');
        }else{
            $('#'+name+'_'+ext).addClass('d-none');

        }
    }

    function toggleRadioButtonDressPolicy(elem){
        if($(elem).val() == '1'){
            $('.dress-policy-yes').removeClass('d-none');
            $('.dress-policy-no').addClass('d-none');
        }else{
            $('.dress-policy-yes').addClass('d-none');
            $('.dress-policy-no').removeClass('d-none');
        }
    }

    function toggleRadioButtonDiversityPolicy(elem){
        if($(elem).val() == '1'){
            $('.diversity-policy-yes').removeClass('d-none');
            $('.diversity-policy-no').addClass('d-none');
        }else{
            $('.diversity-policy-yes').addClass('d-none');
            $('.diversity-policy-no').removeClass('d-none');
        }
    }

    function toggleRadioButtonVisionStatement(elem){
        if($(elem).val() == '1'){
            $('.vision-statement-yes').removeClass('d-none');
            $('.vision-statement-no').addClass('d-none');
        }else{
            $('.vision-statement-yes').addClass('d-none');
            $('.vision-statement-no').removeClass('d-none');
        }
    }

    function toggleRadioButtonAdditionalInfo(elem){
        if($(elem).val() == '1'){
            $('.additional-info-yes').removeClass('d-none');
            $('.additional-info-no').addClass('d-none');
        }else{
            $('.additional-info-yes').addClass('d-none');
            $('.additional-info-no').removeClass('d-none');
        }
    }
    $(function(){
        $(".product_check img").click(function(){
            $(this).parents('.product_check.row').find(".product_img_box.active").removeClass('active');
            $(this).parent(".product_img_box").addClass('active');
            $(this).parents('.product_check.row').find('.image-selection-hidden').val($(this).data('for'));
        });

        @if (count($errors) > 0)
            stf_add_screen_show_employer_onboarding_questionnaire();

            @php
            $company_info_fields = ['company_name','physical_address','primary_contact','primary_email','primary_direct_phone_number','secondary_phone_number','secondary_email','secondary_direct_phone_number'];
            $current_professional_fields = ['workplace_dress_policy','workplace_dress_policy_file','workplace_dress_upto_date','workplace_dress_communication','diversity_inclusion_policy','diversity_inclusion_policy_file','diversity_inclusion_policy_upto_date','currently_poor_staff','currently_poor_staff_description','percentage_of_emp_believe','different_position_business','scenario_for_men','scenario_for_women','scenario_for_other','appropriate_germents','appropriate_germents_description'];

            $image_presentation_fields = ['client_facing_team_members','more_casual_status','more_casual','impression_description','vision_statement','vision_statement_file','vision_statement_description','additional_info','additional_info_file','additional_info_description','hope_description'];
            $service_accounting_fields = ['additional_amount_status','additional_amount'];
            $tab = '';
            @endphp


            @foreach($company_info_fields as $company_info_field)
                @error($company_info_field)
                    @php $tab = 'company_information'; @endphp
                @enderror
            @endforeach

            @if($tab == '')
                @foreach($current_professional_fields as $current_professional_field)
                    @error($current_professional_field)
                        @php $tab = 'current_professional'; @endphp
                    @enderror
                @endforeach
            @endif

            @if($tab == '')
                @foreach($image_presentation_fields as $image_presentation_field)
                    @error($image_presentation_field)
                        @php $tab = 'image_presentation'; @endphp
                    @enderror
                @endforeach
            @endif

            @if($tab == '')
                @foreach($service_accounting_fields as $service_accounting_field)
                    @error($service_accounting_field)
                        @php $tab = 'service_accounting'; @endphp
                    @enderror
                @endforeach
            @endif --}}

            {{-- // $("a[href=#current_professional]").trigger('click');
            $(document).find('a[href="#company_information"], a[href="#current_professional"], a[href="#image_presentation"], a[href="#service_accounting"]').parent().removeClass('active');

            $("#company_information, #current_professional, #image_presentation, #service_accounting").removeClass('active in').addClass('fade');

            $(document).find('a[href="#{{ $tab }}"]').parent().addClass('active');

            $('#{{ $tab }}').addClass('active in').removeClass('fade');
        @endif
    });
</script>
@endsection --}}
