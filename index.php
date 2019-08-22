<?php

// Fearon, 05178096 / Belkin, 17385402 - Assignment 1

namespace mfearonvbelkin\A1;

include "autoloader.php";



$inFile = fopen ("acct.txt", "r") or die ("ERROR: Could not open acct.txt!");

/**
 * Array containing Account Objects to hold the Account data from acct.txt, detailing Current Account Balances
 *
 * @var array
 */
$arrayAccounts = array();

/**
 * Array containing BadTranz Objects to hold the data from BadTranzException, detailing Invalid Transactions
 *
 * @var array
 */
$arrayBadTranz = array();

while (!feof($inFile)) {

    /**
     * Copy line by line into a temp string
     *
     * @var string
     */
  $tempString = fgets($inFile);

  if ($tempString != "") {

      /**
       * Split the string into temp variables for Account ID as a string and Current Account Balance as a string.
       */
    list($tempAccountId, $tempAmount) = explode(" ", $tempString);

      /**
       * Convert temp Amount to a float
       *
       * @var float
       */
    $tempAmount = floatval($tempAmount);

      /**
       * Create a new Account Object containing these two variables and add it to the array
       */
    $arrayAccounts[] = new Account($tempAccountId, $tempAmount);
  }

  $tempString = "";
}

fclose($inFile);



$inFile = fopen ("tranz.txt", "r") or die ("ERROR: Could not open tranz.txt!");

/**
 * Discard the header in tranz.txt
 */
$tempString = fgets($inFile);

/**
 * Initialize Transaction Counter to zero
 *
 * @var int
 */
$transactionCount = 0;

/**
 * Initialize Valid Transaction Counter to zero
 *
 * @var int
 */
$validTransactionCount = 0;

/**
 * Initialize Transaction Line Counter to zero
 *
 * @var int
 */
$dataLine = 0;

while (!feof($inFile)) {

    /**
     * Copy line by line into a temp string
     *
     * @var string
     */
  $tempString = fgets($inFile);

  if ($tempString != "") {

      /**
       * Increment the Transaction Line Counter:
       */
    $dataLine++;

      /**
       * Increment the Transaction Counter:
       */
    $transactionCount++;

      /**
       * Increment the Valid Transaction Counter:
       */
    $validTransactionCount++;

      /**
       * Split the string into temp variables for Account ID as a string, Transaction type as a string and Transaction amount as a string.
       */
    list($tempAccountId, $tempTransaction, $tempAmount) = explode(' ', $tempString);

      /**
       * Convert temp Amount to a float
       *
       * @var float
       */
    $tempAmount = floatval($tempAmount);

    $tempString = "";

    $tempAccount = null;

      /**
       * Loop through the Array of Account Objects to locate the target Account Object or null if it does not exist
       */
    foreach ($arrayAccounts as $Account) {

      if ($tempAccountId === $Account -> getAccountId()) {

        $tempAccount = $Account;

        break;
      }
    }

      /**
       * If the Target Account Object exists, then attempt to process the Transaction using Account Object Method setBalance
       */
    try {

      if ($tempAccount != null) {

        $tempAccount -> setBalance($tempTransaction, $tempAmount, $tempAccount);

      } else {

          /**
           * If the Target Account does not exist, then throw an Object of Class BadTranzException derived from Exception Class
           */
        throw new BadTranzException($tempAccountId, 0.0, $tempTransaction, $tempAmount, $tempAccount);
      }
    }

    catch(BadTranzException $exception) {

        /**
         * If an Exception is caught of type BadTranzException, decrement the Valid Transaction count.
         */
      $validTransactionCount--;

        /**
         * Create new Objects of Class BadTranz as required and add to the array
         */
      for ($i = 0; $i < $exception -> getReasonArrayLength(); $i++) {

        $arrayBadTranz[] = new BadTranz($dataLine, $exception -> getAccountId(), $exception -> getTransaction(),
                            $exception -> getAmount(), $exception -> getReason($i));
      }
    }
  }
}

fclose($inFile);



$outFile = fopen("update.txt", "w") or die ("ERROR: Could not open update.txt!");

foreach($arrayAccounts as $Account) {

    /**
     * Write the data from the Objects of Account Class in the array to the update.txt file in the same format as acct.txt
     */
  fwrite($outFile, $Account -> getAccountId() . ' ' . $Account -> getBalance() . PHP_EOL);
}

fclose($outFile);


/**
 * Load $html string with html code to display Transaction Count, Valid Transaction Count and a table to contain the Invalid Transaction data
 *
 * @var string
 */
$html = '<b> There were ' . $transactionCount . ' transactions in total. </b><br><br>
          <b> There were ' . $validTransactionCount . ' valid transactions. </b><br><br>
          <b> The following transactions are invalid: </b><br><br>
          <table style = "border: 1px solid black; border-collapse:collapse;"><tr>
          <td style = "border: 1px solid black; padding: 0px 10px 0px 10px"><b> Line # </b></td>
          <td style = "border: 1px solid black; padding: 0px 10px 0px 10px"><b> ID </b></td>
          <td style = "border: 1px solid black; padding: 0px 10px 0px 10px"><b> Type</b></td>
          <td style = "border: 1px solid black; padding: 0px 10px 0px 10px"><b> Amount </b></td>
          <td style = "border: 1px solid black; padding: 0px 10px 0px 10px"><b> Reason </b></td>
          </tr>';

/**
 * Load the string with html code to fill the table with the Invalid Transaction data from the Objects of Class BadTranz in the array
 */
foreach($arrayBadTranz as $BadTranz) {

  $html .= '<tr>' .
            '<td style = "text-align:center; border: 1px solid black; padding: 0px 10px 0px 10px">' . $BadTranz -> getLine() . '</td>' .
            '<td style = "text-align:center; border: 1px solid black; padding: 0px 10px 0px 10px">' . $BadTranz -> getAccountId() . '</td>' .
            '<td style = "text-align:center; border: 1px solid black; padding: 0px 10px 0px 10px">' . $BadTranz -> getTransaction() . '</td>' .
            '<td style = "text-align:center; border: 1px solid black; padding: 0px 10px 0px 10px">' . $BadTranz -> getAmount() . '</td>' .
            '<td style = "text-align:left; border: 1px solid black; padding: 0px 10px 0px 10px">' . $BadTranz -> getReason() . '</td>' .
            '</tr>';
}

$html .= "</table>";

/**
 * Print the html data to browser
 */
echo $html;
