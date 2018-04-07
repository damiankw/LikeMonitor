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
  $JSON = curl_exec($CURL);

  // turn JSON into array
  $DATA = json_decode($JSON, true);

  // output the required information
  echo sprintf('%06d', $DATA['graphql']['user']['edge_followed_by']['count']);
?>
