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

my($name, $age, $gender, $email) = (param("inputName"),param("inputAge"), param("inputGender"),
        param("inputEmail"));
# Produce the header for the reply page - do it here so
#  error messages appear on the page

print header();

# Build the Web page to thank the survey participant
print start_html("Thankyou");
print "<h1>Thanks for participating in our survey</h1> <br/>\n";
print end_html();