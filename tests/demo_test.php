<?php declare(strict_types=1);

/**
 * Very small test script using native assert(). This is intentionally tiny
 * so you can run it without installing PHPUnit. It checks the basic
 * behavior required by the task.
 */

require_once __DIR__ . '/../vendor/autoload.php';

use App\AdminUser;
use App\CustomerUser;

$admin = new AdminUser('Test Admin', 'test.admin@example.com');
$customer = new CustomerUser('Test Cust', 'test.cust@example.com');

// Basic assertions demonstrating functionality required by the task
assert($admin->getRole() === \App\UserBase::ROLE_ADMIN);
assert($customer->getRole() === \App\UserBase::ROLE_CUSTOMER);
assert(filter_var($admin->getEmail(), FILTER_VALIDATE_EMAIL) !== false);
assert(\App\UserBase::getInstanceCount() >= 2);

echo "All tests passed.\n";
