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
 * Time: 2:46 PM
 */

function fSelect($value1, $value2)
{
    $strSelect = "";
    if($value1 == $value2)
    {
        $strSelect = " Selected";
    }
    return $strSelect;
}


function isChecked($var)
{
    $checked = "";
    if($var == "Y")
    {

        $checked = "checked";
    }

    return $checked;
}

?>
<script language="javascript">
    function confirmDelete()
    {
        window.location='clientModify.php?clientID=<?php echo $_GET["clientID"]; ?>&Action=ConfirmDelete';
    }
</script>
<?php


include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM client WHERE clientID =".$_GET["clientID"];
$result = $conn->query(($query));
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
       case "UPDATE":

        ?>
        <form method="post" action="clientModify.php?clientID=<?php echo $_GET["clientID"]; ?>&Action=ConfirmUpdate">
            <div class="container">
                <h2>Client Details Update</h2>
                <table>
                    <tr>
                        <th>Given Name:</th>
                        <td><input type="text" name="gName" size="50" value="<?php echo $row["gName"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Family Name:</th>
                        <td><input type="text" name="fName" size="50" value="<?php echo $row["fName"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Unit Number:</th>
                        <td><input type="text" name="unitNum" size="50" value="<?php echo $row["unitNum"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Street Number:</th>
                        <td><input type="text" name="streetNum" size="50" value="<?php echo $row["streetNum"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Street Name:</th>
                        <td><input type="text" name="street" size="50" value="<?php echo $row["street"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Suburb:</th>
                        <td><input type="text" name="suburb" size="50" value="<?php echo $row["suburb"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>State:</th>
                        <td><input type="text" name="state" size="50" value="<?php echo $row["state"]; ?>"></td>
                    </tr>

                    <tr>
                        <th>Postcode:</th>
                        <td><input type="text" name="postcode" size="50" value="<?php echo $row["postcode"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><input type="text" name="email" size="50" value="<?php echo $row["email"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Contact:</th>
                        <td><input type="text" name="mobile" size="50" value="<?php echo $row["mobile"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Mailing List:</th>
                        <td><input type="checkbox" class="checkbox" name="check" value="Y" <?php echo isChecked($row["mailingList"])?>></td>
                    </tr>


                </table>

            <br>


                <table>
                    <tr>
                        <td><input type = "submit" value="Update Client"></td>
                        <td><input type = "button" value="Return to List" OnClick="window.location='displayClients.php'"></td>
                    </tr>

                </table>
                <br>
                <?php
                $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
                ?>
                <input type = "button" class="codeButton" value="Client Modify" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">

            </div>
        </form>

        <?php
        break;
    case "ConfirmUpdate":
        {
            $mailing="N";
            if (isset($_POST["check"]))
            {
                $mailing=$_POST["check"];
            }

            $query="UPDATE client set gName='$_POST[gName]', fName='$_POST[fName]', unitNum='$_POST[unitNum]', 
            streetNum='$_POST[streetNum]', street='$_POST[street]', 
            suburb='$_POST[suburb]', state='$_POST[state]', postcode='$_POST[postcode]', 
            email='$_POST[email]', mobile='$_POST[mobile]', mailingList='$mailing'
            WHERE clientID =".$_GET["clientID"];
            $result = $conn->query(($query));



            header("Location: displayClients.php");
        }
        break;

    case "DELETE":

        //formats the address to be nice
        $address= "";
        if (!empty($row["unitNum"])){
            $address= $address."U".$row["unitNum"].", ";
        }
        $address= $address.$row["streetNum"]." ".$row["street"].", ".$row["suburb"].", ".$row["state"].", ".$row["postcode"];

        ?>
        <div class="container">
            <h2>Confirm deletion of the following client record</h2>

            <table class="table table-striped table-bordered">
                <tr>
                    <th>Name:</th>
                    <td><?php echo $row["gName"]." ".$row["fName"]?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><?php echo $address?></td>
                </tr>
                <tr>
                    <th>Email:</th>
                    <td><?php echo $row["email"]?></td>
                </tr>
                <tr>
                    <th>Contact:</th>
                    <td><?php echo $row["mobile"]?></td>
                </tr>

            </table>
            <br/>
            <table align="center">
                <tr>
                    <td><input type="button" value="Confirm" OnClick="confirmDelete();">
                    <td><input type="button" value="Cancel" OnClick="window.location='displayClients.php'"></td>
                </tr>
            </table>
            <br>
            <?php
            $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
            ?>
            <input type = "button" class="codeButton" value="Client Modify" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">

        </div>
        <?php
        break;

    case "ConfirmDelete":
        $query="DELETE FROM client WHERE clientID =".$_GET["clientID"];
        if($conn->query($query))
        {
            ?>
            <div class="container">
            <h4>The client record has been successfully deleted</h4>

            <?php
        }
        else {
            echo "<center>Error Contacting Database<p /></center>";
        }
        ?>
        <input type = "button" value="Return to List" OnClick="window.location='displayClients.php'">
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