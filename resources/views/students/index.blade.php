@extends('layouts.app')

@section('title','Students')
@section('content')

	<ul class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{url('home')}}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <span>Students</span>
      </li>
      </ul>
      <!-- 
      END - Breadcrumbs
      -->
      <div class="content-i">
      <div class="content-box">
        <div class="element-wrapper">
          <div class="element-box">
            <div class="element-header">

              <h3>
                @if(is_null($status))
                  Student's Details
                @elseif($status == 0)
                  Withdrawn Student's Details
                @elseif($status == 1)
                  Active Student's Details
                @elseif($status == 2)
                  JSS3 Grduated Student's Details
                @elseif($status == 3)
                  SSS3 Grduated Student's Details
                @elseif($status == 4)
                  Expelled Student's Details
                @endif 
                @if($category_id == 1)
                  (Boarding Students)
                @elseif($category_id == 2)
                  (Day students)
                @endif
              </h3>


             <!-- Page menu -->
              <div style="z-index: 999; margin-top: -25px;" class="pull-right os-dropdown-trigger os-dropdown-position-left">
                <i class="fas fa-ellipsis-h fa-2x"></i>
                <div class="os-dropdown bg-primary">
                  <ul>

                    <li>
                      <a href="#" class="filterStudent" data-toggle="modal" data-target="#filterStudent">
                        <i class="fas fa-search"></i> Filter students
                      </a>
                    </li>

                    @can('add student')
                    <li>
                      <a onclick="oisNew(event)" data-type="purple" data-size="xl" data-title="Register new student" href="{{url('students/full-registration')}}"><i class="fas fa-user-plus"></i> Add New Student</a>
                    </li>



                    <li>
                      <a onclick="oisRead(event)" data-type="purple" data-size="l" data-title="New JSS3 Graduates" href="{{url('students/new-jss-3')}}">
                        <i class="fas fa-user-circle"></i> New JSS3 Graduates
                      </a>
                    </li>

                   <li>
                      <a onclick="oisRead(event)" data-type="purple" data-size="l" data-title="New SSS3 Graduates" href="{{url('students/new-sss-3')}}">
                        <i class="fas fa-user-circle"></i> New SSS3 Graduates
                      </a>
                    </li>
                    @endcan

                    
                  </ul>
                </div>
              </div>


            </div>

              @if(count($students) > 0 )
              <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" style="width:100%">
                <thead class="text-primary">
              <tr>
                <th class="text-center"><i class="fas fa-level-down"></i> S/N</th>
                <th><i class="fas fa-user"></i> Student's ID</th>
                <th><i class="fas fa-user-circle"></i> Name</th>
                <th><i class="fas fa-users"></i> Current class</th>
                <th><i class="fas fa-user-tie"></i> Parent's Name</th>
                <th><i class="fas fa-user-tie"></i> Parent's phone</th>
                <th><i class="fas fa-user-tie"></i> Parent's phone2</th>
                <th><i class="fas fa-tint"></i> Status</th>
                <th><i class="fas fa-plug"></i> Actions</th>
              </tr>
                </thead>
                <tbody>
                <?php $i = 0; ?>
              @foreach($students as $x => $student)

              @if ($student->status!=5)

              <tr id="student{{$student->id}}">
                <td class="text-center">{{$i}}</td>
                <td><a data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} details" data-size="l" onclick="oisRead(event)" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a>@if(!is_null($student->switched_id))<br><span class="badge badge-success"><a data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} details" data-size="l" onclick="oisRead(event)" href="{{url('students/show/'.$student->switched_id)}}">PREVIOUS PROFILE</a></span> @endif</td>

                <td><a data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} details" data-size="l" onclick="oisRead(event)" href="{{url('students/show/'.$student->id)}}">{{$student->surname.' '.$student->othernames}}</a></td>

                <td>{{$student->current_class.' '.$student->arm}}</td>

                <td>{{$student->parent}}</td>
                <td>{{$student->phone1}}</td>
                <td>{{$student->phone2}}</td>

                <td>
             <a data-student_id="{{$student->id}}" href="{{url('students/status')}}" class="changeStatus">{!! App\Student::status($student->status) !!}</a> 
                </td>
                <td class="text-center">

                  @can('view report')
                    <a href="{{url('students/performance/'.$student->id)}}" onclick="oisRead(event)" data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} performance" data-size="xl">
                      <i class="fas fa-chart-bar"></i>
                    </a> &nbsp;
                  @endcan


                  @can('edit student')
                  <a data-type="purple" data-title="Update {{$student->surname.' '.$student->othernames}} details" data-size="xl" onclick="oisEdit(event)" href="{{url('students/edit/'.$student->id)}}" title="Edit student"><i class="fas fa-edit"></i></a> &nbsp;
                  @endcan

                  @can('delete student')
                    <a data-hide="#student{{$student->id}}" data-title="Delete {{$student->surname.' '.$student->othernames}}" data-content="All information about {{$student->surname.' '.$student->othernames}} would be permanently deleted and can never be recovered, proceed to delete ?" onclick="oisDelete(event)" class="text-danger" data-spin="yes" data-id="{{$student->id}}" href="{{url('students/destroy')}}" title="Delete">
                      <i class="fas fa-trash"></i>
                    </a> &nbsp;
                  @endcan
                  <a data-type="purple" data-title="Update {{$student->surname.' '.$student->othernames}} details" data-size="xl" onclick="oisEdit(event)" href="{{url('students/edit2/'.$student->id)}}" title="Edit student"><i class="fas fa-check"></i></a> &nbsp;
                  <a data-type="purple" data-title="Switch {{$student->surname.' '.$student->othernames}} details" data-size="xl" onclick="oisEdit(event)" href="{{url('students/switch/'.$student->id)}}" title="Edit student"><i class="fas fa-redo"></i></a> &nbsp;

                </td>
              </tr>
              @endif
              <?php $i++; ?>
              @endforeach

              
              
                </tbody>
                
              </table>

                {{$students->links()}}
              
              </div> 

              

              @else 
              <div class="text-center">
                <h3>No student found</h3>
                <a onclick="oisNew(event)" data-type="purple" data-size="xl" data-title="Register new student" class="btn full-registration btn-outline-primary" href="{{url('students/full-registration')}}">Register New Student</a>
              </div>
              @endif
              

            
          </div>
      </div>
        

        
      </div>
      </div>

