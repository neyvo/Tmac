<?php include "topo.php"; ?>

<?php 

        if($_SESSION['perfil'] <> 'ADMINISTRADOR'){
            header("location: index.php");
        }

        //---------------------------------------------------------------
         if($_REQUEST['tt']){             
            $_SESSION['tt'] = $_REQUEST['tt'];             
         }
         
         if($_SESSION['tt']){                         
            $torneio = DB::procurar("torneio", $_SESSION['tt']);
         }
        
        //-------------------------------------------------------------
         
         if($_REQUEST['cat']){             
            $_SESSION['cat'] = $_REQUEST['cat'];             
         }
         if($_SESSION['cat']){
            $categoria = DB::procurar("categoria", $_SESSION['cat']);
         }
         
         if($_REQUEST['id']){
            $o = DB::procurar("grupo", $_REQUEST['id']);
         }    
        
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header"><?= $torneio['nome']. " - ".$categoria['nome'] ?></h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Dados do Grupo
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="../controller/processaGeral.php" method="post">
                                        
                                        <div class="form-group">
                                            <label>Torneio</label>
                                            <select class="form-control" name="p[id_torneio]">
                                                
                                                 <?php		
	
                        $pt = "";	        
                        
                        $pt['excluido']['valor'] = 'N';
                        $pt['excluido']['tipo'] = '=';
                        
                       
                        
                        $pt['id']['valor'] = $_SESSION['tt'];
                        $pt['id']['tipo'] = '=';
			
                       $listaT = DB::listar("torneio",$pt,"order by nome");       
      
                       if($listaT){
                           
                                 foreach($listaT as $linhaT){   
                                      $tipo = DB::procurar("etapa", $linhaT['id_etapa'])
?>                                                           
                                                <option <?php if($o['id_torneio'] == $linhaT['id']) { ?>selected <?php } ?> value="<?= $linhaT['id'] ?>"><?= $linhaT['nome']." - ".$tipo['nome'] ?></option>
                                                <?php } } ?>                                                
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Atleta</label>
                                            <select class="form-control" name="p[id_participante]">
                                                
                                                 <?php		
	
                        $pa = "";	        
                        
                        $pa['excluido']['valor'] = 'N';
                        $pa['excluido']['tipo'] = '=';
                        
                        $pa['id_torneio']['valor'] = $_SESSION['tt'];
                        $pa['id_torneio']['tipo'] = '=';
                        
                        $pa['id_categoria']['valor'] = $_SESSION['cat'];
                        $pa['id_categoria']['tipo'] = '=';
                        
                        $pa['situacao']['valor'] = 'PAGO';
                        $pa['situacao']['tipo'] = '=';
                        
			
                       $listaA = DB::listar("inscricao",$pa,"order by id");       
      
                       if($listaA){
                           
                                 foreach($listaA as $linhaA){
                                     
                                     $atle = DB::procurar("atleta", $linhaA['id_atleta']);
                                     
                                 
?>                                                           
                                                <option <?php if($o['id_atleta'] == $linhaA['id_atleta']) { ?>selected <?php } ?> value="<?= $linhaA['id_atleta'] ?>"><?= $atle['nome'] ?></option>
                                                <?php } } ?>
                                                
                                            </select>
                                        </div>
                                        
                                        
                                        
                                         <div class="form-group">
                                            <label>Grupo</label>
                                            <input class="form-control" name="p[nome]" value="<?= $o['nome'] ?>" required />                                            
                                        </div> 
                                        
                                             <div class="form-group">
                                            <label>Numero</label>
                                            <input class="form-control" name="p[numero]" value="<?= $o['numero'] ?>" required />                                            
                                        </div> 
                                        
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <button type="reset" class="btn btn-primary">Limpar</button>
                                          <input type="hidden" name="objeto" value="grupo" />
                                          <input type="hidden" name="acao" value="Salvar" />
                                          <input type="hidden" name="id" value="<?php echo $o['id']; ?>">                                          
                       <input type="hidden" name="pagina" value="gerenciar_grupo" />
                       
                                        
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
                            Grupos
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Torneio</th>                                                                                      
                                            <th>Grupo</th>
                                            <th>Numero</th>
                                            <th>Atleta</th>                                                                                        
                                            <th>Alterar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
                        
                        $p['id_torneio']['valor'] = $_SESSION['tt'];
                        $p['id_torneio']['tipo'] = '=';
			
                       $lista = @DB::listar("grupo",$p,"order by nome,numero");       
      
                       if($lista){
                           
                                 foreach($lista as $linha){
                                     
                                     $tt = DB::procurar("torneio", $linha['id_torneio']);
                                     $atle = DB::procurar("atleta", $linha['id_participante']);
                                     $tipo = DB::procurar("etapa", $tt['id_etapa']);
                                     
                                    
?>                                        
                                        <tr class="gradeA">
                                            <td><?= $tt['nome']." - ".$tipo['nome'] ?></td>                                            
                                            <td><?= $linha['nome'] ?></td>
                                            <td><?= $linha['numero'] ?></td>
                                            <td><?= $atle['nome'] ?></td>
                                                                          
                                            <td><a href="gerenciar_grupo.php?id=<?=$linha['id'];?>"><button type="button" class="btn btn-warning">Alterar</button></a></td>
                                            <td><a href="../controller/processaExcluir.php?id=<?=$linha['id'];?>&pag=gerenciar_grupo&obj=grupo"><button type="button" class="btn btn-danger">Excluir</button></a></td>                                          
                                            
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