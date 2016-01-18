<?php include "topo.php"; ?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    
                    <?php                                                        
                     if($_SESSION['foto']) { ?>
                                            <img src="./fotos/<?= $_SESSION['foto'] ?>" width="100px" height="100px" />
                     <?php } ?>
                    
                    <h3 class="page-header"> <?= $_SESSION['nome_usuario'] ?> - <?= $_SESSION['perfil'] ?> </h3>              
                    
                     
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            
            
            <?php 
            $ano = 2016; 
            
            while( $ano >= 2015  ) {
            
            ?>
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel  <?php if(fmod($ano,2)==1){ echo 'panel-primary';} else { echo 'panel-green'; }?> ">
                        <div class="panel-heading">
                            Pontuação - <?= $ano ?>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover xtable" >
                                    <thead>
                                        <tr>
                                            <th>Ano</th>
                                            <th>Torneio</th>
                                            <th>Categoria</th>
                                            <th>Atleta</th>
                                            <th>Pontos</th>                                                                               
                                            <th>Classificação</th>                                                                               
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
                        
                        $p['id_atleta']['valor'] = $_SESSION['id_usuario'];
                        $p['id_atleta']['tipo'] = '=';
                        
                        $p['ano']['valor'] = $ano;
                        $p['ano']['tipo'] = '=';
                        
			
                       $lista = DB::listar("atleta_categoria",$p,"order by ano desc,id_categoria,pontos desc");       
      
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
            
            <?php $ano--; } ?>
            
            
            
            
        </div>
        <!-- /#page-wrapper -->

<?php include "rodape.php"; ?>