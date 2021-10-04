

<div class="element-box">
      
      <form method="post" enctype="MULTIPART/FORM-DATA" onsubmit="oisForm(event)" action="<?php echo e(url('old-testimonials/store')); ?>">

        <?php echo e(@csrf_field()); ?>


        <div class="formAlert"></div>

        <div class="form-group">
          <label>Name</label>
          <input type="text" name="name" class="form-control" placeholder="Surname othernames" />
        </div>

        
        <div class="form-group">
          <label>Select session admitted</label>
          <input type="text" name="session_admitted" class="form-control" placeholder="Enter session admitted" />
        </div>

        <div class="form-group">
          <label>Select session graduated</label>
          <input type="text" name="session_graduated" class="form-control" placeholder="Enter session graduated" />
        </div>



        <div class="form-group">
          <label>Position Held</label>
          <input name="post_held" type="text" class="form-control" placeholder="Position held whilst in school" />
        </div>



        <div class="form-group">
          <label>Abilities</label>
          <input name="abilities" type="text" class="form-control" placeholder="Enter abilities" />
        </div>



        <div class="form-group">
          <label>Areas good at:</label>
          <input name="areas_good_at" type="text" class="form-control" placeholder="Enter areas good at" />
        </div>




        <div class="form-group">
          <label>Conducts</label>
          <input name="conduct" type="text" class="form-control" placeholder="Enter conduct" />
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

      formProcessor();
  });

</script>

