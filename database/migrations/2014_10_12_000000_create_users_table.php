<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('email')->unique();
            $table->string('password',100);
            $table->rememberToken();
            $table->timestamps();
        });


    Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });


    Schema::create('test', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('user_id')->unsigned();


            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });


    Schema::create('groups', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
        });


    Schema::create('group_classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->integer('group_id')->unsigned();

            $table->foreign('group_id')->references('id')->on('groups')->onDelete('cascade');
        });


      Schema::create('arms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
        });



      Schema::create('aliases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
        });


      /* Alias_Arm_Group_Class as shortened to AAGC */
      Schema::create('aagc', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('group_class_id')->unsigned();
            $table->integer('arm_id')->unsigned();
            $table->integer('alias_id')->unsigned();
            $table->timestamps();

            $table->foreign('group_class_id')->references('id')->on('group_classes')->onDelete('cascade');
            $table->foreign('alias_id')->references('id')->on('aliases')->onDelete('cascade');
            $table->foreign('arm_id')->references('id')->on('arms')->onDelete('cascade');
        });


      DB::statement('

            CREATE VIEW aagc_view AS 
            SELECT aagc.id, gc.name as class, CONCAT(a.name,"(",al.name,")") as arm 
            FROM aagc 
            JOIN group_classes gc ON gc.id = aagc.group_class_id 
            JOIN arms a ON a.id = aagc.arm_id 
            JOIN aliases al ON al.id = aagc.alias_id

        ');


      Schema::create('sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->timestamps();
        });


      Schema::create('aagc_session', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id')->unsigned();
            $table->integer('aagc_id')->unsigned();

            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('aagc_id')->references('id')->on('aagc')->onDelete('cascade');
        });



      Schema::create('terms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
        });


      Schema::create('session_term', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });



      Schema::create('clubs', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
            $table->timestamps();
        });


      Schema::create('parents', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',100);
            $table->string('address');
            $table->string('phone1',15);
            $table->string('phone2',15);
            $table->timestamps();
        });


      Schema::create('houses', function (Blueprint $table) {
            $table->increments('id');
            $table->string('colour',20);
            $table->timestamps();
        });



      Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',30);
        });



      Schema::create('lgas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->integer('state_id')->unsigned();


            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });



      Schema::create('student_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',10);
        });



      Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admission_no',20)->unique()->index();
            $table->string('surname',20);
            $table->string('othernames',40);
            $table->string('gender',10);
            $table->date('dob');
            $table->string('blood_group',3);
            $table->string('genotype',3);
            $table->string('health_challenges');
            $table->boolean('emergency_treatment');
            $table->boolean('immunization');
            $table->boolean('lab_test');
            $table->integer('admitted_session_id')->unsigned();
            $table->integer('graduated_session_id')->unsigned()->nullable();
            $table->integer('student_parent_id')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->integer('lga_id')->unsigned();
            $table->string('parent_relationship');
            $table->integer('club_id')->unsigned();
            $table->integer('house_id')->unsigned();
            $table->integer('student_category_id')->unsigned();
            $table->tinyInteger('status')->unsigned()->default(0);
            $table->timestamps();


            $table->foreign('admitted_session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('graduated_session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('student_parent_id')->references('id')->on('parents')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('lga_id')->references('id')->on('lgas')->onDelete('cascade');
            $table->foreign('club_id')->references('id')->on('clubs')->onDelete('cascade');
            $table->foreign('house_id')->references('id')->on('houses')->onDelete('cascade');
            $table->foreign('student_category_id')->references('id')->on('student_categories')->onDelete('cascade');
        });



      Schema::create('aagc_session_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aagc_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->string('principal_comment')->nullable();
            $table->string('teacher_comment')->nullable();
            $table->string('hostel_comment')->nullable();
            $table->boolean('promotion_status')->default(0);
            $table->timestamps();


            $table->foreign('aagc_id')->references('id')->on('aagc')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });


       Schema::create('student_spies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('aagc_id')->unsigned();
            $table->string('current_class',10);
            $table->string('arm',20);

            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('aagc_id')->references('id')->on('aagc')->onDelete('cascade');
        });


             Schema::create('subject_schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',20);
        });


      Schema::create('subject_categories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->integer('subject_school_id')->unsigned();
            $table->timestamps();

            
            $table->foreign('subject_school_id')->references('id')->on('subject_schools')->onDelete('cascade');
        });



      Schema::create('subjects', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',50);
            $table->integer('subject_school_id')->unsigned();
            $table->timestamps();

            $table->foreign('subject_school_id')->references('id')->on('subject_schools')->onDelete('cascade');
        });



       Schema::create('subject_subject_category', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_category_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('subject_school_id')->unsigned();


            $table->foreign('subject_school_id')->references('id')->on('subject_schools')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('subject_category_id')->references('id')->on('subject_categories');
        });



      Schema::create('aagc_subject', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('aagc_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->timestamps();


            $table->foreign('aagc_id')->references('id')->on('aagc')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });



      Schema::create('aagc_subject_student', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('subject_id')->unsigned();
            $table->integer('aagc_id')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->timestamps();


            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('aagc_id')->references('id')->on('aagc')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });



      Schema::create('grades', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name',2);
            $table->integer('lower_bound')->unsigned();
            $table->integer('upper_bound')->unsigned();
            $table->timestamps();
        });



      Schema::create('assessment_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('percentage');
            $table->timestamps();
        });



        Schema::create('assessments', function (Blueprint $table) {
            $table->increments('id');
            // $table->integer('assessment_type_id')->unsigned();
            $table->integer('test1')->unsigned();
            $table->integer('test3')->unsigned();
            $table->integer('test2')->unsigned();
            $table->integer('exam')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('aagc_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->timestamps();

            $table->foreign('aagc_id')->references('id')->on('aagc')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            // $table->foreign('assessment_type_id')->references('id')->on('assessment_types');
        });



        Schema::create('cummulative_assessements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('score')->unsigned();
            $table->integer('student_id')->unsigned();
            $table->integer('aagc_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->timestamps();

            $table->foreign('aagc_id')->references('id')->on('aagc')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });



      Schema::create('beces', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('score')->unsigned();
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });



      Schema::create('bece_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->string('examination_no',20)->unique();
            $table->string('remark');
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });



    Schema::create('junior_mocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('score')->unsigned();
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });



      
    Schema::create('senior_mocks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('score')->unsigned();
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });



      Schema::create('waecs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('score')->unsigned();
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });



      Schema::create('waec_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->string('examination_no',20)->unique();
            $table->string('remark');
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });


      

      Schema::create('necos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->integer('subject_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('score')->unsigned();
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
        });




      Schema::create('neco_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned();
            $table->string('examination_no',20)->unique();
            $table->string('remark');
            $table->timestamps();

            
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });





      Schema::create('testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('areas_good_at');
            $table->string('image');
            $table->string('session_admitted');
            $table->string('session_graduated');
            $table->string('post_held');
            $table->string('abilities');
            $table->integer('student_id')->unsigned();
            $table->text('conduct');
            $table->timestamps();


            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
        });



        Schema::create('old_testimonials', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('areas_good_at');
            $table->string('image');
            $table->string('session_admitted');
            $table->string('session_graduated');
            $table->string('post_held');
            $table->string('abilities');
            $table->text('conduct');
            $table->timestamps();

        });



        Schema::create('next_term_begins', function (Blueprint $table) {
            $table->increments('id');
            $table->date('begins');
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->timestamps();

            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');

            $table->foreign('term_id')->references('id')->on('terms')->onDelete('cascade');
        });



        Schema::create('sms_pin', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('student_id')->unsigned()->index();
            $table->integer('student_category_id')->unsigned();
            $table->integer('session_id')->unsigned()->index();
            $table->integer('group_class_id')->unsigned()->index();
            $table->integer('pin')->unsigned();
            $table->timestamps();
        });


        Schema::create('punctuality_classrooms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_id')->unsigned();
            $table->integer('aagc_id')->unsigned();
            $table->integer('session_id')->unsigned();
            $table->integer('term_id')->unsigned();
            $table->date('date');
            $table->boolean('status')->default(0);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
