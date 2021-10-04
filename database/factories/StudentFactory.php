<?php

use Faker\Generator as Faker;
use App\Session;
use App\Student_parent;
use App\State;

$factory->define(App\Student::class, function (Faker $faker) {
	$a = ['CSMT/SSS/','CSMT/JSS/'];
	$id = rand(5000,9000);
	if($id < 10)
		$id = '00'.$id;
	else if($id < 100)
		$id = '0'.$id;

	$admission_no = $a[rand(0,1)].rand(2013,2018).'/'.$id;
	$genotype = ['AA','AS','SS'];
	$blood_group = ['O','O+','O-','B','B+','B-','A','AB+','A-','A+'];
	$health_challenges = ['Asthma','Ulcer','HIV','Good'];
	$gender = ['male','female'];
	$parent_relationship = ['Father','Mother','Uncle','Aunt'];

    return [
        'admission_no' => $admission_no,
        'surname' => $faker->firstname,
        'othernames' => $faker->name,
        'gender' => $gender[rand(0,1)],
        'dob' => $faker->date,
        'genotype' => $genotype[rand(0,2)],
        'health_challenges' => $health_challenges[rand(0,3)],
        'emergency_treatment' => rand(0,1),
        'immunization' => rand(0,1),
        'lab_test' => rand(0,1),
        'blood_group' => $blood_group[rand(0,9)],
        'admitted_session_id' => 12,
        // 'admitted_session_id' => function(){ return Session::all()->random(); },
        // 'graduated_session_id' => function(){ return Session::all()->random(); },
        'parent_id' => function(){ return Student_parent::all()->random(); },
        'parent_relationship' => $parent_relationship[rand(0,3)], 
        'state_id' => function(){ return State::all()->random(); },
        'lga_id' => function(){ return State::all()->random()->lgas()->first(); },
        'club_id' => rand(1,2),
        'house_id' => rand(1,2),
        'student_category_id' => rand(1,2),
        'status' => 1,
    ];
});

