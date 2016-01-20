        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">TM - ADMIN</a>
            </div>
            <!-- /.navbar-header -->

            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        
                        
                          <?php if($_SESSION['id_usuario']) {?>
                        <li>
                            <a href="inicio.php"><i class="fa fa-dashboard fa-fw"></i> Painel</a>
                        </li>
                          <?php } ?>
                        <li>
                            <a href="index.php"><i class="fa fa-table fa-fw"></i> Ranking Acumulado</a>
                        </li>
                        
                        <li>
                            <a href="ranking_2016.php"><i class="fa fa-table fa-fw"></i> Ranking 2016</a>
                        </li>
                        <li>
                            <a href="ranking_2015.php"><i class="fa fa-table fa-fw"></i> Ranking 2015</a>
                        </li>
                        
                        <?php if($_SESSION['perfil'] == 'ADMINISTRADOR') { ?>
                         <li>
                             <a href="atualizar_pontos.php"><i class="fa fa-edit fa-fw"></i> Atualizar Pontos</a>
                        </li>
                        <li>
                            <a href="cad_atleta.php"><i class="fa fa-edit fa-fw"></i> Cadastrar Atleta</a>
                        </li>
                        <li>
                            <a href="cad_categoria.php"><i class="fa fa-edit fa-fw"></i> Cadastrar Categoria</a>
                        </li>
                        <li>
                            <a href="cad_torneio.php"><i class="fa fa-edit fa-fw"></i> Cadastrar Torneio</a>
                        </li>
                        <?php } ?>
                        
                        <?php if($_SESSION['id_usuario']) {?>
                        <li>
                            
                            <a href="alterar_dados.php"><i class="fa fa-edit fa-fw"></i> Alterar Dados</a>
                        </li>
                        <li>
                            
                            <a href="login.php"><i class="fa fa-edit fa-fw"></i> Sair</a>
                        </li>
                        <?php } else { ?>
                        <li>
                            <a href="login.php"><i class="fa fa-edit fa-fw"></i> Entrar</a>
                        </li>
                        <?php } ?>
                        
                        
                        
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



