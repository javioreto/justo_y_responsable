barcode_scanner = {

  result: {
    element: null,

    show: function(code) {
      this.element.innerHTML = code;
    },
  },

  decode: {
    tobias: {
      do: function(photo) {
        var code = getBarcodeFromImage(photo);
        result.show(code);
      },
    },

    eddie: {
      workerCount: 0,
      resultArray: [],

      do: function(canvas) {
        //if (this.workerCount > 0) return;
        this.workerCount = 2;
        this.resultArray = [];
        barcode_scanner.decode.canvas = canvas;
        barcode_scanner.decode.ctx = canvas.getContext('2d');

        var DecodeWorker = new Worker("DecoderWorker.js");
        DecodeWorker.onmessage = this.receiveMessage;
		DecodeWorker.postMessage({pixels: barcode_scanner.decode.ctx.getImageData(0,0,canvas.width,canvas.height).data, cmd: "normal"});
      },

      receiveMessage: function(e) {
        var canvas = barcode_scanner.decode.canvas;
        var ctx = barcode_scanner.decode.ctx;

        barcode_scanner.decode.eddie.workerCount--;
        if(e.data.success){
          var tempArray = e.data.result;
          for(var i = 0; i < tempArray.length; i++) {
            if(barcode_scanner.decode.eddie.resultArray.indexOf(tempArray[i]) == -1) {
              barcode_scanner.decode.eddie.resultArray.push(tempArray[i]);
            }
          }
          barcode_scanner.result.show(barcode_scanner.decode.eddie.resultArray.join("<br />"));
          barcode_scanner.decode.eddie.workerCount = 0;
        }else {
          if(barcode_scanner.decode.eddie.workerCount == 1) {
            var FlipWorker = new Worker("DecoderWorker.js");
            FlipWorker.onmessage = barcode_scanner.decode.eddie.receiveMessage;
            FlipWorker.postMessage({pixels: ctx.getImageData(0,0,canvas.width,canvas.height).data, cmd: "flip"});
          }
        }
        if(barcode_scanner.decode.eddie.workerCount == 0){
          if(barcode_scanner.decode.eddie.resultArray.length === 0) {
            barcode_scanner.result.show("No se ha detectado el codigo de barras,<br>escanee de nuevo el producto.");
      				$('#resultado').removeClass('hidden').addClass('visible');
            setTimeout(function () {
      				$('#resultado').removeClass('visible').addClass('hidden');
   				 }, 3000);
          }else {
          	$('#resultado').removeClass('hidden').addClass('visible');
            barcode_scanner.result.show(barcode_scanner.decode.eddie.resultArray + "<br /><img src='../../images/cargador.gif' style='margin:15px 0px -10px 0px;'>");
            loadProduct(barcode_scanner.decode.eddie.resultArray[0]);
          }
        }
      },
    },
  },
}

$(document).ready(function(){
    var streaming = false,
  video        = document.querySelector('#video'),
  canvas       = document.querySelector('#canvas'),
  photo        = document.querySelector('#barcode'),
  startbutton  = document.querySelector('#startbutton'),
  result       = document.querySelector('#result'),
  width = 640,
  height = 0;

  navigator.getMedia = ( navigator.getUserMedia ||
                        navigator.webkitGetUserMedia ||
                        navigator.mozGetUserMedia ||
                        navigator.msGetUserMedia);
if (navigator.getMedia) {
  navigator.getMedia({video: true, audio: false}, function(stream) {
      if (navigator.mozGetUserMedia) {
        video.mozSrcObject = stream;
      } else {
        var vendorURL = window.URL || window.webkitURL;
        video.src = vendorURL.createObjectURL(stream);
      }
      video.play();
    },
    function(err) {
    $('#introducir').removeClass('hidden').addClass('subir');
    $('#txt1').addClass('hidden');
    $('#txt2').addClass('hidden');
    }
  );
  }else{
    $('#introducir').removeClass('hidden').addClass('subir');
    $('#txt1').addClass('hidden');
    $('#txt2').addClass('hidden');
  }

  video.addEventListener('canplay', function(ev){
    if (!streaming) {
      height = video.videoHeight / (video.videoWidth/width);
      video.setAttribute('width', width);
      video.setAttribute('height', height);
      canvas.setAttribute('width', width);
      canvas.setAttribute('height', height);
      streaming = true;
    }
      
  }, false);

  function takepicture() {

    var data = canvas.toDataURL('image/png');
    photo.setAttribute('src', data);
  }

  function scan() {
    takepicture();

    canvas.width = width;
    canvas.height = height;
    var ctx = canvas.getContext('2d');
    ctx.drawImage(video, 0, 0, width, height);

    barcode_scanner.result.element = result;
    barcode_scanner.decode.eddie.do(canvas);

    //scanTimeout();
  }

  function scanTimeout(){
    setTimeout(scan, 100);
  }

  startbutton.addEventListener('click', function(ev){
    scanTimeout();
    ev.preventDefault();
  }, false); 
  
  buscar.addEventListener('click', function(ev){
    loadProduct('cod: '+document.getElementById('codText').value);
  }, false);
  
  lanzartexto.addEventListener('click', function(ev){
    $('#introducir').removeClass('hidden').addClass('subir');
  }, false);


});


//Function to load products.
function loadProduct(barcode){
	$.ajax({
			dataType: "json",
			data: {"barcode": barcode},
			url:   '../controller/checkCode.php',
			type:  'post',
			beforeSend: function(){
				
			},
			success: function(response){
				if(response!=0){
					page = '../view/products.php?cod='+response;
					setTimeout(document.location.href=page,12500);
				}
				
			},
			error:	function(xhr,err){ 
				//alert("El codigo de barras introducido no esta en nuestra \nbase de datos, introduzca otro codigo.");
				$( "#popupBasic" ).popup("open");
			}
		});
}

