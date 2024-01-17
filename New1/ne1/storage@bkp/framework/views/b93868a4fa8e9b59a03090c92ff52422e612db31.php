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
<?php $__env->startSection('content'); ?>

  <div class="box">
    <div class="box-header with-border">
      <h3 class="box-title"><?php echo e(trans('app.contact_us'), false); ?></h3>
      <div class="box-tools pull-right">
        
      </div>
    </div> <!-- /.box-header -->
    <div class="box-body">
      <table class="table table-hover" id="all-contactus-table">
        <thead>
          <tr>              
            <th><?php echo e(trans('app.name'), false); ?></th>
            <th><?php echo e(trans('app.phone'), false); ?></th>
            <th><?php echo e(trans('app.email'), false); ?></th>
            <th><?php echo e(trans('app.subject'), false); ?></th>
            <th><?php echo e(trans('app.message'), false); ?></th>            
            <th><?php echo e(trans('app.status'), false); ?></th>        
            <th><?php echo e(trans('app.option'), false); ?></th>
          </tr>
        </thead>
        <tbody id="massSelectArea">
          <?php if(isset($contact_us_data) && !empty($contact_us_data)): ?>
           
            <?php $__currentLoopData = $contact_us_data; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cud): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>            
              <tr>                
                <td><?php echo e($cud->name, false); ?></td>
                <td><?php echo e($cud->phone, false); ?></td>
                <td><?php echo e($cud->email, false); ?></td>               
                  <?php if(strlen($cud->subject) > 20): ?>
                  <td>
                    <?php echo e(substr(strip_tags($cud->subject),0,50), false); ?>

                    <span class="read-more-show">Read More...</i></span>
                    <span class="read-more-content hide_content"> <?php echo e(substr(strip_tags($cud->subject),50,strlen(strip_tags($cud->subject))), false); ?> 
                    <span class="read-more-hide hide_content">Less</span> </span>
                  </td>
                  <?php else: ?>
                  <td><?php echo e(strip_tags($cud->subject), false); ?></td>
                  <?php endif; ?>
                              
                  <?php if(strlen($cud->message) > 25): ?>
                  <td>
                    <?php echo e(substr(strip_tags($cud->message),0,50), false); ?>

                    <span class="read-more-show">Read More...</i></span>
                    <span class="read-more-content hide_content"> <?php echo e(substr(strip_tags($cud->message),50,strlen(strip_tags($cud->message))), false); ?> 
                    <span class="read-more-hide hide_content">Less</span> </span>
                  </td>
                  <?php else: ?>
                  <td><?php echo e(strip_tags($cud->message), false); ?></td>
                  <?php endif; ?>
                
                <td>
                  <?php if($cud->read_msg == 0): ?>
                  <span class="label label-success "><?php echo e(trans('app.unread'), false); ?></span>
                  <?php else: ?>                    
                  <span class="label label-default"><?php echo e(trans('app.read'), false); ?></span>
                  <?php endif; ?>
                  
                </td>
                <td>
                    <?php if($cud->read_msg == 0): ?>
                      <?php echo Form::open(['route' => ['admin.contactus.readed',$cud->id ], 'method' => 'get', 'class' => 'data-form']); ?>

                      <?php echo Form::button('<i class="glyphicon glyphicon-eye-open"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.readed_now'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                      <?php echo Form::close(); ?>

                    <?php endif; ?>
                  <?php echo Form::open(['route' => ['admin.contactus.trash',$cud->id ], 'method' => 'delete', 'class' => 'data-form']); ?>

                  <?php echo Form::button('<i class="glyphicon glyphicon-trash"></i>', ['type' => 'submit', 'class' => 'confirm ajax-silent', 'title' => trans('app.delete_permanently'), 'data-toggle' => 'tooltip', 'data-placement' => 'top']); ?>

                  <?php echo Form::close(); ?>

                </td>
              </tr>              
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
          <?php endif; ?>
        </tbody>
      </table>
      
    </div> <!-- /.box-body -->
  </div> <!-- /.box -->
<?php $__env->stopSection(); ?>
<script src="https://code.jquery.com/jquery-1.10.2.js"></script>
  <script type="text/javascript">
  $(document).ready(function() {
      $("#all-contactus-table").DataTable({
        "lengthChange": false,
        "language": {
          "paginate": {
            "previous": "<i class='fa fa-hand-o-left'></i>",
            "next": "<i class='fa fa-hand-o-right'></i>",
          }
        }
      });
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
      
    });
    </script>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/dappr/public_html/test.dappr.com.au/resources/views/admin/contact/index.blade.php ENDPATH**/ ?>