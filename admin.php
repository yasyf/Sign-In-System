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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>

<script type="text/javascript" 
           src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyA3x9A0bb14zaTAEWNxZlUVSk9DjFYFApk"></script>
<!-- Add fancyBox -->
<link rel="stylesheet" href="http://clients.mohamedaliurology.com/fancybox/jquery.fancybox-1.3.4.css" type="text/css" media="screen" />
<script type="text/javascript" src="http://clients.mohamedaliurology.com/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
</head>
<body>
<?php
if(!current_user_can('contributor') && !current_user_can('administrator') )
{
	?>
	<center>	<h1>Please <a href="wp-login.php" class="button">Log In</a> as an administrator</h1> </center>
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
	<script type="text/javascript">

	function fancy(userID) {
		$.fancybox({
	        'width'             : '95%',
	        'height'            : '90%',
	        'autoScale'         : false,
	        'type'              : 'iframe',
			'centerOnScroll'	: true,
	        'href'              : "single.php?sesh=<?php echo($_POST['sesh']); ?>&uid="+userID
	    	});
	}
	var myOptions;
	var map;
$(document).ready(function() {
	 myOptions = {
	         zoom: 7,
	         center: new google.maps.LatLng(48.65272968171546,-123.55540037155151),
	         mapTypeId: google.maps.MapTypeId.ROADMAP
	      };
	 map = new google.maps.Map(document.getElementById("map"), myOptions);
});
	</script>
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
			
			$selector = "SELECT `uname`, `post`, `img`, `latlon`, `loc` FROM `".$_POST['sesh']."` WHERE uid = '".$user_id."' LIMIT 1";
			$result = mysql_query($selector) or die(mysql_error());
			while ($row = mysql_fetch_row($result)) {
			echo("<tr>");
			echo("<td><a href='javascript:fancy(".$user_id.")'>".$display_name."</a></td>");
			if($row[1] == "V0R 2P1")
				{
				echo("<td><img src='http://www.imaginecup.lk/App_Themes/Rainbow/images/icon_green_bullet.png'  /></td>");
				}
			else
				{
					echo("<td><img src='http://www.alpicasa.nl/siteimg/css/home_circle_red_right.png'  /></td>");
				}
			if($row[2])
				{
				echo("<td><img src='http://www.imaginecup.lk/App_Themes/Rainbow/images/icon_green_bullet.png'  /></td>");
				}
			else
				{
					echo("<td><img src='http://www.alpicasa.nl/siteimg/css/home_circle_red_right.png'  /></td>");
				}
			echo("<td><a href='".$row[2]."' target='_blank'>Click Here</a></td>");	
				echo("</tr>");
				?>
				<script type="text/javascript">
				var contentString<?php echo($user_id); ?>;
				var marker<?php echo($user_id); ?>;
				var infowindow<?php echo($user_id); ?>;
			$(document).ready(function() {
				 contentString<?php echo($user_id); ?> = "<?php echo("<img src='".$row[2]."' width='50' height='40' border='0' /><br /><a href='javascript:fancy(".$user_id.")'>".$display_name."</a>"); ?>";  
				 marker<?php echo($user_id); ?>  = new google.maps.Marker({
				    map:map,
				    draggable:false,
				    animation: google.maps.Animation.DROP,
				    position: new google.maps.LatLng(<?php echo($row[3]); ?>),
					title: "<?php echo($row[4]); ?>",
					icon: '<?php if($row[2])	{	echo("http://www.imaginecup.lk/App_Themes/Rainbow/images/icon_green_bullet.png");	}	else	{	echo("http://www.alpicasa.nl/siteimg/css/home_circle_red_right.png");	} ?>'
				  });
					 infowindow<?php echo($user_id); ?> = new google.maps.InfoWindow({
					    content: contentString<?php echo($user_id); ?>
					});
					google.maps.event.addListener(marker<?php echo($user_id); ?>, 'click', function() {
					  infowindow<?php echo($user_id); ?>.open(map,marker<?php echo($user_id); ?>);
					});
					});
				</script>
				<?php
			}
		}
		
		?>
	</table>
	<br /> <div id="map" style="width: 500px; height: 300px"></div>
	<?php
}
	?>
	</center>

</body>
</html>
