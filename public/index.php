<?php

//	//	//	//	//
//	Tobi Web
//	php para traer desde Behanse data en .json y pasarla por Twig
//
//

$api_key = '*****';

/*	Template system	*/

require_once '../vendor/Twig-1.24.0/lib/Twig/Autoloader.php';
Twig_Autoloader::register();

// en que carpeta estan los templates
$loader = new Twig_Loader_Filesystem('../templates');

// iniciar Twig
$twig = new Twig_Environment($loader);

// Custom Filter 'slug'
$filter = new Twig_SimpleFilter('slug', function ($string) {
	$string = transliterator_transliterate("Any-Latin; NFD; [:Nonspacing Mark:]
		Remove; NFC; [:Punctuation:] Remove; Lower();", $string);
    $string = preg_replace('/[-\s]+/', '-', $string);
    $string = trim($string, '-');
    return $string;
});
$twig->addFilter($filter);

// cargar template
$template = $twig->loadTemplate('index.html.twig');



/*	Cargar .json	*/

// llamar el archivo.json
// contenido local para desarrollo, cambiar cuando este aovivo
//$proyectosJson = file_get_contents("projects.json");
$proyectosJson = file_get_contents('https://www.behance.net/v2/projects/?q=tobiasbeltran&api_key='.$api_key);

// decode json to php objet array
// (si $2param = 'true', devuelve en formato array)
$proyectos = json_decode($proyectosJson,true);



/*	Render	*/

echo $template->render($proyectos);



/* Leesto!	*/


//	//	//	//	//	//	//	//

/*	TOBY LIKS		//	//

Perfíl: https://www.behance.net/v2/users/tobiasbeltran?api_key=
Projects: https://www.behance.net/v2/projects/?q=tobiasbeltran&api_key= (todos)
Project: https://www.behance.net/v2/projects/36221413?api_key= (c/u)
Documentación: https://www.behance.net/dev/api/endpoints/1#projects-get-10

*/



?>
