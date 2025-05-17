<?php
// Check if the form is submitted
if (isset($_POST['Submit'])) {
    // Retrieve the start and end dates from the form
    $startDate = $_POST['date1'];
    $endDate = $_POST['date2'];

    // Check if dates are provided
    if (empty($startDate) || empty($endDate)) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Please provide both start and end dates.</h1><br>");
    }

    // Create connection to the MySQL server
    $conn = mysqli_connect("localhost", "root", "", 'library');

    // Check connection
    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!, Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }

    // Query to fetch books issued between the two dates
    $query = "SELECT * FROM Book_issue WHERE Issue_Date BETWEEN '$startDate' AND '$endDate'";

    $result = mysqli_query($conn, $query);

  
    if (mysqli_num_rows($result) > 0) {
        
        echo "<table border='1' cellpadding='10' cellspacing='0' style='margin: auto; width: 80%; text-align: center; border-collapse: collapse; border: 2px solid solid; margin-top: 10px;'>
                <thead>
                    <tr>
                        <th>Roll No.</th>
                        <th>Class</th>
                        <th>Book Id</th>
                        <th>Issue Date</th>
                    </tr>
                </thead>
                <tbody>";

        // Fetch and display each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["Rollno"] . "</td>
                    <td>" . $row["Class"] . "</td>
                    <td>" . $row["Book_id"] . "</td>
                    <td>" . $row["Issue_Date"] . "</td>
                  </tr>";
        }

        // End the table
        echo "</tbody></table>";
    } else {
        echo "<h1 style='text-align: center; color: red; margin-top: 20%; font-size: 50px;'>No books found between the provided dates</h1><br>";
    }

    // Close the connection
    mysqli_close($conn);
} else {
    echo "Please Enter Data";
}
?>
