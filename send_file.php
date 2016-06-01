<?php
    //Get arguments from CLI and validate it
    if ( count($argv) != 4 ) {
        echo "Usage: ".$argv[0]." username password /path/nmap_scan.xml\n";
        exit;
    }
   if ( !is_file($argv[3]) ) {
        echo "File does not exist\n";
        echo "Usage: ".$argv[0]." username password /path/nmap_scan.xml\n";
        exit;
   }

        $target_url = 'https://kanboard.gbmcloud.com/angello/upload.php';
        //This needs to be the full path to the file you want to send.
        $file_name_with_full_path = realpath($argv[3]);
        /* curl will accept an array here too.
         * Many examples I found showed a url-encoded string instead.
         * Take note that the 'key' in the array will be the key that shows up in the
         * $_FILES array of the accept script. and the at sign '@' is required before the
         * file name.
         */
        $post = array('extra_info' => '123456','file_contents'=>'@'.$file_name_with_full_path);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL,$target_url);
        curl_setopt($ch, CURLOPT_POST,1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
        curl_setopt($ch, CURLOPT_USERPWD, "$argv[1]:$argv[2]");
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
        $result=curl_exec ($ch);
        curl_close ($ch);
        echo $result;
?>
