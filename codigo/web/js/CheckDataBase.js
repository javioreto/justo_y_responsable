$.ajax({
	dataType: "json",
	data: {id:"hola"},
	url:   '../controller/checkdb.php',
	type:  'post',
	beforeSend: function(){
		
	},
	success: function(response){
		
	},
	error:	function(xhr,err){
		page = '../view/errorBd.php';
		setTimeout(document.location.href=page,12500); 
	}
});

