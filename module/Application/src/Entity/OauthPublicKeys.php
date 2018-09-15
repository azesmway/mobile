<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthPublicKeys
 *
 * @ORM\Table(name="oauth_public_keys")
 * @ORM\Entity
 */
class OauthPublicKeys
{
    /**
     * @var string
     *
     * @ORM\Column(name="client_id", type="string", length=80, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="oauth_public_keys_client_id_seq", allocationSize=1, initialValue=1)
     */
    private $clientId;

    /**
     * @var string|null
     *
     * @ORM\Column(name="public_key", type="string", length=20000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $publicKey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="private_key", type="string", length=20000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $privateKey;

    /**
     * @var string|null
     *
     * @ORM\Column(name="encryption_algorithm", type="string", length=80, precision=0, scale=0, nullable=true, unique=false)
     */
    private $encryptionAlgorithm;


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
     * Set publicKey.
     *
     * @param string|null $publicKey
     *
     * @return OauthPublicKeys
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

    /**
     * Set privateKey.
     *
     * @param string|null $privateKey
     *
     * @return OauthPublicKeys
     */
    public function setPrivateKey($privateKey = null)
    {
        $this->privateKey = $privateKey;

        return $this;
    }

    /**
     * Get privateKey.
     *
     * @return string|null
     */
    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * Set encryptionAlgorithm.
     *
     * @param string|null $encryptionAlgorithm
     *
     * @return OauthPublicKeys
     */
    public function setEncryptionAlgorithm($encryptionAlgorithm = null)
    {
        $this->encryptionAlgorithm = $encryptionAlgorithm;

        return $this;
    }

    /**
     * Get encryptionAlgorithm.
     *
     * @return string|null
     */
    public function getEncryptionAlgorithm()
    {
        return $this->encryptionAlgorithm;
    }
}
