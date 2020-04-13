<?php

declare(strict_types=1);

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Embeddable() */
final class IssueId extends UuidBasedIdentity
{
}
