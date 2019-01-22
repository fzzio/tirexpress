function readURL(input) {
    if (input.files && input.files[0] ) {
        console.log("Size: " + input.files[0].size/1024/1024 + "MB" + " --- Type: " + input.files[0].type);

        var uploadErrors = [];
        var acceptFileTypes = /^image\/(jpe?g|png)$/i;
        if(input.files[0].type.length && !acceptFileTypes.test(input.files[0].type)) {
            uploadErrors.push('Sólo se pueden subir imágenes JPG y PNG.' );
        }
        if( input.files[0].size/1024/1024 > 5 ) {
            uploadErrors.push('El archivo excede los 5Mb permitidos por imagen.');
        }
        if(uploadErrors.length > 0) {
            alert(uploadErrors.join("\n"));
        } else {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(input).closest('.custom-input-file').find('.sm-img-foto')
                    .attr('src', e.target.result);
                $(input).closest('.custom-input-file').find('.sm-img-foto').show();
                $(input).closest('.custom-input-file').css('background-image', 'none');
        		//$(input).closest('.custom-input-file-edit').addClass('edit-flag');
            };
            reader.readAsDataURL(input.files[0]);
        }
    }else{
        $(input).closest('.custom-input-file').find('.sm-img-foto').attr('src', js_base_url('assets/near/img/camara.png'));
        $(input).closest('.custom-input-file').find('.sm-img-foto').removeAttr('style');
        $(input).closest('.custom-input-file').removeAttr('style');
        $(input).closest('.custom-input-file-edit').removeClass('edit-flag');
    }
}

/**
 * Resize function without multiple trigger
 * 
 * Usage:
 * $(window).smartresize(function(){  
 *     // code here
 * });
 */
