<?php
  require_once('config.php');

  $FACEBOOK = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_facebook.php?page='. $_CONFIG['facebook']);
  $TWITTER = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_twitter.php?page='. $_CONFIG['twitter']);
  $INSTAGRAM = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_instagram.php?page='. $_CONFIG['instagram']);

  // converts a standard number to cards
  function n2c($N) {
    $a=strlen($N);
    for ($i=0; $i<strlen($N); $i++) {
      echo '<img src="images/card-'. substr($N, $i, 1) .'.png" height="150px" />';
    }
  }

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
      background-color: #313237;
      font-size: 100pt;
      color: #FFFFFF;
    }
    
    img {
      padding: 5px;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="row text-center">
      <img src="<?php echo $_CONFIG['logo']; ?>" />
    </div>
    <div class="row text-center">
      <a href="https://www.facebook.com/<?php echo $_CONFIG['facebook']; ?>"><img src="images/logo-facebook.png" height="150px" /></a>
      <?php n2c(substr($FACEBOOK, 0, 3)); ?> <?php n2c(substr($FACEBOOK, 3, 3)); ?>
    </div>
    <div class="row text-center">
      <a href="https://www.twitter.com/<?php echo $_CONFIG['twitter']; ?>"><img src="images/logo-twitter.png" height="150px" /></a>
      <?php n2c(substr($TWITTER, 0, 3)); ?> <?php n2c(substr($TWITTER, 3, 3)); ?>
    </div>
    <div class="row text-center">
      <a href="https://www.instagram.com/<?php echo $_CONFIG['instagram']; ?>"><img src="images/logo-instagram.png" height="150px" /></a>
      <?php n2c(substr($INSTAGRAM, 0, 3)); ?> <?php n2c(substr($INSTAGRAM, 3, 3)); ?>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script>
  </script>

</body>

</html>
