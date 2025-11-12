<?php
require_once __DIR__ . '/../vendor/autoload.php';

require_once __DIR__ . '/services/UsersService.php';
require_once __DIR__ . '/services/ArtistsService.php';
require_once __DIR__ . '/services/AppointmentsService.php';
require_once __DIR__ . '/services/PaymentsService.php';
require_once __DIR__ . '/services/TattooDesignsService.php';

Flight::register('usersService', 'UsersService');
Flight::register('artistsService', 'ArtistsService');
Flight::register('appointmentsService', 'AppointmentsService');
Flight::register('paymentsService', 'PaymentsService');
Flight::register('tattooDesignsService', 'TattooDesignsService');

Flight::route('/', function() {
    echo 'Tattoo Studio API is running!';
});

require_once __DIR__ . '/routes/UsersRoutes.php';
require_once __DIR__ . '/routes/ArtistsRoutes.php';
require_once __DIR__ . '/routes/AppointmentsRoutes.php';
require_once __DIR__ . '/routes/PaymentsRoutes.php';
require_once __DIR__ . '/routes/TattooDesignsRoutes.php';

Flight::start();
?>
