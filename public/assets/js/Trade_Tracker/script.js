//TODO: Increase capabilities of this function using keymatching, iterating through the object, checking for hollow elements.
function isEquivalent(a, b) {
	// Create arrays of property names
	var aProps = Object.getOwnPropertyNames(a);
	var bProps = Object.getOwnPropertyNames(b);

	// If number of properties is different,
	// objects are not equivalent
	if (aProps.length != bProps.length) {
		return false;
	}

	for (var i = 0; i < aProps.length; i++) {
		var propName = aProps[i];

		// If values of same property are not equal,
		// objects are not equivalent
		if (a[propName] !== b[propName]) {
			// console.log("> $isEquivalent: The objects are different");
			return false;
		}
	}
	// If we made it this far, objects
	// are considered equivalent
	// console.log("> $isEquivalent: The objects are equal");
	return true;
}
//Buy/Sell current price
//VARIABLES/NON OOP
let target = "";
const allRows = [];
const spawner = document.querySelector(".tt-spawn");
const typeSelector = document.querySelector(".tt-type-selector");
const types = typeSelector.querySelectorAll("li");
//!Get all trades from the database
//GatherLists
const trades = JSON.parse(
	document.getElementById("trade-list").textContent.trim()
);
const symbolList = JSON.parse(
	document.getElementById("ticker-list").textContent.trim()
);
const walletList = JSON.parse(
	document.getElementById("wallet-list").textContent.trim()
);

//OOP
let allPreferences = {
	columnsPreferences: {
		active: {
			equityColumns: "default",
			optionColumns: "default",
			optionColumnsSell: "default",
		},
		equityColumns: {
			default: [
				{
					location: "first-block",
					columns: ["closed", "symbol", "trade_type"],
				},
				{
					location: "scroll-block",
					columns: [
						"entry_price",
						"current_price",
						"leverage",
						"shares",
						"total_trade_cost",
						"close_price",
						"open_date",
						"open_time",
						"close_date",
						"close_time",
						//TODO: Implement shares and current total value calculation (total_trade)
						"price_target",
						"stop_loss",
						"trading_account",
						"details",
					],
				},
				{
					location: "button-block",
					columns: ["save", "cancel", "delete"],
				},
			],
		},
		optionColumns: {
			default: [
				{
					location: "first-block",
					columns: ["closed", "symbol", "trade_type"],
				},
				{
					location: "scroll-block",
					columns: [
						"premium",
						"number_of_contracts",
						"total_trade_cost",
						"close_price",
						"open_date",
						"open_time",
						"close_date",
						"close_time",
						"expiration",
						"strike",
						"price_target",
						"stop_loss",
						"trading_account",
						"details",
					],
				},
				{
					location: "button-block",
					columns: ["save", "cancel", "delete"],
				},
			],
		},
		optionColumnsSell: {
			default: [
				{
					location: "first-block",
					columns: ["closed", "symbol", "trade_type"],
				},
				{
					location: "scroll-block",
					columns: [
						"option_price",
						"close_price",
						"open_date",
						"open_time",
						"close_date",
						"close_time",
						"expiration",
						"strike",
						"trading_account",
						"details",
					],
				},
				{
					location: "button-block",
					columns: ["save", "cancel", "delete"],
				},
			],
		},
	},
	layoutPreferences: {
		equityBlock: {
			// * The attach field acts as a redirect to another block, such as the second block. This is used to collapse multiple columns into one
			attach: "",
			// * Trades with this keyword as category get attached here
			keyword: "equity",
			columns: "equityColumns",
			title: "Equity Trades",
			// * Position where the trade gets printed - populated by the script
			target: "",
		},
		optionBlock: {
			attach: "",
			keyword: "option_buy",
			columns: "optionColumns",
			//Not option buys  because it also includes sells
			title: "Option Trades",
			target: "",
		},
		soldOptionsBlock: {
			// Remember to manage the legend well
			attach: "",
			keyword: "option_sell",
			columns: "optionColumnsSell",
			title: "Option Selling",
			target: "",
		},
	},
	colorPreferences: {
		priceGreen: "green",
		priceRed: "red",
		connectedGreen: "#a0e05f",
		notConnectedYellow: "#ffcf66",
	},
};

/**
 * * Class created to handle each specific row
 * @param {object} trade The origin trade object. Can be empty and is printed in the row itself
 * @param {boolean} editing Represents whether the object is being edited or not. Used to show classes accordingly
 * @param {boolean} fromDb Equal to editing, used to understand whether to send a query when deleted
 */
class Row {
	constructor(trade, editing = false, fromDb = !editing, legend = false) {
		//Quick dropping of empty fields
		const tempTradeObj = { ...trade };
		//Edits initial object. New-object function here: https://stackoverflow.com/questions/286141/remove-blank-attributes-from-an-object-in-javascript
		Object.keys(tempTradeObj).forEach(
			(k) => tempTradeObj[k] == null && delete tempTradeObj[k]
		);
		this.origin = { ...tempTradeObj };
		//Actual form
		this.target = [];
		//Form in Object format - Initialized as "trade" and changed at every change
		this.current = { ...tempTradeObj };
		//State for graphical variations
		this.state = {
			editing,
			// The frromDB property is useful when deleting the trade to decide whether a delete query should be fetched or not
			fromDb,
			// This is a specific field reserved to the 3 or more details  rows which will spawn on top
			legend,
			// This is the block where the trade is rendered. Useful for changing properties of this block
			position: "",
			visible: true,
		};
		this.detailsInfo = {
			hiddenInput: "",
			mainInput: "",
			row: this,
			column: "",
			tagList: [],
		};
		this.numbers = {
			//The price must be only accessed from the numbers field, as it's the only temporary storage box
			current_price: tempTradeObj.hasOwnProperty("current_price")
				? tempTradeObj.current_price
				: "",
			total_trade_cost: tempTradeObj.hasOwnProperty("total_trade_cost")
				? tempTradeObj.total_trade_cost
				: "",
		};
	}
	/**
	 * * Function that removes the disabled class from an input
	 * @param this Refers to the input it's being applied to -
	 * Not an arrow function
	 */
	inputEditingEnable() {
		if (this.classList.contains("disabled-edt")) {
			this.classList.remove("disabled-edt");
		}
	}
	/**
	 * * Function that disabled an input if no changes have been made
	 * @param {*} event The blurring event
	 * @paraDiinputEditingDisable Refers to the trade
	 */
	inputEditingDisable = (event) => {
		//If the form is not being edited fully (brand new)
		if (!this.state.editing) {
			//Check if the person made changes "this.current == this.origin"
			if (this.current[event.target.name] == this.origin[event.target.name]) {
				event.target.classList.add("disabled-edt");
			}
		}
	};

