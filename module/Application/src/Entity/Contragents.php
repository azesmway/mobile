<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\DBAL\Types\Type;
use Application\Model\EntityBase;

/*
 * Переназночаем типы для PostgreSQL
 */
Type::overrideType('datetime', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('datetimetz', 'Doctrine\DBAL\Types\VarDateTimeType');
Type::overrideType('time', 'Doctrine\DBAL\Types\VarDateTimeType');


/**
 * Contragents
 *
 * @ORM\Table(name="contragents", uniqueConstraints={@ORM\UniqueConstraint(name="contragents_id_uindex", columns={"id"})})
 * @ORM\Entity(repositoryClass="Application\Model\EntityBase")
 */
class Contragents extends EntityBase
{

  /**
   * @ORM\OneToMany(targetEntity="\Application\Entity\PurchasePlan", mappedBy="contragent", cascade={"persist"})
   * @ORM\JoinColumn(name="id", referencedColumnName="customer")
   */
  private $plans;

  /**
   * @var int
   *
   * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
   * @ORM\Id
   * @ORM\GeneratedValue(strategy="SEQUENCE")
   * @ORM\SequenceGenerator(sequenceName="contragents_id_seq", allocationSize=1, initialValue=1)
   */
  private $id;

  /**
   * @var string|null
   *
   * @ORM\Column(name="fullname", type="string", length=1000, precision=0, scale=0, nullable=true, unique=false)
   */
  private $fullname;

  /**
   * @var string|null
   *
   * @ORM\Column(name="shortname", type="string", length=500, precision=0, scale=0, nullable=true, unique=false)
   */
  private $shortname;

  /**
   * @var string|null
   *
   * @ORM\Column(name="iko", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $iko;

  /**
   * @var string|null
   *
   * @ORM\Column(name="inn", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $inn;

  /**
   * @var string|null
   *
   * @ORM\Column(name="kpp", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $kpp;

  /**
   * @var string|null
   *
   * @ORM\Column(name="ogrn", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $ogrn;

  /**
   * @var string|null
   *
   * @ORM\Column(name="legaladdress", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $legaladdress;

  /**
   * @var string|null
   *
   * @ORM\Column(name="postaladdress", type="text", precision=0, scale=0, nullable=true, unique=false)
   */
  private $postaladdress;

  /**
   * @var string|null
   *
   * @ORM\Column(name="phone", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $phone;

  /**
   * @var string|null
   *
   * @ORM\Column(name="fax", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $fax;

  /**
   * @var string|null
   *
   * @ORM\Column(name="email", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $email;

  /**
   * @var string|null
   *
   * @ORM\Column(name="okato", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $okato;

  /**
   * @var string|null
   *
   * @ORM\Column(name="okopf", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $okopf;

  /**
   * @var string|null
   *
   * @ORM\Column(name="okopfname", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
   */
  private $okopfname;

  /**
   * @var string|null
   *
   * @ORM\Column(name="okpo", type="string", length=40, precision=0, scale=0, nullable=true, unique=false)
   */
  private $okpo;


  /**
   * Contragents constructor.
   * @param $entityManager
   * @param $metadata
   */
  public function __construct($entityManager, $metadata)
  {
    EntityBase::__construct($entityManager, $metadata);
    $this->plans = new ArrayCollection();
  }

  /**
   * Возвращаем название класса
   *
   * @return string
   */
  public function getEntityName()
  {
    return $this->_entityName;
  }

  /**
   * Список планов
   *
   * @return ArrayCollection
   */
  public function getPlans()
  {
    return $this->plans;
  }

}
