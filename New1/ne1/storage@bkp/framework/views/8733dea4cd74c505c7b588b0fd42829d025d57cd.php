<?php if($ratings): ?>
  <ul>
    <?php for($i = 0; $i < 5; $i++): ?>
      <?php if($ratings - $i >= 1): ?> 
      <li><a href="#"><i class="fas fa-star"></i></a></li>
    <?php elseif( ($ratings - $i) < 1 && ($ratings - $i) > 0 ): ?>
      
      <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
    <?php else: ?>
      
      <li><a href="#"><i class="far fa-star"></i></a></li> <?php endif; ?>
    <?php endfor; ?>
  </ul>
<?php endif; ?>
<?php /**PATH C:\wamp64\www\hype-dappr\public\themes\default/views/partials/_ratings.blade.php ENDPATH**/ ?>