	//We need to pass the higher object, so we arrow function (Object -> input -> function : the this still refers to the object)
	/**
	 * * Function that updates the current object
	 * @param {*} event The input event
	 * @param {boolean} wipe Whether to change all the properties back to normal
	 */
	updateCurrent = (event, wipe = false) => {
		if (wipe) {
			this.current = { ...this.origin };
		} else {
			if (event.target.value == "" || !event.target.value) {
				delete this.current[event.target.name];
			} else {
				this.current[event.target.name] = event.target.value;
			}
		}
	};

	/**
	 * * Functions to show hidden "closed" fields at the end of a trade
	 * * When we click on the "closed" check, we hide/show the "closed" input fields - remove the hidden-open class - reset the closed inputs to the origin
	 */
	toggleFormClosed = () => {
		if (this.current.closed == "true") {
			// console.log("> $toggleFormClosed: This was CLOSED now OPEN ");
			this.current.closed = "false";
			this.target.forEach((subRow) => {
				subRow.querySelectorAll(".closed-field").forEach((input) => {
					input.classList.add("hidden-open", "disabled-edt");
					//Set the value back to the input one
					input.value = this.origin[input.name];
					//Run an update current to update che current object
					if (input.value == "") {
						delete this.current[input.name];
					} else {
						this.current[input.name] = input.value;
					}
					//Toggle buttons runs after this function in the event chain
				});
			});
		} else {
			// console.log("> $toggleFormClosed: This was OPEN now CLOSED");
			this.current.closed = "true";
			//When someone "opens" the trade, the closed event fields memory is deleted
			this.target.forEach((subRow) => {
				subRow.querySelectorAll(".closed-field").forEach((input) => {
					input.classList.remove("hidden-open", "disabled-edt");
				});
			});
		}
	};

	/**
	 * * Function to show Send/Clear buttons +
	 */
	stateCheck = (event = false) => {
		//Autopopulate block
		this.autopopulate();

		//Button changes
		if (!isEquivalent(this.origin, this.current)) {
			//If there are changes, show the buttons - DO NOT HAVE THE DISABLED CLASS
			this.target.forEach((subRow) => {
				subRow.querySelectorAll(".tt-button-toggle").forEach((button) => {
					button.setAttribute("class", "tt-button tt-delete tt-button-toggle");
				});
			});
		} else {
			this.target.forEach((subRow) => {
				subRow.querySelectorAll(".tt-button-toggle").forEach((button) => {
					button.setAttribute(
						"class",
						"tt-button tt-delete tt-button-toggle  disabled-btn"
					);
				});
			});
		}
	};

	/**
	 * * Selector block
	 */
	/**
	 * * Create selector list
	 * Function that creates a selector below a given input
	 * @param {*} row
	 * @param {*} column
	 * @param {*} expander
	 * @param {*} idColumn
	 * @param {*} list
	 */
	attachSelector = (row, column, expander, idColumn, tagColumn, list) => {
		column.addEventListener("input", () => {
			const result = list.filter(
				(element) => column.value.toLowerCase() == element.text.toLowerCase()
			);
			//Here the person inserted an actually valid option
			if (result.length != 0) {
				idColumn.value = result[0].id;
				this.updateCurrent({
					target: {
						name: idColumn.name,
						value: idColumn.value,
					},
				});
				this.stateCheck();
			}
			//Here the person missed
			else {
				idColumn.value = "";
				this.updateCurrent({
					target: {
						name: idColumn.name,
						value: idColumn.value,
					},
				});
				this.stateCheck();
			}
		});
		const checkmate = (element) => {
			//Hide everything
			expander.style.display = "none";
			row.style.zIndex = "auto";
			//Not working implementation sadly
			// this.state.position.style.zIndex = "auto";
			//Run the updatecurrent thingy using a sudo-object
			column.value = element.text;
			this.updateCurrent({
				target: { name: column.name, value: column.value },
			});
			//Hidden fields
			idColumn.value = element.id;
			this.updateCurrent({
				target: {
					name: idColumn.name,
					value: idColumn.value,
				},
			});
			tagColumn.value = element.tag;
			this.updateCurrent({
				target: {
					name: tagColumn.name,
					value: tagColumn.value,
				},
			});

			this.stateCheck();
		};

		//The expander is the block which will get filled up with the relative information

		const createList = (expander, list, length) => {
			//Sort the list by tags
			list.sort((a, b) => (a.tag > b.tag ? 1 : -1));

			if (list.length > 0) {
				let currentTag = "";
				list.forEach((element) => {
					const option = document.createElement("div");
					option.innerHTML = element.text;
					option.addEventListener("click", () => {
						checkmate(element);
					});
					//If the tags are different, create a new title element
					if (element.tag != currentTag) {
						currentTag = element.tag;
						const tag = document.createElement("span");
						tag.textContent = element.tag;
						tag.classList.add("tag");
						expander.appendChild(tag);
					}

					expander.append(option);
				});
				if (length > 20) {
					const more = document.createElement("span");
					more.textContent = `And ${length - 20} more`;
					expander.append(more);
				}
			} else {
				const err = document.createElement("span");
				err.textContent = "No results";
				expander.appendChild(err);
			}
		};

		const browse = () => {
			//Shows the expander which was previously hidden
			expander.style.display = "flex";
			expander.textContent = "";
			//Moves the row above the others so that the expanded content shows above the other rows
			row.style.zIndex = 10;
			if (column.value == "") {
				//Using the spread operator to not destroy the list object
				createList(expander, [...list].splice(0, 20), list.length);
			} else {
				const updatedList = list.filter((element) => {
					const compValue = element.text.toLowerCase();
					if (compValue.includes(column.value.toLowerCase())) {
						return true;
					}
				});
				createList(expander, updatedList.splice(0, 20), updatedList.length);
			}
		};

		column.addEventListener("focus", browse);
		column.addEventListener("input", browse);
		column.addEventListener("keyup", (event) => {
			if (event.keyCode == 13) {
				expander.style.display = "none";
				row.style.zIndex = "auto";
			}
		});

		window.addEventListener("click", (event) => {
			if (event.target != column && event.target != expander) {
				expander.style.display = "none";
				row.style.zIndex = "auto";
			}
		});
	};

