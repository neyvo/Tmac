<?php include "topo.php"; ?>

<?php 

        
         if($_REQUEST['id']){
            $o = DB::procurar("atleta_categoria", $_REQUEST['id']);
         }
        
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Atualizar Pontos</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Dados do Registro
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="../controller/processaGeral.php" method="post">
                                        
                                        <div class="form-group">
                                            <label>Ano</label>
                                            <input class="form-control" name="p[ano]" value="<?= $o['ano'] ?>" required />                                            
                                        </div>                                        
                                        
                                        <div class="form-group">
                                            <label>Torneio</label>
                                            <select class="form-control" name="p[id_torneio]">
                                                
                                                 <?php		
	
                        $pt = "";	        
                        
                        $pt['excluido']['valor'] = 'N';
                        $pt['excluido']['tipo'] = '=';
			
                       $listaT = DB::listar("torneio",$pa,"order by nome");       
      
                       if($listaT){
                           
                                 foreach($listaT as $linhaT){
                                     
                                 
?>                                                           
                                                <option <?php if($o['id_torneio'] == $linhaT['id']) { ?>selected <?php } ?> value="<?= $linhaT['id'] ?>"><?= $linhaT['nome'] ?></option>
                                                <?php } } ?>
                                                
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Atleta</label>
                                            <select class="form-control" name="p[id_atleta]">
                                                
                                                 <?php		
	
                        $pa = "";	        
                        
                        $pa['excluido']['valor'] = 'N';
                        $pa['excluido']['tipo'] = '=';
			
                       $listaA = DB::listar("atleta",$pa,"order by nome");       
      
                       if($listaA){
                           
                                 foreach($listaA as $linhaA){
                                     
                                 
?>                                                           
                                                <option <?php if($o['id_atleta'] == $linhaA['id']) { ?>selected <?php } ?> value="<?= $linhaA['id'] ?>"><?= $linhaA['nome'] ?></option>
                                                <?php } } ?>
                                                
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Categoria</label>
                                            <select class="form-control" name="p[id_categoria]">
                                                
                                                 <?php		
	
                        $pc = "";	        
                        
                        $pc['excluido']['valor'] = 'N';
                        $pc['excluido']['tipo'] = '=';
			
                       $listaC = DB::listar("categoria",$pa,"order by nome");       
      
                       if($listaC){
                           
                                 foreach($listaC as $linhaC){
                                     
                                 
?>                                                           
                                                <option <?php if($o['id_categoria'] == $linhaC['id']) { ?>selected <?php } ?> value="<?= $linhaC['id'] ?>"><?= $linhaC['nome'] ?></option>
                                                <?php } } ?>
                                                
                                            </select>
                                        </div>
                                        
                                        
                                        
                                        <div class="form-group">
                                            <label>Pontos</label>
                                            <input class="form-control" name="p[pontos]" value="<?= $o['pontos'] ?>" required />                                            
                                        </div>
                                        
                                          <div class="form-group">
                                            <label>Classificação</label>
                                            <input class="form-control" name="p[classificacao]" value="<?= $o['classificacao'] ?>" required />                                            
                                        </div>
                                        
                                        
                                        
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <button type="reset" class="btn btn-primary">Limpar</button>
                                          <input type="hidden" name="objeto" value="atleta_categoria" />
                                          <input type="hidden" name="acao" value="Salvar" />
                       <input type="hidden" name="pagina" value="atualizar_pontos" />
                       <input type="hidden" name="id" value="<?php echo $o['id']; ?>">
                                        
                                    </form>
                                    <hr>
                                    <?php if($_REQUEST['msg']) { ?>
                         <div class="alert alert-success alert-dismissable">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <?= $_REQUEST['msg'] ?>
                            </div>
 <?php } ?>

                                </div>
                                <!-- /.col-lg-6 (nested) -->
                                <div class="col-lg-6">
                                    
                                    
                                    
                                    
                                    
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                            </div>
                            <!-- /.row (nested) -->
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-green">
                        <div class="panel-heading">
                            Pontuação
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Ano</th>
                                            <th>Torneio</th>
                                            <th>Categoria</th>
                                            <th>Atleta</th>
                                            <th>Pontos</th>  
                                            <th>Classif.</th>  
                                            <th>Alterar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
			
                       $lista = DB::listar("atleta_categoria",$p,"order by ano,id_torneio,id_categoria,pontos desc");       
      
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
                                            
                                            
                                            <td><a href="atualizar_pontos.php?id=<?=$linha['id'];?>"><button type="button" class="btn btn-warning">Alterar</button></a></td>
                                            <td><a href="../controller/processaExcluir.php?id=<?=$linha['id'];?>&pag=atualizar_pontos&obj=atleta_categoria"><button type="button" class="btn btn-danger">Excluir</button></a></td>                                          
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