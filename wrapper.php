<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
ob_start(function($output){
    if( (strpos($output,"<video") > -1 || strpos($output,"<audio") > -1  || strpos($output,"<source") > -1 )  && (strpos($output,"<safe") == FALSE) ){
    //Check If There is Video On The Page Then Load Defa Protector
    // Source Tag Validation isn't need but for safety 
    //If HTML Contains Safe Tag, Then Not Load Defa Protector
                function getURL($matches)
        {
            $crc_one = date(time()) . 'ro7ana' ;
            $crc = sha1($crc_one) . time();
            $_SESSION['defaprotect' . $crc] = $matches['2'];
            return $matches[1] . "video.php?crc=".$crc;
          }
        $output = preg_replace_callback("/(<video[^>]*src *= *[\"']?)([^\"']*)/i", getURL, $output);
        $output = preg_replace_callback("/(<source[^>]*src *= *[\"']?)([^\"']*)/i", getURL, $output);
        $output = preg_replace_callback("/(<audio[^>]*src *= *[\"']?)([^\"']*)/i", getURL, $output);
    }
    return $output;
});

$_SESSION['kay'] = 'kay';


