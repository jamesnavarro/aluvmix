<script>
   function pass()
{
window.open('../vistas/form_contrasena.php', 'contacto', 'width=400,height=200');
} 
    </script>
<header id="header">
                <!-- START Logo -->
                <div class="logo hidden-phone hidden-tablet">
                     <img src="../imagenes/monti.png" style="width: 170px; height:50px;">
                </div>
                <!--/ END Logo -->
                <!-- START Mobile Sidebar Toggler -->
                <a href="#" class="toggler" data-toggle="sidebar"><span class="icon icone-reorder"></span></a>
                <!--/ END Mobile Sidebar Toggler -->

                <!-- START Toolbar -->
                <ul class="toolbar" id="toolbar">
                    <!-- START Profile -->
                    <li class="profile">
                        <a href="#" data-toggle="dropdown">
                            <span class="avatar"><img src="../img/avatar/avatar.png" alt=""></span>
                            <span class="text hidden-phone"><?php echo $_SESSION["nombre"] ?><span class="role"><?php echo $_SESSION["k_username"] ?></span></span>
                            <span class="arrow icone-caret-down"></span>
                        </a>
                        <!-- START Dropdown Menu -->
                        <div class="dropdown-menu" role="menu">
                            <header>
                                Mi Perfil 
                                <ul class="toolbar">
                                    <li><a href="../vistas/?id=user&cod=<?php  echo $_SESSION["id_user"] ?>" class="btn btn-small"><span class="icon icone-pencil"></span></a></li>
                                    <li><a href="lenguage:javascript()" onclick="pass();" class="btn btn-small"><span class="icon icone-cog"></span> Cambiar Contraseña</a></li>
                                </ul>
                            </header>
                           
                            <footer>
                                <a href="../salir.php" class="text"><span class="icon icone-off"></span>Salir</a>
                            </footer>
                        </div>
                        <!--/ END Dropdown Menu -->
                    </li>
                    <!--/ END Profile -->
                </ul>
                <!--/ END Toolbar -->
            </header>