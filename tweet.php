<?php
  // define the file location to the config
  $config = "settings/config.php";

  // Check if we can find the config file
  if(file_exists($config))
  {
    // Require the config file so we know where our files are
    require_once($config);
    // echo 'settings loaded';

    // set the index to the value return from the read_index function
    $index = read_index();
    // echo $index; // output the index

    $word = read_src($index);

    //echo $word;
    //echo 'Dictionary: https://www.dictionary.com/browse/' . $word;

    // set the next index and write it to the index file
    // we pass through the index value we just retrieved from the read_index function
    set_index($index);

    require_once('codebird/codebird.php');
    echo '<h4>TWITTER API CALL</h4>';

    \codebird\Codebird::setConsumerKey(CONSUMER_KEY, CONSUMER_SECRET);
    $cb = \codebird\Codebird::getInstance();
    $cb->setToken(ACCESS_TOKEN_KEY, ACCESS_TOKEN_SECRET);

    $status = "{$word} is a bitch.";

    $params = array(
      'status' => $status
    );
    $reply = $cb->statuses_update($params);

    echo $status;

  }
  else {
    echo 'Couldnt load settings';
  }

  // This function will read the index file and return the current index number.
  function read_index()
  {
    $src = fopen(FILE_DIR . FILE_INDEX, "r");

    $index = fgets($src);

    fclose($src);

    return (int)$index;
  }

  function read_src($index)
  {
    $lines = file(FILE_DIR . FILE_SRC);
    $index = (int)$index;

    $word = rtrim($lines[$index]);
    return $word;
  }

  // This function will write to next index we want to the index file.
  function set_index($index)
  {
    $src = fopen(FILE_DIR . FILE_INDEX, "w");
    $index++;
    fwrite($src, $index);

    fclose($src);
  }

?>
