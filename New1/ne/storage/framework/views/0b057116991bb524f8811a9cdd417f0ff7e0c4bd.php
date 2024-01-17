<?php $__env->startSection('content'); ?>
  <style type="text/css">
    section {
      margin: 0 0 35px 0;
    }

    @media  screen and (max-width: 991px) {
      section {
        margin: 0 0 30px 0;
      }
    }

  </style>

  <!-- MAIN SLIDER -->
  <?php if(!app('mobile-detect')->isMobile()) : ?>
  <?php echo $__env->make('theme::sections.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php else: ?>
  <?php echo $__env->make('theme::mobile.slider', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Featured category stat -->
  <?php echo $__env->make('theme::sections.featured_category-new', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- banner grp one -->
  <?php if(!empty($banners['group_1'])): ?>
    <?php echo $__env->make('theme::sections.banners', ['banners' => $banners['group_1']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Flash deal start -->
  <?php if(isset($flashdeals)): ?>
    <?php echo $__env->make('flashdeal::_deals', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Trending start -->
  <?php echo $__env->make('theme::sections.trending_now', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- banner grp two -->
  <?php if(!empty($banners['group_2'])): ?>
    <?php echo $__env->make('theme::sections.banners', ['banners' => $banners['group_2']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Deal of Day start -->
  <?php echo $__env->make('theme::sections.deal_of_the_day', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- banner grp three -->
  <?php if(!empty($banners['group_3'])): ?>
    <?php echo $__env->make('theme::sections.banners', ['banners' => $banners['group_3']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Featured category stat -->
  

  <!-- Popular Product type start -->
  <?php echo $__env->make('theme::sections.popular', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- banner grp three -->
  <?php if(!empty($banners['group_4'])): ?>
    <?php echo $__env->make('theme::sections.banners', ['banners' => $banners['group_4']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Bundle start -->
  

  <!-- feature-brand start -->
  <?php echo $__env->make('theme::sections.featured_brands', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- Recently Added -->
  <?php echo $__env->make('theme::sections.recently_added', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- banner grp four -->
  <?php if(!empty($banners['group_5'])): ?>
    <?php echo $__env->make('theme::sections.banners', ['banners' => $banners['group_5']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Additional Items -->
  <?php echo $__env->make('theme::sections.additional_items', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- banner grp four -->
  <?php if(!empty($banners['group_6'])): ?>
    <?php echo $__env->make('theme::sections.banners', ['banners' => $banners['group_6']], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>

  <!-- Best finds under $99 deals start -->
  <?php echo $__env->make('theme::sections.best_finds', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

  <!-- best selling Now   -->
  

  <!-- Recently Viewed -->
  <?php echo $__env->make('theme::sections.recent_views', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('scripts'); ?>
  <script src="<?php echo e(theme_asset_url('js/eislideshow.js'), false); ?>"></script>
  <script type="text/javascript">
    // Main slider
    $('#ei-slider').eislideshow({
      animation: 'center',
      autoplay: true,
      slideshow_interval: 5000,
    });

    // $("#top_vendors").slick({
    //   slidesToShow: 3,
    //   slidesToScroll: 1,
    //   autoplay: true,
    //   autoplaySpeed: 2000,
    // });

    // Trending now tabs
    $(function() {
      $('.feature__tabs a').click(function() {
        let targetDom = $(this).attr('href');
        $(targetDom).slick('refresh');

        // Check for active
        $('.feature__tabs li').removeClass('active');
        $(this).parent().addClass('active');

        // Display active tab
        $('.feature__items .feature__items-inner').hide();
        $(targetDom).show();

        return false;
      });
    });

    // Owl Sliders
    $('.owl-carousel').owlCarousel({
      loop: true,
      dots: false,
      margin: 10,
      nav: true,
      responsive: {
        0: {
          items: 2
        },
        576: {
          items: 3
        },
        992: {
          items: 5
        }
      }
    })
  </script>

  <!-- Flash deals script -->
  <?php if(isset($flashdeals)): ?>
    <?php echo $__env->make('flashdeal::scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <?php endif; ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('theme::layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/index.blade.php ENDPATH**/ ?>