<?php
	/**
	 * Deletes the strings' html tags
	 *
	 * @string string The string to edit
	 * @return string The edited string
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */
	function prepareDescription($string)
	{		$string=ereg_replace("<*>","",$string);
			return(htmlentities($string));
	}
	
	/**
	 * Loads the right description from the database
	 * and falls back to "English" if $language isn't available
	 *
	 * @id int The preferenceid
	 * @language string The used language
	 * @return array The description (short & long)
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */
	function getDescription($id,$language)
	{		global $db;
			$row=$db->query_first(
				'SELECT `desc_long`,`desc_short` FROM `'.TABLE_MODULES_SASETTINGS_DESC.'` '.
				'WHERE `preferenceid`="'.$id.'" '.
				'AND `language`="'.$language.'" '
			);
			if($language!="English")
			{	foreach($row as $key => $foo)
				{	if($foo=="")
					{	$temp=getDescription($id,"English");
						$row[$key]=$temp[$key];
					}
				}
			}
			return($row);
	}	

	/**
	 * Shows preference-editing form
	 *
	 * @domain string The domain, which preferences get edited
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */
	function showEditForm($domain)
	{ 	global $db, $tpl, $userinfo, $s, $header, $footer, $lng, $page, $action, $id, $language, $filename;
		if($domain != "\$GLOBAL")
		{	$result=$db->query_first(
            'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
            'WHERE `domainid`="'.$id.'"'
         );
			verifyAll($domain,$id);
			//Load per domain preferences
			if(AREA == "admin")
			{	$query=
				   'SELECT `p`.*, `sa`.*, `r`.`available` '.
					'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` `p` '.
					'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_SA.'` `sa` '.
					'ON(`p`.`preferencename` = `sa`.`preference` AND '.
					'"%'.$domain.'" = `sa`.`username`) '.
					'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` `r` '.
					'ON(`p`.`preferenceid` = `r`.`preferenceid` AND '.
					'`r`.`domainid`="'.$id.'") '.					
					'WHERE `p`.`used`="Y" '.
					'ORDER BY `p`.`preferencename` ASC';
			}
			else
			{	//customer can edit all permitted preferences and not more!
				$query=
				   'SELECT `p`.*,`sa`.* '.
					'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` `p` '.
					'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_SA.'` `sa` '.
					'ON(`p`.`preferencename` = `sa`.`preference` AND '.
					'"%'.$domain.'" = `sa`.`username`) '.
					'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` `r` '.
					'ON(`p`.`preferenceid` = `r`.`preferenceid` AND '.
					'`r`.`domainid` = "'.$id.'") '.
					'WHERE `p`.`used`="Y" '.
					'AND `r`.`available`="Y" '.
					'ORDER BY `p`.`preferencename` ASC';
			}
			$result=$db->query($query);
		}
		else
		{	$query=
			   'SELECT `p`.*, `sa`.*, `r`.`available` '.
				'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` `p` '.
				'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_SA.'` `sa` '.
				'ON(`p`.`preferencename` = `sa`.`preference` AND '.
				'"\$GLOBAL" = `sa`.`username`) '.
				'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` `r` '.
				'ON(`p`.`preferenceid` = `r`.`preferenceid` AND '.
				'`r`.`domainid`="0") '.		
				'WHERE `p`.`used`="Y" '.
				'ORDER BY `p`.`preferencename` ASC';
			$result=$db->query($query);
		}
		$numprefs=$db->num_rows($result);
		eval("echo \"".getTemplate("modules/sasettings/edit_top")."\";");
		if($domain == "\$GLOBAL")
		{	eval("echo \"".getTemplate("modules/sasettings/edit_globaltitle")."\";");
		}
		else
		{	eval("echo \"".getTemplate("modules/sasettings/edit_domaintitle")."\";");
		}
		while($row=$db->fetch_array($result))
		{	$descs=getDescription($row['preferenceid'],$language);
			$descr=prepareDescription($descs['desc_long']);
			if(AREA=="admin")
			{	if($row['available']=='Y')
				{	$right='checked="checked"';
				}
				else
				{	$right="";
				}
			}
			//use different templates for different types
			if($row['type']=="enum")
			{	eval("echo \"".getTemplate("modules/sasettings/edit_main_enum")."\";");
				$string=$row['enum_settings'];
				//parse the string and output the select
				$first=strpos($string,"'");
				if(!($first===FALSE))
				{	$second=strpos($string,"'",($first+1));
				}
				echo "<select name='".$row['preferencename']."' size='1'>";
								
				while(!($first === FALSE || $second === FALSE))
				{	$option=substr($string,($first+1),($second-$first-1));
					$string=substr($string,($second+1));
					//output option
					if($option!=$row['value'])
					{	echo "<option>$option</option>";
					}
					else
					{	echo "<option selected>$option</option>";
					}
					//find next "'"
					$first=strpos($string,"'");
					if(!($first===FALSE))
					{	$second=strpos($string,"'",($first+1));
					}
				}
				echo "</select></td></tr>";
			}
			elseif($row['type']=="boolean")
			{	eval("echo \"".getTemplate("modules/sasettings/edit_main_enum")."\";");
				echo '<input type="checkbox" class="noborder" name="'.$row['preferencename'].'" value="1" ';
				if($row['value']=="1")
				{	echo 'checked="checked"';
				}
				echo ">";
			}
			else
			{	$maxsize = ($row['type']=="string") ? $row['maxsize'] : '30';
				eval("echo \"".getTemplate("modules/sasettings/edit_main")."\";");
			}
		}
		eval("echo \"".getTemplate("modules/sasettings/edit_bottom")."\";");
		return;	
	}
	
	
	/**
	 * Stores the new values from the form in the database
	 *
	 * @domain string The domain, which preferences get edited
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function saveValues($domain)
	{	global $db,$_POST,$id;
		if($domain!="\$GLOBAL")
		{	$domain="%".$domain;
		}
		if(AREA=="admin")
		{	$query=
				'SELECT * '.
				'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.
				'WHERE `used`="Y"';
		}
		else
		{	$query=
				'SELECT `p`.* '.
				'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` `p` '.
				'LEFT JOIN `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` `r` '.
				'ON(`p`.`preferenceid` = `r`.`preferenceid` AND '.
				'`r`.`domainid` = "'.$id.'") '.
				'WHERE `p`.`used`="Y" '.
				'AND `r`.`available`="Y"';
		}
		$result=$db->query($query);
		while($row=$db->fetch_array($result))
		{	if(!isset($_POST[$row['preferencename']]))
			{	$_POST[$row['preferencename']]=0;
			}
			$value=verifyVar($row['type'],$_POST[$row['preferencename']],$row['maxsize'],$row['enum_settings']);
			//now store $value
			$db->query(
				'UPDATE `'.TABLE_MODULES_SASETTINGS_SA.'` '.
				'SET `value`="'.$value.'" '.
				'WHERE `preference`="'.$row['preferencename'].'" AND '.
				'`username`="'.$domain.'"'
			);
			if(AREA=="admin")
			{	//save new rights
				if(isset($_POST[$row['preferencename']."-right"]) && $_POST[$row['preferencename']."-right"]=="Y")
				{	$value="Y";
				}
				else
				{	$value="N";
				}
				$db->query(
					'UPDATE `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
					'SET `available`="'.$value.'" '.
					'WHERE `preferenceid`="'.$row['preferenceid'].'" AND '.
					'`domainid`="'.$id.'"'
				);
			}
		}
		return;		
	}
	
	/**
	 * Sets the default rights for a domain
	 *
	 * @domainid int The domainid, which rights get set
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function setDefaultRights($domainid)
	{	global $db;
		//delete existing rights
		$db->query(
			'DELETE FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
			'WHERE `domainid`="'.$domainid.'"'
		);
		//get default rights
		$result=$db->query(
			'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
			'WHERE `domainid`="0"'
		);
		while($row=$db->fetch_array($result))
		{	//save rights
			$db->query(
				'INSERT INTO `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
				'(`domainid`,`preferenceid`,`available`) '.
				'VALUES("'.$domainid.'","'.$row['preferenceid'].
				'","'.$row['available'].'")'
			);
		}
		return;
	}
	
	/**
	 * Shows the detailed description
	 *
	 * @preferenceid int The id of the prefernce,
	 *	for which the desription should be shown
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function showDetailedDescription($preferenceid)
	{	global $db, $tpl, $userinfo, $s, $header, $footer, $lng, $page, $action, $id, $language, $filename;
		$result=$db->query_first(
		   'SELECT `p`.* '.
			'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` `p` '.
			'WHERE `p`.`preferenceid`="'.$preferenceid.'"'
		);
		$descs=getDescription($preferenceid,$language);
		eval("echo \"".getTemplate("modules/sasettings/edit_showdescr")."\";");
	}

	
	/**
	 * Verifies the variable depenend on its type
	 *
	 * @type string The type of the variable
	 * @var string The value of the variable
	 * @maxsize string The maximum length for type string
	 * @enum_settings string The available values for type enum	 
	 * @return The verfied variable	 
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function verifyVar($type,$var,$maxsize="30",$enum_settings="")
	{	if($type=="string")
		{	$value=escape(substr(htmlentities($var),0,$maxsize));
		}
		elseif($type=="float")
		{	$value=(float)$var;
		}	
		elseif($type=="int")
		{	$value=intval($var);
		}	
		elseif($type=="boolean")
		{	if($var=="1")
			{	$value="1";
			}
			else
			{	$value="0";
			}
		}
		elseif($type=="enum")
		{	//parse the string enum_settings and verify that the value is valid
			$string=$enum_settings;
			$value="";
			$first=strpos($string,"'");
			if(!($first===FALSE))
			{	$second=strpos($string,"'",($first+1));
			}				
			while(!($first === FALSE || $second === FALSE))
			{	$i=substr($string,($first+1),($second-$first-1));
				$string=substr($string,($second+1));
				//verify value
				if($i==$var)
				{	$value=$i;
					break;
				}
				//find next "'"
				$first=strpos($string,"'");
				if(!($first===FALSE))
				{	$second=strpos($string,"'",($first+1));
				}
			}					
		}
	return($value);			
	}
	
	/**
	 * Verifies if all preferences for a domain
	 * are set and otherwise it sets the default
	 * value
	 *
	 * @domain string The domain to verify
	 * @domain int The domainid of the domain 
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function verifyAll($domain,$domainid)
   { 	global $db;
   	$result=$db->query(
		   'SELECT * '.
			'FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.		
			'WHERE `used`="Y"'
		);
		while($row=$db->fetch_array($result))
		{	$info=$db->query_first(
			   'SELECT * '.
				'FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.		
				'WHERE `preferenceid`="'.$row['preferenceid'].'" '.
				'AND `domainid`="'.$domainid.'" '
			);
			if(!isset($info['available']))
			{	//this preference is missing, so insert it
				$default=$db->query_first(
					'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_SA.'` '.
					'WHERE `username`="$GLOBAL" '.
					'AND `preference`="'.$row['preferencename'].'" '
				);
				$db->query(
					'INSERT INTO `'.TABLE_MODULES_SASETTINGS_SA.'` '.
					'(`username`,`preference`,`value`) '.
					'VALUES("%'.$domain.'","'.$row['preferencename'].
					'","'.$default['value'].'")'
				);
				//and insert the according preference right
				$default=$db->query_first(
					'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
					'WHERE `domainid`="0" '.
					'AND `preferenceid`="'.$row['preferenceid'].'" '
				);
				$db->query(
					'INSERT INTO `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
					'(`domainid`,`preferenceid`,`available`) '.
					'VALUES("'.$domainid.'","'.$row['preferenceid'].
					'","'.$default['available'].'")'
				);				
			}
		}	
	}	
	
	
	/**
	 * Escapes the string correctly
	 *
	 * @string string The string to escape
	 *	@return string The escaped string
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function escape($string)
	{	if(get_magic_quotes_gpc()!=1)
		{	return(mysql_escape_string($string));
		}
		return($string);
	}

?>
