/*
! THE PRIORITIES !
- Being a service, not a burden. And the best service
- Not creating another dead sheet, but useful and VISIBLE information for the trader
- Ease of sharing
 */
//* IMPORTANT IDEAS: -
//* ALWAYS RENDER FROM OLDEST TO NEWEST - then hide the trades which are not in the current page. To handle current page use a side object or list of the current order.
//* Trades are always passed around as rows, the only time they exist as plain objects is when they are pulled from the db
//* To spawn new trades we use a pseudoid that is actually unique to the frontend trade window. Differences between the pseudoid and the id signal a missing connection with the db, meaning important changes to be SAVED
// ? VOCABULARY
// ? ALI means "at least in", meaning that the referred thing is being used at least in THING, maybe more stuff
/*

TODOS (backend)
- Select fields id rec: if only an id is sent, associate the right item with it. 
- vibe check fields (especially "strict" ones like the tradeType)
- Print tickers and wallet with this new schema { id: "01", value: "Personal Account", tag: "Schwab" },
- PseudoId implementation: when a trade with a pseaudoid is saved, get him a real id. Then this id gets changed in the frontend both in the actual row and in all of the linearObjs in tables and tradewindows referring to it

TODOS (frontend)
HUGE
- Sync the "lateral" fields for tag and id with the changeValue function and make them update/reset accordingly
- historical
- expanded view
- image
- Autosave
- Customize Columns
- Customize Formulas

SMALLER
- Refactor with maps (and where possible) with sets
- Cleanup the Window event listeners with a zdarkener or something else I really don't know
- Do something about the "plain" main new-row button
- deletePrompt
- Give the ability to enter images
- Give the ability for "tag" blocks and use expandeers to do so. Notion like
- Finish the compute functions (For strings and make them customizable)
- Multiple newRow setup
- Share trades
- Export/Import User Preferences
- Seach Box

ACTIVE
- Database Integration


WEIRDS:

-#1
In the backend we only do a "parent check". 
This means that if a parent comes in with pseudoIds of children, they will be able to change those.
Instead, if a parent comes AFTER the children, which means that the children have already been saved on the db
then we only want the right ids of those children, which are saved in the origin object (and get updated only on succesful db updates)


RULES:

-#1
The trade cannot have both a closed_ref != -1 and a closed list != []

*/


//START OF THE PROGRAM
let debug: boolean = true;


interface listerObj {
	id: string,
	value: string,
	tag: string,
}

interface variation {
	text: string,
	value: string,
}

interface fieldDirective {
	name: string,
	render: string,
	default: string,
	type: string,
	subtype: string,
	//Former if select, latter if list
	options?: { [key: string]: variation[] } | listerObj[],
	objLinked?: Array<string>,
	modifiers: Array<string>,
	computed: Array<string>,
	description: string,
	placeholder: string,
	columnName: string,
}

type dbTag = "New" | "Edit" | "Delete";
interface tableApiResponse {
	status: string,
	message: string,
}
class TradeObj {
	//0
	legend: string;
	//s
	saved_sorting: string;
	//00i
	id: string;
	//00p
	pseudo_id: string;
	//00b
	order_id: string;
	//1
	closed: string;
	//2
	symbol: string;
	//2b
	broker_symbol_id: string;
	//3
	trade_type: string;
	//4
	open_date: string;
	//5
	close_date: string;
	//6
	shares: string;
	//7
	entry_price: string;
	//8
	close_price: string;
	//9
	leverage: string;
	//10
	total_trade_cost: string;
	//11
	price_target: string;
	//12
	stop_loss: string;
	//13
	open_time: string;
	//14
	close_time: string;
	//15
	trading_account: string;
	//16
	details: string;
	//17
	premium: string;
	//18
	number_of_contracts: string;
	//19
	expiration: string;
	//20
	strike: string;
	//21
	variation_perc: string;
	//22
	variation: string;
	//23
	symbol_tag: string;
	//24
	symbol_id: string;
	//25
	trading_account_id: string;
	//26
	trading_account_tag: string;
	//27
	category: string;
	//28
	total_fees: string;
	//29
	closed_ref: string;
	//30
	closed_list: string;
	//31
	on_open_fees: string;
	//32
	on_close_fees: string;
	//33
	current_price: string;
	//sif
	stats_interpolated_fields: string;
	//juf
	json_user_fields: string;
	//b1
	save: string;
	//b2
	cancel: string;
	//b3
	delete: string;
	constructor(row: Partial<TradeObj>) {
		this.legend = row.legend || "false";
		this.saved_sorting = (row.saved_sorting || row.id) || "0";
		this.id = row.id || "0";
		this.pseudo_id = (row.pseudo_id || row.id) || "0n1";
		this.order_id = row.order_id || "0";
		this.closed = row.closed || "false";
		this.symbol = row.symbol || "";
		this.broker_symbol_id = row.broker_symbol_id || "";
		this.trade_type = row.trade_type || (row.category == "equity" || !row.category ? "long" : "call");
		this.open_date = row.open_date || "";
		this.close_date = row.close_date || "";
		this.shares = row.shares || "";
		this.entry_price = row.entry_price || "";
		this.close_price = row.close_price || "";
		this.leverage = row.leverage || "";
		this.total_trade_cost = row.total_trade_cost || "";
		this.price_target = row.price_target || "";
		this.stop_loss = row.stop_loss || "";
		this.open_time = row.open_time || "";
		this.close_time = row.close_time || "";
		this.trading_account = row.trading_account || "";
		this.details = row.details || "";
		this.premium = row.premium || "";
		this.number_of_contracts = row.number_of_contracts || "";
		this.expiration = row.expiration || "";
		this.strike = row.strike || "";
		this.variation_perc = row.variation_perc || "";
		this.variation = row.variation || "";
		this.symbol_tag = row.symbol_tag || "";
		this.symbol_id = row.symbol_id || "-1";
		this.trading_account_id = row.trading_account_id || "-1";
		this.trading_account_tag = row.trading_account_tag || "";
		this.category = row.category || "equity";
		this.closed_ref = row.closed_ref || "-1";
		this.closed_list = row.closed_list || "[]";
		this.total_fees = row.total_fees || "";
		this.on_open_fees = row.total_fees || "";
		this.on_close_fees = row.total_fees || "";
		this.current_price = row.current_price || "";
		this.stats_interpolated_fields = row.stats_interpolated_fields || "[]";
		this.json_user_fields = row.json_user_fields || buildDefaultUserFields();
		this.save = row.save || "Save";
		this.cancel = row.cancel || "Cancel";
		this.delete = row.delete || "Delete";
	}

}

type GraphicsDirective = Array<string>
const debugGraphicsLibrary: { [key: string]: GraphicsDirective } = {
	h3: [],
	description: [],
	input: ["form-control"],
	select: ["form-control"],
	div: [],
	button: ["btn", "btn-sm", "h-100"],
	openedBtn: ["btn", "btn-light", "h-100"],
	closedBtn: ["btn", "btn-warning", "h-100"],
	cancelBtn: ["btn-warning", "btn-block"],
	saveBtn: ["btn-primary", "btn-block"],
	deleteBtn: ["btn-danger", "btn-block"],
	darkener: ["tt-darkener"],
	tradeTable: ["trade-table"],
	tableBottomController: ["table-bottom-controller"],
	pageMoverHolder: ["page-mover-holder"],
	tradeWindow: ["tt-trade-window"],
	expander: ["tt-expander", "hidden"],
	expanderEmptyBlock: ["empty-block"],
	expanderTagSeparator: ["tag-separator"],
	expanderClickableValue: ["clickable-value"],
	mainBtn: ["btn-primary", "mr-3"],
	spawnerButton: ["spawner-new-button", "btn-primary", "mr-3"],
	tradeContainer: ["trade-container"],
	containerDropdown: ["dropdown-btn"],
	disabledBtn: ["disabled-btn"],
	promptBox: ["tt-prompt-box"],
	fieldHolder: ["field-holder", "form-group", "custom-group-width", "mb-0"],
	autoCalculated: [],
	editing: ["editing"],
	legendContainer: ["legendary"],
	closedRow: ["closed-row"],
	legendRow: ["legend-row"],
	mainRow: ["main-row"],
	fixedSection: ["fixed-section", "px-0"],
	scrollableSection: ["scrollable-section", "overflow-auto", "px-0"],
	controllerBox: ["tt-controller-box", "pb-5"],
	alert: ["tt-alert", "alert", "alert-dimissable"],
	closeWindowBtn: ["close-button"],
}
const graphicsLibrary: { [key: string]: GraphicsDirective } = {
	h3: [],
	description: [],
	input: ["form-control"],
	select: ["form-control"],
	div: [],
	button: ["btn"],
	openedBtn: ["btn", "btn-light", "btn-block"],
	closedBtn: ["btn", "btn-warning", "btn-block"],
	cancelBtn: ["btn-warning", "btn-block"],
	saveBtn: ["btn-primary", "btn-block"],
	deleteBtn: ["btn-danger", "btn-block"],
	darkener: ["tt-darkener", "btn-block"],
	tradeTable: ["trade-table"],
	tableBottomController: ["table-bottom-controller"],
	pageMoverHolder: ["page-mover-holder"],
	tradeWindow: ["tt-trade-window"],
	expander: ["tt-expander", "hidden"],
	expanderEmptyBlock: ["empty-block"],
	expanderTagSeparator: ["tag-separator"],
	expanderClickableValue: ["clickable-value"],
	mainBtn: ["btn-primary", "mr-3"],
	spawnerButton: ["spawner-new-button", "btn-primary", "mr-3"],
	tradeContainer: ["trade-container", "pl-3"],
	containerDropdown: ["dropdown-btn"],
	disabledBtn: ["disabled-btn"],
	promptBox: ["tt-prompt-box"],
	fieldHolder: ["field-holder", "form-group", "custom-group-width", "mb-0"],
	autoCalculated: [],
	editing: ["editing"],
	legendContainer: ["legendary"],
	closedRow: ["closed-row"],
	legendRow: ["legend-row"],
	mainRow: ["main-row", "row"],
	fixedSection: ["fixed-section", "col-3", "d-flex", "px-0"],
	scrollableSection: ["scrollable-section", "col-6", "overflow-auto", "d-flex", "px-0"],
	controllerBox: ["tt-controller-box", "pb-5"],
	alert: ["tt-alert", "alert", "alert-dimissable"],
	closeWindowBtn: ["close-button"],

}
//Merged interfacte
interface HTMLElement {
	/**
	  * htmlElement specific function that Adds a Graphical Directive to an html element
	  */
	agd(...classSet: Array<keyof typeof graphicsLibrary>): void,
	rgd(...classSet: Array<keyof typeof graphicsLibrary>): void,
}


HTMLElement.prototype.agd = function (...classSet: Array<keyof typeof graphicsLibrary>) {
	if (debug == true) {
		classSet.forEach(index => {
			this.classList.add(...debugGraphicsLibrary[index]);
		})
	} else {
		classSet.forEach(index => {
			this.classList.add(...graphicsLibrary[index]);
		})
	}
}
HTMLElement.prototype.rgd = function (...classSet: Array<keyof typeof graphicsLibrary>) {
	if (debug == true) {

		classSet.forEach(index => {
			this.classList.remove(...debugGraphicsLibrary[index]);
		})
	} else {
		classSet.forEach(index => {
			this.classList.remove(...graphicsLibrary[index]);
		})

	}
}

//Html extended Input element
interface HeIe extends HTMLInputElement {
	memory?: { [key: string]: any }
}
interface HeSe extends HTMLSelectElement {
	memory?: { [key: string]: any }
}
interface HeDe extends HTMLDivElement {
	memory?: { [key: string]: any },
	//Used in the lister

}
interface HeBe extends HTMLButtonElement {
	memory?: { [key: string]: any }
}
interface inputField extends HeIe {
	discriminator: "INPUT-FIELD",
	memory: {
		fieldHolder: fieldHolder
	}
	disabled: boolean,
	name: string,
	value: any,
}
interface selectField extends HeSe {
	discriminator: "SELECT-FIELD",
	memory: {
		fieldHolder: fieldHolder
	}
	disabled: boolean,
	name: string,
	value: any,
}
interface buttonField extends HeBe {
	discriminator: "BUTTON-FIELD",
	memory: {
		fieldHolder: fieldHolder
	}
	disabled: boolean,
	name: string,
	value: any,
}

interface listerButton extends HeDe {
	realValue?: listerObj
}

interface promptTemplate {
	text: string,
	attachedNumber: string,
	attachedObj: object,
}

function instanceOfIF(object: any): object is inputField {
	return object.discriminator === "INPUT-FIELD";
}
function instanceOfSF(object: any): object is selectField {
	return object.discriminator === "SELECT-FIELD";
}
function instanceOfBF(object: any): object is buttonField {
	return object.discriminator === "BUTTON-FIELD";
}

interface fieldHolder extends HeDe {
	memory: {
		field: inputField | selectField | buttonField,
		fieldHolder: HTMLElement
	}
}

interface structObj {
	name: string,
	target: inputField | selectField | buttonField,
	editing: boolean,
	hasCancelListener: boolean,
	//Tag of the directive
	dirTag: string,
	objLinked: string[],
	reset: (() => void),
}
function isStructObj(obj: any): obj is structObj {
	return 'name' in obj && 'target' in obj && 'editing' in obj && 'dirTag' in obj;
}

interface usableEvent extends Partial<Event> {
	target: buttonField | selectField | inputField,
}



interface refSortingTag {
	tag: string,
	logical: "equal",
	trades: Array<Row2>
}

//CustomFuncs
type TrueDirectives = "e" | "g" | "s" | "ge" | "se" | "im"; //greater, smaller, im: impossible
//Im is used for multipliers
interface TrueCondition {
	type: "string" | "number",
	//If it's a string defaults to "e"
	dir: TrueDirectives, //equal, greater, smaller etc.
	value: string | number,
}
interface FuncDirective {
	//Directive pointer, which field to check the data of
	dp: string,
	defaults: -1 | string, // -1 means that if it doesn't satisfy the conditions, it's blocking. A string means that it can default to that value in case, like leverage at "" can default to 1
	trueCondition: TrueCondition,
}

interface FuncTopic {
	defaults: -1 | string, // -1 means that if this topic is not satisfied the whole execution fails, otherwise it's what the topic defaults to
	//The type is inferred by the operations
	directives: Array<FuncDirective>
}

type FuncOperator = "+" | "-" | "i" | "*";
interface FuncOperation {
	//These get repeated as long as the chain exists
	mainOperationStreak: FuncOperator[],
	//If it's an array, it gets repeated only once, otherwise it gets repeated as long as there is space to do so
	subTopicOperation: Array<Array<
		Array<FuncOperator> | FuncOperator
	>>, //As above, but one for each block. Again, if missing they get repeated
}
interface FuncStructure {
	targets: string //the column to write in
	underlyingType: "string" | "number", //The operations act differently depending on this
	overwrite: 0 | 1, //0 overwrite only if condition is met, 1 always overwrite (basically autoupdate)
	overwriteCond: string //-1 never, string: only if it matches given string 
	topics: Array<FuncTopic>,
	operator: FuncOperation,
}
/**
 * NOT COMPLETE CHECKER OF A TRUECONDITION FOR A COMPFUNC
 * 
 * TODO: COMPLETE
 * @param element The element to check
 * @param trueCondition The appropriate truth condition
 * @returns bool
 */
function trueConditionCheck(element: string, trueCondition: TrueCondition) {
	if (trueCondition.dir == "im") {
		return false
	} else {
		switch (trueCondition.type) {
			case "number":
				switch (trueCondition.dir) {
					case "e":
						return pf(element) == trueCondition.value
					case "g":
						return pf(element) > trueCondition.value;
					case "ge":
						return pf(element) >= trueCondition.value;
					case "s":
						return pf(element) < trueCondition.value;
					case "se":
						return pf(element) <= trueCondition.value;
				}
			case "string":
				switch (trueCondition.dir) {
					case "e":
						return element == trueCondition.value
				}
				break
		}
		console.error("trueConditionCheck$ No case catched")
		return false
	}
}

/**
 * - !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 * 
 * INCOMPLETE FUNCTION, DO NOT USE
 */
function applyStrOperator(firstEl: string, secondEl: string, operator: FuncOperator): string {
	console.error("DO NOT CALL THIS FUNCTION, STILL WORK IN PROGRESS")
	return ""
}
function applyNumOperator(firstEl: number, secondEl: number, operator: FuncOperator): number {
	switch (operator) {
		case "+":
			return firstEl + secondEl
		case "-":
			return firstEl - secondEl
		case "*":
			return firstEl * secondEl
		case "i":
			console.error("Trying to operate on two numbers with an ignore operator")
			return 0
	}
}
//

let darkenedScreenElement: null | HTMLElement = null;
let darkenedScreenIndex = 0;


//Gather backend data
const tradeElement = document.getElementById("trade-list");
const symbolElement = document.getElementById("symbol-list");
const walletElement = document.getElementById("wallet-list");
let tradesList: Array<Partial<TradeObj>>, symbolList: Array<listerObj>, walletList: Array<listerObj>;

if (tradeElement === null || tradeElement.textContent === null) {
	tradesList = [];
} else {
	tradesList = JSON.parse(tradeElement.textContent.trim())
}
if (symbolElement === null || symbolElement.textContent === null) {
	symbolList = [];
} else {
	symbolList = JSON.parse(symbolElement.textContent.trim())
}
if (walletElement === null || walletElement.textContent === null) {
	walletList = [];
} else {
	walletList = JSON.parse(walletElement.textContent.trim())
}

/**
 * Returns an input field
 * @returns {domElement} Input field
 */
function spawnInput() {
	const res: HeIe = document.createElement("input");
	res.agd("input");
	res.memory = {};
	return res;
}
/**
 * Returns a select field
 * @returns {domElement}
 */
function spawnSelect() {
	const res: HeSe = document.createElement("select");
	res.agd("select");
	res.memory = {};
	return res;
}
function spawnDiv() {
	const res: HeDe = document.createElement("div");
	res.agd("div");
	res.memory = {} as { field: any, fieldHolder: any };
	return res;
}
/**
 * Returns a BUTTON element
 * @returns {domElemeent}
 */
