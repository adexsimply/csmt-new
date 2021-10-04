@extends('layouts.app')

@section('title','Class subject & students')
@section('content')

	<ul class="breadcrumb">
    <li class="breadcrumb-item">
      <a href="{{url('home')}}">Dashboard</a>
    </li>
    
    <li class="breadcrumb-item">
      <a href="{{url('classes')}}">All classes</a>
    </li>
            
    <li class="breadcrumb-item">
    </li>
            
    <li class="breadcrumb-item">
    </li>
  </ul>
  <!-- END - Breadcrumbs -->
          

  <div class="content-i">
    <div class="content-box">
      <div class="element-wrapper compact pt-4">
          <div class="element-wrapper">
            

            <!-- Page header -->
            <div class="element-header clearfix">
             

             
            <div class="col-sm-12">
  @if($students)
    
    <form method="post" onsubmit="oisForm(event)" action="{{url('psychomotor/store')}}">
      <div class="formAlert"></div>
      {{csrf_field()}}
      <input type="hidden" name="aagc_id" value="{{$aagc_id}}">
      <input type="hidden" name="session_id" value="{{$session_id}}">
      <input type="hidden" name="term_id" value="{{$term_id}}">
      <input name="category_id" type="hidden" value="{{$category_id}}">
      <table class="table table-hover table-padded">
        <thead>
          <th>SN</th>
          <th>Name</th>
          <!-- <th>Student ID</th> -->
          <th>Craft skill</th>
          <th>Pet project</th>
          <th>Sport</th>
          <th>Remark</th>
        </thead>

        <tbody>
          @foreach($students as $x => $student)
            <tr>
              <input type="hidden" name="student_id[]" value="{{$student->student_id}}" />
              <td>{{$x+1}}</td>
              <td>{{$student->surname.' '.$student->othernames}}</td>
              <!-- <td>{{$student->admission_no}}</td> -->
              <td>
                <input type="text" class="form-control" name="craft_skill[]" placeholder="Enter craft skill">
              </td>

              <td>
                <input type="text"  class="form-control" name="pet_project[]" placeholder="Enter pet project">
              </td>

              <td>
                <input type="text" class="form-control" name="sport[]" placeholder="Enter sport">
              </td>

              <td>
                <input type="text" class="form-control" name="remark[]" placeholder="Enter remark">
              </td>


            </tr>
          @endforeach
        </tbody>
      </table>
      <div class="row">
        <div class="col-xs-12">
          <button type="submit" class="btn btn-primary">
            <i class="fas fa-check"></i> Submit
          </button>
        </div>
        
      </div>
      
    </form>
  @else
    <div class="text-danger text-center">
      <i class="fas fa-trash"></i> No student found
    </div>
  @endif
</div>

                    

                    
          </div>
      </div>
    </div>
  </div>

@endsection




@section('modal')
  

  
  <!-- Create new subject modal -->
  <div class="modal fade" id="addNewSubject">
    <div class="modal-dialog modal-sm mx-auto">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Add new subject</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form onsubmit="oisForm(event)" method="POST" action="{{url('classes/aagc/subjects/addnew')}}">

            <div class="formAlert"></div>
            

          <input type="hidden" name="aagc_id" id="aagc_id">
          <input type="hidden" name="session_id" id="session_id">

          <div class="form-group">
              <label for=""> Subject school</label>
              <select required="" class="subjectOptions form-control" required name='subject_id'></select>
          </div>

          <button class="btn btn-primary" type="submit"> Add Subject</button>

             </form>
        </div>

      </div>
    </div>
  </div>







@endsection





@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      $('.dataTableFull').DataTable({
      // "processing": true,
      // "ajax": 'server.php',
      "dom": 'lBfrtip',
      // "pageLength": 100,
      "bPaginate": false,
      // "responsive": true,
      "fixedHeader": true,
      "buttons": [
            {
                extend: 'collection',
                text: 'Export',
                buttons: [
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]

    });



      $('.studentTable').DataTable();

      $('.nav-tabs-sticky').stickyTabs();

      function fetchPromotionList(){
         $('#promotion').html('<p class="text-center"> <i class="fas  fa-spinner fa-spin fa-5x"></i> </p>');


        $.get('{{url("classes/aagc/promotion/".$aagc_id."/".$session_id."/".$term_id)}}',function(data){
            $("#promotion").html(data);
        });
        
      }

      var promotion = false;

      /*Collect Promotion details*/
      $(".promotionToggle").click(function(){

          fetchPromotionList();
          promotion = true;
      });

      if(!promotion){
        var hash = location.hash;

        if(hash == '#promotion'){
          fetchPromotionList();
        }
      }
      


      /*Add new subjects*/
      $(".addNewSubject").click(function(e){
          e.preventDefault();
          subjectOptions();
          var aagc_id = $(this).data('aagc_id');
          var session_id = $(this).data('session_id');
          $('#aagc_id').val(aagc_id);
          $('#session_id').val(session_id);

          $("#addNewSubject").modal('show');
      });

    });
  </script>
@endsection

