@extends('admin.layouts.master')
@section('content')
<link href="{{ url('css/frotend-stylist-form-common-all.css?').rand(10,1000) }}" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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

<div class="container update_question stf_outer_body stf_side_bar_not_hide">

        <h3 style="margin-left: 50px">Manage Question Text</h3>

    <div class="main">


         <div class="row">
            <select class="form-control question_catogaries" id="QuestionCatogaries" name="catagory" onchange="question_update_select_cat(this)">
                <option value=""  selected>All Category</option>
                @if($question_catogaries_list->isNotEmpty()){
                    @foreach ($question_catogaries_list as $cat_info){
                        <option value="{{$cat_info->id}}" >{{$cat_info->name}}</option>
                    }
                    @endforeach
                @endif
            </select>
            <select class="form-control question_list"  name="question_list" onchange="question_update_select_question(this)">
                <option value=""  selected>Select Questions</option>
                @if($question_list->isNotEmpty()){
                    @foreach ($question_list as $q_info){
                        <option value="{{$q_info->id}}" categroy_id="{{ $q_info->question_catogary;}}" >{{ strip_tags($q_info->name); }}</option>
                    }
                    @endforeach
                @endif
            </select>
        </div>
    </div>

        <div class="question_update_html"></div>

</div>



@endsection
@section('page-script')
@include('admin.stylist_form.common')

@endsection

