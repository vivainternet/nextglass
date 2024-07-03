<?php
/* if (eregi("conexion.php", $_SERVER['PHP_SELF'])) { // si el nombre del archivo esta en la URL no lo deja acceder directamente
		die("You can't access this file... Sorry!<br><meta http-equiv=\"refresh\" content=\"0;URL=/\">");
} */

// namespace db; // No definido.

// Class
use mysqli;

// Se defina las Clases para que la puedan usar las funciones internas de los archivos inc_..._.php // Se escriben en PascalCase
class Database
{	// ATRIBUTOS
		protected $db_username 	= "mich";
		protected $db_password	= "*********";
		protected $db_name  		= "nextglass";
		protected $db_host			= "localhost";

		protected $conn;

		// CONSTRUCTOR
		public function __construct() {
			$this->getConnection();
		}

		// METODO getConnection() para obtener la conexion. Se escriben en camelCase
		public function getConnection()
		{
				// $this->conn = null; // Es el Constructor ???
				try {
						$this->conn = new mysqli($this->db_host, $this->db_username, $this->db_password, $this->db_name);

						// Verifica si la conexion tiene errores.
						if ($this->conn->connect_error) {
							throw new Exception("Connection failed: " . $this->conn->connect_error);
						}
				} catch (Exception $e) {
						echo "Error de conexión: " . $e->getMessage();
				}
				return $this->conn;
		}


	// METODO para cerrar la conexion.
	public function closeConnection()	{
			if ($this->conn) {
					$this->conn->close();
			}
	}
}

// El OBJETO es $db instanciado (creado) por la clase Database (la clase es como una plantilla)
$db 	= new Database(); 			// Class Database
$conn = $db->getConnection(); // Metodo getConnection()

// Debug Clases
/* if ($conn) {	echo "Conexion exitosa a la base de datos";
} else {	echo "Error al conectar a la base de datos"; } */

 // EJEMPLO SQL: funciona->cambiar nombre de tabla y campos
/* $sql = "SELECT * FROM [nombre de tabla] ";
$res = $conn->query($sql);
$row = $res->fetch_assoc();
$num = $res->num_rows;
echo '<br>'.$num;
// debug
echo "<br>".$sql."<br /><br />num: ".$num."<br />\$row[cambiar]: ".$row['cambiar_nombre_de_campo']."<br />";
 */

// Recuerda cerrar la conexion cuando termines.
// $db->closeConnection();
