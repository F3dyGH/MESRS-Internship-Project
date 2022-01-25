<?php

namespace App\Entity\Cogi;

use Doctrine\ORM\Mapping as ORM;

/**
 * Instructor
 *
 * @ORM\Table(name="instructor", indexes={@ORM\Index(name="IDX_31FC43DD72930994", columns={"inst_id"})})
 * @ORM\Entity
 */
class Instructor
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
