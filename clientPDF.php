<html>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: Jordan
 * Date: 4/10/2018
 * Time: 4:45 PM
 */
require "vendor/autoload.php";
class CreatePDF
{
    function clientPDF($header, $headerWidth, $data)
    {
        define ('K_PATH_IMAGES', 'images/');
        // create new PDF document
        $pdf = new TCPDF('L', 'mm', 'A4', true);

        // set document header information. This appears at the top of each page of the PDF document
        $pdf->SetHeaderData(null, null, "Ruthless Real Estate Client List", '');

        // set header and footer fonts
        $pdf->setHeaderFont(array('helvetica', 'B', 16));

        //set margins
        //$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        //$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);

        //set image scale factor
        //$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

        // add a page
        $pdf->AddPage();

        $pdf->Ln();

        $table = '<table class="table table-striped table-bordered">';
        $table.='<tr>';
        for($i = 0; $i < sizeof($header); ++$i)
        {

            $table.='<th width="'.$headerWidth[$i].'">'.$header[$i].'</th>';
        }
        $table.="</tr>";

        $rowCount=0;

        foreach($data as $row)
        {
            $address= "";
            if (!empty($row["unitNum"])){
                $address= $address."U".$row["unitNum"].", ";
            }
            $address= $address.$row["streetNum"]." ".$row["street"].", ".$row["suburb"].", ".$row["state"].", ".$row["postcode"];

            $table.='<tr>';

            $table.="<td>$row[gName] $row[fName]</td>";
            $table.="<td>$address</td>";
            $table.="<td>$row[email]</td>";
            $table.="<td>$row[mobile]</td>";
            $table.="</tr>";
            $rowCount++;
        }

        $table .= "</table>";

        $pdf->writeHTML($table, false, false, false, false, 'L');
        //add new line after text written
        //fill - paint background
        //reset last cell height
        //add current cell padding
        //alignment

        $saveDir= dirname($_SERVER["SCRIPT_FILENAME"])."/PDFS/";

        if($pdf->Output($saveDir.'Customers.pdf','F'));
        {
            return $table;
        }

        exit();
    }
}

?>


<h1>Create PDF</h1>
<?php

include("connection.php");
$conn = new mysqli($HOST, $UName, $PWord, $DB);
$query= "SELECT * FROM client ORDER BY fName";
$result = $conn->query($query);

$allRows=mysqli_fetch_all($result,MYSQLI_ASSOC);

//Column titles
$header = array('Name', 'Address', 'Email', 'Contact');
//Column Widths
$headerWidth=array(150,300,250,200);

//create new instance of my CreatePDF class
$PDF = new CreatePDF();

//pass it headers, headerWidth and data
$table = $PDF->ClientPDF($header, $headerWidth, $allRows);


echo $table;
echo "<br />";
echo "<a href='PDFS/Customers.pdf'>Click here to see PDF</a>";



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