function spawnBtn() {
	const res: HeBe = document.createElement("button");
	res.agd("button");
	res.memory = {};
	return res;
}
/**
 * 
 * @param text The text to prompt
 * @param options CURRENTLY NOT OPERATIONAL 
 * @returns 
 */
async function trueFalsePrompt(text: string, options: { trueTxt: string, falseTxt: string } = { trueTxt: "Yes", falseTxt: "Cancel" }): Promise<boolean> {
	const prompt = spawnDiv();
	document.body.append(prompt);
	prompt.agd("promptBox");

	const closeBtn = spawnBtn();
	closeBtn.innerHTML = "✕";
	closeBtn.agd("closeWindowBtn");

	const trueBtn = spawnBtn();
	const falseBtn = spawnBtn();

	falseBtn.agd("deleteBtn");
	trueBtn.agd("saveBtn");


	const description = spawnDiv();
	description.agd("h3");

	description.innerHTML = text;
	trueBtn.innerHTML = options.trueTxt;
	falseBtn.innerHTML = options.falseTxt;

	prompt.append(closeBtn);
	prompt.append(description);
	prompt.append(trueBtn);
	prompt.append(falseBtn);


	const result: boolean = await new Promise(function (resolve) {
		window.addEventListener("mousedown", function (e) {
			if (e.target != prompt && e.target != trueBtn && e.target != falseBtn) {
				prompt.remove();
				resolve(false)
			}
		})
		closeBtn.addEventListener("click", function () {
			prompt.remove();
			resolve(false)
		});
		falseBtn.addEventListener("click", function () {
			prompt.remove();
			resolve(false)
		});
		trueBtn.addEventListener("click", function () {
			prompt.remove();
			resolve(true)
		});
	})

	return result;

}

//TODO: Increase capabilities of this function using keymatching, iterating through the object, checking for hollow elements.
/**
 * Function to compare objects
 * @param {Object} a
 * @param {Object} b
 * // @param {true | false} emptyStrict Whether the existance of an empty field on one object, and the
 * @returns {true|false}
 */
function isEquivalent(a: { [key: string]: any }, b: { [key: string]: any }): boolean {
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
			return false;
		}
	}
	// If we made it this far, objects
	// are considered equivalent
	return true;
}
/**
 * This is a simple, *insecure* hash that's short, fast, and has no dependencies.
 * For algorithmic use, where security isn't needed, it's way simpler than sha1 (and all its deps)
 * or similar, and with a short, clean (base 36 alphanumeric) result.
 * Loosely based on the Java version; see
 * https://stackoverflow.com/questions/6122571/simple-non-secure-hash-function-for-javascript
 * 
 * This function is currently used to throw the right events to scroll the other rows.
*/
const simpleHash = (str: string) => {
	let hash = 0;
	for (let i = 0; i < str.length; i++) {
		const char = str.charCodeAt(i);
		hash = (hash << 5) - hash + char;
		hash &= hash; // Convert to 32bit integer
	}
	return new Uint32Array([hash])[0].toString(36);
};

const isN = (el: string) => {
	return !isNaN(parseFloat(el))
}

function getFuncName() {
	return getFuncName.caller.name
}

//For ease of writing where multiple conversion are needed
const pf = parseFloat;
/**
 * Function that darkens the screen at a given zindex. Moves it up if the current index is below the argument, or deletes it if remove is true
 * @param {int} index At what z-index to spawn it
 * @param {true|false} remove Whether it should be removed
 */
function zDarkner(index: string, remove: boolean = false, opacity = "0.35", pointerEvents: boolean = false) {
	if (!remove) {
		if (darkenedScreenElement == null) {
			const darkener = document.createElement("div");
			document.body.append(darkener);
			darkener.agd("darkener");
			darkenedScreenElement = darkener;
			//Style it
			darkener.style.opacity = opacity;
			darkener.style.zIndex = index;
			darkener.style.pointerEvents = pointerEvents ? "all" : "none";
		} else {
			//Only do something if the index is bigger than the current one
			if (darkenedScreenIndex < parseFloat(index)) {
				darkenedScreenElement.style.zIndex = index;
			}
			darkenedScreenElement.style.opacity = opacity;
		}
		return darkenedScreenElement;
	} else {
		if (darkenedScreenElement != undefined) {
			darkenedScreenElement.style.opacity = "0";
			darkenedScreenIndex = 0;
		}
		return null;
	}
}
/**
 * Either blocks the body or unlocks it
 * @param {true|false} block
 */
function blockBody(block = true) {
	if (block) {
		document.body.style.overflow = "hidden";
	} else {
		document.body.style.overflow = "auto";
	}
}
/**
 * Returns true if the current input is valid
 * @returns {true|false}
 */
function validPerc(closeValue: string) {
	var regex = /^[a-zA-Z]+$/
	if (
		closeValue == undefined ||
		closeValue == "" ||
		closeValue.match(regex) != null ||
		parseFloat(closeValue) < 0 ||
		parseFloat(closeValue) > 100
	) {
		console.error("La percentuale:", closeValue, "non va bene INT:", parseFloat(closeValue))
		return false;
	}
	return true;
}
/**
 * Function to change the visibility state of an element by switching its viewSys properties (visible/hidden)
 * @param element The element to give and remove classes to
 * @param visible In which state to put the element
 * @param stateProperties An array of state properties to update
 */
function changeVisible(element: HTMLElement, visible: boolean, stateProperties: boolean[] = []) {
	if (visible == true) {
		element.classList.add("visible");
		element.classList.remove("hidden");
	} else {
		element.classList.add("hidden");
		element.classList.remove("visible");
	}
	stateProperties.forEach(property => {
		property = visible
	})
}

type sectionsLayout = Array<{
	fixed: boolean,
	size: string,
	//elements: Array<keyof typeof defaultFields | keyof typeof userPrefs.customFields>,
	//nElements: Array<keyof typeof defaultFields | keyof typeof userPrefs.customFields>
	elements: Array<string>,
	activeFormulas: Array<keyof UserPreferences['formulas']['fields']>,
	nElements: Array<string>
}>
interface UserPreferences {
	//selectedSorting: keyof UserPreferences["sortings"]
	selectedSorting: string,
	sortings: {
		[key: string]: {
			targets: keyof TradeObj,
			blocks: {
				[key: string]: {
					name: string,
					tag: string,
					tagLogical: "equal",
					variations: {
						text: string, value: string
					}[]

					//selected: keyof UserPreferences["sortings"][UserPreferences["selectedSorting"]]["blocks"]["layouts"],
					selected: string,
					layouts: {
						[key: string]: sectionsLayout
					},
				}

			}
		}
	},
	rowsPerPage: number,
	customFields: {
		[key: string]: fieldDirective,
	},
	promptDefaults: {
		[key: string]: { [key: string]: promptTemplate }
	},
	promptDefaultsDirectives: {
		[key: string]: {
			//templateName: keyof UserPreferences["promptDefaults"],
			//selected: keyof UserPreferences["promptDefaultsDirectives"]["variations"],
			templateName: string,
			selected: string,
			variations: {
				[key: string]: Array<string>
			}
		}
	},
	/*
	formulas: {
		fields: {
			[key: string]: (row: Row2, dirPointer: string) => void
		}
	},
	*/
	formulas: {
		fields: {
			[key: string]: FuncStructure
		}
	}
	walletList: Array<listerObj>,
	symbolList: Array<listerObj>,

}


//USER PREFERENCES

//The user can add trades (logs) of that type. Every tipe has specific features
//Then the user can define views using the available fields inside the available types
//The user can add a new type, and he can
const userPrefs: UserPreferences = {
	//Sortings are based on one database column
	selectedSorting: "categories",
	sortings: {
		categories: {
			//The trade property that it targets - currently used for table sorting and row column assignment
			targets: "category",
			blocks: {
				equity: {
					// Name is for example used in creating new trades as the tag which comes up 
					name: "Equity",
					//Tag is used for conditional logic - equal to the key name
					//Deployed in the trade using the getVars function
					tag: "equity",
					//What logical operation to run when running a sorting.
					tagLogical: "equal",
					variations: [
						{ text: "Long", value: "long" },
						{ text: "Short", value: "short" },
					],
					selected: "default",

					layouts: {
						//If an element is not fixed, then it will be able to scroll
						//Which elements get rendered? Check "availableFields"
						//If fixed is true, then the size 
						default: [
							{ fixed: true, size: "20%", elements: ["1", "2", "3"], activeFormulas: [], nElements: [] as string[] },
							{
								fixed: false,
								size: "75%",
								elements: ["7", "6", "9", "8", "10", "11", "12", "4", "13", "5", "14", "u1", "15"],
								activeFormulas: ["totalCost"],
								nElements: [] as string[]
							},
							{
								fixed: true,
								size: "15%",
								elements: ["b1", "b2", "b3"],
								activeFormulas: [],
								nElements: [] as string[]
							},
							//0 layouts are holding all the not displayed fields till now
							//The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
							//0 layouts have to be used
							{
								fixed: true,
								size: "0",
								activeFormulas: [],
								//This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
								nElements: [
									"1",
									"2",
									"3",
									"7",
									"6",
									"9",
									"8",
									"10",
									"11",
									"12",
									"4",
									"13",
									"5",
									"14",
									"u1",
									"15",
									"b1",
									"b2",
									"b3",
								],

								elements: [] as string[],
							},
						],
					},
				},
				option_buy: {
					name: "Option Buy",
					//Tag is used for conditional logic - equal to the key name
					//Deployed in the trade using the getVars function
					tag: "option_buy",
					//What logical operation to run when running a sorting.
					tagLogical: "equal",
					variations: [
						{ text: "Call", value: "call" },
						{ text: "Put", value: "put" },
					],
					selected: "default",
					layouts: {
						//If an element is not fixed, then it will be able to scroll
						//Which elements get rendered? Check "availableFields"
						//If fixed is true, then the size 
						default: [

							{ fixed: true, size: "10%", elements: ["1", "2", "3"], activeFormulas: [], nElements: [] as string[] },
							{
								fixed: false,
								size: "80%",
								elements: ["17", "18", "10", "19", "20", "11", "12"],
								activeFormulas: ["totalCost"],
								nElements: [] as string[]
							},
							{
								fixed: true,
								size: "10%",
								elements: ["b1", "b2", "b3"],
								activeFormulas: [],
								nElements: [] as string[]
							},
							//0 layouts are holding all the not displayed fields till now
							//The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
							//0 layouts have to be used
							{
								fixed: true,
								size: "0",
								activeFormulas: [],
								//This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
								nElements: [
									"1",
									"2",
									"3",
									"17",
									"18",
									"10",
									"19",
									"20",
									"11",
									"12",
									"u1",
									"15",
									"b1",
									"b2",
									"b3",
								],

								elements: [] as string[],
							},
						],
					},
				},
				// option: {
				// 	name: "Buy Options",
				// 	tag: "option",
				// 	tagLogical: "equal",
				// 	variations: [
				// 		{ text: "Call", value: "call" },
				// 		{ text: "Putt", value: "put" },
				// 	],
				// 	selected: "default",
				// 	layouts: {
				// 		default: {},
				// 	},
				// },
				// optionSell: {
				// 	name: "Write options",
				// 	tag: "optionSell",
				// 	tagLogical: "equal",
				// 	variations: [
				// 		{ text: "Call", value: "call" },
				// 		{ text: "Putt", value: "put" },
				// 	],
				// 	selected: "default",
				// 	layouts: {
				// 		default: {},
				// 	},
				// },
			},
		},
	},
	rowsPerPage: 10,
	customFields: {
		"u1": {
			name: "testText",
			type: "input",
			default: "testingthisthinghere",
			render: "true",
			subtype: "text",
			modifiers: [] as string[],
			computed: [] as string[],
			description: "A test input I built to try this feature out",
			placeholder: "testing",
			columnName: "Test Text (Field!)",
		},
	},
	/**
	* These are common elements to be spawned in prompts (like standard close percentage and other stuff)
	* - text usually refers to a displayed value
	* - attachedNumber is a quick version of an attached object with various information inside of it
	* - attachedObject contains any other required information, that will be handled by the handler of an expander
	 */
	promptDefaults: {
		//Default values to be shown when creating a new field - pending implementation
		// fieldDefaults: {
		//...
		// },
		/**
		 * attachedNumber:
		 * - = 1 means that a builder should be opened using the provided basic options
		 * - = 0 means that the trade should be built immediately and sorted
		 * 
		 * text:
		 * - the default value for the text of the button.
		 * 
		 * ? a possible and interesting feature could be to have "default" trades built based on chosen sorting
		 */
		newRowsTemplates: {
			"0": { text: "New Trade", attachedNumber: "1", attachedObj: {} },
			"1": { text: "Equity Trade", attachedNumber: "0", attachedObj: { category: "equity", trade_type: "long" } },
			"2": { text: "Buy Option", attachedNumber: "0", attachedObj: { category: "option_buy", trade_type: "call" } },
			"3": { text: "Sell Option", attachedNumber: "0", attachedObj: { category: "option_sell" } },
		},
		//
		closePrompt: {
			"0": { text: "25%", attachedNumber: "25", attachedObj: {} },
			"1": { text: "50%", attachedNumber: "50", attachedObj: {} },
			"2": { text: "75%", attachedNumber: "75", attachedObj: {} },
			"3": { text: "100%", attachedNumber: "100", attachedObj: {} },
		},
	} as { [key: string]: { [key: string]: promptTemplate } },
	/** 
	 * These are used to keep every newly created option saved in the defaults, but let users decide a configuration for them. 
	 * Currently NOT used by the close prompt 
	 * 
	 * Selected object contains the selected setting for such object. 
	 * Currently NOT implemented ways to add multiple settings. Could be useful for changing spawners with different layouts
	 * */
	promptDefaultsDirectives: {
		newRows: {
			templateName: "newRowsTemplates",
			selected: "default",
			variations: {
				default: ["1", "2"]
			}
		}
	},
	formulas: {
		fields: {
			totalCost: {
				targets: "10",
				underlyingType: "number",
				overwrite: 0,
				overwriteCond: "",
				topics: [
					{
						defaults: "0",
						directives: [
							//Ignore the first if true and calculate with the others
							{
								dp: "27",
								defaults: -1,
								trueCondition: {
									type: "string",
									dir: "e",
									value: "option_buy",
								}
							},
							{
								dp: "18",
								defaults: -1,
								trueCondition: {
									type: "number",
									dir: "ge",
									value: 0,
								}
							},
							{
								dp: "17",
								defaults: -1,
								trueCondition: {
									type: "number",
									dir: "ge",
									value: 0,
								}
							},
							//100x premium multiplier
							{
								dp: "0",
								defaults: "100",
								trueCondition: {
									type: "number",
									dir: "im",
									value: 0,
								}
							},
						]

					},
					{
						defaults: "0",
						directives: [
							//Ignore the first if true and calculate with the others
							{
								dp: "27",
								defaults: -1,
								trueCondition: {
									type: "string",
									dir: "e",
									value: "equity",
								}
							},
							{
								dp: "6",
								defaults: -1,
								trueCondition: {
									type: "number",
									dir: "ge",
									value: 0,
								}
							},
							{
								dp: "7",
								defaults: -1,
								trueCondition: {
									type: "number",
									dir: "ge",
									value: 0,
								}
							},
						]

					},
					{
						defaults: "0",
						directives: [
							{
								dp: "31",
								defaults: -1,
								trueCondition: {
									type: "number",
									dir: "ge",
									value: 0,
								}
							},
							{
								dp: "32",
								defaults: -1,
								trueCondition: {
									type: "number",
									dir: "ge",
									value: 0,
								}
							},
							{
								dp: "34",
								defaults: -1,
								trueCondition: {
									type: "number",
									dir: "ge",
									value: 0,
								}
							},
						]

					},
				],
				operator: {
					mainOperationStreak: ["+"],
					subTopicOperation: [[["i"], "+", "*", "*"], [["i"], "+", "*"], ["+"]]
				}
			}
		}
	},

	walletList: [...walletList],
	symbolList: [...symbolList],
	// [
	// 	{ id: "01", value: "Personal Account", tag: "Schwab" },
	// 	{ id: "02", value: "WALL2", tag: "Ungrouped" },
	// 	{ id: "03", value: "WALL3", tag: "TD Ameritrade" },
	// ],

};
function getTradeTypeVars() {
	const result: { [key: string]: Array<variation> } = {};
	for (const [key, value] of Object.entries(userPrefs.sortings.categories.blocks)) {
		result[key] = value.variations;
	}
	return result;
}

function buildDefaultUserFields() {
	const res: { [key: string]: string } = {};
	Object.values(userPrefs.customFields).forEach(customField => {
		res[customField.name] = customField.default;
	});
	return JSON.stringify(res);
}
//LIST MANAGEMENT

/**
 *
 * - FORMAT:
 *  id: 1++ for our fields | b1++ for buttons | u1++ for user fields :
 *  {
 * 		name: string - db property,
 * 		render: whether this object can be rendered into a column or not.
 * 		default: default value that the input has when first rendered
 * 		type: general type of input ( input | choice | legend),
 * 		subtype: variant of input or,
 * 		options: takes a specifically modeled array to be used for select or list fields
 * 		modifiers: for fields that need to change depending on the state of the row,
 * 		objLinked: properties in the standardobject which are linked to the field (which the field edits. No field is associated to those properties). Usually a backend value like tag or id for symbols.
 * 		description: description for the user,
 * 		placeholder: text that goes in the input field,
 * 		columnName: "" | string - if not specified, the db name is used (i.e. the name property),
 *  }
 *
 * - MODIFIERS:
 * 
 * "editing" - active when editing
 * "stat" - calculated in the frontend
 *
 */



