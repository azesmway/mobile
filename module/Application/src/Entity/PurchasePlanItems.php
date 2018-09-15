<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Type;
use Application\Model\EntityBase;

/*
 * Переназночаем типы для PostgreSQL
 */

Type::overrideType('datetime', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('datetimetz', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('time', 'Doctrine\DBAL\Types\VarDateTimeType');


/**
 * PurchasePlanItems
 *
 * @ORM\Table(name="purchase_plan_items", uniqueConstraints={@ORM\UniqueConstraint(name="purchaseplanitems_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="IDX_BE8BFB7B542823B5", columns={"planitemcustomer"}), @ORM\Index(name="IDX_BE8BFB7B6956883F", columns={"currency"}), @ORM\Index(name="IDX_BE8BFB7BD91135CD", columns={"planid"})})
 * @ORM\Entity
 */
class PurchasePlanItems extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="purchase_plan_items_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="guid", type="guid", precision=0, scale=0, nullable=true, unique=false)
   */
  private $guid;

  /**
   * @var int|null
   *
   * @ORM\Column(name="ordinalnumber", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $ordinalnumber;

  /**
   * @var string|null
   *
   * @ORM\Column(name="contractsubject", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $contractsubject;

  /**
   * @var string|null
   *
   * @ORM\Column(name="minimumrequirements", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $minimumrequirements;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="contractenddate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  private $contractenddate;

  /**
   * @var string|null
   *
   * @ORM\Column(name="modificationdescription", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $modificationdescription;

  /**
   * @var string|null
   *
   * @ORM\Column(name="status", type="string", length=2, precision=0, scale=0, nullable=true, unique=false)
   */
  private $status;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="shared", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $shared;

  /**
   * @var string|null
   *
   * @ORM\Column(name="parentid", type="guid", precision=0, scale=0, nullable=true, unique=false)
   */
  private $parentid;

  /**
   * @var int|null
   *
   * @ORM\Column(name="okato", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $okato;

  /**
   * @var string|null
   *
   * @ORM\Column(name="region", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $region;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="isgeneraladdress", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $isgeneraladdress;

  /**
   * @var string|null
   *
   * @ORM\Column(name="maximumcontractprice", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  private $maximumcontractprice;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchaseperiodyear", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $purchaseperiodyear;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchaseperiodquarter", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $purchaseperiodquarter;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchaseperiodmonth", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $purchaseperiodmonth;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchasemethodcode", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $purchasemethodcode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="purchasemethodname", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $purchasemethodname;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="iselectronic", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $iselectronic;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="ispurchaseignored", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $ispurchaseignored;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="innovationequivalent", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  private $innovationequivalent;

  /**
   * @var \Application\Entity\Contragents
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Contragents", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="planitemcustomer", referencedColumnName="id", nullable=true)
   * })
   */
  private $planitemcustomer;

  /**
   * @var \Application\Entity\PurchasePlan
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\PurchasePlan", inversedBy="planitems", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="planid", referencedColumnName="id", nullable=true)
   * })
   */
  private $planid;

  /**
   * @var \Application\Entity\Okv
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okv", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="currency", referencedColumnName="id", nullable=true)
   * })
   */
  private $currency;


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
   * Set guid.
   *
   * @param string|null $guid
   *
   * @return PurchasePlanItems
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
   * Set ordinalnumber.
   *
   * @param int|null $ordinalnumber
   *
   * @return PurchasePlanItems
   */
  public function setOrdinalnumber($ordinalnumber = null)
  {
    $this->ordinalnumber = $ordinalnumber;

    return $this;
  }

  /**
   * Get ordinalnumber.
   *
   * @return int|null
   */
  public function getOrdinalnumber()
  {
    return $this->ordinalnumber;
  }

  /**
   * Set contractsubject.
   *
   * @param string|null $contractsubject
   *
   * @return PurchasePlanItems
   */
  public function setContractsubject($contractsubject = null)
  {
    $this->contractsubject = $contractsubject;

    return $this;
  }

  /**
   * Get contractsubject.
   *
   * @return string|null
   */
  public function getContractsubject()
  {
    return $this->contractsubject;
  }

  /**
   * Set minimumrequirements.
   *
   * @param string|null $minimumrequirements
   *
   * @return PurchasePlanItems
   */
  public function setMinimumrequirements($minimumrequirements = null)
  {
    $this->minimumrequirements = $minimumrequirements;

    return $this;
  }

  /**
   * Get minimumrequirements.
   *
   * @return string|null
   */
  public function getMinimumrequirements()
  {
    return $this->minimumrequirements;
  }

  /**
   * Set contractenddate.
   *
   * @param \DateTime|null $contractenddate
   *
   * @return PurchasePlanItems
   */
  public function setContractenddate($contractenddate = null)
  {
    $this->contractenddate = $contractenddate;

    return $this;
  }

  /**
   * Get contractenddate.
   *
   * @return \DateTime|null
   */
  public function getContractenddate()
  {
    return $this->contractenddate;
  }

  /**
   * Set modificationdescription.
   *
   * @param string|null $modificationdescription
   *
   * @return PurchasePlanItems
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
   * Set status.
   *
   * @param string|null $status
   *
   * @return PurchasePlanItems
   */
  public function setStatus($status = null)
  {
    $this->status = $status;

    return $this;
  }

  /**
   * Get status.
   *
   * @return string|null
   */
  public function getStatus()
  {
    return $this->status;
  }

  /**
   * Set shared.
   *
   * @param bool|null $shared
   *
   * @return PurchasePlanItems
   */
  public function setShared($shared = null)
  {
    $this->shared = $shared;

    return $this;
  }

  /**
   * Get shared.
   *
   * @return bool|null
   */
  public function getShared()
  {
    return $this->shared;
  }

  /**
   * Set parentid.
   *
   * @param string|null $parentid
   *
   * @return PurchasePlanItems
   */
  public function setParentid($parentid = null)
  {
    $this->parentid = $parentid;

    return $this;
  }

  /**
   * Get parentid.
   *
   * @return string|null
   */
  public function getParentid()
  {
    return $this->parentid;
  }

  /**
   * Set okato.
   *
   * @param int|null $okato
   *
   * @return PurchasePlanItems
   */
  public function setOkato($okato = null)
  {
    $this->okato = $okato;

    return $this;
  }

  /**
   * Get okato.
   *
   * @return int|null
   */
  public function getOkato()
  {
    return $this->okato;
  }

  /**
   * Set region.
   *
   * @param string|null $region
   *
   * @return PurchasePlanItems
   */
  public function setRegion($region = null)
  {
    $this->region = $region;

    return $this;
  }

  /**
   * Get region.
   *
   * @return string|null
   */
  public function getRegion()
  {
    return $this->region;
  }

  /**
   * Set isgeneraladdress.
   *
   * @param bool|null $isgeneraladdress
   *
   * @return PurchasePlanItems
   */
  public function setIsgeneraladdress($isgeneraladdress = null)
  {
    $this->isgeneraladdress = $isgeneraladdress;

    return $this;
  }

  /**
   * Get isgeneraladdress.
   *
   * @return bool|null
   */
  public function getIsgeneraladdress()
  {
    return $this->isgeneraladdress;
  }

  /**
   * Set maximumcontractprice.
   *
   * @param string|null $maximumcontractprice
   *
   * @return PurchasePlanItems
   */
  public function setMaximumcontractprice($maximumcontractprice = null)
  {
    $this->maximumcontractprice = $maximumcontractprice;

    return $this;
  }

  /**
   * Get maximumcontractprice.
   *
   * @return string|null
   */
  public function getMaximumcontractprice()
  {
    return $this->maximumcontractprice;
  }

  /**
   * Set purchaseperiodyear.
   *
   * @param int|null $purchaseperiodyear
   *
   * @return PurchasePlanItems
   */
  public function setPurchaseperiodyear($purchaseperiodyear = null)
  {
    $this->purchaseperiodyear = $purchaseperiodyear;

    return $this;
  }

  /**
   * Get purchaseperiodyear.
   *
   * @return int|null
   */
  public function getPurchaseperiodyear()
  {
    return $this->purchaseperiodyear;
  }

  /**
   * Set purchaseperiodquarter.
   *
   * @param int|null $purchaseperiodquarter
   *
   * @return PurchasePlanItems
   */
  public function setPurchaseperiodquarter($purchaseperiodquarter = null)
  {
    $this->purchaseperiodquarter = $purchaseperiodquarter;

    return $this;
  }

  /**
   * Get purchaseperiodquarter.
   *
   * @return int|null
   */
  public function getPurchaseperiodquarter()
  {
    return $this->purchaseperiodquarter;
  }

  /**
   * Set purchaseperiodmonth.
   *
   * @param int|null $purchaseperiodmonth
   *
   * @return PurchasePlanItems
   */
  public function setPurchaseperiodmonth($purchaseperiodmonth = null)
  {
    $this->purchaseperiodmonth = $purchaseperiodmonth;

    return $this;
  }

  /**
   * Get purchaseperiodmonth.
   *
   * @return int|null
   */
  public function getPurchaseperiodmonth()
  {
    return $this->purchaseperiodmonth;
  }

  /**
   * Set purchasemethodcode.
   *
   * @param int|null $purchasemethodcode
   *
   * @return PurchasePlanItems
   */
  public function setPurchasemethodcode($purchasemethodcode = null)
  {
    $this->purchasemethodcode = $purchasemethodcode;

    return $this;
  }

  /**
   * Get purchasemethodcode.
   *
   * @return int|null
   */
  public function getPurchasemethodcode()
  {
    return $this->purchasemethodcode;
  }

  /**
   * Set purchasemethodname.
   *
   * @param string|null $purchasemethodname
   *
   * @return PurchasePlanItems
   */
  public function setPurchasemethodname($purchasemethodname = null)
  {
    $this->purchasemethodname = $purchasemethodname;

    return $this;
  }

  /**
   * Get purchasemethodname.
   *
   * @return string|null
   */
  public function getPurchasemethodname()
  {
    return $this->purchasemethodname;
  }

  /**
   * Set iselectronic.
   *
   * @param bool|null $iselectronic
   *
   * @return PurchasePlanItems
   */
  public function setIselectronic($iselectronic = null)
  {
    $this->iselectronic = $iselectronic;

    return $this;
  }

  /**
   * Get iselectronic.
   *
   * @return bool|null
   */
  public function getIselectronic()
  {
    return $this->iselectronic;
  }

  /**
   * Set ispurchaseignored.
   *
   * @param bool|null $ispurchaseignored
   *
   * @return PurchasePlanItems
   */
  public function setIspurchaseignored($ispurchaseignored = null)
  {
    $this->ispurchaseignored = $ispurchaseignored;

    return $this;
  }

  /**
   * Get ispurchaseignored.
   *
   * @return bool|null
   */
  public function getIspurchaseignored()
  {
    return $this->ispurchaseignored;
  }

  /**
   * Set innovationequivalent.
   *
   * @param bool|null $innovationequivalent
   *
   * @return PurchasePlanItems
   */
  public function setInnovationequivalent($innovationequivalent = null)
  {
    $this->innovationequivalent = $innovationequivalent;

    return $this;
  }

  /**
   * Get innovationequivalent.
   *
   * @return bool|null
   */
  public function getInnovationequivalent()
  {
    return $this->innovationequivalent;
  }

  /**
   * Set planitemcustomer.
   *
   * @param \Application\Entity\Contragents|null $planitemcustomer
   *
   * @return PurchasePlanItems
   */
  public function setPlanitemcustomer(\Application\Entity\Contragents $planitemcustomer = null)
  {
    $this->planitemcustomer = $planitemcustomer;

    return $this;
  }

  /**
   * Get planitemcustomer.
   *
   * @return \Application\Entity\Contragents|null
   */
  public function getPlanitemcustomer()
  {
    return $this->planitemcustomer;
  }

  /**
   * Set planid.
   *
   * @param \Application\Entity\PurchasePlan|null $planid
   *
   * @return PurchasePlanItems
   */
  public function setPlanid(\Application\Entity\PurchasePlan $planid = null)
  {
    $this->planid = $planid;

    return $this;
  }

  /**
   * Get planid.
   *
   * @return \Application\Entity\PurchasePlan|null
   */
  public function getPlanid()
  {
    return $this->planid;
  }

  /**
   * Set currency.
   *
   * @param \Application\Entity\Okv|null $currency
   *
   * @return PurchasePlanItems
   */
  public function setCurrency(\Application\Entity\Okv $currency = null)
  {
    $this->currency = $currency;

    return $this;
  }

  /**
   * Get currency.
   *
   * @return \Application\Entity\Okv|null
   */
  public function getCurrency()
  {
    return $this->currency;
  }
}
