<?php
require_once __DIR__ . '/../services/PaymentsService.php';

/**
 * @OA\Get(
 *     path="/payments",
 *     tags={"payments"},
 *     summary="Get all payments",
 *     @OA\Response(
 *         response=200,
 *         description="List of all payments"
 *     )
 * )
 */
Flight::route('GET /payments', function() {
    Flight::json(Flight::paymentsService()->getAllPayments());
});

/**
 * @OA\Get(
 *     path="/payments/{id}",
 *     tags={"payments"},
 *     summary="Get payment by ID",
 *     @OA\Parameter(
 *          name="id",
 *          in="path",
 *          required=true,
 *          description="Payment ID",
 *          @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment data"
 *     )
 * )
 */
Flight::route('GET /payments/@id', function($id) {
    Flight::json(Flight::paymentsService()->getPaymentById($id));
});

/**
 * @OA\Post(
 *     path="/payments",
 *     tags={"payments"},
 *     summary="Create a new payment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id","amount","date"},
 *             @OA\Property(property="user_id", type="integer", example=5),
 *             @OA\Property(property="amount", type="number", example=49.99),
 *             @OA\Property(property="date", type="string", format="date-time", example="2025-01-15T10:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Payment created successfully"
 *     )
 * )
 */
Flight::route('POST /payments', function() {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentsService()->createPayment($data));
});

/**
 * @OA\Put(
 *     path="/payments/{id}",
 *     tags={"payments"},
 *     summary="Update payment details",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="amount", type="number", example=59.99),
 *             @OA\Property(property="status", type="string", example="completed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment updated successfully"
 *     )
 * )
 */
Flight::route('PUT /payments/@id', function($id) {
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentsService()->updatePayment($id, $data));
});

/**
 * @OA\Delete(
 *     path="/payments/{id}",
 *     tags={"payments"},
 *     summary="Delete a payment",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Payment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Payment deleted successfully"
 *     )
 * )
 */
Flight::route('DELETE /payments/@id', function($id) {
    Flight::paymentsService()->deletePayment($id);
    Flight::json(["message" => "Payment deleted successfully"]);
});
?>
