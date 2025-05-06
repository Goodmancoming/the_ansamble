class Person {
    constructor(name, age, height, weight){
        this.name = name;
        this.age = age;
        this.height = height;
        this.weight = weight;
    }
    getName(){
        console.log(this.name);
    }
    getAge(){
        console.log(this.age);
    }
    getHeight(){
        console.log(this.height);
    }
    getWeight(){
        console.log(this.weight);
    }
}

class Revan extends Person {
    constructor(){
        super('Revan', 90, 90, 15);
    }
}

class John extends Person {
    constructor(){
        super('John', 25, 200, 90);
    }
}

class Bimo extends Person {
    constructor(){
        super('Bimo', 16, 180, 75);
    }
}

const revan = new Revan();
const john = new John();
const bimo = new Bimo();

revan.getName();//
revan.getAge();//
revan.getHeight();//
revan.getWeight();//

john.getName();//
john.getAge();//
john.getHeight();//
john.getWeight();//

bimo.getName();//
bimo.getAge();//
bimo.getHeight();//
bimo.getWeight();//

/*
//===============================================================================================

function createPerson(name, age, height, weight) {
    return {
        name,
        age,
        height,
        weight,
        getName() {
            console.log(this.name);
        },
        getAge() {
            console.log(this.age);
        },
        getHeight() {
            console.log(this.height);
        },
        getWeight() {
            console.log(this.weight);
        }
    };
}

function Revan() {
    return createPerson('Revan', 90, 90, 15);
}

function John() {
    return createPerson('John', 25, 200, 90);
}

function Bimo() {
    return createPerson('Bimo', 16, 180, 75);
}

const revan = Revan();
const john = John();
const bimo = Bimo();

revan.getName();  // "Revan"
john.getAge();    // 25
bimo.getHeight(); // 180

//===============================================================================================

function Person(name, age, height, weight) {
    this.name = name;
    this.age = age;
    this.height = height;
    this.weight = weight;

    this.getName = function() {
        console.log(this.name);
    };
    this.getAge = function() {
        console.log(this.age);
    };
    this.getHeight = function() {
        console.log(this.height);
    };
    this.getWeight = function() {
        console.log(this.weight);
    };
}

function Revan() {
    return new Person('Revan', 90, 90, 15);
}

function John() {
    return new Person('John', 25, 200, 90);
}

function Bimo() {
    return new Person('Bimo', 16, 180, 75);
}

const Revan = Revan();
revan.getName();  // "Revan"
const john = John();
john.getAge();    */