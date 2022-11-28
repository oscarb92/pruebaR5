jQuery(document).ready(function($){
	
	setTimeout(function() { 
		var d = new Date();
		$(".yearpickerM").yearpicker({
			endYear: d.getFullYear(),
		}); 
	}, 1000);

	// 	***** MASK PRICE *****
	if($('#price').length){
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
	}

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
					    $('select.marca-select2').trigger('change')
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

	$('form.search-form').on('submit', function(e){
            e.preventDefault();
            $(".content-results .flex-results").html("");
            $(".content-results").removeClass('loading');
              $.ajax({
                  url: "./lib/ajax.php?buscar",
                  type: "POST",
                  data:  new FormData(this),
                  contentType: false,
                  cache: false,
                  processData:false,
                  dataType: "json",
                  beforeSend : function(){
                    //$("#preview").fadeOut();
                    $(".content-results").addClass('loading');
                  },
                 success: function(data){
                    console.log(data);
                    if(data.completado){
                    	var html= '';
                    	if(data.data){
	                      var values = data.data;
	                      for (let row of values) {
	                          var image = (row.imagen).replaceAll("..",".");
	                          var precio = Number(row.precio).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
	                          image = image == "" ? "./assets/images/logo.png" : image;
	                          html += '<div class="item-car-box"><div class="conte-box"><div class="img-box"><img src="'+image+'"></div><div class="content-txt-box">';
	                          html += '<h3>'+row.marca+'</h3>';
	                          html += '<div class="item-list-box"><span>Estado</span>: '+row.estado+'</div>';
	                          html += '<div class="item-list-box"><span>Línea</span>: '+row.linea+'</div>';
	                          html += '<div class="item-list-box"><span>Año</span>: '+row.year+'</div>';
	                          html += '<div class="item-list-box price-box"><span>Precio</span>: $'+precio+'</div>';
	                          html += '</div></div></div>';
	                      }
	                  }else{
	                  	html += '<div class="not-found-cars"><h2>¡No se han encontrado vehículos con los criterios de búsqueda!</h2></div>';
	                  }
                      $(".content-results .flex-results").html(html);
                    }else{
                      
                    }
                    $(".content-results").addClass('loading');
                  },
                  error: function(e) {
                    console.log(e)
                    //$("#err").html(e).fadeIn();
                    $(".content-results").addClass('loading');
                  }          
              });

       });

	// Cargar Marcas en el buscador
	$.ajax({
		url: "./lib/ajax.php?marca",
		type: "POST",
		contentType: false,
		cache: false,
		processData:false,
		dataType: "json",
		beforeSend : function(){

			$(".marca-field").prop("disabled", true);
			$(".content-results").addClass('loading');
		},
		success: function(data){

			let values = data.data;
			console.log(values);
			var marcas = [];
			for (let row of values) {
				marcas.push({"id": row, "text": row});
			}
			$(".marca-field").select2({
				data: marcas
			});
			$(".marca-field").prop("disabled", false);
		},
		error: function(e) {
			console.log(e)

			$(".marca-field").prop("disabled", false);
		}          
	});

})
