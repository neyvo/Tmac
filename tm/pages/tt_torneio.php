<?php include "topo_index.php"; ?>

<?php 
        
        
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Torneios </h2>
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
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>
                                            
                                            <th>Ano</th>
                                            <th>Tipo</th>                                            
                                            <th>Descricao</th>
                                            <th>Inscrição</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
                        
                        $p['datai']['valor'] = hoje("Y-m-d");
                        $p['datai']['tipo'] = '<=';
                        
                        $p['dataf']['valor'] = hoje("Y-m-d");
                        $p['dataf']['tipo'] = '>=';
			
                       $lista = DB::listar("torneio",$p,"order by nome");       
      
                       if($lista){
                           
                                 foreach($lista as $linha){
                                     
                                     $tipo = DB::procurar("etapa", $linha['id_etapa'])
?>                                        
                                        <tr class="gradeA">
                                            
                                            <td><?= $linha['nome'] ?></td>
                                            <td><?= $tipo['nome'] ?></td>
                                            <td> <div class="form-group">
                                            
                                                    <textarea class="form-control" name="p[descricao]" rows="10" readonly><?= $linha['descricao'] ?></textarea>                                         
                                        </div></td>
                                            <td><a href="tt_inscricao.php?t=<?=$linha['id'];?>"><button type="button" class="btn btn-warning">INSCRIÇÃO</button></a></td>
                                            
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