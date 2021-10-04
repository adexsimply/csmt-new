

<div class="element-box">
      
      <form method="post" enctype="MULTIPART/FORM-DATA" onsubmit="oisForm(event)" action="<?php echo e(url('old-testimonials/update')); ?>">

        <?php echo e(@csrf_field()); ?>


        <div class="formAlert"></div>

        <input type="hidden" name="id" value="<?php echo e($testimonial->id); ?>">

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" value="<?php echo e($testimonial->name); ?>" />
        </div>
        
        <div class="form-group">
          <label>Admission Number</label>
          <input type="text" name="admission_no" class="form-control" value="<?php echo e($testimonial->admission_no); ?>" />
        </div>

        
        <div class="form-group">
          <label>Select session admitted</label>
          <input type="text" name="session_admitted" class="form-control" value="<?php echo e($testimonial->session_admitted); ?>" />
        </div>

        

        <div class="form-group">
          <label>Select session graduated</label>
          <input type="text" name="session_graduated" class="form-control" value="<?php echo e($testimonial->session_graduated); ?>" />
        </div>



        <div class="form-group">
          <label>Position Held</label>
          <input name="post_held" type="text" value="<?php echo e($testimonial->post_held); ?>" class="form-control" />
        </div>



        <div class="form-group">
          <label>Abilities</label>
          <input name="abilities" type="text" value="<?php echo e($testimonial->abilities); ?>" class="form-control" />
        </div>



        <div class="form-group">
          <label>Areas good at:</label>
          <input name="areas_good_at" type="text" value="<?php echo e($testimonial->areas_good_at); ?>" class="form-control" />
        </div>




        <div class="form-group">
          <label>Conducts</label>
          <input name="conduct" type="text" value="<?php echo e($testimonial->conduct); ?>" class="form-control" />
        </div>

        <div class="form-group">
          <label>Passport Photograph</label>
          <input name="image" type="file" class="form-control" />
        </div>


        
          <button class="btn btn-primary" type="submit" value="save" name="submit"><i class="fa fa-floppy-o"></i> Save Testimonial</button>
        

    </form>

</div>

<script type="text/javascript">

  $(document).ready(function(){
      sessionOptions();
      formProcessor();

      $('.fetchStudent').change(function(){

        var session_id = $(this).val();

        /*Display message whilst collecting student list*/
        $(".studentOptions").html('<option>Collecting students.....</option>');

        $.get('<?php echo e(url("testimonials/student")); ?>/'+session_id,function(data){

          var studentOptions = '<option>Select student</option>';
          $.each(data.students, function(i,value){
              studentOptions+='<option value="'+value.id+'">'+value.surname+' '+value.othernames+' ('+value.admission_no+')</option>';
          });

          $(".studentOptions").html(studentOptions);

        });

      });


  });

</script>

