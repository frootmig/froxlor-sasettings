$header
   <table class="maintable sasettings" align="center" cellspacing="1">
     <tr>
      <td class="maintitle" colspan="2"><b><img alt="" src="images/title.gif"> {$result['preferencename']}</b></td>
     </tr>
     <tr>
      <td class="main_field_name">{$lng['modules']['sasettings']['desc_short']}</td>
      <td class="main_field_display">{$descs['desc_short']}</td>
     </tr>     
     <tr>
      <td class="main_field_name">{$lng['modules']['sasettings']['descinput']}</td>
      <td class="main_field_display"><p>
      {$descs['desc_long']}
      </p></td>
     </tr>
      <tr>
      <td class="field_display_border_left" colspan="2">
      <a href="$filename?page=$page&action=edit&id=$id&s=$s">
      {$lng['modules']['sasettings']['back']}</a> </td>
     </tr>
     <tr>  
	</table>
$footer
