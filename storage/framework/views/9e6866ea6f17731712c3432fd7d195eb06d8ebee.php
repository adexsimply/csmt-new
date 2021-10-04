

<?php $__env->startSection('content'); ?>

  <ul>
    <li>Surname : <?php echo e($student->surname); ?></li>
    <li>Othernames : <?php echo e($student->othernames); ?></li>
    <li>Areas good at : <?php echo e($student->areas_good_at); ?></li>
    <li>Image : <img src="<?php echo e(asset('../storage/app/public/passports/'.$student->image)); ?>"></li>
    <li>Session admitted : <?php echo e($student->session_admitted); ?></li>
    <li>Session graduated : <?php echo e($student->session_graduated); ?></li>
    <li>Post held : <?php echo e($student->post_held); ?></li>
    <li>Abilities : <?php echo e($student->abilities); ?></li>
    <li>Conduct : <?php echo e($student->conduct); ?></li>
  </ul>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>