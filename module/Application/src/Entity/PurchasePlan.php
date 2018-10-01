<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Application\Model\EntityBase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\ClassMetadata;

/*
 * Переназначаем типы для PostgreSQL
 */
Type::overrideType('datetime', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('datetimetz', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('time', 'Doctrine\DBAL\Types\VarDateTimeType');


/**
 * PurchasePlan
 *
 * @ORM\Table(name="purchase_plan", uniqueConstraints={@ORM\UniqueConstraint(name="purchase_plan_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="IDX_ADE9931E81398E09", columns={"customer"}), @ORM\Index(name="IDX_ADE9931E89A85CC3", columns={"placer"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
 */
class PurchasePlan extends EntityBase
{

  /**
   * @ORM\OneToMany(targetEntity="\Application\Entity\PurchasePlanItems", mappedBy="plan", cascade={"persist"})
   * @ORM\JoinColumn(name="id", referencedColumnName="planid")
   */
  protected $planitems;

  /**
   * @ORM\ManyToOne(targetEntity="\Application\Entity\Contragents", inversedBy="plans")
   * @ORM\JoinColumn(name="customer", referencedColumnName="id")
   */
  protected $contragent;

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="purchase_plan_id_seq", allocationSize=1, initialValue=1)
   */
  protected $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="plantype", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $plantype;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="createdatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $createdatetime;

  /**
   * @var string|null
   *
   * @ORM\Column(name="urleis", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $urleis;

  /**
   * @var string|null
   *
   * @ORM\Column(name="registrationnumber", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $registrationnumber;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="startdate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $startdate;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="enddate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $enddate;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="approvedate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $approvedate;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="publicationdatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $publicationdatetime;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="isdigitform", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $isdigitform;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="summsizech15", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $summsizech15;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="isimportedfromvsrz", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $isimportedfromvsrz;

  /**
   * @var int|null
   *
   * @ORM\Column(name="version", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $version;

  /**
   * @var string|null
   *
   * @ORM\Column(name="modificationdescription", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $modificationdescription;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="usenewclassifiers", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $usenewclassifiers;

  /**
   * @var string|null
   *
   * @ORM\Column(name="excludevolume", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $excludevolume;

  /**
   * @var string|null
   *
   * @ORM\Column(name="volumesmb", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $volumesmb;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolume", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $annualvolume;

  /**
   * @var string|null
   *
   * @ORM\Column(name="percentsmb", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $percentsmb;

  /**
   * @var int|null
   *
   * @ORM\Column(name="reportingyear", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $reportingyear;

  /**
   * @var string|null
   *
   * @ORM\Column(name="previousyearannualvolume", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $previousyearannualvolume;

  /**
   * @var string|null
   *
   * @ORM\Column(name="previousyearannualvolumehitech", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $previousyearannualvolumehitech;

  /**
   * @var string|null
   *
   * @ORM\Column(name="previousyearannualvolumehitechsmb", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $previousyearannualvolumehitechsmb;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsumm", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $annualvolumehitechsumm;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechincrease", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $annualvolumehitechincrease;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechpercent", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $annualvolumehitechpercent;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsmbsumm", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $annualvolumehitechsmbsumm;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsmbincrease", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $annualvolumehitechsmbincrease;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsmbpercent", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $annualvolumehitechsmbpercent;

  /**
   * @var string|null
   *
   * @ORM\Column(name="guid", type="guid", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $guid;

  /**
   * @var string|null
   *
   * @ORM\Column(name="additionalinfo", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $additionalinfo;

  /**
   * @var \Application\Entity\Contragents
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Contragents", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="customer", referencedColumnName="id", nullable=true)
   * })
   */
  protected $customer;

  /**
   * @var \Application\Entity\Contragents
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Contragents", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="placer", referencedColumnName="id", nullable=true)
   * })
   */
  protected $placer;

  /**
   * PurchasePlan constructor.
   * @param EntityManagerInterface $em
   * @param ClassMetadata $class
   */
  public function __construct(EntityManagerInterface $em, ClassMetadata $class)
  {
    parent::__construct($em, $class);
    $this->planitems = new ArrayCollection();
  }

  /**
   * Set createdatetime.
   *
   * @param \DateTime|null $createdatetime
   *
   * @return PurchasePlan
   */
  public function setCreatedatetime($createdatetime = null)
  {
    if (!empty($createdatetime) && is_string($createdatetime)) {
      $createdatetime = new \DateTime(date('c', strtotime($createdatetime)));
    }

    $this->createdatetime = $createdatetime;

    return $this;
  }

  /**
   * Set startdate.
   *
   * @param \DateTime|null $startdate
   *
   * @return PurchasePlan
   */
  public function setStartdate($startdate = null)
  {
    if (!empty($startdate) && is_string($startdate)) {
      $startdate = new \DateTime(date('Y-m-d', strtotime($startdate)));
    }

    $this->startdate = $startdate;

    return $this;
  }

  /**
   * Set enddate.
   *
   * @param \DateTime|null $enddate
   *
   * @return PurchasePlan
   */
  public function setEnddate($enddate = null)
  {
    if (!empty($enddate) && is_string($enddate)) {
      $enddate = new \DateTime(date('Y-m-d', strtotime($enddate)));
    }

    $this->enddate = $enddate;

    return $this;
  }

  /**
   * Set approvedate.
   *
   * @param \DateTime|null $approvedate
   *
   * @return PurchasePlan
   */
  public function setApprovedate($approvedate = null)
  {
    if (!empty($approvedate) && is_string($approvedate)) {
      $approvedate = new \DateTime(date('Y-m-d', strtotime($approvedate)));
    }

    $this->approvedate = $approvedate;

    return $this;
  }

  /**
   * Set publicationdatetime.
   *
   * @param \DateTime|null $publicationdatetime
   *
   * @return PurchasePlan
   */
  public function setPublicationdatetime($publicationdatetime = null)
  {
    if (!empty($publicationdatetime) && is_string($publicationdatetime)) {
      $publicationdatetime = new \DateTime(date('Y-m-d', strtotime($publicationdatetime)));
    }

    $this->publicationdatetime = $publicationdatetime;

    return $this;
  }

  /**
   * Set customer.
   *
   * @param \Application\Entity\Contragents|null $customer
   *
   * @return PurchasePlan
   */
  public function setCustomer(\Application\Entity\Contragents $customer = null)
  {
    $this->customer = $customer;

    return $this;
  }

  /**
   * Get customer.
   *
   * @return \Application\Entity\Contragents|null
   */
  public function getCustomer()
  {
    return $this->customer;
  }

  /**
   * Set placer.
   *
   * @param \Application\Entity\Contragents|null $placer
   *
   * @return PurchasePlan
   */
  public function setPlacer(\Application\Entity\Contragents $placer = null)
  {
    $this->placer = $placer;

    return $this;
  }

  /**
   * Get placer.
   *
   * @return \Application\Entity\Contragents|null
   */
  public function getPlacer()
  {
    return $this->placer;
  }

  /**
   * Получаем коллекцию позиций плана
   *
   * @return ArrayCollection
   */
  public function getPlanitems()
  {
    return $this->planitems;
  }

  /**
   * Добавляем в коллекцию позицию
   *
   * @param PurchasePlanItems|null $planitems
   * @return $this
   */
  public function setPlanitems(\Application\Entity\PurchasePlanItems $planitems = null)
  {
    $this->planitems[] = $planitems;

    return $this;
  }

}
