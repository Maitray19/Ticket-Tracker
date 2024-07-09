<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Responses</title>
    <link rel="stylesheet" href="styles.css">
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
    padding: 15px;
    text-align: left;
}
.response-container {
    width: 75%;
    max-width: 800px; /* Add a max-width for better control */
    margin: 100px auto; /* Centering the container */
    background-color: #fff;
    padding: 15px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    
}
.response {
    margin-bottom: 20px;
}
.response p {
    margin: 5px 0;
}
.response hr {
    border: 1px solid #ddd;
}

    </style>
</head>
<body>
<header>
    <div class="navbar">
        <div class="logo"><a href="index.html">CRM</a></div>
        <ul class="links">
            <li><a href="index.html">Home</a></li>
            <li><a href="about.html">About</a></li>
            <li><a href="service.html">Services</a></li>
            <li><a href="customer.html">Customer care <i class="fa-solid fa-message" style="padding-left: 5px;"></i></a></li>
        </ul>
        <div class="toggle-btn">
            <i class="fa-solid fa-barcode"></i>
        </div>
    </div>
</header>
<div id="mainarea">
    <?php
    include 'db.php';
    session_start();

    if (isset($_SESSION['user_id'])) {
        $user_id = $_SESSION['user_id'];

        // Prepare and execute the SQL query
        $sql = "SELECT email, request_type, created_at FROM service_requests WHERE user_id = ?";
        $stmt = $conn->prepare($sql);
        if (!$stmt) {
            die('Prepare failed: ' . htmlspecialchars($conn->error));
        }

        $stmt->bind_param("i", $user_id);
        if (!$stmt->execute()) {
            die('Execute failed: ' . htmlspecialchars($stmt->error));
        }

        // Bind variables to prepared statement
        $stmt->bind_result($email, $request_type, $created_at);

        // Fetch and display results
        echo '<div class="response-container">';
        while ($stmt->fetch()) {
            echo "<div class='response'>";
            echo "<p><strong>$created_at</strong></p>";
            echo "<p>Email: $email</p>";
            echo "<p>Request Type: $request_type</p>";
            echo "<hr>";
            echo "</div>";
        }
        echo '</div>';

        $stmt->close();
    } else {
        echo "______________________..You need to log in to see your service requests.";
    }
    ?>
</div>
<footer>
    <div class="container">
        <p>&copy; 2024 CRM. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
