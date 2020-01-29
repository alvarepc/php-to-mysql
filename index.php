<?php

# https://github.com/debianmaster/openshift-examples/tree/master/php-mysql-example
# https://github.com/gshipley/phpdatabase

echo "Welcome to OpenShift Online Developer Preview";
echo "<br>To test the database, hit the dbtest.php URL";
echo "<br><br>This assumes that you have the correct env variables set";
echo "<BR><BR>The environment variables required are databaseuser, databasepassword, and databasenmae.";

$dbhost = getenv("MYSQL_SERVICE_HOST");
$dbport = getenv("MYSQL_SERVICE_PORT");
$dbuser = getenv("databaseuser");
$dbpwd = getenv("databasepassword");
$dbname = getenv("databasename");

$connection = new mysqli($dbhost, $dbuser, $dbpwd, $dbname);
if ($connection->connect_errno) {
    printf("Connect failed: %s\n", $mysqli->connect_error);
    exit();
} else {
    printf("Connected to the database\n");
	# Display the table
	$query = "SELECT * FROM instructor";
	if ($result = $mysqli->query($query)) {
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
		printf("Instructor table not found!\n");
	}
}
$connection->close();
?>