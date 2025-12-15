<?php
require_once __DIR__ . '/../services/UsersService.php';
require_once __DIR__ . '/../middleware/AuthMiddleware.php';
require_once __DIR__ . '/../data/Roles.php';
/**
 * @OA\Get(
 *     path="/users",
 *     tags={"users"},
 *     summary="Get all users",
 *     @OA\Response(
 *         response=200,
 *         description="Array of all users in the database"
 *     )
 * )
 */
Flight::route('GET /users', function () {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::json([
        "data" => Flight::usersService()->getAllUsers()
    ]);
});


/**
 * @OA\Get(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Get user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID of the user",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Returns the user with the given ID"
 *     )
 * )
 */
Flight::route('GET /users/@id', function ($id) {
    $currentUser = Flight::get('user');
    if ($currentUser->role !== Roles::ADMIN && $currentUser->id != $id) {
        Flight::halt(403, 'Access denied: insufficient privileges');
    }

    Flight::json([
        "data" => Flight::usersService()->getUserById($id)
    ]);
});

/**
 * @OA\Put(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Update an existing user",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             @OA\Property(property="name", type="string", example="Updated Name"),
 *             @OA\Property(property="email", type="string", example="newemail@example.com")
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User updated"
 *     )
 * )
 */
Flight::route('PUT /users/@id', function ($id) {
    $currentUser = Flight::get('user');
    if ($currentUser->role !== Roles::ADMIN && $currentUser->id != $id) {
        Flight::halt(403, 'Access denied: insufficient privileges');
    }

    $data = Flight::request()->data->getData();
    Flight::json([
        "message" => "User updated successfully",
        "data" => Flight::usersService()->updateUser($id, $data)
    ]);
});
/**
 * @OA\Delete(
 *     path="/users/{id}",
 *     tags={"users"},
 *     summary="Delete a user by ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="User ID",
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="User deleted"
 *     )
 * )
 */
Flight::route('DELETE /users/@id', function ($id) {
    Flight::auth_middleware()->authorizeRole(Roles::ADMIN);
    Flight::usersService()->deleteUser($id);
    Flight::json([
        "message" => "User deleted successfully"
    ]);
});
?>
