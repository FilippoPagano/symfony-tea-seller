<?php

namespace App\Entity;

use App\Repository\AnalysisResultRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AnalysisResultRepository::class)
 */
class AnalysisResult
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isValid;

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $reasons = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $invalidSellers = [];

    /**
     * @ORM\Column(type="array", nullable=true)
     */
    private $sellers = [];

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIsValid(): ?bool
    {
        return $this->isValid;
    }

    public function setIsValid(bool $isValid): self
    {
        $this->isValid = $isValid;

        return $this;
    }

    public function getReasons(): ?array
    {
        return $this->reasons;
    }

    public function setReasons(?array $reasons): self
    {
        $this->reasons = $reasons;

        return $this;
    }

    public function getInvalidSellers(): ?array
    {
        return $this->invalidSellers;
    }

    public function setInvalidSellers(?array $invalidSellers): self
    {
        $this->invalidSellers = $invalidSellers;

        return $this;
    }

    public function getSellers(): ?array
    {
        return $this->sellers;
    }

    public function setSellers(?array $sellers): self
    {
        $this->sellers = $sellers;

        return $this;
    }
}
