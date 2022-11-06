<?php

namespace App\Entity;

use App\Repository\ImageRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

#[ORM\Entity(repositoryClass: ImageRepository::class)]
#[Vich\Uploadable]
class Image
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Vich\UploadableField(mapping:'images', fileNameProperty:"alt")]
    private ?File $imageFile = null;

    #[ORM\Column(length: 255)]
    private ?string $alt = null;

    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updated_at = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * Get the value of alt
     */ 
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * Set the value of alt
     *
     * @return  self
     */ 
    public function setAlt(?string $alt): void
    {
        $this->alt = $alt;
    }

    /**
     * Get the value of imageFile
     */ 
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * Set the value of imageFile
     *
     * @return  self
     */ 
    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if(null !== $imageFile){
            $this->updated_at = new \DateTimeImmutable();
        }
    }

    public function getUpdatedAt(): ?\DateTime
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTime $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
