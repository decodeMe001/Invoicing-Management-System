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
		$this->connector = new WindowsPrintConnector("POS-59");
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
	}

	public function print_test_receipt($header="", $items, $subtotal, $total, $tax="", $cashier="")
	{
		$this->check_connection();
		$this->printer->selectPrintMode(Printer::MODE_DOUBLE_WIDTH);
		$this->printer->text("LIZZYLOVE PHARM.\n");
		$this->printer->feed();
		$this->printer->selectPrintMode();
		$this->printer->setJustification(Printer::JUSTIFY_CENTER);
		$this->printer->text("135, Alhaji Hassan B/Stop, beside AP Filling Station, Camp. Davies Rd., Isefun, Ayobo, Lagos.\n");
		$this->printer->text("TEL: +2348143702571.\n");
		/* Title of receipt */
		$this->printer->feed();
		$this->printer->setJustification(Printer::JUSTIFY_CENTER);
		$this->printer->setEmphasis(true);
		$this->printer->text("SALES INVOICE\n");
		$this->printer->setEmphasis(false);	
		/* Items */
		$this->printer->setJustification(Printer::JUSTIFY_CENTER);
		$this->printer->text($header);
		/* Looping through Items */
		$this->printer->setEmphasis(false);	
		foreach ($items as $item) {
			$this->printer->text(new CartItems($item["name"].'['.'x'.$item['qty'].']', number_format($item['subtotal'], 0, '.', ',')));
		}
		
		/* Tax and total */
		// $this->printer->selectPrintMode(Printer::JUSTIFY_CENTER);
		$this->printer->feed();
		$this->printer->selectPrintMode();
		$this->printer->setJustification(Printer::JUSTIFY_CENTER);
		$this->printer->text($tax);
		$this->printer->text($subtotal);
		$this->printer->text($total);
		$this->printer->feed();
		
		/* Footer */
		$this->printer->setJustification(Printer::JUSTIFY_CENTER);
		$this->printer->text("Thanks for your purchase!\n");
		$this->printer->text("ITEM(S) PURCHASED IN GOOD CONDITION ARE NOT REFUNDABLE.\n");
		$this->printer->text($cashier);
		$this->printer->text(date('Y-m-d H:i:s')."\n");

		/* Cut the receipt and open the cash drawer */
		$this->printer->cut(Printer::CUT_PARTIAL);
		$this->printer-> pulse();
		$this->printer-> close();
	}

}