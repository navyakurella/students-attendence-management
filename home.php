<?php

session_start();
include "db_conn.php";
date_default_timezone_set("Asia/Calcutta");
$date = date('d-M-y');

if (isset($_SESSION['USERID']) && isset($_SESSION['UNAME'])) {
    $roll = $_SESSION['UNAME'];

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
                margin-left: 30px;
                margin-top: 20px;
                color: aliceblue;

            }

            #container {
                background-color: rgb(249, 251, 253, .5);

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

            #student td,
            #student th {
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

            #student1 {
                font-family: Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                width: 80%;



            }

            #student1 td,
            #student1 th {
                border: 1px solid #ddd;
                padding: 8px;
                text-align: center;
            }


            #student1 tr:nth-child(even) {
                background-color: #ddd;
            }



            #student1 th {
                padding-top: 12px;
                padding-bottom: 12px;

                background-color: #04AA6D;
                color: white;
            }

            img {
                height: 160px;
                width: 160px;
            }
        </style>


    </head>

    <body>

        <h1 id="header">Hello, <?php echo $_SESSION['NAME']; ?></h1>

        <a href="logout.php">Logout</a>
        <div id="container">
            <center>
                <?php
                $img_path = 'http://studentscorner.vardhaman.org/images/cse/' . $roll . '.jpg';
                echo "<table border='1' id='student1'>\n";

                echo "<tr>\n";
                echo "<td rowspan='4'><img src=" . $img_path . "></th>\n";
                echo "<td>" . $_SESSION['NAME'] . "</th>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                echo "<td>" . $roll . "</th>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                echo "<td>" . 'computer science and engineering' . "</th>\n";
                echo "</tr>\n";
                echo "<tr>\n";
                echo "<td>" . '2020' . "</th>\n";
                echo "</tr>\n";
                echo "</table>\n";
                ?>
            </center>
            <br><br>
            <h1 style="text-align: center;">YOUR ATTENDENCE PERCENTAGE IS :

                <?php
                $total_classes = 0;
                $total_present = 0;
                $hours = array('HOUR1', 'HOUR2', 'HOUR3', 'HOUR4', 'HOUR5', 'HOUR6', 'HOUR7');
                $statement = "select HOUR1,HOUR2,HOUR3,HOUR4,HOUR5,HOUR6,HOUR7 from csed where ROLL_NO='${roll}' ";
                $count_a = oci_parse($conn, $statement);
                oci_execute($count_a);
                while ($row = oci_fetch_assoc($count_a)) {
                    foreach ($hours as $i) {
                        if (isset($row[$i])) {
                            $total_classes = $total_classes + 1;
                            if ($row[$i] == 'present') {
                                $total_present = $total_present + 1;
                            }
                        }
                    }
                }

                if ($total_present == 0) {
                    echo 0;
                } else {
                    echo ($total_present / $total_classes) * 100;
                }

                ?>
            </h1><br><br>
            <h1>Today's classes : </h1>
            <?php

            $select_stmt = "select * from sub_topic where DAY='${date}'";

            $stid = oci_parse($conn, $select_stmt);
            oci_execute($stid);

            echo "<table border='1' id='student1'>\n";

            echo "<tr>\n";

            echo "<th>" . 'HOUR' . "</th>\n";
            echo "<th>" . 'SUBJECT' . "</th>\n";
            echo "<th>" . 'TOPIC' . "</th>\n";
            echo "</tr>\n";

            while ($row = oci_fetch_assoc($stid)) {
                echo "<tr>\n";

                echo "<td>" . $row["HOUR"] . "</td>\n";
                echo "<td>" . $row["SUBJECT"] . "</td>\n";
                echo "<td>" . $row["TOPIC"] . "</td>\n";
                echo "</tr>\n";
            }

            echo "</table>\n";

            ?><br><br>
            <h1>Your total atendence : </h1>
        <?php

        $select_stmt = "select DAY,HOUR1,HOUR2,HOUR3,HOUR4,HOUR5,HOUR6,HOUR7 from csed where ROLL_NO='${roll}'";

        $stid = oci_parse($conn, $select_stmt);
        oci_execute($stid);

        echo "<table border='1', id='student'>\n";

        echo "<tr>\n";
        echo "<th>" . 'DATE' . "    </th>\n";
        echo "<th>" . 'HOUR1' . "</th>\n";
        echo "<th>" . 'HOUR2' . "</th>\n";
        echo "<th>" . 'HOUR3' . "</th>\n";
        echo "<th>" . 'HOUR4' . "</th>\n";
        echo "<th>" . 'HOUR5' . "</th>\n";
        echo "<th>" . 'HOUR6' . "</th>\n";
        echo "<th>" . 'HOUR7' . "</th>\n";
        echo "</tr>\n";

        while ($row = oci_fetch_assoc($stid)) {
            echo "<tr>\n";
            echo "<td>" . $row["DAY"] . "</td>\n";
            echo "<td>" . $row["HOUR1"] . "</td>\n";
            echo "<td>" . $row["HOUR2"] . "</td>\n";
            echo "<td>" . $row["HOUR3"] . "</td>\n";
            echo "<td>" . $row["HOUR4"] . "</td>\n";
            echo "<td>" . $row["HOUR5"] . "</td>\n";
            echo "<td>" . $row["HOUR6"] . "</td>\n";
            echo "<td>" . $row["HOUR7"] . "</td>\n";
            echo "</tr>\n";
        }

        echo "</table>\n";
    } else {

        header("Location: sign-in.php");

        exit();
    }

        ?>
        </div>

    </body>

    </html>