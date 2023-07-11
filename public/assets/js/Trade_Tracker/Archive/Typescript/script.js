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
let debug = false;
class TradeObj {
    constructor(row) {
        this.legend = row.legend || "false";
        this.saved_sorting = row.saved_sorting || row.id || "0";
        this.id = row.id || "0";
        this.pseudo_id = row.pseudo_id || row.id || "0n1";
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
const graphicsLibrary = {
    h3: [],
    description: [],
    input: ["form-control"],
    select: ["form-control"],
    div: [],
    button: ["btn", "btn-sm", "m-1"],
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
    mainBtn: ["btn-primary"],
    spawnerButton: ["spawner-new-button", "btn-primary"],
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
    columnsEditorHolder: [],
    columnsEditorElementsEditorHolder: ["d-flex", "flex-column"],
    columnsEditorSectionDiv: ["mt-5"],
    columnsEditorSelectedField: [],
    columnsEditorAvailableField: ["available-field"],
    columnsEditorBlockedField: [],
    columnsEditorDescriptionText: [],
    columnsEditorPageTitle: [],
    columnsEditorSelectInput: [],
    columnsEditorBlockTitle: [],
    columnsEditorSectionTitle: [],
    columnsEditorInformationText: [],
    columnsEditorShowMoreFieldSelector: [],
    columnsEditorFieldSelectorHolder: [],
    columnsEditorFieldSelectorTitle: [],
    columnsEditorFieldSelectorSubTitle: [],
    columnsEditorFieldSelectorUpDownButton: [],
    columnsEditorFieldSelectorInUse: [],
};
HTMLElement.prototype.agd = function (...classSet) {
    classSet.forEach((index) => {
        this.classList.add(...graphicsLibrary[index]);
    });
};
HTMLElement.prototype.rgd = function (...classSet) {
    classSet.forEach((index) => {
        this.classList.remove(...graphicsLibrary[index]);
    });
};
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
    return "name" in obj && "target" in obj && "editing" in obj && "dirTag" in obj;
}
/**
 * NOT COMPLETE CHECKER OF A TRUECONDITION FOR A COMPFUNC
 *
 * TODO: COMPLETE
 * @param element The element to check
 * @param trueCondition The appropriate truth condition
 * @returns bool
 */
function trueConditionCheck(element, trueCondition) {
    if (trueCondition.dir == "im") {
        return false;
    }
    else {
        switch (trueCondition.type) {
            case "number":
                switch (trueCondition.dir) {
                    case "e":
                        return pf(element) == trueCondition.value;
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
                        return element == trueCondition.value;
                }
                break;
        }
        console.error("trueConditionCheck$ No case catched");
        return false;
    }
}
/**
 * - !!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!
 *
 * INCOMPLETE FUNCTION, DO NOT USE
 */
function applyStrOperator(firstEl, secondEl, operator) {
    console.error("DO NOT CALL THIS FUNCTION, STILL WORK IN PROGRESS");
    return "";
}
function applyNumOperator(firstEl, secondEl, operator) {
    switch (operator) {
        case "+":
            return firstEl + secondEl;
        case "-":
            return firstEl - secondEl;
        case "*":
            return firstEl * secondEl;
        case "i":
            console.error("Trying to operate on two numbers with an ignore operator");
            return 0;
    }
}
//
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
    res.agd("input");
    res.memory = {};
    return res;
}
/**
 * Returns a select field
 * @returns {domElement}
 */
function spawnSelect() {
    const res = document.createElement("select");
    res.agd("select");
    res.memory = {};
    return res;
}
function spawnDiv() {
    const res = document.createElement("div");
    res.agd("div");
    res.memory = {};
    return res;
}
/**
 * Returns a BUTTON element
 * @returns {domElemeent}
 */
function spawnBtn() {
    const res = document.createElement("button");
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
async function truePrompt(text, options = { trueTxt: "Yes" }) {
    const prompt = spawnDiv();
    document.body.append(prompt);
    prompt.agd("promptBox");
    const closeBtn = spawnBtn();
    closeBtn.innerHTML = "✕";
    closeBtn.agd("closeWindowBtn");
    const trueBtn = spawnBtn();
    trueBtn.agd("saveBtn");
    const description = spawnDiv();
    description.agd("h3");
    description.innerHTML = text;
    trueBtn.innerHTML = options.trueTxt;
    prompt.append(closeBtn);
    prompt.append(description);
    prompt.append(trueBtn);
    const result = await new Promise(function (resolve) {
        window.addEventListener("mousedown", function (e) {
            if (e.target != prompt && e.target != trueBtn) {
                prompt.remove();
                resolve(true);
            }
        });
        closeBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(true);
        });
        trueBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(true);
        });
    });
    return result;
}
/**
 *
 * @param text The text to prompt
 * @param options CURRENTLY NOT OPERATIONAL
 * @returns
 */
async function trueFalsePrompt(text, options = { trueTxt: "Yes", falseTxt: "Cancel" }) {
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
    const result = await new Promise(function (resolve) {
        window.addEventListener("mousedown", function (e) {
            if (e.target != prompt && e.target != trueBtn && e.target != falseBtn) {
                prompt.remove();
                resolve(false);
            }
        });
        closeBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(false);
        });
        falseBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(false);
        });
        trueBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(true);
        });
    });
    return result;
}
/**
 *
 * @param text
 * @param options
 * @returns 0 For "don't do anything", 1 For "Save changes", 2 For "Delete changes"
 */
async function trueFalseCancelPrompt(text, options = { trueTxt: "Yes", falseTxt: "No", cancelTxt: "Cancel" }) {
    const prompt = spawnDiv();
    document.body.append(prompt);
    prompt.agd("promptBox");
    const closeBtn = spawnBtn();
    closeBtn.innerHTML = "✕";
    closeBtn.agd("closeWindowBtn");
    const trueBtn = spawnBtn();
    const falseBtn = spawnBtn();
    const cancelBtn = spawnBtn();
    falseBtn.agd("deleteBtn");
    trueBtn.agd("saveBtn");
    cancelBtn.agd("cancelBtn");
    const description = spawnDiv();
    description.agd("h3");
    description.innerHTML = text;
    trueBtn.innerHTML = options.trueTxt;
    falseBtn.innerHTML = options.falseTxt;
    cancelBtn.innerHTML = options.cancelTxt;
    prompt.append(closeBtn);
    prompt.append(description);
    prompt.append(trueBtn);
    prompt.append(cancelBtn);
    prompt.append(falseBtn);
    const result = await new Promise(function (resolve) {
        window.addEventListener("mousedown", function (e) {
            if (e.target != prompt && e.target != trueBtn && e.target != falseBtn) {
                prompt.remove();
                resolve(0);
            }
        });
        closeBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(0);
        });
        cancelBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(0);
        });
        falseBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(2);
        });
        trueBtn.addEventListener("click", function () {
            prompt.remove();
            resolve(1);
        });
    });
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
const simpleHash = (str) => {
    let hash = 0;
    for (let i = 0; i < str.length; i++) {
        const char = str.charCodeAt(i);
        hash = (hash << 5) - hash + char;
        hash &= hash; // Convert to 32bit integer
    }
    return new Uint32Array([hash])[0].toString(36);
};
const isN = (el) => {
    return !isNaN(parseFloat(el));
};
function getFuncName() {
    return getFuncName.caller.name;
}
//For ease of writing where multiple conversion are needed
const pf = parseFloat;
/**
 * Function that darkens the screen at a given zindex. Moves it up if the current index is below the argument, or deletes it if remove is true
 * @param {int} index At what z-index to spawn it
 * @param {true|false} remove Whether it should be removed
 */
