<?php
require_once __DIR__ . '/../services/TattooDesignsService.php';

/**
 * @OA\Get(
 *     path="/tattoo_designs",
 *     tags={"tattoo_designs"},
 *     summary="Get all tattoo designs",
 *     @OA\Response(
 *          response=200,
 *          description="Array of all tattoo designs"
 *     )
 * )
 */
Flight::route('GET /tattoo_designs', function() {
    Flight::json(Flight::tattooDesignsService()->getAllDesigns());
});

/**
 * @OA\Get(
 *     path="/tattoo_designs/{id}",
 *     tags={"tattoo_designs"},
 *     summary="Get tattoo design by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Tattoo design ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tattoo design data"
 *     )
 * )
 */
Flight::route('GET /tattoo_designs/@id', function($id) {
    Flight::json(Flight::tattooDesignsService()->getDesignById($id));
});

/**
 * @OA\Post(
 *     path="/tattoo_designs",
 *     tags={"tattoo_designs"},
 *     summary="Create a new tattoo design",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"name", "style", "price"},
 *             @OA\Property(property="name", type="string", example="Dragon Sleeve"),
 *             @OA\Property(property="style", type="string", example="Japanese"),
 *             @OA\Property(property="price", type="number", example=250.00)
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Tattoo design created successfully"
 *     )
 * )
 */
Flight::route('POST /tattoo_designs', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::tattooDesignsService()->createDesign($data));
});

/**
 * @OA\Put(
 *     path="/tattoo_designs/{id}",
 *     tags={"tattoo_designs"},
 *     summary="Update full tattoo design by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Tattoo design ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Tattoo Name"),
 *             @OA\Property(property="style", type="string", example="Realism"),
 *             @OA\Property(property="price", type="number", example=300)
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tattoo design updated successfully"
 *     )
 * )
 */
Flight::route('PUT /tattoo_designs/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::tattooDesignsService()->updateDesign($id, $data));
});

/**
 * @OA\Delete(
 *     path="/tattoo_designs/{id}",
 *     tags={"tattoo_designs"},
 *     summary="Delete a tattoo design by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Tattoo design ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Tattoo design deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /tattoo_designs/@id', function($id) {
    Flight::tattooDesignsService()->deleteDesign($id);
    Flight::json(["message" => "Tattoo design deleted successfully"]);
});
?>