	//* Function to autopopulate fields
	//Called in: stateCheck
	//TODO: Expand on autopopulate
	autopopulate = (live = false) => {
		const current = this.current;
		const numbers = this.numbers;
		//* current_price and total_trade_cost can come from current aswell, so a "hasOwnProperty" is not enough
		//* the Leverage property is re-initialized here instead of being preloaded in numbers for ease of use
		const leverage = this.current.hasOwnProperty("leverage")
			? this.current.leverage
			: 1;
		//Function to print in the column the value
		const printResult = (value, field, hardChange = true) => {
			this.target.forEach((subRow) => {
				//If the field exists, show the data in that field. No coloring enabled yet
				if (subRow.querySelector(`.field-${field}`)) {
					if (subRow.querySelector(`.field-${field}`).tagName == "INPUT") {
						subRow.querySelector(`.field-${field}`).value = value;
						if (hardChange) {
							this.current[field] = value;
						}
					} else {
						subRow.querySelector(`.field-${field}`).innerText = value;
					}
				}
			});
		};
		/**
		 * Function to make calculating parts of statistics one-liners
		 * @param {number} price Price of the item
		 * @param {number} amount How many of them
		 * @param {float} multiplier For example, in an option calc you'll want to MULTIPLY the premium by 100
		 * @returns
		 */
		function costCalc(price, amount, multiplier = 1) {
			return parseFloat(price) * parseFloat(amount) * multiplier;
		}

		//! Change the price to the incoming one only if current_price is not set in current
		if (
			numbers.hasOwnProperty("current_price") &&
			!current.hasOwnProperty("current_price")
		) {
			//Do not change the current property, someone may have set by hand their own price.
			printResult(numbers.current_price, "current_price", false);
			if (live) {
				//Color the border of the first row in green
				this.target[0].style.boxShadow = `inset 5px 0px 0px 0px ${allPreferences.colorPreferences.connectedGreen}`;
			} else {
				this.target[0].style.boxShadow = `inset 4px 0px 0px 0px ${allPreferences.colorPreferences.notConnectedYellow}`;
			}
		}
		//Equity specific stats - in shares
		if (current.category == "equity") {
			//Empty property equals non-existing property
			if (
				current.hasOwnProperty("entry_price") &&
				current.hasOwnProperty("shares")
			) {
				numbers.total_trade_cost = costCalc(
					current.entry_price,
					current.shares,
					leverage
				);
				//Todo Implement tax calculation
				printResult(numbers.total_trade_cost, "total_trade_cost");
				//Initial cost already existing
			}
			if (
				numbers.hasOwnProperty("total_trade_cost") &&
				numbers["total_trade_cost"]
			) {
				//x is used to avoid re-checking object properties here
				let x = 0;
				if (current.hasOwnProperty("close_price")) {
					numbers.profit =
						costCalc(current.close_price, current.shares, leverage) -
						numbers.total_trade_cost;
					if (current.trade_type == "short") {
						numbers.profit = -numbers.profit;
					}
				}
				//Possible profit
				if (current.hasOwnProperty("price_target")) {
					numbers.possibleProfit =
						costCalc(current.shares, current.price_target, leverage) -
						numbers.total_trade_cost;
					if (current.trade_type == "short") {
						numbers.possibleProfit = -numbers.possibleProfit;
					}
					x++;
				}
				//Possible loss
				if (current.hasOwnProperty("stop_loss")) {
					numbers.possibleLoss =
						numbers.total_trade_cost -
						costCalc(current.shares, current.stop_loss, leverage);
					if (current.trade_type == "short") {
						numbers.possibleLoss = -numbers.possibleLoss;
					}
					x++;
				}
				if (x == 2) {
					//no need for abs because they are either both positive or both negative
					numbers.reward_risk_ratio =
						Math.round(
							((current.price_target - current.entry_price) /
								(current.entry_price - current.stop_loss)) *
								100
						) / 100;
				}
			}
		}
		if (current.category == "option_buy") {
			//Empty property equals non-existing property
			if (
				current.hasOwnProperty("premium") &&
				current.hasOwnProperty("number_of_contracts")
			) {
				numbers.total_trade_cost = costCalc(
					current.premium,
					current.number_of_contracts,
					100
				);
				//Todo Implement tax calculation
				printResult(numbers.total_trade_cost, "total_trade_cost");
			}
			//Initial cost already existing
			if (
				numbers.hasOwnProperty("total_trade_cost") &&
				numbers["total_trade_cost"]
			) {
				let x = 0;
				//* Here we don't need to invert for puts, as prices rise in both circumstances
				if (current.hasOwnProperty("close_price")) {
					numbers.profit =
						costCacl(current.close_price, current.number_of_contracts, 100) -
						numbers.total_trade_cost;
				}
				//Possible profit
				if (current.hasOwnProperty("price_target")) {
					numbers.possibleProfit =
						costCalc(current.number_of_contracts, current.price_target, 100) -
						numbers.total_trade_cost;
					x++;
				}
				//Possible loss
				if (current.hasOwnProperty("stop_loss")) {
					numbers.possibleLoss =
						numbers.total_trade_cost -
						costCalc(current.number_of_contracts, current.stop_loss, 100);
					x++;
					0;
				}
				if (x == 2) {
					numbers.reward_risk_ratio =
						Math.round(
							((current.price_target - current.premium) /
								(current.entry_price - current.stop_loss)) *
								100
						) / 100;
				}
			}
		}

		if (
			numbers.hasOwnProperty("total_trade_cost") &&
			numbers["total_trade_cost"] &&
			numbers.hasOwnProperty("current_price") &&
			numbers["current_price"]
		) {
			numbers.current_gain;
		}
		console.log(numbers);
		/**
		 * total_trade_cost
		 * current_price
		 * profit
		 * possibleProfit
		 * possibleLoss
		 */
	};

	// * Function to send changes to the database
	//Arrow function so it doesn't refer to the button.
	fetchChanges = async (e) => {
		e.preventDefault();
		//TODO: Include a warning before saving or not (Maybe with a "don't ask me anymroe")
		try {
			const tag = !this.fromDb ? "New" : "Edit";
			const payload = { tag: tag, trade: this.current };
			const result = await fetch(
				// "http://localhost/MillennialInvest/Site-v7/v1.4/index.php/Trade-Tracker/Trade-Manager", // Localhost
				"http://10.0.0.60/MillennialInvest/Site-v7/v1.4/public/index.php/Trade-Tracker/Trade-Manager", // Remote Localhost
				// "http://192.168.0.3/MillennialInvest/Site-v7/v1.4/index.php/Trade-Tracker/Trade-Manager", // Remote Localhost
				// "https://www.mymiwallet.com/Trade-Tracker/Trade-Manager",
				{
					method: "POST",
					credentials: "same-origin",
					//Request appeareance: {tag: "new"/"edit"/ JUST FOR DELETE BELOW"delete", trade: payload}
					body: JSON.stringify(payload),
					headers: { "Content-Type": "application/json" },
				}
			);
			const data = await result.json();
			/**	BACKEND
			 *	Use the tag to create new trade or to update existing.
			 *	RESPONSE APPEARANCE
			 *	{status: "" , message: ""}
			 */
			if (data.status == "error") {
				newAlert(data);
			}
			if (data.status == "success") {
				newAlert(data);
				if (tag == "New") {
					//We can use the tag object to add or not the id to the current object.
					this.current.id = data.message;
					this.state.fromDb = true;
					this.state.editing = false;
				}
				//Make the new origin the current trade
				this.origin = { ...this.current };
				//Re-Render the trade by exploiting the revertChanges function - which also toggles the buttons
				this.revertChanges(e);
			}
		} catch (err) {
			newAlert({
				message: "Something went wrong in the preliminary phase",
				status: "error",
			});
		}
	};

