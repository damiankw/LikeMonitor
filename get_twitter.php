<?php
  /* get_twitter.php
   * This will pull the number of followers from any given Twitter page.
   *
   * 2018 Damian West <damian@damian.id.au>
   */

  require_once('monitor.php');

  // we need to be given a page variable with the Twitter page
  if (!isset($_GET['page'])) {
    die('ERROR [0001] NO PAGE GIVEN');
  }

  echo get_twitter($_GET['page'], (isset($_GET['img']) ? $_GET['img'] : false));
?>
