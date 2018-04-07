<?php
  /* get_twitter.php
   * This will pull the number of followers from any given Twitter page.
   *
   * 2018 Damian West <damian@damian.id.au>
   */

  // we need to be given a page variable with the Twitter page
  if (!isset($_GET['page'])) {
    die('ERROR [0001] NO PAGE GIVEN');
  }

  // build the URL for Twitter
  $URL = 'https://twitter.com/' . $_GET['page'];

  // set up CURL and execute (we are making out to be a browser here)
  $CURL = curl_init($URL);
  curl_setopt($CURL, CURLOPT_POST, false );
  curl_setopt($CURL, CURLOPT_FOLLOWLOCATION, true );
  curl_setopt($CURL, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7");
  curl_setopt($CURL, CURLOPT_HEADER, false );
  curl_setopt($CURL, CURLOPT_RETURNTRANSFER, true );
  $HTML = curl_exec($CURL);

  // check if there is a valid return, if not the page must be invalid (this will be outdated after 1bil followers on a page. i'm not good at regex)
  if (!preg_match('/<a href="\/'. $_GET['page'] .'\/followers">([\s\S]*?)<\/a>/', $HTML, $MATCH)) {
    die('ERROR [0002] PAGE INVALID');
  }

  // get the number of followers from the output of the first check
  preg_match('/<div class="statnum">(\d{1,3}\,\d{1,3}\,\d{1,3}\,\d{1,3}|\d{1,3}\,\d{1,3}\,\d{1,3}|\d{1,3}\,\d{1,3}|\d{1,3})<\/div>/', $MATCH[1], $MATCH);

  // return the solid number with no commas
  echo sprintf('%06d', str_replace(',', '', $MATCH[1]));
?>
