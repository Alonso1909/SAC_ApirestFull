Buenas profesor Leonel debido a que no puede trabajar con la base de datos en el servidor 85.187.158.121 debido a que me mandaba el siguiente error:

	No se puede establecer una conexión ya que el equipo
	de destino denegó expresamente dicha conexión in C:\xampp\htdocs\SAC_API-Rest	\modelos\conexion.php:8

Decidi trabaja de manera local exportando la base de datos "sac" e importandola en mi servidor local en una base de datos con el mismo nombre. Aun asi la instruccion de la conexion a la base de datos de servidor 85.187.158.121 esta presente en el archivo /modelos/conexion.php en forma de comentario.

Adjunto el archivo SQL de la tabla "organigrama" donde realiza las pruebas de las funciones de la apirest (registros:ID_ORGANIGRAMA 76,77,78).