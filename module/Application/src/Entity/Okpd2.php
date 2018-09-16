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
 * Okpd2
 *
 * @ORM\Table(name="okpd2", uniqueConstraints={@ORM\UniqueConstraint(name="okpd2_id_uindex", columns={"id"})})
 * @ORM\Entity
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
  private $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="code", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $code;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $name;

  /**
   * @var string|null
   *
   * @ORM\Column(name="parentcode", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $parentcode;

  /**
   * @var int|null
   *
   * @ORM\Column(name="comment", type="integer", precision=0, scale=0, nullable=true, unique=false)
   */
  private $comment;

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
   * Возвращаем название класса
   *
   * @return string
   */
  public function getEntityName()
  {
    return 'Okpd2';
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
   * Set code.
   *
   * @param string|null $code
   *
   * @return Okpd2
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
   * Set name.
   *
   * @param string|null $name
   *
   * @return Okpd2
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
   * Set parentcode.
   *
   * @param string|null $parentcode
   *
   * @return Okpd2
   */
  public function setParentcode($parentcode = null)
  {
    $this->parentcode = $parentcode;

    return $this;
  }

  /**
   * Get parentcode.
   *
   * @return string|null
   */
  public function getParentcode()
  {
    return $this->parentcode;
  }

  /**
   * Set comment.
   *
   * @param int|null $comment
   *
   * @return Okpd2
   */
  public function setComment($comment = null)
  {
    $this->comment = $comment;

    return $this;
  }

  /**
   * Get comment.
   *
   * @return int|null
   */
  public function getComment()
  {
    return $this->comment;
  }

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
   * @return Okpd2
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
}
