<?php 
namespace utility;

if (!defined('BASEPATH')) exit('No direct script access allowed');
defined('BASEPATH') OR exit('No direct script access allowed');


/* A wrapper to do organise item names & prices into columns */
class CartItems
{
    private $name;
    private $price;
    private $nairaSign;

    public function __construct($name = '', $price = '', $nairaSign = true)
    {
        $this->name = $name;
        $this->price = $price;
        $this->nairaSign = $nairaSign;
    }

    public function __toString()
    {
        $rightCols = 6;
        $leftCols = 30;
        if ($this->nairaSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols) ;
        $nairaUnicode = "N";
        $sign = ($this->nairaSign ? $$nairaUnicode : '');
        $right = str_pad($sign.$this->price, $rightCols, ' ', STR_PAD_LEFT);
        return "$left$right\n";
    }
}