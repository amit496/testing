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
<div class="box stf_outer_body stf_side_bar_not_hide">
@php

// print_r($errors);die;
    $edit_id = 0;

    $show_table = 'none';
    $show_edit_mode = 'none';


    $company_name = '';
    $physical_address = '';
    $primary_contact = '';
    $primary_email= '';
    $primary_direct_phone_number= '';
    $secondary_phone_number= '';
    $secondary_email= '';
    $secondary_direct_phone_number= '';

    $workplace_dress_policy= '';
    $workplace_dress_policy_1='';
    $workplace_dress_policy_0='';
    $workplace_dress_policy_attc_display='block';

    // --------------------------------------------
    $workplace_dress_policy_file= '';
    // ------------------------------------------------
    $workplace_dress_upto_date = '';
    $workplace_dress_upto_date_1= '';
    $workplace_dress_upto_date_0= '';
    $workplace_dress_communication= '';

    $diversity_inclusion_policy = '';
    $diversity_inclusion_policy_1= '';
    $diversity_inclusion_policy_0= '';
    $diversity_inclusion_policy_attc_display='block';


    $diversity_inclusion_policy_file= '';

    $diversity_inclusion_policy_upto_date= '';
    $diversity_inclusion_policy_upto_date_1= '';
    $diversity_inclusion_policy_upto_date_0= '';
    $diversity_inclusion_policy_file_attc_display='block';


    $currently_poor_staff= '';
    $currently_poor_staff_1= '';
    $currently_poor_staff_0= '';
    $currently_poor_staff_attc_display='block';

    $currently_poor_staff_description= '';

    $percentage_of_emp_believe='';
    $different_position_business= '';
    $different_position_business_1='';
    $different_position_business_0='';
    $percentage_of_emp_believe_attc_display='block';

    $scenario_for_men='';
    $scenario_for_women='';
    $scenario_for_other='';


    $appropriate_germents= '';
    $appropriate_germents_1='';
    $appropriate_germents_0='';
    $appropriate_germents_attc_display='block';


    $appropriate_germents_description='';
    $client_facing_team_members='';

    $more_casual_status= '';
    $more_casual_status_1='';
    $more_casual_status_0='';
    $more_casual_status_attc_display='none';

    $more_casual='';
    $impression_description='';
    $vision_statement_attc_display='block';


    $vision_statement= '';
    $vision_statement_1='';
    $vision_statement_0='';

    $vision_statement_file='';

    $vision_statement_description='';

    $additional_info= '';
    $additional_info_1='';
    $additional_info_0='';
    $additional_info_attc_display='block';

    $additional_info_file='1';
    $additional_info_description='';
    $hope_description='';
    $additional_amount='';

    $additional_amount_status= '';
    $additional_amount_status_1='';
    $additional_amount_status_0='';
    $additional_amount_status_attc_display='block';


    $client_facing_team_members_roles_arr = array();
    $team_members_wear_internally_arr = array();
    $description_scenario = '';
    $different_position_business_attc_display='none';

    if(isset($db_data)){

        $show_edit_mode = 'block';
        $company_name = $db_data->company_name;

        $physical_address = $db_data->physical_address;
        $primary_contact = $db_data->primary_contact;
        $primary_email = $db_data->primary_email;
        $primary_direct_phone_number = $db_data->primary_direct_phone_number;
        $secondary_phone_number = $db_data->secondary_contact;
        $secondary_email = $db_data->secondary_email;
        $secondary_direct_phone_number = $db_data->secondary_direct_phone_number;
        extract($field_data);
        $edit_id = $db_data->id;
        $workplace_dress_policy = (int)$workplace_dress_policy;


        $workplace_dress_policy = (int)$workplace_dress_policy;
        $workplace_dress_upto_date = (int)$workplace_dress_upto_date;
        $diversity_inclusion_policy = (int)$diversity_inclusion_policy;
        $diversity_inclusion_policy_upto_date = (int)$diversity_inclusion_policy_upto_date;
        $currently_poor_staff = (int)$currently_poor_staff;
        $different_position_business = (int)$different_position_business;
        $appropriate_germents = (int)$appropriate_germents;
        $more_casual_status = (int)$more_casual_status;
        $vision_statement = (int)$vision_statement;
        $additional_info = (int)$additional_info;
        $additional_amount_status = (int)$additional_amount_status;
    }else{
        $show_table = 'block';
    }

    if(old('company_name') != null){
        $company_name = old('company_name');
    }
    if(old('physical_address') != null){
        $physical_address = old('physical_address');
    }
    if(old('primary_contact') != null){
        $primary_contact = old('primary_contact');
    }
    if(old('primary_email') != null){
        $primary_email = old('primary_email');
    }
    if(old('primary_direct_phone_number') != null){
        $primary_direct_phone_number = old('primary_direct_phone_number');
    }


    if(old('secondary_phone_number') != null){
        $secondary_phone_number = old('secondary_phone_number');
    }

    if(old('secondary_email') != null){
        $secondary_email = old('secondary_email');
    }

    if(old('secondary_direct_phone_number') != null){
        $secondary_direct_phone_number = old('secondary_direct_phone_number');
    }





    if(old('hope_description') != null){
        $hope_description = old('hope_description');
    }

    if(old('additional_amount') != null){
        $additional_amount = old('additional_amount');
    }

    if(old('additional_info_description') != null){
        $additional_info_description = old('additional_info_description');
    }

    if(old('vision_statement_description') != null){
        $vision_statement_description = old('vision_statement_description');
    }

    if(old('impression_description') != null){
        $impression_description = old('impression_description');
    }

     if(old('currently_poor_staff_description') != null){
        $currently_poor_staff_description = old('currently_poor_staff_description');
    }

    if(old('scenario_for_men') != null){
        $scenario_for_men = old('scenario_for_men');
    }
    if(old('scenario_for_women') != null){
        $scenario_for_women = old('scenario_for_women');
    }

    if(old('description_scenario') != null){
        $description_scenario = old('description_scenario');
    }

    if(old('appropriate_germents_description') != null){
        $appropriate_germents_description = old('appropriate_germents_description');
    }

    if(old('client_facing_team_members_roles_arr') != null){
        $client_facing_team_members_roles_arr = old('client_facing_team_members_roles_arr');
    }

    if(old('team_members_wear_internally_arr') != null){
        $team_members_wear_internally_arr = old('team_members_wear_internally_arr');
    }






   if($workplace_dress_policy === 0 || (old('workplace_dress_policy') != null && (int)old('workplace_dress_policy') === 0  )){
        $workplace_dress_policy_1='';
        $workplace_dress_policy_0='checked';
        $workplace_dress_policy_attc_display='block';
    }else  if($workplace_dress_policy === 1 || (old('workplace_dress_policy') != null && (int)old('workplace_dress_policy') === 1  )){
        $workplace_dress_policy_1='checked';
        $workplace_dress_policy_0='';
        $workplace_dress_policy_attc_display='none';
    }


    if($workplace_dress_upto_date === 0 || (old('workplace_dress_upto_date') != null && (int)old('workplace_dress_upto_date') === 0  )){

        $workplace_dress_upto_date_1='';
        $workplace_dress_upto_date_0='checked';
        $workplace_dress_upto_date_attc_display='none';
    }else if($workplace_dress_upto_date === 1 || (old('workplace_dress_upto_date') != null && (int)old('workplace_dress_upto_date') === 1  )){

        $workplace_dress_upto_date_1='checked';
        $workplace_dress_upto_date_0='';
        $workplace_dress_upto_date_attc_display='block';
    }

   if($diversity_inclusion_policy === 0 || (old('diversity_inclusion_policy') != null && (int)old('diversity_inclusion_policy') === 0  )){

        $diversity_inclusion_policy_1 = '';
        $diversity_inclusion_policy_0='checked';
        $diversity_inclusion_policy_attc_display='none';
    }else if($diversity_inclusion_policy === 1 || (old('diversity_inclusion_policy') != null && (int)old('diversity_inclusion_policy') === 1 )){

        $diversity_inclusion_policy_1='checked';
        $diversity_inclusion_policy_0='';
        $diversity_inclusion_policy_attc_display='block';
    }

    if($diversity_inclusion_policy_upto_date === 0 || (old('diversity_inclusion_policy_upto_date') != null && (int)old('diversity_inclusion_policy_upto_date') === 0  )){
        $diversity_inclusion_policy_upto_date_1='';
        $diversity_inclusion_policy_upto_date_0='checked';
        $diversity_inclusion_policy_file_attc_display='none';
    }else if($diversity_inclusion_policy_upto_date === 1 || (old('diversity_inclusion_policy_upto_date') != null && (int)old('diversity_inclusion_policy_upto_date') === 1  )){
        $diversity_inclusion_policy_upto_date_1='checked';
        $diversity_inclusion_policy_upto_date_0='';
        $diversity_inclusion_policy_file_attc_display='block';
    }

   if($currently_poor_staff === 0 || (old('currently_poor_staff') != null && (int)old('currently_poor_staff') === 0  )){
        $currently_poor_staff_1='';
        $currently_poor_staff_0='checked';
        $currently_poor_staff_attc_display='none';
    }else if($currently_poor_staff === 1 || (old('currently_poor_staff') != null && (int)old('currently_poor_staff') === 1  )){
        $currently_poor_staff_1='checked';
        $currently_poor_staff_0='';
        $currently_poor_staff_attc_display='block';
    }



    if($different_position_business === 0 || (old('different_position_business') != null && (int)old('different_position_business') === 0  )){
        $different_position_business_1='';
        $different_position_business_0='checked';
        $different_position_business_attc_display='none';
    }else if($different_position_business === 1 || (old('different_position_business') != null && (int)old('different_position_business') === 1  )){
        $different_position_business_1='checked';
        $different_position_business_0='';
        $different_position_business_attc_display='block';
    }



    if($appropriate_germents === 0 || (old('appropriate_germents') != null && (int)old('appropriate_germents') === 0  )){
        $appropriate_germents_1='';
        $appropriate_germents_0='checked';
        $appropriate_germents_attc_display='none';
    }else if($appropriate_germents === 1 || (old('appropriate_germents') != null && (int)old('appropriate_germents') === 1  )){
        $appropriate_germents_1='checked';
        $appropriate_germents_0='';
        $appropriate_germents_attc_display='block';
    }


    if($more_casual_status === 0 || (old('more_casual_status') != null && (int)old('more_casual_status') === 0  )){
        $more_casual_status_1='';
        $more_casual_status_0='checked';
        $more_casual_status_attc_display='none';
    }else if($more_casual_status === 1 || (old('more_casual_status') != null && (int)old('more_casual_status') === 1  )){
        $more_casual_status_1='checked';
        $more_casual_status_0='';
        $more_casual_status_attc_display='block';
    }


    if($vision_statement === 0 || (old('vision_statement') != null && (int)old('vision_statement') === 0  )){
        $vision_statement_1='';
        $vision_statement_0='checked';
        $vision_statement_attc_display='none';
    }else if($vision_statement === 1 || (old('vision_statement') != null && (int)old('vision_statement') === 1  )){
        $vision_statement_1='checked';
        $vision_statement_0='';
        $vision_statement_attc_display='block';
    }


   if($additional_info === 0 || (old('additional_info') != null && (int)old('additional_info') === 0  )){
        $additional_info_1='';
        $additional_info_0='checked';
        $additional_info_attc_display='none';
   }else if($additional_info === 1 || (old('additional_info') != null && (int)old('additional_info') === 1  )){
        $additional_info_1='checked';
        $additional_info_0='';
        $additional_info_attc_display='block';
    }



    if($additional_amount_status === 0 || (old('additional_amount_status') != null && (int)old('additional_amount_status') === 0  )){
        $additional_amount_status_1='';
        $additional_amount_status_0='checked';
        $additional_amount_status_attc_display='none';
    }else  if($additional_amount_status === 1 || (old('additional_amount_status') != null && (int)old('additional_amount_status') === 1    )){
        $additional_amount_status_1='checked';
        $additional_amount_status_0='';
        $additional_amount_status_attc_display='block';

    }



