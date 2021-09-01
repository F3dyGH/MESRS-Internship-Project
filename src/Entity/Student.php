<?php

namespace App\Entity;

use App\Repository\StudentRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=StudentRepository::class)
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="students")
     */
    private $student;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?user
    {
        return $this->student;
    }

    public function setStudent(?user $student): self
    {
        $this->student = $student;

        return $this;
    }
}
