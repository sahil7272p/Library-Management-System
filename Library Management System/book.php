<?php

if(isset($_POST['Submit'])){

    $Bname = $_POST['bname'];
    $Bid = $_POST['bid'];
    $Bp =$_POST['bp'];
    $Bpub = $_POST['pub'];
    $Author = $_POST['AN'];

    if (empty($Bname) || empty($Bid) || empty($Bp) || empty($Bpub) || 
        empty($Author)) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'> Oh! All Fields are Required, Please Fill the Missing Data</h1><br>");
    }

    $conn = mysqli_connect("localhost", "root", "",'library');

    
    if (!$conn) {
        die("<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Oh!,Not Connected to the Server</h1><br>" . mysqli_connect_error());
    }

    
    mysqli_select_db($conn, 'library');

    

    $sql = "CREATE TABLE IF NOT EXISTS book(
        Book_Name VARCHAR(50),
        Book_id BIGINT(20) PRIMARY KEY,
        Book_Price BIGINT(20),
        Publisher VARCHAR(50),
        Author VARCHAR(50)
    );";
    

    if (!mysqli_query($conn, $sql)) {
        die("Table Not Created: " . mysqli_error($conn)); 
    }

    
    $sql = "INSERT INTO Book(Book_Name,Book_id,Book_Price, Publisher, Author) 
            VALUES ('$Bname', $Bid, $Bp, '$Bpub', '$Author')";

    if (!mysqli_query($conn, $sql)) {
        die("Data Not Inserted: " . mysqli_error($conn)); 
    } 
    else {
        echo "<h1 style='text-align: center; color: blue; margin-top: 20%; font-size: 50px;'>Thanks, Your Response has been Submitted <BR>--< GO BACK >-- </h1><br>";
    }
    
    mysqli_close($conn);
    
    header("Location: book.html");
    exit();
} 

else {
    echo "Please Enter Data";
}
?>
