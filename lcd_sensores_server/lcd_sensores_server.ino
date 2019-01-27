#include <Ethernet.h>//libreria ethernet
#include <SPI.h>//libreria ethernet
#include <SFE_BMP180.h>//libreria presion
#include <LiquidCrystal_I2C.h>//libreria display
#include <Wire.h>//libreria I2C
#include <DHT.h>//librería sensor
#define DHTPIN 2// Definimos el pin digital donde se conecta el sensor
#define DHTTYPE DHT11// Dependiendo del tipo de sensor

char status;//variable presion
double T,P,pre;//variable presion
int hum, temp;//constantes para humedad
int TRIG = 3;//envio del ulrasonico
int ECHO = 4;//recibo del ultrasonico
String estado;
long tiempo, dist;//variables para el sensor ultrasonico

// Configuracion del Ethernet Shield
byte mac[] = {0xDE, 0xAD, 0xBE, 0xEF, 0xFF, 0xEE}; // Direccion MAC
byte ip[] = { 192,168,1,109 }; // Direccion IP del Arduino
byte server[] = { 192,168,1,91 }; // Direccion IP del servidor192,168,0,14

SFE_BMP180 bmp180;//definimos objeto bmp180
LiquidCrystal_I2C lcd(0x27,16,2);//definimos objeto LiquidCrystal
DHT dht(DHTPIN, DHTTYPE);//Definimos objeto tipo dht
EthernetClient cliente;//objeto del ethernet

void setup() {
  Serial.begin(9600);//Inicializamos comunicación serie
  lcd.init();//iniciamos lcd
  lcd.backlight();//luz de fondo
  lcd.clear();//limpiar
  lcd.setCursor(0,0);
  lcd.print("Hola");
  lcd.setCursor(0,1);
  lcd.print("Iniciando...");
  delay(3000);

  Ethernet.begin(mac, ip); // Inicializamos el Ethernet Shield
  
  dht.begin();//Comenzamos el sensor DHT
  
  pinMode(TRIG, OUTPUT);//pin TRIG como salida
  pinMode(ECHO, INPUT);//pin ECHO como entrada
  
  //comprobamos el funcionamiento del bmp180
  if (bmp180.begin()){
    Serial.println("BMP180 iniciado correctamenten");
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("BMP180 iniciado");
    lcd.setCursor(0,1);
    lcd.print("correctamente");
    delay(3000);
  }
  else
  {
    Serial.println("Error al iniciar el BMP180");
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Error al iniciar");
    lcd.setCursor(0,1);
    lcd.print("el BMP180");
    while(1); // bucle infinito
  }
}

void loop() {
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Leyendo datos");
  lcd.setCursor(0,1);
  lcd.print("espere...");
  
  //codigo para la temperatura
  hum = dht.readHumidity();// Leemos la humedad relativa
  temp = dht.readTemperature();// Leemos la temperatura en grados centígrados (por defecto)
  if (isnan(hum) || isnan(temp)) {// Comprobamos si ha habido algún error en la lectura
    Serial.println("Error obteniendo los datos del sensor DHT11");
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Error obteniendo");
    lcd.setCursor(0,1);
    lcd.print("datos DHT11");
    delay(3000);
    return;
  }

  //codigo para el sensor ultrasonico
  digitalWrite(TRIG, 0);//estabilizamos el sensor asignando un valor 0
  delayMicroseconds(5);//esperamos a la estabilizacion
  digitalWrite(TRIG, HIGH);//envio del sonido
  tiempo=pulseIn(ECHO, HIGH);//conteo de microsegundos, cambia a LOW cunado recibe el valor
  tiempo=tiempo/2;//el tiempo es doble debido a que tiene que mandar y recibir
  dist=int(0.034*tiempo);//concatenacion a valor entero, despeje velocidad = 340m/s -> 0.034cm/microsegundo
  if(dist>0 && dist<=10)
  estado="cerca";
  else
  estado="lejos";
  
  //codigo para el sensor de presion
  status = bmp180.getTemperature(T); //Obtener la temperatura
  if (status != 0)
  {
    status = bmp180.startPressure(3); //Inicio lectura de presión
    if (status != 0)
    {        
      delay(status);//Pausa para que finalice la lectura        
      status = bmp180.getPressure(P,T); //Obtenemos la presión
      if (status != 0)
      {                  
        /*Serial.print("Temperatura: ");
        Serial.print(T,2);
        Serial.print(" *C , ");
        Serial.print("Presion: ");
        Serial.print(P,2);
        Serial.println(" mb"); */         
      }      
    }      
  }
  
  Serial.print("Presion ");
  Serial.print(P,2);
  Serial.print(" mb Humedad: ");
  Serial.print(hum);
  Serial.print(" % Temperatura: ");
  Serial.print(temp);
  Serial.print(" ºC Distancia: ");
  Serial.print(dist);
  Serial.println(" cm");
  Serial.print(estado);
  
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Pre.:");
  lcd.print(P,2);
  lcd.print("mb");
  lcd.setCursor(0,1);
  lcd.print("Hum.:");
  lcd.print(hum);
  lcd.print("%");
  delay(2000);

  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Temp.:");
  lcd.print(temp);
  lcd.print("C");
  lcd.setCursor(0,1);
  lcd.print("Dist.:");
  lcd.print(dist);
  lcd.print("cm ");
  lcd.print(estado);
  delay(2000);

  // Proceso de envio de muestras al servidor
  Serial.println("Envio de dato, conectando...");
  lcd.clear();
  lcd.setCursor(0,0);
  lcd.print("Envio de datos");
  lcd.setCursor(0,0);
  lcd.print("Conectando...");
  if (cliente.connect(server, 80)>0) {  // Conexion con el servidor(client.connect(server, 80)>0
    cliente.print("GET /arduino/control/conexion_arduino.php?pre_php="); // Enviamos los datos por GET
    cliente.print(P,2);
    cliente.print("&hum_php=");
    cliente.print(hum);
    cliente.print("&temp_php=");
    cliente.print(temp);
    cliente.print("&dist_php=");
    cliente.print(estado);
    cliente.println(" HTTP/1.0");
    cliente.println("User-Agent: Arduino 1.0");
    cliente.println();
    Serial.println("Envio con exito (al archivo controller/index y models/herramienta)");
    lcd.clear();
    lcd.setCursor(0,1);
    lcd.print("Envio con exito");
    delay(1000);
  } else {
    Serial.println("Fallo en la conexion");
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Fallo en la");
    lcd.setCursor(0,1);
    lcd.print("conexion");
    delay(2000);
  }
  if (!cliente.connected()) {
    Serial.println("Desconectando");
    lcd.clear();
    lcd.setCursor(0,0);
    lcd.print("Desconectando");
    delay(1000);
  }
  cliente.stop();
  cliente.flush();
  
  //delay(5000); // Espero un minuto antes de tomar otra muestra
}
