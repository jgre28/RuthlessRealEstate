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
 * Date: 29/09/2018
 * Time: 10:07 AM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);
$query= "SELECT * FROM type ORDER BY typeName";
$result = $conn->query($query);
?>

<div class="container">
    <h2>Property Types</h2>
    <a href="typeAdd.php?Action=INSERT">Add new type</a>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Type</th>
            <th></th>
            <th></th>
        </tr>

        <?php while ($row = mysqli_fetch_array($result))
        {?>
            <tr>
                <td><?php echo $row["typeName"]?></td>

                <td><a href="typeModify.php?typeID=<?php echo $row["typeID"]; ?>&Action=UPDATE">Update</a></td>
                <td><a href="typeModify.php?typeID=<?php echo $row["typeID"]; ?>&Action=DELETE">Delete</a></td>
            </tr>


        <?php } ?>
    </table>
<br>
    <?php
    $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
    ?>
    <input type = "button" class="codeButton" value="Types" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">

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
