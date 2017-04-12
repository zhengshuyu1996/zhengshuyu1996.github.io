#!/usr/bin/perl -w
# conelec1.pl
# This CGI program processes the consumer electronics survey
#  form and updates the file that stores the survey

use CGI ":standard";

# error Ð a function to produce an error message for the client
#         and exit in case of open errors

sub error {
    print "Error file could not be opened in conelec1.pl <br/>";
    print end_html();
    exit(1);
}

# Begin main program
# Get the form values

my($name, $age, $gender, $email) = (param("inputName"),param("inputAge"), param("inputGender"),
        param("inputEmail"));

# Produce the header for the reply page - do it here so
#  error messages appear on the page

print header();

# Check the format of input
$check = 0;
if (($name =~ /</) || ($age =~ /</) || ($gender =~ /</) || ($email =~ /</)) {
	$check = 1;
}
elsif ($age !~ /^\d+$/) {
	$check = 1;
}
elsif ($gender ne "male" && $gender ne "female") {
	$check = 1;
}
elsif ($email !~ /([\w\-]+\@[\w\-]+\.[\w\-]+)/) {
	$check = 1;
}

if ($check == 1) {
	print start_html("Sorry");
	# print "<meta http-equiv=\"refresh\" content=\"5;URL=homework/week3/week3.html\"></head><body>"
	print "<h1>You have made an error! please do it again.</h1>\n";
	print "<h3>This page will jump back in 5 seconds.</h3>\n";
	print "<script language=\"javascript\" type=\"text/javascript\">\n";
	print "window.setTimeout(\"window.location='../homework/week3/questionare.html'\",5000);\n";
	print "</script>\n";
	print end_html();
}
elsif ($name eq "" || $age eq "" || $email eq "") {
	print start_html("Sorry");
	# print "<meta http-equiv=\"refresh\" content=\"5;URL=homework/week3/week3.html\"></head><body>"
	print "<h1>You haven't finished the form, please do it again.</h1>\n";
	print "<h3>This page will jump back in 5 seconds.</h3>\n";
	print "<script language=\"javascript\" type=\"text/javascript\">\n";
	print "window.setTimeout(\"window.location='../homework/week3/questionare.html'\",5000);\n";
	print "</script>\n";
	print end_html();
}
else {

	# Set names for file locking and unlocking

	$LOCK = 2;
	$UNLOCK = 8;

	# Open and lock the survey data file

	open(SURVDAT, "<survdat.dat") or error();
	flock(SURVDAT, $LOCK);

	# Read the data

	chomp($length = <SURVDAT>);
	for ($count = 0; $count < $length; $count++) {
   		chomp($file_lines[$count] = <SURVDAT>);
	}

	# Read the survey data file, unlock it, and close it

	flock(SURVDAT, $UNLOCK);
	close(SURVDAT);

	print start_html("Thankyou");

	# Reopen the survey data file for writing and lock it

	open(SURVDAT, ">survdat.dat") or error();
	flock(SURVDAT, $LOCK);

	# Write out the file data, unlock the file, and close it
	$length ++;
	print SURVDAT "$length\n";
	for ($count = 0; $count < $length - 1; $count++) {
    	$line = $file_lines[$count];
    	print SURVDAT "$line\n";
    	# print "<p>$line</p><br/>\n";
	}
	print SURVDAT "$name $age $gender $email \n";

	# print "<p>$name, $age, $gender, $email</p>\n";

	flock(SURVDAT, $UNLOCK);
	close(SURVDAT);

	# Build the Web page to thank the survey participant
	#print start_html("Thankyou");
	print "<div style=\"text-align:center; width:100%; margin-left:auto; margin-right:auto;\">\n",
		  "<h1>Thanks for participating in our survey </h1><br/>\n";
	print "<p>Click <a href=\"list.pl\"><strong>HERE</strong></a> to view the results.</p><br/>\n",
		  "<h3><a href=\"../homework/week3/questionare.html\">BACK</a></h3>\n";
	print end_html();

}
