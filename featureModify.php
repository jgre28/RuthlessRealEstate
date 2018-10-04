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
 * Date: 30/09/2018
 * Time: 3:22 PM
 */

?>
<script language="javascript">
    function confirmDelete()
    {
        window.location='featureModify.php?featureID=<?php echo $_GET["featureID"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php


include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM feature WHERE featureID =".$_GET["featureID"];
$result = $conn->query(($query));
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
    case "UPDATE":
        ?>
        <div class="container">
            <form method="post" action="featureModify.php?featureID=<?php echo $_GET["featureID"]; ?>&Action=ConfirmUpdate">
                <h2>Feature Type Update</h2>
                <table>
                    <tr>
                        <th>Feature:</th>
                        <td><input type="text" name="newFeature" size="50" value="<?php echo $row["featureName"]; ?>"></td>
                    </tr>

                </table>
<br>
                <table>
                    <tr>
                        <td><input type = "submit" value="Update Feature"></td>
                        <td><input type = "button" value="Return to List" OnClick="window.location='displayFeatures.php'"></td>
                    </tr>

                </table>
            </form>
            <br>
            <?php
            $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
            ?>
            <input type = "button" class="codeButton" value="Feature Modify" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">

        </div>
        <?php
        break;
    case "ConfirmUpdate":
        {
            $query="UPDATE feature set featureName='$_POST[newFeature]'
            WHERE featureID =".$_GET["featureID"];
            $result = $conn->query(($query));


            header("Location: displayFeatures.php");
        }
        break;

    case "DELETE":

        ?>
        <div class="container">
            <h2>Confirm deletion of the following Feature Type</h2>

            <table class="table table-striped table-bordered">
                <tr>
                    <th>Feature:</th>
                    <td><?php echo $row["featureName"]?></td>
                </tr>
            </table>
            <br/>
            <table align="center">
                <tr>
                    <td><input type="button" value="Confirm" OnClick="confirmDelete();">
                    <td><input type="button" value="Cancel" OnClick="window.location='displayFeatures.php'"></td>
                </tr>
            </table>
            <br>
            <?php
            $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
            ?>
            <input type = "button" class="codeButton" value="Feature Modify" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">

        </div>
        <?php
        break;

    case "ConfirmDelete":
        $query="DELETE FROM feature WHERE featureID =".$_GET["featureID"];
        if($conn->query($query))
        {
            ?>
            <div class="container">
            <h4>The feature type has been successfully deleted</h4>

            <?php
        }
        else {
            echo "<center>Error Contacting Database<p /></center>";
        }
        ?>
        <input type = "button" value="Return to List" OnClick="window.location='displayFeatures.php'">
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