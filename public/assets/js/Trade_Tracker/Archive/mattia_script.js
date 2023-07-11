"use strict";
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
- styling
- linked scrolling
- Sync the "lateral" fields for tag and id with the changeValue function and make them update/reset accordingly
- historical
- expanded view
- image
- Save + delete button
- Fix ts-ignores
- Working on block designing
? - Structure more stuff with events
SMALLER
- Do something about the "plain" main new-row button
- deletePrompt
- Styling ability
- Give the ability to enter images
- Give the ability for "tag" blocks and use expandeers to do so. Notion like
- Re-create the sort feature
- Finish the compute functions
ACTIVE


- default pseudo ID
- Legend Row
*/
class TradeObj {
    constructor(row) {
        this.legend = row.legend || "";
        this.id = row.id || "0";
        this.pseudo_id = row.pseudo_id || "0n1";
        this.order_id = row.order_id || "0";
        this.closed = row.closed || "false";
        this.symbol = row.symbol || "";
        this.broker_symbol_id = row.broker_symbol_id || "";
        this.trade_type = row.trade_type || (row.category == "equity" || !row.category ? "long" : "call");
        this.open_date = row.open_date || "";
        this.close_date = row.close_date || "";
        this.shares = row.shares || "0";
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
        this.json_user_fields = row.json_user_fields || buildDefaultUserFields();
        this.save = row.save || "Save";
        this.cancel = row.cancel || "Cancel";
        this.delete = row.delete || "Delete";
    }
}
function instanceOfIF(object) {
    return object.discriminator === "INPUT-FIELD";
}
function instanceOfSF(object) {
    return object.discriminator === "SELECT-FIELD";
}
function instanceOfBF(object) {
    return object.discriminator === "BUTTON-FIELD";
}
function isStructObj(obj) {
    return 'name' in obj && 'target' in obj && 'editing' in obj && 'dirTag' in obj;
}
let darkenedScreenElement = null;
let darkenedScreenIndex = 0;
//Gather backend data
const tradeElement = document.getElementById("trade-list");
const symbolElement = document.getElementById("symbol-list");
const walletElement = document.getElementById("wallet-list");
let tradesList, symbolList, walletList;
if (tradeElement === null || tradeElement.textContent === null) {
    tradesList = [];
}
else {
    tradesList = JSON.parse(tradeElement.textContent.trim());
}
if (symbolElement === null || symbolElement.textContent === null) {
    symbolList = [];
}
else {
    symbolList = JSON.parse(symbolElement.textContent.trim());
}
if (walletElement === null || walletElement.textContent === null) {
    walletList = [];
}
else {
    walletList = JSON.parse(walletElement.textContent.trim());
}
/**
 * Returns an input field
 * @returns {domElement} Input field
 */
function spawnInput() {
    const res = document.createElement("input");
    res.memory = {};
    return res;
}
/**
 * Returns a select field
 * @returns {domElement}
 */
function spawnSelect() {
    const res = document.createElement("select");
    res.memory = {};
    return res;
}
function spawnDiv() {
    const res = document.createElement("div");
    res.memory = {};
    return res;
}
/**
 * Returns a BUTTON element
 * @returns {domElemeent}
 */
function spawnBtn() {
    const res = document.createElement("button");
    res.memory = {};
    return res;
}
//TODO: Increase capabilities of this function using keymatching, iterating through the object, checking for hollow elements.
/**
 * Function to compare objects
 * @param {Object} a
 * @param {Object} b
 * // @param {true | false} emptyStrict Whether the existance of an empty field on one object, and the
 * @returns {true|false}
 */
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
/**
 * This is a simple, *insecure* hash that's short, fast, and has no dependencies.
 * For algorithmic use, where security isn't needed, it's way simpler than sha1 (and all its deps)
 * or similar, and with a short, clean (base 36 alphanumeric) result.
 * Loosely based on the Java version; see
 * https://stackoverflow.com/questions/6122571/simple-non-secure-hash-function-for-javascript
 *
 * This function is currently used to throw the right events to scroll the other rows.
*/
const simpleHash = (str) => {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        const char = str.charCodeAt(i);
        hash = (hash << 5) - hash + char;
        hash &= hash; // Convert to 32bit integer
    }
    return new Uint32Array([hash])[0].toString(36);
};
/**
 * Function that darkens the screen at a given zindex. Moves it up if the current index is below the argument, or deletes it if remove is true
 * @param {int} index At what z-index to spawn it
 * @param {true|false} remove Whether it should be removed
 */
function zDarkner(index, remove = false) {
    if (!remove) {
        if (darkenedScreenElement == null) {
            const darkener = document.createElement("div");
            document.body.append(darkener);
            darkener.classList.add("tt-darkener");
            darkenedScreenElement = darkener;
            //Style it
            darkener.style.opacity = "0.35";
            darkener.style.zIndex = index;
            darkener.style.pointerEvents = "none";
        }
        else {
            //Only do something if the index is bigger than the current one
            if (darkenedScreenIndex < parseFloat(index)) {
                darkenedScreenElement.style.zIndex = index;
            }
            darkenedScreenElement.style.opacity = "0.35";
        }
    }
    else {
        if (darkenedScreenElement != undefined) {
            darkenedScreenElement.style.opacity = "0";
            darkenedScreenIndex = 0;
        }
    }
}
/**
 * Either blocks the body or unlocks it
 * @param {true|false} block
 */
function blockBody(block = true) {
    if (block) {
        document.body.style.overflow = "hidden";
    }
    else {
        document.body.style.overflow = "auto";
    }
}
/**
 * Returns true if the current input is valid
 * @returns {true|false}
 */
