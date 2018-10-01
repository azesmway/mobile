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
 * Okved2
 *
 * @ORM\Table(name="okved2")
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
 */
class Okved2 extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="okved2_id_seq", allocationSize=1, initialValue=1)
   */
  protected $id;

  /**
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
   */
  protected $code;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="text", precision=0, scale=0, nullable=false, unique=false)
   */
  protected $name;

  /**
   * @var string|null
   *
   * @ORM\Column(name="parentcode", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $parentcode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="comment", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $comment;

  /**
   * @var string|null
   *
   * @ORM\Column(name="section", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $section;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="changedatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $changedatetime;

  /**
   * @var string|null
   *
   * @ORM\Column(name="businessstatus", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $businessstatus;

  /**
   * Set changedatetime.
   *
   * @param string|null $changedatetime
   *
   * @return Okved2
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
