<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }}</title>

        <!-- Fonts -->
        <!-- <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css"> -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        <link href="{{ asset('css/special.css') }}" rel="stylesheet">
      <link href="{{ asset('fa/css/font-awesome.css') }}" rel="stylesheet">
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }


            .bold{
              font-weight: bold !important;
              
            }

            .blue{
              color: blue !important;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
      <?php 
            $student = App\Student::find($student_id); 
            $total = 0;
        ?>
        <div class="flex-center position-ref">
            

            <div class="content">
                
              <table class="table table-bordered">

                <thead style="display: none;">
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  <th></th>
                  
                </thead>
                <tbody>

                  <tr class="">
                    <td class="no-space text-center" colspan="2" valign="bottom"><img style="width: 100px;" src="{{ asset('storage/images/logo.png') }}"></td>


                    <td class="no-space" colspan="7 text-center">
                        
                        <h2 class="bold blue no-space">CSMT STAFF SECONDARY SCHOOL</h2>
                        <h5 class="no-space bold">Along Watchman Street, P.M.B. 147, Abakaliki, Ebonyi State, Nigeria</h5>

                        <h5 class="no-space bold">Email: csmtschools@gmail.com Tel: 08032124870, 07060725882</h5>

                        <h3 class="bold blue no-space">CUMMULATIVE REPORT SHEET</h3>
                        <h4 class="bold blue no-space">{{App\Session::find($session_id)->name}}</h4>



                    </td>
                  </tr>

                  <tr>
                    <td colspan="3">STUDENT'S ID: <span class="bold blue">{{$student->admission_no}}</span></td>
                    <td colspan="3">STUDENT'S NAME: <span class="bold blue">{{$student->surname.' '.$student->othernames}}</span></td>
                    <td colspan="3">CLASS: <span class="bold blue">{!! App\Aagc::name($aagc_id) !!}</span></td>
                  </tr>

                  <tr>
                    <td colspan="2">House: <span class="blue bold">{{$student->house->colour}}</span> </td>
                    <td colspan="2">Club: <span class="blue bold">{{$student->club->name}}</span> </td>


                    <td colspan="2">No in Class:  <span class="blue bold">{{App\Aagc::find($aagc_id)->students()->count()}}</span> </td>


                    <td colspan="3">Next Term Begins: <span class="blue bold">28-APR-2018</span></td>

                  </tr>

                  <tr>
                    <td colspan="9" class="bold" style="color:yellow; background: purple;">ACADEMIC REPORT (COGNITIVE DOMAIN)</td>
                  </tr>

                  <!-- Grade head -->
                    <tr>
                      <td></td>
                      
                      @if($cummulative == 2)
                        <td colspan="2"></td>
                        <td class="bold blue">1<sup>st</sup> Term</td>
                        <td class="bold blue">2<sup>nd</sup> Term</td>
                        <td class="bold blue">Total</td>
                        <td class="bold blue">Average</td>
                      @else
                        <td></td>
                        <td class="bold blue">1<sup>st</sup> Term</td>
                        <td class="bold blue">2<sup>nd</sup> Term</td>
                        <td class="bold blue">3<sup>rd</sup> Term</td>
                        <td class="bold blue">Total</td>
                        <td class="bold blue">Average</td>
                      @endif

                        <td class="bold blue">Grade</td>
                        <td class="bold blue">Remark</td>


                    </tr>




                    <tr>
                      <td class="bold blue">SN</td>
                      

                      @if($cummulative == 2)
                        <td colspan="2" class="bold blue">Subjects</td>
                        <td class="bold blue">100</td>
                        <td class="bold blue">100</td>
                        <td class="bold blue">200</td>

                      @else
                        <td class="bold blue">Subjects</td>
                        <td class="bold blue">100</td>
                        <td class="bold blue">100</td>
                        <td class="bold blue">100</td>
                        <td class="bold blue">300</td>
                      @endif

                    </tr>


                    @foreach($subjects as $x => $subject)

                      <tr>
                          <td>{{$x+1}}</td>
                          @if($cummulative == 2)
                            <td colspan="2" class="text-left  bold blue">{{$subject->name}}</td>
                          @else
                            <td class="text-left  bold blue">{{$subject->name}}</td>
                          @endif

                          <?php 
                                $scores = App\Assessment::cummulativeStudentScore($student_id,$subject->id,$aagc_id,$session_id,$cummulative);

                                $sum=0; 
                          ?>

                          <!-- Printing cummulative scores -->

                          @foreach($scores as $score)

                           
                              <td>{{$score->score}}</td>

                              <!-- Calculate score sum -->
                            <?php $sum+=$score->score ?>


                          @endforeach


                          <!-- Calculate grade point -->
                          <?php $gp = round($sum / $cummulative,2) ?>

                            <td>{{$sum}}</td>
                            <td>{{ $gp }}</td>
                            <td>{{ App\Assessment :: grade($gp) }}</td>
                            <td>{{ App\Assessment :: remark($gp) }}</td>

                      </tr>

                        <!-- Calculate score sum total and increment SN -->
                        <?php $total +=$sum;?>

                    @endforeach




                    <tr>
                      <td colspan="9" class="blue">
                      GRADE DETAILS: <strong>A+</strong> = 90-100% , A = 80-89% , B+ = 70-79% , B = 60-69% , C = 50-59% , D = 40-49% , F = 0-39%

                    </td>
                    </tr>

                    <tr>
                      <td colspan="2">Total: <span class="blue">{{$total}}</span></td>
                      <td colspan="3">Student's Average: </td>
                      <td colspan="2">Position in Class: </td>
                      <td colspan="2">Result: </td>
                    </tr>


                    <tr>

                      <td colspan="5" class="no-space">
                        <p class="no-margin padding-5" style="background: purple; color: yellow;">CHARACTER REPORT(AFFECTIVE DOMAIN)</p>
                        <table class="table no-space">
                           
                          <tbody>
                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>


                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>


                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>


                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>





                          </tbody>
                        </table>
                      </td>




                      <td colspan="5" class="no-space">
                        <p class="no-margin padding-5" style="background: purple; color: yellow;">CHARACTER REPORT(AFFECTIVE DOMAIN)</p>
                        <table class="table no-space">
                           
                          <tbody>
                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>


                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>


                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>


                            <tr>
                              <td>Punctuality</td>

                              <td>
                                Classroom: - <br>
                                Resumption:  -
                              </td>
                            </tr>





                          </tbody>
                        </table>
                      </td>




                    </tr>


                </tbody>

              </table>




            </div>
        </div>
    </body>
</html>
