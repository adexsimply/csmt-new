
<script type="text/javascript">
$(document).ready(function(){


 /*Collect student details*/
      $(".studentDetails").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

          dialog(url,"Student's full details",'l');
      });

window.studentDetails = function(){
	
	$(".studentDetails").click(function(e){
          e.preventDefault();
          var url = $(this).attr('href');

          dialog(url,"Student's full details",'l');
      });
	
}


window.fullArmOptions = function(group_class_id,x=null){

		var that = $(".fullArmOptions");

		that.html("<option value=''>Collecting class arms......</option>");

		
		$.get('{{url("select/full-arms")}}/'+group_class_id,function(data){
			console.log(data);
			var fullArmOptions = "<option value=''>Select class arm</option>";

			$.each(data.fullArms,function(i,value){

				if(value.id == x)

					fullArmOptions+="<option selected value='"+value.id+"'>"+value.arm+"</option>";
				else

					fullArmOptions+="<option value='"+value.id+"'>"+value.arm+"</option>";

			});


			that.html(fullArmOptions);

		});

	}






window.subject_schoolOptions = function(x=null){

		var that = $(".subject_schoolOptions");

		that.html("<option value=''>Collecting subject schools......</option>");

		$.get('{{url("select/subject_schools")}}',function(data){
			console.log(data);
			var subject_schoolOptions = "<option value=''>Select a subject school</option>";
			$.each(data.subject_schools,function(i,value){
				if(value.id == x)
					subject_schoolOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					subject_schoolOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(subject_schoolOptions);

		});

	}






window.subject_categoryOptions = function(x=null){

		var that = $(".subject_categoryOptions");

		that.html("<option value=''>Collecting subject categories......</option>");

		$.get('{{url("select/subject_categories")}}',function(data){
			console.log(data);
			var subject_categoryOptions = "<option value=''>Select a subject category</option>";
			$.each(data.subject_categories,function(i,value){
				if(value.id == x)
					subject_categoryOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					subject_categoryOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(subject_categoryOptions);

		});

	}




window.student_postOptions = function(x=null){

		var that = $(".student_postOptions");

		that.html("<option value=''>Collecting student post......</option>");

		$.get('{{url("select/student_posts")}}',function(data){
			console.log(data);
			var student_postOptions = "<option value=''>Select a student post</option>";
			$.each(data.student_posts,function(i,value){
				if(value.id == x)
					student_postOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					student_postOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(student_postOptions);

		});

	}




window.student_categoryOptions = function(x=null){

		var that = $(".student_categoryOptions");

		that.html("<option value=''>Collecting student categories......</option>");

		$.get('{{url("select/student_categories")}}',function(data){
			console.log(data);
			var student_categoryOptions = "<option value=''>Select a student category</option>";
			$.each(data.student_categories,function(i,value){
				if(value.id == x)
					student_categoryOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					student_categoryOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(student_categoryOptions);

		});

	}




window.student_abilityOptions = function(x=null){

		var that = $(".student_abilityOptions");

		that.html("<option value=''>Collecting student abilities......</option>");

		$.get('{{url("select/student_abilities")}}',function(data){
			console.log(data);
			var student_abilityOptions = "<option value=''>Select student ability</option>";
			$.each(data.student_abilities,function(i,value){
				if(value.id == x)
					student_abilityOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					student_abilityOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(student_abilityOptions);

		});

	}




window.stateOptions = function(x=null){

		var that = $(".stateOptions");

		that.html("<option value=''>Collecting states......</option>");

		$.get('{{url("select/states")}}',function(data){
			console.log(data);
			var stateOptions = "<option value=''>Select state</option>";
			$.each(data.states,function(i,value){
				if(value.id == x)
					stateOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					stateOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(stateOptions);

		});

	}




window.lgaOptions = function(state_id,x=null){

		var that = $(".lgaOptions");

		that.html("<option value=''>Collecting lgas......</option>");

		$.get('{{url("select/lgas")}}',{state_id:state_id},function(data){
			console.log(data);
			var lgaOptions = "<option value=''>Select lga</option>";
			$.each(data.lgas,function(i,value){
				if(value.id == x)
					lgaOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					lgaOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(lgaOptions);

		});

	}





window.houseOptions = function(x=null){

		var that = $(".houseOptions");

		that.html("<option value=''>Collecting houses......</option>");

		$.get('{{url("select/houses")}}',function(data){
			console.log(data);
			var houseOptions = "<option value=''>Select house</option>";
			$.each(data.houses,function(i,value){
				if(value.id == x)
					houseOptions+="<option selected value='"+value.id+"'>"+value.colour+"</option>";
				else
					houseOptions+="<option value='"+value.id+"'>"+value.colour+"</option>";

			});


			that.html(houseOptions);

		});

	}



window.gradeOptions = function(x=null){

		var that = $(".gradeOptions");

		that.html("<option value=''>Collecting grades......</option>");

		$.get('{{url("select/grades")}}',function(data){
			console.log(data);
			var gradeOptions = "<option value=''>Select grade</option>";
			$.each(data.grades,function(i,value){
				if(value.id == x)
					gradeOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					gradeOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(gradeOptions);

		});

	}




window.clubOptions = function(x=null){

		var that = $(".clubOptions");

		that.html("<option value=''>Collecting clubs......</option>");

		$.get('{{url("select/clubs")}}',function(data){
			console.log(data);
			var clubOptions = "<option value=''>Select club</option>";
			$.each(data.clubs,function(i,value){
				if(value.id == x)
					clubOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					clubOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(clubOptions);

		});

	}


 


window.subjectOptions = function(x=null,sql=null){

		var that = $(".subjectOptions");

		that.html("<option value=''>Collecting subjects......</option>");

		var url = sql ==null ? '{{url("select/subjects")}}' : '{{url("select/subjects")}}/'+sql;

		
		$.get(url,function(data){
			console.log(data);
			var subjectOptions = "<option value=''>Select subject</option>";
			$.each(data.subjects,function(i,value){
				if(value.id == x)
					subjectOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					subjectOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(subjectOptions);

		});

	}




window.classOptions = function(x=null,armList=false){

		var that = $(".classOptions");

		that.html("<option value=''>Collecting classes......</option>");

		$.get('{{url("select/classes")}}',function(data){
			console.log(data);
			var classOptions = "<option value=''>Select class</option>";
			$.each(data.classes,function(i,value){
				if(value.id == x)
					classOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					classOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(classOptions);

		});

		/*Collect arms in selected classes*/
		if(armList){

			that.change(function(){
			var value = $(this).val();

			fullArmOptions(value);

		});

		}
		

	}





window.assessment_typeOptions = function(x=null){

		var that = $(".assessment_typeOptions");

		that.html("<option value=''>Collecting assessment types......</option>");

		$.get('{{url("select/assessment_types")}}',function(data){
			console.log(data);
			var assessment_typeOptions = "<option value=''>Select assessment type</option>";
			$.each(data.assessment_types,function(i,value){
				if(value.id == x)
					assessment_typeOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					assessment_typeOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(assessment_typeOptions);

		});

	}



window.armOptions = function(x=null){

		var that = $(".armOptions");

		that.html("<option value=''>Collecting arms......</option>");

		$.get('{{url("select/arms")}}',function(data){
			console.log(data);
			var armOptions = "<option value=''>Select arm</option>";
			$.each(data.arms,function(i,value){
				
				if(value.id == x)
					armOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					armOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(armOptions);

		});

	}







window.aliasOptions = function(x=null){

		var that = $(".aliasOptions");

		that.html("<option value=''>Collecting aliases......</option>");

		$.get('{{url("select/aliases")}}',function(data){
			console.log(data);
			var aliasOptions = "<option value=''>Select alias</option>";
			$.each(data.aliases,function(i,value){
				if(value.id == x)
					aliasOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					aliasOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(aliasOptions);

		});

	}





window.groupOptions = function(x=null){

		var that = $(".groupOptions");

		that.html("<option value=''>Collecting groups......</option>");

		$.get('{{url("select/groups")}}',function(data){
			console.log(data);
			var groupOptions = "<option value=''>Select group</option>";
			$.each(data.groups,function(i,value){
				if(value.id == x)
					groupOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					groupOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(groupOptions);

		});

	}


window.session_termOptions = function(x=null){

		var that = $(".session_termOptions");

		that.html("<option value=''>Collecting session terms......</option>");

		$.get('{{url("select/session_term")}}',function(data){
			console.log(data);
			var session_termOptions = "<option value=''>Select session term</option>";
			$.each(data.session_terms,function(i,value){
				if(value.id == x)
					session_termOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					session_termOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(session_termOptions);

		});

	}



	window.termOptions = function(x=null){

		var that = $(".termOptions");

		that.html("<option value=''>Collecting terms......</option>");

		$.get('{{url("select/terms")}}',function(data){
			console.log(data);
			var termOptions = "<option value=''>Select term</option>";
			$.each(data.terms,function(i,value){
				if(value.id == x)
					termOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					termOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(termOptions);

		});

	}




window.sessionOptions = function(x=null,selectMessage=true){

		var that = $(".sessionOptions");

		that.html("<option value=''>Collecting sessions......</option>");

		$.get('{{url("select/sessions")}}',function(data){
			console.log(data);
			var sessionOptions = selectMessage ? "<option value=''>Select session</option>" : '';
			$.each(data.sessions,function(i,value){
				if(value.id == x)
					sessionOptions+="<option selected value='"+value.id+"'>"+value.name+"</option>";
				else
					sessionOptions+="<option value='"+value.id+"'>"+value.name+"</option>";

			});


			that.html(sessionOptions);

		});

	}


	



	
});
	
</script>
