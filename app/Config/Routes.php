<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/forgot', 'LoginController::forgot');
$routes->get('/restablecer/(:any)', 'LoginController::restablecer/$1');
$routes->post('/reset', 'LoginController::reset');
$routes->post('/login', 'LoginController::validar');
$routes->put('/restablecer', 'LoginController::restablecerPass');

//$routes->addPlaceholder('alphanumsymbol', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');

$routes->group('', ['filter' => 'AuthCheck'], function ($routes) {

    $routes->get('/admin', 'AdminController::index');
    $routes->get('/dashboard', 'AdminController::dashboard');
    $routes->get('/backup', 'AdminController::createBackup');
    $routes->get('/prestamosMes/(:num)', 'AdminController::prestamosMes/$1');
	$routes->get('/fallecidosMes/(:num)', 'AdminController::fallecidosMes/$1');
    $routes->put('/admin/(:num)', 'AdminController::update/$1');

    //usuarios
    $routes->get('/usuarios/logout', 'UsuariosController::logout');
    $routes->get('/usuarios', 'UsuariosController::index');
    $routes->get('/usuarios/new', 'UsuariosController::new');
    $routes->get('/usuarios/list', 'UsuariosController::listar');

    $routes->get('/usuarios/(:num)/edit', 'UsuariosController::edit/$1');
    //profile user
    $routes->get('/usuarios/profile', 'UsuariosController::profile');
    $routes->post('/usuarios', 'UsuariosController::create');
    $routes->delete('/usuarios/(:num)', 'UsuariosController::delete/$1');
    $routes->put('/profile', 'UsuariosController::saveprofile');
    $routes->put('/usuarios/cambiarClave', 'UsuariosController::cambiarClave');
    $routes->put('/usuarios/(:num)', 'UsuariosController::update/$1');
    //fin usuario

    $routes->get('/clientes/list', 'ClientesController::listar');
    $routes->resource('clientes', ['controller' => 'ClientesController']);

    $routes->get('/prestamos', 'PrestamosController::index');
    $routes->get('/prestamos/historial', 'PrestamosController::historial');
    $routes->get('/prestamos/listHistorial', 'PrestamosController::listHistorial');
    $routes->get('/prestamos/buscarCliente', 'PrestamosController::buscarCliente');
    $routes->get('/prestamos/(:num)/detail', 'PrestamosController::detail/$1');
    $routes->get('/prestamos/(:num)/reporte', 'PrestamosController::reporte/$1');
    $routes->post('/prestamos', 'PrestamosController::create');
    $routes->post('/prestamos/enviarCorreo', 'PrestamosController::enviarCorreo');
    $routes->put('/prestamos/(:num)', 'PrestamosController::update/$1');
    $routes->delete('/prestamos/(:num)', 'PrestamosController::delete/$1');

    $routes->get('/cajas', 'CajasController::index');
    $routes->get('/cajas/new', 'CajasController::new');
    $routes->get('/cajas/movimientos', 'CajasController::movimientos');
    $routes->get('/cajas/(:num)/edit', 'CajasController::edit/$1');
    $routes->post('/cajas', 'CajasController::create');
    $routes->put('/cajas/(:num)', 'CajasController::update/$1');

    $routes->get('/reportesPdf/(:any)', 'ReportesController::reportesPdf/$1');
    $routes->get('/reportesExcel/(:any)', 'ReportesController::reportesExcel/$1');

    $routes->get('/roles/list', 'RolesController::listar');
    $routes->resource('roles', ['controller' => 'RolesController']);

    //resoluciones
    $routes->get('/resoluciones', 'ResolucionesController::index');
    $routes->get('/resoluciones/new', 'ResolucionesController::new');
    $routes->post('/resoluciones', 'ResolucionesController::create');
    $routes->get('/resoluciones/list', 'ResolucionesController::listar');
    $routes->get('/resoluciones/(:num)/edit', 'ResolucionesController::edit/$1');
    $routes->put('/resoluciones/(:num)', 'ResolucionesController::update/$1');
    //$routes->get('/resoluciones/reportes', 'ResolucionesController::reportes');
    //Organizaciones Sociales

    $routes->get('/organizacion', 'OrganizacionController::index');
    $routes->get('/organizacion/new', 'OrganizacionController::new');
    $routes->post('/organizacion', 'OrganizacionController::create');
    $routes->get('/organizacion/list', 'OrganizacionController::listar');
    $routes->get('/organizacion/(:num)/edit', 'OrganizacionController::edit/$1');
    $routes->put('/organizacion/(:num)', 'OrganizacionController::update/$1');
    $routes->get('/organizacion/(:num)/juntadirectiva', 'OrganizacionController::juntadirectiva/$1');
    $routes->get('/organizacion/(:num)/(:num)/listardirectiva', 'OrganizacionController::listardirectiva/$1/$2');
    $routes->delete('/organizacion/(:num)/(:num)', 'OrganizacionController::deletedirectiva/$1/$2');
    $routes->post('/organizacion/agregardirectiva', 'OrganizacionController::agregardirectiva');
    $routes->post('/organizacion/agregaresolucion', 'OrganizacionController::agregaresolucion');
    $routes->get('/organizacion/(:num)/impresioncredencial', 'OrganizacionController::impresioncredencial/$1');
    $routes->get('/organizacion/(:num)/entregacredencial', 'OrganizacionController::entregacredencial/$1');
    $routes->get('/organizacion/(:num)/listaresoluciones', 'OrganizacionController::listaresoluciones/$1');
    $routes->get('/organizacion/(:num)/cbdenomina', 'OrganizacionController::cbdenomina/$1');

    //Personas
    $routes->get('/personas/(:alphanum)/consultardni', 'PersonasController::consultardni/$1');
	$routes->get('/personas/(:alphanum)/consultarpide', 'PersonasController::consultarpide/$1');
	$routes->get('/personas', 'PersonasController::index');
	$routes->get('/personas/new', 'PersonasController::new');
	$routes->post('/personas', 'PersonasController::create');
    $routes->get('/personas/list', 'PersonasController::listar');
	$routes->get('/personas/(:alphanum)/edit', 'PersonasController::edit/$1');
	$routes->put('/personas/(:alphanum)', 'PersonasController::update/$1');
	$routes->get('/personas/(:num)/cbprovincia', 'PersonasController::cbprovincia/$1');
	$routes->get('/personas/(:num)/cbdistrito', 'PersonasController::cbdistrito/$1');
	
    //Personas con dicapacidad
	$routes->get('/personasdiscapacidad/(:alphanum)/new', 'PersonasDiscapacidadController::new/$1');
	$routes->post('/personasdiscapacidad', 'PersonasDiscapacidadController::create');
	$routes->get('/personasdiscapacidad/(:alphanum)/listardiscapacidad', 'PersonasDiscapacidadController::listardiscapacidad/$1');
	$routes->get('/personasdiscapacidad/(:alphanum)/listaractividades', 'PersonasDiscapacidadController::listaractividades/$1');
	$routes->get('/personasdiscapacidad/(:alphanum)/listarfamiliar', 'PersonasDiscapacidadController::listarfamiliar/$1');
    $routes->get('/personasdiscapacidad/agregardiscapacidad/(:alphanum)/(:num)/(:num)', 'PersonasDiscapacidadController::agregardiscapacidad/$1/$2/$3');
    $routes->get('/personasdiscapacidad/agregaractividades/(:alphanum)/(:num)/(:num)', 'PersonasDiscapacidadController::agregaractividades/$1/$2/$3');
	$routes->get('/personasdiscapacidad/agregarfamiliar/(:any)/(:any)/(:any)/(:any)/(:any)', 'PersonasDiscapacidadController::agregarfamiliar/$1/$2/$3/$4/$5');
	$routes->get('/personasdiscapacidad/deletesalud/(:num)/(:alphanum)', 'PersonasDiscapacidadController::deletesalud/$1/$2');
	$routes->get('/personasdiscapacidad/deletefamilia/(:num)/(:alphanum)', 'PersonasDiscapacidadController::deletefamilia/$1/$2');
	
	//Personas fallecidas
	
	$routes->get('/personasfallecidas', 'PersonasfallecidasController::index');
	$routes->get('/personasfallecidas/new', 'PersonasfallecidasController::new');
	$routes->get('/personasfallecidas/(:alphanum)/edit', 'PersonasfallecidasController::edit/$1');
	//$routes->post('/personasfallecidas', 'PersonasfallecidasController::create');
	$routes->get('/personasfallecidas/(:alphanum)/(:alphanum)/(:num)/declarar', 'personasfallecidasController::declarar/$1/$2/$3');
    $routes->get('/personasfallecidas/list', 'PersonasfallecidasController::listar');
	$routes->put('/personasfallecidas/(:alphanum)', 'PersonasfallecidasController::update/$1');
	$routes->get('/personasfallecidas/(:alphanum)/listacroquis', 'PersonasfallecidasController::listacroquis/$1');
	$routes->post('/personasfallecidas/generacroquis', 'PersonasfallecidasController::generacroquis');
	$routes->get('/personasfallecidas/generaorden/(:alphanum)/(:alphanum)/(:num)/(:num)/(:any)', 'PersonasfallecidasController::generaorden/$1/$2/$3/$4/$5');
	$routes->get('/personasfallecidas/(:alphanum)/listaorden', 'PersonasfallecidasController::listaorden/$1');
	$routes->get('/personasfallecidas/(:alphanum)/listasolicitud', 'PersonasfallecidasController::listasolicitud/$1');
	$routes->post('/personasfallecidas/generasolicitud', 'PersonasfallecidasController::generasolicitud');
	$routes->get('/personasfallecidas/solicitudes', 'PersonasfallecidasController::solicitudes');
	$routes->get('/personasfallecidas/(:num)/(:num)/(:num)/listasolicitudes', 'PersonasfallecidasController::listasolicitudes/$1/$2/$3');
	$routes->get('/personasfallecidas/(:num)/editsolicitud', 'PersonasfallecidasController::editsolicitud/$1');
	$routes->post('/personasfallecidas/(:alphanum)/updatesolicitud', 'PersonasfallecidasController::updatesolicitud/$1');
	$routes->delete('/personasfallecidas/(:num)', 'PersonasfallecidasController::delete/$1');
	$routes->get('/personasfallecidas/autorizaciones', 'PersonasfallecidasController::autorizaciones');
	$routes->get('/personasfallecidas/(:num)/(:num)/(:num)/listaautorizaciones', 'PersonasfallecidasController::listaautorizaciones/$1/$2/$3');
	
    //Demo iReport
    $routes->get('/demo', 'ReportesController::demo');

    //RUOS
    $routes->get('/ruos', 'RuosController::index');
    $routes->get('/ruos/list', 'RuosController::listar');
	
	//EXCEL
	
	$routes->get('/exceleditor', 'ExcelEditorController::index');
	$routes->get('/exceleditor/list', 'ExcelEditorController::listar');
	$routes->get('/exceleditor/guardar/(:any)', 'ExcelEditorController::guardar/$1');
	$routes->get('/exceleditor/solicitudes', 'ExcelEditorController::solicitudes');
	$routes->get('/exceleditor/listarsolicitudes/(:any)/(:any)/(:any)', 'ExcelEditorController::listarsolicitudes/$1/$2/$3');
	$routes->get('/exceleditor/guardarsolicitudes/(:any)', 'ExcelEditorController::guardarsolicitudes/$1');
    //CEMENTERIO
	
    $routes->get('/historial', 'HistorialController::index');
    $routes->get('/historial/list', 'HistorialController::listar');
});

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
