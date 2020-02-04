<?php

namespace App\Entities\Claim;

use App\Entities\Users;
use Doctrine\ORM\Mapping as ORM;

/**
 * Question
 *
 * @ORM\Table(name="claims")
 * @ORM\Entity(repositoryClass="App\Repositories\Claim")
 */
class Item
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $identity;

    /**
     * @var string|null
     *
     * @ORM\Column(name="zipcode", type="string", nullable=true)
     */
    protected $zipcode;

    /**
     * @var string $provider
     *
     * @ORM\Column(name="provider", type="string", nullable=false)
     */
    protected $provider;

    /**
     * @var string $property
     *
     * @ORM\Column(name="property", type="string", nullable=false)
     */
    protected $property;

    /**
     * @var string $damages
     *
     * @ORM\Column(name="damages", type="string", nullable=false)
     */
    protected $damages;

    /**
     * @var string|null
     *
     * @ORM\Column(name="text", type="text", nullable=true)
     */
    protected $text;

    /**
     * @var Users
     *
     * @ORM\ManyToOne(targetEntity="App\Entities\Users")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", nullable=false)
     */
    private $user;

    /**
     * @var State
     *
     * @ORM\Embedded(class="App\Entities\Claim\State", columnPrefix = false)
     */
    private $state;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_date", type="datetime", nullable=false)
     */
    private $createDate;

    public function __construct()
    {
        $this->createDate = new \DateTime();
    }

    /**
     * @return string
     */
    public function getProvider()
    {
        return $this->provider;
    }

    /**
     * @param string $provider
     *
     * @return Item
     */
    public function setProvider($provider)
    {
        $this->provider = $provider;

        return $this;
    }

    /**
     * @return string
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * @param string $property
     *
     * @return Item
     */
    public function setProperty($property)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * @return string
     */
    public function getDamages(): string
    {
        return $this->damages;
    }

    /**
     * @param string $damages
     *
     * @return Item
     */
    public function setDamages(string $damages)
    {
        $this->damages = $damages;

        return $this;
    }

    /**
     * @return State
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param State $state
     *
     * @return Item
     */
    public function setState(State $state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * @return bool
     */
    public function isActive()
    {
        return $this->getState()->isActive();
    }

    /**
     * @return \DateTime
     */
    public function getCreateDate()
    {
        return $this->createDate;
    }

    /**
     * @return int
     */
    public function getIdentity()
    {
        return $this->identity;
    }

    /**
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * @param string|null $text
     *
     * @return Item
     */
    public function setText(?string $text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * @return Users
     */
    public function getUser(): Users
    {
        return $this->user;
    }

    /**
     * @param Users $user
     *
     * @return Item
     */
    public function setUser(Users $user): Item
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return string|null
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * @param string|null $zipcode
     */
    public function setZipcode($zipcode): Item
    {
        $this->zipcode = $zipcode;

        return $this;
    }
}