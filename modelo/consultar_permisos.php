<?php
if(isset($_SESSION["id_user"])){
$consul1="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Cotizacion' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resul1=  mysqli_query($con,$consul1);
while($fila=  mysqli_fetch_array($resul1)){
$id_cot=$fila['id_user'];
$id_roles_cot=$fila['id_roles'];
$modulo_cot=$fila['modulo'];
$acceso_cot=$fila['acceso'];
$eliminar_cot=$fila['eliminar'];
$editar_cot=$fila['editar'];
$exportar_cot=$fila['exportar'];
$aprobar_cot=$fila['importar'];
$crear_cot=$fila['listar'];
$ver_cot=$fila['ver'];                       
}}
if(isset($_SESSION["id_user"])){
$consultaC="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Productos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultC=  mysqli_query($con,$consultaC);
while($fila=  mysqli_fetch_array($resultC)){
$id_pro=$fila['id_user'];
$id_roles_pro=$fila['id_roles'];
$modulo_pro=$fila['modulo'];
$acceso_pro=$fila['acceso'];
$eliminar_pro=$fila['eliminar'];
$editar_pro=$fila['editar'];
$exportar_pro=$fila['exportar'];
$aprobar_pro=$fila['importar'];
$crear_pro=$fila['listar'];
$ver_pro=$fila['ver'];
                          
 }}
if(isset($_SESSION["id_user"])){
$consultaR="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Contactos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultR=  mysqli_query($con,$consultaR);
while($fila=  mysqli_fetch_array($resultR)){
$id_mat=$fila['id_user'];
$id_roles_con=$fila['id_roles'];
$modulo_con=$fila['modulo'];
$acceso_con=$fila['acceso'];
$eliminar_con=$fila['eliminar'];
$editar_con=$fila['editar'];
$exportar_con=$fila['exportar'];
$importar_con=$fila['importar'];
$crear_con=$fila['listar'];
$ver_con=$fila['ver'];                       
 }}
if(isset($_SESSION["id_user"])){
$consultaN="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.area='CRM' and b.modulo='Empresas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultN=  mysqli_query($con,$consultaN);
while($fila=  mysqli_fetch_array($resultN)){
$id_pre=$fila['id_user'];
$id_roles_emp=$fila['id_roles'];
$modulo_emp=$fila['modulo'];
$acceso_emp=$fila['acceso'];
$eliminar_emp=$fila['eliminar'];
$editar_emp=$fila['editar'];
$exportar_emp=$fila['exportar'];
$importar_emp=$fila['importar'];
$crear_emp=$fila['listar'];
$ver_emp=$fila['ver'];
                           
 }}
if(isset($_SESSION["id_user"])){
$consultaL="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Estadisticas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultL=  mysqli_query($con,$consultaL);
while($fila=  mysqli_fetch_array($resultL)){
$id_est=$fila['id_user'];
$id_roles_est=$fila['id_roles'];
$modulo_est=$fila['modulo'];
$acceso_est=$fila['acceso'];
$eliminar_est=$fila['eliminar'];
$editar_est=$fila['editar'];
$exportar_est=$fila['exportar'];
$aprobar_est=$fila['importar'];
$crear_est=$fila['listar'];
$ver_est=$fila['ver'];
                          
 }}
