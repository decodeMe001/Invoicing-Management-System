<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

defined('BASEPATH') OR exit('No direct script access allowed');
	
// IMPORTANT - Replace the following line with your path to the escpos-php autoload script
require_once __DIR__ . '\..\..\vendor\mike42\escpos-php\autoload.php';
require_once __DIR__ . '\..\..\autoload.php';


use Mike42\Escpos\PrintConnectors\NetworkPrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer;

// cart-class
use utility\CartItems;

class ReceiptPrint {

	private $CI;
	private $connector;
	private $printer;

	// TODO: printer settings
	// Make this configurable by printer (32 or 48 probably)
	private $printer_width = 32;

	function __construct()
	{
		$this->CI =& get_instance(); // This allows you to call models or other CI objects with $this->CI->... 
	}

	function connect()
	{
		$this->connector = new WindowsPrintConnector("webpos");
		$this->printer = new Printer($this->connector);
	}

	private function check_connection()
	{
	if (!$this->connector OR !$this->printer OR !is_a($this->printer, 'Mike42\Escpos\Printer')) {
		throw new Exception("Tried to create receipt without being connected to a printer.");
	}
	}

	public function close_after_exception()
	{
	if (isset($this->printer) && is_a($this->printer, 'Mike42\Escpos\Printer')) {
		$this->printer->close();
	}
		$this->connector = null;
		$this->printer = null;
		$this->emc_printer = null;
	}

	// Calls printer->text and adds new line
	private function add_line($text = "", $should_wordwrap = true)
	{
		$this->printer->text($text."\n");
	}


	public function print_test_receipt($header=" ", $items=" ", $subtotal=" ", $balance=" ", $tax=" ", $total=" ")
	{

		$this->check_connection();
		$this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$this->printer->text("Blessed Stan Photos Ltd.\n");
		$this->printer->selectPrintMode();
		$this->printer->text("No. 1 Asika Ilobi Sreet, Orlu, Imo State.\n");
		$this->printer->feed();
		/* Title of receipt */
		$this->printer->setEmphasis(true);
		$this->printer->text("SALES INVOICE\n");
		$this->printer->setEmphasis(false);

		/* Items */
		$this->printer->setJustification(Printer::JUSTIFY_LEFT);
		$this->printer->setEmphasis(true);
		$this->add_line($header);
		$this->printer->setEmphasis(false);
		
		/* Looping through Items */
		foreach ($items as $item) {
			$this->add_line(new CartItems($item['order_photo_type'].'['.$item['order_photo_size'].']'.'('.$item['order_item_quantity'].')', $item['order_item_price']));
		}
		$this->printer->setEmphasis(true);
		$this->add_line($subtotal);
		$this->printer->setEmphasis(false);
		$this->printer->feed();

		/* Tax and total */
		$this->add_line($tax);
		$this->add_line($balance);
		$this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$this->add_line($total);
		$this->printer->selectPrintMode();

		/* Footer */
		$this->printer->feed(2);
		$this->printer->setJustification(Printer::JUSTIFY_CENTER);
		$this->printer->text("Thank you for shopping at BlessedStan\n");
		$this->printer->text("For trading hours, call: +2348037974772\n");
		$this->printer->text("Email: blessedstaninvestment@yahoo.com\n");
		$this->printer->feed(2);
		$this->printer->text(date('Y-m-d H:i:s')."\n");

		/* Cut the receipt and open the cash drawer */
		$this->printer->cut(Printer::CUT_PARTIAL);
		$this->printer-> pulse();
		$this->printer-> close();
	}

}