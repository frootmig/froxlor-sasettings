     <tr>
     	<td class="field_name">$used</td>
     	<td class="field_name_border_left">{$row['preferenceid']}</td>
     	<td class="field_name">{$row['preferencename']}</td>
     	<td class="field_name"><span title="$descr">{$descs['desc_short']}</span></td>
     	<td class="main_field_display_small"><a href="$filename?page=$page&action=edit&id={$row['preferenceid']}&s=$s">
     	{$lng['panel']['edit']}</a>
     	<br /><a href="$filename?page=$page&action=export&id={$row['preferenceid']}&s=$s">
     	{$lng['modules']['sasettings']['export']}</a>
     	</td>
     </tr>