if(isset($_SESSION["id_user"])){
$consultaR="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Materiales' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultR=  mysqli_query($con,$consultaR);
while($fila=  mysqli_fetch_array($resultR)){
$id_mat=$fila['id_user'];
$id_roles_mat=$fila['id_roles'];
$modulo_mat=$fila['modulo'];
$acceso_mat=$fila['acceso'];
$eliminar_mat=$fila['eliminar'];
$editar_mat=$fila['editar'];
$exportar_mat=$fila['exportar'];
$aprobar_mat=$fila['importar'];
$crear_mat=$fila['listar'];
$ver_mat=$fila['ver'];                        
}}
    if(isset($_SESSION["id_user"])){
$consultaN="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Configuracion' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultN=  mysqli_query($con,$consultaN);
while($fila=  mysqli_fetch_array($resultN)){
$id_conf=$fila['id_user'];
$id_roles_conf=$fila['id_roles'];
$modulo_conf=$fila['modulo'];
$acceso_conf=$fila['acceso'];
$eliminar_conf=$fila['eliminar'];
$editar_conf=$fila['editar'];
$exportar_conf=$fila['exportar'];
$aprobar_conf=$fila['importar'];
$crear_conf=$fila['listar'];
$ver_conf=$fila['ver'];
                           
 }}
     if(isset($_SESSION["id_user"])){
$consultaCAM="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Pedidos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultCAM=  mysqli_query($con,$consultaCAM);
while($fila=  mysqli_fetch_array($resultCAM)){
$id_ped=$fila['id_user'];
$id_roles_ped=$fila['id_roles'];
$modulo_ped=$fila['modulo'];
$acceso_ped=$fila['acceso'];
$eliminar_ped=$fila['eliminar'];
$editar_ped=$fila['editar'];
$exportar_ped=$fila['exportar'];
$aprobar_ped=$fila['importar'];
$crear_ped=$fila['listar'];
$ver_ped=$fila['ver'];
                          
 }}
     if(isset($_SESSION["id_user"])){
$consultaPR="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Orden de Produccion' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultPR=  mysqli_query($con,$consultaPR);
while($fila=  mysqli_fetch_array($resultPR)){
$id_op=$fila['id_user'];
$id_roles_op=$fila['id_roles'];
$modulo_op=$fila['modulo'];
$acceso_op=$fila['acceso'];
$eliminar_op=$fila['eliminar'];
$editar_op=$fila['editar'];
$exportar_op=$fila['exportar'];
$aprobar_op=$fila['importar'];
$crear_op=$fila['listar'];
$ver_op=$fila['ver'];
                         
 }}
     if(isset($_SESSION["id_user"])){
$consultaIN="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='OP Retenidas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultIN=  mysqli_query($con,$consultaIN);
while($fila=  mysqli_fetch_array($resultIN)){
$id_ret=$fila['id_user'];
$id_roles_ret=$fila['id_roles'];
$modulo_ret=$fila['modulo'];
$acceso_ret=$fila['acceso'];
$eliminar_ret=$fila['eliminar'];
$editar_ret=$fila['editar'];
$exportar_ret=$fila['exportar'];
$aprobar_ret=$fila['importar'];
$crear_ret=$fila['listar'];
$ver_ret=$fila['ver'];
                          
 }}
     if(isset($_SESSION["id_user"])){
$consultaCA="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='OP Remision' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultCA=  mysqli_query($con,$consultaCA);
while($fila=  mysqli_fetch_array($resultCA)){
$id_rem=$fila['id_user'];
$id_roles_rem=$fila['id_roles'];
$modulo_rem=$fila['modulo'];
$acceso_rem=$fila['acceso'];
$eliminar_rem=$fila['eliminar'];
$editar_rem=$fila['editar'];
$exportar_rem=$fila['exportar'];
$aprobar_rem=$fila['importar'];
$crear_rem=$fila['listar'];
$ver_rem=$fila['ver'];
                          
 }}
     if(isset($_SESSION["id_user"])){
$consultafle="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Fletes' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultfle=  mysqli_query($con,$consultafle);
while($fila=  mysqli_fetch_array($resultfle)){
$id_fle=$fila['id_user'];
$id_roles_fle=$fila['id_roles'];
$modulo_fle=$fila['modulo'];
$acceso_fle=$fila['acceso'];
$eliminar_fle=$fila['eliminar'];
$editar_fle=$fila['editar'];
$exportar_fle=$fila['exportar'];
$aprobar_fle=$fila['importar'];
$crear_fle=$fila['listar'];
$ver_fle=$fila['ver'];
                          
 }}
     if(isset($_SESSION["id_user"])){
$consultaveh="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Vehiculos' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resultveh=  mysqli_query($con,$consultaveh);
while($fila=  mysqli_fetch_array($resultveh)){
$id_veh=$fila['id_user'];
$id_roles_veh=$fila['id_roles'];
$modulo_veh=$fila['modulo'];
$acceso_veh=$fila['acceso'];
$eliminar_veh=$fila['eliminar'];
$editar_veh=$fila['editar'];
$exportar_veh=$fila['exportar'];
$aprobar_veh=$fila['importar'];
$crear_veh=$fila['listar'];
$ver_veh=$fila['ver'];
                          
 }}
      if(isset($_SESSION["id_user"])){
$consultahoj="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Hojas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resulthoj=  mysqli_query($con,$consultahoj);
while($fila=  mysqli_fetch_array($resulthoj)){
$id_hoj=$fila['id_user'];
$id_roles_hoj=$fila['id_roles'];
$modulo_hoj=$fila['modulo'];
$acceso_hoj=$fila['acceso'];
$eliminar_hoj=$fila['eliminar'];
$editar_hoj=$fila['editar'];
$exportar_hoj=$fila['exportar'];
$aprobar_hoj=$fila['importar'];
$crear_hoj=$fila['listar'];
$ver_hoj=$fila['ver'];
                          
 }}
if(isset($_SESSION["id_user"])){
$consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='trafico' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
$resulttra=  mysqli_query($con,$consultatra);
while($fila=  mysqli_fetch_array($resulttra)){
$id_tra=$fila['id_user'];
$id_roles_tra=$fila['id_roles'];
$modulo_tra=$fila['modulo'];
$acceso_tra=$fila['acceso'];
$eliminar_tra=$fila['eliminar'];
$editar_tra=$fila['editar'];
$exportar_tra=$fila['exportar'];
$aprobar_tra=$fila['importar'];
$crear_tra=$fila['listar'];
$ver_tra=$fila['ver'];
                          
 }}
 
