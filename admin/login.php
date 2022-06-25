<html>
    <head>
        <title>Admin Login page</title>
        <link rel="stylesheet" href="../css/login-admin.css">
        <link rel="icon" type="image/x-icon" href="../images/fevicon.ico">
    </head>
    <body>
        <section>
        <div class="right-side">
                <img src="../images/logo2.png" class="pagelogo">
                <h1>Welcome to Quick Food</h1>
                <P>We'll Make Your Mood</P>
            </div>

            <div class="registration_box">
                <div class="register">
                    <p class="para">Login</p>
                    <form method="post" action="../common/logincode.php">
                    
                        <div class="input_box">
                            <span>Admin Id</span>
                            <input type="text" name="username" placeholder="Enter your username">
                        </div>
                        <div class="input_box">
                            <span>Password</span>
                            <input type="password" name="password" placeholder="Enter Your password" required>
                        </div>
                    
                        <div class="input_box">
                            <input type="submit" name="submit" value="Proceed">
                        </div>   
                    </form>
                </div>
                

            
        </section>
    </body>
</html>