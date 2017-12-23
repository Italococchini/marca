var CARRITO = [];
CARRITO["cantidad"] = 0;
CARRITO["productos"] = [];
CARRITO["productos"].push({
	"tamano": "",
	"edad": "",
	"presentacion": "",
	"plan": "",
	"plan_id": "",
	"cantidad": 1,
	"subtotal": 0.00
});


var PRODUCTOS = [];
var PLANES = [];

jQuery(document).ready(function() {

	change_fase(1);

	carrousel();
	carrousel_responsive();
	CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] = jQuery("#vlz_carrousel img")[0].id;

	jQuery("#edad button").on("click", function(e){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["edad"] = jQuery(this).attr("data-value");
		change_fase(2, this);
	});

	jQuery("#presentaciones button").on("click", function(e){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["presentacion"] = jQuery(this).attr("data-value");
		change_fase(3, this);
	});

	jQuery("#plan button").on("click", function(e){
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["plan"] = jQuery(this).attr("data-value");

		var nombre_producto = PRODUCTOS[ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] ]["nombre"];

		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["plan_id"] = 
			PLANES[ 
				get_slug_producto(nombre_producto)+"_"+
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["presentacion"]+"_"+
				get_slug_producto( CARRITO["productos"][ (CARRITO["productos"].length-1) ]["plan"] )
			]["openpay_id"];
		

		change_fase(4, this);
	});

	jQuery("#btn-atras").on("click", function(e){
		change_fase( jQuery(this).attr("data-value") );
	});

	jQuery("#agregar_plan").on("click", function(e){
		e.preventDefault();
		CARRITO["productos"].push({
			"tamano": "",
			"edad": "",
			"presentacion": "",
			"plan": "",
			"plan_id": "",
			"cantidad": 1,
			"subtotal": 0.00
		});
		CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = undefined;
		jQuery("button").removeClass("vlz_activo");
		carrousel();
		carrousel_responsive();
		change_fase( 1 );
	});

	jQuery("#pagar").on("click", function(e){
		e.preventDefault();
		var _json = get_json_cart();
		jQuery.post(
			TEMA+"assets/ajax/carrito.php", {
				CART: _json
			},
			function(data){
				location.href = HOME+"/pagar-mi-marca";
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
	});

	jQuery("#tienda").on("click", function(e){
		e.preventDefault();
		var _json = get_json_cart();
		jQuery.post(
			TEMA+"assets/ajax/carrito.php", {
				CART: _json
			},
			function(data){
				location.href = HOME+"/pago-tienda";
			}, "json"
		).fail(function(e) {
			console.log( e );
	  	});
		
	});

	jQuery.post(
		TEMA+"assets/ajax/productos_planes.php", {},
		function(data){
			PRODUCTOS = data["PRODUCTOS"];
			PLANES = data["PLANES"];
		}, "json"
	).fail(function(e) {
		console.log( e );
  	});

});

function get_json_cart(){
	var _json = JSON.stringify( CARRITO["total"] )+"===";
	_json += JSON.stringify( CARRITO["cantidad"] )+"===";
	jQuery.each(CARRITO["productos"],  function(key, producto){
		_json += JSON.stringify( producto )+"|";
	});
	return _json;
}

function get_slug_producto(name){
	return String(name).replace(" ", "_").toLowerCase();
}

function change_title(txt){
	jQuery("#header").html(txt);
}

function change_fase(fase, _this = ""){
	jQuery(".comprar_container section").addClass("hidden");
	jQuery("#fase_"+fase).addClass("bounceInRight animated");
	jQuery("#fase_"+fase).removeClass('hidden');
	if( fase > 0 ){
		jQuery("#btn-atras").attr("data-value", fase-1);
	}else{
		location.href = HOME;
	}
	if( _this != "" ){
		var padre = jQuery(_this).parent().parent().attr("id");
		jQuery("#"+padre+" button").removeClass("vlz_activo");
		jQuery(_this).addClass("vlz_activo");
	}
	loadFase(fase);
}