	// * Function that reverts changes to this.origin
	revertChanges = (e) => {
		e.preventDefault();
		//If the state is different, run a frontend form change - which will toggle back to the right one
		if (this.current.closed != this.origin.closed) {
			this.toggleFormClosed();
		}
		//Wipe all changes in the current object
		this.updateCurrent(e, true);
		this.target.forEach((subRow) => {
			subRow.querySelectorAll(".tt-input").forEach((input) => {
				input.value = this.origin[input.name] ? this.origin[input.name] : "";
				input.checked = input.value == "true" ? true : false;
				//Run a separate update for the details function
				if (input.name == "details") {
					this.detailsInfo.column.textContent = "";
					this.detailsInfo.column.append(
						this.detailsInfo.mainInput,
						this.detailsInfo.hiddenInput
					);
					if (input.value == "") {
						this.detailsInfo.tagList = [];
					} else {
						this.detailsInfo.tagList = [];
						const splicedTags = input.value.split(",");
						splicedTags.forEach((string) => {
							addTag(string, this.detailsInfo);
						});
					}
				}
				//Change the checkbox look
				if (!this.state.editing) {
					input.classList.add("disabled-edt");
				}
			});
		});
		// console.log("> $revertChanges:", this.current.details, this.origin.details);
		this.stateCheck();
	};

	// * Function that deletes the row in the DB
	deleteRow = async (e) => {
		e.preventDefault();
		//If it's from the database, you will have to send a delete query for this id
		if (this.state.fromDb) {
			//Send delete query to db after alert
			try {
				const payload = { tag: "Delete", trade: this.current };
				const result = await fetch(
					// "http://localhost/MillennialInvest/Site-v7/v1.4/index.php/Trade-Tracker/Trade-Manager", // Localhost
                    "http://10.0.0.60/MillennialInvest/Site-v7/v1.4/public/index.php/Trade-Tracker/Trade-Manager", // Remote Localhost
					// "http://192.168.0.3/MillennialInvest/Site-v7/v1.4/index.php/Trade-Tracker/Trade-Manager", // Remote Localhost
					// "https://www.mymiwallet.com/Trade-Tracker/Trade-Manager",
					{
						method: "POST",
						//Request appeareance: {tag: "new"/"edit"/ JUST FOR DELETE BELOW"delete", trade: payload}
						body: JSON.stringify(payload),
						headers: { "Content-Type": "application/json" },
					}
				);
				const data = await result.json();
				/**	BACKEND
				 * 	Check whether the trade exists, return a message if it doesn't.
				 * 	if it does:
				 *	Use the tag to delete the trade
				 *	RESPONSE APPEARANCE
				 *	{status: "" , id: ""}
				 */
				if (data.status == "error") {
					newAlert(data);
				}
				if (data.status == "success") {
					newAlert(data);
					// -> substitute the row for a second with a "trade deleted"
					// then drop it
					this.target.forEach((subRow) => subRow.remove());
					const theRow = this;
					allRows.splice(allRows.indexOf(theRow), 1);
				}
			} catch (err) {
				newAlert({
					message: "Something went wrong in the preliminary phase",
					status: "error",
				});
			}
		} else {
			this.target.forEach((subRow) => subRow.remove());
			const theRow = this;
			allRows.splice(allRows.indexOf(theRow), 1);
		}
		//If it's not from the database, just delete it
	};
	/**
	 * * Function to check for comma presence
	 * @param {*} e Event of writing in the input- If present, create new tag and do all the rest
	 */
	commaCheck(e) {
		//* This refers to the mainInput
		// The split makes sure that copy pastes work aswell
		if (e.target.value.split(",").length > 1) {
			//Remove comma
			e.target.value.split(",").forEach((string) => {
				if (filterTag(string).length > 0) {
					addTag(string, this.detailsInfo);
				}
			});
		}
	}