function zDarkner(index, remove = false, opacity = "0.35", pointerEvents = false) {
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
        }
        else {
            //Only do something if the index is bigger than the current one
            if (darkenedScreenIndex < parseFloat(index)) {
                darkenedScreenElement.style.zIndex = index;
            }
            darkenedScreenElement.style.opacity = opacity;
        }
        return darkenedScreenElement;
    }
    else {
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
    if (closeValue == undefined || closeValue == "" || closeValue.match(regex) != null || parseFloat(closeValue) < 0 || parseFloat(closeValue) > 100) {
        console.error("La percentuale:", closeValue, "non va bene INT:", parseFloat(closeValue));
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
    if (visible == true) {
        element.classList.remove("hidden");
    }
    else {
        element.classList.add("hidden");
    }
    stateProperties.forEach((property) => {
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
                    selected: "E-Preset 1",
                    layouts: {
                        //If an element is not fixed, then it will be able to scroll
                        //Which elements get rendered? Check "availableFields"
                        //If fixed is true, then the size
                        "E-Preset 1": [
                            { fixed: true, size: "20%", elements: ["1", "2", "3"], activeFormulas: [], nElements: [] },
                            {
                                fixed: false,
                                size: "75%",
                                elements: ["7", "6", "9", "8", "10", "11", "12", "4", "13", "5", "14", "u1", "15"],
                                activeFormulas: ["totalCost"],
                                nElements: [],
                            },
                            {
                                fixed: true,
                                size: "15%",
                                elements: ["b1", "b2", "b3"],
                                activeFormulas: [],
                                nElements: [],
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                activeFormulas: [],
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: ["1", "2", "3", "7", "6", "9", "8", "10", "11", "12", "4", "13", "5", "14", "u1", "15", "b1", "b2", "b3"],
                                elements: [],
                            },
                        ],
                        "E-Preset 2": [
                            { fixed: true, size: "20%", elements: ["3", "2", "1"], activeFormulas: [], nElements: [] },
                            {
                                fixed: false,
                                size: "75%",
                                elements: ["7", "6", "9", "8", "10", "11", "12", "4", "13", "5", "14", "u1", "15"],
                                activeFormulas: ["totalCost"],
                                nElements: [],
                            },
                            {
                                fixed: true,
                                size: "15%",
                                elements: ["b1", "b2", "b3"],
                                activeFormulas: [],
                                nElements: [],
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                activeFormulas: [],
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: ["1", "2", "3", "7", "6", "9", "8", "10", "11", "12", "4", "13", "5", "14", "u1", "15", "b1", "b2", "b3"],
                                elements: [],
                            },
                        ],
                        "E-Preset 3": [
                            { fixed: true, size: "20%", elements: ["3", "2", "1"], activeFormulas: [], nElements: [] },
                            {
                                fixed: false,
                                size: "75%",
                                elements: ["7", "6", "9", "8", "10", "11", "12", "4", "13", "5", "14", "u1", "15"],
                                activeFormulas: ["totalCost"],
                                nElements: [],
                            },
                            {
                                fixed: true,
                                size: "15%",
                                elements: ["b1", "b2", "b3"],
                                activeFormulas: [],
                                nElements: [],
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                activeFormulas: [],
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: ["1", "2", "3", "7", "6", "9", "8", "10", "11", "12", "4", "13", "5", "14", "u1", "15", "b1", "b2", "b3"],
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
                    selected: "OB-Preset 1",
                    layouts: {
                        //If an element is not fixed, then it will be able to scroll
                        //Which elements get rendered? Check "availableFields"
                        //If fixed is true, then the size
                        "OB-Preset 1": [
                            { fixed: true, size: "10%", elements: ["1", "2", "3"], activeFormulas: [], nElements: [] },
                            {
                                fixed: false,
                                size: "80%",
                                elements: ["17", "18", "10", "19", "20", "11", "12"],
                                activeFormulas: ["totalCost"],
                                nElements: [],
                            },
                            {
                                fixed: true,
                                size: "10%",
                                elements: ["b1", "b2", "b3"],
                                activeFormulas: [],
                                nElements: [],
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                activeFormulas: [],
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: ["1", "2", "3", "17", "18", "10", "19", "20", "11", "12", "b1", "b2", "b3"],
                                elements: [],
                            },
                        ],
                        "OB-Preset 2": [
                            { fixed: true, size: "10%", elements: ["1", "2", "3"], activeFormulas: [], nElements: [] },
                            {
                                fixed: false,
                                size: "80%",
                                elements: ["17", "18", "10", "19", "20", "11", "12"],
                                activeFormulas: ["totalCost"],
                                nElements: [],
                            },
                            {
                                fixed: true,
                                size: "10%",
                                elements: ["b1", "b2", "b3"],
                                activeFormulas: [],
                                nElements: [],
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                activeFormulas: [],
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: ["1", "2", "3", "17", "18", "10", "19", "20", "11", "12", "b1", "b2", "b3"],
                                elements: [],
                            },
                        ],
                        "OB-Preset 3": [
                            { fixed: true, size: "10%", elements: ["1", "2", "3"], activeFormulas: [], nElements: [] },
                            {
                                fixed: false,
                                size: "80%",
                                elements: ["17", "18", "10", "19", "20", "11", "12"],
                                activeFormulas: ["totalCost"],
                                nElements: [],
                            },
                            {
                                fixed: true,
                                size: "10%",
                                elements: ["b1", "b2", "b3"],
                                activeFormulas: [],
                                nElements: [],
                            },
                            //0 layouts are holding all the not displayed fields till now
                            //The presence of 0 layouts makes all functions easier to manage since no exception has to be made for these fields.
                            //0 layouts have to be used
                            {
                                fixed: true,
                                size: "0",
                                activeFormulas: [],
                                //This is a list of all the element NOT to include - Made up from all the elements included in the other parts of the row
                                nElements: ["1", "2", "3", "17", "18", "10", "19", "20", "11", "12", "b1", "b2", "b3"],
                                elements: [],
                            },
                        ],
                    },
                },
            },
        },
    },
    rowsPerPage: 10,
    customFields: {
        u1: {
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
                default: ["1", "2"],
            },
        },
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
                                },
                            },
                            {
                                dp: "18",
                                defaults: -1,
                                trueCondition: {
                                    type: "number",
                                    dir: "ge",
                                    value: 0,
                                },
                            },
                            {
                                dp: "17",
                                defaults: -1,
                                trueCondition: {
                                    type: "number",
                                    dir: "ge",
                                    value: 0,
                                },
                            },
                            //100x premium multiplier
                            {
                                dp: "0",
                                defaults: "100",
                                trueCondition: {
                                    type: "number",
                                    dir: "im",
                                    value: 0,
                                },
                            },
                        ],
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
                                },
                            },
                            {
                                dp: "6",
                                defaults: -1,
                                trueCondition: {
                                    type: "number",
                                    dir: "ge",
                                    value: 0,
                                },
                            },
                            {
                                dp: "7",
                                defaults: -1,
                                trueCondition: {
                                    type: "number",
                                    dir: "ge",
                                    value: 0,
                                },
                            },
                        ],
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
                                },
                            },
                            {
                                dp: "32",
                                defaults: -1,
                                trueCondition: {
                                    type: "number",
                                    dir: "ge",
                                    value: 0,
                                },
                            },
                            {
                                dp: "34",
                                defaults: -1,
                                trueCondition: {
                                    type: "number",
                                    dir: "ge",
                                    value: 0,
                                },
                            },
                        ],
                    },
                ],
                operator: {
                    mainOperationStreak: ["+"],
                    subTopicOperation: [[["i"], "+", "*", "*"], [["i"], "+", "*"], ["+"]],
                },
            },
        },
    },
    walletList: [...walletList],
    symbolList: [...symbolList],
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
    Object.values(userPrefs.customFields).forEach((customField) => {
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
    s: {
        name: "saved_sorting",
        render: "false",
        default: "",
        type: "input",
        subtype: "number",
        modifiers: [],
        computed: [],
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
        subtype: "close",
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
    "34": {
        name: "position_holding_fees",
        render: "true",
        default: "",
        type: "input",
        subtype: "number",
        modifiers: ["closed_reduce"],
        computed: [],
        description: "Fees that accumulate through overnight or other sort of means",
        placeholder: "",
        columnName: "Ownership Fees",
    },
    sif: {
        name: "stats_interpolated_fields",
        //Default synced with List match function and list builder
        render: "false",
        default: "{}",
        type: "input",
        subtype: "JSON",
        modifiers: [],
        computed: [],
        description: "Holds the fields which are currently controlled by the stats attribute. Becomes a set in the row object",
        placeholder: "",
        columnName: "Stats interpolated fields",
    },
    juf: {
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
    b1: {
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
    b2: {
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
    b3: {
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
const availableFieldsGen = (prefObj = userPrefs) => {
    const res = Object.assign(Object.assign({}, defaultFields), prefObj.customFields);
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
    constructor(parent, originalChildrenArray = [], tradeWindowRef, tagObj) {
        this.parent = parent;
        this.target = "";
        this.tagObj = tagObj;
        this.tradeWindowRef = tradeWindowRef;
        //
        const tableProps = this.c_sortChildren(originalChildrenArray);
        //Increasing order by id
        this.sortedMainChildren = tableProps[0];
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
            },
        };
    }
    /**
     * Returns an array containing the rows in sorted order and the rows by id.
     * @param childArray The rows coming in
     */
    c_sortChildren(childArray) {
        const byIdObj = {};
        //Sort in INCREASING order
        //The LOWEST sorting gets put first
        //OTHERWISE
        //By sorting from smallest to greates, the smallest gets rendered as the first element, hence pushed to the end
        const mainTrades = [...childArray].filter((row) => row.current[gin("29")] == "-1");
        const sortedArr = mainTrades.sort(function (rowA, rowB) {
            return rowB.state.currentSorting - rowA.state.currentSorting;
        });
        for (let i = 0; i < childArray.length; i++) {
            const children = childArray[i];
            byIdObj[children.current[gin("00p")]] = children;
            children.changeTableReference(this);
        }
        return [sortedArr, byIdObj];
    }
    reorderRows() {
        //We can call sortChildren with ONLY mainRows, reducing loops and getting the same result
        this.sortedMainChildren = this.c_sortChildren(this.sortedMainChildren)[0];
        this.sortedMainChildren.forEach((mainRow) => {
            if (mainRow.state.container != "") {
                mainRow.state.container.style.order = mainRow.state.currentSorting.toString();
            }
            else {
                console.error("Impossible to reorder given row: its container is undefined");
            }
        });
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
            holder.agd("pageMoverHolder");
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
            };
            controllerBox.append(holder);
            moveForward.addEventListener("click", (e) => {
                this.pageForward();
            });
            moveBackward.addEventListener("click", (e) => {
                this.pageBackward();
            });
            currentPage.addEventListener("change", () => {
                //The other functions already check for this, but we avoid a streak of refreshing functions
                if (this.currentPageMin <= parseInt(currentPage.value) && parseInt(currentPage.value) <= this.currentPageMax) {
                    this.currentPage = parseInt(currentPage.value);
                    this.refreshPages();
                }
            });
        }
        else {
            console.error("Trying to append controller to DOM undefined table");
        }
    }
    /**
     * Renders each present row following the sortedMainChildren order
     * @param {bool} refreshLayout Whether we are creating new containers or just refereshing the layout.
     * It works because when we render we take the value from the current object and not the origin one.
     */
    renderRows(refreshLayout = false) {
        this.sortedMainChildren.forEach((row) => {
            row.renderRow(!refreshLayout);
        });
        if (refreshLayout) {
            if (this.activeLegend != "") {
                this.activeLegend.renderRow(false);
            }
            else {
                console.error("Trying to refresh layout of a table without having rendered the legend");
            }
        }
        this.refreshPages();
    }
    renderLegend(information) {
        if (this.activeLegend != "") {
            this.activeLegend.d_delete();
            this.activeLegend = "";
        }
        //Create a legend with properties that satisfy the refSortingTag
        const selectedSortingTarget = userPrefs.sortings[userPrefs.selectedSorting].targets;
        const freshLegendObj = new TradeObj({ legend: "true", id: "-1" });
        switch (information.logical) {
            case "equal":
                freshLegendObj[selectedSortingTarget] = information.tag;
                break;
        }
        const newLegend = new Row2(freshLegendObj, true);
        newLegend.changeTableReference(this);
        newLegend.renderRow();
        this.activeLegend = newLegend;
        return newLegend;
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
            const maxPage = Math.floor(this.sortedMainChildren.length / userPrefs.rowsPerPage) + 1;
            this.currentPage = maxPage;
        }
        else {
            const lastTradePosition = this.sortedMainChildren.indexOf(this.pagedTrades()[0]);
            this.currentPage = Math.floor(lastTradePosition / userPrefs.rowsPerPage) + 1;
        }
        //Update the controller and which trades should be shown
        this.refreshCurrentPageVisibility();
        this.refreshPageController();
        this.updateLegendPosition();
    }
    /**
     * Shows the current page trades based on the sortedMainChildren property of the table, and hides all the rest
     *
     * Important note: When looking for specific trades, the pageVisibility stops being a matter of importance, then the searching function RE-runs this function to re-page the trades correctly
     */
    refreshCurrentPageVisibility() {
        const array = [...this.sortedMainChildren];
        const lowerBound = (this.currentPage - 1) * userPrefs.rowsPerPage;
        const upperBound = this.currentPage * userPrefs.rowsPerPage - 1;
        for (let index = array.length - 1; index >= 0; index--) {
            const element = array[index];
            //TODO: Decide whether to hide the mainRow or the container.
            if (array.length - index - 1 >= lowerBound && array.length - index - 1 <= upperBound) {
                if (element.state.container != "") {
                    element.state.paged = true;
                    const childTrades = JSON.parse(element.current[gin("30")]);
                    childTrades.forEach((id) => {
                        //Backward pagination update. Ran forward when new rows are inserted
                        if (this.tradeWindowRef.allRowsObj.hasOwnProperty(id)) {
                            this.tradeWindowRef.allRowsObj[id].state.paged = true;
                        }
                    });
                    changeVisible(element.state.container, true);
                }
                else {
                    console.error("The container of the row which has been tried to page is currently not rendered");
                }
            }
            else {
                if (element.state.container != "") {
                    element.state.paged = false;
                    const childTrades = JSON.parse(element.current[gin("30")]);
                    childTrades.forEach((id) => {
                        if (this.tradeWindowRef.allRowsObj.hasOwnProperty(id)) {
                            this.tradeWindowRef.allRowsObj[id].state.paged = false;
                        }
                    });
                    changeVisible(element.state.container, false);
                }
                else {
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
            const newMax = this.sortedMainChildren.length != 0 && Math.floor(this.sortedMainChildren.length / userPrefs.rowsPerPage) - this.sortedMainChildren.length / userPrefs.rowsPerPage == 0
                ? this.sortedMainChildren.length / userPrefs.rowsPerPage
                : Math.floor(this.sortedMainChildren.length / userPrefs.rowsPerPage) + 1;
            const newMin = 1;
            this.currentPageMin = newMin;
            this.currentPageMax = newMax;
            currentPage.value = this.currentPage.toString();
            currentPage.min = newMin.toString();
            currentPage.max = newMax.toString();
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
    updateLegendPosition() {
        if (this.activeLegend != "" && this.activeLegend.state.container != "") {
            this.activeLegend.state.currentSorting = this.tradeWindowRef.biggestSorting + 1;
            this.activeLegend.state.container.style.order = this.activeLegend.state.currentSorting.toString();
        }
    }
    pageForward(numberOfPages = 1) {
        const reversedArray = [...this.sortedMainChildren].reverse();
        if (reversedArray.slice((this.currentPage - 1 + numberOfPages) * userPrefs.rowsPerPage, (this.currentPage + numberOfPages) * userPrefs.rowsPerPage - 1).length == 0) {
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
        const reversedArray = [...this.sortedMainChildren].reverse();
        if (this.currentPage - 1 - numberOfPages < 0 ||
            reversedArray.slice((this.currentPage - 1 - numberOfPages) * userPrefs.rowsPerPage, (this.currentPage - numberOfPages) * userPrefs.rowsPerPage - 1).length == 0) {
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
        return this.sortedMainChildren.slice((page - 1) * userPrefs.rowsPerPage, page * userPrefs.rowsPerPage - 1);
    }
    //TODO: More on these
    /**
     * Function to add a children to the table elements
     * - This works only if the array was previously sorted low to high
     * @param {Row[]} children List of rows to push
     * @param {boolean} fresh Whether the element is new (has the highest id) or older (has a lower id)
     */
    pushChildren(children) {
        children.forEach((child) => {
            child.changeTableReference(this);
            this.children[child.current[gin("00p")]] = child;
            //Sort only mainRows. If empty, unshift in the increasing order array. Otherwise find the first row it's bigger of
            if (child.current[gin("29")] == "-1") {
                //SORTING
                if (this.sortedMainChildren.length < 1 || child.state.currentSorting <= this.sortedMainChildren[0].state.currentSorting) {
                    this.sortedMainChildren.unshift(child);
                }
                else {
                    //The worst case scenario now is that the second element is already greater than the coming one
                    //splice puts to the right of the index
                    //The smallest index we can get is 0
                    for (let index = 0; index < this.sortedMainChildren.length; index++) {
                        const element = this.sortedMainChildren[index];
                        if (index == this.sortedMainChildren.length - 1 && child.state.currentSorting >= element.state.currentSorting) {
                            this.sortedMainChildren.push(child);
                            //Loop closure
                            index = this.sortedMainChildren.length;
                        }
                        else {
                            if (child.state.currentSorting < element.state.currentSorting) {
                                this.sortedMainChildren.splice(index, 0, child);
                                //Loop closure
                                index = this.sortedMainChildren.length;
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
                        const partialCloses = JSON.parse(child.current[gin("30")]);
                        partialCloses.forEach((pseudoId) => {
                            //Backwards pagination and rendering
                            if (this.children.hasOwnProperty(pseudoId)) {
                                if (Object.entries(this.children[pseudoId].structure).length == 0) {
                                    this.children[pseudoId].renderRow();
                                    this.children[pseudoId].state.paged = child.state.paged;
                                }
                            }
                        });
                    }
                }
                else {
                    console.error("Trying to push mainRow and reorder its container but failed because the container is undefined");
                }
            }
            else {
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
            this.currentPageMax = Math.floor(this.sortedMainChildren.length / userPrefs.rowsPerPage) + 1;
        });
        this.refreshPages();
    }
    /**
     * ATTENTION: This function is used to clean data about the row from the table, not to do anything to the actual row. The row is the main caller of the tradewindow function which then calls this
     * @param children The rows to cleanUp
     */
    dropdownChildren(children) {
        children.forEach((child) => {
            //When the db is called, the pseudoids vanish, and also get edited
            this.sortedMainChildren = this.sortedMainChildren.filter((element) => element.current[gin("00p")] != child.current[gin("00p")]);
            this.currentPageMax = Math.floor(this.sortedMainChildren.length / userPrefs.rowsPerPage) + 1;
            if (this.children.hasOwnProperty(child.current[gin("00p")])) {
                delete this.children[child.current[gin("00p")]];
            }
            const tagIndex = this.tagObj.trades.indexOf(child);
            if (tagIndex > -1)
                this.tagObj.trades.splice(tagIndex, 1);
        });
        this.refreshPages();
    }
}
class TradeWindow {
    constructor(holder) {
        this.holder = holder;
        this.tables = {};
        this.allRows = [];
        this.delayedRenderStack = {};
        this.biggestSorting = 0;
        //Linear access
        this.allRowsObj = {};
        this.currentlyEdited = new Set();
        this.sortings = userPrefs.sortings;
        this.selectedSorting = userPrefs.sortings[userPrefs.selectedSorting];
        //DB column that is getting tag-checked
        this.columnTarget = "";
        //Tags are the elements to look for in the trade column
        // {tag: "equity", logical: "equal"}
        this.refSortingTags = [];
        //Parent styling
        holder.agd("tradeWindow");
        this.controllers = {
            saveAll: "",
        };
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
                        trades: [],
                    }, this.allRows),
                });
            }
        }
    }
    buildTables() {
        this.tables = {};
        this.updateSortingInfo();
        this.refSortingTags.forEach((tagObj) => {
            const newTable = new Table(this.holder, tagObj.trades, this, tagObj);
            this.tables[tagObj.tag] = newTable;
            newTable.renderTable();
            newTable.renderRows();
            //Set the tradewindow ref
            newTable.renderLegend(tagObj).state.tradeWindow = this;
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
    filterTrades(tagObj, rows, unsafe = false) {
        const copiedRows = [...rows];
        const entireList = [];
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
                        if (tagObj.trades.filter((otherRow) => otherRow.current[gin("00p")] == row.current[gin("00p")]).length == 0 || unsafe) {
                            //Forward check
                            if (this.allRowsObj.hasOwnProperty(row.current[gin("29")])) {
                                if (this.allRowsObj[row.current[gin("29")]].origin[this.columnTarget] == tagObj.tag) {
                                    return true;
                                }
                            }
                        }
                    }
                    // if the row is an entire one and it matches, take all its referenced rows and gather them in the object as well
                    else if (row.origin[this.columnTarget] == tagObj.tag && row.current[gin("29")] == "-1") {
                        if (row.current[gin("30")] != "[]") {
                            //Gather all those rows and get them in here too
                            const list = JSON.parse(row.current[gin("30")]);
                            //We don't have only db rows, as in the current we keep the pseudoIds as well
                            list.forEach((partialRowPId) => {
                                //Check that it's not already in there.
                                if (tagObj.trades.filter((otherRow) => otherRow.current[gin("00p")] == partialRowPId).length == 0) {
                                    //Backward check
                                    if (this.allRowsObj.hasOwnProperty(partialRowPId))
                                        entireList.push(this.allRowsObj[partialRowPId]);
                                }
                            });
                        }
                        return true;
                    }
                }));
        }
        return entireList;
    }
    sortAndTableTrades(trades) {
        //We need to push this here to
        this.allRows = this.allRows.concat(trades);
        trades.forEach((row) => {
            row.state.tradeWindow = this;
            this.allRowsObj[row.current[gin("00p")]] = row;
            if (row.state.currentSorting > this.biggestSorting) {
                this.biggestSorting = row.state.currentSorting;
            }
        });
        this.refSortingTags.forEach((tagObj) => {
            let correctTrades = this.filterTrades(tagObj, trades);
            tagObj.trades = tagObj.trades.concat(correctTrades);
            this.tables[tagObj.tag].pushChildren(correctTrades);
        });
    }
    /**
     * ATTENTION 1: A trade being dropped is always a children or a parent at this point empty.
     *
     * ATTENTION 2: This function removes the trades from view but it's not used to CLEAN the dom of the trade. The row is the one that invokes this function
     * @param trades
     */
    dropTrades(trades) {
        //A trade being dropped is always a children or a parent at this point empty.
        trades.forEach(trade => {
            const inObj = this.allRowsObj.hasOwnProperty(trade.current[gin("00p")]);
            const arrIndex = this.allRows.indexOf(trade);
            const child = trade.current[gin("29")] != "-1";
            const table = trade.state.table;
            if (!inObj && arrIndex == -1) {
                console.error("dropTrades$ trying to delete trade that isn't present anymore in any list", trade);
                return;
            }
            ;
            if (inObj)
                delete this.allRowsObj[trade.current[gin("00p")]];
            if (arrIndex > -1)
                this.allRows.splice(arrIndex, 1);
            if (child && this.allRowsObj.hasOwnProperty(trade.current[gin("29")])) {
                //Clean the reference in the parent
                const oldList = JSON.parse(this.allRowsObj[trade.current[gin("29")]].current[gin("30")]);
                const thisIndx = oldList.indexOf(trade.current[gin("00p")]);
                if (thisIndx > -1)
                    oldList.splice(oldList.indexOf(trade.current[gin("00p")]), 1);
                else
                    console.error("dropTrades$ The parent of this trade doesn't have it anymore in its reference (child then parent)", trade, this.allRowsObj[trade.current[gin("29")]]);
                this.allRowsObj[trade.current[gin("29")]].current[gin("30")] = JSON.stringify(oldList);
                this.allRowsObj[trade.current[gin("29")]].origin[gin("30")] = JSON.stringify(oldList);
            }
            //Go down to the table
            if (table == "") {
                console.error("dropTrades$ trying to delete trade that doesn't have a table reference");
                return;
            }
            table.dropdownChildren([trade]);
        });
    }
    saveAll() {
        this.allRows.forEach((row) => {
            if (row.state.editingList.length != 0) {
                row.d_saveChanges();
            }
        });
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
        //Also hiding it at spawn
        this.element.agd("expander");
        this.state = {
            visible: false,
            position: {
                currentX: -1,
                currentY: -1,
            },
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
    fill(content, maxLenght = 100) {
        // The content type determines how the listerObj list is interpreted
        if (this.currentFormat == "lister") {
            //Todo: Check that the content type matches the expander type
            this.element.textContent = "";
            let empty;
            if (content.length == 0) {
                empty = spawnDiv();
                empty.innerHTML = "No results";
                empty.agd("expanderEmptyBlock");
                this.element.append(empty);
            }
            else {
                const orderedListByTag = [...content].sort((a, b) => a.tag.localeCompare(b.tag));
                // Print a divider based on tag
                for (let index = 0; index < orderedListByTag.length && index < maxLenght; index++) {
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
                    tagSeparator === null || tagSeparator === void 0 ? void 0 : tagSeparator.agd("expanderTagSeparator");
                    clickableValue = spawnDiv();
                    clickableValue.agd("expanderClickableValue");
                    this.element.append(clickableValue);
                    //Give it activation properties
                    clickableValue.innerHTML = orderedListByTag[index].value;
                    clickableValue.realValue = Object.create(orderedListByTag[index]);
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
                empty.agd("expanderEmptyBlock");
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
                            selected.forEach((element) => {
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
                    empty.agd("expanderEmptyBlock");
                    this.element.append(empty);
                    console.error("Directive given, but no results from userPrefs");
                }
                else {
                    selectedButtons.forEach((button) => {
                        const newBtn = spawnBtn();
                        newBtn.agd("spawnerButton");
                        if (button.attachedNumber == "0") {
                            newBtn.classList.add("quick-spawn");
                        }
                        else if (button.attachedNumber == "1") {
                            newBtn.classList.add("spawner-main");
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
            this.structure[fieldName].target.memory.fieldHolder.agd("editing");
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
            this.structure[fieldName].target.memory.fieldHolder.rgd("editing");
            this.state.editingList = this.state.editingList.filter((item) => item !== fieldName);
            if (this.state.editingList.length == 0) {
                this.state.editing = false;
            }
        };
        this.cancelChanges = () => {
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
        /**
         * When the child is saved, the parent is saved too.
         * When the parent is saved, the closed list does not get updated in the backend
         * When the parent is saved, its new id gets put in all the children
         * When the child is saved, we change the current and origin closed list property on the frontend and in the backend.
         *
         * When the child is deleted, the backend removes from the backend the property in the parent, then the frontend does it.
         * @returns
         */
        this.d_saveChanges = async () => {
            try {
                //dbObject acts as a save of the previous version
                const dbObject = Object.assign({}, this.current);
                // Put user field changes into the json_user_fields field
                const jsUF = {};
                Object.values(userPrefs.customFields).forEach((customField) => {
                    jsUF[customField.name] = this.current[customField.name];
                    //Remove the given field from the dbobject
                    delete dbObject[customField.name];
                });
                dbObject[gin("juf")] = (jsUF != undefined && JSON.stringify(jsUF) != "") ? JSON.stringify(jsUF) : "{}";
                dbObject[gin("sif")] = JSON.stringify(Array.from(this.state.statsChangedList));
                const isParent = this.current[gin("30")] != "[]";
                const isChild = this.current[gin("29")] != "-1";
                const tradeWindow = this.state.tradeWindow;
                if (tradeWindow == "")
                    throw ({ msg: "Trade window is not defined for this row", obj: this });
                if (this.state.table == "")
                    throw ({ msg: "Table is not defined for this row", obj: this });
                if (isParent && isChild)
                    throw ({ msg: "Trade is both parent and child", obj: this });
                //Save the parent first. The child will then update the parent with its new data
                //When the parent is saved, each child already gets the reference updated
                if (isChild) {
                    if (!tradeWindow.allRowsObj.hasOwnProperty(this.current[gin("29")]))
                        throw (`The trade window doesn't contain the parent  (${this.current[gin("29")]})of this trade, aborting`);
                    const parent = tradeWindow.allRowsObj[this.current[gin("29")]];
                    if (!await parent.d_saveChanges())
                        throw ({ mag: "Failed to save the parent of this child trade [this, parent]", obj: [this, parent] });
                }
                let tag = "New";
                if (dbObject[gin("00i")] == dbObject[gin("00p")]) {
                    tag = "Edit";
                }
                const request = await fetch("http://192.168.0.23/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager", 
                // "http://localhost/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager"
                // "https://www.mymiwallet.com/Trade-Tracker/Trade-Manager"
                {
                    method: "POST",
                    credentials: "same-origin",
                    body: JSON.stringify({ tag, trade: dbObject }),
                    headers: { "Content-Type": "application/json" },
                });
                const data = await request.json();
                if (data.status == "0") {
                    newAlert({ status: "error", message: "Saving the trade was unsuccessfull" });
                    console.error("API: Error processing this data", data);
                    return false;
                }
                //Edit the pseudoid and other db fields (like the id)
                const updatedTrade = JSON.parse(data.message);
                //Clean the response from properties that  
                for (const key of Object.keys(updatedTrade)) {
                    if (this.current.hasOwnProperty(key))
                        continue;
                    //Throwing here would impact other factors
                    delete updatedTrade[key];
                }
                delete updatedTrade[gin("30")]; //Here we are deleting the incoming closed list because it's not updated. We could send it to the origin but it would make no difference. Refer to the standard api schema
                this.current = Object.assign(Object.assign({}, this.current), updatedTrade);
                //The pseudo id doesn't exist in the database, so we have to refresh it like this
                this.current[gin('00p')] = this.current[gin('00i')];
                if (isParent) //Propagate new id
                 {
                    const childIdList = JSON.parse(this.current[gin("30")]);
                    childIdList.forEach(pId => {
                        if (!tradeWindow.allRowsObj.hasOwnProperty(pId)) {
                            console.error("d_saveChanges$ Missing row", pId, "in allrows list. Couldn't propagate");
                            return;
                        }
                        tradeWindow.allRowsObj[pId].current[gin("29")] = this.current[gin('00p')];
                        tradeWindow.allRowsObj[pId].origin[gin("29")] = this.current[gin('00p')];
                    });
                }
                if (isChild) //Swap and add the new id in the closed lists
                 {
                    //We checked above whether the parent exists or not.
                    const parent = tradeWindow.allRowsObj[gin("29")];
                    const childIdCurrentL = JSON.parse(parent.current[gin("30")]);
                    const childIdOriginL = JSON.parse(parent.origin[gin("30")]);
                    //No way it was updated otherwise
                    childIdOriginL.push(this.current[gin("00p")]);
                    parent.origin[gin("30")] = JSON.stringify(childIdOriginL);
                    //dbobject still holds the old pseudoid
                    if (childIdCurrentL.indexOf(this.current[gin("00p")]) < 0) {
                        if (childIdCurrentL.indexOf(dbObject[gin("00p")]) < 0)
                            console.error("d_saveChanges$ for some reason the old pseuoid doesn't appear in the parent list. Pushing the new one anyways");
                        else
                            childIdCurrentL.splice(childIdCurrentL.indexOf(dbObject[gin("00p")]), 1);
                        childIdCurrentL.push(this.current[gin('00p')]);
                    }
                    parent.current[gin("30")] = JSON.stringify(childIdCurrentL);
                }
                //Upward Save Propagation
                if (tag == "New") {
                    //Fix tables/tradeWindows byKeyObj (in the future, maps)
                    //Delete the reference in the object above
                    //Sorted rows is an array of references to these objects, so the ids are already fixed.
                    const thisTableRow = Object.getOwnPropertyDescriptor(this.state.table.children, dbObject[gin("00p")]);
                    if (thisTableRow != undefined) {
                        Object.defineProperty(this.state.table.children, this.current[gin("00p")], thisTableRow);
                        delete this.state.table.children[dbObject[gin("00p")]];
                    }
                    else {
                        console.error("d_saveChanges$ Couldn't find said property in the table reference");
                    }
                    const thisTradeWindowRow = Object.getOwnPropertyDescriptor(tradeWindow, dbObject[gin("00p")]);
                    if (thisTradeWindowRow != undefined) {
                        Object.defineProperty(tradeWindow.allRowsObj, this.current[gin("00p")], thisTradeWindowRow);
                        delete tradeWindow.allRowsObj[dbObject[gin("00p")]];
                    }
                    else {
                        console.error("d_saveChanges$ Couldn't find said property in the tradeWindow reference");
                    }
                }
                //Refresh the origin object to mirror the (just modified) current one
                this.updateCurrent("", 1);
                //Cancelchanges will removeEditing, then run the cancelSaveToggler to fix any still active button
                this.cancelChanges();
                return true;
            }
            catch (error) {
                newAlert({ status: "error", message: "Saving the trade was unsuccessfull" });
                console.error("d_saveChanges$ catched general error:", error);
                return false;
            }
        };
        /**
         * OPERATES ON THE CURRENT AND ORIGIN PROPERTIES
         * - Changes a value of the
         * @param {*} value The value to change it to
         * @param {string| -1} target If -1 makes the current object identical to the origin one, if 1 the opposite
         */
        this.updateCurrent = (value = "", target, fromStats = false) => {
            if (target == -1) {
                this.current = Object.assign({}, this.origin);
            }
            else if (target == 1) {
                this.origin = Object.assign({}, this.current);
            }
            else {
                this.current[target] = value;
                if (fromStats) {
                    this.structure[target].target.agd("autoCalculated");
                    this.state.statsChangedList.add(target);
                }
                else {
                    this.state.statsChangedList.delete(target);
                    this.structure[target].target.rgd("autoCalculated");
                }
            }
            //DEBUG
            if (debug) {
                // Prints the current objects for the "test" row clearly in another div
                const curPrint = document.querySelector(".current");
                const oriPrint = document.querySelector(".origin");
                curPrint.innerHTML = JSON.stringify(this.current);
                oriPrint.innerHTML = JSON.stringify(this.origin);
                //DEBUG
            }
        };
        /**
         * Function to prompt a close event. Takes no argument because it acts on the row itself
         */
        this.closePrompt = () => {
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
            for (const value of Object.values(userPrefs.promptDefaults.closePrompt)) {
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
            promptBox.append(promptTitle, promptDesc, inputBox, inputButtonArray, enterButton, closeBtn, errorBox, infoBox);
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
            function windowCloseKeyFunc(event) {
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
            function windowClickAwayFunc(event) {
                const target = event.target;
                if (promptBox.dataset.visible == "true" && target != null && !promptBox.contains(target)) {
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
                window.removeEventListener("keyup", windowCloseKeyFunc);
                window.removeEventListener("mouseup", windowClickAwayFunc);
            }
        };
        /**
         * When the child is deleted, the backend removes from the backend the property in the parent, then the frontend does it.
         *
         * @param consequential Whether it has to be deleted (from the db) without asking
         * @param legend Whether to not care about the db
         */
        this.d_delete = async (consequential = false, legend = this.state.isLegend) => {
            const tradeWindowRef = this.state.tradeWindow;
            if (tradeWindowRef == "") {
                newAlert({ status: "error", message: "Deleting the trade was unsuccessfull" });
                console.error("d_delete$ This row doesn't have a tradeWindow reference");
                return false;
            }
            ;
            if (legend == false) {
                try {
                    if (consequential == true || (await trueFalsePrompt("Are you sure you want to permanently delete this row?"))) {
                        const parent = this.current[gin("30")] != "[]";
                        if (consequential && parent) {
                            console.error({ msg: "d_delete$ This row is a parent even though a consequential has been fired, so not all child references have been cleared", obj: this.current });
                            newAlert({ status: "error", message: "Deleting the trade was unsuccessfull" });
                            return false;
                        }
                        //If it's a parent:
                        if (parent) {
                            if (!(await trueFalsePrompt("Deleting this row will also delete all of its children, continue?")))
                                return false;
                            //First we delete the kids
                            const childIdList = JSON.parse(this.current[gin("30")]);
                            childIdList.forEach(async (childPseudoId) => {
                                //Se questo figlio non esiste,
                                if (!tradeWindowRef.allRowsObj.hasOwnProperty(childPseudoId))
                                    return;
                                if (!(await tradeWindowRef.allRowsObj[childPseudoId].d_delete(true)))
                                    throw { msg: "Failed to delete children:", obj: { children: tradeWindowRef.allRowsObj[childPseudoId], id: childPseudoId } };
                            });
                            //Now that every children should have cleared the current of this parent
                            return await this.d_delete(true);
                        }
                        //It's a child, it takes care of its parent and removes itself from the references
                        else {
                            //If there's an error, it will be thrown and the function will return false
                            const request = await fetch("http://192.168.0.23/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager", 
                            // "http://localhost/MyMIWallet/v7/v1.5/public/index.php/Trade-Tracker/Trade-Manager"
                            // "https://www.mymiwallet.com/Trade-Tracker/Trade-Manager"
                            {
                                method: "POST",
                                credentials: "same-origin",
                                body: JSON.stringify({ tag: "Delete", trade: this.current }),
                                headers: { "Content-Type": "application/json" },
                            });
                            const data = await request.json();
                            const tradeWindowRef = this.state.tradeWindow;
                            if (tradeWindowRef == "")
                                throw "This row doesn't have a tradeWindow reference";
                            if (data.status == '0') {
                                newAlert({ status: "error", message: "Deleting the trade was unsuccessfull" });
                                console.error("d_delete$ catched general error:", data.message);
                                return false;
                            }
                            if (data.status == '2')
                                console.error("d_delete$ The given trade didn't exist anymore in the database:", this);
                            if (this.current[gin("29")] != "-1" && !tradeWindowRef.allRowsObj.hasOwnProperty(this.current[gin("29")]))
                                console.error(`d_delete$ The tradewindow doesn't contain the parent anymore: ${this.current[gin("29")]}`, this);
                            //Droptrades cleans the reference in the other trades.
                            tradeWindowRef.dropTrades([this]);
                            this.cleanupDom();
                            return true;
                        }
                    }
                }
                catch (error) {
                    newAlert({ status: "error", message: "Deleting the trade was unsuccessfull" });
                    console.error("d_delete$ catched general error:", error);
                    return false;
                }
            }
            else {
                this.cleanupDom(true);
                return true;
                //Apparently the garbage collector takes care here *shrug*
            }
            console.error("d_delete$ completed cycle without catching a return. Returning false");
            return false;
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
                this.structure[gin("1")].target.innerHTML = "Open";
                // Add the open event listener
                this.structure[gin("1")].target.onclick = this.open;
                this.structure[gin("1")].target.rgd("button");
                this.structure[gin("1")].target.rgd("openedBtn");
                this.structure[gin("1")].target.agd("closedBtn");
            }
            else {
                //Edit the fields, create a "complete" partial close, then add a SAVE PROMPT to it
                const availableFields = availableFieldsGen();
                //Create the new trade object
                //Create a new row "percenting" the numerical values of the current one and creating a relative different one
                const percentedNewTrade = Object.assign({}, this.origin);
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
                    //Closed Ref
                    //* Here we decide that if you close a sub trade you are still closing a part of the main trade and not of the sub trade
                    if (this.current[gin("29")] != "-1") {
                        percentedNewTrade[gin("29")] = this.current[gin("29")];
                        //THE ORIGIN IS UPDATED IN THE BACKEND - affecting directly the origin of the parent
                        const parentTrade = this.state.table.tradeWindowRef.allRowsObj[this.current[gin("29")]];
                        const newList = JSON.parse(parentTrade.current[gin("30")]);
                        newList.push(newPseudoId);
                        parentTrade.current[gin("30")] = JSON.stringify(newList);
                    }
                    else {
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
                            if (!isNaN(parseFloat(this.current[field.name]))) {
                                this.current[field.name] = (((100 - percentage) / 100) * parseFloat(percentedNewTrade[field.name])).toString();
                                newPartialCloseRow.current[field.name] = ((percentage / 100) * parseFloat(percentedNewTrade[field.name])).toString();
                                //We are reducing the value, so if it were to be reset it would go to 0 - hence the following decision
                                newPartialCloseRow.origin[field.name] = "0";
                                //Add this property to the editing tab
                                this.addEditingOnStdInput({ target: { name: field.name } });
                                newPartialCloseRow.addEditingOnStdInput({ target: { name: field.name } });
                                this.changeValue(field.name);
                                newPartialCloseRow.changeValue(field.name);
                                //Change the field visually
                            }
                        }
                        //This was made for future implementation of fields like the closed perc one
                        else if (field.modifiers.includes("closed_relative_increase")) {
                            //Change the values
                            if (!isNaN(parseFloat(this.current[field.name]))) {
                                this.current[field.name] += ((100 - parseFloat(this.current[field.name])) * percentage) / 100;
                                //Add this property to the editing tab
                                this.addEditingOnStdInput({ target: { name: field.name } });
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
        this.open = () => {
            //STYLEME
            this.updateCurrent("false", "closed");
            this.addEditingOnStdInput({ target: { name: "closed" } });
            this.structure[gin("1")].target.innerHTML = "Close";
            //Re-add the close event listener
            this.structure[gin("1")].target.onclick = this.closePrompt;
            this.structure[gin("1")].target.rgd("closedBtn");
            this.structure[gin("1")].target.agd("openedBtn");
        };
        //* Row2 keeps the empty fields empty rather than deleting them
        //Fields used to compare changes.
        //TOBETESTED: Depends on the way the database stores the user fields data
        const interpolatedData = this.c_userFieldsInterpolate(new TradeObj(data));
        this.origin = Object.assign({}, interpolatedData);
        this.current = Object.assign({}, interpolatedData);
        //State information
        this.state = {
            isLegend: legend,
            table: "",
            //Gets set when the row is pushed in the tradeWindow
            tradeWindow: "",
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
    c_statsManipulatedInterpolate(originObject) {
        if (originObject.hasOwnProperty(gin("sif"))) {
            return new Set(JSON.parse(originObject[gin("sif")]));
        }
        else {
            console.error("c_statsManipulatedInterpolate$ Given object was missing the sif property", originObject);
            return new Set([]);
        }
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
        if (this.current[gin("29")] != "-1") {
            if (this.state.table != "") {
                const parentRow = this.state.table.tradeWindowRef.allRowsObj[this.current[gin("29")]];
                return parentRow.getLayout();
            }
            else {
                console.error("getLayout$ This partial row doesn't have a table reference, using available layout", this);
            }
        }
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
     *
     * Also adds the dropdown button to toggle visibility of the closed rows
     * @returns {domElement} Returns the container objetc
     */
    createContainer() {
        const container = document.createElement("div");
        this.state.container = container;
        container.agd("tradeContainer");
        this.refreshDropdown();
        return container;
    }
    dropdownChildren(expand = !this.state.dropDown.expanded) {
        const childList = JSON.parse(this.current[gin("30")]);
        const theTable = this.state.table;
        if (theTable != "") {
            childList.forEach((pId) => {
                if (theTable.tradeWindowRef.allRowsObj.hasOwnProperty(pId)) {
                    const mainRow = theTable.tradeWindowRef.allRowsObj[pId].state.mainRow;
                    if (mainRow != "") {
                        changeVisible(mainRow, expand);
                        this.state.dropDown.expanded = expand;
                        if (this.state.dropDown.target != "")
                            this.state.dropDown.target.innerHTML = this.state.dropDown.expanded ? "˄" : "˅";
                    }
                }
            });
        }
        else {
            console.error("dropdownChildren$ This row's table is not yet defined.", this);
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
                    changeVisible(this.state.dropDown.target, true);
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
                                changeVisible(this.state.mainRow, theTable.tradeWindowRef.allRowsObj[this.current[gin("29")]].state.dropDown.expanded);
                            }
                        }
                        //Bad/Old implementation that requires even more checking.
                        //changeVisible(theTable.tradeWindowRef.allRowsObj[this.current[gin("29")]].state.dropDown.target, true)
                    }
                }
            }
            else {
                if (secondCall) {
                    console.error("refreshDropdown$ Second call failed: the dropdown has not been assigned correctly");
                    return;
                }
                const dropdown = document.createElement("button");
                dropdown.innerHTML = this.state.dropDown.expanded ? "˄" : "˅";
                this.state.dropDown.target = dropdown;
                dropdown.agd("containerDropdown");
                this.state.container.append(dropdown);
                changeVisible(dropdown, false);
                //The dropdown is disabled on spawn (see the Row2 constructor)
                dropdown.addEventListener("click", (e) => {
                    this.dropdownChildren();
                });
                this.refreshDropdown(true);
            }
        }
        else {
            console.error("refreshDropdown$ Trying to refresh dropdown without a defined container");
        }
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
        //The editings and checks are being done only on the cancel changes button
        if (this.state.editing) {
            //Add event listener - To prevent multiple firings, we use a checking property when this runs
            if (!this.structure[gin("b2")].hasCancelListener) {
                this.structure[gin("b2")].target.addEventListener("click", this.cancelChanges, true);
                this.structure[gin("b1")].target.addEventListener("click", this.d_saveChanges, true);
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
            }
            else {
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
            }
            else {
                console.error("cancelSaveToggler$ The given row doesn't have a table reference", this);
            }
        }
        else {
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
            }
            else {
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
            }
            else {
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
    getValue(property, target = "current") {
        return this[target].hasOwnProperty(property) ? { value: this[target][property], has: true } : { value: "", has: false };
    }
    //Value and current object are never not linked. So to update the value of a fieald you must update the current object first
    changeValue(property, origin = "current") {
        const availableFields = availableFieldsGen();
        const propertyFieldInstructions = availableFields[this.structure[property].dirTag];
        switch (propertyFieldInstructions.type) {
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
     * Brutal cleanup of the given row.
     */
    cleanupDom(cleanContainer = false) {
        this.structure = {};
        if (this.state.mainRow != "") {
            this.state.mainRow.remove();
            this.state.mainRow = "";
        }
        else {
            console.error("cleanumDom$ mainRow of given row doesn't exist");
        }
        if (cleanContainer) {
            if (this.state.container != "") {
                this.state.container.remove();
                this.state.container = "";
            }
            else {
                console.error("cleanumDom$ container of given row doesn't exist");
            }
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
            this.formulaRun();
        };
        //Pass the two functions from the parent object
        const addEditingOnStdInput = this.addEditingOnStdInput;
        const addEditingOnListInput = this.addEditingOnListInput;
        /**
         * Function to create a structure in the this.structure object for the given std input field
         * @param {domElemeent} field
         * @param {{name: string, render: boolean,default:any,objLinked: [] | string[],"//And more fields which can be found above the defaultfields delcaration"}} directive
         */
        const createStructure = (field, ginDir) => {
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
                    this.changeValue(field.name, "origin");
                },
            };
            //If the field is linked to others, save it here
            const directive = availableFieldsGen()[ginDir];
            if (directive.hasOwnProperty("objLinked") && directive.objLinked != undefined && directive.objLinked.length != 0) {
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
                function listMatch(list, specValue) {
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
                function listBrowse(list, value) {
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
                        addEditingOnListInput(e);
                        //Now filter using that input
                        const availableChoices = listBrowse(list, input);
                        //Show the listing block
                        listingExpander.moveAndResizeTo();
                        listingExpander.fill(availableChoices, 10);
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
                        listingExpander.fill(availableChoices, 10);
                        listingExpander.show();
                    }
                    else {
                        console.error("Target is null");
                    }
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
        fieldHolder.agd("fieldHolder");
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
                        //Easier access when referencing things in the aftermath (1/2)
                        //Used in the
                        buildLister(dirProperties.name, fieldHolder, dirProperties.options);
                        break;
                    case "select":
                        field = spawnSelect();
                        field.discriminator = "SELECT-FIELD";
                        //STYLEME
                        if (dirProperties.options != undefined) {
                            const actualOptions = dirProperties.options[this.current[gin("27")]];
                            actualOptions.forEach((option) => {
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
                field.rgd("button");
                //Make the button into a "closed" string that you cvan click on to reopen the trade.
                if (this.getValue(gin("1")).value == "true") {
                    field.innerHTML = "Open";
                    field.onclick = this.open;
                    field.agd("closedBtn");
                }
                else {
                    field.innerHTML = "Close";
                    //ADD EVENT LISTENER
                    field.onclick = this.closePrompt;
                    field.agd("openedBtn");
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
                console.error("renderRow went wrong, table has not been assigned yet (renderRow) (closed-row)", this);
            }
            else {
                //TODO: Make the ref to the pseudoId and not the Id
                container = this.state.table.children[this.origin[gin("29")]].state.container;
                this.state.container = container;
                //Only one append required, unlike normal rows where we are creating a trade container to put the main row in, we simply add the trade row to the main trade pre-existing container
                if (this.state.container == "") {
                    console.error("Table has been assigned, but its container is empty (renderRow) (closed-row)", this, this.state.table.tradeWindowRef.allRowsObj[this.origin[gin("29")]].state.container);
                }
                else {
                    this.state.container.append(mainRow);
                    //Addin the row to the state of the trade for easier access in the future
                }
            }
        }
        else {
            //STYLEME
            //If the trade is not closed, then either build a new container
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
            if (this.state.isLegend) {
                mainRow.agd("legendRow");
                if (this.state.container != "")
                    this.state.container.agd("legendContainer");
            }
            else {
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
                (key) => !block.nElements.includes(key) && !block.nElements.includes(key));
            }
            //scrollable
            if (block.fixed) {
                //? DOUBTFUL about how to handle the width property
                section.style.minWidth = block.size;
                section.style.maxWidth = block.size;
                section.agd("fixedSection");
            }
            else {
                section.style.width = block.size;
                section.agd("scrollableSection");
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
        let formulaSet = new Set();
        currentLayout.forEach((block) => {
            formulaSet = new Set([...formulaSet, ...block.activeFormulas]);
        });
        Array.from(formulaSet).forEach((formulaName) => {
            //Things named with op are referred to the operator sets
            const formula = userPrefs.formulas.fields[formulaName];
            //Overwrite checker here
            switch (formula.overwrite) {
                case 0:
                    if (this.current[gin(formula.targets)] != formula.overwriteCond && !this.state.statsChangedList.has(gin(formula.targets))) {
                        return;
                    }
                //No break to continue to the next case
                case 1:
                    const opSubTopicLenght = formula.operator.subTopicOperation.length;
                    const opMainStreaklLenght = formula.operator.mainOperationStreak.length;
                    let funcValid = true;
                    let numResult = 0;
                    let strResult = "";
                    //The topic position is also used to index the current operation
                    for (let topicPosition = 0; topicPosition < formula.topics.length; topicPosition++) {
                        const topic = formula.topics[topicPosition];
                        let topicValid = true;
                        if (formula.underlyingType == "number") {
                            strResult = false;
                            let topicResult = 0;
                            const opTopicStreak = formula.operator.subTopicOperation[topicPosition % opSubTopicLenght];
                            const opTopicStreakLenght = opTopicStreak.length;
                            //After the first cycle use this array instead.
                            const repeatableOperations = [...opTopicStreak].filter((operator) => {
                                //Filter out single use elements
                                return !Array.isArray(operator);
                            });
                            //ITERATE THROUGH THE ELEMENTS
                            for (let subTopicIndex = 0; subTopicIndex < topic.directives.length; subTopicIndex++) {
                                const topicDirective = topic.directives[subTopicIndex];
                                //Decide which streak to use depending on whether we are positioned in the first cycle or cycles ahead
                                let currentOperator;
                                if (subTopicIndex >= opTopicStreakLenght) {
                                    //Second operation cycle
                                    //Remove the lenght of the operators which are not going to be repeated and index on base lenght of these operators.
                                    currentOperator = repeatableOperations[(subTopicIndex - opTopicStreakLenght) % repeatableOperations.length];
                                }
                                else {
                                    //First operation cycle
                                    //Single directive check.
                                    //Had to infer types because typescript is ideotic
                                    currentOperator = Array.isArray(opTopicStreak[subTopicIndex]) ? opTopicStreak[subTopicIndex][0] : opTopicStreak[subTopicIndex];
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
                                }
                                else {
                                    //Now the operator is one to make work on the actual result
                                    if (valid) {
                                        topicResult = applyNumOperator(topicResult, pf(uValidValue), currentOperator);
                                    }
                                    else if (!valid && topicDirective.defaults != -1) {
                                        topicResult = applyNumOperator(topicResult, pf(topicDirective.defaults), currentOperator);
                                    }
                                    else if (!valid && topicDirective.defaults == -1) {
                                        topicValid = false;
                                        //Close cycle
                                        subTopicIndex = topic.directives.length;
                                    }
                                    else {
                                        console.error("formulaRun$ During directive check, none of the truthCondition circumstances was catched", topicDirective);
                                        topicValid = false;
                                        subTopicIndex = topic.directives.length;
                                    }
                                }
                            }
                            if (topicValid == true) {
                                if (topicPosition == 0) {
                                    numResult = topicResult;
                                }
                                else {
                                    const currentOperation = formula.operator.mainOperationStreak[(topicPosition - 1) % opMainStreaklLenght];
                                    numResult = applyNumOperator(numResult, topicResult, currentOperation);
                                }
                            }
                            else if (topic.defaults != -1 && topicValid == false) {
                                if (topicPosition == 0) {
                                    numResult = pf(topic.defaults);
                                }
                                else {
                                    const currentOperation = formula.operator.mainOperationStreak[(topicPosition - 1) % opMainStreaklLenght];
                                    numResult = applyNumOperator(numResult, pf(topic.defaults), currentOperation);
                                }
                            }
                            else if (topic.defaults == -1 && topicValid == false) {
                                //Complete the whole cycle and stop running for loops
                                funcValid = false;
                                topicPosition = formula.topics.length;
                            }
                        }
                        else {
                        }
                    }
                    if (funcValid) {
                        //Overwrite property checked before calculation
                        this.updateCurrent(strResult == false ? numResult.toString() : strResult, gin(formula.targets), true);
                        this.changeValue(gin(formula.targets));
                        this.addEditingOnStdInput({ target: this.structure[gin(formula.targets)].target });
                    }
                    else {
                        return; //Skip this cycle and move to the next one. We are at the end but this signifies better
                    }
            }
        });
    }
}
////////////
// RUNTIME
function createNewRow(startingObj = new TradeObj({}), options = { separator: "n", forcedProperties: {}, repeat: 1 }) {
    const tradeArray = [];
    for (let index = 0; index < options.repeat; index++) {
        const tradeObj = new TradeObj(startingObj);
        if (tradeWindow.allRows.length != 0 && !startingObj.hasOwnProperty(gin("00i"))) {
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
            tradeObj[key] = value;
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
const tradeWindow = new TradeWindow(tradeWindowTarget);
//Add all trades to this tradewindow
//Get trades
//Trasform them into rows
//Push them into the tradewindow
//? User data (user pref) oject generator API?
tradeWindow.buildTables();
tradesList.forEach((trade) => {
    createNewRow(trade);
});
////////////////////////
// Controller Section //
////////////////////////
const controllerBox = spawnDiv();
controllerBox.agd("controllerBox");
tradeWindowTarget === null || tradeWindowTarget === void 0 ? void 0 : tradeWindowTarget.prepend(controllerBox);
/////////////////////////
// New Row
const newRowButton = spawnBtn();
newRowButton.innerHTML = "New row";
newRowButton.agd("mainBtn", "button");
const newRowOptionExpander = new Expander(newRowButton, "moreOptions");
newRowButton.addEventListener("click", (e) => {
    newRowOptionExpander.show();
    newRowOptionExpander.fill([
        {
            id: "newRows",
            //Here we chose to put the templatename inside the directives for defaults, so these other two fields cna have other implementations later
            value: "",
            tag: "",
        },
    ]);
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
};
//TODO: FINISH IMPLEMENTING
////////////////7/////
// Edit User preferences
const editPrefsBtn = spawnBtn();
controllerBox.append(editPrefsBtn);
editPrefsBtn.agd("button", "mainBtn");
editPrefsBtn.innerHTML = "Settings";
const mainEditPrefsWindow = document.querySelector(".tt-edit-user-preferences");
if (mainEditPrefsWindow != null) {
    const editPrefsObj = {
        fullActivatorBtn: editPrefsBtn,
        state: {
            visible: false,
            currentPage: "columnsEditor",
            editing: new Set([]),
            closing: false,
        },
        elements: {
            mainWindow: mainEditPrefsWindow,
            closeBtn: mainEditPrefsWindow.querySelector(".close-button"),
            menuBar: mainEditPrefsWindow.querySelector(".menu-bar"),
            pageSection: mainEditPrefsWindow.querySelector(".page-section"),
            pages: {
                columnsEditor: mainEditPrefsWindow.querySelector(".columns-editor"),
                customColumns: mainEditPrefsWindow.querySelector(".custom-columns"),
            },
            saveBtn: mainEditPrefsWindow.querySelector("#saveBtn"),
            resetBtn: mainEditPrefsWindow.querySelector("#resetBtn")
        },
        addEdit(prop) {
            this.state.editing.add(prop);
            this.elements.saveBtn.disabled = false;
            this.elements.resetBtn.disabled = false;
        },
        removeEdit(prop) {
            this.state.editing.delete(prop);
            if (this.state.editing.size == 0) {
                this.elements.saveBtn.disabled = true;
                this.elements.resetBtn.disabled = true;
            }
        },
        clearEdit() {
            this.state.editing.clear();
            this.elements.saveBtn.disabled = true;
            this.elements.resetBtn.disabled = true;
        },
        showMainTab() {
            changeVisible(this.elements.mainWindow, true, [this.state.visible]);
        },
        async hideMainTab() {
            if (this.state.closing == true) {
                return;
            }
            else {
                this.state.closing = true;
                if (await this.switchPage(this.state.currentPage) != false) {
                    changeVisible(this.elements.mainWindow, false, [this.state.visible]);
                }
                this.state.closing = false;
            }
        },
        /**
         * Used to switch to a new page: Without switching
         * @param newPage
         * @returns
         */
        async switchPage(newPage, directive = -1) {
            if (this.elements.pages.hasOwnProperty(newPage)) {
                if (this.state.editing.size >= 1) {
                    try {
                        let actualDirective = 0;
                        if (directive != -1) {
                            actualDirective = directive;
                        }
                        else {
                            actualDirective = await trueFalseCancelPrompt("Do you want to save these changes?");
                        }
                        switch (actualDirective) {
                            case 0:
                                return false;
                            case 1:
                                await this.saveNewPreferences();
                                break;
                            case 2:
                                //Reset the object
                                this.shadowUserPrefs = JSON.parse(JSON.stringify(this.mirroredUserPrefs));
                                this.clearEdit();
                        }
                        changeVisible(this.elements.pages[this.state.currentPage], false);
                        changeVisible(this.elements.pages[newPage], true);
                        this.refreshPages();
                        this.state.currentPage = newPage;
                        return true;
                    }
                    catch (error) {
                        console.error("editPrefsObj.switchPage$ There was an error:", error);
                        return false;
                    }
                }
                else {
                    changeVisible(this.elements.pages[this.state.currentPage], false);
                    changeVisible(this.elements.pages[newPage], true);
                    this.state.currentPage = newPage;
                    return true;
                }
            }
            else {
                console.error("editPrefsObj.switchPage$ Trying to switch to non-existing preferences page");
                return false;
            }
        },
        //TODO: Complete the function, and then pull the userprefs from the db
        async saveNewPreferences() {
            try {
                //PUSH t he changePrefs
                const result = await fetch("", {
                    method: "POST",
                    credentials: "same-origin",
                    body: JSON.stringify({ tt_user_settings: this.shadowUserPrefs }),
                    headers: { "Content-Type": "application/json" },
                });
                const data = await result.json();
                if (data.success) {
                    //do stuff
                }
                else {
                    //do other stuff
                }
                //Update the mirrored user prefs
                this.mirroredUserPrefs = JSON.parse(JSON.stringify(this.shadowUserPrefs));
                this.clearEdit();
                truePrompt("For changes to take effect you need to reload the page. You can keep editing preferences in the meantime", { trueTxt: "Ok" });
            }
            catch (e) {
                throw (e);
            }
        },
        mirroredUserPrefs: structuredClone(userPrefs),
        shadowUserPrefs: structuredClone(userPrefs),
        /**
         * Brute force refresh of the insides of every settings page
         *
         * Called when an edit is made or when edits are cancelled
         */
        //TODO: Complete this function
        refreshPages() {
            /*
            TODO:
            - Change Size
            */
            //* Top level mirror and shadow have no difference. Difference gets born when a change can happen on the shadow that will impact how elements IN PAGE refresh
            const columnsEditor = () => {
                this.elements.pages.columnsEditor.innerHTML = "";
                const pageTitle = document.createElement("h1");
                pageTitle.innerHTML = "Edit the layout";
                pageTitle.agd("columnsEditorPageTitle");
                this.elements.pages.columnsEditor.append(pageTitle);
                const desc0 = document.createElement("p");
                desc0.innerHTML = "Here you can edit which columns and in which order they are displayed for each table.<br>Each of the tables' layouts is then divided in sections that compose the row (like the button section). Edit each layout individually and then save to see changes appear";
                desc0.agd("columnsEditorDescriptionText");
                this.elements.pages.columnsEditor.append(desc0);
                const sortingType = document.createElement("h7");
                sortingType.innerHTML = this.shadowUserPrefs.selectedSorting == "none" ? "Table division: All the rows are sorted in the same table" : `Table division: ${this.mirroredUserPrefs.selectedSorting}`;
                sortingType.agd("columnsEditorInformationText");
                this.elements.pages.columnsEditor.append(sortingType);
                const shadowSelectedSorting = this.shadowUserPrefs.sortings[this.shadowUserPrefs.selectedSorting];
                //Here shadow and mirror have no difference between them
                //* BUT: The mirrored will stay static, while the other will be dynamic. So
                for (const [blockKey, blockProps] of Object.entries(this.mirroredUserPrefs.sortings[this.mirroredUserPrefs.selectedSorting].blocks)) {
                    /**
                     * Creates a described input, of any chosen type. Also gives back the input for event listening
                     * @param label
                     * @param type
                     * @returns
                     */
                    const createBasicInput = (label, type) => {
                        const holder = document.createElement("div");
                        const desc = document.createElement("p");
                        const input = document.createElement("input");
                        input.setAttribute("type", type);
                        desc.innerHTML = label;
                        holder.append(desc, input);
                        return [holder, input];
                    };
                    const spawnEditor = (layoutName, target) => {
                        if (!blockProps.layouts.hasOwnProperty(layoutName)) {
                            return false;
                        }
                        target.innerHTML = "";
                        const layout = blockProps.layouts[layoutName];
                        const availableFields = Object.assign({}, availableFieldsGen(this.mirroredUserPrefs));
                        //Map the situation of fields
                        /**
                         * Valued at -1 if in no section
                         *
                         * Valued with the section index if present
                         */
                        const masterUsedFields = new Map();
                        //If the elements are left empty, the nElements are used to generate them. This only happens if the layout is used, otherwise it remains empty
                        //The active layout works EVEN WITHOUT this filler here, but it's the only one receiving a filling treatment
                        for (const key of Object.keys(availableFields)) {
                            masterUsedFields.set(key, -1);
                        }
                        for (let index = 0; index < layout.length; index++) {
                            const section = layout[index];
                            if (section.size != "0") {
                                section.elements.forEach(element => {
                                    masterUsedFields.set(element, index);
                                });
                            }
                        }
                        const sectionsRefreshers = [];
                        for (let index = 0; index < layout.length; index++) {
                            const section = layout[index];
                            const fixedIndex = index;
                            const fieldModifiers = new Map();
                            if (section.size != "0") {
                                //Create + Initialize
                                //Functions
                                //Event Listeners
                                //Append
                                /**
                                 * The function is used to refresh the fieldEditors (selectors) to accomodate for changes in other layout parts
                                 * When you work on ANY other part, it reloads and shrink back
                                 * @param elementsEditor
                                 * @param showHidden
                                 */
                                const refreshElementEditor = (elementsEditor, showHidden = false) => {
                                    elementsEditor.innerHTML = "";
                                    for (const [key, directive] of Object.entries(availableFields)) {
                                        if (directive.render != "false" && key != "0") {
                                            //Set the editing state - section comes from the mirrored, not the shadow. So it's fixed even in case of adding/removal
                                            const tag = `sectionElementsOrder_${simpleHash(JSON.stringify(section) + JSON.stringify(index) + JSON.stringify(layoutName))}`;
                                            //Used to not trigger this function again
                                            const fieldSelector = document.createElement("div");
                                            fieldSelector.agd("columnsEditorFieldSelectorHolder");
                                            const fieldName = document.createElement("h5");
                                            fieldName.agd("columnsEditorFieldSelectorTitle");
                                            fieldName.innerHTML = directive.columnName;
                                            const fieldSubType = document.createElement("p");
                                            fieldSubType.agd("columnsEditorFieldSelectorSubTitle");
                                            fieldSubType.innerHTML = directive.subtype;
                                            const upButton = document.createElement("button");
                                            upButton.setAttribute("id", "upButton");
                                            const downButton = document.createElement("button");
                                            downButton.setAttribute("id", "downButton");
                                            upButton.agd("columnsEditorFieldSelectorUpDownButton");
                                            downButton.agd("columnsEditorFieldSelectorUpDownButton");
                                            upButton.innerHTML = "↑";
                                            downButton.innerHTML = "↓";
                                            const inUse = document.createElement("input");
                                            inUse.setAttribute("type", "checkbox");
                                            inUse.agd("columnsEditorFieldSelectorInUse");
                                            //Start out as a standard field. Remembering that the number of fields won't change while in this page here
                                            fieldSelector.agd("columnsEditorAvailableField");
                                            //classy, failed, try fieldSelector.style.order = (shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.length + 1).toString();
                                            fieldSelector.style.order = "600000";
                                            if (!showHidden) {
                                                fieldSelector.classList.add("d-none");
                                            }
                                            if (masterUsedFields.get(key) == index) {
                                                inUse.checked = true;
                                                fieldSelector.rgd("columnsEditorAvailableField", "columnsEditorBlockedField");
                                                fieldSelector.agd("columnsEditorSelectedField");
                                                fieldSelector.classList.remove("d-none");
                                                fieldSelector.style.order = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.indexOf(key).toString();
                                                fieldModifiers.set(key, fieldSelector);
                                            }
                                            else if (masterUsedFields.get(key) != -1) {
                                                inUse.disabled = true;
                                                fieldSelector.rgd("columnsEditorAvailableField", "columnsEditorSelectedField");
                                                fieldSelector.agd("columnsEditorBlockedField");
                                                fieldSelector.style.order = "1000000";
                                            }
                                            upButton.addEventListener("click", () => {
                                                const currentIndexPrefs = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.indexOf(key);
                                                if (currentIndexPrefs != 0) {
                                                    const aboveKey = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements[currentIndexPrefs - 1];
                                                    const aboveElement = fieldModifiers.get(aboveKey);
                                                    if (aboveElement !== undefined) {
                                                        const aboveElementOrder = aboveElement.style.order;
                                                        shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements[currentIndexPrefs] = aboveKey;
                                                        shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements[currentIndexPrefs - 1] = key;
                                                        aboveElement.style.order = fieldSelector.style.order;
                                                        fieldSelector.style.order = aboveElementOrder;
                                                        if (JSON.stringify(shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements) != JSON.stringify(layout[index].elements)) {
                                                            console.log("The element order is different", shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements, JSON.stringify(layout[index].elements), tag);
                                                            this.addEdit(tag);
                                                        }
                                                        else {
                                                            this.removeEdit(tag);
                                                        }
                                                        ;
                                                    }
                                                    else {
                                                        console.error("SETTINGS: There is no above element");
                                                    }
                                                }
                                            });
                                            downButton.addEventListener("click", () => {
                                                const currentIndexPrefs = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.indexOf(key);
                                                if (currentIndexPrefs < shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.length - 1) {
                                                    const belowKey = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements[currentIndexPrefs + 1];
                                                    const belowElement = fieldModifiers.get(belowKey);
                                                    if (belowElement !== undefined) {
                                                        const belowElementOrder = belowElement.style.order;
                                                        shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements[currentIndexPrefs] = belowKey;
                                                        shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements[currentIndexPrefs + 1] = key;
                                                        belowElement.style.order = fieldSelector.style.order;
                                                        fieldSelector.style.order = belowElementOrder;
                                                        if (JSON.stringify(shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements) != JSON.stringify(layout[index].elements)) {
                                                            console.log("The element order is different", shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements, JSON.stringify(layout[index].elements), tag);
                                                            this.addEdit(tag);
                                                        }
                                                        else {
                                                            this.removeEdit(tag);
                                                        }
                                                        ;
                                                    }
                                                    else {
                                                        console.error("SETTINGS: There is no above element");
                                                    }
                                                }
                                            });
                                            inUse.addEventListener("click", () => {
                                                if (masterUsedFields.get(key) == index) {
                                                    //REMOVE
                                                    const pointOfKilling = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.indexOf(key);
                                                    if (pointOfKilling > -1) {
                                                        masterUsedFields.set(key, -1);
                                                        fieldModifiers.delete(key);
                                                        shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.splice(pointOfKilling, 1);
                                                        fieldSelector.style.order = "600000";
                                                        fieldSelector.rgd("columnsEditorSelectedField");
                                                        fieldSelector.agd("columnsEditorAvailableField");
                                                        //Drop from the 0 size
                                                        const pointOfNKilling = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][shadowSelectedSorting.blocks[blockKey].layouts[layoutName].length - 1].nElements.indexOf(key);
                                                        if (pointOfNKilling > -1) {
                                                            shadowSelectedSorting.blocks[blockKey].layouts[layoutName][shadowSelectedSorting.blocks[blockKey].layouts[layoutName].length - 1].nElements.splice(pointOfNKilling, 1);
                                                        }
                                                        else {
                                                            console.error("SETTINGS: Couldn't find index of key in nElements");
                                                        }
                                                    }
                                                    else {
                                                        console.error("SETTINGS: Element already doesn't exist in list");
                                                    }
                                                }
                                                else {
                                                    //ADD
                                                    const lastElementKey = shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements[shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.length - 1];
                                                    const lastElement = fieldModifiers.get(lastElementKey) || { style: { order: "0" } };
                                                    shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements.push(key);
                                                    masterUsedFields.set(key, index);
                                                    fieldModifiers.set(key, fieldSelector);
                                                    fieldSelector.style.order = (parseInt(lastElement.style.order) + 1).toString();
                                                    fieldSelector.rgd("columnsEditorAvailableField");
                                                    fieldSelector.agd("columnsEditorSelectedField");
                                                    //Add to the 0 size
                                                    shadowSelectedSorting.blocks[blockKey].layouts[layoutName][shadowSelectedSorting.blocks[blockKey].layouts[layoutName].length - 1].nElements.push(key);
                                                }
                                                //Set the editing state - section comes from the mirrored, not the shadow. So it's fixed even in case of adding/removal
                                                if (JSON.stringify(shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements) != JSON.stringify(layout[index].elements)) {
                                                    console.log("The element number is different", shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].elements, JSON.stringify(layout[index].elements), tag);
                                                    console.log(fieldModifiers);
                                                    this.addEdit(tag);
                                                }
                                                else {
                                                    this.removeEdit(tag);
                                                }
                                                ;
                                            });
                                            fieldSelector.append(inUse, fieldName, fieldSubType, upButton, downButton);
                                            elementsEditor.append(fieldSelector);
                                        }
                                    }
                                    const showMore = document.createElement("button");
                                    showMore.style.order = "599999";
                                    let showingMore = showHidden;
                                    showMore.innerHTML = showHidden ? "Hide all available fields ↑" : "Show all available fields ↓";
                                    showMore.agd("columnsEditorShowMoreFieldSelector");
                                    showMore.addEventListener("click", () => {
                                        showingMore = !showingMore;
                                        refreshElementEditor(elementsEditor, showingMore);
                                        for (let x = 0; x < sectionsRefreshers.length; x++) {
                                            const element = sectionsRefreshers[x];
                                            if (x != fixedIndex) {
                                                element.generator(element.block);
                                            }
                                        }
                                    });
                                    elementsEditor.append(showMore);
                                };
                                const sectionDiv = document.createElement("div");
                                sectionDiv.agd("columnsEditorSectionDiv");
                                const sectionTitle = document.createElement("h6");
                                sectionTitle.innerHTML = `Section ${index + 1}`;
                                sectionTitle.agd("columnsEditorSectionTitle");
                                const [scrollableHolder, scrollabelInput] = createBasicInput("Should this section be fixed?", "checkbox");
                                scrollabelInput.checked = section.fixed;
                                const scrollableInfo = document.createElement("p");
                                scrollableInfo.innerHTML = "A fixed section will shrink its cells to make them fit in the size<br>A non fixed section will fix the size of the cells and make you scroll through them";
                                scrollableInfo.agd("columnsEditorBlockTitle");
                                const elementsEditor = document.createElement("div");
                                elementsEditor.agd("columnsEditorElementsEditorHolder");
                                refreshElementEditor(elementsEditor);
                                sectionsRefreshers[index] = { generator: refreshElementEditor, block: elementsEditor };
                                //Listeners
                                scrollabelInput.addEventListener("input", () => {
                                    shadowSelectedSorting.blocks[blockKey].layouts[layoutName][index].fixed = scrollabelInput.checked;
                                    const tag = `sectionFixed_${simpleHash(JSON.stringify(section) + JSON.stringify(index))}`;
                                    if (section.fixed != scrollabelInput.checked) {
                                        console.log("Different", tag);
                                        this.addEdit(tag);
                                    }
                                    else {
                                        console.log("Equal", tag);
                                        this.removeEdit(tag);
                                    }
                                });
                                sectionDiv.append(sectionTitle, scrollableHolder, scrollableInfo, elementsEditor);
                                target.append(sectionDiv);
                            }
                        }
                    };
                    const blockTitle = document.createElement("h2");
                    blockTitle.agd("columnsEditorBlockTitle");
                    const desc1 = document.createElement("p");
                    desc1.agd("columnsEditorDescriptionText");
                    blockTitle.innerHTML = blockProps.name;
                    desc1.innerHTML = "Select active layout";
                    const selectedLayout = document.createElement("select");
                    selectedLayout.agd("columnsEditorSelectInput");
                    for (const layoutKey of Object.keys(blockProps.layouts)) {
                        const layoutOption = document.createElement("option");
                        layoutOption.value = layoutKey;
                        layoutOption.innerHTML = layoutKey;
                        if (layoutKey == blockProps.selected) {
                            layoutOption.selected = true;
                        }
                        selectedLayout.append(layoutOption);
                    }
                    const desc2 = document.createElement("p");
                    desc2.agd("columnsEditorDescriptionText");
                    desc2.innerHTML = "Editing layout: ";
                    const currentlyEditedLayout = document.createElement("select");
                    currentlyEditedLayout.agd("columnsEditorSelectInput");
                    for (const layoutKey of Object.keys(blockProps.layouts)) {
                        const layoutOption = document.createElement("option");
                        layoutOption.value = layoutKey;
                        layoutOption.innerHTML = layoutKey;
                        if (layoutKey == blockProps.selected) {
                            layoutOption.selected = true;
                        }
                        currentlyEditedLayout.append(layoutOption);
                    }
                    const editor = document.createElement("div");
                    editor.agd("columnsEditorHolder");
                    //Functions
                    spawnEditor(blockProps.selected, editor);
                    //Listeners
                    currentlyEditedLayout.addEventListener("input", () => {
                        spawnEditor(currentlyEditedLayout.value, editor);
                    });
                    selectedLayout.addEventListener("input", () => {
                        shadowSelectedSorting.blocks[blockKey].selected = selectedLayout.value;
                        if (blockProps.selected != selectedLayout.value) {
                            editPrefsObj.addEdit("selectedLayout_" + blockProps.name);
                        }
                        else {
                            editPrefsObj.removeEdit("selectedLayout_" + blockProps.name);
                        }
                    });
                    this.elements.pages.columnsEditor.append(blockTitle, desc1, selectedLayout, desc2, currentlyEditedLayout, editor);
                }
            };
            columnsEditor();
        }
    };
    //Initializers
    editPrefsObj.hideMainTab();
    editPrefsObj.refreshPages();
    ///Pages:
    ///columns editor
    //hide all pages
    Object.values(editPrefsObj.elements.pages).forEach((page) => {
        changeVisible(page, false);
    });
    //make the first one show
    editPrefsObj.switchPage("columnsEditor");
    //Listeners
    ///main tab
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
    ///Save
    editPrefsObj.elements.saveBtn.addEventListener("click", function () {
        if (editPrefsObj.state.editing.size != 0) {
            editPrefsObj.switchPage(editPrefsObj.state.currentPage, 1);
        }
    });
    //Reset
    editPrefsObj.elements.resetBtn.addEventListener("click", async function () {
        if (editPrefsObj.state.editing.size != 0 && await trueFalsePrompt("Do you want to delete the changes you just made?")) {
            editPrefsObj.switchPage(editPrefsObj.state.currentPage, 2);
        }
    });
}
else {
    console.error("Couldn't find the user preferences menu box");
}
//Notifications
function newAlert(message) {
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
    }
    else {
        console.error("Alert box is undefined: Appending new message is impossible");
    }
}
//# sourceMappingURL=script.js.map