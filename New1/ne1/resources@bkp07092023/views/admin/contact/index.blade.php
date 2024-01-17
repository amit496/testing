@extends('admin.layouts.master')
<style>
  /* .icheckbox_minimal-blue.massCheck, .btn-group, .massCheck, .massActionWrapper,.iCheck-helper */
  /* #massSelectArea .icheckbox_minimal-blue, .btn-group
  {
    display: none !important;
  } */
  
</style>
<style type="text/css">
  .read-more-show{
    cursor:pointer;
    color: #080808;
    font-weight: 900;
  }
  .read-more-hide{
    cursor:pointer;
    color: #080808;
    font-weight: 900;
  }

  .hide_content{
    display: none;
  }
</style>
@section('content')

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title">{{ trans('app.contact_us') }}</h3>
      <div class="box-tools pull-right">
        {{-- @can('create', \App\Models\Customer::class)
          <a href="javascript:void(0)" data-link="{{ route('admin.admin.customer.bulk') }}" class="ajax-modal-btn btn btn-default btn-flat">{{ trans('app.bulk_import') }}</a>
          <a href="javascript:void(0)" data-link="{{ route('admin.admin.customer.create') }}" class="ajax-modal-btn btn btn-new btn-flat">{{ trans('app.add_customer') }}</a>
        @endcan --}}
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover" id="all-contactus-table">
        <thead>
          <tr>              
            <th>{{ trans('app.name') }}</th>
            <th>{{ trans('app.phone') }}</th>
            <th>{{ trans('app.email') }}</th>
            <th>{{ trans('app.subject') }}</th>
            <th>{{ trans('app.message') }}</th>            
            <th>{{ trans('app.status') }}</th>        
            <th>{{ trans('app.option') }}</th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          @if (isset($contact_us_data) && !empty($contact_us_data))
           
            @foreach ($contact_us_data as $cud)            
              <tr>                
                <td>{{ $cud->name }}</td>
                <td>{{ $cud->phone }}</td>
                <td>{{ $cud->email }}</td>               
                  @if(strlen($cud->subject) > 20)
                  <td>
                    {{ substr(strip_tags($cud->subject),0,50) }}
                    <span class="read-more-show">Read More...</i></span>
                    <span class="read-more-content hide_content"> {{ substr(strip_tags($cud->subject),50,strlen(strip_tags($cud->subject))) }} 
                    <span class="read-more-hide hide_content">Less</span> </span>
                  </td>
                  @else
                  <td>{{ strip_tags($cud->subject) }}</td>
                  @endif
                              
                  @if(strlen($cud->message) > 25)
                  <td>
                    {{ substr(strip_tags($cud->message),0,50) }}
                    <span class="read-more-show">Read More...</i></span>
                    <span class="read-more-content hide_content"> {{ substr(strip_tags($cud->message),50,strlen(strip_tags($cud->message))) }} 
                    <span class="read-more-hide hide_content">Less</span> </span>
                  </td>
                  @else
                  <td>{{ strip_tags($cud->message) }}</td>
                  @endif
                {{-- <td>{{ strip_tags($cud->message)}}</td> --}}
                <td>
                  @if($cud->read_msg == 0)
                  <span class="label label-success ">{{ trans('app.unread') }}</span>
                  @else                    
                  <span class="label label-default">{{ trans('app.read') }}</span>
                  @endif
                  
                </td>
                <td>
                    @if ($cud->read_msg == 0)
                      {!! Form::open(['route' => ['admin.contactus.readed',$cud->id ], 'method' => 'get', 'class' => 'data-form']) !!}
                      {!! Form::button('<i class="glyphicon glyphicon-eye-open"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.readed_now'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                      {!! Form::close() !!}
                    @endif
                  {!! Form::open(['route' => ['admin.contactus.trash',$cud->id ], 'method' => 'delete', 'class' => 'data-form']) !!}
                  {!! Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']) !!}
                  {!! Form::close() !!}
                </td>
              </tr>              
            @endforeach
          @endif
        </tbody>
      </table>
      {{-- {{ $contact_us_data->links() }} --}}
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
@endsection
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
    // Hide the extra content initially, using JS so that if JS is disabled, no problemo:
      $('.read-more-content').addClass('hide_content')
      $('.read-more-show, .read-more-hide').removeClass('hide_content')

      // Set up the toggle effect:
      $('.read-more-show').on('click',this, function(e) {
        $(this).next('.read-more-content').removeClass('hide_content');
        $(this).addClass('hide_content');
        e.preventDefault();
      });

      // Changes contributed by @diego-rzg
      $('.read-more-hide').on('click', function(e) {
        var p = $(this).parent('.read-more-content');
        p.addClass('hide_content');
        p.prev('.read-more-show').removeClass('hide_content'); // Hide only the preceding "Read More"
        e.preventDefault();
      });
      $("#all-contactus-table").DataTable({
        "lengthChange": false,
        "language": {
          "paginate": {
            "previous": "<i class='fa fa-hand-o-left'></i>",
            "next": "<i class='fa fa-hand-o-right'></i>",
          }
        }
      });
    });
    </script>
