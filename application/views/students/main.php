<?php $this->load->view('includes/head'); ?>
<?php $this->load->view('includes/mobile'); ?>
<?php $this->load->view('includes/sidebar'); ?>
		<div class="content-w">
		   <!--------------------
		  START - Breadcrumbs
		  -------------------->
		  <ul class="breadcrumb">
			<li class="breadcrumb-item">
			  <a href="dashboard.html">Dashboard</a>
			</li>
			<li class="breadcrumb-item">
			  <span>Admission</span>
			</li>
			<li class="breadcrumb-item">
			  <span>Student Registration</span>
			</li>
		  </ul>
		  <!--------------------
		  END - Breadcrumbs
		  -------------------->
		  <div class="content-i">
			<div class="content-box">
				<div class="element-wrapper">
					
					<h3 class="element-header">
					  Student's Details
					</h3>

					<div class="element-box">
						<?php $this->load->view('students/add_student'); ?>
					  <div class="table-responsive">
						<table id="example" class="table table-striped table-bordered" style="width:100%">
							<thead>
								<tr>
									<th>S/N</th>
									<th>Student's ID</th>
									<th>Name</th>
									<th>Class</th>
									<th>Parent's Name</th>
									<th>Actions</th>
								</tr>
							</thead>
							<tbody>
								<?php 
                                     $i_student = 1;
                                     foreach ($student_lists as $student) { 
                                ?>
								<tr>
								  <td ><?php echo $i_student; ?></td>
								  <td><?php echo $student->student_id; ?></td>
								  <td><?php echo $student->surname." ".$student->other_names; ?></td>
								  <td><?php echo $student->level_name.$student->arm_name; ?></td>
								  <td><?php echo $student->parent_fullname; ?></td>
								  <td>
									<a class="text-danger" href="#" onclick="delete_student_name('<?php echo $student->id;?>')"><i class="os-icon os-icon-ui-15"></i></a>
									<a href="#" title="Delete" onclick="get_student_data('<?php echo $student->id; ?>')" data-target="#humanitiesModal" data-toggle="modal">
									  <i class="os-icon os-icon-ui-49"></i>
									</a>

								  </td>
								</tr>
                                 <?php $i_student++;
                                 } ?>
                                                  
							  
							</tbody>
							
						</table>
					  </div>
					  

					</div>
				</div>
			  

			  
			</div>
		  </div>
		</div>
<?php $this->load->view('includes/foot'); ?>
	<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
	<script src="https://cdn.datatables.net/1.10.16/js/dataTables.bootstrap4.min.js"></script>
	

	<script src="<?php echo base_url(); ?>assets/js/main.js?version=4.2.0"></script>
	<script>
	  $(document).ready(function() {
		  $('#example').DataTable();
	  } );
	</script>

	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');
	  
	  ga('create', 'UA-XXXXXXXX-9', 'auto');
	  ga('send', 'pageview');
	</script>	
<?php $this->load->view('students/student_script'); ?>