<?php
	include_once 'dbh.inc.php';
    require_once 'phpqrcode/qrlib.php';

    $garray = json_decode($_POST['greendata']);
    $rarray = json_decode($_POST['reddata']);

    function random_string($length) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $character_length = strlen($characters);
        $random_string = '';
        for ($i=0; $i<$length; $i++) {
            $random_string .= $characters[rand(0, $character_length-1)];
        }
        return $random_string;
    }
 
    $random_auth = random_string(20);

    //was going to add extra code here to prevent extra QR codes from being generated for the same lockers, but realized
    //that lockers become gray after being confirmed and thus cant be clicked or re-generated

    $gcount = count($garray);
    $rcount = count($rarray);

    if ($gcount > 0) {
        $sql = "UPDATE lockers_info SET adminAuth = '$random_auth' WHERE lockerNum IN (" . implode(',', $garray) . ");";
        mysqli_query($link, $sql);
    }

    if ($rcount > 0) {
        $sql2 = "UPDATE lockers_info SET adminAuth = '$random_auth' WHERE lockerNum IN (" . implode(',', $rarray) . ");";
        mysqli_query($link, $sql2);
    }

    echo $random_auth;

?>