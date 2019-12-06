<?php
// define the file location to the config
$config = "settings/config.php";

// Check if we can find the config file
if(file_exists($config))
{
  require_once($config);
  require_once('codebird/codebird.php');
  echo '<h4>TWITTER API TEST</h4>';

  \codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
  $cb = \codebird\Codebird::getInstance();
  $cb->setToken(ACCESS_TOKEN_KEY, ACCESS_TOKEN_SECRET);

  $params = array(
    'status' => 'Auto Post on Twitter with PHP http://goo.gl/OZHaQD #php #twitter'
  );
  $reply = $cb->statuses_update($params);

}
else
{
  echo 'CONFIG NOT FOUND';
}
?>
