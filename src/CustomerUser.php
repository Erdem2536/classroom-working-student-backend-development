<?php declare(strict_types=1);

namespace App;

use App\Traits\CanLogin;

/**
 * CustomerUser is a lightweight user type that demonstrates extending the
 * base user, adding a small metadata bag and reusing the CanLogin trait.
 * Keep in mind metadata here is just an array for example purposes.
 */
class CustomerUser extends UserBase
{
    use CanLogin;

    // Simple key/value array to store arbitrary customer info.
    private array $metadata = [];

    public function __construct(string $name, string $email, array $metadata = [])
    {
        parent::__construct($name, $email);
        $this->role = self::ROLE_CUSTOMER;
        $this->metadata = $metadata;
    }

    public function getMetadata(): array
    {
        return $this->metadata;
    }
}
