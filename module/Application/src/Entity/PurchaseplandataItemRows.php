<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Application\Model\EntityBase;

/**
 * PurchaseplandataItemRows
 *
 * @ORM\Table(name="purchaseplandata_item_rows", uniqueConstraints={@ORM\UniqueConstraint(name="purchaseplandata_item_rows_id_uindex", columns={"id"})}, indexes={@ORM\Index(name="IDX_F5519FF56F8C53D8", columns={"okved2"}), @ORM\Index(name="IDX_F5519FF5ACD0F0F0", columns={"okpd2"}), @ORM\Index(name="IDX_F5519FF52A675A96", columns={"okei"}), @ORM\Index(name="IDX_F5519FF5F9E23AB3", columns={"planitemid"})})
 * @ORM\Entity
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
   * @var int|null
   *
   * @ORM\Column(name="qty", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $qty;

  /**
   * @var \Application\Entity\Okved2
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okved2")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="okved2", referencedColumnName="id", nullable=true)
   * })
   */
  private $okved2;

  /**
   * @var \Application\Entity\Okpd2
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okpd2")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="okpd2", referencedColumnName="id", nullable=true)
   * })
   */
  private $okpd2;

  /**
   * @var \Application\Entity\Okei
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\Okei")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="okei", referencedColumnName="id", nullable=true)
   * })
   */
  private $okei;

  /**
   * @var \Application\Entity\PurchasePlanItems
   *
   * @ORM\ManyToOne(targetEntity="Application\Entity\PurchasePlanItems")
   * @ORM\JoinColumns({
   *   @ORM\JoinColumn(name="planitemid", referencedColumnName="id", nullable=true)
   * })
   */
  private $planitemid;


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
   * @return PurchaseplandataItemRows
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
   * @return PurchaseplandataItemRows
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
   * Set qty.
   *
   * @param int|null $qty
   *
   * @return PurchaseplandataItemRows
   */
  public function setQty($qty = null)
  {
    $this->qty = $qty;

    return $this;
  }

  /**
   * Get qty.
   *
   * @return int|null
   */
  public function getQty()
  {
    return $this->qty;
  }

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
   * Get okved2.
   *
   * @return \Application\Entity\Okved2|null
   */
  public function getOkved2()
  {
    return $this->okved2;
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
   * Get okpd2.
   *
   * @return \Application\Entity\Okpd2|null
   */
  public function getOkpd2()
  {
    return $this->okpd2;
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
   * Get okei.
   *
   * @return \Application\Entity\Okei|null
   */
  public function getOkei()
  {
    return $this->okei;
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

  /**
   * Get planitemid.
   *
   * @return \Application\Entity\PurchasePlanItems|null
   */
  public function getPlanitemid()
  {
    return $this->planitemid;
  }
}
