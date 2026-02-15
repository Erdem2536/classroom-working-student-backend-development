<?php declare(strict_types=1);

namespace App;

use App\Interfaces\Resettable;
use App\Traits\CanLogin;

/**
 * AdminUser represents an admin account. It's intentionally simple but
 * demonstrates implementing an interface and reusing a trait.
 *
 * Comments are written casually so you can follow the code like a short
 * tutorial. The resetPassword method is a toy example — in real apps you'd
 * integrate email/DB and proper secrets handling.
 */
class AdminUser extends UserBase implements Resettable
{
    use CanLogin;

    public function __construct(string $name, string $email)
    {
        parent::__construct($name, $email);
        // Assign admin role using the base class constant
        $this->role = self::ROLE_ADMIN;
    }

    /**
     * Reset password returns a new random string for demo purposes.
     * In reality you'd persist a hashed password and probably send a link.
     */
    public function resetPassword(): string
    {
        $new = bin2hex(random_bytes(4));
        return $new;
    }
}
