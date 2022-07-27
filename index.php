<!-- 
  This weather app was made with SASS (SCSS), HTML, PHP and JS.
  it was put together and developed by Thomas Ewan Sykes (Mad_Tom05 (on all socials)) and Pythona Studios.
  Yes there are many spelling mistakes (like the search css file), but it's kinda on brand with me, it spell alot wrong :)
  
  github: https://github.com/ThomasEwanSykes/simple-weather-app/
  website: tom-sykes.co.uk - pythonastudios.com - tomsykes.gay

  copyright 2022 Pythona Studios
 -->

<!DOCTYPE html>
<html lang="en-us">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Weather - by Thomas Ewan Sykes & Pythona Studios</title>
  <link rel="stylesheet" href="./style.css">
  <link rel="stylesheet" href="./sherch.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>
  <meta name="application-name" content="Weather by Thomas Ewan Sykes" />
  <meta name="keywords" content="Weahter, your location, date, sky, snow, sun" />
  <meta name="description" content="This is a simple weather app by Thomas Ewan Sykes & Pythona Studios">
  <meta name="author" content="Thomas Ewan Sykes & Pythona Studios">
  <link rel="index" title="Weather - by Thomas Ewan Sykes & Pythona Studios" href="https://weather.tom-sykes.co.uk" />
  <meta http-equiv="Cache-Control" content="no-cache">
</head>

<body>
<?php
//whether ip is from share internet
if (!empty($_SERVER['HTTP_CLIENT_IP']))   
  {
    $ip_address = $_SERVER['HTTP_CLIENT_IP'];
  }
//whether ip is from proxy
elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR']))  
  {
    $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];
  }
//whether ip is from remote address
else
  {
    $ip_address = $_SERVER['REMOTE_ADDR'];
  }
?>
  <?php
  error_reporting(0);
  $url = 'http://ip-api.com/json/' . $ip_address . '?fields=city';
  $location = json_decode(file_get_contents($url), true);
  $myLoc = new stdClass();
  $myLoc = json_decode(file_get_contents($url), true);
  $Locjson = json_encode($myLoc);
  $ljosn = json_decode(file_get_contents($url), true);

  $key = ''; //sign up on weatherapi.com to get your API key and put it in between the ''; if not it WILL NOT work
  if (isset($_GET['query'])) {
    $query = $_GET['query'];
  } else {
    $query = $ljosn["city"];
  }
  $json = file_get_contents('http://api.weatherapi.com/v1/current.json?key=' . $key . '&q=' . $query . '&api=no');
  $obj = json_decode($json);
  ?>

  <article class="widget">
    <div class="title">
      <h1 class="title">Weather</h1><br>
    </div>
    <div class="title">
      <label>Enter you Country, County, City, Post code Etc.</label>
    </div>
    <div class="search">
      <div class="Icon">
        <form action="" method="">
          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#657789" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
            <circle cx="11" cy="11" r="8" />
            <line x1="21" y1="21" x2="16.65" y2="16.65" />
          </svg>
      </div>
      <div class="InputContainer">

        <input name="query" type="text" placeholder="London" />
        </form>
      </div>
    </div>
    <div class="weatherIcon"><?php echo '<img width="50"  src="' . $obj->current->condition->icon . '" alt="">'; ?></div>
    <div class="weatherInfo">
      <div class="temperature"><span><?php echo $obj->current->temp_c; ?>&deg;</span></div>
      <div class="description">
        <div class="weatherCondition"><?php echo $obj->current->condition->text; ?></div>
        <div class="place"><?php echo $obj->location->name, ', ' . $obj->location->country ?></div>
      </div>
    </div> <?php $epoch = $obj->current->last_updated_epoch;
            $dt = new DateTime("@$epoch");
            ?>
    <div class="date"><?php echo $dt->format('d l F Y h:ia'); ?></div>
  </article>
</body>
</html>
