<a class="button product-link itemQuickView" href="<?php echo e(route('quickView.product', $item->slug), false); ?>">
  <i class="fal fa-search-plus"></i>
</a>

<a href="javascript:void(0)" data-link="<?php echo e(route('wishlist.add', $item), false); ?>" class="button add-to-wishlist">
  <i class="fal fa-heart"></i>
</a>

<a href="javascript:void(0)" data-link="<?php echo e(route('cart.addItem', $item->slug), false); ?>" class="button button--cart sc-add-to-cart">
  <i class="fal fa-shopping-cart"></i>
  <?php echo e(trans('theme.add_to_cart'), false); ?>

</a>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/partials/_vertical_hover_buttons.blade.php ENDPATH**/ ?>