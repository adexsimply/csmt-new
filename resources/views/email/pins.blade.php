@extends('layouts.app')

@section('title','Student result pin')
@section('content')

          <!--
          END - Breadcrumbs
          -->
          <div class="content-i">
            <div class="content-box">
              <div class="element-wrapper compact pt-4">
                <div class="element-wrapper">
                  
                    <div class="element-header clearfix">
                      <h4>Bulk sms pin</h4>
                      
                      @include('components.sms-menu')
                    </div>

                    <div class="element-box">
                      @if($pins)
                      <table class="table table-padded dataTable">
                        <thead>
                          <th>SN</th>
                          <th>Student ID</th>
                          <th>Student name</th>
                          <th>Pin</th>
                          <th>Phone number</th>
                        </thead>
                        <tbody>
                          @foreach($pins as $x => $pin)
                            <tr>
                              <td>{{$x+1}}</td>
                              <td>{{$pin->admission_no}}</td>
                              <td>{{$pin->surname.' '.$pin->othernames}}</td>
                              <td>{{$pin->pin}}</td>
                              <td>{{$pin->phone}}</td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table> 
                      @else
                        <h1 class="text-danger text-center"><i class="fas fa-trash"></i> No pin found</h1>
                      @endif
                    </div>

                    
                </div>
              </div>
              

              
            </div>
          </div>

@endsection
