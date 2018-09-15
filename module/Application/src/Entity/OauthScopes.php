<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthScopes
 *
 * @ORM\Table(name="oauth_scopes")
 * @ORM\Entity
 */
class OauthScopes
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer", precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="oauth_scopes_id_seq", allocationSize=1, initialValue=1)
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=255, precision=0, scale=0, nullable=false, options={"default"="supported"}, unique=false)
     */
    private $type = 'supported';

    /**
     * @var string|null
     *
     * @ORM\Column(name="scope", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $scope;

    /**
     * @var string|null
     *
     * @ORM\Column(name="client_id", type="string", length=80, precision=0, scale=0, nullable=true, unique=false)
     */
    private $clientId;

    /**
     * @var int|null
     *
     * @ORM\Column(name="is_default", type="smallint", precision=0, scale=0, nullable=true, unique=false)
     */
    private $isDefault;


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
     * Set type.
     *
     * @param string $type
     *
     * @return OauthScopes
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type.
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set scope.
     *
     * @param string|null $scope
     *
     * @return OauthScopes
     */
    public function setScope($scope = null)
    {
        $this->scope = $scope;

        return $this;
    }

    /**
     * Get scope.
     *
     * @return string|null
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * Set clientId.
     *
     * @param string|null $clientId
     *
     * @return OauthScopes
     */
    public function setClientId($clientId = null)
    {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get clientId.
     *
     * @return string|null
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * Set isDefault.
     *
     * @param int|null $isDefault
     *
     * @return OauthScopes
     */
    public function setIsDefault($isDefault = null)
    {
        $this->isDefault = $isDefault;

        return $this;
    }

    /**
     * Get isDefault.
     *
     * @return int|null
     */
    public function getIsDefault()
    {
        return $this->isDefault;
    }
}
