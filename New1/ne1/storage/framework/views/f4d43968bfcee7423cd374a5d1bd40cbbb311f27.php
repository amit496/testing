<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media  only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }
    </style>
</head>

<?php

$style = [
    /* Layout ------------------------------ */

    'body' => 'margin: 0; padding: 0; width: 100%; background-color: #F2F4F6;',
    'email-wrapper' => 'width: 100%; margin: 0; padding: 0; background-color: #F2F4F6;',

    /* Masthead ----------------------- */

    'email-masthead' => 'padding: 25px 0; text-align: center;',
    'email-masthead_name' => 'font-size: 16px; font-weight: bold; color: #2F3133; text-decoration: none; text-shadow: 0 1px 0 white;',

    'email-body' => 'width: 100%; margin: 0; padding: 0; border-top: 1px solid #EDEFF2; border-bottom: 1px solid #EDEFF2; background-color: #FFF;',
    'email-body_inner' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0;',
    'email-body_cell' => 'padding: 35px;',

    'email-footer' => 'width: auto; max-width: 570px; margin: 0 auto; padding: 0; text-align: center;',
    'email-footer_cell' => 'color: #AEAEAE; padding: 35px; text-align: center;',

    /* Body ------------------------------ */

    'body_action' => 'width: 100%; margin: 30px auto; padding: 0; text-align: center;',
    'body_sub' => 'margin-top: 25px; padding-top: 25px; border-top: 1px solid #EDEFF2;',

    /* Type ------------------------------ */

    'anchor' => 'color: #3869D4;',
    'header-1' => 'margin-top: 0; color: #2F3133; font-size: 19px; font-weight: bold; text-align: left;',
    'paragraph' => 'margin-top: 0; color: #74787E; font-size: 16px; line-height: 1.5em;',
    'paragraph-sub' => 'margin-top: 0; color: #74787E; font-size: 12px; line-height: 1.5em;',
    'paragraph-center' => 'text-align: center;',

    /* Buttons ------------------------------ */

    'button' => 'display: block; display: inline-block; width: 200px; min-height: 20px; padding: 10px;
                 background-color: #3869D4; border-radius: 3px; color: #ffffff; font-size: 15px; line-height: 25px;
                 text-align: center; text-decoration: none; -webkit-text-size-adjust: none;',

    'button--green' => 'background-color: #22BC66;',
    'button--red' => 'background-color: #dc4d2f;',
    'button--blue' => 'background-color: #3869D4;',
];
?>

<?php $fontFamily = 'font-family: Arial, \'Helvetica Neue\', Helvetica, sans-serif;'; ?>

<body style="<?php echo e($style['body'], false); ?>">
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td style="<?php echo e($style['email-wrapper'], false); ?>" align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Logo -->
                    <tr>
                        <td style="<?php echo e($style['email-masthead'], false); ?>">
                            <a style="<?php echo e($fontFamily, false); ?> <?php echo e($style['email-masthead_name'], false); ?>" href="<?php echo e(url('/'), false); ?>" target="_blank">
                                <img src="<?php echo e(get_logo_url('platform', 'full'), false); ?>" width="200px" class="brand-logo" alt="<?php echo e(get_platform_title(), false); ?>" title="<?php echo e(get_platform_title(), false); ?>">
                                
                            </a>
                        </td>
                    </tr>

                    <!-- Email Body -->
                    <tr>
                        <td style="<?php echo e($style['email-body'], false); ?>" width="100%">
                            <table style="<?php echo e($style['email-body_inner'], false); ?>" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="<?php echo e($fontFamily, false); ?> <?php echo e($style['email-body_cell'], false); ?>">
                                        <!-- Greeting -->
                                        <h1 style="<?php echo e($style['header-1'], false); ?>">
                                            <?php if(! empty($greeting)): ?>
                                                <?php echo e($greeting, false); ?>

                                            <?php else: ?>
                                                <?php if($level == 'error'): ?>
                                                    Whoops!
                                                <?php else: ?>
                                                    Hello!
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        </h1>

                                        <!-- Intro -->
                                        <?php $__currentLoopData = $introLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p style="<?php echo e($style['paragraph'], false); ?>">
                                                <?php echo e($line, false); ?>

                                            </p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Action Button -->
                                        <?php if(isset($actionText)): ?>
                                            <table style="<?php echo e($style['body_action'], false); ?>" align="center" width="100%" cellpadding="0" cellspacing="0">
                                                <tr>
                                                    <td align="center">
                                                        <?php
                                                            switch ($level) {
                                                                case 'success':
                                                                    $actionColor = 'button--green';
                                                                    break;
                                                                case 'error':
                                                                    $actionColor = 'button--red';
                                                                    break;
                                                                default:
                                                                    $actionColor = 'button--blue';
                                                            }
                                                        ?>

                                                        <a href="<?php echo e($actionUrl, false); ?>"
                                                            style="<?php echo e($fontFamily, false); ?> <?php echo e($style['button'], false); ?> <?php echo e($style[$actionColor], false); ?>"
                                                            class="button"
                                                            target="_blank">
                                                            <?php echo e($actionText, false); ?>

                                                        </a>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php endif; ?>

                                        <!-- Outro -->
                                        <?php $__currentLoopData = $outroLines; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $line): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <p style="<?php echo e($style['paragraph'], false); ?>">
                                                <?php echo e($line, false); ?>

                                            </p>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        <!-- Salutation -->
                                        <p style="<?php echo e($style['paragraph'], false); ?>">
                                            Regards,<br><?php echo e(config('app.name'), false); ?>

                                        </p>

                                        <!-- Sub Copy -->
                                        <?php if(isset($actionText)): ?>
                                            <table style="<?php echo e($style['body_sub'], false); ?>">
                                                <tr>
                                                    <td style="<?php echo e($fontFamily, false); ?>">
                                                        <p style="<?php echo e($style['paragraph-sub'], false); ?>">
                                                            If you’re having trouble clicking the "<?php echo e($actionText, false); ?>" button,
                                                            copy and paste the URL below into your web browser:
                                                        </p>

                                                        <p style="<?php echo e($style['paragraph-sub'], false); ?>">
                                                            <a style="<?php echo e($style['anchor'], false); ?>" href="<?php echo e($actionUrl, false); ?>" target="_blank">
                                                                <?php echo e($actionUrl, false); ?>

                                                            </a>
                                                        </p>
                                                    </td>
                                                </tr>
                                            </table>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td>
                            <table style="<?php echo e($style['email-footer'], false); ?>" align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td style="<?php echo e($fontFamily, false); ?> <?php echo e($style['email-footer_cell'], false); ?>">
                                        <p style="<?php echo e($style['paragraph-sub'], false); ?>">
                                            &copy; <?php echo e(date('Y'), false); ?>

                                            <a style="<?php echo e($style['anchor'], false); ?>" href="<?php echo e(url('/'), false); ?>" target="_blank"><?php echo e(get_platform_title(), false); ?></a>.
                                            All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
<?php /**PATH C:\wamp64\www\hype-dappr\resources\views/vendor/notifications/email.blade.php ENDPATH**/ ?>