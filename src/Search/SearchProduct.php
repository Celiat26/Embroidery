<?php 

namespace App\Search;



class SearchProduct
{
    private $filterByName;

    private $filterByCategory;

    /**
     * Get the value of filterByName
     */ 
    public function getFilterByName()
    {
        return $this->filterByName;
    }

    /**
     * Set the value of filterByName
     *
     * @return  self
     */ 
    public function setFilterByName($filterByName)
    {
        $this->filterByName = $filterByName;

        return $this;
    }

    /**
     * Get the value of filterByCategory
     */ 
    public function getFilterByCategory()
    {
        return $this->filterByCategory;
    }

    /**
     * Set the value of filterByCategory
     *
     * @return  self
     */ 
    public function setFilterByCategory($filterByCategory)
    {
        $this->filterByCategory = $filterByCategory;

        return $this;
    }
}