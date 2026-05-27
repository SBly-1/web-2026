// Подсчет гласных в строке
function countVowels(str) {
    const vowels = 'аеёиоуыэюя'
    let count = 0

    for (const letter of str.toLowerCase()) {
        if (vowels.includes(letter)) {
            count++
        }
    }
    return count
}

console.log(countVowels("Привет, мир!"))