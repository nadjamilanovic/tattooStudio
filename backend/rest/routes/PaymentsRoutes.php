<?php
require_once __DIR__ . '/../services/PaymentsService.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../data/Roles.php';

Flight::register('auth_middleware', 'AuthMiddleware');

/**
 * @OA\Get(
 *     path="/payments",
 *     tags={"payments"},
 *     summary="Get all payments",
 * )
 */
Flight::route('GET /payments', function() {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::paymentsService()->getAllPayments());
});

/**
 * @OA\Get(
 *     path="/payments/{id}",
 *     tags={"payments"},
 *     summary="Get payment by ID",
 * )
 */
Flight::route('GET /payments/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::paymentsService()->getPaymentById($id));
});

/**
 * @OA\Post(
 *     path="/payments",
 *     tags={"payments"},
 *     summary="Create a new payment",
 * )
 */
Flight::route('POST /payments', function() {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentsService()->createPayment($data));
});

/**
 * @OA\Put(
 *     path="/payments/{id}",
 *     tags={"payments"},
 *     summary="Update payment details",
 * )
 */
Flight::route('PUT /payments/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::paymentsService()->updatePayment($id, $data));
});

/**
 * @OA\Delete(
 *     path="/payments/{id}",
 *     tags={"payments"},
 *     summary="Delete a payment",
 * )
 */
Flight::route('DELETE /payments/@id', function($id) {
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    Flight::paymentsService()->deletePayment($id);
    Flight::json(["message" => "Payment deleted successfully"]);
});
?>
