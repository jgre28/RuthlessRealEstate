<html>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 3/09/2018
 * Time: 3:44 PM
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

function saleDateCheck($var)
{
    $str="";
    if(!empty($var))
    {
        $str = "saleDate='$var', ";
    }
    return $str;
}

function salePriceCheck($var)
{
    $str="";
    if(!empty($var))
    {
        $str = "salePrice='$var', ";
    }
    return $str;
}

function soldDateCheck($var)
{
    $str="Not Sold";
    if(!empty($var))
    {
        $str=date("d/m/Y",strtotime($var));

    }
    return $str;

}

function soldPriceCheck($var)
{
    $str="Not Sold";
    if(!empty($var))
    {
        $str="$".number_format($var,2);

    }
    return $str;

}

function isChecked($var)
{
    $checked = "";
    if(!empty($var))
    {

        $checked = "checked";
    }

    return $checked;
}

?>
<script language="javascript">
function confirmDelete()
{
window.location='propertyModify.php?propertyID=<?php echo $_GET["propertyID"]; ?>&Action=ConfirmDelete';
}
</script>
<?php


include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$query = "SELECT * FROM property WHERE propertyID =".$_GET["propertyID"];
$result = $conn->query(($query));
$row = $result->fetch_assoc();

$strAction = $_GET["Action"];

