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
            <tr><td><input type="button" class="button" value="Documentation"  OnClick="window.location='documentation.php'"></td></tr>


        </table>

    </div>
</header>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 5/10/2018
 * Time: 8:21 AM
 */

?>

<div class="container">
    <h2>Documentation Page</h2>
    <table class="table2 table-striped table-bordered">
        <tr>
            <th>Name</th>
            <th>Student ID</th>
        </tr>
        <tr>
            <td>Jordan Gregory</td>
            <td>25099159</td>
        </tr>
        <tr>
            <td>Peter Paxinos</td>
            <td>27023737</td>
        </tr>
    </table>


<p><b>Date Submitted:</b> 05/10/2018</p>
<p><b>MySQL Database account used</b>
    <table class="table2 table-striped table-bordered">
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <tr>
            <td>s25099159</td>
            <td>monash00</td>
        </tr>
    </table>
    </p>

    <p><b>Website user account</b>
    <table class="table2 table-striped table-bordered">
        <tr>
            <th>Username</th>
            <th>Password</th>
        </tr>
        <tr>
            <td>RobinB</td>
            <td>asdf</td>
        </tr>
    </table>
    </p>
    <p><b>Create Table Statements</b><input type = "button" class="button" value="Table Statements" OnClick="window.location='displayCode.php?fileName=createTables.ddl'">
    </p>

    </p>
    <p><b>Database Data</b><input type = "button" class="button" value="Data" OnClick="window.location='databaseTables.php'">
    </p>

    <p><b>Group MemberParticipation</b>
    <table class="table2 table-striped table-bordered">
        <tr>
            <th>Component</th>
            <th>Jordan</th>
            <th>Peter</th>
        </tr>
        <tr>
            <td>Property Pages</td>
            <td>60%</td>
            <td>40%</td>
        </tr>
        <tr>
            <td>Property Feature Modification</td>
            <td>80%</td>
            <td>20%</td>
        </tr>
        <tr>
            <td>Client Pages</td>
            <td>50%</td>
            <td>50%</td>
        </tr>
        <tr>
            <td>Email Functionality</td>
            <td>50%</td>
            <td>50%</td>
        </tr>
        <tr>
            <td>PDF Creation</td>
            <td>60%</td>
            <td>40%</td>
        </tr>
        <tr>
            <td>Type Pages</td>
            <td>50%</td>
            <td>50%</td>
        </tr>
        <tr>
            <td>Feature Pages</td>
            <td>50%</td>
            <td>50%</td>
        </tr>
        <tr>
            <td>Multiple Property Modification Page</td>
            <td>70%</td>
            <td>30%</td>
        </tr>
        <tr>
            <td>Images Page</td>
            <td>70%</td>
            <td>30%</td>
        </tr>
        <tr>
            <td>Security</td>
            <td>50%</td>
            <td>50%</td>
        </tr>
        <tr>
            <td>CSS styling</td>
            <td>50%</td>
            <td>50%</td>
        </tr>




    </table>
    </p>



</div>

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
