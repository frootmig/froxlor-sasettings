$header
	<if 0 < $numprefs >
       <form method="POST" action="$filename">
       <input type="hidden" name="s" value="$s">
       <input type="hidden" name="page" value="$page">
       <input type="hidden" name="action" value="$action">
       <input type="hidden" name="id" value="$id">
   </if>
    <table cellpadding="5" cellspacing="4" border="0" align="center" class="maintable">
     <tr>
      <td colspan="5" class="maintitle"><b><img src="images/title.gif" alt="" />&nbsp;{$lng['modules']['sasettings']['title']}</b></td>
     </tr>