(function($,sr){
    // debouncing function from John Hann
    // http://unscriptable.com/index.php/2009/03/20/debouncing-javascript-methods/
    var debounce = function (func, threshold, execAsap) {
      var timeout;

        return function debounced () {
            var obj = this, args = arguments;
            function delayed () {
                if (!execAsap)
                    func.apply(obj, args); 
                timeout = null; 
            }

            if (timeout)
                clearTimeout(timeout);
            else if (execAsap)
                func.apply(obj, args);

            timeout = setTimeout(delayed, threshold || 100); 
        };
    };

    // smartresize 
    jQuery.fn[sr] = function(fn){  return fn ? this.bind('resize', debounce(fn)) : this.trigger(sr); };

})(jQuery,'smartresize');
/**
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

var CURRENT_URL = window.location.href.split('#')[0].split('?')[0],
    $BODY = $('body'),
    $MENU_TOGGLE = $('#menu_toggle'),
    $SIDEBAR_MENU = $('#sidebar-menu'),
    $SIDEBAR_FOOTER = $('.sidebar-footer'),
    $LEFT_COL = $('.left_col'),
    $RIGHT_COL = $('.right_col'),
    $NAV_MENU = $('.nav_menu'),
    $FOOTER = $('footer');

	
	
// Sidebar
function init_sidebar() {
	// TODO: This is some kind of easy fix, maybe we can improve this
	var setContentHeight = function () {
		// reset height
		$RIGHT_COL.css('min-height', $(window).height());

		var bodyHeight = $BODY.outerHeight(),
			footerHeight = $BODY.hasClass('footer_fixed') ? -10 : $FOOTER.height(),
			leftColHeight = $LEFT_COL.eq(1).height() + $SIDEBAR_FOOTER.height(),
			contentHeight = bodyHeight < leftColHeight ? leftColHeight : bodyHeight;

		// normalize content
		contentHeight -= $NAV_MENU.height() + footerHeight;

		$RIGHT_COL.css('min-height', contentHeight);
	};

	$SIDEBAR_MENU.find('a').on('click', function(ev) {
		console.log('clicked - sidebar_menu');
		var $li = $(this).parent();

		if ($li.is('.active')) {
			$li.removeClass('active active-sm');
			$('ul:first', $li).slideUp(function() {
				setContentHeight();
			});
		} else {
        	// prevent closing menu if we are on child menu
        	if (!$li.parent().is('.child_menu')) {
        		$SIDEBAR_MENU.find('li').removeClass('active active-sm');
        		$SIDEBAR_MENU.find('li ul').slideUp();
        	}else{
        		if ( $BODY.is( ".nav-sm" ) ){
        			$SIDEBAR_MENU.find( "li" ).removeClass( "active active-sm" );
        			$SIDEBAR_MENU.find( "li ul" ).slideUp();
        		}
        	}
        	$li.addClass('active');

        	$('ul:first', $li).slideDown(function() {
        		setContentHeight();
        	});
        }
    });

	// toggle small or large menu 
	$MENU_TOGGLE.on('click', function() {
		console.log('clicked - menu toggle');

		if ($BODY.hasClass('nav-md')) {
			$SIDEBAR_MENU.find('li.active ul').hide();
			$SIDEBAR_MENU.find('li.active').addClass('active-sm').removeClass('active');
		} else {
			$SIDEBAR_MENU.find('li.active-sm ul').show();
			$SIDEBAR_MENU.find('li.active-sm').addClass('active').removeClass('active-sm');
		}

		$BODY.toggleClass('nav-md nav-sm');

		setContentHeight();
	});

	// check active menu
	$SIDEBAR_MENU.find('a[href="' + CURRENT_URL + '"]').parent('li').addClass('current-page');

	$SIDEBAR_MENU.find('a').filter(function () {
		return this.href == CURRENT_URL;
	}).parent('li').addClass('current-page').parents('ul').slideDown(function() {
		setContentHeight();
	}).parent().addClass('active');

	// recompute content when resizing
	$(window).smartresize(function(){  
		setContentHeight();
	});

	setContentHeight();

	// fixed sidebar
	if ($.fn.mCustomScrollbar) {
		$('.menu_fixed').mCustomScrollbar({
			autoHideScrollbar: true,
			theme: 'minimal',
			mouseWheel:{ preventDefault: true }
		});
	}
};

// /Sidebar
var randNum = function() {
	return (Math.floor(Math.random() * (1 + 40 - 20))) + 20;
};


// Panel toolbox
$(document).ready(function() {
    $('.collapse-link').on('click', function() {
        var $BOX_PANEL = $(this).closest('.x_panel'),
            $ICON = $(this).find('i'),
            $BOX_CONTENT = $BOX_PANEL.find('.x_content');
        
        // fix for some div with hardcoded fix class
        if ($BOX_PANEL.attr('style')) {
            $BOX_CONTENT.slideToggle(200, function(){
                $BOX_PANEL.removeAttr('style');
            });
        } else {
            $BOX_CONTENT.slideToggle(200); 
            $BOX_PANEL.css('height', 'auto');  
        }

        $ICON.toggleClass('fa-chevron-up fa-chevron-down');
    });

    $('.close-link').click(function () {
        var $BOX_PANEL = $(this).closest('.x_panel');

        $BOX_PANEL.remove();
    });
});
// /Panel toolbox

// Tooltip
$(document).ready(function() {
    $('[data-toggle="tooltip"]').tooltip({
        container: 'body'
    });
});
// /Tooltip

// Progressbar
if ($(".progress .progress-bar")[0]) {
    $('.progress .progress-bar').progressbar();
}
// /Progressbar

// Switchery
$(document).ready(function() {
    if ($(".nr-js-switch")[0]) {
        var elems = Array.prototype.slice.call(document.querySelectorAll('.nr-js-switch'));
        elems.forEach(function (html) {
            var switchery = new Switchery(html, {
                color: '#3498DB',
                jackColor : '#FFFFFF'
            });
        });
    }
    var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));

    elems.forEach(function(html) {
      var switchery = new Switchery(html);
    });
});
// /Switchery


// iCheck
// $(document).ready(function() {
//     if ($("input.flat")[0]) {
//         $(document).ready(function () {
//             $('input.flat').iCheck({
//                 checkboxClass: 'icheckbox_flat-blue',
//                 radioClass: 'iradio_flat-blue'
//             });
//         });
//     }
// });
// /iCheck



// Accordion
$(document).ready(function() {
    $(".expand").on("click", function () {
        $(this).next().slideToggle(200);
        $expand = $(this).find(">:first-child");

        if ($expand.text() == "+") {
            $expand.text("-");
        } else {
            $expand.text("+");
        }
    });
});

// NProgress
if (typeof NProgress != 'undefined') {
    $(document).ready(function () {
        NProgress.start();
    });

    $(window).load(function () {
        NProgress.done();
    });
}

	
//hover and retain popover when on popover content
var originalLeave = $.fn.popover.Constructor.prototype.leave;
$.fn.popover.Constructor.prototype.leave = function(obj) {
	var self = obj instanceof this.constructor ?
	obj : $(obj.currentTarget)[this.type](this.getDelegateOptions()).data('bs.' + this.type);
	var container, timeout;

	originalLeave.call(this, obj);

	if (obj.currentTarget) {
		container = $(obj.currentTarget).siblings('.popover');
		timeout = self.timeout;
		container.one('mouseenter', function() {
			//We entered the actual popover – call off the dogs
			clearTimeout(timeout);
			//Let's monitor popover content instead
			container.one('mouseleave', function() {
				$.fn.popover.Constructor.prototype.leave.call(self, self);
			});
		});
	}
};

$('body').popover({
	selector: '[data-popover]',
	trigger: 'click hover',
	delay: {
		show: 50,
		hide: 400
	}
});


function gd(year, month, day) {
	return new Date(year, month - 1, day).getTime();
}

/* SELECT2 */
function init_select2() {
	if( typeof (select2) === 'undefined'){ return; }
	console.log('init_toolbox');
	$(".select2_single").select2({
		placeholder: "Select a state",
		allowClear: true
	});
	$(".select2_group").select2({});
	$(".select2_multiple").select2({
		maximumSelectionLength: 4,
		placeholder: "With Max Selection limit 4",
		allowClear: true
	});

};
  

