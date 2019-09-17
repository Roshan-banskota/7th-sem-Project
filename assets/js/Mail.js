Email.send
(
	{
	    Host : "smtp.yourisp.com",
	    Username : "WOLF CRECENT",
	    Password : "AINCRAD",
	    To : 'ro2052son@gmail.com',
	    From : "wcrecent@gmail.com",
	    Subject : "SMTP JS",
	    Body : "The job is done."
	}
).then
(
	message => alert(message)
);