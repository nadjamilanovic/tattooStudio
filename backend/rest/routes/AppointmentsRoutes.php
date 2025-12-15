<?php
require_once __DIR__ . '/../services/AppointmentsService.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../data/Roles.php';

Flight::register('auth_middleware', 'AuthMiddleware');
/**
 * @OA\Get(
 *      path="/appointments",
 *      tags={"appointments"},
 *      summary="Get all appointments",
 *      @OA\Response(
 *           response=200,
 *           description="Array of all appointments in the database"
 *      )
 * )
 */
Flight::route('GET /appointments', function(){
    $user = Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::appointmentsService()->getAllAppointments());
});

/**
 * @OA\Get(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Get appointment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the appointment",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the appointment with the given ID"
 *     )
 * )
 */
Flight::route('GET /appointments/@id', function($id){
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::json(Flight::appointmentsService()->getAppointmentById($id));
});


/**
 * @OA\Post(
 *     path="/appointments",
 *     tags={"appointments"},
 *     summary="Create a new appointment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id", "artist_id", "date"},
 *             @OA\Property(property="user_id", type="integer", example=3),
 *             @OA\Property(property="artist_id", type="integer", example=1),
 *             @OA\Property(property="date", type="string", format="date-time", example="2025-01-10 14:30:00")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="New appointment created"
 *     )
 * )
 */
Flight::route('POST /appointments', function(){
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->createAppointment($data));
});


/**
 * @OA\Put(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Update an existing appointment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="date", type="string", format="date-time", example="2025-02-01 12:00:00"),
 *             @OA\Property(property="status", type="string", example="confirmed")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment updated"
 *     )
 * )
 */
Flight::route('PUT /appointments/@id', function($id){
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    $data = Flight::request()->data->getData();
    Flight::json(Flight::appointmentsService()->updateAppointment($id, $data));
});

/**
 * @OA\Delete(
 *     path="/appointments/{id}",
 *     tags={"appointments"},
 *     summary="Delete an appointment by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="Appointment ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Appointment deleted"
 *     )
 * )
 */
Flight::route('DELETE /appointments/@id', function($id){
    Flight::auth_middleware()->verifyToken(Flight::request()->getHeader("Authentication"));
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN); // samo admin
    Flight::appointmentsService()->deleteAppointment($id);
    Flight::json(["message" => "Appointment deleted successfully"]);
});
?>