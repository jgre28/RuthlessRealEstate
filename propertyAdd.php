<html>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 30/09/2018
 * Time: 10:01 AM
 */

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


        <form method="post" action="propertyAdd.php?Action=ConfirmInsert">
            <div class="container">
                <h1>New Property Details</h1>
                <table>
                    <tr>
                        <th>Seller</th>
                        <td><Select Name = "name">
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
                        <th>Type</th>
                        <td><Select Name = "type">
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
                        <th>Unit Number</th>
                        <td><input type="text" name="unitNum" size="50"></td>
                    </tr>
                    <tr>
                        <th>Street Number</th>
                        <td><input type="text" name="streetNum" size="50"></td>
                    </tr>
                    <tr>
                        <th>Street Name</th>
                        <td><input type="text" name="street" size="50"></td>
                    </tr>
                    <tr>
                        <th>Suburb</th>
                        <td><input type="text" name="suburb" size="50"></td>
                    </tr>
                    <tr>
                        <th>State</th>
                        <td><input type="text" name="state" size="50""></td>
                    </tr>

                    <tr>
                        <th>Postcode</th>
                        <td><input type="text" name="postcode" size="50"></td>
                    </tr>
                    <tr>
                        <th>Listing Date</th>
                        <td><input type="date" name="listDate" ></td>
                    </tr>
                    <tr>
                        <th>Listing Price</th>
                        <td><input type="text" name="listPrice" size="50"></td>
                    </tr>
                    <tr>
                        <th>Image Name</th>
                        <td><input type="text" name="imageName" size="50"></td>
                    </tr>
                    <tr>
                        <th>Description</th>
                        <td><input type="text" name="propDesc" size="50" height="50"></td>
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
                            <td><?php echo $Features["featureName"]?></td>
                            <td><input type="text" name="description[]" size="50"></td>
                            <td align="center"><input type="checkbox" name="check[]" value="<?php echo $Features["featureID"]; ?>" ></td>
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
                        <td><input type = "submit" value="Add Property"></td>
                        <td><input type="button" value="Return to List" OnClick="window.location='displayProperties.php'"></td>
                    </tr>

                </table>
            </div>
        </form>

        <?php
        break;
    case "ConfirmInsert":
        {
            $query="INSERT INTO property(propertyID, unitNum, streetNum, street, suburb, state, postcode,
            sellerID, listingDate, listingPrice, propertyType, imageName, description) values (propertyID, '$_POST[unitNum]', 
            '$_POST[streetNum]', '$_POST[street]', '$_POST[suburb]', '$_POST[state]', '$_POST[postcode]', '$_POST[name]',
            '$_POST[listDate]', '$_POST[listPrice]', '$_POST[type]', '$_POST[imageName]', '$_POST[propDesc]')";
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

            //header("Location: displayProperties.php");
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
