//DECLARATIONS
const buys = document.getElementById("buys");
const sells = document.getElementById("sells");
const data = JSON.parse(document.getElementById("orderBookFetch").innerHTML);
let lastData = data;
//Controller variables
const closeBtn = document.getElementById("close");
const openBtn = document.getElementById("open");
const buyBtn = document.getElementById("buySubmit");
const sellBtn = document.getElementById("sellSubmit");
//Chose variables to display in the colums. Adding more here just requires more small calculations.
const columns = ["initial_coin_value", "amount", "total"];
if (data[1][0]) {
	const url = data[0];
	const id = data[1][0].id;
	let listLength = 10;
	let decimals = 8;
	let evtSource;
	//FUNCTIONS
	let timeframe = 1440 * 60; //Display a value every 1d
	let timeWindow = 1440 * 60 * 365; //Number of visible "candles"
	let oldMem;

	//Date function

	const elapsedToHour = (elapsed, bool = true) => {
		const seconds = elapsed % 60 >= 10 ? elapsed % 60 : `0${elapsed % 60}`;
		const minutes =
			((elapsed - seconds) % 3600) / 60 >= 10
				? (((elapsed - seconds) % 3600) / 60) % 60
				: `0${(((elapsed - seconds) % 3600) / 60) % 60}`;
		const hours =
			(elapsed - seconds - minutes * 60) / 3600 >= 10
				? (elapsed - seconds - minutes * 60) / 3600
				: `0${(elapsed - seconds - minutes * 60) / 3600}`;
		if (bool) {
			return `${hours}:${minutes}:${seconds}`;
		} else {
			return `${hours}:${minutes}`;
		}
	};
	const dateTimeToElapsed = (dateTime) => {
		const date = dateTime.split(" "); //Given a datetime property with a space in between, returns as the [0] the date and as the [1] the time
		const timeArray = date[1].split(":");
		return (
			parseInt(timeArray[0], 10) * 3600 +
			parseInt(timeArray[1], 10) * 60 +
			parseInt(timeArray[2], 10)
		);
	};
	const dateTimeSplit = (dateTime, bool = true) => {
		const date = dateTime.split(" "); //Given a datetime property with a space in between, returns as the [0] the date and as the [1] the time
		if (bool) {
			return date[0];
		} else {
			return date[1];
		}
	};
	const dateToString = (date, bool = true) => {
		const year =
			parseInt(date.getFullYear(0)) >= 10
				? date.getFullYear(0)
				: `0${date.getFullYear(0)}`;
		const month =
			parseInt(date.getMonth() + 1) >= 10
				? date.getMonth() + 1
				: `0${date.getMonth() + 1}`;
		const day =
			parseInt(date.getDate()) >= 10 ? date.getDate() : `0${date.getDate()}`;
		const dateD = year + "-" + month + "-" + day;

		const hours =
			parseInt(date.getHours()) >= 10 ? date.getHours() : `0${date.getHours()}`;
		const minutes =
			parseInt(date.getMinutes()) >= 10
				? date.getMinutes() + 1
				: `0${date.getMinutes() + 1}`;
		const seconds =
			parseInt(date.getSeconds()) >= 10
				? date.getSeconds()
				: `0${date.getSeconds()}`;

		const timeD = hours + ":" + minutes + ":" + seconds;
		if (bool) {
			return dateD + " " + timeD;
		} else {
			return dateD;
		}
	};

	const getDaysArray = function (x, e, bool = true) {
		var s = new Date(e);
		s.setDate(s.getDate() - x);

		for (var a = []; s <= e; s.setDate(s.getDate() + 1)) {
			a.push(new Date(s));
		}
		if (bool) {
			a = a.map((date) => {
				return dateToString(date, false);
			});
			return a;
		} else {
			return a;
		}
	};

	const getHourArray = function (timeframe, day = false) {
		let intradayDivision = [];
		for (i = 1440; i > 0; i = i - timeframe / 60) {
			if (day) {
				intradayDivision.push(day + " " + elapsedToHour(i * 60, false));
			} else {
				intradayDivision.push(elapsedToHour(i * 60, false));
			}
		}
		return intradayDivision;
	};

	//Chart function
	const dataGen = (arrayOfOrders, filter = false) => {
		if (timeframe > 1440 * 60) {
			window.alert("Timeframe not supporded");
		} else {
			const today = new Date();
			//Data format: "2020-10-23 23:59:59"
			//Take out just the closed orders
			arrayOfOrders = arrayOfOrders.filter((order) => {
				return order.status == "Closed";
			});
			if (!(arrayOfOrders[0].id == oldMem)) {
				oldMem = arrayOfOrders[0].id;
				//Sort them by how they came in, the last closed order of a specific time period will always define the last price
				arrayOfOrders.sort((a, b) => b.id - a.id);
				//Math functions to take the text property and parse it into

				//Remap the array in a more useful fashion
				arrayOfOrders.forEach((order) => {
					order.datetime = order.current_date;
					order.elapsed = dateTimeToElapsed(order.datetime);
					order.day = dateTimeSplit(order.datetime);
				});

				//Get time elapsed from midnight today

				//Take the orders and make a map of them
				const chartMap = new Map();
				if (timeframe == 1440 * 60) {
					arrayOfOrders.forEach((order) => {
						//Map way
						if (chartMap.has(order.day)) {
							let list = chartMap.get(order.day);
							list.push(order);
						} else {
							chartMap.set(order.day, [order]);
						}
					});
				} else {
					let intradayDivision = [];
					for (i = 0; i < 1440; i = i + timeframe / 60) {
						intradayDivision.push(i);
					}
					arrayOfOrders.forEach((order) => {
						if (chartMap.has(order.day)) {
							const dayMap = chartMap.get(order.day);
							intradayDivision.forEach((periodStart) => {
								if (
									order.elapsed > periodStart * 60 &&
									order.elapsed <= periodStart * 60 + timeframe
								) {
									const periodEnd = elapsedToHour(periodStart * 60 + timeframe);
									if (dayMap.has(periodEnd)) {
										const intraHourArray = dayMap.get(periodEnd);
										intraHourArray.push(order);
										dayMap.set(periodEnd, intraHourArray);
									} else {
										dayMap.set(periodEnd, [order]);
									}
									chartMap.set(order.day, dayMap);
								}
							});
						} else {
							const dayMap = new Map();
							intradayDivision.forEach((periodStart) => {
								if (
									order.elapsed > periodStart * 60 &&
									order.elapsed <= periodStart * 60 + timeframe
								) {
									const periodEnd = elapsedToHour(
										periodStart * 60 + timeframe,
										false
									);
									dayMap.set(periodEnd, [order]);
									chartMap.set(order.day, dayMap);
								}
							});
						}
					});
				}
				let xAxis = [];
				let yAxis = [];
				//Date subtraction and foreach for daily
				//For i in timewindow for intraday

				//Time window enabled for daily
				if (timeframe == 1440 * 60) {
					xAxis = getDaysArray(timeWindow / timeframe, today);
					xAxis.forEach((datetime) => {
						const date = dateTimeSplit(datetime);
						if (chartMap.has(date)) {
							yAxis.push(chartMap.get(date)[0].initial_coin_value);
						} else {
							if (filter) {
								xAxis = xAxis.filter((element) => element != datetime);
							} else {
								yAxis.push("Nothing for " + datetime);
							}
						}
					});
					//Time window not enabled yet for intraday
				} else {
					// let stop = 0;
					chartMap.forEach((hour, day) => {
						xAxis = [...xAxis, ...getHourArray(timeframe, day, true)];
					});
					// Slice depending on limit
					let x = 0;
					xAxis.forEach((datetime) => {
						if (x <= timeWindow / timeframe || !filter) {
							x++;
							if (chartMap.has(dateTimeSplit(datetime))) {
								if (
									chartMap
										.get(dateTimeSplit(datetime))
										.has(dateTimeSplit(datetime, false))
								) {
									yAxis.push(
										chartMap
											.get(dateTimeSplit(datetime))
											.get(dateTimeSplit(datetime, false))[0].initial_coin_value
									);
								} else {
									if (filter) {
										xAxis = xAxis.filter((element) => element != datetime);
									} else {
										yAxis.push("Nothing for " + datetime);
									}
								}
							} else {
								if (filter) {
									xAxis = xAxis.filter((element) => element != datetime);
								} else {
									yAxis.push("Nothing for " + datetime);
								}
							}
						}
						if (filter) {
							xAxis = xAxis.slice(0, timeWindow / timeframe);
							yAxis = yAxis.slice(0, timeWindow / timeframe);
						}
					});
					console.log(xAxis);
					console.log(yAxis);
				}
				//Plotting
				const container = document.getElementById("chart-container");
				container.innerHTML = "";
				container.innerHTML = `<canvas id="myChart" width="400" height="400"></canvas>`;
				var ctx = document.getElementById("myChart");
				const data = {
					labels: xAxis,
					datasets: [
						{
							label: "MYMI/USD",
							data: yAxis,
							fill: false,
							borderColor: "rgb(75, 192, 192)",
							tension: 0.1,
						},
					],
				};
				var myChart = new Chart(ctx, {
					type: "line",
					data: data,
					options: {
						animation: {
							duration: 0,
						},
						maintainAspectRatio: false,
						scales: {
							y: {
								beginAtZero: true,
							},
						},
					},
				});
			}
		}
	};
	//Function that takes an array of orders and devides them between buys and sells
	const parser = (arrayOfOrders) => {
		lastData = arrayOfOrders;

		const buyOrders = arrayOfOrders.filter((order) => {
			return order.trade_type == "Buy" && order.status == "Open";
		});
		const sellOrders = arrayOfOrders.filter((order) => {
			return order.trade_type == "Sell" && order.status == "Open";
		});
		buyOrders.sort((a, b) => {
			return b.initial_coin_value - a.initial_coin_value;
		});
		sellOrders.sort((a, b) => {
			return a.initial_coin_value - b.initial_coin_value;
		});
		tableGenerator(buys, buyOrders);
		tableGenerator(sells, sellOrders);
	};
	//Function that generates a list of elements given the lenght of the desired list - possible iteration to save memory could be to not run this function but to change each individual element innerHTML when new messages arrive
	const tableGenerator = (target, data) => {
		//Clean the previous list content
		target.textContent = "";
		//Go through the lenght of the list and generate a row for each
		for (var i = 0; i < data.length; i++) {
			//Length + 1 because arrays start from 0 and we keep the listLength property accessible
			const content = data[i];
			const row = document.createElement("tr");
			//Add buy field
			row.classList.add("order-row");
			row.classList.add("font-inherit");
			columns.forEach((name) => {
				const column = document.createElement("td");
				column.classList.add(`${name}-field`);
				column.classList.add("font-inherit");
				//Since the price variable is not listed in the object, calculate it
				column.innerHTML = content[name];
				row.appendChild(column);
			});
			//Append to table
			target.appendChild(row);
		}
	};
	////LISTENER EVENTS
	parser(data[1]);
	//Open source
	let startSource = () => {
		evtSource = new EventSource(
			//~  Online
			//~ `https://www.mymiwallet.com/index.php/Exchange/Order_Event_Manager/${url + id}`, { withCredentials: true }
			//~  Localhost
			`http://localhost/MillennialInvest/Site-v7/v1.3/index.php/Exchange/Order_Event_Manager/${url + id}`, { withCredentials: true }
			//~  Remote Localhost
			//~ `http://192.168.0.3/MillennialInvest/Site-v7/v1.3/index.php/Exchange/Order_Event_Manager/${url + id}`, { withCredentials: true }
		);
		console.log("> Event Source connected!");
		evtSource.onmessage = (message) => {
			//This change requires the backend message to be sent in a separated form: {book:{listoforders},chart{listofcompletedtransactions}};
			parser(JSON.parse(message.data));

			dataGen(JSON.parse(message.data),true);
			console.log(JSON.parse(message.data));
		};

		evtSource.onerror = (error) => {
			console.log(
				"> An error occourred:",
				error,
				"\n\n> Try again by clicking refresh"
			);
			closeSource();
		};
		closeBtn.style.display = "block";
		openBtn.style.display = "none";
	};
	//Close source
	const closeSource = () => {
		evtSource.close();
		console.log("> Event Source Closed");
		openBtn.style.display = "block";
		closeBtn.style.display = "none";
	};
	//EVENT LISTENERS

	//~ buyBtn.addEventListener("click", closeSource);
	//~ sellBtn.addEventListener("click", closeSource);
	closeBtn.addEventListener("click", closeSource);
	openBtn.addEventListener("click", startSource);
	//Start polling from the database
	startSource();
	//~ window.beforeunload = closeSource();
} else {
	openBtn.style.display = "none";
	closeBtn.style.display = "none";
}