	/**
	 * * Function to create columns
	 * @param {*} field Is the column identifier
	 * @param {*} location Is where to append the column
	 */
	switchColumn(field, location) {
		let varContainer = "";
		let expander = "";
		let button = "";
		let idInput = "";
		let tagInput = "";
		let column = "";
		switch (field) {
			case "closed":
				//Create the input element
				varContainer = document.createElement("div");
				varContainer.classList.add(
					"tt-input",
					"tt-input-container",
					"disabled-edt"
				);
				column = document.createElement("input");
				column.setAttribute("type", "checkbox");
				column.setAttribute("name", field);
				//Depending on the form state, disable or enable it's style
				if (!this.state.editing) {
					column.setAttribute("class", "disabled-edt");
				}
				column.checked = this.current.closed == "true" ? true : false;
				column.value = this.current.closed;
				column.addEventListener("input", function () {
					if (this.value == "false") {
						this.value = "true";
					} else {
						this.value = "false";
					}
				});
				column.addEventListener("input", this.toggleFormClosed);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.stateCheck);
				//Need arrow function to pass

				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				varContainer.append(column);
				location.appendChild(varContainer);
				break;
			case "symbol":
				varContainer = document.createElement("div");
				varContainer.classList.add("tt-input-container");
				expander = document.createElement("div");
				expander.classList.add("tt-selector");
				column = document.createElement("input");
				column.setAttribute("type", "text");
				column.setAttribute("name", field);
				//Creating an hidden id input to store the id of the ticker.
				idInput = document.createElement("input");
				idInput.classList.add("tt-input");
				idInput.style.display = "none";
				idInput.setAttribute("type", "text");
				idInput.setAttribute("name", `${field}_id`);
				varContainer.append(idInput);
				//
				//Same procedure for the tag
				tagInput = document.createElement("input");
				tagInput.classList.add("tt-input");
				tagInput.style.display = "none";
				tagInput.setAttribute("type", "text");
				tagInput.setAttribute("name", `${field}_tag`);
				varContainer.append(tagInput);
				//
				this.attachSelector(
					location,
					column,
					expander,
					idInput,
					tagInput,
					symbolList
				);
				if (!this.state.editing) {
					column.classList.add("disabled-edt");
				}
				column.classList.add("tt-input", "tt-symbol", "form-selectpicker");
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.stateCheck);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
					//Quick check to add the ID and tag to the object if it doesn't have it
					if (this.origin.hasOwnProperty(`${field}_id`)) {
						idInput.value = this.origin[`${field}_id`];
					} else {
						//If there is no id attached, try to do it right now
						const result = symbolList.filter(
							(element) =>
								column.value.toLowerCase() == element.text.toLowerCase()
						);

						if (result.length != 0) {
							idInput.value = result[0].id;
							this.origin[`${field}_id`] = result[0].id;
							this.current[`${field}_id`] = result[0].id;
						}
					}
					if (this.origin.hasOwnProperty(`${field}_tag`)) {
						tagInput.value = this.origin[`${field}_tag`];
					} else {
						//If there is no id attached, try to do it right now
						const result = symbolList.filter(
							(element) =>
								column.value.toLowerCase() == element.text.toLowerCase()
						);
						if (result.length != 0) {
							tagInput.value = result[0].tag;
							this.origin[`${field}_tag`] = result[0].tag;
							this.current[`${field}_tag`] = result[0].tag;
						}
					}
				} else {
					column.value = "";
				}
				varContainer.appendChild(column);
				varContainer.appendChild(expander);
				location.appendChild(varContainer);
				break;
			//case "trade_type":
			// Should we have it?
			//    break;
			case "open_date":
			case "close_date":
				column = document.createElement("input");
				column.setAttribute("type", "date"); //TODO: Create the datetime picker
				column.setAttribute("name", field);
				if (!this.state.editing) {
					column.setAttribute("class", "tt-input disabled-edt");
				} else {
					column.classList.add("tt-input");
				}

				//To keep track of all fields to activate or not when closing
				if (field == "close_date") {
					if (this.current.closed == "false") {
						//If the trade is still open don't show the "field"

						column.classList.add("hidden-open");
					}
					column.classList.add("closed-field");
				}
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.stateCheck);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				location.appendChild(column);
				break;
			case "open_time":
			case "close_time":
				column = document.createElement("input");
				column.setAttribute("type", "time"); //TODO: Create the datetime picker
				column.setAttribute("name", field);
				column.setAttribute("step", 1);
				if (!this.state.editing) {
					column.setAttribute("class", "tt-input disabled-edt");
				} else {
					column.classList.add("tt-input");
				}

				//To keep track of all fields to activate or not when closing
				if (field == "close_time") {
					if (this.current.closed == "false") {
						//If the trade is still open don't show the "field"

						column.classList.add("hidden-open");
					}
					column.classList.add("closed-field");
				}
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.stateCheck);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				location.appendChild(column);
				break;
			//Tdameritrade date picker for options
			case "expiration":
				column = document.createElement("input");
				column.setAttribute("type", "date"); //TODO: Create the datetime picker
				column.setAttribute("name", field);
				if (!this.state.editing) {
					column.setAttribute("class", "tt-input disabled-edt");
				} else {
					column.classList.add("tt-input");
				}
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.stateCheck);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				location.appendChild(column);
				break;
			//Non changing fields
			case "current_price":
			case "trade_type":
			case "total_trade_cost":
				//STATIC STATISTICS
				if (field == "trade_type") {
					column = document.createElement("div");

					column.setAttribute(
						"class",
						`tt-statistic disabled-edt field-${field}`
					);
					if (this.origin.hasOwnProperty(field)) {
						column.innerText =
							this.origin[field].charAt(0).toUpperCase() +
							this.origin[field].slice(1);
					}
				}
				//DYNAMIC STATISTICS
				else {
					column = document.createElement("input");
					column.setAttribute("class", `tt-statistic tt-input field-${field}`);
					if (!this.state.editing) {
						column.classList.add("disabled-edt");
					}
					if (this.origin.hasOwnProperty(field)) {
						column.value =
							this.origin[field].charAt(0).toUpperCase() +
							this.origin[field].slice(1);
					}
					column.addEventListener("input", this.updateCurrent);
					column.addEventListener("input", this.stateCheck);
				}
				column.setAttribute("name", field);
				//The value of the element is set inside of the price updater
				location.appendChild(column);
				break;
			//Non changing field
			case "entry_price":
			case "option_price":
			case "strike":
			case "shares":
			case "leverage":
			case "premium":
			case "number_of_contracts":
			case "price_target":
			case "stop_loss":
			case "close_price":
				column = document.createElement("input");
				column.setAttribute("type", "number");
				column.setAttribute("name", field);
				if (!this.state.editing) {
					column.setAttribute("class", "tt-input disabled-edt");
				} else {
					column.classList.add("tt-input");
				}
				//Check if it's close_price
				if (field == "close_price") {
					if (this.current.closed == "false") {
						column.classList.add("hidden-open");
						//To keep track of all fields to activate or not
					}
					column.classList.add("closed-field");
				}
				if (field == "leverage") {
					column.setAttribute("placeholder", "1");
				}
				//If the trade is still open don't show the "field"
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.stateCheck);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				location.appendChild(column);
				break;
			case "trading_account":
				varContainer = document.createElement("div");
				varContainer.classList.add("tt-input-container");
				expander = document.createElement("div");
				expander.classList.add("tt-selector");

				column = document.createElement("input");
				column.setAttribute("type", "text");
				column.setAttribute("name", field);

				//Creating an hidden id input to store the id of the wallet.
				idInput = document.createElement("input");
				idInput.classList.add("tt-input");
				idInput.style.display = "none";
				idInput.setAttribute("type", "text");
				idInput.setAttribute("name", `${field}_id`);
				varContainer.append(idInput);
				//
				//Same thing for the tag
				tagInput = document.createElement("input");
				tagInput.classList.add("tt-input");
				tagInput.style.display = "none";
				tagInput.setAttribute("type", "text");
				tagInput.setAttribute("name", `${field}_tag`);
				varContainer.append(tagInput);
				//
				this.attachSelector(
					location,
					column,
					expander,
					idInput,
					tagInput,
					walletList
				);

				column.classList.add("tt-input", `tt-${field}`, "form-selectpicker");
				if (!this.state.editing) {
					column.classList.add("disabled-edt");
				}
				//If the trade is still open don't show the "field"
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.stateCheck);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
					//Refer to "symbol"
					if (this.origin.hasOwnProperty(`${field}_id`)) {
						idInput.value = this.origin[`${field}_id`];
					} else {
						//If there is no id attached, try to do it right now
						const result = walletList.filter(
							(element) =>
								column.value.toLowerCase() == element.text.toLowerCase()
						);
						if (result.length != 0) {
							idInput.value = result[0].id;
							this.origin[`${field}_id`] = result[0].id;
							this.current[`${field}_id`] = result[0].id;
						}
					}
					if (this.origin.hasOwnProperty(`${field}_tag`)) {
						tagInput.value = this.origin[`${field}_tag`];
					} else {
						//If there is no id attached, try to do it right now
						const result = walletList.filter(
							(element) =>
								column.value.toLowerCase() == element.text.toLowerCase()
						);
						if (result.length != 0) {
							tagInput.value = result[0].tag;
							this.origin[`${field}_tag`] = result[0].tag;
							this.current[`${field}_tag`] = result[0].tag;
						}
					}
				} else {
					column.value = "";
				}
				varContainer.appendChild(column);
				varContainer.appendChild(expander);
				location.appendChild(varContainer);
				break;
			case "details":
				column = document.createElement("div");
				const hiddenInput = document.createElement("input");
				const mainInput = document.createElement("input");
				column.append(hiddenInput, mainInput);
				hiddenInput.setAttribute("type", "text");
				hiddenInput.style.display = "none";
				hiddenInput.classList.add("tt-input");
				// Exploiting the disabled class to NOT show the borders of the input
				mainInput.classList.add("disabled-edt", "tt-text-field");
				mainInput.setAttribute("type", "text");
				mainInput.setAttribute("placeholder", "Add a comma to save");
				// We only need the name on the actual input which is getting edited
				hiddenInput.setAttribute("name", field);
				column.classList.add("tt-input", `tt-${field}`);
				if (!this.state.editing) {
					column.classList.add("disabled-edt");
				}
				this.detailsInfo.hiddenInput = hiddenInput;
				this.detailsInfo.mainInput = mainInput;
				this.detailsInfo.column = column;
				//Situation where you pulled something from the db
				if (this.current.hasOwnProperty("details")) {
					this.detailsInfo.tagList = [];
					this.current.details.split(",").forEach((string) => {
						addTag(string, this.detailsInfo);
					});
				}
				mainInput.addEventListener("input", (e) => {
					this.commaCheck(e, this.detailsInfo);
				});
				//If the trade is still open don't show the "field"
				mainInput.addEventListener("focus", this.inputEditingEnable);
				mainInput.addEventListener("blur", this.inputEditingDisable);
				//Set the current value of the element

				location.appendChild(column);
				break;
			case "save":
				button = document.createElement("button");
				button.setAttribute(
					"class",
					"btn btn-primary btn-xs tt-button tt-save tt-button-toggle disabled-btn "
				);
				//Buttons never need the editing check, because they show up only when changes are there - except for the delete button, which is omnipresent.
				button.addEventListener("click", this.fetchChanges);
				//No need for updateCurrent because each input is doing the work
				button.textContent = "Save";
				location.appendChild(button);
				break;
			case "delete":
				button = document.createElement("button");
				button.setAttribute(
					"class",
					"btn btn-danger btn-xs tt-button tt-delete "
				);
				button.addEventListener("click", this.deleteRow);
				button.innerText = `Delete`;
				location.appendChild(button);
				break;
			case "cancel":
				button = document.createElement("button");
				button.setAttribute(
					"class",
					"btn btn-secondary btn-xs tt-button tt-cancel tt-button-toggle disabled-btn "
				);
				button.addEventListener("click", this.revertChanges);
				button.textContent = "Cancel";
				location.appendChild(button);
				break;
		}
	}

	legendColumns(column, location) {
		const legendContainer = document.createElement("div");
		const text = document.createElement("h4");
		legendContainer.classList.add("tt-legend-column", `tt-${column}`);
		//Metti la prima lettera in caps
		let interpolatedText = column.split("_");
		for (var i = 0; i < interpolatedText.length; i++) {
			interpolatedText[i] =
				interpolatedText[i].charAt(0).toUpperCase() +
				interpolatedText[i].slice(1);
		}
		interpolatedText = interpolatedText.join(" ");
		text.innerText = interpolatedText;
		legendContainer.append(text);
		location.append(legendContainer);
	}

	/**
	 * * Function that renders this row below the other ones
	 * @param {*} location the DOM target where we are going to append/prepend the item
	 * @param {string} keyword used to modularly decide which case we are targeting. Useful when collapsing multiple categories into one. Defaults to the row's category
	 * @param {boolean} append if true: AFTER the other elements, if false: BEFORE the other elements
	 */
	firstRender(location, append = true, keyword = this.current.category) {
		// * Render each input field
		switch (keyword) {
			//Buys and sells
			case "equity":
				allPreferences.columnsPreferences.equityColumns[
					allPreferences.columnsPreferences.active.equityColumns
				].forEach((directive) => {
					const subRow = document.createElement("div");
					subRow.classList.add("tt-row");
					if (this.state.legend) {
						subRow.classList.add("tt-legend-row");
					} else {
						subRow.classList.add("tt-trade-row");
					}
					// Add to the location
					if (append) {
						location.querySelector(`.${directive.location}`).append(subRow);
					} else {
						location.querySelector(`.${directive.location}`).prepend(subRow);
					}
					this.target.push(subRow);
					directive.columns.forEach((column) => {
						//If it's the legend, run it trhough the "Standard" builder with just text
						if (this.state.legend) {
							this.legendColumns(column, subRow);
						} else {
							//Else just make a row
							this.switchColumn(column, subRow);
						}
					});
				});
				break;
			case "option_buy":
				allPreferences.columnsPreferences.optionColumns[
					allPreferences.columnsPreferences.active.optionColumns
				].forEach((directive) => {
					const subRow = document.createElement("div");
					subRow.classList.add("tt-row");
					if (this.state.legend) {
						subRow.classList.add("tt-legend-row");
					} else {
						subRow.classList.add("tt-trade-row");
					}
					// Add to the location
					if (append) {
						location.querySelector(`.${directive.location}`).append(subRow);
					} else {
						location.querySelector(`.${directive.location}`).prepend(subRow);
					}
					this.target.push(subRow);
					directive.columns.forEach((column) => {
						//If it's the legend, run it trhough the "Standard" builder with just text
						if (this.state.legend) {
							this.legendColumns(column, subRow);
						} else {
							//Else just make a row
							this.switchColumn(column, subRow);
						}
					});
				});
				break;
			case "option_sell":
				allPreferences.columnsPreferences.optionColumnsSell[
					allPreferences.columnsPreferences.active.optionColumnsSell
				].forEach((directive) => {
					const subRow = document.createElement("div");
					subRow.classList.add("tt-row");
					if (this.state.legend) {
						subRow.classList.add("tt-legend-row");
					} else {
						subRow.classList.add("tt-trade-row");
					}
					// Add to the location
					if (append) {
						location.querySelector(`.${directive.location}`).append(subRow);
					} else {
						location.querySelector(`.${directive.location}`).prepend(subRow);
					}
					this.target.push(subRow);
					directive.columns.forEach((column) => {
						//If it's the legend, run it trhough the "Standard" builder with just text
						if (this.state.legend) {
							this.legendColumns(column, subRow);
						} else {
							//Else just make a row
							this.switchColumn(column, subRow);
						}
					});
				});
				break;
		}
	}
	//END OF OBJECT
}

