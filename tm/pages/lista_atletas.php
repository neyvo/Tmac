<?php include "topo.php"; ?>


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Atletas</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Pontuação
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ano</th>
                                            <th>Torneio</th>
                                            <th>Categoria</th>
                                            <th>Atleta</th>
                                            <th>Pontos</th>                                                                               
                                            <th>Classif.</th>                                                                               
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
			
                       $lista = DB::listar("atleta_categoria",$p,"order by ano,id_categoria,pontos desc");       
      
                       if($lista){
                           
                                 foreach($lista as $linha){
                                     
                                     $atleta = DB::procurar("atleta", $linha['id_atleta']);
                                     $categoria = DB::procurar("categoria", $linha['id_categoria']);
                                     $torneio = DB::procurar("torneio", $linha['id_torneio']);
?>                                        
                                        <tr class="gradeA">
                                            <td><?= $linha['ano'] ?></td>
                                            <td><?= $torneio['nome'] ?></td>
                                            <td><?= $categoria['nome'] ?></td>
                                            <td><?= $atleta['nome'] ?></td>
                                            <td><?= $linha['pontos'] ?></td> 
                                            <td><?= $linha['classificacao'] ?></td> 
                                        </tr>                                        
                       <?php } } ?>                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            
            
            
        </div>
        <!-- /#page-wrapper -->

<?php include "rodape.php"; ?>