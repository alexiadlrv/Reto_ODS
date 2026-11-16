# Proyecto ODS
### 12. Despliegue de la parte PHP en Apache mediante un host virtual propio

**1paso** primero abrimos el host de apache en bloc de notas como administrador ,esta es la ruta : C:\Windows\System32\drivers\etc\hosts   y pegamos la ruta 
127.0.0.1    ods-ecocontenedores.local

**2paso** Luego configuramos el host virtual en apache yendo  esta ruta abres el documento C:\xampp\apache\conf\extra\httpd-vhosts.conf  

**3paso**	voy hasta el final del archivo y pongo este codigo ,luego reinicio el xampp abriendolo y dandole a start y ya estaria 
 <VirtualHost *:80>
    ServerName ods-ecocontenedores.local
    DocumentRoot "C:/Users/kalitzel/reto1/Reto_ODS/web"
    <Directory "C:/Users/kalitzel/reto1/Reto_ODS/web">
        Options Indexes FollowSymLinks
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
