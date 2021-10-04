<?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('view report')): ?>
<div id="accordion">


    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('add report')): ?>
  <!-- Add new assessment -->
  <div class="card rounded-0 no-border bottom-50">
   <div class="card-header transparent clearfix">
     <a class="card-link" data-toggle="collapse" href="#newassessment">
       <h6>
         <i class="os-icon text-primary os-icon-ui-23"></i> 
         Add assessments
       </h6>
     </a>
   </div>


   <hr class="no-space">

   <div id="newassessment" class="collapse show" data-parent="#accordion">
     <div class="card-body">

      <form action="<?php echo e(url('assessments/create')); ?>/" method="get" id="uploadAssessment">
           <div class="row">
          
             <div class="col-md-2">
               <label for="">Class</label>
               <select required="" class="form-control classOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Class Arm</label>
               <select required id="aagc_id" class="form-control fullArmOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Category</label>
               <select required name="category_id" id="category_id" class="form-control">
                 <option value="1">Boarding</option>
                 <option value="2">Day</option>
               </select>
             </div>

             <div class="col-md-2">
               <label for="">Subject</label>
               <select required id="subject_id" required="" class="form-control subjectOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Session</label>
               <select required id="session_id" required="" class="form-control sessionOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Term</label>
               <select required id="term_id" required="" class="form-control termOptions"></select>
             </div>

           </div>

          
               <br>
               <button class="btn btn-primary" type="submit"><i class="fa fa-pie-chart"></i> Grade students</button>
           

         </form>     
      </div>
    </div>
  </div>
  <?php endif; ?>

  <!-- View all assessments -->
  <div class="card rounded-0 no-border bottom-50">
   
   <div class="card-header transparent clearfix">
     <a class="card-link" data-toggle="collapse" href="#viewassessment">
       <h6>
         <i class="os-icon text-primary os-icon-ui-23"></i> 
         Continuous Assessment
       </h6>

     </a>
   </div>

   <hr class="no-space">

   <div id="viewassessment" class="collapse" data-parent="#accordion">
     <div class="card-body">
          

         <form method="get" action="<?php echo e(url('assessments/printer')); ?>">
           <div class="row">
          
             <div class="col-md-2">
               <label for="">Class</label>
               <select required class="form-control classOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Class Arm</label>
               <select required name="aagc_id" class="form-control fullArmOptions"></select>
             </div>

             <div class="col-md-2">
               <label for="">Category</label>
               <select required name="category_id" class="form-control">
                 <option value="1">Boarding</option>
                 <option value="2">Day</option>
               </select>
             </div>


             <div class="col-md-2">
               <label for="">Subject</label>
               <select required name="subject_id" required="" class="form-control subjectOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Session</label>
               <select required name="session_id" required="" class="form-control sessionOptions"></select>
             </div>

             <div class="col-md-2">
               <label for="">Term</label>
               <select required name="term_id" required="" class="form-control termOptions"></select>
             </div>

           </div>

          
               <br>
               <button class="btn btn-primary" type="submit">View assessments</button>
           

         </form>     

     </div>
   </div>
  </div>




  <!-- View all assessments -->
  <div class="card rounded-0 no-border bottom-50">
   
   <div class="card-header transparent clearfix">
     <a class="card-link" data-toggle="collapse" href="#viewClassassessment">
       <h6>
         <i class="os-icon text-primary os-icon-ui-23"></i> 
          Mastersheet
       </h6>
     </a>
   </div>

   <hr class="no-space">
   <div id="viewClassassessment" class="collapse" data-parent="#accordion">
     <div class="card-body">
          

         <form method="get" action="<?php echo e(url('assessments/class-assessment-printer')); ?>">
           <div class="row">
          
             <div class="col-md-3">
               <label for="">Class</label>
               <select required class="form-control classOptions"></select>
             </div>


             <div class="col-md-3">
               <label for="">Class Arm</label>
               <select required name="aagc_id" class="form-control fullArmOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Category</label>
               <select required name="category_id" class="form-control">
                 <option value="1">Boarding</option>
                 <option value="2">Day</option>
               </select>
             </div>


             <div class="col-md-2">
               <label for="">Session</label>
               <select required name="session_id" required="" class="form-control sessionOptions"></select>
             </div>

             <div class="col-md-2">
               <label for="">Term</label>
               <select required name="term_id" required="" class="form-control termOptions"></select>
             </div>

           </div>

          
               <br>
               <div class="btn-group">
                 <button class="btn btn-primary" type="submit"><i class="fa fa-print"></i> Print assessments</button>
               </div>
               
           

         </form>     

     </div>
   </div>
  </div>


  <!-- View Subject Analysis-->
  <div class="card rounded-0 no-border bottom-50">
   <div class="card-header transparent clearfix">
     <a class="card-link" data-toggle="collapse" href="#newassessment1">
       <h6>
         <i class="os-icon text-primary os-icon-ui-23"></i> 
         View Subject Analysis
       </h6>
     </a>
   </div>


   <hr class="no-space">

   <div id="newassessment1" class="collapse" data-parent="#accordion">
     <div class="card-body">

      <form method="get" action="<?php echo e(url('assessments/subject-analysis')); ?>">
          <div class="row">
          
             <div class="col-md-2">
               <label for="">Class</label>
               <select required class="form-control classOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Class Arm</label>
               <select required name="aagc_id" class="form-control fullArmOptions"></select>
             </div>

             <div class="col-md-2">
               <label for="">Category</label>
               <select required name="category_id" class="form-control">
                 <option value="1">Boarding</option>
                 <option value="2">Day</option>
               </select>
             </div>


             <div class="col-md-2">
               <label for="">Subject</label>
               <select required name="subject_id" required="" class="form-control subjectOptions"></select>
             </div>


             <div class="col-md-2">
               <label for="">Session</label>
               <select required name="session_id" required="" class="form-control sessionOptions"></select>
             </div>

             <div class="col-md-2">
               <label for="">Term</label>
               <select required name="term_id" required="" class="form-control termOptions"></select>
             </div>

           </div>

          
               <br>
               <button class="btn btn-primary" type="submit">View assessments</button>
           

         </form>    
      </div>
    </div>
  </div>




</div>
<?php endif; ?>