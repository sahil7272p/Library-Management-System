<?php
if (isset($_POST['Submit'])) {
    $Rollno = $_POST['rollno'];
    $Bid = $_POST['bid'];
    $Issue_date=$_POST['issuedate'];
    $Return_Date = $_POST['returndate'];

    if (empty($Rollno) || empty($Bid) || empty($Issue_date) ||empty($Return_Date)) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh! All Fields are Required, Please Fill the Missing Data</h1><br>");
    }

    
    $conn = mysqli_connect("localhost", "root", "", 'library');

    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!, Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }
    
   
    $sql = "DELETE FROM student WHERE Rollno='$Rollno'";

    if (!mysqli_query($conn, $sql)) {
        die("<h1 style='text-align: center; color: red;'>Failed to delete record: " . mysqli_error($conn) . "</h1><br>");
    } else {
        echo ("<h1 style='text-align: center; color: red;'>Record Deleted Successfully</h1><br>");
    }

    $sql = "DELETE FROM book_issue WHERE Rollno='$Rollno'";

    if (!mysqli_query($conn, $sql)) {
        die("<h1 style='text-align: center; color: red;'>Failed to delete record from student: " . mysqli_error($conn) . "</h1><br>");
    } else {
        echo ("<h1 style='text-align: center; color: red;'>Student Record Deleted Successfully</h1><br>");
    }

    mysqli_close($conn);
    header("Location: return.html");
    exit();
} else {
    echo "<h1 style='text-align: center; color: red;'>Please Enter Data</h1>";
}
?>
