<html>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 28/08/2018
 * Time: 12:16 PM
 */


    include("connection.php");
    $conn = new mysqli($HOST, $UName, $PWord, $DB);
    $query= "SELECT * FROM client ORDER BY fName";
    $result = $conn->query($query);
    ?>
<div class="container">
    <h2>Client Table</h2>
    <table class="table table-striped">
    <th>Client</th>
    <?php while ($row = mysqli_fetch_array($result))
    { ?>
        <tr>
            <td><?php echo $row["gName"]?></td>
            <td><?php echo $row["fName"]?></td>
            <td><?php echo $row["unitNum"]." ".$row["streetNum"]." ".$row["street"].", ".$row["suburb"].", ".$row["state"].", ".$row["postcode"]?></td>

            <td><?php echo $row["email"]?></td>
            <td><?php echo $row["mobile"]?></td>
            <td><?php echo $row["mailingList"]?></td>
            <td><a href="clientModify.php?clientID=<?php echo $row["clientID"]; ?>&Action=UPDATE">Update</a></td>
            <td><a href="clientModify.php?clientID=<?php echo $row["clientID"]; ?>&Action=DELETE">Delete</a></td>

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