<?
Main($map);
function Main($map)
{
$GLOBALS["goMap"] = ms_newMapObj("$map" );
  
  //batas koordinat seluruh peta, untuk tool 'zoom all'
  $GLOBALS["gfMinX"] = (float)$GLOBALS["goMap"]->extent->minx;
  $GLOBALS["gfMinY"] = (float)$GLOBALS["goMap"]->extent->miny;
  $GLOBALS["gfMaxX"] = (float)$GLOBALS["goMap"]->extent->maxx;
  $GLOBALS["gfMaxY"] = (float)$GLOBALS["goMap"]->extent->maxy;
  
  //set nilai $aVars dengan nilai parameter URL
  if (sizeof($_POST) > 0) {
    $aVars = $_POST;
  } else {
    if (sizeof($_GET) > 0) {
      $aVars = $_GET;
    } else {
      $aVars = array();
    }
  }
  
  //tool navigasi default: zoom in
  $GLOBALS["gszCurrentTool"] = "ZOOM_IN";
  $GLOBALS["gShowQueryResults"] = FALSE;
  
  //proses parameter URL
  ProcessURLArray( $aVars );
}


function DrawMap()
{
  //fungsi untuk menggambar peta
  if ($GLOBALS["gShowQueryResults"])
      $img = $GLOBALS["goMap"]->drawQuery();
  else
    $img = $GLOBALS["goMap"]->draw();
  
  $url = $img->saveWebImage();

  $nWidth = $GLOBALS["goMap"]->width;
  $nHeight = $GLOBALS["goMap"]->height;

  echo "<INPUT  TYPE=image SRC=".$url." BORDER=0 WIDTH=\"".$nWidth."\" HEIGHT=\"".$nHeight."\" NAME=MAINMAP>\n";

  echo "<INPUT TYPE=HIDDEN NAME=MINX VALUE=\"".$GLOBALS["goMap"]->extent->minx."\">\n";
  echo "<INPUT TYPE=HIDDEN NAME=MINY VALUE=\"".$GLOBALS["goMap"]->extent->miny."\">\n";
  echo "<INPUT TYPE=HIDDEN NAME=MAXX VALUE=\"".$GLOBALS["goMap"]->extent->maxx."\">\n";
  echo "<INPUT TYPE=HIDDEN NAME=MAXY VALUE=\"".$GLOBALS["goMap"]->extent->maxy."\">\n";
}


function DrawScaleBar()
{
  //fungsi untuk menampilkan skala
  
  $img = $GLOBALS["goMap"]->drawScaleBar();
  $url = $img->saveWebImage();

  echo"<IMG SRC=$url BORDER=0>\n";
}


function DrawLegend()
{
	//fungsi untuk menampilkan legenda dengan cekbox
    echo "<table cellspacing=0 cellpadding=0 size=50>";
    echo "<tr bgcolor=\"#E2EFF5\">\n";
    echo "<td></td>\n";
    echo "<td></td>\n";
    echo "</tr>\n";
    echo $GLOBALS["goMap"]->processLegendTemplate( array() );
    echo "<tr>\n";
    echo "<td><input type=\"image\""." src=\"./images/icon_update.png\""." width=\"20\" height=\"20\" title=\"Klik\"></td>\n";
    echo "<td colspan=2>"."<font face=\"verdana\" size=\"2\">"."<b>Update</b></font></td>\n";
    echo "</tr>\n";
    echo "</table>";
}


function DrawPointQueryResults()
{
  //fungsi untuk menampilkan query dengan memisil salah satu nama lokasi
  if (!$GLOBALS["gShowQueryResults"]) {
    echo "&nbsp;";
  } else {
    $nResults = 0;
    echo "<PRE>";
    echo "<b>Kecamatan terpilih:</b>\n";
    echo "------------------\n";
    $oLayer = $GLOBALS["goMap"]->getLayerByName("kecamatan"); //layer yang bernama lokasi
    $nLayerResults = $oLayer->getNumResults();
    if ($nLayerResults > 0) {
      $oLayer->open();
      $aField = explode(";", $oLayer->getMetaData("RESULT_FIELDS")); 
	  //ambil nilai yang ada di result_field
      $aDesc = explode(";", $oLayer->getMetaData("DESC_FIELDS"));
      for ($i=0; $i<$nLayerResults; $i++) {
        $oRes = $oLayer->getResult($i);
        $oShape = $oLayer->getShape($oRes->tileindex, $oRes->shapeindex);
        for ($j=0; $j<count($aField); $j++) {
          echo $aDesc[$j]." : ";
          echo $oShape->values[$aField[$j]]."\n";
        }
		
        DrawSatu($oShape); 
		DrawDua($oShape); 
		DrawTiga($oShape); 
		DrawEmpat($oShape); 
		DrawLima($oShape);
		
        $oShape->free();
        $nResults++;
      }
      $oLayer->close();
    }
    
    if ($nResults == 0) {
      echo "Tidak ditemukan objek pada layer Kecamatan.";
    }
    echo "</PRE>";
  }
}


