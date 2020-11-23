<?php
include('../../../../../modelo/conexionv1.php');
if(isset($_GET['page'])){
                    $page = $_GET['page'];
            }else{
                    $page = 1;
            }
             $tipo = $_GET['tipo'];
              $sql1 = mysqli_query($con2,"SELECT * FROM orden_produccion  where opf='".$_GET['orden']."' and tipofom='".$_GET['tipoop']."'  ");
              $r = mysqli_fetch_array($sql1);
              $idcot = $r['ref'];
              $orden = $_GET['orden'];
              $id_orden = $r['id_orden'];
             $orden = str_pad($orden, 9, "0", STR_PAD_LEFT);
            $rad = $_GET['rad'];
            $nombre = $_GET['nombre'];
           echo '<input type="text" id="idcot"  value="'.$idcot.'" disabled style="width: 70px">';
            echo '<input type="text" id="idorden"  value="'.$id_orden.'" disabled style="width: 70px">'; 
                ?>
<table class="table table-bordered table-condensed table-hover">
                                <thead>
                                    <tr>
                                        <th>CODIGO</th>
                                        <TH>PRODUCTO <?php echo $tipo ?></TH>
                                        <TH>REF</TH>
                                        <TH>COSTO</TH>
                                        <TH>MED</TH>
                                        <TH>COLOR</TH>
           
                                        <TH>CANT.</TH>
                                        <TH>SALDO</TH>
                                        <TH>C.DESP</TH>
                                        <TH>STOCK</TH>
<!--                                        <TH>UBI</TH>-->
                                        <TH>OPC</TH>
               
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($rad==''){
                                        $disa = 'disabled';
                                    }  else {
                                        $disa = '';
                                    }
                         if($tipo=='Perfileria'){
                             $sql = mysqli_query($con2,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where concat(b.codigo,' ',b.descripcion) like '%".$nombre."%' and  a.linea='$tipo' and  a.codigo_pro=b.codigo and a.id_cot=".$idcot." and cantidad!=0 group by a.referencia, a.perfil order by b.sistema asc  ");
                         }else{
                             $sql=mysqli_query($con2,"SELECT *, a.medida, sum(a.medida*a.cantidad) as med, sum(a.cantidad) as can FROM desgloses_material a, referencias b where concat(b.codigo,' ',b.descripcion) like '%".$nombre."%' and a.linea='Accesorios' and  a.codigo_pro=b.codigo and a.id_cot=".$idcot." and cantidad!=0 group by a.codigo_pro order by a.referencia asc  ");
                         }
                        
			$item = 0;
                        $bod = '';
			if(mysqli_num_rows($sql)>0){
				while($mostrar = mysqli_fetch_array($sql)){
					$item = $item+1;
                                   if($mostrar['color']=='01'){
                                        $crudo = 'ANONIZADO';
                                        $codcolor = '01';
                                    }else{
                                        $crudo = 'CRUDO';
                                        $codcolor = '00';
                                    }
                                    $medres = mysqli_query($con2,"select sum(medida*cantidad) as med from desgloses_material where id_cot='".$idcot."' and referencia='".$mostrar['referencia']."' and perfil='".$mostrar['perfil']."' ");
                                    $md = mysqli_fetch_array($medres);
                 
                                    $medtotal = $md['med'];
                                    
                                    $ref = $mostrar['referencia'];
                                    if($tipo=='Perfileria'){
                                         $canper = $md['med']/($mostrar['perfil']-100);
                                   $codigo = $ref.'-'.$codcolor.substr($mostrar['perfil'],0,2);
                                    }else{
                                        $codigo = $mostrar['codigo'];
                                         $canper = $mostrar['can'];
                                    }
                                   $saldo = ceil($canper) - $mostrar['cantdespachada'];
					echo '<tr>
                                        <td><input type="text" id="cod'.$mostrar['id_desglose'].'" onchange="veri('.$mostrar['id_desglose'].')"  value="'.$codigo.'" style="width:80px"></td>'
                                        . '<td style="width: 200px"><input type="text" id="des'.$mostrar['id_desglose'].'" disabled value="'.$mostrar['descripcion'].'" style="width:100%"></td>'
                                        . '<td>'.$mostrar['referencia'].'</td>'
                                        . '<td><input type="text" id="pre'.$mostrar['id_desglose'].'"  value="'.$precio.'"  style="width:80px"></td>'
                                        . '<td><input type="text" id="med'.$mostrar['id_desglose'].'"  value="'.$mostrar['perfil'].'"  style="width:40px"></td>'
                                        . '<td><input type="text" id="col'.$mostrar['id_desglose'].'"  value="'.$mostrar['colores'].'"  style="width:80px"></td>'
                                        . '<td>'.ceil($canper).'</td>'
                                        . '<td><input type="text" id="pcant'.$mostrar['id_desglose'].'" disabled style="width: 40px" value="'.$saldo.'"></td>'
                                        . '<td><input type="text" id="ncant'.$mostrar['id_desglose'].'" onchange="veri('.$mostrar['id_desglose'].')" '.$disa.' style="width: 40px" value=""></td>'
                                        . '<td><input type="text" id="sto'.$mostrar['id_desglose'].'"  value="" disabled style="width: 70px">'
                                        . '<td><button id="'.$mostrar['id_desglose'].'" disabled  onclick="agregarproductos('.$mostrar['id_desglose'].')">Agregar</button></td>';
                                        
                                    }
                        }else{
				 echo '<tr><td colspan="9"></td><td style="text-align:center"  colspan="2"><button onclick="generar_desglose()">Desglose de Materiales</button></td></tr>';
			}
                                   
                                    ?>
                                </tbody>
                            </table>
                        
