<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class RaspPiData
 *
 * @package App\Entity
 *
 * @ORM\Entity
 * @ORM\Table(name="rasp_pi_data")
 */
class RaspPiData
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var string|null
     *
     * @ORM\Column(name="name", type="string")
     * @Assert\Unique()
     */
    private $name;

    /**
     * @var float|null
     *
     * @ORM\Column(name="cpu_temp", type="float", nullable=true)
     */
    private $cpuTemp;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string|null $name
     *
     * @return RaspPiData
     */
    public function setName(?string $name): RaspPiData
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getCpuTemp(): ?float
    {
        return $this->cpuTemp;
    }

    /**
     * @param float|null $cpuTemp
     *
     * @return RaspPiData
     */
    public function setCpuTemp(?float $cpuTemp): RaspPiData
    {
        $this->cpuTemp = $cpuTemp;
        return $this;
    }
}