<h3>PHP - MySQL Test Script</h3>

This script will test connectivity to MySQL from this hosting account. You will need to specify the full hostname of the MySQL server on which the database resides, the database username, password, and database name. This is case sensitive. This script runs SHOW TABLES. It does not make any changes to the database.

<table>
<form method="post" action="<?=$_SERVER['PHP_SELF']; ?>">
<tr>
	<td>Hostname:</td><td><input type="text" id="host" name="host"></td>
</tr>
<tr>
	<td>Username:</td><td><input type="text" id="user" name="user"></td>
</tr>
<tr>
	<td>Password:</td><td><input type="text" id="pass" name="pass"></td>
</tr>
<tr>
	<td>Database:</td><td><input type="text" id="db" name="db"></td>
</tr>
<tr>
<td></td><td><input type="submit" name="submit" id="submit" value="Submit"></td>
</tr>
</form>
</table>

<?php
//Sample Database Connection Syntax for PHP and MySQL.

if ($_POST['submit']) {

//Connect To Database

$hostname=$_POST['host'];
$username=$_POST['user'];
$password=$_POST['pass'];
$dbname=$_POST['db'];

echo "Connecting...<br>";
mysql_connect($hostname,$username, $password) OR DIE ("<html><script language='JavaScript'<alert('Unable to connect to database! Please try again later.'),history.go(-1)</script></html>");
mysql_select_db($dbname);

# Check If Record Exists
echo "Selecting records<br>";
$query = "SHOW TABLES";

$result = mysql_query($query);

echo "Testing results...<br>";
if($result)
{
    echo "<b>Data found!</b> Test passed. MySQL connections via PHP are functioning correctly from this hosting account.<br />";
}
else {
	echo "No data found.<br>";
}
	echo "Done.<br>";
}
?>