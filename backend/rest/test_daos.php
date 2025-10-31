<?php
require_once 'dao/UsersDao.php';
require_once 'dao/ArtistsDao.php';
require_once 'dao/TattooDesignsDao.php';
require_once 'dao/AppointmentsDao.php';
require_once 'dao/PaymentsDao.php';

// USERS
$usersDao = new UsersDao();
$artistsDao = new ArtistsDao();
$tattooDao = new TattooDesignsDao();
$appointmentsDao = new AppointmentsDao();
$paymentsDao = new PaymentsDao();

echo "<h3>TEST 1: Insert user</h3>";
$usersDao->insert([
    'name' => 'Nadja Milanovic',
    'email' => 'nadja' . rand(1000,9999) . '@example.com',
    'password' => password_hash('123456', PASSWORD_BCRYPT),
    'role' => 'admin',
    'created_at' => date('Y-m-d H:i:s')
]);
echo "User inserted successfully!<br><br>";

$allUsers = $usersDao->getAll();
print_r($allUsers);
$user_id = $allUsers[count($allUsers)-1]['id']; 

echo "<h3>TEST 2: Insert artist</h3>";
$artistsDao->insert([
    'user_id' => $user_id,
    'style' => 'Realism',
    'bio' => 'Specializes in realistic tattoos.',
    'photo_url' => 'artist_photo.jpg',
    'created_at' => date('Y-m-d H:i:s')
]);
echo "Artist inserted successfully!<br><br>";

$allArtists = $artistsDao->getAll();
print_r($allArtists);
$artist_id = $allArtists[count($allArtists)-1]['id'];

echo "<h3>TEST 3: Insert tattoo design</h3>";
$tattooDao->insert([
    'artist_id' => $artist_id,
    'title' => 'Lion Tattoo',
    'image_url' => 'lion_tattoo.jpg',
    'description' => 'Detailed lion tattoo design.',
    'price' => 150.00,
    'created_at' => date('Y-m-d H:i:s')
]);
echo "Tattoo design inserted successfully!<br><br>";

$allDesigns = $tattooDao->getAll();
print_r($allDesigns);
$design_id = $allDesigns[count($allDesigns)-1]['id'];

echo "<h3>TEST 4: Insert appointment</h3>";
$appointmentsDao->insert([
    'user_id' => $user_id,
    'artist_id' => $artist_id,
    'design_id' => $design_id,
    'appointment_date' => '2025-11-05',
    'appointment_time' => '14:00:00',
    'status' => 'confirmed',
    'notes' => 'Client requested shading details.',
    'created_at' => date('Y-m-d H:i:s')
]);
echo "Appointment inserted successfully!<br><br>";

$allAppointments = $appointmentsDao->getAll();
print_r($allAppointments);
$appointment_id = $allAppointments[count($allAppointments)-1]['id'];

echo "<h3>TEST 5: Insert payment</h3>";
$paymentsDao->insert([
    'appointment_id' => $appointment_id,
    'amount' => 150.00,
    'method' => 'cash',
    'paid_at' => date('Y-m-d H:i:s')
]);
echo "Payment inserted successfully!<br><br>";

$allPayments = $paymentsDao->getAll();
print_r($allPayments);

echo "<br><h3>ALL TESTS PASSED SUCCESSFULLY!</h3>";

?>