@endsection


@section('modal')
  <!-- Create new subject modal -->
  <div class="modal fade" id="filterStudent">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Filter student</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="get" action="{{url('students/filter')}}">
              
             <div class="form-group">
               <select name="group_class_id" class="form-control classOptions"></select>
             </div>

             
             <div class="form-group">
               <select class="form-control fullArmOptions" name="aagc_id"></select>
             </div>
             
             <div class="form-group">
               <select class="form-control" name="category_id">
                 <option value="1">Boarding</option>
                 <option value="2">Day</option>
               </select>
             </div>
             
             <div class="form-group">
               <select class="form-control sessionOptions" name="session_id"></select>
             </div>
             
             <div class="form-group">
               <select class="form-control clubOptions" name="club_id"></select>
             </div>

             <div class="form-group">
               <button class="btn btn-primary" type="submit"><i class="fas fa-eye"></i> View students</button>

               
             </div>

                  


                  </form>
        </div>

      </div>
    </div>
  </div>
@endsection


@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

      // $("#studentTable").DataTable();
      
      if(hash = location.hash){
       
        $(hash).trigger('click');
       
      }


      $(".filterStudent").click(function(e){
        e.preventDefault();
        sessionOptions();
        classOptions();
        clubOptions();


        $(".classOptions").change(function(){
          var group_class_id = $(this).val();
          fullArmOptions(group_class_id);
        });
  

        $("#filterStudent").modal('show');
      });


		});
	</script>
@endsection