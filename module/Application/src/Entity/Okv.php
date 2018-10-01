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
 * Okv
 *
 * @ORM\Table(name="okv", uniqueConstraints={@ORM\UniqueConstraint(name="okv_id_uindex", columns={"id"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
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
  protected $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="guid", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $guid;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="changedatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $changedatetime;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="startdateactive", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $startdateactive;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="enddateactive", type="date", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $enddateactive;

  /**
   * @var int|null
   *
   * @ORM\Column(name="businessstatus", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $businessstatus;

  /**
   * @var string|null
   *
   * @ORM\Column(name="code", type="string", length=10, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $code;

  /**
   * @var int|null
   *
   * @ORM\Column(name="digitalcode", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $digitalcode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $name;

  /**
   * @var string|null
   *
   * @ORM\Column(name="shortname", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $shortname;

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
   * Set startdateactive.
   *
   * @param \DateTime|null $startdateactive
   *
   * @return Okv
   */
  public function setStartdateactive($startdateactive = null)
  {
    if (!empty($startdateactive) && is_string($startdateactive)) {
      $startdateactive = new \DateTime(date('Y-m-d', strtotime($startdateactive)));
    }

    $this->startdateactive = $startdateactive;

    return $this;
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
      $enddateactive = new \DateTime(date('Y-m-d', strtotime($enddateactive)));
    }

    $this->enddateactive = $enddateactive;

    return $this;
  }

}
