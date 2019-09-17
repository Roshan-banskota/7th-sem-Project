
//	Temporary entities due to the absence of DB are represented by :- <[T]>

var courseDB = [];			// Array to store data from Course DataBase

//	Class : Course
class Course
{
	constructor(cid,name,teachers,totalNoOfClasses,noOfClassesTaken,currentSlack)
	{
		this.cid = cid;
		this.name = name;
		this.teachers  = teachers;
		this.totalNoOfClasses  = totalNoOfClasses;
		this.noOfClassesTaken  = noOfClassesTaken;
		this.currentSlack  = currentSlack;
	}

	console()
	{
		//console.log(this);
	}

	//	<[T]> Function to check wether an Object of Course class already exists in courseDB
	isCourseExist()
	{
		for (var i = 0; i < courseDB.length; i++) 
		{
			if (courseDB[i].cid === this.cid) 
			{
				return true;
			}
			else
			{
				return false;
			}
		}
	}
	
	//	<[T]> Function to add objects of Course class to courseDB
	addCourse()
	{
		if (!this.isCourseExist()) 
		{
			courseDB.push(this);
		}
		else
		{
			alert("Course id already exists.");
		}
	}

	//	Function to check if Course needs schedulling
	needsSchedulling() 
	{
		//console.log('\n\nFunction : needsSchedulling()');

		if (this.noOfClassesTaken < this.totalNoOfClasses) 
		{
			//console.log('\ttrue');
			return true;
		}	
		else
		{
			//console.log('\tfalse');
			return false;
		}
	}

	//	Function to get slack
	getSlack(eid)
	{
		//console.log('\n\nFunction : getSlack()');

		var teacher = this.teachers;
		var totalUnits = teacher.getTotalUnits();
		var remainingUnits = teacher.getRemainingUnits(currentUnit);
		var totalClasses = this.totalNoOfClasses;
		var classesTaken = this.noOfClassesTaken;

		/*var deadline = totalUnits - remainingUnits;
		var 
*/
		var slack = -1 * ((totalUnits - remainingUnits) - (totalClasses - classesTaken));
		console.log('\tSlack :- (',totalUnits,' - ',remainingUnits,') - (',totalClasses,' - ',classesTaken,') = ',slack)		
		return slack;
	}
}


