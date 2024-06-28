<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information Review</title>
    <link rel="stylesheet" href="css/review.css">
    <script src="js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Customer Information Review</h1>
        <div class="section">
            <?php
            if (isset($_GET['email'])) {
                $email = $_GET['email'];
                include 'db.php';

                $stmt = $conn->prepare("SELECT lastname, firstname, city, country, image_path FROM customers WHERE email = ?");
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->bind_result($lastname, $firstname, $city, $country, $imagePath);
                $stmt->fetch();
                $stmt->close();
                $conn->close();

                if ($lastname) {
                    echo "<p><strong>Last Name:</strong> $lastname</p>";
                    echo "<p><strong>First Name:</strong> $firstname</p>";
                    echo "<p><strong>City:</strong> $city</p>";
                    echo "<p><strong>Country:</strong> $country</p>";
                    echo "<p><strong>Image:</strong><br><img src='$imagePath' alt='Customer Image' width='150'></p>";
                } else {
                    echo "<p>No customer found with the email: $email</p>";
                }
            } else {
                echo "<p>Please provide an email in the query string (e.g., ?email=test@example.com)</p>";
            }
            ?>
            <!-- Return Button -->
            <div>
                <a href="./index.php" class="button">Return to Index</a>
            </div>
        </div>

        <div class="section container_section">
            <div>
            <h2>Mini Pocket Calculator</h2>
            <iframe src="./pages/calculator.html"></iframe>
            </div>
            <div>
            <h2>Screen Share Utility</h2>
            <iframe src="./pages/screenshare.html"></iframe>
            </div>
        </div>
    </div>
</body>
</html>
