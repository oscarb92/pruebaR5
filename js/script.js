jQuery(document).ready(function($){
	
	setTimeout(function() { 
		var d = new Date();
		$(".yearpickerM").yearpicker({
			endYear: d.getFullYear(),
		}); 
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
		$(".alert-form").attr('data-alert', 'default');
		$(".alert-form").hide();
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
				    $("input.btn").prop("disabled", true);
			   	},
			   success: function(data){
			   		console.log(data);
				    if(!data.completado){
				     	$(".alert-form").html(data.msg).fadeIn();
				     	$(".alert-form").attr('data-alert', 'danger');
				    }else{
				    	$(".alert-form").html("¡Los datos han sido guardados!").fadeIn();
					    $(".alert-form").attr('data-alert', 'success');
					    $("form.form-add-car")[0].reset(); 
				    }
				    $("input.btn").prop("disabled", false);
			    },
			    error: function(e) {
			    	console.log(e)
			    	//$("#err").html(e).fadeIn();
			    	$("input.btn").prop("disabled", false);
			    }          
	    });


	});


})