function  DrawSatu($oShape)
{
  //fungsi untuk menampilkan hasil query dari lokasi
  echo "<PRE>";
  @$GLOBALS["goMap"]->queryByShape($oShape);
  $oLayer = $GLOBALS["goMap"]->getLayerByName('campak'); //ambill layer yang bernama peta
  $nLayerResults = $oLayer->getNumResults();

  echo "<b>Penyakit Campak pada lokasi terpilih:</b>\n";
  echo "----------------------------\n";
  $nResults = 0;
  if ($nLayerResults > 0) {
    $oLayer->open();
    $aField = explode(";", $oLayer->getMetaData("RESULT_FIELDS"));
    $aDesc = explode(";", $oLayer->getMetaData("DESC_FIELDS"));
    for ($i=0; $i<$nLayerResults; $i++) {
      $oRes = $oLayer->getResult($i);
      $oShape = $oLayer->getShape($oRes->tileindex, $oRes->shapeindex);
      for ($j=0; $j<count($aField); $j++) {
        echo $aDesc[$j]." ".($i+1).": ";
        echo $oShape->values[$aField[$j]]."<br>";
      }
      $oShape->free();
      $nResults++;
    }
    $oLayer->close();
  }
  echo "</PRE>";

  if ($nResults == 0) {
    ?><font color="#999999">Tidak ditemukan objek pada layer Lokasi.</font><?
  }
}

function  DrawDua($oShape)
{
  //fungsi untuk menampilkan hasil query dari lokasi
  echo "<PRE>";
  @$GLOBALS["goMap"]->queryByShape($oShape);
  $oLayer = $GLOBALS["goMap"]->getLayerByName('dbd'); //ambill layer yang bernama peta
  $nLayerResults = $oLayer->getNumResults();
  echo "<b>Penyakit DBD pada lokasi terpilih:</b>\n";
  echo "----------------------------\n";
  $nResults = 0;
  if ($nLayerResults > 0) {
    $oLayer->open();
    $aField = explode(";", $oLayer->getMetaData("RESULT_FIELDS"));
    $aDesc = explode(";", $oLayer->getMetaData("DESC_FIELDS"));
    for ($i=0; $i<$nLayerResults; $i++) {
      $oRes = $oLayer->getResult($i);
      $oShape = $oLayer->getShape($oRes->tileindex, $oRes->shapeindex);
      for ($j=0; $j<count($aField); $j++) {
        echo $aDesc[$j]." ".($i+1).": ";
        echo $oShape->values[$aField[$j]]."<br>";
      }
      $oShape->free();
      $nResults++;
    }
    $oLayer->close();
  }
  echo "</PRE>";

  if ($nResults == 0) {
	?><font color="#999999">Tidak ditemukan objek pada layer Lokasi.</font><?
  }
}


function  DrawTiga($oShape)
{
  //fungsi untuk menampilkan hasil query dari lokasi
  echo "<PRE>";
  @$GLOBALS["goMap"]->queryByShape($oShape);
  $oLayer = $GLOBALS["goMap"]->getLayerByName('diare'); //ambill layer yang bernama peta
  $nLayerResults = $oLayer->getNumResults();
  echo "<b>Penyakit Diare pada lokasi terpilih:</b>\n";
  echo "----------------------------\n";
  $nResults = 0;
  if ($nLayerResults > 0) {
    $oLayer->open();
    $aField = explode(";", $oLayer->getMetaData("RESULT_FIELDS"));
    $aDesc = explode(";", $oLayer->getMetaData("DESC_FIELDS"));
    for ($i=0; $i<$nLayerResults; $i++) {
      $oRes = $oLayer->getResult($i);
      $oShape = $oLayer->getShape($oRes->tileindex, $oRes->shapeindex);
      for ($j=0; $j<count($aField); $j++) {
        echo $aDesc[$j]." ".($i+1).": ";
        echo $oShape->values[$aField[$j]]."<br>";
      }
      $oShape->free();
      $nResults++;
    }
    $oLayer->close();
  }
  echo "</PRE>";

  if ($nResults == 0) {
    ?><font color="#999999">Tidak ditemukan objek pada layer Lokasi.</font><?
  }
}


