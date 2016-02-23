<?php
/**
 * Created by PhpStorm.
 * User: ahand
 * Date: 2/18/16
 * Time: 11:01 AM
 */

require_once 'Article.php';



$url = $_GET['url'];



    $req = $url;
    $resp = file_get_contents($req);
    $xml = simplexml_load_string($resp);

    foreach ($xml->channel->item as $story) {
        $article = new Article($story);
        $article->getFeed();
    }
