<script>
function createWalletAddressDGB() {
	var DIGIBYTE = {
		baseNetwork: "digibyte",
		messagePrefix: '\x18DigiByte Signed Message:\n',
		messagePrefix: 'x19DigiByte Signed Message:\n',
		bech32: 'dgb',
		bip32: {
			public: 0x04b24746,
			private: 0x04b2430c,
		},
		pubKeyHash: 0x1e,
		scriptHash: 0x3f,
		wif: 0xb0,
	};
	var keyPair = Bitcoin.ECPair.makeRandom({ network: DIGIBYTE });
	var address = Bitcoin.payments.p2pkh({
		pubkey: keyPair.publicKey,
		network: DIGIBYTE,
	}).address;
	//~ Bitcoin.assert.strictEqual(address.startsWith('dgb'), true);      
	
	document.getElementById('private_key').value = keyPair.toWIF();
	document.getElementById('public_key').value = address;
	//~ TEST GENERATED WALLET ADDRESS
	//~ console.log(keyPair.toWIF()); 
	//~ console.log(address);

}
</script>
<script>
function sendCoinsToMyMI() {
	var key = Bitcoin.ECKey.fromWIF("DFhiAqX1Ta7Cm4nbyB9QTYcEqJ2No1wLFu");
	var tx = new Bitcoin.TransactionBuilder();
	tx.addInput("d18e7106e5492baf8f3929d2d573d27d89277f3825d3836aa86ea1d843b5158b", 1);
	tx.addOutput("12idKQBikRgRuZEbtxXQ4WFYB7Wa3hZzhT", 149000);
	tx.sign(0, key);
	console.log(tx.build().toHex());
}
</script>
