$(document).ready(function(){



  $(".sendSMS").submit(function(e){
    e.preventDefault();
    var element = $(this);
    // var data = element.serialize();
    var url = element.attr('action');
    var post = element.attr('method');
    var display=$(this).find(".formAlert");
    display.html("<div class='text-center text-bold'><i class='fa fa-spinner fa-spin fa-2x'></i> Please wait.....</div>");

    display.show();

    $.ajax({
      url:url,
      type:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        console.log(data);

        // $.ajax({
        //     url : "http://api.ebulksms.com:8080/sendsms.json",
        //     type: "POST",
        //     data : data,
        //     dataType: "json"
        //   }).done(function(status){
        //     console.log(status);
        //   });
      }

    });
  
  });





  $("#sendPinToParent").submit(function(e){
    e.preventDefault();
    var element = $(this);
    // var data = element.serialize();
    var url = element.attr('action');
    var post = element.attr('method');
    var display=$(this).find(".formAlert");
    display.html("<div class='text-center text-bold'><i class='fa fa-spinner fa-spin fa-2x'></i> Please wait.....</div>");

    display.show();

    $.ajax({
      url:url,
      type:"POST",
      data:new FormData(this),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){

        console.log(data);
        // $.ajax({
        //     url : "http://api.ebulksms.com:8080/sendsms.json",
        //     type: "POST",
        //     data : data,
        //     dataType: "json"
        //   }).done(function(status){
        //     console.log(status);
        //   });
      }

    });
  
  });






  $('#systemLocalBackup').click(function(e){
    e.preventDefault();
    var url = $(this).attr('href');

    $('#pleaseWaitDialog').modal('show');
    jQuery.getJSON(url).done(function(data){
      if(typeof data == 'string')
        data = $.parseJSON(data);

    console.log(data);
    
      if(data.status == 1)
        $.dialog({
          title : 'Backup & Restore',
          content : 'System backup successful!',
          type : 'green'
        });

      else
        $.dialog({
          title : 'Backup & Restore',
          content : 'System backup failed',
          type : 'red'
        });


      $('#pleaseWaitDialog').modal('hide');
    });

  });





  $('#systemBackup').click(function(e){
    e.preventDefault();
    var url = $(this).attr('href');
    var progressUrl = $(this).data('progressUrl');

    $('#pleaseWaitDialog').modal('show');
    jQuery.getJSON(url).done(function(data){
      if(data.status == 1)
        $.dialog({
          title : 'Backup & Restore',
          content : 'System backup successful!',
          type : 'green'
        });

      else
        $.dialog({
          title : 'Backup & Restore',
          content : 'System backup failed',
          type : 'red'
        });


      $('#pleaseWaitDialog').modal('hide');
    });



    /*Check progress*/
    function shout(){
      $.get('http://localhost/csmt/public/backup/progress',function(data){
        // var data = jQuery.parseJSON(JSON.stringify(data));
        $('#ajax_loader').html(data);
      });
      
    }


    setInterval(function(){ shout(); },500);

  });





    $('.dataTable').DataTable({
      // "processing": true,
      // "ajax": 'server.php',
      "dom": 'lBfrtip',
      "pageLength": 100,
      "bPaginate": true,
      // "responsive": true,
      "fixedHeader": true,
      "buttons": [
            {
                extend: 'collection',
                orientation : 'landscape',
                pageSize : 'LEGAL',
                text : 'Export',
                titleAttr : 'PDF',
                buttons: [
                    'excel',
                    'csv',
                    'pdf',
                    'print'
                ]
            }
        ]

    });




    function useDataTable(element){
		  $(element).DataTable({
		      // "processing": true,
		      // "ajax": 'server.php',
		      // "dom": 'lBfrtip',
		      "pageLength": 100,
		      "responsive": true,
		      "fixedHeader": true,
		      "buttons": [
		            {
		                extend: 'collection',
		                text: 'Export',
		                buttons: [
		                    'excel',
		                    'csv',
		                    'pdf',
		                    'print'
		                ],
                  orientation : 'landscape',
                  pageSize : 'LEGAL',
                  text : '<i class="fa fa-file-pdf-o"> PDF</i>',
                  titleAttr : 'PDF'
		            }
		        ]

		    });
		}
});


	

    function assessment(){
         /* Generate student list for grading*/
        classOptions(null,true);
        sessionOptions(null,false);
        termOptions();

        $('#uploadAssessment').submit(function(e){
            e.preventDefault();
            var aagc_id = $("#aagc_id").val();
            var session_id = $("#session_id").val();
            var subject_id = $("#subject_id").val();
            var term_id = $("#term_id").val();
            var category_id = $("#category_id").val();
            var url = $(this).attr('action');


            url +=aagc_id+'/'+category_id+'/'+session_id+'/'+subject_id+'/'+term_id;

            dialog(url,'Upload assessments','xl','purple');
        });



        /*Collect subjects offered by students in selected class*/
        $(".fullArmOptions").change(function(){
          var value = $(this).val();

          subjectOptions(null,'id IN (SELECT subject_id FROM aagc_subject WHERE aagc_id='+value+')');

        });
    }