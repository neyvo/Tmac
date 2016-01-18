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
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Procurar...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                            <!-- /input-group -->
                        </li>
                        <li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Painel</a>
                        </li>
                       
                        <li>
                            <a href="lista_atletas.php"><i class="fa fa-table fa-fw"></i> Atletas</a>
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
                        <li>
                            <a href="login.php"><i class="fa fa-edit fa-fw"></i> Sair</a>
                        </li>
                        
                       
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
            <!-- /.navbar-static-side -->
        </nav>



