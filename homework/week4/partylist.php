<?xml version="1.0" encoding="UTF-8"?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <!-- <meta charset="utf-8"/> -->
    <title>Week 4</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="description" content="my homepage">
    <meta name="keywords" content="homepage">
    <meta name="author" content="ZhengShuYu">
    <link rel="shortcut icon" href="img/favicon.ico">

    <!-- CSS | STYLE -->
    <link rel="stylesheet" type="text/css" href="../../css/style.css">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.css">
    <style type="text/css">
        .Header {
            position: fixed; 
            top: 0px; 
            width: 100%; 
            height: 6%; 
            background-color: rgba(59, 60, 79, 1);
            float: left;
            font-size: 20px;
        }
        .error {
            color: #FF0000;
            font-size: 12px;
        }
        td, th {
            border:solid darkslategray; 
            border-width:0px 1px 1px 0px; 
            padding:10px 0px;
        }
        table {
            border:solid darkslategray;
            border-width:1px 0px 0px 1px;
            margin-left:auto; 
            margin-right:auto; 
            width: 86%;
            word-wrap: break-word;
            /*word-break:break-all;*/
            word-break: normal;
        }
    </style>

    <!-- PLUGIN SCRIPTS -->
    <script type="text/javascript" src="../../js/jquery.js"></script>
    <script type="text/javascript" src="../../js/bootstrap.js"></script>
    <!-- END PLUGIN SCRIPTS -->

</head>

<body>
    <div class="Header">
        <div style="height: 100%; width: 100%; margin-left: 20px">
            <a href="week4.html">
                <img src="../../img/yunwen1.png" alt="Back" width="88" height="31"/>
            </a>
        </div>
    </div>
    <div>
        <div class="left-column"></div>
        <div class="right-column"></div>
        <div class="mid-column">
            <br/>
            <!-- <div class="mycard" id="container"> -->
              <!-- <h2> Query Results </h2> -->
              <?php
                  $db = mysqli_connect("localhost", "usr_2016_26", "mysql", "db_2016_26");
                  if (!$db) {
                        print "<p class=\"error\">Error - Could not connect to MySQL</p>";
                        // exit;
                  }

                  $sql = "SELECT * FROM party";
                  $result = mysqli_query($db, $sql);
                  if (!$result) {
                        print "<p class=\"error\">Error - the query could not be executed";
                        $error = mysqli_error();
                        print $error . "</p>";
                  }

                  // Display the results in a table
                  // Get the number of rows in the result, as well as the first row
                  // and the number of fields in the rows
                  $num_rows = mysqli_num_rows($result);
                  $row = mysqli_fetch_array($result);
                  $num_fields = sizeof($row);

                  if (count($row) != 0) {

                      // Output the values of the fields in the row
                      for ($row_num = 0; $row_num < $num_rows; $row_num++) {
                          print "<div class=\"mycard\">";
                          print "<h3>Party infomation</h3>";
                          // print "<table border=\"2\" style=\"margin-left:auto; margin-right:auto; width: 80%; word-break:break-all;\">";
                          print "<table><tr align = 'center'>";
                          while ($next_element = each($row)){
                              $next_element = each($row);
                              $next_key = $next_element['key'];
                              print "<th>" . $next_key . "</th>";
                          }
                          print "</tr>";
                          reset($row);
                          print "<tr align = 'center'>";
                          for ($field_num = 0; $field_num < $num_fields / 2; $field_num++)
                              print "<td>" . $row[$field_num] . "</td> ";
                          print "</tr></table>\n<h4>Guests</h4>";

                          // var_dump($row[0]);
                          // Output guests participant in the party
                          // print "<table border=\"2\" style=\"margin-left:auto; margin-right:auto; width: 80%; word-break:break-all;\">";
                          $query = "SELECT guest.Guest_ID,guest.Guest_Name, guest.Age, guest.Gender, guest.E_mail
                                    FROM guest,guest_party
                                    WHERE guest_party.Party_ID=$row[0]
                                    AND guest_party.Guest_ID=guest.Guest_ID";
                          $guests = mysqli_query($db, $query);
                          if (!$guests) {
                              print "<p class=\"error\">Error - the query could not be executed";
                              $error = mysqli_error();
                              print $error . "</p>";
                          }
                          // var_dump($guests);
                          $gnum_rows = mysqli_num_rows($guests);
                          $grow = mysqli_fetch_array($guests);
                          $gnum_fields = sizeof($grow);
                          if (count($grow) != 0) {
                              // print "<table border=\"2\" style=\"margin-left:auto; margin-right:auto; width: 80%; word-break:break-all;\">";
                              print "<table><tr align = 'center'>";
                              // Produce the column labels
                              while ($next_element = each($grow)){
                                  $next_element = each($grow);
                                  $next_key = $next_element['key'];
                                  print "<th>" . $next_key . "</th>";
                              }
                              print "</tr>";
                              for ($grow_num = 0; $grow_num < $gnum_rows; $grow_num++) {
                                  reset($grow); 
                                  print "<tr align = 'center'>";
                                  for ($gfield_num = 0; $gfield_num < $gnum_fields / 2; $gfield_num++)
                                      print "<td>" . $grow[$gfield_num] . "</td> ";
                                  $grow = mysqli_fetch_array($guests);
                              }
                              print "</table>";
                          }
                          print "<h4><a href=\"party.php\">BACK</a></h4>\n";
                          print "</div><br/>";
                          $row = mysqli_fetch_array($result);
                      }
                  }
                  mysqli_close($db);
            ?>
            <!-- <h4><a href="party.php">BACK</a></h4> -->
            <!-- </div> -->
            <br/>
        </div>
    </div>
    <div class="Footer" style="position: fixed; bottom: 0px; width: 100%; height: 6%; background-color: rgba(242, 236, 223, 1); float: left;">
        <!-- <a href="http://jigsaw.w3.org/css-validator/check/referer">
            <img style="border:0;height:100%;float:right;" src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!" />
        </a>
        <a href="http://validator.w3.org/check?uri=referer">
            <img src="http://www.w3.org/Icons/valid-xhtml10" alt="Valid XHTML 1.0 Strict" style="border:0;height:100%;float:right;" />
        </a> -->
    </div>
</body>
</html>