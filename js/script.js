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

})