//? Rebuild with Record<>??
const defaultFields: { [key: string]: fieldDirective } = {
	"0": {
		name: "legend",
		render: "true",
		default: "",
		type: "input",
		subtype: "locked",
		modifiers: [] as string[],
		computed: [] as string[],
		description: "Fixed text field - shows the text which it's given as value",
		placeholder: "",
		columnName: "Legend?",
	},
	"s": {
		name: "saved_sorting",
		render: "false",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],
		description: "The saved sorting in the database",
		placeholder: "",
		columnName: "Saved Sorting",
	},
	"00i": {
		name: "id",
		render: "false",
		default: "0",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description:
			"Id of the trade from our database. Autoincremented by the backend",
		placeholder: "",
		columnName: "DB Id",
	},
	"00p": {
		name: "pseudo_id",
		render: "false",
		default: "0",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description:
			"Used for linear access. If the trade comes from the database, equal to the trade id. Otherwise, adjusted in the frontend to signify closedness etc.",
		placeholder: "",
		columnName: "Pseudo Id",
	},
	"00b": {
		name: "order_id",
		render: "false",
		default: "0",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "broker based order id",
		placeholder: "",
		columnName: "Broker Id",
	},
	"1": {
		name: "closed",
		render: "true",
		default: "false",
		type: "closed",
		subtype: "",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Toggles the trade status between open and closed",
		placeholder: "",
		columnName: "Closed",
	},
	"2": {
		name: "symbol",
		render: "true",
		default: "",
		type: "choice",
		subtype: "list",
		options: symbolList,
		modifiers: [] as string[],
		computed: [] as string[],

		objLinked: ["symbol_tag", "symbol_id"],
		description: "Here you store which ticker you traded",
		placeholder: "AAPL, SPY, AMZN",
		columnName: "Symbol",
	},
	"2b": {
		name: "broker_symbol_id",
		render: "true",
		default: "",
		type: "choice",
		subtype: "list",
		options: symbolList,
		modifiers: [] as string[],
		computed: [] as string[],

		objLinked: [],
		description: "Symbol id in the broker (userful if treating options)",
		placeholder: "0ROOT.JF10007500",
		columnName: "Broker Symbol ID",
	},
	"3": {
		// NOT THE CATEGORY, that one is at id 27
		name: "trade_type",
		render: "true",
		default: "buy",
		type: "choice",
		subtype: "select",
		//* Function - Here we are not allowing users to change category of trade from the trade itself. We can implement re-creation later
		options: getTradeTypeVars(),
		modifiers: [] as string[],
		computed: [] as string[],

		description: "This choice impacts statistic calculations",
		placeholder: "",
		columnName: "Trade Type",
	},
	"4": {
		name: "open_date",
		render: "true",
		default: "",
		type: "input",
		subtype: "date",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Open Date",
	},
	"5": {
		name: "close_date",
		render: "true",
		default: "",
		type: "input",
		subtype: "date",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Close Date",
	},
	"6": {
		name: "shares",
		render: "true",
		default: "0",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce"],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Shares",
	},
	"7": {
		name: "entry_price",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Entry Price",
	},
	"8": {
		name: "close_price",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Close Price",
	},
	"9": {
		name: "leverage",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],


		description: "Desc",
		placeholder: "",
		columnName: "Leverage",
	},
	"10": {
		name: "total_trade_cost",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce", "total_cost"],
		computed: [] as string[],


		description: "Desc",
		placeholder: "",
		columnName: "Total Trade Cost",
	},
	"11": {
		name: "price_target",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Price Target",
	},
	"12": {
		name: "stop_loss",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Stop Loss",
	},
	"13": {
		name: "open_time",
		render: "true",
		default: "",
		type: "input",
		subtype: "time",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Open Time",
	},
	"14": {
		name: "close_time",
		render: "true",
		default: "",
		type: "input",
		subtype: "time",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Close Time",
	},
	"15": {
		name: "trading_account",
		render: "true",
		default: "",
		type: "choice",
		subtype: "list",
		modifiers: [] as string[],
		computed: [] as string[],

		objLinked: ["trading_account_tag, trading_account_id"],
		options: walletList,
		description: "Desc",
		placeholder: "",
		columnName: "Trading Account",
	},
	"16": {
		name: "details",
		render: "true",
		default: "",
		type: "tags",
		subtype: "",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Details",
	},
	"17": {
		name: "premium",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Premium",
	},
	"18": {
		name: "number_of_contracts",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce"],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Number of Contracts",
	},
	"19": {
		name: "expiration",
		render: "true",
		default: "",
		type: "input",
		subtype: "date",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Expiration Date",
	},
	"20": {
		name: "strike",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Strike",
	},
	"21": {
		name: "variation_perc",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Variation Percentage",
	},
	"22": {
		name: "variation",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce"],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Variation",
	},
	"23": {
		name: "symbol_tag",
		render: "false",
		//Default synced with List match function and list builder
		default: "",
		type: "input",
		subtype: "text",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Symbol Tag",
	},
	"24": {
		name: "symbol_id",
		//Default synced with List match function and list builder
		render: "false",
		default: "-1",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Symbol Id",
	},
	"25": {
		name: "trading_account_id",
		//Default synced with List match function and list builder
		render: "false",
		default: "-1",
		type: "input",
		subtype: "number",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Trading Account Id",
	},
	"26": {
		name: "trading_account_tag",
		//Default synced with List match function and list builder
		render: "false",
		default: "-1",
		type: "input",
		subtype: "tag",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Trading Account Tag",
	},
	"27": {
		name: "category",
		//Default synced with List match function and list builder
		render: "true",
		default: "equity",
		type: "input",
		subtype: "text",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Trade Category",
	},
	"28": {
		name: "total_fees",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce"],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Total Fees",
	},
	"29": {
		//REF IS DIRECTED TOWARDS THE PSEUDOID, NOT THE ID
		name: "closed_ref",
		//Default synced with List match function and list builder
		render: "false",
		default: "-1",
		type: "input",
		subtype: "id",
		modifiers: [] as string[],
		computed: [] as string[],

		description:
			"if -1, the trade is not closed, otherwise it's the id of the trade to which this is a partial close",
		placeholder: "",
		columnName: "Closed Reference",
	},
	"30": {
		name: "closed_list",
		//Default synced with List match function and list builder
		render: "false",
		//TODO: Update on save
		default: "[]",
		type: "input",
		subtype: "array[int]",
		modifiers: [] as string[],
		computed: [] as string[],

		description:
			"Contains IDs of partial closes of this trade. When this trade is partially closed, this field obtains the id of the first partial close",
		placeholder: "",
		columnName: "Closed List",
	},
	"31": {
		name: "on_open_fees",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce"],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "On Open Fees",
	},
	"32": {
		name: "on_close_fees",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce"],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "On Close Fees",
	},
	"33": {
		name: "current_price",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: [],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Current Price",
	},
	"34": {
		name: "position_holding_fees",
		render: "true",
		default: "",
		type: "input",
		subtype: "number",
		modifiers: ["closed_reduce"],
		computed: [] as string[],

		description: "Fees that accumulate through overnight or other sort of means",
		placeholder: "",
		columnName: "Ownership Fees",
	},
	"sif": {
		name: "stats_interpolated_fields",
		//Default synced with List match function and list builder
		render: "false",
		default: "{}",
		type: "input",
		subtype: "JSON",
		modifiers: [] as string[],
		computed: [] as string[],

		description:
			"Holds the fields which are currently controlled by the stats attribute. Becomes a set in the row object",
		placeholder: "",
		columnName: "Stats interpolated fields",
	},
	"juf": {
		name: "json_user_fields",
		//Default synced with List match function and list builder
		render: "false",
		default: "{}",
		type: "input",
		subtype: "JSON",
		modifiers: [] as string[],
		computed: [] as string[],

		description:
			"Gets parsed to all the user fields as value. When the trade is saved all the user field data gets jsonized in here",
		placeholder: "",
		columnName: "Json User Fields",
	},
	"b1": {
		name: "save",
		render: "true",
		default: "Save",
		type: "button",
		subtype: "save",
		modifiers: [] as string[],
		computed: [] as string[],

		description: "Desc",
		placeholder: "",
		columnName: "Save",
	},
	"b2": {
		name: "delete",
		render: "true",
		default: "Cancel",
		type: "button",
		subtype: "cancel",
		modifiers: [] as string[],
		computed: [] as string[],
		description: "Desc",
		placeholder: "",
		columnName: "Cancel",
	},
	"b3": {
		name: "cancel",
		render: "true",
		default: "Delete",
		type: "button",
		subtype: "delete",
		modifiers: [] as string[],
		computed: [] as string[],
		description: "Desc",
		placeholder: "",
		columnName: "Delete",
	},
};
/**
 * * Function to create a CLEAN list of available fields
 * Spreads the default field object alongside the customfields one in a new object and returns it
 * - Overlapping is not taken care of
 * @returns {{int:{}} }
 */
const availableFieldsGen = () => {
	const res = { ...defaultFields, ...userPrefs.customFields } as { [key: string]: fieldDirective };
	return res;
}
/**
 * * Crucial that returns the name of a specific field given its identifier 
 * - Use: Lets you change names based on db with a single text change in the userfields property
 * @param {string} identifier Id of the available fields property
 * @returns {string} Name in the database
 */

////////////////////
// Tables Section //
////////////////////

const gin = (identifier: string): keyof TradeObj => {
	const availableFields = availableFieldsGen();
	if (availableFields.hasOwnProperty(identifier)) {
		return availableFields[identifier as keyof typeof availableFields].name as keyof TradeObj
	} else {
		console.error("Accessing non-existing/undefined tag with gin:", identifier, availableFields, "\n Bad indexing happening");
		return gin("0")
	}
}

class Table {
	parent: HTMLElement;
	//Target is empty until the row is built
	target: HTMLElement | "";
	tradeWindowRef: TradeWindow;
	//Sorted children only contains main trades NOT partial ones
	sortedChildren: Array<Row2>;
	activeLegend: Row2 | "";
	children: { [key: string]: Row2 };
	// visibleRows: Array<Row2>;
	currentPage: number;
	currentPageMin: number;
	currentPageMax: number;
	controllerBox: {
		box: HTMLElement | "",
		pageMover: {
			holder: "" | HTMLElement,
			currentPage: HTMLInputElement | "",
			moveForward: HTMLButtonElement | "",
			moveBackward: HTMLButtonElement | "",
		}
	};

	/**
	 *
	 * @param {domElement} parent Literally where to render the table
	 * @param {Row[]} originalChildrenArray array of rows.
	 * @param {TradeWindow} tradeWindowRef used to reference high-up from rows
	 */
	constructor(parent: HTMLElement, originalChildrenArray: Row2[] = [], tradeWindowRef: TradeWindow) {
		this.parent = parent;
		this.target = "";
		this.tradeWindowRef = tradeWindowRef;
		//
		const tableProps = this.c_sortChildren(originalChildrenArray);
		//Increasing order by id
		this.sortedChildren = tableProps[0];
		this.activeLegend = "";
		this.children = tableProps[1];
		// this.visibleRows = [];
		this.currentPage = 1;
		this.currentPageMin = 1;
		this.currentPageMax = 1;
		this.controllerBox = {
			box: "",
			pageMover: {
				holder: "",
				currentPage: "",
				moveBackward: "",
				moveForward: "",
			}
		}
	}
	/**
	 * Returns an array containing the rows in sorted order and the rows by id.
	 * @param childArray The rows coming in
	 */
	c_sortChildren(childArray: Array<Row2>): [Array<Row2>, { [key: string | number]: Row2 }] {
		const byIdObj: { [key: string]: Row2 } = {};
		//Sort in INCREASING order
		//The LOWEST sorting gets put first as of css convention.
		//OTHERWISE
		//By sorting from smallest to greates, the smallest gets rendered as the first element, hence pushed to the end
		const mainTrades = [...childArray].filter(row => row.current[gin("29")] == "-1")
		const sortedArr: Array<Row2> = mainTrades.sort(function (rowA, rowB) {
			return rowB.state.currentSorting - rowA.state.currentSorting;
		});
		for (let i = 0; i < childArray.length; i++) {
			const children = childArray[i];
			byIdObj[children.current[gin('00p')]] = children;
			children.changeTableReference(this);

		}
		return [sortedArr, byIdObj];


	}
	reorderRows() {
		//We can call sortChildren with ONLY mainRows, reducing loops and getting the same result
		this.sortedChildren = this.c_sortChildren(this.sortedChildren)[0]
		this.sortedChildren.forEach(mainRow => {
			if (mainRow.state.container != "") {
				mainRow.state.container.style.order = mainRow.state.currentSorting.toString();
			} else {
				console.error("Impossible to reorder given row: its container is undefined")
			}
		})
		this.refreshPages();
	}
	renderTable() {
		//STYLEME
		const table = document.createElement("div");
		table.agd("tradeTable");
		this.parent.append(table);
		this.target = table;
		this.renderController();
	}
	/**
	 * Renders all the needed controllers for the table.
	 */
	renderController() {
		const controllerBox = document.createElement("div");
		this.controllerBox.box = controllerBox;
		controllerBox.agd("tableBottomController");
		if (this.target != "") {
			////////////
			//PAGE MOVER
			const holder = document.createElement("div");
			this.target.append(controllerBox);
			holder.agd("pageMoverHolder")

			const moveForward = spawnBtn();
			moveForward.innerHTML = "&rarr;";
			const moveBackward = spawnBtn();
			moveBackward.innerHTML = "&larr;";
			const currentPage = spawnInput();
			currentPage.value = this.currentPage.toString();
			holder.append(moveBackward, currentPage, moveForward);

			this.controllerBox.pageMover = {
				holder,
				currentPage,
				moveBackward,
				moveForward,
			}

			controllerBox.append(holder);
			moveForward.addEventListener("click", (e) => { this.pageForward() });
			moveBackward.addEventListener("click", (e) => { this.pageBackward() });


			currentPage.addEventListener("change", () => {
				//The other functions already check for this, but we avoid a streak of refreshing functions
				if (this.currentPageMin <= parseInt(currentPage.value) && parseInt(currentPage.value) <= this.currentPageMax) {
					this.currentPage = parseInt(currentPage.value);
					this.refreshPages();
				}
			})
		} else {
			console.error("Trying to append controller to DOM undefined table");

		}
	}
	/**
	 * Renders each present row following the sortedChildren order
	 * @param {bool} refreshLayout Whether we are creating new containers or just refereshing the layout.
	 * It works because when we render we take the value from the current object and not the origin one.
	 */
	renderRows(refreshLayout = false) {
		this.sortedChildren.forEach((row) => {
			row.renderRow(!refreshLayout);
		});
		if (refreshLayout) {
			if (this.activeLegend != "") {
				this.activeLegend.renderRow(false);
			} else {
				console.error("Trying to refresh layout of a table without having rendered the legend")
			}
		}
		this.refreshPages();
	}
	renderLegend(information: refSortingTag) {
		if (this.activeLegend != "") {
			this.activeLegend.d_delete();
			this.activeLegend = "";
		}
		//Create a legend with properties that satisfy the refSortingTag
		const selectedSortingTarget = userPrefs.sortings[userPrefs.selectedSorting as keyof typeof userPrefs.sortings].targets;
		const freshLegendObj = new TradeObj({ legend: "true", id: "-1" })
		switch (information.logical) {
			case "equal":
				freshLegendObj[selectedSortingTarget] = information.tag;
				break;
		}
		const newLegend = new Row2(freshLegendObj, true);
		newLegend.changeTableReference(this);
		newLegend.renderRow();

		this.activeLegend = newLegend;
	}


	hideTable() {
		if (!!this.target) {
			this.target.style.display = "none";
		}
	}
	/**
	 * This is a general function to refresh things when a trade gets deleted, number of trades per pages gets changed or any other impacting change
	 * 
	 * To keeps things in order, the new current page becomes the one with the first trade on the current one if the previous current is not empty. ù
	 * If empty the new current page is instead the last one
	 * 
	 * - Calls the refreshCurrentPageVisibility function 
	 * - Calls the refreshPageController function
	 */
	refreshPages() {
		//Check whether after the update you are on an empty page
		if (this.pagedTrades().length == 0) {
			const maxPage = Math.floor(this.sortedChildren.length / userPrefs.rowsPerPage) + 1;
			this.currentPage = maxPage;
		} else {
			const lastTradePosition = this.sortedChildren.indexOf(this.pagedTrades()[0]);
			this.currentPage = Math.floor(lastTradePosition / userPrefs.rowsPerPage) + 1;
		}

		//Update the controller and which trades should be shown
		this.refreshCurrentPageVisibility();
		this.refreshPageController();
		this.updateLegendPosition();
	}
	/**
	 * Shows the current page trades based on the sortedChildren property of the table, and hides all the rest  
	 * 
	 * Important note: When looking for specific trades, the pageVisibility stops being a matter of importance, then the searching function RE-runs this function to re-page the trades correctly
	 */
	//! Big optimization flaw
	//TODO: Optimize this by working with reverse indexes instead of reversing the array
	refreshCurrentPageVisibility() {
		//Spread to not reverse the sorted one
		//Reference to objects is kept anyways
		const reversedArray = [...this.sortedChildren].reverse();
		const lowerBound = (this.currentPage - 1) * userPrefs.rowsPerPage;
		const upperBound = (this.currentPage * userPrefs.rowsPerPage - 1);

		for (let index = 0; index < reversedArray.length; index++) {
			const element = reversedArray[index];
			//TODO: Decide whether to hide the mainRow or the container. 
			if (index >= lowerBound && index <= upperBound) {
				if (element.state.container != "") {
					element.state.paged = true;
					const childTrades: string[] = JSON.parse(element.current[gin("30")]);
					childTrades.forEach(id => {
						//Backward pagination update. Ran forward when new rows are inserted
						if (this.tradeWindowRef.allRowsObj.hasOwnProperty(id)) {
							this.tradeWindowRef.allRowsObj[id].state.paged = true
						}
					});
					changeVisible(element.state.container, true);
				} else {
					console.error("The container of the row which has been tried to page is currently not rendered");
				}
			} else {
				if (element.state.container != "") {
					element.state.paged = false;
					const childTrades: string[] = JSON.parse(element.current[gin("30")])
					childTrades.forEach(id => {
						if (this.tradeWindowRef.allRowsObj.hasOwnProperty(id)) {
							this.tradeWindowRef.allRowsObj[id].state.paged = false
						}

					});
					changeVisible(element.state.container, false);
				} else {
					console.error("The container of the row which has been tried to page is currently not rendered");
				}
			}
		}
	}
	/**
	 * Visually refreshes the currentPage counter and the buttons in case we NOW are on the last/first page
	 * 
	 * Used alongside other refresh functions.
	 */
	refreshPageController() {
		const currentPage = this.controllerBox.pageMover.currentPage;
		if (currentPage != "") {


			const newMax = this.sortedChildren.length != 0 && (Math.floor(this.sortedChildren.length / userPrefs.rowsPerPage) - this.sortedChildren.length / userPrefs.rowsPerPage) == 0 ? this.sortedChildren.length / userPrefs.rowsPerPage : Math.floor(this.sortedChildren.length / userPrefs.rowsPerPage) + 1;
			const newMin = 1;
			this.currentPageMin = newMin;
			this.currentPageMax = newMax;

			currentPage.value = this.currentPage.toString();
			currentPage.min = newMin.toString();
			currentPage.max = newMax.toString();

			if (this.currentPage == newMin) {
				if (this.controllerBox.pageMover.moveBackward != "") {

					this.controllerBox.pageMover.moveBackward.classList.add("disabled")
					this.controllerBox.pageMover.moveBackward.disabled = true;
				} else {
					console.error("Page controller moveBackward is not defined");
				}
			} else {
				if (this.controllerBox.pageMover.moveBackward != "") {

					this.controllerBox.pageMover.moveBackward.classList.remove("disabled")
					this.controllerBox.pageMover.moveBackward.disabled = false;
				}
			}
			if (this.currentPage == newMax) {
				if (this.controllerBox.pageMover.moveForward != "") {
					this.controllerBox.pageMover.moveForward.classList.add("disabled")
					this.controllerBox.pageMover.moveForward.disabled = true;
				}
			} else {
				if (this.controllerBox.pageMover.moveForward != "") {
					this.controllerBox.pageMover.moveForward.classList.remove("disabled")
					this.controllerBox.pageMover.moveForward.disabled = false;
				}
			}
		} else {
			console.error("currentPage HTMLinput controller is not rendered/not saved in the obj properties");
		}
	}
	updateLegendPosition() {
		if (this.activeLegend != "" && this.activeLegend.state.container != "") {
			this.activeLegend.state.currentSorting = this.tradeWindowRef.biggestSorting + 1;
			this.activeLegend.state.container.style.order = this.activeLegend.state.currentSorting.toString();

		}
	}

