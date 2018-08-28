<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 28/08/2018
 * Time: 12:41 PM
 */
?>
<script language="javascript">
    function confirmDelete()
    {
        window.location='clientModify.php?clientID=<?php echo $_GET["clientID"]; ?>&Action=ConfirmDelete';
    }
</script>

<?php    include("connection.php");
    $conn = new mysqli($HOST, $UName, $PWord, $DB)
    or die("Couldn't log on to database");

    $query = "SELECT * FROM client WHERE clientID =".$_GET["clientID"];
    $result = $conn->query(($query));
    $row = $result->fetch_assoc();

    $strAction = $_GET["Action"];

    switch($strAction)
    {
        case "UPDATE":
        ?>
        <form method="post" action="clientModify.php?clientID=<?php echo $_GET["clientID"]; ?>&Action=ConfirmUpdate">
            <h1>Client details update</h1>
            <table>
                <tr>
                    <td>first name</td>
                    <td><input type="text" name="gName" size="50" value="<?php echo $row["gName"]; ?>"></td>
                </tr>
                <tr>
                    <td><input type = "submit" value="Update Client"></td>
                    <td><input type="button" value="Return to List" OnClick="window.location='displayClient.php'"></td>
                </tr>

            </table>
        </form>
        <?php
        break;

        case "ConfirmUpdate":
            {
                $query="UPDATE client set gName='$_POST[gName]' WHERE clientID =".$_GET["clientID"];
                $result = $conn->query(($query));
                header("Location: displayClient.php");
            }
            break;
        case "DELETE":
            ?>
            <h1>Confirm deletion of the following customer record</h1>
                <tr>
                    <td><b>Name</b></td>
                    <td><?php echo $row["gName"]." ".$row["fName"]; ?></td>
                </tr>
            </table>
            <br/>
            <table align="center">
                <tr>
                    <td><input type="button" value="Confirm" OnClick="confirmDelete();">
                    <td><input type="button" value="Cancel" OnClick="window.location='displayClient.php'"></td>
                </tr>
            </table>
            <?php
            break;

        case "ConfirmDelete":
            $query="DELETE FROM client WHERE clientID =".$_GET["clientID"];
            $result = $conn->query(($query));
            header("Location: displayClient.php");
 } ?>
