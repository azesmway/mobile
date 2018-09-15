<?php

namespace Application\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MigrationsTable
 *
 * @ORM\Table(name="migrations_table")
 * @ORM\Entity
 */
class MigrationsTable
{
    /**
     * @var string
     *
     * @ORM\Column(name="version", type="string", length=255, precision=0, scale=0, nullable=false, unique=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="SEQUENCE")
     * @ORM\SequenceGenerator(sequenceName="migrations_table_version_seq", allocationSize=1, initialValue=1)
     */
    private $version;


    /**
     * Get version.
     *
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }
}
