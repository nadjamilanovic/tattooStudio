<?php
require_once __DIR__ . '/../services/AppointmentsService.php';

/**
 * @OA\Get(
 *     path="/appointments",
 *     summary="Get all appointments",
 *     @OA\Response(response=200, description="List of all appointments")
 * )
 */

/**
 * @OA\Get(
 *     path="/appointments/{id}",
 *     summary="Get appointment by ID",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Appointment data")
 * )
 */

/**
 * @OA\Post(
 *     path="/appointments",
 *     summary="Create a new appointment",
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             required={"user_id","artist_id","date"},
 *             @OA\Property(property="user_id", type="integer"),
 *             @OA\Property(property="artist_id", type="integer"),
 *             @OA\Property(property="date", type="string", format="date-time")
 *         )
 *     ),
 *     @OA\Response(response=201, description="Appointment created successfully")
 * )
 */

/**
 * @OA\Put(
 *     path="/appointments/{id}",
 *     summary="Update appointment details",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\RequestBody(
 *         @OA\JsonContent(
 *             @OA\Property(property="date", type="string", format="date-time"),
 *             @OA\Property(property="status", type="string")
 *         )
 *     ),
 *     @OA\Response(response=200, description="Appointment updated successfully")
 * )
 */

/**
 * @OA\Delete(
 *     path="/appointments/{id}",
 *     summary="Delete an appointment",
 *     @OA\Parameter(name="id", in="path", required=true, @OA\Schema(type="integer")),
 *     @OA\Response(response=200, description="Appointment deleted successfully")
 * )
 */


Flight::group('/appointments', function() {
    Flight::route('GET /', function() {
        Flight::json(Flight::appointmentsService()->getAll());
    });

    Flight::route('GET /@id', function($id) {
        Flight::json(Flight::appointmentsService()->getById($id));
    });

    Flight::route('POST /', function() {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::appointmentsService()->create($data));
    });

    Flight::route('PUT /@id', function($id) {
        $data = Flight::request()->data->getData();
        Flight::json(Flight::appointmentsService()->update($id, $data));
    });

    Flight::route('DELETE /@id', function($id) {
        Flight::appointmentsService()->delete($id);
        Flight::json(["message" => "Appointment deleted successfully"]);
    });
});
?>
