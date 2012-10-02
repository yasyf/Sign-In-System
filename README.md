Inspired by the fact that my school mandates sign-ins at certain times, I attempted to recreate the experience in a much more modern way: virtual sign-in. The current implimentation gathers your physical location, proximity to the school (and therefore presense at the school or not), and captures a picture with your webcam. It also employs WordPress as a user management system.

TThe code is probably much more interesting than the actual site, which doesn't do much more than actually sign you in, capture all the relevant information, and log it for viewing in the administrator area.

The site is located at http://signin.yasyf.com.

The interesting bits of code are probably at [the sign-in page](https://github.com/yasyf/Sign-In-System/blob/master/wp-content/themes/signin/index.php) and [the admin section](https://github.com/yasyf/Sign-In-System/blob/master/admin.php).

More details at http://yasyf.me/.