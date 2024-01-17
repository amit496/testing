<link href="<?php echo e(url('css/fileinput.css'), false); ?>" rel="stylesheet">
<script src="<?php echo e(url('js/fileinput.js'), false); ?>"></script>


<!-- page script -->
<script type="text/javascript">
  ;
  (function($, window, document) {
    $(document).ready(function() {
      var formData = new FormData();

      var footerTemplate = '<div class="file-thumbnail-footer">\n' +
        '    <small>{size}</small> {actions}\n' +
        '</div>';

      var actionsTemplate = '<div class="file-actions">\n' +
        '    <div class="file-footer-buttons">\n' +
        '       {download} {zoom} {other} {delete}' +
        '    </div>\n' +
        '    {drag}\n' +
        '    <div class="clearfix"></div>\n' +
        '</div>';

      var deleteTemplate = '<button type="button" class="kv-file-remove btn btn-kv btn-default btn-flat btn-xs" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.remove'), false); ?>" {dataUrl}{dataKey}><i class="fa fa-trash"></i></button>\n';

      var downloadTemplate = '<a class="kv-file-download btn btn-default btn-flat btn-xs" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.download'), false); ?>" href="{downloadUrl}" download="" target="_blank"><i class="fa fa-download"></i></a>\n';

      var zoomTemplate = '<button type="button" class="kv-file-zoom btn btn-default btn-flat btn-xs"  data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.preview'), false); ?>"><i class="fa fa-search-plus"></i></button>';

      var dragTemplate = '<span class="file-drag-handle {dragClass}" data-toggle="tooltip" data-placement="top" title="<?php echo e(trans('app.move'), false); ?>"><i class="fa fa-arrows"></i></span>';

      var initialPreview = [<?= isset($preview) ? $preview['urls'] : '' ?>];

      var initialPreviewConfig = [<?= isset($preview) ? $preview['configs'] : '' ?>];

      $("#dropzone-input").fileinput({
        uploadUrl: "<?php echo e(route('image.upload'), false); ?>",
        uploadExtraData: function() {
          var extra = {};
          extra['model_id'] =  jQuery('.add_prod_model_fields_outer input[name="inventory_id"]').val();
          extra['model_name'] = 'inventory';
          extra['redirect_url'] = '';
          return extra;
        },
        showUpload: false,
        enableResumableUpload: true,
        resumableUploadOptions: {
          // testUrl: "/site/test-file-chunks",
          chunkSize: <?php echo e(config('image.chunk_size', 1024), false); ?>,
        },
        dropZoneEnabled: true,
        browseOnZoneClick: true,
        dropZoneTitle: "<?php echo e(trans('app.drag_n_drop_here'), false); ?>",
        showClose: false,
        showRemove: false,
        showCaption: false,
        maxFilePreviewSize: 25600,
        minFileSize: <?php echo e(getAllowedMinImgSize(), false); ?>,
        maxFileSize: <?php echo e(getAllowedMaxImgSize(), false); ?>,
        minFileCount: <?php echo e(getMinNumberOfRequiredImgsForInventory(), false); ?>,
        maxTotalFileCount: <?php echo e(getMaxNumberOfImgsForInventory(), false); ?>,
        allowedFileExtensions: ['jpg', 'jpeg', 'gif', 'png', 'webp'],
        msgFilesTooLess: "<?php echo trans('help.number_of_img_upload_required'); ?>",
        msgTotalFilesTooMany: "<?php echo trans('help.number_of_img_upload_exceeded'); ?>",
        msgInvalidFileExtension: "<?php echo trans('help.msg_invalid_file_extension'); ?>",
        msgSizeTooLarge: "<?php echo trans('help.msg_invalid_file_too_learge'); ?>",
        dragSettings: {
          animation: 300,
          onUpdate: function(evt) {
            console.log(evt);
          },
        },
        initialPreview: initialPreview,
        overwriteInitial: false,
        initialPreviewAsData: true,
        initialPreviewFileType: 'image',
        initialPreviewDownloadUrl: "<?php echo e(url('download/{key}'), false); ?>",
        initialPreviewConfig: initialPreviewConfig,
        layoutTemplates: {
          footer: footerTemplate,
          actions: actionsTemplate,
          actionDelete: deleteTemplate,
          actionDownload: downloadTemplate,
          actionZoom: zoomTemplate,
          actionDrag: dragTemplate
        },
      }).on('filebeforedelete', function() {
        return new Promise(function(resolve, reject) {
          $.confirm({
            title: "<?php echo e(trans('app.confirmation'), false); ?>",
            content: "<?php echo e(trans('app.are_you_sure'), false); ?>",
            type: 'red',
            buttons: {
              'confirm': {
                text: '<?php echo e(trans('app.proceed'), false); ?>',
                keys: ['enter'],
                btnClass: 'btn-red',
                action: function() {
                  resolve();
                }
              },
              'cancel': {
                text: '<?php echo e(trans('app.cancel'), false); ?>',
                action: function() {
                  notie.alert(2, "<?php echo e(trans('messages.canceled'), false); ?>", 3);
                }
              },
            }
          });
        });
      }).on('filedeleted', function() {
        setTimeout(function() {
          notie.alert(1, "<?php echo e(trans('messages.file_deleted'), false); ?>", 3);
        }, 900);
      }).on('filesorted', function(event, params) {
        var sortUrl = "<?php echo e(route('image.sort'), false); ?>";
        var max = Math.max(params.oldIndex, params.newIndex);
        var min = Math.min(params.oldIndex, params.newIndex);
        var order = {};
        var stack = params.stack;
        for (k in stack) {
          if (k >= min && k <= max)
            order[stack[k].key] = k;
        };

        // Update the database using AJAX
        $.post(sortUrl, order, function(theResponse, status) {
          notie.alert(1, "<?php echo e(trans('responses.reordered'), false); ?>", 2);
        });
      }).on('fileuploaded', function(event, previewId, index, fileId) {
        console.log('File Uploaded', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
      }).on('fileuploaderror', function(event, previewId, index, fileId) {
        console.log('File Upload Error', 'ID: ' + fileId + ', Thumb ID: ' + previewId);
      }).on('filebatchuploadcomplete', function(event, preview, config, tags, extraData) {
        console.log('File Batch Uploaded', preview, config, tags, extraData);
         //window.location.href = extraData.redirect_url;
         var is_update_or_crate = jQuery('.add_prod_model_fields_outer').find('input[name="product_status_in_modal"]').val();
         var pro_id = jQuery('.add_prod_model_fields_outer').find('input[name="pro_id"]').val();
          var product_status_is_new =  jQuery('.add_prod_model_fields_outer').find('input[name="product_status_is_new"]').val();
          // is upate by manage product
         if(jQuery('.stf_outer_body.stf_manage_products_list').length == 1){
                stfGetProductListHtmlAjax();
                stfModelHide();
                return false;
        }
       if(product_status_is_new == 'Y'){
                stfGetProductListHtmlAjax();
              }
         stfCreatedProductAddInReveal(pro_id);
         //stfGetProductListHtmlAjax();
         stfModelHide();
      });

      $('div.btn.btn-primary.btn-file').hide();

      
    });
  }(window.jQuery, window, document));




</script>
<?php /**PATH /home/dappr/public_html/portal.dappr.com.au/resources/views/plugins/dropzone-upload-stylist.blade.php ENDPATH**/ ?>