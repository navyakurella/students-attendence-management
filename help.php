<?php

$conn = oci_connect('system', 'system', 'localhost:1521/XE');

$date=date("Ymd");

print $date;
$check="select $date from user_tables order by table_name asc";
$s = oci_parse($conn, $check);
oci_execute($s);
if (oci_num_rows($s)==0){
   $sql="create table csed(day date,roll_no varchar2(20),hour1 varchar2(20),hour2 varchar2(20),hour3 varchar2(20),hour4 varchar2(20),hour5 varchar2(20),hour6 varchar2(20),hour7 varchar2(20)),primary key(day,roll_no)";
   $res=oci_parse($conn,$sql);
   oci_execute($res);
}

print oci_num_rows($s);
?>