<?php
function n2c($N) {
  $DATA = '';
  for ($i=0; $i<strlen($N); $i++) {
    $DATA .= '<img src="images/card-'. substr($N, $i, 1) .'.png" height="150px" />';
  }
  
  return $DATA;
}

function get_twitter($PAGE, $IMG=false) {
  // build the URL for Twitter
  $URL = 'https://twitter.com/' . $PAGE;

  // set up CURL and execute (we are making out to be a browser here)
  $CURL = curl_init($URL);
  curl_setopt($CURL, CURLOPT_POST, false );
  curl_setopt($CURL, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($CURL, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
  curl_setopt($CURL, CURLOPT_HEADER, false );
  curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true );
  $HTML = curl_exec($CURL);

  // check if there is a valid return, if not the page must be invalid (this will be outdated after 1bil followers on a page. i'm not good at regex)
  if (!preg_match('/<a href="\/'. $PAGE .'\/followers">([\s\S]*?)<\/a>/', $HTML, $MATCH)) {
    die('ERROR [0002] PAGE INVALID');
  }

  // get the number of followers from the output of the first check
  preg_match('/<div class="statnum">(\d{1,3}\,\d{1,3}\,\d{1,3}\,\d{1,3}|\d{1,3}\,\d{1,3}\,\d{1,3}|\d{1,3}\,\d{1,3}|\d{1,3})<\/div>/', $MATCH[1], $MATCH);

  // build the full number
  $TOTAL = sprintf('%06d', str_replace(',', '', $MATCH[1]));
  
  // output whatever is required
  if ($IMG) {
    return n2c(substr($TOTAL, 0, 3)) .' '. n2c(substr($TOTAL, 3, 3));
  } else {
    return $TOTAL;
  }
}

function get_facebook($PAGE, $IMG=false) {
  // build the URL for Facebook
  $URL = 'https://www.facebook.com/plugins/fan.php?connections=100&id=' . $_GET['page'];

  // set up CURL and execute (we are making out to be a browser here)
  $CURL = curl_init($URL);
  curl_setopt($CURL, CURLOPT_POST, false );
  curl_setopt($CURL, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($CURL, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
  curl_setopt($CURL, CURLOPT_HEADER, false );
  curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true );
  $HTML = curl_exec($CURL);

  // check if there is a valid return, if not the page must be invalid (this will be outdated after 1bil followers on a page. i'm not good at regex)
  if (!preg_match('/>(\d{1,3}\,\d{1,3}\,\d{1,3}\,\d{1,3}|\d{1,3}\,\d{1,3}\,\d{1,3}|\d{1,3}\,\d{1,3}|\d{1,3}) likes</', $HTML, $MATCH)) {
    die('ERROR [0002] PAGE INVALID');
  }

  // return the solid number with no commas
  $TOTAL = sprintf('%06d', str_replace(',', '', $MATCH[1]));

  // output whatever is required
  if ($IMG) {
    return n2c(substr($TOTAL, 0, 3)) .' '. n2c(substr($TOTAL, 3, 3));
  } else {
    return $TOTAL;
  }
}

function get_instagram($PAGE, $IMG=false) {
  // build the URL for Instagram
  $URL = 'https://www.instagram.com/' . $PAGE .'/?__a=1';

  // set up CURL and execute (we are making out to be a browser here)
  $CURL = curl_init($URL);
  curl_setopt($CURL, CURLOPT_POST, false );
  curl_setopt($CURL, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($CURL, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
  curl_setopt($CURL, CURLOPT_HEADER, false );
  curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true );
  $JSON = curl_exec($CURL);

  // turn JSON into array
  $DATA = json_decode($JSON, true);

  // output the required information
  $TOTAL = sprintf('%06d', $DATA['graphql']['user']['edge_followed_by']['count']);

  // output whatever is required
  if ($IMG) {
    return n2c(substr($TOTAL, 0, 3)) .' '. n2c(substr($TOTAL, 3, 3));
  } else {
    return $TOTAL;
  }
}
?>