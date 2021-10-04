<div style="z-index: 999; margin-top: -25px;" class="pull-right os-dropdown-trigger os-dropdown-position-left">
                        <i class="fas fa-ellipsis-h fa-2x"></i>
                        <div class="os-dropdown bg-primary">
                          <ul>

                            <li>
                              <a onclick="oisNew(event)" data-title="Generate pin" data-type="purple" href="{{url('sms/create-pin')}}">
                                <i class="fas fa-tint"></i><span> Generate pin</span>
                              </a>
                            </li>

                            <li>
                              <a href="{{url('sms/pins')}}">
                                <i class="fas fa-eye"></i><span> View pins</span>
                              </a>
                            </li>


                            <li>
                              <a onclick="oisNew(event)" data-title="Send pin" data-type="purple" href="{{url('sms/send-pin')}}">
                                <i class="fas fa-share"></i><span> Send pin</span>
                              </a>
                            </li>


                            <li>
                              <a href="{{url('sms')}}">
                                <i class="fas fa-user-tie"></i><span> Send to parents</span>
                              </a>
                            </li>
                            
                          </ul>
                        </div>
                      </div>