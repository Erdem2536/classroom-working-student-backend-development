<?php declare(strict_types=1);

namespace App;

use InvalidArgumentException;

/**
 * Base class for users.
 *
 * This is the shared place for fields and behavior that every user type needs.
 * I kept method names explicit and simple so this is easy to read if you're
 * new to PHP. The intent here is educational: show visibility, static
 * properties, simple validation and a couple of magic methods.
 */
abstract class UserBase
{
    // Role constants make code easier to read and less error-prone.
    public const ROLE_ADMIN = 'admin';
    public const ROLE_CUSTOMER = 'customer';

    // Static counter: counts how many user objects we've created so far.
    protected static int $instanceCount = 0;

    // Common properties every user has.
    protected string $name;
    protected string $email;
    protected string $role;

    /**
     * Construct a user with a name and email. We run simple validation
     * on the email so the rest of the code can assume it's valid.
     */
    public function __construct(string $name, string $email)
    {
        $this->setName($name);
        $this->setEmail($email);
        self::$instanceCount++;
    }

    /** Return how many user instances have been created (static state). */
    public static function getInstanceCount(): int
    {
        return self::$instanceCount;
    }

    // --- Basic getters / setters (encapsulation) ---
    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        // trim to avoid accidental whitespace from user input
        $this->name = trim($name);
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $email = trim($email);
        // Basic validation: FILTER_VALIDATE_EMAIL is good enough for examples.
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            // Throw an exception so callers can handle the error.
            throw new InvalidArgumentException('Invalid email: ' . $email);
        }
        $this->email = $email;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Human-friendly string representation used by echo/print.
     */
    public function __toString(): string
    {
        return sprintf('%s <%s> (%s)', $this->getName(), $this->getEmail(), $this->getRole());
    }

    // --- Small demonstration of magic accessors ---
    // These are here for learning purposes. In production code you might
    // prefer explicit getters/setters everywhere for clarity.
    public function __get(string $name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }

        trigger_error('Undefined property: ' . $name, E_USER_NOTICE);
        return null;
    }

    public function __set(string $name, $value): void
    {
        if (property_exists($this, $name)) {
            $this->$name = $value;
            return;
        }

        trigger_error('Undefined property: ' . $name, E_USER_NOTICE);
    }
}