function add_item_cart( index, ID, name, frecuencia, thumnbnail, price, presentacion, cantidad = 1 ){
	var HTML = "";

	HTML += '<tr>';
	HTML += '	 <td class=" hidden-xs">';
	HTML += '	 	<span onClick="eliminarProducto('+index+')">';
	HTML += '	 		<i class="fa fa-close"></i> <span class="hidden-sm hidden-md hidden-lg hidden-xs">Remover</span>';
	HTML += '	 	</span>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<span href="#">';
	HTML += '	 		<img src="'+thumnbnail+'" width="60px" height="60px">';
	HTML += '	 	</span>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label> '+name+' <br> '+presentacion+'</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label>'+frecuencia+'</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label>$ '+price+' MXN</label>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label id="cant_'+index+'"> '+cantidad+' </label> <div class="cantidad_controls"> <i class="fa fa-plus-circle mas" onclick="mas_cantidad('+index+')"></i> <i class="fa fa-minus-circle menos" onclick="menos_cantidad('+index+')"></i> </div>';
	HTML += '	 </td>';
	HTML += '	 <td class="">';
	HTML += '	 	<label>$ '+(price*cantidad)+' MXN</label>';
	HTML += '	 </td>';
	HTML += '</tr>';
	HTML += '<tr>';
	HTML += '	 <td colspan=7 class="separador">';
	HTML += '	 	<hr>';
	HTML += '	 </td>';
	HTML += '</tr>';

	jQuery( '#cart-items' ).append(HTML);
}

function mas_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	valor++;
	jQuery("#cant_"+index).html(valor);
	CARRITO["productos"][index]["cantidad"] = valor;
	CARRITO["cantidad"]++;
	loadFase(4);
}

function menos_cantidad(index){
	var valor = jQuery("#cant_"+index).html();
	if( valor > 1){
		valor--;
		jQuery("#cant_"+index).html(valor);
		CARRITO["productos"][index]["cantidad"] = valor;
		CARRITO["cantidad"]--;
		loadFase(4);
	}
}

function loadFase(fase){

	switch( fase ){
		
		case 1: // Fase #1 - Tamaño
			change_title('Elije el tamaño de tu mascota');
		break;

		case 2: // Fase #2 - Producto
			change_title('Escoge la marca de tu preferencia');
			var count_items = 1;
					

			loadProductos();
			loadProductosResponsive()
			carrousel_productos();
			carrousel_productos_responsive();
			
				$.each(PRODUCTOS,  function(key, val){
					changeExtra( count_items, ind, 0);
					count_items++;
				});

			setTimeout(
				function(){
					if( CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] != undefined ){
						jQuery(CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"]).click();
					}
				}, 500
			);
			 
		break;
		// ***************************************
		// Fase #3 - Plan ****
		// ***************************************
		case 3:
			change_title('Selecciona el tiempo de suscripción');
			jQuery("#plan article").css("display", "none");
			jQuery.each(PRODUCTOS[ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] ]["planes"],  function(key, val){
				if( val == 1 ){
					jQuery("#plan-"+key).css("display", "inline-block");

					var producto = CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"];
					var presentacion = CARRITO["productos"][ (CARRITO["productos"].length-1) ]["presentacion"];

					jQuery(".value_900g button").html( "$ "+( PRODUCTOS[ producto ]["presentaciones"][presentacion] * 1 )+" MXN" );
					jQuery(".value_2000g button").html("$ "+( PRODUCTOS[ producto ]["presentaciones"][presentacion] * 2 )+" MXN" );
					jQuery(".value_4000g button").html("$ "+( PRODUCTOS[ producto ]["presentaciones"][presentacion] * 4 )+" MXN" );
				}
			});
		break;
		// ***************************************
		// Fase #4 - Extras
		// ***************************************
		case 5:
			/* Omitir paso
			jQuery('#btn-omitir').removeClass('hidden');
			jQuery("#slider-item").empty();

			var count_items = 1;
			jQuery.each( extras, function(ind, itm){					
				changeExtra( count_items, ind, 0 );
				count_items++;
			});

			// Registrar Carrito de compras
			 addCart(urlbase);*/
		break;
		// ***************************************
		// Fase #5 - Resumen de Compra
		// ***************************************
		case 4:
			change_title('Verifica tu compra');

			var subtotal = 0;
			var iva = 0;
			var total = 0;
			var cant_item = 0;



			jQuery( '#cart-items' ).html("");

			var precio = 0;

			jQuery.each( CARRITO["productos"],  function(key, producto){

				var plan = 1;
				switch( producto['plan'] ){
					case "Mensual":
						plan = 2;
					break;
					case "Bimestral":
						plan = 4;
					break;
					case "Trimetral":
						plan = 5;
					break;
					case "Semestral":
						plan = 6;
					break;
				}

				var _producto = producto["producto"];
				var presentacion = producto["presentacion"];
				var precio_plan = PRODUCTOS[ _producto ]["presentaciones"][ presentacion ]*plan;

				precio=precio_plan;
				
				add_item_cart(
					key,
					producto["producto"],
					PRODUCTOS[ _producto ].nombre,
					producto['plan'],
					TEMA+"/productos/imgs/"+PRODUCTOS[ producto["producto"] ].dataextra.img,
					precio_plan,
					producto["presentacion"],
					producto["cantidad"]								
				);

				var temp_total = ( precio_plan * producto["cantidad"] );
				CARRITO["productos"][key]["subtotal"] = temp_total;
				subtotal += temp_total;

				cant_item += parseInt( producto["cantidad"] );
			});
			iva = subtotal * 0.12;
			subtotal= subtotal - iva;
			total = subtotal + iva;

			jQuery('#cant-item').html(cant_item);
			jQuery('#subtotal').html( FN(subtotal)+" MXN" );
			jQuery('#iva').html( FN(iva)+" MXN" );
			jQuery('#total').html( FN(total)+" MXN" );
			jQuery('#precio').html( FN(precio)+" MXN" );
			jQuery('#precio1').html( FN(precio)+" MXN" );
			jQuery('#precio2').html( FN(precio)+" MXN" );


			CARRITO["total"] = total;
			CARRITO["cantidad"] = cant_item;

		break;
	}
}

