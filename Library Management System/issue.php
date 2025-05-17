<?php
if (isset($_POST['Submit'])) {
    // Retrieve form inputs
    $Rollno = $_POST['rollno'];
    $Class = $_POST['class'];
    $Bid = $_POST['bid'];
    $Issue_Date = $_POST['issuedate'];
    $Return_date = $_POST['returndate'];

    // Check for empty fields
    if (empty($Rollno) || empty($Class) || empty($Bid) || empty($Issue_Date) || empty($Return_date)) {
        die("<h1 style='text-align: center; color: red;'>All fields are required. Please fill in all details.</h1>");
    }

    // Database connection
    $conn = mysqli_connect("localhost", "root", "", "library");

    if (!$conn) {
        die("<h1 style='text-align: center; color: red;'>Failed to connect to the database: " . mysqli_connect_error() . "</h1>");
    }


    $sql = "CREATE TABLE IF NOT EXISTS book_issue (
        Rollno BIGINT(20),
        Class VARCHAR(20),
        Book_id BIGINT(20) UNIQUE, 
        Issue_Date DATE,
        Return_Date DATE,
        FOREIGN KEY (Rollno) REFERENCES student(Rollno),
        FOREIGN KEY (Book_id) REFERENCES book(Book_id)
    );";

    if (!mysqli_query($conn, $sql)) {
        die("<h1 style='text-align: center; color: red;'>Error creating table: " . mysqli_error($conn) . "</h1>");
    }

    // Step 2: Validate student existence
    $checkStudent = "SELECT * FROM student WHERE Rollno = '$Rollno'";
    $studentResult = mysqli_query($conn, $checkStudent);

    if (mysqli_num_rows($studentResult) == 0) {
        die("<h1 style='text-align: center; color: red;'>Roll Number $Rollno does not exist in the student table.</h1>");
    }

    // Step 3: Validate book existence
    $checkBook = "SELECT * FROM book WHERE Book_id = '$Bid'";
    $bookResult = mysqli_query($conn, $checkBook);

    if (mysqli_num_rows($bookResult) == 0) {
        die("<h1 style='text-align: center; color: red;'>Book ID $Bid does not exist in the book table.</h1>");
    }


    // Step 5: Insert the book issue record
    $insertQuery = "INSERT INTO book_issue (Rollno, Class, Book_id, Issue_Date, Return_Date) 
                    VALUES ('$Rollno', '$Class', '$Bid', '$Issue_Date', '$Return_date')";

    if (mysqli_query($conn, $insertQuery)) {
        echo "<h1 style='text-align: center; color: green;'>Book issued successfully!</h1>";
    } else {
        echo "<h1 style='text-align: center; color: red;'>Error issuing the book: " . mysqli_error($conn) . "</h1>";
    }

    // Close connection
    mysqli_close($conn);
} else {
    echo "<h1 style='text-align: center; color: red;'>Please submit the form properly.</h1>";
}
?>
