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
            <tr><td><input type="button" class="button" value="Documentation"  OnClick="window.location='documentation.php'"></td></tr>


        </table>

    </div>
</header>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 29/09/2018
 * Time: 10:37 AM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$strAction = $_GET["Action"];


switch($strAction)
{
    case "INSERT":
        ?>


        <form method="post" action="typeAdd.php?Action=ConfirmInsert">
            <div class="container">
            <h2>New Property Type</h2>
            <table>
                <tr>
                    <th>Type Name:</th>
                    <td><input type="text" name="newType" size="50"></td>
                </tr>
            </table>

        <br>

            <table>
                <tr>
                    <td><input type = "submit" value="Add Type"></td>
                    <td><input type="button" value="Return to List" OnClick="window.location='displayTypes.php'"></td>
                </tr>

            </table>
<br>
                <?php
                $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
                ?>
                <input type = "button" class="codeButton" value="Type Insert" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">

            </div>
        </form>

<?php
break;
case "ConfirmInsert":
    {
        $query="INSERT INTO type(typeID, typeName) values (typeID, '$_POST[newType]')";
        $result = $conn->query(($query));
        header("Location: displayTypes.php");
    }
    break;
}?>


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
