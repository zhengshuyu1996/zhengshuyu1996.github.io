<?php
// 定义变量并设置为空值
$nameErr = $emailErr = $ageErr = $partyErr = $placeErr = $dateErr = $pnameErr = $IDErr= "";
$name = $email = $gender = $age = $party = $date = $place = $pname = $info = $ID = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (empty($_POST["inputName"])) {
    $nameErr = "Name is required!";
  } else {
    $name = test_input($_POST["inputName"]);
    if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
      $nameErr = "Please enter valid name!"; 
    }
  }

  if (empty($_POST["inputEmail"])) {
    $emailErr = "Email is required!";
  } else {
    $email = test_input($_POST["inputEmail"]);
    if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/",$email)) {
      $emailErr = "Please enter valid email!"; 
    }
  }

  if (empty($_POST["inputAge"])) {
    $ageErr = "Age is required!";
  } else {
    $age = test_input($_POST["inputAge"]);
    if (!preg_match("/^\d+$/",$age)) {
      $ageErr = "Please enter a number!"; 
    }
  }
  if (!empty($_POST["inputGender"])) {
    $gender = test_input($_POST["inputGender"]);
  }

  if (empty($_POST["Party"])) {
    $partyErr = "Please select a party!";
  } else {
    $party = $_POST["Party"];
  }

  if (empty($_POST["inputPName"])) {
    $pnameErr = "Please enter the party name!";
  } else {
    $pname = $_POST["inputPName"];
  }

  if (empty($_POST["inputPlace"])) {
    $placeErr = "Please enter place!";
  } else {
    $place = $_POST["inputPlace"];
  }

  if (empty($_POST["inputDate"])) {
    $dateErr = "Please enter date!";
  } else {
    $date = $_POST["inputDate"];
    if (!preg_match("/^([0-9]{4})-([0-9]{2})-([0-9]{2})$/",$date)) {
      $dateErr = "Please input valid date!"; 
    }
    else {
      list($y,$m,$d) = explode('-',$date);
      if (!checkdate($m,$d,$y)) {
        $dateErr = "Please input valid date!"; 
      }
    }
  }

  if (!empty($_POST["inputInfo"])) {
    $info = test_input($_POST["inputInfo"]);
  }

  if (empty($_POST["inputID"])) {
    $IDErr = "Please select a record!";
  } else {
    $ID = test_input($_POST["inputID"]);
  }

}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>