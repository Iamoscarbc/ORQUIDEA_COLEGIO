<?php
//include("../seguridad.php");
include("../central/cabecera.php");
include("../central/sidebar.php");
?>
<div class="content-wrapper">
<section class="content">
			<div class="row">
				 <div class="col-xs-12">
						<div class="box box-info">
								 <div class="box-header with-border">
										<h3 class="box-title"><b>Reporte de Pagos</b></h3>
										<div class="box-tools pull-right">
											<button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
											<button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
										</div>
								 </div>
						<!-- /.box-header -->
						<div class="box-body">
             <div class="table-responsive">
							<table class="table" >
 					    <tr>
 							   <td><b>Desde</td>
 								<td><input type="date" id="bd-desde"/></td>
 								<td><b>Hasta</td>
 								<td><input type="date" id="bd-hasta"/></td>
 								<td><a href="javascript:reportePDF();" class="btn btn-info"><span class="glyphicon glyphicon-print"> Imprimir</span></a></td>
 						</tr>
 				     </table>
						 	</div>
						</div>
					</div>
					<!-- /.box -->
				</div>
				<!-- /.col-->
			<!-- ./row -->
		</section>
		</div>
		<script>
		function reportePDF(){
			var desde = $('#bd-desde').val();
			var hasta = $('#bd-hasta').val();
			window.open('rptrango2pago.php?desde='+desde+'&hasta='+hasta);
		}
		</script>
		<?php include("../central/pie2.php"); ?>
	  <?php include("../central/pie.php");?>
