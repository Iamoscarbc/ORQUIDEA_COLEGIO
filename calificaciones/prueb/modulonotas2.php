
<!DOCTYPE html>
<html>
<head>
	<title>notas de alumnos</title>
	<link rel="stylesheet" href="tabla.css">
</head>
<body>
--
<table align="center" width="300"> 
	<fieldset>
<tr>

	<td align="center">
		Seleccione el curso :  
  <td> 
    <select name="cur"> 
     

      </select> 


      <!--segundo select 
      -->
      <br>
<br><br>
</fieldset>
<tr>

	<td align="center">
		Seleccione el grado :  
  <td> 
    <select name="grado"> 
     

      </select> 

<!-- dos formas de que bote los datos correctos
osea los cursos que esta registrado el profe

laprimera que al elegir en el conbo box 
salga una ventana que le pide que ingrese su clave
y usuario para que el sistema verifique qe el es el docente de eso curso si no verifica i la clave y usario en incorrecta no le permitira calificar i dira su clave es incorrecta elija su curso correcto
-->

<!-- la segunda forma es que el ingrese con su usuario y le muestre los cursos que esra registrados
-->


  </table>
  <br> 
   
   
   
<hr> 




<table align=center width=800 border="1" cellspacing="0"> 
<tr class="fila">
	<thead>

	<th>Codigoss
		<th>Apellido
			<th>Nombre
				<th>Nota 1
					<th>Nota 2
						<th>Nota 3
							<th>Nota 4
								<th>&nbsp; 
<th>Promedio
	<th>Condicion
		<th>&nbsp; 

 </thead>

     

<tr> 

	<td align="center"><?echo $vectoralu[$i]["codigo"]?> 

	<td align="center"><?echo $vectoralu[$i]["apellido"]?> 

	<td align="center"><?echo $vectoralu[$i]["nombre"]?> 

	<td align="center"><input type="text" size="5" class="texto1" name="t<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="n<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="k<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="r<?echo $i?>"> 


<td align="center"><input value="Calcular" type="button" onClick="promedio(<?echo $i?>);"> 




<td align="center"><input type="text" class="texto1" size="5" readonly name="p<?echo $i?>"> 
<td align="center"><input type="text" class="texto1" size="15" readonly name="c<?echo $i?>">
<!-- boton a 
<td align="center"><input type="button" value="Guardar" onClick="save(<?echo $i?>,'<?echo $vectoralu[$i]["codigo"]?>');"> 
</tr>

	<!--prueba de tablas

<tr> 

	<td align="center"><?echo $vectoralu[$i]["codigo"]?> 

	<td align="center"><?echo $vectoralu[$i]["apellido"]?> 

	<td align="center"><?echo $vectoralu[$i]["nombre"]?> 

	<td align="center"><input type="text" size="5" class="texto1" name="t<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="n<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="k<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="r<?echo $i?>"> 


<td align="center"><input value="Calcular" type="button" onClick="promedio(<?echo $i?>);"> 




<td align="center"><input type="text" class="texto1" size="5" readonly name="p<?echo $i?>"> 
<td align="center"><input type="text" class="texto1" size="15" readonly name="c<?echo $i?>"> 
<td align="center"><input type="button" value="Guardar" onClick="save(<?echo $i?>,'<?echo $vectoralu[$i]["codigo"]?>');"> 
</tr>



<tr> 

	<td align="center"><?echo $vectoralu[$i]["codigo"]?> 

	<td align="center"><?echo $vectoralu[$i]["apellido"]?> 

	<td align="center"><?echo $vectoralu[$i]["nombre"]?> 

	<td align="center"><input type="text" size="5" class="texto1" name="t<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="n<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="k<?echo $i?>"> 

	<td align="center"><input type="text" size="5" class="texto1" name="r<?echo $i?>"> 


<td align="center"><input value="Calcular" type="button" onClick="promedio(<?echo $i?>);"> 




<td align="center"><input type="text" class="texto1" size="5" readonly name="p<?echo $i?>"> 
<td align="center"><input type="text" class="texto1" size="15" readonly name="c<?echo $i?>"> 
</tr>

boton guardar 

<td align="center"><input type="button" value="
Guardar" onClick="save(<?echo $i?>,'<?echo $vectoralu[$i]["codigo"]?>');">
--> 


</table> 

	<br>
	<br>
	<br>
<!--el on click es el que ace la funcion de guardar
-->
<td align="center"><input value="Calcular" type="button" onClick="promedio(<?echo $i?>);"> 




</body>
</html>
