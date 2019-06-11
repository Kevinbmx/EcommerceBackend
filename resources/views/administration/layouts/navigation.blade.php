
<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="clear">
                            <span class="block m-t-xs">Trovare</strong>
                            </span> <span class="text-muted text-xs block">Administracion <b class="caret"></b></span>
                        </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs" >
                        <li><a href="#">Logout</a></li>
                        <li><a href="#">Logout1</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    TRV+
                </div>
            </li>
            <li class="">
                        <a href="{{ url('/admin/mainPage') }}"><i class="fas fa-home"></i> <span class="nav-label">Inicio</span> </a>
            </li>
            <li id="security">
                        <a href="#"><i class="fas fa-key"></i> <span class="nav-label">Seguridad</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" style="height: 0px;">
                            @can('users.index')
                                <li id="usuario"><a href="{{ url('admin/user') }}">Lista de Usuario</a></li>
                            @endcan
                            @can('rol.index')
                            <li>
                                <a href="#" id="damian">Roles <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse" style="height: 0px;">
                                    <li>
                                        <a href="{{ url('admin/role') }}">Lista de Roles</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/roleUser') }}">Rol a Usuario</a>
                                    </li>
                                    
                                </ul>
                            </li>
                            @endcan
                            @can('permission.index')
                            <li>
                                <a href="#" id="damian">Permiso <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse" style="height: 0px;">
                                    <li>
                                        <a href="{{ url('admin/permission') }}">Lista de Permisos</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('admin/permissionRol') }}">Permiso a rol</a>
                                    </li>
                                </ul>
                            </li>
                            @endcan
                        </ul>
            </li>
            <li id="Moduleinventario">
                        <a href="#"><i class="fas fa-list-alt"></i> <span class="nav-label">Modulo de Inventario</span> <span class="fa arrow"></span></a>
                        <ul  class="nav nav-second-level collapse" style="height: 0px;">
                            @can('stocktaking.index')
                            <li id="inventario">
                                <a href="#" id="damian">Inventario <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse" >
                                    {{-- @can('brand.index')
                                        <li id="marca">
                                            <a href="{{route('brand.index')}}">Lista de Marcas</a>
                                        </li>
                                    @endcan --}}
                                    @can('category.index')
                                        <li>
                                            <a href="#">Lista de categoria</a>
                                        </li>
                                    @endcan
                                    {{-- @can('color.index')
                                        <li>
                                            <a href="{{route('color.index')}}">Lista de Colores</a>
                                        </li>
                                    @endcan --}}
                                    @can('article.index')
                                        <li>
                                            <a href="#">Lista de Articulos</a>
                                        </li>
                                    @endcan
                                    @can('characteristic.index')
                                        <li>
                                            <a href="#">Lista de Detalles Tecnicos</a>
                                        </li>
                                    @endcan
                                    @can('excist.index')
                                        <li>
                                            <a href="#">Lista de existencias</a>
                                        </li>
                                    @endcan
                                    @can('imageProduct.index')
                                        <li>
                                            <a href="#">Imagen a Producto</a>
                                        </li>
                                    @endcan
                                    @can('offer.index')
                                        <li>
                                            <a href="#">Ofertanga</a>
                                        </li>
                                    @endcan
                                </ul>
                            </li>
                            @endcan
                            <li class="">
                                <a href="#" id="damian">Compra <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse" style="height: 0px;">
                                    <li>
                                        <a href="#">Lista de Proveeedores</a>
                                    </li>
                                    <li>
                                        <a href="#">Orden de compra</a>
                                    </li>
                                    <li>
                                        <a href="#">devoluciones</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="">
                                <a href="#" id="damian">Venta <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse" style="height: 0px;">
                                    <li>
                                        <a href="#">Lista de Venta</a>
                                    </li>
                                    <li>
                                        <a href="#">Orden de compra</a>
                                    </li>
                                    <li>
                                        <a href="#">Devoluciones</a>
                                    </li>

                                </ul>
                            </li>
                            <li class="">
                                <a href="#" id="damian">Pedidos <span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level collapse" style="height: 0px;">
                                    <li>
                                        <a href="#">Lista de Pedido</a>
                                    </li>
                                    <li>
                                        <a href="#">Pedido Asignados</a>
                                    </li>
                                </ul>
                            </li>
                            <li><a href="dashboard_2.html">Marketing Digital</a></li>
                            <li><a href="dashboard_3.html">Modulo</a></li>
                            <li><a href="dashboard_4_1.html">Asignar Acceso</a></li>
                        </ul>
            </li>
            <li class="">
                        <a href="#"><i class="fas fa-key"></i> <span class="nav-label">Marketing Digital</span> <span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level collapse" style="height: 0px;">
                            <li class="active"><a href="#">Lista de suscriptores</a></li>
                        </ul>
            </li>

           
        </ul>

    </div>
</nav>
