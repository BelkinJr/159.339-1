<?php

// Fearon, 05178096 / Belkin, 17385402 - Assignment 1

namespace mfearonvbelkin\A1;

/**
 * Object contains data on invalid transactions and methods to retrieve this data
 *
 * Class BadTranz
 * @package mfearonvbelkin\A1
 */
class BadTranz {

    /**
     * Line number from tranz.txt
     *
     * @var int
     */
  private $mLine;

    /**
     * Account ID
     *
     * @var string
     */
  private $mAccountId;

    /**
     *  Transaction Type
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
     * Reason for Invalid Transaction
     *
     * @var string
     */
  private $mReason;

    /**
     * BadTranz constructor.
     * @param $newLine int Line number from tranz.txt
     * @param $newAccountId string Account ID
     * @param $newTransaction string Transaction Type
     * @param $newAmount float Transaction Amount
     * @param $newReason string Reason for Invalid Transaction
     */
  public function __construct ($newLine, $newAccountId, $newTransaction, $newAmount, $newReason) {

    $this -> mLine = $newLine;
    $this -> mAccountId = $newAccountId;
    $this -> mTransaction = $newTransaction;
    $this -> mAmount = $newAmount;
    $this -> mReason = $newReason;
  }

    /**
     * Returns Line number from tranz.txt
     *
     * @return int
     */
  public function getLine() { return $this -> mLine; }

    /**
     * Returns Account ID
     *
     * @return string
     */
  public function getAccountId() { return $this -> mAccountId; }

    /**
     * Returns Transaction Type
     *
     * @return string
     */
  public function getTransaction() { return $this -> mTransaction; }

    /**
     * Returns Transaction Amount
     *
     * @return float
     */
  public function getAmount() { return $this -> mAmount; }

    /**
     * Returns Reason for Invalid Transaction
     *
     * @return string
     */
  public function getReason() { return $this -> mReason; }
}
