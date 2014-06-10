$header
	<if 0 < $numprefs >
       <form method="POST" action="$filename">
       <input type="hidden" name="s" value="$s">
       <input type="hidden" name="page" value="$page">
       <input type="hidden" name="action" value="$action">
       <input type="hidden" name="id" value="$id">
   </if>
    <table class="maintable" align="center" cellspacing="4" cellpadding="5" border="0">
     <tr>
      <td colspan="4" class="maintitle"><b><img src="images/title.gif" alt="" /> {$lng['modules']['sasettings']['title']}</b></td>
     </tr>
