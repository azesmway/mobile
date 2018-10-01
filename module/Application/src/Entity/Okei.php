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
 * Okei
 *
 * @ORM\Table(name="okei", uniqueConstraints={@ORM\UniqueConstraint(name="okei_id_uindex", columns={"id"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
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
  protected $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $name;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="changedatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $changedatetime;

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
   * @var string|null
   *
   * @ORM\Column(name="symbol", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $symbol;

  /**
   * @var string|null
   *
   * @ORM\Column(name="sectioncode", type="string", length=1, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $sectioncode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="sectionname", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $sectionname;

  /**
   * @var string|null
   *
   * @ORM\Column(name="groupcode", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $groupcode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="groupname", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $groupname;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="enddateactive", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $enddateactive;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="startdateactive", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $startdateactive;

  /**
   * Set changedatetime.
   *
   * @param \DateTime|null $changedatetime
   *
   * @return Okei
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
   * Set enddateactive.
   *
   * @param \DateTime|null $enddateactive
   *
   * @return Okpd2
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
   * Set startdateactive.
   *
   * @param \DateTime|null $startdateactive
   *
   * @return Okpd2
   */
  public function setStartdateactive($startdateactive = null)
  {
    if (!empty($startdateactive) && is_string($startdateactive)) {
      $startdateactive = new \DateTime(date('c', strtotime($startdateactive)));
    }

    $this->startdateactive = $startdateactive;

    return $this;
  }

}
