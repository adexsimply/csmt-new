<script type="text/javascript">
  

       ///This clears textbox on modal toggle
        function clear_textbox_category() {
        document.getElementById('category_heading').innerHTML = "Add New Category";
        $('input[type=text]').each(function() {
            $(this).val('');
        });
      }




          ////Function to show form for session editing
         function get_category_data(idr1) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('admissions/get_category_details')?>',
          dataType : 'json',
          data: {id: idr1},
          success: function(data){

                  var category1_name = data[0].category_name;
                  var category_id = data[0].id;
                  $('[name="category_name"]').val(category1_name);
                  $('[name="category_id"]').val(category_id);
                  document.getElementById('category_heading').innerHTML = "Edit Category";
          }
        });
          }


        function delete_category_name(rowIndex) {
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
            $.post("<?php echo base_url() . 'admissions/delete_category'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }

      /////Add Term form begins
          function validate_category(formData) {
              var returnData;
              $('#add-category').disable([".action"]);
              $("button[title='add_category']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'admissions/validate_category_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                      returnData = data;
                  }
              });


              $('#add-category').enable([".action"]);
              $("button[title='add_category']").html("Save changes");
              if (returnData != 'success') {
                  $('#add-category').enable([".action"]);
                  $("button[title='add_category']").html("Save changes");
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

          function form_routes_add_category(action) {
              if (action == 'add_category') {
                  var formData = $('#add-category').serialize();
                  if (validate_category(formData) == 'success') {
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
                          save_category_name(formData);
                      });
                  }
              } else {
                  cancel();
              }
          }

          function save_category_name(formData) {
              $("button[title='add_category']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'admissions/add_category_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'admissions'; ?>";
              });
          }
</script>