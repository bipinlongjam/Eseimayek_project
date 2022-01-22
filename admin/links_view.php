<?php
// This script and data application were generated by AppGini 5.70
// Download AppGini for free from https://bigprof.com/appgini/download/

	$currDir=dirname(__FILE__);
	include("$currDir/defaultLang.php");
	include("$currDir/language.php");
	include("$currDir/lib.php");
	@include("$currDir/hooks/links.php");
	include("$currDir/links_dml.php");

	// mm: can the current member access this page?
	$perm=getTablePermissions('links');
	if(!$perm[0]){
		echo error_message($Translation['tableAccessDenied'], false);
		echo '<script>setTimeout("window.location=\'index.php?signOut=1\'", 2000);</script>';
		exit;
	}

	$x = new DataList;
	$x->TableName = "links";

	// Fields that can be displayed in the table view
	$x->QueryFieldsTV = array(   
		"`links`.`id`" => "id",
		"`links`.`facebook`" => "facebook",
		"`links`.`twitter`" => "twitter",
		"`links`.`instagram`" => "instagram",
		"`links`.`pinterest`" => "pinterest",
		"`links`.`dribble`" => "dribble",
		"`links`.`comments_script`" => "comments_script",
		"`links`.`sharing_script`" => "sharing_script",
		"`links`.`javascript`" => "javascript"
	);
	// mapping incoming sort by requests to actual query fields
	$x->SortFields = array(   
		1 => '`links`.`id`',
		2 => 2,
		3 => 3,
		4 => 4,
		5 => 5,
		6 => 6,
		7 => 7,
		8 => 8,
		9 => 9
	);

	// Fields that can be displayed in the csv file
	$x->QueryFieldsCSV = array(   
		"`links`.`id`" => "id",
		"`links`.`facebook`" => "facebook",
		"`links`.`twitter`" => "twitter",
		"`links`.`instagram`" => "instagram",
		"`links`.`pinterest`" => "pinterest",
		"`links`.`dribble`" => "dribble",
		"`links`.`comments_script`" => "comments_script",
		"`links`.`sharing_script`" => "sharing_script",
		"`links`.`javascript`" => "javascript"
	);
	// Fields that can be filtered
	$x->QueryFieldsFilters = array(   
		"`links`.`id`" => "ID",
		"`links`.`facebook`" => "Facebook",
		"`links`.`twitter`" => "Twitter",
		"`links`.`instagram`" => "instagram",
		"`links`.`pinterest`" => "Pinterest",
		"`links`.`dribble`" => "Dribble",
		"`links`.`comments_script`" => "Comments script",
		"`links`.`sharing_script`" => "Sharing script",
		"`links`.`javascript`" => "Javascript"
	);

	// Fields that can be quick searched
	$x->QueryFieldsQS = array(   
		"`links`.`id`" => "id",
		"`links`.`facebook`" => "facebook",
		"`links`.`twitter`" => "twitter",
		"`links`.`instagram`" => "instagram",
		"`links`.`pinterest`" => "pinterest",
		"`links`.`dribble`" => "dribble",
		"`links`.`comments_script`" => "comments_script",
		"`links`.`sharing_script`" => "sharing_script",
		"`links`.`javascript`" => "javascript"
	);

	// Lookup fields that can be used as filterers
	$x->filterers = array();

	$x->QueryFrom = "`links` ";
	$x->QueryWhere = '';
	$x->QueryOrder = '';

	$x->AllowSelection = 1;
	$x->HideTableView = ($perm[2]==0 ? 1 : 0);
	$x->AllowDelete = $perm[4];
	$x->AllowMassDelete = false;
	$x->AllowInsert = $perm[1];
	$x->AllowUpdate = $perm[3];
	$x->SeparateDV = 1;
	$x->AllowDeleteOfParents = 0;
	$x->AllowFilters = 1;
	$x->AllowSavingFilters = 0;
	$x->AllowSorting = 1;
	$x->AllowNavigation = 1;
	$x->AllowPrinting = 1;
	$x->AllowCSV = 1;
	$x->RecordsPerPage = 10;
	$x->QuickSearch = 1;
	$x->QuickSearchText = $Translation["quick search"];
	$x->ScriptFileName = "links_view.php";
	$x->RedirectAfterInsert = "links_view.php?SelectedID=#ID#";
	$x->TableTitle = "Links";
	$x->TableIcon = "resources/table_icons/firefox.png";
	$x->PrimaryKey = "`links`.`id`";

	$x->ColWidth   = array(  150, 150, 150, 150, 150, 150, 150, 150);
	$x->ColCaption = array("Facebook", "Twitter", "instagram", "Pinterest", "Dribble", "Comments script", "Sharing script", "Javascript");
	$x->ColFieldName = array('facebook', 'twitter', 'instagram', 'pinterest', 'dribble', 'comments_script', 'sharing_script', 'javascript');
	$x->ColNumber  = array(2, 3, 4, 5, 6, 7, 8, 9);

	// template paths below are based on the app main directory
	$x->Template = 'templates/links_templateTV.html';
	$x->SelectedTemplate = 'templates/links_templateTVS.html';
	$x->TemplateDV = 'templates/links_templateDV.html';
	$x->TemplateDVP = 'templates/links_templateDVP.html';

	$x->ShowTableHeader = 1;
	$x->ShowRecordSlots = 0;
	$x->TVClasses = "";
	$x->DVClasses = "";
	$x->HighlightColor = '#FFF0C2';

	// mm: build the query based on current member's permissions
	$DisplayRecords = $_REQUEST['DisplayRecords'];
	if(!in_array($DisplayRecords, array('user', 'group'))){ $DisplayRecords = 'all'; }
	if($perm[2]==1 || ($perm[2]>1 && $DisplayRecords=='user' && !$_REQUEST['NoFilter_x'])){ // view owner only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `links`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='links' and lcase(membership_userrecords.memberID)='".getLoggedMemberID()."'";
	}elseif($perm[2]==2 || ($perm[2]>2 && $DisplayRecords=='group' && !$_REQUEST['NoFilter_x'])){ // view group only
		$x->QueryFrom.=', membership_userrecords';
		$x->QueryWhere="where `links`.`id`=membership_userrecords.pkValue and membership_userrecords.tableName='links' and membership_userrecords.groupID='".getLoggedGroupID()."'";
	}elseif($perm[2]==3){ // view all
		// no further action
	}elseif($perm[2]==0){ // view none
		$x->QueryFields = array("Not enough permissions" => "NEP");
		$x->QueryFrom = '`links`';
		$x->QueryWhere = '';
		$x->DefaultSortField = '';
	}
	// hook: links_init
	$render=TRUE;
	if(function_exists('links_init')){
		$args=array();
		$render=links_init($x, getMemberInfo(), $args);
	}

	if($render) $x->Render();

	// hook: links_header
	$headerCode='';
	if(function_exists('links_header')){
		$args=array();
		$headerCode=links_header($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$headerCode){
		include_once("$currDir/header.php"); 
	}else{
		ob_start(); include_once("$currDir/header.php"); $dHeader=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%HEADER%%>', $dHeader, $headerCode);
	}

	echo $x->HTML;
	// hook: links_footer
	$footerCode='';
	if(function_exists('links_footer')){
		$args=array();
		$footerCode=links_footer($x->ContentType, getMemberInfo(), $args);
	}  
	if(!$footerCode){
		include_once("$currDir/footer.php"); 
	}else{
		ob_start(); include_once("$currDir/footer.php"); $dFooter=ob_get_contents(); ob_end_clean();
		echo str_replace('<%%FOOTER%%>', $dFooter, $footerCode);
	}
?>