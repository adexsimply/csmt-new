@extends('layouts.app')

@section('content')

  <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
               @if($subject_school_id == 2)
                <a href="{{url('subjects#junior-school')}}">Junior school subjects</a>
              @else
                <a href="{{url('subjects#senior-school')}}">Senior school subjects</a>
              @endif
            </li>
            <li class="breadcrumb-item">
              <span>Add subject to category</span>
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
                        {{$category->name}}
                    </h4>

                    <div class="element-box">
                      

                      @if(count($subjects) > 0)

                        <form class="mt-4" method="POST" action="{{url('subjects/category/addup/store')}}">

                          {{@csrf_field()}}


                          <input type="hidden" name="id" value="{{$category->id}}">

                          <input type="hidden" name="subject_school_id" value="{{$subject_school_id}}">

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
                                                    <input type="checkbox" value="{{$subject->id}}" name="subject_id[]" class="form-check-input" id="{{$subject->id}}" />
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
                              <button class="btn btn-primary" type="submit"> Submit</button>
                            </div>
                       </form>

                        @else
                          <div class="alert alert-danger text-center">
                              <h1>No subject found</h1>
                              <a class="btn btn-danger" href="{{url('subjects')}}">Create new subject</a>
                          </div>
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
      
    });
  </script>
@endsection