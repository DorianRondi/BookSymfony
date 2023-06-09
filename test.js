function secondSymbol(s, symbol) {
    let occurence = -1;
    let count = 0;
    for (const elt of s) {
            occurence++;
        if (elt === symbol){
            ++count;
            if (count == 2) {
                return occurence;
            }
        }
    }
    return -1;
}

console.log(secondSymbol('Hello world!!!', 'l'));
console.log(secondSymbol('Hello world!!!', 'o'));
console.log(secondSymbol('Hello world!!!', 'A'));
console.log(secondSymbol('', 'q'));
console.log(secondSymbol('Hello', '!'));