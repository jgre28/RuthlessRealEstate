<html>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 28/08/2018
 * Time: 12:16 PM
 */

/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 28/08/2018
 * Time: 11:47 AM
 */

    include("connection.php");
    $conn = new mysqli($HOST, $UName, $PWord, $DB);
    $query= "SELECT * FROM client ORDER BY fName";
    $result = $conn->query($query);
    ?>
<table border="1">
    <th>Property Type</th>
    <?php while ($row = mysqli_fetch_array($result))
    { ?>
        <tr>
            <td><?php echo $row["gName"]?></td>
            <td><?php echo $row["fName"]?></td>
            <td><?php echo $row["unitNum"]?></td>
            <td><?php echo $row["streetNum"]?></td>
            <td><?php echo $row["street"]?></td>
            <td><?php echo $row["suburb"]?></td>
            <td><?php echo $row["state"]?></td>
            <td><?php echo $row["postcode"]?></td>
            <td><?php echo $row["email"]?></td>
            <td><?php echo $row["mobile"]?></td>
            <td><?php echo $row["mailingList"]?></td>

        </tr>

    <?php } ?>

</table>



</body>

</html>