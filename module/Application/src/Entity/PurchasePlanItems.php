<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Type;
use Application\Model\EntityBase;

/*
 * Переназначаем типы для PostgreSQL
 */
Type::overrideType('datetime', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('datetimetz', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('time', 'Doctrine\DBAL\Types\VarDateTimeType');


/**
 * PurchasePlanItems
 *
 * @ORM\Table(name="purchase_plan_items", uniqueConstraints={@ORM\UniqueConstraint(name="purchaseplanitems_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="IDX_BE8BFB7B542823B5", columns={"planitemcustomer"}), @ORM\Index(name="IDX_BE8BFB7B6956883F", columns={"currency"}), @ORM\Index(name="IDX_BE8BFB7BD91135CD", columns={"planid"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
 */
class PurchasePlanItems extends EntityBase
{
  /**
   * @ORM\ManyToOne(targetEntity="\Application\Entity\PurchasePlan", inversedBy="planitems")
   * @ORM\JoinColumn(name="planid", referencedColumnName="id")
   */
  protected $plan;

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="purchase_plan_items_id_seq", allocationSize=1, initialValue=1)
   */
  protected $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="guid", type="guid", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $guid;

  /**
   * @var int|null
   *
   * @ORM\Column(name="ordinalnumber", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $ordinalnumber;

  /**
   * @var string|null
   *
   * @ORM\Column(name="contractsubject", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $contractsubject;

  /**
   * @var string|null
   *
   * @ORM\Column(name="minimumrequirements", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $minimumrequirements;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="contractenddate", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $contractenddate;

  /**
   * @var string|null
   *
   * @ORM\Column(name="modificationdescription", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $modificationdescription;

  /**
   * @var string|null
   *
   * @ORM\Column(name="status", type="string", length=2, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $status;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="shared", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $shared;

  /**
   * @var string|null
   *
   * @ORM\Column(name="parentid", type="guid", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $parentid;

  /**
   * @var int|null
   *
   * @ORM\Column(name="okato", type="string", length=11, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $okato;

  /**
   * @var string|null
   *
   * @ORM\Column(name="region", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $region;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="isgeneraladdress", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $isgeneraladdress;

  /**
   * @var string|null
   *
   * @ORM\Column(name="maximumcontractprice", type="decimal", precision=20, scale=2, nullable=true, unique=false)
   */
  protected $maximumcontractprice;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchaseperiodyear", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $purchaseperiodyear;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchaseperiodquarter", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $purchaseperiodquarter;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchaseperiodmonth", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $purchaseperiodmonth;

  /**
   * @var int|null
   *
   * @ORM\Column(name="purchasemethodcode", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $purchasemethodcode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="purchasemethodname", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $purchasemethodname;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="iselectronic", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $iselectronic;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="ispurchaseignored", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $ispurchaseignored;

  /**
   * @var bool|null
   *
   * @ORM\Column(name="innovationequivalent", type="boolean", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $innovationequivalent;

  /**
   * @var string|null
   *
   * @ORM\Column(name="orderpricing", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $orderpricing;

  /**
   * @var string|null
   *
   * @ORM\Column(name="cancellationreason", type="string", length=20, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $cancellationreason;

  /**
   * @var \Application\Entity\Contragents
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Contragents", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="planitemcustomer", referencedColumnName="id", nullable=true)
   * })
   */
  protected $planitemcustomer;

  /**
   * @var \Application\Entity\PurchasePlan
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\PurchasePlan", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="planid", referencedColumnName="id", nullable=true)
   * })
   */
  protected $planid;

  /**
   * @var \Application\Entity\Okv
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okv", cascade={"persist"})
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="currency", referencedColumnName="id", nullable=true)
   * })
   */
  protected $currency;

  /**
   * Set contractenddate.
   *
   * @param \DateTime|null $contractenddate
   *
   * @return PurchasePlanItems
   */
  public function setContractenddate($contractenddate = null)
  {
    if (!empty($contractenddate) && is_string($contractenddate)) {
      $contractenddate = new \DateTime(date('Y-m-d', strtotime($contractenddate)));
    }

    $this->contractenddate = $contractenddate;

    return $this;
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

}
