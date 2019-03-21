<html>
<body>

<?php
$servername = "127.0.0.1";
$username = "root";
$password = "seedubuntu";
$dbname = "test";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$uname = $_POST["username"];
$passwd = $_POST["password"];
$fname = $_POST["firstname"];
$lname = $_POST["lastname"];
$email = $_POST["Email"];


$sql = "UPDATE MyGuests SET firstname='$fname', lastname='$lname', email='$email', password='$passwd' WHERE usrname='$uname'";

if ($conn->query($sql) === TRUE) {
    echo "Sign up successfully!";
    header("location: index.html");
} 
else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$sql2 = "SELECT * FROM MyGuests WHERE usrname = '$uname' and password = '$passwd'";

$result = $conn->query($sql2);

if ($result->num_rows === 1) {
    session_start();
    $row = $result->fetch_assoc();
	unset($_SESSION['row']);

   
	if (!isset($_SESSION['row'])) {  
	
    $_SESSION['row'] = $row;        
    header("location: welcome.php");
	}

	
} else {
    echo "Error: " . $sql2 . "<br>" . $conn->error;
}


$conn->close();


?>

</body>
</html>
