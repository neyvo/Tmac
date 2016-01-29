<?php include "topo_index.php"; ?>


<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h2 class="page-header">Ranking Acumulado</h2>
                </div>
                <!-- /.col-lg-12 -->
            </div>
        <!-- Pontuação acumulada ADULTO -->
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel  <?php if(fmod(2015,2)==1){ echo 'panel-primary';} else { echo 'panel-green'; }?> ">
                        <div class="panel-heading">
                            Adulto - Absoluto 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover" >
                                    <thead>
                                        <tr>                                         
                                            
                                            <th>Categoria</th>
                                            <th>Atleta</th>
                                            <th>Pontos</th>                                                                               
                                            <th>Classificação</th>                                                                               
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                       
                        
                        $SQL = "select id_atleta, id_categoria, sum(pontos) total  from atleta_categoria WHERE excluido = 'N' AND id_categoria = '1' group by id_atleta, id_categoria  order by total desc";
			
                       $listaA = DB::listarSQL($SQL);       
      
                       if($listaA){
                           
                           $j = 1;
                                 foreach($listaA as $linhaA){
                                     
                                     $atleta = DB::procurar("atleta", $linhaA['id_atleta']);
                                     $categoria = DB::procurar("categoria", $linhaA['id_categoria']);
                                     
                                    
?>                                      
                                        <tr class="gradeA">
                                           
                                           
                                            <td><?= $categoria['nome'] ?></td>
                                            <td><?= $atleta['nome'] ?></td>
                                            <td><?= $linhaA['total'] ?></td>                                                                                                                                 
                                            <td><?= $j ?></td>                                                                                                                                 
                                        </tr>                                        
                                 <?php  $j++; }
                       
                       
                       
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
            
    
                <!-- Pontuação acumulada VETERANO -->
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel  <?php if(fmod(2015,2)==1){ echo 'panel-primary';} else { echo 'panel-green'; }?> ">
                        <div class="panel-heading">
                            Veterano 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover " >
                                    <thead>
                                        <tr>                                         
                                            
                                            <th>Categoria</th>
                                            <th>Atleta</th>
                                            <th>Pontos</th>                                                                               
                                            <th>Classificação</th>                                                                               
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                       
                        
                        $SQL = "select id_atleta, id_categoria, sum(pontos) total  from atleta_categoria WHERE excluido = 'N' AND id_categoria = '2' group by id_atleta, id_categoria  order by total desc";
			
                       $listaA = DB::listarSQL($SQL);       
      
                       if($listaA){
                           
                           $j = 1;
                                 foreach($listaA as $linhaA){
                                     
                                     $atleta = DB::procurar("atleta", $linhaA['id_atleta']);
                                     $categoria = DB::procurar("categoria", $linhaA['id_categoria']);
                                     
                                    
?>                                      
                                        <tr class="gradeA">
                                           
                                           
                                            <td><?= $categoria['nome'] ?></td>
                                            <td><?= $atleta['nome'] ?></td>
                                            <td><?= $linhaA['total'] ?></td>                                                                                                                                 
                                            <td><?= $j ?></td>                                                                                                                                 
                                        </tr>                                        
                                 <?php  $j++; }
                       
                       
                       
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
            

    <!-- Pontuação acumulada geral -->
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel  <?php if(fmod(2015,2)==1){ echo 'panel-primary';} else { echo 'panel-green'; }?> ">
                        <div class="panel-heading">
                           Infantil - Juvenil - Masculino
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover " >
                                    <thead>
                                        <tr>                                         
                                            
                                            <th>Categoria</th>
                                            <th>Atleta</th>
                                            <th>Pontos</th>                                                                               
                                            <th>Classificação</th>                                                                               
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                       
                        
                        $SQL = "select id_atleta, id_categoria, sum(pontos) total  from atleta_categoria WHERE excluido = 'N' AND id_categoria = '10' group by id_atleta, id_categoria  order by total desc";
			
                       $listaA = DB::listarSQL($SQL);       
      
                       if($listaA){
                           
                           $j = 1;
                                 foreach($listaA as $linhaA){
                                     
                                     $atleta = DB::procurar("atleta", $linhaA['id_atleta']);
                                     $categoria = DB::procurar("categoria", $linhaA['id_categoria']);
                                     
                                    
?>                                      
                                        <tr class="gradeA">
                                           
                                           
                                            <td><?= $categoria['nome'] ?></td>
                                            <td><?= $atleta['nome'] ?></td>
                                            <td><?= $linhaA['total'] ?></td>                                                                                                                                 
                                            <td><?= $j ?></td>                                                                                                                                 
                                        </tr>                                        
                                 <?php  $j++; }
                       
                       
                       
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
            
        <!-- Pontuação acumulada geral -->
            
            
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel  <?php if(fmod(2015,2)==1){ echo 'panel-primary';} else { echo 'panel-green'; }?> ">
                        <div class="panel-heading">
                           Infantil - Juvenil - Feminino
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="dataTable_wrapper table-responsive">
                                <table class="table table-striped table-bordered table-hover " >
                                    <thead>
                                        <tr>                                         
                                            
                                            <th>Categoria</th>
                                            <th>Atleta</th>
                                            <th>Pontos</th>                                                                               
                                            <th>Classificação</th>                                                                               
                                            
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        
                <?php		
	
                       
                        
                        $SQL = "select id_atleta, id_categoria, sum(pontos) total  from atleta_categoria WHERE excluido = 'N' and id_categoria = '11' group by id_atleta, id_categoria  order by total desc";
			
                       $listaA = DB::listarSQL($SQL);       
      
                       if($listaA){
                           
                           $j = 1;
                                 foreach($listaA as $linhaA){
                                     
                                     $atleta = DB::procurar("atleta", $linhaA['id_atleta']);
                                     $categoria = DB::procurar("categoria", $linhaA['id_categoria']);
                                     
                                    
?>                                      
                                        <tr class="gradeA">
                                           
                                           
                                            <td><?= $categoria['nome'] ?></td>
                                            <td><?= $atleta['nome'] ?></td>
                                            <td><?= $linhaA['total'] ?></td>                                                                                                                                 
                                            <td><?= $j ?></td>                                                                                                                                 
                                        </tr>                                        
                                 <?php  $j++; }
                       
                       
                       
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
            

            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-green">
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
                                     $torneio = DB::procurar("etapa", $linha['id_torneio']);
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