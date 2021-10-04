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
                      <h4>Bulk sms pin</h4>
                      
                      @include('components.sms-menu')

                    </div>

                    <div class="element-box">
                      
                      <div class="col-md-8 center-block">
                          <div class="panel panel-success card">
                              <div class="panel-heading card-header">
                                <h4 class="no-space">Send message to parents</h4>
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
                                        <form method="post"  onsubmit="sendSMSForm(event)" action="{{url('sms/send-to-parent')}}">
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
                                            <input type="text" name="sender" class="form-control" required="" placeholder="Sender" value="CSMT SEC SC" />
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
                                        <form method="post"  onsubmit="sendSMSForm(event)" action="{{url('sms/send-to-others')}}">
                                            {{csrf_field()}}

                                            <div class="formAlert"></div>

                                            <div class="form-group">
                                              <input type="text" name="sender" class="form-control" required="" placeholder="Sender" value="CSMT SEC SC" />
                                            </div>

                                            <div class="form-group">
                                              <textarea name="phones" placeholder="Enter phone numbers separated by comma" required="" class="form-control" rows="5"></textarea>
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



@section('script')
  

  <script type="text/javascript">
    $(document).ready(function(){

      classOptions();
    });
  </script>
@endsection