<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Bitcoinjs {

    private $v8;

    public function __construct() {
        // Create a new V8Js instance
        $this->v8 = new V8Js();

        // Load the BitcoinJS library
        $bitcoinjs = file_get_contents('/path/to/bitcoin.js');
        $this->v8->executeString($bitcoinjs);
    }

    public function getNewAddress() {
        // This function generates a new random key pair and returns the corresponding Bitcoin address. This address can be used to receive funds.
        $js = <<<EOT
            var keyPair = Bitcoin.ECPair.makeRandom();
            var address = Bitcoin.payments.p2pkh({ pubkey: keyPair.publicKey }).address;
            address;
        EOT;

        // Execute the JavaScript code and return the result
        return $this->v8->executeString($js);
    }

    // This function generates a new random key pair and returns both the private key and the public key. 
    // The private key should be kept secret and is needed to spend funds. 
    // The public key can be shared and is used to verify signatures.
    public function getNewKeyPair() {
        $js = <<<EOT
            var keyPair = Bitcoin.ECPair.makeRandom();
            var privateKey = keyPair.privateKey.toString('hex');
            var publicKey = keyPair.publicKey.toString('hex');
            { privateKey: privateKey, publicKey: publicKey };
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a public key and returns the corresponding Bitcoin address.
    public function getAddressFromPublicKey($publicKey) {
        $js = <<<EOT
            var publicKeyBuffer = Buffer.from('$publicKey', 'hex');
            var address = Bitcoin.payments.p2pkh({ pubkey: publicKeyBuffer }).address;
            address;
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes an array of inputs and an array of outputs and creates a new transaction. 
    // Each input should be an object with a txid and a vout property. 
    // Each output should be an object with an address and a value property.
    public function createTransaction($inputs, $outputs) {
        $js = <<<EOT
            var psbt = new Bitcoin.Psbt();
            $inputs.forEach(function(input) {
                psbt.addInput({
                    hash: input.txid,
                    index: input.vout,
                    sequence: 0xffffffff
                });
            });
            $outputs.forEach(function(output) {
                psbt.addOutput({
                    address: output.address,
                    value: output.value
                });
            });
            psbt.toHex();
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a transaction, a transaction id, and an output index, and adds an input to the transaction.
    public function addInputToTransaction($transactionHex, $txid, $vout) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.addInput('$txid', $vout);
            transaction.toHex();
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a transaction and returns an array of its inputs. 
    // Each input is an object with a txid and a vout property.
    public function getTransactionInputs($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            var inputs = transaction.ins.map(function(input) {
                return {
                    txid: input.hash.toString('hex'),
                    vout: input.index
                };
            });
            JSON.stringify(inputs);
        EOT;
    
        return json_decode($this->v8->executeString($js), true);
    }
    
    // This function takes a transaction and returns an array of its outputs. 
    // Each output is an object with an address and a value property.
    public function getTransactionOutputs($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            var outputs = transaction.outs.map(function(output) {
                return {
                    address: Bitcoin.address.fromOutputScript(output.script),
                    value: output.value
                };
            });
            JSON.stringify(outputs);
        EOT;
    
        return json_decode($this->v8->executeString($js), true);
    }
    
    // This function takes a transaction and returns its id. 
    // The transaction id is a hash of the transaction data and is used to identify the transaction on the blockchain.
    public function getTransactionId($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.getId();
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a transaction and returns the total value of its inputs.
    public function getTransactionTotalInputValue($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            var totalInputValue = transaction.ins.reduce(function(total, input) {
                return total + input.value;
            }, 0);
            totalInputValue;
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns the total value of its outputs.
    public function getTransactionTotalOutputValue($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            var totalOutputValue = transaction.outs.reduce(function(total, output) {
                return total + output.value;
            }, 0);
            totalOutputValue;
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns the total value of its outputs.
    public function getTransactionFee($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            var inputTotal = transaction.ins.reduce(function(total, input) {
                return total + input.value;
            }, 0);
            var outputTotal = transaction.outs.reduce(function(total, output) {
                return total + output.value;
            }, 0);
            inputTotal - outputTotal;
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a private key, a transaction, an input index, an amount, and an address, and signs the input of the transaction.
    public function signTransaction($privateKey, $transactionHex, $inputIndex, $amount, $address) {
        $js = <<<EOT
            var keyPair = Bitcoin.ECPair.fromPrivateKey(Buffer.from('$privateKey', 'hex'));
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            var hashType = Bitcoin.Transaction.SIGHASH_ALL;
            var signature = transaction.sign($inputIndex, keyPair, null, hashType, $amount);
            var scriptSig = Bitcoin.payments.p2pkh({ pubkey: keyPair.publicKey, signature: signature }).input;
            transaction.setInputScript($inputIndex, scriptSig);
            transaction.toHex();
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction, an input index, an amount, and an address, and verifies the signature of the input.
    public function verifyTransactionSignature($transactionHex, $inputIndex, $amount, $address) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            var scriptSig = transaction.ins[$inputIndex].script;
            var pubkey = Bitcoin.payments.p2pkh({ output: scriptSig }).pubkey;
            var signature = Bitcoin.payments.p2pkh({ input: scriptSig, output: scriptSig }).signature;
            var hashType = Bitcoin.Transaction.SIGHASH_ALL;
            var hash = transaction.hashForSignature($inputIndex, scriptSig, hashType);
            var keyPair = Bitcoin.ECPair.fromPublicKey(pubkey);
            keyPair.verify(hash, signature);
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a transaction and returns its version.
    public function getTransactionVersion($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.version;
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns its locktime.
    public function getTransactionLocktime($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.locktime;
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a transaction and checks if it is a SegWit transaction.
    public function isSegwit($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.isSegwit();
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a transaction and returns its witness commitment.
    public function getWitnessCommitment($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.getWitnessCommitment().toString('hex');
        EOT;
    
        return $this->v8->executeString($js);
    }
        
    // This function takes a transaction and returns its virtual size.
    public function getTransactionVirtualSize($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.virtualSize();
        EOT;
    
        return $this->v8->executeString($js);
    }

    // This function takes a transaction and checks if it has any witness data.
    public function hasWitnesses($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.hasWitnesses();
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns its hash.
    public function getTransactionHash($transactionHex, $witness = false) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.getHash($witness).toString('hex');
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns its raw binary data as a buffer.
    public function getTransactionBuffer($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.toBuffer().toString('hex');
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns its length in bytes.
    public function getTransactionByteLength($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.byteLength();
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns its length in bytes.
    public function getTransactionOverheadByteLength($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.overheadLength();
        EOT;
    
        return $this->v8->executeString($js);
    }
    
    // This function takes a transaction and returns its virtual size in bytes. 
    // The virtual size is a measure of the transaction's weight that takes into account the discount for witness data introduced by SegWit.
    public function getTransactionVirtualByteLength($transactionHex) {
        $js = <<<EOT
            var transaction = Bitcoin.Transaction.fromHex('$transactionHex');
            transaction.virtualSize();
        EOT;
    
        return $this->v8->executeString($js);
    }
    
}
