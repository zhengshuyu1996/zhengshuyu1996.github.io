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

my(@name) = param("ids");

# Produce the header for the reply page - do it here so
#  error messages appear on the page

print header();

if (0 == @name) {
  print start_html("Sorry");
  print "<script language=\"javascript\" type=\"text/javascript\">\n",
        "alert(\"No changes!\");\n",
        "window.setTimeout(\"window.location='list.pl'\", 1);\n";
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

  # Read the survey data file, unlock it, and close it

  chomp($length = <SURVDAT>);

  for ($count = 0; $count < $length; $count++) {
      chomp($file_lines[$count] = <SURVDAT>);
  }

  flock(SURVDAT, $UNLOCK);
  close(SURVDAT);

  # Reopen the survey data file for writing and lock it

  open(SURVDAT, ">survdat.dat") or error();
  flock(SURVDAT, $LOCK);

  # Write out the file data, unlock the file, and close it
  $length = $length - @name;
  print SURVDAT "$length\n";
  $length = $length + @name;
  $cnt = 0;
  $flag = 0;
  for ($count = 0; $count < $length; $count++) {
      if ($flag == 0 && $name[$cnt] == $count) {
        $cnt ++;
        if ($cnt == @name) {
          $flag = 1;
        }
      }
      else {
        $line = $file_lines[$count];
        print SURVDAT "$line\n";
      }
  }

  flock(SURVDAT, $UNLOCK);
  close(SURVDAT);

  # Build the Web page to thank the survey participant
  print start_html("Thankyou");
  print "<script language=\"javascript\" type=\"text/javascript\">\n",
        "alert(\"Data deleted!\");\n",
        "window.setTimeout(\"window.location='list.pl'\", 1);\n";
        # "window.setTimeout(\"window.history.go(-1)\");\n";
        
  print "</script>\n";
  print end_html();

}
