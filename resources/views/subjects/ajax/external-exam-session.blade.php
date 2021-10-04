
@if(count($sessions) > 0)
<div class="row mb-xl-2 mb-xxl-3">
      
      @foreach($sessions as $session)
        <div class="col-sm-4">
            <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="{{url($exam.'/'.$session->id)}}">
                <div class="label dashboard-icons">
                  <div class="os-icon os-icon-tasks-checked"></div>
                </div>
                <div class="value dashboard-title">
                    {{$session->name}}
                </div>
            </a>
        </div>
      @endforeach

</div>

@else

  <div class="text-center">
        <h3>No result found</h3>
  </div>
  
@endif