	pageForward(numberOfPages: number = 1) {
		const reversedArray = [...this.sortedChildren].reverse();

		if (reversedArray.slice((this.currentPage - 1 + numberOfPages) * userPrefs.rowsPerPage, ((this.currentPage + numberOfPages) * userPrefs.rowsPerPage) - 1).length == 0) {
			//There are no trades on that page
			return false
		} else {
			this.currentPage += numberOfPages;
			if (this.currentPage > this.currentPageMax) {
				this.currentPage = this.currentPageMax;
			}
			//A bit overkill,  but at least we know that we are refreshing all of what we need in the controller in case of future animations
			this.refreshPageController();
			//Standard again
			this.refreshCurrentPageVisibility();
			return true
		}

	}
	pageBackward(numberOfPages: number = 1) {
		const reversedArray = [...this.sortedChildren].reverse();

		if ((this.currentPage - 1 - numberOfPages) < 0 || reversedArray.slice((this.currentPage - 1 - numberOfPages) * userPrefs.rowsPerPage, ((this.currentPage - numberOfPages) * userPrefs.rowsPerPage) - 1).length == 0) {
			//There are no trades on that page
			return false
		} else {
			this.currentPage -= numberOfPages;
			if (this.currentPage < this.currentPageMin) {
				this.currentPage = this.currentPageMin;
			}
			this.refreshPageController();
			this.refreshCurrentPageVisibility();
			return true
		}
	}
	/**
	 * Defaults to return the trades of the current page. 
	 * @returns Reference to the trades of the given page
	 */
	pagedTrades(page: number = this.currentPage) {
		return this.sortedChildren.slice((page - 1) * userPrefs.rowsPerPage, (page * userPrefs.rowsPerPage) - 1)
	}
	//TODO: More on these
	/**
	 * Function to add a children to the table elements
	 * - This works only if the array was previously sorted low to high
	 * @param {Row[]} children List of rows to push
	 * @param {boolean} fresh Whether the element is new (has the highest id) or older (has a lower id)
	 */
	pushChildren(children: Array<Row2>) {
		children.forEach((child) => {
			child.changeTableReference(this);
			this.children[child.current[gin("00p")]] = child;

			//Sort only mainRows. If empty, unshift in the increasing order array. Otherwise find the first row it's bigger of
			if (child.current[gin("29")] == "-1") {
				//SORTING
				if (
					this.sortedChildren.length < 1 ||
					child.state.currentSorting <= this.sortedChildren[0].state.currentSorting
				) {
					this.sortedChildren.unshift(child);
				} else {
					//The worst case scenario now is that the second element is already greater than the coming one
					//splice puts to the right of the index
					//The smallest index we can get is 0
					for (let index = 0; index < this.sortedChildren.length; index++) {
						const element = this.sortedChildren[index];
						if (index == this.sortedChildren.length - 1 && child.state.currentSorting >= element.state.currentSorting) {

							this.sortedChildren.push(child);
							//Loop closure
							index = this.sortedChildren.length;
						} else {
							if (child.state.currentSorting < element.state.currentSorting) {
								this.sortedChildren.splice(index, 0, child);
								//Loop closure
								index = this.sortedChildren.length;

							}
						}
					}
				}

				//Repeating the renderRow to avoid another if (closedRef check)
				child.renderRow();
				//The state.paged is handled by the page manager because this row is in the sorted list
				if (child.state.container != "") {
					child.state.container.style.order = child.state.currentSorting.toString();
					if (child.current[gin("30")] != "[]") {
						const partialCloses: string[] = JSON.parse(child.current[gin("30")]);
						partialCloses.forEach(pseudoId => {
							//Backwards pagination and rendering
							if (this.children.hasOwnProperty(pseudoId)) {
								if (Object.entries(this.children[pseudoId].structure).length == 0) {
									this.children[pseudoId].renderRow();
									this.children[pseudoId].state.paged = child.state.paged;
								}
							}
						});
					}
				} else {
					console.error("Trying to push mainRow and reorder its container but failed because the container is undefined");
				}
			} else {
				//* DELAYED RENDERING: The partial row renders only when the parent exists.
				//FORWARD CHECKING: Update the pagination for that children if it has a closedRef property working
				//Backward check is done in the pagination update
				if (this.children.hasOwnProperty(child.current[gin("29")])) {
					//If it has not been rendered yet by the backwards rendering, then do so
					if (Object.entries(child.structure).length == 0) {
						child.state.paged = this.children[child.current[gin("29")]].state.paged;
						child.renderRow();
					}
				}
				//If the main row is not there yet, she will take care of rendering this one
			}
			this.currentPageMax = Math.floor(this.sortedChildren.length / userPrefs.rowsPerPage) + 1;

		});
		this.refreshPages();

	}
	/**
	 * ATTENTION: This function is used to clean data about the row from the table, not to do anything to the actual row. The row is the main caller of the tradewindow function which then calls this
	 * @param children The rows to cleanUp
	 */
	dropdownChildren(children: Array<Row2>) {
		children.forEach((child) => {
			//When the db is called, the pseudoids vanish, and also get edited
			delete this.children[child.current[gin("00p")]];
			this.currentPageMax = Math.floor(this.sortedChildren.length / userPrefs.rowsPerPage) + 1;
			//todo: optimize this, could be moved below
			this.sortedChildren = this.sortedChildren.filter(element =>
				element.current[gin("00p")] != child.current[gin("00p")]
			);
			if (this.children.hasOwnProperty(child.current[gin("00p")])) {
				delete this.children[child.current[gin("00p")]];
			}
		});
		this.refreshPages();

	}



}

class TradeWindow {
	//!FUTUREBUG Currently when rebuilding tables because the sorting has changed the old ones don't get deleted.
	holder: HTMLElement;
	tables: { [key: string]: Table };
	allRows: Array<Row2>;
	allRowsObj: { [key: string]: Row2 };
	currentlyEdited: Set<Row2>;
	biggestSorting: number;
	//Partial rows that still need rendering but where the main row has not yet been pushed
	delayedRenderStack: { [key: string]: Row2 };
	sortings: typeof userPrefs.sortings;
	//The string union is for the selected element
	selectedSorting: typeof userPrefs.sortings.categories | string;
	columnTarget: string;
	refSortingTags: Array<refSortingTag>;
	controllers: {
		saveAll: "" | HTMLButtonElement;
	}

	constructor(holder: HTMLElement) {
		this.holder = holder;
		this.tables = {};
		this.allRows = [];
		this.delayedRenderStack = {};
		this.biggestSorting = 0;
		//Linear access
		this.allRowsObj = {};
		this.currentlyEdited = new Set();
		this.sortings = userPrefs.sortings;
		this.selectedSorting = userPrefs.sortings[userPrefs.selectedSorting as keyof typeof userPrefs.sortings];
		//DB column that is getting tag-checked
		this.columnTarget = "";
		//Tags are the elements to look for in the trade column
		// {tag: "equity", logical: "equal"}
		this.refSortingTags = [];
		//Parent styling
		holder.agd("tradeWindow");
		this.controllers = {
			saveAll: "",
		}
	}
	/**
	 * Fractions the tradelist into tables based on the selected sorting
	 * - Update sorting directives based on the userprefs object
	 * - Create refSortingTags with: tag, logical, trades *
	 * - To populate trades *, we use the filtertrades function
	 * The * is just for reading reference
	 */
	updateSortingInfo() {
		this.sortings = userPrefs.sortings;
		this.selectedSorting = this.sortings[userPrefs.selectedSorting as keyof typeof userPrefs.sortings];
		if (typeof this.selectedSorting === "string") {
			console.error("Bad selection of sorting, currently selected an informational field:", this.selectedSorting, userPrefs.selectedSorting);
		} else {

			this.columnTarget = this.selectedSorting.targets;
			this.refSortingTags = [];
			for (const blockObj of Object.values(this.selectedSorting.blocks)) {
				//The list
				this.refSortingTags.push({
					tag: blockObj.tag,
					logical: blockObj.tagLogical,
					trades: this.filterTrades(
						{
							tag: blockObj.tag,
							logical: blockObj.tagLogical,
							trades: []
						},
						this.allRows
					),
				});
			}
		}
	}
	buildTables() {
		this.tables = {};
		this.updateSortingInfo();
		this.refSortingTags.forEach((tagObj) => {
			const newTable = new Table(this.holder, tagObj.trades, this);
			this.tables[tagObj.tag] = newTable;
			newTable.renderTable();
			newTable.renderRows();
			newTable.renderLegend(tagObj);
		});
	}
	/**
	 * Filters trade for tradesList generation through updateSortingInfo.
	 * Also adds trades to o(n) object array - used ALI partial close rows rendering to find the parent trade
	 * 
	 * ATTENTION: Closed rows are part of the main row, hence if they don't meet the criteria of the filtering they asre still pushed with the main row in the respective object
	 * 
	 * ! Set/Map refactoring absolutely needed. As we have to include an unsafe paramether to have a specific function work properly
	 * ( The solution includes not needing to check whether the object already exists to avoid duplicates)
	 * @param {{tag: string, logical: string, trades: Row[] }} tagObj
	 */
	filterTrades(tagObj: typeof this.refSortingTags[number], rows: Array<Row2>, unsafe = false) {
		const copiedRows = [...rows];
		const entireList: Row2[] = [];
		switch (tagObj.logical) {
			//TODO add other cases
			case "equal":
			default:
				entireList.push(...copiedRows.filter((row) => {

					// Only care about the main rows, not the closed ones, those one get pushed in tag object if their reference is already there

					//Handling partial rows
					//THIS IS USED FOR ROWS THAT GET INCLUDE AFTER THEIR CLOSED PARENT COMES IN
					if (row.current[gin("29")] != "-1") {
						//Check if the tagObj already has this row
						if (
							tagObj.trades.filter(
								(otherRow) => otherRow.current[gin("00p")] == row.current[gin("00p")]
							).length == 0 || unsafe
						) {
							//Forward check
							if (this.allRowsObj.hasOwnProperty(row.current[gin("29")])) {
								if (this.allRowsObj[row.current[gin("29")]].origin[this.columnTarget as keyof TradeObj] == tagObj.tag) {
									return true

								}
							}
						}
					}
					// if the row is an entire one and it matches, take all its referenced rows and gather them in the object as well  
					else if (row.origin[this.columnTarget as keyof TradeObj] == tagObj.tag && row.current[gin("29")] == "-1") {
						if (row.current[gin("30")] != "[]") {
							//Gather all those rows and get them in here too
							const list: string[] = JSON.parse(row.current[gin("30")]);
							//We don't have only db rows, as in the current we keep the pseudoIds as well
							list.forEach(partialRowPId => {
								//Check that it's not already in there. 
								if (tagObj.trades.filter(
									(otherRow) => otherRow.current[gin("00p")] == partialRowPId
								).length == 0) {
									//Backward check
									if (this.allRowsObj.hasOwnProperty(partialRowPId))
										entireList.push(this.allRowsObj[partialRowPId]);
								}
							})
						}
						return true;
					}
				}));

		}
		return entireList
	}
	sortAndTableTrades(trades: Array<Row2>) {
		//We need to push this here to
		this.allRows = this.allRows.concat(trades);
		trades.forEach(row => {
			this.allRowsObj[row.current[gin("00p")]] = row;
			if (row.state.currentSorting > this.biggestSorting) {
				this.biggestSorting = row.state.currentSorting;
			}
		})
		this.refSortingTags.forEach((tagObj) => {
			let correctTrades = this.filterTrades(tagObj, trades);
			tagObj.trades = tagObj.trades.concat(correctTrades);
			this.tables[tagObj.tag].pushChildren(correctTrades);
		});
	}
	/**
	 * ATTENTION: This function removes the trades from view but it's not used to CLEAN the dom of the trade. The row is the one that invokes this function
	 * @param trades 
	 */
	dropTrades(trades: Array<Row2>) {
		trades.forEach(trade => {
			//We check if the property still exist but don't care, because parent trades are going to take care of eliminating childr
			if (this.allRowsObj.hasOwnProperty(trade.current[gin("00p")])) {

				//Trade window cleaning
				delete this.allRowsObj[trade.current[gin("00p")]];
				this.allRows = this.allRows.filter(otherTrade => otherTrade.current[gin("00p")] != trade.current[gin("00p")]);

				//If a main row is deleted, she will take care of all the yet existing subrows
				if (trade.current[gin("29")] != "-1") {
					if (this.allRowsObj.hasOwnProperty(trade.current[gin("29")])) {
						const oldList: string[] = JSON.parse(this.allRowsObj[trade.current[gin("29")]].current[gin("30")]);
						const newList = oldList
							.filter(pId => pId != trade.current[gin("00p")]);
						this.allRowsObj[trade.current[gin("29")]].current[gin("30")] = JSON.stringify(newList);

					}
				}
			}
		})

		//TradeOBJ + table cleaning
		this.refSortingTags.forEach((tagObj) => {
			let correctTrades = this.filterTrades(tagObj, trades, true);
			correctTrades.forEach(trade => {
				tagObj.trades = tagObj.trades.filter(tagTrade => {

					return tagTrade.current[gin("00p")] != trade.current[gin("00p")]
				});
			})
			this.tables[tagObj.tag].dropdownChildren(trades);
		})


	}
	saveAll() {
		this.allRows.forEach(row => {
			if (row.state.editingList.length != 0) {
				row.d_saveChanges();
			}
		})
	}
}

// When a value is clicked, the "newInput" event is dispatched. 
// The dom target must be adapted to contain such listener
class Expander {
	currentDomTarget: inputField | selectField | HTMLButtonElement;
	activeRow: "" | Row2 = "";
	currentFormat: "lister" | "moreOptions" = "lister";
	element: HTMLDivElement;
	state: {
		visible: boolean,
		position: {
			currentX: number,
			currentY: number,
		}
	};

	constructor(newDomTarget: inputField | selectField | HTMLButtonElement, type: "lister" | "moreOptions", activeRow: "" | Row2 = "") {
		//The dom target is the element which the lister has effect on
		this.currentDomTarget = newDomTarget;
		this.activeRow = activeRow;
		this.element = document.createElement("div");
		//Also hiding it at spawn
		this.element.agd("expander");
		this.state = {
			visible: false,
			position: {
				currentX: -1,
				currentY: -1
			}
		}
		this.changeFormat(type);
		document.body.append(this.element);
	}

	changeFormat(newFormat: typeof this.currentFormat) {
		this.element.classList.remove(this.currentFormat);
		this.element.classList.add(newFormat);
		this.currentFormat = newFormat;
	}

	/**
	 * Checking for status before hiding or showing must be done outside of these functions
	 */
	hide() {
		this.element.classList.remove(this.currentFormat);
		this.element.classList.add("hidden");
		this.state.visible = false;
	}

