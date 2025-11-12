<?php
require_once __DIR__ . '/../services/ArtistsService.php';

/**
 * @OA\Get(
 *     path="/artists",
 *     summary="Get all artists",
 *     @OA\Response(response=200, description="List of all artists")
 * )
 */

/**
 * @OA\Get(
 *     path="/artists/{id}",
 *     summary="Get artist by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Artist data")
 * )
 */

/**
 * @OA\Post(
 *     path="/artists",
 *     summary="Create a new artist",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","specialty"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="specialty", type="string")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Artist created successfully")
 * )
 */

/**
 * @OA\Put(
 *     path="/artists/{id}",
 *     summary="Update artist information",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="specialty", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Artist updated successfully")
 * )
 */

/**
 * @OA\Delete(
 *     path="/artists/{id}",
 *     summary="Delete an artist",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Artist deleted successfully")
 * )
 */


Flight::group('/artists', function() {
    Flight::route('GET /', function() {
        Flight::json(Flight::artistsService()->getAll());
    });

    Flight::route('GET /@id', function($id) {
        Flight::json(Flight::artistsService()->getById($id));
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::artistsService()->create($data));
    });

    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::artistsService()->update($id, $data));
    });

    Flight::route('DELETE /@id', function($id) {
        Flight::artistsService()->delete($id);
        Flight::json(["message" => "Artist deleted successfully"]);
    });
});
?>
