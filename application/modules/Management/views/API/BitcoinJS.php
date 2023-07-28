<h1>BitcoinJS Library Functions</h1>

<?php
$functions = [
    [
        'name' => 'Get New Address',
        'description' => 'This function generates a new random key pair and returns the corresponding Bitcoin address. This address can be used to receive funds.',
        'code' => 'public function getNewAddress() {...}'
    ],
    [
        'name' => 'Get New Key Pair',
        'description' => 'This function generates a new random key pair and returns both the private key and the public key. The private key should be kept secret and is needed to spend funds. The public key can be shared and is used to verify signatures.',
        'code' => 'public function getNewKeyPair() {...}'
    ],
    [
        'name' => 'Get Address From Public Key',
        'description' => 'This function takes a public key and returns the corresponding Bitcoin address.',
        'code' => 'public function getAddressFromPublicKey($publicKey) {...}'
    ],
    [
        'name' => 'Create Transaction',
        'description' => 'This function takes an array of inputs and an array of outputs and creates a new transaction. Each input should be an object with a `txid` and a `vout` property. Each output should be an object with an `address` and a `value` property.',
        'code' => 'public function createTransaction($inputs,$outputs) {...}'
    ],
    [
        'name' => 'Add Input To Transaction',
        'description' => 'This function takes a transaction, a transaction id, and an output index, and adds an input to the transaction.',
        'code' => 'public function addInputToTransaction($transactionHex,$txid,$vout) {...}'
    ],
    [
        'name' => 'Get Transaction Inputs',
        'description' => 'This function takes a transaction and returns an array of its inputs. Each input is an object with a `txid` and a `vout` property.',
        'code' => 'public function getTransactionInputs($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Outputs',
        'description' => 'This function takes a transaction and returns an array of its outputs. Each output is an object with an `address` and a `value` property.',
        'code' => 'public function getTransactionOutputs($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Id',
        'description' => 'This function takes a transaction and returns its id. The transaction id is a hash of the transaction data and is used to identify the transaction on the blockchain.',
        'code' => 'public function getTransactionId($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Total Input Value',
        'description' => 'This function takes a transaction and returns the total value of its inputs.',
        'code' => 'public function getTransactionTotalInputValue($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Total Output Value',
        'description' => 'This function takes a transaction and returns the total value of its outputs.',
        'code' => 'public function getTransactionTotalOutputValue($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Fee',
        'description' => 'This function takes a transaction and returns its fee. The fee is the difference between the total input value and the total output value.',
        'code' => 'public function getTransactionFee($transactionHex) {...}'
    ],
    [
        'name' => 'Sign Transaction',
        'description' => 'This function takes a private key, a transaction, an input index, an amount, and an address, and signs the input of the transaction.',
        'code' => 'public function signTransaction($privateKey,$transactionHex,$inputIndex,$amount,$address) {...}'
    ],
    [
        'name' => 'Verify Transaction Signature',
        'description' => 'This function takes a transaction, an input index, an amount, and an address, and verifies the signature of the input.',
        'code' => 'public function verifyTransactionSignature($transactionHex,$inputIndex,$amount,$address) {...}'
    ],
    [
        'name' => 'Get Transaction Version',
        'description' => 'This function takes a transaction and returns its version.',
        'code' => 'public function getTransactionVersion($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Locktime',
        'description' => 'This function takes a transaction and returns its locktime.',
        'code' => 'public function getTransactionLocktime($transactionHex) {...}'
    ],
    [
        'name' => 'Is Segwit',
        'description' => 'This function takes a transaction and checks if it is a SegWit transaction.',
        'code' => 'public function isSegwit($transactionHex) {...}'
    ],
    [
        'name' => 'Get Witness Commitment',
        'description' => 'This function takes a transaction and returns its witness commitment.',
        'code' => 'public function getWitnessCommitment($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Virtual Size',
        'description' => 'This function takes a transaction and returns its virtual size.',
        'code' => 'public function getTransactionVirtualSize($transactionHex) {...}'
    ],
    [
        'name' => 'Has Witnesses',
        'description' => 'This function takes a transaction and checks if it has any witness data.',
        'code' => 'public function hasWitnesses($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Hash',
        'description' => 'This function takes a transaction and returns its hash.',
        'code' => 'public function getTransactionHash($transactionHex,$witness=false) {...}'
    ],
    [
        'name' => 'Get Transaction Buffer',
        'description' => 'This function takes a transaction and returns its raw binary data as a buffer.',
        'code' => 'public function getTransactionBuffer($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Byte Length',
        'description' => 'This function takes a transaction and returns its length in bytes.',
        'code' => 'public function getTransactionByteLength($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Overhead Byte Length',
        'description' => 'This function takes a transaction and returns the length of its overhead (non-input and non-output data) in bytes.',
        'code' => 'public function getTransactionOverheadByteLength($transactionHex) {...}'
    ],
    [
        'name' => 'Get Transaction Virtual Byte Length',
        'description' => 'This function takes a transaction and returns its virtual size in bytes.',
        'code' => 'public function getTransactionVirtualByteLength($transactionHex) {...}'
    ],
];

foreach ($functions as $function) {
    echo '<div class="function">';
    echo '<div class="function-name">' . htmlspecialchars($function['name']) . '</div>';
    echo '<div class="description">' . htmlspecialchars($function['description']) . '</div>';
    echo '<div class="code">' . htmlspecialchars($function['code']) . '</div>';
    echo '</div>';
}
?>