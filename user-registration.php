<html>
    <head>
        <title>User Registration page</title>
        <link rel="stylesheet" href="css/login-admin.css">
    </head>
    <body>
        <section>
        
            <div class="registration_box">
                <div class="register">
                    <p class="para">Registration</p>
                    <div style="font-size: 14px; color:white; margin-bottom:5px; font-weight:bold ">
                        <?php
			                if(isset($_GET['unsucsesmsg']))
                            {
			                    echo $_GET['unsucsesmsg'];
			                }
                        ?> 
                    </div>
                    <form method="post" action="common/registration-code.php">
                    
                    <div class="input_box">
                        <span>Username</span>
                        <input type="text" name="username" placeholder="Enter your name">
                    </div>
                    <div class="input_box">
                        <span>E_Mail Id</span>
                        <input type="email" name="email" placeholder="Enter your Email">
                    </div>
                    <div style="font-size: 14px; color:white; margin-bottom:5px; font-weight:bold ">
                        <?php
			                if(isset($_GET['emailmsg']))
                            {
			                    echo $_GET['emailmsg'];
			                }
                        ?> 
                    </div>
                    <div class="input_box">
                        <span>Password</span>
                        <input type="password" name="password" placeholder="Enter Your password">
                    </div>
                    <div class="input_box">
                        <span>Confirm Password</span>
                        <input type="password" name="repassword" placeholder="Re enter your Password">
                    </div>
                    <div style="font-size: 14px; color:white; margin-bottom:5px; font-weight:bold ">
                        <?php
			                if(isset($_GET['passwordmsg']))
                            {
			                    echo $_GET['passwordmsg'];
			                }
                        ?> 
                    </div>
                    <div class="input_box">
                        <input type="submit" name="submit" value="Submit">
                    </div>
                </form>
                
                    
                    <div class="input_box accountOne">
                        <p class="account">Already have an account? <a href="user-login.php">Sing In</a></p>
                    
                    </div>
                </div>
            </div>

            <div class="right-side">
                <img src="images/logo2.png" class="pagelogo">
                <h1>Welcome to Quick Food</h1>
                <P>We'll Make Your Mood</P>
            </div>

        </section>
    </body>
</html>