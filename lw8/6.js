// Метод map для объекта
function mapObject(obj, newValue) {
    const result = {}
    for (const key in obj) {
        result[key] = newValue(obj[key])
    }
    return result
}
const nums = { a: 1, b: 2, c: 3 }
console.log(mapObject(nums, x => x * 2))