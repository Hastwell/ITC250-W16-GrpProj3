<?php
/**
 * feed_view.php along with feed_list.php provides a sample web application
 *
 * @package nmListView
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.10 2012/02/28
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see feed_list.php
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials

# check variable of item passed in - if invalid data, forcibly redirect back to feed_list.php page
if(isset($_GET['id']) && (int)$_GET['id'] > 0){#proper data must be on querystring
    $myID = (int)$_GET['id']; #Convert to integer, will equate to zero if fails
}else{
    myRedirect(VIRTUAL_PATH . "feed/feed_list.php");
}


/**
 *
 * INDIVIDUAL ITEMS FROM LIST PAGE
 *
 */
//sql statement to select individual item
$sql = <<<QUERY

        SELECT f.FeedName, f.FeedURL
            FROM wn16_categoryfeedlink l
        LEFT JOIN wn16_feed f 
            ON f.FeedID = l.FeedID
        RIGHT JOIN wn16_newscategories c 
            ON c.CategoryID = l.CategoryID
        WHERE l.CategoryID = $myID;
QUERY;



//$sql = "select MuffinName,Description,MetaDescription,MetaKeywords,Price from `wn16_feedcategories c` where c.CategoryID =" . $myID;
//---end config area --------------------------------------------------

$foundRecord = FALSE; # Will change to true, if record found!

# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

echo "<h3 style='text-align: center'>News Feeds Available</h3>";

if(mysqli_num_rows($result) > 0)
{#records exist - process
    $foundRecord = TRUE;

    /**
     *
     *  COLUMNS
     *
     */
    echo "<ul id='feedlist'>";
    while ($row = mysqli_fetch_assoc($result))
    {
        $Title = dbOut($row['FeedName']);
        $Link = dbOut($row['FeedURL']);
        if($foundRecord)
        {#records exist - show muffin!
            ?>
            <li style="text-align: center"><a href="news_feed.php?url=<?=$Link?>"<h3><?=$Title?></h3></a></li>
            <hr>
            <?php
        }else{//no such muffin!
            echo '<div align="center">No Items Match Category.</div>';
            echo '<div align="center"><a href="' . VIRTUAL_PATH . 'news_list.php">BACK</a></div>';
        }


    }

    echo "</ul>";
}

@mysqli_free_result($result); # We're done with the data!

if($foundRecord)
{#only load data if record found
//    $config->titleTag = $MuffinName . " muffins made with PHP & love!"; #overwrite PageTitle with Muffin info!
//    #Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
//    $config->metaDescription = $MetaDescription . ' Seattle Central\'s ITC280 Class Muffins are made with pure PHP! ' . $config->metaDescription;
//    $config->metaKeywords = $MetaKeywords . ',Muffins,PHP,Fun,Bran,Regular,Regular Expressions,'. $config->metaKeywords;
}
/*
$config->metaDescription = 'Web Database ITC281 class website.'; #Fills <meta> tags.
$config->metaKeywords = 'SCCC,Seattle Central,ITC281,database,mysql,php';
$config->metaRobots = 'no index, no follow';
$config->loadhead = ''; #load page specific JS
$config->banner = ''; #goes inside header
$config->copyright = ''; #goes inside footer
$config->sidebar1 = ''; #goes inside left side of page
$config->sidebar2 = ''; #goes inside right side of page
$config->nav1["page.php"] = "New Page!"; #add a new page to end of nav1 (viewable this page only)!!
$config->nav1 = array("page.php"=>"New Page!") + $config->nav1; #add a new page to beginning of nav1 (viewable this page only)!!
*/
# END CONFIG AREA ----------------------------------------------------------

get_header(); #defaults to theme header or header_inc.php
?>

<?php


get_footer(); #defaults to theme footer or footer_inc.php
?>
