<?php
if(isset($_POST['submit'])){
    $Name = $_POST['name'];
    $Rollno = $_POST['rollno']; 
    $Class = $_POST['class'];
    $Section = $_POST['section'] ;
    $Mobile = $_POST['mobile'];
    
    if (empty($Name) || empty($Rollno) || empty($Class) || empty($Section) || 
        empty($Mobile)) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'> Oh! All Fields are Required, Please Fill the Missing Data</h1><br>");
    }

   
    $conn = mysqli_connect("localhost", "root", "");

    
    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!,Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }

    $sql = "CREATE DATABASE IF NOT EXISTS library";
    if (!mysqli_query($conn, $sql)) {
        die("Couldn't create the Database: " . mysqli_error($conn));
    }

    mysqli_select_db($conn, 'library');

    
    $sql = "CREATE TABLE IF NOT EXISTS student(
        Name VARCHAR(50),
        Rollno BIGINT(20) PRIMARY KEY,
        Class VARCHAR(20),
        Section VARCHAR(20),
        Mobile BIGINT(20)
    );";
    

    if (!mysqli_query($conn, $sql)) {
        die("Table Not Created: " . mysqli_error($conn)); 
    }

   
    $sql = "INSERT INTO student(Name, Rollno, Class, Section, Mobile) 
            VALUES ('$Name', $Rollno, '$Class', '$Section', $Mobile)";

    if (!mysqli_query($conn, $sql)) {
        die("Data Not Inserted: " . mysqli_error($conn)); 
    } 
    else {
        echo "<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Thanks, Your Response has been Submitted.<BR>--< GO BACK >-- </h1><br>";
    }
    
    mysqli_close($conn);

    header("Location: student.html");
    exit();
} 

else {
    echo "Please Enter Data";
}
?>