	/**
	 * Moves the expander to the target and shows it
	 * 
	 * Checking for status before hiding or showing must be done outside of these functions.
	 * https://tutorial.eyehunts.com/js/get-absolute-position-of-element-javascript-html-element-browser-window/
	 */
	show() {
		this.moveAndResizeTo(this.currentDomTarget);
		this.element.classList.add(this.currentFormat);
		this.element.classList.remove("hidden");
		this.state.visible = true;
	}
	//Moves the expander to the current target by default, or another input/select if passed
	moveAndResizeTo(target: typeof this.currentDomTarget = this.currentDomTarget) {
		const rect = target.getBoundingClientRect();
		const width = rect.width;
		const left = rect.left;
		const bottom = rect.bottom;
		// Edit the expander element
		this.element.style.width = `${width}px`;
		this.element.style.top = `${bottom + window.scrollY}px`;
		this.element.style.left = `${left + window.scrollX}px`;
	}
	/**
	 *  In case of a moreOptions expander, the values are not going to be filtered (at least in this patch). So only a single element will be taken giving directions on which promptDefatults object to read from
	 * */
	fill(content: Array<listerObj>) {
		// The content type determines how the listerObj list is interpreted
		if (this.currentFormat == "lister") {
			//Todo: Check that the content type matches the expander type
			this.element.textContent = "";
			let empty: listerButton;
			if (content.length == 0) {
				empty = spawnDiv();
				empty.innerHTML = "No results";
				empty.agd("expanderEmptyBlock");

				this.element.append(empty);
			} else {

				const orderedListByTag = [...content].sort((a, b) => a.tag.localeCompare(b.tag));
				// Print a divider based on tag
				for (let index = 0; index < orderedListByTag.length; index++) {
					//Separate the elements with different tags
					/*ideas:
						- Make the paragraph cliccable and show only the trades with that specific 
					*/
					//Check if a tag separator is needed and print it
					let tagSeparator, clickableValue: listerButton;
					if (index == 0) {
						//HERE: we don't print anything if the first tag is empty. Which is unlikely, but whatever
						if (orderedListByTag[index].tag != "") {
							tagSeparator = spawnDiv();
							tagSeparator.innerHTML = orderedListByTag[index].tag;
							this.element.append(tagSeparator);
						}
					} else if (orderedListByTag[index].tag != orderedListByTag[index - 1].tag) {
						tagSeparator = spawnDiv();
						tagSeparator.innerHTML = orderedListByTag[index].tag;
						this.element.append(tagSeparator);
					}
					tagSeparator?.agd("expanderTagSeparator");

					clickableValue = spawnDiv();
					clickableValue.agd("expanderClickableValue")
					this.element.append(clickableValue);
					//Give it activation properties
					clickableValue.innerHTML = orderedListByTag[index].value;
					clickableValue.realValue = { ...orderedListByTag[index] };
					//Click event
					clickableValue.addEventListener("click", (e) => {
						//Dispatch an event to the field to edit everything
						const newInputEvent = new CustomEvent("newInput", { detail: { inputValue: clickableValue.realValue } })
						this.currentDomTarget.dispatchEvent(newInputEvent);
						//Now change the inner value of the linked field
						this.currentDomTarget.value = clickableValue.realValue?.value;
					})
				}


			}
		} else if (this.currentFormat == "moreOptions") {
			// Let the id refer to the 
			this.element.textContent = "";
			let empty = spawnDiv();

			if (content.length == 0) {
				empty.innerHTML = "No options available";
				empty.agd("expanderEmptyBlock")
				this.element.append(empty);
				console.error("No directive given when generating moreOptions expander")
			}
			else {

				//Get to promptDefaults and check whether the required directives are available
				const selectedButtons: promptTemplate[] = [];
				//A lot of error management, more of an excercise than anything.
				//The big part of error management has to be done in the creation of userPrefs
				if (userPrefs.promptDefaultsDirectives.hasOwnProperty(content[0].id)) {
					const directive = userPrefs.promptDefaultsDirectives[content[0].id as keyof typeof userPrefs.promptDefaultsDirectives];
					if (userPrefs.promptDefaults.hasOwnProperty(directive.templateName)) {
						if (directive.variations.hasOwnProperty(directive.selected)) {
							const selected = directive.variations[directive.selected as keyof typeof directive.variations];
							//Not empty checking
							selected.forEach(element => {
								selectedButtons.push(userPrefs.promptDefaults[directive.templateName][element]);
							})
						} else {
							console.error(`Selected directive for ${content[0].id} has no match in its variations`);
						}
					} else {
						console.error("Associated templateName has no match in userPrefs/promptDefaults");
					}
				} else {
					console.error("Given directive has no match in userPrefs/promptDefaultsDirectives");
				}
				if (selectedButtons.length == 0) {
					empty.innerHTML = "No options available";
					empty.agd("expanderEmptyBlock")
					this.element.append(empty);
					console.error("Directive given, but no results from userPrefs");
				} else {
					selectedButtons.forEach(button => {
						const newBtn = spawnBtn();
						newBtn.agd("spawnerButton");
						if (button.attachedNumber == "0") {
							newBtn.classList.add("quick-spawn");
						} else if (button.attachedNumber == "1") {
							newBtn.classList.add("spawner-main");
						}
						this.element.append(newBtn);
						newBtn.innerHTML = button.text;
						newBtn.addEventListener("click", (e) => {
							//Dispatch an event to the field to edit everything
							const newInputEvent = new CustomEvent("directive", { detail: { type: button.attachedNumber, attachedObj: button.attachedObj } })
							this.currentDomTarget.dispatchEvent(newInputEvent);
						})
					})
				}
			}
		}
	};
}
class Row2 {
	/**
	 * * The Row class
	 * @param {Object} data The trade object - refer to TRADE FORMAT above this class
	 * @param {boolean} legend whether this iss a legend column or not
	 */
	origin: TradeObj;
	current: TradeObj;
	state: {
		isLegend: boolean,
		table: Table | "",
		parent: HTMLElement | "",
		container: HTMLElement | "",
		dropDown: {
			target: HTMLElement | "",
			expanded: boolean,
		},
		mainRow: HTMLElement | "",
		editing: boolean,
		editingList: Array<string>,
		statsChangedList: Set<string>,
		//TODO: Rework the stuff below to make access easier and less resource intensive
		childRows: Set<Row2>,
		parentRow: Row2 | "",
		raiser: string,
		//Whether the row is currently visible in a page
		paged: boolean,
		currentSorting: number,
	};
	structure: {
		[key: string]: structObj
	}

	constructor(data: TradeObj, legend = false) {
		//* Row2 keeps the empty fields empty rather than deleting them
		//Fields used to compare changes.
		//TOBETESTED: Depends on the way the database stores the user fields data
		const interpolatedData = this.c_userFieldsInterpolate(data);
		this.origin = { ...interpolatedData };
		this.current = { ...interpolatedData };
		//State information
		this.state = {
			isLegend: legend,
			table: "",
			parent: "",
			//Keep track of the trade conatiner dom object
			container: "",
			dropDown: {
				target: "",
				expanded: false,
			},
			//Keep track of the row itself
			mainRow: "",
			editing: false,
			//For o(1) access of how many elements are being "edited"
			editingList: [],

			statsChangedList: this.c_statsManipulatedInterpolate(this.origin),
			childRows: new Set([]),
			parentRow: "",
			//Used for raising the zindex of a row. The raiser is the element which is currently raising that specific row.
			//Deprecated after change in expander structure
			raiser: "",
			paged: false,
			currentSorting: parseFloat(this.origin.saved_sorting),
		};
		this.structure = {};
	}
	/**
			 * Function that sets the field to an editing state and adds the item to the editingList
			 * - for lists only the main property is being tracked
			 * @param {"string"} fieldName The name of the field
			 */
	setEditing = (fieldName: string) => {
		this.structure[fieldName].editing = true;
		//Adding to the fieldholder for buttons
		this.structure[fieldName].target.memory.fieldHolder.agd("editing");
		this.state.editing = true;
		this.state.editingList.push(fieldName);
	};
	/**
	 * Function that removes the field from an editing state and if the edittinglist is empty REMOVES the editing state
	 * - for lists only the main property is being tracked
	 * @param {"string"} fieldName The name of the field
	 */
	removeEditing = (fieldName: string) => {
		this.structure[fieldName].editing = false;
		this.structure[fieldName].target.memory.fieldHolder.rgd("editing");

		this.state.editingList = this.state.editingList.filter(
			(item) => item !== fieldName
		);
		if (this.state.editingList.length == 0) {
			this.state.editing = false;
		}
	};
	//* c_ functions are called in the constructor
	//* d_ functions interact with the database
	/**
	 * Run in the constuctor. Gets all properties in the json_user_fields column, parses them and adds themo to both the origin and current object.
	 * The trade will re-add those properties in here once the trade is getting sent
	 */
	c_userFieldsInterpolate(originObject: TradeObj): Required<TradeObj> {
		if (originObject.hasOwnProperty("json_user_fields")) {
			const userFieldData = JSON.parse(originObject.json_user_fields);
			return { ...originObject, ...userFieldData };
		}
		return originObject;
	}
	c_statsManipulatedInterpolate(originObject: TradeObj): Set<string> {
		if (originObject.hasOwnProperty(gin("sif"))) {
			return new Set(JSON.parse(originObject[gin("sif")]))
		} else {
			console.error("c_statsManipulatedInterpolate$ Given object was missing the sif property", originObject);
			return new Set([])
		}
	}
	/**
	 *  To run when assigned to a table. Changes this.state.table and this.parent
	 * @param {Table} table Changes the table element of this trade.
	 */
	changeTableReference(table: Table) {
		this.state.table = table;
		this.state.parent = table.target;
	}
	/**
	 * Given the current userpref sorting, returns the layout based on the important database entry
	 * @returns layout
	 */
	getLayout(): sectionsLayout {
		//Mental stuff
		if (this.current[gin("29")] != "-1") {
			if (this.state.table != "") {
				const parentRow = this.state.table.tradeWindowRef.allRowsObj[this.current[gin("29")]];
				return parentRow.getLayout();
			} else {
				console.error("getLayout$ This partial row doesn't have a table reference, using available layout", this);
			}
		}
		const sortings = userPrefs.sortings;
		const selectedSorting = userPrefs.selectedSorting;

		const sortingTarget = sortings[selectedSorting as keyof typeof sortings].targets;
		const thisRowTargetedValue = this.current[sortingTarget as keyof TradeObj];
		//! Meh the below casting
		const associatedBlock =
			sortings[selectedSorting as keyof typeof sortings].blocks[thisRowTargetedValue as keyof typeof userPrefs.sortings.categories.blocks];
		const selectedLayout = associatedBlock.selected;
		return associatedBlock.layouts[selectedLayout as keyof typeof associatedBlock.layouts];

	}
	/**
	 * * Function that creates a new container and assigns the object the container property
	 * 
	 * Also adds the dropdown button to toggle visibility of the closed rows
	 * @returns {domElement} Returns the container object
	 */
	createContainer() {
		const container = document.createElement("div");
		this.state.container = container;
		container.agd("tradeContainer");
		this.refreshDropdown();

		return container;
	}
	dropdownChildren(expand = !this.state.dropDown.expanded) {
		const childList: string[] = JSON.parse(this.current[gin("30")]);
		const theTable = this.state.table;
		if (theTable != "") {
			childList.forEach(pId => {
				if (theTable.tradeWindowRef.allRowsObj.hasOwnProperty(pId)) {
					const mainRow = theTable.tradeWindowRef.allRowsObj[pId].state.mainRow
					if (mainRow != "") {
						changeVisible(mainRow, expand);
						this.state.dropDown.expanded = expand;

						if (this.state.dropDown.target != "")
							this.state.dropDown.target.innerHTML = this.state.dropDown.expanded ? "˄" : "˅"
					}
				}
			})
		} else {
			console.error("dropdownChildren$ This row's table is not yet defined.", this)
		}
	}
	/**
	 * Creates the dropdown and hides child rows in case they must not be displayed
	 * @param secondCall 
	 * @returns 
	 */
	refreshDropdown(secondCall = false) {
		if (this.state.container != "") {
			if (this.state.dropDown.target != "" || this.current[gin("29")] != "-1") {

				//Backwards check

				//If this row has children then it can't have a reference, hence the target must be an htmlelement
				if (this.current[gin("30")] != "[]") {
					changeVisible(this.state.dropDown.target as HTMLElement, true)
					//DEFAULT EXPANSION
					this.dropdownChildren(this.state.dropDown.expanded);
				}
				//Forward check
				if (this.current[gin("29")] != "-1") {

					const theTable = this.state.table;
					if (theTable != "") {
						if (theTable.tradeWindowRef.allRowsObj.hasOwnProperty(this.current[gin("29")])) {
							theTable.tradeWindowRef.allRowsObj[this.current[gin("29")]].refreshDropdown(true);
							if (this.state.mainRow != "") {
								changeVisible(this.state.mainRow, theTable.tradeWindowRef.allRowsObj[this.current[gin("29")]].state.dropDown.expanded)
							}
						}
						//Bad/Old implementation that requires even more checking.
						//changeVisible(theTable.tradeWindowRef.allRowsObj[this.current[gin("29")]].state.dropDown.target, true)

					}
				}
			} else {
				if (secondCall) {
					console.error("refreshDropdown$ Second call failed: the dropdown has not been assigned correctly")
					return;
				}
				const dropdown = document.createElement("button");
				dropdown.innerHTML = this.state.dropDown.expanded ? "˄" : "˅";
				this.state.dropDown.target = dropdown;
				dropdown.agd("containerDropdown");
				this.state.container.append(dropdown);
				changeVisible(dropdown, false);
				//The dropdown is disabled on spawn (see the Row2 constructor)
				dropdown.addEventListener("click", (e) => { this.dropdownChildren() });

				this.refreshDropdown(true)
			}

		} else {
			console.error("refreshDropdown$ Trying to refresh dropdown without a defined container");
		}
	}

	/**
	 * Function that replaces the given field with a cloned one. Useful for removing event listeners
	 * @param {domElement} field The row field to replace
	 * @returns {domElemeent} The newly created field with updated memory
	 */
	domCloneField(field: inputField | selectField | buttonField) {
		//Replace the dom element
		var old_element = field;
		if (instanceOfIF(field)) {
			const new_element = old_element.cloneNode(true) as inputField;
			new_element.discriminator = "INPUT-FIELD";
			old_element.memory.fieldHolder.replaceChild(new_element, old_element);
			//Add the memory properties to the field which you just created
			new_element.memory = old_element.memory;
			return new_element;
		} else if (instanceOfSF(field)) {
			const new_element = old_element.cloneNode(true) as selectField;
			new_element.discriminator = "SELECT-FIELD";
			old_element.memory.fieldHolder.replaceChild(new_element, old_element);
			//Add the memory properties to the field which you just created
			new_element.memory = old_element.memory;
			return new_element;
		} else {
			const new_element = old_element.cloneNode(true) as buttonField;
			new_element.discriminator = "BUTTON-FIELD";
			old_element.memory.fieldHolder.replaceChild(new_element, old_element);
			//Add the memory properties to the field which you just created
			new_element.memory = old_element.memory;
			return new_element;
		}
	}
	cancelChanges = () => {
		//We don't have to work on "Linked" fields since they only exist in the current object
		this.state.editingList.forEach((changedField) => {
			//Get the fiend which has been changed in the structure property
			if (isStructObj(this.structure[changedField])) {
				const fieldStruct = this.structure[changedField];
				//Use the predefined reset function for each field

				fieldStruct.reset();
				//We let it change the close value no matter what
				//Drops field from array & sets all the states to the right "Position"

				this.removeEditing(fieldStruct.name);
			} else {
				console.error("A function name has been added to the editing list and is now being iterated:", this.state.editingList)
			}
		});

		//THIS THING RIGHT HERE SOLVES A LOT OF PROBLEMS
		//Current = ...Origin now
		this.updateCurrent("", -1);
		//Run an iteration of the toggler to "remove" the clickability from the cancel field
		this.cancelSaveToggler();
	};
	d_saveChanges = async () => {
		try {
            console.log("begging d_saveChanges - try"); 
			//dbObject acts as a save of the previous version
			const dbObject = { ...this.current };
            console.log(dbObject); 

			// Put user field changes into the json_user_fields field
			const jsUF: { [key: string]: string } = {};
			Object.values(userPrefs.customFields).forEach(customField => {
				jsUF[customField.name] = this.current[customField.name as keyof TradeObj];
			});
			dbObject[gin("juf")] = JSON.stringify(jsUF);
			dbObject[gin("sif")] = JSON.stringify(Array.from(this.state.statsChangedList));
			//WEIRD#1
			dbObject[gin("30")] = this.origin[gin("30")];

			let tag: dbTag = "New";
			if (dbObject[gin("00i")] == dbObject[gin("00p")]) {
				tag = "Edit";
			}


			//DB
			// PseudoId implementation: when a trade with a pseaudoid is saved, get him a real id. Then this id gets changed in the frontend both in the actual row and in all of the linearObjs in tables and tradewindows referring to it (including closed_ref and other)
			// Closed_list: when a trade with a closed reference is saved, update the closed list of the parent trade in the frontend and backend. 
			//! The closed list must be updated based on this trade refernece, because the main trade doesn't have any actual contents in the current closedList
			//Async save changes
                    console.log("Hi, we made it this far, A"); 
			const request = await fetch(
				// "http://192.168.0.23/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager"
				"http://localhost/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager"
				// "https://www.mymiwallet.com/Trade-Tracker/Trade-Manager"
				,
				{
					method: "POST",
					credentials: "same-origin",
					body: JSON.stringify({ tag, trade: dbObject }),
					headers: { "Content-Type": "application/json" },
				}


			);
			const data: tableApiResponse = await request.json();
			if (data.status == "1") {

				//Edit the pseudoid and other db fields (like the id)
				const updatedTrade: Partial<TradeObj> = JSON.parse(data.message);
				for (const key of Object.keys(updatedTrade)) {
					if (!this.current.hasOwnProperty(key)) {
						//Throwing here would impact other factors
						console.log({ message: "One key coming from the db object was not defined in the current object", obj: JSON.parse(data.message) })
					}
				}
				this.current = { ...this.current, ...updatedTrade };

				//* All of the below could be done "easily" in the backend too. But this method works fine for now
				if (this.current[gin("29")] != "-1") {
					if (this.state.table != "") {
						const mainTrade = this.state.table.tradeWindowRef
							.allRowsObj[this.current[gin("29")]];
						const mainTradeList = JSON.parse(mainTrade.current[gin("30")]);
						//We have updated the pseuodId of this trade to be exactly like the id
						//Now we update it here
						if (mainTradeList.indexOf(dbObject[gin("00p")]) != -1) {
							mainTradeList[mainTradeList.indexOf(dbObject[gin("00p")])] = this.current[gin("00p")];
							mainTradeList.push(this.current[gin("00p")]);
							mainTrade.current[gin("30")] = JSON.stringify(mainTradeList);
							mainTrade.origin[gin("30")] = JSON.stringify(mainTradeList);

							if (!(await mainTrade.d_saveChanges())) {
								console.error("d_saveChanges$ Child row failed to save the main row", this, mainTrade);
							};
						} else {
							console.error("d_saveChanges$ pId of this childrenRow not found in the mainRow list")
						}

					} else {
						console.error("d_saveChanges$ Couldn't propagate changes upwards because this row has no table reference", this);
					}

				}

				//Upward Save Propagation
				if (tag == "New") {
					//Fix childRows references
					if (this.current[gin("30")] != "[]") {
						const childList: string[] = JSON.parse(this.current[gin("30")]);
						childList.forEach(childRowPId => {
							if (this.state.table != "") {
								if (this.state.table.tradeWindowRef.allRowsObj.hasOwnProperty(childRowPId)) {
									const childTrade = this.state.table.tradeWindowRef.allRowsObj[childRowPId];
									//The backend will handle the updating of the childFields.
									//? Should the backend manage it? Should I also save the main trade? Or just maybe a part of it?
									//? Should I integrate 29 and 30 into the state of each row and update them just when necessary? This would make it easier to manage as a data structure and do stuff with it rather than parsing. Also, could use a set.
									childTrade.current[gin("29")] = this.current[gin("00p")];
									childTrade.origin[gin("29")] = this.current[gin("00p")];
								} else {
									console.error("d_saveChanges$ Couldn't propagate changes downwards because the tradeWindow doesn't have the childRow saved", this.state.table.tradeWindowRef.allRowsObj);
								}
							} else {
								console.error("d_saveChanges$ Couldn't propagate changes downwards because this mainRow has no table reference", this);
							}
						})
					}
					//Fix tables/tradeWindows byKeyObj (in the future, maps)
					if (this.state.table != "") {
						//Delete the reference in the object above
						const thisTableRow = Object.getOwnPropertyDescriptor(this.state.table.children, dbObject[gin("00p")]);
						if (thisTableRow != undefined) {
							Object.defineProperty(this.state.table.children, this.current[gin("00p")], thisTableRow)
							delete this.state.table.children[dbObject[gin("00p")]];
						} else {
							console.error("d_saveChanges$ Couldn't find said property in the table reference");
						}
						const thisTradeWindowRow = Object.getOwnPropertyDescriptor(this.state.table.tradeWindowRef.allRowsObj, dbObject[gin("00p")]);
						if (thisTradeWindowRow != undefined) {
							Object.defineProperty(this.state.table.tradeWindowRef.allRowsObj, this.current[gin("00p")], thisTradeWindowRow)
							delete this.state.table.tradeWindowRef.allRowsObj[dbObject[gin("00p")]];
						} else {
							console.error("d_saveChanges$ Couldn't find said property in the tradeWindow reference");
						}

					} else {
						console.error("d_saveChanges$ Trouble Propagating table/tradeWindow changes, missing table reference", this);
					}

				}

				//Refresh the origin object to mirror the (just modified) current one
				this.updateCurrent("", 1);
				//Cancelchanges will removeEditing, then run the cancelSaveToggler to fix any still active button
				this.cancelChanges();

			} else {
				newAlert({ status: "error", message: "Saving the trade was unsuccessfull" })
				console.error("d_saveChanges$ returned an API error:", data.message);
				return false;
			}

			return true;
		}
		catch (error) {
			newAlert({ status: "error", message: "Saving the trade was unsuccessfull" })
			console.error("d_saveChanges$ catched general error:", error);
			return false;
		}
	}
	/**
	 * Toggles the cancel and save button, cancels changes if required and resets all necessary parts
	 */

