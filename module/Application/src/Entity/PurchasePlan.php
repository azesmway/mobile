<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Application\Model\EntityBase;

/*
 * Переназночаем типы для PostgreSQL
 */

Type::overrideType('datetime', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('datetimetz', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('time', 'Doctrine\DBAL\Types\VarDateTimeType');


/**
 * PurchasePlan
 *
 * @ORM\Table(name="purchase_plan", uniqueConstraints={@ORM\UniqueConstraint(name="purchase_plan_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="IDX_ADE9931E81398E09", columns={"customer"}), @ORM\Index(name="IDX_ADE9931E89A85CC3", columns={"placer"})})
 * @ORM\Entity
 */
class PurchasePlan extends EntityBase
{

  /**
   * @ORM\OneToMany(targetEntity="\Application\Entity\PurchasePlanItems", mappedBy="planid", cascade={"persist"})
   * @ORM\JoinColumn(name="id", referencedColumnName="planid")
   */
  private $planitems;

  /**
   * @ORM\ManyToOne(targetEntity="\Application\Entity\Contragents", inversedBy="plans")
   * @ORM\JoinColumn(name="customer", referencedColumnName="id")
   */
  private $contragent;

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="purchase_plan_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="plantype", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $plantype;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="createdatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  private $createdatetime;

  /**
   * @var string|null
   *
   * @ORM\Column(name="urleis", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $urleis;

  /**
   * @var string|null
   *
   * @ORM\Column(name="registrationnumber", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $registrationnumber;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="startdate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  private $startdate;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="enddate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  private $enddate;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="approvedate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  private $approvedate;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="publicationdatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  private $publicationdatetime;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="isdigitform", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $isdigitform;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="summsizech15", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $summsizech15;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="isimportedfromvsrz", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $isimportedfromvsrz;

  /**
   * @var int|null
   *
   * @ORM\Column(name="version", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $version;

  /**
   * @var string|null
   *
   * @ORM\Column(name="modificationdescription", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $modificationdescription;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="usenewclassifiers", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $usenewclassifiers;

  /**
   * @var string|null
   *
   * @ORM\Column(name="excludevolume", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $excludevolume;

  /**
   * @var string|null
   *
   * @ORM\Column(name="volumesmb", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $volumesmb;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolume", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $annualvolume;

  /**
   * @var string|null
   *
   * @ORM\Column(name="percentsmb", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $percentsmb;

  /**
   * @var int|null
   *
   * @ORM\Column(name="reportingyear", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $reportingyear;

  /**
   * @var string|null
   *
   * @ORM\Column(name="previousyearannualvolume", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $previousyearannualvolume;

  /**
   * @var string|null
   *
   * @ORM\Column(name="previousyearannualvolumehitech", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $previousyearannualvolumehitech;

  /**
   * @var string|null
   *
   * @ORM\Column(name="previousyearannualvolumehitechsmb", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $previousyearannualvolumehitechsmb;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsumm", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $annualvolumehitechsumm;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechincrease", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $annualvolumehitechincrease;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechpercent", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $annualvolumehitechpercent;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsmbsumm", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $annualvolumehitechsmbsumm;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsmbincrease", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $annualvolumehitechsmbincrease;

  /**
   * @var string|null
   *
   * @ORM\Column(name="annualvolumehitechsmbpercent", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $annualvolumehitechsmbpercent;

  /**
   * @var string|null
   *
   * @ORM\Column(name="guid", type="guid", precision=0, scale=0, nullable=true, unique=false)
   */
  private $guid;

  /**
   * @var string|null
   *
   * @ORM\Column(name="additionalinfo", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $additionalinfo;

  /**
   * @var \Application\Entity\Contragents
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Contragents", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="customer", referencedColumnName="id", nullable=true)
   * })
   */
  private $customer;

  /**
   * @var \Application\Entity\Contragents
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Contragents", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="placer", referencedColumnName="id", nullable=true)
   * })
   */
  private $placer;

  /**
   * PurchasePlan constructor.
   */
  public function __construct()
  {
    $this->planitems = new ArrayCollection();
  }

  /**
   * Get id.
   *
   * @return int
   */
  public function getId()
  {
    return $this->id;
  }

  /**
   * Set plantype.
   *
   * @param string|null $plantype
   *
   * @return PurchasePlan
   */
  public function setPlantype($plantype = null)
  {
    $this->plantype = $plantype;

    return $this;
  }

  /**
   * Get plantype.
   *
   * @return string|null
   */
  public function getPlantype()
  {
    return $this->plantype;
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
   * Get createdatetime.
   *
   * @return \DateTime|null
   */
  public function getCreatedatetime()
  {
    return $this->createdatetime;
  }

  /**
   * Set urleis.
   *
   * @param string|null $urleis
   *
   * @return PurchasePlan
   */
  public function setUrleis($urleis = null)
  {
    $this->urleis = $urleis;

    return $this;
  }

  /**
   * Get urleis.
   *
   * @return string|null
   */
  public function getUrleis()
  {
    return $this->urleis;
  }

  /**
   * Set registrationnumber.
   *
   * @param string|null $registrationnumber
   *
   * @return PurchasePlan
   */
  public function setRegistrationnumber($registrationnumber = null)
  {
    $this->registrationnumber = $registrationnumber;

    return $this;
  }

  /**
   * Get registrationnumber.
   *
   * @return string|null
   */
  public function getRegistrationnumber()
  {
    return $this->registrationnumber;
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
   * Get startdate.
   *
   * @return \DateTime|null
   */
  public function getStartdate()
  {
    return $this->startdate;
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
   * Get enddate.
   *
   * @return \DateTime|null
   */
  public function getEnddate()
  {
    return $this->enddate;
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
   * Get approvedate.
   *
   * @return \DateTime|null
   */
  public function getApprovedate()
  {
    return $this->approvedate;
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
   * Get publicationdatetime.
   *
   * @return \DateTime|null
   */
  public function getPublicationdatetime()
  {
    return $this->publicationdatetime;
  }

  /**
   * Set isdigitform.
   *
   * @param bool|null $isdigitform
   *
   * @return PurchasePlan
   */
  public function setIsdigitform($isdigitform = null)
  {
    $this->isdigitform = $isdigitform;

    return $this;
  }

  /**
   * Get isdigitform.
   *
   * @return bool|null
   */
  public function getIsdigitform()
  {
    return $this->isdigitform;
  }

  /**
   * Set summsizech15.
   *
   * @param bool|null $summsizech15
   *
   * @return PurchasePlan
   */
  public function setSummsizech15($summsizech15 = null)
  {
    $this->summsizech15 = $summsizech15;

    return $this;
  }

  /**
   * Get summsizech15.
   *
   * @return bool|null
   */
  public function getSummsizech15()
  {
    return $this->summsizech15;
  }

  /**
   * Set isimportedfromvsrz.
   *
   * @param bool|null $isimportedfromvsrz
   *
   * @return PurchasePlan
   */
  public function setIsimportedfromvsrz($isimportedfromvsrz = null)
  {
    $this->isimportedfromvsrz = $isimportedfromvsrz;

    return $this;
  }

  /**
   * Get isimportedfromvsrz.
   *
   * @return bool|null
   */
  public function getIsimportedfromvsrz()
  {
    return $this->isimportedfromvsrz;
  }

  /**
   * Set version.
   *
   * @param int|null $version
   *
   * @return PurchasePlan
   */
  public function setVersion($version = null)
  {
    $this->version = $version;

    return $this;
  }

  /**
   * Get version.
   *
   * @return int|null
   */
  public function getVersion()
  {
    return $this->version;
  }

  /**
   * Set modificationdescription.
   *
   * @param string|null $modificationdescription
   *
   * @return PurchasePlan
   */
  public function setModificationdescription($modificationdescription = null)
  {
    $this->modificationdescription = $modificationdescription;

    return $this;
  }

  /**
   * Get modificationdescription.
   *
   * @return string|null
   */
  public function getModificationdescription()
  {
    return $this->modificationdescription;
  }

  /**
   * Set usenewclassifiers.
   *
   * @param bool|null $usenewclassifiers
   *
   * @return PurchasePlan
   */
  public function setUsenewclassifiers($usenewclassifiers = null)
  {
    $this->usenewclassifiers = $usenewclassifiers;

    return $this;
  }

  /**
   * Get usenewclassifiers.
   *
   * @return bool|null
   */
  public function getUsenewclassifiers()
  {
    return $this->usenewclassifiers;
  }

  /**
   * Set excludevolume.
   *
   * @param string|null $excludevolume
   *
   * @return PurchasePlan
   */
  public function setExcludevolume($excludevolume = null)
  {
    $this->excludevolume = $excludevolume;

    return $this;
  }

  /**
   * Get excludevolume.
   *
   * @return string|null
   */
  public function getExcludevolume()
  {
    return $this->excludevolume;
  }

  /**
   * Set volumesmb.
   *
   * @param string|null $volumesmb
   *
   * @return PurchasePlan
   */
  public function setVolumesmb($volumesmb = null)
  {
    $this->volumesmb = $volumesmb;

    return $this;
  }

  /**
   * Get volumesmb.
   *
   * @return string|null
   */
  public function getVolumesmb()
  {
    return $this->volumesmb;
  }

  /**
   * Set annualvolume.
   *
   * @param string|null $annualvolume
   *
   * @return PurchasePlan
   */
  public function setAnnualvolume($annualvolume = null)
  {
    $this->annualvolume = $annualvolume;

    return $this;
  }

  /**
   * Get annualvolume.
   *
   * @return string|null
   */
  public function getAnnualvolume()
  {
    return $this->annualvolume;
  }

  /**
   * Set percentsmb.
   *
   * @param string|null $percentsmb
   *
   * @return PurchasePlan
   */
  public function setPercentsmb($percentsmb = null)
  {
    $this->percentsmb = $percentsmb;

    return $this;
  }

  /**
   * Get percentsmb.
   *
   * @return string|null
   */
  public function getPercentsmb()
  {
    return $this->percentsmb;
  }

  /**
   * Set reportingyear.
   *
   * @param int|null $reportingyear
   *
   * @return PurchasePlan
   */
  public function setReportingyear($reportingyear = null)
  {
    $this->reportingyear = $reportingyear;

    return $this;
  }

  /**
   * Get reportingyear.
   *
   * @return int|null
   */
  public function getReportingyear()
  {
    return $this->reportingyear;
  }

  /**
   * Set previousyearannualvolume.
   *
   * @param string|null $previousyearannualvolume
   *
   * @return PurchasePlan
   */
  public function setPreviousyearannualvolume($previousyearannualvolume = null)
  {
    $this->previousyearannualvolume = $previousyearannualvolume;

    return $this;
  }

  /**
   * Get previousyearannualvolume.
   *
   * @return string|null
   */
  public function getPreviousyearannualvolume()
  {
    return $this->previousyearannualvolume;
  }

  /**
   * Set previousyearannualvolumehitech.
   *
   * @param string|null $previousyearannualvolumehitech
   *
   * @return PurchasePlan
   */
  public function setPreviousyearannualvolumehitech($previousyearannualvolumehitech = null)
  {
    $this->previousyearannualvolumehitech = $previousyearannualvolumehitech;

    return $this;
  }

  /**
   * Get previousyearannualvolumehitech.
   *
   * @return string|null
   */
  public function getPreviousyearannualvolumehitech()
  {
    return $this->previousyearannualvolumehitech;
  }

  /**
   * Set previousyearannualvolumehitechsmb.
   *
   * @param string|null $previousyearannualvolumehitechsmb
   *
   * @return PurchasePlan
   */
  public function setPreviousyearannualvolumehitechsmb($previousyearannualvolumehitechsmb = null)
  {
    $this->previousyearannualvolumehitechsmb = $previousyearannualvolumehitechsmb;

    return $this;
  }

  /**
   * Get previousyearannualvolumehitechsmb.
   *
   * @return string|null
   */
  public function getPreviousyearannualvolumehitechsmb()
  {
    return $this->previousyearannualvolumehitechsmb;
  }

  /**
   * Set annualvolumehitechsumm.
   *
   * @param string|null $annualvolumehitechsumm
   *
   * @return PurchasePlan
   */
  public function setAnnualvolumehitechsumm($annualvolumehitechsumm = null)
  {
    $this->annualvolumehitechsumm = $annualvolumehitechsumm;

    return $this;
  }

  /**
   * Get annualvolumehitechsumm.
   *
   * @return string|null
   */
  public function getAnnualvolumehitechsumm()
  {
    return $this->annualvolumehitechsumm;
  }

  /**
   * Set annualvolumehitechincrease.
   *
   * @param string|null $annualvolumehitechincrease
   *
   * @return PurchasePlan
   */
  public function setAnnualvolumehitechincrease($annualvolumehitechincrease = null)
  {
    $this->annualvolumehitechincrease = $annualvolumehitechincrease;

    return $this;
  }

  /**
   * Get annualvolumehitechincrease.
   *
   * @return string|null
   */
  public function getAnnualvolumehitechincrease()
  {
    return $this->annualvolumehitechincrease;
  }

  /**
   * Set annualvolumehitechpercent.
   *
   * @param string|null $annualvolumehitechpercent
   *
   * @return PurchasePlan
   */
  public function setAnnualvolumehitechpercent($annualvolumehitechpercent = null)
  {
    $this->annualvolumehitechpercent = $annualvolumehitechpercent;

    return $this;
  }

  /**
   * Get annualvolumehitechpercent.
   *
   * @return string|null
   */
  public function getAnnualvolumehitechpercent()
  {
    return $this->annualvolumehitechpercent;
  }

  /**
   * Set annualvolumehitechsmbsumm.
   *
   * @param string|null $annualvolumehitechsmbsumm
   *
   * @return PurchasePlan
   */
  public function setAnnualvolumehitechsmbsumm($annualvolumehitechsmbsumm = null)
  {
    $this->annualvolumehitechsmbsumm = $annualvolumehitechsmbsumm;

    return $this;
  }

  /**
   * Get annualvolumehitechsmbsumm.
   *
   * @return string|null
   */
  public function getAnnualvolumehitechsmbsumm()
  {
    return $this->annualvolumehitechsmbsumm;
  }

  /**
   * Set annualvolumehitechsmbincrease.
   *
   * @param string|null $annualvolumehitechsmbincrease
   *
   * @return PurchasePlan
   */
  public function setAnnualvolumehitechsmbincrease($annualvolumehitechsmbincrease = null)
  {
    $this->annualvolumehitechsmbincrease = $annualvolumehitechsmbincrease;

    return $this;
  }

  /**
   * Get annualvolumehitechsmbincrease.
   *
   * @return string|null
   */
  public function getAnnualvolumehitechsmbincrease()
  {
    return $this->annualvolumehitechsmbincrease;
  }

  /**
   * Set annualvolumehitechsmbpercent.
   *
   * @param string|null $annualvolumehitechsmbpercent
   *
   * @return PurchasePlan
   */
  public function setAnnualvolumehitechsmbpercent($annualvolumehitechsmbpercent = null)
  {
    $this->annualvolumehitechsmbpercent = $annualvolumehitechsmbpercent;

    return $this;
  }

  /**
   * Get annualvolumehitechsmbpercent.
   *
   * @return string|null
   */
  public function getAnnualvolumehitechsmbpercent()
  {
    return $this->annualvolumehitechsmbpercent;
  }

  /**
   * Set guid.
   *
   * @param string|null $guid
   *
   * @return PurchasePlan
   */
  public function setGuid($guid = null)
  {
    $this->guid = $guid;

    return $this;
  }

  /**
   * Get guid.
   *
   * @return string|null
   */
  public function getGuid()
  {
    return $this->guid;
  }

  /**
   * Set additionalinfo.
   *
   * @param string|null $additionalinfo
   *
   * @return PurchasePlan
   */
  public function setAdditionalinfo($additionalinfo = null)
  {
    $this->additionalinfo = $additionalinfo;

    return $this;
  }

  /**
   * Get additionalinfo.
   *
   * @return string|null
   */
  public function getAdditionalinfo()
  {
    return $this->additionalinfo;
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

}