function  DrawEmpat($oShape)
{
  //fungsi untuk menampilkan hasil query dari lokasi
  echo "<PRE>";
  @$GLOBALS["goMap"]->queryByShape($oShape);
  $oLayer = $GLOBALS["goMap"]->getLayerByName('filaria'); //ambill layer yang bernama peta
  $nLayerResults = $oLayer->getNumResults();
  echo "<b>Penyakit Filaria pada lokasi terpilih:</b>\n";
  echo "----------------------------\n";
  $nResults = 0;
  if ($nLayerResults > 0) {
    $oLayer->open();
    $aField = explode(";", $oLayer->getMetaData("RESULT_FIELDS"));
    $aDesc = explode(";", $oLayer->getMetaData("DESC_FIELDS"));
    for ($i=0; $i<$nLayerResults; $i++) {
      $oRes = $oLayer->getResult($i);
      $oShape = $oLayer->getShape($oRes->tileindex, $oRes->shapeindex);
      for ($j=0; $j<count($aField); $j++) {
        echo $aDesc[$j]." ".($i+1).": ";
        echo $oShape->values[$aField[$j]]."<br>";
      }
      $oShape->free();
      $nResults++;
    }
    $oLayer->close();
  }
  echo "</PRE>";

  if ($nResults == 0) {
    ?><font color="#999999">Tidak ditemukan objek pada layer Lokasi.</font><?
  }
}


function  DrawLima($oShape)
{
  //fungsi untuk menampilkan hasil query dari lokasi
  echo "<PRE>";
  @$GLOBALS["goMap"]->queryByShape($oShape);
  $oLayer = $GLOBALS["goMap"]->getLayerByName('hivaids'); //ambill layer yang bernama peta
  $nLayerResults = $oLayer->getNumResults();
  echo "<b>Penyakit HIV/AIDS pada lokasi terpilih:</b>\n";
  echo "----------------------------\n";
  $nResults = 0;
  if ($nLayerResults > 0) {
    $oLayer->open();
    $aField = explode(";", $oLayer->getMetaData("RESULT_FIELDS"));
    $aDesc = explode(";", $oLayer->getMetaData("DESC_FIELDS"));
    for ($i=0; $i<$nLayerResults; $i++) {
      $oRes = $oLayer->getResult($i);
      $oShape = $oLayer->getShape($oRes->tileindex, $oRes->shapeindex);
      for ($j=0; $j<count($aField); $j++) {
        echo $aDesc[$j]." ".($i+1).": ";
        echo $oShape->values[$aField[$j]]."<br>";
      }
      $oShape->free();
      $nResults++;
    }
    $oLayer->close();
  }
  echo "</PRE>";

  if ($nResults == 0) {
    ?><font color="#999999">Tidak ditemukan objek pada layer Lokasi.</font><?
  }
}


function DrawKeyMap()
{
    $img = $GLOBALS["goMap"]->drawreferencemap();
    $url = $img->saveWebImage();

    echo "<INPUT TYPE=image SRC=$url  BORDER=1 NAME=KEYMAP>\n";
}



