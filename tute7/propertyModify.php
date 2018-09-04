<html>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 3/09/2018
 * Time: 3:44 PM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM property WHERE propertyID =".$_GET["propertyID"];
$result = $conn->query(($query));
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
    case "UPDATE":
        ?>
<div class="container">
        <form method="post" action="propertyModify.php?propertyID=<?php echo $_GET["propertyID"]; ?>&Action=ConfirmUpdate">
            <h1>Property Details Update</h1>
            <table>
                <tr>
                    <td>streetNum</td>
                    <td><input type="text" name="streetNum" size="50" value="<?php echo $row["streetNum"]; ?>"></td>
                </tr>
                <tr>
                    <td><input type = "submit" value="Update Property"></td>
                    <td><input type="button" value="Return to List" OnClick="window.location='displayProperties.php'"></td>
                </tr>

            </table>
        </form>
</div>
        <?php
        break;
    case "ConfirmUpdate":
        {
            $query="UPDATE property set streetNum='$_POST[streetNum]' WHERE propertyID =".$_GET["propertyID"];
            $result = $conn->query(($query));
            header("Location: displayProperties.php");
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

</body>
</html>