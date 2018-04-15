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
                              <a class="nav-link active" data-toggle="tab" href="#tab_academicSession">Academic Session setup</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_termSetup">Academic Term setup</a>
                            </li>
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_levelSetup">Academic Level setup</a>
                            </li>
                          
                            <li class="nav-item">
                              <a class="nav-link " data-toggle="tab" href="#tab_categorySetup">Students Category setup</a>
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
                              														  Add New Session
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
                              					                                            <input type="text" class="form-control" name="sess_name" placeholder=" Example 2014 / 2015">
                              					                                          </div>
                              					                                          <div class="col-md-5"></div>
                                                                                  <div style="color: #ff0000;" class="form-control-feedback" data-field="sess_name"></div>
                              					                                        </div>
                              					                                                             
                              					                                    </div>
                                													  </div>
                                													  <div class="modal-footer">
                                														<button class="btn btn-secondary" data-dismiss="modal" type="button"> Cancel</button><button class="btn btn-primary" type="button" title="add_session" onclick="form_routes_add('add_session')">Add Session</button>
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

                          <div class="tab-pane" id="tab_termSetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <h6 class="element-header">
                                        Create New Term
                                      </h6>
                                     
                                      <div class="element-box">
                                        <form action="">
                                          <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-7">
                                              <label for="" >Term Name</label>
                                              <input type="text" class="form-control" placeholder=" E.g First Term">
                                              <button class="btn btn-success mt-3">Add Term</button>
                                            </div>
                                            <div class="col-md-5"></div>
                                          </div>
                                            
                                        </form>                      
                                      </div>
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                            <h5 >Term List</h5>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Session Name</td>
                                                  <td>Session Status</td>
                                                  <td>Date Added</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>1</td>
                                                    <td>Third term</td>
                                                    <td><button class="btn btn-success"><i class="icon-check mr-1"></i>Current Term</button></td>
                                                    <td>16-08-2017 11:19am</td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit"><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>2</td>
                                                    <td>2016/2017</td>
                                                    <td><button class="btn btn-info text-white"><i class="icon-check mr-1"></i>Activate Term</button></td>
                                                    <td>05-09-2016 4:14pm</td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit"><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>3</td>
                                                    <td>First Term</td>
                                                    <td><button class="btn btn-success"><i class="icon-check mr-1"></i>Current Term</button>
                                                    </td>
                                                    <td>05-09-2016 4:14pm</td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit"><i class="os-icon os-icon-ui-49"></i></button>
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


                          <div class="tab-pane" id="tab_levelSetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <h6 class="element-header">
                                        Create New Level
                                      </h6>
                                     
                                      <div class="element-box">
                                        <form action="">
                                          <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-7">
                                              <label for="" >Level Name</label>
                                              <input type="text" class="form-control" placeholder=" E.g JSS1">
                                              <button class="btn btn-success mt-3">Add Level</button>
                                            </div>
                                            <div class="col-md-5"></div>
                                          </div>
                                            
                                        </form>                      
                                      </div>
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                            <h5 >Academic level List</h5>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Level Name</td>
                                                  <td>Date Added</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>1</td>
                                                    <td>SSS2</td>
                                                    <td>16-08-2017 11:19am</td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit"><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>2</td>
                                                    <td>SSS1</td>
                                                   
                                                    <td>05-09-2016 4:14pm</td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit"><i class="os-icon os-icon-ui-49"></i></button>
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>3</td>
                                                    <td>JSS3</td>
                                                    
                                                    <td>05-09-2016 4:14pm</td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      <button class="btn btn-info text-white" title="Edit"><i class="os-icon os-icon-ui-49"></i></button>
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
                         

                          <div class="tab-pane" id="tab_categorySetup">
                            <div class="tablo-with-chart">
                              <div class="row">
                                <div class="col-sm-12 col-xxl-12">
                                  <div class="tablos">
                                      <h6 class="element-header">
                                        Create New Category
                                      </h6>
                                     
                                      <div class="element-box">
                                        <form action="">
                                          <div class="row">
                                            <div class="col-md-2"></div>
                                            <div class="col-md-7">
                                              <label for="" >Category Name</label>
                                              <input type="text" class="form-control" placeholder=" E.g day student">
                                              <button class="btn btn-success mt-3">Add Category</button>
                                            </div>
                                            <div class="col-md-5"></div>
                                          </div>
                                            
                                        </form>                      
                                      </div>
                                      <div class="element-box">
                                        <div class="row">                        
                                          <div class="col-md-12 mt-5">
                                            <h5 >Academic level List</h5>
                                            <div class="table-responsive">
                                              <table class="table table-lightborder">
                                                <thead>
                                                  <td>S/N</td>
                                                  <td>Category Name</td>
                                                  <td>Date Added</td>
                                                  <td>Action</td>
                                                  
                                                </thead>
                                                <tbody>
                                                  <tr>
                                                    <td>1</td>
                                                    <td>Day Student</td>
                                                    <td>16-08-2017 11:19am</td>
                                                    <td>
                                                      <button class="btn btn-danger" title="Delete"><i class="os-icon os-icon-ui-15"></i></button>
                                                      
                                                    </td>
                                                  </tr>
                                                  <tr>
                                                    <td>2</td>
                                                    <td>Boarding Student</td>
                                                   
                                                    <td>05-09-2016 4:14pm</td>
                                                    <td>
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
                              
                              </div>
                            </div>
                          </div>

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
    url: '<?php echo base_url('admissions/ajax_text')?>',
    dataType : 'json',
    data: {id: idr},
    success: function(data){

            var sess1_name = data[0].sess_name;
            var sess_id = data[0].id;
            $('[name="sess_name"]').val(sess1_name);
            $('[name="sess_id"]').val(sess_id);
    }
});
    }

   
    function clear_textbox() {
    $('input[type=text]').each(function() {
        $(this).val('');
    });
  }

</script> 
