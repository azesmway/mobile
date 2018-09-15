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
 * @ORM\Table(name="upload_files", uniqueConstraints={@ORM\UniqueConstraint(name="upload_files_id_uindex", columns={"id"})})
 * @ORM\Entity
 */
class UploadFiles extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="upload_files_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="dateupdate", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  private $dateupdate;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $name;

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
   * Set dateupdate.
   *
   * @param \DateTime|null $dateupdate
   *
   * @return UploadFiles
   */
  public function setDateupdate($dateupdate = null)
  {
    if (!empty($dateupdate) && is_string($dateupdate)) {
      $dateupdate = new \DateTime(date('c', strtotime($dateupdate)));
    }

    $this->dateupdate = $dateupdate;

    return $this;
  }

  /**
   * Get changedatetime.
   *
   * @return \DateTime|null
   */
  public function getDateupdate()
  {
    return $this->dateupdate;
  }

  /**
   * Set name.
   *
   * @param string|null $name
   *
   * @return UploadFiles
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

}