if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Tareas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_tar=$fila['id_user'];
            $id_roles_tar=$fila['id_roles'];
            $modulo_tar=$fila['modulo'];
            $acceso_tar=$fila['acceso'];
            $eliminar_tar=$fila['eliminar'];
            $editar_tar=$fila['editar'];
            $exportar_tar=$fila['exportar'];
            $aprobar_tar=$fila['importar'];
            $crear_tar=$fila['listar'];
            $ver_tar=$fila['ver'];
        }
}

if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Llamadas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_lla=$fila['id_user'];
            $id_roles_lla=$fila['id_roles'];
            $modulo_lla=$fila['modulo'];
            $acceso_lla=$fila['acceso'];
            $eliminar_lla=$fila['eliminar'];
            $editar_lla=$fila['editar'];
            $exportar_lla=$fila['exportar'];
            $aprobar_lla=$fila['importar'];
            $crear_lla=$fila['listar'];
            $ver_lla=$fila['ver'];
        }
}

if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Reuniones' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_reu=$fila['id_user'];
            $id_roles_reu=$fila['id_roles'];
            $modulo_reu=$fila['modulo'];
            $acceso_reu=$fila['acceso'];
            $eliminar_reu=$fila['eliminar'];
            $editar_reu=$fila['editar'];
            $exportar_reu=$fila['exportar'];
            $aprobar_reu=$fila['importar'];
            $crear_reu=$fila['listar'];
            $ver_reu=$fila['ver'];
        }
}

if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Notas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_not=$fila['id_user'];
            $id_roles_not=$fila['id_roles'];
            $modulo_not=$fila['modulo'];
            $acceso_not=$fila['acceso'];
            $eliminar_not=$fila['eliminar'];
            $editar_not=$fila['editar'];
            $exportar_not=$fila['exportar'];
            $aprobar_not=$fila['importar'];
            $crear_not=$fila['listar'];
            $ver_not=$fila['ver'];
        }
}

if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Empresas' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_emp=$fila['id_user'];
            $id_roles_emp=$fila['id_roles'];
            $modulo_emp=$fila['modulo'];
            $acceso_emp=$fila['acceso'];
            $eliminar_emp=$fila['eliminar'];
            $editar_emp=$fila['editar'];
            $exportar_emp=$fila['exportar'];
            $aprobar_emp=$fila['importar'];
            $crear_emp=$fila['listar'];
            $ver_emp=$fila['ver'];
        }
}

if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Solicitudes' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_sol=$fila['id_user'];
            $id_roles_sol=$fila['id_roles'];
            $modulo_sol=$fila['modulo'];
            $acceso_sol=$fila['acceso'];
            $eliminar_sol=$fila['eliminar'];
            $editar_sol=$fila['editar'];
            $exportar_sol=$fila['exportar'];
            $aprobar_sol=$fila['importar'];
            $crear_sol=$fila['listar'];
            $ver_sol=$fila['ver'];
        }
}

if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Gestiones' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_ges=$fila['id_user'];
            $id_roles_ges=$fila['id_roles'];
            $modulo_ges=$fila['modulo'];
            $acceso_ges=$fila['acceso'];
            $eliminar_ges=$fila['eliminar'];
            $editar_ges=$fila['editar'];
            $exportar_ges=$fila['exportar'];
            $aprobar_ges=$fila['importar'];
            $crear_ges=$fila['listar'];
            $ver_ges=$fila['ver'];
        }
}

if(isset($_SESSION["id_user"])){
    $consultatra="SELECT a.id_user, a.id_roles, b.id_roles, b.modulo, b.acceso, b.eliminar, b.editar, b.exportar, b.importar, b.listar, b.ver FROM usuarios a, roles_accion b WHERE a.id_user=".$_SESSION["id_user"]." and b.modulo='Orden de Compra' and a.id_roles=b.id_roles group by b.id_roles, b.modulo";
    $resulttra=  mysqli_query($con,$consultatra);
        while($fila=  mysqli_fetch_array($resulttra)){
            $id_oc=$fila['id_user'];
            $id_roles_oc=$fila['id_roles'];
            $modulo_oc=$fila['modulo'];
            $acceso_oc=$fila['acceso'];
            $eliminar_oc=$fila['eliminar'];
            $editar_oc=$fila['editar'];
            $exportar_oc=$fila['exportar'];
            $aprobar_oc=$fila['importar'];
            $crear_oc=$fila['listar'];
            $ver_oc=$fila['ver'];
        }
}
?>