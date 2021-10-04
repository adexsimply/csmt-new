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
      <a href="{{url('classes/'.$group_id)}}">{{App\Group::find($group_id)->name}} classes</a>
    </li>
            
    <li class="breadcrumb-item">
      <span>{{$name}} Class students</span>
    </li>
  </ul>
  <!-- END - Breadcrumbs -->
          

  <div class="content-i">
    <div class="content-box">
      <div class="element-wrapper compact pt-4">
          <div class="element-wrapper">
            

            <!-- Page header -->
            <div class="element-header clearfix">
              <h4>{{$name.' '.App\Student::categoryName($category_id)}}</h4>
             

             <!-- Page menu -->
              <div style="z-index: 999; margin-top: -25px;" class="pull-right os-dropdown-trigger os-dropdown-position-left">
                <i class="fas fa-ellipsis-h fa-2x"></i>
                <div class="os-dropdown bg-primary">
                  <ul>

                    <!-- <li>
                      <a href="#">
                        <i class="fas fa-chart-line"></i> Summary
                      </a>
                    </li> -->

                    <li>
                      <a href="#students">
                        <i class="fas fa-users"></i><span> Students </span>
                      </a>
                    </li>

                    <li>
                      <a href="#subjects">
                        <i class="fas fa-cog"></i><span> Subject setup </span>
                      </a>
                    </li>

                    <li>
                      <a href="#comments">
                        <i class="fas fa-comments"></i><span> Comments </span>
                      </a>
                    </li>

                    <li>
                      <a href="{{url('assessments/class-assessment-printer/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)}}">
                        <i class="fas fa-sitemap"></i><span> Assessment</span>
                      </a>
                    </li>

                    <li>
                      <a href="{{url('classes/aagc/session-details/'.$group_id.'/'.$group_class_id.'/'.$aagc_id.'/'.$categoryAlt.'/'.$session_id)}}">
                        <i class="fas fa-tint"></i><span> Switch class </span>
                      </a>
                    </li>

                    <li>
                      <a data-size="xl" data-title="Register new student" onclick="oisNew(event)" data-type="purple" href="{{url('students/create/'.$aagc_id.'/'.$session_id)}}"> <i class="fas  fa-user-plus"></i> Add new student</a>
                    </li>

                    <li>
                      <a href="#" data-session_id="{{$session_id}}" data-aagc_id="{{$aagc->id}}" class="addNewSubject"><i class="fas  fa-book"></i> Add new subject</a>
                    </li>

                    
                  </ul>
                </div>
              </div>
                      
            </div>



            <!-- Tab menu -->
            <div class="element-box">
              <div class="os-tabs-w">
                <div class="os-tabs-controls">

                  <ul class="nav nav-tabs nav-tabs-sticky smaller">
                    <li class="nav-item">
                      <a class="nav-link active text-center" data-toggle="tab" href="#students"><i class="fas  fa-users"></i> <br>Class students</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link text-center" data-toggle="tab" href="#subjects">
                        <i class="fas  fa-book-open"></i> <br>Subjects</a>
                    </li>

                    <li class="nav-item text-center">
                      <a class="nav-link" data-toggle="tab" href="#comments">
                        <i class="fas fa-comments"></i> <br>Comments</a>
                    </li>

                    <li class="nav-item">
                      <a class="nav-link text-center" href="{{url('assessments/class-assessment-printer/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)}}"><i class="fas  fa-balance-scale"></i> <br>Assessments</a>
                    </li>

                    
                    <li class="nav-item text-center">
                      <a class="nav-link" data-toggle="tab" href="#domain">
                        <i class="fas fa-tint"></i> <br>Domains</a>
                    </li>

                    @if($term_id == 3)
                      <li class="nav-item text-center">
                        <a class="nav-link promotionToggle" data-toggle="tab" href="#promotion"><i class="fas  fa-arrow-circle-right"></i> <br>Promotion</a>
                      </li>
                    @endif
                  </ul>
                  
                </div>
                <div class="tab-content">
                  



                  <!-- Class arm students -->
                  <div class="tab-pane active" id="students">
                    

                    @if(Addon::isEmpty($students))

                      <div class="element-box no-space">

                        <div class="table-responsive">
                         <table style="width: 100%;" class="table dataTableFull table-striped table-bordered table-hover studentTable">
                            <thead>
                              <tr>
                                <th class="text-center">S/N</th>
                                <th>Student's ID</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Parent's Name</th>
                                <th>Parent's Phone</th>
                              </tr>
                            </thead>
                            <tbody>


                          @foreach($students as $x => $student)
                            <tr>
                              <td class="text-center">{{$x+1}}</td>
                              <td><a onclick="oisRead(event)" data-size="l" data-type="purple" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>
                              <td>{{$student->surname.' '.$student->othernames}}</td>
                              <td>{{$student->gender}}</td>
                              <td>{{$student->parent_name}}</td>
                              <td>{{$student->phone1.', '.$student->phone2}}</td>
                            </tr>
                          @endforeach



                              </tbody>

                             </table>
                          </div>
                      </div>

                    @else

                      <div class="text-center">
                        <h3> No student found! </h3>
                        <a class="btn btn-outline-primary" data-size="xl" data-title="Register new student" onclick="oisNew(event)" data-type="purple" href="{{url('students/create/'.$aagc_id.'/'.$session_id)}}"> <i class="fas  fa-user-plus"></i> Add new student</a>
                      </div>
                    @endif
                  </div>





                  <!-- Class arm students comment-->
                  <div class="tab-pane" id="comments">
                    @if(count($students) > 0 )

                    <div class="element-box no-space">

                      <a href="{{url('comments/create/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$term_id)}}" class="float-right btn btn-primary makeComment" onclick="oisNew(event)" data-type="purple" data-size="xl">
                                    <i class="fas fa-comment-dots"></i> Add comments</a>
                      <div class="table-responsive">
                       <table style="width: 100%;" class="table table-lightborder table-striped table-bordered dataTable">
                          <thead>
                            <tr>
                              <th class="text-center">S/N</th>
                              <th>Student's ID</th>
                              <th>Name</th>
                              <th>Principal's Comment</th>
                              <th>Teacher's Comment</th>
                              <th>Hostel Parent's Comment</th>
                            </tr>
                          </thead>
                          <tbody>


                        @foreach($students as $x => $student)
                        <?php $comments = App\Comment::comments($aagc_id,$session_id,$term_id,$category_id,$student->id); ?>
                          <tr>
                            <td class="text-center">{{$x+1}}</td>
                            <td><a class="studentDetails" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>
                            <td>{{$student->surname.' '.$student->othernames}}</td>
                            <td>{{!empty($comments->principal_comment) ? $comments->principal_comment : '-'}}</td>
                            <td>{{!empty($comments->teacher_comment) ? $comments->teacher_comment : '-'}}</td>
                            <td>{{!empty($comments->hostel_comment) ? $comments->hostel_comment : '-'}}</td>
                          </tr>
                          @php ($x++) @endphp
                        @endforeach



                            </tbody>

                           </table>
                        </div>
                    



                    </div>

                  @else

                    <div class="text-center">
                      <h3> No student found! </h3>
                      <a class="btn btn-outline-primary" data-size="xl" data-title="Register new student" onclick="oisNew(event)" data-type="purple" href="{{url('students/create/'.$aagc_id.'/'.$session_id)}}"> <i class="fas  fa-user-circle"></i> Add new student</a>
                    </div>
                  @endif
                  </div>







                  <!-- Class arm students comment-->
                  <div class="tab-pane" id="promotion"></div>






                  <!-- Domain -->
                  <div class="tab-pane" id="domain">
                    <!-- Start accordion -->
                        <div id="DomainAccordion">

                            <div class="card rounded-0 no-border bottom-50">

                               <div class="card-header transparent clearfix">
                                  <div class="pull-left">
                                      <a class="card-link" data-toggle="collapse" href="#effectiveDomain">
                                          <h5>
                                            <i class="os-icon text-primary os-icon-ui-23"></i> 
                                            Effective domain
                                          </h5>
                                      </a>

                                  </div>
                              </div>
                              <hr class="no-space">

                              <!-- Class arms as accordion content -->
                              <div id="effectiveDomain" class="collapse show" data-parent="#DomainAccordion">


                                <!-- Collect class arms -->
                                <div class="card-body">

                                    <div class="row">

                                      <div class="col-sm-4 mt-5">
                                        <div style="z-index: 1; margin-right: 10px; margin-top: 5px;" class="pull-right top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                                            <i class="fas fa-ellipsis-h"></i>
                                            <div class="os-dropdown bg-primary">
                                              <ul>

                                                <li>
                                                  <a data-title="Mark classroom punctuality" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('punctuality/classroom/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">
                                                    <i class="fas fa-check-circle"></i> Classroom punctuality
                                                  </a>
                                                </li>

                                                <li>
                                                  <a data-title="Mark resumption punctuality" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('punctuality/resumption/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">
                                                    <i class="fas fa-check-circle"></i> Resumption punctuality
                                                  </a>
                                                </li>
                                               
                                              </ul>
                                            </div>
                                          </div>


                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label"  data-title="Mark classroom punctuality" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('punctuality/classroom/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-venus"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              Punctuality
                                            </div>
                                              
                                          </a>
                                      </div>


                                      <div class="col-sm-4 mt-5">
                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label" data-title="Mark classroom attendance" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('attendance/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-neuter"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              Attendance
                                            </div>
                                              
                                          </a>
                                      </div>

                                      <div class="col-sm-4 mt-5">
                                        <div style="z-index: 1; margin-right: 10px; margin-top: 5px;" class="pull-right top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                                            <!-- <i class="fas fa-ellipsis-h"></i> -->
                                            <div class="os-dropdown bg-primary">
                                              <ul>

                                                <li>
                                                  <a data-title="Mark subject assignment" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('assignment/subject/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">
                                                    <i class="fas fa-check-circle"></i> Subject Assignment
                                                  </a>
                                                </li>
<!-- 
                                                <li>
                                                  <a data-title="Mark hostel assignment" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('assignment/hostel/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">
                                                    <i class="fas fa-check-circle"></i> Hostel Assignment
                                                  </a>
                                                </li> -->
                                               
                                              </ul>
                                            </div>
                                          </div>
                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label" data-title="Mark subject punctuality" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('assignment/subject/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-mars"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              Assignment
                                            </div>
                                              
                                          </a>
                                      </div>



                                    <!--   <div class="col-sm-4 mt-5">
                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label" data-title="Mark student neatness" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('neatness/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-transgender-alt"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              Neatness
                                            </div>
                                              
                                          </a>
                                      </div> -->

                                     <!--  <div class="col-sm-4 mt-5">
                                        
                                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" data-title="Clinic attendance" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('clinic/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-heart"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              Clinic
                                            </div>
                                              
                                          </a>
                                      </div> -->


                                      <div class="col-sm-4 mt-5">
                                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" data-title="Exeat attendance" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('exeat/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-chevron-right"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              Exeat
                                            </div>
                                              
                                          </a>
                                      </div>



                                    </div>
                                  
                                </div>

                              </div>

                            </div>


                            <div class="card rounded-0 no-border bottom-50">

                               <div class="card-header transparent clearfix">
                                  <div class="pull-left">
                                      <a class="card-link" data-toggle="collapse" href="#psychomotorDomain">
                                          <h5>
                                            <i class="os-icon text-primary os-icon-ui-23"></i> 
                                            Psychomotor domain
                                          </h5>
                                      </a>

                                  </div>
                              </div>
                              <hr class="no-space">

                             
                              <div id="psychomotorDomain" class="collapse" data-parent="#DomainAccordion">


                               
                                <div class="card-body">

                                    <div class="row">

                                      <div class="col-sm-4 mt-5">
                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label" data-title="Psychomotor domain" data-type="purple" data-size="xl" onclick="oisNew(event)" href="{{url('psychomotor/create/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-plus-circle"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              Mark
                                            </div>
                                              
                                          </a>
                                      </div>
                                        <a href="{{url('psychomotor/create2/'.$aagc_id.'/'.$session_id.'/'.$term_id.'/'.$category_id)}}">Alternative Method</a>

                                    </div>
                                  
                                </div>

                              </div>

                            </div>




                        </div>
                  </div>





                  <!-- Class subjects -->
                  <div class="tab-pane" id="subjects">
                    @if(count($subjects) > 0)

                      <div class="table-responsive">
                        <table class="table table-striped table-bordered dataTable" style="width: 100%;">
                          <thead>
                            <tr>
                              <th class="text-center">
                                S/N
                              </th>
                              <th>
                                Subject Name
                              </th>
                              <th>
                                Date Added
                              </th>
                              <th class="text-center no-print">
                                Action
                              </th>
                            </tr>
                          </thead>
                          <tbody>

                          @foreach($subjects as $x => $subject)
                            <tr id="subject{{$subject->pivot->id}}">
                                <td class="text-center">{{$x+1}}</td>

                                <td>{{$subject->name}}</td>

                                <td>{{Carbon\Carbon::parse($subject->created_at)->format('Y-m-d')}}</td>

                                <td class="row-actions no-print">
                                    <a data-type="purple" onclick="oisRead(event)" data-title="{{$subject->name}} students" data-size="xl" href="{{url('classes/aagc/subject-student/view/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$subject->id)}}" data-toggle="tooltip" title="View students" > 

                                      <i class="fas  fa-users"></i> </a>

                                      <a data-type="purple" 
                                        onclick="oisNew(event)" 
                                        data-size="xl" 
                                        data-toggle="tooltip" 
                                        data-title="Add student to {{$subject->name}}" title="Add student" 
                                        href="{{url('classes/aagc/subject-student/getnew/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$subject->id)}}"> <i class="fas fa-user-plus"></i> </a>

                                      @can('add report')
                                      <a onclick="oisNew(event)" 
                                        data-size="xl" 
                                        data-type="purple" 
                                        data-title="Upload {{$name.' '.$subject->name}} result" 
                                        data-toggle="tooltip" 
                                        title="Upload new assessments" 
                                        href="{{url('assessments/create/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$subject->id.'/'.$term_id)}}"> <i class="fas fa-upload"></i> 
                                      </a>
                                      @endcan

                                      @can('add report')
                                      <a onclick="oisNew(event)" 
                                        data-size="xl" 
                                        data-type="purple" 
                                        data-title="Upload {{$name.' '.$subject->name}} result" 
                                        data-toggle="tooltip" 
                                        title="Upload Practical" 
                                        href="{{url('assessments/create_practical/'.$aagc_id.'/'.$category_id.'/'.$session_id.'/'.$subject->id.'/'.$term_id)}}"> <i class="fas fa-edit"></i> 
                                      </a>
                                      @endcan

                                      @can('view report')
                                     <a data-toggle="tooltip" 
                                        title="View assessments" 
                                        href="{{url('assessments/printer/'.$subject->id.'/'.$aagc_id.'/'.$category_id.'/'.$session_id)}}"> <i class="fas fa-eye"></i> </a>
                                      @endcan


                                     <a data-toggle="tooltip" 
                                        title="View Subject Analysis" 
                                        href="{{url('assessments/subject-analysis/'.$subject->id.'/'.$aagc_id.'/'.$category_id.'/'.$session_id)}}"> <i class="fas fa-file-pdf"></i> </a>

                                    <a data-toggle="tooltip" 
                                        title="Remote subject from class" 
                                        data-id="{{$subject->pivot->id}}" 
                                        class="text-danger" 
                                        data-hide="#subject{{$subject->pivot->id}}" 
                                        onclick="oisDelete(event)" 
                                        data-title="Delete {{$subject->name}}" 
                                        href="{{url('classes/aagc/subject/destroy')}}" title="Delete">
                                      <i class="fas fa-trash"></i>
                                    </a>
                                </td>
                              </tr>
                              @php ($x++) @endphp
                          @endforeach

                          </tbody>
                        </table>
                      </div>  

                    @else

                      <!-- Setup class subjects -->
                      <div class="element-box">

                        @php
                          $subjects = App\Subject::where('subject_school_id',($group_id + 1))->orWhere('subject_school_id',1)->get();
                        @endphp

                        
                        @if(count($subjects) > 0)

                          <form class="mt-4" onsubmit="oisForm(event)" method="POST" action="{{url('classes/aagc/subject-setup')}}">

                            {{@csrf_field()}}
                              
                              <div class="formAlert"></div>
                                <input type="hidden" name="aagc_id" value="{{$aagc->id}}">
                                <input type="hidden" name="session_id" value="{{$session_id}}">

                                 <div class="table-responsive">

                                  <table class="table table-lightborder">
                                    <thead>
                                      <tr>
                                        <th>
                                          Action
                                        </th>
                                        <th>
                                          Subject Name
                                        </th>
                                        <th class="text-center">
                                          Date Added
                                        </th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>

                                      @foreach($subjects as $subject)
                                        <tr>
                                            <td>
                                              
                                              <div class="form-check">
                                                <input type="checkbox" checked="" value="{{$subject->id}}" name="subject_ids[]" class="form-check-input" id="{{$subject->id}}" />
                                              </div>

                                            </td>

                                            <td><label for="{{$subject->id}}" style="cursor:pointer;">{{$subject->name}}</label></td>


                                            <td class="text-center">{{Carbon\Carbon::parse($subject->created_at)->format('Y-m-d')}}</td>

                                          </tr>
                                          
                                      @endforeach

                                    </tbody>
                                  </table>

                                </div> 
                               <div class="form-buttons-w">
                                <button class="btn btn-primary" type="submit"> Save subjects</button>
                              </div>
                          </form>

                        @else
                          <div class="alert alert-danger text-center">
                              <h1>No subject found</h1>
                              <a href="{{url('subjects')}}">Create new subject</a>
                          </div>
                        @endif

                      </div>
                      

                    @endif
                  </div>

                </div>

              </div>
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

