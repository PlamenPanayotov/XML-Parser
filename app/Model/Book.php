<?php
namespace App\Model;

class Book
{
    private $id;

    private $name;

    private $author;

    private $postingDate;

    public function __construct()
    {
        $this->id = uniqid();
        $this->postingDate = date('d-m-y');
    }
    

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */ 
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Get the value of name
     */ 
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @return  self
     */ 
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get the value of author
     */ 
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * Set the value of author
     *
     * @return  self
     */ 
    public function setAuthor($author)
    {
        $this->author = $author;

        return $this;
    }

    /**
     * Get the value of postingDate
     */ 
    public function getPostingDate()
    {
        return $this->postingDate;
    }

    /**
     * Set the value of postingDate
     *
     * @return  self
     */ 
    public function setPostingDate($postingDate)
    {
        $this->postingDate = $postingDate;

        return $this;
    }
}