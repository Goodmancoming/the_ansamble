// packages/menu/generic.js
import { MenuItem } from './base.js';
class GenericItem extends MenuItem {
  constructor(name, price, description, image) {
    super(name, price, description, image);
  }
}

export { GenericItem };