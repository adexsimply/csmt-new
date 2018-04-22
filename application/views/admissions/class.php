<div class="tab-pane" id="tab_classSetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                               <button class="btn btn-outline-primary pull-right" data-target="#classModal" data-toggle="modal" onclick="clear_textbox_class()" type="button">Add Class</button>
                                               <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="classModal" role="dialog" tabindex="-1">
                                                  <div class="modal-dialog modal-lg px-5" role="document">
                                                    <form id="add-class">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">
                                                            <span id="class_heading"></span> 
                                                          </h5>
                                                          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                                          </div>
                                                          <div class="modal-body ">
                                                              <div class="element-box">
                                                                <div class="row">
                                                                    <div class="col-md-3">Group Name</div>
                                                                    <div class="col-md-7">
                                                                      <input type="text" class="form-control" hidden="" name="class_id" placeholder=" Example JSS1">
                                                                      <?php foreach($level_group_lists as $level_group_list ) { ?>
                                                                        <div class="form-check">
                                                                          <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="group_name" id="<?php echo $level_group_list->id; ?>" value="<?php echo $level_group_list->id; ?>"><?php echo $level_group_list->group_name; ?>
                                                                          </label>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="col-md-3">Level Name</div>
                                                                    <div class="col-md-7">
                                                                      <input type="text" class="form-control" hidden="" name="class_id" placeholder=" Example JSS1">
                                                                      <?php foreach($level_list as $level_lists ) { ?>
                                                                        <div class="form-check">
                                                                          <label class="form-check-label">

                                                                            <input type="radio" class="form-check-input" name="level_name" id="<?php echo $level_lists->level_name; ?>" value="<?php echo $level_lists->id; ?>"><?php echo $level_lists->level_name; ?>
                                                                          </label>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                    <div class="col-md-3">Arm Name</div>
                                                                    <div class="col-md-7">
                                                                      <?php foreach($arm_list as $arm_lists ) { ?>
                                                                        <div class="form-check">
                                                                          <label class="form-check-label">
                                                                            <input type="radio" class="form-check-input" name="arm_name" id="<?php echo $arm_lists->arm_name; ?>" value="<?php echo $arm_lists->id; ?>"><?php echo $arm_lists->arm_name."(".$arm_lists->group_name.")"; ?>
                                                                            <input type="text" name="group_id" hidden="" value="<?php echo $arm_lists->level_group; ?>">
                                                                          </label>
                                                                        </div>
                                                                        <?php } ?>
                                                                    </div>
                                                                  </div>              
                                                              </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_class" onclick="form_routes_add_class('add_class')">Confirm</button>
                                                            </div>
                                                       </div>
                                                    </form>
                                                  </div>
                                               </div>
                                             
                                            <h5>Class List</h5>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Class</td>
                                                  <td>Date Added</td>
                                                  <td>Added By</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                  $i_class = 1;
                                                  foreach ($class_lists as $class_list) { 
                                                    ?>
                                                  <tr>
                                                    <td><?php echo $i_class; ?></td>
                                                    <td><?php echo $class_list->level_name.$class_list->arm_name; ?></td>
                                                    <td><?php echo $class_list->date_added; ?></td>
                                                    <td><?php echo $class_list->username; ?></td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete" onclick="delete_class_name('<?php echo $class_list->id;?>')"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit" onclick="get_class_data('<?php echo $class_list->id; ?>')" data-target="#classModal" data-toggle="modal"  ><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <?php $i_class++;
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