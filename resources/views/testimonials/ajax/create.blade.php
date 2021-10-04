

<div class="element-box">
      
      <form method="post" enctype="MULTIPART/FORM-DATA" onsubmit="oisForm(event)" action="{{url('testimonials/store')}}">

        {{@csrf_field()}}

        <div class="formAlert"></div>

        <div class="form-group">
          <label>Select session admitted</label>
          <select name="session_admitted" class="sessionOptions fetchStudent form-control"></select>
        </div>

        <div class="form-group">
          <label>Students</label>
          <select name="student_id" class="studentOptions form-control"></select>
        </div>

        <div class="form-group">
          <label>Select session graduated</label>
          <select name="session_graduated" class="sessionOptions form-control"></select>
        </div>



        <div class="form-group">
          <label>Position Held</label>
          <input name="post_held" type="text" class="form-control" />
        </div>



        <div class="form-group">
          <label>Abilities</label>
          <input name="abilities" type="text" class="form-control" />
        </div>



        <div class="form-group">
          <label>Areas good at:</label>
          <input name="areas_good_at" type="text" class="form-control" />
        </div>




        <div class="form-group">
          <label>Conducts</label>
          <input name="conduct" type="text" class="form-control" />
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

      $('.fetchStudent').change(function(){

        var session_id = $(this).val();

        /*Display message whilst collecting student list*/
        $(".studentOptions").html('<option>Collecting students.....</option>');

        $.get('{{url("testimonials/student")}}/'+session_id,function(data){

          var studentOptions = '<option>Select student</option>';
          $.each(data.students, function(i,value){
              studentOptions+='<option value="'+value.id+'">'+value.surname+' '+value.othernames+' ('+value.admission_no+')</option>';
          });

          $(".studentOptions").html(studentOptions);

        });

      });


  });

</script>

