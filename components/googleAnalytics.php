<!-- Google tag (gtag.js) -->

<?php

$myGoogleAnalyticsId = 'G-0000000000'; //Change here your to your Google Analytics Id

echo '<script async src="https://www.googletagmanager.com/gtag/js?id=G-' . $myGoogleAnalyticsId . '"></script>';

echo "<script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());
  
    gtag('config', '" . $myGoogleAnalyticsId . "');
  </script>";


?>