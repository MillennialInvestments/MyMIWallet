const getMonthLabels = (start = { startYear: 0, startMonth: 0, startDay: 0 }, end = { endYear: 0, endendMonth: 0, endDay: 0 }, showYears) => {
    const MONTHS = [
        'January',
        'February',
        'March',
        'April',
        'May',
        'June',
        'July',
        'August',
        'September',
        'October',
        'November',
        'December'
    ];



    const yearsBetween = end.endYear - start.startYear + 1;
    const monthsBetween = (end.endendMonth + 12 - start.startMonth + 1) + (yearsBetween - 1) * 12;
    console.log(yearsBetween, monthsBetween);

    //We use these months as labels
    const myNames = [];

    for (let index = 0; index < monthsBetween; index++) {
        const currentMonth = start.startMonth + index;
        const currentYear = showYears ? start.startYear + Math.floor((currentMonth - 1) / 12) : "";
        const element = MONTHS[(currentMonth - 1) % 12];
        myNames.push(`${element} ${currentYear}`);
    }

    return myNames;
}


/**
 * type: Expense, Income

 */
const expensesOrIncomes = (type, budgetData, start = { startYear: 0, startMonth: 0, startDay: 0 }, end = { endYear: 0, endendMonth: 0, endDay: 0 }) => {
    const result = new Map([]);

    let newData = budgetData
        .filter((element) => {
            const elementNumericalDate = parseInt(element.year) * 10000 + parseInt(element.month) * 100 + parseInt(element.day);
            const startNumericalDate = start.startYear * 10000 + start.startMonth * 100 + start.startDay;
            const endNumericalDate = end.endYear * 10000 + end.endendMonth * 100 + end.endDay;


            return (element.account_type == type &&
                elementNumericalDate >= startNumericalDate &&
                elementNumericalDate <= endNumericalDate)
        })
        .sort((first, second) => {
            const firstNumericalDate = parseInt(first.year) * 10000 + parseInt(first.month) * 100 + parseInt(first.day);
            const secondNumericalDate = parseInt(second.year) * 10000 + parseInt(second.month) * 100 + parseInt(second.day);

            return firstNumericalDate - secondNumericalDate

        })
        .forEach(cleanElement => {
            if (result.has(`${cleanElement.year}${cleanElement.month}`)) {
                result.set(`${cleanElement.year}${cleanElement.month}`, result.get(`${cleanElement.year}${cleanElement.month}`) + parseFloat(cleanElement.gross_amount));
            } else {
                result.set(`${cleanElement.year}${cleanElement.month}`, +parseFloat(cleanElement.gross_amount));
            }
        })

    const yearsBetween = end.endYear - start.startYear + 1;
    const monthsBetween = (end.endendMonth + 12 - start.startMonth + 1) + (yearsBetween - 1) * 12;

    const resultArray = [];

    for (let index = 0; index < monthsBetween; index++) {
        let amount = 0;
        const currentMonth = start.startMonth + index;
        const currentYear = start.startYear + Math.floor((currentMonth - 1) / 12);

        if (result.has(currentYear.toString() + ((currentMonth - 1) % 12 + 1).toString())) {
            amount = result.get(currentYear.toString() + ((currentMonth - 1) % 12 + 1).toString())
        }

        resultArray.push(amount);
    }

}