
<?php
session_start();

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
                    <a href="userTest.php">
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
                    <a href="userHistory.php">
                    <i class="fa-solid fa-clock-rotate-left"></i>
                    <div>History</div>
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
            <form action="../php/userTestRequest.php" method="post" id="form" >
            <div class="contain">
            <div class="inner-box">


            <label>
            Submit the test
            <input type="date" name="date" id="date" min="2019-12-31" max="<?php echo date("Y-m-d"); ?>" required>
            <span class="validity"></span>
            </label>
      
            <p>
            <button id="submit">Submit</button>
            </p>

            
             
            </div>
            </div>
            </form>
        </div>
        
    </div>

<script src="../javascript/userTest.js"></script>
</body>

</html>


