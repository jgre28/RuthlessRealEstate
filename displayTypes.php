<html>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 29/09/2018
 * Time: 10:07 AM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);
$query= "SELECT * FROM type ORDER BY typeName";
$result = $conn->query($query);
?>

<div class="container">
    <h2>Property Types</h2>
    <a href="typeAdd.php?Action=INSERT">Add new type</a>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Type</th>
            <th></th>
            <th></th>
        </tr>

        <?php while ($row = mysqli_fetch_array($result))
        {?>
            <tr>
                <td><?php echo $row["typeName"]?></td>

                <td><a href="typeModify.php?typeID=<?php echo $row["typeID"]; ?>&Action=UPDATE">Update</a></td>
                <td><a href="typeModify.php?typeID=<?php echo $row["typeID"]; ?>&Action=DELETE">Delete</a></td>
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
