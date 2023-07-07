<?php 
namespace utility;

<<<<<<< HEAD
if (!defined('BASEPATH')) exit('No direct script access allowed');
=======
<<<<<<< HEAD
if (!defined('BASEPATH')) exit('No direct script access allowed');
=======
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
>>>>>>> 0da628fe696508bd39c21c22e2116dbf7925a3e3
defined('BASEPATH') OR exit('No direct script access allowed');


/* A wrapper to do organise item names & prices into columns */
class CartItems
{
    private $name;
    private $price;
    private $nairaSign;

<<<<<<< HEAD
=======
<<<<<<< HEAD
>>>>>>> 0da628fe696508bd39c21c22e2116dbf7925a3e3
    public function __construct($name = '', $price = '', $nairaSign = true)
    {
        $this->name = $name;
        $this->price = $price;
        $this->nairaSign = $nairaSign;
<<<<<<< HEAD
=======
=======
    public function __construct($name = '', $price = '', $nairaSign = false)
    {
        $this -> name = $name;
        $this -> price = $price;
        $this -> nairaSign = $nairaSign;
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
>>>>>>> 0da628fe696508bd39c21c22e2116dbf7925a3e3
    }

    public function __toString()
    {
<<<<<<< HEAD
        $rightCols = 6;
        $leftCols = 30;
=======
        $rightCols = 10;
        $leftCols = 38;
<<<<<<< HEAD
>>>>>>> 0da628fe696508bd39c21c22e2116dbf7925a3e3
        if ($this->nairaSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this->name, $leftCols) ;
        $nairaUnicode = "N";
        $sign = ($this->nairaSign ? $$nairaUnicode : '');
        $right = str_pad($sign.$this->price, $rightCols, ' ', STR_PAD_LEFT);
<<<<<<< HEAD
=======
=======
        if ($this -> nairaSign) {
            $leftCols = $leftCols / 2 - $rightCols / 2;
        }
        $left = str_pad($this -> name, $leftCols) ;

        $sign = ($this -> nairaSign ? '# ' : '');
        $right = str_pad($sign . $this -> price, $rightCols, ' ', STR_PAD_LEFT);
>>>>>>> 060766fe05b38dadf2897b881fab97884399e5e3
>>>>>>> 0da628fe696508bd39c21c22e2116dbf7925a3e3
        return "$left$right\n";
    }
}