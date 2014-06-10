<?php
/**
 * filename: $Source: /syscp/modules_customer_sa-settings.php,v $
 * begin: Thursday, Dec 21 2004
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version. This program is distributed in the
 * hope that it will be useful, but WITHOUT ANY WARRANTY; without even the
 * implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 * See the GNU General Public License for more details.
 *
 * @author Wolfgang Ziegler <nuppla@gmx.at>
 * @copyright 2004 sasettings dev team
 */

    define('AREA', 'customer');

    require("./lib/modules/sasettings/tables.inc.php");
    require("./lib/modules/sasettings/functions.php");

	/**
	 * Include our init.php, which manages Sessions, Language etc.
	 */
	require("./lib/init.php");
	include("./lib/modules/sasettings/insertCss.php");
	
	if(isset($_POST['id']))
	{	$id=intval($_POST['id']);
	}
	elseif(isset($_GET['id']))
	{	$id=intval($_GET['id']);
	}
	
	if(($page == "domains" || $page == "overview") && $action == "")
	{	eval("echo \"".getTemplate("modules/sasettings/domains_top")."\";");
		$result=$db->query(
			'SELECT `id`, `domain` '.
			'FROM `'.TABLE_PANEL_DOMAINS.'` '.
			'WHERE `customerid`="'.$userinfo['customerid'].'" '.
			'AND `isemaildomain`="1" '.
			'AND `deactivated`="0" '.
			'ORDER BY `domain` ASC'
		);	
		while($row=$db->fetch_array($result))
		{	eval("echo \"".getTemplate("modules/sasettings/domains_main")."\";");
		}
		eval("echo \"".getTemplate("modules/sasettings/domains_bottom")."\";");
	}
	elseif($page == "domains" && $action == "edit")
	{	$result=$db->query_first(
			'SELECT `domain` FROM `'.TABLE_PANEL_DOMAINS.'` '.
			'WHERE `id` = "'.$id.'" '.
			'AND `customerid`="'.$userinfo['customerid'].'" '.
			'AND `isemaildomain`="1" '.
			'AND `deactivated`="0" '		
		);
		if(!isset($result['domain']))
		{	die("Error. You can't edit the settings for this domain.");
		}
		
		if(isset($_POST['send']) && $_POST['send']=='send')
		{	//store values
			saveValues($result['domain']);
		}
		//show the form
		showEditForm($result['domain']);
	}
   elseif($page == "domains" && $action == "help")
   {	if(isset($_GET['preferenceid']))
		{	showDetailedDescription(intval($_GET['preferenceid']));
		}
   }

?>	     