$header
       <form method="POST" action="$filename">
       <input type="hidden" name="s" value="$s">
       <input type="hidden" name="page" value="$page">
       <input type="hidden" name="action" value="$action">
    <table class="maintable" align="center" cellspacing="4" cellpadding="5" border="0">
    	<tr>
       <td class="maintitle" colspan="2"><b><img alt="" src="images/title.gif">  {$lng['modules']['sasettings']['addpref']}</b></td>
      </tr>
 
     <tr>
       <td class="main_field_name">
       	{$lng['modules']['sasettings']['prefaddname']} 
       	(<a href="http://spamassassin.apache.org/full/3.0.x/dist/doc/Mail_SpamAssassin_Conf.html" target="_blank">{$lng['modules']['sasettings']['addprefinfo']}</a>)
       </td>
       <td class="main_field_display">
       	<input type="text" name="preferencename" size="25" maxlength="50" value="">
       </td>
      </tr>         
      <tr>
       <td class="main_field_name">
       	{$lng['modules']['sasettings']['prefused']}
       </td>
       <td class="main_field_display">
      	 <input type="checkbox" class="noborder" title="{$lng['modules']['sasettings']['usedboxdescr']}" name="used" value="Y" checked="checked">
       </td>
      </tr>
      <tr>
       <td class="main_field_name">
       	{$lng['modules']['sasettings']['prefedittype']}
       </td>
       <td class="main_field_display">
       	<select name='type' size='1'>
       		$optionTags
       	</select>
       </td>
      </tr>
      <tr>
       <td class="main_field_name">
       	{$lng['modules']['sasettings']['maxsize']}
       </td>
       <td class="main_field_display">
       	<input type="text" name="maxsize" size="25" maxlength="10" value="30">
       </td>
      </tr>
      <tr>
       <td class="main_field_name">
       	{$lng['modules']['sasettings']['enum_settings']}
       </td>
       <td class="main_field_display">
       	<input type="text" name="enum_settings" size="25" maxlength="100" value="">
       </td>
      </tr>
      <tr>
       <td class="main_field_name">
       	{$lng['modules']['sasettings']['globalvalue']}
       </td>
       <td class="main_field_display">
       	<input type="text" name="globalvalue" size="25" maxlength="50" value="">
       </td>
      </tr>        
      <tr>
       <td class="main_field_name">
       	{$lng['modules']['sasettings']['globalright']}
       </td>
       <td class="main_field_display">
      	 <input type="checkbox" class="noborder" title="{$lng['modules']['sasettings']['rightsboxdescr']}" name="globalright" value="Y" checked="checked">
       </td>
      </tr>
 
