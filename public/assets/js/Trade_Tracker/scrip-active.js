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
			console.log("> $isEquivalent: The objects are different");
			return false;
		}
	}
	// If we made it this far, objects
	// are considered equivalent
	console.log("> $isEquivalent: The objects are equal");
	return true;
}
//Buy/Sell current price
//TODO: Mysql integration
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
					columns: ["closed", "symbol"],
				},
				{
					location: "scroll-block",
					columns: [
						"open_price",
						"shares",
						"close_price",
						"open_date",
						"open_time",
						"close_date",
						"close_time",
						//TODO: Implement shares and current total value calculation (total_trade)
						"price_target",
						"stop_loss",
						"total_trade_cost",
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
					columns: ["closed", "symbol"],
				},
				{
					location: "scroll-block",
					columns: [
						"option_price",
						"close_price",
						"trade_type",
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
					columns: ["closed", "symbol"],
				},
				{
					location: "scroll-block",
					columns: [
						"option_price",
						"close_price",
						"trade_type",
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
		firstBlock: {
			attach: "",
			keyword: "equity",
			columns: "equityColumns",
			title: "Equity Trades",
			target: "",
		},
		secondBlock: {
			attach: "",
			keyword: "option_buy",
			columns: "optionColumns",
			title: "Option Buys",
			target: "",
		},
		thirdBlock: {
			// * The attach field acts as a redirect to another block, such as the second block. This is used to collapse multiple columns into one
			// Remember to manage the legend well
			attach: "secondBlock",
			keyword: "option_sell",
			columns: "optionColumnsSell",
			title: "Option Selling",
			target: "",
		},
	},
	colorPreferences: {
		priceGreen: "green",
		priceRed: "red",
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
		//TODO: Thinking of way to implement the live updates also for new trades.
		//?Maybe give an ID back on trade save
		//*Send trade to db, receive answer with new id of this row and attach it
		this.origin = { ...trade };
		//Actual form
		this.target = [];
		//Form in Object format - Initialized as "trade" and changed at every change
		this.current = { ...trade };
		//State for graphical variations
		this.state = {
			editing,
			// The frromDB property is useful when deleting the trade to decide whether a delete query should be fetched or not
			fromDb,
			// This is a specific field reserved to the 3 or more details  rows which will spawn on top
			legend,
		};
		this.detailsInfo = {
			hiddenInput: "",
			mainInput: "",
			row: this,
			column: "",
			tagList: [],
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
			console.log("> $toggleFormClosed: This was CLOSED now OPEN ");
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
			console.log("> $toggleFormClosed: This was OPEN now CLOSED");
			this.current.closed = "true";
			//When someone "opens" the trade, the closed event fields memory is deleted
			this.target.forEach((subRow) => {
				subRow.querySelectorAll(".closed-field").forEach((input) => {
					input.classList.remove("hidden-open");
				});
			});
		}
	};

	/**
	 * * Function to show Send/Clear buttons
	 */
	formToggleButtons = () => {
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

	// * Function to send changes to the database
	//Arrow function so it doesn't refer to the button.
	fetchChanges = async (e) => {
		e.preventDefault();
		//TODO: Include a warning before saving or not (Maybe with a "don't ask me anymroe")
		try {
			const tag = !this.fromDb ? "New" : "Edit";
			const payload = { tag: tag, trade: this.current };
			const result = await fetch(
				"https://www.mymiwallet.com/Trade-Tracker/Trade-Manager",
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
				if (tag == "new") {
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
			//TODO: Handle this and the above errors in the frontend (Maybe with a small div coming up below the current row?)
			console.log("> $fetchChanges: Something went wrong", err);
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
			subRow.querySelectorAll("input").forEach((input) => {
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
		console.log("> $revertChanges:", this.current.details, this.origin.details);
		this.formToggleButtons();
	};

	// * Function that changes form type by re-rendering it - FUTURE IMPLEMENTATION if needed
	// reRender();

	/**
	 *	* Function to update fields.
	 *	* If on price changes the color depending on whether the trade is long or short
	 *  TODO: Option price implementation (when to show green and when to show red)
	 * @param {*} inputName Name of the input column to change the value of
	 * @param {*} newValue Value to change in the input
	 */
	updateField = (inputName, newValue) => {
		let input = "";
		this.target.forEach((subRow) => {
			if (subRow.querySelector(`input[(name = "${inputName}")]`)) {
				input = subRow.querySelector(`input[(name = "${inputName}")]`);
			}
		});
		if ((inputName = "current_price")) {
			input.value = newValue;
			// * Technically this can work for other kind of trades too, adding the "call and put" under the long type;
			// * A particular thing has to be done for writing options. In gen
			if ((this.current.category = "equity"))
				if (parseFloat(newValue) > parseFloat(this.current.open_price)) {
					//Price is higher than open
					if (this.current.trade_type == "long") {
						input.style.color = allPreferences.colorPreferences.priceGreen;
					} else {
						input.style.color = allPreferences.colorPreferences.priceRed;
					}
				} else {
					//Price is lower than open
					if (this.current.trade_type == "short") {
						input.style.color = allPreferences.colorPreferences.priceRed;
					} else {
						input.style.color = allPreferences.colorPreferences.priceGreen;
					}
				}
		} else {
			this.target.forEach((subRow) => {
				if (subRow.querySelector(`input[(name = "${inputName}")]`)) {
					input = subRow.querySelector(`input[(name = "${inputName}")]`);
				}
			});
			input.value = newValue;
		}
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
					"https://www.mymiwallet.com/Trade-Tracker/Trade-Manager",
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
				//TODO: Handle this and the above errors in the frontend (Maybe with a small div coming up below the current row?)
				console.log("Something went wrong", err);
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
		let button = "";
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
				column.addEventListener("input", this.formToggleButtons);
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
				column = document.createElement("input");
				column.setAttribute("type", "text");
				column.setAttribute("name", field);
				if (!this.state.editing) {
					column.classList.add("disabled-edt");
				}
				column.classList.add("tt-input", "tt-symbol", "form-selectpicker");
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.formToggleButtons);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				location.appendChild(column);
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
				column.addEventListener("input", this.formToggleButtons);
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
				column.addEventListener("input", this.formToggleButtons);
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
				column.addEventListener("input", this.formToggleButtons);
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
				column = document.createElement("div");
				column.setAttribute("name", field);
				column.setAttribute("class", "tt-input disabled-edt");
				//The value of the element is set inside of the price updater
				location.appendChild(column);
				break;
			//Non changing field
			case "open_price":
			case "option_price":
			case "strike":
			case "shares":
			case "price_target":
			case "stop_loss":
			case "close_price":
			case "total_trade_cost":
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
				//If the trade is still open don't show the "field"
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.formToggleButtons);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				location.appendChild(column);
				break;
			case "trading_account":
				//TODO: Add backend check of the trading_account being available + add selector for the trading_account
				column = document.createElement("input");
				column.setAttribute("type", "text");
				column.setAttribute("name", field);
				column.classList.add("tt-input", `tt-${field}`, "form-selectpicker");
				if (!this.state.editing) {
					column.classList.add("disabled-edt");
				}
				//If the trade is still open don't show the "field"
				column.addEventListener("focus", this.inputEditingEnable);
				column.addEventListener("blur", this.inputEditingDisable);
				column.addEventListener("input", this.updateCurrent);
				column.addEventListener("input", this.formToggleButtons);
				//Set the current value of the element
				if (this.origin.hasOwnProperty(field)) {
					column.value = this.origin[field];
				} else {
					column.value = "";
				}
				location.appendChild(column);
				break;
			case "details":
				column = document.createElement("div");
				const hiddenInput = document.createElement("input");
				const mainInput = document.createElement("input");
				column.append(hiddenInput, mainInput);
				hiddenInput.setAttribute("type", "text");
				hiddenInput.style.display = "none";
				// Exploiting the disabled class to NOT show the borders of the input
				mainInput.classList.add("disabled-edt");
				mainInput.setAttribute("type", "text");
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
					"tt-button tt-save tt-button-toggle disabled-btn "
				);
				//Buttons never need the editing check, because they show up only when changes are there - except for the delete button, which is omnipresent.
				button.addEventListener("click", this.fetchChanges);
				//No need for updateCurrent because each input is doing the work
				button.textContent = "Save";
				location.appendChild(button);
				break;
			case "delete":
				button = document.createElement("button");
				button.setAttribute("class", "tt-button tt-delete ");
				button.addEventListener("click", this.deleteRow);
				button.innerText = `Delete`;
				location.appendChild(button);
				break;
			case "cancel":
				button = document.createElement("button");
				button.setAttribute(
					"class",
					"tt-button tt-cancel tt-button-toggle disabled-btn "
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
	//TODO: Style the tag and the close button
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
	console.log("> $addTag: Refreshing tags with this object", detailsInfo);
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
	console.log(
		"> $refreshTags: refreshing tags using this list",
		detailsInfo.tagList
	);
	detailsInfo.tagList.forEach((tag) => {
		stringedList.push(tag.text);
	});
	console.log("> $refreshTags: stringed list:", stringedList);
	detailsInfo.hiddenInput.value = stringedList.join(",");

	//Use a placebo event to trigger the updatecurrent correctly
	detailsInfo.row.updateCurrent({
		target: detailsInfo.hiddenInput,
	});
	detailsInfo.row.formToggleButtons();
}
//Crucial, when splitting there is always an empty array.
function filterTag(tag) {
	return tag
		.replace(/[^\w -]/g, "")
		.trim()
		.replace(/\W+/g, "-");
}

//NON OBJECT ORIENTED PROGRAMMING BELOW
let target = "";
const allRows = [];
const spawner = document.querySelector(".tt-spawn");
const typeSelector = document.querySelector(".tt-type-selector");
const types = typeSelector.querySelectorAll("li");
//!Get all trades from the database
const trades = [
	{
		category: "equity",
		closed: "true",
		open_date: "2021-10-16",
		open_time: "14:41:29",
		trade_type: "long",
		symbol: "SPY",
		close_price: "435",
		open_price: "23423",
		shares: "1",
		close_date: "2021-10-14",
		close_time: "03:23:42",
		price_target: "423423",
		stop_loss: "42342",
		trading_account: "4234",
		details: "DGDFG,G,DSRGDSR,GDSRGSDRGDSR,GSDRGSDRG",
	},
	{
		category: "equity",
		closed: "true",
		open_date: "2021-10-16",
		open_time: "14:41:29",
		trade_type: "long",
		symbol: "SPY",
		close_price: "435",
		open_price: "23423",
		shares: "1",
		close_date: "2021-10-14",
		close_time: "03:23:42",
		price_target: "423423",
		stop_loss: "42342",
		trading_account: "4234",
		details: "DGDFG,G,DSRGDSR,GDSRGSDRGDSR,GSDRGSDRG",
	},
	{
		category: "equity",
		closed: "true",
		open_date: "2021-10-16",
		open_time: "14:41:29",
		trade_type: "long",
		symbol: "SPY",
		close_price: "435",
		open_price: "23423",
		shares: "1",
		close_date: "2021-10-14",
		close_time: "03:23:42",
		price_target: "423423",
		stop_loss: "42342",
		trading_account: "4234",
		details: "DGDFG,G,DSRGDSR,GDSRGSDRGDSR,GSDRGSDRG",
	},
	{
		category: "equity",
		closed: "true",
		open_date: "2021-10-16",
		open_time: "14:59:57",
		trade_type: "short",
		symbol: "SAFSAEF",
	},
];
/**
 * * Layout block
 */
//  Use the layout to generate the interface
function renderBlocks() {
	for (let [key, value] of Object.entries(allPreferences.layoutPreferences)) {
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
		newTrade.firstRender(target, false, tempKwrd);
	});
});

renderBlocks();

//End of new trade block
/**
 * * Database trades block
 */
trades.forEach((trade) => {
	const newTrade = new Row(trade, false);
	allRows.push(newTrade);
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
	newTrade.firstRender(target, false);
});
// End of database trades block

//TODO: onColumnChange re-render

//TODO: Implement "special pickers": ticker, time with timezone, trading_account

/**
 * * UpdateTrade block
 */

//Handler for price change
const startSource = () => {
	evtSource = new EventSource(`tdameritrade api url`, {
		withCredentials: true,
	});
	//? Possibly, send something like {id:10,price:239} with nothing else to save execution time and foreach looping time
	//There will be an event daemon which will go through all of the current open trades, ask for the price to tdameritrade and send it back here
	evtSource.onmessage = (message) => {
		console.log(message);
		const parsed = JSON.parse(message);
		parsed.forEach((trade) => {
			//Get the trade you need by row
			const theTradeArr = allRows.filter((row) => row.current.id == trade.id);
			// Go through the trade and use keys and values to COMPLETELY re-render the trade
			for (const [key, value] of Object.entries(theTradeArr[0])) {
				theTradeArr[0].updateField(key, value);
			}
		});
	};
	evtSource.onerror = (error) => {
		console.log(
			"> An error occourred:\n",
			error,
			"\n\n> Try again by clicking the button"
		);
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
