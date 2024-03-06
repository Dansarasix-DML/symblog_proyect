**Cambia el nombre de las variables a las que tengas en tu base de datos o usa la base de datos proporcionada en el repositorio.**

Añade el siguiente Virtual Host:

```
<VirtualHost symblog.es:80>
    DocumentRoot "C:/xampp/htdocs/DWES/Ud10/act_symblog/public/"
    ServerName symblog.es
    <Directory C:/xampp/htdocs/DWES/Ud10/act_symblog/>
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```

Y añade la siguiente línea en tus hosts: ``127.0.0.1 symblog.es``
