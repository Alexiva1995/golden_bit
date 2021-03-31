<?php

use Illuminate\Support\Facades\Route;


// configuracion inicial

Route::group(['prefix' => 'installer', 'middleware' => 'licencia'], function (){
  Route::get('/step1', 'InstallController@index')->name('install-step1');
  Route::post('/savestep1', 'InstallController@saveStep1')->name('install-save-step1');
  Route::get('/step2', 'InstallController@step2')->name('install-step2');
  Route::post('/savestep2', 'InstallController@saveStep2')->name('install-save-step2');
  Route::get('/end', 'InstallController@end')->name('install-end');

});


Route::get('vistaCorreo', function ()
{
  return view('emails.plantilla');
});

// Route::get('/', 'HomeController@home');

Route::prefix('mioficina')->group(function ()
{

 Route::get('getcurrency', 'AdminController@getCurrency')->name('get.currency');
  
Route::group(['prefix' => 'autentication'], function (){
  Route::get('/register', 'Auth\RegisterController@newRegister')->name('autenticacion.new-register');
  Route::post('/saveregister', 'Auth\RegisterController@creater')->name('autenticacion.save-register');
  // ruta para el segundo factor
  Route::get('2fact', 'Auth\RegisterController@fact2')->name('autenticacion.2fact');
  Route::post('2fact', 'Auth\RegisterController@validar2fact')->name('autenticacion.2fact');
    // Registro de las licencias
  Route::post('/savelicencia', 'HomeController@saveLicencia')->name('autenticacion-save-licencia');
   // pare enviar el correo
  Route::post('/recuperarclave', 'RecuperarController@Correo')->name('autenticacion.clave');
  // para recibir el codigo enviado y ir a la pagina de cambiar correo
  Route::get('/getcodigo/{id}', 'RecuperarController@getCodigo')->name('autenticacion-codigo');
  // para guardar el nuevo correo
  Route::post('/guardarclave', 'RecuperarController@change')->name('autenticacion-new-clave');
  Route::post('/loginnew', 'RecuperarController@nuevoLogin')->name('autenticacion-login');
  Route::get('{token}/validarcorreo', 'RecuperarController@validarCorreo')->name('autenticacion-validar-correo');
});



// Tienda Online

Route::group(['prefix' => 'tienda', 'middleware' => ['auth', 'licencia', 'guest']], function (){
    Route::get('/', 'TiendaController@index')->name('tienda-index');
    Route::post('savecompra', 'TiendaController@saveOrdenPosts')->name('tienda-save-compra');
    Route::post('savecupon', 'TiendaController@saveCupon')->name('tienda-save-cupon');
    Route::post('verificar_cupon', 'TiendaController@validacionCupon')->name('tienda-verificar-cupon');
    Route::get('/solicitudes', 'TiendaController@solicitudes')->name('tienda-solicitudes');
    Route::get('/accionsolicitud/{id}/{estado}/accion', 'TiendaController@accionSolicitud')->name('tienda-accion-solicitud');
    Route::get('product', 'ProductController@index')->name('listProduct');
    Route::post('saveproduct', 'ProductController@saveProduct')->name('save.product');
    Route::post('editproduct', 'ProductController@editProduct')->name('edit.product');
    Route::get('{id}/delete', 'ProductController@deleteProduct')->name('save.delete');
    Route::get('{estado}/state', 'TiendaController@estadoTransacion')->name('tienda.estado');

    // inversiones 
    Route::post('/inversion', 'InversionController@pago')->name('tienda.inversion');
    // Blackbox
    Route::post('/goldpack', 'InversionController@pagoGold')->name('tienda.pagogold');
    
});



Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'licencia', 'guest']], function() {

  Route::resource('bonosetting', 'BonoSettingAdminController');

  Route::get('blackbox', 'HomeController@blackbox')->name('blackbox');

  Route::group(['prefix' => 'botbrainbow'], function (){
    // index botbrainbow
    Route::get('/', 'BotBrainbowController@index')->name('botbrainbow.index');
    Route::post('/save_bot_brainbow', 'BotBrainbowController@saveBotBrainbow')->name('botbrainbow.save');
    Route::post('/update_bot_brainbow', 'BotBrainbowController@updateBot')->name('botbrainbow.update');
    Route::get('/get_brainbow', 'BotBrainbowController@getBotBrainbow')->name('botbrainbow.get-data');
    Route::post('/up_bot', 'BotBrainbowController@saveBotExcel')->name('botbrainbow.upbot');
    Route::get('/showbot', 'BotBrainbowController@show_bot')->name('botbrainbow.show');
  });

  Route::post('changeside', 'HomeController@changeSide')->name('change.side');

    // Actualiza todos la informacion para los usuarios

    Route::get('updateall', 'AdminController@ActualizarTodo')->name('admin-update-all');

    Route::group(['prefix' => 'liquidacion'], function ()
    {
      // Liquidaciones Pendientes
      Route::get('/', 'LiquidationController@index')->name('liquidacion');
      Route::get('/{iduser}/detalles', 'LiquidationController@detalles')->name('liquidacion.detalles');
      Route::get('/user_liquidar', 'LiquidationController@indexUserComision')->name('liquidacion.user.comision');
      Route::post('liquidationFiltro', 'LiquidationController@indexFiltro')->name('liquidation.filtro');
      Route::post('generarliquidacion', 'LiquidationController@liduidarUser')->name('liquidacion.generar');
      Route::post('procesarcomisiones', 'LiquidationController@procesarComisiones')->name('liquidacion.procesar.comision');
      Route::get('/liquidacionPendientes', 'LiquidationController@liquidacionPendientes')->name('liquidacion.pendientes');
      Route::get('/liquidacioninversion', 'LiquidationController@liquidacionesInversion')->name('liquidacion.inversion');
      Route::post('/liquidarinversiones', 'LiquidationController@liquidarInversiones')->name('liquidacion.liquidacion.inversiones');
      Route::get('/liquidacionrealizadas', 'LiquidationController@liquidacionesRealizada')->name('liquidacion.realizadas');
      Route::post('/updateLiquidacion', 'LiquidationController@updateLiquidation')->name('liquidacion.update');

      Route::get('rentabilidad', 'ComisionesController@getRentabilidad')->name('prueba.rentabilidad');
    });

    // publicidad
    Route::group(['prefix' => 'publicidad'], function ()
    {
      Route::get('/', 'PublicidadController@indexAdmin')->name('publicidad');
      Route::post('/save', 'PublicidadController@savePublicidad')->name('save.publicidad');
      Route::post('editproduct', 'PublicidadController@editPublicidad')->name('edit.publicidad');
      Route::get('{id}/delete', 'PublicidadController@deletePublicidad')->name('delete.publicidad');
      Route::get('/user', 'PublicidadController@indexUser')->name('publicidad.user');
      Route::post('/compartido', 'PublicidadController@compartido')->name('publicidad.compartido');
      Route::get('/ciclografiph', 'PublicidadController@getInfoDiario')->name('publicidad.ciclo');
    });

    // Billetera

    Route::group(['prefix' => 'wallet'], function(){
        Route::get('/', 'WalletController@index')->name('wallet-index');
        Route::get('/puntos', 'WalletController@indexPoints')->name('wallet-puntos');
        Route::post('/transferencia', 'WalletController@transferencia')->name('wallet-transferencia');
        Route::get('/obtenermetodo/{id}', 'WalletController@datosMetodo')->name('wallet-metodo');
        Route::post('/retiro', 'WalletController@retiro')->name('wallet-retiro');
        Route::get('/historial', 'WalletController@historial')->name('wallet-historial');
        Route::post('/historialfechas', 'WalletController@historial_fechas')->name('wallet-historial-fechas');
        Route::get('/cobros', 'WalletController@cobros')->name('wallet-cobros');
        Route::post('/cobrosfechas', 'WalletController@cobros_fechas')->name('wallet-cobros-fechas');
        // inversiones
        Route::get('/walletInversiones', 'WalletController@indexInversiones')->name('wallet-invesiones');
        Route::get('/detailInversiones/{id}', 'WalletController@indexInversionDetalle')->name('wallet-detalles');
        Route::post('retirarInversiobes', 'WalletController@retirarInversiones')->name('wallet-inversiones-retirar');
        Route::post('retirar_invertido', 'WalletController@retirarInvertido')->name('wallet-inversiones-retirar-invertido');
        // admin
        Route::get('inversionesAdmin', 'InversionController@indexAdminInversion')->name('inversiones.admin');
        Route::get('blackboxlog', 'InversionController@indexBlackbox')->name('blackbox.log');
    });

    

    // Pago

    Route::group(['prefix' => 'price'], function(){

        Route::get('/historial', 'PagoController@historyPrice')->name('price-historial');

        Route::get('/confirmar', 'PagoController@confimPrice')->name('price-confirmar');

        Route::get('/aceptarpago/{id}', 'PagoController@aprobarPago')->name('price-aprobar');

        Route::get('/rechazarpago/{id}', 'PagoController@rechazarPago')->name('price-rechazar');

        Route::post('/filtro', 'PagoController@filtro')->name('price-filtro');

    });



    // graficas

    Route::group(['prefix' => 'chart'], function(){

        Route::get('ventas', 'IndexController@chartVentas')->name('chart.ventas');

        Route::get('pagos', 'IndexController@charPagos')->name('chart.pagos');

        // Route::get('rangos', 'IndexController@chartRangos')->name('chart.rangos');

        Route::get('usuarios', 'IndexController@chartUsuarios')->name('chart.usuarios');

    });

    // Configuraciones

    Route::group(['prefix' => 'settings'], function ()

    {

        // Permite Reiniciar el sistema
        Route::get('/reinicio', 'SettingController@resetSystem')->name('settings.reset');
        // seccion logo, favico y nombre sistema

        Route::get('/sistema', 'SettingController@indexLogo')->name('setting-logo');

        Route::post('/savelogo', 'SettingController@saveLogo')->name('setting-save-logo');

        Route::post('/savefavicon', 'SettingController@saveFavicon')->name('setting-save-favicon');

        Route::post('/savename', 'SettingController@updateName')->name('setting-save-name');

        Route::get('/chageporcent', 'HomeController@changePorcent')->name('setting-change-porcent');

        Route::post('/saveporcentniveles', 'SettingController@updateValorNiveles')->name('setting-save-porcent');
        // valor de tantech coins
        Route::post('/valuetantevh', 'SettingController@updateTantech')->name('setting-save-tantech');
        // valor de rentabilidad
        Route::post('/valuerentabilidad', 'SettingController@updateRentabilidad')->name('setting-save-rentabilidad');

        // seccion campos formularios

        Route::get('/formulario', 'SettingController@indexFormulario')->name('setting-formulario');

        Route::post('saveform', 'SettingController@saveForm')->name('setting-save-form');

        Route::get('/updatefield/{id}/{estado}', 'SettingController@statusField')->name('setting-update-field');

        Route::get('/getform/{id}', 'SettingController@getForm')->name('setting-get-form');

        Route::post('/updateform', 'SettingController@updateForm')->name('setting-update-form'); 

        Route::get('/deleteform/{id}', 'SettingController@deleteForm')->name('setting-delete-form');

        Route::post('/terminos', 'SettingController@terminos')->name('setting-terminos');

        // seccion de comisiones

        Route::get('/comisiones', 'SettingController@indexComisiones')->name('setting-comisiones');

        Route::post('/savecomision', 'SettingController@saveSettingComision')->name('setting-save-comision');

        Route::post('/savebono', 'SettingController@saveBono')->name('setting-save-bono');

        Route::post('/saveprimeracompra', 'SettingController@savePrimera_compra')->name('setting-save-primara-compra');

        Route::post('/saveproducto', 'SettingController@saveProducto')->name('setting-save-producto');

        Route::post('/deleteproducto', 'SettingController@deleteProducto')->name('setting-delete-producto');

        Route::get('/getrangosall', 'SettingController@allRangos')->name('settings-get-all-rangos');

        Route::get('/getproductosall', 'SettingController@allProductos')->name('settings-get-all-productos');

        // seccion de estructura (Arbol - Matrix)

        Route::get('/estructura', 'SettingController@indexEstructura')->name('setting-estructura');

        Route::post('saveestrutura', 'SettingController@saveEstructura')->name('setting-save-estructura');

        // seccion de Rango

        Route::get('/rangos', 'SettingController@indexRango')->name('setting-rango');

        Route::post('/saverango', 'SettingController@saveRangos')->name('setting-save-rango');

        // seccion de pago

        Route::get('/pagos', 'SettingController@indexPago')->name('setting-pago');

        Route::post('/savepagos', 'SettingController@savePagos')->name('setting-save-pagos');

        Route::get('/updatepago/{id}/{estado}', 'SettingController@statusPago')->name('setting-update-pagos');

        Route::post('/savecomisionpago', 'SettingController@comisionMetodoPago')->name('setting-comision-pago');

        Route::get('/getmetodo/{id}', 'SettingController@getMetodo')->name('setting-get-metodo');

        Route::post('/updatemetodo', 'SettingController@updateMetodo')->name('setting-update-metodo'); 

        Route::get('/deletemetodo/{id}', 'SettingController@deleteMetodo')->name('setting-delete-metodo');

        // seccion de plantilla de correo

        Route::get('/plantilla', 'SettingController@indexPlantilla')->name('setting-plantilla');

        Route::post('/saveplantilla', 'SettingController@savePlantilla')->name('setting-save-plantilla');

        Route::post('/probaplantilla', 'SettingController@probarPlantilla')->name('setting-probar-plantilla');

        // seccion permisos

        Route::get('/permisos', 'SettingController@indexPermisos')->name('setting-permisos');

        Route::post('/adminsave', 'SettingController@saveAdmin')->name('setting-save-admin');

        Route::get('/getpermisos/{id}', 'SettingController@getPermisos')->name('setting-get-permisos');

        Route::post('/savepermiso', 'SettingController@savePermisos')->name('setting-save-permisos');

        // seccion activacion

        Route::get('/activacion', 'SettingController@indexActivacion')->name('setting-activacion');

        Route::post('/saveactivacion', 'SettingController@saveActivacion')->name('setting-save-activacion');

        // seccion de monedas

        Route::get('/monedas', 'SettingController@indexMonedas')->name('setting-monedas');

        Route::post('/savemonedas', 'SettingController@saveMonedas')->name('setting-save-monedas');

        Route::get('/updatemoneda/{id}/{estado}', 'SettingController@statusMoneda')->name('setting-update-moneda-principal');

        Route::get('/deletemoneda/{id}', 'SettingController@deleteMoneda')->name('setting-delete-moneda');

    });



    //Generar las comisiones mensuales de todos los usuarios (OpcSidebar: Comisiones / Generar Comisiones)

    Route::get('/generatecommisions', 'ComisionesController@ObtenerUsuarios')->name('admin.generate-commissions');

    //Historial de comisiones de todos los usuarios (OpcSidebar: Reportes / Historial de Comisiones)

    Route::get('/commissionrecords', 'AdministradorController@commission_records')->name('admin.commission-records');



    //   Rutas pasa las liquidaciones

    Route::get('/liquidaciones', 'LiquidacionesController@index')->name('admin.liquidaciones');

    Route::get('/generarliquidaciones', 'LiquidacionesController@procesarLiquidacion')->name('admin.generarliquidaciones');

    Route::post('/liquidacion_estatus', 'LiquidacionesController@estado')->name('admin.liquidacion_estatus');

    Route::get('/liquidar_todo', 'LiquidacionesController@liquidar_todo')->name('admin.liquidar_todo');



    // Transferir comisiones pendientes

    Route::get('/pagocomision/{id}', 'CommissionController@pago_comisiones')->name('admin.pagocomision');

    // Historia del Liquidaciones

    Route::get('/recordliquidacion', 'LiquidacionesController@recordliquidacion')->name('admin.liquidacion-record');



    //comisiones por fechas

     Route::get('/comisiones_filter', 'ComisionesController@comisiones_filter')->name('admin.comisiones_filter');

     Route::post('/filter_comisiones', 'ComisionesController@filter_comisiones')->name('admin.filter_comisiones');



    Route::get('/', 'AdminController@index')->name('admin.index');

    Route::get('/ranking', 'Ranking2Controller@ranking')->name('admin.ranking');



    //Transfiere lo que hay en las billeteras al banco

    Route::get('/paycommissions', 'CommissionController@pay_commissions')->name('admin.pay-commissions');

    Route::get('/recordtransfers', 'CommissionController@record_transfers')->name('admin.record-transfers');



    // Modificacion del usuario por parte del admin

    Route::get('/userrecords', 'HomeController@user_records')->name('admin.userrecords');

    Route::get('/change/{iduser}/user/{paquete}/package', 'HomeController@changePaquete')->name('admin.change.paquete');

    Route::get('/useredit/{id}', 'ActualizarController@user_edit')->name('admin.useredit');

    Route::post('/userdelete', 'HomeController@deleteProfile')->name('admin.userdelete');

    Route::get('/userinactive', 'HomeController@userActiveManual')->name('admin.userinactive');

    Route::post('/userinactive', 'HomeController@saveActiveManual')->name('admin.userinactive');



    Route::post('/userdeletetodos/{id}', 'AdminController@deleteTodos')->name('admin.userdeletetodos');





    Route::get('/notifications', 'NotificationController@index')->name('admin.notifications');

    

    //Search users por vision de usuario

    Route::get('/buscar','AdminController@buscar')->name('admin.buscar');

    

    Route::get('/vista','AdminController@vista')->name('admin.vista');

    //fin de vision de usuario

    

    //Todo tipo de informes

     Route::group(['prefix' => 'info'], function(){

      // info rango
      Route::get('rangouser', 'RangoController@listRangos')->name('info.list-rango');
      route::get('{iduser}/{idrango}/{estado}/actualizarpremio', 'RangoController@cambiarEstadoDelosrangos')->name('info.rango-actualizar');

         //informes de perfil buscar por nombre

        Route::get('/perfil', 'ReporteController@perfil')->name('info.perfil');

        Route::post('/nombre','ReporteController@nombre')->name('info.nombre');

      

      //buscar por ID de usuario

        Route::post('/usuario','ReporteController@usuario')->name('info.usuario');

        Route::get('/mostrar-usuario','ReporteController@mostrarusuario')->name('info.mostrar-usuario');

        

        //desde un ID hasta ID

         Route::post('/lista','ReporteController@lista')->name('info.lista');

        Route::get('/lista-final','ReporteController@listafinal')->name('info.lista-final');

        

        //informes de activos

         Route::get('/activacion','ReporteController@activacion')->name('info.activacion');

         Route::post('/mostrar-activo','ReporteController@mostraractivo')->name('info.mostrar-activo');

         Route::post('/fecha','ReporteController@fecha')->name('info.fecha');

         

         //Rangos

         Route::get('/rango','ReporteController@rango')->name('info.rango');

         Route::post('/mostrar-rango','ReporteController@mostrarrango')->name('info.mostrar-rango');

         

         //comisiones

         Route::get('/comisiones','ReporteController@comisiones')->name('info.comisiones');

         Route::post('/mostrar-comisiones','ReporteController@mostrarcomisiones')->name('info.mostrar-comisiones');
        
        // Comisiones con compras
        Route::get('{balance}/{tipo}/comisioncompra', 'ComisionesController@reporteCompraComision')->name('info.comisioncompra');
        Route::post('/comisioncomprafecha', 'ComisionesController@reporteCompraComisionxFecha')->name('info.comisioncompra.fechas');

        // Sumatoria de la Billeteras
         Route::get('billeteras', 'ReporteController@billeteras')->name('info.billeteras');

         //pagos

          Route::get('/pagos','ReporteController@pagos')->name('info.pagos');

         Route::get('/pagosusuario','ReporteController@pagosusuario')->name('info.pagosusuario');

         Route::post('/buscar','ReporteController@buscar')->name('info.buscar');

         

         //reportes pagos

          Route::get('/reportes','ReporteController@reportes')->name('info.reportes');

           Route::post('/repor-fecha','ReporteController@reporfecha')->name('info.repor-fecha');

            Route::post('/todos','ReporteController@todos')->name('info.todos');

          Route::post('/nombre-bus','ReporteController@nombrebus')->name('info.nombre-bus');

          

          //reportes de comision

           Route::get('/repor-comi','ReporteController@reporcomi')->name('info.repor-comi');

          Route::post('/repor-todos','ReporteController@reportodos')->name('info.repor-todos');

          

          //reporte de ventas

          Route::get('/ventas','ReporteController@ventas')->name('info.ventas');

          Route::post('/informe_fecha','ReporteController@informe_fecha')->name('info.informe_fecha');

          Route::post('/informe_ventas','ReporteController@informe_ventas')->name('info.informe_ventas');

          

          //liquidacion

           Route::get('/liquidacion','ReporteController@liquidacion')->name('info.liquidacion');



          // descuento

          Route::get('/feed', 'ReporteController@descuentos')->name('info.descuento');

         

    });

    

    //gestion de perfiles

     Route::group(['prefix' => 'gestion'], function(){

         //perfil

         Route::get('/verusuario/{id}', 'GestionController@verusuario')->name('gestion.verusuario');

         Route::get('/gestionperfiles', 'GestionController@gestionperfiles')->name('gestion.gestionperfiles');

          Route::post('/gestion','GestionController@gestion')->name('gestion.gestion');

          Route::get('/encontrado','GestionController@encontrado')->name('gestion.encontrado');

          

          //ingresos liberados

          Route::get('/ingresos/{id}','GestionController@ingresos')->name('gestion.ingresos');

          Route::get('/ingresos-valor','GestionController@ingresos_valor')->name('gestion.ingresos-valor');

          

          //ingresos detallados

          Route::get('/ingresos-detallado','GestionController@ingresos_detallado')->name('gestion.ingresos-detallado');

          

          //referidos

          Route::get('/referidos/{id}','GestionController@referidos')->name('gestion.referidos');

          Route::get('/directos','GestionController@directos')->name('gestion.directos');

          

          //billetera

          Route::get('/wallet/{id}','GestionController@wallet')->name('gestion.wallet');

          Route::get('/billetera','GestionController@billetera')->name('gestion.billetera');

          

          //pagos

          Route::get('/pago/{id}','GestionController@pago')->name('gestion.pago');

          Route::get('/liberado','GestionController@liberado')->name('gestion.liberado');

          

     });

     

     //herramientas subida de archivos

     Route::group(['prefix' => 'archivo'], function(){

          Route::get('/subir','ArchivoController@subir')->name('archivo.subir');

           Route::post('/subida','ArchivoController@subida')->name('archivo.subida');

          Route::get('/ver','ArchivoController@ver')->name('archivo.ver');

          Route::get('/{id}/destruir',[

           'uses' => 'ArchivoController@destruir',

            'as' => 'archivo.destruir'

	                                 ]);

	

	//gestion de noticias

	Route::get('/noticias', 'ArchivoController@noticias')->name('archivo.noticias');

	Route::post('/guardar',[

'uses' => 'ArchivoController@guardar',

'as' => 'archivo.guardar'

	]);

	

	Route::get('/contenido', 'ArchivoController@contenido')->name('archivo.contenido');

	Route::get('/{id}/eliminar', 'ArchivoController@eliminar')->name('archivo.eliminar');

		Route::get('/{id}/actualizar', 'ArchivoController@actualizar')->name('archivo.actualizar');

		Route::put('/{id}/modificar', 'ArchivoController@modificar')->name('archivo.modificar');

     });



    Route::group(['prefix' => 'user'], function(){

        Route::get('/edit', 'ActualizarController@editProfile')->name('admin.user.edit');

        Route::put('update', 'ActualizarController@updateProfile')->name('admin.user.update');

        Route::put('actualizar/{id}', 'ActualizarController@actualizar')->name('admin.user.actualizar');

    });

    

    //Historial de actividades

     Route::group(['prefix' => 'actividad'], function(){

          Route::get('/actividad', 'ActividadController@actividad')->name('actividad.actividad');

     });





    Route::group(['prefix' => 'network'], function(){

        Route::get('/directrecords', 'AdminController@direct_records')->name('directrecords');

        Route::get('/networkrecords', 'AdminController@network_records')->name('networkrecords');

         Route::post('/buscardirectos','AdminController@buscardirectos')->name('buscardirectos');

          Route::post('/buscarnetwork','AdminController@buscarnetwork')->name('buscarnetwork');

          Route::post('/buscarnetworknivel','AdminController@buscarnetworknivel')->name('buscarnetworknivel');

           

        Route::get('/commissionsrecords', 'ComisionesController@ObtenerUsuarios')->name('commissionsrecords');

        Route::get('/commissionspayment', 'ComisionesController@ObtenerUsuarios')->name('commissionspayment');

         Route::get('/aprobarcomision/{id}', 'ComisionesController@aprobarComision')->name('comisiones.aprobar');

      // admin
      Route::post('records_directo', 'AdminController@directoAdmin')->name('admin.directo');
      Route::post('records_network', 'AdminController@networkAdmin')->name('admin.network');

    });



    Route::group(['prefix' => 'transactions'], function(){

        Route::get('/personalorders', 'AdminController@personal_orders')->name('personalorders');

        Route::get('/networkorders', 'AdminController@network_orders')->name('networkorders');

         Route::post('/buscarpersonalorder','AdminController@buscarpersonalorder')->name('buscarpersonalorder');

          Route::post('/buscarnetworkorder','AdminController@buscarnetworkorder')->name('buscarnetworkorder');

    });

    

    Route::group(['prefix' => 'ticket'], function(){

       Route::get('/ticket','TicketController@ticket')->name('ticket');

       Route::post('/generarticket','TicketController@generarticket')->name('generarticket');

       Route::get('/misticket','TicketController@misticket')->name('misticket');

        Route::get('/{id}/comentar','TicketController@comentar')->name('comentar');

        

        Route::post('subir','TicketController@subir')->name('subir');
        Route::get('/todosticket','TicketController@todosticket')->name('todosticket');

       

        Route::get('/{id}/ver','TicketController@ver')->name('ver');

       

       Route::get('/{id}/cerrar','TicketController@cerrar')->name('cerrar');

    });





});


});