/* WYSIWYG EDITOR */
function init_wysiwyg() {
	if( typeof ($.fn.wysiwyg) === 'undefined'){ return; }
	console.log('init_wysiwyg');

	function init_ToolbarBootstrapBindings() {
		var fonts = ['Serif', 'Sans', 'Arial', 'Arial Black', 'Courier',
			'Courier New', 'Comic Sans MS', 'Helvetica', 'Impact', 'Lucida Grande', 'Lucida Sans', 'Tahoma', 'Times',
			'Times New Roman', 'Verdana'
			],
			fontTarget = $('[title=Font]').siblings('.dropdown-menu');

		$.each(fonts, function(idx, fontName) {
			fontTarget.append($('<li><a data-edit="fontName ' + fontName + '" style="font-family:\'' + fontName + '\'">' + fontName + '</a></li>'));
		});
		$('a[title]').tooltip({
			container: 'body'
		});
		$('.dropdown-menu input').click(function() {
			return false;
		})
		.change(function() {
			$(this).parent('.dropdown-menu').siblings('.dropdown-toggle').dropdown('toggle');
		})
		.keydown('esc', function() {
			this.value = '';
			$(this).change();
		});

		$('[data-role=magic-overlay]').each(function() {
			var overlay = $(this),
			target = $(overlay.data('target'));
			overlay.css('opacity', 0).css('position', 'absolute').offset(target.offset()).width(target.outerWidth()).height(target.outerHeight());
		});

		if ("onwebkitspeechchange" in document.createElement("input")) {
			var editorOffset = $('#editor').offset();

			$('.voiceBtn').css('position', 'absolute').offset({
				top: editorOffset.top,
				left: editorOffset.left + $('#editor').innerWidth() - 35
			});
		} else {
			$('.voiceBtn').hide();
		}
	}

	function showErrorAlert(reason, detail) {
		var msg = '';
		if (reason === 'unsupported-file-type') {
			msg = "Unsupported format " + detail;
		} else {
			console.log("error uploading file", reason, detail);
		}
		$('<div class="alert"> <button type="button" class="close" data-dismiss="alert">&times;</button>' +
			'<strong>File upload error</strong> ' + msg + ' </div>').prependTo('#alerts');
	}

	$('.editor-wrapper').each(function(){
		var id = $(this).attr('id');	//editor-one

		$(this).wysiwyg({
			toolbarSelector: '[data-target="#' + id + '"]',
			fileUploadError: showErrorAlert
		});	
	});


	window.prettyPrint;
	prettyPrint();

};
	
