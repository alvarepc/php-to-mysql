<?php

# https://github.com/debianmaster/openshift-examples/tree/master/php-mysql-example
# https://github.com/gshipley/phpdatabase

echo "Welcome to OpenShift Online Developer Preview";
echo "<br><br>This assumes that you have the correct env variables set";
echo "<br><br>The environment variables required are MYSQL_SERVICE_HOST, MYSQL_SERVICE_PORT, MYSQL_USER, MYSQL_PASSWORD, MYSQL_DATABASE.";

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("MYSQL_USER");
$dbpwd = getenv("MYSQL_PASSWORD");
$dbname = getenv("MYSQL_DATABASE");

$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
if ($connection->connect_errno) {
    printf("<br><br>Connect failed: %s", $connection->connect_error);
    exit();
} else {
    printf("<br><br>Connected to the database");
	# Display the table
	$query = "SELECT * FROM instructors;";
	if ($result = $connection->query($query)) {
		echo '<table border="0" cellspacing="2" cellpadding="2"> 
		<tr> 
			<td> <font face="Arial">Instructor Number</font> </td> 
			<td> <font face="Arial">Instructor Name</font> </td> 
			<td> <font face="Arial">Email</font> </td> 
			<td> <font face="Arial">City</font> </td> 
			<td> <font face="Arial">State</font> </td> 
			<td> <font face="Arial">Postal Code</font> </td> 
			<td> <font face="Arial">Country</font> </td> 
		</tr>';
		/* fetch associative array */
		while ($row = $result->fetch_assoc()) {
			echo '<tr> 
					<td>'.$row["instructorNumber"].'</td> 
					<td>'.$row["instructorName"].'</td> 
					<td>'.$row["email"].'</td> 
					<td>'.$row["city"].'</td> 
					<td>'.$row["state"].'</td> 
					<td>'.$row["postalCode"].'</td> 
					<td>'.$row["country"].'</td> 
				  </tr>';
		}
		echo '</table>';
		
		/* free result set */
		$result->free();
	}
	else {
		printf("<br><br>Instructors table not found!\n");
	}
}
$connection->close();
?>
