<?php
    include_once 'dbh.inc.php';

    $array = json_decode($_POST['qrdata']);

    function random_string($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $character_length = strlen($characters);
        $random_string = '';
        for ($i=0; $i<$length; $i++) {
            $random_string .= $characters[rand(0, $character_length-1)];
        }
        return $random_string;
    }

    $auth = random_string(20);
    $count = count($array);

    if ($count > 0) {
        $sql = "UPDATE lockers_info SET adminAuth = '$auth' WHERE lockerNum IN (" . implode(',', $array) . ");";
        mysqli_query($link, $sql);
    }

    echo $auth;
?>