/* AUTOSIZE */
function init_autosize() {

	if(typeof $.fn.autosize !== 'undefined'){

		autosize($('.resizable_textarea'));

	}

};
	   
/* PARSLEY */
function init_parsley() {
	if( typeof (parsley) === 'undefined'){ return; }
	console.log('init_parsley');

	$/*.listen*/('parsley:field:validate', function() {
	  validateFront();
	});
	$('#form-entidad-agregar .btn-guardar, #form-superadmin-agregar .btn-guardar').on('click', function() {
		$(this).parents('.form-near-agregar').parsley().validate();
		validateFront();
	});

	$('#form-entidad-editar .btn-guardar, #form-auth-editar .btn-guardar').on('click', function() {
		$(this).parents('.form-near-editar').parsley().validate();
		validateFront();
	});
	
	var validateFront = function() {
		if (true === $('.form-near-agregar, .form-near-editar').parsley().isValid()) {
			$('.bs-callout-info').removeClass('hidden');
			$('.bs-callout-warning').addClass('hidden');
		} else {
			$('.bs-callout-info').addClass('hidden');
			$('.bs-callout-warning').removeClass('hidden');
		}
	};

	try {
		hljs.initHighlightingOnLoad();
	} catch (err) {}

};
	   
		
/* TAGS INPUT */
function init_TagsInput() {
	if( typeof $.fn.tagsInput === 'undefined'){ return; }
	console.log('init_TagsInput');

	$('#near-campo-detalle').tagsInput({
		width: 'auto',
		defaultText: 'Agregar opción'
	});
};


/* COLOR PICKER */
function init_ColorPicker() {
	
	if( typeof ($.fn.colorpicker) === 'undefined'){ return; }
	console.log('init_ColorPicker');
	
		$('.near-color-picker').colorpicker({
			autoInputFallback: false,
			format: 'hex',
			useAlpha: false
	    });
	
}; 

	   
/* DATERANGEPICKER */
function init_daterangepicker_single_call() {

	if( typeof ($.fn.daterangepicker) === 'undefined'){ return; }
	console.log('init_daterangepicker_single_call');


	$('#near-contrato-inicio, #near-contrato-fin, #near-miembro-fecha-nacimiento').daterangepicker({
		singleDatePicker: true,
		locale: {
            format: 'DD/MM/YYYY'
        },
		singleClasses: "picker_3"
	}, function(start, end, label) {
		console.log(start.toISOString(), end.toISOString(), label);
	});

}


	   
/* VALIDATOR */
function init_validator () {

	if( typeof (validator) === 'undefined'){ return; }
	console.log('init_validator'); 

	// initialize the validator function
	validator.message.date = 'not a real date';

	// validate a field on "blur" event, a 'select' on 'change' event & a '.reuired' classed multifield on 'keyup':
	$('form')
		.on('blur', 'input[required], input.optional, select.required', validator.checkField)
		.on('change', 'select.required', validator.checkField)
		.on('keypress', 'input[required][pattern]', validator.keypress);

	$('.multi.required').on('keyup blur', 'input', function() {
		validator.checkField.apply($(this).siblings().last()[0]);
	});

	$('form').submit(function(e) {
		e.preventDefault();
		var submit = true;

		// evaluate the form using generic validaing
		if (!validator.checkAll($(this))) {
			submit = false;
		}

		if (submit)
			this.submit();

		return false;
	});
};
	   

