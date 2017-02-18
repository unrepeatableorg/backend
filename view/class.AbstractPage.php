<?php

namespace Carbon\Page;

/**
 * A class which describes the abstract properties and actions of
 * a page.
 * 
 * @author  Joeri Hermans
 * @since   17 February 2016
 */

abstract class AbstractPage
{

    /**
     * Contains the title of the page.
     */
    private $mTitle;
    
    public function setTitle($title)
    {
        $this->mTitle = $title;
    }
    
    public function containsTitle()
    {
        return ( isset($this->mTitle) && strlen($this->mTitle) > 0 );
    }
    
    public function getTitle()
    {
        return $this->mTitle;
    }
    
    abstract public function draw();

}
