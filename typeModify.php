<html>
<header>
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
 * Time: 10:17 AM
 */

?>
<script language="javascript">
    function confirmDelete()
    {
        window.location='typeModify.php?typeID=<?php echo $_GET["typeID"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php


include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM type WHERE typeID =".$_GET["typeID"];
$result = $conn->query(($query));
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
    case "UPDATE":
                ?>
        <div class="container">
            <form method="post" action="typeModify.php?typeID=<?php echo $_GET["typeID"]; ?>&Action=ConfirmUpdate">
                <h1>Property Type Update</h1>
                <table>
                    <tr>
                        <th>Type Name:</th>
                        <td><input type="text" name="newType" size="50" value="<?php echo $row["typeName"]; ?>"></td>
                    </tr>

                </table>

                <table>
                    <tr>
                        <td><input type = "submit" value="Update Type"></td>
                        <td><input type = "button" value="Return to List" OnClick="window.location='displayTypes.php'"></td>
                    </tr>

                </table>
            </form>
        </div>
        <?php
        break;
    case "ConfirmUpdate":
        {
            $query="UPDATE type set typeName='$_POST[newType]'
            WHERE typeID =".$_GET["typeID"];
            $result = $conn->query(($query));


            header("Location: displayTypes.php");
        }
        break;

    case "DELETE":

        ?>
        <div class="container">
            <h1>Confirm deletion of the following property Type</h1>

            <table>
                <tr>
                    <th>Property Type:</th>
                    <td><?php echo $row["typeName"]?></td>
                </tr>
            </table>
            <br/>
            <table align="center">
                <tr>
                    <td><input type="button" value="Confirm" OnClick="confirmDelete();">
                    <td><input type="button" value="Cancel" OnClick="window.location='displayTypes.php'"></td>
                </tr>
            </table>
        </div>
        <?php
        break;

    case "ConfirmDelete":
        $query="DELETE FROM type WHERE typeID =".$_GET["typeID"];
        if($conn->query($query))
        {
            ?>
            <div class="container">
            <h4>The property type has been successfully deleted</h4>

            <?php
        }
        else {
            echo "<center>Error Contacting Database<p /></center>";
        }
        ?>
        <input type = "button" value="Return to List" OnClick="window.location='displayTypes.php'">
        </div>

        <?php
        break;

} ?>


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