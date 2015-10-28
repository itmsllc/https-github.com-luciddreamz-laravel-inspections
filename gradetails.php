<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<?php
session_start();
//echo "Session ID: ".session_id()."<br>";
$session = session_id();

require_once 'login.php';
$conn = new mysqli($hn, $un, $pw, $db);
if ($conn->connect_error) die($conn->connect_error);
        ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Villas Computerized Inspection System</title>
        <style type="text/css">
            body.back {background: lightblue}
            h1 {text-align: center}
            h2 {text-align: center}
            h3.ital {font-style: italic}
            p {text-align: center}
            .center {
                text-align: center;
            }
            .left {
                text-align: left;
            }
            .right {
                text-align: right;
            }
            table {
                    width: auto;
                    margin: auto;
            }
            th {
                text-align: center;
                border-bottom: 1px solid black;                
            }
            td {
                text-align: center;
            }
            caption {
                font-size: 1.2em;
                font-weight: bold;
            }
        </style>
    </head>
    <body class="back">
           <h1>Computerized Inspection System</h1>
        <h3 class="ital" align="center">by Isabel Molines</h3>
        <h2>Villa Inspection Report</h2>
    <?php
        
$id = $_GET['id'];
//echo "Inspection No.: = ".$id;

//        $id = 158;
        
        $query = "SELECT * FROM inspections WHERE id = '$id'";
        
$result = $conn->query($query);
if(!$result) die($conn->error);

        echo "<table>";

        while($row = mysqli_fetch_array($result)) {
    echo "<tr><td><b>Inspection No.: ".$row['id']."</td></tr>";
    echo "<tr><td><b>Villa number: </b>".$row['room_number']."</td></tr>";
    echo "<tr><td><b>Date cleaned : </b>".$row['clean_date']."</td></tr>";
    echo "<tr><td><b>Cleaned by : </b>".$row['gra']."</td></tr>";
$session = $row['session'];
$score = $row['score'];

$room_number = $row['room_number'];
$clean_date = $row['clean_date'];
        } 
echo "</table><br><br>";


//echo "Session = ".$session."<br>";
//echo "Villa number = ".$room_number."<br>";
//echo "Date cleaned: = ".$clean_date."<br>";
//echo "Overall score = ".$score;

echo "<table>
    <caption>Points taken off</caption>
<tr>
<th>ID</th>
<th>Description</th>
<th>Points off</th>
</tr>";

$query = "SELECT * FROM inspection WHERE room_number = $room_number AND clean_date = '$clean_date' AND points_off < 0";

$result = $conn->query($query);
if(!$result) die($conn->error);

//        echo "<table>";

        while($row = mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['item_id']."</td>";
                echo "<td class='left'>".$row['descrip']."</td>";
                echo "<td class='center'>".$row['points_off']."</td>";
                echo "</tr>";
        }
echo "</table><br><br>";

echo "<table>
<tr>
<th class='center'>Overall Score</th>
</tr>";
	echo "<tr>";
	echo "<td><b>".$score."</b></td>";
	echo "</tr>";

echo "</table>";

$result->close();
$conn->close();


        ?>
    </body>
</html>
