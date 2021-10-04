@extends('layouts.app')

@section('title','Arm sessions')
@section('content')

@php $name = $aagc->group_class->name.' '.$aagc->arm->name.'('.$aagc->alias->name.')'; @endphp

	<ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{url('classes')}}">All classes</a>
            </li>
            <li class="breadcrumb-item">
              <a href="{{url('classes/'.$group_id)}}">{{App\Group::name($group_id)}} classes</a>
            </li>
            <li class="breadcrumb-item">
              <span>{{$name}} Class sessions</span>
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
                      {{$name}}
                      <a href="{{url('classes/aagc/session-list/'.$aagc->id)}}" class="newSession float-right btn btn-outline-primary"><i class="fa fa-plus-circle"></i> Add new session</a>
                    </h4>

                    
                   
                    
                      @if(count($aagc) > 0 )

                        <div class="element-box">

                          <h3>Class sessions</h3>
                           <hr>

                          <div class="row mb-xl-2 mb-xxl-3">

                            @foreach($aagc->sessions as $session)

                                <div class="col-sm-4">


                                  <div style="z-index: 1; margin-right: 10px; margin-top: 5px;" class="pull-right top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                                            <i class="fas fa-ellipsis-h"></i>
                                            <div class="os-dropdown bg-primary">
                                              <ul>

                                                <li>
                                                  <a href="{{url('classes/aagc/session-details/'.$group_id.'/'.$aagc->group_class_id.'/'.$aagc->id.'/1/'.$session->id)}}">
                                                    <i class="fas fa-users"></i>
                                                      Boarding School
                                                  </a>
                                                </li>

                                                <li>
                                                  <a href="{{url('classes/aagc/session-details/'.$group_id.'/'.$aagc->group_class_id.'/'.$aagc->id.'/2/'.$session->id)}}">
                                                    <i class="fas fa-users"></i>
                                                     Day School
                                                  </a>
                                                </li>

                                              </ul>
                                            </div>
                                  </div>


                                    <a class="element-box el-tablo activateTerm centered trend-in-corner padded bold-label" href="{{url('classes/aagc/session-details/'.$group_id.'/'.$aagc->group_class_id.'/'.$aagc->id.'/1/'.$session->id)}}">

                                            <div class="label dashboard-icons">
                                              <div class="icon-rocket"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              {{$session->name}}
                                            </div>
                                            
                                    </a>
                                           
                                </div>
                            @endforeach

                            <div class="col-sm-4">
                              <a class="newSession element-box el-tablo activateTerm centered trend-in-corner padded bold-label" href="{{url('classes/aagc/session-list/'.$aagc->id)}}">
                                <div class="label dashboard-icons">
                                  <div class="fas fa-plus-circle"></div>
                                </div>
                                <div class="value dashboard-title">
                                  New session
                                </div>
                                            
                              </a>
                                          
                            </div>

                          </div>
                        </div>

                      @else

                        <div class="element-box text-center">
                          <h3> No Session found! </h3>
                          <a href="#" class="newSession btn btn-success">Add new session</a>
                        </div>
                      @endif
                    
                </div>
              </div>
              

              
            </div>
          </div>

@endsection

@section('modal')
  <!-- Create new session modal -->
  <div class="modal fade" id="newSession">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Create new Session</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form onsubmit="oisForm(event)" id="newSession" method="POST" action="{{url('classes/aagc/store-single-session')}}">

            <div class="formAlert"></div>

            <input type="hidden" name="aagc_id" value="{{$aagc->id}}">

            <div class="form-group">
              <label for=""> Sessions</label>
              <select name="session_id" required="" class="form-control sessionOptions"></select>
            </div>
 


          <button class="btn btn-primary" type="submit"> Add session</button>

             </form>
        </div>

      </div>
    </div>
  </div>

@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $(".newSession").click(function(e){
          e.preventDefault();

          var url = $(this).attr('href');

          $.get(url,function(data){

            var sessionOptions = "";

            if(data.sessions.length == 0)
                sessionOptions="<option>No session found</option>";

              else{
              
                $.each(data.sessions,function(i,value){

                    sessionOptions+="<option value='"+value.id+"'>"+value.name+"</option>";
                });

              }

              $(".sessionOptions").html(sessionOptions);

              $("#newSession").modal('show');


          });

          
      });
    });
  </script>
@endsection

