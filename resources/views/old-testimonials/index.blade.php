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
                    

                    <h4 class="element-header clearfix">
                      Student Testimonial


                      
                      <!-- Page menu -->
                      <div style="z-index: 999; margin-top: -25px;" class="pull-right os-dropdown-trigger os-dropdown-position-left">
                        <i class="fas fa-ellipsis-h fa-2x"></i>
                        <div class="os-dropdown bg-primary">
                          <ul>

                            <li>
                          <a class="dropdown-item createNewExistingStudentTestimonial" href="{{url('testimonials/create')}}">Existing Student</a>
                            </li>

                            <li>
                          <a class="dropdown-item" href="{{url('old-testimonials/create')}}">Old Student</a>
                            </li>

                            
                          </ul>
                        </div>
                      </div>


                   <!--     <div class="btn-group float-right">
                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                           New Testimonial
                        </button>
                        <div class="dropdown-menu">
                          <a class="dropdown-item createNewExistingStudentTestimonial" href="{{url('testimonials/create')}}">Existing Student</a>
                          <a class="dropdown-item" href="{{url('old-testimonials/create')}}">Old Student</a>
                        </div>
                      </div> -->
                    </h4>

                    
                   
                    
                        <div class="element-box">
                           <h4>Existing Student Testimonial</h4>
                           <hr>
                          
                          <div class="row mb-xl-2 mb-xxl-3">

                              

                              <div class="col-sm-4">
                                <a class="element-box el-tablo activateTerm centered trend-in-corner padded bold-label" href="{{url('testimonials/show')}}">
                                 <div class="label dashboard-icons">
                                    <div class="os-icon os-icon-tasks-checked"></div>
                                  </div>
                                  <div class="value dashboard-title">
                                    View Testimonials
                                  </div>
                                          
                                  </a>
                                </div>
                              

                              <div class="col-sm-4">
                                <a class="element-box el-tablo createNewExistingStudentTestimonial centered trend-in-corner padded bold-label" href="{{url('testimonials/create')}}">
                                 <div class="label dashboard-icons">
                                    <div class="os-icon os-icon-tasks-checked"></div>
                                  </div>
                                  <div class="value dashboard-title">
                                    New Testimonials
                                  </div>
                                          
                                  </a>
                                </div>
 

                          </div>
                           



                        </div>

                    
                </div>
              </div>
              

              
            </div>
          </div>

@endsection



@section('script')
	<script type="text/javascript">
		$(document).ready(function(){
    
      $(".createNewExistingStudentTestimonial").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

          dialog(url,'Create new Testimonial','l');
      });


		});
	</script>
@endsection