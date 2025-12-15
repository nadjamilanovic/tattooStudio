<?php
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/rest/services/AuthService.php';
require_once __DIR__ . '/rest/services/UsersService.php';
require_once __DIR__ . '/rest/services/ArtistsService.php';
require_once __DIR__ . '/rest/services/AppointmentsService.php';
require_once __DIR__ . '/rest/services/PaymentsService.php';
require_once __DIR__ . '/rest/services/TattooDesignsService.php';
require "middleware/AuthMiddleware.php";


use Firebase\JWT\JWT;
use Firebase\JWT\Key;


ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


Flight::register('usersService', 'UsersService');
Flight::register('artistsService', 'ArtistsService');
Flight::register('appointmentsService', 'AppointmentsService');
Flight::register('paymentsService', 'PaymentsService');
Flight::register('tattooDesignsService', 'TattooDesignsService');
Flight::register('auth_service', 'AuthService');
Flight::register('auth_middleware', "AuthMiddleware");

Flight::route('/*', function() {
   if(
       strpos(Flight::request()->url, '/auth/login') === 0 ||
       strpos(Flight::request()->url, '/auth/register') === 0
   ) {
       return TRUE;
   } else {
       try {
           $token = Flight::request()->getHeader("Authentication");
           if(!$token)
               Flight::halt(401, "Missing authentication header");


           $decoded_token = JWT::decode($token, new Key(Config::JWT_SECRET(), 'HS256'));


           Flight::set('user', $decoded_token->user);
           Flight::set('jwt_token', $token);
           return TRUE;
       } catch (\Exception $e) {
           Flight::halt(401, $e->getMessage());
       }
   }
});

require_once __DIR__ . '/rest/routes/AuthRoutes.php';
require_once __DIR__ . '/rest/routes/UsersRoutes.php';
require_once __DIR__ . '/rest/routes/ArtistsRoutes.php';
require_once __DIR__ . '/rest/routes/AppointmentsRoutes.php';
require_once __DIR__ . '/rest/routes/PaymentsRoutes.php';
require_once __DIR__ . '/rest/routes/TattooDesignsRoutes.php';

Flight::start();
?>
