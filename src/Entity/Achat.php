<?php

namespace App\Entity;

use App\Repository\AchatRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AchatRepository::class)]
class Achat
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $dateachat = null;


    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: '0')]
    private ?string $numfacture = null;

    #[ORM\OneToMany(mappedBy: 'idAchat', targetEntity: DetailAchat::class)]
    private Collection $detailAchats;

    #[ORM\ManyToOne(inversedBy: 'achats')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Fournisseur $idFournisseur = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $created_at = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $Tva = null;

    #[ORM\Column(type: Types::DECIMAL, precision: 10, scale: 0, nullable: true)]
    private ?string $Remise = null;

    public function __construct()
    {
        $this->detailAchats = new ArrayCollection();

        $timezone = new \DateTimeZone('Asia/Jerusalem'); // Replace with your desired timezone offset (+03:00)
        $now = new \DateTime('now', $timezone);
        $this->created_at = \DateTimeImmutable::createFromFormat('Y-m-d H:i:s', $now->format('Y-m-d H:i:s'));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateachat(): ?\DateTimeInterface
    {
        return $this->dateachat;
    }

    public function setDateachat(\DateTimeInterface $dateachat): static
    {
        $this->dateachat = $dateachat;

        return $this;
    }


    public function getNumfacture(): ?string
    {
        return $this->numfacture;
    }

    public function setNumfacture(string $numfacture): static
    {
        $this->numfacture = $numfacture;

        return $this;
    }

    /**
     * @return Collection<int, DetailAchat>
     */
    public function getDetailAchats(): Collection
    {
        return $this->detailAchats;
    }

    public function addDetailAchat(DetailAchat $detailAchat): static
    {
        if (!$this->detailAchats->contains($detailAchat)) {
            $this->detailAchats->add($detailAchat);
            $detailAchat->setIdAchat($this);
        }

        return $this;
    }

    public function removeDetailAchat(DetailAchat $detailAchat): static
    {
        if ($this->detailAchats->removeElement($detailAchat)) {
            // set the owning side to null (unless already changed)
            if ($detailAchat->getIdAchat() === $this) {
                $detailAchat->setIdAchat(null);
            }
        }

        return $this;
    }

    public function getIdFournisseur(): ?Fournisseur
    {
        return $this->idFournisseur;
    }

    public function setIdFournisseur(?Fournisseur $idFournisseur): static
    {
        $this->idFournisseur = $idFournisseur;

        return $this;
    }

    
    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }
    
    public function setCreatedAt(\DateTimeImmutable $created_at): static
    {
        $this->created_at = $created_at;
        
        return $this;
    }

    
    public function getTva(): ?string
    {
        return $this->Tva;
    }

    public function setTva(string $Tva): static
    {
        $this->Tva = $Tva;
        
        return $this;
    }

    public function getRemise(): ?string
    {
        return $this->Remise;
    }
    
    public function setRemise(string $Remise): static
    {
        $this->Remise = $Remise;

        return $this;
    }

    public function soustotal(): float
    {
    $soustotal = 0.0;

        foreach ($this->getDetailAchats() as $detailAchat) {
            $soustotal += $detailAchat->getPrixunitaire() * $detailAchat->getQuantite();
        }
        return $soustotal;
    }

    public function total(): float
    {
        $total = 0.0;
        $tva = 0.0;
        $remise = 0.0;

        foreach ($this->getDetailAchats() as $detailAchat) {
            $montant = $detailAchat->getPrixunitaire() * $detailAchat->getQuantite();
            $tva += $montant * ($this->getTva() / 100);
            $remise += $montant * ($this->getRemise() / 100);
            $total += $montant;
        }

        $total += $tva;
        $total -= $remise;

        return $total;
    }

}
