<?php

require_once "conexao.php";
require_once "municipio.model.php";
require_once "municipio.service.php";
    //conexao
$con = new Conexao();
    //model
$mm = new MunicipioModel();
    //service
$ms = new MunicipioService($con,$mm);
    //variável que armazena o resultado da consulta no BD
$dados = $ms->recuperar();
$total = $ms->getTotal();

foreach ($total as $t => $tv);

?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<title>VACINÔMETRO MATO GROSSO</title>
	
	<!--CSS Bootstrap-->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
	<!--CSS Customizado-->
	<link rel="stylesheet" type="text/css" href="css/estilo.css">

	<!--JQuery-->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
	
	<!--Bibliotecas JS para o gráfico-->
	<script src="js/raphael.min.js"> </script> 
	<script  src= "js/jquery.mapael.min.js"> </script> 
	<script src="js/mt.js"></script>

	<!--Data Tables-->
	<link rel="stylesheet" type="text/css" href="bibliotecas/DataTables/DataTables-1.10.22/css/dataTables.bootstrap4.min.css"/>
	<link rel="stylesheet" type="text/css" href="bibliotecas/DataTables/RowGroup-1.1.2/css/rowGroup.bootstrap4.min.css"/> 
	<script type="text/javascript" src="bibliotecas/DataTables/DataTables-1.10.22/js/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="bibliotecas/DataTables/DataTables-1.10.22/js/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="bibliotecas/DataTables/RowGroup-1.1.2/js/dataTables.rowGroup.min.js"></script>

	<!--Google Fonts-->
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css2?family=Yusei+Magic&display=swap" rel="stylesheet">

</head>

<header class="letra">
	
	<nav class="navbar navbar-expand-sm navbar-dark bg-fundo">
		<!--Logo-->
		<a href="" id="logo" class="navbar-brand"><img src="img/logo.png" class="img-fluid" width="280px"></a>
		<!--Navegação-->
		<ul class="navbar-nav">
			<span class="letra text-white display-1">Vacinômetro</span>
		</ul>
	</nav>

</header>