function validPerc(closeValue) {
    var regex = /^[a-zA-Z]+$/;
    if (closeValue == undefined ||
        closeValue == "" ||
        closeValue.match(regex) != null ||
        parseFloat(closeValue) < 0 ||
        parseFloat(closeValue) > 100) {
        console.log("La percentuale:", closeValue, "non va bene INT:", parseFloat(closeValue));
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
function changeVisible(element, visible, stateProperties = []) {
    console.log(element, "HWHW");
    if (visible == true) {
        element.classList.add("visible");
        element.classList.remove("hidden");
    }
    else {
        element.classList.add("hidden");
        element.classList.remove("visible");
    }
    stateProperties.forEach(property => {
        property = visible;
    });
}
//USER PREFERENCES
//The user can add trades (logs) of that type. Every tipe has specific features
//Then the user can define views using the available fields inside the available types
//The user can add a new type, and he can
const userPrefs = {
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
                    spawners: {},
                    selected: "default",
                    layouts: {
                        //If an element is not fixed, then it will be able to scroll
                        //Which elements get rendered? Check "availableFields"
                        //If fixed is true, then the size 
                        default: [
                            { fixed: true, size: "10%", elements: ["1", "2", "3"], nElements: [] },
                            {
                                fixed: false,
                                size: "80%",
                                elements: ["7", "6", "9", "8", "11", "12", "4", "13", "5", "14", "u1", "15"],
                                nElements: []
                            },
                            {
                                fixed: true,
                                size: "10%",
                                elements: ["b1", "b2", "b3"],
                                nElements: []
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: [
                                    "1",
                                    "2",
                                    "3",
                                    "7",
                                    "6",
                                    "9",
                                    "8",
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
                                elements: [],
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
                            { fixed: true, size: "10%", elements: ["1", "2", "3"], nElements: [] },
                            {
                                fixed: false,
                                size: "80%",
                                elements: ["12", "6", "9", "8", "11", "7", "4", "13", "5", "14", "u1", "15"],
                                nElements: []
                            },
                            {
                                fixed: true,
                                size: "10%",
                                elements: ["b1", "b2", "b3"],
                                nElements: []
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: [
                                    "1",
                                    "2",
                                    "3",
                                    "7",
                                    "6",
                                    "9",
                                    "8",
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
                                elements: [],
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
            modifiers: [],
            computed: [],
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
    },
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
            totalCost(row, directive) {
            }
        },
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
    const result = {};
    for (const [key, value] of Object.entries(userPrefs.sortings.categories.blocks)) {
        result[key] = value.variations;
    }
    return result;
}
function buildDefaultUserFields() {
    const res = {};
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
const currentKeys = Object.keys(new TradeObj({}));
const defaultFields = {
    "0": {
        name: "legend",
        render: "true",
        default: "",
        type: "input",
        subtype: "locked",
        modifiers: [],
        computed: [],
        description: "Fixed text field - shows the text which it's given as value",
        placeholder: "",
        columnName: "Legend?",
    },
    "00i": {
        name: "id",
        render: "false",
        default: "0",
        type: "input",
        subtype: "number",
        modifiers: [],
        computed: [],
        description: "Id of the trade from our database. Autoincremented by the backend",
        placeholder: "",
        columnName: "DB Id",
    },
    "00p": {
        name: "pseudo_id",
        render: "false",
        default: "0",
        type: "input",
        subtype: "number",
        modifiers: [],
        computed: [],
        description: "Used for linear access. If the trade comes from the database, equal to the trade id. Otherwise, adjusted in the frontend to signify closedness etc.",
        placeholder: "",
        columnName: "Pseudo Id",
    },
    "00b": {
        name: "order_id",
        render: "false",
        default: "0",
        type: "input",
        subtype: "number",
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        computed: [],
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
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        computed: [],
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
        modifiers: [],
        computed: [],
        description: "if -1, the trade is not closed, otherwise it's the id of the trade to which this is a partial close",
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
        modifiers: [],
        computed: [],
        description: "Contains IDs of partial closes of this trade. When this trade is partially closed, this field obtains the id of the first partial close",
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
        computed: [],
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
        computed: [],
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
        computed: [],
        description: "Desc",
        placeholder: "",
        columnName: "Current Price",
    },
    "juf": {
        name: "json_user_fields",
        //Default synced with List match function and list builder
        render: "false",
        default: "{}",
        type: "input",
        subtype: "JSON",
        modifiers: [],
        computed: [],
        description: "Gets parsed to all the user fields as value. When the trade is saved all the user field data gets jsonized in here",
        placeholder: "",
        columnName: "Json User Fields",
    },
    "b1": {
        name: "save",
        render: "true",
        default: "Save",
        type: "button",
        subtype: "save",
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
        modifiers: [],
        computed: [],
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
    const res = Object.assign(Object.assign({}, defaultFields), userPrefs.customFields);
    return res;
};
/**
 * * Crucial that returns the name of a specific field given its identifier
 * - Use: Lets you change names based on db with a single text change in the userfields property
 * @param {string} identifier Id of the available fields property
 * @returns {string} Name in the database
 */
////////////////////
// Tables Section //
////////////////////
const gin = (identifier) => {
    const availableFields = availableFieldsGen();
    if (availableFields.hasOwnProperty(identifier)) {
        return availableFields[identifier].name;
    }
    else {
        console.error("Accessing non-existing/undefined tag with gin:", identifier, availableFields, "\n Bad indexing happening");
        return gin("0");
    }
};
class Table {
    /**
     *
     * @param {domElement} parent Literally where to render the table
     * @param {Row[]} originalChildrenArray array of rows.
     * @param {TradeWindow} tradeWindowRef used to reference high-up from rows
     */
    constructor(parent, originalChildrenArray = [], tradeWindowRef) {
        this.parent = parent;
        this.target = "";
        this.tradeWindowRef = tradeWindowRef;
        //
        const tableProps = this.c_sortChildren(originalChildrenArray);
        //Increasing order by id
        this.sortedChildren = tableProps[0];
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
        };
    }
    //Sorry algorithm lord
    c_sortChildren(childArray) {
        const byIdObj = {};
        //Sort in increasing order
        //TODO: Adapt this to sort by pseudoId in case it's not already doing it.
        const sortedArr = childArray.sort(function (rowA, rowB) {
            return parseFloat(rowA.origin[gin("00i")]) - parseFloat(rowB.origin[gin("00i")]);
        });
        for (let i = 0; i < childArray.length; i++) {
            const children = childArray[i];
            byIdObj[children.origin[gin('00p')]] = children;
            children.changeTableReference(this);
        }
        return [sortedArr, byIdObj];
    }
    renderTable() {
        //STYLEME
        const table = document.createElement("div");
        table.classList.add("trade-table");
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
        controllerBox.classList.add("table-bottom-controller");
        if (this.target != "") {
            ////////////
            //PAGE MOVER
            const holder = document.createElement("div");
            this.target.append(controllerBox);
            holder.classList.add("page-mover-holder");
            const moveForward = document.createElement("button");
            moveForward.innerHTML = "&rarr;";
            const moveBackward = document.createElement("button");
            moveBackward.innerHTML = "&larr;";
            const currentPage = document.createElement("input");
            currentPage.value = this.currentPage.toLocaleString();
            holder.append(moveBackward, currentPage, moveForward);
            this.controllerBox.pageMover = {
                holder,
                currentPage,
                moveBackward,
                moveForward,
            };
            controllerBox.append(holder);
            moveForward.addEventListener("click", (e) => { this.pageForward(); });
            moveBackward.addEventListener("click", (e) => { this.pageBackward(); });
        }
        else {
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
        this.refreshPages();
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
        }
        else {
            const lastTradePosition = this.sortedChildren.indexOf(this.pagedTrades()[0]);
            this.currentPage = Math.floor(lastTradePosition / userPrefs.rowsPerPage) + 1;
        }
        //Update the controller and which trades should be shown
        this.refreshCurrentPageVisibility();
        this.refreshPageController();
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
                if (element.state.mainRow != "") {
                    element.state.paged = true;
                    element.state.mainRow.classList.add("visible");
                    element.state.mainRow.classList.remove("hidden");
                }
                else {
                    console.error("The row which has been tried to page is currently not rendered");
                }
            }
            else {
                if (element.state.mainRow != "") {
                    element.state.paged = false;
                    element.state.mainRow.classList.remove("visible");
                    element.state.mainRow.classList.add("hidden");
                }
                else {
                    console.error("The row which has been tried to page is currently not rendered");
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
            currentPage.value = this.currentPage.toLocaleString();
            currentPage.min = newMin.toLocaleString();
            currentPage.max = newMax.toLocaleString();
            console.log(newMax, newMin);
            if (this.currentPage == newMin) {
                if (this.controllerBox.pageMover.moveBackward != "") {
                    this.controllerBox.pageMover.moveBackward.classList.add("disabled");
                    this.controllerBox.pageMover.moveBackward.disabled = true;
                }
                else {
                    console.error("Page controller moveBackward is not defined");
                }
            }
            else {
                if (this.controllerBox.pageMover.moveBackward != "") {
                    this.controllerBox.pageMover.moveBackward.classList.remove("disabled");
                    this.controllerBox.pageMover.moveBackward.disabled = false;
                }
            }
            if (this.currentPage == newMax) {
                if (this.controllerBox.pageMover.moveForward != "") {
                    this.controllerBox.pageMover.moveForward.classList.add("disabled");
                    this.controllerBox.pageMover.moveForward.disabled = true;
                }
            }
            else {
                if (this.controllerBox.pageMover.moveForward != "") {
                    this.controllerBox.pageMover.moveForward.classList.remove("disabled");
                    this.controllerBox.pageMover.moveForward.disabled = false;
                }
            }
        }
        else {
            console.error("currentPage HTMLinput controller is not rendered/not saved in the obj properties");
        }
    }
    pageForward(numberOfPages = 1) {
        const reversedArray = [...this.sortedChildren].reverse();
        if (reversedArray.slice((this.currentPage - 1 + numberOfPages) * userPrefs.rowsPerPage, ((this.currentPage + numberOfPages) * userPrefs.rowsPerPage) - 1).length == 0) {
            //There are no trades on that page
            return false;
        }
        else {
            this.currentPage += numberOfPages;
            if (this.currentPage > this.currentPageMax) {
                this.currentPage = this.currentPageMax;
            }
            //A bit overkill,  but at least we know that we are refreshing all of what we need in the controller in case of future animations
            this.refreshPageController();
            //Standard again
            this.refreshCurrentPageVisibility();
            return true;
        }
    }
    pageBackward(numberOfPages = 1) {
        const reversedArray = [...this.sortedChildren].reverse();
        if ((this.currentPage - 1 - numberOfPages) < 0 || reversedArray.slice((this.currentPage - 1 - numberOfPages) * userPrefs.rowsPerPage, ((this.currentPage - numberOfPages) * userPrefs.rowsPerPage) - 1).length == 0) {
            //There are no trades on that page
            return false;
        }
        else {
            this.currentPage -= numberOfPages;
            if (this.currentPage < this.currentPageMin) {
                this.currentPage = this.currentPageMin;
            }
            this.refreshPageController();
            this.refreshCurrentPageVisibility();
            return true;
        }
    }
    /**
     * Defaults to return the trades of the current page.
     * @returns Reference to the trades of the given page
     */
    pagedTrades(page = this.currentPage) {
        return this.sortedChildren.slice((page - 1) * userPrefs.rowsPerPage, (page * userPrefs.rowsPerPage) - 1);
    }
    //TODO: More on these
    /**
     * Function to add a children to the table elements
     * - This works only if the array was previously sorted low to high
     * @param {Row[]} children List of rows to push
     * @param {boolean} fresh Whether the element is new (has the highest id) or older (has a lower id)
     */
    pushChildren(children, fresh = true) {
        //STYLEME 
        //?? I don't know whether I need to change the order here or somewhere else.
        children.forEach((child) => {
            child.changeTableReference(this);
            this.children[child.origin[gin("00p")]] = child;
            //Sort in the sortedChildern array - which is already sorted from the bottom
            //If the array is empty, or the element has a bigger id than the last, just put it there. Otherwise find the one which is bigger
            //TODO: Sort better based on pseudoId
            if (this.sortedChildren.length < 1 ||
                parseFloat(this.sortedChildren[this.sortedChildren.length - 1].origin[gin("00i")]) <= parseFloat(child.origin[gin("00i")])) {
                this.sortedChildren.push(child);
            }
            else {
                for (let index = 0; index < this.sortedChildren.length; index++) {
                    //> makes sure that trades with the same ids (closes) are still pushed to the last point of the sorted array
                    //If the list is empty, push the trade no matter what
                    if (parseFloat(this.sortedChildren[index].origin[gin("00i")]) >
                        parseFloat(child.origin[gin("00i")])) {
                        //Shift the array forward and push this element
                        this.sortedChildren.splice(index, 0, child);
                        //Finish the loop
                        //RISKY IF ANYTHING IS CHANGED, COULD INFINITE LOOP
                        index = this.sortedChildren.length;
                    }
                }
            }
            child.renderRow();
            this.currentPageMax = Math.floor(this.sortedChildren.length / userPrefs.rowsPerPage) + 1;
        });
        this.refreshPages();
        //? Later make old blocks render "in blocks" and so follow an ordering process.
    }
    dropChildren(children) {
        children.forEach((child) => {
            //When the db is called, the pseudoids vanish, and also get edited
            delete this.children[child.origin[gin("00p")]];
            this.currentPageMax = Math.floor(this.sortedChildren.length / userPrefs.rowsPerPage) + 1;
            //todo: optimize this, could be moved below
            this.sortedChildren.filter((element) => {
                element.origin[gin("00p")] != child.origin[gin("00p")];
            });
        });
        this.refreshPages();
    }
}
class TradeWindow {
    constructor(holder) {
        this.holder = holder;
        this.tables = {};
        this.allRows = [];
        //Linear access
        this.allRowsObj = {};
        this.sortings = userPrefs.sortings;
        this.selectedSorting = userPrefs.sortings[userPrefs.selectedSorting];
        //DB column that is getting tag-checked
        this.columnTarget = "";
        //Tags are the elements to look for in the trade column
        // {tag: "equity", logical: "equal"}
        this.refSortingTags = [];
        //Parent styling
        holder.classList.add("tt-trade-window");
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
        this.selectedSorting = this.sortings[userPrefs.selectedSorting];
        if (typeof this.selectedSorting === "string") {
            console.error("Bad selection of sorting, currently selected an informational field:", this.selectedSorting, userPrefs.selectedSorting);
        }
        else {
            this.columnTarget = this.selectedSorting.targets;
            this.refSortingTags = [];
            for (const blockObj of Object.values(this.selectedSorting.blocks)) {
                //The list
                this.refSortingTags.push({
                    tag: blockObj.tag,
                    logical: blockObj.tagLogical,
                    trades: this.filterTrades({
                        tag: blockObj.tag,
                        logical: blockObj.tagLogical,
                        trades: []
                    }, this.allRows),
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
        });
    }
    /**
     * Filters trade for tradesList generation through updateSortingInfo.
     * Also adds trades to o(n) object array - used ALI partial close rows rendering to find the parent trade
     * @param {{tag: string, logical: string, trades: Row[] }} tagObj
     * @returns
     */
    filterTrades(tagObj, rows) {
        switch (tagObj.logical) {
            //TODO add other cases
            case "equal":
            default:
                return rows.filter((row) => {
                    this.allRowsObj[row.origin[gin("00p")]] = row;
                    if (row.origin[this.columnTarget] == tagObj.tag) {
                        return true;
                    }
                });
        }
    }
    sortAndTableTrades(trades) {
        //We need to push this here to
        this.allRows = this.allRows.concat(trades);
        this.refSortingTags.forEach((tagObj) => {
            let correctTrades = this.filterTrades(tagObj, trades);
            tagObj.trades = tagObj.trades.concat(correctTrades);
            this.tables[tagObj.tag].pushChildren(correctTrades);
        });
    }
    dropTrades(trades) {
    }
}
// When a value is clicked, the "newInput" event is dispatched. 
// The dom target must be adapted to contain such listener
class Expander {
    constructor(newDomTarget, type, activeRow = "") {
        this.activeRow = "";
        this.currentFormat = "lister";
        //The dom target is the element which the lister has effect on
        this.currentDomTarget = newDomTarget;
        this.activeRow = activeRow;
        this.element = document.createElement("div");
        this.element.classList.add("tt-expander");
        this.element.classList.add("hidden");
        this.state = {
            visible: false,
            position: {
                currentX: -1,
                currentY: -1
            }
        };
        this.changeFormat(type);
        document.body.append(this.element);
    }
    changeFormat(newFormat) {
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
        console.log("SHOWING", this.element);
    }
    //Moves the expander to the current target by default, or another input/select if passed
    moveAndResizeTo(target = this.currentDomTarget) {
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
    fill(content) {
        // The content type determines how the listerObj list is interpreted
        if (this.currentFormat == "lister") {
            //Todo: Check that the content type matches the expander type
            this.element.textContent = "";
            let empty;
            if (content.length == 0) {
                empty = spawnDiv();
                empty.innerHTML = "No results";
                empty.classList.add("empty-block");
                this.element.append(empty);
            }
            else {
                const orderedListByTag = [...content].sort((a, b) => a.tag.localeCompare(b.tag));
                // Print a divider based on tag
                for (let index = 0; index < orderedListByTag.length; index++) {
                    //Separate the elements with different tags
                    /*ideas:
                        - Make the paragraph cliccable and show only the trades with that specific
                    */
                    //Check if a tag separator is needed and print it
                    let tagSeparator, clickableValue;
                    if (index == 0) {
                        //HERE: we don't print anything if the first tag is empty. Which is unlikely, but whatever
                        if (orderedListByTag[index].tag != "") {
                            tagSeparator = spawnDiv();
                            tagSeparator.innerHTML = orderedListByTag[index].tag;
                            this.element.append(tagSeparator);
                        }
                    }
                    else if (orderedListByTag[index].tag != orderedListByTag[index - 1].tag) {
                        tagSeparator = spawnDiv();
                        tagSeparator.innerHTML = orderedListByTag[index].tag;
                        this.element.append(tagSeparator);
                    }
                    tagSeparator === null || tagSeparator === void 0 ? void 0 : tagSeparator.classList.add("tag-separator");
                    clickableValue = spawnDiv();
                    clickableValue.classList.add("clickable-value");
                    this.element.append(clickableValue);
                    //Give it activation properties
                    clickableValue.innerHTML = orderedListByTag[index].value;
                    clickableValue.realValue = Object.assign({}, orderedListByTag[index]);
                    console.log(clickableValue);
                    //Click event
                    clickableValue.addEventListener("click", (e) => {
                        var _a;
                        //Dispatch an event to the field to edit everything
                        const newInputEvent = new CustomEvent("newInput", { detail: { inputValue: clickableValue.realValue } });
                        this.currentDomTarget.dispatchEvent(newInputEvent);
                        //Now change the inner value of the linked field
                        this.currentDomTarget.value = (_a = clickableValue.realValue) === null || _a === void 0 ? void 0 : _a.value;
                    });
                }
            }
        }
        else if (this.currentFormat == "moreOptions") {
            // Let the id refer to the 
            this.element.textContent = "";
            let empty = spawnDiv();
            if (content.length == 0) {
                empty.innerHTML = "No options available";
                empty.classList.add("empty-block");
                this.element.append(empty);
                console.error("No directive given when generating moreOptions expander");
            }
            else {
                //Get to promptDefaults and check whether the required directives are available
                const selectedButtons = [];
                //A lot of error management, more of an excercise than anything.
                //The big part of error management has to be done in the creation of userPrefs
                if (userPrefs.promptDefaultsDirectives.hasOwnProperty(content[0].id)) {
                    const directive = userPrefs.promptDefaultsDirectives[content[0].id];
                    if (userPrefs.promptDefaults.hasOwnProperty(directive.templateName)) {
                        if (directive.variations.hasOwnProperty(directive.selected)) {
                            const selected = directive.variations[directive.selected];
                            //Not empty checking
                            selected.forEach(element => {
                                //@ts-ignore
                                selectedButtons.push(userPrefs.promptDefaults[directive.templateName][element]);
                            });
                        }
                        else {
                            console.error(`Selected directive for ${content[0].id} has no match in its variations`);
                        }
                    }
                    else {
                        console.error("Associated templateName has no match in userPrefs/promptDefaults");
                    }
                }
                else {
                    console.error("Given directive has no match in userPrefs/promptDefaultsDirectives");
                }
                if (selectedButtons.length == 0) {
                    empty.innerHTML = "No options available";
                    empty.classList.add("empty-block");
                    this.element.append(empty);
                    console.error("Directive given, but no results from userPrefs");
                }
                else {
                    selectedButtons.forEach(button => {
                        const newBtn = spawnBtn();
                        newBtn.classList.add("new-button");
                        if (button.attachedNumber == "0") {
                            newBtn.classList.add("quick-spawn");
                        }
                        else if (button.attachedNumber == "1") {
                            newBtn.classList.add("main");
                        }
                        this.element.append(newBtn);
                        newBtn.innerHTML = button.text;
                        newBtn.addEventListener("click", (e) => {
                            //Dispatch an event to the field to edit everything
                            const newInputEvent = new CustomEvent("directive", { detail: { type: button.attachedNumber, attachedObj: button.attachedObj } });
                            this.currentDomTarget.dispatchEvent(newInputEvent);
                        });
                    });
                }
            }
        }
    }
    ;
}
class Row2 {
    constructor(data, legend = false) {
        /**
                 * Function that sets the field to an editing state and adds the item to the editingList
                 * - for lists only the main property is being tracked
                 * @param {"string"} fieldName The name of the field
                 */
        this.setEditing = (fieldName) => {
            this.structure[fieldName].editing = true;
            //Adding to the fieldholder for buttons
            this.structure[fieldName].target.memory.fieldHolder.classList.add("editing");
            this.state.editing = true;
            this.state.editingList.push(fieldName);
        };
        /**
         * Function that removes the field from an editing state and if the edittinglist is empty REMOVES the editing state
         * - for lists only the main property is being tracked
         * @param {"string"} fieldName The name of the field
         */
        this.removeEditing = (fieldName) => {
            this.structure[fieldName].editing = false;
            this.structure[fieldName].target.memory.fieldHolder.classList.remove("editing");
            this.state.editingList = this.state.editingList.filter((item) => item !== fieldName);
            if (this.state.editingList.length == 0) {
                this.state.editing = false;
            }
        };
        /**
         * OPERATES ON THE CURRENT AND ORIGIN PROPERTIES
         * - Changes a value of the
         * @param {*} value The value to change it to
         * @param {string| -1} target If -1 makes the current object identical to the origin one, if 1 the opposite
         */
        this.updateCurrent = (value = "", target) => {
            if (target == -1) {
                this.current = Object.assign({}, this.origin);
            }
            else if (target == 1) {
                this.origin = Object.assign({}, this.current);
            }
            else {
                this.current[target] = value;
            }
            //DEBUG
            // Prints the current objects for the "test" row clearly in another div
            const curPrint = document.querySelector(".current");
            const oriPrint = document.querySelector(".origin");
            // @ts-ignore
            curPrint.innerHTML = JSON.stringify(this.current);
            // @ts-ignore
            oriPrint.innerHTML = JSON.stringify(this.origin);
            //DEBUG
        };
        /**
         * Function to prompt a close event. Takes no argument because it acts on the row itself
         */
        this.closePrompt = () => {
            // Needed for ease of managing events below (onclose)
            const rowRef = this;
            //STYLEME
            //This is the container for everything
            const promptBox = document.createElement("div");
            promptBox.dataset.visible = "true";
            promptBox.classList.add("tt-prompt-box");
            promptBox.style.zIndex = "11";
            //This is the title of the box
            const promptTitle = document.createElement("h3");
            //This is the description of what the heck you are doing
            const promptDesc = document.createElement("div");
            //This box is used to manually send the amout - BIG ON DESKTOP, SMALL ON MOBILE
            const inputBox = document.createElement("input");
            inputBox.setAttribute("type", "number");
            inputBox.setAttribute("max", "100");
            inputBox.setAttribute("min", "0");
            //These buttons are used to autofill the element - BIG ON MOBILE SMALL ON DESKTOP
            const inputButtonArray = document.createElement("div");
            //Add a close button
            const closeBtn = document.createElement("button");
            closeBtn.innerHTML = "Close this";
            //Spawn the buttons that the user wanted to have as preference
            for (const value of Object.values(userPrefs.promptDefaults.closePrompt)) {
                const button = document.createElement("button");
                button.innerHTML = value.text;
                //Onclick edit the input field
                button.onclick = function () {
                    inputBox.value = value.attachedNumber.toLocaleString();
                };
                //STYLEME Just be cautious with this order property
                button.style.order = value.attachedNumber.toLocaleString();
                //Append it
                inputButtonArray.append(button);
            }
            // If on mobile we need an ok button, but the event will be fired also on Enter click
            const enterButton = document.createElement("button");
            enterButton.innerHTML = "Enter";
            //Where you show errors when they arise
            const errorBox = document.createElement("div");
            //Used to show basic information, like the key to press
            const infoBox = document.createElement("div");
            //Fill the thingy
            promptBox.append(promptTitle, promptDesc, inputBox, inputButtonArray, enterButton, closeBtn, errorBox, infoBox);
            document.body.append(promptBox);
            //FOcus on the field
            inputBox.focus();
            //Block the scrolling
            blockBody();
            //Darken the background - we pass an index below the promptbox one. Here TEN
            zDarkner("10");
            //Bind the meaning to the closebutton of the box
            closeBtn.onclick = function () {
                blockBody(false);
                zDarkner("0", true);
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
            //Function below runs function above
            window.addEventListener("keyup", function (event) {
                // Number 13 is the "Enter" key on the keyboard
                if (event.key === "13") {
                    // Cancel the default action, if needed
                    event.preventDefault();
                    // Trigger the button element with a click
                    enterButton.click();
                }
                if (event.key === "Escape") {
                    event.preventDefault();
                    closeBtn.click();
                }
            });
            // window.addEventListener("click", function (event) {
            // 	if (promptBox.dataset.visible == "true" && event.target != promptBox) {
            // 		console.log("Yooooo")
            // 		closeBtn.click();
            // 	}
            // });
            function submitClose() {
                const closeValue = inputBox.value;
                //Error checking
                if (!validPerc(closeValue)) {
                    errorBox.innerHTML = "Choose a percentage between 1 and 100";
                }
                else {
                    let partial = true;
                    //If we are closing 100% then don't spawn a new trade
                    if (closeValue == "100") {
                        partial = false;
                    }
                    const result = rowRef.close(partial, closeValue);
                    if (result == false) {
                        errorBox.innerHTML = "Choose a percentage between 1 and 100";
                    }
                    else {
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
            }
        };
        this.deletePrompt = () => {
            //TODO - COMPLETE
            //Database stuff
            const fetch = true;
            //...
            //Drop from every list, then remove
            if (fetch) {
                //SAY THAT IF IT HAS CLOSED FIELDS ALSO THOSE WILL BE DELETED
                if (JSON.parse(this.current.closed_list))
                    tradeWindow.allRowsObj; //Continue
            }
            else {
                newAlert({ status: "error", message: "Deleting the trade was unsuccessfull" });
            }
        };
        /**
         * - Function for standard inputs that changes their state to "editing" if the content is different from the origin.
         *@param {{target: {name:string, "//Other dom stuff"}, "//Other event stuff"}} event  Input event
         * Doesn't work for multi-field-editing inputs like the lists
         */
        this.addEditingOnStdInput = (event) => {
            const theProperty = event.target.name;
            if (this.current[theProperty] != this.origin[theProperty]) {
                this.setEditing(theProperty);
            }
            else {
                this.removeEditing(theProperty);
            }
            //Toggle the cancel button
            this.cancelSaveToggler();
        };
        /**
         * Function to change the editing state of an input
         * @param {{target: {name:string, "//Other dom stuff"}, "//Other event stuff"}} event
         */
        this.addEditingOnListInput = (event) => {
            const theProperty = event.target.name;
            const linked = this.structure[theProperty].objLinked;
            //Work on the property
            if (this.current[theProperty] != this.origin[theProperty]) {
                this.setEditing(theProperty);
            }
            else {
                linked.forEach((link) => {
                    if (this.current[link] != this.origin[link]) {
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
        this.close = (partial = false, percentageStr = "100") => {
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
                this.addEditingOnStdInput({ target: { name: "closed" } });
                //GRAPHICAL CHANGES
                //STYLEME
                this.structure[gin("1")].target.innerHTML = "Open";
                // Add the open event listener
                this.structure[gin("1")].target.onclick = this.open;
            }
            else {
                //Edit the fields, create a "complete" partial close, then add a SAVE PROMPT to it
                const availableFields = availableFieldsGen();
                //Create the new trade object
                //Create a new row "percenting" the numerical values of the current one and creating a relative different one
                const percentedNewTrade = Object.assign({}, this.current);
                let index = 1;
                let newPseudoId = `${this.origin[gin("00i")]}c${index}`;
                if (this.state.table == "") {
                    console.error("Table not yet assigned to row while closing it:", this);
                    return false;
                }
                else {
                    while (this.state.table.tradeWindowRef.allRowsObj.hasOwnProperty(newPseudoId)) {
                        newPseudoId = `${this.origin[gin("00i")]}c${index}`;
                        index++;
                    }
                    percentedNewTrade[gin("00p")] = newPseudoId;
                    //00i is the id
                    percentedNewTrade.closed_ref = this.current[gin("00p")];
                    percentedNewTrade.closed = "true";
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
                            this.current[field.name] = (((100 - percentage) / 100) * parseFloat(percentedNewTrade[field.name])).toString();
                            newPartialCloseRow.current[field.name] = ((percentage / 100) * parseFloat(percentedNewTrade[field.name])).toString();
                            //We are reducing the value, so if it were to be reset it would go to 0 - hence the following decision
                            newPartialCloseRow.origin[field.name] = "0";
                            //Add this property to the editing tab
                            this.addEditingOnStdInput({ target: { name: field.name } });
                            newPartialCloseRow.addEditingOnStdInput({ target: { name: field.name } });
                            this.changeValue(field.name, this.structure[field.name].target);
                            newPartialCloseRow.changeValue(field.name, newPartialCloseRow.structure[field.name].target);
                            //Change the field visually
                        }
                        //This was made for future implementation of fields like the closed perc one
                        else if (field.modifiers.includes("closed_relative_increase")) {
                            //Change the values
                            this.current[field.name] +=
                                (100 - parseFloat(this.current[field.name])) * percentage / 100;
                            //Add this property to the editing tab
                            this.addEditingOnStdInput({ target: { name: field.name } });
                            this.changeValue(field.name, this.structure[field.name].target);
                        }
                    });
                    //
                }
                return true;
            }
        };
        /**
         * Function to open the trade and change the style of the button
         */
        this.open = () => {
            //!fixme - looks like the button changes form but the events are not changed from the close button. The name stays the same
            //TODO
            //STYLEME
            this.updateCurrent("false", "closed");
            this.addEditingOnStdInput({ target: { name: "closed" } });
            this.structure[gin("1")].target.innerHTML = "Close";
            //Re-add the close event listener
            this.structure[gin("1")].target.onclick = this.closePrompt;
        };
        //* Row2 keeps the empty fields empty rather than deleting them
        //Fields used to compare changes.
        //TOBETESTED: Depends on the way the database stores the user fields data
        const interpolatedData = this.c_userFieldsInterpolate(data);
        this.origin = Object.assign({}, interpolatedData);
        this.current = Object.assign({}, interpolatedData);
        //State information
        this.state = {
            isLegend: legend,
            table: "",
            parent: "",
            //Keep track of the trade conatiner dom object
            container: "",
            //Keep track of the row itself
            mainRow: "",
            editing: false,
            //For o(1) access of how many elements are being "edited"
            editingList: [],
            manuallyChangedList: this.c_generateManuallyChangedList(this.origin),
            //Used for raising the zindex of a row. The raiser is the element which is currently raising that specific row.
            //Deprecated after change in expander structure
            raiser: "",
            paged: false,
        };
        this.structure = {};
    }
    //* c_ functions are called in the constructor
    //* d_ functions interact with the database
    /**
     * Run in the constuctor. Gets all properties in the json_user_fields column, parses them and adds themo to both the origin and current object.
     * The trade will re-add those properties in here once the trade is getting sent
     */
    c_userFieldsInterpolate(originObject) {
        if (originObject.hasOwnProperty("json_user_fields")) {
            const userFieldData = JSON.parse(originObject.json_user_fields);
            return Object.assign(Object.assign({}, originObject), userFieldData);
        }
        return originObject;
    }
    c_generateManuallyChangedList(comparingObj, basicObj = new TradeObj({})) {
        const result = [];
        for (const [key, value] of Object.entries(comparingObj)) {
            if (value != basicObj[key]) {
                if (result.indexOf(key) == -1) {
                    result.push(key);
                }
            }
            else {
                if (result.indexOf(key) != -1) {
                    result.splice(result.indexOf(key), 1);
                }
            }
        }
        return result;
    }
    /**
     *  To run when assigned to a table. Changes this.state.table and this.parent
     * @param {Table} table Changes the table element of this trade.
     */
    changeTableReference(table) {
        this.state.table = table;
        this.state.parent = table.target;
    }
    /**
     * Given the current userpref sorting, returns the layout based on the important database entry
     * @returns layout
     */
    getLayout() {
        //Mental stuff
        const sortings = userPrefs.sortings;
        const selectedSorting = userPrefs.selectedSorting;
        const sortingTarget = sortings[selectedSorting].targets;
        const thisRowTargetedValue = this.current[sortingTarget];
        //! Meh the below casting
        const associatedBlock = sortings[selectedSorting].blocks[thisRowTargetedValue];
        const selectedLayout = associatedBlock.selected;
        return associatedBlock.layouts[selectedLayout];
    }
    /**
     * * Function that creates a new container and assigns the object the container property
     * @returns {domElement} Returns the container object
     */
    createContainer() {
        const container = document.createElement("div");
        this.state.container = container;
        container.classList.add("trade-container");
        return container;
    }
    /**
     * Function that replaces the given field with a cloned one. Useful for removing event listeners
     * @param {domElement} field The row field to replace
     * @returns {domElemeent} The newly created field with updated memory
     */
    domCloneField(field) {
        //Replace the dom element
        var old_element = field;
        if (instanceOfIF(field)) {
            const new_element = old_element.cloneNode(true);
            new_element.discriminator = "INPUT-FIELD";
            old_element.memory.fieldHolder.replaceChild(new_element, old_element);
            //Add the memory properties to the field which you just created
            new_element.memory = old_element.memory;
            return new_element;
        }
        else if (instanceOfSF(field)) {
            const new_element = old_element.cloneNode(true);
            new_element.discriminator = "SELECT-FIELD";
            old_element.memory.fieldHolder.replaceChild(new_element, old_element);
            //Add the memory properties to the field which you just created
            new_element.memory = old_element.memory;
            return new_element;
        }
        else {
            const new_element = old_element.cloneNode(true);
            new_element.discriminator = "BUTTON-FIELD";
            old_element.memory.fieldHolder.replaceChild(new_element, old_element);
            //Add the memory properties to the field which you just created
            new_element.memory = old_element.memory;
            return new_element;
        }
    }
    /**
     * Toggles the cancel and save button, cancels changes if required and resets all necessary parts
     */
    cancelSaveToggler() {
        const cancelChanges = () => {
            //We don't have to work on "Linked" fields since they only exist in the current object
            this.state.editingList.forEach((changedField) => {
                //Get the fiend which has been changed in the structure property
                console.log(changedField);
                if (isStructObj(this.structure[changedField])) {
                    const fieldStruct = this.structure[changedField];
                    //Use the predefined reset function for each field
                    // @ts-ignore
                    fieldStruct.reset();
                    //We let it change the close value no matter what
                    //Drops field from array & sets all the states to the right "Position"
                    // @ts-ignore
                    this.removeEditing(fieldStruct.name);
                }
                else {
                    console.error("A function name has been added to the editing list and is now being iterated:", this.state.editingList);
                }
            });
            //THIS THING RIGHT HERE SOLVES A LOT OF PROBLEMS
            //Current = ...Origin now
            this.updateCurrent("", -1);
            //Run an iteration of the toggler to "remove" the clickability from the cancel field
            this.cancelSaveToggler();
        };
        const d_saveChanges = async () => {
            try {
                // Put user field changes into the json_user_fields field
                // PseudoId implementation: when a trade with a pseaudoid is saved, get him a real id. Then this id gets changed in the frontend both in the actual row and in all of the linearObjs in tables and tradewindows referring to it
                //Async save changes
                //Edit the pseudoid and other db fields (like the id)
                //Refresh the origin object to mirror the (just modified) current one
                this.updateCurrent("", 1);
                //Cancelchanges will removeEditing, then run the cancelSaveToggler to fix any still active button
                cancelChanges();
            }
            catch (error) {
                //Let the user know something was wrong
            }
        };
        //The editings and checks are being done only on the cancel changes button
        if (this.state.editing) {
            //Add event listener - To prevent multiple firings, we use a checking property when this runs
            if (!this.structure[gin("b2")].hasCancelListener) {
                this.structure[gin("b2")].target.addEventListener("click", cancelChanges, true);
                this.structure[gin("b1")].target.addEventListener("click", d_saveChanges, true);
                this.structure[gin("b2")].target.classList.remove("disabled-btn");
                this.structure[gin("b1")].target.classList.remove("disabled-btn");
                this.structure[gin("b2")].hasCancelListener = true;
            }
            //Make it clickable
            //TODO: Implement better looking disabled/enabled transitions
            this.structure[gin("b2")].target.disabled = false;
            this.structure[gin("b1")].target.disabled = false;
        }
        else {
            //Remove event listener
            const noEventCloseField = this.domCloneField(this.structure[gin("b2")].target);
            const noEventSaveField = this.domCloneField(this.structure[gin("b1")].target);
            //RE-ADD this element to the structure object;
            this.structure[gin("b2")].target = noEventCloseField;
            this.structure[gin("b1")].target = noEventSaveField;
            //TODO: FINISH SAVE CANCEL PARALLELs
            this.structure[gin("b2")].target.classList.add("disabled-btn");
            this.structure[gin("b1")].target.classList.add("disabled-btn");
            //To prevent multiple listening. (Only checked on the cancel button)
            this.structure[gin("b2")].hasCancelListener = false;
            //Remove clickability
            this.structure[gin("b2")].target.disabled = true;
            this.structure[gin("b1")].target.disabled = true;
            //Act on the save button - which works in parallel to the cancel button
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
    getValue(property, target = "current") {
        return this[target].hasOwnProperty(property)
            ? { value: this[target][property], has: true }
            : { value: "", has: false };
    }
    //Value and current object are never not linked. So to update the value of a fieald you must update the current object first
    changeValue(property, target, origin = "current") {
        const availableFields = availableFieldsGen();
        const propertyFieldInstructions = Object.values(availableFields).filter(
        //The lenght of this should be 1
        (field) => field.name == property);
        switch (propertyFieldInstructions[0].type) {
            //Closed will
            case "closed":
                //Sort of test to generalise the "close"/"open" change, but only currently used in the reset function
                //If they are already equal by any chance, don't do anything - won't happen, but better outcome if it does
                if (this.current[property] != this[origin][property]) {
                    //The value gets reset in the close or open function
                    //Depending on the target state, run either function
                    if (this.origin[gin("1")] == "true") {
                        //Close the trade, not spawning a new one and keeping 100 of it
                        this.close();
                    }
                    else {
                        //DEBUG
                        this.open();
                    }
                }
                break;
            default:
                target.value = this.getValue(property, origin).value;
                //					field.value = this.getValue(field.name, "origin").value;
                break;
        }
    }
    /**
     * * Function to spawn an INPUT field
     * @param {int} directive
     * @param {{value: string, has: true | false}} propInfo accessed with this.name of the specified directive
     * - WEIRD BEHIAVIOUR: We give the value before the directive is rendered to enable legend rendering - and also historical referencing
     * @returns {domElement} !ATTENTION! You are getting the container with the field in it, not the "actual input". To access it use the .field property
     */
    spawnField(directive, propInfo) {
        //Get the current available fields;
        const availableFields = availableFieldsGen();
        /**
         * - Function that takes in the event coming from an input event and changes the current object acccrodingly
         * @param {{"//contains a lot of stuff",target:{ ..., value: string}}} event
         */
        const updateOnStdInput = (event) => {
            this.updateCurrent(event.target.value, event.target.name);
        };
        //Pass the two functions from the parent object
        const addEditingOnStdInput = this.addEditingOnStdInput;
        const addEditingOnListInput = this.addEditingOnListInput;
        /**
         * Function to create a structure in the this.structure object for the given std input field
         * @param {domElemeent} field
         * @param {{name: string, render: boolean,default:any,objLinked: [] | string[],"//And more fields which can be found above the defaultfields delcaration"}} directive
         */
        const createStructure = (field, directive) => {
            this.structure[field.name] = {
                target: field,
                editing: false,
                name: field.name,
                //Used for understanding whether it's a button, an user generated element or a normal input
                dirTag: Object.keys(availableFields).find((key) => availableFields[key] === directive),
                hasCancelListener: false,
                //Attributes which this edits as well in the current object
                objLinked: [],
                /**
                 * Function that resets the field to its origin value. Changes based on directive type
                 */
                reset: () => {
                    this.changeValue(field.name, field, "origin");
                },
            };
            //If the field is linked to others, save it here
            if (directive.hasOwnProperty("objLinked") && directive.objLinked != undefined &&
                directive.objLinked.length != 0) {
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
        const buildLister = (targetValue, targetInputHolder, list) => {
            if (instanceOfIF(targetInputHolder.memory.field) || instanceOfSF(targetInputHolder.memory.field)) {
                const listingExpander = new Expander(targetInputHolder.memory.field, "lister");
                //Create the element which contains the available options
                //Set the input value to the right one
                const initialValue = {
                    value: this.current[targetValue],
                    id: this.current[`${targetValue}_id`],
                    tag: this.current[`${targetValue}_tag`],
                };
                targetInputHolder.memory.field.value = initialValue.value;
                /**
                 * Sets the current value to a given valid element
                 * @param {{id: -1 | number, value: string, tag: "" | string}} matchedInput
                 * @param {"current" | "origin"} directive where to "aim the change". Used for INITIAL setup
                 */
                const updateOnInput = (matchedInput) => {
                    //Update the current element
                    this.updateCurrent(matchedInput.value, targetValue);
                    this.updateCurrent(matchedInput.id, `${targetValue}_id`);
                    this.updateCurrent(matchedInput.tag, `${targetValue}_tag`);
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
                function listMatch(list, specValue) {
                    if (typeof specValue == "string") {
                        const newList = list.filter((element) => {
                            console.log("---", element);
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
                function listBrowse(list, value) {
                    const newList = list.filter((element) => {
                        return element.value.toLowerCase().includes(value.toLowerCase());
                    });
                    return newList;
                }
                targetInputHolder.memory.field.addEventListener("input", function (e) {
                    //RUNTIME
                    //@ts-ignore
                    if (e.target != null) {
                        const input = targetInputHolder.memory.field.value;
                        //UPDATE
                        console.log("LIST MATCHING WITH:", list);
                        const matchedInput = listMatch(list, input);
                        updateOnInput(matchedInput);
                        //Add editing state
                        addEditingOnListInput(e);
                        //Now filter using that input
                        const availableChoices = listBrowse(list, input);
                        //Show the listing block
                        listingExpander.moveAndResizeTo();
                        listingExpander.fill(availableChoices);
                    }
                    else {
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
                    }
                    else {
                        console.error("Target is null");
                    }
                    //? To be tested: "clickaway method" on the entire holder
                });
                targetInputHolder.memory.field.addEventListener("newInput", ((e) => {
                    listingExpander.hide();
                    const inputValue = e.detail.inputValue;
                    updateOnInput(inputValue);
                    addEditingOnListInput({ target: { name: targetValue } });
                    targetInputHolder.memory.field.value = inputValue.value;
                }));
                window.addEventListener("click", function (event) {
                    if (listingExpander.state.visible == true) {
                        if (event.target != targetInputHolder &&
                            event.target != targetInputHolder.memory.field &&
                            event.target != targetInputHolder.memory.fieldHolder &&
                            event.target != listingExpander.element) {
                            listingExpander.hide();
                        }
                    }
                });
            }
            else {
                console.error("Assigning lister type expander to a button element");
            }
        };
        //Used to hold "excess" elements around the input itself.
        const fieldHolder = spawnDiv();
        fieldHolder.classList.add("field-holder");
        //Declaration of used fields in the process
        let field; //* The ! serves to tell typescript that I WILL define it
        //Put the thing into a variable for easier access
        const dirProperties = availableFields[directive];
        //The type switches between the "structure" of the element to spawn, not its HTML type
        switch (dirProperties.type) {
            case "input":
                //If it's an input do quick adjustments
                field = spawnInput();
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
                field.addEventListener("input", updateOnStdInput);
                field.addEventListener("input", addEditingOnStdInput);
                //Here we cna append it after
                fieldHolder.append(field);
                //Easier access when referencing things in the aftermath (1/2)
                break;
            case "choice":
                switch (dirProperties.subtype) {
                    case "list":
                        //The list type is a type where you get a list of options but the choice is not forced, also you can "write"
                        field = spawnInput();
                        field.discriminator = "INPUT-FIELD";
                        fieldHolder.append(field);
                        fieldHolder.memory.field = field;
                        console.log(">> creating the field$", fieldHolder.memory);
                        //Easier access when referencing things in the aftermath (1/2)
                        //Used in the
                        buildLister(dirProperties.name, fieldHolder, dirProperties.options);
                        console.log("Built lister with", dirProperties.options);
                        break;
                    case "select":
                        field = spawnSelect();
                        field.discriminator = "SELECT-FIELD";
                        //STYLEME
                        if (dirProperties.options != undefined) {
                            //@ts-ignore
                            dirProperties.options[this.current[gin(27)]].forEach((option) => {
                                const optionSelect = document.createElement("option");
                                optionSelect.value = option.value;
                                optionSelect.innerText = option.text;
                                field.append(optionSelect);
                            });
                            //Here we set the value of the select field to its default one
                            field.value = propInfo.value;
                            //The input inplementation works like a charm for this.
                            field.addEventListener("input", updateOnStdInput);
                            field.addEventListener("input", addEditingOnStdInput);
                            fieldHolder.append(field);
                            break;
                        }
                        else {
                            console.error("Missing options in the field directive during field generation", dirProperties, this);
                        }
                }
                break;
            case "closed":
                field = spawnBtn();
                //Make the button into a "closed" string that you cvan click on to reopen the trade.
                if (this.getValue(gin("1")).value == "true") {
                    field.innerHTML = "Open";
                    field.onclick = this.open;
                }
                else {
                    field.innerHTML = "Close";
                    //ADD EVENT LISTENER
                    field.onclick = this.closePrompt;
                }
                fieldHolder.append(field);
                break;
            case "button":
                field = spawnBtn();
                //Set the basic text to the default one provided in the dir object - can be changed later
                field.innerHTML = dirProperties.default;
                //Add it to its own holder
                fieldHolder.append(field);
                switch (dirProperties.subtype) {
                    //The "Default disabling" of the cancel and savebutton is ran after the fields are created in the renderrow FuNCTION
                    //* REMEMBER TO RUN IT IF THE ROW IS GENERATED IN ANOTHER WAY.
                    case "cancel":
                        break;
                    case "save":
                        break;
                    case "delete":
                        field.onclick = this.deletePrompt;
                        break;
                }
                fieldHolder.memory.field = field;
                //PLACEHOLDER
                break;
            //Used for non rendering fields or specific things which are nothing at all
            case "tags":
                //TODO: Create tags input
                field = spawnInput();
                //STYLEME
                field.value = propInfo.value;
                field.setAttribute("placeholder", dirProperties.placeholder);
                fieldHolder.append(field);
                break;
        }
        field.setAttribute("name", dirProperties.name);
        field.classList.add(dirProperties.name);
        //Here we make it easy to access the fields for future changes
        createStructure(field, dirProperties);
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
            mainRow.classList.add("closed-row");
            //Get the container from the origin trade by using its closedRef
            //HIGH UP- not stuck to the current row, may find other ones if needed
            //Possible feature to change
            if (this.state.table == "") {
                console.error("renderRow went wrong, table has not been assigned yet (renderRow) (closed-row)", this);
            }
            else {
                //TODO: Make the ref to the pseudoId and not the Id
                console.log(gin("28"));
                console.log(gin("29"));
                console.log(gin("30"));
                console.log(this.origin[gin("29")], this.state.table.tradeWindowRef.allRowsObj);
                container =
                    this.state.table.tradeWindowRef.allRowsObj[this.origin[gin("29")]].state
                        .container;
                this.state.container = container;
                //Only one append required, unlike normal rows where we are creating a trade container to put the main row in, we simply add the trade row to the main trade pre-existing container
                if (this.state.container == "") {
                    console.error("Table has been assigned, but its container is empty (renderRow) (closed-row)", this, this.state.table.tradeWindowRef.allRowsObj[this.origin[gin("29")]].state.container);
                }
                else {
                    //@ts-ignore
                    container.append(mainRow);
                    //Addin the row to the state of the trade for easier access in the future
                }
            }
        }
        else {
            //STYLEME
            //If the trade is not closed, then either build a new container
            if (this.state.isLegend) {
                mainRow.classList.add("legend-row");
            }
            else {
                mainRow.classList.add("main-row");
            }
            //THE CONTAINER IS "ABOVE" THE MAIN ROW
            if (fresh) {
                //Create the trade box
                //USE: Row and expansion container
                container = this.createContainer();
                container.append(mainRow);
            }
            else {
                if (this.state.container == "") {
                    console.error("The container is empty (renderRow) (re-render of non closed row)", this);
                }
                else {
                    container = this.state.container;
                    container.append(mainRow);
                }
            }
            //Here we are prepending (low to high IDs) the row to the container itself - unlike the closed trades where we only have to append one: row to container
            if (this.state.parent == "") {
                console.error("Parent not defined (renderRow)", this, this.state.parent);
            }
            else {
                this.state.parent.prepend(container);
                if (container == undefined) {
                    console.error("Prepending undefined element (renderRow)", container, this);
                }
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
                (key) => !block.nElements.includes(key) && !block.nElements.includes(key));
            }
            //scrollable
            if (block.fixed) {
                //? DOUBTFUL about how to handle the width property
                section.style.minWidth = block.size;
                section.classList.add("fixed-section");
            }
            else {
                section.style.width = block.size;
                section.classList.add("scrollable-section");
                //Sync Scrolling
                if (this.state.table != "" && this.state.table.target != "") {
                    //Create an hashed event for sections with the same properties
                    //! Possible bug if two sections are identical, but a problem for some intern later.
                    const hashEventCode = simpleHash(JSON.stringify(block));
                    const eventScroll = new CustomEvent(hashEventCode, { detail: { scroll: 0, sender: this.origin.pseudo_id } });
                    this.state.table.target.addEventListener(hashEventCode, ((e) => {
                        if (e.detail.sender != this.origin.pseudo_id) {
                            section.scrollLeft = e.detail.scroll;
                        }
                    }));
                    section.addEventListener("scroll", () => {
                        if (this.state.table != "" && this.state.table.target != "") {
                            eventScroll.detail.scroll = section.scrollLeft;
                            this.state.table.target.dispatchEvent(eventScroll);
                        }
                    });
                }
            }
            //ELEMENTS
            block.elements.forEach((directive) => {
                const fieldInfo = availableFields[directive];
                if (this.state.isLegend) {
                    //Get the info for the specific column
                    //Get the columnname to either the columName defined or the dbName
                    const columnName = fieldInfo.columnName == "" ? fieldInfo.name : fieldInfo.columnName;
                    const hasObj = { value: columnName, has: true };
                    //Get the value for that element
                    //Render based on the 0 field
                    const field = this.spawnField("0", hasObj);
                    section.append(field);
                }
                else {
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
        }
    }
}
////////////
// RUNTIME
function createNewRow(startingObj = new TradeObj({}), separator = "n", forcedProperties = {}) {
    const tradeObj = new TradeObj(startingObj);
    if (tradeWindow.allRows.length != 0) {
        //Set the new id to be the same as the one of the last trade, then create a pseudoId that has format IDnINDEX where the index depends on the amount of just built trades. When they get created, they also get saved and the database sends back to them a new id
        const currentLatest = tradeWindow.allRows[tradeWindow.allRows.length - 1];
        const copiedId = currentLatest.origin[gin("00i")];
        let index = 1;
        let newPseudoId = `${copiedId}${separator}${index}`;
        while (tradeWindow.allRowsObj.hasOwnProperty(newPseudoId)) {
            index++;
            newPseudoId = `${copiedId}${separator}${index}`;
        }
        tradeObj[gin("00p")] = newPseudoId;
        tradeObj[gin("00i")] = copiedId;
        console.log("EEEEE: ", newPseudoId, copiedId);
    }
    for (const [key, value] of Object.entries(forcedProperties)) {
        tradeObj[key] = value;
    }
    //If it's not the first one, then the default "0n1" value will work fine
    //As soon as the thing is sent, then the pseudoId will be changed to match the ID - unless another row has been gathered before it.
    const newRow = new Row2(tradeObj);
    tradeWindow.sortAndTableTrades([newRow]);
}
const tradeWindowTarget = document.querySelector(".new-target");
//Create new tradeewindow
const tradeWindow = new TradeWindow(tradeWindowTarget);
//Add all trades to this tradewindow
//Get trades
//Trasform them into rows
//Push them into the tradewindow
//? User data (user pref) oject generator API?
tradeWindow.buildTables();
//TODO: FINISH HERE
tradesList.forEach(trade => {
    createNewRow(trade);
});
////////////////////////
// Controller Section //
////////////////////////
const controllerBox = document.createElement("div");
controllerBox.classList.add("tt-controller-box");
tradeWindowTarget === null || tradeWindowTarget === void 0 ? void 0 : tradeWindowTarget.prepend(controllerBox);
/////////////////////////
// New Row
const newRowButton = document.createElement("button");
newRowButton.classList.add("new-btn");
newRowButton.innerHTML = "New row";
const newRowOptionExpander = new Expander(newRowButton, "moreOptions");
newRowButton.addEventListener("click", (e) => {
    newRowOptionExpander.show();
    newRowOptionExpander.fill([{
            id: "newRows",
            //Here we chose to put the templatename inside the directives for defaults, so these other two fields cna have other implementations later
            value: "",
            tag: ""
        }]);
});
window.addEventListener("click", function (event) {
    if (newRowOptionExpander.state.visible == true) {
        if (
        // Having ONLY the expander makes this a form of toggle
        event.target != newRowOptionExpander.element &&
            event.target != newRowButton) {
            newRowOptionExpander.hide();
        }
    }
});
newRowButton.addEventListener("directive", ((e) => {
    newRowOptionExpander.hide();
    // { detail: { type: button.attachedNumber, attachedObj: button.attachedObj} }
    // type refers to whether to spawn a trade builder box
    // attachedObj is the default trade to start from
    //0 means new trade, 1 means open builder
    if (e.detail.type == "0") {
        createNewRow(e.detail.attachedObj);
    }
    else if (e.detail.type == "1") {
    }
}));
const spawnNewTradeBuilder = () => { };
controllerBox.append(newRowButton);
////////////////7/////
// Edit User preferences
const editPrefsBtn = document.createElement("button");
controllerBox.append(editPrefsBtn);
editPrefsBtn.classList.add("new-btn");
editPrefsBtn.innerHTML = "Settings";
const mainEditPrefsWindow = document.querySelector(".tt-edit-user-preferences");
if (mainEditPrefsWindow != null) {
    const editPrefsObj = {
        fullActivatorBtn: editPrefsBtn,
        state: {
            visible: false,
            currentPage: "columnsEditor",
        },
        elements: {
            mainWindow: mainEditPrefsWindow,
            closeBtn: mainEditPrefsWindow.querySelector(".close-button"),
            menuBar: mainEditPrefsWindow.querySelector(".menu-bar"),
            pageSection: mainEditPrefsWindow.querySelector(".page-section"),
            pages: {
                columnsEditor: mainEditPrefsWindow.querySelector(".columns-editor"),
                customColumns: mainEditPrefsWindow.querySelector(".custom-columns"),
            }
        },
        showMainTab() {
            changeVisible(this.elements.mainWindow, true, [this.state.visible]);
        },
        hideMainTab() {
            changeVisible(this.elements.mainWindow, false, [this.state.visible]);
        },
        switchPage(newPage) {
            if (this.elements.pages.hasOwnProperty(newPage)) {
                changeVisible(this.elements.pages[this.state.currentPage], false);
                changeVisible(this.elements.pages[newPage], true);
                this.state.currentPage = newPage;
            }
            else {
                console.error("Trying to switch to non-existing preferences page");
            }
        }
    };
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
            if (event.target != editPrefsObj.elements.mainWindow) {
                editPrefsObj.hideMainTab();
            }
        }
    });
}
else {
    console.error("COuldn't find the user preferences menu box");
}
//Notifications
function newAlert(message) {
    // {status: ----, message: ----}
    const alert = document.createElement("div");
    alert.classList.add("tt-alert", `tt-${message.status}`);
    alert.innerHTML = message.message;
    const alertBox = document.querySelector(".tt-alert-box");
    if (alertBox != null) {
        alertBox.append(alert);
        setTimeout(() => {
            alertBox.removeChild(alert);
        }, 3500);
    }
    else {
        console.error("Alert box is undefined: Appending new message is impossible");
    }
}
///* Styling blocks
// Main Rows
document.querySelectorAll(".trade-container .main-row").forEach(mainRow => {
    //Add classes
});
//Closed Rows
document.querySelectorAll(".trade-container .closed-row").forEach(mainRow => {
    //Add classes
});
//Fields
//Field Holders
//# sourceMappingURL=script.js.map