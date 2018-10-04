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
 * Time: 10:01 AM
 */

?>

<script language="JavaScript">
    function verifyEntry(textbox, name)
    {
        if(textbox.value=='')
        {
            textbox.setCustomValidity('Please enter a value for the '+name+' field');
        }
        else
        {
            textbox.setCustomValidity('');
        }
        return true;
    }
</script>

<?php
include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$strAction = $_GET["Action"];


switch($strAction)
{
    case "INSERT":
        $propertyTypes = $conn->query("SELECT * FROM type ORDER BY typeName");
        $propertyFeatures = $conn->query("SELECT * FROM  feature ORDER BY featureName;");
        $clientNames = $conn->query("SELECT clientID, gName, fName FROM client ORDER BY fName");
        ?>


        <form method="post" enctype="multipart/form-data" action="propertyAdd.php?Action=ConfirmInsert">
            <div class="container">
                <h2>New Property Details</h2>
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
                                    <option value="<?php echo $Client["clientID"]; ?>">
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
                                    <option value="<?php echo $Type["typeID"]; ?>">
                                        <?php echo $Type["typeName"]; ?>
                                    </option>
                                    <?php
                                }
                                ?>
                            </Select></td>
                    </tr>
                    <tr>
                        <th>Unit Number:</th>
                        <td><input type="text" name="unitNum" size="10"></td>
                    </tr>
                    <tr>
                        <th>Street Number:</th>
                        <td><input type="text" name="streetNum" size="10" required
                            onInvalid="verifyEntry(this, 'Street Number');"
                            onInput="verifyEntry(this, 'Street Number');"></td>
                    </tr>
                    <tr>
                        <th>Street Name:</th>
                        <td><input type="text" name="street" size="50" required
                                   onInvalid="verifyEntry(this, 'Street');"
                                   onInput="verifyEntry(this, 'Street');"></td>
                    </tr>
                    <tr>
                        <th>Suburb:</th>
                        <td><input type="text" name="suburb" size="50" required
                                   onInvalid="verifyEntry(this, 'Suburb');"
                                   onInput="verifyEntry(this, 'Suburb');"></td>
                    </tr>
                    <tr>
                        <th>State:</th>

                        <td><Select Name = "state" required
                                    onInvalid="verifyEntry(this, 'State');"
                                    onInput="verifyEntry(this, 'State');">
                                <option value=""></option>
                                <option value="ACT">ACT</option>
                                <option value="NSW">NSW</option>
                                <option value="NT">NT</option>
                                <option value="QLD">QLD</option>
                                <option value="SA">SA</option>
                                <option value="TAS">TAS</option>
                                <option value="VIC">VIC</option>
                                <option value="WA">WA</option>
                                </Select></td>
                    </tr>

                    <tr>
                        <th>Postcode:</th>
                        <td><input type="text" name="postcode" size="15" required
                                   onInvalid="verifyEntry(this, 'Postcode');"
                                   onInput="verifyEntry(this, 'Postcode');"></td>
                    </tr>
                    <tr>
                        <th>Listing Date:</th>
                        <td><input type="date" name="listDate" required
                                   onInvalid="verifyEntry(this, 'Listing Date');"
                                   onInput="verifyEntry(this, 'Listing Date');"></td>
                    </tr>
                    <tr>
                        <th>Listing Price:</th>
                        <td><input type="text" name="listPrice" size="20" required
                                   onInvalid="verifyEntry(this, 'Listing Price');"
                                   onInput="verifyEntry(this, 'Listing Price');"></td>
                    </tr>
                    <tr>
                        <th>Image:</th>
                        <td><input type="file" name="imageName" size="50"></td>
                    </tr>
                    <tr>
                        <th valign="top" >Description:</th>

                        <td valign="top" align="left">
                            <textarea cols="55" name="propDesc" rows="5"></textarea>
                        </td>
                    </tr>
                </table>

            <br>

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
                            <td><?php echo $Features["featureName"]?></td>
                            <td><input type="text" name="description[]" size="50"></td>
                            <td align="center"><input type="checkbox" class="checkbox" name="check[]" value="<?php echo $Features["featureID"]; ?>" ></td>
                        </tr>


                        <?php
                    }
                    ?>




                </table>

            <br>

                <table>
                    <tr>
                        <td><input type = "submit" value="Add Property"></td>
                        <td><input type="button" value="Return to List" OnClick="window.location='displayProperties.php'"></td>
                    </tr>

                </table>
                <br>
                <?php
                $fileName = explode("/",$_SERVER["SCRIPT_FILENAME"]);
                ?>
                <input type = "button" class="codeButton" value="Property Insert" OnClick="window.location='displayCode.php?fileName=<?php echo end($fileName);?>'">

            </div>
        </form>

        <?php
        break;
    case "ConfirmInsert":
        {

        $imgName="";

            if($_FILES["imageName"]["type"] == "image/png" ||
                $_FILES["imageName"]["type"] == "image/jpeg" ||
                $_FILES["imageName"]["type"] == "image/bmp" )
            {

                $imgName=explode(" ",$_FILES["imageName"]["name"]);
                $imgName=implode("_",$imgName);

                $upFile = "property_images/".$imgName;

                if (!empty($_FILES["imageName"]["name"]))
                {
                    if(!move_uploaded_file($_FILES["imageName"] ["tmp_name"], $upFile))
                    {
                        echo "ERROR: Could not move image into directory";
                        $imgName="";
                    }
                    
                }
            }




            $newStreet=ucwords(strtolower($_POST["street"]));
            $newSuburb=ucwords(strtolower($_POST["suburb"]));




            $query = "INSERT INTO property(propertyID, unitNum, streetNum, street, suburb, state, postcode,
            sellerID, listingDate, listingPrice, propertyType, imageName, description) values (propertyID, '$_POST[unitNum]', 
            '$_POST[streetNum]', '$newStreet', '$newSuburb', '$_POST[state]', '$_POST[postcode]', '$_POST[name]',
            '$_POST[listDate]', '$_POST[listPrice]', '$_POST[type]', '$imgName', '$_POST[propDesc]')";
            $result = $conn->query(($query));

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
                              VALUES ((SELECT LAST_INSERT_ID()), " . $featID . ", '$descriptions[$index]')";
                    $result = $conn->query(($query));

                }
            }
            //print property successfully added if worked
            //if bad image direct to property modify



            if(empty($_FILES["imageName"]["name"]) ||
                $_FILES["imageName"]["type"] == "image/png" ||
                $_FILES["imageName"]["type"] == "image/jpeg" ||
                $_FILES["imageName"]["type"] == "image/bmp" )
            {
            ?>

            <div class="container">
                <h4>The property record has been successfully added</h4>

            <input type = "button" value="Return to List" OnClick="window.location='displayProperties.php'">
            </div>

            <?php
            }
            else
                {
                $query = "SELECT LAST_INSERT_ID();";
                $result = $conn->query(($query));
                $insertID = mysqli_fetch_array($result);
                    ?>
<div class="container">
                    <p>The only accepted image types are png, jpeg and bmp.</p>
                    <p>You can upload a new compatible image or add property without the image.</p>

                    <input type = "button" value="Add Without Image" OnClick="window.location='displayProperties.php'">
                    <input type = "button" value="Upload New Image" OnClick="window.location='propertyModify.php?propertyID=<?php echo $insertID[0]; ?>&Action=UPDATE'">
</div>
    <?php
            }

           // header("Location: displayProperties.php");
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
