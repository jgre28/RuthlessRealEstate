<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 11/09/2018
 * Time: 11:27 AM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$strAction = $_GET["Action"];


switch($strAction)
{
    case "INSERT":
        $propertyTypes = $conn->query("SELECT * FROM type ORDER BY typeName");
        $propertyFeatures = $conn->query("SELECT * FROM  feature f LEFT OUTER JOIN (SELECT * FROM property_feature) pf
    ON f.featureID=pf.featureID ORDER BY f.featureName;");
        $clientNames = $conn->query("SELECT clientID, gName, fName FROM client ORDER BY fName");

        ?>
    <div class="container">
        <form method="post" action="propertyAdd.php?Action=ConfirmInsert">
            <h1>Property Details</h1>
            <table>
                <tr>
                    <td>Unit Number</td>
                    <td><input type="text" name="unitNum" size="50"></td>
                </tr>
                <tr>
                    <td>Street Number</td>
                    <td><input type="text" name="streetNum" size="50"></td>
                </tr>
                <tr>
                    <td>Street Name</td>
                    <td><input type="text" name="street" size="50"></td>
                </tr>
                <tr>
                    <td>Suburb</td>
                    <td><input type="text" name="suburb" size="50"></td>
                </tr>
                <tr>
                    <td>State</td>
                    <td><input type="text" name="state" size="50"></td>
                </tr>

                <tr>
                    <td>Postcode</td>
                    <td><input type="text" name="postcode" size="50"></td>
                </tr>
                <tr>
                    <td>Type</td>
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
                    <td>Listing Date</td>
                    <td><input type="date" name="listDate" ></td>
                </tr>

                <tr>
                    <td>Listing Price</td>
                    <td><input type="text" name="listPrice" size="50"></td>
                </tr>
                <tr>
                    <td>Image Name</td>
                    <td><input type="text" name="imageName" size="50"></td>
                </tr>
                <tr>
                    <td>Description</td>
                    <td><input type="text" name="description" size="50" height="50"></td>
                </tr>
            </table>
            <h3>Seller</h3>
            <table>
               <tr>
                   <td>Name</td>
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
            </table>
            <h3>Features</h3>
            <table>
                <?php
                //when updating features, delete all existing and add all checked for specific property
                while ($Features= $propertyFeatures->fetch_assoc())
                { ?>
                    <tr>
                        <td><?php echo $Features["featureName"]?></td>
                        <td><input type="text" name="description" size="50"></td>
                    </tr>


                    <?php
                }
                ?>




            </table>

            <table>
                <tr>
                    <td><input type = "submit" value="Add Property"></td>
                    <td><input type="button" value="Return to List" OnClick="window.location='displayProperties.php'"></td>
                </tr>

            </table>
        </form>
    </div>
<?php
        break;
    case "ConfirmInsert":
        {
            $query="INSERT INTO property(propertyID, unitNum, streetNum, street, suburb, state, postcode,
            sellerID, listingDate, listingPrice, propertyType) values (propertyID, '$_POST[unitNum]', 
            '$_POST[streetNum]', '$_POST[street]', '$_POST[suburb]', '$_POST[state]', '$_POST[postcode]', '$_POST[name]',
            '$_POST[listDate]', '$_POST[listPrice]', '$_POST[type]')";
            $result = $conn->query(($query));
            header("Location: displayProperties.php");
        }
        break;
}?>