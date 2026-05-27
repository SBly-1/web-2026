// Пароль 
function generatePassword(size) {
    if (size < 4) {
        return "Ошибка: размер пароля должен быть не меньше 4"
    }
    const lower = "abcdefghijklmnopqrstuvwxyz"
    const upper = "ABCDEFGHIJKLMNOPQRSTUVWXYZ"
    const digits = "0123456789"
    const special = "!@#$%^&*()_+-=[]{};:,.<>?"
    const allSymbols = lower + upper + digits + special
    const password = []

    password.push(lower[Math.floor(Math.random() * lower.length)])
    password.push(upper[Math.floor(Math.random() * upper.length)])
    password.push(digits[Math.floor(Math.random() * digits.length)])
    password.push(special[Math.floor(Math.random() * special.length)])

    for (let i = 4; i < size; i++) {
        password.push(allSymbols[Math.floor(Math.random() * allSymbols.length)])
    }

    for (let i = 0; i < password.length; i++) {
        const randomIndex = Math.floor(Math.random() * password.length)
        const temp = password[i]
        password[i] = password[randomIndex]
        password[randomIndex] = temp
    }
    return password.join("")
}

console.log(generatePassword(10))