<?php $__env->startSection('content'); ?>
    <style>
        .scale{
            transform: scale(1.2);
        }
    </style>
    <div style="padding-left: 12px;">
        <h4>Appointment Scheduling</h4>
        <p>Set your weekly hours for employees to bookin<br>Getting to know you styling meetings.</p>
    </div>
    
    <?php
        $edit_id = 0;
        $monday = '';
        $monday_key = '';
        if (isset($merchantAvailability_data)) {
            foreach ($merchantAvailability_data as $key => $value) {
                if (isset($key) && $key == 1) {
                    $monday_key = 1;
                    foreach ($value as $k => $v) {
                        $edit_id = $k;
                        $monday .=
                            '
                            
                    <div class="Appointment-box Appointment-box-length">
                            <div class="input-group mb-3">
                                <input type="hidden" name="monday_edit_id[]" value="' .
                            $edit_id .
                            '">
                                <input list="browsers" name="monday_start[]" class="input-width start_availability_time" value="' .
                            $v['start'] .
                            '">

                                <datalist id="browsers">
                                    <option>08:00am</option>
                                    <option>08:30am</option>
                                    <option>09:00am</option>
                                    <option>09:30am</option>
                                    <option>10:00am</option>
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                    <option>03:00pm</option>
                                    <option>03:30pm</option>
                                    <option>04:00pm</option>
                                    <option>04:30pm</option>
                                    <option>05:00pm</option>
                                    <option>05:30pm</option>
                                    <option>06:00pm</option>
                                </datalist>
                            </div>
                            <span><i class="fa fa-minus"></i></span>
                            <div class="input-group mb-3">
                                <input list="browsers" name="monday_end[]" class="input-width end_availability_time" value="' .
                            $v['end'] .
                            '" >
                                <datalist id="browsers" >
                                    <option>08:00am</option>
                                    <option>08:30am</option>
                                    <option>09:00am</option>
                                    <option>09:30am</option>
                                    <option>10:00am</option>
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <a class="remove_row" title="Remove" id="row-data" href="' .
                            url('admin/stylist/availability/delete/') .
                            '/' .
                            $k .
                            '"><i class="fa fa-trash"></i></a>
                        </div>';
                    }
                }
            }
        }
        
        $tuesday = '';
        $tuesday_key = '';
        if (isset($merchantAvailability_data)) {
            foreach ($merchantAvailability_data as $key => $value) {
                if (isset($key) && $key == 2) {
                    $tuesday_key = 2;
                    foreach ($value as $k => $v) {
                        $edit_id = $k;
                        $tuesday .=
                            '
                    <div class="Appointment-box Appointment-box-length">
                            <div class="input-group mb-3">
                                <input type="hidden"  name="tuesday_edit_id[]" value="' .
                            $edit_id .
                            '">
                                <input list="browsers" name="tuesday_start[]" class="input-width start_availability_time" value="' .
                            $v['start'] .
                            '">

                                <datalist id="browsers">
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <span><i class="fa fa-minus"></i></span>
                            <div class="input-group mb-3">
                                <input list="browsers" name="tuesday_end[]" class="input-width end_availability_time" value="' .
                            $v['end'] .
                            '" >
                                <datalist id="browsers" >
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <a  class="remove_row" title="Remove" id="row-data" href="' .
                            url('admin/stylist/availability/delete/') .
                            '/' .
                            $k .
                            '"><i class="fa fa-trash"></i></a>
                        </div>';
                    }
                }
            }
        }
        
        $wednesday = '';
        $wednesday_key = '';
        if (isset($merchantAvailability_data)) {
            foreach ($merchantAvailability_data as $key => $value) {
                if (isset($key) && $key == 3) {
                    $wednesday_key = 3;
                    foreach ($value as $k => $v) {
                        $edit_id = $k;
                        $wednesday .=
                            '
                    <div class="Appointment-box Appointment-box-length">
                            <div class="input-group mb-3">
                                <input type="hidden" name="wednesday_edit_id[]" value="' .
                            $edit_id .
                            '">
                                <input list="browsers" name="wednesday_start[]" class="input-width start_availability_time" value="' .
                            $v['start'] .
                            '">

                                <datalist id="browsers">
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <span><i class="fa fa-minus"></i></span>
                            <div class="input-group mb-3">
                                <input list="browsers" name="wednesday_end[]" class="input-width end_availability_time" value="' .
                            $v['end'] .
                            '" >
                                <datalist id="browsers" >
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <a  class="remove_row" title="Remove" id="row-data" href="' .
                            url('admin/stylist/availability/delete/') .
                            '/' .
                            $k .
                            '"><i class="fa fa-trash"></i></a>
                        </div>';
                    }
                }
            }
        }
        
        $thursday = '';
        $thursday_key = '';
        if (isset($merchantAvailability_data)) {
            foreach ($merchantAvailability_data as $key => $value) {
                if (isset($key) && $key == 4) {
                    $thursday_key = 4;
                    foreach ($value as $k => $v) {
                        $edit_id = $k;
                        $thursday .=
                            '
                    <div class="Appointment-box Appointment-box-length">
                            <div class="input-group mb-3">
                                <input type="hidden" name="thursday_edit_id[]" value="' .
                            $edit_id .
                            '">
                                <input list="browsers" name="thursday_start[]" class="input-width start_availability_time" value="' .
                            $v['start'] .
                            '">

                                <datalist id="browsers">
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <span><i class="fa fa-minus"></i></span>
                            <div class="input-group mb-3">
                                <input list="browsers" name="thursday_end[]" class="input-width end_availability_time" value="' .
                            $v['end'] .
                            '" >
                                <datalist id="browsers" >
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <a class="remove_row" title="Remove" id="row-data" href="' .
                            url('admin/stylist/availability/delete/') .
                            '/' .
                            $k .
                            '"><i class="fa fa-trash"></i></a>
                        </div>';
                    }
                }
            }
        }
        
        $friday = '';
        $friday_key = '';
        $dayscheckbox = [];
        if (isset($merchantAvailability_data)) {
            foreach ($merchantAvailability_data as $key => $value) {
                $dayscheckbox[$key] = $key;
                if (isset($key) && $key == 5) {
                    $friday_key = 5;
                    foreach ($value as $k => $v) {
                        $edit_id = $k;
                        $friday .=
                            '
                    <div class="Appointment-box Appointment-box-length">
                            <div class="input-group mb-3">
                                <input type="hidden" name=" []" value="' .
                            $edit_id .
                            '">
                                <input list="browsers" name="friday_start[]" class="input-width start_availability_time" value="' .
                            $v['start'] .
                            '">

                                <datalist id="browsers">
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <span><i class="fa fa-minus"></i></span>
                            <div class="input-group mb-3">
                                <input list="browsers" name="friday_end[]" class="input-width end_availability_time" value="' .
                            $v['end'] .
                            '" >
                                <datalist id="browsers" >
                                    <option>10:00am</option>
                                    <option>10:30am</option>
                                    <option>11:00am</option>
                                    <option>11:30am</option>
                                    <option>12:00pm</option>
                                    <option>12:30pm</option>
                                    <option>01:00pm</option>
                                    <option>01:30pm</option>
                                    <option>02:00pm</option>
                                    <option>02:30pm</option>
                                </datalist>
                            </div>
                            <a  class="remove_row" title="Remove" id="row-data" href="' .
                            url('admin/stylist/availability/delete/') .
                            '/' .
                            $k .
                            '"><i class="fa fa-trash"></i></a>
                        </div>';
                    }
                }
            }
        }
        
        if (count($dayscheckbox)) {
            $dayscheckbox = implode(',', $dayscheckbox);
        } else {
            $dayscheckbox = '';
        }
        
    ?>

    <form action="<?php echo e(url('/'), false); ?>/admin/stylist/availability/time" method="post" id="merchant_availibility">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="merchant_ids" value="<?php echo e($id, false); ?>">
        <input type="hidden" name="dayscheckbox" id="dayscheckbox" value="<?php echo e($dayscheckbox, false); ?>">

        <div class="appointment-scheduling-style" id="main_box_calendar">
            <div class="Appointment-costom Appointment-box-costom "style="position: relative;">
                <div class="Appointment-text">
                    <input class="form-check-input weekdayname" name="day[]"
                        <?php if(isset($monday_key) && $monday_key == 1){ echo "checked";} ?> type="checkbox"
                        check-data-day="monday" value="1">
                    <h3>MONDAY</h3>
                </div>
                <div
                    class="Appointment-box-sa <?php if(isset($monday_key) && $monday_key == 1){ echo ''; }else { echo "Appointment-box-hide"; } ?> ">
                    <?php
                        if (isset($monday)) {
                            echo $monday;
                        } else {
                            echo '<div class="Appointment-box-sa Appointment-box-hide">
                    <div class="Appointment-box Appointment-box-length">
                        <div class="input-group mb-3">
                            <input type="hidden" name="monday_edit_id[]" value="' .
                                $edit_id .
                                '">
                            <input list="browsers" name="monday_start[]" class="input-width start_availability_time" >
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <span><i class="fa fa-minus"></i></span>
                        <div class="input-group mb-3">
                            <input list="browsers" name="monday_end[]" class="input-width end_availability_time" >
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <a class="remove_row" title="Remove"><i class="fa fa-trash"></i></a>
                    </div>
                </div>';
                        }
                    ?>
                </div>
                <div
                    class="Appointment-add-new <?php if(isset($monday_key) && $monday_key == 1){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <a class="add_new_row" title="Add"><i class="fa fa-plus"></i></a>
                </div>
                
            </div>

            <div class="Appointment-costom Appointment-box-costom "style="position: relative;">
                <div class="Appointment-text">
                    <input class="form-check-input weekdayname" name="day[]" type="checkbox" check-data-day="tuesday"
                        value="2" <?php if(isset($tuesday_key) && $tuesday_key == 2){ echo "checked";} ?>>
                    <h3>TUESDAY</h3>
                </div>
                <div
                    class="Appointment-box-sa <?php if(isset($tuesday_key) && $tuesday_key == 2){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <?php
                        if (isset($tuesday)) {
                            echo $tuesday;
                        } else {
                            echo '<div class="Appointment-box Appointment-box-length">
                        <div class="input-group mb-3">
                            <input type="hidden"  name="tuesday_edit_id[]" value="' .
                                $edit_id .
                                '">
                            <input list="browsers" name="tuesday_start[]" class="input-width start_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <span><i class="fa fa-minus"></i></span>
                        <div class="input-group mb-3">
                            <input list="browsers" name="tuesday_end[]" class="input-width end_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <a class="remove_row" title="Remove"><i class="fa fa-trash"></i></a>
                    </div>';
                        }
                    ?>
                </div>
                <div class="Appointment-add-new Appointment-box-hide">
                    <a class="add_new_row" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>

            <div class="Appointment-costom Appointment-box-costom "style="position: relative;">
                <div class="Appointment-text">
                    <input class="form-check-input weekdayname" name="day[]" type="checkbox" check-data-day="wednesday"
                        value="3" <?php if(isset($wednesday_key) && $wednesday_key == 3){ echo "checked";} ?>>
                    <h3>WEDNESDAY</h3>
                </div>
                <div
                    class="Appointment-box-sa <?php if(isset($wednesday_key) && $wednesday_key == 3){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <?php
                        if (isset($wednesday)) {
                            echo $wednesday;
                        } else {
                            echo '<div class="Appointment-box Appointment-box-length">
                        <div class="input-group mb-3">
                            <input type="hidden" name="wednesday_edit_id[]" value="' .
                                $edit_id .
                                '">
                            <input list="browsers" name="wednesday_start[]" class="input-width start_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <span><i class="fa fa-minus"></i></span>
                        <div class="input-group mb-3">
                            <input list="browsers" name="wednesday_end[]" class="input-width end_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <a class="remove_row" title="Remove"><i class="fa fa-trash"></i></a>
                    </div>';
                        }
                    ?>
                </div>
                <div
                    class="Appointment-add-new <?php if(isset($wednesday_key) && $wednesday_key == 3){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <a class="add_new_row" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>

            <div class="Appointment-costom Appointment-box-costom "style="position: relative;">
                <div class="Appointment-text">
                    <input class="form-check-input weekdayname" name="day[]" type="checkbox" check-data-day="thursday"
                        value="4" <?php if(isset($thursday_key) && $thursday_key == 4){ echo "checked";} ?>>
                    <h3>THURSDAY</h3>
                </div>
                <div
                    class="Appointment-box-sa <?php if(isset($thursday_key) && $thursday_key == 4){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <?php
                        if (isset($thursday)) {
                            echo $thursday;
                        } else {
                            echo '<div class="Appointment-box Appointment-box-length">
                        <div class="input-group mb-3">
                            <input type="hidden" name="thursday_edit_id[]" value="' .
                                $edit_id .
                                '">
                            <input list="browsers" name="thursday_start[]" class="input-width start_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <span><i class="fa fa-minus"></i></span>
                        <div class="input-group mb-3">
                            <input list="browsers" name="thursday_end[]" class="input-width  end_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <a class="remove_row" title="Remove"><i class="fa fa-trash"></i></a>
                    </div>';
                        }
                    ?>

                </div>
                <div
                    class="Appointment-add-new <?php if(isset($thursday_key) && $thursday_key == 4){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <a class="add_new_row" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>

            <div class="Appointment-costom Appointment-box-costom "style="position: relative;">
                <div class="Appointment-text">
                    <input class="form-check-input weekdayname" name="day[]" type="checkbox" check-data-day="friday"
                        value="5" <?php if(isset($friday_key) && $friday_key == 5){ echo "checked";} ?>>
                    <h3>FRIDAY</h3>
                </div>
                <div
                    class="Appointment-box-sa <?php if(isset($friday_key) && $friday_key == 5){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <?php
                        if (isset($friday)) {
                            echo $friday;
                        } else {
                            echo '<div class="Appointment-box Appointment-box-length">
                        <div class="input-group mb-3">
                            <input type="hidden" name="friday_edit_id[]" value="' .
                                $edit_id .
                                '">
                            <input list="browsers" name="friday_start[]" class="input-width start_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <span><i class="fa fa-minus"></i></span>
                        <div class="input-group mb-3">
                            <input list="browsers" name="friday_end[]" class="input-width end_availability_time">
                            <datalist id="browsers">
                                <option>10:00am</option>
                                <option>10:30am</option>
                                <option>11:00am</option>
                                <option>11:30am</option>
                                <option>12:00pm</option>
                                <option>12:30pm</option>
                                <option>01:00pm</option>
                                <option>01:30pm</option>
                                <option>02:00pm</option>
                                <option>02:30pm</option>
                            </datalist>
                        </div>
                        <a class="remove_row" title="Remove"><i class="fa fa-trash"></i></a>
                    </div>';
                        }
                    ?>

                </div>
                <div
                    class="Appointment-add-new <?php if(isset($friday_key) && $friday_key == 5){ echo ''; }else { echo "Appointment-box-hide"; } ?>">
                    <a class="add_new_row" title="Add"><i class="fa fa-plus"></i></a>
                </div>
            </div>
            <span id="timesub" onclick="handleData_merchant()">Submit</span>

        </div>
    </form>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-style'); ?>
    <link rel="stylesheet" href="<?php echo e(asset('css/backend-stylist-form.css'), false); ?>">
