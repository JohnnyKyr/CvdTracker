
<?php
session_start();
// echo "user is " . $_SESSION["username"] . ".<br>";
// echo session_id();
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CVDtrack User Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'> 
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    
    <link rel="stylesheet" href="../css/userSettings.css">
    
</head>
<body>
    <div class="container">
        <div class="topbar">
            <div class="logo">
                <h2>CVDtrack</h2>
            </div>
            <div class="search">
                <input type="text" id="searcn" placeholder="search">
                <label for="search"> <i class="fas fa-search"></i></label>
            </div>
            <i class="fas fa-bell"></i>
            <div class="user">
                <img src="../images/user.png" alt="user image">
            </div>
        </div>


        <div class="sidebar">
            <ul>
            <li>
                    <a href="user.php">
                    <i class="fa-solid fa-map"></i>
                    <div>Map</div>
                    </a>
                </li>

                <li>
                    <a href="#">
                    <i class="fa-solid fa-virus"></i>
                    <div>Test</div>
                    </a>
                </li>

                <li>
                    <a href="userList.php">
                    <i class="fa-solid fa-rectangle-list"></i>
                    <div>List</div>
                    </a>
                </li>
          
                <li>
                    <a href="userSettings.php">
                    <i class="fas fa-cog"></i>
                    <div>Settings</div>
                    </a>
                </li>

                <li>
                    <a href="index.php">
                        <i class="fa-solid fa-right-from-bracket"></i>
                    <div>Log Out</div>
                    </a>
                </li>

            </ul>
        </div>

        <div class="main">
            <form action="../php/userSettingsRequest.php" method="post" id="form" >
            <div class="contain">
            <div class="inner-box">

            <div class="username-box">
            <label for="username">Change Username</label> 
                    <div class="form_control">    
                        <input type="text" id="username" placeholder= "<?php echo $_SESSION["username"];?>" name="username"> 
                        <i class="fa fa-check-circle"></i>
				        <i class="fa fa-exclamation-circle"></i>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <small>error</small>
                    </div>
            </div>

            <div class="password-box">
            <label for="password">Change Password</label> 
                    <div class="form_control">   
                        <input type="password" id="password" placeholder="password" name="password">
                        <i class="fa fa-check-circle"></i>
				        <i class="fa fa-exclamation-circle"></i>
                        <i class="fa-solid fa-triangle-exclamation"></i>
                        <small>There is an error</small>
                    </div>
            </div>
                
            <button type="submit" name="submit" id="submit">Stage Changes</button>
            </div>
            </form>
        </div>
        
    </div>

<script src="../javascript/userSettings.js"></script>
</body>

</html>


