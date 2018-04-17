<script type="text/javascript">
  

       ///This clears textbox on modal toggle
        function clear_textbox_arm() {
        document.getElementById('arm_heading').innerHTML = "Add New Arm";
        $('input[type=text]').each(function() {
            $(this).val('');
        });
      }




          ////Function to show form for session editing
         function get_arm_data(idr1) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('admissions/get_arm_details')?>',
          dataType : 'json',
          data: {id: idr1},
          success: function(data){

                  var arm1_name = data[0].arm_name;
                  var alias = data[0].alias;
                  var level_group = data[0].group_name;
                  var arm_id = data[0].id;
                  $('[name="arm_name"]').val(arm1_name);
                  $('[name="alias"]').val(alias);
                  $('[name="arm_id"]').val(arm_id);
                  document.getElementById('arm_heading').innerHTML = "Edit Arm";
                  document.getElementById(level_group).checked = true;
          }
        });
          }


        function delete_arm_name(rowIndex) {
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
            $.post("<?php echo base_url() . 'admissions/delete_arm'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }

      /////Add Term form begins
          function validate_arm(formData) {
              var returnData;
              $('#add-arm').disable([".action"]);
              $("button[title='add_arm']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'admissions/validate_arm_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                      returnData = data;
                  }
              });


              $('#add-arm').enable([".action"]);
              $("button[title='add_arm']").html("Save changes");
              if (returnData != 'success') {
                  $('#add-arm').enable([".action"]);
                  $("button[title='add_arm']").html("Save changes");
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

          function form_routes_add_arm(action) {
              if (action == 'add_arm') {
                  var formData = $('#add-arm').serialize();
                  if (validate_arm(formData) == 'success') {
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
                          save_arm_name(formData);
                      });
                  }
              } else {
                  cancel();
              }
          }

          function save_arm_name(formData) {
              $("button[title='add_arm']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'admissions/add_arm_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'admissions'; ?>";
              });
          }
</script>