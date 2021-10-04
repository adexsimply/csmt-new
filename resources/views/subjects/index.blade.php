@extends('layouts.app')
@section('title','Subjects')
@section('content')

	<ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="subject_category.html">Academic Records</a>
            </li>
            <li class="breadcrumb-item">
              <span>Academic Subject Setup</span>
            </li>
          </ul>
          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                    
                    <h4 class="element-header">
                      Academic Subject Setup
                    </h4>
                   
                    <div class="element-box">
                      <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                          <ul class="nav nav-tabs smaller nav-tabs-sticky">
                            <li class="nav-item ">
                              <a class="nav-link active text-center" data-toggle="tab" href="#setup"><i class="fa fa-wrench"></i>  <br />Subject setup</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link text-center" data-toggle="tab" href="#junior-school"><i class="fa fa-arrow-down"></i>   <br />Junior Secondary Subjects</a>
                            </li>


                            <li class="nav-item">
                              <a class="nav-link text-center" data-toggle="tab" href="#senior-school"><i class="fa fa-arrow-up"></i>   <br />Senior Secondary Subjects</a>
                            </li>
                            

                            <li class="nav-item">
                              <a class="nav-link assessmentPaneToggle text-center" data-toggle="tab" href="#assessment"><i class="fa fa-bar-chart"></i>   <br />Assessment</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link assessmentPaneToggle text-center" data-toggle="tab" href="#external"><i class="fa fa-pie-chart"></i>  <br />External exams</a>
                            </li>
                            
                          </ul>
                          
                        </div>



                        <div class="tab-content">


                          <div class="tab-pane active" id="setup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="element-box">
                                    @if(count($subjects) > 0)

	                                   <div class="table-responsive">
	                                      <table class="table table-lightborder">
	                                        <thead>
	                                          <tr>
	                                            <th>
	                                              S/N
	                                            </th>
	                                            <th>
	                                              Subject Name
	                                            </th>
	                                            <th>
	                                              Subject school
	                                            </th>
	                                            <th>
	                                              Date Added
	                                            </th>
	                                            <th>
	                                              Action
	                                            </th>
	                                          </tr>
	                                        </thead>
	                                        <tbody>

	                                        @foreach($subjects as $subject)
	                                        	<tr id="subject{{$subject->id}}">
		                                            <td>{{$x}}</td>

		                                            <td>{{$subject->name}}</td>

		                                            <td>{{$subject->school}}</td>

		                                            <td>{{Carbon\Carbon::parse($subject->created_at)->format('Y-m-d')}}</td>

		                                            <td class="row-actions">
			                                              
                                                    @can('edit subject')
			                                              <a href="{{url('subjects/edit/'.$subject->id)}}" class="editSubject text-primary">
			                                                <i class="fas fa-edit"></i>
			                                              </a>
                                                    @endcan

                                                    @can('delete subject')
			                                              <a class="text-danger" data-id="{{$subject->id}}" onclick="oisDelete(event)" data-hide="#subject{{$subject->id}}" href="{{url('subjects/destroy')}}">
			                                                <i class="fas fa-trash"></i>
			                                              </a>
                                                    @endcan
		                                            </td>
	                                          	</tr>
	                                          	@php ($x++)
	                                        @endforeach

	                                        </tbody>
	                                      </table>

	                                      
	                                    </div>                                      

                                    @else
                                    	<h1 class="text-center">No subject found</h1>
                                    @endif

                                    @can('add subject')
                                    <a href="#" class="btn newSubject btn-primary">Add new subject</a>
                                    @endcan
                                  </div>


                                </div>
                              
                              </div>
                            </div>
                          </div>


                         





                          <!-- Senior secondary school subject tap pane -->
                          <div class="tab-pane" id="junior-school">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="element-box">
                                    
                                    @if(count($juniorSubjects) > 0 )
									<h4>Junior secondary school subjects</h4>

                                    <div class="table-responsive">
                                      <table class="table table-lightborder">
                                        <thead>
                                          <tr>
                                            <th>
                                              S/N
                                            </th>
                                            <th>
                                              Subject Name
                                            </th>
                                            <th>
                                              Subject Child
                                            </th>
                                            
                                            <th class="text-center">
                                              Action
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	@php ($x=1)
                                        	@foreach($juniorSubjects as $category)
                                        		<tr id="juniorCategory{{$category->id}}">
		                                            <td>{{$x}}</td>
		                                            <td>{{$category->name}}</td>
		                                            <td>

		                                            	<!-- Collecting subjects -->
		                                            	@foreach($category->subjects as $subject)

		                                                	<span class="status_pill green"></span>
		                                            		<a title="Double click to remove" data-toggle="tooltip">{{$subject->name}}</a>

		                                            	@endforeach

		                                            </td>


		                                            <td class="row-actions">

		                                              <a data-subject_school_id="2" href="{{url('subjects/category/edit/'.$category->id)}}" title="Edit {{$category->name}}" data-toggle="tooltip" class="text-primary editCategory">
		                                                <i class="fas fa-edit"></i>
		                                              </a>


		                                              <a data-id="{{$category->id}}" href="{{url('subjects/category/addup/'.$category->id.'/2')}}" title="Add a subject" data-toggle="tooltip" 
                                                    class="text-info addSingleSubject" > 
                                                    <i class="fas fa-plus-circle"></i>
                                                  </a>


		                                              <a data-id="{{$category->id}}" class="text-danger" data-hide="#juniorCategory{{$category->id}}" href="{{url('subjects/category/destroy')}}" data-toggle="tooltip" title="Delete {{$category->name}}" onclick="oisDelete(event)">
		                                                <i class="fas fa-trash"></i>
		                                              </a>

		                                            </td>
                                          		</tr>


                                          		@php ($x++)
                                        	@endforeach

                                        </tbody>
                                      </table>
                                    </div>




                                    @else
                                    	<h1 class="text-center">No subject found</h1>
                                    @endif
                                    <p class="text-center">
                                    	<a href="{{url('subjects/category/create/2')}}" class="btn newCategory btn-primary">Add new subject category</a>
                                	</p>

                                  </div>



                                </div>
                              
                              </div>
                            </div>
                          </div>





                          <!-- Senior secondary school subject tap pane -->
                        <div class="tab-pane" id="senior-school">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="element-box">
                                    
                                    @if(count($seniorSubjects) > 0 )
									<h4>Senior secondary school subjects</h4>

                                    <div class="table-responsive">
                                      <table class="table table-lightborder">
                                        <thead>
                                          <tr>
                                            <th>
                                              S/N
                                            </th>
                                            <th>
                                              Subject Name
                                            </th>
                                            <th>
                                              Subject Child
                                            </th>
                                            <th class="text-center">
                                              Date Added
                                            </th>
                                            <th class="text-center">
                                              Action
                                            </th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                        	@php ($x=1)
                                        	@foreach($seniorSubjects as $category)
                                        		<tr id="category{{$category->id}}">
		                                            <td>{{$x}}</td>
		                                            <td>{{$category->name}}</td>
		                                            <td>

		                                            	<!-- Collecting subjects -->
		                                            	@foreach($category->subjects as $subject)

		                                                	<span class="status_pill green"></span> {{$subject->name}}, 

		                                            	@endforeach

		                                            </td>

		                                            <td class="">
		                                              {{Carbon\Carbon::parse($category->created_at)->format('Y-m-d')}}
		                                            </td>

		                                            <td class="row-actions">

		                                              <a data-subject_school_id="3" href="{{url('subjects/category/edit/'.$category->id)}}" title="Edit {{$category->name}}" data-toggle="tooltip" class="editCategory text-primary">
		                                                <i class="fas fa-edit"></i>
		                                              </a>


		                                              <a data-id="{{$category->id}}" href="{{url('subjects/category/addup/'.$category->id.'/3')}}" title="Add a subject" data-toggle="tooltip" class="addSingleSubject"><i class="fas fa-plus-circle"></i></a>


		                                              <a data-id="{{$category->id}}" onclick="oisDelete(event)" data-hide="#category{{$category->id}}" class="text-danger" href="{{url('subjects/category/destroy')}}" data-toggle="tooltip" title="Delete {{$category->name}}">
		                                                <i class="fas fa-trash"></i>
		                                              </a>

		                                            </td>
                                          		</tr>


                                          		@php ($x++)
                                        	@endforeach

                                        </tbody>
                                      </table>
                                    </div>




                                    @else
                                    	<h1 class="text-center">No subject found</h1>
                                    @endif
                                    <p class="text-center">
                                    	<a href="{{url('subjects/category/create/3')}}" class="btn newCategory btn-primary">Add new subject category</a>
                                	</p>

                                  </div>



                                </div>
                              
                              </div>
                            </div>
                          </div>





                   <div class="tab-pane" id="assessment">
                      <div class="tablo-with-chart">
                        <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                 

                                  <div class="element-box">

                     


                        @include('components.assessment')

                    </div>

                    


                                </div>
                              
                              </div>
                            </div>
                          </div>








                          <!-- External examination pane -->
                        <div class="tab-pane" id="external">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                    
                                    <div class="row mb-xl-2 mb-xxl-3">



                                     <div class="col-sm-4">
                                        <a onclick="oisRead(event)" data-type="purple" data-title="Examination Academic Session" data-size="xl" class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('bece/sessions')}}">
                                          <div class="label dashboard-icons">
                                            <div class="ti-ruler-pencil"></div>
                                          </div>
                                          <div class="value dashboard-title">
                                            BECE Result
                                          </div>
                                          
                                          
                                        </a>
                                      </div>



                                      <div class="col-sm-4">
                                        <a onclick="oisRead(event)" data-type="purple" data-title="Examination Academic Session" data-size="xl" class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('waec/sessions')}}">
                                          <div class="label dashboard-icons">
                                            <div class="ti-receipt"></div>
                                          </div>
                                          <div class="value dashboard-title">
                                            WAEC Result  
                                          </div>
                                          
                                        </a>
                                      </div>



                                      <div class="col-sm-4">
                                        <a onclick="oisRead(event)" data-type="purple" data-title="Examination Academic Session" data-size="xl" class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('neco/sessions')}}">
                                          <div class="label dashboard-icons">
                                            <div class="ti-pencil-alt"></div>
                                          </div>
                                          <div class="value dashboard-title">
                                            NECO Result
                                          </div>
                                          
                                        </a>
                                      </div>

                                    </div>


                                    <div class="row mb-xl-2 mb-xxl-3">
                                      <div class="col-sm-4">
                                        <a onclick="oisRead(event)" data-type="purple" data-title="Examination Academic Session" data-size="xl" class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('junior-mock/sessions')}}">
                                          <div class="label dashboard-icons">
                                            <div class="ti-ruler-alt"></div>
                                          </div>
                                          <div class="value dashboard-title">
                                            JUNIOR Mock
                                          </div>
                                          
                                          
                                        </a>
                                      </div>



                                      <div class="col-sm-4">
                                        <a onclick="oisRead(event)" data-type="purple" data-title="Examination Academic Session" data-size="xl" class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('senior-mock/sessions')}}">
                                          <div class="label dashboard-icons">
                                            <div class="ti-ruler-alt"></div>
                                          </div>
                                          <div class="value dashboard-title">
                                            SENIOR Mock
                                          </div>
                                          
                                          
                                        </a>
                                      </div>




                                    </div>



                                </div>
                              
                              </div>
                            </div>
                          </div>






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



	<!-- Edit subject modal -->
	<div class="modal fade" id="editCategory">
	  <div class="modal-dialog modal-md ">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-name">Edit subject</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        <form onsubmit="oisForm(event)" method="POST" action="{{url('subjects/category/update')}}">

	        	{{@csrf_field()}}

	        	<div class="formAlert"></div>

	        	<input type="hidden" name="subject_school_id" id="subject_school_id">
	        	<input type="hidden" name="id" id="id">

	        	<div class="form-group">
			        <label for=""> Category Name</label>
			        <input id="name" required="" name="name" class="form-control" placeholder="Enter subject name" type="text">
			    </div>  


          <!-- Subject category checklist would be loaded here with javascript -->
			    <div class="categoryList">

			    </div>


			    

			    <button class="btn btn-primary" type="submit">Save changes</button>

             </form>
	      </div>

	    </div>
	  </div>
	</div>


	<!-- Edit subject modal -->
	<div class="modal fade" id="editSubject">
	  <div class="modal-dialog modal-md ">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-name">Edit subject</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        <form onsubmit="oisForm(event)" method="POST" action="{{url('subjects/update')}}">

	        	<div class="formAlert"></div>

	        	<input type="hidden" name="id" id="id">
	        	<div class="form-group">
			        <label for=""> Subject Name</label>
			        <input id="name" required="" name="name" class="form-control" placeholder="Enter subject name" type="text">
			    </div>  


			    <div class="form-group">
			        <label for=""> Subject school</label>
			        <select id="subject_school_id" required="" class="subject_schoolOptions form-control" required name='subject_school_id'></select>
			    </div>

			    <button class="btn btn-primary" type="submit"> Add Subject</button>

             </form>
	      </div>

	    </div>
	  </div>
	</div>


	<!-- Create new subject modal -->
	<div class="modal fade" id="newSubject">
	  <div class="modal-dialog modal-md ">
	    <div class="modal-content">

	      <!-- Modal Header -->
	      <div class="modal-header">
	        <h4 class="modal-name">Create new subject</h4>
	        <button type="button" class="close" data-dismiss="modal">&times;</button>
	      </div>

	      <!-- Modal body -->
	      <div class="modal-body">
	        <form onsubmit="oisForm(event)" method="POST" action="{{url('subjects/store')}}">

	        	<div class="formAlert"></div>

	        	<div class="form-group">
			        <label for=""> Subject Name</label>
			        <input name="name" required="" class="form-control" placeholder="Enter subject name" type="text">
			    </div>  


			    <div class="form-group">
			        <label for=""> Subject school</label>
			        <select required="" class="subject_schoolOptions form-control" required name='subject_school_id'></select>
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
			$('.nav-tabs-sticky').stickyTabs();



      /*Show external examination year modal*/
      $(".externalResultYear").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

           dialog(url,'Examination Academic Session','xl','purple');

      });





      /*Grading*/
      if(location.hash == "#assessment"){
        assessment();
      }


      $(".assessmentPaneToggle").click(function(){
        assessment();
      });

      




			/*Trigger edit category modal*/
			$('.editCategory').click(function(e){
				e.preventDefault();
				$("#editCategory").modal('show');
				var subject_school_id = $(this).data('subject_school_id');

				$(".categoryList").html('<i class="fa fa-spinner fa-spin"></i> Collecting subject list, please wait....');

				$.get($(this).attr('href'),function(data){
					console.log(data);

					$("#editCategory").find('#name').val(data.category.name);
					$("#editCategory").find('#id').val(data.category.id);
					$("#editCategory").find('#subject_school_id').val(subject_school_id);

					var subjects = data.subjects
					var list = "";

					/*Looping through subject list to create checklist */
					$.each(subjects,function(i,value){

						list+='<div class="form-check form-check-inline"><label><input checked name="subject_id[]" type="checkbox" value="'+value.id+'" />'+value.name+'</label></div>';
					});


					/*Add subject list to form*/
					$('.categoryList').html(list);
				});


			});





			/*Trigger new class form pop up*/
			$('.newSubject').click(function(e){
				e.preventDefault();
				subject_schoolOptions();
				$('#newSubject').modal('show');
			});



			/*Edit subject*/
			$('.editSubject').click(function(e){
				e.preventDefault();

				var url = $(this).attr('href');
				
				$.get(url,function(data){
					console.log(data);
					var subject = data.subject;
					$("#editSubject").find('#id').val(subject.id);
					$("#editSubject").find('#name').val(subject.name);

					subject_schoolOptions(subject.subject_school_id);
					$("#editSubject").modal('show');
				});
			});
		});
	</script>
@endsection