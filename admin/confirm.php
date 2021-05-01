<?php

    require_once 'dbh.inc.php';
    require_once 'phpqrcode/qrlib.php';

    require 'PHPMailer/PHPMailer.php';
    require 'PHPMailer/SMTP.php';
    require 'PHPMailer/Exception.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $garray=json_decode($_POST['greendata']);
    $rarray=json_decode($_POST['reddata']);
    echo $garray[0];
    echo $rarray[0];

    $gcount = count($garray);
    $rcount = count($rarray);

    if ($gcount > 0) {
        $stat_update = "UPDATE lockers_info SET lockerStat = 'Gray' WHERE lockerNum IN (" . implode(',', $garray) . ");";
        mysqli_query($link, $stat_update);
    }

    if ($rcount > 0) {
        $delete_update = "UPDATE lockers_info SET lockerStat = 'Red' WHERE lockerNum IN (" . implode(',', $rarray) . ");";
        mysqli_query($link, $delete_update);
    }

    $sql = "SELECT lockerNum, email, lockerID FROM lockers_info;"; 
    $result = mysqli_query($link, $sql);

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) { //saving all the results of the query into arrays so I only have to call the database once
            $locker_nums[] = $row['lockerNum'];
            $student_email[] = $row['email'];
            $locker_auth[] = $row['lockerID'];
        }
    }

    for ($i = 0; $i < mysqli_num_rows($result); $i++ ) {
        for ($j = 0; $j < $gcount; $j++) {
            if ($locker_nums[$i] == $garray[$j]) {
                $filename = "./images/QR.png";
                QRcode::png($locker_auth[$i], $filename, QR_ECLEVEL_L, 4, 1);

                $msg = "Your FAU Library Order is Ready for Pickup!";
                //SMTP settings
                $mail = new PHPMailer(true);
                $mail->isSMTP();
                $mail->SMTPSecure='ssl';
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth=true;
                $mail->Username='FAULibraryLockerSystem@gmail.com';
                $mail->Password='Group8pass';
                $mail->Port='465';

                //Mail settings
                $mail->setFrom('FAULibraryLockerSystem@gmail.com');
                $mail->addAddress($student_email[$i]);
                $mail->isHTML(true);
                $mail->Subject='Your FAU Library Order Pickup Info';
                $mail->addEmbeddedImage('images/QR.png', 'qr');
                $mail->Body="<h1>We got your order! It's waiting for you at the FAU Library Kiosk.</h1>
                            <br>
                            <h2>Your 6 Digit Authentication Code: " . $locker_auth[$i] . "</h2>
                            <br>
                            <h2>Your Scannable QR Code: </h2>
                            <img src='cid:qr' width='275' height='275'>";

                $mail->Send();

                unlink('images/QR.png');
            }
        }
    }

?>