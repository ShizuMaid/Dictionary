<?php
$par1_ip="127.0.0.1";
$par2_name="root";
$par3_p="";
$par4_db="Dictionary";

$induction = mysqli_connect($par1_ip,$par2_name,$par3_p,$par4_db);
mysqli_set_charset($induction, "utf8mb4");

if ($induction == false){
    echo "Ошибка подключения";
}

?>