/**
 * * Secondary controller for the DETAILS block
 * @param {*} text Content of the tag - gets added to the hiddeninput
 * @param {object} detailsInfo Information about the invocating trade
 */
function addTag(text, detailsInfo) {
	let tag = {
		text,
		element: document.createElement("span"),
	};
	// Add the tag looking class
	tag.element.classList.add("tt-tag-detail");
	// Update the tag object
	tag.element.textContent = tag.text;
	// Create the closing button, style it up later
	const xBtn = document.createElement("span");
	xBtn.innerHTML = `
		<svg
			xmlns="http://www.w3.org/2000/svg"
			xmlns:xlink="http://www.w3.org/1999/xlink"
			version="1.1"
			viewBox="0 0 512 512"
			xml:space="preserve"
		>
			<path d="M443.6,387.1L312.4,255.4l131.5-130c5.4-5.4,5.4-14.2,0-19.6l-37.4-37.6c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4  L256,197.8L124.9,68.3c-2.6-2.6-6.1-4-9.8-4c-3.7,0-7.2,1.5-9.8,4L68,105.9c-5.4,5.4-5.4,14.2,0,19.6l131.5,130L68.4,387.1  c-2.6,2.6-4.1,6.1-4.1,9.8c0,3.7,1.4,7.2,4.1,9.8l37.4,37.6c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1L256,313.1l130.7,131.1  c2.7,2.7,6.2,4.1,9.8,4.1c3.5,0,7.1-1.3,9.8-4.1l37.4-37.6c2.6-2.6,4.1-6.1,4.1-9.8C447.7,393.2,446.2,389.7,443.6,387.1z" />
		</svg>`;
	xBtn.classList.add("x-button");
	tag.element.append(xBtn);
	detailsInfo.tagList.push(tag);
	// Append the tag element to the column - before the mainInput
	detailsInfo.column.insertBefore(tag.element, detailsInfo.mainInput);

	//Refresh tags
	xBtn.addEventListener("click", () => {
		removeTag(detailsInfo.tagList.indexOf(tag), detailsInfo);
	});
	// console.log("> $addTag: Refreshing tags with this object", detailsInfo);
	refreshTags(detailsInfo);
	// Clean the input
	detailsInfo.mainInput.value = "";
}

