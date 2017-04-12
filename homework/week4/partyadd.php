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
                if ($pname != "" && $date != "" && $place != "") {
                  if ($pnameErr == "" && $dateErr == "" && $placeErr == "") {
                    print "<br/><div class=\"mycard\">";

                    $db = mysqli_connect("localhost", "usr_2016_26", "mysql", "db_2016_26");
                    if (!$db) {
                      print "<p class=\"error\">Error - Could not connect to MySQL</p>";
                    }
                    $query = "REPLACE INTO party (Party_Name, Date, Place, Info) VALUES ('$_POST[inputPName]','$_POST[inputDate]','$_POST[inputPlace]','$_POST[inputInfo]')";
                    $result = mysqli_query($db, $query);
                    if (!$result) {
                      print "<p class=\"error\">Error - the query could not be executed<br/>";
                      $error = mysqli_error();
                      print $error . "</p>";
                    }
                    mysqli_close($db);

                    print "<h1>New party added!</h1><br/>\n";
                    print "<p>Click <a href=\"partylist.php\"><strong>HERE</strong></a> to view the all parties.</p>\n";
                    // print "<h5><a href=\"partyadd.php\">BACK</a></h5>\n";
                    print "</div>";
                    $pname = $date = $place = $info = "";
                  }
                }
              }
            ?>
            <br/>
            <div class="mycard" id="container">
                <h2>Party List</h2>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="Form1">
                <br/>
                <div class="form-group">
                  <label for="inputName">Party Name</label>
                  <input type="text" class="form-control" id="inputPName" name="inputPName" placeholder="Enter party name" value="<?php if ($pnameErr == "") {echo $pname;}?>" required="required">
                  <span class="error">*</span>
                  <br/><span class="error"><?php echo $pnameErr;?></span>
                </div>
                <div class="form-group">
                  <label for="inputDate">Date(YYYY-MM-DD)</label>
                  <input type="text" class="form-control" id="inputDate" name="inputDate" placeholder="Enter date" value="<?php if ($dateErr == "") {echo $date;}?>" required="required">
                  <span class="error">*</span>
                  <br/><span class="error"><?php echo $dateErr;?></span>
                </div>
                <div class="form-group">
                  <label for="inputPlace">Place</label>
                  <input type="text" class="form-control" id="inputPlace" name="inputPlace" placeholder="Enter place" value="<?php if ($placeErr == "") {echo $place;}?>" required="required">
                  </select><span class="error">*</span>
                  <br/><span class="error"><?php echo $placeErr;?></span>
                </div>
                <div class="form-group">
                  <label for="inputInfo">Short description</label>
                  <input type="text" class="form-control" id="inputInfo" name="inputInfo" placeholder="Describe your party" value="<?php {echo $info;}?>">
                </div>
                <br/><input type = "submit"  value = "Submit" />
              </form>
              <h4><a href="partylist.php">VIEW ALL</a></h4>
              <h4><a href="party.php">BACK</a></h4>
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