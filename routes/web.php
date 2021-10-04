<?php
if(version_compare(PHP_VERSION, '7.2.0', '>=')) {
    error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
}
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::view('/','auth.login');
Route::view('test','test');
Route::view('backup','backup');
Route::view('backup/progress','backup-progress');
Route::view('backup/local','local-backup');
Route::view('401','401');

// Route::prefix('progress')->group(function(){
// 	Route::get('backup','ProgressController@backup');
// });

Auth::routes();

// Route::middleware(['auth','permission_clearance'])->group(function(){
Route::middleware(['auth'])->group(function(){
	Route::get('/home', 'HomeController@index')->name('home');
	Route::resource('roles', 'RoleController');
	Route::resource('posts', 'PostController');
	Route::resource('users', 'UserController')->middleware('user');
	Route::resource('permissions','PermissionController');	



	/*Backup and restore*/

	// Route::get('backup','BackupController@index');
	// Route::get('/home', 'HomeController@index');

	Route::view('extra','extra.index');
	Route::get('extra/club-students/{id}','ClubController@index');
	Route::get('extra/create-club-report/{club_id}/{session_id}/{term_id}','ClubController@createClubReport');
	Route::get('extra/house-students/{id}','HouseController@index');


	Route::post('extra/store-club-report','ClubController@storeClubReport');
	Route::post('extra/update-many-club-report','ClubController@updateManyClubReport');

	Route::prefix('next-term-begins')->group(function(){
		Route::post('store','NextTermBeginController@store');
		Route::post('delete','NextTermBeginController@destroy');
	});

	/*Testimonials*/
	Route::prefix('testimonials')->group(function(){
		Route::view('/','testimonials.index');
		Route::get('create','TestimonialController@create');
		Route::get('show','TestimonialController@show');
		Route::get('edit/{id}','TestimonialController@edit');
		Route::get('print/{id}','TestimonialController@print');
		Route::get('student/{session_id}','TestimonialController@fetchStudents');

		Route::post('store','TestimonialController@store');
		Route::post('update','TestimonialController@update');
		Route::post('delete','TestimonialController@destroy');
	});



	/*Old Testimonials*/
	Route::prefix('old-testimonials')->group(function(){
		Route::get('create','OldTestimonialController@create');
		Route::get('show','OldTestimonialController@show');
		Route::get('edit/{id}','OldTestimonialController@edit');
		Route::get('print/{id}','OldTestimonialController@print');
		Route::get('student/{session_id}','OldTestimonialController@fetchStudents');

		Route::post('store','OldTestimonialController@store');
		Route::post('update','OldTestimonialController@update');
		Route::post('delete','OldTestimonialController@destroy');
	});


	/*Class punctuality*/
	Route::prefix('punctuality/classroom')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','PunctualityClassroomController@create');

		Route::get('show/{aagc_id}/{session_id}/{category_id}/{term_id}/{date}','PunctualityClassroomController@show');

		Route::post('store','PunctualityClassroomController@store');
		Route::post('update','PunctualityClassroomController@update');
	});


	
	/*Resumption punctuality*/
	Route::prefix('punctuality/resumption')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','PunctualityResumptionController@create');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{date}','PunctualityResumptionController@show');

		Route::post('store','PunctualityResumptionController@store');
		Route::post('update','PunctualityResumptionController@update');
	});

	

	/*Classroom assignment*/
	Route::prefix('assignment/subject')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','AssignmentSubjectController@create');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{subject_id}/{date}','AssignmentSubjectController@show');

		Route::post('store','AssignmentSubjectController@store');
		Route::post('update','AssignmentSubjectController@update');
	});
	

	/*psychomotor domain*/
	Route::prefix('psychomotor')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','PsychomotorController@create');
		Route::get('create2/{aagc_id}/{session_id}/{term_id}/{category_id}','PsychomotorController@create2');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{subject_id}/{date}','PsychomotorController@show');

		Route::post('store','PsychomotorController@store');
		Route::post('update','PsychomotorController@update');
	});



	/*Hostel assignment*/
	Route::prefix('assignment/hostel')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','AssignmentHostelController@create');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{date}','AssignmentHostelController@show');

		Route::post('store','AssignmentHostelController@store');
		Route::post('update','AssignmentHostelController@update');
	});



	/*Neatness domain url */
	Route::prefix('neatness')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','NeatnessController@create');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{date}','NeatnessController@show');

		Route::post('store','NeatnessController@store');
		Route::post('update','NeatnessController@update');
	});


	/*Clinic domain url */
	Route::prefix('clinic')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','ClinicController@create');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{date}','ClinicController@show');

		Route::post('store','ClinicController@store');
		Route::post('update','ClinicController@update');
	});




	/*Exeat domain url */
	Route::prefix('exeat')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','ExeatController@create');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{date}','ExeatController@show');

		Route::post('store','ExeatController@store');
		Route::post('update','ExeatController@update');
	});
	


	/*Classroom attendance*/
	Route::prefix('attendance')->group(function(){
		Route::get('create/{aagc_id}/{session_id}/{term_id}/{category_id}','AttendanceController@create');

		Route::get('show/{aagc_id}/{session_id}/{term_id}/{category_id}/{date}','AttendanceController@show');

		Route::post('store','AttendanceController@store');
		Route::post('update','AttendanceController@update');
	});


	/*Subject URIs*/
	Route::middleware('subject')->prefix('subjects')->group(function(){
		Route::get('/','SubjectController@index');
		Route::post('store','SubjectController@store');
		Route::get('edit/{id}','SubjectController@edit');
		Route::post('update','SubjectController@update');
		Route::post('destroy','SubjectController@destroy');


	/*Subject category URIs*/
		Route::get('category/create/{subject_school_id}','SubjectCategoryController@create');
		Route::post('category/store','SubjectCategoryController@store');
		Route::get('category/edit/{id}','SubjectCategoryController@edit');
		Route::post('category/update','SubjectCategoryController@update');
		Route::post('category/destroy','SubjectCategoryController@destroy');
		Route::get('category/addup/{id}/{subject_school_id}','SubjectCategoryController@addupCreate')->where(['id','[0-9]+'],['subject_school_id','[0-9]+']);
		Route::post('category/addup/store','SubjectCategoryController@addupStore');
	});



	/*Bece URIs*/
	Route::prefix('bece')->group(function(){
		Route::get('sessions','BeceController@session');
		Route::get('/{session_id}','BeceController@index')->where(['session_id','[0-9]+']);
		Route::get('show/{student_id}','BeceController@show');
		Route::get('edit/{student_id}/{session_id}','BeceController@edit');
		Route::post('update','BeceController@update');
	});


