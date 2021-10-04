<div class="col-sm-12">
  <form method="POST" onsubmit="sendSMSForm(event)" action="<?php echo e(url('sms/send-pin')); ?>">
    <?php echo e(csrf_field()); ?>

    <div class="formAlert"></div>


    <div class="form-group">
      <input type="text" name="sender" class="form-control" required="" placeholder="Sender" value="CSMT SEC SC" />
    </div>
    
    <div class="form-group">
      <select name="group_class_id" class="form-control classOptions"></select>
    </div>

    <div class="form-group">
      <select name="category_id" class="form-control">
        <option value="0">All</option>
        <option value="1"><?php echo e(App\Student::categoryName(1)); ?></option>
        <option value="2"><?php echo e(App\Student::categoryName(2)); ?></option>
      </select>
    </div>

    <button class="btn btn-primary" type="submit">Send Pin</button>
  </form>
</div>

<script type="text/javascript">
  $(document).ready(function(){
    classOptions()
  });

</script>