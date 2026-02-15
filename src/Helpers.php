<?php declare(strict_types=1);

namespace App\Helpers;

/**
 * Small namespaced helper functions.
 *
 * These are regular functions (not class methods) to demonstrate that PHP
 * also supports free functions inside namespaces. I like to use these for
 * tiny utilities that don't need a full class.
 */
function formatUsers(array $users): array
{
    // returns a numeric array of associative arrays (name/email/role)
    return array_map(function ($u) {
        return [
            'name' => $u->getName(),
            'email' => $u->getEmail(),
            'role' => $u->getRole(),
        ];
    }, $users);
}

