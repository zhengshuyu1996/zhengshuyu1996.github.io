#!/usr/bin/perl -w
# conelec2.pl - display the survey results

use CGI ":standard";

# error - a function to produce an error message for the client
#         and exit in case of open errors

sub error {
    print "Error - file could not be opened in conelec2.pl <br/>";
    print end_html();
    exit(1);
}

# Begin main program
# Initialize file locking/unlocking parameter

$LOCK = 2;
$UNLOCK = 8;

print header();
# Open, lock, read, and unlock the survey data file

open(SURVDAT, "<survdat.dat") or error();
flock(SURVDAT, $LOCK);

chomp($length = <SURVDAT>);
for ($count = 0; $count < $length; $count++) {
    chomp($file_lines[$count] = <SURVDAT>);
}

flock(SURVDAT, $UNLOCK);

# Create the beginning of the result Web page

print start_html("Survey Results");
print "<div style=\"text-align:center; width:100%; margin-left:auto; margin-right:auto;\">\n",
      "<h2> Results of the Personal Information Survey",
      "</h2><br/> \n";

# Make the column titles array

@col_titles = ("Name", "Age", "Gender", "Email Address",
               "Delete");

# Create the column titles in HTML by giving their address to the th
#  function and storing the return value in the @rows array

@rows = th(\@col_titles);

# Split the input lines and create the data rows with the td function
#  and add them to the row addresses array

for ($count = 0; $count < $length; $count++) {
  @id = split(/ /, $file_lines[$count]);
  push(@id, "<input type=\"checkbox\" name=\"ids\" value=\"".$count."\"/>");
  push(@rows, td(\@id));
}

# Create the table for the female survey results
#  The address of the array of row addresses is passed to Tr

print "<form action=\"delete.pl\" method=\"post\" id=\"Form1\">";
print table({-border => "border", -style => "margin-left:auto; margin-right:auto; width: 80%;", -class => "table table-bordered table-hover"},
            caption("<h3>Survey Data</h3>"),
            Tr(\@rows)
           );
print "<br/><input type = \"submit\"  value = \"Delete\" /></form><br/>\n",
      "<h3><a href=\"../homework/week3/questionare.html\">BACK</a></h3></div>";

# Create the table for the female survey results
#  The address of the array of row addresses is passed to Tr

print end_html();

