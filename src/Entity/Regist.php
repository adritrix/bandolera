<?php

namespace App\Entity;

use App\Repository\RegistRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RegistRepository::class)]
class Regist
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: Message::class, inversedBy: 'regists')]
    #[ORM\JoinColumn(nullable: false)]
    private $message;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'regists')]
    #[ORM\JoinColumn(nullable: false)]
    private $reciver;

    #[ORM\Column(type: 'boolean')]
    private $isread;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMessage(): ?Message
    {
        return $this->message;
    }

    public function setMessage(?Message $message): self
    {
        $this->message = $message;

        return $this;
    }

    public function getReciver(): ?User
    {
        return $this->reciver;
    }

    public function setReciver(?User $reciver): self
    {
        $this->reciver = $reciver;

        return $this;
    }

    public function getIsread(): ?bool
    {
        return $this->isread;
    }

    public function setIsread(bool $isread): self
    {
        $this->isread = $isread;

        return $this;
    }
}
