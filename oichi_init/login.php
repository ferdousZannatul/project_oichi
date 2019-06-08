<?php
session_start();

if(isset($_SESSION['login_id']) && $_SESSION['login_id']>0){
    header("Location: view.php");
    die();
}

include 'header.php';
?>

<div class="container" style="height:70% !important;">
	<div class="row h-100 align-items-center my-auto">
		<div class="col col-lg-4 mx-auto">
            <h1 class="text-center text-light">Admin Login</h1>
            <form action="data.php" method="POST">
                <div class="form-group">
                    <!-- <label for="username">Username</label> -->
                    <input type="text" class="form-control" name="username" id="username"  required="" placeholder="username">
                </div>
                <div class="form-group">
                    <!-- <label for="password">Password</label> -->
                    <input type="password" class="form-control" name="password" id="password"  required="" placeholder="password">
                </div>
                <button class="btn btn-primary form-control" type="submit" name="login" id="login">Login</button>
                <div class="text-center text-danger">
                    <?php
                        if(isset($_SESSION['error_msg'])){
                            echo $_SESSION['error_msg'].", try again!";
                        }
                    ?>
                </div>
            </form>
        </div>
	</div>
</div>

<?php include 'footer.php'; ?>