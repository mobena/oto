<?php

namespace VideosBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Video
 *
 * @ORM\Table(name="video")
 * @ORM\Entity(repositoryClass="VideosBundle\Repository\VideoRepository")
 */
class Video
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="description", type="text")
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank()
     * @ORM\Column(name="source", type="text")
     */
    private $source;

    /**
     * @var int
     *
     * @ORM\Column(name="user_creator", type="integer")
     */
    private $userCreator;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created", type="datetime")
     */
    private $created;

    /**
     * @var int
     *
     * @ORM\Column(name="status_visibility", type="integer")
     */
    private $statusVisibility;
    
    function __construct()
    {
        $this->setCreated(new \DateTime());
        
    }


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return Video
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Video
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set source
     *
     * @param string $source
     * @return Video
     */
    public function setSource($source)
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Get source
     *
     * @return string 
     */
    public function getSource()
    {
        return $this->source;
    }

    /**
     * Set userCreator
     *
     * @param integer $userCreator
     * @return Video
     */
    public function setUserCreator($userCreator)
    {
        $this->userCreator = $userCreator;

        return $this;
    }

    /**
     * Get userCreator
     *
     * @return integer 
     */
    public function getUserCreator()
    {
        return $this->userCreator;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     * @return Video
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime 
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set statusVisibility
     *
     * @param integer $statusVisibility
     * @return Video
     */
    public function setStatusVisibility($statusVisibility)
    {
        $this->statusVisibility = $statusVisibility;

        return $this;
    }

    /**
     * Get statusVisibility
     *
     * @return integer 
     */
    public function getStatusVisibility()
    {
        return $this->statusVisibility;
    }
}
