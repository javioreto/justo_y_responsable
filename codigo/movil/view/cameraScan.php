<?php
include_once ("../init.php");
if (is_file("controller/load.php")){
	include_once ("controller/load.php");
}
else {
	include_once ("../controller/load.php");
}

if (is_file("dataAccess/dataBase.php")){
    include_once ("dataAccess/dataBase.php");
}
else {
    include_once ("../dataAccess/dataBase.php");
}

$dataBase = new dataBase();
$con = $dataBase->CheckConnectDB($dataBase->getServer(),$dataBase->getUsername(),$dataBase->getPassword(),$dataBase->getDB());
?>



<!DOCTYPE html>
<html>
	<head>

		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?php echo _("Justo y Responsable") ?></title>
        
        <link rel="stylesheet" href="../css/themes/default/jyrtheme.min.css" />
        <link rel="stylesheet" href="../css/themes/default/jquery.mobile.icons.min.css" />
        <link rel="stylesheet" href="http://code.jquery.com/mobile/1.4.2/jquery.mobile.structure-1.4.2.min.css" />
        
        <link rel="stylesheet"  href="../css/cameraScan.css">
        
        <script src="../js/static/jquery.js"></script>
        <script src="../js/static/jquery.mobile-1.4.2.min.js"></script>

		<script type="text/javascript" src="../js/searchFunctions.js"></script>
		<script type="text/javascript" src="../js/establishmentMap.js"></script>
		<script type="text/javascript" src="../js/load.js"></script>
		<script type="text/javascript" src="../js/location.js"></script>
				<script type="text/javascript" src="get_barcode_from_image.js"></script>

		
		<script src="http://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places" type="text/javascript"></script>
		
        
	</head>
	
	
	<body>	
	<div id="head" data-role="header" data-theme="a">
	    <a href="index.php" data-ajax="false" data-rel="back" class="ui-btn ui-corner-all ui-shadow ui-icon-back ui-btn-icon-left ui-btn-icon-notext"></a>
	    <div id="tablehead" align="center">
	    <table>
               <tr>
                   <td>
                       <img src="../../images/logojyrm.png" alt="logo JyR" />
                   </td>
                   <td>
                       <h1> <?php echo _("JyR") ?></h1>
                   </td>
               </tr>
           </table>
		</div>
		
		<a data-ajax='false' href='#settingPanel' class="ui-btn ui-corner-all ui-shadow ui-icon-bars ui-btn-right ui-btn-icon-notext"></a>
	</div>
	
	
	<video id="video" style="width:100%; margin-left:auto; margin-right:auto; max-height:800px;"></video>
	<div class="banner_over_scan">Escanee el código de barras del producto</div>

	<div style="background-color:gray; min-height:60px; text-align:center;">
		<a id="button" class="ui-btn ui-btn-inline ui-shadow ui-btn-corner-all">Escanear</a>
	</div>
	
    
<button onclick="alert(getBarcodeFromImage('picture'))">Scan</button>
        <!-- target for the canvas-->
        <div id="canvasHolder"></div>

        <!--preview image captured from canvas-->
        <img id="preview" src="about:blank" width="160" height="120" />

        <label>base64 image:</label>
        <input id="imageToForm" type="text" />
		<p id="textbit"></p>
		Hola!
		
		<img width="320" height="240" src="about:blank" alt="" id="picture">
			<input id="Take-Picture" type="file" accept="image/*;capture=camera" />
		 <script>

        var video;
        var dataURL;

        //http://coderthoughts.blogspot.co.uk/2013/03/html5-video-fun.html - thanks :)
        function setup() {
            navigator.myGetMedia = (navigator.getUserMedia ||
            navigator.webkitGetUserMedia ||
            navigator.mozGetUserMedia ||
            navigator.msGetUserMedia);
            navigator.myGetMedia({ video: true }, connect, error);
        }

        function connect(stream) {
            video = document.getElementById("video");
            video.src = window.URL ? window.URL.createObjectURL(stream) : stream;
            video.play();
        }

        function error(e) { console.log(e); }

        addEventListener("load", setup);

        function captureImage() {
            var canvas = document.createElement('canvas');
            canvas.id = 'hiddenCanvas';
            //add canvas to the body element
            document.body.appendChild(canvas);
            //add canvas to #canvasHolder
            document.getElementById('canvasHolder').appendChild(canvas);
            var ctx = canvas.getContext('2d');
            canvas.width = video.videoWidth / 4;
            canvas.height = video.videoHeight / 4;
            ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
            //save canvas image as data url
            dataURL = canvas.toDataURL();
            //set preview image src to dataURL
            document.getElementById('preview').src = dataURL;
            // place the image value in the text box
            document.getElementById('imageToForm').value = dataURL;
            document.getElementById('picture').setAttribute( 'src', dataURL );
			DecodeBar()
            }

        //Bind a click to a button to capture an image from the video stream
        var el = document.getElementById("button");
        el.addEventListener("click", captureImage, false);

    </script>
    
    
<script type="text/javascript">
			var takePicture = document.querySelector("#Take-Picture"),
			showPicture = document.querySelector("#picture");
			Result = document.querySelector("#textbit");
			Canvas = document.createElement("canvas");
			Canvas.width=640;
			Canvas.height=480;
			var resultArray = [];
			ctx = Canvas.getContext("2d");
			var workerCount = 0;
			function receiveMessage(e) {
				if(e.data.success === "log") {
					console.log(e.data.result);
					return;
				}
				if(e.data.finished) {
					workerCount--;
					if(workerCount) {
						if(resultArray.length == 0) {
							DecodeWorker.postMessage({ImageData: ctx.getImageData(0,0,Canvas.width,Canvas.height).data, Width: Canvas.width, Height: Canvas.height, cmd: "flip"});
						} else {
							workerCount--;
						}
					}
				}
				if(e.data.success){
					var tempArray = e.data.result;
					for(var i = 0; i < tempArray.length; i++) {
						if(resultArray.indexOf(tempArray[i]) == -1) {
							resultArray.push(tempArray[i]);
						}
					}
					Result.innerHTML=resultArray.join("<br />");
				}else{
					if(resultArray.length === 0 && workerCount === 0) {
						Result.innerHTML="Decoding failed.";
					}
				}
			}
			var DecodeWorker = new Worker("DecoderWorker.js");
			DecodeWorker.onmessage = receiveMessage;
			if(takePicture && showPicture) {
			takePicture.onchange = function (event) {
				//document.querySelector("#button").onclick = function (event) {	
				alert(event);
					var files = event.target.files
					//var files = event.target.files
					if (files && files.length > 0) {
						file = files[0];
						try {				
							var URL = window.URL || window.webkitURL;
							var imgURL = URL.createObjectURL(file);
							showPicture.src = imgURL;
							URL.revokeObjectURL(imgURL);
							DecodeBar()
						}
						catch (e) {
							try {
								var fileReader = new FileReader();
								fileReader.onload = function (event) {
									showPicture.src = event.target.result;
								};
								fileReader.readAsDataURL(file);
								DecodeBar()
							}
							catch (e) {
								Result.innerHTML = "Neither createObjectURL or FileReader are supported";
							}
						}
					}
				};
			}
			function DecodeBar(){
				showPicture.onload = function(){
					ctx.drawImage(showPicture,0,0,Canvas.width,Canvas.height);
					resultArray = [];
					workerCount = 2;
					Result.innerHTML="";
					DecodeWorker.postMessage({ImageData: ctx.getImageData(0,0,Canvas.width,Canvas.height).data, Width: Canvas.width, Height: Canvas.height, cmd: "normal"});
				}
			}
						</script>	
	</body>       
</html>