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
     
     * @ORM\Column(type="string", length=50)
     */
    private $NSC;

  
   

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\ManyToOne(targetEntity=Classroom::class, inversedBy="students")
     * @ORM\JoinColumn(nullable=false)
     */
    private $classroom;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $creation_date;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $enabled;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $date_naissance;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $moyenne;

  
    

    public function getNSC(): ?string
    {
        return $this->NSC;
    }

    public function setNSC(string $NSC): self
    {
        $this->NSC = $NSC;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getClassroom(): ?Classroom
    {
        return $this->classroom;
    }

    public function setClassroom(?Classroom $classroom): self
    {
        $this->classroom = $classroom;

        return $this;
    }

    public function __toString()
    {
        return(string)$this->getEmail();
    }

    public function getCreation_date(): ?\DateTimeInterface
    {
        return $this->creation_date;
    }

    public function setCreation_date(?\DateTimeInterface $creation_date): self
    {
        $this->creation_date = $creation_date;

        return $this;
    }

    public function getEnabled(): ?bool
    {
        return $this->enabled;
    }

    public function setEnabled(?bool $enabled): self
    {
        $this->enabled = $enabled;

        return $this;
    }

    public function getDate_naissance(): ?\DateTimeInterface
    {
        return $this->date_naissance;
    }

    public function setDate_naissance(?\DateTimeInterface $date_naissance): self
    {
        $this->date_naissance = $date_naissance;

        return $this;
    }

    public function getMoyenne(): ?float
    {
        return $this->moyenne;
    }

    public function setMoyenne(?float $moyenne): self
    {
        $this->moyenne = $moyenne;

        return $this;
    }
}
