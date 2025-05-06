class MenuItem {
  #name; #price; #description; #image;
  constructor(name, price, description = '', image = '../assets/default.png') {
    if (new.target === MenuItem) throw new Error('Cannot instantiate abstract MenuItem');
    this.#name = name;
    this.#price = price;
    this.#description = description;
    this.#image = image;
  }
  getName() { return this.#name; }
  getPrice() { return this.#price; }
  getDescription() { return this.#description; }
  getImage() { return this.#image; }
  renderCard() {
    const card = document.createElement('div');
    card.className = 'card';
    const image = document.createElement('img');
    image.src = this.getImage();
    image.alt = this.getName();
    const cardContent = document.createElement('div');
    cardContent.className = 'card-content';
    const name = document.createElement('h3');
    name.textContent = this.getName();
    const description = document.createElement('p');
    description.textContent = this.getDescription();
    const price = document.createElement('p');
    price.innerHTML = `<strong>Rp${this.getPrice().toFixed(2)}</strong>`;
    const cardActions = document.createElement('div');
    cardActions.className = 'card-actions';
    const orderButton = document.createElement('button');
    orderButton.dataset.name = this.getName();
    orderButton.textContent = 'Order';
    cardActions.appendChild(orderButton);
    cardContent.appendChild(name);
    cardContent.appendChild(description);
    cardContent.appendChild(price);
    card.appendChild(image);
    card.appendChild(cardContent);
    card.appendChild(cardActions);
    return card;
  }
}

export { MenuItem };
//================================================================================================
// contain s the base class for all menu items, including drinks and food. It defines the properties and methods that all menu items should have, such as name, price, description, image, and a method to render the card for the item. The class is designed to be extended by other classes that represent specific types of menu items (e.g., drinks or food). The constructor initializes the properties, and the renderCard method creates a card element with the item's details. The class also includes getter methods for accessing the properties of the menu item.