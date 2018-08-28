<html>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 28/08/2018
 * Time: 11:47 AM
 */

    include("connection.php");
    $conn = new mysqli($HOST, $UName, $PWord, $DB);
    $query= "SELECT * FROM type ORDER BY typeName";
    $result = $conn->query($query);
    ?>
<table border="1">
    <th>Property Type</th>
    <?php while ($row = mysqli_fetch_array($result))
    { ?>
        <tr><td><?php echo $row["typeName"]?></td></tr>

    <?php } ?>

</table>



</body>

</html>