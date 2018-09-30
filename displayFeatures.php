<html>
<body>


<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 30/09/2018
 * Time: 3:14 PM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);
$query= "SELECT * FROM feature ORDER BY featureName";
$result = $conn->query($query);
?>

<div class="container">
    <h2>Property Feature Types</h2>
    <a href="featureAdd.php?Action=INSERT">Add New Feature Type</a>
    <table class="table table-striped table-bordered">
        <tr>
            <th>Feature</th>
            <th></th>
            <th></th>
        </tr>

        <?php while ($row = mysqli_fetch_array($result))
        {?>
            <tr>
                <td><?php echo $row["featureName"]?></td>

                <td><a href="featureModify.php?featureID=<?php echo $row["featureID"]; ?>&Action=UPDATE">Update</a></td>
                <td><a href="featureModify.php?featureID=<?php echo $row["featureID"]; ?>&Action=DELETE">Delete</a></td>
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
