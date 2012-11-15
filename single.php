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
<script type="text/javascript" 
           src="http://maps.google.com/maps/api/js?sensor=false&key=AIzaSyA3x9A0bb14zaTAEWNxZlUVSk9DjFYFApk"></script>
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
?>
<center>

<?php
if(isset($_REQUEST['sesh']) && isset($_REQUEST['uid']))
{

	
			
			$selector = "SELECT `id` ,`uid` ,`uname` ,`loc` ,`post` ,`premise` ,`img` ,`latlon` FROM `".$_REQUEST['sesh']."` WHERE uid = '".$_REQUEST['uid']."' LIMIT 1";
			$result = mysql_query($selector) or die(mysql_error());
			while ($row = mysql_fetch_row($result)) {
				echo("<div style='float:left;'>");
			echo("<b>".$row[2]."</b> (User ".$row[1].")");
			echo("<br /> <strong>Location:</strong>".$row[3]);
			echo("<br /> <strong>Postal Code:</strong>".$row[4]);
			echo("<br /> <strong>Premise:</strong>".$row[5]);
			echo('<br /> <div id="map" style="width: 500px; height: 300px"></div>');
			echo("</div>");
			echo("<div style='float:right;'>");
			echo("<br /><img src='".$row[6]."' />");	
			echo("</div>");
			?>
			<script type="text/javascript"> 
		 var myOptions = {
		         zoom: 15,
		         center: new google.maps.LatLng(<?php echo($row[7]); ?>),
		         mapTypeId: google.maps.MapTypeId.ROADMAP
		      };
		var contentString = "<?php echo("<img src='".$row[6]."' width='50' height='40' border='0' /><br /><b>".$row[2]."</b>"); ?>";   
		var map = new google.maps.Map(document.getElementById("map"), myOptions);
		var marker = new google.maps.Marker({
		    map:map,
		    draggable:false,
		    animation: google.maps.Animation.DROP,
		    position: new google.maps.LatLng(<?php echo($row[7]); ?>),
			title: "<?php echo($row[2]); ?>",
		  });
		var infowindow = new google.maps.InfoWindow({
		    content: contentString
		});
		google.maps.event.addListener(marker, 'click', function() {
		  infowindow.open(map,marker);
		});
		   </script>
			<?php
		}

}
	?>
	</center>

</body>
</html>
