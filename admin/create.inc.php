<?php
    include_once 'dbh.inc.php';

    $admin_name = $_POST['admin'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $book_num = $_POST['num_books'];
    $reference_num = $_POST['reference_num'];
    $result_array = array();
    $i = 1;

    $sql = "SELECT lockerNum FROM lockers_info;";
    $result = mysqli_query($link, $sql);

    if($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) {     
            $result_array[] = $row['lockerNum'];
        }
        while (in_array($i, $result_array)) {
            $i++;
        }
        if ($i > 9) {
            exit();
        }
        $locker_num = $i;
        echo $i;
    } else {
        $locker_num = 1;
    }

    $today_date = date("m/d/Y");

    $locker_id = mt_rand(100000, 999999);
    $sql = "INSERT INTO lockers_info (lockerNum, lockerID, studentName, email, bookNum, referenceNum, lockerStat, lockerDate) VALUES ('$locker_num','$locker_id','$name', '$email', '$book_num', '$reference_num', 'Green', '$today_date');";
    mysqli_query($link, $sql);
    $sql = "INSERT INTO lockers_history (lockerNum, lockerID, studentName, email, bookNum, referenceNum, dateAdded, adminName) VALUES ('$locker_num','$locker_id','$name', '$email', '$book_num', '$reference_num', '$today_date', '$admin_name');";
    mysqli_query($link, $sql);

?>