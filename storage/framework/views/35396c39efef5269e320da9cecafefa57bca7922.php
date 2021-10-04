<?php $__env->startSection('title','Page not found'); ?>
<?php $__env->startSection('content'); ?>
  <div class="row">  
      <div class='col-md-4 center-block'>
          <h3><center>401</center></h3><br>
          <p><center>Full Authentication required to view this Page.</center></p>
      </div>
  </div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>