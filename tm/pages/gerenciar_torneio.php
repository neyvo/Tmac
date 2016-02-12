<?php include "topo.php"; ?>

<?php 
        if($_SESSION['perfil'] <> 'ADMINISTRADOR'){
            header("location: index.php");
        }

        
         if($_REQUEST['id']){
            $o = DB::procurar("torneio", $_REQUEST['id']);
         }
        
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Gerenciar Torneio</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Lista de Torneios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>                                            
                                            <th>Ano</th>
                                            <th>Etapa</th>                                            
                                            <th>Categoria</th>
                                            <th>Gerenciar</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';               
                                             
                        $p['ativo']['valor'] = "S";
                        $p['ativo']['tipo'] = '=';
                                                
			
                       $lista = DB::listar("torneio",$p,"order by nome");       
      
                       if($lista){
                           
                                 foreach($lista as $linha){
                                     
                                      $pc['excluido']['valor'] = 'N';
                                      $pc['excluido']['tipo'] = '=';
                                     
                                     $catl = DB::listar("categoria",$pc,"order by nome");       
                                     
                                     foreach($catl as $cat){
                                     
                                     $tipo = DB::procurar("etapa", $linha['id_etapa'])
?>                                        
                                        <tr class="gradeA">
                                            <td><?= $linha['id'] ?></td>                                            
                                            <td><?= $linha['nome'] ?></td>
                                            <td><?= $tipo['nome'] ?></td>
                                            <td><?= $cat['nome'] ?></td>
                                            
                                            <td><a href="gerenciar_grupo.php?tt=<?=$linha['id'] ?>&cat=<?= $cat['id'] ?>"><button type="button" class="btn btn-warning">Gerenciar</button></a></td>
                                            
                                        </tr>                                        
                       <?php } }
                       
                                 } ?>                                        
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