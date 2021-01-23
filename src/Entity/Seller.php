<?php

declare(strict_types=1);

namespace App\Entity;

use App\Repository\SellerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * Seller.
 *
 * @ORM\Entity(repositoryClass=SellerRepository::class)
 */
class Seller
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private string $name;

    /**
     * @ORM\Column(type="string", length=255)
	  * Alias seller_type
	  * either PUBLISHER, INTERMEDIARY, or BOTH.
     */
    private string $type;

    /**
     * @ORM\Column(name="seller_id", type="string")
     */
    private string $sellerId;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private ?string $comment;

    /**
     * @ORM\Column(name="is_confidential", type="integer", nullable=true)
	  * Doctrine does not support defaults... interesting
     */
    private ?int $isConfidential;

    /**
     * @ORM\Column(name="is_passthrough", type="integer", nullable=true)
     */
    private ?int $isPassthrough;

    /**
     * @ORM\Column(name="domain", type="string", nullable=true)
     */
    private ?string $domain;
	 
    /**
     * Constructor.
     */
    public function __construct(string $name, string $sellerId, string $type, ?string $comment = null, ?int $isConfidential = 0, ?int $isPassthrough = 0, ?string $domain = null)
    {
        $this->name     = $name;
        $this->sellerId = $sellerId;
        $this->type = $type;
        $this->comment  = $comment;
        $this->isConfidential  = $isConfidential;
        $this->isPassthrough  = $isPassthrough;
        $this->domain  = $domain;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getSellerId(): string
    {
        return $this->sellerId;
    }

    public function getIsConfidential(): ?int
    {
        return $this->isConfidential;
    }

    public function getComment(): ?string
    {
        return $this->comment;
    }

    public function getIsPassthrough(): ?int
    {
        return $this->isPassthrough;
    }

    public function getDomain(): ?string
    {
        return $this->domain;
    }
	 
    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setType(string $type)
    {
        $this->type = $type;
    }

    public function setSellerId(string $sellerId)
    {
        $this->sellerId = $sellerId;
    }

    public function setIsConfidential(int $isConfidential)
    {
        $this->isConfidential = $isConfidential;
    }

    public function setComment(string $comment)
    {
        $this->comment = comment;
    }

    public function setIsPassthrough(int $isPassthrough)
    {
        $this->isPassthrough = $isPassthrough;
    }

    public function setDomain(string $domain)
    {
        $this->domain = $domain;
    }
}
