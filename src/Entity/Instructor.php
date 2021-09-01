<?php

namespace App\Entity;

use App\Repository\InstructorRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InstructorRepository::class)
 */
class Instructor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="instructors")
     */
    private $inst;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getInst(): ?user
    {
        return $this->inst;
    }

    public function setInst(?user $inst): self
    {
        $this->inst = $inst;

        return $this;
    }
}
