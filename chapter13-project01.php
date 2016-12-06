<?php
session_start();

require_once('config2.php');
$connection = mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME);

//handling connection errors
if (mysqli_connect_errno()) {
	die(mysqli_connect_error());
}

// initialize variables
$email = "";
$password = "";
$emailMessage = '';
$emailClass = '';
$passwordMessage = '';
$passwordClass = '';      

$emailMessage = '';
$emailClass = '';



$passwordMessage = '';
$passwordClass = '';
  
function validLogin(){
$pdo = new PDO(DBCONNSTRING,DBUSER,DBPASS);
//very simple (and insecure) check of valuid credentials.
$sql = "SELECT * FROM Credentials WHERE Username=:user and
Password=:pass";
$statement = $pdo->prepare($sql);
$statement->bindValue(':user',$_POST['email']);
$statement->bindValue(':pass',$_POST['password']);
$statement->execute();
if($statement->rowCount()>0){
return true;
}
return false;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Chapter 13</title>

   <!-- Bootstrap core CSS -->
   <link href="bootstrap3_defaultTheme/dist/css/bootstrap.css" rel="stylesheet">

   <!-- Custom styles for this template -->
   <link href="chapter13-project01.css" rel="stylesheet">

   <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
   <!--[if lt IE 9]>
   <script src="bootstrap3_defaultTheme/assets/js/html5shiv.js"></script>
   <script src="bootstrap3_defaultTheme/assets/js/respond.min.js"></script>
   <![endif]-->
</head>

<body>

<div class="container">
   <div class="row">
      <div class="col-md-3">
      </div>
      <div class="col-md-6">
         <div id="login">
<?php
   //require_once("config.php");
   $loggedIn=false;
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
     if(validLogin()){
		echo "<h2>Welcome ".$_POST['email']."</h2>";
		echo "<a href='logout.php'>Logout</a>";
		$_SESSION['UserID']=$email;
		$loggedIn=true;
	}
	else {
		echo '<p>Login unsuccessful.</p>';
		echo '<div class="page-header">
               <h2>Login</h2> 
            </div>';
       echo '<form role="form" method="post" action="' .$_SERVER['PHP_SELF']. '">';
      echo    '<div class="form-group '.$emailClass.'">';
      echo      '<label for="exampleInputEmail1">Email address</label>';
       echo     '<input type="email" class="form-control" name="email" value="'.$email.'">';
       echo     '<p class="help-block">'.$emailMessage.'</p>';
        echo  '</div>
              <div class="form-group '.$passwordClass.'">';
        echo    '<label for="exampleInputPassword1">Password</label>';
        echo    '<input type="password" class="form-control" name="password"  value="'.$password.'>';
        echo   '<p class="help-block">'.$passwordMessage.'</p>';
        echo  '</div>
              <div class="form-group">
                <label for="exampleInputFile">Server</label>
                <select name="server" class="form-control">';
                
                  for ($i = 1; $i < 6; $i++) {
                     echo '<option>Server ' . $i . '</option>';
                  }
                
       echo     '</select>';             
        echo      '</div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>  ';
   } 

   }
   else{
     echo '<div class="page-header">
               <h2>Login</h2> 
            </div>';
       echo '<form role="form" method="post" action="' .$_SERVER['PHP_SELF']. '">';
      echo    '<div class="form-group '.$emailClass.'">';
      echo      '<label for="exampleInputEmail1">Email address</label>';
       echo     '<input type="email" class="form-control" name="email" value="'.$email.'">';
       echo     '<p class="help-block">'.$emailMessage.'</p>';
        echo  '</div>
              <div class="form-group '.$passwordClass.'">';
        echo    '<label for="exampleInputPassword1">Password</label>';
        echo    '<input type="password" class="form-control" name="password"  value="'.$password.'>';
        echo   '<p class="help-block">'.$passwordMessage.'</p>';
        echo  '</div>
              <div class="form-group">
                <label for="exampleInputFile">Server</label>
                <select name="server" class="form-control">';
                
                  for ($i = 1; $i < 6; $i++) {
                     echo '<option>Server ' . $i . '</option>';
                  }
                
       echo     '</select>';             
        echo      '</div>
              <button type="submit" class="btn btn-primary">Submit</button>
            </form>  ';
   } 
   
?>

            

         </div>
      </div>
      <div class="col-md-3">
      </div>
   </div>  
</div>  <!-- end container -->

 <!-- Bootstrap core JavaScript
 ================================================== -->
 <!-- Placed at the end of the document so the pages load faster -->
 <script src="bootstrap3_defaultTheme/assets/js/jquery.js"></script>
 <script src="bootstrap3_defaultTheme/dist/js/bootstrap.min.js"></script>    
</body>
</html>
