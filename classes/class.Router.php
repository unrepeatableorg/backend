<?php

namespace Carbon\Router;

/**
 * A class which is responsible for router the request to the required page.
 *
 * @author  Joeri Hermans
 * @since   16 February 2016
 */

use \Carbon\Page\AbstractPage;
use \Carbon\Page\PageNotFound;

class Router
{

    /**
     * Contains a list of pages which are registered with this router.
     */
    private $mPages = array();

    /**
     * Contains the routed view.
     */
    private $mView = null;

    /**
     * Contains the segments of the requested URL.
     */
    private $mSegments = array();

    /**
     * Contains the number of segments.
     */
    private $mNumSegments = 0;

    /**
     * Contains the base of the application directory.
     */
    private $mBaseLength = 0;

    /**
     * Holds the page which has been set as the default home-page.
     */
    private $mPageHome;

    private function setSegments($path)
    {
        if( $path != "/" ) {
            $this->mSegments = explode("/", $path);
            array_shift($this->mSegments);
            $this->mNumSegments = count($this->mSegments);
        }
    }

    private function cleanPath($path)
    {
        $path = substr($path, $this->mBaseLength);
        $length = strlen($path);
        if( $length === 0 ) {
            $path = "/";
        } elseif( $length > 1 && $path[$length - 1] == '/' ) {
            $path = substr($path, 0, $length - 1);
        }

        return $path;
    }

    private function computeView($path)
    {
        $view = null;

        $keys = array_keys($this->mPages);
        foreach($keys as $k) {
            if( preg_match('#' . $k . '#', $path) ) {
                $view = $this->mPages[$k];
                break;
            }
        }

        return $view;
    }

    public function __construct()
    {
        // Nothing to do here.
    }

    public function __destruct() {
        unset($this->mPages);
        unset($this->mSegments);
    }

    public function setHomePage($homePage)
    {
        if( $homePage instanceof AbstractPage )
            $this->mPageHome = $homePage;
    }

    public function registerPage($path, $pageClass)
    {
        $this->mPages[$path] = $pageClass;
    }

    public function setBase($base)
    {
        $this->mBaseLength = strlen($base);
    }

    public function numSegments()
    {
        return $this->mNumSegments;
    }

    public function getSegment($index)
    {
        return $this->mSegments[$index];
    }

    public function route()
    {
        $path = $this->cleanPath($_SERVER['REQUEST_URI']);
        $this->setSegments($path);
        $view = $this->computeView($path);
        if( $view === null ) {
            $view = new $this->mPages[PageNotFound::PATH];
        }
        $this->mView = new $view();
    }

    public function getView()
    {
        return $this->mView;
    }

}
