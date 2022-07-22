<?php

namespace App\Entity;

use App\Repository\TraderRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation\UploadableField;

#[ORM\Table(name: 'Traders')]
#[ORM\Entity(repositoryClass: TraderRepository::class)]
class Trader
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private int $id;

    #[ORM\Column(type: 'boolean')]
    private bool $published;

    #[ORM\Column(type: 'string', length: 255)]
    private string $fullName;

    #[ORM\Column(type: 'string', length: 255)]
    private string $characterType;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private string $uriName;

    #[ORM\Column(type: 'string', length: 255, nullable: false)]
    private ?string $imageName;

//    #[UploadableField(mapping: 'traders', fileNameProperty: 'image_name')]
//    private ?File $fileName;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): self
    {
        $this->published = $published;

        return $this;
    }

    public function getFullName(): ?string
    {
        return $this->fullName;
    }

    public function setFullName(string $fullName): self
    {
        $this->fullName = $fullName;

        return $this;
    }

    public function getCharacterType(): ?string
    {
        return $this->characterType;
    }

    public function setCharacterType(string $characterType): self
    {
        $this->characterType = $characterType;

        return $this;
    }

    /**
     * @return string
     */
    public function getUriName(): string
    {
        return $this->uriName;
    }

    /**
     * @param string $uriName
     * @return Trader
     */
    public function setUriName(string $uriName): self
    {
        $this->uriName = $uriName;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    /**
     * @param string|null $imageName
     * @return Trader
     */
    public function setImageName(?string $imageName): self
    {
        $this->imageName = $imageName;

        return $this;
    }
}
