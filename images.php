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
 * Time: 9:14 AM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);



?>

<div class="container">
    <?php
    $strAction = $_GET["Action"];

    switch($strAction)
    {

    case "DISPLAY":
    ?>

    <h2>Images Table</h2>
    <form method="post" action="images.php?Action=DELETE">
        <table class="table table-striped table-bordered">
            <tr>
                <th>Image Name</th>
                <th>Property Type</th>
                <th>Address</th>
                <th>Seller</th>
                <th>Delete?</th>
            </tr>
        <?php
    $imgDir = dirname($_SERVER["SCRIPT_FILENAME"])."/property_images";

    $dir = opendir($imgDir);
    while ($file = readdir($dir)) {
        if ($file == "." || $file == "..") {
            continue;
        }


        $data= explode(".", $file);
        $ext = end($data);
        echo $ext;


        if ($ext == "jpg" || $ext == "jpeg" || $ext == "png" || $ext == "bmp")
        {
            //display table and checkbox form for deleting



            $query= "SELECT * FROM property WHERE imageName = '$file'";
            $result = $conn->query($query);
            if($result->fetch_array()) {
                $query= "SELECT * FROM property WHERE imageName = '$file'";
                $result = $conn->query($query);
                $row = mysqli_fetch_array($result);
                //get the types name to display rather than the ID of the type
                $type = $row["propertyType"];

                $typeName = mysqli_fetch_row($conn->query("SELECT typeName FROM type WHERE $type= typeID"));
                $type=$typeName[0];

                //formats the address to be nice
                $address = "";
                if (!empty($row["unitNum"])) {
                    $address = $address . "U" . $row["unitNum"] . ", ";
                }
                $address = $address . $row["streetNum"] . " " . $row["street"] . ", " . $row["suburb"] . ", " . $row["state"] . ", " . $row["postcode"];


                //gets the sellers name
                $sellerID = $row["sellerID"];
                $sellerName = mysqli_fetch_row($conn->query("SELECT gName, fName FROM client WHERE $sellerID= clientID"));
                $name=$sellerName[0]." ".$sellerName[1];
            }
            else{
                $type = "N/A";
                $address = "N/A";
                $name = "N/A";
            }
            ?>
                <tr>
                    <td><?php echo $file?></td>
                    <td><?php echo $type?></td>
                    <td><?php echo $address?></td>
                    <td><?php echo $name?></td>
                    <td align="center"><input type="checkbox" class="checkbox" name="check[]" value=<?php echo $file?>></td>

                </tr>


            <?php
        }


    }
    ?>
        </table>
        <input type = "submit" value="Delete Images">

        <?php
        break;

        case "DELETE":

            if (isset($_POST["check"]))
            {

                foreach ($_POST["check"] as $file) {

                    $query= "SELECT propertyID FROM property WHERE imageName = '$file'";
                    $result = $conn->query($query);
                    if($result->fetch_array()) {

                        $query = "UPDATE property SET imageName = '' WHERE imageName = '$file'";
                        $result = $conn->query($query);
                    }
                    unlink("property_images/".$file);

                }
                ?>
                <h2>Images Successfully Deleted</h2>
                <?php

            }
            else{
                ?>
                <h2>No Images Selected for Deletion</h2>
                <?php
            }

            ?>
            <input type = "button" value="Back to Images" OnClick="window.location='images.php?Action=DISPLAY'">

        <?php

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