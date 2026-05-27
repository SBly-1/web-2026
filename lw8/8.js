// Объединение map и filter
const numbers = [2, 5, 8, 10, 3]
const result = numbers.map(number => number * 3).filter(number => number > 10)
console.log(result)