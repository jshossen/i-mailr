<?php

// # Delete Invoice Sample
// This sample code demonstrate how you can delete
// an invoice.

/** @var Invoice $invoice */
$invoice = require 'CreateInvoice.php';

use PayPal\Api\Invoice;
use PayPal\Api\CancelNotification;

try {

    // ### Delete Invoice
    // Delete invoice object by calling the
    // `delete` method
    // on the Invoice class by passing a valid
    // notification object
    // (See bootstrap.php for more on `ApiContext`)
    $deleteStatus = $invoice->delete($apiContext);
} catch (Exception $ex) {
    ResultPrinter::printError("Delete Invoice", "Invoice", null, $deleteStatus, $ex);
    exit(1);
}

ResultPrinter::printResult("Delete Invoice", "Invoice", $invoice->getId(), null, null);
