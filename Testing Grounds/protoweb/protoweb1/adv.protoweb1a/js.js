// 1) Abstract base class
class UIComponent {
  constructor() {
    if (new.target === UIComponent) {
      throw new Error('Cannot instantiate abstract UIComponent');
    }
  }
  render() {
    throw new Error('render() must be implemented by subclass');
  }
}

// 2) Cart class (encapsulation of cart logic)
class Cart {
  #items = [];
  constructor(countElementId) {
    this.countEl = document.getElementById(countElementId);
    this.updateCount();
  }
  add(item) {
    this.#items.push(item);
    this.updateCount();
  }
  remove(index) {
    this.#items.splice(index, 1);
    this.updateCount();
  }
  get count() {
    return this.#items.length;
  }
  updateCount() {
    this.countEl.innerText = this.count;
  }
}

// instantiate the cart
const cart = new Cart('cartCount');

// 3) ProductCard now extends UIComponent
class ProductCard extends UIComponent {
  #title; #description; #image;
  constructor(title, description, image) {
    super();
    this.#title = title;
    this.#description = description;
    this.#image = image;
  }

  static getRandomColor() {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    return `rgba(${r}, ${g}, ${b}, 1)`;
  }

  render() {
    const card = document.createElement('div');
    card.className = 'product-card';
    card.style.backgroundColor = ProductCard.getRandomColor();
    card.innerHTML = `
      <h2>${this.#title}</h2>
      <p>${this.#description}</p>
      <img src="${this.#image}" alt="Product Image"
           onerror="this.src='smiley-test.png';"
           style="width:80%;height:auto;margin-top:5px;" />
      <br>
      <button class="add-to-cart-btn" style="margin-top:10px;">Add to Cart</button>
    `;

    const btn = card.querySelector('.add-to-cart-btn');
    btn.addEventListener('click', () => {
      cart.add({
        title: this.#title,
        description: this.#description,
        image: this.#image
      });
      btn.textContent = 'Added!';
      btn.disabled = true;
    });

    return card;
  }
}

// 4) DiscountCard shows polymorphism by overriding render()
class DiscountCard extends ProductCard {
  #discount;
  constructor(title, description, image, discount) {
    super(title, description, image);
    this.#discount = discount;
  }
  render() {
    const card = super.render();
    const badge = document.createElement('div');
    badge.className = 'discount-badge';
    badge.innerText = `${this.#discount}% OFF`;
    badge.style.position = 'absolute';
    badge.style.top = '8px';
    badge.style.right = '8px';
    badge.style.padding = '4px 6px';
    badge.style.background = 'rgba(0,0,0,0.6)';
    badge.style.color = 'white';
    badge.style.borderRadius = '4px';
    card.style.position = 'relative';
    card.prepend(badge);
    return card;
  }
}

// 5) ScrollMenu also extends UIComponent
class ScrollMenu extends UIComponent {
  constructor(containerId) {
    super();
    this.container = document.getElementById(containerId);
    this.setupScrollBehavior();
  }
  setupScrollBehavior() {
    this.container.addEventListener('wheel', e => {
      if (e.deltaY !== 0) {
        e.preventDefault();
        this.container.scrollLeft += e.deltaY * 3;
      }
    });
  }
  addComponent(component) {
    // accepts any UIComponent
    this.container.appendChild(component.render());
  }
  addSampleCards(count = 3) {
    for (let i = 0; i < count; i++) {
      // mix of ProductCard & DiscountCard
      const C = (i % 2 === 0)
        ? new ProductCard('Item', 'Desc', 'proto-assets/smiley-test.png')
        : new DiscountCard('Sale', 'Hot deal', 'proto-assets/smiley-test.png', 20);
      this.addComponent(C);
    }
  }
}

// Initialize everything
const scrollMenu = new ScrollMenu('scrollmenu');
scrollMenu.addSampleCards();

document.getElementById('addCardBtn').addEventListener('click', () => {
  const title = prompt("Enter title:");
  const desc  = prompt("Enter description:");
  const img   = prompt("Enter image URL:") || 'proto-assets/smiley-test.png';
  const useDiscount = confirm("Add a discount?");
  const card = useDiscount
    ? new DiscountCard(title, desc, img, parseInt(prompt("Discount %?"), 10) || 0)
    : new ProductCard(title, desc, img);
  scrollMenu.addComponent(card);
});