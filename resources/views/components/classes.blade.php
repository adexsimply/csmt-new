<!-- Display class-->
                    <div class="element-box">

                      @if(Addon::isEmpty($groupClasses))

                        <!-- Start accordion -->
                        <div id="classGroupAccordion">

                          <!-- Collect classes as accordion header -->
                          @foreach($groupClasses as $x => $groupClass)

                            @php $className = $groupClass->name @endphp
                            <div class="card rounded-0 no-border bottom-50" id="job{{$x}}">

                               <div class="card-header transparent clearfix">
                                  <div class="pull-left">
                                      <a class="card-link" data-toggle="collapse" href="#classCollapse{{$x}}">
                                          <h5>
                                            <i class="os-icon text-primary os-icon-ui-23"></i> 
                                            {{$className}}
                                          </h5>
                                      </a>

                                  </div>
                              </div>
                              <hr class="no-space">

                              <!-- Class arms as accordion content -->
                              <div id="classCollapse{{$x}}" class="collapse {{$x == 0 ? 'show' : ''}}" data-parent="#classGroupAccordion">

                                <!-- Collect class arms -->
                                <div class="card-body">
                                  @php 
                                    $arms = App\Group_class::armAlias($groupClass->id);
                                  @endphp


                                  @if(Addon::isEmpty($arms))

                                    <div class="row">

                                      @foreach($arms as $arm)

                                        @php ($armName = $arm->arm.' ('.$arm->alias.')')
                                        <!-- Display class arm -->
                                        <div class="col-sm-4 mt-5 ">

                                          <!-- Drop down menu -->
                                          <!-- <div style="z-index: 1; margin-right: 10px; margin-top: 5px;" class="pull-right top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                                            <i class="fas fa-ellipsis-h"></i>
                                            <div class="os-dropdown bg-primary">
                                              <ul>
                                                <li>
                                                  <a href="#">
                                                    <i class="fas fa-eye fa-1x"></i><span> Peep {{$className.' '.$armName}}</span>
                                                  </a>
                                                </li>
                                                <li>
                                                  <a href="#">
                                                    <i class="fas fa-edit"></i><span> Edit {{$className.' '.$armName}}</span>
                                                  </a>
                                                </li>
                                                <li>
                                                  <a href="#">
                                                    <i class="fas fa-trash"></i><span> Delete {{$className.' '.$armName}} </span>
                                                  </a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div> -->

                                            <!-- Class arm holder -->
                                            <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url('classes/aagc/'.$groupClass->group_id.'/'.$arm->id.'/'.Addon::url($groupClass->name.'-'.$arm->arm.'-'.$arm->alias))}}">

                                              <div class="label dashboard-icons">
                                                <div class="fas fa-users"></div>
                                              </div>

                                              <div class="value dashboard-title">
                                                 {{$armName}}
                                              </div>
                                              
                                            </a>


                                          </div>

                                      @endforeach


                                      <div class="col-sm-4 mt-5">
                                          <a class="newArm element-box el-tablo centered trend-in-corner padded bold-label" href="#" data-group_class_id="{{$groupClass->id}}">

                                            <div class="label dashboard-icons">
                                                <div class="fa fa-plus-circle"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              New {{$className}} arm
                                            </div>
                                              
                                          </a>
                                      </div>


                                    </div>

                                  @else
                                    <div class="row">
                                      <div class="col-sm-4 mt-5">
                                          <a class="newArm element-box el-tablo centered trend-in-corner padded bold-label" data-group_class_id="{{$groupClass->id}}" href="#">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-plus-circle"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              New {{$className}} arm
                                            </div>
                                              
                                          </a>
                                      </div>
                                    </div>
                                  @endif 

                                  <!-- <a href="#" data-group_class_id="{{$groupClass->id}}" class="newArm btn btn-success">Add {{$groupClass->name}} Arm</a> -->


                                </div>
                              </div>

                            </div>
                          @endforeach
                        </div>

                      @else
                        <h3>No class found, Please call the admin</h3>
                      @endif


                    </div>
