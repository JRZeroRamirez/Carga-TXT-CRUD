Selecciona el fichero a importar:<br/>

<form enctype='multipart/form-data' action='' method='post' id="form-id-subir" >
   <table> 
    <td>
        <input size='50' type='file' name='filename'>
        <input type="hidden" name="subir" value="admin1">
    </td>
    <td>
        <button type="submit" class="button">Subir CSV / TXT </button>
    </td>
   </table>
</form>
<?php
         $servername = "localhost";
         $username = "root";
         $password = "";
         $database = "sample";
         $mysqli= new mysqli($servername,$username,$password,$database);
  
 //Carga el archivo
  
 if (isset($_POST['subir'])) {   
     error_reporting(E_ERROR);  
     if (is_uploaded_file($_FILES['filename']['tmp_name'])) {
         "<h1>" . "File ". $_FILES['filename']['name'] ." subido." . "</h1>";
         //echo "<h2>Datos subidos:</h2>";
         //readfile($_FILES['filename']['tmp_name']);
     }
  
     //Importa el archivo a la base de datos
     $handle = fopen($_FILES['filename']['tmp_name'], "r");
  
     while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
         
        if($data[0] == NULL || $data[3] == NULL){
            if($data[0] == NULL){
                echo '<script language="javascript">alert("Favor ingresar el correo del señor '.$data[1].' '.$data[2].' ");
                    window.location.href="index.php"</script>';
            }
            if($data[3] == NULL){
                echo '<script language="javascript">alert("Favor ingresar el código del señor '.$data[1].' '.$data[2].' ");
                    window.location.href="index.php"</script>';
            }
        }else{
           
                $mysqli->query("INSERT INTO datos (email,nombre,apellido,codigo)values('".$data[0]."','".$data[1]."','".$data[2]."','".$data[3]."')");
                
            
        }


    }
  
     fclose($handle);
     //Cierra la carga del archivo
 }
 ?>
<h4>Agregar Nuevo</h4>
<form action="" method="post">
<table>
    <tr>
        <td><input type="email" name="email" placeholder="Ingresar Email" required></td>
        <td><input type="text" name="nombre" placeholder="Ingresar Nombre" ></td>
    </tr>
    <tr>
        <td><input type="text" name="apellido" placeholder="Ingresar Apellido" ></td>
        <td><input type="number" min="1" name="codigo" placeholder="Ingresar Código" required></td>
    </tr>
    <tr>
        <td><button name="agregar" type="submit">Agregar</button></td>
    </tr>
</table>
</form>

 <table border="1">
 <thead>
 <tr>
 <td>#</td>
 <td style="text-align:center;">Email</td>
 <td style="text-align:center;">Nombre</td>
 <td style="text-align:center;">Apellido</td>
 <td style="text-align:center;">Código</td>
 <td style="text-align:center;">Editar</td>
 <td style="text-align:center;">Eliminar</td>
 </tr>
 </thead>
 <?php
 $consultaDatos=$mysqli->query("SELECT * FROM datos  ");
 ?>
 <tbody>
 <?php
 $conteo='0';
 while($extraerDatos=$consultaDatos->fetch_array()){
 ?>
 <tr>
 <td><?php echo $conteo++; ?></td>
 <form action="" method="post">
    <td><input style="border:0px;background:#C7C6CD;" name="email" type="email" value="<?php echo $extraerDatos['email']; ?>"></td>
    <td><input style="border:0px;background:#C7C6CD;" name="nombre" type="text" value=" <?php echo $extraerDatos['nombre']; ?>" ></td>
    <td><input style="border:0px;background:#C7C6CD;" name="apellido" type="text" value=" <?php echo $extraerDatos['apellido']; ?>" ></td>
    <td><input style="border:0px;background:#C7C6CD;" name="codigo" type="number" min="1" value="<?php echo $extraerDatos['codigo']; ?>" ></td>
    <td>
            <input name="id" type="hidden" readonly value="<?php echo $extraerDatos['id']; ?>">
            <button name="editar" type="submit">Editar</button>
    </td>
 </form>
 <td style="text-align:center;">
    <form action="" method="post">
        <input name="id" style="height:15px;visibility:hidden;" readonly value="<?php echo $extraerDatos['id']; ?>"><br>
        <button name="eliminar" type="submit">Eliminar</button>
    </form>
 </td>
 </tr>
 <?php
 }


 /// Agregar registro
 if(isset($_POST['agregar'])){
    $idEditar=$_POST['id'];
    $email=$_POST['email'];
    $nombre=$_POST['nombre'];
    $apellido=$_POST['apellido'];
    $codigo=$_POST['codigo'];

    $mysqli->query("INSERT INTO datos (email,nombre,apellido,codigo)VALUES('$email','$nombre','$apellido','$codigo') ");
    echo '<script language="javascript">alert("Registro Ingresado");
    window.location.href="index.php"</script>';
}
/// END
 /// Editar registro
 if(isset($_POST['editar'])){
     $idEditar=$_POST['id'];
     $email=$_POST['email'];
     $nombre=$_POST['nombre'];
     $apellido=$_POST['apellido'];
     $codigo=$_POST['codigo'];

     $mysqli->query("UPDATE datos SET email='$email',nombre='$nombre',apellido='$apellido',codigo='$codigo' WHERE id='$idEditar' ");
     echo '<script language="javascript">alert("Registro Actualizado");
     window.location.href="index.php"</script>';
 }
 /// END
  /// Eliminar registro
  if(isset($_POST['eliminar'])){
    $idEliminar=$_POST['id'];

    $mysqli->query("DELETE FROM datos WHERE id='$idEliminar' ");
    echo '<script language="javascript">alert("Registro Eliminado");
    window.location.href="index.php"</script>';
}
/// END
 ?>
 </tbody>
 </table>
