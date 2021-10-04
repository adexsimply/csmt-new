<div class="element-box">

  <div class="os-tabs-w">
      <div class="os-tabs-controls">
        <ul class="nav nav-tab-sticky nav-tabs smaller">
          <li class="nav-item active">
            <a class="nav-link text-center active" data-toggle="tab" href="#basic"><i class="fas fa-user-circle"></i> <br/>Date(s) Present at Clinic</a>
          </li>
        </ul>
        
      </div>

      <div class="tab-content">
          
          <div class="tab-pane active" id="basic">
              <div class="tablo-with-chart">
                  <table class="table">
                      <tbody>
                          <?php $__currentLoopData = $attendances; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $attendance): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                          <tr><td><?php echo e($attendance->date); ?></td></tr>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        
                      </tbody>
                  </table>
              </div>
          </div>

      </div>

    </div>
  
</div>



<script type="text/javascript">
    
    $(document).ready(function(){
       /*Edit student details*/
      $(".edit").click(function(e){
          e.preventDefault();

          var url = $(this).attr('href');

          dialog(url,'Student Update','xl');

      });
    });

</script>

