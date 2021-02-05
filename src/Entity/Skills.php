<?php

namespace App\Entity;

use App\Repository\SkillsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SkillsRepository::class)
 */
class Skills
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\Column(type="integer")
     */
    private $note;

    /**
     * @ORM\ManyToMany(targetEntity=Competences::class, mappedBy="skills")
     */
    private $competences;

    /**
     * @ORM\ManyToMany(targetEntity=Realisations::class, mappedBy="skills")
     */
    private $realisations;

    public function __construct()
    {
        $this->competences = new ArrayCollection();
        $this->realisations = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getNote(): ?int
    {
        return $this->note;
    }

    public function setNote(int $note): self
    {
        $this->note = $note;

        return $this;
    }

    /**
     * @return Collection|Competences[]
     */
    public function getCompetences(): Collection
    {
        return $this->competences;
    }

    public function addCompetence(Competences $competence): self
    {
        if (!$this->competences->contains($competence)) {
            $this->competences[] = $competence;
            $competence->addSkill($this);
        }

        return $this;
    }

    public function removeCompetence(Competences $competence): self
    {
        if ($this->competences->removeElement($competence)) {
            $competence->removeSkill($this);
        }

        return $this;
    }

    /**
     * @return Collection|Realisations[]
     */
    public function getRealisations(): Collection
    {
        return $this->realisations;
    }

    public function addRealisation(Realisations $realisation): self
    {
        if (!$this->realisations->contains($realisation)) {
            $this->realisations[] = $realisation;
            $realisation->addSkill($this);
        }

        return $this;
    }

    public function removeRealisation(Realisations $realisation): self
    {
        if ($this->realisations->removeElement($realisation)) {
            $realisation->removeSkill($this);
        }

        return $this;
    }
}
