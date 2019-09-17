function displayRoutine() 
{
	var timetable = new Timetable();
	var day;

	timetable.setScope(6,21);

	timetable.addLocations(['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']);


	for (var i = 0; i < routine.length; i++) 
	{
		switch (routine[i].time.day) 
		{
		  case 1:
		    day = "Sunday";
		    break;
		  case 2:
		    day = "Monday";
		    break;
		  case 3:
		     day = "Tuesday";
		    break;
		  case 4:
		    day = "Wednesday";
		    break;
		  case 5:
		    day = "Thursday";
		    break;
		  case 6:
		    day = "Friday";
		    break;
		  case 7:
		    day = "Saturday";
		}

		if (routine[i].course.cid != undefined) 
		{
			console.log(i,routine[i].time.startHour,routine[i].time.startMin,routine[i].time.endHour,routine[i].time.endMin);
			timetable.addEvent(routine[i].course.name, day, new Date(2019,9,7,routine[i].time.startHour,routine[i].time.startMin), new Date(2019,9,7,routine[i].time.endHour,routine[i].time.endMin));
		}

	}

	var renderer = new Timetable.Renderer(timetable);
	renderer.draw('.timetable');
}