	cancelSaveToggler() {
		//The editings and checks are being done only on the cancel changes button
		if (this.state.editing) {

			//Add event listener - To prevent multiple firings, we use a checking property when this runs
			if (!this.structure[gin("b2")].hasCancelListener) {
				this.structure[gin("b2")].target.addEventListener(
					"click",
					this.cancelChanges,
					true
				);
				this.structure[gin("b1")].target.addEventListener(
					"click",
					this.d_saveChanges,
					true
				)
				this.structure[gin("b2")].target.rgd("disabledBtn");
				this.structure[gin("b1")].target.rgd("disabledBtn");
				this.structure[gin("b2")].hasCancelListener = true;
			}
			//Make it clickable
			//TODO: Implement better looking disabled/enabled transitions
			this.structure[gin("b2")].target.disabled = false;
			this.structure[gin("b1")].target.disabled = false;

			//External
			if (this.state.container != "" && this.state.mainRow != "") {
				this.state.container.agd("editing");
				this.state.mainRow.agd("editing");
			} else {
				console.error("cancelSaveToggler$ The container or mainRow of the row is not defined", this);
			}
			//SaveAll
			if (this.state.table != "") {
				this.state.table.tradeWindowRef.currentlyEdited.add(this);
				if (this.state.table.tradeWindowRef.controllers.saveAll != "") {
					if (Array.from(this.state.table.tradeWindowRef.currentlyEdited).length != 0) {
						this.state.table.tradeWindowRef.controllers.saveAll.disabled = false;
						saveAllBtn.rgd("disabledBtn");
					}
				}
			} else {
				console.error("cancelSaveToggler$ The given row doesn't have a table reference", this);
			}
		} else {
			//Remove event listener
			const noEventCloseField = this.domCloneField(this.structure[gin("b2")].target);
			const noEventSaveField = this.domCloneField(this.structure[gin("b1")].target);
			//RE-ADD this element to the structure object;
			this.structure[gin("b2")].target = noEventCloseField;
			this.structure[gin("b1")].target = noEventSaveField;

			this.structure[gin("b2")].target.agd("disabledBtn");
			this.structure[gin("b1")].target.agd("disabledBtn");
			//To prevent multiple listening. (Only checked on the cancel button)
			this.structure[gin("b2")].hasCancelListener = false;
			//Remove clickability
			this.structure[gin("b2")].target.disabled = true;
			this.structure[gin("b1")].target.disabled = true;
			//Act on the save button - which works in parallel to the cancel button

			//External
			if (this.state.container != "" && this.state.mainRow != "") {
				this.state.container.rgd("editing");
				this.state.mainRow.rgd("editing");
			} else {
				console.error("cancelSaveToggler$ The container or mainRow of the row is not defined", this);
			}
			if (this.state.table != "") {
				this.state.table.tradeWindowRef.currentlyEdited.delete(this);
				if (this.state.table.tradeWindowRef.controllers.saveAll != "") {
					if (Array.from(this.state.table.tradeWindowRef.currentlyEdited).length == 0) {
						this.state.table.tradeWindowRef.controllers.saveAll.disabled = true;
						saveAllBtn.agd("disabledBtn");
					}
				}
			} else {
				console.error("cancelSaveToggler$ The given row doesn't have a table reference", this);
			}
		}
	}
	/**
	 * * Gather the value based on the given property
	 * - IN ROW2 EMPTY FIELDS KEEP BEING DEFINED, SO THE "HAS" PROPERTY SHOULD ALWAYS RETURN TRUE
	 * @param {string} property Property to gether from the current or origin field
	 * @param {"current" |"origin" } target Defines whether to take it from the current or origin field. STD: true
	 * @returns {{value: string, has:true | false}} Specific value given the key
	 * - Boolean in use for select fields: if false, do not try to pull the rest of the data.
	 */
	getValue(property: string, target: "current" | "origin" = "current") {
		return this[target as keyof Row2].hasOwnProperty(property)
			? { value: this[target][property as keyof TradeObj], has: true }
			: { value: "", has: false };
	}
	//Value and current object are never not linked. So to update the value of a fieald you must update the current object first
	changeValue(property: string, origin: "current" | "origin" = "current") {
		const availableFields = availableFieldsGen();
		const propertyFieldInstructions = availableFields[this.structure[property].dirTag]
		switch (propertyFieldInstructions.type) {
			//Closed will
			case "closed":
				//Sort of test to generalise the "close"/"open" change, but only currently used in the reset function
				//If they are already equal by any chance, don't do anything - won't happen, but better outcome if it does
				if (this.current[property as keyof TradeObj] != this[origin][property as keyof TradeObj]) {
					//The value gets reset in the close or open function
					//Depending on the target state, run either function
					if (this.origin[gin("1")] == "true") {
						//Close the trade, not spawning a new one and keeping 100 of it
						this.close();
					} else {
						// ?? //DEBUG
						this.open();
					}
				}

				break;
			default:
				this.structure[property].target.value = this.getValue(property, origin).value;
				break;
		}
	}
	/**
	 * OPERATES ON THE CURRENT AND ORIGIN PROPERTIES
	 * - Changes a value of the
	 * @param {*} value The value to change it to
	 * @param {string| -1} target If -1 makes the current object identical to the origin one, if 1 the opposite
	 */
	updateCurrent = (value = "", target: -1 | 1 | string, fromStats = false) => {
		if (target == -1) {
			this.current = { ...this.origin };
		} else if (target == 1) {
			this.origin = { ...this.current };
		} else {
			this.current[target as keyof TradeObj] = value;
			if (fromStats) {
				this.structure[target].target.agd("autoCalculated");
				this.state.statsChangedList.add(target);
			} else {
				this.state.statsChangedList.delete(target);
				this.structure[target].target.rgd("autoCalculated");
			}

		}
		//DEBUG
		if (debug) {
			// Prints the current objects for the "test" row clearly in another div
			const curPrint = document.querySelector(".current") as HTMLElement;
			const oriPrint = document.querySelector(".origin") as HTMLElement;

			curPrint.innerHTML = JSON.stringify(this.current);
			oriPrint.innerHTML = JSON.stringify(this.origin);
			//DEBUG
		}
	};
	/**
	 * Function to prompt a close event. Takes no argument because it acts on the row itself
	 */
	closePrompt = () => {
		// Needed for ease of managing events below (onclose)
		const rowRef = this;

		//STYLEME
		//This is the container for everything
		const promptBox = spawnDiv();
		promptBox.dataset.visible = "true";
		promptBox.agd("promptBox");
		promptBox.style.zIndex = "11";
		//This is the title of the box
		const promptTitle = document.createElement("h3");
		promptTitle.agd("h3");
		//This is the description of what the heck you are doing
		const promptDesc = spawnDiv();
		promptDesc.agd("description");
		//This box is used to manually send the amout - BIG ON DESKTOP, SMALL ON MOBILE
		const inputBox = spawnInput();
		inputBox.setAttribute("type", "number");
		inputBox.setAttribute("max", "100");
		inputBox.setAttribute("min", "0");

		//These buttons are used to autofill the element - BIG ON MOBILE SMALL ON DESKTOP
		const inputButtonArray = spawnDiv();
		//Add a close button
		const closeBtn = spawnBtn();
		closeBtn.innerHTML = "✕";
		closeBtn.agd("closeWindowBtn");
		//Spawn the buttons that the user wanted to have as preference
		for (const value of Object.values(
			userPrefs.promptDefaults.closePrompt
		)) {
			const button = spawnBtn();
			button.innerHTML = value.text;
			//Onclick edit the input field
			button.onclick = function () {
				inputBox.value = value.attachedNumber.toString();
			};
			//STYLEME Just be cautious with this order property
			button.style.order = value.attachedNumber.toString();
			//Append it
			inputButtonArray.append(button);
		}

		// If on mobile we need an ok button, but the event will be fired also on Enter click
		const enterButton = spawnBtn();
		enterButton.innerHTML = "Enter";
		//Where you show errors when they arise
		const errorBox = spawnDiv();
		//Used to show basic information, like the key to press
		const infoBox = spawnDiv();

		//Fill the thingy
		promptBox.append(
			promptTitle,
			promptDesc,
			inputBox,
			inputButtonArray,
			enterButton,
			closeBtn,
			errorBox,
			infoBox
		);
		document.body.append(promptBox);
		//FOcus on the field
		inputBox.focus();

		//Bind the meaning to the closebutton of the box
		closeBtn.onclick = function () {
			delClosePrompt();
		};
		//Now we add the listeners for OK or enter key that run the close function
		inputBox.oninput = function () {
			//Check if everything is alright
			const isGood = validPerc(inputBox.value);
			if (isGood) {
				errorBox.innerHTML = "";
			}
			//We are adding an error on input because the UX feels better that way. The error comes up only if they submit something wrong.
		};
		enterButton.onclick = submitClose;

		function windowCloseKeyFunc(event: KeyboardEvent) {
			// Number 13 is the "Enter" key on the keyboard
			if (event.key === "Enter") {
				// Cancel the default action, if needed
				event.preventDefault();
				// Trigger the button element with a click
				enterButton.click();
			}
			if (event.key === "Escape") {
				event.preventDefault();
				closeBtn.click();
			}
		}
		function windowClickAwayFunc(event: MouseEvent) {
			const target = event.target as Node;
			if (promptBox.dataset.visible == "true"
				&& target != null
				&& !promptBox.contains(target)
			) {
				closeBtn.click();
			}
		}
		//Function below runs function above
		window.addEventListener("keyup", windowCloseKeyFunc);
		window.addEventListener("mouseup", windowClickAwayFunc);
		function submitClose() {
			const closeValue = inputBox.value;

			//Error checking
			if (!validPerc(closeValue)) {
				errorBox.innerHTML = "Choose a percentage between 1 and 100";
			} else {
				let partial = true;
				//If we are closing 100% then don't spawn a new trade
				if (closeValue == "100") {
					partial = false;
				}
				const result = rowRef.close(partial, closeValue);
				if (result == false) {
					errorBox.innerHTML = "Choose a percentage between 1 and 100";
				} else {
					blockBody(false);
					zDarkner("0", true);
					delClosePrompt();
				}
			}
		}

		//STYLEME - With
		function delClosePrompt() {
			promptBox.dataset.visible = "false";
			promptBox.remove();
			promptDesc.remove();
			inputBox.remove();
			inputButtonArray.remove();
			promptTitle.remove();
			enterButton.remove();
			closeBtn.remove();
			errorBox.remove();
			infoBox.remove();
			window.removeEventListener("keyup", windowCloseKeyFunc);
			window.removeEventListener("mouseup", windowClickAwayFunc);
		}
	};

