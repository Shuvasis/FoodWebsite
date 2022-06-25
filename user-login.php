<html>
    <head>
        <title>User Login page</title>
        <link rel="stylesheet" href="css/login-admin.css">
    </head>
    <body>
        <section>
        <div class="right-side">
                <img src="images/logo2.png" class="pagelogo">
                <h1>Welcome to Quick Food</h1>
                <P>We'll Make Your Mood</P>
            </div>

            <div class="registration_box">
                <div class="register">
                    <p class="para">Login</p>
                    <form method="post" action="common/logincode.php">
                    
                        <div class="input_box">
                            <span>USER Id</span>
                            <input type="text" name="username" placeholder="Enter your Email">
                        </div>
                        <div class="input_box">
                            <span>Password</span>
                            <input type="password" name="password" placeholder="Enter Your password" required>
                        </div>
                    
                        <div class="input_box">
                            <input type="submit" name="submit" value="Proceed">
                        </div>   
                    </form>
                    <div style="font-size: 20px; color:white; ">
                        <?php
			                if(isset($_GET['msg']))
                            {
			                    echo $_GET['msg'];
			                }
                        ?> 
                    </div>
                        <div class="input_box">
                        <a href="forgetpass.php" class="forgetpass">forget password? </a>
                    </div>
                    <div class="input_box accountOne">
                        <p class="account">Don't have an account? <a href="user-registration.php">Sing up</a></p>
                    
                    </div>
            </div>
                </div>
            </div>

            
        </section>
    </body>
</html>