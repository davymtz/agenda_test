# Agenda test
## _En este pequeño proyecto se realizó una agenda con las siguientes tecnologías:_

- Laravel: La bse del proyecto, se utilizó su motor de templates (Blade) y en algunos casos se creo un pequeño api para llamar a ciertas funciones [Laravel]
- Bootstrap: para darle un diseño elegante y buena vista al proyecto
- MySQL: como motor de base de datos para almacenar la información
- Docker: para levantar ambiente de desarrollo para cada necesidad del proyecto [Docker]

## Installation

Estep proyecto requiere tener instalado docker y docker-compose para poder correr.
Antes de correr el proyecto necesitan descargar y configurar _[Laradock]_ y segu.ir los pasos para poder levantar un entorno amigable para proyecto en laravel

Para poder levantar el proyecto se necesita utilizar estos comandos.
```sh
cd laradock
docker-compose up -d nginx mysql
```

Para poder visualizar los contenedores el proyecto, se puede utilizar este comando:
```sh
docker container ps -a
```

Para poder utilizar composer y la herramienta artisan propia de laravel, pueden utilizar este comando:
```sh
docker-compose exec --user=laradock workspace bash
```
**Nota**: para entrar como usuario _no root_ necesitaremos del parámetero '- -user'.

Para MySQL, este comando:
```sh
docker-compose mysql mysql -p -u <nombre de usuario>
```
Para terminar parar los conenedores y eliminarlos necesitarán este comando:
```sh
docker-compose down
```

[//]: # (These are reference links used in the body of this note and get stripped out when the markdown processor does its job. There is no need to format nicely because it shouldn't be seen. Thanks SO - http://stackoverflow.com/questions/4823468/store-comments-in-markdown-syntax)

   [Docker]: <https://www.docker.com/>
   [Laravel]: <https://laravel.com>
   [Laradock]: <https://laradock.io/>
