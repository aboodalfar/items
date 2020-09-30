<?php
/**
 * PHP Grid Component
 *
 * @author Abu Ghufran <gridphp@gmail.com> - http://www.phpgrid.org
 * @version 2.0.0
 * @license: see license.txt included in package
 */

include_once("config.php");

include(PHPGRID_LIBPATH."inc/jqgrid_dist.php");
$db_conf = array(
    "type" => PHPGRID_DBTYPE,
    "server" => PHPGRID_DBHOST,
    "user" => PHPGRID_DBUSER,
    "password" => PHPGRID_DBPASS,
    "database" => PHPGRID_DBNAME
);

$g = new jqgrid($db_conf);

$opt["caption"] = "items list";
$opt["autowidth"] = true;
$opt["altRows"] = true; 
$opt["multiselect"] = true; 
$opt["scroll"] = true;
// first column is not autoincrement 
$opt["autoid"] = false; 

$g->set_options($opt);

$g->table = "items_list";

$cols = array();
// multi-select in search filter
$col = array();
$col["title"] = "Unit";
$col["name"] = "unit_id";
$col["dbname"] = "items_list.unit_id";
$col["width"] = "100";


// this will prepare (key:value) option list for dropdown filters
$str = $g->get_dropdown_values("select distinct id as k, name as v from units limit 10;");



// in edit mode render as select
$col["edittype"] = "select";
$col["editoptions"] = array("value"=>":;".$str);

// multi-select in search filter
$col["stype"] = "select-multiple";
$col["searchoptions"]["value"] = $str;


$cols[] = $col;


$g->set_columns($cols,true);


$g->set_actions(array(	
	"add"=>true, // allow/disallow add
	"edit"=>true, // allow/disallow edit
	"delete"=>true, // allow/disallow delete
	"showhidecolumns"=>true, // show/hide row wise edit/del/save option
	"rowactions"=>true, // show/hide row wise edit/del/save option
	"autofilter" => true, // show/hide autofilter for search
	"search" => "advance", // show/hide autofilter for search
) 
);

$out = $g->render("list1");


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" media="screen" href="../../lib/js/themes/base/jquery-ui.custom.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="../../lib/js/jqgrid/css/ui.jqgrid.css" />

	<script src="../../lib/js/jquery.min.js" type="text/javascript"></script>
	<script src="../../lib/js/jqgrid/js/i18n/grid.locale-en.js" type="text/javascript"></script>
	<script src="../../lib/js/jqgrid/js/jquery.jqGrid.min.js" type="text/javascript"></script>
	<script src="../../lib/js/themes/jquery-ui.custom.min.js" type="text/javascript"></script>
	
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>	

</head>
<body>
	<div>
	<?php echo $out?>
	</div>
	
	
	<style>
	.ui-priority-secondary
	{
		background-color: #f5f5f5;
		opacity: 1 !important;
	}
	</style>
	
	<script>
        $( document ).ready(function() {
            setTimeout(function(){ $('#d_tg').remove(); },100);
        });
	</script>	

</body>
</html>