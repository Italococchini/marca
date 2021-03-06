jQuery(document).ready(function() {

	jQuery("#tab_2 .suscripcion_item").on("click", function(e){
		jQuery(".suscripcion_item").removeClass("item_activo");
		jQuery(this).addClass("item_activo");
		jQuery("#tipo_suscripcion").val( jQuery(this).attr("data-plan") );
		jQuery("#presentacion").val( jQuery(this).attr("data-type") );
		jQuery("#status").val( jQuery(this).attr("data-status") );
		jQuery("#entrega").val( jQuery(this).attr("data-entrega") );
		jQuery("#img_item").attr("src", jQuery(this).attr("data-img") );

		var entregados = jQuery(this).attr("data-entregados");
		jQuery(".entregas span").removeClass("entregado");
		if( entregados != "-" ){
			entregados = entregados.split(",");
			jQuery.each(entregados, function( index, value ) {
			  	jQuery(".entregas #mes_"+value).addClass("entregado");
			});
		}
	});

	jQuery("#tab_3 .suscripcion_item").on("click", function(e){

		jQuery(".suscripcion_item").removeClass("item_activo");
		jQuery(this).addClass("item_activo");
		jQuery(".progress-content > div > div > div").removeClass("paso_completado");
		switch( jQuery(this).attr("data-status") ){
			case 'Armada':
				jQuery("#armada").addClass("paso_completado");
			break;
			case 'Enviada':
				jQuery("#armada").addClass("paso_completado");
				jQuery("#enviada").addClass("paso_completado");
			break;
			case 'Recibida':
				jQuery("#armada").addClass("paso_completado");
				jQuery("#enviada").addClass("paso_completado");
				jQuery("#recibida").addClass("paso_completado");
			break;
		}
	});

	jQuery("#tab_2 .suscripcion_item.item_activo").click();

	jQuery(".perfil_tabs li").on("click", function(e){
		jQuery(".secciones_container section").removeClass("section_activo");
		jQuery("#tab_"+jQuery(this).attr("data-tab")).addClass("section_activo");
		jQuery(".perfil_tabs li").removeClass("tab_activo");
		jQuery(this).addClass("tab_activo");
	});

	jQuery('[name="dir_estado"]').on('change', function(){
		jQuery.get( urlbase+"/ajax/admin_municipio.php?estado="+jQuery(this).val(), function(r) {
			var options = '<option value="0">Delegación</option>';
			var rx = jQuery.parseJSON(r);
			jQuery.each( rx, function(id, row){
				options = options  + '<option value="'+row.id+'">'+row.name+'</option>';
			});
			jQuery('[name="dir_ciudad"]').html( options );
		});

	});

	jQuery('#form-registro')
	.on('init.field.fv', function(e, data) {
		scroll(0);

        // data.field   --> The field name
        // data.element --> The field element
        if (data.field === 'sexo') {
            var $icon = data.element.data('fv.icon');
            $icon.appendTo('#alertSexIcon');
        }
    })
    
	.on('success.form.bv', function(e) {
	    // Prevent form submission
	    e.preventDefault();

	    
	    // Get the form instance
	    var $form = jQuery(e.target);

	    // Get the FormValidation instance
	    var bv = $form.data('formValidation');		

	    
		jQuery('#login-mensaje').html('');
		jQuery('#login-mensaje').addClass('hidden');
		
		jQuery.post( urlbase+"/ajax/register.php", {
			key:'registro',

			email: jQuery('[name="r_usuario"]').val(),
			email_c: jQuery('[name="r_usuario_c"]').val(),
			pass: jQuery('[name="r_clave"]').val(),
			pass_c: jQuery('[name="r_clave_c"]').val(),

			nombre: jQuery('[name="nombre"]').val(),
			apellido: jQuery('[name="apellido"]').val(),
			sexo: jQuery('[name="sexo"]').val(),
			edad: jQuery('[name="edad"]').val(),
			mascota: jQuery('[name="mascota"]').val(),
			telef_movil: jQuery('[name="telef_movil"]').val(),
			telef_fijo: jQuery('[name="telef_fijo"]').val(),
			dondo_conociste: jQuery('[name="dondo_conociste"]').val(),

			dir_numint: jQuery('[name="dir_numint"]').val(),
			dir_numext: jQuery('[name="dir_numext"]').val(),

			dir_calle: jQuery('[name="dir_calle"]').val(),
			dir_estado: jQuery('[name="dir_estado"]').val(),
			dir_ciudad: jQuery('[name="dir_ciudad"]').val(),
			dir_colonia: jQuery('[name="dir_colonia"]').val(),
			dir_codigo_postal: jQuery('[name="dir_codigo_postal"]').val()

		}, function(r) {

			r = jQuery.parseJSON(r);

			if(r['code']==1){
				var redirect = jQuery('[name="redirect"]').val();
				if( typeof jQuery('[name="redirect"]').val() == 'undefined'){
					redirect = '';
				}
				if( redirect != '' ){
					window.location = redirect;
				}else{
					window.location.reload();				
				}			
			}else{
				jQuery('#login-mensaje').html(r['msg']);
				jQuery('#login-mensaje').removeClass('hidden');

			}
			//<i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
			//<span class="sr-only">Loading...</span>
		});
	})
	.bootstrapValidator({
	    feedbackIcons: {
	        valid: 'glyphicon glyphicon-ok',		        
	        invalid: 'glyphicon glyphicon-remove',
	        validating: 'glyphicon glyphicon-refresh'
	    },
		submitHandler: function(validator, form, submitButton){
		    validator.defaultSubmit();
		},    
	    fields: {
		    
			nombre: {
			    message: 'Error',
			    validators: {
			        notEmpty: {
			            message: 'Este campo no debe estar vacío'
			        },
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 50
                    }
		    	}
			},
			apellido: {
			    message: 'Error',
			    validators: {
			        notEmpty: {
			            message: 'Este campo no debe estar vacío'
			        },
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 50
                    }
		    	}
			},
			sexo: {
				message: 'Error',
				validators: {
					choice: {
						min: 1,
						max: 1,
						message: 'Este campo no debe estar vacío'
					},
				},
			},
			edad: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					}, 
						integer :{
						message: 'Este campo no debe estar vacío'
					},
				},
			},
			telef_movil: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 13,
                        min: 10
                    }

				},
			},
			dondo_conociste: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
				},
			},
			r_usuario: {
				message: 'Email invalido',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},					
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 200
                    }
				},
			},
			r_usuario_c: {
				message: 'Email invalido',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					identical: {
                        field: 'r_usuario',
                        message: 'El usuario y su confirmación no son los mismos'
                    },
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 200
                    }
				},
			},
			r_clave: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					different: {
	                    field: 'r_usuario',
		                    message: 'El nombre de usuario y la contraseña no pueden ser iguales entre sí'
	                },
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 20
                    }
				},
			},
			r_clave_c: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
					identical: {
                        field: 'r_clave',
                        message: 'La contraseña y su confirmación no son los mismos'
                    },
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 20
                    }
                    
				},
			},
			dir_calle: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 200
                    }
				},
			},
			dir_numext: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 20
                    }
				},
			},
			dir_estado: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},integer :{
						message: 'Este campo no debe estar vacío'
					},
				},
			},
			dir_ciudad: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},integer :{
						message: 'Este campo no debe estar vacío'
					},
				},
			},
			dir_colonia: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 50

                    }					
				},
			},
			dir_codigo_postal: {
				message: 'Error',
				validators: {
					notEmpty: {
						message: 'Este campo no debe estar vacío'
					},
			        stringLength: {
                        message: 'Post content must be less than 120 characters',
                        max: 15
                    }					
				},
			},
	    }
	});

});