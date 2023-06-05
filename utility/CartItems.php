<?php 
namespace utility;

<<<<<<< HEAD
if (!defined('BASEPATH')) exit('No direct script access allowed');
=======
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
defined('BASEPATH') OR exit('No direct script access allowed');


/* A wrapper to do organise item names & prices into columns */
class CartItems
{
    private $name;
    private $price;
    private $nairaSign;

<<<<<<< HEAD
    public function __construct($name = '', $price = '', $nairaSign = true)
    {
        $this->name = $name;
        $this->price = $price;
        $this->nairaSign = $nairaSign;
=======
    public function __construct($name = '', $price = '', $nairaSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> nairaSign = $nairaSign;
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
    }

    public function __toString()
    {
        $rightCols = 10;
        $leftCols = 38;
<<<<<<< HEAD
        if ($this->nairaSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols) ;
        $nairaUnicode = "N";
        $sign = ($this->nairaSign ? $$nairaUnicode : '');
        $right = str_pad($sign.$this->price, $rightCols, ' ', STR_PAD_LEFT);
=======
        if ($this -> nairaSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> nairaSign ? '# ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
        return "$left$right\n";
    }
}