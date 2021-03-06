<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Inicio');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//Rutas inición de sesión
$routes->get('/', 'Inicio::index');
$routes->get('Inicio', 'Inicio::index'); 
$routes->get('Ingreso', 'Inicio::paginaIngreso');
$routes->get('Registro', 'Inicio::paginaRegistro');
$routes->post('emailRecuperar', 'Inicio::email_recuperar');
$routes->post('crearRegistroUsuario', 'Inicio::crearRegistroUsuario');
$routes->get('cambiarContrasena/(:any)', 'Inicio::vista_cambiar_pass/$1');
$routes->post('editarContrasena', 'Inicio::editarContrasena');

$routes->get('TerminosCondiciones', 'TerminosCondiciones::terminosCondicionesMarcha'); 


//Rutas sesión en fincas
$routes->post('validarIngreso', 'Inicio::validarDatosIngreso');
$routes->get('inicioAdmin', 'Fincas::index');
$routes->post('getMunicipios', 'Fincas::obtenerMunicipios');
$routes->post('registrarFinca', 'Fincas::agregarFinca');
$routes->get('logOut', 'Inicio::cerrarSesion');
$routes->post('EditarFinca', 'Fincas::editarFincas');
$routes->post('EliminarFinca', 'Fincas::peticionEliminarFinca');

$routes->get('Dashboard/(:num)', 'Dashboard::inicio_dashboard/$1');

// Rutas controlador Empleado
$routes->get('Empleados', 'Empleado::vista_empleado');
$routes->post('AgregarEmpleado', 'Empleado::agregarEmpleado');
$routes->post('EditarEmpleado', 'Empleado::editar_Empleado');
$routes->post('EliminarEmpleado', 'Empleado::eliminarEmpleado');
$routes->post('BuscarActivosInactivos', 'Empleado::obtenerEmpleados');
$routes->post('RestaurarEmpleado', 'Empleado::restaurarEmpleado');

//Rutas controlador Categorias
$routes->get('Categorias', 'Categoria::vista_categoria');
$routes->post('AgregarCategoria', 'Categoria::agregarCategoria');
$routes->post('listarCategoria', 'Categoria::listarCategoria');
$routes->post('EliminarCategoria', 'Categoria::EliminarCategoria');
$routes->post('EditarCategoria', 'Categoria::EditarCategoria');

//Rutas controlador Lote
$routes->get('Lotes', 'Lote::vista_lote');
$routes->post('AgregarLote', 'Lote::agregarLote');
$routes->post('EditarLote', 'Lote::editarLote');
$routes->post('EliminarLote', 'Lote::eliminarLote');

// Rutas controlador AsigCategoria
$routes->get('Asig_Categoria', 'AsigCategoria::vista_asig_categoria');
$routes->post('AgregarAsigCategoria', 'AsigCategoria::agregarAsigCategoria');
$routes->post('EditarAsigCategoria', 'AsigCategoria::editarAsigCategoria');
$routes->post('EliminarAsigCategoria', 'AsigCategoria::eliminarAsigCategoria');

//Rutas controlador Lote Actividad
$routes->get('LoteActividad', 'LoteActividad::vista_asig_actividad');
$routes->post('AgregarLoteActividad', 'LoteActividad::agregarLoteActividad');
$routes->post('EliminarLoteActividad', 'LoteActividad::eliminarLoteActividad');
$routes->post('EditarLoteActividad', 'LoteActividad::editarLoteActividad');
$routes->post('EditarLoteActividadEstado', 'LoteActividad::editarLoteActividadEstado');
$routes->post('FiltrarActividadEstado', 'LoteActividad::filtrarActividadbyEstado');

//Rutas controlador Inventario
$routes->get('Inventario', 'Inventario::vista_inventario');
$routes->post('AgregarInventario', 'Inventario::agregarInventario');
$routes->post('EditarInventario', 'Inventario::editarInventario');
$routes->post('EliminarInventario', 'Inventario::eliminarInventario');

//Rutas controlador Actividad
$routes->get('Actividades', 'Actividad::vista_actividad');
$routes->post('AgregarActividad', 'Actividad::agregarActividad');
$routes->post('EditarActividad', 'Actividad::editarActividad');
$routes->post('EliminarActividad', 'Actividad::eliminarActividad');

// Rutas controlador AsigEmpleado
$routes->get('Asig_empleado', 'AsigEmpleado::vista_asig_empleado');
$routes->post('AgregarAsigEmpleado', 'AsigEmpleado::agregarAsignarEmpleado');
$routes->post('EditarAsigEmpleado', 'AsigEmpleado::editarAsigEmp');
$routes->post('EliminarAsigEmpleado', 'AsigEmpleado::eliminarAsigEmpleado');

// Rutas controlador Herramientas
$routes->get('herramientas', 'Herramientas::vista_herramientas');
$routes->post('AgregarHerramientas', 'Herramientas::agregarHerramienta');
$routes->post('EditarHerramientas', 'Herramientas::editarHerramienta');
$routes->post('EliminarHerramientas', 'Herramientas::eliminarHerramienta');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
