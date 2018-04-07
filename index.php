<?php
  require_once('config.php');

  $FACEBOOK = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_facebook.php?page='. $_CONFIG['facebook']);
  $TWITTER = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_twitter.php?page='. $_CONFIG['twitter']);
  $INSTAGRAM = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_instagram.php?page='. $_CONFIG['instagram']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" media="screen" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/css/bootstrap.min.css">

  <title><?php echo $_CONFIG['title']; ?></title>
  <style>
    body {
      background-color: #000000;
      font-size: 100pt;
      color: #FFFFFF;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row text-center">
      <img src="<?php echo $_CONFIG['logo']; ?>" />
    </div>
    <div class="row">
      <div class="col-md-3">
        <img src="http://pngimg.com/uploads/facebook_logos/facebook_logos_PNG19762.png" height="200px" />
      </div>
      <div class="col-md-9">
        <?php echo number_format($FACEBOOK); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <img src="http://www.freelogovectors.net/wp-content/uploads/2013/04/twitter_bird_icon-785x785.jpg" height="200px" />
      </div>
      <div class="col-md-9">
        <?php echo number_format($TWITTER); ?>
      </div>
    </div>
    <div class="row">
      <div class="col-md-3">
        <img src="http://www.pingview.io/wp-content/uploads/2016/09/instagram-logo.png" height="200px" />
      </div>
      <div class="col-md-9">
        <?php echo number_format($INSTAGRAM); ?>
      </div>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script>
  </script>

</body>

</html>
