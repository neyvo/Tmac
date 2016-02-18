<?php include "topo.php"; ?>

<?php 

        if($_SESSION['perfil'] <> 'ADMINISTRADOR'){
            header("location: index.php");
        }

         if($_REQUEST['id']){
            $o = DB::procurar("inscricao", $_REQUEST['id']);
         }              
        
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Inscrição Torneio</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Dados do torneio
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
                        
                        $pt['datai']['valor'] = hoje("Y-m-d");
                        $pt['datai']['tipo'] = '<=';
                        
                        $pt['dataf']['valor'] = hoje("Y-m-d");
                        $pt['dataf']['tipo'] = '>=';
			
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
			
                       $listaC = DB::listar("categoria",$pc,"order by nome");       
      
                       if($listaC){
                           
                                 foreach($listaC as $linhaC){
                                     
                                 
?>                                                           
                                                <option <?php if($o['id_categoria'] == $linhaC['id']) { ?>selected <?php } ?> value="<?= $linhaC['id'] ?>"><?= $linhaC['nome'] ?></option>
                                                <?php } } ?>
                                                
                                            </select>
                                        </div>
                                        
                                         <div class="form-group">
                                            <label>Situação</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="p[situacao]" id="optionsRadios1" value="PENDENTE" <?php if($o['situacao']=='PENDENTE') { ?> checked <?php } ?>>PENDENTE
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="p[situacao]" id="optionsRadios3" value="PAGO" <?php if($o['situacao']=='PAGO') { ?> checked <?php } ?>>PAGO
                                                </label>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <button type="reset" class="btn btn-primary">Limpar</button>
                                          <input type="hidden" name="objeto" value="inscricao" />
                                          <input type="hidden" name="acao" value="Salvar" />
                                          <input type="hidden" name="id" value="<?php echo $o['id']; ?>">                                          
                       <input type="hidden" name="pagina" value="cad_inscricao" />
                       
                                        
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
                            Inscrições Torneios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Torneio</th>                                            
                                            <th>Categoria</th>                                            
                                            <th>Atleta</th>                                            
                                            <th>Data Inscrição</th>                                            
                                            <th>Situação</th>
                                            <th>Alterar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
                        
                        //$p['id_atleta']['valor'] = $_SESSION['id_usuario'];
                        //$p['id_atleta']['tipo'] = '=';
			
                       $lista = @DB::listar("inscricao",$p,"order by data_hora");       
      
                       if($lista){
                           
                                 foreach($lista as $linha){
                                     
                                     $tt = DB::procurar("torneio", $linha['id_torneio']);
                                     $atle = DB::procurar("atleta", $linha['id_atleta']);
                                     $tipo = DB::procurar("etapa", $tt['id_etapa']);
                                     $cat = DB::procurar("categoria", $linha['id_categoria']);
?>                                        
                                        <tr class="gradeA">
                                            <td><?= $tt['nome']." - ".$tipo['nome'] ?></td>                                            
                                            <td><?= $cat['nome'] ?></td>
                                            <td><?= $atle['nome'] ?></td>
                                            <td><?= formataDataHora($linha['data_hora']) ?></td>
                                            <?php if($linha['situacao'] == 'PENDENTE'){ ?>
                                            <td><div class="alert alert-danger"><?= $linha['situacao'] ?></div></td>
                                            <?php } else {?>                                            
                                            <td><div class="alert alert-success alert-dismissable"><?= $linha['situacao'] ?></div></td>
                                            <?php } ?> 
                                            <td><a href="cad_inscricao.php?id=<?=$linha['id'];?>"><button type="button" class="btn btn-warning">Alterar</button></a></td>
                                            <td><a href="../controller/processaExcluir.php?id=<?=$linha['id'];?>&pag=cad_inscricao&obj=inscricao"><button type="button" class="btn btn-danger">Excluir</button></a></td>                                          
                                            
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