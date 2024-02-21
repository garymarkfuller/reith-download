<?php
$urls = [
    'https://podcasts.files.bbci.co.uk/p02p8ttc.rss',
    'https://podcasts.files.bbci.co.uk/p02p8xh7.rss',
    'https://podcasts.files.bbci.co.uk/b00729d9.rss'
];
$url_no = 0;
foreach($urls as $url) {
    $xml = simplexml_load_string(file_get_contents($url));
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    $file_no = 0;
    foreach($array['channel']['item'] as $lecture) {
        if ($fp_remote = fopen($lecture['enclosure']['@attributes']['url'], 'rb')) {

            // local filename
            $local_file = 'lectures/' . $url_no . '-' . $file_no . '-' . str_replace(' ', '-', strtolower($lecture['title'])) . '.mp3';
        
             // read buffer
            if ($fp_local = fopen($local_file, 'wb')) {
                while ($buffer = fread($fp_remote, 8192)) {
        
                    // write buffer in file
                    fwrite($fp_local, $buffer);
                }
        
                // close local
                fclose($fp_local);
               
            }
            // close remote
            fclose($fp_remote);
        }
        $file_no++; 
    } 
    $url_no++;
}
