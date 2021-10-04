

<div class="element-box">
      
      <form method="post" enctype="MULTIPART/FORM-DATA" onsubmit="oisForm(event)" action="{{url('testimonials/update')}}">

        {{@csrf_field()}}

        <div class="formAlert"></div>

        <input type="hidden" name="id" value="{{$testimonial->id}}">

        <div class="form-group">
          <label>Select session admitted</label>
          <input type="text" name="session_admitted" class="form-control" value="{{$testimonial->session_admitted}}" />
        </div>

        <div class="form-group">
          <label>Select session graduated</label>
          <input type="text" name="session_graduated" class="form-control" value="{{$testimonial->session_graduated}}" />
        </div>



        <div class="form-group">
          <label>Position Held</label>
          <input name="post_held" type="text" value="{{$testimonial->post_held}}" class="form-control" />
        </div>



        <div class="form-group">
          <label>Abilities</label>
          <input name="abilities" type="text" value="{{$testimonial->abilities}}" class="form-control" />
        </div>



        <div class="form-group">
          <label>Areas good at:</label>
          <input name="areas_good_at" type="text" value="{{$testimonial->areas_good_at}}" class="form-control" />
        </div>




        <div class="form-group">
          <label>Conducts</label>
          <input name="conduct" type="text" value="{{$testimonial->conduct}}" class="form-control" />
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

