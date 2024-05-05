<?php
$conn = mysqli_connect("localhost","jacopo","Dianaidra24?","sport_portal_db") ;

if (!$conn)
{
echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
?>