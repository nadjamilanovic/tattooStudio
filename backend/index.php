<?php
require_once __DIR__ . '/vendor/autoload.php';

require_once __DIR__ . '/rest/services/UsersService.php';
require_once __DIR__ . '/rest/services/ArtistsService.php';
require_once __DIR__ . '/rest/services/AppointmentsService.php';
require_once __DIR__ . '/rest/services/PaymentsService.php';
require_once __DIR__ . '/rest/services/TattooDesignsService.php';

Flight::register('usersService', 'UsersService');
Flight::register('artistsService', 'ArtistsService');
Flight::register('appointmentsService', 'AppointmentsService');
Flight::register('paymentsService', 'PaymentsService');
Flight::register('tattooDesignsService', 'TattooDesignsService');

Flight::route('/', function() {
    echo 'Tattoo Studio API is running!';
});

require_once __DIR__ . '/rest/routes/UsersRoutes.php';
require_once __DIR__ . '/rest/routes/ArtistsRoutes.php';
require_once __DIR__ . '/rest/routes/AppointmentsRoutes.php';
require_once __DIR__ . '/rest/routes/PaymentsRoutes.php';
require_once __DIR__ . '/rest/routes/TattooDesignsRoutes.php';

Flight::start();
?>
