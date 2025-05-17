<?php

if (isset($_POST['Submit'])) {
    $Rollno = $_POST['rollno'];

    if (empty($Rollno)) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'> Please Fill the Data</h1><br>");
    }

    $conn = mysqli_connect("localhost", "root", "", 'library');

    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!, Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }

    $issue="SELECT Issue_Date FROM book_issue WHERE Rollno=$Rollno";
    $return="SELECT Return_Date FROM book_issue WHERE Rollno=$Rollno";
    $diff= 30-$return;

    
    if($diff>0){
        echo $diff*20;
    }




    $query = "SELECT * FROM book_issue WHERE Rollno = $Rollno";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        echo "<h2 style='text-align: center;'>Books Published by: $pub</h2>";
        echo "<table border='1' cellpadding='8' cellspacing='0' style='margin: auto; width: 80%; text-align: center;'>
                    <tr>
                        <th>Roll NO</th>
                        <th>Class</th>
                        <th>Book Id</th>
                        <th>Issue Date</th>
                        <th>Fine</th>
                    </tr>";
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>
                    <td>" . $row["Rollno"] . "</td>
                    <td>" . $row["Class"] . "</td>
                    <td>" . $row["Book_id"] . "</td>
                    <td>" . $row["Issue_Date"] . "</td>
                    <td>".$fine."</td>
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
