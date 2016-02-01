<html>
<head><title>Welcome to Web GIS-Endemik</title></head>
<body>
<table>
<tr>
	<td>
	<blockquote>
	<font face="Arial, Helvetica, sans-serif" color="#000000" size="2"><h4>
	  <script language="JavaScript" type="text/javascript">
		<!--
		var message="Selamat Datang..."
		var neonbasecolor="white"
		var neontextcolor="black"
		var flashspeed=100  //dalam milisekon
		
		var n=0
		if (document.all||document.getElementById){
		document.write('<font color="'+neonbasecolor+'">')
		for (m=0;m<message.length;m++)
		document.write('<span id="neonlight'+m+'">'+message.charAt(m)+'</span>')
		document.write('</font>')
		}
		else
		document.write(message)
		
		function crossref(number){
		var crossobj=document.all? eval("document.all.neonlight"+number) : document.getElementById("neonlight"+number)
		return crossobj
		}
		
		function neon(){
		
		//Mengubah semua karakter ke warna dasar
		if (n==0){
		for (m=0;m<message.length;m++)
		//eval("document.all.neonlight"+m).style.color=neonbasecolor
		crossref(m).style.color=neonbasecolor
		}
		
		//bergantian dan merubah karakter ke warna yang lain
		crossref(n).style.color=neontextcolor
		
		if (n<message.length-1)
		n++
		else{
		n=0
		clearInterval(flashing)
		setTimeout("beginneon()",1500)
		return
		}
		}
		
		function beginneon(){
		if (document.all||document.getElementById)
		flashing=setInterval("neon()",flashspeed)
		}
		beginneon()
		//-->
	</script>
	</h4></font>
	  
	  <table>
	  <tr>
	  	<td valign="top"><div align="justify"><font face="verdana" size="2">Di Web GIS tentang penyebaran penyakit menular di kota depok. Situs ini memberikan informasi kepada Anda tentang perkembangan penyakit menular, dan penyebarannya yang dipetakan dengan menggunakan Mapserver. </font> </div></td>
		<td><img src="./img/depok.jpg" border="0" height="100" width="85"></td>
	  </tr>
	  </table>
	  
	 
	 
	  <p align="center">&nbsp;</p>
	  <p align="center"><br>
	    <img src="./img/peta.jpg" border="0" title="Peta Depok"></a></p>
	</blockquote>
	</td>
</tr>
<tr>
	<td>
	<marquee behavior="slide" direction="left">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <p align="center">
		<a href="#" onClick="window.open('about.php','scrollwindow','top=200,left=350,width=575,height=410');" style="text-decoration:none" title="Info Situs">
		<font face="verdana" size="2" color="#00CC00">ABOUT</font></a> | 
		<a href="http://www.gunadarma.ac.id" style="text-decoration:none" target="_blank" title="www.gunadarma.ac.id">
		<font face="verdana" size="2" color="#006699">Universitas Gunadarma</font></a> | 
		<a href="http://www.depok.go.id" style="text-decoration:none" target="_blank" title="www.depok.go.id">
		<font face="verdana" size="2" color="#006699">Pemerintah Kota Depok</font></a> |
		<a href="http://www.depkes.go.id" style="text-decoration:none" target="_blank" title="www.depkes.go.id">
		<font face="verdana" size="2" color="#006699">Departemen Kesehatan Indonesia</font></a></p>
  	</marquee>
	</td>
</tr>
</table>
</body>
</html>



