@extends('layouts.app')
@section('title','Extra')
@section('content')

<ul class="breadcrumb">
  <li class="breadcrumb-item">
    <a href="{{url('home')}}">Dashboard</a>
  </li>          
            
  <li class="breadcrumb-item">
    <span>comments</span>
  </li>
</ul>

  <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper pt-4">
                <div class="element-wrapper">
                  <h6 class="element-header">
                      Extra

                       <a class="newTerm float-right btn btn-primary" href="#">Next term begins</a>
                    </h6>
                   
                    <div class="element-box">
                      <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                          <ul class="nav nav-tabs-sticky nav-tabs smaller">

                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#club">Clubs</a>
                            </li>
                             
                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#house">Houses</a>
                            </li>

                            <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#nextTerm">Next term begings</a>
                            </li>
                          </ul>
                          
                        </div>
                        <div class="tab-content">
                          

                          <div class="tab-pane active" id="club">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                    <div class="row mb-xl-2 mb-xxl-3">
                                      
                                      @foreach(App\Club::all() as $club)


                                        <div class="col-sm-3">
                                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('extra/club-students/'.$club->id)}}">
                                          <div class="label dashboard-icons">
                                            <div class="icon-rocket"></div>
                                          </div>
                                          <div class="value dashboard-title">
                                           
                                              {{$club->name}}
                                            
                                          </div>
                                          
                                        </a>
                                      </div>


                                      @endforeach
                                     
                                    </div>
                                  </div>
                                </div>
                              
                              </div>
                            </div>
                          </div>
                         


         
                          <div class="tab-pane" id="house">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                    <div class="row mb-xl-2 mb-xxl-3">
                                      
                                      @foreach(App\House::all() as $house)


                                        <div class="col-sm-3">
                                        <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('extra/house-students/'.$club->id)}}">
                                          <div class="label dashboard-icons">
                                            <div class="icon-rocket"></div>
                                          </div>
                                          <div class="value dashboard-title">
                                            {{$house->colour}}
                                          </div>
                                          
                                        </a>
                                      </div>


                                      @endforeach
                                     
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>



                          
                          <div class="tab-pane" id="nextTerm">
                           
                                  <div class="table-responsive">    
                                      <table class="table">
                                        <thead>
                                          <th>SN</th>
                                          <th>Session</th>
                                          <th>Term</th>
                                          <th>Category</th>
                                          <th>Next term begins</th>
                                        </thead>
                                        <tbody>
                                          @php ($x=1)
                                      @foreach(App\Next_term_begin::orderBy('id','desc')->get() as $ntb)
                                        <tr id="{{$ntb->id}}">
                                          <td>{{$x}}</td>
                                          <td>{{$ntb->term->name}}</td>
                                          <td>{{$ntb->session->name}}</td>
                                          <td>@if ($ntb->student_category_id==1) {{'Boarding'}} @else {{'Day'}} @endif</td>
                                          <td>{{$ntb->begins}}</td>
                                          <td>
                                            <a class="delete text-danger" data-id="{{$ntb->id}}" onclick="oisDelete(event)" href="{{url('next-term-begins/delete')}}"><i class="fa fa-times-circle"></i> </a>
                                          </td>
                                        </tr>
                                        @php ($x++)
                                      @endforeach

                                       </tbody>
                                      </table>
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

  
  <!-- Create next term begin -->
  <div class="modal fade" id="newTerm">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Next term begins</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form onsubmit="oisForm(event)" id="newSession" method="POST" action="{{url('next-term-begins/store')}}">

            <div class="formAlert"></div>

            <div class="form-group">
              <label for=""> Next term begins</label>
              <input type="text" name="begins" required="" placeholder="20-JAN-2019" class="form-control" />
            </div>

            <div class="form-group">
              <label for=""> Session</label>
              <select name="session_id" required="" class="form-control sessionOptions"></select>
            </div> 

            <div class="form-group">
              <label for=""> Term</label>
              <select name="term_id" required="" class="form-control termOptions"></select>
            </div>  

            <div class="form-group">
              <label for=""> Student Category</label>
              <select name="student_category_id" required="" class="form-control">
                <option value="">Select Category</option>
                <option value="1">Boarding</option>
                <option value="2">Day</option>
              </select>
            </div>  

          <br>
            <button class="btn btn-primary" type="submit"> Submit</button>
          
          

             </form>
        </div>

      </div>
    </div>
  </div>
  
@endsection

@section('script')
  <script type="text/javascript">
    $(document).ready(function(){
      $(".nav-tabs-sticky").stickyTabs();

      $(".newTerm").click(function(e){
          e.preventDefault();
          sessionOptions();
          termOptions();
          $("#newTerm").modal('show');
      });
    });
  </script>
@endsection