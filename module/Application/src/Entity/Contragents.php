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
 * @ORM\Entity
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


  public function __construct()
  {
    $this->plans = new ArrayCollection();
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
   * Set fullname.
   *
   * @param string|null $fullname
   *
   * @return Contragents
   */
  public function setFullname($fullname = null)
  {
    $this->fullname = $fullname;

    return $this;
  }

  /**
   * Get fullname.
   *
   * @return string|null
   */
  public function getFullname()
  {
    return $this->fullname;
  }

  /**
   * Set shortname.
   *
   * @param string|null $shortname
   *
   * @return Contragents
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

  /**
   * Set iko.
   *
   * @param string|null $iko
   *
   * @return Contragents
   */
  public function setIko($iko = null)
  {
    $this->iko = $iko;

    return $this;
  }

  /**
   * Get iko.
   *
   * @return string|null
   */
  public function getIko()
  {
    return $this->iko;
  }

  /**
   * Set inn.
   *
   * @param string|null $inn
   *
   * @return Contragents
   */
  public function setInn($inn = null)
  {
    $this->inn = $inn;

    return $this;
  }

  /**
   * Get inn.
   *
   * @return string|null
   */
  public function getInn()
  {
    return $this->inn;
  }

  /**
   * Set kpp.
   *
   * @param string|null $kpp
   *
   * @return Contragents
   */
  public function setKpp($kpp = null)
  {
    $this->kpp = $kpp;

    return $this;
  }

  /**
   * Get kpp.
   *
   * @return string|null
   */
  public function getKpp()
  {
    return $this->kpp;
  }

  /**
   * Set ogrn.
   *
   * @param string|null $ogrn
   *
   * @return Contragents
   */
  public function setOgrn($ogrn = null)
  {
    $this->ogrn = $ogrn;

    return $this;
  }

  /**
   * Get ogrn.
   *
   * @return string|null
   */
  public function getOgrn()
  {
    return $this->ogrn;
  }

  /**
   * Set legaladdress.
   *
   * @param string|null $legaladdress
   *
   * @return Contragents
   */
  public function setLegaladdress($legaladdress = null)
  {
    $this->legaladdress = $legaladdress;

    return $this;
  }

  /**
   * Get legaladdress.
   *
   * @return string|null
   */
  public function getLegaladdress()
  {
    return $this->legaladdress;
  }

  /**
   * Set postaladdress.
   *
   * @param string|null $postaladdress
   *
   * @return Contragents
   */
  public function setPostaladdress($postaladdress = null)
  {
    $this->postaladdress = $postaladdress;

    return $this;
  }

  /**
   * Get postaladdress.
   *
   * @return string|null
   */
  public function getPostaladdress()
  {
    return $this->postaladdress;
  }

  /**
   * Set phone.
   *
   * @param string|null $phone
   *
   * @return Contragents
   */
  public function setPhone($phone = null)
  {
    $this->phone = $phone;

    return $this;
  }

  /**
   * Get phone.
   *
   * @return string|null
   */
  public function getPhone()
  {
    return $this->phone;
  }

  /**
   * Set fax.
   *
   * @param string|null $fax
   *
   * @return Contragents
   */
  public function setFax($fax = null)
  {
    $this->fax = $fax;

    return $this;
  }

  /**
   * Get fax.
   *
   * @return string|null
   */
  public function getFax()
  {
    return $this->fax;
  }

  /**
   * Set email.
   *
   * @param string|null $email
   *
   * @return Contragents
   */
  public function setEmail($email = null)
  {
    $this->email = $email;

    return $this;
  }

  /**
   * Get email.
   *
   * @return string|null
   */
  public function getEmail()
  {
    return $this->email;
  }

  /**
   * Set okato.
   *
   * @param string|null $okato
   *
   * @return Contragents
   */
  public function setOkato($okato = null)
  {
    $this->okato = $okato;

    return $this;
  }

  /**
   * Get okato.
   *
   * @return string|null
   */
  public function getOkato()
  {
    return $this->okato;
  }

  /**
   * Set okopf.
   *
   * @param string|null $okopf
   *
   * @return Contragents
   */
  public function setOkopf($okopf = null)
  {
    $this->okopf = $okopf;

    return $this;
  }

  /**
   * Get okopf.
   *
   * @return string|null
   */
  public function getOkopf()
  {
    return $this->okopf;
  }

  /**
   * Set okopfname.
   *
   * @param string|null $okopfname
   *
   * @return Contragents
   */
  public function setOkopfname($okopfname = null)
  {
    $this->okopfname = $okopfname;

    return $this;
  }

  /**
   * Get okopfname.
   *
   * @return string|null
   */
  public function getOkopfname()
  {
    return $this->okopfname;
  }

  /**
   * Set okpo.
   *
   * @param string|null $okpo
   *
   * @return Contragents
   */
  public function setOkpo($okpo = null)
  {
    $this->okpo = $okpo;

    return $this;
  }

  /**
   * Get okpo.
   *
   * @return string|null
   */
  public function getOkpo()
  {
    return $this->okpo;
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
