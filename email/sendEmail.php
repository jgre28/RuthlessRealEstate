<html>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 18/09/2018
 * Time: 11:27 AM
 */

function isChecked($var)
{
    $checked = "";
    if($var == "Y")
    {

        $checked = "checked";
    }

    return $checked;
}

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);
$query= "SELECT gName, fName, email, mailingList FROM client ORDER BY fName";
$result = $conn->query($query);

ini_set('SMTP', "smtp.monash.edu.au");
ini_set('sendmail_from', "jgre28@student.monash.edu");



if ((empty($_POST["subject"])) || (empty($_POST["message"])))
{
    ?>

    <form method="post" action="sendEmail.php">
        <div class="container">
            <h2>Send email</h2>
        <table class="table table-striped">
            <?php while ($row = mysqli_fetch_array($result))
            { ?>
                <tr>
                    <td><?php echo $row["gName"]?></td>
                    <td><?php echo $row["fName"]?></td>
                    <td><?php echo $row["email"]?></td>

                    <td align="center"><input type="checkbox" name="check[]" value=<?php echo $row["email"]?> <?php echo isChecked($row["mailingList"])?>></td>

                </tr>
            <?php } ?>
        </table>

        <table border="0" width="100%">
            <tr>
                <th>From:</th>
                <td>Ruthless Real Estate</td>
            </tr>
            <tr>
                <th>Subject:</th>
                <td><input type="text" name="subject" size="45"></td>
            </tr>
            <tr>
                <th>Message:</th>
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
        </div>
    </form>

<?php
}
else
{

    $bcc="";
    if (isset($_POST["check"]))
    {
        $bcc="Bcc:";
        foreach ($_POST["check"] as $email) {

            $bcc = $bcc." ".$email.",";

        }
        $bcc=substr($bcc, 0, -1);
    }


    $to = "Ruthless Real Estate <jgre28@student.monash.edu.au>";
    $msg = $_POST["message"];
    $subject = $_POST["subject"];
    $headers = "From: Ruthless Real Estate <jgre28@student.monash.edu.au>"."\r\n".$bcc;

    if(mail($to, $subject, $msg, $headers))
    {
        echo "Mail Sent";
    }
    else
    {
        echo "Error Sending Mail";
    }
}
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<script
        src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script
        src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script
        src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>


</body>
</html>
