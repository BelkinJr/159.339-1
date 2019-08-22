<?php

// Fearon, 05178096 / Belkin, 17385402 - Assignment 1

namespace mfearonvbelkin\A1;

include "autoloader.php";

/**
 * Object contains data on valid Accounts and methods to retrieve this data
 *
 * Class Account
 * @package mfearonvbelkin\A1
 */
class Account {

    /**
     * Account ID
     *
     * @var string
     */
  private $mAccountId;

    /**
     * Current Account Balance
     *
     * @var float
     */
  private $mBalance;

    /**
     * Account constructor.
     * @param $newAccountId (string, Account ID)
     * @param $newBalance (float, Current Account Balance)
     */
  public function __construct ($newAccountId, $newBalance) {

    $this -> mAccountId = $newAccountId;
    $this -> mBalance = $newBalance;
  }

    /**
     * Returns Account ID
     *
     * @return string
     */
  public function getAccountId () { return $this -> mAccountId; }

    /**
     * Returns Current Account Balance
     *
     * @return float
     */
  public function getBalance () { return $this -> mBalance; }

    /**
     * Performs Transaction from Tranz.txt on the appropriate Account or throw an Exception Object BadTranzException
     *
     * @param $transaction (string Transaction Type)
     * @param $amount (float Transaction Amount)
     * @param $account (Account Class Object of Target Account or null)
     * @throws BadTranzException
     */
  public function setBalance ($transaction, $amount, $account) {


      /**
       * If the Transaction Type is D, the Transaction is a Positive value, then Process the Transaction
       */
    if ($transaction === "D" && $amount >= 0 ) {

        /**
         * Process the Deposit Transaction
         */
      $this -> mBalance += $amount;

      /**
       * If the Transaction Type is W, the Transaction is a Positive value, the Current Account Balance is higher than the Transaction Amount
       */
    } elseif ($transaction === "W" && $amount >= 0 && $this -> mBalance > $amount) {

        /**
         * Process the Withdrawal Transaction
         */
      $this -> mBalance -= $amount;

      /**
       * If neither of the above are true, throw an Object of Class BadTranzException derived from Exception Class
       */
    } else {

      throw new BadTranzException($this -> mAccountId, $this -> mBalance, $transaction, $amount, $account);
    }
  }
}
