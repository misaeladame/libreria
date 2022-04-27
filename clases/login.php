<?php 
    require_once "conexion.php";
    class Login { 
        public function verificaLogin($user,$pass){
            try
            {
                $pase=0;
                $sql = "SELECT * FROM users WHERE user = '$user'";
                $query=conectar::conexion()->prepare($sql); 
                $query->execute();
                $registro=$query->fetch(PDO::FETCH_ASSOC);

                $checkPass = password_verify($pass,$registro['password']);

                if($checkPass && $registro['isAdmin']==0 && $registro['isBorrado']==0)
                {
                    $pase++;                 
                } 
                else if($checkPass && $registro['isAdmin']==1 && $registro['isBorrado']==0)
                {
                    $pase++;   
                }
                

                if($pase>0 && $registro['isAdmin']==1)
                {
                    session_start();
                    $_SESSION["usuario"] = $registro;
                    echo "<div class= 'alert alert-success'>";
                    echo "<h2 align='center'>Bienvenido(a) Admin ".$_SESSION["usuario"]["name"]."</h2>";
                    echo "</div>";
                    header("refresh: 2; ../../vistas/admin/homeAdmin.php");
                }

                else if($pase>0 && $registro['isAdmin']==0)
                {
                    session_start();
                    $_SESSION["usuario"] = $registro;
                    echo "<div class= 'alert alert-success'>";
                    echo "<h2 align='center'>Bienvenido(a) ".$_SESSION["usuario"]['name']."</h2>";
                    echo "</div>";
                    header("refresh: 2; ../../vistas/usuario/homeEstandar.php");
                }

                else
                {
                    echo "<div class= 'alert alert-danger'>";
                    echo "<h2 align='center'>Usuario o Contraseña Incorrecto...</h2>";
                    echo "</div>";
                    header("refresh: 2; ../../vistas/login/loginUsuario.php");
                }
            }
            catch(PDOException $e)
            {
                echo $e->getMessage();
            }
        }

        public function cerrarSesion(){
            
            session_start();
            session_destroy();
            header("Location: loginUsuario.php");
        }
    }
?>