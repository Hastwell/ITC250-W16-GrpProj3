<?php
/**
 * Created by PhpStorm.
 * User: ahand
 * Date: 2/18/16
 * Time: 11:01 AM
 */
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials
require_once 'Article.php';



if(!isset($_SESSION)){
    session_start();
    $_SESSION['time_exp'] = $now + (60 * 15);
}

$now = time();

if (isset($_SESSION['time_exp']) && $now > $_SESSION['time_exp']){
    unset($_SESSION['time_exp']);
    $_SESSION['time_exp'] = $now + (60 * 15);
}


//if( ini_get('allow_url_fopen') ) {
//    echo "allow_url_fopen is enabled.";
//}else { echo "allow_url_fopen is disabled.";}


get_header(); #defaults to theme header or header_inc.php
?>
    <h3 align="center"><?=smartTitle();?></h3>
<?php





    $req = $_GET['url'];
if(!isset($_SESSION['feed'])){
    $_SESSION['feed'] = file_get_contents($req);
}
    $resp = $_SESSION['feed'];
    $xml = simplexml_load_string($resp);

    //var_dump($xml);


    foreach ($xml->channel->item as $story) {
        $article = new Article($story);
        echo $article->getArticle();
    }
get_footer();