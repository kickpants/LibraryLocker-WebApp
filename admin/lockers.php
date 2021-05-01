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
	<meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport">
	<title>Locker Access - FAU Library</title>
	<link href="styles.css?newversion4" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
	<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<link href="https://use.fontawesome.com/releases/v5.12.0/css/all.css" rel="stylesheet">
</head>
<body id="page-top">
	<div id="wrapper">
		<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
			<div class="container-fluid d-flex flex-column p-0">
				<a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="#">
				<div class="sidebar-brand-icon rotate-n-15">
					<i class="fas fa-laugh-wink"></i>
				</div>
				<div class="sidebar-brand-text mx-3">
					<span>FAU Library</span>
				</div></a>
				<hr class="sidebar-divider my-0">
				<ul class="nav navbar-nav text-light" id="accordionSidebar">
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="index.php"><i class="fas fa-window-maximize"></i><span>Form</span></a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link ac" href="lockers.php"><i class="fas fa-unlock"></i><span>Locker Access</span></a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="history.php"><i class="fas fa-table"></i><span>History</span></a>
					</li>
					<li class="nav-item" role="presentation">
						<a class="nav-link" href="logout.php"><i class="far fa-user-circle"></i><span>Logout</span></a>
					</li>
					<li class="nav-item" role="presentation"></li>
				</ul>
				<div class="text-center d-none d-md-inline">
					<button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
				</div>
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
				<h3 class="text-dark mb-1" id="legend-block">Legend:</h3>
				<div>
					<p id="rcorners1">Insert Books</p>
					<p id="rcorners2">Not In-Use</p>
					<p id="rcorners3">In-Use</p>
					<p id="rcorners4">Pickup Expired</p>
				</div>
					<div class="bs-example">
						<div class="accordion" id="accordionExample">
							<div class="card">
								<div class="card-header" id="headingOne">
									<h2 class="mb-0">
										<button type="button" class="btn" data-toggle="collapse" data-target="#collapseOne">How do I use this? Tap here</button>									
									</h2>
								</div>
								<div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
									<div class="card-body">
										<div class="text-center">
											<p><span style='color: #5cb85c;'>Green</span> locker blocks represent lockers with orders that are ready to be fulfilled.</p>
											<p><span style='color: #d9534f;'>Red</span> locker blocks represent lockers with expired orders waiting to be removed.</p>
											<p><span style='color: Grey;'>Grey</span> locker blocks represent lockers filled with a current order.</p>
											<p><span style='color: Silver;'>Silver</span> locker blocks represent empty lockers that are not in use.</p>
											<p>When ready, tap any <span style='color: #5cb85c;'>Green</span> or <span style='color: #d9534f;'>Red</span> locker orders to select them, and press the "Confirm/Remove Orders" button.
											After this, a one-time QR code will be generated on the page. Scan this code at the locker kiosk to access selected lockers.</p>
											<p>When a <span style='color: Grey;'>Grey</span> locker is tapped, a new button should appear to generate a QR code to access it. This can 
											be used in case a locker needs to be re-accessed for any reason.</p>
											<p>Reminder: Confirmation emails will not be sent to students until after their <span style='color: #5cb85c;'>Green</span> locker is submitted.</p>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="card shadow">
						<div class="card-body">
							<div class="container">
								<div class="row">
									<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
										<h2 id="test">Locker Status</h2>
										<div class="btn-group1" id="btn_groups">
											<button type="button" class="button2" id="Locker_btn1" disabled>Locker 1</button> <button type="button" class="button2" id="Locker_btn2" disabled>Locker 2</button> <button type="button" class="button2" id="Locker_btn3" disabled>Locker 3</button><br>
											<button type="button" class="button2" id="Locker_btn4" disabled>Locker 4</button> <button type="button" class="button2" id="Locker_btn5" disabled>Locker 5</button> <button type="button" class="button2" id="Locker_btn6" disabled>Locker 6</button><br>
											<button type="button" class="button2" id="Locker_btn7" disabled>Locker 7</button> <button type="button" class="button2" id="Locker_btn8" disabled>Locker 8</button> <button type="button" class="button2" id="Locker_btn9" disabled>Locker 9</button>
										</div>
										<p name="msg" id="msg"></p>
										<button class="btn-genQR genQR" id="gen_btn">Access Locker</button>
										<button class="btn-done done" id="done_btn">Confirm/Remove Orders</button>
										<div class="qrdiv" id="qrpanel">
											<span id="qrcode" class="text-center">
											</span>
										</div>
									</div>
								</div>
								<p id="demo"></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js">
	</script> 
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.js">
	</script> 
	<script src="assets/js/script.min.js">
	</script> 
	<script src="assets/js/qrcode.js">
	</script> 
	<script src="assets/js/lockers.js?newversion4">
	</script>
</body>
</html>