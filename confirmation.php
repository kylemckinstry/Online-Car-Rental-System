<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet'>
  <link rel="stylesheet" href="styles.css">

  <title>Purchase</title>
</head>

<body>

  <?php

  session_start();
  include_once 'connection.php';

  $emailResponse = $_POST["emailAddr"];

  if ($emailResponse != "") {

    $date = date("Y-m-d", strtotime("-3 months"));
    $query = "SELECT * FROM renting_history WHERE user_email = '$emailResponse' AND rent_date >= '$date'";

    $result = mysqli_query($conn, $query);

    if ($result) {
      if (mysqli_num_rows($result) > 0) {
        $bond = 0;
        $_SESSION["total"] += $bond;
      } else {
        $bond = 200;
        $_SESSION["total"] += $bond;
      }
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  }

  //Insert MySQL
  if (isset($_POST["emailAddr"])) {
    $insertEmail = $_POST["emailAddr"];
    $sql = "SELECT * FROM renting_history WHERE user_email = '$insertEmail'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 0) {
      $date = date("Y-m-d");
      $bond_amount = 200;
      $insertSql = "INSERT INTO renting_history (user_email, rent_date, bond_amount) VALUES ('$insertEmail', '$date', '$bond_amount')";
      mysqli_query($conn, $insertSql);
    }

  } else {
    echo "emailResponse is not set";
  }

  //Confirmation card
  echo '<div class="container mt-5 mb-5">
        <div class="text-center">
        <img class="card-img-top" src="images/wheel.svg" alt="Card image cap" style="width: 10rem">
        </div>
        <div class="row d-flex justify-content-center">';

  echo '<h1 class="card-title" style="padding: .7rem 0rem .7rem 0rem">Thank you for renting with Hertz-UTS</h1>';
  echo '<div class="card">
<div class="card-body" style="font-family: Muli; font-weight: 700;">
  <h2 class="card-subtitle mb-2" style="font-family: Muli; font-weight: 700; color: #ffc107">Order confirmation</h2>
  <br>
  <h4 class="card-text">Your total order cost <i>(including bond)</i> is <b style="color: #ffc107">$' . $_SESSION["total"] . '</b></h4>

  <table class="table" style="width:100%; font-family: Muli;">';

  $carString = file_get_contents('cars.json');
  $data = json_decode($carString, true);

  foreach ($_SESSION["cart"] as $id => $item) {
    echo '<tr class="card-text" style="vertical-align: top;">

      <th style="width: 30%">' . $item["Brand"] . ' ' . $item['Model'] . ' ' . $item['Year'] . '</th>
      <th style="font-weight: lighter; width: 70%"> 

      <table class="table" style="font-weight: 700;">
      <tr class="card-text" style="vertical-align: top;">
        <th>Days rented:</th>
        <th style="font-weight: lighter; width: 70%">' . $item['RentalDays'] . ' day(s)</th>
      </tr>
      <tr class="card-text" style="vertical-align: top;">
        <th>Price per day:</th>
        <th style="font-weight: lighter; width: 70%">$' . $item['PriceDay'] . '</th>
      </tr>
      <tr class="card-text" style="vertical-align: top;">
        <th>Mileage:</th>
        <th style="font-weight: lighter; width: 70%">' . $item["Mileage"] . ' kms</th>
      </tr>
      <tr class="card-text" style="vertical-align: top;">
        <th>Fuel type:</th>
        <th style="font-weight: lighter; width: 70%">' . $item['FuelType'] . '</th>
      </tr>
      <tr class="card-text" style="vertical-align: top;">
        <th>Seats:</th>
        <th style="font-weight: lighter; width: 70%">' . $item['Seats'] . '</th>
      </tr>
      </table>
      <p>' . $item['Description'] . '</p>

      </th>
      </tr>';

    // Update JSON data for the current item
    foreach ($data as $carKey => $carValue) {
      if ($item["Image"] == $carValue['id']) {
        if ($carValue['availability']) {
          $data[$carKey]['availability'] = false;
        } else {

        }
      }
    }
  }

  echo '</table>

  <div class="text-right">
  <a href="destroySession.php" target="contentFrame" class="btn btn-warning">Confirm order</a>
  </div>
</div>
</div><br><br>';

  // Update JSON
  $newCarString = json_encode($data);
  file_put_contents('cars.json', $newCarString);

  ?>

</body>

</html>