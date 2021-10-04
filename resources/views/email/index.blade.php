@extends('layouts.app')

@section('title','Send sms')
@section('content')

          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                  
                    <div class="element-header clearfix">
                      <h4>Bulk Email</h4>
                      

                    </div>

                              
                                <div class="col-xs-12">
                                
                                  <ul class="nav nav-tabs nav-tabs-sticky" id="myTab" role="tablist">
                                    <li class="nav-item">
                                      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true"> To class parent</a>
                                    </li>
                                    <li class="nav-item">
                                      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#others" role="tab" aria-controls="profile" aria-selected="false"> Others</a>
                                    </li>
                                  </ul>


                                  <div class="tab-content" id="myTabContent">


                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

                                      <div class="panel-body card-body">
                                        <form method="post"  onsubmit="oisForm(event)" action="{{url('email/send-to-parent')}}">
                                          {{csrf_field()}}

                                          <div class="formAlert"></div>

                                          <div class="form-group">
                                            <select name="group_class_id" class="form-control classOptions"></select>
                                          </div>


                                          <div class="form-group">
                                            <select name="category_id" class="form-control">
                                              <option value="0">All</option>
                                              <option value="1">{{App\Student::categoryName(1)}}</option>
                                              <option value="2">{{App\Student::categoryName(2)}}</option>
                                            </select>
                                          </div>

                                          <div class="form-group">
                                            <textarea name="message" placeholder="Enter message" required="" class="form-control" rows="5"></textarea>
                                          </div>

                                          <div class="form-group">
                                            <button class="btn btn-primary" type="submit"> <i class="fas fa-share-alt"></i> Send message</button>
                                          </div>

                                        
                                        </form>
                                      </div>

                                    </div>



                                    <div class="tab-pane fade" id="others" role="tabpanel" aria-labelledby="profile-tab">

                                      <div class="card-body">    
                                        <div class="col-sm-12">
                                          <form method="POST" onsubmit="oisForm(event)" action="{{url('email/send-pin')}}">
                                            {{csrf_field()}}
                                            <div class="formAlert"></div>
                                            <div class="form-group">
                                              <select name="category_id" class="form-control">
                                                <option value="1">{{App\Student::categoryName(1)}}</option>
                                                <option value="2">{{App\Student::categoryName(2)}}</option>
                                              </select>
                                            </div>

                                            <button class="btn btn-primary" type="submit">Send Pin</button>
                                          </form>
                                        </div>
                                      </div>


                                    </div>
                                  </div>

                                </div>
                

                  <script type="text/javascript">
                    $(document).ready(function(){
                      classOptions()
                    });

                  </script>

                    
                </div>
              </div>
              

              
            </div>
          </div>

@endsection



@section('script')
  

  <script type="text/javascript">
    $(document).ready(function(){

      classOptions();
    });
  </script>
@endsection