function ProcessURLArray( $aVars)
{
  //simpan tool navigasi yang sedang aktif
  $GLOBALS["gszCurrentTool"] = (isset($aVars["CMD"])) ? 
    $aVars["CMD"] : "ZOOM_IN";

  //set batas koordinat peta
  $oExt = $GLOBALS["goMap"];
  $fMinX = isset($aVars["MINX"]) ? $aVars["MINX"] : $oExt->extent->minx;
  $fMinY = isset($aVars["MINY"]) ? $aVars["MINY"] : $oExt->extent->miny;;
  $fMaxX = isset($aVars["MAXX"]) ? $aVars["MAXX"] : $oExt->extent->maxx;;
  $fMaxY = isset($aVars["MAXY"]) ? $aVars["MAXY"] : $oExt->extent->maxy;;
  $GLOBALS["goMap"]->setextent( $fMinX, $fMinY, $fMaxX, $fMaxY );

  //lebar dan tinggi gambar peta
  $fW  = $GLOBALS["goMap"]->width;
  $fH = $GLOBALS["goMap"]->height;

  if (isset($_GET["legendlayername"]))
  {
        for( $i=0; $i<$GLOBALS["goMap"]->numlayers; $i++ )
        {
            $oLayer = $GLOBALS["goMap"]->getLayer($i);
            if (in_array( $oLayer->name, $_GET["legendlayername"] ))
                $oLayer->set( "status", MS_ON );
            else
                $oLayer->set( "status", MS_OFF );
        }
    }
  
  //lakukan perubahan skala, sesuai tool navigasi terpilih
  if (isset($aVars["CMD"]) && isset ($aVars["MAINMAP_x"])) {
    //titik tempat user meng-klik pada lokasi peta
    $nX = isset($aVars["MAINMAP_x"]) ? 
      intval($aVars["MAINMAP_x"]) : $fW/2.0;
    $nY = isset($aVars["MAINMAP_y"]) ? 
      intval($aVars["MAINMAP_y"]) : $fW/2.0;
    
    if (isset($aVars["MAINMAP_x"]) && isset($aVars["MAINMAP_y"])) {
      $oPixelPos = ms_newpointobj();
      $oPixelPos->setxy($nX, $nY);

      $oGeoExt = ms_newrectobj();
      $oGeoExt->setextent($fMinX, $fMinY, $fMaxX, $fMaxY);

      //ubah skala peta, dengan method zoompoint atau setextent
      if ($aVars["CMD"] == "ZOOM_IN") {
        $GLOBALS["goMap"]->zoompoint(2, $oPixelPos, 
          $fW, $fH, $oGeoExt);
      } else if ($aVars["CMD"] == "ZOOM_OUT") {
        $GLOBALS["goMap"]->zoompoint(-2, $oPixelPos, 
          $fW, $fH, $oGeoExt);
      } else if ($aVars["CMD"] == "RECENTER") {
        $GLOBALS["goMap"]->zoompoint(1, $oPixelPos, 
          $fW, $fH, $oGeoExt);
      } else if ($aVars["CMD"] == "ZOOM_ALL") {
        $GLOBALS["goMap"]->setextent($GLOBALS["gfMinX"],
          $GLOBALS["gfMinY"], $GLOBALS["gfMaxX"],
          $GLOBALS["gfMaxY"]);
      } else if ($aVars["CMD"] == "QUERY")
      {
          $nGeoX = Pix2Geo($nX, 0, $fW, $fMinX, $fMaxX, 0);
          $nGeoY = Pix2Geo($nY, 0, $fH, $fMinY, $fMaxY, 1);
      
          $oGeo = ms_newPointObj();
          $oGeo->setXY($nGeoX, $nGeoY);
      
          // Simbol '@' digunakan supaya tidak muncul pesan peringatan
          // ketika objek tidak ditemukan
          @$GLOBALS["goMap"]->queryByPoint($oGeo, MS_SINGLE, -1);
      
          $GLOBALS["gShowQueryResults"] = TRUE;
      }
    }
  } else if (isset($aVars["KEYMAP_x"]) 
    && isset($aVars["KEYMAP_y"])) {
    
    $oRefExt = $GLOBALS["goMap"]->reference->extent;
    
    $nX = intval($aVars["KEYMAP_x"]);
    $nY = intval($aVars["KEYMAP_y"]);
    
    $fWidthPix = doubleval($GLOBALS["goMap"]->reference->width);
    $fHeightPix = doubleval($GLOBALS["goMap"]->reference->height);
    
    $nGeoX = Pix2Geo($nX, 0, $fWidthPix, $oRefExt->minx, $oRefExt->maxx, 0);
    $nGeoY = Pix2Geo($nY, 0, $fHeightPix, $oRefExt->miny, $oRefExt->maxy, 1);
    
    $fDeltaX = ($fMaxX - $fMinX) / 2.0;
    $fDeltaY = ($fMaxY - $fMinY) / 2.0;
    
    $GLOBALS["goMap"]->setextent($nGeoX - $fDeltaX, $nGeoY - $fDeltaY,
                                  $nGeoX + $fDeltaX, $nGeoY + $fDeltaY);
  }
  
}


function Pix2Geo($nPixPos, $fPixMin, $fPixMax, $fGeoMin, $fGeoMax,
                     $bInversePix)
{
    $fDeltaPix = ($bInversePix) ? $fPixMax - $nPixPos : $nPixPos - $fPixMin;

    $fDeltaGeo = $fDeltaPix * ($fGeoMax - $fGeoMin) / 
      ($fPixMax - $fPixMin);

    return $fGeoMin + $fDeltaGeo;
}


function IsCurrentTool( $szTool )
{
    return (strcasecmp($GLOBALS["gszCurrentTool"], $szTool) == 0);
}



?>
