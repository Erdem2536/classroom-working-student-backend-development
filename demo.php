<?php declare(strict_types=1);

// Demo script - will try to use Composer autoload if present, otherwise
// fall back to direct requires. The fallback is useful for quick checks
// without installing Composer, but when you're ready to work on real
// projects it's better to rely on Composer autoload only.
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
	require_once __DIR__ . '/vendor/autoload.php';
} else {
	// Manual requires: these are ordered so traits/interfaces are loaded
	// before the classes that use them. This keeps the demo runnable in
	// environments where Composer isn't available (learning convenience).
	require_once __DIR__ . '/src/UserBase.php';
	require_once __DIR__ . '/src/Traits/CanLogin.php';
	require_once __DIR__ . '/src/Interfaces/Resettable.php';
	require_once __DIR__ . '/src/AdminUser.php';
	require_once __DIR__ . '/src/CustomerUser.php';
}

use App\AdminUser;
use App\CustomerUser;

echo "PHP Basics Coding Challenge Demo\n";

// Create example users to show how the classes work. These are small and
// readable so you can step through them while learning.
$admin = new AdminUser('Alice Admin', 'alice.admin@example.com');
$customer = new CustomerUser('Bob Customer', 'bob.customer@example.com', ['plan' => 'free']);

echo $admin . PHP_EOL; // uses __toString()
echo $customer . PHP_EOL;

// ----- Arrays and simple functional helpers -----
$users = [$admin, $customer];

// numeric array -> collect emails using array_map and a short closure
$emails = array_map(fn($u) => $u->getEmail(), $users);
echo "Emails: " . implode(', ', $emails) . PHP_EOL;

// group by role into an associative array (role => list of users)
$byRole = [];
foreach ($users as $u) {
	$byRole[$u->getRole()][] = $u;
}

// filter example: get only admins
$admins = array_filter($users, fn($u) => $u->getRole() === App\UserBase::ROLE_ADMIN);
echo "Admin count via filter: " . count($admins) . PHP_EOL;

// static counter from the base class
echo "Total instances: " . App\UserBase::getInstanceCount() . PHP_EOL;

// exception handling demo to show how validation errors surface
try {
	$bad = new CustomerUser('Bad', 'not-an-email');
} catch (\Throwable $e) {
	echo "Caught exception for invalid email: " . $e->getMessage() . PHP_EOL;
}

// closure example: anonymous function used with array_map to print names
$printName = function($u) { echo "- " . $u->getName() . "\n"; };
array_map($printName, $users);

// small assert to show an inline test — will do nothing if OK
assert(count($users) === 2);

echo "Demo finished.\n";