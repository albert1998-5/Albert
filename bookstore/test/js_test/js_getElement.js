let ID_GET = document.getElementById("title");


console.log(ID_GET);



let query_GET = document.querySelector(".second");
console.log(query_GET);

let query_GET_ALL = document.querySelectorAll(".second");
console.log(query_GET_ALL);

let aaa = ["1", "2", "王"];

for (let i = 0; i < 3; i++) {
    console.log(aaa[i]);
}

console.log("---------------------");
var fruits = ["apple", "orange", "cherry"];
fruits.forEach(myFunction);

function myFunction(item, index) {
  document.getElementById("demo").innerHTML += index + ":" + item + "<br>"; 
//   document.getElementById("demo").innerHTML = index + ":" + item + "<br>"; 
}

console.log("---------------------");
for (i in aaa) {
    console.log("aaa[" + i + "] = " + aaa[i]);
}

// array.forEach(element => {
    
// });