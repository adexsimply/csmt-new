/*Table rows to link*/
  $(".rowLink").click(function(){
    window.location=$(this).data('url');
  });

  
/*Ajax csrf token declaration*/
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
  });

  /*Open passed url in a new tab*/
  function newTab(url){
    return window.open(url,'_blank');
  }


  /*Activate bootstrap tooltip*/
  $('[data-toggle="tooltip"]').tooltip();

  /*Replace newline with br tage*/
  String.prototype.nl2br = function(){ return this.replace(/\n/g, "<br />"); }

  /*Number format*/
  window.numberFormat=function(x){
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }



  //Maximum value of X-Axis hould be supplied
    function graphPloter(xAxis,yAxis,graphData,element,dataLabel=''){

        // init line chart if element exists
        if ($(element).length) {

          var lineChart = $(element);

          // line chart data
          var lineData = {
            labels: yAxis,
            datasets: [{
              label: dataLabel,
              fill: false,
              lineTension: 0.3,
              backgroundColor: "#fff",
              borderColor: "#047bf8",
              borderCapStyle: 'butt',
              borderDash: [],
              borderDashOffset: 0.0,
              borderJoinStyle: 'miter',
              pointBorderColor: "#fff",
              pointBackgroundColor: "#141E41",
              pointBorderWidth: 3,
              pointHoverRadius: 10,
              pointHoverBackgroundColor: "#FC2055",
              pointHoverBorderColor: "#fff",
              pointHoverBorderWidth: 3,
              pointRadius: 5,
              pointHitRadius: 10,
              data: graphData,
              spanGaps: true
            }]
          };

          // line chart init
          var myLineChart = new Chart(lineChart, {
            type: 'line',
            data: lineData,
            options: {
              legend: {
                display: false
              },
              scales: {
                xAxes: [{
                  ticks: {
          fontSize: '11',
          fontColor: '#969da5'
                  },
                  gridLines: {
          color: 'rgba(0,0,0,0.05)',
          zeroLineColor: 'rgba(0,0,0,0.05)'
                  }
                }],
                yAxes: [{
                  display: false,
                  ticks: {
          beginAtZero: true,
          max: xAxis
                  }
                }]
              }
            }
          });
        }



    }




  /*Send form data to server*/
  function oisForm(event){
    event.preventDefault();

    var element = $(event.target);
    // var data = element.serialize();
    var url = element.attr('action');
    var display=element.find(".formAlert");
    display.html("<div class='text-center text-bold'><i class='fa fa-spinner fa-spin fa-2x'></i> Please wait.....</div>");

    display.show();

    $.ajax({
      url:url,
      type:"POST",
      data:new FormData(event.target),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
         console.log(data);
         var data = jQuery.parseJSON(JSON.stringify(data));
        
        if(data.status==1){
          
          
          if(data.retain==301){

            $.confirm({
                            title:'Operation successful',
                            content:'Would you like to refresh this page to see the latest data?',
                            icon:'fa fa-check-circle',
                            type:'green',
                            buttons:{
                                yes:function(){
                                    location.reload();
                                },
                                no:function(){
                                    
                                }
                            }
                        });

            /*Clear the form field*/
              element.trigger('reset');
          }

          else if(data.retain == 1){
            if(data.message)
             $.alert(data.message);

            else
             $.alert('Operation successful');
          }

          else if(data.retain == 0){
            element.trigger('reset');
          }

          else if(data.url){
            window.location = data.url;
          }
        
          
          

          
          
          display.html("<div class='alert alert-success text-center'>"+data.message+"  <a href='#' class='close' data-dismiss='alert' aria-label='close'>&times;</a></div>");

          setTimeout(function(){display.hide(1000);},6000);
        }
        else if(data.status==301){
          
          $.alert({
            content : data.message,
            title : 'Operation status',
            type : 'green',
          });
        
          location.reload();
          
          
        }
        else{
          display.html("<div class='alert alert-danger text-center'>"+data.message+"</div>");
        }
        

      },

       error: function(data) {
        var status = data.status;
        /*Checking form validation error*/
        var m='';
        var error = data.responseJSON;
        if(status===422){

                    for(var k in error.errors){
                           // m+=error.errors[k];
                           m+="<div class='alert alert-danger text-center'>"+error.errors[k]+"</div>";
                        }
          }

          // Other errors
        else {

        
          
           m+="<div class='alert alert-danger text-center'>"+error.message+"</div>";
        }
          display.html(m);
                    // console.log(data);
                            
                 }

    });

  }


  function messageSender(data){
    $.ajax({
            url : "http://api.ebulksms.com:8080/sendsms.json",
            type: "POST",
            data : data,
            dataType: "json"
          }).done(function(status){
            console.log(status);
          });
  }


  function sendSMSForm(event){
    event.preventDefault();

    var element = $(event.currentTarget);
    var url = element.attr('action');
    var post = element.attr('method');
    var display=element.find(".formAlert");
    display.html("<div class='text-center text-bold'><i class='fa fa-spinner fa-spin fa-2x'></i> Please wait.....</div>");

    display.show();

    $.ajax({
      url:url,
      type:"POST",
      data:new FormData(event.target),
      contentType:false,
      cache:false,
      processData:false,
      success:function(data){
        var data = jQuery.parseJSON(JSON.stringify(data));
        var count = parseInt(data.length);
        
        console.log(data);
        // if(isNaN(count)){
        //   $.ajax({
        //     url : "http://api.ebulksms.com:8080/sendsms.json",
        //     type: "POST",
        //     data : data,
        //     async : false,
        //     dataType: "json"
        //   }).done(function(status){
        //      console.log(status);
        //     if(status.response.status == "SUCCESS")
        //       display.html("<div class='alert alert-success text-center'> "+status.response.totalsent+" message(s) sent </div>");
        //     else
        //       display.html("<div class='alert alert-danger text-center'> Message(s) not sent, please try again</div>");
        //   });
        // }
          
        // else if(count > 0){
        //   var sentMessage = 0;
        //   $.each(data,function(i,value){
        //     $.ajax({
        //       url : "http://api.ebulksms.com:8080/sendsms.json",
        //       type: "POST",
        //       data : value,
        //       async : false,
        //       dataType: "json"
        //     }).done(function(status){
        //       console.log(status);
        //       if(status.response.status == "SUCCESS")
        //         sentMessage++;
        //     });
        //   });

        //   display.html("<div class='alert alert-success text-center'> "+sentMessage+" message(s) sent </div>");

        // }
        // else
        //   display.html("<div class='text-center alert alert-danger'> Nothing to send</div>");

      }

    });
  }


  

  function viewAssignmentAttendance(event){
    event.preventDefault();

    var element = $(event.currentTarget);
    var title = element.data('title');
    var type = element.data('type');
    var size = element.data('size');
    var date = $('#classAssignmentSubject').val();
    var subject_id = element.val();
    var url = element.data('url')+'/'+subject_id+'/'+date;

    title = title ? title : 'Attendance';
    size = size ? size : 'm';
    type = type ? type : '';
  
    dialog(url,title,size,type);

    /*Clear the calendar*/
    element.val('');
  }
  

  function viewAttendance(event){
    event.preventDefault();

    var element = $(event.currentTarget);
    var title = element.data('title');
    var type = element.data('type');
    var size = element.data('size');
    var date = element.val();
    var url = element.data('url')+'/'+date;

    title = title ? title : 'Attendance';
    size = size ? size : 'm';
    type = type ? type : '';
  
    dialog(url,title,size,type);

    /*Clear the calendar*/
    element.val('');
  }


  /*OIS CRUD scripts*/
  function oisNew(event){
    event.preventDefault();
    /*var element = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a');*/
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var type = element.data('type');
    var size = element.data('size');

    title = title ? title : 'Add new';
    size = size ? size : 'm';
    type = type ? type : '';

    dialog(url,title,size,type);
  }


  
  function oisRead(event){
    event.preventDefault();
    /*var element = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a');*/
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var type = element.data('type');
    var size = element.data('size');


    title = title ? title : 'Edit entity';
    size = size ? size : 'm';
    type = type ? type : '';

    dialog(url,title,size,type);
  }

  
  function oisReport(event){
    event.preventDefault();
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var type = element.data('type');
    var size = element.data('size');


    title = title ? title : 'Report';
    size = size ? size : 'm';
    type = type ? type : '';

    dialog(url,title,size,type);
  }



  function oisEdit(event){
    event.preventDefault();

    /*var element = $(event.target).is('a') ? $(event.target) : $(event.target).parents('a');*/
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var type = element.data('type');
    var size = element.data('size');

    title = title ? title : 'Edit entity';
    size = size ? size : 'm';
    type = type ? type : '';

    dialog(url,title,size,type);
  }




  function oisDelete(event){
    event.preventDefault();
    
    var element = $(event.currentTarget);
    var url = element.attr('href');
    var title = element.data('title');
    var content = element.data('content');
    var id = element.data('id');
    var redirect = element.data('redirect');
    var hide = element.data('hide');
    var method = element.data('method');
    
    title = title ? title : 'Delete permanently';
    content = content ? content : 'Please note that this action is irreversible, Procced to delete ? ';

    $.confirm({
      title : title,
      content : content,
      type : 'red',
      icon: 'fas fa-warning',
      buttons : {
        Yes : function(){

          /*Display loader modal*/
          $('#pleaseWaitDialog').modal('show');

          /*Call back function to run at server's response*/
          var callback = function(data){
            console.log(data);
            if(data==150 || data=="150")
              window.location="{{url('150')}}";
            
            else{
              if(data.status==1){
                if(redirect && hide){
                  $(hide).hide(1000);
                  window.location = redirect;
                }
                else if(redirect)
                  window.location = redirect;

                else if(hide)
                  $(hide).hide(1000);

                else
                  $.alert('Delete done successfully!');
                  

                }

              else
                alert(data.message);
            }

            $('#pleaseWaitDialog').modal('hide');
            
          };


          /*Check request method*/
          if(method == 'delete'){
            $.post({
              type : method,
              url : url
            }).done(function(data){
              callback(data);
            });
          }

          else
            $.post(url,{id:id}).done(function(data){
                callback(data);
            });
            
          
        },

        No : function(){}

      }
    });
    
  }




  /*Dialog box for ajax pop up processing*/
  function dialog(url,title='Operation',size='m',type=''){
    
     $.dialog({
              content: function () {
                  var self = this;
                  return $.ajax({
                      url: url,
                      method: 'get',
                  }).done(function (data) {
                      self.setContent(data);
                      self.setTitle(title);
                  }).fail(function(){
                      self.setContent('Something went wrong');
                  });
              },
              columnClass: size,
              type:type
          });
 
  }
