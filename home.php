
<?php  

	include 'includes/CDN.php';
	include 'includes/navbar.php';
	session_start();
?>
<!DOCTYPE html>
<html xmlns:fb="http://www.facebook.com/2008/fbml">
<head>
	<title>Meet Emma</title>

	<style type="text/css">
		body,html{
  			width: 100%;
  			height: 100%;
  			padding: 0px;
  			margin: 0px;
		}
		.section_border{
			//border:2px solid black; 
			height: 100%;
		}

	</style> 
</head>
<body>

<div class="container-fluid" style="margin-top:0px; font-family: 'Raleway', sans-serif;">
	<div class="row" style="height: 80%">
		<div class="col-sm-2 section_border" >
			<?php include'includes/sidebar.php'; ?>
		</div>
		<div class="col-sm-7 section_border">
			<h2> Col-1</h2>
		</div>
		<div class="col-sm-3 section_border"
		 style="background-image:url('http://cache4.asset-cache.net/xd/505229569.jpg?v=1&c=IWSAsset&k=2&d=62CA815BFB1CE48053E4E3C9F9FFA16F86871D979DBBA836C62C6C731A6616AADB1EAF54E7E3BE9A'); background-size:cover; color:#fff;">
  <?php if ($_SESSION['FBID']): ?>      <!--  After user login  -->
  	<div class="card" >
  	  <!--<img class="card-img-top" data-src="..." alt="Card image cap">-->
  	  <img  class=" card-image img-circle" style="margin:auto 20%;" src="https://graph.facebook.com/<?php echo $_SESSION['FBID']; ?>/picture?type=large">
  	  <div class="card-block">
  	    <h4 class="card-title">Hello <?php echo $_SESSION['FULLNAME']; ?></h4>
  	    <p class="card-text">Your virtual assistant is up and running now.</p>
  	  </div>
  	  <ul class="list-group list-group-flush" style="color: #222">
  	    <li class="list-group-item"><?php echo $_SESSION['EMAIL']; ?></li>
  	    <li class="list-group-item">"LIVE,LAUGH,LOVE AND CODE" </li>
  	    <li class="list-group-item">&copy by Decode Black 96</li>
  	  </ul>
  	</div>

<?php else: ?>    
<?php header("Location:login_register.php"); ?>
<?php endif ?>
		</div>
	</div>
	<div class="row col-lg-12" style="height: 14%;background-color: #222;width:102%" > 
		<div class="col-lg-8 col-lg-offset-2" style="margin-top: 2%">
			<div class="col-sm-10">
				<input type="text" class="col-sm-8 form-control" placeholder="Say Something">
			</div>
			<div>
				<span class="pull-right col-sm-2"><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAADAAAAAwCAYAAABXAvmHAAACrElEQVR42u2Xz2sTQRSAX8VSb1K8iNqKooJH2Ux6Ksn+iPQqxZMIehJB0do/IMhmQWsvHr2KSEGk0tSLIoWIYNUKij20F2/N7iaUZnYT0kYzzhMKs0HDJiTdLcwHDwKZSd63781LBiQSSW9JZdkhzfKm1Rz9mjZp/W9YdEU3vXv4HsQZ40FtNG36q5rls//Ej4tmbSS2T15Mvp3ExOPmEMQNbBtMMEyoljcFcQN7PqyAlqNfIG7gYQ0tYNIaxA1MrJPY3wImbUqBKAXSFv0tBSIVMOkvKRDtGKWN/T6FdqRAxFNoWwpEPIXqUqBT6ALU/UVgu8GW4GD3f6f9TRDYNJTDrk7YbtiqUumHwIYoUJuHERDAS0r4CvgFECgbY+cFAR7KT+g1POmCKFDNw6WggHc3fBtVb4CAoyauBgXIG+g1Xh5mRAGah6cggBd11fK/h7lOprIs0H6uRl6KAo5O7kOv4QmPiwJ4Jqqv4FiwCtXjvD2+tRmfK6kZ/ygI2HritK0rDVGgrClJ6DWMwYC/AGuCBMYcIC2V0CzvjmbRz3j3xUjn6CfeYreUJ2wQkGD75INPX1mFfsEFrrcIYCvdhC4paWQakxajpJMr0C9YFg54i7AsClRmh9/xnr0NHcInzZStk2aLwAcGMAD9pPIazvFKVDD5rdnhJeHLX5RTyRPQHpz5o66emMc9wdlPtvA8wF7Aq2BUHh1525qEo5JtR1WeOXpickO9cJIpyuD6xJmhYiZ5ytWSl3mlnuOaf+2zDaLDXmJrSgZ/MYVEugo+gSh+FkSBa4yd5Ul87DZ5XpFl/AyIEjzYjkau8WqshU2cr13HPbgX4gJOD97n465GZlyVvC9mSKloKI2iTnbwNT+gBX54H+IaXAtxJzE3ycSAFqSAFJACUkAikXD+AHj5/wx2o5osAAAAAElFTkSuQmCC" alt="microphone_img">
				</span>
			</div>
		</div>
	</div>
</div>
</body>
</html>