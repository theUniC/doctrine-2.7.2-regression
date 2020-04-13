<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity(repositoryClass="App\Repository\IssueRepository") */
class Issue
{
    /** @ORM\Embedded(class=IssueId::class) */
    private IssueId $id;

    /** @ORM\Column(type="string", length=255) */
    private string $title;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }
}
