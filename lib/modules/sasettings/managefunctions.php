<?php
	/**
	 * Outputs the correct option tags
	 *
	 * @selectedtype string The string to edit
	 * @return string The generated option tags
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */

	function getOptionTags($selectedtype="")
	{	$types=array("string","float","int","enum","boolean");
		$output="";
		foreach($types as $type)
		{	if($type!=$selectedtype)
			{	$output=$output."<option>$type</option>";
			}
			else
			{	$output=$output."<option selected>$type</option>";
			}
		}
		return($output);
	}
	
	/**
	 * Verifies the given type of a preference
	 *
	 * @verify string The type to verify
	 * @return boolean If the type was valid
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */
	function verifyType($verify)
	{ $types=array("string","float","int","enum","boolean");
		foreach($types as $type)
		{	if($type==$verify)
			{	return(true);
			}
		}
		return(false);
	}

	
	/**
	 * Deletes values from preferences that are
	 * no longer used
	 *
	 * @name string The preferencename of the preference
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function deleteNotUsedValues($name)
	{	global $db,$id;
		$db->query(
			'DELETE '.	
			'FROM `'.TABLE_MODULES_SASETTINGS_SA.'` '.
			'WHERE `preference`="'.$name.'" '
		);
		//delete rights
		$db->query(
			'DELETE FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
			'WHERE `preferenceid`="'.$id.'" '
		);
	}
	
	/**
	 * Adds necessary values from preferences that are
	 * used now
	 *
	 * @name string The preferencename of the preference
	 * @id int The preferenceid ot the preference
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */	 
	function addValues($name,$id)
	{	global $db;
		//get global default value
		$row=$db->query_first(
			'SELECT `value` '.	
			'FROM `'.TABLE_MODULES_SASETTINGS_SA.'` '.
			'WHERE `username`="$GLOBAL"'.
			'AND `preference`="'.$name.'" '
		);
		$default=$row['value'];
		//get global default right
		$row=$db->query_first(
			'SELECT `available` '.	
			'FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
			'WHERE `domainid`="0"'.
			'AND `preferenceid`="'.$id.'" '
		);
		$defaultright=$row['available'];

		$result=$db->query(
			'SELECT `id`,`domain` '.
			'FROM `'.TABLE_PANEL_DOMAINS.'` '.
			'WHERE `isemaildomain`="1" '		
		);
		while($row=$db->fetch_array($result))
		{	$test=$db->query_first(
				'SELECT `available` '.	
				'FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
				'WHERE `domainid`="'.$row['id'].'"'.
				'AND `preferenceid`="'.$id.'" '
			);
			if(!isset($test['available']))
			{	//for each domain we have to insert a value
				$db->query(
					'INSERT INTO `'.TABLE_MODULES_SASETTINGS_SA.'` '.
					'(`preference`,`username`,`value`) '.
					'VALUES("'.$name.'","%'.$row['domain'].'","'.$default.'")'
				);
				//and set the preference right
				$db->query(
					'INSERT INTO `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
					'(`domainid`,`preferenceid`,`available`) '.
					'VALUES("'.$row['id'].'","'.$id.'","'.$defaultright.'") '
				);
			}
		}
	}
	
	
	/**
	 * Export a preference to sql
	 *
	 * @preferenceid int The preference's id
	 * @return string The preference export
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */
	function exportPreference($preferenceid)
	{	global $db;	
		$row=$db->query_first(
			'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_PREFERENCES.'` '.
			'WHERE `preferenceid`="'.$preferenceid.'" '
		);
		if(!isset($row['preferencename']))
		{	return ("");
		}
		//we don't insert a specific id
		$row['preferenceid']="";
		$output="\n-- Insert Preference ".$row['preferencename']."\n";
		$output .= createInsert(TABLE_MODULES_SASETTINGS_PREFERENCES,
							array('preferenceid','preferencename','used','type',
									'enum_settings','maxsize'),$row
						);
		$data=$db->query_first(
			'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_RIGHTS.'` '.
			'WHERE `preferenceid`="'.$preferenceid.'" '.
			'AND `domainid`="0"'
		);
		$data['preferenceid']="LAST_INSERT_ID()";
		$output .= createInsert(TABLE_MODULES_SASETTINGS_RIGHTS,
							array('preferenceid','domainid','available'),$data
						);
		$result=$db->query(
			'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_DESC.'` '.
			'WHERE `preferenceid`="'.$preferenceid.'" '
		);
		while($data=$db->fetch_array($result))
		{	$data['preferenceid']="LAST_INSERT_ID()";
			$output .= createInsert(TABLE_MODULES_SASETTINGS_DESC,
				array('preferenceid','language','desc_short','desc_long'),$data
			);
		}
		$data=$db->query_first(
			'SELECT * FROM `'.TABLE_MODULES_SASETTINGS_SA.'` '.
			'WHERE `preference`="'.$row['preferencename'].'" '.
			'AND `username`="$GLOBAL"'
		);
		$output .= createInsert(TABLE_MODULES_SASETTINGS_SA,
							array('preference','username','value'),$data
						);
		return($output);
	}
	
	/**
	 * Create an INSERT command
	 *
	 * @table string The table, in wich to insert
	 * @cols array The cols to insert	
	 * @row	array	The array with the data to insert
	 * @return string The INSTERT command
	 * @author Wolfgang Ziegler <nuppla@gmx.at>
	 */
	function createInsert($table,$cols,$row)	
	{	$output='INSERT INTO `'.$table.'` ';
		$first="(";
		$second="VALUES(";
		foreach($cols as $col)
		{	$first .= '`'.$col.'`,';
			if($row[$col]!="LAST_INSERT_ID()")
			{	$second .= '"'.$row[$col].'",';
			}
			else
			{	$second .= $row[$col].',';
			}
		}
		$first=substr($first,0,-1);
		$second=substr($second,0,-1);
		$first .= ') ';
		$second .= ') ';
		$output .= $first.$second.";\n";
		return($output);
	}
?>