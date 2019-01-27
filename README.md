# Arduino-DB
Envio de datos de un microcontrolador Arduino a una Base de Datos

**Estos archivos son úicamente demostrativos, ten en cuenta que solo se limita a realizar la captura y alojamiento de datos, así como unas sencillas aplicaciones de consulta, pero eso no significa que tenga grandes limitaciones, espero que te sea de gran ayuda en tus futuros proyectos.**

El proyecto está compuesto por:

1. Una carpeta "arduino" contiene todos los archivos que son parte del sistema web.
   - La carpeta "control" contiene los archivos encargados de introducir datos.
   - La carpeta "grafico" contiene archivos demostrativos de la aplicación de un servidor web que son graficas que se actualizan cada 5 segundos, generación de archivos pdf y cvs.
   - La carpeta "resources" es un directorio que utiliza el cóigo encargado de generar las gráficas, estan compuestas por javascript, se recomienda no modificar esta carpeta.
2. Un cóigo Arduino encargado de capturar datos de diversos sensores e imprimirlos en un display y en el objeto asignado para trabajar nuestra conexión.
   - Ten mucha atención al momento de enviar la información al servidor, ya que depender・de este como reciba los datos.
   - El programa se limita a un uso local (por el momento).
3. Archivo sql para la creación de la tabla


## Recomendaciones
- Utilizar la paqueteria de desarrollo y/o software XAMPP, Sublime Text y Advanced IP Scanner.
- Instalar la paqueteria XAMPP en la dirección raiz del disco local (C:\).
- Parar el Servicio de publicación World Wide Web a traves del comando ejecutable services.msc y reiniciar el equipo.
- En las reglas de entrada y salida, habilitar conexiones publicas y privadas para Apache HTTP Server ubicada en la configuración avanzada del Firewall de Windows.
- Ejecutar el panel de control de XAMPP como administrador.
- Realizar la gestión de las bases de datos a través de un navegador web y la página phpmyadmin.
- Cada proyecto realizado debe contener su propia carpeta en el directorio "htdocs" de XAMPP.
- En caso de tener la intención de trabajar con una placa Raspberry Pi, se recomienda habilitar el puerto SSH y utilizar el software PuTTY, misma que nos permitir・realizar un control de la placa a través de una red.
- En caso de tener la intención de montar un servidor web en una placa Raspberry Pi, se recomienda visitar el siguiente [enlace](https://www.youtube.com/watch?v=19ZLM1C3sG0). Te redireccionara un video completo sobre el proceso de la instalación de un servidor LAMP, así como te enseñara a usar un cliente FTP.
https://www.youtube.com/watch?v=19ZLM1C3sG0

### Alternativas & Extras
- Paquetería WAMP Server.
- Servidores externos basados en la nube.
- Implementación de WebSockets.
- Servidor basado en javascript node.js o similares.
- Microsoft Azure y alternativas.
- Diversas placas capaces de trabajar con servidores web y diferentes sensores (Raspberry Pi, NodeMCU, "FPGA")
- Leguajes de programación capaces de trabajar con bases de datos, servidores, comunicación serial, etc. (Java, Python, C++)
- Software capaces de trabajar con bases de datos, servidores, comunicación serial, etc.(MATLAB, Maple, Simio, Processing, Software Siemens, Blender, Android, etc.)

*Agradezco a toda la comunidad que ha compartido la información sobre sus proyectos, que han ayudado en los proyectos de otros y que estén dispuestos a ayudar, sin ellos no serian posibles estos proyectos.*
