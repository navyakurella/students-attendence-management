<?php
$conn = oci_connect('system', 'system', 'localhost:1521/XE');
if (!$conn) {
   $m = oci_error();
   echo $m['message'], "\n";
   exit;
}
else {
   
}

?>