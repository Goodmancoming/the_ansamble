// main.js
import { Coffee } from './packages/drinks/coffee.js';
import { Pizza } from './packages/food/pizza.js';
import { GenericItem } from './packages/menu/generic.js';

class CafeApp {
  #menu = [];
  constructor(containerId, formId) {
    this.container = document.getElementById(containerId);
    this.form = document.getElementById(formId);
    this._init();
  }
  _init() {
    // Abstraction: define initial menu
    this.#menu.push(new Coffee(), new Pizza());
    this._renderMenu();
    this._bindForm();
  }
  _renderMenu() {
    this.container.innerHTML = '';
    this.#menu.forEach(item => {
      const card = item.renderCard();
      card.querySelector('button').addEventListener('click', () => this._order(item));
      this.container.appendChild(card);
    });
  }
  _order(item) {
    alert(`You ordered: ${item.getName()} for Rp${item.getPrice().toFixed(2)}`);
    if (typeof item.serve === 'function') item.serve(); // Interface check
  }
  _bindForm() {
    this.form.addEventListener('submit', e => {
      e.preventDefault();
      const type = document.getElementById('itemType').value;
      const name = document.getElementById('itemName').value;
      const price = parseFloat(document.getElementById('itemPrice').value);
      const desc = document.getElementById('itemDesc').value;
      const img = document.getElementById('itemImage').value || 'https://via.placeholder.com/200x150';
      let item;
      if (type === 'drink') {
        item = new GenericItem(name, price, desc, img);
      } else {
        item = new GenericItem(name, price, desc, img);
      }
      this.#menu.push(item); // Polymorphism: GenericItem treated as MenuItem
      this._renderMenu();
      this.form.reset();
    });
  }
}

document.addEventListener('DOMContentLoaded', () => {
  new CafeApp('menu', 'addForm');
});
