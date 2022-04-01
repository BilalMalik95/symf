<?php

namespace App\Entity;

use App\Repository\LeadsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LeadsRepository::class)
 */
class Leads
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */

    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lead_name;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Lead_company;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Lead_domain;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $Lead_broadcast_status;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $Lead_created_by;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLeadName(): ?string
    {
        return $this->lead_name;
    }

    public function setLeadName(?string $lead_name): self
    {
        $this->lead_name = $lead_name;

        return $this;
    }

    public function getLeadCompany(): ?string
    {
        return $this->Lead_company;
    }

    public function setLeadCompany(?string $Lead_company): self
    {
        $this->Lead_company = $Lead_company;

        return $this;
    }

    public function getLeadDomain(): ?string
    {
        return $this->Lead_domain;
    }

    public function setLeadDomain(?string $Lead_domain): self
    {
        $this->Lead_domain = $Lead_domain;

        return $this;
    }

    public function getLeadBroadcastStatus(): ?string
    {
        return $this->Lead_broadcast_status;
    }

    public function setLeadBroadcastStatus(?string $Lead_broadcast_status): self
    {
        $this->Lead_broadcast_status = $Lead_broadcast_status;

        return $this;
    }

    public function getLeadCreatedBy(): ?string
    {
        return $this->Lead_created_by;
    }

    public function setLeadCreatedBy(?string $Lead_created_by): self
    {
        $this->Lead_created_by = $Lead_created_by;

        return $this;
    }
}
