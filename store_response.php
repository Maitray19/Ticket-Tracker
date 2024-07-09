<?php
include 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
    $email = $_POST['email'];
    $request_type = $_POST['requesttype'];

    $sql = "INSERT INTO service_requests (user_id, email, request_type) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("iss", $user_id, $email, $request_type);

        if ($stmt->execute()) {
            // Redirect to thankyou.html after successful insertion
            header("Location: thankyou.html");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Error preparing statement: " . $conn->error;
    }
} else {
    echo '<div class="smessage">You need to login first to store your service requests.</div>';
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Request</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/dffba75db4.js" crossorigin="anonymous"></script>
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
            padding-right: 110px;
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
        .input-group {
            color: white;
        }
        .heading {
            color: white;
            padding-left: 70px;
            padding-top: 20px;
        }
        #email {
            width: 20%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #requesttype {
            width: 20%;
            padding: 12px 20px;
            margin: 8px 0;
            display: inline-block;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        #submit {
            width: 20%;
            background-color: #000000;
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
        .message {
            color: blue;
            font-size: 20px;
            font-weight: bold;
            text-align: center;
        }
        span {
            margin-left: 400px;
            font-weight: bold;
        }
        .lore {}
    </style>
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo"><a href="#">CRM</a></div>
        <ul class="links">
            <li><a href="index.html">Home</a></li>
            <li><a href="#">About</a></li>
            <li><a href="service.html">Services</a></li>
            <li><a href="customer.html">Customer care <i class="fa-solid fa-message" style="padding-left: 5px;"></i></a></li>
        </ul>
    </div>
</header>
<div id="mainarea">
    <div id="header">
        <main class="main-content">
            <h2 id="heading" style="margin-left:150px; padding-bottom:20px; color:white;">Service-Request</h2>
        </div>
        <div class="form-container">
            <form action="store_response.php" method="post">
                <div class="input-group">
                    <label for="email"><span class="lore">Email</span></label>
                    <input type="email" style="margin-left: 100px;" id="email" name="email" required>
                </div>
                <div class="input-group">
                    <label for="requesttype"><span>Type of Request</span></label>
                    <select id="requesttype" style="margin-left:22px;" name="requesttype" required>
                        <option value="video-editing">Video Editing</option>
                        <option value="web-software">Web-based Software</option>
                        <option value="graphic-designing">Graphic Designing</option>
                        <option value="content-writing">Content Writing</option>
                        <option value="data-entry">Data Entry</option>
                        <option value="data-cleaning">Data Cleaning</option>
                        <option value="sales-services">Sales Services</option>
                    </select>
                </div>
                <button type="submit" class="btn" id="submit" style="margin-left:550px;">Submit Request</button>
                <br>
                <a href="service.html" class="btn-secondary" id="tap" style="font-size=15px; padding-left:510px;">Want to know more? Check our services out!</a>

            </form>
        </div>
    </main>
</div>
</body>
</html>
