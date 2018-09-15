<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OauthUsers
 *
 * @ORM\Table(name="oauth_users")
 * @ORM\Entity
 */
class OauthUsers
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="oauth_users_username_seq", allocationSize=1, initialValue=1)
     */
    private $username;

    /**
     * @var string|null
     *
     * @ORM\Column(name="password", type="string", length=2000, precision=0, scale=0, nullable=true, unique=false)
     */
    private $password;

    /**
     * @var string|null
     *
     * @ORM\Column(name="first_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $firstName;

    /**
     * @var string|null
     *
     * @ORM\Column(name="last_name", type="string", length=255, precision=0, scale=0, nullable=true, unique=false)
     */
    private $lastName;


    /**
     * Get username.
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password.
     *
     * @param string|null $password
     *
     * @return OauthUsers
     */
    public function setPassword($password = null)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password.
     *
     * @return string|null
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set firstName.
     *
     * @param string|null $firstName
     *
     * @return OauthUsers
     */
    public function setFirstName($firstName = null)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get firstName.
     *
     * @return string|null
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set lastName.
     *
     * @param string|null $lastName
     *
     * @return OauthUsers
     */
    public function setLastName($lastName = null)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get lastName.
     *
     * @return string|null
     */
    public function getLastName()
    {
        return $this->lastName;
    }
}
