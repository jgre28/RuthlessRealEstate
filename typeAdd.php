<html>
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
            <h1>New Property Type</h1>
            <table>
                <tr>
                    <th>Type Name:</th>
                    <td><input type="text" name="newType" size="50"></td>
                </tr>
            </table>
        </div>
        <br>
        <div class="container">
            <table>
                <tr>
                    <td><input type = "submit" value="Add Type"></td>
                    <td><input type="button" value="Return to List" OnClick="window.location='displayTypes.php'"></td>
                </tr>

            </table>
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

</body>
</html>