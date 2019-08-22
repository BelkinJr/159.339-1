<?php

// Fearon, 05178096 / Belkin, 17385402 - Assignment 1

namespace mfearonvbelkin\A1;

/**
/**
 * Processes Invalid Transactions from Account Class Object and creates Reasons for the Transaction being Invalid
 *
 * Object is a custom Exception derived from the Exception Class
 *
 * Class BadTranzException
 * @package mfearonvbelkin\A1
 */
class BadTranzException extends \Exception {

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
     * Transaction Type
     *
     * @var string
     */
  private $mTransaction;

    /**
     * Transaction Amount
     *
     * @var float
     */
  private $mAmount;

    /**
     * Target Account or null
     *
     * @var Account Class Object
     */
  private $mAccountValid;

    /**
     * Array of Reasons that the Transaction is Invalid
     *
     * @var array
     */
  private $mReasonArray = array();

    /**
     * BadTranzException constructor.
     * @param $newAccountId (string, Account ID)
     * @param $newBalance (float, Current Account Balance)
     * @param $newTransaction (string, Transaction Type)
     * @param $newAmount (float, Transaction Amount)
     * @param $newAccountValid (Account, Class Object Target Account or null)
     */
  public function __construct ($newAccountId, $newBalance, $newTransaction, $newAmount, $newAccountValid) {

    $this -> mAccountId = $newAccountId;
    $this -> mBalance = $newBalance;
    $this -> mTransaction = $newTransaction;
    $this -> mAmount = $newAmount;
    $this -> mAccountValid = $newAccountValid;

      /**
       * If the Transaction Amount is Negative, then the Transaction is Invalid
       */
    if ($this -> mAmount < 0) {

      $this -> mReasonArray[] = "Negative Transaction Amount";
    }

      /**
       * If the Account exists and the Current Account Balance is less than the Withdrawal Transaction Amount, then the Transaction is Invalid
       */
    if ($this -> mAccountValid != null && $this -> mTransaction == "W") {

      if ($this -> mBalance < $this -> mAmount) {

        $this -> mReasonArray[] = "Insufficient Balance";
      }
    }

      /**
       * If the Transaction Type is not W for Withdrawal or D for Deposit, then the Transaction is Invalid
       */
    if ($this -> mTransaction !== "W" && $this -> mTransaction !== "D") {

      $this -> mReasonArray[] = "Invalid Transaction Type";

    }

      /**
       * If the Account does not exist, then the Transaction is Invalid
       */
    if ($this -> mAccountValid == null) {

      $this -> mReasonArray[] = "Invalid Account ID";
    }

    parent::__construct();
  }

    /**
     * Returns Account ID
     *
     * @return string
     */
    public function getAccountId () { return $this -> mAccountId; }

    /**
     * Returns Transaction Amount
     *
     * @return float
     */
    public function getAmount () { return $this -> mAmount; }

    /**
     * Returns Transaction Type
     *
     * @return string
     */
    public function getTransaction () { return $this -> mTransaction; }

    /**
     * Returns data at position i in the Array of Reasons for the Transaction being Invalid
     *
     * @param $i
     * @return mixed
     */
    public function getReason ($i) { return $this -> mReasonArray[$i]; }

    /**
     * Returns the length of the Array of Reasons for the Transaction being Invalid
     *
     * @return int
     */
    public function getReasonArrayLength () { return sizeof($this -> mReasonArray); }
}
