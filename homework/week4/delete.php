<html>
<head>
      <title>Delete</title>
</head>
<body>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
      $db = mysqli_connect("localhost", "usr_2016_26", "mysql", "db_2016_26");
      if (!$db) {
            print "<p class=\"error\">Error - Could not connect to MySQL</p><br/>";
      }
      if (empty($_POST["ids"])) {
            print "<script language=\"javascript\" type=\"text/javascript\">\n";
            print "alert(\"No changes!\");\n";
            print "</script>\n";
      }
      else {
            $ids = $_POST['ids'];
            // echo var_dump($ids);
            foreach ($ids as $id){
                  $query = "DELETE FROM guest WHERE Guest_ID = '$id'";
                  $result = mysqli_query($db, $query);
                  if (!$result) {
                        print "<p class=\"error\">Error - the query could not be executed</p><br/>";
                        $error = mysqli_error();
                        print "<p>" . $error . "</p>";
                  }
            }
            print "<script language=\"javascript\" type=\"text/javascript\">\n";
            print "alert(\"Data deleted!\");\n";
            // print "window.setTimeout(\"window.location='list.php'\", 1);\n";
            print "</script>\n";
            // print "<div style=\"text-align:center; width:100%; margin-left:auto; margin-right:auto;\">\n";
            // print "<h1> Deleted</h1><br/>\n";
            // print "<p>Click <a href=\"list.php\"><strong>HERE</strong></a> to view the results.</p><br/>\n";
            // print "<h3><a href=\"questionare.php\">BACK</a></h3>\n";
      }
      mysqli_close($db);
}

?>
</body>
</html>