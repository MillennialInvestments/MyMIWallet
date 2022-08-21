let oldMem;
const chartData = [
	{
		status: "Closed",
		id: "25",
		datetime: "2021-08-12 13:12:11",
		initial_coin_value: "0.0001212",
	},
	{
		status: "Closed",
		id: "21",
		datetime: "2021-08-12 10:12:11",
		initial_coin_value: "0.0001312",
	},
	{
		status: "Closed",
		id: "19",
		datetime: "2021-08-11 17:12:11",
		initial_coin_value: "0.0003212",
	},
	{
		status: "Open",
		id: "17",
		datetime: "2021-08-10 13:12:11",
		initial_coin_value: "0.000152",
	},
	{
		status: "Closed",
		id: "15",
		datetime: "2021-08-10 11:12:11",
		initial_coin_value: "0.00012412",
	},
	{
		status: "Closed",
		id: "10",
		datetime: "2021-08-09 10:12:11",
		initial_coin_value: "0.0001512",
	},
	{
		status: "Closed",
		id: "3",
		datetime: "2021-08-07 07:12:11",
		initial_coin_value: "0.000412",
	},
	{
		status: "Open",
		id: "2",
		datetime: "2021-08-06 13:12:11",
		initial_coin_value: "0.0001212",
	},
];
//Chart stuff

// let timeframe = 60 * 4 * 60; //Display a value every 4h
// let timeframe = 45 * 60; //Display a value every 45m
let timeframe = 45 * 60; //Display a value every 1d
let timeWindow = 1440 * 60 * 6; //Number of visible "candles"

const dataGen = (arrayOfOrders, timeframe, timeWindow, filter = false) => {
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
			//Sort them by how they came in, the last closed order of a specific time period will always define the last price
			arrayOfOrders.sort((a, b) => b.id - a.id);
			//Math functions to take the text property and parse it into
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

			//Remap the array in a more useful fashion
			arrayOfOrders.forEach((order) => {
				order.elapsed = dateTimeToElapsed(order.datetime);
				order.day = dateTimeSplit(order.datetime);
			});

			//Get time elapsed from midnight today
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
					parseInt(date.getDate()) >= 10
						? date.getDate()
						: `0${date.getDate()}`;
				const dateD = year + "-" + month + "-" + day;

				const hours =
					parseInt(date.getHours()) >= 10
						? date.getHours()
						: `0${date.getHours()}`;
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
			var getDaysArray = function (x, e, bool = true) {
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
				console.log(xAxis);
				console.log(yAxis);
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
				labels: xAxis.reverse(),
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
				data: chartData,
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
// foreach ($getAllClosedOrders->result_array() as $closedOrders) {
// 	$initial_coin_value			= $closedOrders['initial_coin_value'];
// 	$dates						= $closedOrders['month'] . '/' . $closedOrders['day'];;
// 	$datay[] 					= $initial_coin_value; 	// Append Result Array Data to $datay Array for Y-Axis Data Points (Prices)
// 	$datax[] 					= $dates;				// Append Result Array Data to $datax Array for X-Axis Data Points (Date of Closed Order = Month/Day Ex: 08/07)
// }
