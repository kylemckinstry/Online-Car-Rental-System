<?php

$id = $_GET["id"];

session_start();

$json = file_get_contents('cars.json');
$cars = json_decode($json, true);

if ($cars === null) {
    die("Error: Cannot create object from JSON");
}

foreach ($cars as $carKey => $carValue) {
    if ($id == $carValue['id'] && $carValue['availability']) {
        $car_detail = array(
            "Image" => (int) $carValue['id'],
            "Brand" => (string) $carValue['brand'],
            "Description" => (string) $carValue['description'],
            "FuelType" => (string) $carValue['fuelType'],
            "Mileage" => (string) $carValue['mileage'],
            "Model" => (string) $carValue['model'],
            "PriceDay" => (int) $carValue['priceDay'],
            "RentalDays" => 1,
            "Seats" => (string) $carValue['seats'],
            "Year" => (string) $carValue['modelYear'],
        );

        if (!isset($_SESSION["cart"])) {
            $_SESSION["cart"] = array($id => $car_detail);
        } elseif (!isset($_SESSION["cart"][$id])) {
            $_SESSION["cart"][$id] = $car_detail;
        }

        echo $carValue['availability'];

        return;
    }
}

?>