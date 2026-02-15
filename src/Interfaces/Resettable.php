<?php declare(strict_types=1);

namespace App\Interfaces;

/**
 * Small interface showing a contract: a resettable object must implement
 * a resetPassword method. Interfaces are useful to guarantee behavior.
 */
interface Resettable
{
    /** Reset password and return the new password (demo only). */
    public function resetPassword(): string;
}

