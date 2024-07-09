<?php
// Database connection
$conn = new mysqli('localhost', 'root', '', 'grand');
if ($conn->connect_error) {
    die("Connection Failed: " . $conn->connect_error);
}

$sql = "SELECT email, request_type FROM service_requests";
$result = $conn->query($sql);

$data = [];
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
} else {
    echo "0 results";
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://kit.fontawesome.com/dffba75db4.js" crossorigin="anonymous"></script>
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
        .main-content {
            padding: 80px 20px 20px 20px; /* Adjusted for navbar space */
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 20px;
            border-radius: 8px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        td {
            font-size: 14px; /* Smaller font size */
        }
        .footer {
            text-align: center;
            padding: 10px;
            background: rgba(0, 0, 0, 0.8);
            color: #fff;
            position: fixed;
            bottom: 0;
            width: 100%;
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
        <div class="toggle-btn">
            <i class="fa-solid fa-barcode"></i>
        </div>
    </div>
</header>

<main class="main-content">
    <div class="container">
        <h2>Service Requests</h2>
        <br><br>
        <table>
            <thead>
                <tr>
                    <th>Email</th>
                    <th>Request Type</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data)): ?>
                    <?php foreach ($data as $row): ?>
                        <tr> <!-- Add this line -->
                            <td><?php echo htmlspecialchars($row['email']); ?></td>
                            <td><?php echo htmlspecialchars($row['request_type']); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="2">No data available</td> <!-- Change colspan to 2 as there are 2 columns -->
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>


</body>
</html>
