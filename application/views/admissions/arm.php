<div class="tab-pane" id="tab_armSetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                               <button class="btn btn-outline-primary pull-right" data-target="#armModal" data-toggle="modal" onclick="clear_textbox_arm()" type="button">Add Arm</button>
                                               <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="armModal" role="dialog" tabindex="-1">
                                                  <div class="modal-dialog modal-lg px-5" role="document">
                                                    <form id="add-arm">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">
                                                            <span id="arm_heading"></span> 
                                                          </h5>
                                                          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                                          </div>
                                                          <div class="modal-body ">
                                                              <div class="element-box">
                                                                <div class="row">
                                                                    <div class="col-md-3">Group Name</div>
                                                                    <div class="col-md-7">
                                                                      <input type="text" class="form-control" hidden="" name="arm_id" placeholder=" Example JSS1">
                                                                      <?php foreach($level_group_lists as $level_group_list ) { ?>
                                                                        <div class="form-check">
                                                                          <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="level_group" id="<?php echo $level_group_list->group_name; ?>" value="<?php echo $level_group_list->id; ?>"><?php echo $level_group_list->group_name; ?>
                                                                          </label>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="col-md-3">Arm Name</div>
                                                                    <div class="col-md-7">
                                                                      <input type="text" class="form-control" name="arm_name"  placeholder=" Example Science">
                                                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="arm_name"></div>
                                                                    </div>
                                                                    <div class="col-md-3">Class Alias</div>
                                                                    <div class="col-md-7">
                                                                      <input type="text" class="form-control" name="alias"  placeholder=" Example Humanity">
                                                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="alias"></div>
                                                                    </div>
                                                                  </div>              
                                                              </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_arm" onclick="form_routes_add_arm('add_arm')">Confirm</button>
                                                            </div>
                                                       </div>
                                                    </form>
                                                  </div>
                                               </div>
                                             
                                            <h5>Arm List</h5>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Arm Name</td>
                                                  <td>Group</td>
                                                  <td>Alias</td>
                                                  <td>Date Added</td>
                                                  <td>Added By</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                  $i_arm = 1;
                                                  foreach ($arm_list as $arms) { 
                                                    ?>
                                                  <tr>
                                                    <td><?php echo $i_arm; ?></td>
                                                    <td><?php echo $arms->arm_name; ?></td>
                                                    <td><?php echo $arms->group_name; ?></td>
                                                    <td><?php echo $arms->alias; ?></td>
                                                    <td><?php echo $arms->date_added; ?></td>
                                                    <td><?php echo $arms->username; ?></td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete" onclick="delete_arm_name('<?php echo $arms->id;?>')"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit" onclick="get_arm_data('<?php echo $arms->id; ?>')" data-target="#armModal" data-toggle="modal"  ><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <?php $i_arm++;
                                                   } ?>
                                                  
                                                  
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