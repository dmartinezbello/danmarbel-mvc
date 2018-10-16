<?php

/* Mapear la url ingresada en el navegador y cargarla en el archivo Core.php
    1. Controlador
    2. Metodo
    3. Parametro
    Ejemplo persona/modificar/juan
*/

class Core
{
    // Mientras no se carge ninguna url valida debe cargar el controlador por defecto y ese controlador seria pagina
    protected $controladorActual = "Paginas";
    // Cuando no haya metodo seria el index
    protected $metodoActual = "index";
    //Mientras no se cargue ningu parametro el parametro sera definido como un array vacio
    protected $parametros = [];

    // Esto ejectuta la funcion getUrl por si sola
    public function __construct()
    {
        //print_r($this->getUrl());
        $url = $this->getUrl();
        //echo ucwords($url[0]);

        // Buscar en controladores si el controlador existe
        if (file_exists("../app/controller/" . ucwords($url[0]) . ".php"))
        {
            //Si el controlador existe se configura como controlador por defecto
            $this->controladorActual = ucwords($url[0]);
            
            unset($url[0]);
        }
        // requerir el controlador
        require_once "../app/controller/" . $this->controladorActual . ".php";
        $this->controladorActual = new $this->controladorActual;
    }

    //Obtener el url
    public function getUrl()
    {
        //echo $_GET["url"];
         // Verificar que existe la URL en la carpeta
        if(isset($_GET['url']))
        {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);
            return $url;
        }
    }
}

?>