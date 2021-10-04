@extends('layouts.app')

@section('content')

	<ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <span>Testimonials</span>
            </li>
          </ul>
          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                    

                    <div class="element-header clearfix">
                      <h4>Existing Student Testimonial</h4>

                      <!-- Page menu -->
                      <div style="z-index: 999; margin-top: -25px;" class="pull-right os-dropdown-trigger os-dropdown-position-left">
                        <i class="fas fa-ellipsis-h fa-2x"></i>
                        <div class="os-dropdown bg-primary">
                          <ul>

                            <li>
                              <a onclick="oisNew(event)" data-type="purple" data-title="Create existing student testimonial" href="{{url('testimonials/create')}}">
                                <i class="fas fa-user-plus"></i> Existing Student
                              </a>
                            </li>

                            <li>
                              <a onclick="oisNew(event)" data-type="purple" data-title="Create old student testimonial" href="{{url('old-testimonials/create')}}">
                                <i class="fas fa-user-plus"></i> Old Student
                              </a>
                            </li>

                            
                          </ul>
                        </div>
                      </div>

                       
                    </div>

                    
                   
                    
                        <div class="element-box">
                         
                          @if($testimonials)
                           <table id="table" class="table table-bordered">
                             <thead class="text-primary">
                               <tr>
                                 <th>SN</th>
                                 <th>Admission No:</th>
                                 <th>Name</th>
                                 <th>Admitted Session</th>
                                 <th>Graduated Session</th>
                                 <th>Action</th>
                               </tr>
                             </thead>
                             <tbody>
                               @foreach($testimonials as $x => $testimonial)
                                  @php
                                    $name = $testimonial->student->surname.' '.$testimonial->student->othernames
                                  @endphp

                                  <tr id="{{$testimonial->id}}">

                                    <td>{{$x+1}}</td>

                                    <td><a class="studentDetails" href="{{url('students/show/'.$testimonial->student->id)}}">{{$testimonial->student->admission_no}}</a></td>

                                    <td>{{$name}}</td>
                                    <td>{{$testimonial->session_admitted}}</td>
                                    <td>{{$testimonial->session_graduated}}</td>
                                    <td>

                                      
                                      <a href="{{url('testimonials/print/'.$testimonial->id)}}"><i class="fas fa-print"></i> </a> &nbsp;

                                      <a onclick="oisEdit(event)" data-type="purple" data-title="Edit {{$name}} testimonial" class="text-success" href="{{url('testimonials/edit/'.$testimonial->id)}}"><i class="fas fa-edit"></i> </a> &nbsp;



                                      <a onclick="oisDelete(event)" class="text-danger" data-id="{{$testimonial->id}}" href="{{url('testimonials/delete')}}"><i class="fas fa-times-circle"></i> </a>
                                    </td>
                                  </tr>
                                  
                               @endforeach
                             </tbody>
                           </table>
                          @else
                            <h3 class="alert alert-danger"><i class="fas fa-trash"></i> No data found </h3>
                          @endif
                             



                        </div>

                    
                </div>
              </div>
              

              
            </div>
          </div>

@endsection



@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
      
      $("#table").DataTable();

      $(".edit").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

          dialog(url,'Update Testimonial','l');
      });


      $(".createNewTestimonial").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

          dialog(url,'Create new Testimonial','l');
      });


		});
	</script>
@endsection