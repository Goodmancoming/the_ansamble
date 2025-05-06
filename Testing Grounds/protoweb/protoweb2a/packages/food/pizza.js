// packages/food/pizza.js
import { MenuItem } from '../menu/base.js';
class Pizza extends MenuItem {
  constructor() {
    super('Pizza', 8.50, 'Cheesy pepperoni pizza slice.', 'https://via.placeholder.com/200x150?text=Pizza');
  }
}

export { Pizza };