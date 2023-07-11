<div id="plus-wallet-tester">
    <script>
        //openModal with the data-id in the button itself.
        function openModal(e){
            //...
            //Open the modal, which can have an input field of id "addwallet-row-id"
            const secretInput = document.querySelector("#addwallet-row-id");
            secretInput.value = e.target.dataset.id; //Get the data-id property from the clicked button. You just need to change the target with js selectors if need so
            //...
        }
    </script>


    <h2>+ Wallet</h2>
    <!-- For each row you would print an unique id, even the db one can work fine, in the data-id property of either the button or the row itself if it needs to be used by more elements. The only thing to change is where the function pulls the data-id from -->
        <div><button onclick="openModal(event)" data-id=<?php echo "j23423" ?>>+ Wallet</button></div>

    <h3>The secret input which would go in the modal</h3>
    <input type="text" id="addwallet-row-id" disabled>

</div>