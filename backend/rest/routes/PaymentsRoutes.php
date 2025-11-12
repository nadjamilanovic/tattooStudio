<?php
require_once __DIR__ . '/../services/PaymentsService.php';

/**
 * @OA\Get(
 *     path="/payments",
 *     summary="Get all payments",
 *     @OA\Response(response=200, description="List of all payments")
 * )
 */

/**
 * @OA\Get(
 *     path="/payments/{id}",
 *     summary="Get payment by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Payment data")
 * )
 */

/**
 * @OA\Post(
 *     path="/payments",
 *     summary="Create a new payment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id","amount","date"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="amount", type="number"),
 *             @OA\Property(property="date", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Payment created successfully")
 * )
 */

/**
 * @OA\Put(
 *     path="/payments/{id}",
 *     summary="Update payment details",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             @OA\Property(property="amount", type="number"),
 *             @OA\Property(property="status", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Payment updated successfully")
 * )
 */

/**
 * @OA\Delete(
 *     path="/payments/{id}",
 *     summary="Delete a payment",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Payment deleted successfully")
 * )
 */


Flight::group('/payments', function() {
    Flight::route('GET /', function() {
        Flight::json(Flight::paymentsService()->getAll());
    });

    Flight::route('GET /@id', function($id) {
        Flight::json(Flight::paymentsService()->getById($id));
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::paymentsService()->create($data));
    });

    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::paymentsService()->update($id, $data));
    });

    Flight::route('DELETE /@id', function($id) {
        Flight::paymentsService()->delete($id);
        Flight::json(["message" => "Payment deleted successfully"]);
    });
});
?>
