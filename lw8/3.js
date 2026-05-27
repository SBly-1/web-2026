//Уникальные элементы в массиве
function uniqueElements(arr) {
    const result = {}
    for (const item of arr) {
        const key = String(item)
        if (result[key] === undefined) {
            result[key] = 1
        } else {
            result[key]++
        }
    }
    return result
}

console.log(uniqueElements(["привет", "hello", 1, "1"]))