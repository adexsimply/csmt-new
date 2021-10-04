<!-- Display class-->
                    <div class="element-box">

                      <?php if(Addon::isEmpty($groupClasses)): ?>

                        <!-- Start accordion -->
                        <div id="classGroupAccordion">

                          <!-- Collect classes as accordion header -->
                          <?php $__currentLoopData = $groupClasses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $x => $groupClass): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <?php $className = $groupClass->name ?>
                            <div class="card rounded-0 no-border bottom-50" id="job<?php echo e($x); ?>">

                               <div class="card-header transparent clearfix">
                                  <div class="pull-left">
                                      <a class="card-link" data-toggle="collapse" href="#classCollapse<?php echo e($x); ?>">
                                          <h5>
                                            <i class="os-icon text-primary os-icon-ui-23"></i> 
                                            <?php echo e($className); ?>

                                          </h5>
                                      </a>

                                  </div>
                              </div>
                              <hr class="no-space">

                              <!-- Class arms as accordion content -->
                              <div id="classCollapse<?php echo e($x); ?>" class="collapse <?php echo e($x == 0 ? 'show' : ''); ?>" data-parent="#classGroupAccordion">

                                <!-- Collect class arms -->
                                <div class="card-body">
                                  <?php 
                                    $arms = App\Group_class::armAlias($groupClass->id);
                                  ?>


                                  <?php if(Addon::isEmpty($arms)): ?>

                                    <div class="row">

                                      <?php $__currentLoopData = $arms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $arm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                                        <?php ($armName = $arm->arm.' ('.$arm->alias.')'); ?>
                                        <!-- Display class arm -->
                                        <div class="col-sm-4 mt-5 ">

                                          <!-- Drop down menu -->
                                          <!-- <div style="z-index: 1; margin-right: 10px; margin-top: 5px;" class="pull-right top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                                            <i class="fas fa-ellipsis-h"></i>
                                            <div class="os-dropdown bg-primary">
                                              <ul>
                                                <li>
                                                  <a href="#">
                                                    <i class="fas fa-eye fa-1x"></i><span> Peep <?php echo e($className.' '.$armName); ?></span>
                                                  </a>
                                                </li>
                                                <li>
                                                  <a href="#">
                                                    <i class="fas fa-edit"></i><span> Edit <?php echo e($className.' '.$armName); ?></span>
                                                  </a>
                                                </li>
                                                <li>
                                                  <a href="#">
                                                    <i class="fas fa-trash"></i><span> Delete <?php echo e($className.' '.$armName); ?> </span>
                                                  </a>
                                                </li>
                                              </ul>
                                            </div>
                                          </div> -->

                                            <!-- Class arm holder -->
                                            <a class="element-box el-tablo centered trend-in-corner padded bold-label" href="<?php echo e(url('classes/aagc/'.$groupClass->group_id.'/'.$arm->id.'/'.Addon::url($groupClass->name.'-'.$arm->arm.'-'.$arm->alias))); ?>">

                                              <div class="label dashboard-icons">
                                                <div class="fas fa-users"></div>
                                              </div>

                                              <div class="value dashboard-title">
                                                 <?php echo e($armName); ?>

                                              </div>
                                              
                                            </a>


                                          </div>

                                      <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                      <div class="col-sm-4 mt-5">
                                          <a class="newArm element-box el-tablo centered trend-in-corner padded bold-label" href="#" data-group_class_id="<?php echo e($groupClass->id); ?>">

                                            <div class="label dashboard-icons">
                                                <div class="fa fa-plus-circle"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              New <?php echo e($className); ?> arm
                                            </div>
                                              
                                          </a>
                                      </div>


                                    </div>

                                  <?php else: ?>
                                    <div class="row">
                                      <div class="col-sm-4 mt-5">
                                          <a class="newArm element-box el-tablo centered trend-in-corner padded bold-label" data-group_class_id="<?php echo e($groupClass->id); ?>" href="#">

                                            <div class="label dashboard-icons">
                                                <div class="fas fa-plus-circle"></div>
                                            </div>

                                            <div class="value dashboard-title">
                                              New <?php echo e($className); ?> arm
                                            </div>
                                              
                                          </a>
                                      </div>
                                    </div>
                                  <?php endif; ?> 

                                  <!-- <a href="#" data-group_class_id="<?php echo e($groupClass->id); ?>" class="newArm btn btn-success">Add <?php echo e($groupClass->name); ?> Arm</a> -->


                                </div>
                              </div>

                            </div>
                          <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                      <?php else: ?>
                        <h3>No class found, Please call the admin</h3>
                      <?php endif; ?>


                    </div>