<body>

	<section class="m-5">

		<div class="row border bg-white">
			
			<div class="col-md-6 border-right">
				
				<div class="col-md-6 text-center">
					<div class="card mt-2 mb-5">
						<div class="card-header bg-primary text-white">
							<h3><span class="titulo">População MT</span></h3>
						</div>
						<div class="card-body">
							<p class="h1 p-2 letra"><?= $tv->total_populacao ?></p>
						</div>
					</div>					
				</div>

				<div class="col-md-6 text-center mb-5">
					<div class="card">
						<div class="card-header bg-success text-white">
							<h3><span class="titulo">Doses Recebidas</span></h3>
						</div>
						<div class="card-body">
							<p class="h1 p-2 letra"><?= $tv->total_doses_recebidas ?></p>
						</div>
					</div>	
				</div>

				<div class="col-md-6 text-center">
					<div class="card">
						<div class="card-header bg-danger text-white">
							<h3><span class="titulo">Doses Aplicadas</span></h3>
						</div>
						<div class="card-body">
							<p class="h1 p-2 letra"><?= $tv->total_doses_aplicadas ?></p>
						</div>
					</div>	
				</div>

			</div>			

			<div class="col-md-6 container">
				<!--Mapa-->
				<div class="map"></div>
				<!--Legenda-->
				<div class="areaLegend mb-4 table-responsive"></div>
			</div>

		</div>

		<div class="row mt-3 p-2 border bg-white">
			
			<div class="col p-5 table-responsive">
				<table class="table table-striped table-borderless myTable">
					<thead class="thead-dark text-center">
						<tr>
							<th>Município</th>
							<th>População</th>
							<th>N° Doses Recebidas</th>
							<th>N° Doses Aplicadas</th>
						</tr>
					</thead>

					<tbody>
						<?php foreach ($dados as $key => $value) { ?>
							
							<tr>
								<td><?= $value->nome ?></td>
								<td class="text-center"><?= $value->populacao ?></td>
								<td class="text-center"><?= $value->qtde_doses_recebidas ?></td>
								<td class="text-center"><?= $value->qtde_doses_aplicadas ?></td>
							</tr>

						<?php } ?>
					</tbody>
				</table>
			</div>

		</div>

	</section>

	<footer class="m-5 text-center">
		<small><span id="rodape">Vacinômetro V1.0 - &copy; <?= date('Y') ?> | CODMSIS/STI/SES-MT</span></small>
	</footer>

	

	<script>
		$(".container").mapael({
			map : {
				name : "mt",
				defaultArea: {
					attrs: { 
						fill: "#e2dfdd",
						stroke: "#fff",
						"stroke-width": 1
					},
					attrsHover: {
						fill: "#e2dfdd",
						"stroke-width": 2
					}
				}
			},

			legend: {
				area: {
					mode: "horizontal",
					title: "% População MT Vacinada COVID-19",
					labelAttrs: {
                            "font-size": 12,

                        },
					slices: [
					{
						max: 5,
						attrs: {
							fill: "#6aafe1"
						},
						label: "< 5%"
					},
					{
						min: 5.001,
						max: 10,
						attrs: {
							fill: "#459bd9"
						},
						label: "> 5% e < 10%"
					},
					{
						min: 10.001,
						max: 50,
						attrs: {
							fill: "#2579b5"
						},
						label: "> 10% e < 50%"
					},
					{
						min: 50.001,
						max: 100,
						attrs: {
							fill: "#1a527b"
						},
						label: "> 50%"
					}

					]
				}
			},
			areas: {
				<?php foreach ($dados as $key => $value) { ?>

					"<?= $value->id_map ?>": {
						value: "<?= $value->percentual_vacinada?>",
						//href: "#",
						tooltip: {content: "<p class='badge bg-info d-flex justify-content-center text-white' id='cidade'><?= $value->nome ?></p><p><strong>População: </strong><?= $value->populacao?><br><span class='text-success'>Doses recebidas: </span><?= $value->qtde_doses_recebidas ?><br><span class='text-danger'>Doses aplicadas: </span><?= $value->qtde_doses_aplicadas ?><br><span class='text-info'>% População Vacinada: </span><?= $value->percentual_vacinada?>%</p>"}
					},

				<?php } ?>
			}
		});

    	//função para paginação e filtro nas tabelas usando DataTables pt-br
    	$('.myTable').DataTable({
    		"oLanguage":{
    			"sEmptyTable": "Nenhum registro encontrado",
    			"sInfo": "Mostrando de _START_ até _END_ de _TOTAL_ registros",
    			"sInfoEmpty": "Mostrando 0 até 0 de 0 registros",
    			"sInfoFiltered": "(Filtrados de _MAX_ registros)",
    			"sInfoThousands": ".",
    			"sLengthMenu": "_MENU_ resultados por página",
    			"sLoadingRecords": "Carregando ...",
    			"sProcessing": "Processando ...",
    			"sZeroRecords": "Nenhum registro encontrado",
    			"sSearch": "Pesquisar",
    			"oPaginate": {
    				"sNext": "Próximo",
    				"sPrevious": "Anterior",
    				"sFirst": "Primeiro",
    				"sLast": "Último"
    			},
    			"oAria": {
    				"sSortAscending": ": Ordenar colunas de forma ascendente",
    				"sSortDescending": ": Ordenar colunas de forma descendente"
    			},
    			"select": {
    				"linhas": {
    					"_": "Selecionado% d linhas",
    					"0": "Nenhuma linha avançada",
    					"1": "Selecionado 1 linha"
    				}
    			},
    			"botões": {
    				"copy": "Copiar para a área de transferência",
    				"copyTitle": "Cópia bem local",
    				"copySuccess": {
    					"1": "Uma linha copiada com sucesso",
    					"_": "% d linhas copiadas com sucesso"
    				}
    			}
    		},
    	});

    	$('select').attr('disabled','true');


    </script>

</body>
</html>