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
