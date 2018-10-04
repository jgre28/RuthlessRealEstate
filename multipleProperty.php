<?php
session_start();

?>

<html>
<header>
    <?php
    if (strcmp($_SESSION["access_status"],"granted")){
        header("Location: index.php");
    }
    ?>


    <div class="header">
        <h1>RUTHLESS REAL ESTATE</h1>
    </div>
    <div class="sideMenu" >


        <table align="center">
            <tr><td><input type="button" class="button" value="Home"  OnClick="window.location='index.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Properties"  OnClick="window.location='displayProperties.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Clients" OnClick="window.location='displayClients.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Property Types"  OnClick="window.location='displayTypes.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Features"  OnClick="window.location='displayFeatures.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Multiple Property"  OnClick="window.location='multipleProperty.php?Action=EDIT'"></td></tr>
            <tr><td><input type="button" class="button" value="Images"  OnClick="window.location='images.php?Action=DISPLAY'"></td></tr>


        </table>

    </div>
</header>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 4/10/2018
 * Time: 10:51 AM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);
$query= "SELECT * FROM property ORDER BY listingDate";
$result = $conn->query($query);
?>
<div class="container">

    <?php
    $strAction = $_GET["Action"];

    switch($strAction)
    {

    case "EDIT":
    ?>
    <h2>Edit Multiple Properties Listing Price</h2>
    <form method="post" action="multipleProperty.php?Action=UPDATE">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Listing Date</th>
                <th>Property Type</th>
                <th>Address</th>
                <th>Seller</th>
                <th>Listing Price</th>
                <th>Update?</th>
            </tr>

            <?php while ($row = mysqli_fetch_array($result)) {
                //get the types name to display rather than the ID of the type
                $type = $row["propertyType"];
                $typeName = mysqli_fetch_row($conn->query("SELECT typeName FROM type WHERE $type= typeID"));

                //formats the address to be nice
                $address = "";
                if (!empty($row["unitNum"])) {
                    $address = $address . "U" . $row["unitNum"] . ", ";
                }
                $address = $address . $row["streetNum"] . " " . $row["street"] . ", " . $row["suburb"] . ", " . $row["state"] . ", " . $row["postcode"];


                //gets the sellers name
                $sellerID = $row["sellerID"];
                $sellerName = mysqli_fetch_row($conn->query("SELECT gName, fName FROM client WHERE $sellerID= clientID"));

                ?>

                <tr>
                    <td><?php echo date("d/m/Y", strtotime($row["listingDate"])) ?></td>

                    <td><?php echo $typeName[0] ?></td>
                    <td><?php echo $address ?></td>
                    <td><?php echo $sellerName[0] . " " . $sellerName[1] ?></td>
                    <td>$<input valign="right" type="text" name="listingPrice[]" size="20"
                                value="<?php echo $row["listingPrice"]; ?>"></td>
                    <td align="center"><input type="checkbox" class="checkbox" name="check[]" value="<?php echo $row["propertyID"]; ?>"


                </tr>
            <?php } ?>
        </table>

        <table align="right">
            <tr>
                <td><input type="submit" class="button" value="Update Prices"></td>
            </tr>
        </table>
        <br><br>
        <?php
        $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
        ?>
        <input type = "button" class="codeButton" value="Multiple Property" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">


        <?php
break;

case "UPDATE":
    if (isset($_POST["check"]))
    {
        $IDs = array();
        $newPrices = array();
        $propertyIDs = $conn->query("SELECT propertyID FROM property ORDER BY listingDate;");
        while($propIDs = $propertyIDs->fetch_array())
        {
            $IDs[] = $propIDs["propertyID"];
        }

        foreach ($_POST["listingPrice"] as $listPrice)
        {
            $newPrices[] = $listPrice;
        }


        foreach ($_POST["check"] as $propID) {

            $index = array_search($propID, $IDs);

            $query = "UPDATE property SET listingPrice=$newPrices[$index] WHERE propertyID = $propID";
            $result = $conn->query($query);

        }
    }
    ?>
    <h2>Listing Prices Successfully Updated</h2>
    <input type = "button" class="button" value="Back to Listing" OnClick="window.location='multipleProperty.php?Action=EDIT'">


        <?php
    break;
}
?>
</div>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="Ruthless.css">

</body>
</html>

