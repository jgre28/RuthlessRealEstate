<?php
session_start();

?>

<html>
<header>
    <?php
    if (strcmp($_SESSION["access_status"],"granted")){
        header("Location: index.php");
    }
    ?>


    <div class="header">
        <h1>RUTHLESS REAL ESTATE</h1>
    </div>
    <div class="sideMenu" >


        <table align="center">
            <tr><td><input type="button" class="button" value="Home"  OnClick="window.location='index.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Properties"  OnClick="window.location='displayProperties.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Clients" OnClick="window.location='displayClients.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Property Types"  OnClick="window.location='displayTypes.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Features"  OnClick="window.location='displayFeatures.php'"></td></tr>
            <tr><td><input type="button" class="button" value="Multiple Property"  OnClick="window.location='multipleProperty.php?Action=EDIT'"></td></tr>
            <tr><td><input type="button" class="button" value="Images"  OnClick="window.location='images.php?Action=DISPLAY'"></td></tr>


        </table>

    </div>
</header>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 2/10/2018
 * Time: 8:44 AM
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
            <h2>Send Email</h2>
            <input type = "button" value="Return to Client Listing" OnClick="window.location='displayClients.php'">
            <br>
            <br>

            <table class="table table-striped">
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Recipient</th>
                </tr>

                <?php while ($row = mysqli_fetch_array($result))
                { ?>
                    <tr>
                        <td><?php echo $row["gName"]." ".$row["fName"]?></td>
                        <td><?php echo $row["email"]?></td>

                        <td align="center"><input type="checkbox" class="checkbox" name="check[]" value=<?php echo $row["email"]?> <?php echo isChecked($row["mailingList"])?>></td>

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
    ?>
    <div class="container">
    <?php
    if(mail($to, $subject, $msg, $headers))
    {
        ?>
        <h2>Email Successfully sent</h2>
        <?php
    }
    else
    {
        ?>
        <h2>Error Sending Email</h2>
        <?php
    }
    ?>
    <input type = "button" value="Return to Client Listing" OnClick="window.location='displayClients.php'">
    <input type = "button" value="Send Another Email" OnClick="window.location='sendEmail.php'">

    </div>
<?php
}
?>


<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<script
    src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<script
    src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

<script
    src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

<link rel="stylesheet" href="Ruthless.css">


</body>
</html>
