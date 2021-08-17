# api-empleados
api empleados prueba técnica php

<h1> Prueba Técnica de php</h1>
Para instalar el proyecto de forma local y funcione los diferentes endpoint, me instalé wampserver, y en la carpeta www, copié el proyecto. 
Después habilité los modulos para los host virtual y el rewrite_module, y creé un virtual host en el directorio C:\wamp\bin\apache\apache2.4.9\conf\extra en el fichero httpd-vhosts.conf
puse este virtual host 

```
<VirtualHost *:80>
    ServerAdmin webmaster@dummy-host2.example.com
    DocumentRoot "C:\wamp\www\api-empleados\src\web"
    ServerName api-empleados.com
    ServerAlias api-empleados.com
    ErrorLog "logs/api.empleados.com-error.log"
    CustomLog "logs/api.empleados.com-access.log" common
    <Directory "/">
        Options Indexes FollowSymLinks		
	AllowOverride All
	Order Deny,Allow
	Deny from all
	Allow from all	
    </Directory>
</VirtualHost>
```
y en host de system32 creé este

```
127.0.0.1		api-empleados.com
```

<p align="left" >
Para cualquier cosa que me puedan decir en relación a la prueba técnica, me pueden enviar un mensaje a mi linkedin 
  <a  href="https://www.linkedin.com/in/jhonatanruiz97">
  <img src="https://www.vectorlogo.zone/logos/linkedin/linkedin-icon.svg" alt="Jhonatan Ruiz" height="30" width="30">
  </a> 
</p>

<h1> Aplicación en vivo <a href = "https://api-empleados-php.jruizweb.es" > Api-Empleado </a> </h1>
Los endpoints del API son diferentes a los entregados, ya que se hizo de forma local con el nombre del virtual host diferentes al dominio de mi hosting. 
Estos son los diferentes endpoint 
No es un API REST FULL, ya que se usan parametros, y se llaman a recursos web, (web services) que devuelven un json. 

1. Obtención del perfil de un empleado con el departamento, cargo y salario actuales de un empleado con este endpoint a través de una petición get y con el id del empleado (idEmployee) <a href="https://api-empleados-php.jruizweb.es/api/getListEmployeesById?idEmployee=10014"> Perfil </a>

```
https://api-empleados-php.jruizweb.es/api/getListEmployeesById?idEmployee=10014
```
2. Mostrar Listado de empleados con el departamento, cargo y salario actuales. Ordenado por fecha de contratación y limitado a 50. Atraves de este endpoint con una petición get < a href="https://api-empleados-php.jruizweb.es/api/getListEmployees"> Listado</a>

```
https://api-empleados-php.jruizweb.es/api/getListEmployees
```
3. Inserción de un empleado con los siguientes parámetros:
first_name , last_name , birth_name , gender , dept_no , title , salary
Con una petición post añadiente los siguientes datos en el body en la petición 
```

{
    "firstName": "Pepe",
    "lastName": "Sanchez",
    "birthName": "2021-10-01",
    "gender": "M",
    "deptNo": "d002",
    "title": "Engineer",
    "salary": "21000"

}

https://api-empleados-php.jruizweb.es/api/addNewEmployee
```

