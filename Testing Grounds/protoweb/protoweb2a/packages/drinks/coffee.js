// packages/drinks/coffee.js
import { MenuItem } from '../menu/base.js';
class Coffee extends MenuItem {
  constructor() {
    super('Coffee', 2.00, 'Freshly brewed coffee.', "../assets/default.png");
  }
  serve() { console.log(`Serving ${this.getName()}...`); }
}

export { Coffee };