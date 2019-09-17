//	Temporary entities due to the absence of DB are represented by :- <[T]>

var currentUnit;
var routine = [];			// Array to store generated Schedule
var courseSlack;

function initRoutine() 
{
	console.log('\n\nFunction : initRoutine()')
	for (var i = 0; i < WTA.length; i++) 
	{
		var routineObject = {
								time:WTA[i].time,
								course: "TBA",
								};

		routine.push(routineObject);
	}
}

function schedule() 
{
	console.log('Course Slack = ',courseSlack);
	var routineIndex = 0;			
	for (var i = 0; i < WTA.length; i++)	//	For the Unit of time of Routine
	{
		currentUnit = i; 
		var courseSlack = []			//	Array to store Slack of	Courses for a specific Unit of the Routine

		console.log('At WTA units ',i,WTA[i].time);	
		for (var j = 0; j < courseDB.length; j++)	//	For each Course
		{	
			if (courseDB[j].needsSchedulling())	//	Checking if the Course needs schedulling 
			{
				console.log('\t',courseDB[j].name,' needs schedulling.');

				/*
				for (var k = 0; k < courseDB[j].teachers.length; k++) 
				{
				*/
					var teacher = courseDB[j].teachers;
					
					if (courseDB[j].teachers.isAvailable(WTA[i].time)) 
					{
						console.log('\t\t',courseDB[j].teachers.name,' is available.');	
						var slack = courseDB[j].getSlack(courseDB[j].teachers.eid);
						console.log('\t\tSlack = ',slack);
						courseDB[j].slack = slack;
						courseSlack.push(courseDB[j]);
					}		
					else
					{
						console.log('\t\t',courseDB[j].teachers.name,' is not available.');	

					}
				/*
				}
				*/
			}

		}	

		console.log(courseSlack);
		
		if (courseSlack.length > 0) 
		{
			var min = courseSlack[0].slack;	
			var LSI = 0;	//	Least Slack Index is the index of the element of 'coursesSlack' with the least 'slack'
			for (var l = 0; l < courseSlack.length; l++) 
			{
				if(min > courseSlack[l].slack)
				{
					min = courseSlack[l].slack;
					LSI = l; 
				}					
			}
			var routineObject = {
									time:WTA[i].time,
									course: courseSlack[LSI]
									};
			routine[i] = routineObject;
			console.log('Scheduled Course = ',courseSlack[LSI]);
		}
		

	} 
		
}
