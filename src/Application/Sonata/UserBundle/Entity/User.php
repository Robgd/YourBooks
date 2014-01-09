<?php

/**
 * This file is part of the <name> project.
 *
 * (c) <yourname> <youremail>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Application\Sonata\UserBundle\Entity;

use Sonata\UserBundle\Entity\BaseUser as BaseUser;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * This file has been generated by the Sonata EasyExtends bundle ( http://sonata-project.org/bundles/easy-extends )
 *
 * References :
 *   working with object : http://www.doctrine-project.org/projects/orm/2.0/docs/reference/working-with-objects/en
 *
 * @author <yourname> <youremail>
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var string
     */
    protected $company;

    /**
     * @var string
     */
    protected $siret;


    protected $fileCV;

    /**
     * @var string
     */
    protected $cv;

    protected $fileMotivationLetter;

    /**
     * @var string
     */
    protected $motivationLetter;

    /**
     * @var string
     */
    protected $street;

    /**
     * @var integer
     */
    protected $zipcode;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var ArrayCollection
     */
    protected $books;

    private $temp;

    public function __construct()
    {
        parent::__construct();
        $this->books = new ArrayCollection();
    }


    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return 'sonata_user_class';
    }

    /**
     * Set company
     *
     * @param string $company
     * @return User
     */
    public function setCompany($company)
    {
        $this->company = $company;

        return $this;
    }

    /**
     * Get company
     *
     * @return string
     */
    public function getCompany()
    {
        return $this->company;
    }

    /**
     * Set siret
     *
     * @param string $siret
     * @return User
     */
    public function setSiret($siret)
    {
        $this->siret = $siret;

        return $this;
    }

    /**
     * Get siret
     *
     * @return string
     */
    public function getSiret()
    {
        return $this->siret;
    }

    /**
     * Set cv
     *
     * @param string $cv
     * @return User
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }

    /**
     * Set motivationLetter
     *
     * @param string $motivationLetter
     * @return User
     */
    public function setMotivationLetter($motivationLetter)
    {
        $this->motivationLetter = $motivationLetter;

        return $this;
    }

    /**
     * Get motivationLetter
     *
     * @return string
     */
    public function getMotivationLetter()
    {
        return $this->motivationLetter;
    }

    /**
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * @param int $zipcode
     */
    public function setZipcode($zipcode)
    {
        $this->zipcode = $zipcode;
    }

    /**
     * @return int
     */
    public function getZipcode()
    {
        return $this->zipcode;
    }

    /**
     * Add books
     *
     * @param \Yourbooks\BookBundle\Entity\Book $books
     * @return User
     */
    public function addBook(\Yourbooks\BookBundle\Entity\Book $books)
    {
        $this->books[] = $books;

        return $this;
    }

    /**
     * Remove books
     *
     * @param \Yourbooks\BookBundle\Entity\Book $books
     */
    public function removeBook(\Yourbooks\BookBundle\Entity\Book $books)
    {
        $this->books->removeElement($books);
    }

    /**
     * Get books
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getBooks()
    {
        return $this->books;

    }


    public function setFileCV(UploadedFile $fileCV = null)
    {
        $this->fileCV = $fileCV;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp  = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileCV()
    {
        return $this->fileCV;
    }

    /**
     * @return null|string
     */
    public function getAbsolutePathCV()
    {
        return null === $this->cv ? null : $this->getUploadRootDirCV().'/'.$this->cv;
    }

    /**
     * @return null|string
     */
    public function getWebPathCV()
    {
        return null === $this->cv ? null : $this->getUploadDirCV().'/'.$this->cv;
    }

    /**
     * @return string
     */
    public function getUploadRootDirCV()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../../web/'.$this->getUploadDirCV();
    }

    /**
     * @return string
     */
    public function getUploadDirCV()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/reader/CV';
    }


    public function preUploadCV()
    {
        if (null !== $this->getFileCV()) {
            // do whatever you want to generate a unique name
            $cv = sha1(uniqid(mt_rand(), true));
            $this->cv = $cv.'.'.$this->getFileCV()->guessExtension();
        }
    }


    public function uploadCV()
    {
        if (null === $this->getFileCV()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFileCV()->move($this->getUploadRootDirCV(), $this->cv);

        // check if we have an old file path
        if (isset($this->temp)) {
            // check if we have a true path
            if (is_file($filePath = $this->getUploadRootDirCV().'/'.$this->temp)) {
                // delete the old file
                unlink($filePath);
                // clear the temp file path
                $this->temp = null;
            }
        }
        $this->fileCV = null;
    }


    public function removeUploadCV()
    {
        if ($cv = $this->getAbsolutePathCV()) {
            unlink($cv);
        }
    }













    public function setFileMotivationLetter(UploadedFile $fileMotivation = null)
    {
        $this->fileMotivationLetter = $fileMotivation;
        // check if we have an old image path
        if (isset($this->path)) {
            // store the old name to delete after the update
            $this->temp  = $this->path;
            $this->path = null;
        } else {
            $this->path = 'initial';
        }
    }

    /**
     * Get file.
     *
     * @return UploadedFile
     */
    public function getFileMotivationLetter()
    {
        return $this->fileMotivationLetter;
    }

    /**
     * @return null|string
     */
    public function getAbsolutePathMotivationLetter()
    {
        return null === $this->motivationLetter ? null : $this->getUploadRootDirMotivationLetter().'/'.$this->motivationLetter;
    }

    /**
     * @return null|string
     */
    public function getWebPathMotivationLetter()
    {
        return null === $this->motivationLetter ? null : $this->getUploadDirMotivationLetter().'/'.$this->motivationLetter;
    }

    /**
     * @return string
     */
    public function getUploadRootDirMotivationLetter()
    {
        // the absolute directory path where uploaded
        // documents should be saved
        return __DIR__.'/../../../../../web/'.$this->getUploadDirMotivationLetter();
    }

    /**
     * @return string
     */
    public function getUploadDirMotivationLetter()
    {
        // get rid of the __DIR__ so it doesn't screw up
        // when displaying uploaded doc/image in the view.
        return 'uploads/reader/motivation';
    }


    public function preUploadMotivationLetter()
    {
        if (null !== $this->getFileMotivationLetter()) {
            // do whatever you want to generate a unique name
            $motivation = sha1(uniqid(mt_rand(), true));
            $this->motivationLetter = $motivation.'.'.$this->getFileMotivationLetter()->guessExtension();
        }
    }


    public function uploadMotivationLetter()
    {
        if (null === $this->getFileMotivationLetter()) {
            return;
        }

        // if there is an error when moving the file, an exception will
        // be automatically thrown by move(). This will properly prevent
        // the entity from being persisted to the database on error
        $this->getFileMotivationLetter()->move($this->getUploadRootDirMotivationLetter(), $this->motivationLetter);

        // check if we have an old file path
        if (isset($this->temp)) {
            // check if we have a true path
            if (is_file($filePath = $this->getUploadRootDirMotivationLetter().'/'.$this->temp)) {
                // delete the old file
                unlink($filePath);
                // clear the temp file path
                $this->temp = null;
            }
        }
        $this->fileMotivation = null;
    }


    public function removeUploadMotivationLetter()
    {
        if ($motivationLetter = $this->getAbsolutePathMotivationLetter()) {
            unlink($motivationLetter);
        }
    }

}