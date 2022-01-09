<?php
  include 'config.php';
  session_start();
  $id = isset($_GET['id']) ? $_GET['id'] : '';
  $query=mysqli_query($conn,"SELECT * FROM users where id='$id'")or die(mysqli_error($conn));
  $row=mysqli_fetch_array($query);
?>
<?php ?>
<?php ?>

<!DOCTYPE html>
<html lang="en">

    <head>
        <title>Profile</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link href="css/style.css" rel="stylesheet">
        <link rel="stylesheet" type="text/css" href="style.css">
    </head>

    <header>
        <div id="brand"><a href="HomePage.php">Web Project</a></div>
          <center id="brand"><?php echo "Welcome " . $_SESSION['username']; ?> </center>
            <nav>
              <ul>
                <li><a href="HomePage.php" data-after="Home">Home</a></li>
                <li><a href="ProfilePage.php" data-after="Profile">Profile</a></li>
                <li><a style=" border: 2px solid #09c372;  margin: 5px; Padding: 5px; border-radius: 6px;" href="logout.php">Logout</a></li>
              </ul>
            </nav>
    </header>

    <body>
    <!-- Profile Section -->
      <section id="Profile">
        <div class="Profile">
	        <div class="container">
          <form action="" method="post" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Update Profile</p>
              <?php $username=$_SESSION['username'];
                $sql=" SELECT * FROM users WHERE username='$username'";
                $result = mysqli_query($conn , $sql);
                $row =mysqli_fetch_array($result); ?>
                <div class="input-group">
                  <input type="text" id="username" name="username" value="<?php echo $row['username'] ?> " ><br> 
                </div>
                <div class="input-group">
                  <input type="email" id="email" name="email" value="<?php echo $row['email'] ?>" placeholder="Email Address"><br>
                </div>
                <div class="input-group">
                  <input type="password" id="password" name="password" placeholder="Enter New Password" required><br>
                </div>
                <div class="input-group">
	        			  <input type="password" placeholder="Confirm Password" name="cpassword" required >
	        		  </div>
                <input type="hidden" value="<?php echo $row['password']; ?>" name="password2">
                <input type="hidden" name="id_usr" value="<?php echo $row["id"]; ?>">

                <?php if(isset($_GET['updated'])){?>
                 <p style="color:green;font-weight:700"> Updated successfully ! </p> <?php } elseif (isset($_GET['Exist'])) {?>
                 <p style="color:red;font-weight:700"> Email exists  ! </p> <?php } ?> 
            
                 <div class="input-group">
                 <button type="submit" name= "submit" class="btn"> Update Profile</button>
                </div>
          </form>
        </div>
      </section>
<?php
if (isset($_POST["submit"])){
  $usernameA=$_POST['username'];
  $emailA=$_POST['email'];
  $mdp=$_POST['password2'];
  $hash=$_POST['password2'];

  $idn = $_POST["id_usr"];

  if (!empty($_POST["password"] && $_POST["password"] === $_POST["cpassword"])) { $mdp = $_POST["password"];
                                    $hash = md5($mdp);}
  else {
    echo "<script>alert('Woops! Something Wrong Went.')</script>";
  }
  // email Update !
  if ($emailA != "" ) {$query = "SELECT * FROM users where email like '$emailA'";
                      $verif_email = mysqli_num_rows(mysqli_query($conn, $query));}
  else {$verif_email = 0;}

  if ($verif_email == 1 && $emailA != $row["email"]) {echo ("<meta http-equiv='refresh' content='0;  URL =ProfilePage.php?Exist'/>");}
  else{$insert ="UPDATE users set email='$emailA', password='$hash' where id='$idn'";
       $update=mysqli_query($conn,$insert);}
  if ($update) {echo ("<meta http-equiv='refresh' content='0;  URL =ProfilePage.php?Updated'/>");}
  else {echo mysqli_error($conn);}

  // username Update !
  if ($usernameA != "" ) {$query = "SELECT * FROM users where email like '$usernameA'";
    $verif_username = mysqli_num_rows(mysqli_query($conn, $query));}
  else {$verif_username = 0;}
  if ($verif_username == 1 && $usernameA != $row["username"]) {echo ("<meta http-equiv='refresh' content='0;  URL =ProfilePage.php?Exist'/>");}
  else{$insert ="UPDATE users set username='$usernameA', password='$hash' where id='$idn'";
  $update=mysqli_query($conn,$insert);
  $_SESSION = $_POST;}
  if ($update) {echo ("<meta http-equiv='refresh' content='0;  URL =ProfilePage.php?Updated'/>");}
  else {echo mysqli_error($conn);}

  
}?>
    <!-- End Profile Section -->
    </body>

  <!-- footer Section -->
    <footer>
        <div class="footer-content">
            <h3>Web Project 2021/2022</h3>
            <ul class="socials">
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-youtube"></i></a></li>
                <li><a href="#"><i class="fa fa-linkedin-square"></i></a></li>
            </ul>
        </div>

        <div class="footer-bottom">
            <p>copyright &copy; <a href="#">Baananou</a>  </p>
                    <div class="footer-menu">
                      <ul class="f-menu">
                        <li><a href="HomePage.php" data-after="Home">Home</a></li>
                        <li><a href="ProfilePage.php" data-after="Profile">Profile</a></li>

                      </ul>
                    </div>
        </div>

    </footer>
  <!-- End footer Section -->

