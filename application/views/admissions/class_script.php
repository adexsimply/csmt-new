<script type="text/javascript">
  

       ///This clears textbox on modal toggle
        function clear_textbox_class() {
        document.getElementById('class_heading').innerHTML = "Add New Class";
        $('input[type=radio]').each(function() {
            $(this).prop('checked', false);
        });
      }




          ////Function to show form for session editing
         function get_class_data(idr1) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('admissions/get_class_details')?>',
          dataType : 'json',
          data: {id: idr1},
          success: function(data){

                  var arm1_name = data[0].arm_name;
                  var level_name = data[0].level_name;
                  var class_id = data[0].id;
                  //$('[name="arm_name"]').val(arm1_name);
                  //$('[name="level_name"]').val(level_name);
                  $('[name="class_id"]').val(class_id);
                  document.getElementById('class_heading').innerHTML = "Edit Class";
                  document.getElementById(level_name).checked = true;
                  document.getElementById(arm1_name).checked = true;
          }
        });
          }


        function delete_class_name(rowIndex) {
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
            $.post("<?php echo base_url() . 'admissions/delete_class'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }

      /////Add Term form begins
          function validate_class(formData) {
              var returnData;
              $('#add-class').disable([".action"]);
              $("button[title='add_class']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'admissions/validate_class_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                      returnData = data;
                  }
              });


              $('#add-class').enable([".action"]);
              $("button[title='add_class']").html("Save changes");
              if (returnData != 'success') {
                  $('#add-class').enable([".action"]);
                  $("button[title='add_class']").html("Save changes");
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

          function form_routes_add_class(action) {
              if (action == 'add_class') {
                  var formData = $('#add-class').serialize();
                  if (validate_class(formData) == 'success') {
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
                          save_class_name(formData);
                      });
                  }
              } else {
                  cancel();
              }
          }

          function save_class_name(formData) {
              $("button[title='add_class']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'admissions/add_class_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'admissions'; ?>";
              });
          }
</script>