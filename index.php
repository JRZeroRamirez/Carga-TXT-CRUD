<title>CRUD JR Jeisson Ramirez Bravo</title>



<link rel="stylesheet" href="css/estilo.css">

	
<header><h1>CRUD JR Jeisson ramirez B. </h1></header>


<form enctype='multipart/form-data' action='' method='post' id="form-id-subir" >
   <table class="archivo"> 
    <tr>

    <td>
        <label for="archivo">Selecciona el fichero a importar: </label>   
    </tr>
    <tr>
    <td>
        <input size='50' type='file' name='filename'>
        <input type="hidden" name="subir" value="admin1"> <th>
        <button type="submit" class="button">Subir CSV / TXT </button>
    </td>
    </tr>
   </table>
</form>

<!--conexion bd-->
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


<form action=""  method="post">
<table class="usuario">
    <tr>
    <td><label for="usuario">Agregar Nuevo usuario </label></td>
    </tr>
    <tr>
    <td><label for="email"> Correo: </label><br><input type="email" name="email" placeholder="Ingresar Email" required></td> 
    <td><label for="nombre"> Nombre: </label><br><input type="text" name="nombre" placeholder="Ingresar Nombre" ></td>   
   
    <td><label for="apellido"> Apellido: </label><br><input type="text" name="apellido" placeholder="Ingresar Apellido" ></td> 
    <td><label for="codigo"> Ingrese codigo: </label><br><input type="number" min="1" name="codigo" placeholder="Ingresar Código" required></td>
   </tr>
   <tr>
    <td><br><button name="agregar" type="submit">Agregar</button><br><br></td>
    </tr>  
</table>
</form>

<h4><br> USUARIOS <br><br></h4><br>

 <table border="1" class="datos"> <!--mostrar  tabla de datos guardados-->
 <thead>
 <tr>
 <td>#</td>
 <td>Email</td> 
 <td>Nombre</td>
 <td>Apellido</td>
 <td>Código</td>
 <td>Editar</td>
 <td>Eliminar</td>
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
 <form action="" method="post" class="datosM">
    <td><input  style="text-align:center;" name="email"    type="email"  value="<?php echo $extraerDatos['email']; ?>"></td>
    <td><input  style="text-align:center;" name="nombre"   type="text"   value=" <?php echo $extraerDatos['nombre']; ?>" ></td>
    <td><input  style="text-align:center;" name="apellido" type="text"   value=" <?php echo $extraerDatos['apellido']; ?>" ></td>
    <td><input  style="text-align:center;" name="codigo"   type="number" min="1" value="<?php echo $extraerDatos['codigo']; ?>" ></td>
    <td>            
            <button name="editar" type="submit" >Editar</button>
            <input name="id" type="hidden" readonly value="<?php echo $extraerDatos['id']; ?>"><br>
    </td>
 </form>
 <td >
    <form action="" method="post">    
        <input name="id" type="hidden" readonly value="<?php echo $extraerDatos['id']; ?>"><br> 
        <button name="eliminar" type="submit">Eliminar</button> 
        <br>
     
            
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
 </table><!--tabla de datos  guardados  fin-->
