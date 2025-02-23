class Pizza {
    constructor(type, size) {
        this.types = {
            "Маргарита": { price: 500, calories: 300 },
            "Пепперони": { price: 800, calories: 400 },
            "Баварская": { price: 700, calories: 450 }
        };
        this.sizeModifiers = {
            "маленькая": { price: 100, calories: 100 },
            "большая": { price: 200, calories: 200 }
        };
        this.toppings = [];
        this.type = type;
        this.size = size;
    }
    addTopping(topping) {
        this.toppings.push(topping);
    }
    calculatePrice() {
        let basePrice = this.types[this.type].price + this.sizeModifiers[this.size].price;
        let toppingsPrice = this.toppings.reduce((sum, t) => sum + t.price, 0);
        return basePrice + toppingsPrice;
    }
    calculateCalories() {
        let baseCalories = this.types[this.type].calories + this.sizeModifiers[this.size].calories;
        let toppingsCalories = this.toppings.reduce((sum, t) => sum + t.calories, 0);
        return baseCalories + toppingsCalories;
    }
}

function calculatePizza() {
    let type = document.getElementById("pizzaType").value;
    let size = document.getElementById("pizzaSize").value;
    let pizza = new Pizza(type, size);

    let toppingsData = {
        "mozzarella": { price: 50, calories: 20 },
        "cheeseBorder": size === "маленькая" ? { price: 150, calories: 50 } : { price: 300, calories: 50 },
        "cheddarParmesan": size === "маленькая" ? { price: 150, calories: 50 } : { price: 300, calories: 50 }
    };

    if (document.getElementById("mozzarella").checked) {
        pizza.addTopping(toppingsData.mozzarella);
    }
    if (document.getElementById("cheeseBorder").checked) {
        pizza.addTopping(toppingsData.cheeseBorder);
    }
    if (document.getElementById("cheddarParmesan").checked) {
        pizza.addTopping(toppingsData.cheddarParmesan);
    }

    document.getElementById("result").innerText = `Стоимость: ${pizza.calculatePrice()} руб. Калорийность: ${pizza.calculateCalories()} ккал.`;
}
