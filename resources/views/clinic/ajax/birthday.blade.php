    @if(Addon::isEmpty($students))
      <style type="text/css">
        th{
          text-align: center;
        }

        
      </style>

            
            <div class="table-responsive">
            
            <table id="table" class="table">
                <thead class="text-primary">
                    <tr>
                      <th class="text-center"><i class="fas fa-arrow-down"></i> S/N</th>
                      <th><i class="fas fa-user"></i> Student's ID</th>
                      <th><i class="fas fa-user-circle"></i> Name</th>
                      <th><i class="fas fa-user-tie"></i> Parent's Name</th>
                      <th><i class="fas fa-phone"></i> Phone number</th>
                      <th><i class="fas fa-calendar"></i> Birthday</th>
                      <th><i class="fas fa-users"></i> Current class</th>
                    </tr>
                </thead>
                <tbody>
                   @foreach($students as $x => $student)
                      <tr>
                        <td class="text-center">{{$x+1}}</td>

                        <td><a data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} details" data-size="l" onclick="oisRead(event)" href="{{url('students/show/'.$student->id)}}">{{$student->admission_no}}</a></td>

                        <td><a data-type="purple" data-title="{{$student->surname.' '.$student->othernames}} details" data-size="l" onclick="oisRead(event)" href="{{url('students/show/'.$student->id)}}">{{$student->surname.' '.$student->othernames}}</a></td>

                        <td>{{$student->parent}}</td>
                        <td>{{$student->phone1.', '.$student->phone2}}</td>

                        <td><span class="badge badge-success">{{$student->dob}}</span></td>
                        <td>{{$student->current_class.' ('.$student->arm.')'}}</td>
                      </tr>
                   @endforeach                                            
                </tbody>
            </table>


            </div> 
            
          @else

            <h3 class="text-center text-danger"><i class="fas fa-trash"></i> No data found</h3>

          @endif

