<?php 
    session_start();
    include_once 'dbh.inc.php';

    if(!isset($_SESSION['admin']))
    {
        header("Location: login.php");
    }
    
    $sql = "SELECT * FROM admin WHERE aid=".$_SESSION['admin'];
    $result = mysqli_query($link,$sql);
    $userRow = mysqli_fetch_array($result,MYSQLI_ASSOC);
    
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Form - FAU Library</title>
	<link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.0/css/all.css">
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
            <div class="container-fluid d-flex flex-column p-0">
                <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
                    <div class="sidebar-brand-icon rotate-n-15"><i class="fas fa-laugh-wink"></i></div>
                    <div class="sidebar-brand-text mx-3"><span>FAU Library</span></div>
                </a>
                <hr class="sidebar-divider my-0">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="index.php"><i class="fas fa-window-maximize"></i><span>Form</span></a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="lockers.php"><i class="fas fa-unlock"></i><span>Locker Access</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="history.php"><i class="fas fa-table"></i><span>History</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link" href="logout.php"><i class="far fa-user-circle"></i><span>Logout</span></a></li>
                    <li class="nav-item" role="presentation"></li>
                </ul>
                <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
            </div>
        </nav>
        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <nav class="navbar navbar-light navbar-expand bg-white shadow mb-4 topbar static-top">
                    <div class="container-fluid">
                        <ul class="nav navbar-nav flex-nowrap ml-auto">
                            <li class="nav-item dropdown no-arrow" role="presentation">
                                <div class="nav-item dropdown no-arrow">
                                    <span id="admin" class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userRow['aname']; ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">Student Form</h3>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="container">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">                        
                                        <h2>Student Info</h2>
                                    </div>
                                </div>
                                <div align="center">
                                    <div class="col-xs-6 col-sm-6 col-md-6 col-lg-6 col-xs-offset-3" >
                                        <form method="post" id="student-form" class="form" >
                                            <div class="form-group" >
                                                <label class="form-label" for="name">Student Name</label>
                                                <input type="text" class="form-control" id="name" name="name" placeholder="Enter Student Name" tabindex="1"  required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="email">Student  Email</label>
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Enter Student Email" tabindex="2" required>
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label" for="subject">Number of Items</label>
                                                <input type="number" class="form-control" id="num_books" name="num_books" placeholder="Enter Number of Books" tabindex="3" min="0" 	 required>
                                            </div>    
                                            <div class="form-group">
                                                <label class="form-label" for="subject">Reference #'s</label>
                                                <input type="text" class="form-control" id="reference_num" name="reference_num" placeholder="Enter Reference Numbers (Separate by Comma)" tabindex="3" min="0" 	 required>
                                            </div>    
                                            <div class="form-group">
                                                <label class="form-label" for="subject">Locker #</label>
                                                <input type="text" class="form-control" id="Locker #" name="locker_num" placeholder="Automated Locker Number" tabindex="4" disabled>
                                            </div>                            
                                            <div class="form-group">
                                                <label class="form-label" for="subject"> Pin #</label>
                                                <input type="text" class="form-control"  id="Pin #" name="pin_num" placeholder="Automated Pin Code" tabindex="5" disabled>
                                            </div>    
                                            <button type="submit" class="btn btn-primary btn-block text-white btn-user" id="submit" >Submit</button>
                                            <p name="msg" class="fade" id="msg"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js"></script>
    <script src="assets/js/script.min.js"></script>
    <script src="assets/js/form.js?newversion"></script>
</body>

</html>