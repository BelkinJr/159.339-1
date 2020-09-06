# 159.339-1

A simple ATM mechanism, gets input from 2 files which are *acct.txt* and *tranz.txt* 

*acct.txt* has numbers of bank accounts and a corresponding balances

*tranz.txt* has ids that transactions have to be preformed on, type of a transaction D (deposit) or W (withdrawal) and the amount 

Once processing is finished, store updated balances in *update.txt* in the same format as *acct.txt* 

If a transaction is invalid (invalid transaction type – anything other than D or W, invalid amount or the account does not have sufficient balance), then nothing is changed. Invalid transactions diaplsyed in browser using html