/* COMPOSE */
function init_compose() {

	if( typeof ($.fn.slideToggle) === 'undefined'){ return; }
	console.log('init_compose');

	$('#compose, .compose-close').click(function(){
		$('.compose').slideToggle();
	});

};

/* DATA TABLES */
function init_DataTables() {
	
	console.log('run_datatables');
	
	if( typeof ($.fn.DataTable) === 'undefined'){ return; }
	console.log('init_DataTables');
	
	var handleDataTableButtons = function() {
	  if ($("#datatable-buttons").length) {
		$("#datatable-buttons").DataTable({
		  dom: "Bfrtip",
		  buttons: [
			{
			  extend: "copy",
			  className: "btn-sm"
			},
			{
			  extend: "csv",
			  className: "btn-sm"
			},
			{
			  extend: "excel",
			  className: "btn-sm"
			},
			{
			  extend: "pdfHtml5",
			  className: "btn-sm"
			},
			{
			  extend: "print",
			  className: "btn-sm"
			},
		  ],
		  responsive: false
		});
	  }
	};

	TableManageButtons = function() {
	  "use strict";
	  return {
		init: function() {
		  handleDataTableButtons();
		}
	  };
	}();

	/*
	$('#datatable').dataTable();

	$('#datatable-keytable').DataTable({
	  keys: true
	});

	$('#datatable-responsive').DataTable();

	$('#datatable-scroller').DataTable({
	  ajax: "js/datatables/json/scroller-demo.json",
	  deferRender: true,
	  scrollY: 380,
	  scrollCollapse: true,
	  scroller: true
	});

	$('#datatable-fixed-header').DataTable({
	  fixedHeader: true
	});

	var $datatable = $('#datatable-checkbox');

	$datatable.dataTable({
	  'order': [[ 1, 'asc' ]],
	  'columnDefs': [
		{ orderable: false, targets: [0] }
	  ]
	});
	$datatable.on('draw.dt', function() {
	  $('checkbox input').iCheck({
		checkboxClass: 'icheckbox_flat-green'
	  });
	});
	*/

	TableManageButtons.init();
	
};

function getDatosEntidad(entidadID){
    var parametros = {
        entidadID: entidadID
    }
    $.ajax({
        url: js_site_url('entidad/getJSONBaseEntidadPorID'),
        type: 'POST',
        async: true,
        data: parametros,
        dataType: "json",
        success: function (respuesta) {
          	if(respuesta.codigo == 1){
          		$("#near-data-imglogo").attr('src', respuesta.data.entidadUrlImgLogo);
          		$("#near-data-administrador").text(respuesta.data.entidadAdministradorPrincipal);
        	}
        }, 
        error: function (error) {
          console.log("ERROR: " + error);
        }
    });
}

function init_near_dropdown_entidad() {
	if( typeof ($("#near-auth-entidad")) === 'undefined'){ return; }
	$("#near-auth-entidad").trigger("change");
	
	if( typeof ($("#near-miembro-entidad")) === 'undefined'){ return; }
	$("#near-miembro-entidad").trigger("change");
};

