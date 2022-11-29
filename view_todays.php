<?php 
session_start(); 
include "db_conn.php";

date_default_timezone_set("Asia/Calcutta");
$date=date('d-M-y');

?>

<!DOCTYPE html>

<html>

<head>

    <title>HOME</title>
     <style>
          * {
            margin: 0;
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
            background-color: rgba(24, 146, 89, 0.8);
            background-repeat: repeat-y;
        }

        #header {
            
            display: inline-flex;
            
            color: aliceblue;
            padding: 8px;
            margin-left: 8px;
        }

        #container {
            background-color: rgb(249, 251, 253, .5);
            position: static;
            align-self: center;
            width: 82%;
            margin-left: 5%;
            height: max-content;
            border-radius: 8px;
            box-shadow: 2px 2px rgb(97, 86, 86);
            padding: 4%;
        }
        #student {
            font-family: Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #student td,#student th {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }


        #student tr:nth-child(even) {
            background-color: #ddd;
        }



        #student th {
            padding-top: 12px;
            padding-bottom: 12px;
            
            background-color: #04AA6D;
            color: white;
        }
        .right_nav{
            position: relative;
           
        }
        
        #navr{
            font-size: x-large;
            margin-bottom: 30px;
            color: #f2f2f2;
            text-decoration: underline;
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
            float:right;
            padding: 8px;
        }
        .nav_div {
           overflow: hidden;
            
            width: fit-content;
            float: right;
            margin-top: -30px;
            margin-right: 80px;
            left: 800px;
            
        }
        </style>
        <body>


        <div class="right_nav">
            <h1 id="header">vardhaman college of engineering</h1><br>
            <h1 id="header">STUDENT ATTENDENCE OF CSE-D</h1>
        
            <div class="nav_div">
                <a href="logout.php"><p id="navr">Logout</p></a>
            </div>
        </div>


            <div id="container">
                <h1>Today's classes : </h1>
            <?php
$select_stmt = "select * from sub_topic where DAY='${date}'";

    $stid = oci_parse($conn, $select_stmt);
    oci_execute($stid);

    echo "<table border='1' id='student'>\n";

    echo "<tr>\n";
        echo "<th>".'DATE'."    </th>\n";
        echo "<th>". 'HOUR' . "</th>\n";
        echo "<th>". 'SUBJECT' . "</th>\n";
        echo "<th>". 'TOPIC' . "</th>\n";
        echo "</tr>\n";

    while ($row = oci_fetch_assoc($stid)) {
        echo "<tr>\n";
        echo "<td>". $row["DAY"] . "</td>\n";
        echo "<td>". $row["HOUR"] . "</td>\n";
        echo "<td>". $row["SUBJECT"] . "</td>\n";
        echo "<td>". $row["TOPIC"] . "</td>\n";
        echo "</tr>\n";
    }

    echo "</table><br><br>\n";
    ?>


    <h1>Total student's attendence today : </h1>
    <?php

$select_stmt = "select * from csed where DAY='${date}'";

    $stid = oci_parse($conn, $select_stmt);
    oci_execute($stid);

    echo "<table border='1' id='student'>\n";

    echo "<tr>\n";
        echo "<th>".'DATE'."    </th>\n";
        echo "<th>".'ROLL NO'." </th>\n";
        echo "<th>". 'HOUR1' . "</th>\n";
        echo "<th>". 'HOUR2' . "</th>\n";
        echo "<th>". 'HOUR3' . "</th>\n";
        echo "<th>". 'HOUR4' . "</th>\n";
        echo "<th>". 'HOUR5' . "</th>\n";
        echo "<th>". 'HOUR6' . "</th>\n";
        echo "<th>". 'HOUR7' . "</th>\n";
        echo "</tr>\n";

    while ($row = oci_fetch_assoc($stid)) {
        echo "<tr>\n";
        echo "<td>". $row["DAY"] . "</td>\n";
        echo "<td>". $row["ROLL_NO"] . "</td>\n";
        echo "<td>". $row["HOUR1"] . "</td>\n";
        echo "<td>". $row["HOUR2"] . "</td>\n";
        echo "<td>". $row["HOUR3"] . "</td>\n";
        echo "<td>". $row["HOUR4"] . "</td>\n";
        echo "<td>". $row["HOUR5"] . "</td>\n";
        echo "<td>". $row["HOUR6"] . "</td>\n";
        echo "<td>". $row["HOUR7"] . "</td>\n";
        echo "</tr>\n";
    }

    echo "</table>\n";

    ?>
            </div>
        </body>

</head>
</html>

