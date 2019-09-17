//	Temporary entities due to the absence of DB are represented by :- <[T]>

var WTA = [];			//  Array to store Weekly Teacher Availability data

//	Function to convert Hours and Minutes into Minutes
function toMin(hour = 0,min = 0) 
{
	if (hour < 0 || hour > 24) 
	{
		console.log("ERROR!!! Input 'hour' range should be between 0 & 24. ") ;
	}
	else if (min < 0 || min > 60) 
	{
		console.log("ERROR!!! Input 'min' range should be between 0 & 60. ") ;
	}
	else
	{
		return ((hour * 60) + min);
	}
}

//	Function to convert Minutes into Hour and Minutes
function fromMin(min = 0) 
{
	if (min < 0 || min > 60 * 24) 
	{
		console.log("ERROR!!! Input 'min' range should be between 0 & 60. ") ;
	}
	else
	{
		return [Math.trunc(min / 60), min % 60];	
	}
}

//	Function to initialise WTA
function initWTA(unitDuration) 
{
	var dayStartHour = 7;
	var dayStartMin = 0;
	var dayEndHour = 14;
	var dayEndMin = 0;
	
	var startTime = toMin(dayStartHour,dayStartMin);
	var endTime = toMin(dayEndHour,dayEndMin);

	let count = 0;

	for (var i = 0; i < 7; i++) 
	{
		for (var j = startTime; j <= endTime; j++) 
		{	console.log(timeInstance);
			if (count % unitDuration === 0) 
			{
				var timeInstance = new TimeInstance(i,fromMin(j)[0],fromMin(j)[1],fromMin(j + unitDuration)[0],fromMin(j + unitDuration)[1]);
				var wtaInstance = {
									isEmpty : true,
									time : timeInstance,
									availableTeachers : []
								  }
				WTA.push(wtaInstance);
			}

			count++;	
		}
	}
}


function updateWTA() 
{
	console.log('\n\nFunction : updateWTA()');

	for (var i = 0; i < WTA.length; i++) 
	{	
		console.log("\t\tUpdating WTA element ",i + 1,"/",WTA.length)
		
		for (var j = 0; j < teacherDB.length; j++) 
		{
			console.log("\t\t\tChecking teacherDB element ",j + 1,"/",teacherDB.length)	
	
			var teacher = teacherDB[j];
			console.log("\t\t\tteacher = ",teacher.name);		

			for (var k = 0; k < teacher.freeTime.length; k++) 
			{
				console.log("\t\t\t\tChecking freeTime element ",k + 1,"/",teacher.freeTime.length)	
			
				if (teacher.isAvailable(WTA[i].time)) 
				{
					console.log('Currently Available');
					WTA[i].availableTeachers.push(teacher);
					WTA[i].availableTeachers.isEmpty = false;
					console.log("\t\t\t\tPushed ",teacher);		
				}
				else
				{
					console.log('Not Currently Available');
				
				}

			}
	
		}

	}

	console.log("\tWeekly Teacher Availability array updated.")
}