function modalEliminarEntidad(entidadID){
    var parametros = {
        entidadID: entidadID
    }
    $.ajax({
        url: js_site_url('entidad/getJSONBaseEntidadPorID'),
        type: 'POST',
        async: true,
        data: parametros,
        dataType: "json",
        success: function (respuesta) {
          	if(respuesta.codigo == 1){
				$("#eliminar-nombre").text(respuesta.data.entidadNombre);
				$("#eliminar-entidadid").val(respuesta.data.entidadID);
				$("#eliminar-entidad").modal('show');
        	}
        }, 
        error: function (error) {
          console.log("ERROR: " + error);
        }
    });
}
function eliminarEntidad( sadminID ){
    var parametros = {
        sadminID: sadminID,
        entidadID: $("#eliminar-entidadid").val()
    }
    $.ajax({
        url: js_site_url('entidad/eliminar'),
        type: 'POST',
        async: true,
        data: parametros,
        dataType: "json",
        success: function (respuesta) {
          	if(respuesta.codigo == 1){
        		$("#eliminar-entidad").modal('hide');
        		window.location.href = js_site_url('entidad/listar');
        	}
        }, 
        error: function (error) {
          console.log("ERROR: " + error);
        }
    });
}
function modalEliminarAuth(auth){
	var parametros = {
		auth: auth
	}
	$.ajax({
		url: js_site_url('auth/getJSONBaseAuthPorID'),
		type: 'POST',
		async: true,
		data: parametros,
		dataType: "json",
		success: function (respuesta) {
			if(respuesta.codigo == 1){
				$("#eliminar-rol").text(respuesta.data.authTipoRol);
				$("#eliminar-nombre").text(respuesta.data.authNombre);
				$("#eliminar-auth-id").val(respuesta.data.authID);
				$("#eliminar-auth").modal('show');
			}
		}, 
		error: function (error) {
			console.log("ERROR: " + error);
		}
	});
}

function modalEliminarChip(chip){
	var parametros = {
		chip: chip
	}
	$.ajax({
		url: js_site_url('chip/getJSONBaseChipPorID'),
		type: 'POST',
		async: true,
		data: parametros,
		dataType: "json",
		success: function (respuesta) {
			if(respuesta.codigo == 1){
				$("#eliminar-nombre").text(respuesta.data.nombre);
				$("#eliminar-chip-id").val(respuesta.data.chipID);
				$("#modal-eliminar-chip").modal('show');
			}
		}, 
		error: function (error) {
			console.log("ERROR: " + error);
		}
	});
}

function eliminarAuth( rol, usuario ){
    var parametros = {
        rol: rol,
        usuario: usuario,
        auth: $("#eliminar-auth-id").val()
    }
    $.ajax({
        url: js_site_url('auth/eliminar'),
        type: 'POST',
        async: true,
        data: parametros,
        dataType: "json",
        success: function (respuesta) {
          	if(respuesta.codigo == 1){
        		$("#eliminar-auth").modal('hide');
        		window.location.href = js_site_url(respuesta.data.slug + '/listar');
        	}
        }, 
        error: function (error) {
          console.log("ERROR: " + error);
        }
    });
}
function eliminarChip( rol, usuario, entidad ){
    var parametros = {
        rol: rol,
        usuario: usuario,
        entidad: entidad,
        chip: $("#eliminar-chip-id").val()
    }
    $.ajax({
        url: js_site_url('chip/eliminar'),
        type: 'POST',
        async: true,
        data: parametros,
        dataType: "json",
        success: function (respuesta) {
          	if(respuesta.codigo == 1){
        		$("#modal-eliminar-chip").modal('hide');
        		window.location.href = js_site_url('chip/listar/' + entidad);
        	}
        }, 
        error: function (error) {
          console.log("ERROR: " + error);
        }
    });
}


