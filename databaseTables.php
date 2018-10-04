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
 * Time: 9:24 AM
 */

?>
<div class="container">


    <h2>Authenticate Table</h2>
    <table class="table table-striped table-bordered">
        <tr><th>userID</th><th>gName</th><th>fName</th><th>uName</th><th>pword</th></tr>
        <tr><td>1</td><td>Robin</td><td>Bstard</td><td>RobinB</td><td>asdf</td></tr>
        <tr><td>2</td><td>Obiwan</td><td>Kenobi</td><td>ObiwanK</td><td>HelloThere</td></tr>
        <tr><td>3</td><td>General</td><td>Grievous</td><td>GeneralG</td><td>GeneralKenobi</td></tr>
        <tr><td>4</td><td>Bob</td><td>Ross</td><td>test</td><td>test</td></tr></table>

    <h2>Client Table</h2>
    <table class="table table-striped table-bordered">
        <tr><th>clientID</th><th>gName</th><th>fName</th><th>unitNum</th><th>streetNum</th><th>street</th><th>suburb</th><th>state</th><th>postcode</th><th>email</th><th>mobile</th><th>mailingList</th></tr>
        <tr><td>1</td><td>Jordan</td><td>Gregory</td><td></td><td>13</td><td>Fun court</td><td>Rye</td><td>VIC</td><td>3941</td><td>jgre28@student.monash.edu</td><td>0411223344</td><td>Y</td></tr>
        <tr><td>9</td><td>Peter</td><td>Paxinoz</td><td>NULL</td><td>12</td><td>Boring road</td><td>Malvern</td><td>VIC</td><td>3800</td><td>papax1@student.monash.edu</td><td>0422334455</td><td>Y</td></tr>
        <tr><td>10</td><td>Tony</td><td>Stark</td><td>4</td><td>17</td><td>Avengers road</td><td>Clayton</td><td>VIC</td><td>3900</td><td>tony.stark@gmail.com</td><td>0411111111</td><td>N</td></tr>
        <tr><td>11</td><td>Steve</td><td>Rogers</td><td>NULL</td><td>23</td><td>Avengers road</td><td>Clayton</td><td>VIC</td><td>3900</td><td>steve.O@gmail.com</td><td>0411122222</td><td>N</td></tr></table>

    <h2>Feature Table</h2>
    <table class="table table-striped table-bordered">
        <tr><th>featureID</th><th>featureName</th></tr>
        <tr><td>1</td><td>Pool</td></tr>
        <tr><td>2</td><td>Tennis Court</td></tr>
        <tr><td>3</td><td>Garage</td></tr>
        <tr><td>4</td><td>Spa</td></tr>
        <tr><td>5</td><td>Helipad</td></tr>
        <tr><td>6</td><td>Nuclear Reactor</td></tr>
        <tr><td>7</td><td>Chook Farm</td></tr>
        <tr><td>8</td><td>Elevator</td></tr>
        <tr><td>9</td><td>Bunker</td></tr>
        <tr><td>10</td><td>Observatory</td></tr></table>


    <h2>Property Table</h2>
    <table class="table table-striped table-bordered">
        <tr><th>propertyID</th><th>unitNum</th><th>streetNum</th><th>street</th><th>suburb</th><th>state</th><th>postcode</th><th>sellerID</th><th>listingDate</th><th>listingPrice</th><th>saleDate</th><th>salePrice</th><th>imageName</th><th>description</th><th>propertyType</th></tr>
        <tr><td>1</td><td>0</td><td>16</td><td>Funner Court</td><td>Rye</td><td>VIC</td><td>3941</td><td>1</td><td>2018-08-28</td><td>943000.00</td><td>NULL</td><td>NULL</td><td>My_House.jpg</td><td>very cool house must buy</td><td>1</td></tr>
        <tr><td>2</td><td>2</td><td>18</td><td>Lame Street</td><td>Thneedville</td><td>NSW</td><td>2001</td><td>9</td><td>2018-09-03</td><td>1200000.00</td><td>NULL</td><td>NULL</td><td>rundown-house-ts.jpg</td><td>pretty lame but buy it anyway</td><td>1</td></tr>
        <tr><td>3</td><td>8</td><td>24</td><td>Busy Street</td><td>Industville</td><td>VIC</td><td>3111</td><td>9</td><td>2018-09-03</td><td>12000000.00</td><td>NULL</td><td>NULL</td><td></td><td>the coolest, cheapest factory</td><td>2</td></tr>
        <tr><td>4</td><td>NULL</td><td>18</td><td>Funner Court</td><td>Rye</td><td>VIC</td><td>3941</td><td>10</td><td>2018-09-04</td><td>21600000.00</td><td>NULL</td><td>NULL</td><td></td><td>house with a bunker for when the nuclear reactor next door overloads</td><td>1</td></tr>
        <tr><td>16</td><td>7</td><td>13</td><td>America Lane</td><td>Capn</td><td>VIC</td><td>3231</td><td>11</td><td>2018-09-30</td><td>340000.00</td><td>NULL</td><td>NULL</td><td></td><td>captain americas house</td><td>3</td></tr>
        <tr><td>39</td><td></td><td>8</td><td>Dirty Lane</td><td>Holeville</td><td>VIC</td><td>3073</td><td>1</td><td>2018-10-04</td><td>36.00</td><td>NULL</td><td>NULL</td><td>Good_Hole.jpg</td><td>Very comfortable hole</td><td>9</td></tr></table>


    <h2>Property_Feature Table</h2>
    <table class="table table-striped table-bordered">
        <tr><th>propertyID</th><th>featureID</th><th>description</th></tr>
        <tr><td>1</td><td>1</td><td>solar heated</td></tr>
        <tr><td>1</td><td>2</td><td>grass</td></tr>
        <tr><td>1</td><td>6</td><td>mostly stable</td></tr>
        <tr><td>2</td><td>2</td><td>Next door neighbours but they are never home</td></tr>
        <tr><td>3</td><td>7</td><td>chickens</td></tr>
        <tr><td>4</td><td>9</td><td>comfortable</td></tr>
        <tr><td>39</td><td>1</td><td>When it rains the hole fills up</td></tr>
        <tr><td>39</td><td>9</td><td>Hole is underground</td></tr>
        <tr><td>39</td><td>10</td><td>Can see the stars at night</td></tr></table>


    <h2>Type Table</h2>
    <table class="table table-striped table-bordered">

        <tr><th>typeID</th><th>typeName</th></tr>
        <tr><td>1</td><td>House</td></tr>
        <tr><td>2</td><td>Factory</td></tr>
        <tr><td>3</td><td>Apartment</td></tr>
        <tr><td>4</td><td>Shop</td></tr>
        <tr><td>5</td><td>Warehouse</td></tr>
        <tr><td>9</td><td>Hole</td></tr></table>


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

