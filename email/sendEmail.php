<html>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 18/09/2018
 * Time: 11:27 AM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);
$query= "SELECT gName, fName, email, mailingList FROM client ORDER BY fName";
$result = $conn->query($query);
?>

<div class="container">
    <h2>Send email</h2>
    <table class="table table-striped">
    <?php while ($row = mysqli_fetch_array($result))
    { ?>
        <tr>
            <td><?php echo $row["gName"]?></td>
            <td><?php echo $row["fName"]?></td>
            <td><?php echo $row["email"]?></td>

            <td><?php echo $row["mailingList"]?></td>

        </tr>
    <?php } ?>
    </table>

    <?php


if (!isset($_POST["to"]))
{
    ?>

    <form method="post" action="sendEmail.php">
        <table border="0" width="100%">
            <tr>
                <td>To</td>
                <td><input type="text" name="to" size="45"></td>
            </tr>
            <tr>
                <td>Subject</td>
                <td><input type="text" name="subject" size="45"></td>
            </tr>
            <tr>
                <td>Message</td>
                <td valign="top" align="left">
                    <textarea cols="68" name="message" rows="9"></textarea>
                </td>
            </tr>
            <tr>
                <td colspan="2"><br /><br /><input type="submit" value="Send Email">
                    <input type="reset" value="Reset">
                </td>
            </tr>
        </table>
    </form>

<?php
}
else
{
    $from = "Jordan <jgre28@student.monash.edu.au>";
    $to = $_POST["to"];
    $msg = $_POST["message"];
    $subject = $_POST["subject"];
    if(mail($to, $subject, $msg, $from))
    {
        echo "Mail Sent";
    }
    else
    {
        echo "Error Sending Mail";
    }
}
?>
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
