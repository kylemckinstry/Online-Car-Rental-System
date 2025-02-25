<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet'>

    <title>Car Reservation</title>
</head>

<body style="overflow: hidden;">
    <h1 style="color: #ffc107; text-align: center;">Car reservation</h1><br>

    <?php
    session_start();
    if (empty($_SESSION["cart"])) {
        echo '<div class="container text-center">';
        echo '<h2>Oops! Nothing here. Let\'s fix that.</h2><br>';
        echo '<a href="car_info.html" target="contentFrame" class="btn btn-warning">Keep browsing</a></div>';
    } else {
        echo '<form id="checkoutForm" method="post" action="checkout.php" style="flex-grow: 1; overflow-y: auto;">';
        echo '<div class="container col-md-8 mx-auto my-auto" style="height: 100vh; overflow: hidden;">
                        <table class="table">
                            <thead class="thead-light">
                            <tr style="text-align: center;">
                                <th></th>
                                <th>Vehicle</th>
                                <th>Price per day</th>
                                <th>Rental days</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>';

        foreach ($_SESSION["cart"] as $id => $item) {
            echo '<tr>';
            echo '<td style="text-align: center;"><img style="width: 30%; min-width: 80px; height: auto;" class="img-thumbnail" src="images/' . $item["Image"] . '.jpg"></td>';
            echo '<td class="align-middle" style="text-align: center;">' . $item["Year"] . ' ' . $item["Brand"] . ' ' . $item["Model"] . '</td>';
            echo '<td class="align-middle" style="text-align: center;">$' . $item["PriceDay"] . '</td>';
            echo '<td class="align-middle" style="text-align: center;"><input name="rentalDays[]" type="number" required max="30" min="1" value="' . $item["RentalDays"] . '" </td>';
            echo '<td class="align-middle" style="text-align: center;"><button type="submit" class="btn btn-danger" form="removeForm" onclick="document.getElementById(\'removeId\').value=' . $id . '">Remove</button></td></tr>';
        }

        echo '</tbody>
            </table>
            <div class="text-right">
                <button type="submit" form="checkoutForm" class="btn btn-warning">Continue to checkout</button>
            </div>
            </div>
            </form>';

    }
    ?>

    <form id="removeForm" method="post" action="removeCar.php">
        <input hidden name="id" id="removeId" value="">
    </form>

</body>

</html>