function FN(number){
	return new Intl.NumberFormat("de-DE", {style: "currency", currency: "USD"}).format(number);
}

function eliminarProducto(id){
	var confirmed = confirm("Esta seguro de quitar este producto.?");
    if (confirmed == true) {
    	var TEMP = [];
    	jQuery.each( CARRITO["productos"],  function(key, producto){
    		if(key != id){
				TEMP.push(producto);
    		}
		});
		CARRITO["productos"] = TEMP;
		if( CARRITO["productos"].length == 0 ){
			jQuery("#agregar_plan").click();
		}else{
			change_fase(4);
		}
    }
}




















































/* Carruseles */

	function loadProductos(){
		var actual_select = CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"];
		jQuery('#vlz_carrousel_2').html("");
		jQuery('#vlz_carrousel_2')
			.append(jQuery('<a href="#" id="prev"><span id="izquierda" class="fa fa-chevron-left izq"></span></a>'));
		jQuery.each(PRODUCTOS,  function(key, val){
			// if( val['tamanos'][ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] ] == 1 ){
				

				if( CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] == undefined ){
					CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = key;
					// jQuery("#descripciones").html( "Aqui iran las descripciones "+key );
					jQuery("#presentaciones").attr("data-value", key );
					jQuery("#nombre_producto").html( val.nombre );
					jQuery("#presentaciones .button_presentacion").css("display", "none");
					jQuery.each(val["presentaciones"],  function(key2, val2){
						if( val2 > 0 ){
							jQuery("#presentacion-"+key2).css("display", "inline-block");
							jQuery("#descripciones").html( "Aqui iran las descripciones "+key2 );
						}
					});
				}

				
				jQuery('#vlz_carrousel_2')
				.append(
					jQuery('<img id="item_'+key+'" data-id="'+key+'" data-name="'+val.nombre+'">')
					.attr(
						{
							'src': TEMA+"/productos/imgs/"+val.dataextra.img,
						   	'width': '270px',
						}
					)
				);
				
			// }
		});
		jQuery('#vlz_carrousel_2')
			.append(jQuery('<a href="" id="next"><span id="derecha" class="fa fa-chevron-right der"></span></a>'));
		if( actual_select != undefined ){
			CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = "#item_"+actual_select;
		}
	}
	function loadProductosResponsive(){
		var descripciones = 0;
		var actual_select = CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"];
		jQuery('#carrousel_2').html("");
		jQuery('#carrousel_2')
			.append(jQuery('<a href="#" id="prevresp"><span id="izquierda" class="fa fa-chevron-left izq"></span></a>'));
		jQuery.each(PRODUCTOS,  function(key, val){
			// if( val['tamanos'][ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] ] == 1 ){
				

				if( CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] == undefined ){
					CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = key;
					jQuery("#descripciones").html( "Aqui iran las descripciones"+key );
					jQuery("#presentaciones").attr("data-value", key );
					jQuery("#nombre_producto").html( val.nombre );
					jQuery("#presentaciones .button_presentacion").css("display", "none");
					jQuery.each(val["presentaciones"],  function(key2, val2){
						if( val2 > 0 ){
							jQuery("#presentacion-"+key2).css("display", "inline-block");
						}
					});
				}

				jQuery('#carrousel_2')
				.append(
					jQuery('<img id="item_'+key+'" data-id="'+key+'" data-name="'+val.nombre+'">')
					.attr(
						{
							'src': TEMA+"/productos/imgs/"+val.dataextra.img,
						   	'width': '270px',
						}
					)
				);

			// }
		});
		jQuery('#carrousel_2')
			.append(jQuery('<a href="" id="nextresp"><span id="derecha" class="fa fa-chevron-right der"></span></a>'));
		if( actual_select != undefined ){
			CARRITO["productos"][ (CARRITO["productos"].length-1) ]["actual"] = "#item_"+actual_select;
		}
	}

	function carrousel(){
		jQuery('#vlz_carrousel').waterwheelCarousel({
			separation: 280,
			edgeFadeEnabled: true,     	 
			flankingItems: 3,
			orientation: 'horizontal',
			movingToCenter: function ($item) {
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] = $item.attr('id');
				jQuery('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
			},
			movedToCenter: function ($item) {},
			movingFromCenter: function ($item) {},
			movedFromCenter: function ($item) {},
			clickedCenter: function ($item) {}
		});
	}

	function carrousel_responsive(){
		jQuery('#carrousel_responsive').waterwheelCarousel({
			separation: 150,
			edgeFadeEnabled: true,     	 
			flankingItems: 3,
			orientation: 'vertical',
			movingToCenter: function ($item) {
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["tamano"] = $item.attr('id');
				jQuery('#callback-output').prepend('movingToCenter: ' + $item.attr('id') + '<br/>');
			},
			movedToCenter: function ($item) {},
			movingFromCenter: function ($item) {},
			movedFromCenter: function ($item) {},
			clickedCenter: function ($item) {}
		});
	}

	function carrousel_productos() {
		var carousel = jQuery("#vlz_carrousel_2").waterwheelCarousel({
			flankingItems: 3,
			movingToCenter: function (jQueryitem) { },
			movedToCenter: function (jQueryitem) {
				jQuery("#presentaciones").attr("data-value", jQuery("#vlz_carrousel_2 .carousel-center").attr("data-id") );
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = jQuery("#vlz_carrousel_2 .carousel-center").attr("data-id");
				jQuery("#nombre_producto").html( jQuery("#vlz_carrousel_2 .carousel-center").attr("data-name") );
				jQuery("#presentaciones .button_presentacion").css("display", "none");
				jQuery.each(PRODUCTOS[ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] ]["presentaciones"],  function(key, val){
					if( val > 0 ){
						jQuery("#presentacion-"+key).css("display", "inline-block");
					}
				});
			},
			movingFromCenter: function (jQueryitem) {},
			movedFromCenter: function (jQueryitem) {},
			clickedCenter: function (jQueryitem) {}
		});
		jQuery('#prev').bind('click', function () {
	      carousel.prev();
	      return false
	    });
	    jQuery('#next').bind('click', function () {
	      carousel.next();
	      return false;
	    });
		
	}
	function carrousel_productos_responsive() {

		var carusel_responsive = jQuery("#carrousel_2").waterwheelCarousel({
			flankingItems: 0,
			movingToCenter: function (jQueryitem) {},
			movedToCenter: function (jQueryitem) {
				jQuery("#presentaciones").attr("data-value", jQuery("#carrousel_2 .carousel-center").attr("data-id") );
				CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] = jQuery("#carrousel_2 .carousel-center").attr("data-id");
				jQuery("#nombre_producto").html( jQuery("#carrousel_2 .carousel-center").attr("data-name"));
				jQuery("#presentaciones .button_presentacion").css("display", "none", "");
				jQuery.each(PRODUCTOS[ CARRITO["productos"][ (CARRITO["productos"].length-1) ]["producto"] ]["presentaciones"],  function(key, val){
					if( val > 0 ){
						jQuery("#presentacion-"+key).css("display", "inline-block");
					}
				});
			},
			movingFromCenter: function (jQueryitem) {},
			movedFromCenter: function (jQueryitem) {},
			clickedCenter: function (jQueryitem) {}
		});
		jQuery('#prevresp').bind('click', function () {
	      carusel_responsive.prev();
	      return false
	    });
	    jQuery('#nextresp').bind('click', function () {
	      carusel_responsive.next();
	      return false;
	    });
	}