function removeTag(index, detailsInfo) {
	let tag = detailsInfo.tagList[index];
	detailsInfo.tagList.splice(index, 1);
	detailsInfo.column.removeChild(tag.element);
	refreshTags(detailsInfo);
}

function refreshTags(detailsInfo) {
	let stringedList = [];
	// console.log(
	// 	"> $refreshTags: refreshing tags using this list",
	// 	detailsInfo.tagList
	// );
	detailsInfo.tagList.forEach((tag) => {
		stringedList.push(tag.text);
	});
	// console.log("> $refreshTags: stringed list:", stringedList);
	detailsInfo.hiddenInput.value = stringedList.join(",");

	//Use a placebo event to trigger the updatecurrent correctly
	detailsInfo.row.updateCurrent({
		target: detailsInfo.hiddenInput,
	});
	detailsInfo.row.stateCheck();
}
//Crucial, when splitting there is always an empty array.
function filterTag(tag) {
	return tag
		.replace(/[^\w -]/g, "")
		.trim()
		.replace(/\W+/g, "-");
}

/**
 * * Layout block
 */
//  Use the layout to generate the interface
function renderBlocks() {
	for (let [key, value] of Object.entries(allPreferences.layoutPreferences)) {
		//Used to change the block in which a specific category gets rendered
		if (value.attach != "") {
			key = value.attach;
			value = allPreferences.layoutPreferences[value.attach];
		}
		//Create the specific block
		//Make sure that since it's attached it doesn't exist already
		if (value.target != "") {
			return;
		} else {
			const blockTitle = document.createElement("span");
			const title = document.createElement("h1");
			blockTitle.id = key;
			blockTitle.addEventListener("click", () => {
				document.querySelector(`.${key}`).classList.toggle("hidden");
			});
			title.innerText = value.title;
			blockTitle.append(title);
			blockTitle.classList.add("nk-block-title", "fw-bold");
			const block = document.createElement("div");
			block.classList.add(key, "tt-block", "hidden");
			value.target = block;
			document.querySelector(".target").append(blockTitle);
			document.querySelector(".target").append(block);
			allPreferences.columnsPreferences[value.columns][
				allPreferences.columnsPreferences.active[value.columns]
			].forEach((directive) => {
				const section = document.createElement("div");
				section.classList.add(directive.location);
				block.append(section);
			});
			//Create the legend row
			const newLegend = new Row(
				{ category: value.keyword },
				false,
				false,
				true
			);
			//? For some weird reason, legends can't seem to store their position properly. Oh well
			// console.log(block);
			// newLegend.state.position = block;

			newLegend.firstRender(block);
		}
	}
}
/**
 * * New trade block
 */
spawner.addEventListener("click", function () {
	if (this.classList.contains("expanded")) {
		this.classList.remove("expanded");
		this.innerText = "New Trade +";
		typeSelector.style.display = "none";
	} else {
		this.classList.add("expanded");
		this.innerText = "Collapse -";
		typeSelector.style.display = "flex";
	}
});

types.forEach((type) => {
	type.addEventListener("click", function () {
		//Hide the selector again
		spawner.classList.remove("expanded");
		spawner.innerText = "New Trade +";

		typeSelector.style.display = "none";
		let now = new Date();
		const origin = {
			category: this.dataset.category,
			closed: "false",
			open_date: now.toISOString().substring(0, 10), //YYYY-MM-DDTHH:mm:ss.sssZ
			open_time: now.toISOString().substring(11, 19), //YYYY-MM-DDTHH:mm:ss.sssZ
			// ? Still under implementation https://www.techrepublic.com/article/convert-the-local-time-to-another-time-zone-with-this-javascript/
			trade_type: this.dataset.type,
		}; //TODO: Add timezone related open_time
		//True because trading
		const newTrade = new Row(origin, true);
		allRows.push(newTrade);
		let tempKwrd = "";
		for (let [key, value] of Object.entries(allPreferences.layoutPreferences)) {
			// If the keyword matches the trade, print it here
			if (value.keyword == origin.category) {
				//Needed to account for the option_sell field
				if (value.attach != "") {
					key = value.attach;
					value = allPreferences.layoutPreferences[value.attach];
				}
				target = value.target;
				document.querySelector(`.${key}`).classList.remove("hidden");
				tempKwrd = value.keyword;
			}
		}
		// Add the target in so that the index of the block can be shifted for ease - mainly search function
		newTrade.state.position = target;
		newTrade.firstRender(target, false, tempKwrd);
	});
});

