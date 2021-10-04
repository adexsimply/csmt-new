
          <!--------------------
          START - Top Bar
          -------------------->
          <div class="top-bar color-scheme-transparent">
            <!--------------------
            START - Top Menu Controls
            -------------------->
            <div class="top-menu-controls">
              

            
              <!--------------------
              START - Settings Link in secondary top menu
              -------------------->
              <div class="top-icon top-settings os-dropdown-trigger os-dropdown-position-left">
                <i class="os-icon os-icon-ui-46"></i>
                <div class="os-dropdown">
                  <div class="icon-w">
                    <i class="os-icon os-icon-ui-46"></i>
                  </div>
                  <ul>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('manage user')): ?>
                      <li>
                        <a href="<?php echo e(url('users')); ?>"><i class="os-icon os-icon-ui-49"></i><span>Users</span></a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('roles')); ?>"><i class="os-icon os-icon-grid-10"></i><span>Roles</span></a>
                      </li>
                      <li>
                        <a href="<?php echo e(url('permissions')); ?>"><i class="os-icon os-icon-ui-44"></i><span>Permissions</span></a>
                      </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('online upload')): ?>
                      <li>
                        <a id="systemBackup" data-progressUrl="<?php echo e(url('backup/progress')); ?>" href="<?php echo e(url('backup')); ?>">
                            <i class="fas fa-cloud"></i><span>Online upload</span>
                        </a>
                      </li>
                    <?php endif; ?>

                    <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('local backup')): ?>
                      <li>
                        <a id="systemLocalBackup" href="<?php echo e(url('backup/local')); ?>">

                          <i class="fas fa-download"></i><span>Local backup</span>

                        </a>
                      </li>
                    <?php endif; ?>


                    <li>

                    <a href="<?php echo e(route('logout')); ?>" onclick="event.preventDefault(); document.getElementById('logout-form').submit();"> <i class="os-icon os-icon-signs-11"></i><span>Logout</span> </a>

                    <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" style="display: none">
                          <?php echo e(csrf_field()); ?>

                    </form>


                    </li>
                  </ul>
                </div>
              </div>
              <!--------------------
              END - Settings Link in secondary top menu
              -------------------->
            </div>
            <!--------------------
            END - Top Menu Controls
            -------------------->
          </div>