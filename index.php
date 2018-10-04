<?php
session_start();

?>
<html>
<header>
    
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
 * Time: 1:17 PM
 */




include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB)
or die("Couldn't log on to database");

?>

<body>
<?php
if(!isset($_SESSION["access_status"]))
{
    $_SESSION["access_status"]="";
}




if(!strcmp($_SESSION["access_status"],"granted"))
{
    ?>
    <div class="container">
        <h2>Welcome <?php echo $_SESSION["gName"]." ".$_SESSION["fName"]?></h2>
    </div>
    <?php
}
elseif(empty($_POST["uName"]))
{
?>
    <div class="container">
<?php
    if(!strcmp($_SESSION["access_status"],"denied"))
    {
        ?>
        <p>Login Details Incorrect</p>
        <?php
        $_SESSION["access_status"]="";
    }
    ?>

        <form method="post" action="index.php">
            <table >
                <tr>
                    <th>Username:</th>
                    <td><input type="text" name="uName" size="12" maxlength="10"></td>
                </tr>
                <tr>
                    <th>Password:</th>
                    <td><input type="password" name="pWord" size="12" maxlength="10"></td>
                </tr>
                <tr>
                    <td>
                        <input type="submit" value="Login" name="Action">
                        <input type="reset" value="Reset">
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <?php
}
else
{

    $query="SELECT gName, fName FROM authenticate WHERE uName = '$_POST[uName]' AND pword = '$_POST[pWord]'";

    $result = $conn->query(($query));

    if($result->fetch_array())
    {
        $query="SELECT gName, fName FROM authenticate WHERE uName = '$_POST[uName]' AND pword = '$_POST[pWord]'";

        $result = $conn->query(($query));
        $name = mysqli_fetch_array($result);


        $_SESSION["access_status"] = "granted";
        $_SESSION["gName"]=$name[0];
        $_SESSION["fName"]=$name[1];
        header("Location: index.php");

    }
    else
    {
        $_SESSION["access_status"] = "denied";
        header("Location: index.php");
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

<link rel="stylesheet" href="Ruthless.css">

</body>
</html>