<?php
	/**
	 * 	This file inserts a line in the SysCP header,
	 *		so that a additional css file is used.
	 */

$module="sasettings";
$file="style.css";
if(!isset($header))
{	die("You must include lib/init.php before this file!");
}

$SyscpCss='<link href="templates/main.css" rel="stylesheet" type="text/css">';
$newCss=	$SyscpCss.
			'<link href="templates/modules/'.$module.'/'.$file.
			'" rel="stylesheet" type="text/css">';
$header=str_replace($SyscpCss,$newCss,$header);

?>
