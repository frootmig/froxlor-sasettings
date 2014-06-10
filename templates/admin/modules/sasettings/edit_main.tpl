     <tr>
      <td class="field_name">{$row['preferencename']}</td>
      <td class="field_name_border_left"><span title="$descr">{$descs['desc_short']}</span></td>
      <td class="field_name"><input type="checkbox" class="noborder" title="{$lng['modules']['sasettings']['rightsboxdescr']}" name="{$row['preferencename']}-right" value="Y" $right></td>
      <td class="field_name"><a href="$filename?page=$page&id=$id&action=help&preferenceid={$row['preferenceid']}&s=$s" class="help" title="{$lng['modules']['sasettings']['showlongdescr']}">?</a></td>
      <td class="main_field_display_small	">
            <input type="text" name="{$row['preferencename']}" size="25" maxlength="$maxsize" value="{$row['value']}">
      </td>
     </tr>
