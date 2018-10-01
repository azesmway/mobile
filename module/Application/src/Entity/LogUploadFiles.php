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
 * @ORM\Table(name="log_upload_files", uniqueConstraints={@ORM\UniqueConstraint(name="log_upload_files_id_uindex", columns={"id"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
 */
class LogUploadFiles extends EntityBase
{
  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="log_upload_files_id_seq", allocationSize=1, initialValue=1)
   */
  protected $id;

  /**
   * @var \DateTime|null
   *
   * @ORM\Column(name="dateupdate", type="datetimetz", precision=0, scale=0, nullable=true, unique=false)
   */
  protected $dateupdate;

  /**
   * @var string|null
   *
   * @ORM\Column(name="name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  protected $name;

  /**
   * Set dateupdate.
   *
   * @param \DateTime|null $dateupdate
   *
   * @return LogUploadFiles
   */
  public function setDateupdate($dateupdate = null)
  {
    if (!empty($dateupdate) && is_string($dateupdate)) {
      $dateupdate = new \DateTime(date('c', strtotime($dateupdate)));
    }

    $this->dateupdate = $dateupdate;

    return $this;
  }

}
