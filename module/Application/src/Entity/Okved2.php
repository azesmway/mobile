<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\DBAL\Types\Type;
use Application\Model\EntityBase;

Type::overrideType('datetime', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('datetimetz', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('time', 'Doctrine\DBAL\Types\VarDateTimeType');

/**
 * Okved2
 *
 * @ORM\Table(name="okved2")
 * @ORM\Entity
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
  private $id;

  /**
   * @var string
   *
   * @ORM\Column(name="code", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
   */
  private $code;

  /**
   * @var string
   *
   * @ORM\Column(name="name", type="text", precision=0, scale=0, nullable=false, unique=false)
   */
  private $name;

  /**
   * @var string|null
   *
   * @ORM\Column(name="parentcode", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $parentcode;

  /**
   * @var string|null
   *
   * @ORM\Column(name="comment", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $comment;

  /**
   * @var string|null
   *
   * @ORM\Column(name="section", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $section;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="changedatetime", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  private $changedatetime;

  /**
   * @var string|null
   *
   * @ORM\Column(name="businessstatus", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $businessstatus;


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
   * @param string $code
   *
   * @return Okved2
   */
  public function setCode($code)
  {
    $this->code = $code;

    return $this;
  }

  /**
   * Get code.
   *
   * @return string
   */
  public function getCode()
  {
    return $this->code;
  }

  /**
   * Set name.
   *
   * @param string $name
   *
   * @return Okved2
   */
  public function setName($name)
  {
    $this->name = $name;

    return $this;
  }

  /**
   * Get name.
   *
   * @return string
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
   * @return Okved2
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
   * @param string|null $comment
   *
   * @return Okved2
   */
  public function setComment($comment = null)
  {
    $this->comment = $comment;

    return $this;
  }

  /**
   * Get comment.
   *
   * @return string|null
   */
  public function getComment()
  {
    return $this->comment;
  }

  /**
   * Set section.
   *
   * @param string|null $section
   *
   * @return Okved2
   */
  public function setSection($section = null)
  {
    $this->section = $section;

    return $this;
  }

  /**
   * Get section.
   *
   * @return string|null
   */
  public function getSection()
  {
    return $this->section;
  }

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
   * @param string|null $businessstatus
   *
   * @return Okved2
   */
  public function setBusinessstatus($businessstatus = null)
  {
    $this->businessstatus = $businessstatus;

    return $this;
  }

  /**
   * Get businessstatus.
   *
   * @return string|null
   */
  public function getBusinessstatus()
  {
    return $this->businessstatus;
  }

}
