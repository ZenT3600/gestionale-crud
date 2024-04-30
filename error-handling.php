<?php
  function codeFromString($text){
    return crc32($text) % 1000 + 1000;
  }

  function showError($errorString, $errorDescription) {
    if (!isset($errorString) || $errorString == '') {
      $errorString = "Errore Sconosciuto";
    }
    $errorID = codeFromString($errorString);
    printErrorToast($errorString, $errorDescription, $errorID);
  }

  function printErrorToast($error, $description, $uid) {
    echo "<br/>
    <blockquote id='error-toast' style='border-left: 5px solid #8b0000'>
      <b>" . $error . "</b><br/>
      <i>" . $description . "</i>
      <footer>
        <code>Error Code: " . $uid . "</code>
      </footer>
    </blockquote>";
    exit();
  }
?>
