<?php
require_once __DIR__ . '/../services/TattooDesignsService.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../data/Roles.php';

Flight::register('auth_middleware', 'AuthMiddleware');

/**
 * @OA\Get(
 *     path="/tattoo_designs",
 *     tags={"tattoo_designs"},
 *     summary="Get all tattoo designs",
 * )
 */
Flight::route('GET /tattoo_designs', function() {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::tattooDesignsService()->getAllDesigns());
});

/**
 * @OA\Get(
 *     path="/tattoo_designs/{id}",
 *     tags={"tattoo_designs"},
 *     summary="Get tattoo design by ID",
 * )
 */
Flight::route('GET /tattoo_designs/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::tattooDesignsService()->getDesignById($id));
});

/**
 * @OA\Post(
 *     path="/tattoo_designs",
 *     tags={"tattoo_designs"},
 *     summary="Create a new tattoo design",
 * )
 */
Flight::route('POST /tattoo_designs', function() {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::tattooDesignsService()->createDesign($data));
});

/**
 * @OA\Put(
 *     path="/tattoo_designs/{id}",
 *     tags={"tattoo_designs"},
 *     summary="Update tattoo design by ID",
 * )
 */
Flight::route('PUT /tattoo_designs/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::tattooDesignsService()->updateDesign($id, $data));
});

/**
 * @OA\Delete(
 *     path="/tattoo_designs/{id}",
 *     tags={"tattoo_designs"},
 *     summary="Delete a tattoo design by ID",
 * )
 */
Flight::route('DELETE /tattoo_designs/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    Flight::tattooDesignsService()->deleteDesign($id);
    Flight::json(["message" => "Tattoo design deleted successfully"]);
});
?>
