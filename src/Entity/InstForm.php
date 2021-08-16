<?php

namespace App\Entity;

use App\Repository\InstFormRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstFormRepository::class)
 * @Vich\Uploadable
 */
class InstForm
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     */
    private $inst;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $speciality;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $cv;

    /**
     * @Vich\UploadableField(mapping="instform", fileNameProperty="cv")
     * @var File
     */
    private $cvFile;


    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="datetime")
     * @var \DateTime
     */
    private $updatedAt;

    public function __construct()
    {
        $this->inst = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInst(): ?Category
    {
        return $this->inst;
    }

    public function setInst(?User $inst): self
    {
        $this->inst = $inst;

        return $this;
    }
   /* /**
     * @return Collection|User[]

    public function getInst(): Collection
    {
        return $this->inst;
    }

    public function addInst(User $inst): self
    {
        if (!$this->inst->contains($inst)) {
            $this->inst[] = $inst;
            $inst->setInstForm($this);
        }

        return $this;
    }

    public function removeInst(User $inst): self
    {
        if ($this->inst->removeElement($inst)) {
            // set the owning side to null (unless already changed)
            if ($inst->getInstForm() === $this) {
                $inst->setInstForm(null);
            }
        }

        return $this;
    }*/

    public function getSpeciality(): ?string
    {
        return $this->speciality;
    }

    public function setSpeciality(string $speciality): self
    {
        $this->speciality = $speciality;

        return $this;
    }

    public function getCv(): ?string
    {
        return $this->cv;
    }

    public function setCv(string $cv): self
    {
        $this->cv = $cv;

        return $this;
    }

    public function setCvFile(File $cv = null)
    {
        $this->cvFile = $cv;

        // VERY IMPORTANT:
        // It is required that at least one field changes if you are using Doctrine,
        // otherwise the event listeners won't be called and the file is lost
        if ($cv) {
            // if 'updatedAt' is not defined in your entity, use another property
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getCvFile(): ?File
    {
        return $this->cvFile;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }
}