renderBlocks();

//End of new trade block
/**
 * * Database trades block
 */
const sort = (trade, tradeObj) => {
	switch (trade.category) {
		case "equity":
			for (let [key, value] of Object.entries(
				allPreferences.layoutPreferences
			)) {
				if (value.keyword == trade.category) {
					if (value.attach != "") {
						key = value.attach;
						value = allPreferences.layoutPreferences[value.attach];
					}
					target = value.target;
					document.querySelector(`.${key}`).classList.remove("hidden");
				}
			}
			break;
		case "option_buy":
			for (let [key, value] of Object.entries(
				allPreferences.layoutPreferences
			)) {
				if (value.keyword == trade.category) {
					if (value.attach != "") {
						key = value.attach;
						value = allPreferences.layoutPreferences[value.attach];
					}
					target = value.target;
					document.querySelector(`.${key}`).classList.remove("hidden");
				}
			}
			break;
		case "option_sell":
			for (let [key, value] of Object.entries(
				allPreferences.layoutPreferences
			)) {
				if (value.keyword == trade.category) {
					if (value.attach != "") {
						key = value.attach;
						value = allPreferences.layoutPreferences[value.attach];
					}
					target = value.target;
					document.querySelector(`.${key}`).classList.remove("hidden");
				}
			}
			break;
	}
	tradeObj.firstRender(target, false);
	tradeObj.stateCheck();
};

const spawnTrades = (trades) => {
	trades.forEach((trade) => {
		const newTrade = new Row(trade, false);
		allRows.push(newTrade);
		sort(trade, newTrade);
	});
};

// End of database trades block

spawnTrades(trades);
/**
 * * Queries block
 */
function search(string) {
	function searchFields(object, string) {
		for (const i of Object.values(object)) {
			// if (Regex.Match(i, regexd, RegexOptions.IgnoreCase).Success) {
			if (i.toLowerCase().includes(string.toLowerCase())) {
				return true;
			}
		}
	}
	if (string != "") {
		allRows.forEach((row) => {
			//String is just debug text at the moment
			//Wipe table
			row.target.forEach((subrow) => {
				subrow.style.display = "none";
			});
			row.state.visible = false;
			//Re-Render with filters
			if (searchFields(row.origin, string)) {
				row.target.forEach((subrow) => {
					subrow.style.display = "flex";
				});
				row.state.visible = true;
			}
		});
	} else {
		//Re-Render all rows up
		allRows.forEach((row) => {
			row.target.forEach((subrow) => {
				subrow.style.display = "flex";
			});
		});
	}
}

//Search field
document
	.querySelector("#normal-search")
	.addEventListener("change", function () {
		search(this.value);
	});

function statGen() {}

/**
 * * UpdateTrade block
 * ! Currently not in use, handled in the backend
 */
const priceUpdateReqGen = function () {
	const request = [
		{ tag: "undefined", tickerList: [] },
		{ tag: "options", tickerList: [] },
	];
	//[{tag:0,tickerList:[]}]
	allRows.forEach((row) => {
		if (row.origin.hasOwnProperty("symbol")) {
			//Division between options and other stuff.
			//If options: option controller
			//If crypto: crypto controller
			//If ETF,Stocks or whatever: rest controller
			if (
				row.origin.category == "option_buy" ||
				row.origin.category == "option_sell"
			) {
				const appendTarget = request.filter((block) => {
					return block.tag.toLowerCase() == "options";
				});
				appendTarget[0].tickerList.push(row.origin.symbol);
			} else {  
				if (row.origin.hasOwnProperty("symbol_tag")) {
					const appendTarget = request.filter((block) => {
						return (
							block.tag.toLowerCase() == row.origin.symbol_tag.toLowerCase()
						);
					});
					if (appendTarget.length == 0) {
						const newTarget = {
							tag: row.origin.symbol_tag,
							tickerList: [row.origin.symbol],
						};
						request.push(newTarget);
					} else {
						//I filter first, so even if I get multiple results I only attach the ticker to one tag
						if (appendTarget[0].tickerList.indexOf(row.origin.symbol) < 0) {
							//If it's not found, then add it
							appendTarget[0].tickerList.push(row.origin.symbol);
						}
					}
				} else {
					request[0].tickerList.push(row.origin.symbol);
				}
			}
		}
	});
};

priceUpdateReqGen();
//Handler for price change
const startSource = () => {
	evtSource = new EventSource(
		// `http://localhost/MillennialInvest/Site-v7/v1.4/public/index.php/API/Ticker_Price_Manager`,
        "http://10.0.0.60/MillennialInvest/Site-v7/v1.4/public/index.php/Trade-Tracker/Trade-Manager", // Remote Localhost
		// `http://192.168.0.3/MillennialInvest/Site-v7/v1.4/public/index.php/API/Ticker_Price_Manager`,
		// `https://www.mymiwallet.com/API/Ticker_Price_Manager`,
		{
			withCredentials: true,
		}
	);
	//? Possibly, send something like {id:10,price:239} with nothing else to save execution time and foreach looping time
	//There will be an event daemon which will go through all of the current open trades, ask for the price to tdameritrade and send it back here
	evtSource.onmessage = (message) => {
		console.log(message);
		const parsed = JSON.parse(message.data);
		if (!parsed.hasOwnProperty("empty")) {
			for (let [key, value] of Object.entries(parsed)) {
				//Get the trade you need by row
				// {equity: [], options: []}
				//TODO: Handle equity and options to equity options_buy ....
				value.forEach((symbolRow) => {
					allRows.forEach((row) => {
						if (
							row.origin.symbol == symbolRow.symbol &&
							row.origin.closed == "false"
						) {
							row.numbers.current_price = symbolRow.current_price;
							row.autopopulate(true);
						}
					});
				});
			}
		} else {
			console.log("No trades pulled");
		}
	};
	evtSource.onerror = (error) => {
		console.log("> An error occourred:\n", error);
		closeSource();
	};
};

//Close source
const closeSource = () => {
	evtSource.close();
	console.log("> Event Source Closed");
};
// Notifications
function newAlert(message) {
	// {status: ----, message: ----}
	const alert = document.createElement("div");
	alert.classList.add("tt-alert", `tt-${message.status}`);
	alert.innerHTML = message.message;
	document.querySelector(".tt-alert-box").append(alert);
	setTimeout(() => {
		document.querySelector(".tt-alert-box").removeChild(alert);
	}, 3500);
}
startSource();
