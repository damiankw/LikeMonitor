<?php
  require_once('config.php');

  require_once('monitor.php');
  /*
  $FACEBOOK = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_facebook.php?page='. $_CONFIG['facebook']);
  $TWITTER = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_twitter.php?page='. $_CONFIG['twitter']);
  $INSTAGRAM = file_get_contents($_SERVER['REQUEST_SCHEME'] . '://'. $_SERVER['SERVER_NAME'] .'/'. $_SERVER['REQUEST_URI'] .'get_instagram.php?page='. $_CONFIG['instagram']);
  */

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
      padding: 0px 5px 0px 5px;
    }
  </style>
</head>

<body>
    <a href="https://github.com/damiankw/LikeMonitor" class="github-corner" aria-label="Fork me on Github" target="_blank"><svg width="80" height="80" viewBox="0 0 250 250" style="fill:#ee7600; color:#fff; position: absolute; top: 0; border: 0; right: 0;" aria-hidden="true"><path d="M0,0 L115,115 L130,115 L142,142 L250,250 L250,0 Z"></path><path d="M128.3,109.0 C113.8,99.7 119.0,89.6 119.0,89.6 C122.0,82.7 120.5,78.6 120.5,78.6 C119.2,72.0 123.4,76.3 123.4,76.3 C127.3,80.9 125.5,87.3 125.5,87.3 C122.9,97.6 130.6,101.9 134.4,103.2" fill="currentColor" style="transform-origin: 130px 106px;" class="octo-arm"></path><path d="M115.0,115.0 C114.9,115.1 118.7,116.5 119.8,115.4 L133.7,101.6 C136.9,99.2 139.9,98.4 142.2,98.6 C133.8,88.0 127.5,74.4 143.8,58.0 C148.5,53.4 154.0,51.2 159.7,51.0 C160.3,49.4 163.2,43.6 171.4,40.1 C171.4,40.1 176.1,42.5 178.8,56.2 C183.1,58.6 187.2,61.8 190.9,65.4 C194.5,69.0 197.7,73.2 200.1,77.6 C213.8,80.2 216.3,84.9 216.3,84.9 C212.7,93.1 206.9,96.0 205.4,96.6 C205.1,102.4 203.0,107.8 198.3,112.5 C181.9,128.9 168.3,122.5 157.7,114.1 C157.9,116.9 156.7,120.9 152.7,124.9 L141.0,136.5 C139.8,137.7 141.6,141.9 141.8,141.8 Z" fill="currentColor" class="octo-body"></path></svg></a><style>.github-corner:hover .octo-arm{animation:octocat-wave 560ms ease-in-out}@keyframes octocat-wave{0%,100%{transform:rotate(0)}20%,60%{transform:rotate(-25deg)}40%,80%{transform:rotate(10deg)}}@media (max-width:500px){.github-corner:hover .octo-arm{animation:none}.github-corner .octo-arm{animation:octocat-wave 560ms ease-in-out}}</style>
  <div class="container">
    <div class="row text-center">
      <img src="<?php echo $_CONFIG['logo']; ?>" />
    </div>
    <div class="row text-center">
      <a href="https://www.facebook.com/<?php echo $_CONFIG['facebook']; ?>"><img src="images/logo-facebook.png" height="150px" /></a>
      <span id="facebook"><?php echo n2c('000') .' '. n2c('000'); ?></span>
    </div>
    <div class="row text-center">
      <a href="https://www.twitter.com/<?php echo $_CONFIG['twitter']; ?>"><img src="images/logo-twitter.png" height="150px" /></a>
      <span id="twitter"><?php echo n2c('000') .' '. n2c('000'); ?></span>
    </div>
    <div class="row text-center">
      <a href="https://www.instagram.com/<?php echo $_CONFIG['instagram']; ?>"><img src="images/logo-instagram.png" height="150px" /></a>
      <span id="instagram"><?php echo n2c('000') .' '. n2c('000'); ?></span>
    </div>
  </div>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script>
    // set up our pages (this pulls from PHP config)
    var facebook = '<?php echo $_CONFIG['facebook']; ?>';
    var twitter = '<?php echo $_CONFIG['twitter']; ?>';
    var instagram = '<?php echo $_CONFIG['instagram']; ?>';
    
    // this will actually pull the data from the PHP pages
    function get_data() {
      $.get("get_facebook.php?page="+facebook+"&img=true", function(data){
        document.getElementById('facebook').innerHTML = data;
      });
    
      $.get("get_twitter.php?page="+twitter+"&img=true", function(data){
        document.getElementById('twitter').innerHTML = data;
      });
    
      $.get("get_instagram.php?page="+instagram+"&img=true", function(data){
        document.getElementById('instagram').innerHTML = data;
      });
    }

    // pull the data first off
    get_data();
    
    // every x seconds, pull it again
    window.setInterval(function() {
      get_data();
    }, <?php echo $_CONFIG['refresh'] * 1000; ?>);
  </script>

</body>

</html>
