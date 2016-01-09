function PrintStuff(myDocuments) { 
    this.documents = myDocuments; 
}
PrintStuff.prototype.print = function() {
    console.log(this.documents);
}

//Create a new object with the PrintStuff () constructor, thus allowing this new object to inherit PrintStuff's properties and methods.​
var newObj = new PrintStuff("I am a New Object."); 
newObj.print();

function Plant(name,color) {
    this.name = name;
    this.color = color;
    this.country = "Mexico";
    this.isOrganic = true;
}
//alert("ok");
// Add the showNameAndColor method to the Plant prototype property​
Plant.prototype.showNameAndColor = function(name,color) {
    console.log("I am a " + this.name + " and It is " + this.color);
    console.log("I am a " + name + " and It is " + color);
}
Plant.prototype.amIOrganic = function() {
    if (this.isOrganic)
        console.log("I am organic, Baby!");
}
plantObj = new Plant('s','b'); 
plantObj.showNameAndColor('k','y');

function Fruit(fruitName, fruitColor) {
    this.name = fruitName;
    this.color = fruitColor;
}

//​ Set the Fruit's prototype to Plant's constructor, thus inheriting all of Plant.prototype methods and properties.​
Fruit.prototype = new Plant(); 
FruitObj = new Fruit('orange','orangecolor');
FruitObj.amIOrganic();
FruitObj.showNameAndColor('inherit','yes');
//
//// Creates a new object, aBanana, with the Fruit constructor​
//
//var aBanana = new Fruit("Banana", "yellow");
//
////Here, aBanana uses the name property from the aBanana object prototype, which is Fruit.prototype:​
//
//console.log(aBanana.name);
//console.log(aBanana.color);


var myFriends = {name: "Pete"};
//console.log(myFriends.toString ());
console.log(myFriends.name);

