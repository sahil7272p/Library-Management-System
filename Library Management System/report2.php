<?php

// Check if the form is submitted
if (isset($_POST['Submit'])) {

    // Create connection to the MySQL server
    $conn = mysqli_connect("localhost", "root", "", 'library');

    // Check connection
    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!, Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }

    // Create the query to fetch all records from the book table
    $query = "SELECT * FROM book";
    $result = mysqli_query($conn, $query);

    // Check if any rows are returned
    if (mysqli_num_rows($result) > 0) {
        // Initialize a counter for the number of books
        $bookCount = 0;

        // Start the HTML table
        echo "<h2 style='text-align: center;'>Book List</h2>";
        echo "<table border='1' cellpadding='10' cellspacing='0' style='margin: auto; width: 80%; text-align: center; border-collapse: collapse;'>
                <thead>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Book Price</th>
                        <th>Author</th>
                        <th>Publisher</th>
                    </tr>
                </thead>
                <tbody>";

        // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["Book_id"] . "</td>
                    <td>" . $row["Book_Name"] . "</td>
                    <td>" . $row["Book_Price"] . "</td>
                    <td>" . $row["Author"] . "</td>
                    <td>" . $row["Publisher"] . "</td>
                  </tr>";
            $bookCount++;
        }

        // End the table
        echo "</tbody></table><br>";

        // Display the total number of books
        echo "<h2 style='text-align: center;'>Total Number of Books: $bookCount</h2>";

    } else {
        echo "<h1 style='text-align: center; color: red; margin-top: 20%; font-size: 50px;'>No books found</h1><br>";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "Please Enter Data";
}
?>
