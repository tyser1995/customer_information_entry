# customer_information_entry
This is a practical exam using pure php, css, html.

# Customer Information

This project implements a customer database application with features such as customer information entry, review page based on email lookup, mini pocket calculator, and screen sharing utility.

## Project Structure

- **abukai_customer_app/**: Contains PHP files for customer entry (`index.php`) and review (`review.php`).
- **abukai_customer_app/uploads/**: Directory for storing uploaded images.
- **calculator.js**: JavaScript file for mini pocket calculator functionality.
- **abukai_customer_app/pages/screen_share.html**: HTML file for screen sharing utility.

## Database Layout

### Database: `customer_db`

#### Table: `customers`

| Column    | Type         |
|-----------|--------------|
| id        | INT          |
| lastname  | VARCHAR(255) |
| firstname | VARCHAR(255) |
| email     | VARCHAR(255) |
| city      | VARCHAR(255) |
| country   | VARCHAR(255) |
| image     | VARCHAR(255) |

## Test Cases

### Form Submission

- **Case 1**: Enter valid data and submit.
- **Case 2**: Enter invalid email format and check error handling.
- **Case 3**: Upload images of various formats (only JPEG allowed).

### Showing List of Customer
- **Case 1**: Click Show and Hide button.
- **Case 2**: Search functionality.
- **Case 2**: Click selected email to redirect to Review Page.

### Data Retrieval (Review Page)

- **Case 1**: Enter valid email and verify retrieved customer information.
- **Case 2**: Enter non-existent email and check for appropriate feedback.

### Mini Pocket Calculator

- **Case 1**: Test basic addition and subtraction operations.
- **Case 2**: Test edge cases (division by zero, large numbers, etc.).

### Screen Sharing (if implemented)

- **Case 1**: Test screen sharing functionality across different browsers.

## Setup Instructions

1. Set up XAMPP and configure Apache and MySQL.
2. Import the database schema (`customer_db.sql`).
3. Navigate to `http://localhost/abukai_customer_app/index.php` to access the application.

##if import will encounter a problem you can copy the table with the database name customer_db;

CREATE TABLE customers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    lastname VARCHAR(255) NOT NULL,
    firstname VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    city VARCHAR(255) NOT NULL,
    country VARCHAR(255) NOT NULL,
    image_path VARCHAR(255)
);