	/**
	 * 
	 * @param consequential Whether it has to be deleted (from the db) without asking
	 * @param legend Whether to not care about the db
	 */
	d_delete = async (consequential: boolean = false, legend: boolean = this.state.isLegend) => {
		if (legend == false) {
			try {
				if (consequential == true || await trueFalsePrompt("Are you sure you want to permanently delete this row?")) {
					if (this.current[gin("30")] != "[]") {
						if (
							consequential != true && !await trueFalsePrompt("Deleting this trade will also delete all of its closed children. Proceed?")
						) {
							return
						}
					}

					//We don't need to "paint" the dbObject because the check function in the backend will take care of it
					const tag: dbTag = "Delete";

					const dbObject = { ...this.current };

					//! Remember to also delete the linked properties when deleting a row. So if this has a linked ref, go delete this from the set (reverse save)
					
					//* We expect a PARENT trade to also delete the childs in the backend before anything else happens.
					// When we delete child, we expect the status to come back as 2
                    console.log("Hi, we made it this far, B"); 
					const request = await fetch(
                        // "http://192.168.0.23/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager"
                        "http://localhost/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager"
                        // "https://www.mymiwallet.com/Trade-Tracker/Trade-Manager"
						,
						{
							method: "POST",
							credentials: "same-origin",
							body: JSON.stringify({ tag, trade: dbObject }),
							headers: { "Content-Type": "application/json" },
						}


					);
                    console.log(request.text()); 
					const data: tableApiResponse = await request.json();


					//Drop from every list, then remove
					//Debug if
					if (data.status == "1" || (data.status == "2" && consequential)) {
						//SAY THAT IF IT HAS CLOSED FIELDS ALSO THOSE WILL BE DELETED
						if (this.current[gin("30")] != "[]") {

							//Delete all sub fields
							const theRows: Row2[] = [];

							const linkedRows: string[] = JSON.parse(this.current[gin("30")])
							linkedRows.forEach(pId => {
								if (this.state.table != "") {
									if (this.state.table.tradeWindowRef.allRowsObj.hasOwnProperty(pId)) {
										this.state.table.tradeWindowRef.allRowsObj[pId].d_delete(true);
									} else {
										console.error("d_delete$ A linked id is not present in the trade window ref allRowsObj", this, this.state.table.tradeWindowRef.allRowsObj);
										throw ({ message: "d_delete$ Couldn't delete one of the childRows", obj: this });
									}
								}
								else {
									console.error("d_delete$ The given main row has no table reference:", this)
								}
							})


						} else {
							if (this.state.table != "") {
								this.state.table.tradeWindowRef.dropTrades([this]);
								this.cleanupDom();
							} else {
								console.error("d_delete$ Trying to delete row that has no table ref:", this)
							}
						}

					} else {
						newAlert({ status: "error", message: "Deleting the trade was unsuccessfull" })
						console.error("d_saveChanges$ returned an API error:", data.message);
					}

				}
			} catch (error) {
				newAlert({ status: "error", message: "Deleting the trade was unsuccessfull" })
				console.error("d_delete$ catched general error:", error);
			}
		} else {
			this.cleanupDom(true);
			//Apparently the garbage collector takes care here *shrug*
		}
	}
	/**
	 * Brutal cleanup of the given row.
	 */
	cleanupDom(cleanContainer: boolean = false) {
		this.structure = {};
		if (this.state.mainRow != "") {
			this.state.mainRow.remove();
			this.state.mainRow = "";
		} else {
			console.error("cleanumDom$ mainRow of given row doesn't exist")
		}
		if (cleanContainer) {
			if (this.state.container != "") {
				this.state.container.remove();
				this.state.container = "";
			} else {
				console.error("cleanumDom$ container of given row doesn't exist")

			}
		}
	}
	/**
	 * - Function for standard inputs that changes their state to "editing" if the content is different from the origin.
	 *@param {{target: {name:string, "//Other dom stuff"}, "//Other event stuff"}} event  Input event
	 * Doesn't work for multi-field-editing inputs like the lists
	 */
	addEditingOnStdInput = (event: usableEvent) => {
		const theProperty = event.target.name;
		if (this.current[theProperty as keyof TradeObj] != this.origin[theProperty as keyof TradeObj]) {
			this.setEditing(theProperty);
		} else {
			this.removeEditing(theProperty);
		}
		//Toggle the cancel button
		this.cancelSaveToggler();
	};
	/**
	 * Function to change the editing state of an input
	 * @param {{target: {name:string, "//Other dom stuff"}, "//Other event stuff"}} event
	 */
	addEditingOnListInput = (event: usableEvent) => {
		const theProperty = event.target.name;
		const linked = this.structure[theProperty].objLinked;
		//Work on the property
		if (this.current[theProperty as keyof TradeObj] != this.origin[theProperty as keyof TradeObj]) {
			this.setEditing(theProperty);
		} else {
			linked.forEach((link) => {
				if (this.current[link as keyof TradeObj] != this.origin[link as keyof TradeObj]) {
					this.setEditing(theProperty);
					//Cut the function
					return true;
				}
			});
			this.removeEditing(theProperty);
		}
		//Toggle the cancel button
		this.cancelSaveToggler();
	};
	/**
	 * Function to close the trade
	 * @param {true | false} partial Whether a new trade should be created or not - used for resetting. ALWAYS TRUE if percentage is less than 100
	 * @param {int} percentage Number between 1 and 100. If lesser than 100, then a new trade object is created
	 * The reason why percentage and partial are detached is to enable closing a trade partially but splitting it in the same instance.
	 * Standard use doesn't require this feature.
	 * @returns {bool} Whether the close was succesful or not.
	 * - The closed ref list gets updated only on pseudoid removal
	 */
	close = (partial = false, percentageStr = "100") => {
		//Double check if coming from closeprompt
		//If the number is wrong, then return an error before closing weird stuff
		if (!validPerc(percentageStr)) {
			return false;
		}
		const percentage = parseFloat(percentageStr);
		//TODO
		//Either change the property of the trade itself (partial = false, perc = 100) or create new trade
		//If this trade edited, add cancel button
		//If new trade, enable big save button and "split" current trade stuff (like closed perc)+ enable canceling on current trade
		//Run stats

		//If not partial, then close the current trade
		if (!partial) {
			//TODO
			this.updateCurrent("true", "closed");
			//Add editing with "faking" of the object
			this.addEditingOnStdInput({ target: { name: "closed" } } as usableEvent);
			//GRAPHICAL CHANGES
			this.structure[gin("1")].target.innerHTML = "Open";
			// Add the open event listener
			this.structure[gin("1")].target.onclick = this.open;

			this.structure[gin("1")].target.rgd("button");
			this.structure[gin("1")].target.rgd("openedBtn");
			this.structure[gin("1")].target.agd("closedBtn");

		} else {
			//Edit the fields, create a "complete" partial close, then add a SAVE PROMPT to it
			const availableFields = availableFieldsGen();
			//Create the new trade object
			//Create a new row "percenting" the numerical values of the current one and creating a relative different one
			const percentedNewTrade = { ...this.current };
			let index = 1;
			let newPseudoId = `${this.origin[gin("00i")]}c${index}`;
			if (this.state.table == "") {
				console.error("Table not yet assigned to row while closing it:", this);
				return false;
			} else {
				while (this.state.table.tradeWindowRef.allRowsObj.hasOwnProperty(newPseudoId)) {
					newPseudoId = `${this.origin[gin("00i")]}c${index}`;
					index++;
				}
				percentedNewTrade[gin("00p")] = newPseudoId;
				//00i is the id
				//Closed Ref
				//* Here we decide that if you close a sub trade you are still closing a part of the main trade and not of the sub trade
				if (this.current[gin("29")] != "-1") {
					percentedNewTrade[gin("29")] = this.current[gin("29")];
					//THE ORIGIN IS UPDATED IN THE BACKEND - affecting directly the origin of the parent
					const parentTrade = this.state.table.tradeWindowRef.allRowsObj[this.current[gin("29")]];
					const newList = JSON.parse(parentTrade.current[gin("30")]);
					newList.push(newPseudoId);
					parentTrade.current[gin("30")] = JSON.stringify(newList);
				} else {
					percentedNewTrade[gin("29")] = this.current[gin("00p")];
					//THE ORIGIN GETS UPDATED ON SAVE BY THE BACKEND
					const newList = JSON.parse(this.current[gin("30")]);
					newList.push(newPseudoId);
					this.current[gin("30")] = JSON.stringify(newList);

					//Addition of this id to the current closed list of the main row

				}
				//Closed
				percentedNewTrade[gin("1")] = "true";
				percentedNewTrade[gin("30")] = "[]";
				//Change the values of the current trade and of the percented one following the modifiers directions
				//Add editing to all of these properties
				//- We create the new row here, to give the attributes which remove from the main row the 0 value on the origin, so that people are prompted to save them.
				const newPartialCloseRow = new Row2(percentedNewTrade, false);
				this.state.table.tradeWindowRef.sortAndTableTrades([newPartialCloseRow]);
				Object.values(availableFields).forEach((field) => {
					if (field.modifiers.includes("closed_reduce")) {
						//Change the values in the visual interface
						//Change the values in the reference objects
						//this.structure[field.name].target;
						if (!isNaN(parseFloat(this.current[field.name as keyof TradeObj]))) {
							this.current[field.name as keyof TradeObj] = (((100 - percentage) / 100) * parseFloat(percentedNewTrade[field.name as keyof TradeObj])).toString();
							newPartialCloseRow.current[field.name as keyof TradeObj] = ((percentage / 100) * parseFloat(percentedNewTrade[field.name as keyof TradeObj])).toString();
							//We are reducing the value, so if it were to be reset it would go to 0 - hence the following decision
							newPartialCloseRow.origin[field.name as keyof TradeObj] = "0";
							//Add this property to the editing tab
							this.addEditingOnStdInput({ target: { name: field.name } } as usableEvent);
							newPartialCloseRow.addEditingOnStdInput({ target: { name: field.name } } as usableEvent);
							this.changeValue(field.name);
							newPartialCloseRow.changeValue(field.name);
							//Change the field visually

						}

					}
					//This was made for future implementation of fields like the closed perc one
					else if (field.modifiers.includes("closed_relative_increase")) {
						//Change the values
						if (!isNaN(parseFloat(this.current[field.name as keyof TradeObj]))) {

							this.current[field.name as keyof TradeObj] +=
								(100 - parseFloat(this.current[field.name as keyof TradeObj])) * percentage / 100;
							//Add this property to the editing tab
							this.addEditingOnStdInput({ target: { name: field.name } } as usableEvent);
							this.changeValue(field.name);
						}
					}
				});





			}
			return true;
		}
	};
	/**
	 * Function to open the trade and change the style of the button
	 */
	open = () => {
		//STYLEME
		this.updateCurrent("false", "closed");
		this.addEditingOnStdInput({ target: { name: "closed" } } as usableEvent);
		this.structure[gin("1")].target.innerHTML = "Close";
		//Re-add the close event listener
		this.structure[gin("1")].target.onclick = this.closePrompt;

		this.structure[gin("1")].target.rgd("closedBtn");
		this.structure[gin("1")].target.agd("openedBtn");
	};
	/**
	 * * Function to spawn an INPUT field
	 * @param {int} directive
	 * @param {{value: string, has: true | false}} propInfo accessed with this.name of the specified directive
	 * - WEIRD BEHIAVIOUR: We give the value before the directive is rendered to enable legend rendering - and also historical referencing
	 * @returns {domElement} !ATTENTION! You are getting the container with the field in it, not the "actual input". To access it use the .field property
	 */
	spawnField(directive: string, propInfo: { value: string, has: boolean }) {
		//Get the current available fields;
		const availableFields = availableFieldsGen();

		/**
		 * - Function that takes in the event coming from an input event and changes the current object acccrodingly
		 * @param {{"//contains a lot of stuff",target:{ ..., value: string}}} event
		 */
		const updateOnStdInput = (event: usableEvent) => {
			this.updateCurrent(event.target.value, event.target.name);
			this.formulaRun()
		};

		//Pass the two functions from the parent object
		const addEditingOnStdInput = this.addEditingOnStdInput;

		const addEditingOnListInput = this.addEditingOnListInput;

		/**
		 * Function to create a structure in the this.structure object for the given std input field
		 * @param {domElemeent} field
		 * @param {{name: string, render: boolean,default:any,objLinked: [] | string[],"//And more fields which can be found above the defaultfields delcaration"}} directive
		 */
		const createStructure = (field: inputField | selectField | buttonField, ginDir: string) => {
			this.structure[field.name] = {
				target: field,
				editing: false,
				name: field.name,
				//Used for understanding whether it's a button, an user generated element or a normal input
				dirTag: ginDir,
				hasCancelListener: false,
				//Attributes which this edits as well in the current object
				objLinked: [],
				/**
				 * Function that resets the field to its origin value. Changes based on directive type
				 */
				reset: () => {
					this.changeValue(field.name, "origin")
				},
			};

			//If the field is linked to others, save it here
			const directive = availableFieldsGen()[ginDir];
			if (
				directive.hasOwnProperty("objLinked") && directive.objLinked != undefined &&
				directive.objLinked.length != 0
			) {
				//If there are linked properties, push them in here so that they can be "edited" and checked accordingly
				this.structure[field.name].objLinked = [...directive.objLinked];
			}
		};
		/**
		 * Function to build a dinamic input lister on the given field
		 * @param {string} targetValue The value to affect in the current and origin object
		 * @param {domElement} targetInput The input to build upon
		 * @param {[{id: number, value: string, tag: string}]} list The list to pick elements from
		 * - STRICT IS CURRENTLY NOT IN USE
		 * @param {boolean} strict Wheter it's allowed or not to input not-in-list elements into the field
		 */
		const buildLister = (
			targetValue: string,
			targetInputHolder: fieldHolder,
			list: listerObj[],
		) => {
			if (instanceOfIF(targetInputHolder.memory.field) || instanceOfSF(targetInputHolder.memory.field)) {
				const listingExpander = new Expander(targetInputHolder.memory.field, "lister")
				//Create the element which contains the available options
				//Set the input value to the right one
				const initialValue = {
					value: this.current[targetValue as keyof TradeObj],
					id: this.current[`${targetValue}_id` as keyof TradeObj],
					tag: this.current[`${targetValue}_tag` as keyof TradeObj],
				};
				targetInputHolder.memory.field.value = initialValue.value;
				/**
				 * Sets the current value to a given valid element
				 * @param {{id: -1 | number, value: string, tag: "" | string}} matchedInput
				 * @param {"current" | "origin"} directive where to "aim the change". Used for INITIAL setup
				 */
				const updateOnInput = (matchedInput: listerObj) => {
					//Update the current element
					this.updateCurrent(matchedInput.value, targetValue);
					this.updateCurrent(matchedInput.id, `${targetValue}_id`);
					this.updateCurrent(matchedInput.tag, `${targetValue}_tag`);
					this.formulaRun();
				};
				/**
				 * - For list inputs
				 * Function that sorts the given list by tag and then prints the elements in order
				 * @param {*} list
				 * @param {*} block
				 */
				/**
				 * Function that matches a specific value with a list. RETURNS SINGLE ELEMENT, either matching or not
				 * @param {[{id: number, value: string, tag: string}]} list List to match the value in
				 * @param {string | {id: number, value: string, tag: string}} specValue Value to match for
				 * @returns {{id: -1 | number, value: string, tag: "" | string}} matching element
				 * Doesn't account for duplicate elements and just returns the first result given the name
				 */
				function listMatch(list: listerObj[], specValue: string | listerObj): listerObj {
					if (typeof specValue == "string") {
						const newList = list.filter((element) => {
							return element.value.toLowerCase() == specValue.toLowerCase();
						});
						if (newList.length == 0) {
							return { value: specValue, id: "-1", tag: "" };
						}
						return newList[0];
					}
					//IF THE specValue IS AN OBJECT, WHICH IS UNLIKELY, use the equivalent function to check equality
					else {
						const newList = list.filter((element) => {
							return isEquivalent(element, specValue);
						});
						if (newList.length == 0) {
							return { value: specValue.value, id: "-1", tag: "" };
						}
						return newList[0];
					}
				}
				/**
				 * Function to get a list of matching elements to the given input
				 * @param {[{id: number, value: string, tag: string}]} list
				 * @param {string} value
				 * @returns {[{id: number, value: string, tag: string}]}
				 */
				function listBrowse(list: listerObj[], value: string) {
					const newList = list.filter((element) => {
						return element.value.toLowerCase().includes(value.toLowerCase());
					});
					return newList;
				}

				targetInputHolder.memory.field.addEventListener("input", function (e) {
					//RUNTIME

					if (e.target != null) {
						const input = targetInputHolder.memory.field.value;
						//UPDATE
						const matchedInput = listMatch(list, input);
						updateOnInput(matchedInput);
						//Add editing state
						addEditingOnListInput(e as usableEvent);
						//Now filter using that input
						const availableChoices = listBrowse(list, input);
						//Show the listing block
						listingExpander.moveAndResizeTo();
						listingExpander.fill(availableChoices)
					} else {
						console.error("Target is null");
					}
				});
				targetInputHolder.memory.field.addEventListener("focus", function (e) {
					if (e.target != null) {
						//RUNTIME
						const input = targetInputHolder.memory.field.value;
						//Now filter using that input
						const availableChoices = listBrowse(list, input);
						//Show the listing block
						listingExpander.fill(availableChoices);
						listingExpander.show();
					} else {
						console.error("Target is null");
					}
				});
				targetInputHolder.memory.field.addEventListener("newInput", ((e: CustomEvent) => {
					listingExpander.hide();
					const inputValue = e.detail.inputValue;
					updateOnInput(inputValue);
					addEditingOnListInput({ target: { name: targetValue } } as usableEvent);
					targetInputHolder.memory.field.value = inputValue.value;
				}) as EventListener)
				window.addEventListener("click", function (event) {
					if (listingExpander.state.visible == true) {
						if (
							event.target != targetInputHolder &&
							event.target != targetInputHolder.memory.field &&
							event.target != targetInputHolder.memory.fieldHolder &&
							event.target != listingExpander.element
						) {
							listingExpander.hide();
						}
					}
				});
			} else {
				console.error("Assigning lister type expander to a button element");
			}
		};
		//Used to hold "excess" elements around the input itself.
		const fieldHolder = spawnDiv() as fieldHolder;
		fieldHolder.agd("fieldHolder");
		//Declaration of used fields in the process
		let field!: inputField | selectField | buttonField; //* The ! serves to tell typescript that I WILL define it
		//Put the thing into a variable for easier access
		const dirProperties = availableFields[directive];
		//The type switches between the "structure" of the element to spawn, not its HTML type
		switch (dirProperties.type) {
			case "input":
				//If it's an input do quick adjustments
				field = spawnInput() as inputField;
				//STYLEME
				field.value = propInfo.value;
				field.setAttribute("placeholder", dirProperties.placeholder);
				switch (dirProperties.subtype) {
					case "text":
						field.setAttribute("type", "text");
						break;
					case "locked":
						field.setAttribute("type", "text");
						field.setAttribute("disabled", "true");
						break;
					case "number":
						field.setAttribute("type", "number");
						field.setAttribute("placeholder", dirProperties.placeholder);
						break;
					case "date":
						field.setAttribute("type", "date");
						break;
					case "time":
						field.setAttribute("type", "time");
						break;
				}
				field.addEventListener("input", updateOnStdInput as () => void);
				field.addEventListener("input", addEditingOnStdInput as () => void);
				//Here we cna append it after
				fieldHolder.append(field);
				//Easier access when referencing things in the aftermath (1/2)
				break;
			case "choice":
				switch (dirProperties.subtype) {
					case "list":
						//The list type is a type where you get a list of options but the choice is not forced, also you can "write"
						field = spawnInput() as inputField;
						field.discriminator = "INPUT-FIELD";
						fieldHolder.append(field);
						fieldHolder.memory.field = field;
						//Easier access when referencing things in the aftermath (1/2)
						//Used in the
						buildLister(dirProperties.name, fieldHolder, dirProperties.options as listerObj[]);
						break;
					case "select":
						field = spawnSelect() as selectField;
						field.discriminator = "SELECT-FIELD";
						//STYLEME
						if (dirProperties.options != undefined) {
							const actualOptions = dirProperties.options[this.current[gin("27")] as keyof fieldDirective["options"]] as variation[];
							actualOptions.forEach((option) => {
								const optionSelect = document.createElement("option");
								optionSelect.value = option.value;
								optionSelect.innerText = option.text;
								field.append(optionSelect);
							})
							//Here we set the value of the select field to its default one
							field.value = propInfo.value;
							//The input inplementation works like a charm for this.
							field.addEventListener("input", updateOnStdInput as () => void);
							field.addEventListener("input", addEditingOnStdInput as () => void);
							fieldHolder.append(field);
							break;
						} else {
							console.error("Missing options in the field directive during field generation", dirProperties, this);
						}
				}
				break;
			case "closed":
				field = spawnBtn() as buttonField;
				field.rgd("button");
				//Make the button into a "closed" string that you cvan click on to reopen the trade.
				if (this.getValue(gin("1")).value == "true") {
					field.innerHTML = "Open";
					field.onclick = this.open;
					field.agd("closedBtn");
				} else {
					field.innerHTML = "Close";
					//ADD EVENT LISTENER
					field.onclick = this.closePrompt;
					field.agd("openedBtn");
				}
				fieldHolder.append(field);
				break;
			case "button":
				field = spawnBtn() as buttonField;
				//Set the basic text to the default one provided in the dir object - can be changed later
				field.innerHTML = dirProperties.default;
				//Add it to its own holder
				fieldHolder.append(field);
				switch (dirProperties.subtype) {
					//The "Default disabling" of the cancel and savebutton is ran after the fields are created in the renderrow FuNCTION
					//* REMEMBER TO RUN IT IF THE ROW IS GENERATED IN ANOTHER WAY.
					case "cancel":
						field.agd("cancelBtn");
						break;
					case "save":
						field.agd("saveBtn");
						break;
					case "delete":
						field.agd("deleteBtn");
						field.onclick = () => this.d_delete();
						break;
				}
				fieldHolder.memory.field = field;
				//PLACEHOLDER
				break;

			//Used for non rendering fields or specific things which are nothing at all
			case "tags":
				//TODO: Create tags input
				field = spawnInput() as inputField;
				//STYLEME
				field.value = propInfo.value;
				field.setAttribute("placeholder", dirProperties.placeholder);
				fieldHolder.append(field);
				break;
		}
		field.setAttribute("name", dirProperties.name);
		field.classList.add(dirProperties.name);
		//Here we make it easy to access the fields for future changes
		createStructure(field, directive);
		//Easier access when referencing things in the aftermath (2/2)
		//Re-setting the memory.field here to the field itself, for places where I don't need to do it before this line, like listers
		fieldHolder.memory.field = field;
		field.memory.fieldHolder = fieldHolder;
		return fieldHolder;
	}

