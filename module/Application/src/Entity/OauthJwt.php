<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthJwt
 *
 * @ORM\Table(name="oauth_jwt")
 * @ORM\Entity
 */
class OauthJwt
{
    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="oauth_jwt_client_id_seq", allocationSize=1, initialValue=1)
     */
    private $clientId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="subject", type="string", length=80, precision=0, scale=0, nullable=true, unique=false)
     */
    private $subject;

    /**
     * @var string|null
     *
     * @ORM\Column(name="public_key", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $publicKey;


    /**
     * Get clientId.
     *
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set subject.
     *
     * @param string|null $subject
     *
     * @return OauthJwt
     */
    public function setSubject($subject = null)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject.
     *
     * @return string|null
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set publicKey.
     *
     * @param string|null $publicKey
     *
     * @return OauthJwt
     */
    public function setPublicKey($publicKey = null)
    {
        $this->publicKey = $publicKey;

        return $this;
    }

    /**
     * Get publicKey.
     *
     * @return string|null
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }
}
