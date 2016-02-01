<html>
<script language="javascript" type="text/javascript">
<!--
	
function right(e) {
if ((document.layers || (document.getElementById && !document.all)) && (e.which == 2 || e.which == 3)) {
  alert("Copyright by Agus Sumarna - WebGIS");
  return false;
}
else if (event.button == 2 || event.button == 3) {
  alert("Copyright by Agus Sumarna - WebGIS");
  return false;
}
return true;
}

if (document.layers){
document.captureEvents(Event.MOUSEDOWN);
document.onmousedown = right;
}
else if (document.all && !document.getElementById){
document.onmousedown = right;
}

document.oncontextmenu = new Function("alert('Copyright by Agus Sumarna - WebGIS');return false");

// -->
</script>

<head>
		<title>Menu-GIS</title>
		<style type="text/css">
<!--
body {
        font-family: Verdana, Arial, Helvetica, sans-serif;
        margin: 0;
        font-size: 80%;
        font-weight: bold;
        }

ul {
        list-style: none;
        margin: 0;
        padding: 0;
        }

/* =-=-=-=-=-=-=-[Menu One]-=-=-=-=-=-=-=- */

#menu {
        width: 150px;
        border-style: solid solid none solid;
        border-color: #94AA74;
        border-size: 1px;
        border-width: 1px;
        margin: 10px;
        }

#menu li a {
        height: 32px;
          voice-family: "\"}\"";
          voice-family: inherit;
          height: 24px;
        text-decoration: none;
        }

#menu li a:link, #menu li a:visited {
        color: #5E7830;
        display: block;
        background: url(menu1.gif);
        padding: 8px 0 0 10px;
        }

#menu li a:hover, #menu li #current {
        color: #26370A;
        background: url(menu1.gif) 0 -32px;
        padding: 8px 0 0 10px;
        }

#menu li a:active {
        color: #26370A;
        background: url(menu1.gif) 0 -64px;
        padding: 8px 0 0 10px;
        }
-->
</style>
        </head>

<body>
		<div id="menu">
				<ul>
						<!-- CSS Tabs -->
<li><a id="current" href="index.php?page=1">Home</a></li>
<li><a href="index.php?page=5">Tabel GIS</a></li>
<li><a href="index.php?page=6">Diagram GIS</a></li>
<li><a href="index.php?page=4">Forum</a></li>
          </ul>
                </div>
        </body>
</html>