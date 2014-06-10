<tr>
 <td colspan="2" class="maintitle">
 	{$lng['modules']['sasettings']['desc_in_lang']} <b>{$row['language']}</b>
 </td>
</tr>
<tr>
 <td class="main_field_name">
  	{$lng['modules']['sasettings']['desc_short']}
 </td>
 <td class="main_field_display">
 	  <input type="text" name="{$row['language']}_desc_short" size="30" maxlength="30" value="{$row['desc_short']}">
 </td>
</tr>
<tr>
 <td class="main_field_name">
 	<div class="left"> {$lng['modules']['sasettings']['descinput']}</div>
 </td>
 <td class="main_field_display">
		<textarea name="{$row['language']}_desc" cols="50" rows="10">$desc</textarea>
		<br /> {$lng['modules']['sasettings']['deschtml']}
 </td>
</tr>
