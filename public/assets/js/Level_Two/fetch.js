const form = document.getElementById("exchange_buy_order_form"");

const errorField1 = document.querySelector(".errorField1");
const errorField2 = document.querySelector(".errorField2");
const submit = {}; //Set it to array for OPTION 2: const submit = [];
//Add clientside check and validation before sending data to the server. Then unlock the submit function. If someone clicks the button beforehand, hint at the current errors.

if (form) {
    form.addEventListener("submit", async (e) => {
        //Do no refresh
        e.preventDefault();

        //Get Form data in object OR
        form.querySelectorAll("input").forEach((inputField) => {
            submit[inputField.name] = inputField.value;
        });

        //Get form data in array of objects OPTION 2
        // form.querySelectorAll("input").forEach((inputField) => {
        //     submit.push({ name: inputField.name, value: inputField.value });
        // });

        //Console log to show you how it looks
        console.log(submit);

        //Reset errors
        errorField1.textContent = "";
        errorField2.textContent = "";

        //Fetch
        try {
            //~ const result = await fetch("https://www.mymiwallet.com/index.php/Exchange/Buy_Fetch", {
            const result = await fetch("http://192.168.0.3/MillennialInvest/Site-v7/v1.3/index.php/Exchange/Buy_Fetch", {
                method: "POST",
                body: JSON.stringify(submit),
                headers: { "Content-Type": "application/json" },
            });
            const data = await result.json();
            if (data.errors) {
                errorField1.textContent = data.errors.error1; //ASSIGN that  property in the response sent back to fetch ex with express: res.status(400).json({ errors }); where errors is  errors = { error1: "blahblah", error2: "blahblah"}. So errors.error1 = "blahblah"
                errorField2.textContent = data.errors.error2;
            }

            //Basically whatever .json response you send back as a "order approved" sign - same procedure as above, simply swapping error1 for data:  success = "Hurray order approved";
            if (data.success) {
                //location.assign("/"); //Either redirect him like this or
                errorField1.textContent = data.success;
                errorField1.style.color = "green"; //Show that it's a good thing
            }
        } catch (err) {
            console.log(err);
        }
    });
}
