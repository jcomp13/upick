<?php
// Define database connection constants


//$loc = "web";
$loc  = "local";

if ($loc=="local") {
  define('DB_HOST', 'localhost');
  define('DB_USER', 'root');
  define('DB_PASSWORD', '');
  define('DB_NAME', 'football');
}
else {
  define('DB_HOST', 'localhost');
  define('DB_USER', 'jerseyshoreuser');
  define('DB_PASSWORD', 'Rockybear13');
  define('DB_NAME', 'jerseyshoreuser');
}
?>
