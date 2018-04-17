                          <div class="tab-pane" id="tab_termSetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                            <h5 >Term List
                                               <button class="btn btn-outline-primary pull-right" data-target="#termModal" data-toggle="modal" onclick="clear_textbox_term()" type="button">Add Term</button>
                                               <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="termModal" role="dialog" tabindex="-1">
                                                  <div class="modal-dialog modal-lg px-5" role="document">
                                                    <form id="add-term">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">
                                                            <span id="term_heading"></span> 
                                                          </h5>
                                                          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                                          </div>
                                                          <div class="modal-body ">
                                                                            <div class="element-box">
                                                                                <div class="row">
                                                                                  <div class="col-md-2"></div>
                                                                                  <div class="col-md-7">
                                                                                    <label for="" >Term Name</label>
                                                                      <input type="text" class="form-control" hidden="" name="term_id" placeholder=" Example 2014 / 2015">
                                                                                    <input type="text" class="form-control" name="term_name"  placeholder=" E.g First Term">
                                                                                  <div style="color: #ff0000;" class="form-control-feedback" data-field="term_name"></div>
                                                                                  </div>
                                                                                  <div class="col-md-5"></div>
                                                                                </div>
                                                                                                     
                                                                            </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_term" onclick="form_routes_add_term('add_term')">Confirm</button>
                                                            </div>
                                                       </div>
                                                    </form>
                                                  </div>
                                               </div>
                                            </h5>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Session Name</td>
                                                  <td>Session Status</td>
                                                  <td>Date Added</td>
                                                  <td>Added By</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>                                                  
                                                  <?php 
                                                  $i_term = 1;
                                                  foreach ($term_list as $terms) { 
                                                    $term_status = $terms->term_status;
                                                    ?>
                                                  <tr>
                                                    <td><?php echo $i_term; ?></td>
                                                    <td><?php echo $terms->term_name; ?></td>
                                                    <td>
                                                      <?php if($term_status=='1') { ?><button class="btn btn-success"><i class="icon-check mr-1"></i>Current Term</button></td>
                                                      <?php } else { ?><button class="btn btn-info text-white" onclick="activate_term_name('<?php echo $terms->id;?>')"><i class="icon-check mr-1"></i>Activate Term</button></td>
                                                      <?php } ?>
                                                    <td><?php echo $terms->date_added; ?></td>
                                                    <td><?php echo $terms->username; ?></td>
                                                    <td>                                                    
                                                      <button class="btn btn-danger" title="Delete" onclick="delete_term_name('<?php echo $terms->id;?>')"><i class="os-icon os-icon-ui-15"></i></button>


                                                      <button class="btn btn-info text-white" onclick="get_term_data('<?php echo $terms->id; ?>')" title="Edit2" data-target="#termModal" data-toggle="modal"  ><i class="os-icon os-icon-ui-49"></i></button>

                                                    </td>
                                                  </tr>
                                                  <?php $i_term++;
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