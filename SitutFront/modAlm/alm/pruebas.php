<div class="container-fluid mt-5">
	
	<form class="row">
		<div class="col-sm-4"></div>
		<div class="form-group col-sm-4">
			<label>Selecciona una opcion</label>
			<select id="sel" name="sel" class="form-control">
				<option value="0">Selecciona</option>
				<option value="1">Grupo 1</option>
				<option value="2">Grupo 2</option>
				<option value="3">Grupo 3</option>
			</select>
		</div>
	</form>

	<div class="table-responsive mt-4">
    	<table class="table table-bordered table-hover" id="tbListStd" width="100%" cellspacing="0">
        	<thead>
            	<tr>
              		<th>Grupo:</th>
					<th>Acciones:</th>
            	</tr>
        	</thead>
        	<tfoot>
            	<tr>
             		<th>Grupo:</th>
					<th>Acciones:</th>
            	</tr>
        	</tfoot>
        	<tbody></tbody>
    	</table>
   </div>
</div>

<script type="text/javascript">
	document.addEventListener('DOMContentLoaded', () => {


		const sel = document.getElementById('sel');

		sel.addEventListener('change', () => {
			datatableStd();
			// alert(sel.value);
		});
		
		const lenguaje = {
		    "sProcessing":     "Procesando...",
		    "sLengthMenu":     "Mostrar _MENU_ registros",
		    "sZeroRecords":    "No se encontraron resultados",
		    "sEmptyTable":     "Ningún dato disponible en esta tabla",
		    "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
		    "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
		    "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
		    "sInfoPostFix":    "",
		    "sSearch":         "Buscar:",
		    "sUrl":            "",
		    "sInfoThousands":  ",",
		    "sLoadingRecords": "Cargando...",
		    "oPaginate": {
		        "sFirst":    "Primero",
		        "sLast":     "Último",
		        "sNext":     "Siguiente",
		        "sPrevious": "Anterior"
		    },
		    "oAria": {
		        "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
		        "sSortDescending": ": Activar para ordenar la columna de manera descendente"
		    }
		};
		
		datatableStd = () => {
			tableStd = $("#tbListStd").dataTable({
				"aProcessing" : true,
				"aServerSide" : true,
				"ajax" : {
					url : "../../ajax/alm/prueba.php",
					data:{sel : sel.value},
					type : "POST",
					dataType : "json",
					error : function(e) {
						console.log(e.responseText);
					}
				},
				"bDestroy" : true,
				"language" : lenguaje
			}).DataTable();
		}
	});
</script>