function agregarFormularioCampo(usuario, entidad){
	var parametros = {
	    usuario: usuario,
	    entidad: entidad,
	    tipo: $("#near-campo-adicional-tipo").val(),
	    nombre: $("#near-campo-adicional-nombre").val()
	}
	$.ajax({
	    url: js_site_url('formulariocampo/agregar'),
	    type: 'POST',
	    async: true,
	    data: parametros,
	    dataType: "json",
	    success: function (respuesta) {
	      	if(respuesta.codigo == 1){
	    		$("#near-campo-adicional-nombre").val('');
	    		$("#modal-campo-nuevo").modal('hide');
	    		window.location.href = js_site_url('formulariocampo/ver/' + entidad);
	    	}
	    }, 
	    error: function (error) {
	      console.log("ERROR: " + error);
	    }
	});
}

function obtenerCamposDinamicos(entidad){
	var parametros = {
	    entidad: entidad
	}
	$.ajax({
	    url: js_site_url('formulariocampo/obtener_por_entidad'),
	    type: 'POST',
	    async: true,
	    data: parametros,
	    dataType: "json",
	    success: function (respuesta) {
	    	
	      	if(respuesta.codigo == 1){
	      		var strCampos = "";
	      		$.each(respuesta.data, function(indice, campo) {
	      			strCampos += "<div class=\"form-group\">";
	      				strCampos += "<label class=\"control-label col-md-4 col-sm-4 col-xs-12\" for=\"near-miembro-dinamico-1\">";
	      					strCampos += campo.nombre + " <span class=\"required\">*</span>";
	      				strCampos += "</label>";
	      				strCampos += "<div class=\"col-md-6 col-sm-6 col-xs-12\">";
	      					switch(campo.tipo) {
	      					    case "text":
	      							strCampos += "<input required type=\"text\" name=\"near-miembro-dinamico-" + campo.id + "\" id=\"near-miembro-dinamico-" + campo.id + "\" class=\"form-control col-md-7 col-xs-12\" />";
	      					        break;
	      					    case "textarea":
	      							strCampos += "<textarea required name=\"near-miembro-dinamico-" + campo.id + "\" id=\"near-miembro-dinamico-" + campo.id + "\" class=\"form-control col-md-7 col-xs-12\" cols=\"30\" rows=\"3\" /></textarea>";
	      					        break;
	      					    default:
	      					        strCampos += "";
	      					        break;
	      					}

	      				strCampos += "</div>";
	      			strCampos += "</div>";
	      		});
	      		$("#contenedor-campos-dinamicos").html(strCampos);
	    	}
	    }, 
	    error: function (error) {
	      console.log("ERROR: " + error);
	    }
	});
}

function miembroAgregarIndividual(){
	window.location.href = js_site_url('chip/agregar/' + $("#near-auth-entidad").val());
}
function miembroDescargarPlantilla(){
	window.location.href = js_site_url('chip/descargar_plantilla/' + $("#near-auth-entidad").val());
}
function miembroSubirCSV(){
	window.location.href = js_site_url('chip/subir_csv/' + $("#near-auth-entidad").val());
}
function miembroSubirImagenes(){
	window.location.href = js_site_url('chip/subir_imagenes/' + $("#near-auth-entidad").val());
}
function miembroListar(){
	window.location.href = js_site_url('chip/listar/' + $("#near-auth-entidad").val());
}

$(document).ready(function() {
	//init_sparklines();
	//init_flot_chart();
	init_sidebar();
	init_wysiwyg();
	//init_InputMask();
	//init_JQVmap();
	//init_cropper();
	//init_knob();
	//init_IonRangeSlider();
	init_ColorPicker();
	init_TagsInput();
	init_parsley();
	//init_daterangepicker();
	//init_daterangepicker_right();
	init_daterangepicker_single_call();
	//init_daterangepicker_reservation();
	//init_SmartWizard();
	//init_EasyPieChart();
	//init_charts();
	//init_skycons();
	init_select2();
	init_validator();
	init_DataTables();
	//init_chart_doughut();
	//init_gauge();
	//init_PNotify();
	//init_starrr();
	//init_calendar();
	init_compose();
	//init_CustomNotification();
	init_autosize();
	//init_autocomplete();

	// NEAR
	init_near_dropdown_entidad();
});