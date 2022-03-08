<?php

namespace App\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandShopRepository;

#[ORM\Entity(repositoryClass: CommandShopRepository::class)]
#[ORM\HasLifecycleCallbacks]
class CommandShop
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'commandShops')]
    #[ORM\JoinColumn(nullable: false)]
    private $user;

    #[ORM\Column(type: 'datetime')]
    private $createdAt;

    #[ORM\Column(type: 'boolean')]
    private $isPayed = false;

    #[ORM\Column(type: 'integer')]
    private $totalPrice;

    #[ORM\OneToOne(mappedBy: 'commandShop', targetEntity: DeliveryAddress::class, cascade: ['persist', 'remove'])]
    private $deliveryAddress;

    #[ORM\OneToMany(mappedBy: 'commandShop', targetEntity: CommandShopLine::class, orphanRemoval: true)]
    private $commandShopLines;

    public function __construct()
    {
        $this->commandShopLines = new ArrayCollection();
    }

    #[ORM\PrePersist]
    public function prePersist()
    {
        if(empty($this->createdAt))
        {
            $this->createdAt = new DateTime();
        }
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getIsPayed(): ?bool
    {
        return $this->isPayed;
    }

    public function setIsPayed(bool $isPayed): self
    {
        $this->isPayed = $isPayed;

        return $this;
    }

    public function getTotalPrice(): ?int
    {
        return $this->totalPrice;
    }

    public function setTotalPrice(int $totalPrice): self
    {
        $this->totalPrice = $totalPrice;

        return $this;
    }

    public function getDeliveryAddress(): ?DeliveryAddress
    {
        return $this->deliveryAddress;
    }

    public function setDeliveryAddress(DeliveryAddress $deliveryAddress): self
    {
        // set the owning side of the relation if necessary
        if ($deliveryAddress->getCommandShop() !== $this) {
            $deliveryAddress->setCommandShop($this);
        }

        $this->deliveryAddress = $deliveryAddress;

        return $this;
    }

    /**
     * @return Collection|CommandShopLine[]
     */
    public function getCommandShopLines(): Collection
    {
        return $this->commandShopLines;
    }

    public function addCommandShopLine(CommandShopLine $commandShopLine): self
    {
        if (!$this->commandShopLines->contains($commandShopLine)) {
            $this->commandShopLines[] = $commandShopLine;
            $commandShopLine->setCommandShop($this);
        }

        return $this;
    }

    public function removeCommandShopLine(CommandShopLine $commandShopLine): self
    {
        if ($this->commandShopLines->removeElement($commandShopLine)) {
            // set the owning side to null (unless already changed)
            if ($commandShopLine->getCommandShop() === $this) {
                $commandShopLine->setCommandShop(null);
            }
        }

        return $this;
    }
}
