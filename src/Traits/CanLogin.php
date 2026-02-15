<?php declare(strict_types=1);

namespace App\Traits;

/**
 * A tiny reusable trait that provides a login method.
 *
 * This is intentionally trivial: it compares the provided password to a
 * fixed string. Don't copy this for production — it's only here so you can
 * see how traits let different classes share behavior.
 */
trait CanLogin
{
    public function login(string $password): bool
    {
        // Demo-only: pretend the secret is 'secret'
        return $password === 'secret';
    }
}