@endphp

        <div class="box stf_outer_body stf_outer_page_load "  style="display:none">
        <div class="table_list "  style="display:{{ $show_table  }}">
        <div class="row "style="display: flex; margin-left: 0;">

            <div class=""style="width: 96%; ">

                    <div class="container-fluid px-5  stf_table_employer_onboarding">
              <h3 class=" with-border">Employer Onboarding Questionnaire</h3>

              <div class="box-tools pull-right">
                      <a  href="javascript:void(0)" onclick="stf_add_screen_show_employer_onboarding_questionnaire()" class="btn btn-default btn-flat" style="cursor: pointer;">Add Company</a>
              </div>
             <table class="table table-hover dataTable no-footer my-5">
          <thead>
            <tr>
              <th>Company Name</th>
              <th>Email</th>
              <th>Direct Phone Number</th>
              <th>Users</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
             @php
             $table_body = '';
              if(isset($employerOnboarding) && $employerOnboarding){
                foreach($employerOnboarding as $employer_info){

                    $table_body .= '<tr>';
                    $table_body .= ' <td>'.$employer_info->company_name.'</td>';
                    $table_body .= ' <td>'.$employer_info->primary_email.'</td>';
                    $table_body .= ' <td>'.$employer_info->primary_direct_phone_number.'</td>';
                    $table_body .= '<td><span onclick="stf_comapany_add_users('.$employer_info->id.')" class="btn btn-primary">Add User</a></td>';


                    $table_body .= '<td><a href="'.url('admin/employer_onboarding_questionnaire').'/'.$employer_info->id.'" onclick_rename="stf_edit_employer_onboarding_questionnaire('.$employer_info->id.')"><i class="fa fa-edit"></i></a>

                        <a href="'.url('admin/employer-onboarding-questionnaire/delete/'.$employer_info->id).'" ><i class="fa fa-trash-o"></i></a>

                    </td>';
                    $table_body .= '</tr>';

                }

              }else{
                 $table_body = "<tr><td colspan='3'>No Records</td></tr>";
              }
              echo $table_body;

            @endphp

          </tbody>
        </table>

          </div>
          </div>
          </div>
          </div>
          <div class="container-fluid px-5  stf_add_employer_onboarding" style="display:{{ $show_edit_mode  }}">

            <div class="box-header with-border">
              <h3 class="box-title">Employer Onboarding Questionnaire</h3>
              <div class="box-tools pull-right">
                      <a  href="{{ url('admin/employer_onboarding_questionnaire') }}" onclick="stf_manage_screen_show_employer_onboarding_questionnaire()" class="btn btn-default btn-flat" style="cursor: pointer;">Manage Company</a>
                </div>
            </div>
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
            </ul>

            <!-- Tab panes -->
            <form method="post" action="{{ url('admin/employer-onboarding-questionnaire-store'); }}" enctype="multipart/form-data">

                @csrf

                <input type="hidden" name="edit_id"  value="{{$edit_id}}" >
            <div class="tab-content form-tab">

                    <div class="tab-pane active" id="company_information">
                        <!-- <form class="row"> -->
                            <div class="form-group col-md-6">
                                <label for="company_name" style="font-size: 14px;">Company Name </label>
                                <input type="text" class= "form-control" placehlder="Company Name"  name="company_name" value="{{ $company_name; }}">

                                @error('company_name')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror

                            </div>
                            <div class="form-group col-md-6">
                                <label style="font-size: 14px;">Physical address</label>
                                <input type="text" class= "form-control"  placehlder="Physical address" name="physical_address" value="{{ $physical_address; }}">
                                @error('physical_address')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>


                            <div class="form-group col-md-4">
                                <label style="font-size: 14px;">Primary Contact Name </label>
                                <input type="text" class= "form-control" name="primary_contact" placeholder="Primary Contact " value="{{$primary_contact }}" >
                                @error('primary_contact')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>

                            <div class="form-group col-md-4">
                                <label style="font-size: 14px;">Primary Contact Email  </label>
                                <input type="text" class= "form-control"  placeholder="Email" name="primary_email" value=" {{ $primary_email }} " >
                                @error('primary_email')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label style="font-size: 14px;">PRIMARY CONTACT PHONE NUMBER  </label>
                                <input type="number" class= "form-control" name="primary_direct_phone_number"   placeholder="Primary phone number" value="{{$primary_direct_phone_number}}">
                                @error('primary_direct_phone_number')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label style="font-size: 14px;">Secondary Contact   </label>
                                <input type="text" class= "form-control" name="secondary_phone_number"  placeholder="Secondary Contact " value="{{$secondary_phone_number}}" >
                            </div>
                            <div class="form-group col-md-4">
                                <label style="font-size: 14px;">Secondary Email  </label>
                                <input type="text" class= "form-control"  placeholder="Email" name="secondary_email" value="{{$secondary_email}}">
                                @error('secondary_email')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="form-group col-md-4">
                                <label style="font-size: 14px;">Secondary phone number  </label>
                                <input type="number" class= "form-control" name="secondary_direct_phone_number"   placeholder="Direct phone number" value="{{$secondary_direct_phone_number}}" >
                                @error('secondary_direct_phone_number')
                                <div class="error">
                                    {{$message}}
                                </div>
                                @enderror
                            </div>
                            <div class="col-md-12">
                                <a href="#current_professional"  data-toggle="pill" onclick="toggleTabPill(this,'current_professional')" class="btn btn-primary btn-lg">Next</a>
                            </div>
                        <!-- </form> -->
                    </div>
                    <div class="tab-pane fade" id="current_professional">
                        <!-- <form class="row"> -->
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label style="font-size: 14px;">  Do you currently have a workplace  dress policy?</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="workplace_dress_policy" value="1"  {{ $workplace_dress_policy_1 }}  onclick="toggleRadioButtonDressPolicy(this)">Yes
                                        </label>
                                    </div>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="workplace_dress_policy" value="0"   {{ $workplace_dress_policy_0 }} onclick="toggleRadioButtonDressPolicy(this)">No
                                        </label>

                                    </div>
                                     @error('workplace_dress_policy')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror

                                    <div class="form-group dress-policy-yes" style="display:{{ $workplace_dress_policy_attc_display; }}" >
                                        <div class="form-group">
                                            <label >Choose workplace dress policy attachment</label>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="file" class="form-check-input" name="workplace_dress_policy_file">
                                                    <input type="hidden" class="form-check-input"  name="workplace_dress_policy_file"  value="{{$workplace_dress_policy_file}}" >
                                                    <span >
                                                        @if ($workplace_dress_policy_file != '')
                                                          <img src="{{url('uploads/stylist/'. $workplace_dress_policy_file)}}"   alt="" srcset="" style="width: 100px">
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
                                </div>

                                <div class="form-group col-md-4 dress-policy-yes @if(old('workplace_dress_policy') == 1 || old('workplace_dress_policy',NULL) == NULL) '' @else d-none @endif">
                                    <label  style="font-size: 14px;">Is this policy current and up to date?</label>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="workplace_dress_upto_date"  value="1" {{ $workplace_dress_upto_date_1; }} >Yes
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="workplace_dress_upto_date" value="0"  {{ $workplace_dress_upto_date_0; }}   >No
                                    </label>
                                    </div>
                                    @error('workplace_dress_upto_date')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>

                                <div class="form-group col-md-8 dress-policy-no @if(old('workplace_dress_policy',NULL) != NULL && old('workplace_dress_policy') === 0) '' @else d-none @endif">
                                    <label >How do you currently communicate expectations around workplace presentation?</label>
                                    <input type="text" value="{{$workplace_dress_communication}}" class= "form-control" name="workplace_dress_communication">
                                    @error('workplace_dress_communication')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label style="font-size: 14px;"> Do you have a diversity and inclusion
                                    policy?</label>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy" value="1" onclick="toggleRadioButtonDiversityPolicy(this)" {{$diversity_inclusion_policy_1}}
                                       >Yes
                                    </label>
                                    </div>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy"  onclick="toggleRadioButtonDiversityPolicy(this)" value="0" {{$diversity_inclusion_policy_0}}
                                        >No
                                    </label>
                                    </div>
                                    @error('diversity_inclusion_policy')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                    <div class="form-group diversity-policy-yes" style="display:{{ $diversity_inclusion_policy_attc_display;}}">

                                        <div class="form-group">
                                            <label >Choose diversity and inclusion Attachment</label>
                                            <div class="form-check">
                                                <label class="form-check-label">
                                                    <input type="file" class="form-check-input" name="diversity_inclusion_policy_file" >
                                                    <input type="hidden" class="form-check-input"  name="diversity_inclusion_policy_file"  value="{{$diversity_inclusion_policy_file}}" >
                                                    <span>
                                                        @if ($diversity_inclusion_policy_file != '')

                                                          <img src="{{ url('uploads/stylist/'. $diversity_inclusion_policy_file)}}"   alt="" srcset="" style="width: 100px">

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
                                </div>


                                <div class="form-group col-md-4 diversity-policy-yes" @if($additional_amount_status == 1 || $additional_amount_status == 0)  @else d-none @endif>
                                    <label  style="font-size: 14px;">Is this policy current and up to date?</label>
                                    <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy_upto_date" value="1"  {{$diversity_inclusion_policy_upto_date_1}}>Yes
                                    </label>
                                    </div>
                                    <div class="form-check">

                                    <label class="form-check-label">
                                        <input type="radio" class="form-check-input" name="diversity_inclusion_policy_upto_date" value="0"
                                            {{$diversity_inclusion_policy_upto_date_0}}>No
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

                                    <label  style="font-size: 14px;">Are there currently poor staff
                                    presentation challenges within the
                                    organisation?</label>

                                    <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="currently_poor_staff" value="1"  onclick="toggleRadioButton(this,'text')" {{$currently_poor_staff_1}} >Yes
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="0" name="currently_poor_staff" value="0" onclick="toggleRadioButton(this,'text')"
                                            {{$currently_poor_staff_0}}>No
                                        </label>
                                    </div>
                                    @error('currently_poor_staff')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror

                                    <div class="form-group" @if(old('currently_poor_staff') == 1 || old('currently_poor_staff',NULL) == NULL) @else d-none @endif id="currently_poor_staff_text">
                                        <div class="form-group">
                                            <label >Describe</label>
                                            <textarea class="form-check-input form-control" name="currently_poor_staff_description" value="{{$currently_poor_staff_description}}">{{$currently_poor_staff_description}}</textarea>
                                            @error('currently_poor_staff_description')
                                                <div class="error">
                                                    {{$message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <div class="form-group">
                                        <label  style="font-size: 14px;">What percentage of employees do you believe present well within the
                                        organisation?</label>
                                        <select class= "form-control"  id="sel1" name="percentage_of_emp_believe"style=" width: 160px;">
                                        <option value="Less that 25%" @if($percentage_of_emp_believe == "Less that 25%") selected="selected" @endif>Less that 25%</option>

                                        <option value="25-50%" @if($percentage_of_emp_believe  == "25-50%") selected="selected" @endif>25-50%</option>

                                        <option value="50-75%" @if($percentage_of_emp_believe == "50-75%") selected="selected" @endif>50-75%</option>

                                        <option value="Above 75%" @if($percentage_of_emp_believe == "Above 75%") selected="selected" @endif>Above 75%</option>

                                        </select>
                                        @error('percentage_of_emp_believe')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group"style="padding-left: 23px; text-align: justify;">
                                        <label >Do different positions or business
                                        activities require a different standard of presentation or dress code?Eg. Client facing require suit. WFH video conferencing require neat presentation.</label>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" name="different_position_business" value="1" {{$different_position_business_1}} onclick = "stylistHideShowClass(this,'different_position_business_attc_display')")
                                            >Yes
                                        </label>
                                        </div>
                                        <div class="form-check">
                                        <label class="form-check-label">
                                            <input type="radio" class="form-check-input" value="0" name="different_position_business"
                                           {{$different_position_business_0}} onclick = "stylistHideShowClass(this,'different_position_business_attc_display')">No
                                        </label>
                                        </div>
                                        @error('different_position_business')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>



                            </div>

                            <div class="row different_position_business_attc_display" style="display:{{ $different_position_business_attc_display;  }};">

                                <div class="form-group col-md-6">
                                    <div class="form-group">

                                        <label  style="font-size: 14px;">DESCRIBE SCENARIOS</label>
                                        <textarea class="form-check-input form-control" name="description_scenario">@if (isset($description_scenario)){{$description_scenario}}@endif</textarea>
                                        @error('description_scenario')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label  style="font-size: 14px;">Are there any OH&S requirements
                                        that DAPPR needs to know about for
                                        the purpose of choosing appropriate
                                        garments & accessories?</label>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="1" name="appropriate_germents" onclick="toggleRadioButton(this,'div')" {{$appropriate_germents_1}}
                                        >Yes
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <label class="form-check-label">
                                        <input type="radio" class="form-check-input" value="0" name="appropriate_germents" onclick="toggleRadioButton(this,'div')"{{$appropriate_germents_0}}
                                        >No
                                        </label>
                                    </div>
                                    @error('appropriate_germents')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror

                                    <div class="form-group "  @if($appropriate_germents == 1 || $appropriate_germents == '')  @else d-none @endif id="appropriate_germents_div">
                                        <div class="form-group">
                                            <label >Describe</label>

                                            <textarea class="form-check-input form-control" name="appropriate_germents_description" >@if(isset($appropriate_germents_description) ) {{$appropriate_germents_description}} @endif</textarea>
                                            @error('appropriate_germents_description')
                                                <div class="error">
                                                    {{$message}}
                                                </div>
                                            @enderror

                                        </div>
                                    </div>
                                </div>


                            </div>


                            <div class="col-md-12">
                            <a href="#image_presentation"  data-toggle="pill" onclick="toggleTabPill(this,'image_presentation')" class="btn btn-primary btn-lg">Next</a>
                            </div>
                            <!-- </form> -->
                    </div>
                    <div class="tab-pane fade" id="image_presentation">
                        <!-- <form class="row"> -->
                        <div class="row">
                            <div class="form-group col-md-12">
                                <div class="form-group">
                                    <label style="font-size: 14px;">Select images you would be happy to
                                        see team members wear in client
                                        facing roles
                                    </label>
                                    <!-- <select class= "form-control"  id="sel1">
                                        <option>Categories</option>
                                        <option>Corporate</option>
                                        <option>Smart Business </option>
                                        <option>Casual </option>
                                        <option>Combination </option>
                                    </select> -->
                                    <div class="row product_check">
                                        <div class="row">
                                            <div class="col-md-2" style="margin: 0 20px 0 20px;">
                                                <div class="product_box ">
                                                    <div class="product_img_box @if(in_array('Corporate',$client_facing_team_members_roles_arr)) active @endif ">

                                                        <img data-for="Corporate" src="{{ url('images/stylist/questions/corporate.jpg'); }}" >
                                                        <input type="checkbox" name="client_facing_team_members_roles_arr[]" @if(in_array('Corporate',$client_facing_team_members_roles_arr)) cheched @endif  value="Corporate">
                                                    </div>
                                                    <h6 class="text-center">Corporate</h6>
                                                </div>
                                            </div>

                                            <div class="col-md-2" >
                                                <div class="product_box ">
                                                    <div class="product_img_box  @if(in_array('Smart Business',$client_facing_team_members_roles_arr)) active @endif ">
                                                        <img data-for="Smart Business" src="{{ url('images/stylist/questions/smart-business.jpg'); }}" >
                                                        <input type="checkbox" name="client_facing_team_members_roles_arr[]" value="Smart Business" @if(in_array('Smart Business',$client_facing_team_members_roles_arr)) checked @endif >
                                                    </div>
                                                    <h6 class="text-center">Smart Business</h6>
                                                </div>
                                            </div>

                                            <div class="col-md-2" >
                                                <div class="product_box">
                                                    <div class="product_img_box @if(in_array('Smart Casual',$client_facing_team_members_roles_arr)) active @endif">

                                                        <img data-for="Smart Casual" src="{{ url('images/stylist/questions/smart casual.jpg'); }}" >
                                                         <input type="checkbox" name="client_facing_team_members_roles_arr[]" value="Smart Casual" @if(in_array('Smart Casual',$client_facing_team_members_roles_arr)) checked @endif>
                                                    </div>
                                                    <h6 class="text-center">Smart Casual</h6>
                                                </div>
                                            </div>

                                            <div class="col-md-2" >
                                                <div class="product_box">
                                                    <div class="product_img_box @if(in_array('Casual',$client_facing_team_members_roles_arr)) active @endif">

                                                        <img data-for="Casual" src="{{ url('images/stylist/questions/employe_onbording_stylist_defaut.jpg'); }}" >
                                                         <input type="checkbox" name="client_facing_team_members_roles_arr[]" value="Smart Casual" @if(in_array('Casual',$client_facing_team_members_roles_arr)) checked @endif>
                                                    </div>
                                                    <h6 class="text-center">Casual</h6>
                                                </div>
                                            </div>

                                            <div class="col-md-2" >
                                                <div class="product_box ">
                                                    <div class="product_img_box @if(in_array('Combination',$client_facing_team_members_roles_arr)) active @endif">

                                                        <img data-for="Combination" src="{{ url('images/stylist/questions/combination.jpg'); }}" >

                                                         <input type="checkbox" name="client_facing_team_members_roles_arr[]" value="Combination" @if(in_array('Combination',$client_facing_team_members_roles_arr)) checked @endif>
                                                    </div>
                                                    <h6 class="text-center">Combination</h6>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    @error('client_facing_team_members_roles_arr')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-3">
                                <label  style="font-size: 14px;">Can team members be more casual
                                    when not facing clients?</label>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="more_casual_status" value="1" onclick="toggleRadioButtonmorecasualstatus(this,'div')" {{$more_casual_status_1}}
                                    >Yes
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="more_casual_status" value="0" onclick="toggleRadioButtonmorecasualstatus(this,'div')" {{$more_casual_status_0}}
                                    >No
                                </label>
                                </div>
                                @error('more_casual_status')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
{{-- Next --}}
                            <div class="form-group col-md-12 more_casual_status-yes"  style="display:{{ $more_casual_status_attc_display;}}" >
                                <div class="form-group">
                                    <label  style="font-size: 14px;">Select images you would be happy to
                                        see team members wear internally
                                    </label>
                                    <div class="row product_check">
                                        <div class="col-md-2">
                                            <div class="product_box ">
                                                <div class="product_img_box @if(in_array('Corporate',$team_members_wear_internally_arr)) active @endif ">
                                                    <img data-for="Corporate" src="{{ url('images/stylist/questions/corporate.jpg'); }}" >

                                                    <input type="checkbox" name="team_members_wear_internally_arr[]" value="Corporate" @if(in_array('Corporate',$team_members_wear_internally_arr)) checked @endif>
                                                </div>
                                                <h6 class="text-center">Corporate</h6>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="product_box  @if(in_array('Smart Business',$team_members_wear_internally_arr)) active @endif ">
                                                <div class="product_img_box">
                                                    <img data-for="Smart Business" src="{{ url('images/stylist/questions/smart-business.jpg'); }}" >
                                                    <input type="checkbox" name="team_members_wear_internally_arr[]" value="Combination" @if(in_array('Smart Business',$team_members_wear_internally_arr)) checked @endif>
                                                </div>
                                                <h6 class="text-center">Smart Business</h6>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="product_box ">
                                                <div class="product_img_box @if(in_array('Smart Casual',$team_members_wear_internally_arr)) active @endif ">
                                                    <img data-for="Smart Casual" src="{{ url('images/stylist/questions/smart casual.jpg'); }}" >

                                                    <input type="checkbox" name="team_members_wear_internally_arr[]" value="Smart Casual" @if(in_array('Smart Casual',$team_members_wear_internally_arr)) checked @endif>

                                                </div>
                                                <h6 class="text-center">Smart Casual</h6>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="product_box ">
                                                <div class="product_img_box @if(in_array('Casual',$team_members_wear_internally_arr)) active @endif">
                                                    <img data-for="Casual" src="{{ url('images/stylist/questions/employe_onbording_stylist_defaut.jpg'); }}" >

                                                    <input type="checkbox" name="team_members_wear_internally_arr[]" value="Casual" @if(in_array('Casual',$team_members_wear_internally_arr)) checked @endif>

                                                </div>
                                                <h6 class="text-center">Casual</h6>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="product_box ">
                                                <div class="product_img_box  @if(in_array('Combination',$team_members_wear_internally_arr)) active @endif">
                                                    <img data-for="Combination" src="{{ url('images/stylist/questions/employe_onbording_stylist_defaut.jpg'); }}" >

                                                 <input type="checkbox" name="team_members_wear_internally_arr[]" value="Combination" @if(in_array('Combination',$team_members_wear_internally_arr)) checked @endif>

                                                </div>
                                                <h6 class="text-center">combination</h6>
                                            </div>
                                        </div>

                                    </div>

                                    @error('team_members_wear_internally_arr')
                                        <div class="error">
                                            {{$message}}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-4">

                                <label  style="text-align: justify;">In a few words can you describe what
                                impression you’d like your team
                                members to leave on your clients
                                and fellow collegues?Eg. Approachable, neat, forward thinking</label>

                                <textarea name="impression_description" class="form-control">@if(isset($impression_description)){{$impression_description}}@endif</textarea>
                                @error('impression_description')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label  style="font-size: 14px;">Does the company have a vision
                                and/or mission statement?
                                </label>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" name="vision_statement" class="form-check-input"  onclick="toggleRadioButtonVisionStatement(this)" value="1" {{$vision_statement_1}}
                                    >Yes
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="vision_statement" value="0" onclick="toggleRadioButtonVisionStatement(this)" {{$vision_statement_0}}
                                    >No
                                </label>
                                </div>
                                @error('vision_statement')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                                <div class="form-group vision-statement-yes " style="display:{{ $vision_statement_attc_display; }}">

                                    <div class="form-group">
                                        <label>Vision Statement Attachment</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="file" class="form-check-input" name="vision_statement_file">
                                                <input type="hidden" class="form-check-input" name="vision_statement_file" value="{{$vision_statement_file}}">
                                                <span>
                                                    @if ($vision_statement_file != '')
                                                      <img src="{{ url('uploads/stylist/'. $vision_statement_file)}}"   alt="" srcset="" style="width: 100px">
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
                            </div>



                            <div class="form-group col-md-4 vision-statement-yes @if(old('vision_statement') == 1 || old('vision_statement',NULL) == NULL) '' @else d-none @endif">
                                <div class="form-group">
                                    <label  style="font-size: 14px;">Vision Statement Description</label>

                                    <textarea class="form-check-input form-control" name="vision_statement_description">@if(isset($vision_statement_description)){{$vision_statement_description}}
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
                                <label  style="font-size: 14px;">Is there any additional information about the company brand or marketing strategy/documents that is relevant for DAPPR to know when selecting an image for your team members?</label>
                                <div class="form-check">
                                    <label class="form-check-label">
                                        <input type="radio" name="additional_info" class="form-check-input"  onclick="toggleRadioButtonAdditionalInfo(this)" value="1" {{$additional_info_1}}
                                        >Yes
                                    </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="additional_info" value="0" onclick="toggleRadioButtonAdditionalInfo(this)"
                                    {{$additional_info_0}} >No
                                </label>
                                </div>

                                @error('additional_info')
                                    <div class="error">
                                        {{$message}}
                                    </div>
                                @enderror
                                <div class="form-group additional-info-yes" style="display:{{$additional_info_attc_display;}}">

                                    <div class="form-group">
                                        <label>Additional Information Attachment</label>
                                        <div class="form-check">
                                            <label class="form-check-label">
                                                <input type="file" class="form-check-input" name="additional_info_file" >
                                                <input type="hidden" class="form-check-input" name="additional_info_file" value="{{$additional_info_file}}">
                                            </label>
                                            <span>
                                                @if ($additional_info_file!='')

                                                <img src="{{ url('uploads/stylist/'. $additional_info_file)}}"   alt="" srcset="" style="width: 100px">
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
                            </div>



                            <div class="form-group col-md-4 additional-info-yes @if(old('additional_info') == 1 || old('additional_info',NULL) == NULL) '' @else d-none @endif">
                                <div class="form-group">
                                    <label style="font-size: 14px;">Additional Information Description</label>

                                    <textarea class="form-check-input form-control" name="additional_info_description">@if(isset($additional_info_description)){{$additional_info_description}}@endif</textarea>
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

                                <label style="font-size: 14px;">What would you hope to see to
                                deem the rollout of the DAPPR
                                program a success for the company?
                                </label>

                                <textarea class="form-control" name="hope_description">@if(isset($hope_description)){{$hope_description}}@endif</textarea>
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
                    <div class="tab-pane fade" id="service_accounting">
                        <!-- <form class="row"> -->

                        <div class="row">
                            <div class="form-group col-md-6 text-justify">
                                <label style="font-size: 14px;" >As part of the DAPPR program,
                            organisations have the choice to
                            contribute an additional dollar value
                            on top of the service cost toward
                            clothing purchases for each employee involved with the DAPPR
                            program. Would you like to contribute an additional amount to employees clothing allowance per annum? <i>This amount will be evenly distributed over the 4 quarterly deliveries. Unspent will be carried over to the following quarter for each employee.</i></label>
                                <div class="form-group   ">
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="additional_amount_status" value="1" onclick="toggleRadioButton(this,'div')"  {{$additional_amount_status_1}}
                                    >Yes
                                </label>
                                </div>
                                <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="additional_amount_status" value="0" onclick="toggleRadioButton(this,'div')" {{$additional_amount_status_0}}
                                    >No
                                </label>
                                </div>

                                @error('additional_amount_status')
                                    <div class="error ">
                                        {{$message}}
                                    </div>
                                @enderror
                                </div>
                                <div class="form-group @if(old('additional_amount_status') == 1 || old('additional_amount_status',NULL) == NULL)  @else d-none @endif" id="additional_amount_status_div">
                                    <div class="form-group">
                                        <label >How much would the company like to contribute per employee, per annum?
                                        </label>
                                        <input type="text" name="additional_amount" class= "form-control"  value="{{$additional_amount}}" >

                                        @error('additional_amount')
                                            <div class="error">
                                                {{$message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>


                        </div>



                        <div class="col-md-12">
                            <button type="submit" class="btn btn-primary btn-lg">Submit</button>
                        </div>

                        <!-- </form> -->
                       <div class="col-md-12 d-none">
                            <h4 class="text-center">
                                <b>Thanks for taking the time to complete this questionnaire. We collate this information, confirm contracts and accounts and be in contact.
                                </b>
                            </h4>
                        </div>
                    </div>

            </div>

            </form>
           </div>

			</div> <!-- /.box -->
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
    function stylistHideShowClass(elem,show_hide_class = ''){

        if($(elem).val() == 1){
            $('.'+show_hide_class).show();
        }else{
            $('.'+show_hide_class).hide();

        }
    }

    function toggleRadioButtonDressPolicy(elem){
        if($(elem).val() == '1'){
            $('.dress-policy-yes').show();
            $('.dress-policy-no').addClass('d-none');
        }else{
            $('.dress-policy-yes'). hide();
            $('.dress-policy-no').removeClass('d-none');
        }
    }

    function toggleRadioButtonDiversityPolicy(elem){
        if($(elem).val() == '1'){
            $('.diversity-policy-yes').show();
            $('.diversity-policy-no').addClass('d-none');
        }else{
            $('.diversity-policy-yes').hide();
            $('.diversity-policy-no').removeClass('d-none');
        }
    }

    function toggleRadioButtonVisionStatement(elem){
        if($(elem).val() == '1'){
            $('.vision-statement-yes').show()
            $('.vision-statement-no').addClass('d-none');
        }else{
            $('.vision-statement-yes').hide()
            $('.vision-statement-no').removeClass('d-none');
        }
    }

    function toggleRadioButtonmorecasualstatus(elem){
        if($(elem).val() == '1'){
            $('.more_casual_status-yes').show()
            $('.more_casual_status-no').addClass('d-none');
        }else{
            $('.more_casual_status-yes').hide()
            $('.more_casual_status-no').removeClass('d-none');
        }
    }

    function toggleRadioButtonAdditionalInfo(elem){
        if($(elem).val() == '1'){
            $('.additional-info-yes').show();
            $('.additional-info-no').addClass('d-none');
        }else{
            $('.additional-info-yes').hide();
            $('.additional-info-no').removeClass('d-none');
        }
    }
    $(function(){
        $(".product_img_box img").click(function(){
            $(this).parents('.product_img_box').toggleClass('active');
            $(this).parent(".product_img_box").find('input[type="checkbox"]').trigger('click');

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
            @endif

            // $("a[href=#current_professional]").trigger('click');
            $(document).find('a[href="#company_information"], a[href="#current_professional"], a[href="#image_presentation"], a[href="#service_accounting"]').parent().removeClass('active');

            $("#company_information, #current_professional, #image_presentation, #service_accounting").removeClass('active in').addClass('fade');

            $(document).find('a[href="#{{ $tab }}"]').parent().addClass('active');

            $('#{{ $tab }}').addClass('active in').removeClass('fade');
        @endif
    });
</script>
@endsection