</html>

<style>
@import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&display=swap");
/* Global css Start */
img{
    width: 100px;
}
* {
  padding: 0;
  margin: 0;
  box-sizing: border-box;
}

body {
  background-color: #353836;
  color: white;
  font-family: "Poppins", sans-serif;
}

.itemsH {
    min-height: 20vh;
    display: flex;
    justify-content: center;
    align-items: center;
    width:auto;
    margin: 10px;
    background-color: #09c372;
    border-radius: 5px;
}
.itemsV{
    display: flex;
    justify-content: center;
    align-items: center;
    width: 30%;
    margin: 10px;
    background-color: #09c372;
    border-radius: 5px;
    float: right;
    grid-row-start: 1;
    grid-row-end: 4;
}

.item {
    width: auto;
    margin: 10px;
    border: 3px solid #333;
    background-color: #1d1f1d;
}

.item-3 {
    min-height: 300px;
    flex-grow: 1;
    flex-basis: 0;
    order: 2;
}

/* Global css END */


/* Header Start */
header a {
  text-decoration: none;
}

header {
  padding: 0 20px;
  background-color: #1d1f1d;
  height: 50px;
  display: flex;
  justify-content: space-between;
}

#brand {
  font-weight: bold;
  font-size: 18px;
  display: flex;
  align-items: center;
}

#brand a {
  color: #09c372;
}

ul {
  list-style: none;
  height: 100%;
  display: flex;
  align-items: center;
  justify-content: space-around;
}

ul a {
  color: white;
}

ul li {
  padding: 5px;
  margin-left: 10px;
}

ul li:hover {
  transform: scale(1.1);
  transition: 0.3s;
}

#login,#signup {
  border-radius: 5px;
  padding: 5px 8px;
}

#login {
  border: 1px solid #498afb;
}

#signup {
  border: 1px solid #ff3860;
}

#signup a {
  color: #ff3860;
}

#login a {
  color: #498afb;
}
/* Header END */

/* Profile Start */




/* Profile END */

/* Footer Start */

footer{
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    background: #1d1f1d;
    height: auto;
    width: 100vw;

    padding-top: 40px;
    color: #fff;
}
.footer-content{
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
    text-align: center;
}
.footer-content h3{
    font-size: 2.1rem;
    font-weight: 500;
    text-transform: capitalize;
    line-height: 3rem;
}
.footer-content p{
    max-width: 500px;
    margin: 10px auto;
    line-height: 28px;
    font-size: 14px;
    color: #cacdd2;
}
.socials{
    list-style: none;
    display: flex;
    align-items: center;
    justify-content: center;
    margin: 1rem 0 3rem 0;
}
.socials li{
    margin: 0 10px;
}
.socials a{
    text-decoration: none;
    color: #fff;
    border: 1.1px solid white;
    padding: 5px;

    border-radius: 50%;

}
.socials a i{
    font-size: 1.1rem;
    width: 20px;


    transition: color .4s ease;

}
.socials a:hover i{
    color: aqua;
}

.footer-bottom{
    background: #000;
    width: 100vw;
    padding: 20px;
    padding-bottom: 40px;
    text-align: center;
}
.footer-bottom p{
float: left;
    font-size: 14px;
    word-spacing: 2px;
    text-transform: capitalize;
}
.footer-bottom p a{
  color:#44bae8;
  font-size: 16px;
  text-decoration: none;
}
.footer-bottom span{
    text-transform: uppercase;
    opacity: .4;
    font-weight: 200;
}
.footer-menu{
  float: right;

}
.footer-menu ul{
  display: flex;
}
.footer-menu ul li{
padding-right: 10px;
display: block;
}
.footer-menu ul li a{
  color: #cfd2d6;
  text-decoration: none;
}
.footer-menu ul li a:hover{
  color: #27bcda;
}
/* Footer END */

</style>