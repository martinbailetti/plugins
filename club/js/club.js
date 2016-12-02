jQuery(document).ready(function($){

	//objeto que almacena variables que se envían desde PHP
	console.info(WP_OBJECT);

	$("#club-edit-form").submit(function( event ) {

  		$("#club-edit-form label").removeClass("form-field-error");

  		if($("#nombre").val()==""){

  			$("#club-edit-form label[for=nombre]").addClass("form-field-error");
  			event.preventDefault();

  		}
  		if($("#apellidos").val()==""){

  			$("#club-edit-form label[for=apellidos]").addClass("form-field-error");
  			event.preventDefault();

  		}
  		if($("#correo").val()==""){

  			$("#club-edit-form label[for=correo]").addClass("form-field-error");
  			event.preventDefault();

  		}
  		if($("#codigo").val()==""){

  			$("#club-edit-form label[for=codigo]").addClass("form-field-error");
  			event.preventDefault();

  		}
	});


});