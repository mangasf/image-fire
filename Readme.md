# Image Fire

Image Fire es una aplicación a modo de kata cuyo objetivo es la prueba e integración de distintas herramientas enfocadas al desarrollo de aplicaciones web de alto rendimiento.

Las herramientas de las que hace uso la aplicación son:

- ElasticSearch
- RabbitMQ
- Redis
- BlackFire (Profiling)

## Entorno

Para hacer correr la aplicación necesitamos tener instalado vagrant y ansible y ejecutar el siguiente comando:

```
cd mpwarAnsible/vagrant
vagrant up 
```
La máquina virtual ha sido creada por Rubén Cougil (https://github.com/rubencougil).

Una vez levantada la VM podemos acceder a la aplicación desde la siguiente URL: http://http://192.168.33.50/image-fire/.

### ¿ Que contiene la VM?

- **Apache**, port: 80
- **Mysql**, port: 3306
- **Blackfire**
- **RabbitMQ**, port: 5672
- **RabbitMQ Dashboard**, port: 15672, user: admin, password: admin
- **Redis**, port: 6379
- **Elasticsearch**, port: 9200
- **Kibana**, port: 5601

## Modelo de datos

Para poder usar la aplicación necesitamos crear la BD Mysql, lo hacemos ejecutando el script:

```
/mpwar-performance-vm/share/www/html/image-fire/db/images.sql
```

## Casos de uso

- Súbida de imágenes.
- Listar imágenes.
- Borrar imágen.
- Búsqueda de imágenes por tags (ElasticSearch).
- Edición de la información de una imágen (tags y descripción).
- Aplicación de transformaciones a las imágenes subidas (RabbitMQ).

## Redis

Redis es un almacén de estructura de datos de valores de clave en memoria rápido y de código abierto. Redis incorpora un conjunto de estructuras de datos en memoria versátiles que le permiten crear con facilidad diversas aplicaciones personalizadas.

La integración de Redis en Image Fire tiene como objetivo aumentar la disponibilidad de los datos haciendo de cache, agiliza las consultas sobre las imágenes almacenadas.

En el siguiente diagrama podemos ver un diagrama de flujo del caso de uso encargado del listado de imágenes guardadas:

![alt text](https://github.com/mangasf/image-fire/blob/master/report/redis-diagram.png)

Además para mantener la consistencia de datos entre MySql y Redis las operaciones de edición, consulta y adición de imágenes también son ejecutadas sobre Redis.

*El potencial de Redis en Image Fire no es totalmente explotado debido a la sencillez de los casos de uso, sacaríamos un mayor provecho al ampliar la aplicación y añadir funcionalidades que requieran de un mayor numero de consultas sobre nuestro modelo de datos.*

## RabiitMQ

La integración de RabbitMQ permite a Image Fire la paralelización de la subida de imágenes. Una vez subida una imágen se la debe aplicar una serie de transformaciones (resizes, filtros, etc), con cada una de estas transformaciones asignaremos a la imágen los correspondientes tags que nos permitan luego buscarlas (elastic). Estos trabajos de procesamiento son almacenados en una cola mediante su publicación para ser posteriormente consumidos por uno o más consumers.

## ElasticSearch

La integración de ElasticSearch nos permite, además de mejorar la disponibilidad de datos en la aplicación, la búsqueda rápida de imágenes por tags.

Al hacer una subida de una imágen la información de esta no solo se guarda en MySql sino que es también persistida en Elastic. De esta manera desde el buscador de la aplicación podemos buscar de manera rápida imágenes, lanzando consultas contra Elastic.

Las operaciones de borrado y edición de imágenes también son lanzadas contra Elastic para mantener consistencia entre los dos sitemas.

En la siguiente imágen podemos ver el estado de los dos sistemas de persistencia trás la súbida de dos imágenes a la aplicación (Para la monitorización de Elastic usamos Kibana):

![alt text](https://github.com/mangasf/image-fire/blob/master/report/mysql_and_elasic_status.png)

## Blackfire

Hemos usado blackfire para hacer un análisis de rendimiento de la aplicación.

Por una parte hemos hecho un estudio del impacto que tiene el uso de Redis en el rendimiento de la aplicación, lanzando dos análisis, uno primero sin tener datos cacheados y un segundo con datos cacheados.

![alt text](https://github.com/mangasf/image-fire/blob/master/report/blackfire_1.png)
![alt text](https://github.com/mangasf/image-fire/blob/master/report/blackfire_2.png)

Como vemos en las imágenes el rendimiento haciendo uso de Redis es hasta un 15% superior.

También hemos usado blackfire para detectar las posibles optimizaciones que podemos realizar y los cuellos de botella que presenta nuestra aplicación.

Despúes de hacer el análisis hemos aplicado dos optimizaciones:

- Activación de la cache de Twig.
- Activar la optimización de Autoloader.

La mejora conseguida es aproximádamente del 60%.

![alt text](https://github.com/mangasf/image-fire/blob/master/report/blackfire_3.png)

## Capturas de la aplicación

![alt text](https://github.com/mangasf/image-fire/blob/master/report/screen_1.png)
![alt text](https://github.com/mangasf/image-fire/blob/master/report/screen_2.png)
![alt text](https://github.com/mangasf/image-fire/blob/master/report/screen_3.png)

## TODO

- Unit Testing (PHPUnit)
- Tests de Comportamiento (Behat)

## Autor

Fran Mangas (https://github.com/mangasf)
