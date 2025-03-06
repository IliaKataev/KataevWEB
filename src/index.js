// Класс пиццы
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

        this.toppings = {
            "mozzarella": { price: 50, calories: 20 },
            "cheeseBorder": { price: size === "маленькая" ? 150 : 300, calories: 50 },
            "cheddarParmesan": { price: size === "маленькая" ? 150 : 300, calories: 50 }
        };

        this.type = type;
        this.size = size;
        this.selectedToppings = [];
    }

    addTopping(topping) {
        if (!this.selectedToppings.includes(topping)) {
            this.selectedToppings.push(topping);
        }
    }

    removeTopping(topping) {
        this.selectedToppings = this.selectedToppings.filter(t => t !== topping);
    }

    getToppings() {
        return this.selectedToppings;
    }

    getSize() {
        return this.size;
    }

    getStuffing() {
        return this.type;
    }

    calculatePrice() {
        let basePrice = this.types[this.type].price + this.sizeModifiers[this.size].price;
        let toppingsPrice = this.selectedToppings.reduce((sum, topping) => sum + this.toppings[topping].price, 0);
        return basePrice + toppingsPrice;
    }

    calculateCalories() {
        let baseCalories = this.types[this.type].calories + this.sizeModifiers[this.size].calories;
        let toppingsCalories = this.selectedToppings.reduce((sum, topping) => sum + this.toppings[topping].calories, 0);
        return baseCalories + toppingsCalories;
    }
}

let pizza = new Pizza("Маргарита", "маленькая");

function selectPizza(type) {
    const currentPizza = document.querySelector('.pizza-item.selected');
    if (currentPizza) {
        currentPizza.classList.remove('selected');
    }

    const pizzaItem = document.querySelector(`.pizza-item[data-type="${type}"]`);
    pizzaItem.classList.add('selected');

    pizza = new Pizza(type, pizza.size);
    updateButton();
}

function toggleSize() {
    const sizeToggle = document.getElementById("sizeToggle");
    const size = sizeToggle.checked ? "большая" : "маленькая";
    pizza.size = size;
    updateButton();
}

function toggleTopping(topping) {
    const toppingElement = document.querySelector(`.topping-item[onclick="toggleTopping('${topping}')"]`);
    toppingElement.classList.toggle('selected');

    if (toppingElement.classList.contains('selected')) {
        pizza.addTopping(topping);
    } else {
        pizza.removeTopping(topping);
    }

    updateButton();
}

function calculatePizza() {
    const price = pizza.calculatePrice();
    const calories = pizza.calculateCalories();

    document.getElementById("result").innerHTML = `Цена: ${price} руб.<br>Калории: ${calories} ккал.`;
}

function updateButton() {
    const price = pizza.calculatePrice();
    const calories = pizza.calculateCalories();

    const button = document.getElementById("orderButton");

    if (price > 0 && calories > 0) {
        button.classList.remove('disabled');
        button.classList.add('enabled');
        button.innerText = `Добавить в заказ за ${price} руб. | ${calories} ккал.`;
    } else {
        button.classList.remove('enabled');
        button.classList.add('disabled');
        button.innerText = 'Выберите пиццу и ингредиенты';
    }
}
