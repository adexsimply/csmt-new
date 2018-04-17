<div class="tab-pane" id="tab_clubSetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                            <h5 >Club List
                                             </h5>
                                               <button class="btn btn-outline-primary pull-right" data-target="#clubModal" data-toggle="modal" onclick="clear_textbox_club()" type="button">Add Club</button>
                                               <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="clubModal" role="dialog" tabindex="-1">
                                                  <div class="modal-dialog modal-lg px-5" role="document">
                                                    <form id="add-club">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">
                                                            <span id="club_heading"></span> 
                                                          </h5>
                                                          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                                          </div>
                                                          <div class="modal-body ">
                                                              <div class="element-box">
                                                                <div class="row">
                                                                    <div class="col-md-3">Club Name</div>
                                                                    <div class="col-md-7">
                                                                      <input type="text" class="form-control" hidden="" name="club_id" placeholder=" Example JSS1">
                                                                      <input type="text" class="form-control" name="club_name"  placeholder=" Example ICT">
                                                                      <div style="color: #ff0000;" class="form-control-feedback" data-field="club_name"></div>
                                                                    </div>
                                                                  </div>            
                                                              </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_club" onclick="form_routes_add_club('add_club')">Confirm</button>
                                                            </div>
                                                       </div>
                                                    </form>
                                                  </div>
                                               </div>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Club Name</td>
                                                  <td>Date Added</td>
                                                  <td>Added By</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                  $i_club = 1;
                                                  foreach ($club_lists as $club_list) { 
                                                    ?>
                                                  <tr>
                                                    <td><?php echo $i_club; ?></td>
                                                    <td><?php echo $club_list->club_name; ?></td>
                                                    <td><?php echo $club_list->date_added; ?></td>
                                                    <td><?php echo $club_list->username; ?></td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete" onclick="delete_club_name('<?php echo $club_list->id;?>')"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit" onclick="get_club_data('<?php echo $club_list->id; ?>')" data-target="#clubModal" data-toggle="modal"  ><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <?php $i_club++;
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