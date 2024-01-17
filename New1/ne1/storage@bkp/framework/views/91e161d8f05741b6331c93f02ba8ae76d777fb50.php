<div class="share">
  <span>
    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php echo e(urlencode(Request::fullUrl()), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'facebook']); ?>"><i class="fab fa-facebook-f"></i></a>

    <a href="https://twitter.com/intent/tweet?url=<?php echo e(urlencode(Request::fullUrl()), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'twitter']); ?>"><i class="fab fa-twitter"></i></a>

    <a href="http://www.reddit.com/submit?<?php echo e(http_build_query(['url' => Request::fullUrl(), 'title' => $item->title]), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'reddit']); ?>"><i class="fab fa-reddit-alien"></i></a>

    <a href="https://pinterest.com/pin/create/button/?<?php echo e(http_build_query(['url' => Request::fullUrl(),'media' => get_product_img_src($item, 'medium'),'description' => $item->title]), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'pinterest']); ?>"><i class="fab fa-pinterest"></i></a>

    <a href="https://plus.google.com/share?url=<?php echo e(urlencode(Request::fullUrl()), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'google+']); ?>"><i class="fab fa-google-plus"></i></a>

    <a href="http://www.linkedin.com/shareArticle?<?php echo e(http_build_query(['url' => Request::fullUrl(), 'title' => $item->title, 'mini' => true]), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'linkedin']); ?>"><i class="fab fa-linkedin-in"></i></a>

    <a href="http://www.tumblr.com/share?<?php echo e(http_build_query(['u' => Request::fullUrl(), 't' => $item->title, 'v' => 3]), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'tumblr']); ?>"><i class="fab fa-tumblr"></i></a>

    <a href="http://vk.com/share.php?<?php echo e(http_build_query(['url' => Request::fullUrl(),'title' => $item->title,'image' => get_product_img_src($item, 'medium'),'noparse' => false]), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'vk']); ?>"><i class="fab fa-vk"></i></a>

    <a href="http://www.digg.com/submit?<?php echo e(http_build_query(['url' => Request::fullUrl(), 'title' => $item->title]), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'digg']); ?>"><i class="fab fa-digg"></i></a>

    <a href="http://www.viadeo.com/?<?php echo e(http_build_query(['url' => Request::fullUrl(),'title' => $item->title,'image' => get_product_img_src($item, 'medium')]), false); ?>" class="social-share-btn" target="_blank" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'viadeo']); ?>"><i class="fab fa-viadeo"></i></a>

    <a href="whatsapp://send?text=<?php echo e(rawurlencode($item->title . ' | ' . Request::fullUrl()), false); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'WhatsApp']); ?>"><i class="fab fa-whatsapp"></i></a>

    <a href="mailto:?subject=<?php echo e($item->title, false); ?>&amp;body=<?php echo e(Request::fullUrl(), false); ?>" data-toggle="tooltip" data-placement="top" title="<?php echo app('translator')->get('theme.share_on',['name' => 'email']); ?>"><i class="far fa-envelope"></i></a>
  </span>
  <div class="addthis_native_toolbox"></div>
</div>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/layouts/share_btns.blade.php ENDPATH**/ ?>