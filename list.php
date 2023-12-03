<?php
$urls = [
    'https://podcasts.files.bbci.co.uk/p02p8ttc.rss',
    'https://podcasts.files.bbci.co.uk/p02p8xh7.rss',
    'https://podcasts.files.bbci.co.uk/b00729d9.rss'
];

foreach($urls as $url) {
    $xml = simplexml_load_string(file_get_contents($url));
    $json = json_encode($xml);
    $array = json_decode($json,TRUE);
    foreach($array['channel']['item'] as $lecture) {
        echo '<p>' . $lecture['title'] . ' downloads from ' . $lecture['enclosure']['@attributes']['url'] . '</p>';
    }
}
