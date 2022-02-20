<?php

namespace App\Entity;

use App\Repository\MessageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MessageRepository::class)]
class Message
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $subject;

    #[ORM\Column(type: 'string', length: 255)]
    private $body;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'messages')]
    #[ORM\JoinColumn(nullable: false)]
    private $sender;

    #[ORM\OneToMany(mappedBy: 'message', targetEntity: Regist::class, orphanRemoval: true)]
    private $regists;

    public function __construct()
    {
        $this->regists = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getBody(): ?string
    {
        return $this->body;
    }

    public function setBody(string $body): self
    {
        $this->body = $body;

        return $this;
    }

    public function getSender(): ?User
    {
        return $this->sender;
    }

    public function setSender(?User $sender): self
    {
        $this->sender = $sender;

        return $this;
    }

    /**
     * @return Collection<int, Regist>
     */
    public function getRegists(): Collection
    {
        return $this->regists;
    }

    public function addRegist(Regist $regist): self
    {
        if (!$this->regists->contains($regist)) {
            $this->regists[] = $regist;
            $regist->setMessage($this);
        }

        return $this;
    }

    public function removeRegist(Regist $regist): self
    {
        if ($this->regists->removeElement($regist)) {
            // set the owning side to null (unless already changed)
            if ($regist->getMessage() === $this) {
                $regist->setMessage(null);
            }
        }

        return $this;
    }
}
