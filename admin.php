<?php
header("Cache-Control: no-cache, must-revalidate");
/**
 * Front to the WordPress application. This file doesn't do anything, but loads
 * wp-blog-header.php which does and tells WordPress to load the theme.
 *
 * @package WordPress
 */

/**
 * Tells WordPress to load the WordPress theme and output it.
 *
 * @var bool
 */
define('WP_USE_THEMES', false);

/** Loads the WordPress Environment and Template */
require('./wp-blog-header.php');
header('HTTP/1.1 200 OK');
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Sign-In Admin</title>
</head>
<body>
<?php
if(!current_user_can('contributor') && !current_user_can('administrator') )
{
	?>
	<center>	<h1>Please <a href="wp-login.php" class="button">Log In</a></h1> </center>
	</body>
	</html>
	<?php
	exit();
}
mysql_connect(
  $server = "localhost",
  $username = "signin_signins",
  $password = "L7D75XKDDNR7XD91Q")  or die(mysql_error());
mysql_select_db("signin_signins")  or die(mysql_error());
$sql = "SHOW TABLES FROM signin_signins";
$result = mysql_query($sql);
?>
<center>
<form action="#" method="post">

Select Date (Month.Day.Hour)<br />
<select name="sesh">
<?php
while ($row = mysql_fetch_row($result)) {
	$return  = '';
	$return .= "\t" . '<option value="'.$row[0].'">'. $row[0] .'</option>';
	$return .= "\n";
	print($return);    
}

?>
</select><br />
<input type="submit" value="Go" />
</form>
<?php
if(isset($_POST['sesh']))
{
	?>
	Student Sign-In Status<br />
	<table border="1px" width="60%">
		<tr>
			<td>Name</td>
			<td>At School?</td>
			<td>Signed In?</td>
			<td>Image</td>
		</tr>
		<?php
		
		$wp_user_search = $wpdb->get_results("SELECT ID,display_name FROM $wpdb->users ORDER BY ID");
		foreach ( $wp_user_search as $userid ) {
			$user_id       = (int) $userid->ID;
			$display_name  = stripslashes($userid->display_name);
			
			$selector = "SELECT `uname`, `post`, `img` FROM `".$_POST['sesh']."` WHERE uid = '".$user_id."' LIMIT 1";
			$result = mysql_query($selector) or die(mysql_error());
			while ($row = mysql_fetch_row($result)) {
			echo("<tr>");
			echo("<td>".$display_name."</td>");
			if($row[1] == "V0R 2P1")
				{
				echo("<td><img src='http://depts.washington.edu/uwicrc/research/studies/imagesXX/green_dotXX.gif'  /></td>");
				}
			else
				{
					echo("<td><img src='http://www.alpicasa.nl/siteimg/css/home_circle_red_right.png'  /></td>");
				}
			if($row[2])
				{
				echo("<td><img src='http://depts.washington.edu/uwicrc/research/studies/imagesXX/green_dotXX.gif'  /></td>");
				}
			else
				{
					echo("<td><img src='http://www.alpicasa.nl/siteimg/css/home_circle_red_right.png'  /></td>");
				}
			echo("<td><a href='".$row[2]."' target='_blank'>Click Here</a></td>");	
				echo("</tr>");
			}
		}
		
		?>
	</table>
	<?php
	
}
	?>
	</center>

</body>
</html>
