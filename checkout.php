<?php

session_start();

// Calculate total payment
$total = 0;
$rentalDays = $_REQUEST["rentalDays"];
$index = 0;
foreach ($_SESSION["cart"] as $id => $item) {
    $_SESSION["cart"][$id]["RentalDays"] = $rentalDays[$index];
    $total += $rentalDays[$index++] * $item["PriceDay"];
}
$_SESSION["total"] = $total;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="styles.css">
    <link href='https://fonts.googleapis.com/css?family=Muli' rel='stylesheet'>

    <title>Checkout</title>
</head>

<body>
    <h1 style="color: #ffc107; text-align: center;">Checkout</h1>
    <div class="container col-md-8 mx-auto">
        <h4>Customer details & payment</h4>
        <p><i>(<span style="color: red;">*</span>) fields are required.</i></p>
        <form name="confirmForm" method="post" action="confirmation.php">
            <div class="form-group row">
                <label for="firstName" class="col-sm-2 col-form-label" style="font-weight: 600;">First name<span
                        style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" name="firstName"
                        id="firstName" placeholder="Your first name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="lastName" class="col-sm-2 col-form-label" style="font-weight: 600;">Last name<span
                        style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" name="lastName"
                        id="lastName" placeholder="Your last name" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="emailAddr" class="col-sm-2 col-form-label" style="font-weight: 600;">Email address<span
                        style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="email" class="form-control" style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" name="emailAddr"
                        id="emailAddr" placeholder="Your email address" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="addrLine1" class="col-sm-2 col-form-label" style="font-weight: 600;">Address line 1<span
                        style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" name="addrLine1"
                        id="addrLine1" placeholder="Address" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="addrLine2" class="col-sm-2 col-form-label" style="font-weight: 600;">Address line 2</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" name="addrLine2"
                        id="addrLine2" placeholder="Apartment, suite, etc. (optional)">
                </div>
            </div>
            <div class="form-group row">
                <label for="city" class="col-sm-2 col-form-label" style="font-weight: 600;">City<span
                        style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" name="city"
                        id="city" placeholder="City" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="state" class="col-sm-2 col-form-label"
                    style="font-weight: 600; border-color: initial; box-shadow: initial;"
                    onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                    onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';">State<span
                        style="color:red">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" id="state" name="state"
                        style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" required>
                        <option>Australian Capital Territory</option>
                        <option selected>New South Wales</option>
                        <option>Northern Territory</option>
                        <option>Queensland</option>
                        <option>South Australia</option>
                        <option>Tasmania</option>
                        <option>Victoria</option>
                        <option>Western Australia</option>
                    </select>
                </div>
            </div>
            <div class="form-group row">
                <label for="postCode" class="col-sm-2 col-form-label" style="font-weight: 600;">Post code<span
                        style="color:red">*</span></label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" name="postCode"
                        id="postCode" placeholder="Postcode" required>
                </div>
            </div>
            <div class="form-group row">
                <label for="paymentType" class="col-sm-2 col-form-label"
                    style="font-weight: 600; font-weight: 600; border-color: initial; box-shadow: initial;"
                    onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                    onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';" required>Payment
                    type<span style="color:red">*</span></label>
                <div class="col-sm-10">
                    <select class="form-control" id="paymentType" name="paymentType"
                        style="border-color: initial; box-shadow: initial;"
                        onfocus="this.style.borderColor = '#ffc107'; this.style.boxShadow = '0 0 0 0.2rem rgba(255, 193, 7, 0.25)';"
                        onblur="this.style.borderColor = 'initial'; this.style.boxShadow = 'initial';">
                        <option>Credit card</option>
                        <option selected>Debit card</option>
                        <option>PayPal</option>
                        <option>Afterpay</option>
                        <option>ZIP - Buy now, pay later</option>
                    </select>
                </div>
            </div>
            <h4>Your total is <span style="color: #ffc107">
                    <?php echo '$' . $total; ?>
                </span></h4>
            <p>Please note a rental bond of <b>$200</b> will be applied for new customers or existing customers whose
                last rental was made on or prior to <span id="insertDate" style="font-weight: 700"></span>.</p>

            <script>
                function dateThreeMonths() {
                    var today = new Date();
                    today.setMonth(today.getMonth() - 3);
                    var date = today.getDate() + '/' + (today.getMonth() + 1) + '/' + today.getFullYear();
                    var setDate = document.getElementById('insertDate');
                    setDate.textContent = date;
                }
                dateThreeMonths();
            </script>

            <div class="form-group row">
                <div class="col-sm-12 text-right">
                    <a href="car_info.html" target="contentFrame" class="btn btn-secondary">Continue shopping</a>
                    <button type="submit" class="btn btn-warning">Book now</button>
                </div>
            </div>

        </form>
    </div>

</body>

</html>