/*Junior mock URIs*/
	Route::prefix('junior-mock')->group(function(){
		Route::get('sessions','JuniorMockController@session');
		Route::get('/{session_id}','JuniorMockController@index')->where(['session_id','[0-9]+']);
		Route::get('show/{student_id}','JuniorMockController@show');
		Route::get('edit/{student_id}/{session_id}','JuniorMockController@edit');
		Route::post('update','JuniorMockController@update');
	});




/*Senior mock URIs*/
	Route::prefix('senior-mock')->group(function(){
		Route::get('sessions','SeniorMockController@session');
		Route::get('/{session_id}','SeniorMockController@index')->where(['session_id','[0-9]+']);
		Route::get('show/{student_id}','SeniorMockController@show');
		Route::get('edit/{student_id}/{session_id}','SeniorMockController@edit');
		Route::post('update','SeniorMockController@update');
	});



	/*Neco URIs*/
	Route::prefix('neco')->group(function(){
		Route::get('sessions','NecoController@session');
		Route::get('/{session_id}','NecoController@index')->where(['session_id','[0-9]+']);
		Route::get('show/{student_id}','NecoController@show');
		Route::get('edit/{student_id}/{session_id}','NecoController@edit');
		Route::post('update','NecoController@update');
	});



	/*Waec URIs*/
	Route::prefix('waec')->group(function(){
		Route::get('sessions','WaecController@session');
		Route::get('/{session_id}','WaecController@index')->where(['session_id','[0-9]+']);
		Route::get('show/{student_id}','WaecController@show');
		Route::get('edit/{student_id}/{session_id}','WaecController@edit');
		Route::post('update','WaecController@update');
	});



	/*Session URIs*/
	Route::middleware('session')->prefix('sessions')->group(function(){
		Route::get('/','SessionController@index');
		Route::post('store','SessionController@store');
		Route::get('edit/{id}','SessionController@edit')->where(['id','[0-9]+']);
		Route::post('update','SessionController@update');
		Route::post('activate','SessionController@activate');
		Route::any('destroy/{id}','SessionController@destroy');
	});



	/*Class URIs*/
	Route::middleware('classes')->prefix('classes')->group(function(){
		Route::get('/{group_id?}','GroupClassController@index')->where(['group_id','[0-9]+']);

		/*Collect session list for inclusion to class */
		Route::get('aagc/session-list/{aagc_id}','AagcController@sessionList');

		/*Collect class arm student to add commment*/
		Route::get('aagc/comment/{aagc_id}/{category_id}/{session_id}','AagcController@commentSessionStudentList');

		/*Student promotion*/ 
		Route::get('aagc/promotion/{aagc_id}/{session_id}/{term_id}','AagcController@createPromotion');

		Route::get('aagc/{group_id}/{id}/{name?}','AagcController@index')->where(['id','[0-9]+'],['group_id','[0-9]+']);

		Route::get('aagc/session-details/{group_id}/{group_class_id}/{aagc_id}/{category_id}/{session_id}','AagcController@sessionDetails');

		Route::get('aagc/subject-student/getnew/{aagc_id}/{category_id}/{session_id}/{subject_id}','AagcController@getStudentToSubject');
		Route::get('aagc/subject-student/view/{aagc_id}/{category_id}/{session_id}/{subject_id}','AagcController@viewSubjectStudent');

		Route::post('aagc/subject-setup','AagcController@subjectSetup');
		Route::post('aagc/comment','AagcController@commentOnStudent');
		Route::post('aagc/subject-student-addup','AagcController@studentAddup');
		Route::post('aagc/subject-student/destroy','AagcController@removeStudentFromSubject');

		Route::post('aagc/subject-student','AagcController@addStudentToSubject');
		Route::post('aagc/store','AagcController@store');
		Route::post('aagc/store-single-session','AagcController@addSingleSessionToClass');
		Route::post('aagc/promotion','AagcController@promotion');
		Route::post('aagc/subject/destroy','AagcController@deleteSubject');
		Route::post('aagc/subjects/addnew','AagcController@newSingleSubject');

	});





	Route::middleware('student')->prefix('students')->group(function(){
		Route::get('admission-graph','StudentController@admissionGraph');
		Route::get('class-student-graph','StudentController@classStudentGraph');
		Route::get('filter','StudentController@filter');
		Route::get('birthday','StudentController@birthday');
		Route::get('full-registration','StudentController@createFull');
		Route::get('new-jss-3','StudentController@createJss3');
		Route::get('new-sss-3','StudentController@createSss3');
		Route::get('show/{student_id}','StudentController@show');
		Route::get('performance/{student_id}','StudentController@performance');
		Route::get('edit/{student_id}','StudentController@edit');
		Route::get('switch/{student_id}','StudentController@switch');
		Route::get('edit2/{student_id}','StudentController@edit2');
		Route::get('new-remark/{student_id}','StudentController@newRemark');
		Route::get('edit_parent/{parent_id}/{student_id}','StudentController@edit_parent');
		Route::get('/{status?}/{category_id?}','StudentController@index');
		Route::post('status','StudentController@status');
		Route::get('create/{aagc_id}/{session_id}','StudentController@create');
		Route::post('store','StudentController@store');
		Route::post('store-switch','StudentController@storeSwitch');
		Route::post('store-remark','StudentController@storeRemark');
		Route::post('store/graduate','StudentController@storeGraduate');
		Route::post('update','StudentController@update');
		Route::post('destroy','StudentController@destroy');

	});




	Route::middleware('assessment')->prefix('assessments')->group(function(){

		Route::get('class-assessment-printer','AssessmentController@classAssessment');
		Route::get('subject-analysis','AssessmentController@subjectAnalysis');
		Route::get('class-assessment-pdf','AssessmentController@classAssessmentPdf');
		Route::get('class-master-sheet-printer','AssessmentController@classMasterSheet');
		Route::get('class-result-standing-printer','AssessmentController@classResultStanding');

		
		Route::get('printer','AssessmentController@printer');
		Route::get('printer-continuous','AssessmentController@printerFine');
		Route::get('edit/{id}','AssessmentController@edit');
		Route::get('show/{subject_id}','AssessmentController@subjectResult');

		Route::get('cummulative/{aagc_id}/{session_id}','AssessmentController@cummulative');

		Route::get('show/{aagc_id}/{session_id}/{subject_id}','AssessmentController@show');

		Route::get('class-assessment-printer/{aagc_id}/{category_id}/{session_id}/{term_id}','AssessmentController@classAssessment');
		Route::get('class-assessment-pdf/{aagc_id}/{category_id}/{session_id}/{term_id}','AssessmentController@classAssessmentPdf');

		Route::get('class-master-sheet-printer/{aagc_id}/{category_id}/{session_id}/{term_id}','AssessmentController@classMasterSheet');

		Route::get('class-result-standing-printer/{aagc_id}/{category_id}/{session_id}/{term_id}','AssessmentController@classResultStanding');

		Route::get('create/{aagc_id}/{category_id}/{session_id}/{subject_id}/{term_id}','AssessmentController@create');
		Route::get('create_practical/{aagc_id}/{category_id}/{session_id}/{subject_id}/{term_id}','AssessmentController@createPractical');

		Route::get('printer/{subject_id}/{aagc_id}/{category_id}/{session_id?}/{term_id?}','AssessmentController@printer');
		Route::get('subject-analysis/{subject_id}/{aagc_id}/{category_id}/{session_id?}/{term_id?}','AssessmentController@subjectAnalysis');

		Route::get('printer-continuous/{subject_id}/{aagc_id}/{category_id}/{session_id?}/{term_id?}','AssessmentController@printerFine');
		
		Route::get('print-term-statement/{student_id}/{aagc_id}/{session_id}/{position}/{group_class_id}/{term_id}','AssessmentController@printTermStatement');

		Route::get('print-cummulative-statement/{student_id}/{aagc_id}/{session_id}/{cummulative}','AssessmentController@printCummulativeStatement');



		Route::post('store','AssessmentController@store');
		Route::post('store-practical','AssessmentController@storePractical');
		Route::post('update-many','AssessmentController@updateMany');
		Route::post('update-many-practical','AssessmentController@updateManyPractical');
		Route::post('update','AssessmentController@update');
		Route::post('destroy','AssessmentController@destroy');
	});




	Route::middleware('sms')->prefix('sms')->group(function(){
		Route::view('/','sms.index');
		Route::view('/send-pin','sms.ajax.send');
		Route::view('/create-pin','sms.ajax.create-pin');
		Route::get('/pins','SmsController@pin');
		Route::post('/send-to-parent','SmsController@sendMessageToParent');
		Route::post('/send-to-others','SmsController@sendMessageToOthers');
		Route::post('/generate-pin','SmsController@generatePin');
		Route::post('/send-pin','SmsController@sendPinToParent');
	});



});





