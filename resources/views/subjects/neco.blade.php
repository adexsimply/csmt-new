@extends('layouts.app')

@section('content')

  <ul class="breadcrumb">
            <li class="breadcrumb-item">
              <a href="{{url('home')}}">Dashboard</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{url('subjects#external')}}">External exams</a>
              
            </li>
            <li class="breadcrumb-item">
              <span>{{$session->name}}</span>
            </li>
          </ul>
          


          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">

                    <div class="element-box">
                      
                      @if(count($students) > 0)

                        <div class="table-responsive">
                          <table id="table" class="table table-striped table-bordered table-hover table-condensed">
                            <thead>
                              <tr>
                                <th>SN</th>
                                <th>Students' ID</th>
                                <th>Students' Name</th>
                                <th>Examination No:</th>

                                <!-- Create subject columns -->
                                @foreach($subjects as $subject)
                                  <th>{{$subject->name}}</th>
                                @endforeach
                                <th>Actions</th>
                              </tr>
                            </thead>

                            <tbody>
                                
                                <!-- Collect student's details  -->
                                @foreach($students as $student)

                                  <?php 
                                      if(is_null($student->neco_details))
                                        $examination_no = '';

                                      else
                                        $examination_no = $student->neco_details->examination_no;
                                   ?>
                                  <tr>
                                      <td>{{$x}}</td>
                                      <td><a data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} details" data-size="l" onclick="oisRead(event)" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>
                                      <td>{{$student->surname.' '.$student->othernames}}</td>
                                      <td>{{$examination_no}}</td>


                                      <!-- Collect student's score -->
                                      @foreach($subjects as $subject)

                                          <?php
                                              $score = App\Neco::score($student->id, $subject->id);
                                              if($score)
                                                $score = $score->score;
                                              else
                                                $score = 0;
                                           ?>

                                        <td>{{$score}}</td>

                                      @endforeach 

                                        <td>
                                          <a class="viewNeco" target="_blank" href="{{url('neco/show/'.$student->id)}}"><i class="fa fa-print"></i></a>

                                          <a class="editNeco" href="{{url('neco/edit/'.$student->id.'/'.$session->id)}}"><i class="fa fa-edit"></i></a>
                                        </td>

                                  </tr>


                                  @php ($x++)
                                @endforeach

                            </tbody>

                          </table>
                        </div>





                      @else
                        <h1 class="text-danger text-center"><i class="fas fa-trash"></i> No student found</h1>
                      @endif

                    </div>

                </div>
              </div>
              

              
            </div>
          </div>
       

@endsection




@section('script')
  <script type="text/javascript">
    $(document).ready(function(){

      
      $('#table').DataTable({
      // "processing": true,
      // "ajax": 'server.php',
      "dom": 'lBfrtip',
      // "pageLength": 100,
      "bPaginate": false,
      // "responsive": true,
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
                ]
            }
        ]

    });

      $(".editNeco").click(function(e){
          e.preventDefault();
          url = $(this).attr('href');
          dialog(url,'Update Neco score','m');
      });
      
    });
  </script>
@endsection