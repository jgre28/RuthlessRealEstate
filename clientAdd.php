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
 * Date: 30/09/2018
 * Time: 2:08 PM
 */

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

$strAction = $_GET["Action"];


switch($strAction)
{
    case "INSERT":

        ?>


        <form method="post" action="clientAdd.php?Action=ConfirmInsert">
            <div class="container">
                <h2>New Client Details</h2>
                <table>
                    <tr>
                        <th>Given Name:</th>
                        <td><input type="text" name="gName" size="50"></td>
                    </tr>
                    <tr>
                        <th>Family Name:</th>
                        <td><input type="text" name="fName" size="50"></td>
                    </tr>
                    <tr>
                        <th>Unit Number:</th>
                        <td><input type="text" name="unitNum" size="50"></td>
                    </tr>
                    <tr>
                        <th>Street Number:</th>
                        <td><input type="text" name="streetNum" size="50"></td>
                    </tr>
                    <tr>
                        <th>Street Name:</th>
                        <td><input type="text" name="street" size="50"></td>
                    </tr>
                    <tr>
                        <th>Suburb:</th>
                        <td><input type="text" name="suburb" size="50"></td>
                    </tr>
                    <tr>
                        <th>State:</th>
                        <td><input type="text" name="state" size="50""></td>
                    </tr>

                    <tr>
                        <th>Postcode:</th>
                        <td><input type="text" name="postcode" size="50"></td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td><input type="text" name="email" size="50"></td>
                    </tr>
                    <tr>
                        <th>Contact:</th>
                        <td><input type="text" name="mobile" size="50"></td>
                    </tr>
                    <tr>
                        <th>Mailing List:</th>
                        <td><input type="checkbox" class="checkbox" name="check" value="Y" ></td>
                    </tr>

                </table>

            <br>


                <table>
                    <tr>
                        <td><input type = "submit" value="Add Client"></td>
                        <td><input type="button" value="Return to List" OnClick="window.location='displayClients.php'"></td>
                    </tr>

                </table>
            </div>
        </form>

        <?php
        break;
    case "ConfirmInsert":
        {

            $mailing="N";
            if (isset($_POST["check"]))
            {
                $mailing=$_POST["check"];
            }



            $query="INSERT INTO client(clientID, gName, fName, unitNum, streetNum, street, suburb, state, postcode, email, mobile, mailingList)
            values (clientID, '$_POST[gName]', '$_POST[fName]', '$_POST[unitNum]', 
            '$_POST[streetNum]', '$_POST[street]', '$_POST[suburb]', '$_POST[state]', '$_POST[postcode]', '$_POST[email]',
            '$_POST[mobile]', '$mailing')";
            $result = $conn->query(($query));



            header("Location: displayClients.php");
        }
        break;
}?>


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
