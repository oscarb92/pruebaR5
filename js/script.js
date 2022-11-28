jQuery(document).ready(function($){
	
	setTimeout(function() { 
		$(".yearpickerM").yearpicker(); 
	}, 1000);

	// 	***** MASK PRICE *****
	let price = SimpleMaskMoney.setMask('#price',{
	    prefix: '$',
	    suffix: '',
	    fixed: true,
	    fractionDigits: 2,
	    decimalSeparator: '.',
	    thousandsSeparator: ',',
	    emptyOrInvalid: () => {
	      return this.SimpleMaskMoney.args.fixed
	        ? `0${this.SimpleMaskMoney.args.decimalSeparator}00`
	        : `_${this.SimpleMaskMoney.args.decimalSeparator}__`;
	    }
	});

	console.log(price.formatToNumber());

	$(".marca-select2").select2({
	  	tags: true
	});

	$('form.form-add-car').on('submit', function(e){
		e.preventDefault();
		$.ajax({
	        	url: "./lib/ajax.php?upload",
			   	type: "POST",
			   	data:  new FormData(this),
			   	contentType: false,
			    cache: false,
			   	processData:false,
			   	dataType: "json",
			   	beforeSend : function(){
				    //$("#preview").fadeOut();
				    $("#err").fadeOut();
			   	},
			   success: function(data){
			   		console.log(data);
				    if(data=='invalid'){
				     	$("#err").html("Invalid File !").fadeIn();
				    }else{
					    $("#preview").html(data).fadeIn();
					    $("form.form-add-car")[0].reset(); 
				    }
			    },
			    error: function(e) {
			    	console.log(e)
			    	//$("#err").html(e).fadeIn();
			    }          
	    });


	})


})
