<?php
/**
 * filename: $Source: /syscp/modules_admin_sasettings.php,v $
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

    define('AREA', 'admin');
    require("./lib/modules/sasettings/tables.inc.php");
    require("./lib/modules/sasettings/functions.php");
    require("./lib/modules/sasettings/managefunctions.php");

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
	
	if($page == "overview")
	{	//todo!	
		eval("echo \"".getTemplate("modules/sasettings/overview")."\";");
	}
	
	
	
	//edit global defaultvalues
	
	elseif($page == "global" && ($action == "" || $action == "edit"))
	{	if(isset($_POST['send']) && $_POST['send']=='send')
		{	//store values
			if($userinfo['change_serversettings'] == '1')
			{	saveValues("\$GLOBAL");
			}
		}
		if($userinfo['change_serversettings'] == '1')
		{	showEditForm("\$GLOBAL");
		}
	}
	elseif($page == "global" && $action == "help")
   {	if(isset($_GET['preferenceid']))
		{	showDetailedDescription(intval($_GET['preferenceid']));
		}
   }
   
   
   
   //edit domain defaultvalues
	
	elseif($page == "domains" && $action == "")
	{	eval("echo \"".getTemplate("modules/sasettings/domains_top")."\";");
		if($userinfo['change_serversettings'] != '1')
		{	$result=Database::query(
				'SELECT `id`, `domain` FROM `'.TABLE_PANEL_DOMAINS.'` '.
				'WHERE `isemaildomain`="1" '.
				'AND `deactivated`="0" '.
				'AND `adminid`="'.$userinfo['adminid'].'" '.
				'ORDER BY `domain` ASC'
			);
		}
		else
		{	$result=Database::query(
				'SELECT `id`, `domain` FROM `'.TABLE_PANEL_DOMAINS.'` '.
				'WHERE `isemaildomain`="1" '.
				'AND `deactivated`="0" '.
				'ORDER BY `domain` ASC'
			);
		}
		
		while($row=$result->fetch(PDO::FETCH_ASSOC))
		{	eval("echo \"".getTemplate("modules/sasettings/domains_main")."\";");
		}
		eval("echo \"".getTemplate("modules/sasettings/domains_bottom")."\";");
	}
	elseif($page == "domains" && $action == "edit")
	{	$result=Database::query(
			'SELECT `domain`,`adminid` FROM `'.TABLE_PANEL_DOMAINS.'` '.
			'WHERE `id` = "'.$id.'"'.
			'AND `isemaildomain`="1" '.
			'AND `deactivated`="0" '
		);
		$result = $result->fetch(PDO::FETCH_ASSOC);
		if((!isset($result['domain']))||($userinfo['change_serversettings'] != '1' && $result['adminid']!=$userinfo['adminid']))
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
   
   
   
   //show the available preferences
   
   elseif($page == "prefs" && $action == "" && !isset($_POST['send']))
   {	if($userinfo['change_serversettings'] != '1')
   	{	Exit;
   	} 
   	if(!isset($_GET["order"]))
   	{	$order="preferencename";
   	}
   	else
	   {	if($_GET["order"]=="preferencename"||$_GET["order"]=="preferenceid")
	   	{	$order=$_GET["order"];
	   	}
	   	else
	   	{	$order="preferencename";
	   	}
	   }
   	$result=Database::query(
		   'SELECT `p`.*, `sa`.*, `r`.`available` '.
			'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` `p` '.
			'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_SA.'` `sa` '.
			'ON(`p`.`preferencename` = `sa`.`preference` AND '.
			'"$GLOBAL" = `sa`.`username`) '.
			'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` `r` '.
			'ON(`p`.`preferenceid` = `r`.`preferenceid` AND '.
			'`r`.`domainid`="0") '.					
			'ORDER BY `p`.`'.$order.'` ASC'
		);
		$numprefs=Database::num_rows($result);
		eval("echo \"".getTemplate("modules/sasettings/pref_top")."\";");
		while($row=$result->fetch(PDO::FETCH_ASSOC))
		{	$descs=getDescription($row['preferenceid'],$language);
			$descr=prepareDescription($descs['desc_long']);
			if($row['used']=="Y")
			{	$used=$lng['panel']['yes'];
			}
			else
			{	$used=$lng['panel']['no'];
			}
			eval("echo \"".getTemplate("modules/sasettings/pref_main")."\";");
		}
		eval("echo \"".getTemplate("modules/sasettings/pref_bottom")."\";");
   }
   
   
   
   
   // edit a preference
   elseif($page == "prefs" && $action == "edit" && !isset($_POST['send']))
   {	if($userinfo['change_serversettings'] != '1')
   	{	Exit;
   	}    
   	//show form
   	$row=Database::query(
		   'SELECT `p`.*, `d`.* '.
			'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` `p` '.
			'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_DESC.'` `d` '.
			'ON(`p`.`preferenceid`=`d`.`preferenceid` '.
			'AND `d`.`language`="'.$language.'") '.		
			'WHERE `p`.`preferenceid`="'.$id.'"'
		);
	$row=$row->fetch(PDO::FETCH_ASSOC);
   	$descr=prepareDescription($row['desc_long']);
   	if($row['used']=="Y")
		{	$used='checked="checked"';
		   $global = "0";
		}
		else
		{	$used="";
  			$global = "1";
		}
		$optionTags=getOptionTags($row['type']);
   	eval("echo \"".getTemplate("modules/sasettings/pref_edit_top")."\";");
   	//output the form for editing the descriptions in all languages
   	$result=Database::query(
   		'SELECT * '.
			'FROM `'.TABLE_MODULES_SASETTINGS_DESC.'` '.
			'WHERE `preferenceid`="'.$id.'" '.
			'ORDER BY `language` ASC'
		);
		while($row=$result->fetch(PDO::FETCH_ASSOC))
		{	$descr=prepareDescription($row['desc_long']);
			$desc=htmlentities($row['desc_long'],ENT_NOQUOTES);
			eval("echo \"".getTemplate("modules/sasettings/pref_edit_main")."\";");
		}
		eval("echo \"".getTemplate("modules/sasettings/pref_edit_bottom")."\";");
   }
   //save the edited preference   
   elseif($page == "prefs" && $action == "edit" && isset($_POST['send']))
   {	if($userinfo['change_serversettings'] != '1')
   	{	Exit;
   	}
   	if(($_POST['send']=='sendfirst'||$_POST['send']=='send'))
   	{ 	$row=Database::query(
			   'SELECT * '.
				'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.		
				'WHERE `preferenceid`="'.$id.'"'
			);
		$row = $row->fetch(PDO::FETCH_ASSOC);
   		if((!isset($_POST['used']))&&$row['used']=='Y'&&$_POST['send']=='sendfirst')
   		{	//build the string of variables for ask_yesno()
   			$var="page=$page;action=$action;id=$id;";
   			$var=$var."used=N";
   			ask_yesno('modules_sasettings_used', $filename, $var, "");
   			Exit;
   		}
   		else
   		{	//store values
				if(isset($row['preferencename']))
				{	if(isset($_POST['used'])&&$_POST['used']=="N"&&$row['used']=='Y')
					{	$used="N";
						if($row['used']=='Y')
						{	deleteNotUsedValues($row['preferencename']);
						}
						Database::query(
							'UPDATE `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.
							'SET `used`="'.$used.'" '.
							'WHERE `preferenceid`="'.$id.'"'
						);						
					}
					else
					{	$used = (isset($_POST['used'])&&$_POST['used']=="Y")?"Y":"N";
						$type = verifyType($_POST['type'])?$_POST['type']:$row['type'];
						$maxsize=abs(intval($_POST['maxsize']));
						$enum_settings=htmlentities(substr($_POST['enum_settings'],0,100));
						
						//reactivate it			
						if($row['used']=='N' && $used == "Y")
						{							
						   //store global value and global right,
							//before calling addValues()
							$globalvalue=(isset($_POST['globalvalue']))?substr($_POST['globalvalue'],0,50):0;
							//if magic_quotes_gpc is on, get the silly \ out of $enum_settings
							$enum_settings=str_replace("\'","'",$enum_settings);
							$globalvalue=escape(verifyVar($type,$globalvalue,$maxsize,$enum_settings));
							$globalright = (isset($_POST['globalright'])&& $_POST['globalright']=='Y')?"Y":"N";

							Database::query(
								'INSERT INTO `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
								'(`domainid`,`preferenceid`,`available`) '.
								'VALUES("0","'.$id.'","'.$globalright.'") '
							);
							Database::query(
								'INSERT INTO `'.TABLE_MODULES_SASETTINGS_SA.'` '.
								'(`username`,`preference`,`value`) '.
								'VALUES("$GLOBAL","'.$row['preferencename'].'","'.$globalvalue.'") '
							);
					
					      //now we can add the values to the active domains
							addValues($row['preferencename'],$id);
						}

						Database::query(
							'UPDATE `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.
							'SET `used`="'.$used.'", '.
							'`type`="'.$type.'", '.
							'`maxsize`="'.$maxsize.'", '.
							'`enum_settings`="'.$enum_settings.'" '.
							'WHERE `preferenceid`="'.$id.'"'
						);
		
						//ok then update languages
				   	$result=Database::query(
				   		'SELECT * '.
							'FROM `'.TABLE_MODULES_SASETTINGS_DESC.'` '.
							'WHERE `preferenceid`="'.$id.'" '
						);
						while($row=$result->fetch(PDO::FETCH_ASSOC))
						{	$desc_short=escape(
												substr(
													htmlentities($_POST[$row['language']."_desc_short"])
												,0,30)
											);			
							$desc=escape($_POST[$row['language']."_desc"]);
							Database::query(
								'UPDATE `'.TABLE_MODULES_SASETTINGS_DESC.'` '.
								'SET `desc_short`="'.$desc_short.'", '.
								'`desc_long`="'.$desc.'" '.
								'WHERE `language`="'.$row['language'].'" '.
								'AND `preferenceid`="'.$id.'"'
							);
						}
					}
				}
				// go back to the preference overview after saving
				header("Location: ./$filename?page=$page&s=$s");
   		}
   	}
   }

   
   
   
   // add a new preference
   
   elseif($page == "prefs" && $action == "add" && (!isset($_POST['send'])))
   {	if($userinfo['change_serversettings'] != '1')
   	{	Exit;
   	} 
   	//show the form
	   $optionTags=getOptionTags();
	   eval("echo \"".getTemplate("modules/sasettings/pref_add_top")."\";");
   	//output the form for adding the descriptions in all languages
		while(list($language_file, $language_name) = each($languages))
		{	eval("echo \"".getTemplate("modules/sasettings/pref_add_main")."\";");
		}
		eval("echo \"".getTemplate("modules/sasettings/pref_add_bottom")."\";");
   }
   elseif($page == "prefs" && $action == "add" && $_POST['send']=='send')
   {	if($userinfo['change_serversettings'] != '1')
   	{	Exit;
   	}   
   	//add the new preference
		$preferencename=escape(substr($_POST['preferencename'],0,50));
		//existiert das preference bereits?
		$row=Database::query(
			'SELECT * '.
			'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.
			'WHERE `preferencename`="'.$preferencename.'" '
		);
		$row=$row->fetch(PDO::FETCH_ASSOC);
		if(isset($row['preferenceid']))
		{	standard_error('modules_sasettings_prefexist');
			Exit;
		}
		elseif($preferencename=="")
		{	standard_error('modules_sasettings_prefnull');
			Exit;
		}
		if(verifyType($_POST['type']))
		{	$type=$_POST['type'];
		}
		else
		{	Exit;
		}
		$maxsize=abs(intval($_POST['maxsize']));
		$enum_settings=htmlentities(substr($_POST['enum_settings'],0,100));
		if($_POST['used']!="Y")
		{	$used="N";
		}
		else
		{	$used="Y";
		}
		//insert the preference
		Database::query(
			'INSERT INTO `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.
			'(`used`,`type`,`maxsize`,`enum_settings`,`preferenceid`,`preferencename`) '.
			'VALUES("'.$used.'","'.$type.'","'.$maxsize.'","'.$enum_settings.
			'","","'.$preferencename.'") '
		);
		//get the preferenceid
		$preferenceid=mysql_insert_id();
		
      if($used=="Y")
		{	//store global value and global right,
			//before calling addValues()
			$globalvalue=substr($_POST['globalvalue'],0,50);
			//if magic_quotes_gpc is on, get the silly \ out of $enum_settings
			$enum_settings=str_replace("\'","'",$enum_settings);
			$globalvalue=escape(verifyVar($type,$globalvalue,$maxsize,$enum_settings));
			if($_POST['globalright']=='Y')
			{	$globalright="Y";
			}
			else
			{	$globalright="N";
			}
			Database::query(
				'INSERT INTO `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
				'(`domainid`,`preferenceid`,`available`) '.
				'VALUES("0","'.$preferenceid.'","'.$globalright.'") '
			);
			Database::query(
				'INSERT INTO `'.TABLE_MODULES_SASETTINGS_SA.'` '.
				'(`username`,`preference`,`value`) '.
				'VALUES("$GLOBAL","'.$preferencename.'","'.$globalvalue.'") '
			);
	
	      //now we can add the values to the active domains
			addValues($preferencename,$preferenceid);
		}
		//ok then update languages
		while(list($language_file, $language_name) = each($languages))
		{	$desc_short=escape(
								substr(
									htmlentities($_POST[$language_name."_desc_short"])
								,0,30)
							);			
			$desc=escape($_POST[$language_name."_desc"]);
			Database::query(
				'INSERT INTO `'.TABLE_MODULES_SASETTINGS_DESC.'` '.
				'(`preferenceid`,`desc_short`,`desc_long`,`language`) '.
				'VALUES("'.$preferenceid.'","'.$desc_short.'","'.$desc.
				'","'.$language_name.'") '
			);
		}
		header("Location: ./$filename?page=$page&s=$s");
   }
   
   
   //export a preference
   
   elseif($page=="prefs"&&$action="export")
   {	if($userinfo['change_serversettings'] != '1')
   	{	Exit;
   	}
   	$result=Database::query(
		   'SELECT `preferencename` '.
			'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.
			'WHERE `preferenceid`="'.$id.'"'
		);
		$result=$result->fetch(PDO::FETCH_ASSOC);
		if(isset($result['preferencename']))
		{ 	$export=exportPreference($id);
			eval("echo \"".getTemplate("modules/sasettings/pref_export")."\";");
		}
   }
?>
