<?php
require_once __DIR__ . '/../services/ArtistsService.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../data/Roles.php';

Flight::register('auth_middleware', 'AuthMiddleware');
/**
 * @OA\Get(
 *     path="/artists",
 *     tags={"artists"},
 *     summary="Get all artists",
 *     @OA\Response(
 *          response=200,
 *          description="List of all artists"
 *     )
 * )
 */
Flight::route('GET /artists', function() {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::artistsService()->getAllArtists());
});

/**
 * @OA\Get(
 *     path="/artists/{id}",
 *     tags={"artists"},
 *     summary="Get artist by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Artist ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Artist data"
 *     )
 * )
 */
Flight::route('GET /artists/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::artistsService()->getArtistById($id));
});
/**
 * @OA\Post(
 *     path="/artists",
 *     tags={"artists"},
 *     summary="Create a new artist",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","specialty"},
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="specialty", type="string", example="Black & Grey Tattoos")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Artist created successfully"
 *     )
 * )
 */
Flight::route('POST /artists', function() {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::artistsService()->createArtist($data));
});

/**
 * @OA\Put(
 *     path="/artists/{id}",
 *     tags={"artists"},
 *     summary="Update artist information",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Artist ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Artist Name"),
 *             @OA\Property(property="specialty", type="string", example="Realism")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Artist updated successfully"
 *     )
 * )
 */
Flight::route('PUT /artists/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::artistsService()->updateArtist($id, $data));
});

/**
 * @OA\Delete(
 *     path="/artists/{id}",
 *     tags={"artists"},
 *     summary="Delete an artist",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Artist ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Artist deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /artists/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    Flight::artistsService()->deleteArtist($id);
    Flight::json(["message" => "Artist deleted successfully"]);
});
?>
