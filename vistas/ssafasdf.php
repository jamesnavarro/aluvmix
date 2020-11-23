<!-- PARTE ! fel codigo -->
<table width="100%" id="">
                           <tr bgcolor="#F2F2F2">
                               <th class="center">Codigo</th>
                               <th class="center">Descripcion</th>
                               <th class="center">Color</th>
                               <th class="center">Medida</th>
                               <th class="center">Cantidad</th>
                               <th class="center">Precio Uni</th>
                               <th class="center"></th>
                           </tr>
                            <tr bgcolor="#F2F2F2" id="hidden_add">
                               <td ><input type="text" id="coder" onclick="inv_mov_sald();"></td>
                               <td><input type="text" id="des" readonly></td>
                               <td><input type="text" id="col" readonly></td>
                               <td><input type="text" id="med" readonly></td>
                               <td><label><input type="text" id="can"></label></td>
                               <td><input type="text" id="pre" readonly></td>
                               <td><button onclick="descarga_ubica();"><b>Añadir</b></button></td>
                           </tr>
                          <tbody id="mostrar_movi_salida">
                          </tbody>
                       </table>

<!-- FIN DE LA PARTE DE C -->