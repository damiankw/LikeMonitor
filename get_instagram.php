<?php
  /* get_instagram.php
   * This will pull the number of followers from any given Instagram page.
   *
   * 2018 Damian West <damian@damian.id.au>
   */

  // we need to be given a page variable with the Instagram page
  if (!isset($_GET['page'])) {
    die('ERROR [0001] NO PAGE GIVEN');
  }

  // build the URL for Instagram
  $URL = 'https://www.instagram.com/' . $_GET['page'] .'/?__a=1';

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
  echo str_replace(',', '', $MATCH[1]);
?>