switch($strAction)
{
    case "VIEW":
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

        //gets the properties features
        $proID = $_GET["propertyID"];
        $propertyFeatures = $conn->query("SELECT f.featureID featID, f.featureName name, pf.propertyID propID, 
        pf.description FROM  feature f JOIN (SELECT * FROM property_feature WHERE propertyID = $proID) pf
    ON f.featureID=pf.featureID ORDER BY f.featureName;");

        ?>
        <div class="container">
            <h1>Property Details</h1>
            <table>
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
                    <th>Listing Date:</th>
                    <td><?php echo date("d/m/Y",strtotime($row["listingDate"]))?></td>
                </tr>
                <tr>
                    <th>Listing Price:</th>
                    <td><?php echo "$".number_format($row["listingPrice"],2)?></td>
                </tr>
                <tr>
                    <th>Sale Date:</th>
                    <td><?php echo soldDateCheck($row["saleDate"])?></td>
                </tr>
                <tr>
                    <th>Sale Price:</th>
                    <td><?php echo soldPriceCheck($row["salePrice"])?></td>
                </tr>
                <tr>
                    <th>Image:</th>
                    <td><?php echo $row["imageName"]?></td>
                </tr>
                <tr>
                    <th>Description:</th>
                    <td><?php echo $row["description"]?></td>
                </tr>

            </table>
        </div>
        <br>
        <div class="container">
            <h3>Property Features</h3>
            <table>
                <tr>
                    <th>Feature</th>
                    <th>Description</th>

                </tr>
                <?php
                while ($Features= $propertyFeatures->fetch_assoc())
                { ?>
                    <tr>
                        <td><?php echo $Features["name"]?></td>
                        <td><?php echo $Features["description"]?></td>
                    </tr>


                    <?php
                }
                ?>

            </table>
        </div>
        <br>
        <div class="container">
            <form>
                <input type = "button" value="Return to List" OnClick="window.location='displayProperties.php'">
            </form>
        </div>

    <?php
        break;


    case "UPDATE":
        $propertyTypes = $conn->query("SELECT * FROM type ORDER BY typeName");
        $proID = $_GET["propertyID"];
        $propertyFeatures = $conn->query("SELECT f.featureID featID, f.featureName name, pf.propertyID propID, pf.description FROM  feature f LEFT OUTER JOIN (SELECT * FROM property_feature WHERE propertyID = $proID) pf
    ON f.featureID=pf.featureID ORDER BY f.featureName;");
        $clientNames = $conn->query("SELECT clientID, gName, fName FROM client ORDER BY fName");


        ?>
        <form method="post" enctype="multipart/form-data" action="propertyModify.php?propertyID=<?php echo $_GET["propertyID"]; ?>&Action=ConfirmUpdate">
            <div class="container">
                <h1>Property Details Update</h1>
                <table>
                    <tr>
                        <th>Seller:</th>
                        <td><Select Name = "name" required
                                    onInvalid="verifyEntry(this, 'Seller');"
                                    onInput="verifyEntry(this, 'Seller');">
                                <option value=""></option>
                                <?php
                                while ($Client= $clientNames->fetch_assoc())
                                {
                                    ?>
                                    <option value="<?php echo $Client["clientID"]; ?>"<?php echo fSelect($row["sellerID"],$Client["clientID"]); ?>>
                                        <?php echo $Client["gName"]." ".$Client["fName"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </Select></td>
                    </tr>
                    <tr>
                        <th>Property Type:</th>
                        <td><Select Name = "type" required
                                    onInvalid="verifyEntry(this, 'Property Type');"
                                    onInput="verifyEntry(this, 'Property Type');">
                                <option value=""></option>
                                <?php
                                while ($Type= $propertyTypes->fetch_assoc())
                                {
                                    ?>
                                    <option value="<?php echo $Type["typeID"]; ?>"<?php echo fSelect($row["propertyType"],$Type["typeID"]); ?>>
                                        <?php echo $Type["typeName"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </Select></td>
                    </tr>
                    <tr>
                        <th>Unit Number:</th>
                        <td><input type="text" name="unitNum" size="10" value="<?php echo $row["unitNum"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Street Number:</th>
                        <td><input type="text" name="streetNum" size="10" value="<?php echo $row["streetNum"]; ?>" required
                                   onInvalid="verifyEntry(this, 'Street Number');"
                                   onInput="verifyEntry(this, 'Street Number');"></td>
                    </tr>
                    <tr>
                        <th>Street Name:</th>
                        <td><input type="text" name="street" size="50" value="<?php echo $row["street"]; ?>" required
                                   onInvalid="verifyEntry(this, 'Street');"
                                   onInput="verifyEntry(this, 'Street');"></td>
                    </tr>
                    <tr>
                        <th>Suburb:</th>
                        <td><input type="text" name="suburb" size="50" value="<?php echo $row["suburb"]; ?>" required
                                   onInvalid="verifyEntry(this, 'Suburb');"
                                   onInput="verifyEntry(this, 'Suburb');"></td>
                    </tr>
                    <tr>
                        <th>State:</th>
                        <td>
                        <Select Name = "state" required
                                onInvalid="verifyEntry(this, 'State');"
                                onInput="verifyEntry(this, 'State');">
                            <option value=""></option>
                            <option value="ACT" <?php echo fSelect($row["state"],'ACT'); ?>>ACT</option>
                            <option value="NSW" <?php echo fSelect($row["state"],'NSW'); ?>>NSW</option>
                            <option value="NT" <?php echo fSelect($row["state"],'NT'); ?>>NT</option>
                            <option value="QLD" <?php echo fSelect($row["state"],'QLD'); ?>>QLD</option>
                            <option value="SA" <?php echo fSelect($row["state"],'SA'); ?>>SA</option>
                            <option value="TAS" <?php echo fSelect($row["state"],'TAS'); ?>>TAS</option>
                            <option value="VIC" <?php echo fSelect($row["state"],'VIC'); ?>>VIC</option>
                            <option value="WA" <?php echo fSelect($row["state"],'WA'); ?>>WA</option>
                        </Select></td>
                    </tr>

                    <tr>
                        <th>Postcode:</th>
                        <td><input type="text" name="postcode" size="15" value="<?php echo $row["postcode"]; ?>" required
                                   onInvalid="verifyEntry(this, 'Postcode');"
                                   onInput="verifyEntry(this, 'Postcode');"></td>
                    </tr>
                    <tr>
                        <th>Listing Date:</th>
                        <td><input type="date" name="listingDate" value="<?php echo $row["listingDate"]; ?>" required
                                   onInvalid="verifyEntry(this, 'Listing Date');"
                                   onInput="verifyEntry(this, 'Listing Date');"></td>
                    </tr>
                    <tr>
                        <th>Listing Price:</th>
                        <td><input type="text" name="listingPrice" size="20" value="<?php echo $row["listingPrice"]; ?>" required
                                   onInvalid="verifyEntry(this, 'Listing Price');"
                                   onInput="verifyEntry(this, 'Listing Price');"></td>
                    </tr>
                    <tr>
                        <th>Sale Date:</th>
                        <td><input type="date" name="saleDate" value="<?php echo $row["saleDate"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Sale Price:</th>
                        <td><input type="text" name="salePrice" size="20" value="<?php echo $row["salePrice"]; ?>"></td>
                    </tr>
                    <tr>
                        <th>Current Image:</th>
                        <td><?php echo $row["imageName"]; ?> Delete Image?<input type="checkbox" name="deleteImage" value="Y"> </td>
                    </tr>
                    <tr>
                        <th valign="top" >New Image:</th>
                        <td><input type="file" name="imageName" size="50"> <br>WARNING: Successfully uploading a new image will delete the old one.</td>
                    </tr>
                    <tr>
                        <th valign="top" >Description:</th>
                        <td valign="top" align="left">
                            <textarea cols="55" name="propDesc" rows="5" ><?php echo $row["description"]; ?></textarea>
                        </td>
                    </tr>
                </table>
            </div>
            <br>
            <div class="container">
                <h3>Features</h3>
                <table>
                    <tr>
                        <th>Feature</th>
                        <th>Description</th>
                        <th>Available</th>
                    </tr>
                    <?php
                    while ($Features= $propertyFeatures->fetch_assoc())
                    { ?>
                        <tr>
                            <td><?php echo $Features["name"]?></td>
                            <td><input type="text" name="description[]" size="50" value="<?php echo $Features["description"]; ?>"></td>
                            <td align="center"><input type="checkbox" name="check[]" value="<?php echo $Features["featID"]; ?>" <?php echo isChecked($Features["propID"])?>></td>
                        </tr>


                        <?php
                    }
                    ?>




                </table>
            </div>
            <br>
                <div class="container">
                <table>
                    <tr>
                        <td><input type = "submit" value="Update Property"></td>
                        <td><input type = "button" value="Return to List" OnClick="window.location='displayProperties.php'"></td>
                    </tr>

                </table>
                </div>
            </form>

        <?php
        break;
    case "ConfirmUpdate":
        {
            $imgName=$row["imageName"];


            if (isset($_POST["deleteImage"]))
            {
                unlink("property_images/".$row["imageName"]);
                $imgName="";
            }

            if($_FILES["imageName"]["type"] == "image/png" ||
                $_FILES["imageName"]["type"] == "image/jpeg" ||
                $_FILES["imageName"]["type"] == "image/bmp" )
            {
                $upFile = "property_images/".$_FILES["imageName"]["name"];

                if (!empty($_FILES["imageName"]["name"]))
                {
                    if(!move_uploaded_file($_FILES["imageName"] ["tmp_name"], $upFile))
                    {
                        echo "ERROR: Could not move image into directory";
                        $imgName="";
                    }
                    else {

                        $imgName=$_FILES["imageName"]["name"];
                        unlink("property_images/".$row["imageName"]);
                        $imgName="";

                    }
                }
            }

            $newStreet=ucwords(strtolower($_POST["street"]));
            $newSuburb=ucwords(strtolower($_POST["suburb"]));


            $query="UPDATE property set unitNum='$_POST[unitNum]', 
            streetNum='$_POST[streetNum]', street='$newStreet', 
            suburb='$newSuburb', state='$_POST[state]', postcode='$_POST[postcode]', sellerID='$_POST[name]',
            propertyType='$_POST[type]', listingDate='$_POST[listingDate]', listingPrice='$_POST[listingPrice]',
            ".saleDateCheck($_POST['saleDate']).salePriceCheck($_POST['salePrice'])." imageName='$imgName', description='$_POST[propDesc]'
            WHERE propertyID =".$_GET["propertyID"];
            $result = $conn->query(($query));
            $query="DELETE FROM property_feature WHERE propertyID =".$_GET["propertyID"];
            $result = $conn->query(($query));

            if (empty($_POST["saleDate"]))
            {
                $query="UPDATE property set saleDate = NULL WHERE propertyID =".$_GET["propertyID"];
                $result = $conn->query(($query));
            }
            if (empty($_POST["salePrice"]))
            {
                $query="UPDATE property set salePrice = NULL WHERE propertyID =".$_GET["propertyID"];
                $result = $conn->query(($query));
            }

            if (isset($_POST["check"]))
            {
                $IDs = array();
                $descriptions = array();
                $featureIDs = $conn->query("SELECT featureID FROM feature ORDER BY featureName;");
                while($featIDs = $featureIDs->fetch_array())
                {
                    $IDs[] = $featIDs["featureID"];
                }

                foreach ($_POST["description"] as $desc)
                {
                    $descriptions[] = $desc;
                }


                foreach ($_POST["check"] as $featID) {

                    $index = array_search($featID, $IDs);


                    $query = "INSERT INTO property_feature (propertyID, featureID, description)
                              VALUES (" . $_GET["propertyID"] . ", " . $featID . ", '$descriptions[$index]')";
                    $result = $conn->query(($query));

                }
            }
            if(empty($_FILES["imageName"]["name"]) ||
                $_FILES["imageName"]["type"] == "image/png" ||
                $_FILES["imageName"]["type"] == "image/jpeg" ||
                $_FILES["imageName"]["type"] == "image/bmp" )
            {
                ?>

                <div class="container">
                    <h4>The property record has been successfully Updated</h4>

                    <input type = "button" value="Return to List" OnClick="window.location='displayProperties.php'">
                </div>

                <?php
            }
            else
            {

                $updateID = $_GET["propertyID"];
                ?>
                <div class="container">
                    <p>The only accepted image types are png, jpeg and bmp.</p>
                    <p>You can upload a new compatible image or add property without the image.</p>

                    <input type = "button" value="Update Without Image" OnClick="window.location='displayProperties.php'">
                    <input type = "button" value="Upload New Image" OnClick="window.location='propertyModify.php?propertyID=<?php echo $updateID; ?>&Action=UPDATE'">
                </div>
                <?php
            }

            // header("Location: displayProperties.php");
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

    unlink("property_images/".$row["imageName"]);
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