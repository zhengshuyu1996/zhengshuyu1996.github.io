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
            <?php
              include 'check.php';
              if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($name != "" && $email != "" && $gender != "" && $age != "" && $party != "") {
                  if ($nameErr == "" && $emailErr == "" && $ageErr == "" && $partyErr == "") {
                    echo "<br/><div class=\"mycard\">";
                    include 'collect.php';
                    echo "</div>";
                    $name = $email = $gender = $age = $party = "";
                  }
                }
              }
            ?>
            <br/>
            <div class="mycard" id="container">
                <h2>Party List</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="Form1">
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
                        // exit;
                  }

                  $num_rows = mysqli_num_rows($result);
                  $row = mysqli_fetch_array($result);
                  $num_fields = sizeof($row);

                  if (count($row) != 0) {
                    // print "<table border=\"2\" style=\"margin-left:auto; margin-right:auto; width: 90%; word-break:break-all;\">";
                    print "<table><tr align = 'center'>";
                    // Produce the column labels
                    while ($next_element = each($row)){
                      $next_element = each($row);
                      $next_key = $next_element['key'];
                      print "<th>" . $next_key . "</th>";
                    }
                    print "<th>Sign up</th></tr>";

                    // Output the values of the fields in the row
                    for ($row_num = 0; $row_num < $num_rows; $row_num++) {
                      reset($row); 
                      print "<tr align = 'center'>";
                      for ($field_num = 0; $field_num < $num_fields / 2; $field_num++)
                        print "<td>" . $row[$field_num] . "</td> ";
                      print "<td><input type=\"radio\" name=\"Party\" value=\"".$row[0]."\" /></td></tr>";
                      $row = mysqli_fetch_array($result);
                    }
                    print "</table>\n";
                  }
                  mysqli_close($db);
                ?>
                <span class="error"><?php echo $partyErr;?></span>
                <br/><h4><a href="partylist.php">DETAILS</a></h4>
                <br/>
                <div class="form-group">
                  <label for="inputName">Name</label>
                  <input type="text" class="form-control" id="inputName" name="inputName" placeholder="Enter name" value="<?php if ($nameErr == "") {echo $name;}?>" required="required">
                  <span class="error">*</span>
                  <br/><span class="error"><?php echo $nameErr;?></span>
                </div>
                <div class="form-group">
                  <label for="inputAge">Age</label>
                  <input type="text" class="form-control" id="inputAge" name="inputAge" placeholder="Enter age" value="<?php if ($ageErr == "") {echo $age;}?>" required="required">
                  <span class="error">*</span>
                  <br/><span class="error"><?php echo $ageErr;?></span>
                </div>
                <div class="form-group">
                  <label for="inputGender">Gender</label>
                  <select class="form-control" id="inputGender" name="inputGender">
                    <option value="male" <?php if($gender == "male")echo "selected=\"selected\"";?> >Male</option>
                    <option value="female" <?php if($gender == "female")echo "selected=\"selected\"";?> >Female</option>
                  </select><span class="error"> *</span>
                </div>
                <div class="form-group">
                  <label for="inputEmail">Email address</label>
                  <input type="text" class="form-control" id="inputEmail" name="inputEmail" placeholder="Enter email" value="<?php if ($emailErr == "") {echo $email;}?>" required="required">
                  <span class="error">*</span>
                  <br/><span class="error"><?php echo $emailErr;?></span>
                </div>
                <br/><input type = "submit"  value = "Sign up for it!" />
              </form>
              <h4><a href="partyadd.php">ADD A NEW PARTY</a></h4>
              <!-- <h4><a href="week4.html">BACK</a></h4> -->
            </div>
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