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
 * Okv
 *
 * @ORM\Table(name="okv", uniqueConstraints={@ORM\UniqueConstraint(name="okv_id_uindex", columns={"id"})})
 * @ORM\Entity
 */
class Okv extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="okv_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="guid", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $guid;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="changedatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  private $changedatetime;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="startdateactive", type="datetime", precision=0, scale=0, nullable=true, unique=false)
   */
  private $startdateactive;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="enddateactive", type="datetime", precision=0, scale=0, nullable=true, unique=false)
   */
  private $enddateactive;

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
   * @var int|null
   *
   * @ORM\Column(name="digitalcode", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $digitalcode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $name;

  /**
   * @var string|null
   *
   * @ORM\Column(name="shortname", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $shortname;

  /**
   * Возвращаем название класса
   *
   * @return string
   */
  public function getEntityName()
  {
    return 'Okv';
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
   * Set guid.
   *
   * @param string|null $guid
   *
   * @return Okv
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
   * Set changedatetime.
   *
   * @param \DateTime|null $changedatetime
   *
   * @return Okv
   */
  public function setChangedatetime($changedatetime = null)
  {
    if (!empty($changedatetime) && is_string($changedatetime)) {
      $changedatetime = new \DateTime(date('c', strtotime($changedatetime)));
    }

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
   * Set startdateactive.
   *
   * @param \DateTime|null $startdateactive
   *
   * @return Okv
   */
  public function setStartdateactive($startdateactive = null)
  {
    if (!empty($startdateactive) && is_string($startdateactive)) {
      $startdateactive = new \DateTime(date('c', strtotime($startdateactive)));
    }

    $this->startdateactive = $startdateactive;

    return $this;
  }

  /**
   * Get startdateactive.
   *
   * @return \DateTime|null
   */
  public function getStartdateactive()
  {
    return $this->startdateactive;
  }

  /**
   * Set enddateactive.
   *
   * @param \DateTime|null $enddateactive
   *
   * @return Okv
   */
  public function setEnddateactive($enddateactive = null)
  {
    if (!empty($enddateactive) && is_string($enddateactive)) {
      $enddateactive = new \DateTime(date('c', strtotime($enddateactive)));
    }

    $this->enddateactive = $enddateactive;

    return $this;
  }

  /**
   * Get enddateactive.
   *
   * @return \DateTime|null
   */
  public function getEnddateactive()
  {
    return $this->enddateactive;
  }

  /**
   * Set businessstatus.
   *
   * @param int|null $businessstatus
   *
   * @return Okv
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
   * @return Okv
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
   * Set digitalcode.
   *
   * @param int|null $digitalcode
   *
   * @return Okv
   */
  public function setDigitalcode($digitalcode = null)
  {
    $this->digitalcode = $digitalcode;

    return $this;
  }

  /**
   * Get digitalcode.
   *
   * @return int|null
   */
  public function getDigitalcode()
  {
    return $this->digitalcode;
  }

  /**
   * Set name.
   *
   * @param string|null $name
   *
   * @return Okv
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
   * Set shortname.
   *
   * @param string|null $shortname
   *
   * @return Okv
   */
  public function setShortname($shortname = null)
  {
    $this->shortname = $shortname;

    return $this;
  }

  /**
   * Get shortname.
   *
   * @return string|null
   */
  public function getShortname()
  {
    return $this->shortname;
  }
}
