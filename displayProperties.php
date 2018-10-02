<html>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 3/09/2018
 * Time: 1:21 PM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);

?>
<div class="container">
    <h2>Properties Table</h2>
    <form method="post" action="displayProperties.php">
    <table>
        <tr>

            <td><input type="text" name="search" size="45" value="<?php if (isset($_POST["search"])) echo $_POST["search"]; ?>"></td>
            <td><input type="submit" value="Search"></td>
            <td><input type="button" value="Reset Search" OnClick="window.location='displayProperties.php'"></td>
        </tr>
    </table>
        <table>
        <tr>
            <th>Search By:</th>
            <td><input type="radio" name="searchCriteria" value="propertyType"
                    <?php if (!isset($_POST["searchCriteria"]) || $_POST["searchCriteria"]=="propertyType") echo "checked";?>>Property Type</td>
            <td><input type="radio" name="searchCriteria" value="suburb"
                    <?php if (isset($_POST["searchCriteria"]) && $_POST["searchCriteria"]=="suburb") echo "checked";?>>Suburb</td>


        </tr>
    </table>

    </form>

    <?php
    if (empty($_POST["search"]))
    {
        $query= "SELECT * FROM property ORDER BY listingDate";
        $result = $conn->query($query);
    }
    else
    {


        if($_POST["searchCriteria"]=="propertyType")
        {
            $typeSearchTerm=ucwords(strtolower($_POST["search"]));

            $query= "SELECT typeID FROM type WHERE typeName='$typeSearchTerm'";
            $typeResult=$conn->query($query);

            if($typeResult->fetch_array())
            {
                $typeSearch = mysqli_fetch_array($conn->query($query));


                $query= "SELECT * FROM property WHERE propertyType=$typeSearch[0] ORDER BY listingDate ";
                $result = $conn->query($query);
                ?>
                <p>You Searched for the property type <?php echo $typeSearchTerm?></p>
                <?php
            }
            else{
                ?>
                <p>Property type <?php echo $typeSearchTerm?> does not exist</p>

                <?php
                $query= "SELECT * FROM property ORDER BY listingDate";
                $result = $conn->query($query);

            }
        }
        else
        {
            $subSearch=ucwords(strtolower($_POST["search"]));
            $query= "SELECT * FROM property WHERE  suburb = '$subSearch' ORDER BY listingDate ";
            $result = $conn->query($query);

            if($result->fetch_array()) {
                ?>
                <p>You Searched in the suburb <?php echo $subSearch ?></p>
                <?php
                $query= "SELECT * FROM property WHERE  suburb = '$subSearch' ORDER BY listingDate ";
                $result = $conn->query($query);
            }
            else{
                ?>
                <p>No Properties available in the suburb <?php echo $subSearch?></p>

                <?php
                $query= "SELECT * FROM property ORDER BY listingDate";
                $result = $conn->query($query);

            }

        }
        ?>



    <?php
    }


        ?>
    <a href="propertyAdd.php?Action=INSERT">Add New Property</a>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Listing Date</th>
            <th>Listing Price</th>
            <th>Property Type</th>
            <th>Address</th>
            <th>Seller</th>
            <th>Image</th>
            <th>Description</th>
            <th></th>
            <th></th>
            <th></th>


        </tr>
        <?php while ($row = mysqli_fetch_array($result))
        {
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

            <tr>
                <td><?php echo date("d/m/Y",strtotime($row["listingDate"]))?></td>
                <td><?php echo "$".$row["listingPrice"]?></td>
                <td><?php echo $typeName[0]?></td>
                <td><?php echo $address?></td>
                <td><?php echo $sellerName[0]." ".$sellerName[1]?></td>
                <td><?php echo $row["imageName"]?></td>
                <td><?php echo $row["description"]?></td>

                <td><a href="propertyModify.php?propertyID=<?php echo $row["propertyID"]; ?>&Action=VIEW">View</a></td>
                <td><a href="propertyModify.php?propertyID=<?php echo $row["propertyID"]; ?>&Action=UPDATE">Update</a></td>
                <td><a href="propertyModify.php?propertyID=<?php echo $row["propertyID"]; ?>&Action=DELETE">Delete</a></td>

            </tr>
        <?php } ?>
    </table>
</div>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

</body>
</html>
