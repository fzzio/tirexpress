    <!-- Navigation -->
    <nav class="navbar navbar-cdra navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo site_url('backend/index'); ?>">
                <img class="img-responsive obj-centrar img-logoadmin" src="<?php echo base_url('assets/tirexpress/img/logo_llantas.png'); ?>">
            </a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i>
                    <span class="capitalize">
                        <?php echo $this->session->name; ?>
                    </span>
                    <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li class="divider"></li>
                    <li>
                        <a href="<?php echo site_url('backend/logout'); ?>"><i class="fa fa-sign-out fa-fw"></i> Cerrar sesión</a>
                    </li>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <?php /*
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Buscar...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div><!-- /input-group -->
                    </li>
                    */ ?>
                    <li>
                        <a href="<?php echo site_url('backend/index'); ?>">
                            <i class="fa fa-dashboard fa-fw"></i> Inicio
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-fw fa-gear"></i> Mantenimientos<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo site_url('backend/categorias'); ?>">
                                    Categorias
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('backend/ciudades'); ?>">
                                    Ciudades
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('backend/clientes'); ?>">
                                    Clientes
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('backend/empresas'); ?>">
                                    Empresas
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('backend/productos'); ?>">
                                    Productos
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('backend/descuentos'); ?>">
                                    Descuentos
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('backend/zonas'); ?>">
                                    Zonas
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-wpforms"></i> Pedido<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo site_url('backend/pedidos'); ?>">
                                    Pedidos
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('backend/detalle_pedido'); ?>">
                                    Detalle pedido
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#">
                            <i class="fa fa-user"></i> Personal<span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="<?php echo site_url('backend/vendedores'); ?>">
                                    Vendedores
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>