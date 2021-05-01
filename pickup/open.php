<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Home - Open</title>
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,700,300italic,400italic,700italic">
</head>

<body onload="onLoad()" id="page-top">
    <header class="d-flex masthead" style="background-image:url('');">
        <div class="container my-auto text-center">
        <h1 id="label" style="display: none;">What it do</h1>
            <?php
                include_once 'dbh.inc.php';
                $code = $_POST['code'];
                echo strlen($code);
                $result_array = array();
                $reds = array();


                //if the length of the string is 6, then the 
                if (strlen($code) == 6) {
                    $sql = "SELECT lockerNum FROM lockers_info WHERE lockerID = $code";
                    $result = mysqli_query($link, $sql);

                    if($result->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {     
                            //echoing the lockers opened for selenium
                            echo "<h1 class='mb-1' id='lockerNum' value='" . $row['lockerNum'] . "'>" . $row['lockerNum'] . " OPEN </h1>";  
                        }
                        $delete = "DELETE FROM lockers_info WHERE lockerID = $code;";
                        mysqli_query($link, $delete);
                    }
                    else {
                        echo "<p id='lockerNum' value='Hey' style='color: darkred; font-size: 1.5rem;'><strong>INCORRECT PIN CODE OR QR SCANNED <br> PLEASE TRY AGAIN.</strong></p>";
                    }
                } else {
                    $sql = "SELECT lockerNum, lockerStat FROM lockers_info WHERE adminAuth = '$code'";
                    $result = mysqli_query($link, $sql);

                    if($result->num_rows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $result_array[] = $row['lockerNum'];
                            if($row['lockerStat'] == 'Red') {
                                $reds[] = $row['lockerNum'];
                            }
                        }
                        //echoing the lockers opened for selenium
                        echo "<h1 id='lockerNum' class='mb-1' value='" . implode(',', $result_array) . "'>" . implode(', ', $result_array) . " OPEN </h1>";  
                        //destroys admin authentication after one-time use
                        $erase = "UPDATE lockers_info SET adminAuth = NULL WHERE lockerNum IN (" . implode(',', $result_array) . ");";
                        mysqli_query($link, $erase);

                        //if there are outdated lockers found, they are yeeted from the database after opening
                        $delete_reds = "DELETE FROM lockers_info WHERE lockerNum IN (" . implode(',', $reds) . ");";
                        mysqli_query($link, $delete_reds);
                    }
                    else {
                        echo "<p id='lockerNum' value='Hey' style='color: darkred; font-size: 1.5rem;'><strong>INCORRECT PIN CODE OR QR SCANNED <br> PLEASE TRY AGAIN.</strong></p>";
                    }
                }
            ?>
            <h3 class="mb-5"></h3><a class="btn btn-primary btn-xl js-scroll-trigger" role="button" href="keypad.php">Back</a>
            <div class="overlay"></div>
        </div>
    </header>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script>
        function onLoad() {
            setTimeout(function(){ window.location.href = "http://54.82.45.193/pickup/keypad.php" }, 10000);
        }
    </script>
</body>

</html>