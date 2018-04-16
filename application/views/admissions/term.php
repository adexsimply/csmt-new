<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/mobile'); ?>
<?php $this->load->view('includes/sidebar'); ?>
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
                                                                                  </div>
                                                                                  <div class="col-md-5"></div>
                                                                                  <div style="color: #ff0000;" class="form-control-feedback" data-field="term_name"></div>
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


                                                      <button class="btn btn-info text-white" onclick="get_term_data('<?php echo $terms->id;?>')" title="Edit2" data-target="#termModal" data-toggle="modal"  ><i class="os-icon os-icon-ui-49"></i></button>

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

<?php $this->load->view('includes/foot'); ?>
    <script type="text/javascript">
      /////Add Term form begins
          function validate_term(formData) {
              var returnData;
              $('#add-term').disable([".action"]);
              $("button[title='add_term']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'admissions/validate_term_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                  }
                      returnData = data;
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

          function save_term_name(formData) {
              $("button[title='add_term']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'admissions/add_term_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'admissions'; ?>";
              });
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
          //////////////Add session form ends



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

         ///This clears textbox on modal toggle
          function clear_textbox_term() {
          document.getElementById('term_heading').innerHTML = "Add New Term";
          $('input[type=text]').each(function() {
              $(this).val('');
          });
        }
  </script>
