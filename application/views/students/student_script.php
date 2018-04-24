<script type="text/javascript">
  

       ///This clears textbox on modal toggle
        function clear_textbox_student() {
        document.getElementById("add-student").reset();
        $('input[type=text]').each(function() {
            $(this).val('');
        });
      }




          ////Function to show form for session editing
         function get_student_data(idr1) {
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('students/get_student_details')?>',
          dataType : 'json',
          data: {id: idr1},
          success: function(data){

                  var student_id = data[0].student_id;
                  var student_surname = data[0].surname;
                  var other_names = data[0].other_names;
                  var id = data[0].stud_id;
                  var date_of_birth = data[0].date_of_birth;
                  var gender = data[0].gender;
                  var student_address = data[0].student_address;
                  var parent_fullname = data[0].parent_fullname;
                  var state_of_origin = data[0].state_of_origin;
                  var lga = data[0].lga;
                  var relationship = data[0].relationship;
                  var phone = data[0].phone;
                  var phone_2 = data[0].phone_2;
                  var club_id = data[0].club_id;
                  var club_name = data[0].club_name;
                  var house = data[0].house;
                  var session_admission = data[0].session_admission;
                  var sess_name = data[0].sess_name;
                  var class_id = data[0].class_id;
                  var category_id = data[0].category_id;
                  var level_id = data[0].level_id;
                  var level_name = data[0].level_name;
                  var arm_id = data[0].arm_id;
                  var arm_name = data[0].arm_name;
                  var category_name = data[0].category_name;
                  var group_id = data[0].group_id;
                  var group_name = data[0].group_name;
                  var blood_group = data[0].blood_group;
                  var genotype = data[0].genotype;
                  var health_challenge = data[0].health_challenge;
                  var emergency_treatment = data[0].emergency_treatment;
                  var school_immune = data[0].school_immune;
                  var lab_test = data[0].lab_test;

                  //////////////////////////////Date starts
                  var date_of_birth1 = date_of_birth.split('/');
                  var date_of_birth1_y = date_of_birth1[2];
                  var date_of_birth1_m = date_of_birth1[0];
                  var date_of_birth1_d = date_of_birth1[1];

                  if (date_of_birth1_m.length < 2) {
                    date_of_birth1_m = '0'+ date_of_birth1_m;
                  }
                  var date_of_birth_com = date_of_birth1_y +'-'+ date_of_birth1_m + '-' + date_of_birth1_d;
                  /////////////Date


                  $('[name="id"]').val(id);
                  $('[name="student_id"]').val(student_id);
                  $('[name="surname"]').val(student_surname);
                  $('[name="other_names"]').val(other_names);
                  $('[name="dob"]').val(date_of_birth_com);
                  $('#gender').prepend($('<option value=' + gender + ' selected>' + gender + '</option>')).val(gender);
                  $('#student_address').append(student_address);
                  $('[name="parent_fullname"]').val(parent_fullname);
                  $('#state').prepend($('<option value=' + state_of_origin + ' selected>' + state_of_origin + '</option>')).val(state_of_origin);
                  $('[name="lga"]').val(lga);
                  $('[name="relationship"]').val(relationship);
                  $('[name="phone"]').val(phone);
                  $('[name="phone_2"]').val(phone_2);
                  $('[name="health_challenge"]').val(health_challenge);
                  $('#club').prepend($('<option value=' + club_id + ' selected>' + club_name + '</option>')).val(club_id);
                  $('#house').prepend($('<option value=' + house + ' selected>' + house + '</option>')).val(house);
                  $('#sess_name').prepend($('<option value=' + session_admission + ' selected>' + sess_name + '</option>')).val(session_admission);
                  $('#student_category').prepend($('<option value=' + category_id + ' selected>' + category_name + '</option>')).val(category_id);
                  $('#group').prepend($('<option value=' + group_id + ' selected>' + group_name + '</option>')).val(group_id);
                  $('#class_info').prepend($('<option value=' + class_id + ' selected>' + level_name + arm_name + '</option>')).val(class_id);
                  $('#blood_group').prepend($('<option value=' + blood_group + ' selected>' + blood_group + '</option>')).val(blood_group);
                  $('#genotype').prepend($('<option value=' + genotype + ' selected>' + genotype + '</option>')).val(genotype);

                  if (lab_test=='Yes'){
                    $("#labYes").attr('checked', 'checked');
                  }
                  else {
                    $("#labNo").attr('checked', 'checked');                    
                  }

                  if (school_immune=='Yes'){
                    $("#immunizeYes").attr('checked', 'checked');
                  }
                  else {
                    $("#immunizeNo").attr('checked', 'checked');                    
                  }

                  if (emergency_treatment=='Yes'){
                    $("#emergencyYes").attr('checked', 'checked');
                  }
                  else {
                    $("#emergencyNo").attr('checked', 'checked');                    
                  }


                  //$('[name="student_address"]').val(student_address);

                  // var select = document.getElementById('gender');
                  // var opt = new Option('Hello', 'my-option');
                  // select.insertBefore(opt, select.firstChild);


                  //document.getElementById('dob').innerHTML = date_of_birth;
                  //document.getElementById("default_gender").setAttribute("value", "Male");
                  // document.getElementById(level_group).checked = true;
          }
        });
          }


        function delete_student_name(rowIndex) {
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
            $.post("<?php echo base_url() . 'students/delete_student'; ?>", {id : rowIndex}).done(function(data) {
             window.location = "<?php echo base_url().'students'; ?>";
            });
          });
        }

      /////Add Term Student begins
          function validate_student(formData) {
              var returnData;
              $('#add-student').disable([".action"]);
              $("button[title='add_student']").html("Validating data, please wait...");
              $.ajax({
                  url: "<?php echo base_url() . 'students/validate_student_name'; ?>", async: false, type: 'POST', data: formData,
                  success: function(data, textStatus, jqXHR) {
                      returnData = data;
                  }
              });


              $('#add-student').enable([".action"]);
              $("button[title='add_student']").html("Save changes");
              if (returnData != 'success') {
                  $('#add-student').enable([".action"]);
                  $("button[title='add_student']").html("Save changes");
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

          function form_routes_add_student(action) {
              if (action == 'add_student') {
                  var formData = $('#add-student').serialize();
                  if (validate_student(formData) == 'success') {
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
                          save_student_name(formData);
                      });
                  }
              } else {
                  cancel();
              }
          }

          function save_student_name(formData) {
              $("button[title='add_student']").html("Saving data, please wait...");
              $.post("<?php echo base_url() . 'students/add_student_name'; ?>", formData).done(function(data) {

                  window.location = "<?php echo base_url().'students'; ?>";
              });
          }




          ////Function to show form for session editing
         function get_class_list() {
          var group = document.getElementById('group').value;
            $.ajax({
          type: "POST",
          url: '<?php echo base_url('students/get_class_list')?>',
          dataType : 'json',
          data: {id: group},
          success: function(data){

                var i;
                var html ='<option value=""></option>';
                for(i=0; i<data.length; i++){
                  var level_name = data[i].level_name;
                  var arm_name = data[i].arm_name;
                  var level_group = data[i].group_name;
                  var class_id = data[i].id;
                  // $('[name="arm_name"]').val(arm1_name);
                  // $('[name="alias"]').val(alias);
                  // $('[name="arm_id"]').val(arm_id);
                  // document.getElementById('arm_heading').innerHTML = "Edit Arm";
                  // document.getElementById(level_group).checked = true;
                 // alert(level_name);
                  //console.log(level_name + arm_name + group);
                  html += '<option value="'+ class_id +'">' + level_name + arm_name +'</option>';
                }                
                $('#class_info').html(html);
          }
        });
          }

</script>