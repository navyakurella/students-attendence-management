<?php 

session_start(); 

include "db_conn.php";

if (isset($_POST['uname']) && isset($_POST['password'])) {

    function validate($data){

       $data = trim($data);

       $data = stripslashes($data);

       $data = htmlspecialchars($data);

       return $data;

    }

    $uname = validate($_POST['uname']);

    $pass = validate($_POST['password']);

    if (empty($uname)) {

        header("location: sign-in.php?error=User Name is required");

        exit();

    }else if(empty($pass)){

        header("location: sign-in.php?error=Password is required");

        exit();

    }else{

        $sql = "SELECT * FROM users WHERE uname='$uname' AND password='$pass'";
        $s = oci_parse($conn, $sql);
        oci_execute($s);
        

        

            $row = oci_fetch_assoc($s);

            if ($row['UNAME'] == $uname && $row['PASSWORD'] == $pass) {

                if ($row['UNAME'] == 'admin' && $row['PASSWORD'] == 'admin'){
                    echo "Logged in!";

                    $_SESSION['UNAME'] = $row['UNAME'];

                    $_SESSION['NAME'] = $row['NAME'];

                    $_SESSION['USERID'] = $row['USERID'];

                    header("Location: admin.php");

                    exit();
                }
                else{
                    echo "Logged in!";

                    $_SESSION['UNAME'] = $row['UNAME'];

                    $_SESSION['NAME'] = $row['NAME'];

                    $_SESSION['USERID'] = $row['USERID'];

                    header("Location: home.php");

                    exit();
                }

            }else{

                header("Location: sign-in.php?error=Incorect User name or password");

                exit();

            }

        

    }

}else{

    header("Location: sign-in.php");

    exit();

}