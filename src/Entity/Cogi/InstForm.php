<?php

namespace App\Entity\Cogi;

use Doctrine\ORM\Mapping as ORM;

/**
 * InstForm
 *
 * @ORM\Table(name="inst_form", indexes={@ORM\Index(name="IDX_57146EF072930994", columns={"inst_id"})})
 * @ORM\Entity
 */
class InstForm
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="speciality", type="string", length=255, nullable=false)
     */
    private $speciality;

    /**
     * @var string
     *
     * @ORM\Column(name="cv", type="string", length=255, nullable=false)
     */
    private $cv;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=false)
     */
    private $date;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updated_at", type="datetime", nullable=false)
     */
    private $updatedAt;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inst_id", referencedColumnName="id")
     * })
     */
    private $inst;

    public function getId(): ?int
    {
        return $this->id;
    }

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    public function getInst(): ?User
    {
        return $this->inst;
    }

    public function setInst(?User $inst): self
    {
        $this->inst = $inst;

        return $this;
    }


}
