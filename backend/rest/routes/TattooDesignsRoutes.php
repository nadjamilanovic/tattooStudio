<?php
require_once __DIR__ . '/../services/TattooDesignsService.php';

/**
 * @OA\Get(
 *     path="/tattoo_designs",
 *     summary="Get all tattoo designs",
 *     @OA\Response(response=200, description="List of tattoo designs")
 * )
 */

/**
 * @OA\Get(
 *     path="/tattoo_designs/{id}",
 *     summary="Get tattoo design by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Tattoo design data")
 * )
 */

/**
 * @OA\Post(
 *     path="/tattoo_designs",
 *     summary="Create a new tattoo design",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name","style","price"},
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="style", type="string"),
 *             @OA\Property(property="price", type="number")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Tattoo design created successfully")
 * )
 */

/**
 * @OA\Put(
 *     path="/tattoo_designs/{id}",
 *     summary="Update tattoo design details",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string"),
 *             @OA\Property(property="style", type="string"),
 *             @OA\Property(property="price", type="number")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Tattoo design updated successfully")
 * )
 */

/**
 * @OA\Delete(
 *     path="/tattoo_designs/{id}",
 *     summary="Delete a tattoo design",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Tattoo design deleted successfully")
 * )
 */


Flight::group('/tattoo_designs', function() {
    Flight::route('GET /', function() {
        Flight::json(Flight::tattooDesignsService()->getAll());
    });

    Flight::route('GET /@id', function($id) {
        Flight::json(Flight::tattooDesignsService()->getById($id));
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::tattooDesignsService()->create($data));
    });

    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::tattooDesignsService()->update($id, $data));
    });

    Flight::route('DELETE /@id', function($id) {
        Flight::tattooDesignsService()->delete($id);
        Flight::json(["message" => "Tattoo design deleted successfully"]);
    });
});
?>
