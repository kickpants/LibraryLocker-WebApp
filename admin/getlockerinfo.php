<?php
    include_once 'dbh.inc.php';

    $today_date = date("m/d/Y");
    $query = "SELECT lockerNum, lockerStat, studentName, lockerDate FROM lockers_info;";
    $result = mysqli_query($link, $query);
    $data = array();

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_assoc($result)) { //saving all the results of the query into arrays so I only have to call the database once
            $late_date = date("m/d/Y", strtotime($row['lockerDate'] . " + 2 days"));
            if ($today_date > $late_date) {
                $row['lockerStat'] = "Red";
            }
            $data[] = $row;
        }
    }

    //code here to update rows in table
    //jk im not going to do that cause it's better to update locker status client side

    echo json_encode($data);
?>