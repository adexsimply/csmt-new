<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/mobile'); ?>
<?php $this->load->view('includes/sidebar'); ?>
        <div class="content-w">
          <!--------------------
            START - Breadcrumbs
            -------------------->
            <ul class="breadcrumb">
              <li class="breadcrumb-item">
                <a href="dashboard.html">Dashboard</a>
              </li>
              <li class="breadcrumb-item">
                <span>Admission</span>
              </li>
              <li class="breadcrumb-item">
                <span>Admission Setup</span>
              </li>
            </ul>
            <!--------------------
            END - Breadcrumbs
            -------------------->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                                       
                    <div class="element-box">
                      <div class="os-tabs-w">
                        <div class="os-tabs-controls">
                          <ul class="nav nav-tabs smaller">
                            <li class="nav-item">
                              <a class="nav-link active" data-toggle="tab" href="#tab_academicSession">Academic Session</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_termSetup">Academic Term</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_levelSetup">Academic Level</a>
                            </li>
                          
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_categorySetup">Students Category</a>
                            </li>
                          
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_armSetup">Class Arm</a>
                            </li>

                          
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_clubSetup">Club</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_withdraw">Withdraw Student</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_gradute">Graduate Student</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_graduated">Graduated Students</a>
                            </li>
                             <li class="nav-item">
                              <a class="nav-link" data-toggle="tab" href="#tab_withdrawnStudents">Withdrawn Students</a>
                            </li>
                          </ul>
                          
                        </div>
                        <div class="tab-content">
                          <div class="tab-pane active" id="tab_academicSession">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">

                                    <div class="element-box">
                                        <div class="row">        

                                          <div class="col-md-12 mt-5">
                                            <h5 >Session List
                      											   <button class="btn btn-outline-primary pull-right" data-target="#humanitiesModal" data-toggle="modal" onclick="clear_textbox()" type="button">Add Session</button>
                      											   <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="humanitiesModal" role="dialog" tabindex="-1">
                        												  <div class="modal-dialog modal-lg px-5" role="document">
                                                    <form id="add-session">
                              													<div class="modal-content">
                              													  <div class="modal-header">
                              														<h5 class="modal-title" id="exampleModalLabel">
                              														  <span id="session_heading"></span> 
                              														</h5>
                              														<button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                              													  </div>
                              													  <div class="modal-body ">
                              					                                    <div class="element-box">
                              					                                        <div class="row">
                              					                                          <div class="col-md-2"></div>
                              					                                          <div class="col-md-7">
                              					                                            <label for="" >Session Name</label>
                                                                      <input type="text" class="form-control" hidden="" name="sess_id" placeholder=" Example 2014 / 2015">
                              					                                            <input type="text" class="form-control" name="sess_name" id="sess_name11" placeholder=" Example 2014 / 2015">
                                                                                  <div style="color: #ff0000;" class="form-control-feedback" data-field="sess_name"></div>
                              					                                          </div>
                              					                                          <div class="col-md-5"></div>
                              					                                        </div>
                              					                                                             
                              					                                    </div>
                                													  </div>
                                													  <div class="modal-footer">
                                														<button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_session" onclick="form_routes_add('add_session')">Confirm</button>
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
                                                  $i_session = 1;
                                                  foreach ($session_list as $sessions) { 
                                                    $session_status = $sessions->session_status;
                                                    ?>
                                                  <tr>
                                                    <td><?php echo $i_session; ?></td>
                                                    <td><?php echo $sessions->sess_name; ?></td>
                                                    <td> <?php if($session_status=='1') { ?>
                                                      <button class="btn btn-success"><i class="icon-check mr-1"></i>Current Session</button>
                                                      <?php } else { ?>
                                                      <button class="btn btn-info text-white" onclick="activate_session_name('<?php echo $sessions->id;?>')"><i class="icon-check mr-1"></i>Activate Session</button>
                                                      <?php } ?>
                                                    </td>
                                                    <td><?php echo $sessions->date_added; ?></td>
                                                    <td><?php echo $sessions->username; ?></td>
                                                    <td>
                                                      <button class="btn btn-danger" onclick="delete_session_name('<?php echo $sessions->id;?>')" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" onclick="get_data('<?php echo $sessions->id;?>')" data-target="#humanitiesModal" data-toggle="modal" title="Edit"><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <?php $i_session++;
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

  
                          <?php $this->load->view('admissions/term'); ?>

                          <div class="tab-pane" id="tab_levelSetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                            <h5 >Academic level List
                                               <button class="btn btn-outline-primary pull-right" data-target="#levelModal" data-toggle="modal" onclick="clear_textbox_level()" type="button">Add Level</button>
                                               <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="levelModal" role="dialog" tabindex="-1">
                                                  <div class="modal-dialog modal-lg px-5" role="document">
                                                    <form id="add-level">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">
                                                            <span id="level_heading"></span> 
                                                          </h5>
                                                          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                                          </div>
                                                          <div class="modal-body ">
                                                              <div class="element-box">
                                                                  <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-7">
                                                                      <label for="" >Level Name</label>
                                                                      <input type="text" class="form-control" hidden="" name="level_id" placeholder=" Example JSS1">
                                                                      <input type="text" class="form-control" name="level_name"  placeholder=" Example JSS1">
                                                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="level_name"></div>
                                                                      <label for="" >Level Name</label>
                                                                      <input type="text" class="form-control" name="level_rank"  placeholder=" Example 1">
                                                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="level_rank"></div>
                                                                    </div>
                                                                    <div class="col-md-5"></div>
                                                                  </div>              
                                                              </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_level" onclick="form_routes_add_level('add_level')">Confirm</button>
                                                            </div>
                                                       </div>
                                                    </form>
                                                  </div>
                                               </div></h5>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Level Name</td>
                                                  <td>Level Rank</td>
                                                  <td>Date Added</td>
                                                  <td>Added By</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>                                                  
                                                  <?php 
                                                  $i_level = 1;
                                                  foreach ($level_list as $levels) { 
                                                    ?>
                                                  <tr>
                                                    <td><?php echo $i_level; ?></td>
                                                    <td><?php echo $levels->level_name;?></td>
                                                    <td><?php echo $levels->level_rank; ?></td>
                                                    <td><?php echo $levels->date_added; ?></td>
                                                    <td><?php echo $levels->username; ?></td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete" onclick="delete_level_name('<?php echo $levels->id;?>')"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit" onclick="get_level_data('<?php echo $levels->id; ?>')" data-target="#levelModal" data-toggle="modal"  ><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <?php $i_level++;
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
                         

                          <div class="tab-pane" id="tab_categorySetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                            <h5 >Category List
                                               <button class="btn btn-outline-primary pull-right" data-target="#categoryModal" data-toggle="modal" onclick="clear_textbox_category()" type="button">Add Category</button>
                                               <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="categoryModal" role="dialog" tabindex="-1">
                                                  <div class="modal-dialog modal-lg px-5" role="document">
                                                    <form id="add-category">
                                                        <div class="modal-content">
                                                          <div class="modal-header">
                                                          <h5 class="modal-title" id="exampleModalLabel">
                                                            <span id="category_heading"></span> 
                                                          </h5>
                                                          <button aria-label="Close" class="close" data-dismiss="modal" type="button"><span aria-hidden="true"> &times;</span></button>
                                                          </div>
                                                          <div class="modal-body ">
                                                              <div class="element-box">
                                                                  <div class="row">
                                                                    <div class="col-md-2"></div>
                                                                    <div class="col-md-7">
                                                                      <label for="" >Category Name</label>
                                                                      <input type="text" class="form-control" hidden="" name="category_id" placeholder=" Example JSS1">
                                                                      <input type="text" class="form-control" name="category_name"  placeholder=" Example Boarding">
                                                                    <div style="color: #ff0000;" class="form-control-feedback" data-field="category_name"></div>
                                                                    </div>
                                                                    <div class="col-md-5"></div>
                                                                  </div>              
                                                              </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                            <button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_category" onclick="form_routes_add_category('add_category')">Confirm</button>
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
                                                  <td>Category Name</td>
                                                  <td>Date Added</td>
                                                  <td>Added By</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>
                                                  <?php 
                                                  $i_category = 1;
                                                  foreach ($category_list as $categorys) { 
                                                    ?>
                                                  <tr>
                                                    <td><?php echo $i_category; ?></td>
                                                    <td><?php echo $categorys->category_name; ?></td>
                                                    <td><?php echo $categorys->date_added; ?></td>
                                                    <td><?php echo $categorys->username; ?></td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete" onclick="delete_category_name('<?php echo $categorys->id;?>')"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit" onclick="get_category_data('<?php echo $categorys->id; ?>')" data-target="#categoryModal" data-toggle="modal"  ><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <?php $i_category++;
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


                          <?php $this->load->view('admissions/arm'); ?> 

                          <?php $this->load->view('admissions/club'); ?>  


                          <div class="tab-pane" id="tab_withdraw">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">                               
                                     <div class="table-responsive">
                                        <h3 class="mb-5">Student's Information</h3>
                                        <table id="example" class="table table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>S/N</th>
                                                    <th>Student's ID</th>
                                                    <th>Name</th>
                                                    <th>Class</th>
                                                    <th>Parent's Name</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                  <td  >1</td>
                                                  <td>CSMT/SS/15/155</td>
                                                  <td>COLLINS-IGWE  KAOSISOCHUKWU C.</td>
                                                  <td>SS3H</td>
                                                  <td>MR&MRS ADOL AWAM</td>
                                                 
                                                  <td>
                                                    <a class="btn btn-warning" href="#" title="Delete"> Recall
                                                    </a>
                                                    <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>

                                                  </td>
                                                </tr>
                                                <tr>
                                                  <td  >2</td>
                                                  <td>CSMT/SS/15/155</td>
                                                  <td>COLLINS-IGWE  KAOSISOCHUKWU C.</td>
                                                  <td>JSS3D</td>
                                                  <td>MR&MRS ADOL AWAM</td>
                                                 
                                                  <td>
                                                    <a class="btn btn-warning" href="#" title="Delete"> Recall
                                                    </a>
                                                    <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>

                                                  </td>
                                                </tr>
                                               
                                            </tbody>
                                          
                                        </table>
                                      </div>
                                  </div>
                                </div>
                              
                              </div>
                            </div>
                          </div>

                          <div class="tab-pane" id="tab_gradute">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="row ">
                                        <div class="col-sm-3">
                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="junior_graduate.html">
                                            <div class="label dashboard-icons">
                                              <div class="icon-rocket"></div>
                                            </div>
                                            <div class="value dashboard-title">
                                              Junior Secondary
                                            </div>
                                            
                                          </a>
                                        </div>
                                        <div class="col-sm-3">
                                          <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="senior_graduate.html">
                                            <div class="label dashboard-icons">
                                              <div class="icon-rocket"></div>
                                            </div>
                                            <div class="value dashboard-title">
                                              Senior Secondary
                                            </div>
                                            
                                          </a>
                                        </div>
                                      </div>

                                        
                                  </div>
                                </div>
                              
                              </div>
                            </div>
                          </div>

                          <div class="tab-pane" id="tab_graduated">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                    <div class="element-box">
                                      <h5 class="element-header">
                                        Select Category
                                      </h5>
                                      <form action="">
                                        <div class="row">
                                          <div class="col-md-8">
                                            <label for="">Session Name</label>
                                            <select name="level_name" required="" class="form-control">
                                              <option value=""></option>
                                              <option value="2014/2015">2014/2015</option> 
                                              <option value="2015/2016">2015/2016</option>
                                              <option value="2016/2017">2016/2017</option>
                                              <option value="2017/2018">2017/2018</option>                    
                                            </select>
                                          </div>
                                          <div class="col-md-4">
                                            <button class="btn btn-success mt-2e">Load Class</button>
                                          </div>
                                        </div>
                                      </form>
                                    </div>
                                  </div>
                                </div>
                              
                              </div>
                            </div>
                          </div>

                          <div class="tab-pane" id="tab_withdrawnStudents">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <div class="table-responsive">
                                          <h3 class="mb-5">Student's Information</h3>
                                          <table id="example" class="table table-striped table-bordered" style="width:100%">
                                              <thead>
                                                  <tr>
                                                      <th>S/N</th>
                                                      <th>Student's ID</th>
                                                      <th>Name</th>
                                                      <th>Class</th>
                                                      <th>Parent's Name</th>
                                                      <th>Options</th>
                                                  </tr>
                                              </thead>
                                              <tbody>
                                                  <tr>
                                                    <td  >1</td>
                                                    <td>CSMT/SS/15/155</td>
                                                    <td>COLLINS-IGWE  KAOSISOCHUKWU C.</td>
                                                    <td>Withdrawn</td>
                                                    <td>MR&MRS ADOL AWAM</td>
                                                   
                                                    <td>
                                                      <a class="btn btn-warning" href="#" title="Delete"> Recall
                                                      </a>

                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td  >2</td>
                                                    <td>CSMT/SS/15/155</td>
                                                    <td>COLLINS-IGWE  KAOSISOCHUKWU C.</td>
                                                    <td>Withdrawn</td>
                                                    <td>MR&MRS ADOL AWAM</td>
                                                   
                                                    <td>
                                                      <a class="btn btn-warning" href="#" title="Delete"> Recall
                                                      </a>

                                                    </td>
                                                  </tr>
                                                 
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
                </div>
              </div>
              

              
            </div>
          </div>
        </div>

<?php $this->load->view('includes/foot'); ?>

<script type="text/javascript">
    /////Add Session form begins
    function validate(formData) {
        var returnData;
        $('#add-session').disable([".action"]);
        $("button[title='add_session']").html("Validating data, please wait...");
        $.ajax({
            url: "<?php echo base_url() . 'admissions/validate_session_name'; ?>", async: false, type: 'POST', data: formData,
            success: function(data, textStatus, jqXHR) {
                returnData = data;
            }
        });



        $('#add-session').enable([".action"]);
        $("button[title='add_session']").html("Save changes");
        if (returnData != 'success') {
            $('#add-session').enable([".action"]);
            $("button[title='add_session']").html("Save changes");
            $('.form-control-feedback').html('');
            $('.form-control-feedback').each(function() {
                for (var key in returnData) {
                    if ($(this).attr('data-field') == key) {
                        $(this).html(returnData[key]);
                    }
                }
            });
        } else {
            return 'success';   
        }
    }

    function save_session_name(formData) {
        $("button[title='add_session']").html("Saving data, please wait...");
        $.post("<?php echo base_url() . 'admissions/add_session_name'; ?>", formData).done(function(data) {

            window.location = "<?php echo base_url().'admissions'; ?>";
        });
    }

    function form_routes_add(action) {
        if (action == 'add_session') {
            var formData = $('#add-session').serialize();
            if (validate(formData) == 'success') {
                swal({   
                    title: "Please check your data",   
                    text: "",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    cancelButtonText: "Cancel",
                    confirmButtonText: "Save",
                    closeOnConfirm: true 
                }, function() {
                    save_session_name(formData);
                });
            }
        } else {
            cancel();
        }
    }
    //////////////Add session form ends



    function delete_session_name(rowIndex) {
      swal({   
        title: "Are you sure want to delete this data?",   
        text: "Deleted data can not be restored!",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }, function() {
        //var row = datagrid.getRowData(rowIndex);
        $.post("<?php echo base_url() . 'admissions/delete_sess'; ?>", {id : rowIndex}).done(function(data) {
         window.location = "<?php echo base_url().'admissions'; ?>";
        });
      });
    }

    function activate_session_name(rowIndex) {
      swal({   
        title: "Are you sure want to Activate?",   
        text: "",
        type: "warning",
        showCancelButton: true,
        confirmButtonColor: "#DD6B55",
        cancelButtonText: "Cancel",
        confirmButtonText: "Proceed",
        closeOnConfirm: true 
      }, function() {
        //var row = datagrid.getRowData(rowIndex);
        $.post("<?php echo base_url() . 'admissions/activate_sess'; ?>", {id : rowIndex}).done(function(data) {
         window.location = "<?php echo base_url().'admissions'; ?>";
        });
      });
    }

      ////Function to show form for session editing
          function get_data(idr) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('admissions/get_session_details')?>',
          dataType : 'json',
          data: {id: idr},
          success: function(data){

                  var sess1_name = data[0].sess_name;
                  var sess_id = data[0].id;
                  var edit = "Edit"
                  $('[name="sess_name"]').val(sess1_name);
                  $('[name="sess_id"]').val(sess_id);
                  document.getElementById('session_heading').innerHTML = "Edit Session";
          }
      });
          }

         ///This clears textbox on modal toggle
          function clear_textbox() {
          document.getElementById('session_heading').innerHTML = "Add New Session";
          $('input[type=text]').each(function() {
              $(this).val('');
          });
        }


       ///This clears textbox on modal toggle
        function clear_textbox_term() {
        document.getElementById('term_heading').innerHTML = "Add New Term";
        $('input[type=text]').each(function() {
            $(this).val('');
        });
      }




          ////Function to show form for session editing
         function get_term_data(idr1) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('admissions/get_term_details')?>',
          dataType : 'json',
          data: {id: idr1},
          success: function(data){

                  var term1_name = data[0].term_name;
                  var term_id = data[0].id;
                  $('[name="term_name"]').val(term1_name);
                  $('[name="term_id"]').val(term_id);
                  document.getElementById('term_heading').innerHTML = "Edit Term";
          }
        });
          }


        function activate_term_name(rowIndex) {
          swal({   
            title: "Are you sure want to Activate?",   
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }, function() {
            //var row = datagrid.getRowData(rowIndex);
            $.post("<?php echo base_url() . 'admissions/activate_term'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }



        function delete_term_name(rowIndex) {
          swal({   
            title: "Are you sure want to delete this data?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }, function() {
            //var row = datagrid.getRowData(rowIndex);
            $.post("<?php echo base_url() . 'admissions/delete_term'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }

      /////Add Term form begins
          function validate_term(formData) {
              var returnData;
              $('#add-term').disable([".action"]);
              $("button[title='add_term']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'admissions/validate_term_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                      returnData = data;
                  }
              });


              $('#add-term').enable([".action"]);
              $("button[title='add_term']").html("Save changes");
              if (returnData != 'success') {
                  $('#add-term').enable([".action"]);
                  $("button[title='add_term']").html("Save changes");
                  $('.form-control-feedback').html('');
                  $('.form-control-feedback').each(function() {
                      for (var key in returnData) {
                          if ($(this).attr('data-field') == key) {
                              $(this).html(returnData[key]);
                          }
                      }
                  });
              } else {
                  return 'success';   
              }
          }

          function form_routes_add_term(action) {
              if (action == 'add_term') {
                  var formData = $('#add-term').serialize();
                  if (validate_term(formData) == 'success') {
                      swal({   
                          title: "Please check your data",   
                          text: "",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          cancelButtonText: "Cancel",
                          confirmButtonText: "Save",
                          closeOnConfirm: true 
                      }, function() {
                          save_term_name(formData);
                      });
                  }
              } else {
                  cancel();
              }
          }

          function save_term_name(formData) {
              $("button[title='add_term']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'admissions/add_term_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'admissions'; ?>";
              });
          }


       ///This clears textbox on modal toggle
        function clear_textbox_level() {
        document.getElementById('level_heading').innerHTML = "Add New Level";
        $('input[type=text]').each(function() {
            $(this).val('');
        });
      }




          ////Function to show form for session editing
         function get_level_data(idr1) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('admissions/get_level_details')?>',
          dataType : 'json',
          data: {id: idr1},
          success: function(data){

                  var level1_name = data[0].level_name;
                  var level1_rank = data[0].level_rank;
                  var level_id = data[0].id;
                  $('[name="level_name"]').val(level1_name);
                  $('[name="level_rank"]').val(level1_rank);
                  $('[name="level_id"]').val(level_id);
                  document.getElementById('level_heading').innerHTML = "Edit Level";
          }
        });
          }


        function activate_level_name(rowIndex) {
          swal({   
            title: "Are you sure want to Activate?",   
            text: "",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }, function() {
            //var row = datagrid.getRowData(rowIndex);
            $.post("<?php echo base_url() . 'admissions/activate_level'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }



        function delete_level_name(rowIndex) {
          swal({   
            title: "Are you sure want to delete this data?",   
            text: "Deleted data can not be restored!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            cancelButtonText: "Cancel",
            confirmButtonText: "Proceed",
            closeOnConfirm: true 
          }, function() {
            //var row = datagrid.getRowData(rowIndex);
            $.post("<?php echo base_url() . 'admissions/delete_level'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }

      /////Add Term form begins
          function validate_level(formData) {
              var returnData;
              $('#add-level').disable([".action"]);
              $("button[title='add_level']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'admissions/validate_level_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                      returnData = data;
                  }
              });


              $('#add-level').enable([".action"]);
              $("button[title='add_level']").html("Save changes");
              if (returnData != 'success') {
                  $('#add-level').enable([".action"]);
                  $("button[title='add_level']").html("Save changes");
                  $('.form-control-feedback').html('');
                  $('.form-control-feedback').each(function() {
                      for (var key in returnData) {
                          if ($(this).attr('data-field') == key) {
                              $(this).html(returnData[key]);
                          }
                      }
                  });
              } else {
                  return 'success';   
              }
          }

          function form_routes_add_level(action) {
              if (action == 'add_level') {
                  var formData = $('#add-level').serialize();
                  if (validate_level(formData) == 'success') {
                      swal({   
                          title: "Please check your data",   
                          text: "",
                          type: "warning",
                          showCancelButton: true,
                          confirmButtonColor: "#DD6B55",
                          cancelButtonText: "Cancel",
                          confirmButtonText: "Save",
                          closeOnConfirm: true 
                      }, function() {
                          save_level_name(formData);
                      });
                  }
              } else {
                  cancel();
              }
          }

          function save_level_name(formData) {
              $("button[title='add_level']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'admissions/add_level_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'admissions'; ?>";
              });
          }
</script> 
<?php $this->load->view('admissions/category_script'); ?>
<?php $this->load->view('admissions/arm_script'); ?>
<?php $this->load->view('admissions/club_script'); ?>