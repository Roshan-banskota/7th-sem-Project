function start() 
{
	var t1 = new Teacher(1,"KD");
	//t1.console();
	t1.addTeacher();
	t1.addFreeTime(0,6,30,12,30);

	var t2 = new Teacher(2,"MA");
	//t2.console();
	t2.addTeacher();
	t2.addFreeTime(0,6,00,8,30);
	//t2.addFreeTime(0,9,30,10,30);

	var t3 = new Teacher(3,"AS");
	t3.addTeacher();
	t3.addFreeTime(1,9,30,11,00);
	t3.addFreeTime(5,7,30,11,00);
	
	var t4 = new Teacher(4,"IC");
	t4.addTeacher();
	t4.addFreeTime(2,9,30,11,00);
	t4.addFreeTime(5,7,30,13,00);

		
	console.log('Teachers :- ',teacherDB);


	var c1 = new Course(1,"Internet Technology",t1,6,0);
	//c1.console();
	c1.addCourse();

	var c2 = new Course(2,"Software Programming Methodology",t2,5,0);
	//c2.console();
	c2.addCourse();

	var c3 = new Course(3,"Advanced Java Programming",t3,5,0);
	//c2.console();
	c3.addCourse();
	
	var c4 = new Course(4,"ADBMS",t4,5,0);
	//c2.console();
	c4.addCourse();

	console.log('Courses :- ',courseDB);


	initWTA(45);

	//var timeInst = new TimeInstance(0,7,0,8,30);
	//isAvailable(timeInst);

	updateWTA();

	//console.log(c1.needsSchedulling());
	//console.log(t1.getRemainingUnits(3));

	initRoutine();
	schedule();
	displayRoutine(); 

	//console.log(c1.getSlack());

}

function test1() 
{
	for (var i = 0; i < teacherDB.length; i++) 
	{
		var teacher = teacherDB[i];
		console.log('\n\tTeacher = ',teacher);
		for (var j = 0; j < WTA.length; j++) 
		{
			console.log('\tWTA Unit = ',j);
			console.log('\tisAvailable = ',teacher.isAvailable(WTA[j].time));
		}
	
	}
	
}