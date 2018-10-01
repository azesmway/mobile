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
 * Okpd2
 *
 * @ORM\Table(name="okpd2", uniqueConstraints={@ORM\UniqueConstraint(name="okpd2_id_uindex", columns={"id"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
 */
class Okpd2 extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="okpd2_id_seq", allocationSize=1, initialValue=1)
   */
  protected $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="guid", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $guid;

  /**
   * @var string|null
   *
   * @ORM\Column(name="code", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $code;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="string", length=1000, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $name;

  /**
   * @var string|null
   *
   * @ORM\Column(name="parentcode", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $parentcode;

  /**
   * @var int|null
   *
   * @ORM\Column(name="comment", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $comment;

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
   * Set changedatetime.
   *
   * @param \DateTime|null $changedatetime
   *
   * @return Okpd2
   */
  public function setChangedatetime($changedatetime = null)
  {
    if (!empty($changedatetime) && is_string($changedatetime)) {
      $changedatetime = new \DateTime(date('c', strtotime($changedatetime)));
    }

    $this->changedatetime = $changedatetime;

    return $this;
  }

}
