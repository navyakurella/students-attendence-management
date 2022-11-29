<?php 

session_start(); 
header("Location: admin.php");
include "db_conn.php";

date_default_timezone_set("Asia/Calcutta");
$date=date('d-M-y');
print $date."<br>";

$sub = $_GET['subject'];

$topic = $_GET['topic'];

print $sub ."<br>";
print $topic."<br>";
if($sub=='NULL'){
    header("Location: admin.php?error=please select subject name");
    exit(1);
}

$hour="";
$arr=array("hour1","hour2","hour3","hour4","hour5","hour6","hour7");
$students=array("1"=>"20881A05J1","2"=>"20881A05J2","3"=>"20881A05J3","4"=>"20881A05J4","5"=>"20881A05J5","6"=>"20881A05J6","7"=>"20881A05J7","8"=>"20881A05J8","9"=>"20881A05J9","10"=>"20881A05K0",
"11"=>"20881A05K1","12"=>"20881A05K2","13"=>"20881A05K3","14"=>"20881A05K4","15"=>"20881A05K5","16"=>"20881A05K6","17"=>"20881A05K7","18"=>"20881A05K8","19"=>"20881A05K9","20"=>"20881A05L0","21"=>"20881A05L1",
"22"=>"20881A05L2","23"=>"20881A05L3","24"=>"20881A05L4","25"=>"20881A05L5","26"=>"20881A05L6","27"=>"20881A05L7","28"=>"20881A05L8","29"=>"20881A05L9","30"=>"20881A05M0","31"=>"20881A05M1","32"=>"20881A05M2",
"33"=>"20881A05M3","34"=>"20881A05M4","35"=>"20881A05M5","36"=>"20881A05M6","37"=>"20881A05M7","38"=>"20881A05M8","39"=>"20881A05M9","40"=>"20881A05N0","41"=>"20881A05N1","42"=>"20881A05N2","43"=>"20881A05N3",
"44"=>"20881A05N4","45"=>"20881A05N5","46"=>"20881A05N6","47"=>"20881A05N7","48"=>"20881A05N8","49"=>"20881A05N9","50"=>"20881A05P0","51"=>"20881A05P1","52"=>"20881A05P2","53"=>"20881A05P3","54"=>"20881A05P4",
"55"=>"20881A05P5","56"=>"20881A05P6","57"=>"20881A05P7","58"=>"20881A05P8","59"=>"20881A05P9","60"=>"20881A05Q0","61"=>"16881A05C1","62"=>"19881A05F1","63"=>"21885A0519","64"=>"21885A0520","65"=>"21885A0521",
"66"=>"21885A0522","67"=>"21885A0523","68"=>"21885A0524");
foreach ($arr as $i){
    if(isset($_GET[strval($i)])){
        $hour=$i;
        break;
    }
}

print $hour;
$check1="select count(*) as NUMBER_OF_ROWS from sub_topic where DAY='${date}' and HOUR='${hour}'";
$p1=oci_parse($conn,$check1);
oci_define_by_name($p1, 'NUMBER_OF_ROWS', $number_of_rows1);
oci_execute($p1);
oci_fetch($p1);
if($number_of_rows1==0){
    $sql4="insert into sub_topic (DAY,HOUR,SUBJECT,TOPIC) values('${date}','${hour}','${sub}','${topic}')";
    $res1=oci_parse($conn,$sql4);
    oci_execute($res1);
}
elseif($number_of_rows1==1){
    $sql5="update sub_topic set SUBJECT='${sub}' , TOPIC='${topic}' where day='${date}' and hour='${hour}'";
    $res1=oci_parse($conn,$sql5);
    oci_execute($res1);
}

$hour1=strtoupper($hour);
print $hour."<br>";

for ($i=1;$i<68;$i++){
    $val=$students[strval($i)];
    $check="select count(*) as NUMBER_OF_ROWS from csed where DAY='${date}' and ROLL_NO='${val}'";
    $p=oci_parse($conn,$check);
    oci_define_by_name($p, 'NUMBER_OF_ROWS', $number_of_rows);
    oci_execute($p);
    oci_fetch($p);
    if($number_of_rows == 0){
        if(isset($_GET[strval($i."_".$hour)])){
            $sql2="insert into csed(DAY,ROLL_NO,".$hour.") values('${date}','${val}','present')";
            $res=oci_parse($conn,$sql2);
            oci_execute($res);
        }
        else{
            $sql3="insert into csed(DAY,ROLL_NO,".$hour.") values('${date}','${val}','absent')";
            $res=oci_parse($conn,$sql3);
            oci_execute($res);
        }
    }
    elseif($number_of_rows == 1){
        if(isset($_GET[strval($i."_".$hour)])){
            $sql2="update csed set ".$hour."='present' where DAY='${date}' and ROLL_NO='${val}'";
            $res=oci_parse($conn,$sql2);
            oci_execute($res);
        }
        else{
            $sql3="update csed set ".$hour."='absent' where DAY='${date}' and ROLL_NO='${val}'";
            $res=oci_parse($conn,$sql3);
            oci_execute($res);
        }
    }
    
}
header("Location: admin.php?msg=uploaded successfully");

$select_stmt = "select * from csed where DAY='${date}'";

    $stid = oci_parse($conn, $select_stmt);
    oci_execute($stid);

    echo "<table border='1'>\n";

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






