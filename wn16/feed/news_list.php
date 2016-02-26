<?php
/**
 * demo_list.php along with demo_view.php provides a sample web application
 *
 * @package nmListView
 * @author Bill Newman <williamnewman@gmail.com>
 * @version 2.10 2012/02/28
 * @link http://www.newmanix.com/
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License ("OSL") v. 3.0
 * @see demo_view.php
 * @todo none
 */

# '../' works for a sub-folder.  use './' for the root  
require '../inc_0700/config_inc.php'; #provides configuration, pathing, error handling, db credentials 

/**
 *
 * SELECT QUERY
 * PAGE DESCRIPTION
 *
 */

# SQL statement
$sql = "select * from `wn16_newscategories`";

#Fills <title> tag. If left empty will default to $PageTitle in config_inc.php  
$config->titleTag = 'News Feed List';

#Fills <meta> tags.  Currently we're adding to the existing meta tags in config_inc.php
$config->metaDescription = 'Seattle Central\'s ITC280 P3 News Feed List ' . $config->metaDescription;
$config->metaKeywords = 'News, Local, Tech'. $config->metaKeywords;

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
<h3 align="center"><?=smartTitle();?></h3>
<?php


# connection comes first in mysqli (improved) function
$result = mysqli_query(IDB::conn(),$sql) or die(trigger_error(mysqli_error(IDB::conn()), E_USER_ERROR));

/**
 *
 * RESULTS HERE
 *
 */

if(mysqli_num_rows($result) > 0)
{#records exist - process
    while($row = mysqli_fetch_assoc($result))
    {# process each row
        echo '<div align="center"><a href="' . VIRTUAL_PATH . 'feed/news_view.php?id=' . (int)$row['CategoryID'] . '">' . dbOut($row['CategoryName']) . '</a>';

    }
}else{#no records
    echo "<div align=center>No Records Found.</div>";
}
@mysqli_free_result($result);

get_footer(); #defaults to theme footer or footer_inc.php
?>