function calculateBuy()
{
	// Get Variables
	var cost 															= document.getElementById('current_coin_value').value;
	var amount 															= document.getElementById('buy_amount').value;
	var gas	 															= document.getElementById('buy_gas_fee').value;
	var tpercent														= document.getElementById('buy_trans_percent').value;
	var tfee 															= document.getElementById('buy_trans_fee').value;
	//do the math
	var gasfee															= amount * gas;
	var subtotal 														= amount / cost;
	var total															= subtotal - gasfee;
	var expenses														= amount * tpercent + +tfee;
	var total_cost														= +amount + +expenses;
	//update                                           
	// Current Coin Value
	//~ document.getElementById('buy_coin_value_display').innerHTML			= cost;
	//~ document.getElementById('buy_coin_value').value						= cost;
	document.getElementById('buy_amount').value							= amount;
	// Total Coin Value Generation & Placement
	document.getElementById('buy_total').value 							= total.toFixed(0);
	document.getElementById('buy_total').value 							= total.toFixed(0);
	TotalCoins															= parseFloat(total).toFixed(0);   
	document.getElementById('buy_total_coins').innerHTML				= Number(TotalCoins).toLocaleString('en');   
	// Gas Fee Value Generation & Placement
	document.getElementById('buy_user_gas_fee').value 					= gasfee;                                 
	document.getElementById('buy_user_trans_percent').value 			= amount * tpercent;                                 
	// Fees Value Generation & Placement                         
	document.getElementById('buy_fees').value 							= expenses.toFixed(2); 
	Fees						                                   		= parseFloat(expenses).toFixed(2);
	document.getElementById('buy_fees_display').innerHTML				= "$" + Fees.toLocaleString('en');       
	// Total Cost Value Generation & Placement   
	document.getElementById('buy_total_cost').value 					= total_cost.toFixed(2);
	TotalCost		                                            		= parseFloat(total_cost).toFixed(2);
	document.getElementById('buy_total_cost_display').innerHTML			= "$" + parseFloat(TotalCost).toLocaleString('en');                        
}
function clearBuyContent() 
{                                                                   
	document.getElementById('buy_coin_value').value						= "";
	document.getElementById('buy_amount').value	 						= "";
	// Total Coin Value Generation & Placement
	document.getElementById('buy_total').value 							= "";   
	document.getElementById('buy_total_coins').innerHTML				= "";   
	// Gas Fee Value Generation & Placement
	document.getElementById('buy_user_gas_fee').value 					= "";                                  
	// Fees Value Generation & Placement                         
	document.getElementById('buy_fees').value 							= "";                 
	document.getElementById('buy_fees_display').innerHTML				= "";       
	// Total Cost Value Generation & Placement   
	document.getElementById('buy_total_cost').value 					= "";               
	document.getElementById('buy_total_cost_display').innerHTML			= ""; 
}
function calculateSell()
{
	// Get Variables
	var cost 															= document.getElementById('current_coin_value').value;
	var amount 															= document.getElementById('sell_amount').value;
	var gas	 															= document.getElementById('sell_gas_fee').value;
	var tpercent														= document.getElementById('sell_trans_percent').value;
	var tfee 															= document.getElementById('sell_trans_fee').value;
	//do the math
	var gasfee															= amount * gas;
	var subtotal 														= amount / cost;
	var total															= subtotal - gasfee;
	var expenses														= amount * tpercent + +tfee;
	var total_cost														= +amount + +expenses;
	//update                                           
	// Current Coin Value
	//~ document.getElementById('sell_coin_value_display').innerHTM			= cost;
	//~ document.getElementById('sell_coin_value').value					= cost;
	document.getElementById('sell_amount').value						= amount;
	// Total Coin Value Generation & Placement
	document.getElementById('sell_total').value 						= total.toFixed(0);
	document.getElementById('sell_total').value 						= total.toFixed(0);
	TotalCoins															= parseFloat(total).toFixed(0);   
	document.getElementById('sell_total_coins').innerHTML				= Number(TotalCoins).toLocaleString('en');   
	// Gas Fee Value Generation & Placement
	document.getElementById('sell_user_gas_fee').value 					= gasfee;                                 
	document.getElementById('sell_user_trans_percent').value 			= amount * tpercent;                                 
	// Fees Value Generation & Placement                         
	document.getElementById('sell_fees').value 							= expenses.toFixed(2); 
	Fees						                                   		= parseFloat(expenses).toFixed(2);
	document.getElementById('sell_fees_display').innerHTML				= "$" + Fees.toLocaleString('en');       
	// Total Cost Value Generation & Placement   
	document.getElementById('sell_total_cost').value 					= total_cost.toFixed(2);
	TotalCost		                                            		= parseFloat(total_cost).toFixed(2)
	document.getElementById('sell_total_cost_display').innerHTML		= "$" + parseFloat(TotalCost).toLocaleString('en');                        
}
function clearSellContent() 
{                                                                          
	document.getElementById('sell_coin_value').value					= "";
	document.getElementById('sell_amount').value	 					= "";
	// Total Coin Value Generation & Placement
	document.getElementById('sell_total').value							= "";   
	document.getElementById('sell_total_coins').innerHTML				= "";   
	// Gas Fee Value Generation & Placement
	document.getElementById('sell_user_gas_fee').value 					= "";                                  
	// Fees Value Generation & Placement                         
	document.getElementById('sell_fees').value 							= "";                 
	document.getElementById('sell_fees_display').innerHTML				= "";       
	// Total Cost Value Generation & Placement   
	document.getElementById('sell_total_cost').value 					= "";               
	document.getElementById('sell_total_cost_display').innerHTML		= ""; 
}

