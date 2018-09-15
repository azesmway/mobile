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
 * Okei
 *
 * @ORM\Table(name="okei", uniqueConstraints={@ORM\UniqueConstraint(name="okei_id_uindex", columns={"id"})})
 * @ORM\Entity
 */
class Okei extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="okei_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $name;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="changedatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  private $changedatetime;

  /**
   * @var int|null
   *
   * @ORM\Column(name="businessstatus", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $businessstatus;

  /**
   * @var string|null
   *
   * @ORM\Column(name="code", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
   */
  private $code;

  /**
   * @var string|null
   *
   * @ORM\Column(name="symbol", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
   */
  private $symbol;


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
   * Set name.
   *
   * @param string|null $name
   *
   * @return Okei
   */
  public function setName($name = null)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name.
   *
   * @return string|null
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * Set changedatetime.
   *
   * @param \DateTime|null $changedatetime
   *
   * @return Okei
   */
  public function setChangedatetime($changedatetime = null)
  {
    $this->changedatetime = $changedatetime;

    return $this;
  }

  /**
   * Get changedatetime.
   *
   * @return \DateTime|null
   */
  public function getChangedatetime()
  {
    return $this->changedatetime;
  }

  /**
   * Set businessstatus.
   *
   * @param int|null $businessstatus
   *
   * @return Okei
   */
  public function setBusinessstatus($businessstatus = null)
  {
    $this->businessstatus = $businessstatus;

    return $this;
  }

  /**
   * Get businessstatus.
   *
   * @return int|null
   */
  public function getBusinessstatus()
  {
    return $this->businessstatus;
  }

  /**
   * Set code.
   *
   * @param string|null $code
   *
   * @return Okei
   */
  public function setCode($code = null)
  {
    $this->code = $code;

    return $this;
  }

  /**
   * Get code.
   *
   * @return string|null
   */
  public function getCode()
  {
    return $this->code;
  }

  /**
   * Set symbol.
   *
   * @param string|null $symbol
   *
   * @return Okei
   */
  public function setSymbol($symbol = null)
  {
    $this->symbol = $symbol;

    return $this;
  }

  /**
   * Get symbol.
   *
   * @return string|null
   */
  public function getSymbol()
  {
    return $this->symbol;
  }
}