Route::prefix('select')->group(function(){
	Route::get('groups','SelectController@groups');
	Route::get('sessions','SelectController@sessions');
	Route::get('arms','SelectController@arms');
	Route::get('aliases','SelectController@aliases');
	Route::get('full-arms/{group_class_id}','SelectController@fullArms');
	Route::get('assessment_types','SelectController@assessment_types');
	Route::get('classes','SelectController@classes');
	Route::get('subjects/{sql?}','SelectController@subjects');
	Route::get('clubs','SelectController@clubs');
	Route::get('grades','SelectController@grades');
	Route::get('houses','SelectController@houses');
	Route::get('lgas','SelectController@lgas');
	Route::get('states','SelectController@states');
	Route::get('session_term','SelectController@session_term');
	Route::get('student_abilities','SelectController@student_abilities');
	Route::get('student_categories','SelectController@student_categories');
	Route::get('student_posts','SelectController@student_posts');
	Route::get('subject_schools','SelectController@subject_schools');
	Route::get('subject_categories','SelectController@subject_categories');
	Route::get('terms','SelectController@terms');
});
////Parents
	Route::get('/parents', 'ParentController@index');
	Route::get('parents/full-registration','ParentController@createFull');
	Route::post('parents/store','ParentController@store');
	Route::get('parents/edit/{parent_id}','ParentController@edit');
	Route::post('parents/destroy','ParentController@destroy');
	Route::post('parents/update','ParentController@update');
	/////////////
//Standalone Links
	Route::get('/send/email', 'HomeController@mail');

	Route::get('/clinic', 'ClinicController@index')->name('Clinic Mark');
	Route::get('/clinic/edit/{student_id}','ClinicController@edit');
	Route::post('/clinic/update','ClinicController@update1');
	Route::get('/clinic/show/{student_id}','ClinicController@show1');
	/////////////
	//////////?Comments
	Route::get('comments/create/{aagc_id}/{category_id}/{session_id}/{term_id}','CommentController@create');
	Route::get('comments/create-club/{club_id}/{session_id}/{term_id}','CommentController@createClub');
	Route::post('comments/store','CommentController@store');
	Route::post('comments/store-club','CommentController@storeClub');
	Route::post('comments/update-many','CommentController@updateMany');
	Route::post('comments/update-many-club','CommentController@updateManyClub');

	///////Email


		Route::view('email','email.index');
		Route::post('email/send-pin','EmailController@sendPinToParent');
		Route::post('email/send-to-parent','EmailController@sendMessageToParent');
		Route::get('email/demo','EmailController@mail');



