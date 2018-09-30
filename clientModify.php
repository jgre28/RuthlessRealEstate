<html>
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
                <h1>Client Details Update</h1>
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
                        <td><input type="checkbox" name="check" value="Y" <?php echo isChecked($row["mailingList"])?>></td>
                    </tr>


                </table>
            </div>
            <br>

            <div class="container">
                <table>
                    <tr>
                        <td><input type = "submit" value="Update Client"></td>
                        <td><input type = "button" value="Return to List" OnClick="window.location='displayClients.php'"></td>
                    </tr>

                </table>
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

        //get the types name to display rather than the ID of the type
        $type= $row["propertyType"];
        $typeName = mysqli_fetch_row($conn->query("SELECT typeName FROM type WHERE $type= typeID"));

        //formats the address to be nice
        $address= "";
        if (!empty($row["unitNum"])){
            $address= $address."U".$row["unitNum"].", ";
        }
        $address= $address.$row["streetNum"]." ".$row["street"].", ".$row["suburb"].", ".$row["state"].", ".$row["postcode"];


        //gets the sellers name
        $sellerID=  $row["sellerID"];
        $sellerName= mysqli_fetch_row($conn->query("SELECT gName, fName FROM client WHERE $sellerID= clientID"));
        ?>
        <div class="container">
            <h1>Confirm deletion of the following property record</h1>

            <table>
                <tr>
                    <th>Listing Date:</th>
                    <td><?php echo date("d/m/Y",strtotime($row["listingDate"]))?></td>
                </tr>
                <tr>
                    <th>Listing Price:</th>
                    <td><?php echo "$".$row["listingPrice"]?></td>
                </tr>
                <tr>
                    <th>Property Type:</th>
                    <td><?php echo $typeName[0]?></td>
                </tr>
                <tr>
                    <th>Address:</th>
                    <td><?php echo $address?></td>
                </tr>
                <tr>
                    <th>Seller:</th>
                    <td><?php echo $sellerName[0]." ".$sellerName[1]?></td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td><?php echo $row["description"]?></td>
                </tr>

            </table>
            <br/>
            <table align="center">
                <tr>
                    <td><input type="button" value="Confirm" OnClick="confirmDelete();">
                    <td><input type="button" value="Cancel" OnClick="window.location='displayProperties.php'"></td>
                </tr>
            </table>
        </div>
        <?php
        break;

    case "ConfirmDelete":
        $query="DELETE FROM property WHERE propertyID =".$_GET["propertyID"];
        if($conn->query($query))
        {
            ?>
            <div class="container">
            <h4>The property record has been successfully deleted</h4>

            <?php
        }
        else {
            echo "<center>Error Contacting Database<p /></center>";
        }
        ?>
        <input type = "button" value="Return to List" OnClick="window.location='displayProperties.php'">
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

</body>
</html>