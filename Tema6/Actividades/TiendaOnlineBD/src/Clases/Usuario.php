<?php
class Usuario
{
    private string $username;
    private string $password;
    private string $role;

    public function __construct($username, $password, $role)
    {
        $this->username = $username;
        $this->password = $password;
        $this->role = $role;
    }

    public function getUsername()
    {
        return $this->username;
    }
    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function getPassword()
    {
        return $this->password;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getRole()
    {
        return $this->role;
    }
    public function setRole($role)
    {
        $this->role = $role;
    }
    public static function obtenerConexionBD()
    {
        $conexionBD = new mysqli("localhost", "root", "", "tiendaonline");
        if ($conexionBD->connect_error) {
            die("Error de conexión: " . $conexionBD->connect_error);
        }
        return $conexionBD;
    }
    public static function registrarUsuario($usuario)
    {
        $conexionBD = Usuario::obtenerConexionBD();

        //Se comprueba que no exista ese username.
        $verificarUsuario = $conexionBD->query("SELECT COUNT(*) FROM usuario WHERE username = '" . $usuario->getUsername() . "';");
        $registroUsuario = $verificarUsuario->fetch_assoc();
        $usernameExistente = $registroUsuario['COUNT(*)'];

        /*Si en la tabla usuario se encuentra el username en concreto se muestra un mensaje 
            y se cierra la conexión, en caso contrario se verifica la contraseña*/
        if ($usernameExistente > 0) {
            echo "<h2>El nombre de usuario ya está registrado. Por favor, elige otro.</h2>";

            $conexionBD->close();
        } else {
            //Se cifra la contraseña obtenida del usuario.
            $passwordHash = password_hash($usuario->getPassword(), PASSWORD_ARGON2I);

            //Se inserta una fila en la tabla usuario con los valores obtenidos de los getters del objeto.
            $resultado = $conexionBD->query("INSERT INTO usuario (username, password, role) VALUES ('" . $usuario->getUsername() . "', '$passwordHash', '" . $usuario->getRole() . "');");

            //Mostrar comprobación.
            if ($resultado == false) {
                echo "<h2>No se ha podido registrar el usuario en este momento, inténtalo de nuevo.</h2>";
            } else {
                echo "<h2>Te has registrado correctamente.</h2>";
            }

            //Cerrar la conexión.
            $conexionBD->close();
        }
    }
    public static function iniciarSesion($usuario)
    {
        $conexionBD = $conexionBD = Usuario::obtenerConexionBD();
        //Obtenemos la información del usuario
        $consultaUsuario = $conexionBD->query("SELECT username, password, role FROM usuario WHERE username = '" . $usuario->getUsername() . "';");

        if ($consultaUsuario == true) {
            $registroUsuario = $consultaUsuario->fetch_assoc();

            //Verificar la contraseña
            if (password_verify($usuario->getPassword(), $registroUsuario['password']) == true) {
                session_start();

                //Se crea el usuario en la sesión con el username y el role.
                $_SESSION['usuario'] = [
                    'username' => $registroUsuario['username'],
                    'role' => $registroUsuario['role']
                ];

                //Se cierra la conexión de la base de datos y se redirige al index.
                $conexionBD->close();

                header("Location: Index.php");
                die();
            } else {
                //Se cierra la conexión de la base de datos y muestra un mensaje de error.
                $conexionBD->close();
                echo "<h2 style='color: red;'>La contraseña no es correcta</h2>";
            }
        } else {
            //Se cierra la conexión de la base de datos y muestra un mensaje de error.
            $conexionBD->close();
            echo "<h2 style='color: red;'>No se ha podido encontrar el usuario</h2>";
        }
    }
}
