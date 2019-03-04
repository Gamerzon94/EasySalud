<?php
      function Conectarse()
      {
        $con = mysqli_connect('66.7.198.100','easys83_web','EasySalud2018.','easys83_easysalud');
		mysqli_set_charset($con,"utf8");
		return $con; 
      }
      
      function Desconectar(){
          mysqli_close($con);
      }
      
      function buscarRegion(){
          $con = Conectarse();
          $sql = 'select * from ET_REGION;';
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function mostrarProfesionales(){
          $con = Conectarse();
          $sql = "select * from ET_USUARIOS INNER JOIN ET_PROFESIONAL ON ET_USUARIOS.C_ID_USUARIO = ET_PROFESIONAL.C_ID_USUARIO WHERE ET_PROFESIONAL.L_ACTIVO = TRUE";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function disponibilidadProfesional($id){
          $con = Conectarse();
          $sql = "select * from ET_DISPONIBILIDAD where C_ID_USUARIO = '$id'";
          $result = mysqli_query($con,$sql);
          Desconectar();
          return $result;
      }
      
      function buscarComuna($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_COMUNA WHERE C_ID_REGION = '$id'";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function actualizarAtencion($estado,$id){
          $con = Conectarse();
          $sql = "UPDATE ET_SOLICITUD SET C_ID_ESTADO='$estado' WHERE C_ID_SOLICITUD='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarIdProfesional($id){
          $con = Conectarse();
          $sql = "select C_ID_PROFESIONAL from ET_PROFESIONAL where C_ID_USUARIO='$id'";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function buscarIdUsuario($id){
          $con = Conectarse();
          $sql = "select C_ID_USUARIO from ET_PROFESIONAL where C_ID_PROFESIONAL='$id'";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function premium($profesional,$plan,$id){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET L_PREMIUM=TRUE WHERE C_ID_PROFESIONAL='$profesional'";
          mysqli_query($con, $sql);
          date_default_timezone_set("Chile/Continental");
          $mes = date("m");  
            $dia = date("d");
            $ano = date("Y");
            $hoy2 = strtotime(date("Y-m-d"));  
            if($mes == 12){
                    $mes = 1;
            }else{
             $mes = $mes+1;
            }
            $vencimiento = $ano."-".$mes."-".$dia;
          $sql = "INSERT INTO ET_PAGOS (C_ID_USUARIO,C_ID_PLAN,F_FECHA_VENCIMIENTO) VALUES ('$id','$plan','$vencimiento');";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarAtencionesEspecifica($id){
          $con = Conectarse();
          $sql = "select * from ET_SOLICITUD INNER JOIN ET_USUARIOS on ET_USUARIOS.C_ID_USUARIO =  ET_SOLICITUD.C_ID_USUARIO INNER JOIN ET_ESTADO on ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA where ET_SOLICITUD.C_ID_SOLICITUD = '$id';";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarProfesionalesEspecifico($id){
          $con = Conectarse();
          $sql = "select * from ET_USUARIOS INNER JOIN ET_PROFESIONAL ON ET_USUARIOS.C_ID_USUARIO = ET_PROFESIONAL.C_ID_USUARIO WHERE ET_PROFESIONAL.C_ID_PROFESIONAL = '$id'";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function verActividad($id){
          $con = Conectarse();
          $sql = "select * from et_profesional where C_ID_USUARIO = '$id';";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function cambiarActividad($id,$estado){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET L_ACTIVO='$estado' WHERE C_ID_USUARIO='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarPerfil($id){
          $con = Conectarse();
          $sql = "select * from ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_USUARIOS.C_ID_TIPO_USUARIO = ET_TIPO_USUARIO.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION where C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function cargarComuna(){
          $con = Conectarse();
          $sql = "select *  from ET_COMUNA";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function modificarUsuario($id,$email,$cla,$com,$tel,$movil,$dir,$dep){
          $con = Conectarse();
          $sql = "UPDATE ET_USUARIOS SET D_EMAIL_USUARIO='$email',D_CLAVE_USUARIO='$cla',C_ID_COMUNA='$com',N_TELEFONO_USUARIO='$tel',N_MOVIL_USUARIO='$movil',D_DIRECCION_USUARIO='$dir',S_DEPTO_USARIO='$dep' WHERE C_ID_USUARIO='$id'";
          mysqli_query($con, $sql);
          echo mysqli_error($con);
          Desconectar();
      }
      
      function buscarEstudiosProfesional($id){
          $con = Conectarse();
          $sql = "select * from ET_ESTUDIOS_PROFESIONAL INNER JOIN ET_INSTITUCIONES ON ET_INSTITUCIONES.C_ID_INSTITUCIONES = ET_ESTUDIOS_PROFESIONAL.C_ID_INSTITUCIONES INNER JOIN ET_ESPECIALIDAD ON ET_ESPECIALIDAD.C_ID_ESPECIALIDAD = ET_ESTUDIOS_PROFESIONAL.C_ID_ESPECIALIDAD INNER JOIN ET_NIVEL_ESTUDIOS ON ET_ESTUDIOS_PROFESIONAL.C_ID_NIVEL_ESTUDIOS = ET_NIVEL_ESTUDIOS.C_ID_NIVEL_ESTUDIOS where ET_ESTUDIOS_PROFESIONAL.C_ID_PROFESIONAL = '$id' ORDER BY C_ID_ESTUDIOS_PROFESIONAL";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function buscarEquipamiento($id){
          $con = Conectarse();
          $sql = "select * from ET_EQUIPAMIENTO where C_ID_PROFESIONAL='$id'";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function crearUsuario($tip,$run,$nom,$ape,$email,$cla,$com,$tel,$movil,$dir,$dep,$nac,$sexo){
          $con = Conectarse();
          $sql = "INSERT INTO `ET_USUARIOS` (`C_ID_TIPO_USUARIO`, `C_ID_COMUNA`, `C_ID_ESTADO_CUENTA`, `S_RUN_USUARIO`, `D_NOMBRE_USUARIO`, `D_APELLIDO_USUARIO`, `D_EMAIL_USUARIO`, `N_TELEFONO_USUARIO`, `N_MOVIL_USUARIO`, `D_DIRECCION_USUARIO`, `S_DEPTO_USARIO`, `F_FECHA_NACIMIENTO`, `S_SEXO_USUARIO`, `D_CLAVE_USUARIO`, `D_CODIGO_USUARIO`) VALUES ('$tip', '$com', '1', '$run', '$nom', '$ape', '$email', '$tel', '$movil', '$dir', '$dep', '$nac', '$sexo', '$cla', '1234');";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function crearUsuarioConId($run,$nom,$ape,$email,$cla,$com,$tel,$movil,$dir,$dep,$nac,$cod,$genero,$tipoUsu){
          $con = Conectarse();
          $sql = "INSERT INTO ET_USUARIOS(C_ID_COMUNA,C_ID_ESTADO_CUENTA,S_RUN_USUARIO,D_NOMBRE_USUARIO,D_APELLIDO_USUARIO,D_EMAIL_USUARIO,N_TELEFONO_USUARIO,N_MOVIL_USUARIO,D_DIRECCION_USUARIO,D_CLAVE_USUARIO,F_FECHA_NACIMIENTO,D_CODIGO_USUARIO,S_DEPTO_USARIO,S_SEXO_USUARIO,C_ID_TIPO_USUARIO) VALUES ('$com','1','$run','$nom','$ape','$email','$tel','$movil','$dir','$cla','$nac','$cod','$dep','$genero','$tipoUsu')";
          mysqli_query($con, $sql);
          $result = mysqli_insert_id($con);
          Desconectar();
          return $result;
      }
      
      function crearAtencion($idUsuario,$idProfesional,$fecha,$desdeH,$desdeM,$comentarios,$idPaciente){
          $con = Conectarse();
          $sql = "INSERT INTO ET_SOLICITUD (C_ID_USUARIO,C_ID_PROFESIONAL,C_ID_ESTADO,F_FECHA_ATENCION,F_HORAS,F_MINUTOS,D_ANOTACIONES_SOLICITUD,C_PARA) VALUES ('$idUsuario','$idProfesional','1','$fecha','$desdeH','$desdeM','$comentarios','$idPaciente')";
          mysqli_query($con, $sql);
          echo sql;
          Desconectar();
      }
      
      function buscarUsuario($usuario,$clave){
          $con = Conectarse();
          $sql = "select * from ET_USUARIOS where D_EMAIL_USUARIO = '$usuario' and D_CLAVE_USUARIO = '$clave'";
          $result = mysqli_query($con, $sql); 
          Desconectar();
          return $result;
      }
      
      function buscarAtencionesCliente($id){
          $con = Conectarse();
          $sql = "select * from ET_SOLICITUD INNER JOIN ET_PROFESIONAL on ET_PROFESIONAL.C_ID_PROFESIONAL =  ET_PROFESIONAL.C_ID_PROFESIONAL INNER JOIN ET_USUARIOS on ET_USUARIOS.C_ID_USUARIO =  ET_PROFESIONAL.C_ID_USUARIO INNER JOIN ET_ESTADO on ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO where ET_SOLICITUD.C_ID_USUARIO = '$id';";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function buscarAtencionesProfesional($id){
          $con = Conectarse();
          $sql = "select * from ET_SOLICITUD INNER JOIN ET_USUARIOS on ET_USUARIOS.C_ID_USUARIO =  ET_SOLICITUD.C_ID_USUARIO INNER JOIN ET_ESTADO on ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO where ET_SOLICITUD.C_ID_PROFESIONAL = '$id';";
          $result = mysqli_query($con, $sql); 
          echo mysqli_error($con);
          Desconectar();
          return $result;
      }
      
      function eliminarEspecialidad($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_ESPECIALIDAD WHERE C_ID_ESPECIALIDAD = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarEspecialidadEspecifica($id){
          $con = Conectarse();
          $sql = "select * from ET_ESPECIALIDAD where C_ID_ESPECIALIDAD = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function eliminarFarmacia($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_SUCURSAL WHERE C_ID_FARMACIA = '$id'";
          $sql2 = "DELETE FROM ET_FARMACIA WHERE C_ID_FARMACIA = '$id'";
          mysqli_query($con, $sql);
          mysqli_query($con, $sql2);
          Desconectar();
      }
      
      function eliminarSucursal($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_SUCURSAL WHERE C_ID_SUCURSAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function eliminarUsuario($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_USUARIOS WHERE C_ID_USUARIO = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarUsuarioEspecifico($id){
          $con = Conectarse();
          $sql = "select * from ET_USUARIOS where C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarEspecialidades(){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_ESPECIALIDAD";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarFarmacias(){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_FARMACIA, ET_USUARIOS WHERE ET_USUARIOS.C_ID_USUARIO = ET_FARMACIA.C_ID_USUARIO";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function contarSucursales($id){
          $con = Conectarse();
          $sql = "select count(*) as sucursales from ET_SUCURSAL where C_ID_FARMACIA='$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }

    function contarProfesionalesPremium(){
          $con = Conectarse();
          $sql = "select count(*) as profesionales from ET_PROFESIONAL where L_PREMIUM='1'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarEstadosCuenta(){
          $con = Conectarse();
          $sql = "select * from ET_ESTADO_CUENTA";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function usuariosRegistrados(){
          $con = Conectarse();
          $sql= "SELECT count(*) as CANTIDAD FROM ET_USUARIOS";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function atencionesDia(){
          $con = Conectarse();
          $sql= "SELECT DATE(F_FECHA_REGISTRO) AS FECHA FROM ET_SOLICITUD;";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function modificarEspecialidad($id,$nom){
          $con = Conectarse();
          $sql = "UPDATE ET_ESPECIALIDAD SET D_ESPECIALIDAD = '$nom' WHERE C_ID_ESPECIALIDAD = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function modificarFarmacia($id,$nom,$web,$rep){
          $con = Conectarse();
          $sql = "UPDATE ET_FARMACIA SET C_ID_USUARIO='$rep',D_NOMBRE_FARMACIA='$nom',D_WEB_FARMACIA='$web' WHERE C_ID_FARMACIA='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function modificarFarmacia2($id,$nom,$web){
          $con = Conectarse();
          $sql = "UPDATE ET_FARMACIA SET D_NOMBRE_FARMACIA='$nom',D_WEB_FARMACIA='$web' WHERE C_ID_FARMACIA='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function tiposUsuario(){
          $con = Conectarse();
          $sql = "select * from ET_TIPO_USUARIO";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function buscarFarmaciaEspecifica($id){
          $con = Conectarse();
          $sql = "select * from ET_FARMACIA INNER JOIN ET_USUARIOS on ET_FARMACIA.C_ID_USUARIO = ET_USUARIOS.C_ID_USUARIO where ET_FARMACIA.C_ID_FARMACIA = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function modificarSucursal($id,$nom,$tel,$dir,$comuna){
          $con = Conectarse();
          $sql = "UPDATE ET_SUCURSAL SET D_NOMBRE_SUCURSAL='$nom',N_TELEFONO_SUCURSAL='$tel',D_DIRECCION_SUCURSAL='$dir',C_ID_COMUNA='$comuna' WHERE C_ID_SUCURSAL='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarSucursalEspecifica($id){
          $con = Conectarse();
          $sql = "select * from ET_SUCURSAL INNER JOIN ET_FARMACIA on ET_SUCURSAL.C_ID_FARMACIA = ET_FARMACIA.C_ID_FARMACIA INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_SUCURSAL.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION where ET_SUCURSAL.C_ID_SUCURSAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function nuevaEspecialidad($nom){
          $con = Conectarse();
          $sql = "INSERT INTO ET_ESPECIALIDAD (D_ESPECIALIDAD) VALUES ('$nom');";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function cargarRepresentantes(){
          $con = Conectarse();
          $sql = "select * from ET_USUARIOS WHERE C_ID_TIPO_USUARIO = '4'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function nuevaFarmacia($nom,$web,$rep){
          $con = Conectarse();
          $sql = "INSERT INTO ET_FARMACIA (C_ID_USUARIO,D_NOMBRE_FARMACIA,D_WEB_FARMACIA) VALUES ('$rep','$nom','$web');";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function nuevaSucursal($id,$nom,$tel,$dir,$comuna){
          $con = Conectarse();
          $sql = "INSERT INTO ET_SUCURSAL (C_ID_FARMACIA,D_NOMBRE_SUCURSAL,N_TELEFONO_SUCURSAL,D_DIRECCION_SUCURSAL,C_ID_COMUNA,L_ACTIVA) VALUES ('$id','$nom','$tel','$dir','$comuna',FALSE);";
          mysqli_query($con, $sql);
          $result = mysqli_insert_id($con);
          Desconectar();
          return $result;
      }
      
      function mostrarSucursalesFarmacia($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SUCURSAL INNER JOIN ET_FARMACIA ON ET_SUCURSAL.C_ID_FARMACIA = ET_FARMACIA.C_ID_FARMACIA INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_SUCURSAL.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION WHERE ET_FARMACIA.C_ID_FARMACIA = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarSucursalEspecifica($id){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_SUCURSAL INNER JOIN ET_FARMACIA ON ET_SUCURSAL.C_ID_FARMACIA = ET_FARMACIA.C_ID_FARMACIA INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_SUCURSAL.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION WHERE ET_SUCURSAL.C_ID_SUCURSAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuarios(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuariosConFiltro($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA WHERE ET_USUARIOS.C_ID_ESTADO_CUENTA = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuario($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA WHERE ET_USUARIOS.C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function buscarRegistroUsuario($id){
          $con = Conectarse();
          $sql = "SELECT F_FECHA_REGISTRO FROM ET_USUARIOS WHERE C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function verificarProfesional($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS WHERE C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          while ($row = mysqli_fetch_array($result)){
              if($row['C_ID_TIPO_USUARIO']=='3'){
                  return true;
              }else{
                  return false;
              }
          }
          return false;
      }
      
      function verificarProfesional2($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PROFESIONAL WHERE C_ID_PROFESIONAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          if(mysqli_fetch_array($result)){
                  return true;
          }
          return false;
      }
      
      function verificarRut($rut){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS WHERE S_RUN_USUARIO = '$rut'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          while ($row = mysqli_fetch_array($result)){
              if($row['S_RUN_USUARIO']==$rut){
                  return true;
              }else{
                  return false;
              }
          }
          return false;
      }
      
      function verificarEmail($email){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS WHERE D_EMAIL_USUARIO = '$email'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          while ($row = mysqli_fetch_array($result)){
              if($row['D_EMAIL_USUARIO']==$email){
                  return true;
              }else{
                  return false;
              }
          }
          return false;
      }
      
      function mostrarProfesional($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_ESTUDIOS_PROFESIONAL INNER JOIN ET_PROFESIONAL ON ET_ESTUDIOS_PROFESIONAL.C_ID_PROFESIONAL = ET_PROFESIONAL.C_ID_PROFESIONAL INNER JOIN ET_ESPECIALIDAD ON ET_ESPECIALIDAD.C_ID_ESPECIALIDAD = ET_ESTUDIOS_PROFESIONAL.C_ID_ESPECIALIDAD INNER JOIN ET_NIVEL_ESTUDIOS ON ET_NIVEL_ESTUDIOS.C_ID_NIVEL_ESTUDIOS = ET_ESTUDIOS_PROFESIONAL.C_ID_NIVEL_ESTUDIOS INNER JOIN ET_INSTITUCIONES ON ET_INSTITUCIONES.C_ID_INSTITUCIONES = ET_ESTUDIOS_PROFESIONAL.C_ID_INSTITUCIONES INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PROFESIONAL.C_ID_USUARIO WHERE ET_ESTUDIOS_PROFESIONAL.C_ID_PROFESIONAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarNivelEstudio(){
          $con = Conectarse();
          $sql = "select * from ET_NIVEL_ESTUDIOS";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarInstituciones(){
          $con = Conectarse();
          $sql = "select * from ET_INSTITUCIONES";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarEspecialidad(){
          $con = Conectarse();
          $sql = "select * from ET_ESPECIALIDAD";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function crearEstudio($id,$esp,$nivel,$insti,$titulo){
          $con = Conectarse();
          $sql = "INSERT INTO ET_ESTUDIOS_PROFESIONAL (C_ID_PROFESIONAL,C_ID_ESPECIALIDAD,C_ID_NIVEL_ESTUDIOS,C_ID_INSTITUCIONES,D_TITULO) VALUES ('$id','$esp','$nivel','$insti','$titulo')";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function actualizarProfesional($id,$esp,$nivel,$insti,$titulo){
          $con = Conectarse();
          $sql = "UPDATE ET_ESTUDIOS_PROFESIONAL SET C_ID_ESPECIALIDAD = '$esp', C_ID_NIVEL_ESTUDIOS='$nivel',C_ID_INSTITUCIONES='$insti',D_TITULO='$titulo' WHERE C_ID_USUARIO = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function actualizarCoordenadasSucursal($id,$latitud,$longitud){
          $con = Conectarse();
          $sql = "UPDATE ET_SUCURSAL SET N_LATITUD = '$latitud', N_LONGITUD='$longitud' WHERE C_ID_SUCURSAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarDisponibilidad($id){
          $con = Conectarse();
          $sql = "select * from ET_DISPONIBILIDAD INNER JOIN ET_PROFESIONAL ON ET_DISPONIBILIDAD.C_ID_PROFESIONAL = ET_PROFESIONAL.C_ID_PROFESIONAL INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_PROFESIONAL.C_ID_COMUNA where ET_PROFESIONAL.C_ID_PROFESIONAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function crearDisponibilidad($id,$lunes,$martes,$miercoles,$jueves,$viernes,$sabado,$domingo,$hdesde,$mdesde,$hhasta,$mhasta){
          $con = Conectarse();
          $sql = "INSERT INTO ET_DISPONIBILIDAD (C_ID_PROFESIONAL,L_LUNES,L_MARTES,L_MIERCOLES,L_JUEVES,L_VIERNES,L_SABADO,L_DOMINGO,F_HORAS_DESDE,F_MINUTOS_DESDE,F_HORAS_HASTA,F_MINUTOS_HASTA) VALUES ('$id','$lunes','$martes','$miercoles','$jueves','$viernes','$sabado','$domingo','$hdesde','$mdesde','$hhasta','$mhasta')";
          mysqli_query($con, $sql);
          Desconectar();
      }

      function crearEquipamientoConId($id,$equip){
          $con = Conectarse();
          $sql = "INSERT INTO ET_EQUIPAMIENTO (C_ID_PROFESIONAL,D_EQUIPO,D_IMAGEN) VALUES ('$id','$equip','0')";
          mysqli_query($con, $sql);
          $result = mysqli_insert_id($con);
          Desconectar();
          return $result;
      }
      
      function actualizarImagen($id,$imag){
          $con = Conectarse();
          $sql = "UPDATE ET_EQUIPAMIENTO SET D_IMAGEN = '$imag' WHERE C_ID_EQUIPAMIENTO = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function crearProfesional($id,$comuna,$dir,$desc){
          $con = Conectarse();
          $sql = "INSERT INTO ET_PROFESIONAL (C_ID_USUARIO,C_ID_COMUNA,L_ACTIVO,L_PREMIUM,D_DIRECCION_DISPONIBILIDAD,D_DESCRIPCION,D_IMAGEN) VALUES ('$id','$comuna',FALSE,FALSE,'$dir','$desc','0')";
          mysqli_query($con, $sql);
          $result = mysqli_insert_id($con);
          Desconectar();
          return $result;
      }
      
      function actualizarImagenProfesional($id,$imag){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET D_IMAGEN = '$imag' WHERE C_ID_PROFESIONAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function eliminarPerfil($id){
          $con = Conectarse();
          $sql = "UPDATE ET_USUARIOS SET C_ID_ESTADO_CUENTA = '4' WHERE C_ID_USUARIO = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function eliminarDisponibilidad($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_DISPONIBILIDAD WHERE C_ID_DISPONIBILIDAD = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function eliminarEstudio($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_ESTUDIOS_PROFESIONAL WHERE C_ID_ESTUDIOS_PROFESIONAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function eliminarEquipo($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_EQUIPAMIENTO WHERE C_ID_EQUIPAMIENTO = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function cargarPacientes($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PACIENTE INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_PACIENTE.C_ID_COMUNA WHERE C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function eliminarPaciente($id){
          $con = Conectarse();
          $sql = "DELETE FROM ET_PACIENTE WHERE C_ID_PACIENTE = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function crearPaciente($id,$comuna,$nombre,$apellido,$tel,$movil,$dir,$depto,$sexo){
          $con = Conectarse();
          $sql = "INSERT INTO ET_PACIENTE (C_ID_USUARIO,C_ID_COMUNA,D_NOMBRE_PACIENTE,D_APELLIDO_PACIENTE,N_TELEFONO_PACIENTE,N_MOVIL_PACIENTE,D_DIRECCION_PACIENTE,S_DEPTO_PACIENTE,S_SEXO_PACIENTE) VALUES ('$id','$comuna','$nombre','$apellido','$tel','$movil','$dir','$depto','$sexo')";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarPacienteEspefico($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PACIENTE INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_PACIENTE.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION WHERE C_ID_PACIENTE = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function modificarPaciente($id,$comuna,$tel,$movil,$dir,$depto){
          $con = Conectarse();
          $sql = "UPDATE ET_PACIENTE SET C_ID_COMUNA = '$comuna', N_TELEFONO_PACIENTE = '$tel', N_MOVIL_PACIENTE = '$movil', D_DIRECCION_PACIENTE = '$dir', S_DEPTO_PACIENTE = '$depto' WHERE C_ID_PACIENTE = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function buscarAtencionesPacientes($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SOLICITUD INNER JOIN ET_ESTADO ON ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO WHERE C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function buscarProfesional($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PROFESIONAL INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PROFESIONAL.C_ID_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA WHERE C_ID_PROFESIONAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function buscarPacientes($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PACIENTE WHERE C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function desactivarVisibilidad($id){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET L_ACTIVO = FALSE WHERE C_ID_PROFESIONAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function activarVisibilidad($id){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET L_ACTIVO = TRUE WHERE C_ID_PROFESIONAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function solicitudesTodas(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SOLICITUD INNER JOIN ET_ESTADO ON ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO";
          $result = mysqli_query($con, $sql);
          echo mysqli_error($con);
          Desconectar();
          return $result;
      }
      
      function solicitudesPendientes(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SOLICITUD INNER JOIN ET_ESTADO ON ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO WHERE ET_SOLICITUD.C_ID_ESTADO = '1' OR ET_SOLICITUD.C_ID_ESTADO = '2' OR ET_SOLICITUD.C_ID_ESTADO = '3'";
          $result = mysqli_query($con, $sql);
          echo mysqli_error($con);
          Desconectar();
          return $result;
      }
      
      function solicitudesRechazadas(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SOLICITUD INNER JOIN ET_ESTADO ON ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO WHERE ET_SOLICITUD.C_ID_ESTADO = '6'";
          $result = mysqli_query($con, $sql);
          echo mysqli_error($con);
          Desconectar();
          return $result;
      }
      
      function solicitudesFinalizadas(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SOLICITUD INNER JOIN ET_ESTADO ON ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO WHERE ET_SOLICITUD.C_ID_ESTADO = '4'";
          $result = mysqli_query($con, $sql);
          echo mysqli_error($con);
          Desconectar();
          return $result;
      }
      
      function solicitudesCanceladas(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SOLICITUD INNER JOIN ET_ESTADO ON ET_ESTADO.C_ID_ESTADO = ET_SOLICITUD.C_ID_ESTADO WHERE ET_SOLICITUD.C_ID_ESTADO = '5'";
          $result = mysqli_query($con, $sql);
          echo mysqli_error($con);
          Desconectar();
          return $result;
      }
      
      function buscarNombrePaciente($id){
          $con = Conectarse();
          $sql = "select * from ET_USUARIOS INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION where C_ID_USUARIO='$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function buscarNombreProfesional($id){
          $con = Conectarse();
          $sql = "select * from ET_PROFESIONAL inner join ET_USUARIOS on ET_PROFESIONAL.C_ID_USUARIO = ET_USUARIOS.C_ID_USUARIO where C_ID_PROFESIONAL='$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuariosPremium(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA INNER JOIN ET_PROFESIONAL ON ET_PROFESIONAL.C_ID_USUARIO = ET_USUARIOS.C_ID_USUARIO WHERE ET_PROFESIONAL.L_PREMIUM = TRUE";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuariosPendientesActivacion(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA WHERE ET_USUARIOS.C_ID_ESTADO_CUENTA = '1'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuariosActivos(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA WHERE ET_USUARIOS.C_ID_ESTADO_CUENTA = '2'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuariosSuspendidos(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA WHERE ET_USUARIOS.C_ID_ESTADO_CUENTA = '3'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function mostrarUsuariosPendienteEliminacion(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_TIPO_USUARIO ON ET_TIPO_USUARIO.C_ID_TIPO_USUARIO = ET_USUARIOS.C_ID_TIPO_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA WHERE ET_USUARIOS.C_ID_ESTADO_CUENTA = '4'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerPagos(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PAGOS INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PAGOS.C_ID_USUARIO INNER JOIN ET_PLANES ON ET_PLANES.C_ID_PLAN = ET_PAGOS.C_ID_PLAN";
          $result = mysqli_query($con, $sql);
          echo mysqli_error($con);
          Desconectar();
          return $result;
      }
      
      function obtenerPagosSucursal(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PAGOS_SUCURSAL INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PAGOS_SUCURSAL.C_ID_USUARIO INNER JOIN ET_PLANES ON ET_PLANES.C_ID_PLAN = ET_PAGOS_SUCURSAL.C_ID_PLAN";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerPagosSucursalEspecifica($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PAGOS_SUCURSAL INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PAGOS_SUCURSAL.C_ID_USUARIO INNER JOIN ET_PLANES ON ET_PLANES.C_ID_PLAN = ET_PAGOS_SUCURSAL.C_ID_PLAN WHERE C_ID_SUCURSAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerFechaPagosSucursalEspecifica($id){
          $con = Conectarse();
          $sql = "SELECT F_FECHA_REGISTRO FROM ET_PAGOS_SUCURSAL WHERE C_ID_SUCURSAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerProfesionales(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PROFESIONAL";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function actualizarPremium($id){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET L_PREMIUM = FALSE WHERE C_ID_PROFESIONAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function actualizarPremiumSucursal($id){
          $con = Conectarse();
          $sql = "UPDATE ET_SUCURSAL SET L_ACTIVA = FALSE WHERE C_ID_SUCURSAL = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function obtenerProfesionalesConNombre(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PROFESIONAL INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PROFESIONAL.C_ID_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerProfesionalesPremiumConNombre(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PROFESIONAL INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PROFESIONAL.C_ID_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA WHERE ET_PROFESIONAL.L_PREMIUM = TRUE";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerProfesionalesNoPremiumConNombre(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PROFESIONAL INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PROFESIONAL.C_ID_USUARIO INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA WHERE ET_PROFESIONAL.L_PREMIUM = FALSE";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerPlanes(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PLANES";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function guardarPlan($nom,$valor,$duracion,$duracionSel,$activo,$para){
          $con = Conectarse();
          $sql = "INSERT INTO ET_PLANES (D_NOMBRE_PLAN,C_VALOR,C_DURACION,L_TIPO,L_ACTIVO,S_TIPO_PLAN) VALUES ('$nom','$valor','$duracion','$duracionSel','$activo','$para')";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function obtenerPlanEspecifico($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PLANES WHERE C_ID_PLAN = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function actualizarPlan($id,$nom,$valor,$duracion,$duracionSel,$activo,$para){
          $con = Conectarse();
          $sql = "UPDATE ET_PLANES SET D_NOMBRE_PLAN = '$nom', C_VALOR = '$valor',C_DURACION = '$duracion',L_TIPO = '$duracionSel',L_ACTIVO = '$activo',S_TIPO_PLAN = '$para' WHERE C_ID_PLAN = '$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function obtenerPagos2(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PAGOS INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PAGOS.C_ID_USUARIO INNER JOIN ET_PLANES ON ET_PLANES.C_ID_PLAN = ET_PAGOS.C_ID_PLAN WHERE ET_USUARIOS.C_ID_TIPO_USUARIO = '3'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerPagos3(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PAGOS INNER JOIN ET_USUARIOS ON ET_USUARIOS.C_ID_USUARIO = ET_PAGOS.C_ID_USUARIO INNER JOIN ET_PLANES ON ET_PLANES.C_ID_PLAN = ET_PAGOS.C_ID_PLAN WHERE ET_USUARIOS.C_ID_TIPO_USUARIO = '4'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function activarUsuario($id,$email){
          $con = Conectarse();
          $sql = "UPDATE ET_USUARIOS SET C_ID_ESTADO_CUENTA = '2' WHERE D_CODIGO_USUARIO = '$id' AND C_ID_ESTADO_CUENTA='1' AND D_EMAIL_USUARIO = '$email'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function obtenerMensajes($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_MENSAJES WHERE C_ID_USUARIO_RECIBE = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerMensajesEnviados($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_MENSAJES WHERE C_ID_USUARIO_ENVIA = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerMensaje($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_MENSAJES WHERE C_ID_MENSAJE = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerDatosPersonas($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_USUARIOS.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION WHERE ET_USUARIOS.C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function nuevoMensaje($de,$para,$titulo,$mensaje){
          $con = Conectarse();
          $sql = "INSERT INTO ET_MENSAJES (C_ID_USUARIO_ENVIA,C_ID_USUARIO_RECIBE,D_TITULO_MENSAJE,D_MENSAJE) VALUES ('$de','$para','$titulo','$mensaje');";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function nuevoComentario($id,$puntaje,$comentario){
          $con = Conectarse();
          $sql = "INSERT INTO ET_PUNTUACION (C_ID_SOLICITUD,N_PUNTAJE,D_COMENTARIO,L_VISIBILIDAD) VALUES ('$id','$puntaje','$comentario','TRUE');";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function obtenerPuntcuacion($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PUNTUACION INNER JOIN ET_SOLICITUD ON ET_SOLICITUD.C_ID_SOLICITUD = ET_PUNTUACION.C_ID_SOLICITUD WHERE ET_SOLICITUD.C_ID_PROFESIONAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerPuntuacionEspecifica($id){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_PUNTUACION WHERE C_ID_SOLICITUD = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function recuperarClave($email){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS INNER JOIN ET_ESTADO_CUENTA ON ET_ESTADO_CUENTA.C_ID_ESTADO_CUENTA = ET_USUARIOS.C_ID_ESTADO_CUENTA WHERE D_EMAIL_USUARIO = '$email'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function verificarCodigo($email,$codigo){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_USUARIOS WHERE D_EMAIL_USUARIO = '$email' AND D_CODIGO_USUARIO='$codigo' AND C_ID_ESTADO_CUENTA='1'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarFarmacias($id){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_FARMACIA WHERE C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarPlanesFarmacia(){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_PLANES WHERE S_TIPO_PLAN = 'F'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarPlanEspecifico($id){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_PLANES WHERE C_ID_PLAN = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function premiumSucursal($idUsu,$plan,$id){
          $con = Conectarse();
          $sql = "UPDATE ET_SUCURSAL SET L_ACTIVA=TRUE WHERE C_ID_SUCURSAL='$id'";
          mysqli_query($con, $sql);
          date_default_timezone_set("Chile/Continental");
          $mes = date("m");  
            $dia = date("d");
            $ano = date("Y");
            $hoy2 = strtotime(date("Y-m-d"));  
            if($mes == 12){
                    $mes = 1;
            }else{
             $mes = $mes+1;
            }
            $vencimiento = $ano."-".$mes."-".$dia;
          $sql = "INSERT INTO ET_PAGOS_SUCURSAL (C_ID_USUARIO,C_ID_PLAN,C_ID_SUCURSAL,F_FECHA_VENCIMIENTO) VALUES ('$idUsu','$plan',$id,'$vencimiento');";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function obtenerRepresentantes(){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_USUARIOS WHERE C_ID_TIPO_USUARIO = '4'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerSucursalesRepresentante($id){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_SUCURSAL INNER JOIN ET_FARMACIA ON ET_FARMACIA.C_ID_FARMACIA = ET_SUCURSAL.C_ID_FARMACIA WHERE ET_FARMACIA.C_ID_USUARIO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function actualizarCoordenadas($id,$latitud,$longitud){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET N_LATITUD='$latitud', N_LONGITUD='$longitud' WHERE C_ID_PROFESIONAL='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function actualizarDireccionProfesional($id,$dir,$com){
          $con = Conectarse();
          $sql = "UPDATE ET_PROFESIONAL SET C_ID_COMUNA='$com', D_DIRECCION_DISPONIBILIDAD='$dir' WHERE C_ID_PROFESIONAL='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function actualizarEstadoUsuario($id,$estado){
          $con = Conectarse();
          $sql = "UPDATE ET_USUARIOS SET C_ID_ESTADO_CUENTA='$estado' WHERE C_ID_USUARIO='$id'";
          mysqli_query($con, $sql);
          Desconectar();
      }
      
      function obtenerDireccionProfesional($id){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_PROFESIONAL INNER JOIN ET_COMUNA ON ET_COMUNA.C_ID_COMUNA = ET_PROFESIONAL.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION WHERE ET_PROFESIONAL.C_ID_PROFESIONAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function obtenerFechaRegistroSucursal($id){
          $con = Conectarse();
          $sql = "SELECT F_FECHA_REGISTRO FROM ET_SUCURSAL WHERE C_ID_SUCURSAL = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function boletaSucursal($id){
          $con = Conectarse();
          $sql = "SELECT  * FROM ET_PAGOS_SUCURSAL WHERE C_ID_PAGO = '$id'";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function contarComunasSolicitudes(){
          $con = Conectarse();
          $sql = "SELECT COUNT(ET_USUARIOS.C_ID_COMUNA) AS TOTAL, ET_COMUNA.D_NOMBRE_COMUNA FROM ET_SOLICITUD INNER JOIN ET_USUARIOS ON ET_SOLICITUD.C_ID_USUARIO = ET_USUARIOS.C_ID_USUARIO INNER JOIN ET_COMUNA ON ET_USUARIOS.C_ID_COMUNA = ET_COMUNA.C_ID_COMUNA GROUP BY ET_USUARIOS.C_ID_COMUNA ORDER BY TOTAL DESC";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
      function cargarSucursalMarcador(){
          $con = Conectarse();
          $sql = "SELECT * FROM ET_SUCURSAL INNER JOIN ET_FARMACIA ON ET_SUCURSAL.C_ID_FARMACIA = ET_FARMACIA.C_ID_FARMACIA INNER JOIN ET_COMUNA ON ET_SUCURSAL.C_ID_COMUNA = ET_COMUNA.C_ID_COMUNA INNER JOIN ET_REGION ON ET_REGION.C_ID_REGION = ET_COMUNA.C_ID_REGION WHERE ET_SUCURSAL.L_ACTIVA = 1";
          $result = mysqli_query($con, $sql);
          Desconectar();
          return $result;
      }
      
?>
