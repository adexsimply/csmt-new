<script type="text/javascript">
  

       ///This clears textbox on modal toggle
        function clear_textbox_club() {
        document.getElementById('club_heading').innerHTML = "Add New Club";
        $('input[type=text]').each(function() {
            $(this).val('');
        });
      }




          ////Function to show form for session editing
         function get_club_data(idr1) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('admissions/get_club_details')?>',
          dataType : 'json',
          data: {id: idr1},
          success: function(data){

                  var club_name = data[0].club_name;
                  var club_id = data[0].id;
                  $('[name="club_name"]').val(club_name);
                  $('[name="club_id"]').val(club_id);
                  document.getElementById('club_heading').innerHTML = "Edit Club";
          }
        });
          }


        function delete_club_name(rowIndex) {
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
            $.post("<?php echo base_url() . 'admissions/delete_club'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'admissions'; ?>";
            });
          });
        }

      /////Add Term form begins
          function validate_club(formData) {
              var returnData;
              $('#add-club').disable([".action"]);
              $("button[title='add_club']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'admissions/validate_club_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                      returnData = data;
                  }
              });


              $('#add-club').enable([".action"]);
              $("button[title='add_club']").html("Save changes");
              if (returnData != 'success') {
                  $('#add-club').enable([".action"]);
                  $("button[title='add_club']").html("Save changes");
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

          function form_routes_add_club(action) {
              if (action == 'add_club') {
                  var formData = $('#add-club').serialize();
                  if (validate_club(formData) == 'success') {
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
                          save_club_name(formData);
                      });
                  }
              } else {
                  cancel();
              }
          }

          function save_club_name(formData) {
              $("button[title='add_club']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'admissions/add_club_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'admissions'; ?>";
              });
          }
</script>