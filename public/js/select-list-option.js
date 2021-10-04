
  function monthOptions(month=null){

    var monthOptions="";
    var months = new Array('January','February','March','April','May','June','July','August','September','October','November','December');

    for (x = 0; x < 12; x++){
      if((month-1) == x)
        monthOptions+="<option selected value='"+(x+1)+"'>"+months[x]+"</option>";
      else
        monthOptions+="<option value='"+(x+1)+"'>"+months[x]+"</option>";
    }

    $(".monthOptions").html(monthOptions);

  }




  function yearOptions(year=null){

    var yearOptions="";
    var dt = new Date();
    var currentYear = dt.getFullYear() + 1;
    var yearOptions = "<option value=''>Select year</option>";

    for( ; currentYear >= 1970; currentYear-- ){
        if(currentYear == year)
          yearOptions+="<option selected value="+currentYear+">"+currentYear+"</option>";

        else
          yearOptions+="<option value="+currentYear+">"+currentYear+"</option>";
      }

    $(".yearOptions").html(yearOptions);

  }




/*Fetch states*/
  function stateOptions(){

    var that = $(".stateOptions");

    that.html("<option>Collecting states......</option>");
    $.get('{{url("fetch-state")}}',function(data){
      // console.log(data);
      var stateOptions = "<option value=''>Select a state</option>";
      $.each(data.states,function(i,value){
        stateOptions+="<option value='"+value.id+"'>"+value.name+"</option>";
      });


      that.html(stateOptions);

    });

  }



  


/*Ajax fetch lgas*/
  $(".stateOptions").change(function(){
    var id = $(this).val();
    var that = $(".lgaOptions");
    that.html("<option value=''>Collecting local governments......</option>");
    $.get('{{url("fetch-lga")}}',{state_id:id},function(data){
      var lgas='';
      var data = data.lgas;
      $.each(data,function(i,value){
        lgas+="<option value='"+value.id+"'>"+value.name+"</option>";
      });

       that.html(lgas);

    });
  });
  
  
  
/*Change table status*/
  $(document).on('click','.statusToggle',function(e){
    e.preventDefault();
    var that = $(this);
    var id = that.data('id');
    var url = that.attr('href');

    $.confirm({
      title:'Change status',
      type:'red',
      icon:'fa fa-warning',
      content:'Are you sure ?',
      buttons:{
        Yes : function(){
          $.post(url,{id:id},function(data){
            console.log(data);
            if(data.status==1){
              location.reload();
            }
            else if(data==150){
              window.location="{{url('150')}}";
            }
            else{
              alert(data.message);
            }
          });
        },

        No : function(){}

      }
    });
    
  });
  
  
  
  
  
  
/*Delete data  */
  $(document).on('click','.changeStatus',function(e){
    e.preventDefault();
    var that = $(this);
    var student_id = that.data('student_id');
    var url = that.attr('href');


    $.confirm({
             title: 'Change status',
             type:'purple',
             content: '' +
             '<form action="" class="formName">' +

             '<div class="form-group">' +
             '<select class="status form-control">'+
             '<option value="1">Active</option>'+
             '<option value="2">JSS3 Graduate</option>'+
             '<option value="3">SSS3 Graduate</option>'+
             '<option value="4">Expelled</option>'+
             '<option value="0">Withdrawn</option></select>'+
             '</div>' +
             '</form>',
             buttons: {
                 formSubmit: {
                     text: 'Save',
                     btnClass: 'btn-primary',
                     action: function () {
                         var status = this.$content.find('.status').val();

                         $.post(url,{status:status,student_id:student_id},function(data){
                             
                            $.alert(data.message);

                            if(data.status == 1){
                              location.reload();
                             }

                                 
                         });
                     }
                 },
                 cancel: function () {
                     //close
                 },
             },
             onContentReady: function () {
                 // bind to events
                 var jc = this;
                 this.$content.find('form').on('submit', function (e) {
                     // if the user submits the form by pressing enter in the field.
                     e.preventDefault();
                     jc.$$formSubmit.trigger('click'); // reference the button and click it
                 });
             }
        });



    
    
  });
  

 
  
  $(".toggleImager").click(function(){
      $(this).siblings(".logoPicker").click();
    });
      
  $(".logoPicker").change(function(event){
    var showImage=$(this).siblings(".toggleImager").children(".showImage");
    showImage.show();
    $(this).siblings(".toggleImager").children(".i").hide();
    showImage.attr("src",URL.createObjectURL(event.target.files[0]));
    });
  