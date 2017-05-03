<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<form id="formulario">
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td width="36"><img src="../../../Imagenes/historia.png" width="36" height="32"></td>
      <td width="608" class="titulo_form">Ficha Historia Medica de Pacientes </td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td class="head">Numero de Historia: </td>
      <td class="formulario"><input name="numero" type="text" class="textbox" id="numero" value="<?=$numero?>" disabled ></td>
      <td class="formulario"><span class="formulario"></span></td>
      <td class="head">Fecha:</td>
      <td class="formulario"><input name="fecha" type="text" class="textbox" id="fecha" value="<?=$fecha?>" disabled ></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td colspan="6" class="head">Datos Personales del Paciente </td>
    </tr>
    <tr>
      <td class="head">Cedula:</td>
      <td class="formulario"><input name="cedula" type="text" class="textbox" id="cedula" value="<?=$cedula?>" size="12" disabled ></td>
      <td class="formulario"></td>
      <td class="head">Nombre y Apellido: </td>
      <td class="formulario"><input name="nombre" type="text" class="textbox" id="nombre" value="<?=$nombre?>" size="50" disabled ></td>
      <td class="formulario"></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td class="head">Edad:</td>
      <td class="formulario"><input name="edad" type="text" class="textbox" id="edad" value="<?=$edad?>" size="10" disabled ></td>
      <td class="formulario"><span class="formulario"></span></td>
      <td class="head">Sexo:</td>
      <td class="formulario"><input name="sexo" type="text" id="sexo" size="10" value="<?=$sexo?>" disabled ></td>
      <td class="formulario"><span class="formulario"></span></td>
      <td class="head">Correo Electr&oacute;nico: </td>
      <td class="formulario"><input name="correo" type="text" class="textbox" id="correo" value="<?=$correo?>" disabled ></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td class="head">Telefono</td>
      <td class="formulario"><input name="telefono" type="text" class="textbox" id="telefono" value="<?=$telefono?>" size="15" disabled ></td>
      <td class="formulario"><span class="formulario"></span></td>
      <td class="head">Direccion:</td>
      <td class="formulario"><input name="direccion" type="text" class="textbox" id="direccion" value="<?=$direccion?>" size="50" disabled ></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Ubicacion Geografica del Domicilio</td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="ubicacion" class="textbox" id="ubicacion" disabled ><?=$ubicacion?></textarea></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Antecedentes del Paciente </td>
    </tr>
    <tr>
      <td colspan="2" class="head">Antecedentes Personales </td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="personales" class="textbox" id="personales" disabled ><?=$personales?></textarea></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Antecedentes Familiares </td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="familiares" class="textbox" id="familiares" disabled ><?=$familiares?></textarea></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td colspan="2" class="head">Habitos de Consumo </td>
    </tr>
    <tr>
      <td colspan="2" class="head">Tabaco</td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="tabaco" class="textbox" id="tabaco" disabled ><?=$tabaco?></textarea></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
    <tr>
      <td colspan="2" class="head">Alcohol</td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="alcohol" class="textbox" id="alcohol" disabled ><?=$alcohol?></textarea></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
    <tr>
      <td colspan="2" class="head">Ejercicio</td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="ejercicio" class="textbox" id="ejercicio" disabled ><?=$ejercicio?></textarea></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
    <tr>
      <td colspan="2" class="head">Alimentacion</td>
    </tr>
    <tr>
      <td class="formulario"><textarea name="alimentacion" class="textbox" id="alimentacion" disabled ><?=$alimentacion?></textarea></td>
      <td class="formulario"><span class="formulario"></span></td>
    </tr>
  </table>
  <table width="660" border="1" cellspacing="0">
    <tr>
      <td class="formulario"><div align="center">
	  <?php
	  echo "<img src=\"../../../Imagenes/examen.png\" width=\"33\" height=\"32\" style=\"cursor:pointer\"  onClick=\"consulta('$idhistoria')\">&nbsp;&nbsp;";
	  ?>
	  <img src="../../../Imagenes/AdobeReader.png" width="40" height="39">&nbsp;&nbsp;<img src="../../../Imagenes/close.png" width="24" height="24"   style="cursor:pointer"  onclick="cerrar()"></div></td>
    </tr>
  </table>
</form>
</html>