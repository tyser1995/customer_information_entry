<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer Information Entry</title>
    <link rel="stylesheet" href="css/styles.css">
     <!-- Include jQuery -->
     <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Include DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.4/css/jquery.dataTables.css">
    <!-- Include DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.11.4/js/jquery.dataTables.js"></script>

    <script src="js/scripts.js"></script>
</head>
<body>
    <div class="container">
        <h1>Customer Information</h1>
        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
            include 'db.php';

            $lastname = $_POST['lastname'];
            $firstname = $_POST['firstname'];
            $email = $_POST['email'];
            $city = $_POST['city'];
            $country = $_POST['country'];
            $imagePath = '';

            if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
                $imagePath = 'images/' . basename($_FILES['image']['name']);
                move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
            }

            $stmt = $conn->prepare("INSERT INTO customers (lastname, firstname, email, city, country, image_path) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssss", $lastname, $firstname, $email, $city, $country, $imagePath);
            $stmt->execute();
            $stmt->close();
            $conn->close();

            echo "<p class='success-message'>Customer information saved successfully.</p>";
        }
        ?>
        <form id="customer-form" action="index.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="lastname">Last Name:</label>
                <input type="text" id="lastname" name="lastname" required>
            </div>

            <div class="form-group">
                <label for="firstname">First Name:</label>
                <input type="text" id="firstname" name="firstname" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="city">City:</label>
                <input type="text" id="city" name="city" required>
            </div>

            <div class="form-group">
                <label for="country">Country:</label>
                <select id="country" name="country" required>
                    <option value="" selected disabled hidden>Select Country</option>
                    <option value="United States">United States</option>
                    <option value="Canada">Canada</option>
                    <option value="Japan">Japan</option>
                    <option value="United Kingdom">United Kingdom</option>
                    <option value="France">France</option>
                    <option value="Germany">Germany</option>
                </select>
            </div>

            <div class="form-group">
                <label for="image">Upload Picture:</label>
                <input type="file" id="image" name="image" accept="image/jpeg">
            </div>

            <div class="button_container">
                <div>
                    <button type="submit" name="save">Save</button>
                    <button type="button" onclick="resetForm()">Cancel</button>
                </div>
                <a href="#!" class="button toggle-list">Show Customer List</a>
            </div>
        </form>
        <hr>

        <div class="customer_container" style="display:none">
            <h2>Added Customers</h2>
            <table id="customerTable" class="display">
                <thead>
                    <tr>
                        <th>Last Name</th>
                        <th>First Name</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    include 'db.php';

                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    $sql = "SELECT lastname, firstname, email FROM customers";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["lastname"] . "</td>";
                            echo "<td>" . $row["firstname"] . "</td>";
                            echo "<td><a href='review.php?email=" . $row["email"] . "'>" . $row["email"] . "</a></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='4'>No customers added yet</td></tr>";
                    }

                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#customerTable').DataTable();

             // Toggle customer list visibility
             $('.toggle-list').click(function() {
                $('.customer_container').toggle();
                var text = $('.customer_container').is(':visible') ? 'Hide Customer List' : 'Show Customer List';
                $('.toggle-list').text(text);
            });
        });
        function resetForm() {
            document.getElementById('lastname').value = "";
            document.getElementById('firstname').value = "";
            document.getElementById('email').value = "";
            document.getElementById('city').value = "";
            document.getElementById('country').value = "";
        }
    </script>
</body>
</html>
