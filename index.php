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
	$query = "SELECT * FROM instructors";
	if ($result = $connection->query($query)) {
		echo '<table border="0" cellspacing="2" cellpadding="2"> 
		<tr> 
			<td> <font face="Arial">instructorNumber</font> </td> 
			<td> <font face="Arial">instructorName</font> </td> 
			<td> <font face="Arial">email</font> </td> 
			<td> <font face="Arial">city</font> </td> 
			<td> <font face="Arial">state</font> </td> 
			<td> <font face="Arial">postalCode</font> </td> 
			<td> <font face="Arial">country</font> </td> 
		</tr>';
		/* fetch associative array */
		while ($row = $result->fetch_assoc()) {
			echo '<tr> 
					<td>'.$row["col1"].'</td> 
					<td>'.$row["col2"].'</td> 
					<td>'.$row["col3"].'</td> 
					<td>'.$row["col4"].'</td> 
					<td>'.$row["col5"].'</td> 
					<td>'.$row["col6"].'</td> 
					<td>'.$row["col7"].'</td> 
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
