<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

/** @ORM\MappedSuperclass */
abstract class UuidBasedIdentity
{
    /** @ORM\Id() @ORM\GeneratedValue(strategy="NONE") @ORM\Column(type="uuid_binary") */
    protected UuidInterface $uuid;

    /** @ORM\Column(type="uuid")  */
    protected UuidInterface $stringValue;

    private function __construct()
    {
    }

    public static function nextId(): self
    {
        return static::fromUuidAsString(
            Uuid::uuid4()->toString()
        );
    }

    private function setValue(UuidInterface $value): self
    {
        $this->stringValue = $value;

        return $this;
    }

    private function setId(UuidInterface $id): self
    {
        $this->uuid = $id;

        return $this;
    }

    public static function fromUuidAsString(string $uuidAsString): self
    {
        if (!Uuid::isValid($uuidAsString)) {
            throw new \InvalidArgumentException('The value does not represent a valid identifier based in Uuid');
        }

        $uuid = Uuid::fromString($uuidAsString);

        return (new static)
            ->setId($uuid)
            ->setValue($uuid);
    }

    public static function fromUuidInterface(UuidInterface $uuid): self
    {
        return (new static)
            ->setId($uuid)
            ->setValue($uuid);
    }

    public function equals(self $other): bool
    {
        return $this->uuid->equals($other->uuid);
    }

    public function toString(): string
    {
        return (string)$this;
    }

    public function __toString()
    {
        return (string)$this->uuid;
    }

    public function id(): UuidInterface
    {
        return $this->uuid;
    }
}
