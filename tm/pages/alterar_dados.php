<?php include "topo.php"; ?>

<?php 

        
         if($_SESSION['id_usuario']){
            $o = DB::procurar("atleta", $_SESSION['id_usuario']);
         }
        
?>
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Alterar Dados</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            Meus Dados
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
                                            <input class="form-control" name="p[nome]" value="<?= $o['nome'] ?>" readonly />                                            
                                        </div>                                        
                                        <div class="form-group">
                                            <label>Telefone</label>
                                            <input class="form-control" name="p[telefone]" value="<?= $o['telefone'] ?>" required />                                            
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
                                             <?php if($_SESSION['perfil'] == 'ADMINISTRADOR') { ?>
                                            
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="p[perfil]" id="optionsRadios3" value="ADMINISTRADOR" <?php if($o['perfil']=='ADMINISTRADOR') { ?> checked <?php } ?>>ADMINISTRADOR
                                                </label>
                                            </div>
                                            
                                             <?php } ?>
                                            
                                            
                                        </div>
                                        
                                        
                                        <button type="submit" class="btn btn-success">Salvar</button>
                                        <button type="reset" class="btn btn-primary">Limpar</button>
                                          <input type="hidden" name="objeto" value="atleta" />
                                          <input type="hidden" name="acao" value="Salvar" />
                       <input type="hidden" name="pagina" value="alterar_dados" />
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
            
            
            
            
        </div>
        <!-- /#page-wrapper -->

<?php include "rodape.php"; ?>