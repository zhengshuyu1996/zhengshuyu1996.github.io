<?php
      $db = mysqli_connect("localhost", "usr_2016_26", "mysql", "db_2016_26");
      if (!$db) {
            print "<p class=\"error\">Error - Could not connect to MySQL</p>";
      }
      $query = "INSERT INTO guest (Guest_Name, Age, Gender, E_mail) VALUES ('$_POST[inputName]','$_POST[inputAge]','$_POST[inputGender]','$_POST[inputEmail]')";

      // Execute the query
      $result = mysqli_query($db, $query);
      if (!$result) {
            print "<p class=\"error\">Error - the query could not be executed<br/>";
            $error = mysqli_error();
            print $error . "</p>";
      }

      if (!empty($_POST["Party"])) {
            $sql = "SELECT Guest_ID FROM guest WHERE Guest_Name = '$_POST[inputName]'";
            $result = mysqli_query($db, $sql);
            if (!$result) {
                  print "<p class=\"error\">Error - the query could not be executed";
                  $error = mysqli_error();
                  print $error . "</p>";
                  // exit;
            }
            $row = mysqli_fetch_array($result);
            // echo var_dump($result);
            $query = "INSERT INTO guest_party (Guest_ID, Party_ID) VALUES ('$row[Guest_ID]','$_POST[Party]')";
            $result = mysqli_query($db, $query);
            if (!$result) {
                  print "<p class=\"error\">Error - the query could not be executed<br/>";
                  $error = mysqli_error();
                  print $error . "</p>";
            }
            print "<h1>Thanks for participating in our party!</h1><br/>\n";
            print "<p>Click <a href=\"partylist.php\"><strong>HERE</strong></a> to view the results.</p>\n";
      }
      else {
            // print "<div style=\"text-align:center; width:100%; margin-left:auto; margin-right:auto;\">\n";
            print "<h1>Thanks for participating in our survey </h1><br/>\n";
            print "<p>Click <a href=\"list.php\"><strong>HERE</strong></a> to view the results.</p>\n";
            print "<h5><a href=\"questionare.php\">BACK</a></h5>\n";
      }
      mysqli_close($db);
?>