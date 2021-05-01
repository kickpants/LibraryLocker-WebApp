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

    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 1;
    }
    
    $sql1 = "SELECT * FROM lockers_history";
    $result1 = mysqli_query($link,$sql1);
    $num_rows = mysqli_num_rows($result1);
        
    $pageSize = 10;
    $offset = ($page-1) * $pageSize; 
        
    $totalPage = ceil ($num_rows / $pageSize);  
    
    $sql2 = "SELECT * FROM lockers_history ORDER BY `dateAdded` DESC LIMIT $offset, $pageSize";
    $result2 = mysqli_query($link,$sql2);
    
?>


<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>History - FAU Library</title>
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
                    <li class="nav-item" role="presentation"><a class="nav-link" href="index.php"><i class="fas fa-window-maximize"></i><span>Form</span></a></li>
					<li class="nav-item" role="presentation"><a class="nav-link" href="lockers.php"><i class="fas fa-unlock"></i><span>Locker Access</span></a></li>
                    <li class="nav-item" role="presentation"><a class="nav-link active" href="history.php"><i class="fas fa-table"></i><span>History</span></a></li>
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
                                    <span class="d-none d-lg-inline mr-2 text-gray-600 small"><?php echo $userRow['aname']; ?></span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
                <div class="container-fluid">
                    <h3 class="text-dark mb-4">History</h3>
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6"><input type="search" class="form-control form-control-sm" aria-controls="dataTable" placeholder="Search"></div>
                            </div>
                            <div class="table-responsive table mt-2" id="dataTable" role="grid" aria-describedby="dataTable_info">
                                <table class="table dataTable my-0" id="dataTable">
                                    <thead>
                                        <tr>
                                            <th>Student Name</th>
                                            <th>Email</th>
                                            <th>Locker</th>
                                            <th>Reference #'s</th>
                                            <th>Date</th>
                                            <th>Librarian</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php while($row = mysqli_fetch_array($result2,MYSQLI_ASSOC)) { 
                                                                $sname = $row["studentName"];
                                                                $email = $row["email"];
                                                                $lnum  = $row["lockerNum"];
                                                                $reference_num = $row['referenceNum'];
                                                                $time = $row['dateAdded'];
                                                                $admin = $row['adminName']
                                            ?>                          
                                        <tr>
                                            <td><?php echo $sname;?></td>
                                            <td><?php echo $email;?></td>
                                            <td><?php echo $lnum;?></td>
                                            <td><?php echo $reference_num;?></td>
                                            <td><?php echo $time; ?></td>
                                            <td><?php echo $admin; ?></td>
                                        </tr>
                                        <?php
                                            }
                                            ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <nav class="d-lg-flex justify-content-lg-end dataTables_paginate paging_simple_numbers">
                                        <ul class="pagination">
                                            <li class="<?php if($page <= 1){ echo 'disabled'; } ?>">
                                                <a class="page-link" href="<?php if($page <= 1){ echo '#'; } else { echo "?page=".($page - 1); } ?>" aria-label="Previous">
                                                    <span aria-hidden="true">«</span>
                                                </a>
                                            </li>                                           
                                            <li class="page-item">
                                                    <a class="page-link" href ="<?php echo '?page='.$page; ?>"> <?php echo $page ?> <span aria-hidden="true">/ </span><?php echo $totalPage ?>
                                                </a>
                                            </li>
                                            <li class="<?php if($page >= $totalPage){ echo 'disabled'; } ?>">
                                                <a class="page-link" href="<?php if($page >= $totalPage){ echo '#'; } else { echo "?page=".($page + 1); } ?>" aria-label="Next">
                                                    <span aria-hidden="true">»</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
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
</body>

</html>