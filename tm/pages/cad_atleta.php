<?php include "topo.php"; ?>

<?php 

        if($_SESSION['perfil'] <> 'ADMINISTRADOR'){
            header("location: index.php");
        }

         if($_REQUEST['id']){
            $o = DB::procurar("atleta", $_REQUEST['id']);
         }
        
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Cadastro Atleta</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Dados do Atleta
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <form role="form" action="../controller/processaGeral.php" method="post" enctype="multipart/form-data">
                                        
                                         <?php  if($o['foto']) { ?>
                                            <img src="./fotos/<?= $o['foto'] ?>" width="150px" height="150px" />
                                        <?php } ?>
                                         <div class="form-group">
                                            <label>Foto</label>
                                            <input type="file" name="arquivo" id="foto" >
                                        </div>
                                        
                                        <div class="form-group">
                                            <label>Nome</label>
                                            <input class="form-control" name="p[nome]" value="<?= $o['nome'] ?>" required />                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Data de Nascimento - (<?= formataData($o['data_nascimento']) ?>)</label>
                                            <input class="form-control" placeholder="Data de Nascimento" name="p[data_nascimento]" type="date" value="<?= formataData($o['data_nascimento']) ?>" >                                  
                                        </div>
                                        <div class="form-group">
                                            <label>Telefone</label>
                                            <input class="form-control" name="p[telefone]" value="<?= $o['telefone'] ?>"  />                                            
                                        </div>  
                                        <div class="form-group">
                                            <label>E-mail</label>
                                            <input class="form-control" name="p[email]" value="<?= $o['email'] ?>" type="email" />                                            
                                        </div>
                                        <div class="form-group">
                                            <label>Senha</label>
                                            <input class="form-control" name="p[senha]" type="password" value="<?= $o['senha'] ?>" />
                                            
                                        </div>  
                                        
                                        <div class="form-group">
                                            <label>Perfil</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="p[perfil]" id="optionsRadios1" value="ATLETA" <?php if($o['perfil']=='ATLETA') { ?> checked <?php } ?>>ATLETA
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="p[perfil]" id="optionsRadios3" value="ADMINISTRADOR" <?php if($o['perfil']=='ADMINISTRADOR') { ?> checked <?php } ?>>ADMINISTRADOR
                                                </label>
                                            </div>
                                        </div>
                                        
                                        
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <button type="reset" class="btn btn-primary">Limpar</button>
                                          <input type="hidden" name="objeto" value="atleta" />
                                          <input type="hidden" name="acao" value="Salvar" />
                       <input type="hidden" name="pagina" value="cad_atleta" />
                       <input type="hidden" name="id" value="<?php echo $o['id']; ?>">
                       <input type="hidden" name="p[ativo]" value="S">
                                        
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
                            Lista de Atleta
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Codigo</th>
                                            <th>Nome</th>
                                            <th>Nascimento</th>
                                            <th>Telefone</th>
                                            <th>E-mail</th>
                                            <th>Perfil</th>
                                            <th>Alterar</th>
                                            <th>Excluir</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                        $p = "";	        
                        
                        $p['excluido']['valor'] = 'N';
                        $p['excluido']['tipo'] = '=';
			
                       $lista = DB::listar("atleta",$p,"order by nome");       
      
                       if($lista){
                           
                                 foreach($lista as $linha){
?>                                        
                                        <tr class="gradeA">
                                            <td><?= $linha['id'] ?></td>
                                            <td><?= $linha['nome'] ?></td>
                                            <td><?= formataData($linha['data_nascimento']) ?></td>
                                            <td><?= $linha['telefone'] ?></td>
                                            <td><?= $linha['email'] ?></td>
                                            <td><?= $linha['perfil'] ?></td>
                                            <td><a href="cad_atleta.php?id=<?=$linha['id'];?>"><button type="button" class="btn btn-warning">Alterar</button></a></td>
                                            <td><a href="../controller/processaExcluir.php?id=<?=$linha['id'];?>&pag=cad_atleta&obj=atleta"><button type="button" class="btn btn-danger">Excluir</button></a></td>                                          
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