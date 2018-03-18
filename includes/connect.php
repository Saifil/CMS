<?php

define("DB_HOST","localhost");
define("DB_USER","root");
define("DB_PASS","root");
define("DB_NAME","widget_corp");

$conn = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME);

if (mysqli_connect_errno()) {
    die("Database connection failed: " .
        mysqli_connect_error() . "(" . mysqli_connect_errno() . ")"
    );
} else {
    //echo "Success";
}

//mysqli_close($conn);
?>
