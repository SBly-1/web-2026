// Простые числа
function isPrime(number) {
    if (!Number.isInteger(number) || number < 2) {
        return false
    }
    for (let i = 2; i * i <= number; i++) {
        if (number % i === 0) {
            return false
        }
    }
    return true
}
function getPrimeMessage(arr) {
    if (arr.length !== 0) {
        if (arr.length === 1) {
            return 'простое число'
        } 
        return 'простые числа'
    }
}

function getNotPrimeMessage(arr) {
    if (arr.length === 1) {
        return "не простое число"
    }
    return "не простые числа"
}

function isCorrectNumber(value) {
    return typeof value === "number" && !Number.isNaN(value);
}

function isPrimeNumber(value) {
    if ((typeof(value) !== "number") && !Array.isArray(value)) {
        return console.log('Ошибка: Передан параметр неподходящего типа')
    } 
    if (typeof(value) == "number") {
        if (isPrime(value)) {
            return console.log('Результат:', value, 'простое число')
        } else {
            return console.log('Результат:', value, 'не простое число')
        }
    }

    if (value.length === 0) {
        return console.log("Результат: массив пустой")
    }

    for (const item of value) {
        if (!isCorrectNumber(item)) {
            return console.log("Ошибка: Найден элемент массива неподходящего типа")
        }
    }

    const primes = []
    const notPrimes = []
 
    for (const item of value) {
        if (isPrime(item)) {
            primes.push(item)
        } else {
            notPrimes.push(item)
        }
    }

    const result = []

    if (primes.length > 0) {
        result.push(`${primes.join(", ")} ${getPrimeMessage(primes)}`)
    }
    if (notPrimes.length > 0) {
        result.push(`${notPrimes.join(", ")} ${getNotPrimeMessage(notPrimes)}`)
    }
    console.log(`Результат: ${result.join(", ")}`)
}
isPrimeNumber(3)
isPrimeNumber(4)
isPrimeNumber([2, 3])
isPrimeNumber([4, 6])
isPrimeNumber([1, 2, 3, 4])
isPrimeNumber([3, 4, 6])
isPrimeNumber([3, 5, 6])
isPrimeNumber([5, 6])
isPrimeNumber([])
isPrimeNumber(['a', 'b'])
isPrimeNumber('abc')
