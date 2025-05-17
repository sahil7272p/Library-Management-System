<?php

$conn = mysqli_connect("localhost", "root", "", 'library');
echo "Hello";

    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!, Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }

$checkIssued = "SELECT * FROM book_Issue WHERE Book_id = 101";
    $issuedResult = mysqli_query($conn, $checkIssued);

    if (mysqli_num_rows($studentResult) == 0) {
        die("<h1 style='text-align: center; color: red; margin-top: 20%; font-size: 50px;'>Roll Number $Rollno does not exist in the Student table.</h1><br>");
    }

    ?>