<?php $__env->stopSection(); ?>
<?php $__env->startSection('page-script'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.4/jquery.validate.min.js"
        integrity="sha512-FOhq9HThdn7ltbK8abmGn60A/EMtEzIzv1rvuh+DqzJtSGq8BRdEN0U+j0iKEIffiw/yEtVuladk6rsG4X6Uqg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        // jQuery(window).load(function() {
        //     alert('load function run');
        // });
        jQuery(document).ready(function() {


            // $("body").load( "ajax/test.html", function() {
            //     alert( "Load was performed." );
            //     });


            // $("#main_box_calendar").find("checkbox").each(function(){
            //    if ($(this).prop('checked')==true){
            //       alert('checkeed');
            //    }
            // });
            var weekday_arr = [];
            //On Checkbox click show DOM
            jQuery('input[type="checkbox"]').click(function() {
                if (jQuery(this).prop("checked") == true) {
                    // console.log('checked');
                    weekday_arr.push(jQuery(this).val());
                    jQuery("#dayscheckbox").val(weekday_arr);
                    jQuery(this).parent().closest('div.Appointment-costom').children(
                        'div.Appointment-box-sa').removeClass('Appointment-box-hide');
                    jQuery(this).parent().closest('div.Appointment-costom').children(
                        'div.Appointment-add-new').removeClass('Appointment-box-hide');
                } else if (jQuery(this).prop("checked") == false) {
                    jQuery("#dayscheckbox").val(removeValueArray(weekday_arr, jQuery(this).val()));
                    jQuery(this).parent().closest('div.Appointment-costom').children(
                        'div.Appointment-box-sa').addClass('Appointment-box-hide');
                    jQuery(this).parent().closest('div.Appointment-costom').children(
                        'div.Appointment-add-new').addClass('Appointment-box-hide');
                }
            });

            // On remove click remove specific part in DOM
            jQuery(document).on('click', '.remove_row', function() {
                if (jQuery(this).parent().closest('.Appointment-box-costom').find('.Appointment-box-length')
                    .length != 0) {
                    jQuery(this).parent().closest('div.Appointment-box').remove();
                }
            });
            // On add click Add specific part in DOM
            jQuery(".add_new_row").on('click', function() {
                if (jQuery(this).parent().closest('.Appointment-box-costom').find('.Appointment-box-length')
                    .length != 6) {
                    var parent_checkbox_val = jQuery(this).parent().closest('div.Appointment-costom').find(
                        '.weekdayname').val();
                    var checkbox_data_day = jQuery(this).parent().closest('div.Appointment-costom').find(
                        'input.weekdayname').attr("check-data-day");
                    // console.log('parent_checkbox_val: ' + parent_checkbox_val + ' checkbox_data_day:' + checkbox_data_day);
                    // $('.start_availability_time').att('oninput', 'FunctionName(time_validation);');
                    // <option>08:00am</option>
                    //                 <option>08:30am</option>
                    //                 <option>09:00am</option>
                    //                 <option>09:30am</option>
                    // <option>03:00pm</option>
                    // <option>03:30pm</option>
                    // <option>04:00pm</option>
                    // <option>04:30pm</option>
                    // <option>05:00pm</option>
                    // <option>05:30pm</option>
                    // <option>06:00pm</option>
                    var html_part_add =

                        '<div class="Appointment-box Appointment-box-length"style="padding-left: 12px;"><div class="input-group mb-3"><input type="hidden" list="browsers" name="' +
                        checkbox_data_day +
                        '_edit_id[]" class="input-width " value="0"><input list="browsers" name="' +
                        checkbox_data_day +
                        '_start[]" class="input-width start_availability_time" autocomplete="off"> <datalist id="browsers"><option>08:00am</option><option>08:30am</option><option>09:00am</option><option>09:30am</option><option>10:00am</option><option>10:30am</option><option>11:00am</option><option>11:30am</option><option>12:00pm</option><option>12:30pm</option><option>01:00pm</option><option>01:30pm</option><option>02:00pm</option><option>02:30pm</option><option>03:00pm</option><option>03:30pm</option><option>04:00pm</option><option>04:30pm</option><option>05:00pm</option><option>05:30pm</option><option>06:00pm</option></datalist></div><span><i class="fa fa-minus"></i></span><div class="input-group mb-3"><input list="browsers" name="' +
                        checkbox_data_day +
                        '_end[]" class="input-width end_availability_time" autocomplete="off"><datalist id="browsers"><option>08:00am</option><option>08:30am</option><option>09:00am</option><option>09:30am</option><option>10:00am</option><option>10:30am</option><option>11:00am</option><option>11:30am</option><option>12:00pm</option><option>12:30pm</option><option>01:00pm</option><option>01:30pm</option><option>02:00pm</option><option>02:30pm</option><option>03:00pm</option><option>03:30pm</option><option>04:00pm</option><option>04:30pm</option><option>05:00pm</option><option>05:30pm</option><option>06:00pm</option></datalist></div><a class="remove_row" title="Remove" ><i class="fa fa-trash"></i></a></div>';

                    jQuery(this).parent().closest('div.Appointment-costom').append(html_part_add);
                }
            });
        });

        function removeValueArray(arr, val) {
            var arrayItem = arr;
            var itemRemove = val;
            if (arrayItem.length != 0 && itemRemove.length != 0) {
                arrayItem.splice(arrayItem.indexOf(itemRemove), 1)
                return arrayItem;
            }
        }


        function handleData_merchant() {
            var error = true;
            jQuery('.Appointment-box-costom .error_on_field').removeClass('error_on_field');
            jQuery('.weekdayname:checked').each(function() {
                var day = jQuery(this).val();
                console.log(day);
                jQuery(this).closest('.Appointment-box-costom').find('.start_availability_time').each(function() {
                    var start_time = jQuery(this).val();
                    var end_time = jQuery(this).closest('.Appointment-box-length').find(
                        '.end_availability_time').val();
                    console.log("start_time " + start_time);
                    console.log("end_time " + end_time);


                    console.log(parseInt(start_time));
                    console.log(parseInt(end_time));

                    if (start_time == '') {
                        error = false;
                        jQuery(this).addClass('error_on_field');
                    }
                    if (end_time == '') {
                        jQuery(this).closest('.Appointment-box-length').find('.end_availability_time').addClass('error_on_field');
                        error = false;
                    }

                    //   if(start_time < end_time){
                    //      error =  false;
                    //      jQuery(this).addClass('error_on_field');
                    //   }

                    if (start_time == end_time) {
                        error = false;
                        jQuery(this).addClass('error_on_field');
                    }


                    var date = new Date();
                    let day = date.getDate();
                    let month = date.getMonth() + 1;
                    let year = date.getFullYear();
                    console.log();
                    // This arrangement can be altered based on how we want the date's format to appear.
                    // let currentDate = `${day}-${month}-${year}`;
                    // let currentDate = `${day}-${month}-${year}`;
                    let currentDate = day + '/' + month + '/' + year;
                    console.log("start_time: "+start_time);
                    start_time_new  = start_time.replace('pm','');
                    start_time_new  = start_time_new.replace('am','');
                    end_time_new  = end_time.replace('pm','');
                    end_time_new  = end_time_new.replace('am','');
                    var diff = ( new Date("1970-1-1 " + end_time_new) - new Date("1970-1-1 " + start_time_new) ) / 1000 / 60 / 60;  
                    console.log("diff"+diff)
                    // var timeStart = (currentDate + start_time).getHours();
                    // console.log("timeStart: "+timeStart);
                    // var timeEnd = (currentDate + end_time).getHours();
                    // var minDiff = end_time - start_time;

                    // console.log(typeof('end_time' + end_time));
                    // console.log(typeof('start_timeend_time' + start_time));
                    

                    // if (diff != 0.5) {
                    //     console.log(diff);
                    //     console.log('1111111');
                    //     minDiff = 24 + diff;
                    //     // jQuery(this).addClass('error_on_field');
                    //     jQuery(this).closest('.Appointment-box-length').find('.end_availability_time').addClass('error_on_field');
                    //     error = false;
                    // }


                    // console.log(currentDate); 

                });
            });

            if (error) {
                jQuery("#merchant_availibility").submit();
            }
        }

        $(document).ready(function() {
            const date = new Date();
            let day = date.getDate();
            let month = date.getMonth() + 1;
            let year = date.getFullYear();
            // This arrangement can be altered based on how we want the date's format to appear.
            // let currentDate = `${day}-${month}-${year}`;
            // let currentDate = `${day}-${month}-${year}`;
            let currentDate = day + '/' + month + '/' + year;

            console.log(currentDate);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('admin.layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\resources\views/admin/stylist_form/merchant_availability.blade.php ENDPATH**/ ?>