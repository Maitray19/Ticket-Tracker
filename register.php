<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO customers (username, password) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("ss", $username, $password);
        if ($stmt->execute()) {
            // Successful registration, redirect to login page
            header("Location: login2.php?message=thanks for registering please login again");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Open Sans', sans-serif;
}
body {
    height: 100vh;
    background-color: #000;
    background-image: url(coal.jpg); 
    background-size: cover;
    background-position: center;
}
li {
    list-style: none;
}
a {
    text-decoration: none;
    color: #fff;
    font-size: 1rem;
}
a:hover {
    color: orange;
}
header {
    position: relative;
    padding: 0 2rem;
}
.message {
    color: blue;
    font-size: 20px;
    font-weight: bold;
}
.navbar {
    position: fixed; 
    top: 0; 
    width: 100%; 
    height: 60px;
    max-width: 1500px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: space-between;
    background-color: rgba(0, 0, 0, 0.8); 
    z-index: 1000; 
}
.navbar .logo a {
    font-size: 1.5rem;
    font-weight: bold;
}
.logo {
    margin-top: 20px;
}
.navbar .links {  
    display: flex;
    gap: 40px;
    padding-left: 600px;
    font-size: 45px;
}
.navbar .toggle_btn {
    color: #fff;
    font-size: 1.5rem;
    cursor: pointer;
    display: none;
}
      #mainarea {
        display: block;
        margin-left: -50px;
        padding: 20px;
      }
      #header {
        text-align: center;
        margin-top: 150px;
      }
      #header h1 {
        font-size: 2rem;
        margin-bottom: 10px;
        margin-top: 50px;

      }
      #header button {
        background-color: #333;
        color: white;
        border: none;
        padding: 15px 30px;
        font-size: 1.2rem;
        font-weight: bold;
        border-radius: 50px;
        margin-top: 50px;
        cursor: pointer;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        transition: all 0.3s ease;
      }
    .input-group{
        color: white;
    }

    .heading{
        color:white;
        padding-left:70px;
        padding-top: 20px;

    }
     #username{
      width: 20%;
      padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
     } 
     #password{
      width: 20%;
      padding: 12px 20px;
    margin: 8px 0;
    display: inline-block;
    border: 1px solid #ccc;
    border-radius: 4px;
    box-sizing: border-box;
     }
     #submit{
      width: 20%;
    background-color: #000000   ;
    color: white;
    padding: 12px 30px;
    margin: 12px;
    margin-left: 80px;
    border: none;
     border-radius: 4px;
    cursor: pointer;

     }
     #submit:hover {
    background-color: #013220;
  }
  #tap{
    margin-left: 60px;
  }
    </style>
    <header>
        <div class="navbar">
        <div class="logo"><a href="#">CRM</a></div>
        <ul class="links">
        <li><a href="index.html">Home</a></li>
        <li><a href="#">About</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Customer care <i class="fa-solid fa-message" style="padding-left: 5px;"></i></a></li>
        </ul>
        <!-- hold
        <a href="#" class="action_btn">Get Started</a>-->
        <div class="toggle-btn">
            <i class="fa-solid fa-barcode"></i>
        </div>
        </div>
        </header> 
     <div id="mainarea">
      <div id="header">
        <main class="main-content">
          <div class="form-container">
              <h2 style="margin-left:60px; color:white; margin-bottom:30px">Register</h2>
              <form method="POST" action="register.php">
                  <div class="input-group">
                      <label for="username">Username</label>
                      <input type="text" id="username" name="username" required>
                  </div>
                  <div class="input-group">
                      <label for="password">Password</label>
                      <input type="password" id="password" name="password" required>
                  </div>
                  <div class="input-group">
                      <input type="submit" value="Register" class="btn" id="submit">
                      <br>
                      <a href="login2.php" class="btn-secondary" id="tap" style="font-size=15px">Already a member? Login</a>
                  </div>
              </form>
          </div>
      </main>
  
      </div>
    </div>
</body>
</html>