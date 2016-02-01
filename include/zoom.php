<table><tr><td>
<input TYPE="radio" NAME="CMD" VALUE="ZOOM_ALL"
<?php if (IsCurrentTool("ZOOM_ALL")) echo "CHECKED";?>> 
<img SRC="images/icon_zoomfull.png" WIDTH="20" HEIGHT="20"> 
Zoom all <br> 
<input TYPE="radio" NAME="CMD" VALUE="ZOOM_IN"
<?php if (IsCurrentTool("ZOOM_IN")) echo "CHECKED";?>> 
<img SRC="images/icon_zoomin.png"	WIDTH="20" HEIGHT="20"> 
Zoom in <br> 
<input TYPE="radio" NAME="CMD" VALUE="ZOOM_OUT"
<?php if (IsCurrentTool("ZOOM_OUT")) echo "CHECKED";?>> 
<img SRC="images/icon_zoomout.png" WIDTH="20" HEIGHT="20"> 
Zoom out <br> 
<input TYPE="radio" NAME="CMD" VALUE="RECENTER" 
<?php if (IsCurrentTool("RECENTER")) echo "CHECKED";?>> 
<img SRC="images/icon_recentre.png" WIDTH="20" HEIGHT="20"> 
Recenter<br>
<input TYPE="radio" NAME="CMD" VALUE="QUERY" 
<?php if (IsCurrentTool( "QUERY" )) echo "CHECKED";?>>
<img SRC="images/icon_info.png" WIDTH="20" HEIGHT="20">
Query<br>
</td></tr></table>

	