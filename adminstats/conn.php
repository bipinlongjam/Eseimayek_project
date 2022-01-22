<?php

### EDIT HERE ###

// DB CONNECT INFO
$db_host = "localhost";
$db_name = "u244167644_blog_admin_db";
$db_user = "u244167644_eseimayek";
$db_pw = "Lian2019";

// DB TABLE INFO
$GLOBALS['hits_table_name'] = "page_hits";
$GLOBALS['info_table_name'] = "visitor_info";

### STOP EDITING HERE ###

// CONNECT TO DB
try {
	$GLOBALS['db'] = new PDO("mysql:host=".$db_host.";dbname=".$db_name, $db_user, $db_pw, array(PDO::ATTR_PERSISTENT => false, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, PDO::ATTR_EMULATE_PREPARES => false));
}
catch(PDOException $e) {
    echo $e->getMessage();
}

?>
