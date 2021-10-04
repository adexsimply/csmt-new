@extends('layouts.app')

@section('title','House students')
@section('content')

          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                  
                    <div class="element-header clearfix">
                      <h4>House students</h4>
                    </div>

                    <div class="element-box">
                      @if($students)
                      <table class="table table-striped table-bordered dataTable" style="width:100%">
                        <thead>
                          <th>ID</th>
                          <th>Student ID</th>
                          <th>Name</th>
                          <th>Gender</th>
                          <th>Class</th>
                        </thead>

                        <tbody>
                          @foreach($students as $x => $student)
                            <tr>
                              <td>{{$x+1}}</td>
                              <td>{{$student->admission_no}}</td>
                              <td>{{$student->surname.' '.$student->othernames}}</td>
                              <td>{{$student->gender}}</td>
                              <td>{{$student->current_class.''.$student->arm}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                      @else
                        <h1 class="text-danger"><i class="fas fa-trash"></i> No student found! </h1>
                      @endif
                    </div>

                    
                </div>
              </div>
              

              
            </div>
          </div>

@endsection
