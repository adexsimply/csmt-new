@extends('layouts.app')

@section('title','Parents')
@section('content')

	<ul class="breadcrumb">
      <li class="breadcrumb-item">
        <a href="{{url('home')}}">Dashboard</a>
      </li>
      <li class="breadcrumb-item">
        <span>Parents</span>
      </li>
      </ul>
      <!-- 
      END - Breadcrumbs
      -->
      <div class="content-i">
      <div class="content-box">
        <div class="element-wrapper">
          <div class="element-box">
            <div class="element-header">

              <h3>
              	Parents
              </h3>


             <!-- Page menu -->
              <div style="z-index: 999; margin-top: -25px;" class="pull-right os-dropdown-trigger os-dropdown-position-left">
                <i class="fas fa-ellipsis-h fa-2x"></i>
                <div class="os-dropdown bg-primary">
                  <ul>
                    <li>
                      <a onclick="oisNew(event)" data-type="purple" data-size="xl" data-title="Register new parent" href="{{url('parents/full-registration')}}"><i class="fas fa-user-plus"></i> Add New parent</a>
                    </li>
                  </ul>
                </div>
              </div>


            </div>

              @if(count($parents) > 0 )
              <div class="table-responsive">
              <table class="table table-striped table-bordered dataTable" style="width:100%">
                <thead class="text-primary">
              <tr>
                <th class="text-center"><i class="fas fa-level-down"></i> S/N</th>
                <th><i class="fas fa-user-circle"></i> Name</th>
                <th><i class="fas fa-user-tie"></i> Parent's phone</th>
                <th><i class="fas fa-user-tie"></i> Parent's phone2</th>
                <th><i class="fas fa-user-tie"></i> Email</th>
                <th><i class="fas fa-user-tie"></i> Address</th>
                <th><i class="fas fa-plug"></i> Actions</th>
              </tr>
                </thead>
                <tbody>

              @foreach($parents as $x => $parent)



              <tr id="parent{{$parent->id}}">
                <td class="text-center">{{$x+1}}</td>

                <td><a data-type="purple" data-title="{{$parent->name}} details" data-size="l" onclick="oisRead(event)" href="{{url('parents/show/'.$parent->id)}}">{{$parent->name}}</a></td>

                <td>{{$parent->phone1}}</td>
                <td>{{$parent->phone2}}</td>
                <td>{{$parent->email}}</td>
                <td>{{$parent->address}}</td>
                <td class="text-center">

                  <a data-type="purple" data-title="Update {{$parent->name}} details" data-size="xl" onclick="oisEdit(event)" href="{{url('parents/edit/'.$parent->id)}}" title="Edit parent"><i class="fas fa-edit"></i></a> &nbsp;
                  
                    <a data-hide="#parent{{$parent->id}}" data-title="Delete {{$parent->name}}" data-content="All information about {{$parent->name}} would be permanently deleted and can never be recovered, proceed to delete ?" onclick="oisDelete(event)" class="text-danger" data-spin="yes" data-id="{{$parent->id}}" href="{{url('parents/destroy')}}" title="Delete">
                      <i class="fas fa-trash"></i>
                    </a>
                </td>
              </tr>
              @endforeach
              
              
                </tbody>
                
              </table>

              
              </div> 

              

              @else 
              <div class="text-center">
                <h3>No parent found</h3>
                <a onclick="oisNew(event)" data-type="purple" data-size="xl" data-title="Register new parent" class="btn full-registration btn-outline-primary" href="{{url('parents/full-registration')}}">Register New parent</a>
              </div>
              @endif
              

            
          </div>
      </div>
        

        
      </div>
      </div>

@endsection


@section('modal')
  <!-- Create new subject modal -->
  <div class="modal fade" id="filterparent">
    <div class="modal-dialog modal-md ">
      <div class="modal-content">

        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-name">Filter parent</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
          <form method="get" action="{{url('parents/filter')}}">
              
             <div class="form-group">
               <select name="group_class_id" class="form-control classOptions"></select>
             </div>

             
             <div class="form-group">
               <select class="form-control fullArmOptions" name="aagc_id"></select>
             </div>
             
             <div class="form-group">
               <select class="form-control" name="category_id">
                 <option value="1">Boarding</option>
                 <option value="2">Day</option>
               </select>
             </div>
             
             <div class="form-group">
               <select class="form-control sessionOptions" name="session_id"></select>
             </div>
             
             <div class="form-group">
               <select class="form-control clubOptions" name="club_id"></select>
             </div>

             <div class="form-group">
               <button class="btn btn-primary" type="submit"><i class="fas fa-eye"></i> View parents</button>

               
             </div>

                  


                  </form>
        </div>

      </div>
    </div>
  </div>
@endsection


@section('script')
	<script type="text/javascript">
		$(document).ready(function(){

      // $("#parentTable").DataTable();
      
      if(hash = location.hash){
       
        $(hash).trigger('click');
       
      }


      $(".filterparent").click(function(e){
        e.preventDefault();
        sessionOptions();
        classOptions();
        clubOptions();


        $(".classOptions").change(function(){
          var group_class_id = $(this).val();
          fullArmOptions(group_class_id);
        });
  

        $("#filterparent").modal('show');
      });


		});
	</script>
@endsection