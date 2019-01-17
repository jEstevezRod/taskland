<p align="center"><img src="https://i.imgur.com/uUuMaOj.png"></p>


## About Laravel and Vue js

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel attempts to take the pain out of development by easing common tasks used in the majority of web projects, such as:

Vue is a progressive framework for building user interfaces. Unlike other monolithic frameworks, Vue is designed from the ground up to be incrementally adoptable. The core library is focused on the view layer only, and is easy to pick up and integrate with other libraries or existing projects. On the other hand, Vue is also perfectly capable of powering sophisticated Single-Page Applications when used in combination with modern tooling and supporting libraries.

### - Explicación de la idea del proyecto.

Debido que hasta ahora no me he encontrado trabajando en equipo, no me habia dado cuenta
de lo importante que es realmente un buen sistema de versión de controles y no solo eso, hace
falta acompañarla con una herramienta que ayude a esquematizar las tareas pendientes ,
tareas en progreso, tareas preparadas para hacer merge con el branch principal, editar tareas
por cualquier circunstancia, etc. Ahí es donde surge mi idea, crear una aplicación web, en la
cual los miembros de los equipos puedan organizarse de la mejor manera posible y con ello
una eficiencia en el trabajo.

---

### - Tecnologías utilizadas para el desarrollo.

El proyecto estará formado por un front-end elaborado con el framework de Vue js haciendo
servicio a un back-end servido por Laravel. Por parte de Vuejs se usará Vue Router como
encargado de manejar las rutas y como arquitectura de componentes Vuex. Con Laravel haré
uso de Laravel Mix para facilitar el uso de webpack, Laravel Socialite para poder loguearte en
la página web mediante redes sociales ( Google, Github, etc.. ) .
El entorno de desarrollo será en laravel Homestead, la cual es una box predefinida de Vagrant
que me permite desarrollar en una máquina virtual con el entorno ya totalmente preparado para
el desarrollo.
La base de datos será MySQL.
Se utilizarán frameworks de distinto tipos: Para css ,como alternativa a bootstrap, usaré Bulma.
Y Axios para las peticiones http basadas en promesas.
Se hará uso de Webpack como sistema de bundling tanto como para ayudarnos en el
desarrollo para producción, como para ayudarnos a transpilar y preprocesar código
prácticamente de cualquier tecnología ya que con instalar el loader adecuado lo transformará a
una versión o formato más generalizado.

<p align="center"><img src="https://i.imgur.com/SVqv55N.png"></p>

---

### - Alcance completo del proyecto.

La página root será donde podrás loguearte o registrarte mediante un modal, esta página será
la única que podrán ver los usuarios anónimos junto con la page not found 404.
Una vez iniciado sesión estaremos en la página principal, en la parte central habrá una feed de
las notificaciones de lo que van haciendo los miembros de nuestro equipo ( si estamos en
alguno ), las tareas tanto individuales como colectivas, nuevos comentarios en tareas en las
que estamos participando, etc...
Habrá un menú de navegación en la que podremos ir a los siguientes lugares:

-Dashboard:​​ Esta es la página principal de tareas, donde podremos ver nuestras tareas
individuales ( que nosotros mismos nos hayamos puesto, o las que han sido asignadas desde
algún equipo) y también podremos seleccionar los diferentes equipos en los que estamos y si
clicamos en alguno de ellos podremos ver todas las tareas en sus diferentes estados. Existetipos de estados para las tareas, el primero es , - in queue - (todas las tareas que todavía nohan empezado), -in progress - ( que están asignadas a un o varios miembros y está en desarrollo), - completed - ( tareas completadas que están completadas o que simplemente ya
está arreglado y está listo para actualizar la con master branch). Aparte, cada equipo puede
tener 1 o más proyectos en los que está trabajando.

-Mensajes:​​ En esta sección los usuarios que estén en un mismo equipo podrán hablar entre
ellos a través de mensajes, estará compuesto por grupos, que cada grupo será en los equipos
que esté.

-​Calendario: ​Será un calendario en el que se verá de una forma sencilla y simple las fechaslas tareas, así como el tiempo límite para terminar dichas tareas, etc.

-Notas:​​ Creo que siempre es interesante tener un lugar donde poder tener ciertas notas
temporalmente, me explico, cuando estas trabajando, en muchas ocasiones echas de menos
un “contenedor” donde pegar ciertas cosas que necesitarás minutos más adelante, así como
tener los nombres de las diferentes programas / o información de logueo. O tener de forma
personal ciertos apuntes o datos puntuales de una manera fácilmente accesible. Además
existirá la posibilidad de tener notas compartidas con otros usuarios.

-Perfil:​​ Es el lugar donde podrás editar información personal, administrar equipos, organizar
proyectos, etc.

<p align="center"><img src="https://i.imgur.com/BsImI3W.png"></p>