<?php
header('Cache-Control: no-cache, must-revalidate, max-age=0');
header( 'Cache-control: no-store' , false );
header( 'Pragma: no-cache' );
header( 'Expires: 0' );
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Eleven
 */


get_header(); 
if(isset($_POST['myLoc']))
{
	
		$id = "'".mysql_escape_string($_REQUEST['id'])."'";
		$userid = "'".mysql_escape_string($_REQUEST['userid'])."'";
		$myLoc = "'".mysql_escape_string($_REQUEST['myLoc'])."'";
		$postalCode = "'".mysql_escape_string($_REQUEST['postalCode'])."'";
		$premise = "'".mysql_escape_string($_REQUEST['premise'])."'";
		$imgloc = "'".mysql_escape_string($_REQUEST['imgloc'])."'";
		$sesh = mysql_escape_string($_REQUEST['sesh']);
			mysql_connect(
			  $server = "localhost",
			  $username = "signin_signins",
			  $password = "L7D75XKDDNR7XD91Q")  or die(mysql_error());
			mysql_select_db("signin_signins")  or die(mysql_error());
			
			$init = "CREATE TABLE IF NOT EXISTS `" . $sesh . "` (
			  `id` int(100) NOT NULL AUTO_INCREMENT,
			  `uid` int(100) NOT NULL,
			  `uname` text NOT NULL,
			  `loc` varchar(1000) NOT NULL,
			  `post` varchar(10) NOT NULL,
			  `premise` varchar(1000) NOT NULL,
			  `img` varchar(100) NOT NULL,
			  PRIMARY KEY (`id`),
			  UNIQUE KEY `uid` (`uid`)
			) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;";
				mysql_query($init) or die(mysql_error()); 
				$insert = "INSERT INTO  `$sesh` (`id` ,`uid` ,`uname` ,`loc` ,`post` ,`premise` ,`img`)VALUES (NULL,".$userid.",".$id.",".$myLoc.",".$postalCode.",".$premise.",".$imgloc.")";
				mysql_query($insert) or die(mysql_error()); 
	?>
<center>	<br /><div><h1><?php echo($current_user->user_firstname." ".$current_user->user_lastname); ?> Signed In Successfully!</h1> </div></center>
	</body>
	</html>
	<?php
	exit();
}
	 if (!is_user_logged_in()) 
	{
		?>
		<center>	<br /><br /> <div><h1>Please <a href="wp-login.php" >Log In</a></h1></div> </center>
		<?php
		exit();
	}
?>
<script>

var tries = 0;

 function handle_errors(error)  
    {  
        switch(error.code)  
        {  
            case error.PERMISSION_DENIED: alert("user did not share geolocation data");  
            break;  

            case error.POSITION_UNAVAILABLE: alert("could not detect current position");  
            break;  

            case error.TIMEOUT: alert("retrieving position timed out");  
            break;  

            default: alert("unknown error");  
            break;  
        }  
    }  

    function handle_geolocation_query(position){ 
		
		var submit = document.querySelector('#submit');

		 
		console.log("found you!");
		var geocoder = new google.maps.Geocoder();
	    geocoder.geocode(
	    {
	        'latLng':  new google.maps.LatLng(position.coords.latitude, position.coords.longitude)
	    }, function(results, status) {
	        if(status == google.maps.GeocoderStatus.OK) {
	           var myLoc = results[0].formatted_address;
				var postalCode = extractFromAdress(results[0].address_components,"postal_code");
				var premise = extractFromAdress(results[0].address_components,"premise");
				console.log(myLoc);
				console.log(postalCode);
				console.log(premise);
				$("#myLoc").val(myLoc);
				$("#postalCode").val(postalCode);
				$("#premise").val(premise);
			  $('#submit').show();
			}
	    });

		
    }
	function extractFromAdress(components, type){
	    for (var i=0; i<components.length; i++)
	        for (var j=0; j<components[i].types.length; j++)
	            if (components[i].types[j]==type) return components[i].long_name;
	    return "";
	}

$(document).ready(function() {
	navigator.geolocation.getCurrentPosition(handle_geolocation_query,handle_errors);
	var dateObj =  new Date();
	var date = dateObj.getDate();
	var month = dateObj.getMonth();
	var hour = dateObj.getHours();
	$("#sesh").val(month+"."+date+"."+hour);
	
	$("#camera").webcam({
		width: 320,
		height: 240,
		mode: "save",
		swffile: "jscam.swf",
		onSave: function() {
			$("#imgloc").val("img/<?php echo($current_user->ID); ?>/"+month+"/"+date+"/"+hour+".jpg");
			$("#myForm").submit();
		},
		onCapture: function() {
			URL = 'upload.php?user=<?php echo($current_user->ID); ?>&date='+date+"&month="+month+"&hour="+hour;
			webcam.save(URL);
		},
		debug: function (type, string) {
			if(string == "Camera started")
			{
				document.getElementById
				$("#XwebcamXobjectX").height(0).width(0);
			}
				console.log(type + ": " + string)
		},
		onLoad: function() {


		}
	});

		 });

	
</script>
<center>
		<div>
		<form action="#" method="post" id="myForm" >
			<input type="hidden" name="id" value="<?php echo($current_user->user_firstname." ".$current_user->user_lastname); ?>" />
			<input type="hidden" name="userid" value="<?php echo($current_user->ID); ?>" />
			<input type="hidden" name="myLoc" id="myLoc" value="" />
			<input type="hidden" name="postalCode" id="postalCode" value="" />
			<input type="hidden" name="premise" id="premise" value="" />
			<input type="hidden" name="imgloc" id="imgloc" value="" />
			<input type="hidden" name="sesh" id="sesh" value="" />
		<br />	<input type="submit" class="button" id="submitter" value="Sign In" style="display:none;"/>
		<br /><a href="javascript:webcam.capture();" id="submit" class="button" >Sign In</a>
		</form>
		</div>
			<div id="camera"></div>
		</center>


<?php get_footer(); ?>