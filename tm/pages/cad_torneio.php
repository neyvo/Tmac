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
                    <h2 class="page-header">Cadastro Torneio</h2>
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
                                            <label>Etapa</label>
                                            <select class="form-control" name="p[id_etapa]">
                                                
                                                 <?php		
	
                        $pt = "";	        
                        
                        $pt['excluido']['valor'] = 'N';
                        $pt['excluido']['tipo'] = '=';
			
                       $listaT = DB::listar("etapa",$pt,"order by nome");       
      
                       if($listaT){
                           
                                 foreach($listaT as $linhaT){                                                                      
?>                                                           
                                                <option <?php if($o['id_etapa'] == $linhaT['id']) { ?>selected <?php } ?> value="<?= $linhaT['id'] ?>"><?= $linhaT['nome'] ?></option>
                                                <?php } } ?>                                                
                                            </select>
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input class="form-control" name="p[nome]" value="<?= $o['nome'] ?>" required />                                            
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Descrição</label>
                                            <textarea class="form-control" name="p[descricao]" required><?= $o['descricao'] ?></textarea>                                         
                                        </div>  
                                        
                                        <div class="form-group">
                                            <label>Inicio Inscrição - (<?= formataData($o['datai']) ?>)</label>
                                            <input class="form-control" placeholder="Data Inicio" name="p[datai]" type="date" value="<?= formataData($o['datai']) ?>" >                                  
                                        </div>
                                        <div class="form-group">
                                            <label>Fim Inscrição - (<?= formataData($o['dataf']) ?>)</label>
                                            <input class="form-control" placeholder="Data Fim" name="p[dataf]" type="date" value="<?= formataData($o['dataf']) ?>" >                                  
                                        </div>
                                        
                                        
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <button type="reset" class="btn btn-primary">Limpar</button>
                                          <input type="hidden" name="objeto" value="torneio" />
                                          <input type="hidden" name="acao" value="Salvar" />
                       <input type="hidden" name="pagina" value="cad_torneio" />
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
                            Lista de Torneios
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>                                            
                                            <th>Nome</th>
                                            <th>Tipo</th>                                            
                                            <th>Descricao</th>
                                            <th>Alterar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
			
                       $lista = DB::listar("torneio",$p,"order by nome");       
      
                       if($lista){
                           
                                 foreach($lista as $linha){
                                     
                                     $tipo = DB::procurar("etapa", $linha['id_etapa'])
?>                                        
                                        <tr class="gradeA">
                                            <td><?= $linha['id'] ?></td>                                            
                                            <td><?= $linha['nome'] ?></td>
                                            <td><?= $tipo['nome'] ?></td>
                                            <td><?= $linha['descricao'] ?></td>
                                            <td><a href="cad_torneio.php?id=<?=$linha['id'];?>"><button type="button" class="btn btn-warning">Alterar</button></a></td>
                                            <td><a href="../controller/processaExcluir.php?id=<?=$linha['id'];?>&pag=cad_torneio&obj=torneio"><button type="button" class="btn btn-danger">Excluir</button></a></td>                                          
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