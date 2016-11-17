<?php

function debug_to_console( $data ) {

    if ( is_array( $data ) )
        $output = "<script>console.log( 'Debug Objects: " . implode( ',', $data) . "' );</script>";
    else
        $output = "<script>console.log( 'Debug Objects: " . $data . "' );</script>";

    echo $output;
}


/*
 *---------------------------------------------------------------
 * CONFIGURATION
 *---------------------------------------------------------------
 *
 * Different variables to be configured
 */

// The directory where your pointclouds are saved
define("DATAFOLDER", "/data");

// The filenames of the pointclouds
define("PCFILE", "pc.csv");
define("PCINFO", "info.csv");
define("PCIMG", "img.png");

// Can be development or production
define("ENVIRONMENT", "development");

// The development url
define("DEVELURL", "");

// The production url
define("PRODURL", "");




/*
 *---------------------------------------------------------------
 * URL PARSER
 *---------------------------------------------------------------
 *
 * Parses the url and load the correct page.
 */

// Parse the url
include('app/helpers/url.php');
$pathInfo = parsePath();

// Load pages
if (sizeof($pathInfo['call_parts']) > 0) {
  $page = $pathInfo['call_parts'][0];
  switch ($page) {
    case 'view':
      $pcFolder = (isset($_REQUEST['c']) ? $_REQUEST['c'] : null);
      include('app/views/viewer.php');
      break;
    case '404':
      include('app/views/404.php');
      break;
    default:
      //include('app/views/home.php');
      $pcFolder = (isset($_REQUEST['c']) ? $_REQUEST['c'] : null);
      include('app/views/viewer.php');
      break;
  }
}
else {
  $pcFolder = (isset($_REQUEST['c']) ? $_REQUEST['c'] : null);
  include('app/views/viewer.php');
}

?>