	//Different name for different layout
	/**
	 * * The rendering function
	 * @param {boolean} fresh Used to define whether it's the first render or not. If so, then create the container before spawning the trade inside it.
	 * Used to render rows, not to render historical trades; Open | Closed | Partial closed
	 * - Fresh set to false is used to re-render rows with a different layout.
	 */
	renderRow(fresh = true) {
		//All the fields layout you can use
		const availableFields = availableFieldsGen();
		//Retrive the layout of the trade || NO difference between this.origin and this.current
		const layout = this.getLayout();
		//Main row;
		//USE: "MULTIPLE ROWS" in a single trade or expanded views
		const mainRow = document.createElement("div");
		this.state.mainRow = mainRow;
		//If it's an historical trade, do this
		// Container
		//USE: hold the multiple rows
		let container;
		if (this.origin[gin("29")] != "-1") {
			//STYLEME
			mainRow.agd("closedRow");
			//Get the container from the origin trade by using its closedRef
			//HIGH UP- not stuck to the current row, may find other ones if needed
			//Possible feature to change
			if (this.state.table == "") {
				console.error("renderRow went wrong, table has not been assigned yet (renderRow) (closed-row)", this)
			} else {
				//TODO: Make the ref to the pseudoId and not the Id
				container =
					this.state.table.children[this.origin[gin("29")]].state
						.container;
				this.state.container = container;
				//Only one append required, unlike normal rows where we are creating a trade container to put the main row in, we simply add the trade row to the main trade pre-existing container
				if (this.state.container == "") {
					console.error("Table has been assigned, but its container is empty (renderRow) (closed-row)", this, this.state.table.tradeWindowRef.allRowsObj[this.origin[gin("29")]].state.container)
				} else {
					this.state.container.append(mainRow);
					//Addin the row to the state of the trade for easier access in the future
				}

			}
		} else {
			//STYLEME
			//If the trade is not closed, then either build a new container
			//THE CONTAINER IS "ABOVE" THE MAIN ROW
			if (fresh) {
				//Create the trade box
				//USE: Row and expansion container
				container = this.createContainer();
				container.append(mainRow);
			} else {
				if (this.state.container == "") {
					console.error("The container is empty (renderRow) (re-render of non closed row)", this)
				} else {
					container = this.state.container;
					container.append(mainRow);
				}
			}
			//Here we are prepending (low to high IDs) the row to the container itself - unlike the closed trades where we only have to append one: row to container
			if (this.state.parent == "") {
				console.error("Parent not defined (renderRow)", this, this.state.parent)
			} else {
				this.state.parent.prepend(container as HTMLElement);
				if (container == undefined) {
					console.error("Prepending undefined element (renderRow)", container, this)
				}
			}
			if (this.state.isLegend) {
				mainRow.agd("legendRow");
				if (this.state.container != "")
					this.state.container.agd("legendContainer");
			} else {
				mainRow.agd("mainRow");
			}
		}
		//Visible fields
		layout.forEach((block) => {
			const section = document.createElement("div");
			//STYLEME
			//width
			if (block.size == "0") {
				section.style.display = "none";
				//Generate the list of not visible fields
				block.elements = Object.keys(availableFields).filter(
					//Only use elements which are not used in any other field
					//I have no clue why this thing has double the same negation but whatever, it works nonetheless
					(key) => !block.nElements.includes(key) && !block.nElements.includes(key)
				);
			}
			//scrollable
			if (block.fixed) {
				//? DOUBTFUL about how to handle the width property
				section.style.minWidth = block.size;
				section.style.maxWidth = block.size;
				section.agd("fixedSection");
			} else {
				section.style.width = block.size;
				section.agd("scrollableSection");
				//Sync Scrolling
				if (this.state.table != "" && this.state.table.target != "") {
					//Create an hashed event for sections with the same properties
					//! Possible bug if two sections are identical, but a problem for some intern later.
					const hashEventCode = simpleHash(JSON.stringify(block));

					const eventScroll = new CustomEvent(hashEventCode, { detail: { scroll: 0, sender: this.origin.pseudo_id } });

					this.state.table.target.addEventListener(hashEventCode, ((e: CustomEvent) => {
						if (e.detail.sender != this.origin.pseudo_id) {

							section.scrollLeft = e.detail.scroll;
						}
					}) as EventListener)

					section.addEventListener("scroll", () => {
						if (this.state.table != "" && this.state.table.target != "") {
							eventScroll.detail.scroll = section.scrollLeft
							this.state.table.target.dispatchEvent(eventScroll);
						}
					})


				}

			}
			//ELEMENTS
			block.elements.forEach((directive) => {
				const fieldInfo = availableFields[directive];
				if (this.state.isLegend) {
					//Get the info for the specific column
					//Get the columnname to either the columName defined or the dbName
					const columnName =
						fieldInfo.columnName == "" ? fieldInfo.name : fieldInfo.columnName;
					const hasObj = { value: columnName, has: true };
					//Get the value for that element
					//Render based on the 0 field
					const field = this.spawnField("0", hasObj);
					section.append(field);
				} else {
					//Get the property
					const value = this.getValue(fieldInfo.name);
					const field = this.spawnField(directive, value);
					section.append(field);
				}
			});
			mainRow.append(section);
		});
		//If the trade is not a legend row
		if (!this.state.isLegend) {
			//Run the cancel toggler thingy, to disable  (or enable, up to future implementations) the cancel button
			this.cancelSaveToggler();
			this.formulaRun();
			this.refreshDropdown();
		}
	}
	/**
	 * Runs field-specific compute functions
	 * 
	 * NB: Each one of these functions acts solely on the field itself. It can pull data from others but can't update them.
	 */
	formulaRun() {
		const currentLayout = this.getLayout();
		let formulaSet: Set<keyof UserPreferences['formulas']['fields']> = new Set();
		currentLayout.forEach(block => {
			formulaSet = new Set([...formulaSet, ...block.activeFormulas]);
		})
		Array.from(formulaSet).forEach(formulaName => {
			//Things named with op are referred to the operator sets
			const formula = userPrefs.formulas.fields[formulaName];

			//Overwrite checker here
			switch (formula.overwrite) {
				case 0:
					if (this.current[gin(formula.targets)] != formula.overwriteCond && !this.state.statsChangedList.has(gin(formula.targets))) {
						return
					}

				//No break to continue to the next case
				case 1:
					const opSubTopicLenght = formula.operator.subTopicOperation.length;
					const opMainStreaklLenght = formula.operator.mainOperationStreak.length;

					let funcValid = true;


					let numResult = 0;
					let strResult: string | false = "";


					//The topic position is also used to index the current operation
					for (let topicPosition = 0; topicPosition < formula.topics.length; topicPosition++) {
						const topic = formula.topics[topicPosition];
						let topicValid: boolean = true;

						if (formula.underlyingType == "number") {
							strResult = false;
							let topicResult = 0;
							const opTopicStreak = formula.operator.subTopicOperation[topicPosition % opSubTopicLenght]
							const opTopicStreakLenght = opTopicStreak.length

							//After the first cycle use this array instead.
							const repeatableOperations: Array<FuncOperator> =
								[...opTopicStreak]
									.filter(operator => {
										//Filter out single use elements
										return !Array.isArray(operator)
									}) as Array<FuncOperator>;

							//ITERATE THROUGH THE ELEMENTS
							for (let subTopicIndex = 0; subTopicIndex < topic.directives.length; subTopicIndex++) {
								const topicDirective = topic.directives[subTopicIndex];
								//Decide which streak to use depending on whether we are positioned in the first cycle or cycles ahead
								let currentOperator: FuncOperator;

								if (subTopicIndex >= opTopicStreakLenght) {
									//Second operation cycle
									//Remove the lenght of the operators which are not going to be repeated and index on base lenght of these operators.
									currentOperator = repeatableOperations[(subTopicIndex - opTopicStreakLenght) % repeatableOperations.length];
								} else {
									//First operation cycle
									//Single directive check.
									//Had to infer types because typescript is ideotic
									currentOperator = Array.isArray(opTopicStreak[subTopicIndex]) ? opTopicStreak[subTopicIndex][0] as FuncOperator : opTopicStreak[subTopicIndex] as FuncOperator;
								}
								const uValidValue = this.current[gin(topicDirective.dp)];
								const valid = trueConditionCheck(uValidValue, topicDirective.trueCondition);
								//Ignore?
								if (currentOperator == "i") {
									if (!valid) {
										topicValid = false;
										//Close cycle
										subTopicIndex = topic.directives.length;
									}
								} else {//Now the operator is one to make work on the actual result
									if (valid) {
										topicResult = applyNumOperator(topicResult, pf(uValidValue), currentOperator);
									} else if (!valid && topicDirective.defaults != -1) {
										topicResult = applyNumOperator(topicResult, pf(topicDirective.defaults), currentOperator)
									}
									else if (!valid && topicDirective.defaults == -1) {
										topicValid = false;
										//Close cycle
										subTopicIndex = topic.directives.length;
									} else {
										console.error("formulaRun$ During directive check, none of the truthCondition circumstances was catched", topicDirective);
										topicValid = false;
										subTopicIndex = topic.directives.length;
									}
								}
							}


							if (topicValid == true) {
								if (topicPosition == 0) {
									numResult = topicResult;
								} else {
									const currentOperation = formula.operator.mainOperationStreak[(topicPosition - 1) % opMainStreaklLenght];
									numResult = applyNumOperator(numResult, topicResult, currentOperation);
								}
							}
							else if (topic.defaults != -1 && topicValid == false) {
								if (topicPosition == 0) {
									numResult = pf(topic.defaults);
								} else {
									const currentOperation = formula.operator.mainOperationStreak[(topicPosition - 1) % opMainStreaklLenght];
									numResult = applyNumOperator(numResult, pf(topic.defaults), currentOperation);
								}
							} else if (topic.defaults == -1 && topicValid == false) {
								//Complete the whole cycle and stop running for loops
								funcValid = false;
								topicPosition = formula.topics.length;
							}
						} else {

						}
					}

					if (funcValid) {
						//Overwrite property checked before calculation
						this.updateCurrent(strResult == false ? numResult.toString() : strResult, gin(formula.targets), true);
						this.changeValue(gin(formula.targets))
						this.addEditingOnStdInput({ target: this.structure[gin(formula.targets)].target });
					} else {
						return;//Skip this cycle and move to the next one. We are at the end but this signifies better
					}

			}



		});
	}
}




////////////
// RUNTIME
function createNewRow(startingObj: Partial<TradeObj> = new TradeObj({}), options: { separator: string, forcedProperties: Partial<TradeObj>, repeat: number } = { separator: "n", forcedProperties: {}, repeat: 1 }) {
	const tradeArray: Array<Row2> = [];
	for (let index = 0; index < options.repeat; index++) {
		const tradeObj = new TradeObj(startingObj)

		if (tradeWindow.allRows.length != 0 && !startingObj.hasOwnProperty(gin("00i"))

		) {
			//! Needs map fixing because this is highly stupid
			let copiedId = (tradeWindow.biggestSorting + 1).toString();

			let index = 1;
			let newPseudoId = `${copiedId}${options.separator}${index}`;
			while (tradeWindow.allRowsObj.hasOwnProperty(newPseudoId)) {
				index++;
				newPseudoId = `${copiedId}${options.separator}${index}`;
			}


			tradeObj[gin("00p")] = newPseudoId;
			tradeObj[gin("00i")] = copiedId;
		}

		//! Needs map fixing because this is highly stupid
		if (tradeObj[gin("s")] == "0" && tradeObj[gin("00p")] != tradeObj[gin("00i")]) {
			tradeObj.saved_sorting = (tradeWindow.biggestSorting + 1).toString();
		}

		for (const [key, value] of Object.entries(options.forcedProperties)) {
			tradeObj[key as keyof TradeObj] = value;
		}
		//If it's not the first one, then the default "0n1" value will work fine
		//As soon as the thing is sent, then the pseudoId will be changed to match the ID - unless another row has been gathered before it.
		const newRow = new Row2(tradeObj);
		tradeArray.push(newRow);
	}

	tradeWindow.sortAndTableTrades(tradeArray);
}


const tradeWindowTarget = document.querySelector(".new-target");


//Create new tradeewindow
const tradeWindow = new TradeWindow(tradeWindowTarget as HTMLElement);
//Add all trades to this tradewindow
//Get trades
//Trasform them into rows
//Push them into the tradewindow
//? User data (user pref) oject generator API?

tradeWindow.buildTables();

tradesList.forEach(trade => {
	createNewRow(trade);
})


////////////////////////
// Controller Section //
////////////////////////

const controllerBox = spawnDiv();
controllerBox.agd("controllerBox")
tradeWindowTarget?.prepend(controllerBox);



/////////////////////////
// New Row

const newRowButton = spawnBtn();
newRowButton.innerHTML = "New row";
newRowButton.agd("mainBtn", "button");

const newRowOptionExpander = new Expander(newRowButton, "moreOptions");

newRowButton.addEventListener("click", (e) => {
	newRowOptionExpander.show();
	newRowOptionExpander.fill(
		[{
			id: "newRows",
			//Here we chose to put the templatename inside the directives for defaults, so these other two fields cna have other implementations later
			value: "",
			tag: ""
		}]
	)
});
window.addEventListener("click", function (event) {
	if (newRowOptionExpander.state.visible == true) {
		if (
			// Having ONLY the expander makes this a form of toggle
			event.target != newRowOptionExpander.element &&
			event.target != newRowButton
		) {
			newRowOptionExpander.hide();
		}
	}
});
newRowButton.addEventListener("directive", ((e: CustomEvent) => {
	newRowOptionExpander.hide();
	// { detail: { type: button.attachedNumber, attachedObj: button.attachedObj} }
	// type refers to whether to spawn a trade builder box
	// attachedObj is the default trade to start from

	//0 means new trade, 1 means open builder
	if (e.detail.type == "0") {
		createNewRow(e.detail.attachedObj);
	} else if (e.detail.type == "1") {

	}
}) as EventListener);

const spawnNewTradeBuilder = () => { };

controllerBox.append(newRowButton);
//////////////////////
// SaveAll

const saveAllBtn = spawnBtn();
saveAllBtn.disabled = true;
saveAllBtn.agd("disabledBtn");
tradeWindow.controllers.saveAll = saveAllBtn;
saveAllBtn.innerHTML = "Save All";
saveAllBtn.agd("mainBtn", "button");

controllerBox.append(saveAllBtn);

saveAllBtn.onclick = function () {
	for (const row of tradeWindow.currentlyEdited.values()) {
		row.d_saveChanges();
	}
}


//TODO: FINISH IMPLEMENTING


////////////////7/////
// Edit User preferences

const editPrefsBtn = spawnBtn();
controllerBox.append(editPrefsBtn);
editPrefsBtn.agd("button", "mainBtn");
editPrefsBtn.innerHTML = "Settings";

const mainEditPrefsWindow = document.querySelector(".tt-edit-user-preferences") as HTMLElement;
if (mainEditPrefsWindow != null) {
	const editPrefsObj = {
		fullActivatorBtn: editPrefsBtn,
		state: {
			visible: false,
			currentPage: "columnsEditor",
		},
		elements: {
			mainWindow: mainEditPrefsWindow,
			closeBtn: mainEditPrefsWindow.querySelector(".close-button") as HTMLButtonElement,
			menuBar: mainEditPrefsWindow.querySelector(".menu-bar") as HTMLDivElement,
			pageSection: mainEditPrefsWindow.querySelector(".page-section") as HTMLDivElement,
			pages: {
				columnsEditor: mainEditPrefsWindow.querySelector(".columns-editor") as HTMLDivElement,
				customColumns: mainEditPrefsWindow.querySelector(".custom-columns") as HTMLDivElement,
			}
		},
		showMainTab() {
			changeVisible(this.elements.mainWindow, true, [this.state.visible])
		},
		hideMainTab() {
			changeVisible(this.elements.mainWindow, false, [this.state.visible])
		},
		switchPage(newPage: string) {
			if (this.elements.pages.hasOwnProperty(newPage)) {
				changeVisible(this.elements.pages[this.state.currentPage as keyof typeof this.elements.pages], false);
				changeVisible(this.elements.pages[newPage as keyof typeof this.elements.pages], true);
				this.state.currentPage = newPage;
			} else {
				console.error("Trying to switch to non-existing preferences page");
			}
		}
	}

	//Runtimes


	//Initializers
	editPrefsObj.hideMainTab();

	//hide all pages
	Object.values(editPrefsObj.elements.pages).forEach(page => {
		changeVisible(page, false);
	});
	//make the first one show
	editPrefsObj.switchPage("columnsEditor");


	//Listeners

	//main tab
	editPrefsBtn.addEventListener("click", function () {
		editPrefsObj.showMainTab();
	});
	editPrefsObj.elements.closeBtn.addEventListener("click", function () {
		editPrefsObj.hideMainTab();
	});
	window.addEventListener("click", (event) => {
		if (editPrefsObj.state.visible == true) {
			if (
				event.target != editPrefsObj.elements.mainWindow
			) {
				editPrefsObj.hideMainTab();
			}
		}
	})

} else {
	console.error("Couldn't find the user preferences menu box");
}

//Notifications
function newAlert(message: { status: "error" | "success", message: string }) {
	// {status: ----, message: ----}
	const alert = spawnDiv();
	alert.agd("alert");
	alert.classList.add(`tt-${message.status}`);
	alert.innerHTML = message.message;

	const alertBox = document.querySelector(".tt-alert-box");
	if (alertBox != null) {
		alertBox.append(alert);
		setTimeout(() => {
			alertBox.removeChild(alert);
		}, 3500);

	} else {
		console.error("Alert box is undefined: Appending new message is impossible");
	}
}