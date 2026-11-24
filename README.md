# Proyecto ODS
# EcoContenedores — Digitalización de Contenedores Inteligentes (ODS)

## 1. Descripción del proyecto
Aplicación web enfocada en el control inteligente de residuos urbanos y alineada con los Objetivos de Desarrollo Sostenible (**ODS 11** Ciudades y comunidades sostenibles, **ODS 12** Producción y consumo responsables y **ODS 13** Acción por el clima).

El repositorio se divide en dos carpetas principales:
- `web/`: interfaz web en HTML5, CSS3 y PHP (páginas informativas, listado/detalle de contenedores, elementos multimedia y formularios con validación).
- `api/`: servidor backend en Node.js con Express que expone la API REST (`/api/contenedores`) con almacenamiento en memoria.

## 2. Requisitos
- **Node.js** (incluyendo `npm`) para ejecutar el servicio de la API.
- **Apache con PHP** (por ejemplo, mediante XAMPP) para servir la aplicación web en `web/`.
- **Git** para el control de versiones y gestión del repositorio.

## 3. Cómo arrancar la API
Abre una terminal, entra en la carpeta `api` y ejecuta los siguientes comandos:

```bash
cd api
npm install
cp .env.example .env
npm start

```

### 4. Despliegue de la parte PHP en Apache mediante un host virtual propio

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
