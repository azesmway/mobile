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
 * PurchaseplandataItemRows
 *
 * @ORM\Table(name="purchaseplandata_item_rows", uniqueConstraints={@ORM\UniqueConstraint(name="purchaseplandata_item_rows_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="IDX_F5519FF56F8C53D8", columns={"okved2"}), @ORM\Index(name="IDX_F5519FF5ACD0F0F0", columns={"okpd2"}), @ORM\Index(name="IDX_F5519FF52A675A96", columns={"okei"}), @ORM\Index(name="IDX_F5519FF5F9E23AB3", columns={"planitemid"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
 */
class PurchaseplandataItemRows extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="purchaseplandata_item_rows_id_seq", allocationSize=1, initialValue=1)
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
   * @var int|null
   *
   * @ORM\Column(name="qty", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $qty;

  /**
   * @var \Application\Entity\Okved2
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okved2")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="okved2", referencedColumnName="id", nullable=true)
   * })
   */
  protected $okved2;

  /**
   * @var \Application\Entity\Okpd2
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okpd2")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="okpd2", referencedColumnName="id", nullable=true)
   * })
   */
  protected $okpd2;

  /**
   * @var \Application\Entity\Okei
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okei")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="okei", referencedColumnName="id", nullable=true)
   * })
   */
  protected $okei;

  /**
   * @var \Application\Entity\PurchasePlanItems
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\PurchasePlanItems")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="planitemid", referencedColumnName="id", nullable=true)
   * })
   */
  protected $planitemid;

  /**
   * Set okved2.
   *
   * @param \Application\Entity\Okved2|null $okved2
   *
   * @return PurchaseplandataItemRows
   */
  public function setOkved2(\Application\Entity\Okved2 $okved2 = null)
  {
    $this->okved2 = $okved2;

    return $this;
  }

  /**
   * Set okpd2.
   *
   * @param \Application\Entity\Okpd2|null $okpd2
   *
   * @return PurchaseplandataItemRows
   */
  public function setOkpd2(\Application\Entity\Okpd2 $okpd2 = null)
  {
    $this->okpd2 = $okpd2;

    return $this;
  }

  /**
   * Set okei.
   *
   * @param \Application\Entity\Okei|null $okei
   *
   * @return PurchaseplandataItemRows
   */
  public function setOkei(\Application\Entity\Okei $okei = null)
  {
    $this->okei = $okei;

    return $this;
  }

  /**
   * Set planitemid.
   *
   * @param \Application\Entity\PurchasePlanItems|null $planitemid
   *
   * @return PurchaseplandataItemRows
   */
  public function setPlanitemid(\Application\Entity\PurchasePlanItems $planitemid = null)
  {
    $this->planitemid = $planitemid;

    return $this;
  }

}
