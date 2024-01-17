<?php $__env->startSection('content'); ?>
<link href="<?php echo e(url('css/frotend-stylist-form-common-all.css?').rand(10,1000), false); ?>" rel="stylesheet">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<?php if(session('success')): ?>
<div class="alert <?php echo e(Session::get('alert-class', 'alert-info'), false); ?> alert-dismissible fade show">
    <?php echo e(session('success'), false); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>
<?php if(session('error')): ?>
<div class="alert <?php echo e(Session::get('alert-class', 'alert-info'), false); ?> alert-danger  fade show">
    <?php echo e(session('error'), false); ?>

    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php endif; ?>

<div class="container update_question stf_outer_body stf_side_bar_not_hide">

        <h3 style="margin-left: 50px">Manage Question Text</h3>

    <div class="main">


         <div class="row">
            <select class="form-control question_catogaries" id="QuestionCatogaries" name="catagory" onchange="question_update_select_cat(this)">
                <option value=""  selected>All Category</option>
                <?php if($question_catogaries_list->isNotEmpty()): ?>{
                    <?php $__currentLoopData = $question_catogaries_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $cat_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
                        <option value="<?php echo e($cat_info->id, false); ?>" ><?php echo e($cat_info->name, false); ?></option>
                    }
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
            <select class="form-control question_list"  name="question_list" onchange="question_update_select_question(this)">
                <option value=""  selected>Select Questions</option>
                <?php if($question_list->isNotEmpty()): ?>{
                    <?php $__currentLoopData = $question_list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $q_info): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>{
                        <option value="<?php echo e($q_info->id, false); ?>" categroy_id="<?php echo e($q_info->question_catogary, false); ?>" ><?php echo e(strip_tags($q_info->name), false); ?></option>
                    }
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </select>
        </div>
    </div>

        <div class="question_update_html"></div>

</div>



<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-script'); ?>
<?php echo $__env->make('admin.stylist_form.common', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/stylist_form/update_question_answer_text.blade.php ENDPATH**/ ?>