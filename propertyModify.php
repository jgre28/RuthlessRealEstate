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

function isChecked($var)
{
    $checked = "";
    if(!empty($var))
    {

        $checked = "checked";
    }

    return $checked;
}
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
        $propertyTypes = $conn->query("SELECT * FROM type ORDER BY typeName");
        $proID = $_GET["propertyID"];
        $propertyFeatures = $conn->query("SELECT f.featureID featID, f.featureName name, pf.propertyID propID, pf.description FROM  feature f LEFT OUTER JOIN (SELECT * FROM property_feature WHERE propertyID = $proID) pf
    ON f.featureID=pf.featureID ORDER BY f.featureName;");

        ?>
        <div class="container">
            <form method="post" action="propertyModify.php?propertyID=<?php echo $_GET["propertyID"]; ?>&Action=ConfirmUpdate">
                <h1>Property Details Update</h1>
                <table>
                    <tr>
                        <td>Unit Number</td>
                        <td><input type="text" name="unitNum" size="50" value="<?php echo $row["unitNum"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Street Number</td>
                        <td><input type="text" name="streetNum" size="50" value="<?php echo $row["streetNum"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Street Name</td>
                        <td><input type="text" name="street" size="50" value="<?php echo $row["street"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Suburb</td>
                        <td><input type="text" name="suburb" size="50" value="<?php echo $row["suburb"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>State</td>
                        <td><input type="text" name="state" size="50" value="<?php echo $row["state"]; ?>"></td>
                    </tr>

                    <tr>
                        <td>Postcode</td>
                        <td><input type="text" name="postcode" size="50" value="<?php echo $row["postcode"]; ?>"></td>
                    </tr>
                    <tr>
                        <td>Type</td>
                        <td><Select Name = "type">
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
                </table>
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

                <table>
                    <tr>
                        <td><input type = "submit" value="Update Property"></td>
                        <td><input type = "button" value="Return to List" OnClick="window.location='displayProperties.php'"></td>
                    </tr>

                </table>
            </form>
        </div>
        <?php
        break;
    case "ConfirmUpdate":
        {
            $query="UPDATE property set unitNum='$_POST[unitNum]', 
            streetNum='$_POST[streetNum]', street='$_POST[street]', 
            suburb='$_POST[suburb]', state='$_POST[state]', postcode='$_POST[postcode]', 
            propertyType='$_POST[type]'
            WHERE propertyID =".$_GET["propertyID"];
            $result = $conn->query(($query));
            $query="DELETE FROM property_feature WHERE propertyID =".$_GET["propertyID"];
            $result = $conn->query(($query));

            //foreach ($_POST["description"] as $desc)
            //{
              //  echo $desc."hi\n";

            //}


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
                    //echo $_POST["description"];
                    //find description indexes to include
                    //echo $featID."\n";

                    $index = array_search($featID, $IDs);
                    echo $index."\n";

                    echo $query = "INSERT INTO property_feature (propertyID, featureID, description)
                              VALUES (" . $_GET["propertyID"] . ", " . $featID . ", '$descriptions[$index]')";
                    $result = $conn->query(($query));

                }
            }
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