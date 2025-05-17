<?php

if (isset($_POST['Submit'])) {
    $pub = $_POST['pub'];

    if (empty($pub)) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh! Field is Required, Please Fill the Data</h1><br>");
    }

    $conn = mysqli_connect("localhost", "root", "", 'library');

    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!, Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }

    $query = "SELECT * FROM book WHERE Publisher = '$pub'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        echo "<h2 style='text-align: center;'>Books Published by: $pub</h2>";
        echo "<table border='1' cellpadding='8' cellspacing='0' style='margin: auto; width: 80%; text-align: center;'>
                    <tr>
                        <th>Book ID</th>
                        <th>Book Name</th>
                        <th>Book Price</th>
                        <th>Author</th>
                    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["Book_id"] . "</td>
                    <td>" . $row["Book_Name"] . "</td>
                    <td>" . $row["Book_Price"] . "</td>
                    <td>" . $row["Author"] . "</td>
                  </tr>";
        }
        echo "</tbody></table><br>";
    } else {
        echo "<h1 style='text-align: center; color: red; margin-top: 20%; font-size: 50px;'>No books found for the entered publisher</h1><br>";
    }
    mysqli_close($conn);
} else {
    echo "Please Enter Data";
}
?>
