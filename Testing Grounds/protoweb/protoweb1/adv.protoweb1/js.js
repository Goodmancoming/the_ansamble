let cart = [];

function updateCartCount() {
  document.getElementById('cartCount').innerText = cart.length;
}

class ProductCard {
  constructor(title, description, image) {
    this.title = title;
    this.description = description;
    this.image = image;
  }

  getRandomColor() {
    const r = Math.floor(Math.random() * 256);
    const g = Math.floor(Math.random() * 256);
    const b = Math.floor(Math.random() * 256);
    return `rgba(${r}, ${g}, ${b}, 1)`;
  }

  render() {
    const card = document.createElement('div');
    card.className = 'product-card';
    card.style.backgroundColor = this.getRandomColor();
    card.innerHTML = `
      <h2>${this.title}</h2>
      <p>${this.description}</p>
      <img src="${this.image}" alt="Product Image" 
           onerror="this.src='smiley-test.png';" 
           style="width: 80%; height: auto; margin-top: 5px;" />
      <br>
      <button class="add-to-cart-btn" style="margin-top: 10px;">Add to Cart</button>
    `;

    const button = card.querySelector('.add-to-cart-btn');
    button.addEventListener('click', () => {
      cart.push({
        title: this.title,
        description: this.description,
        image: this.image
      });
      button.textContent = 'Added!';
      button.disabled = true;
      updateCartCount();
    });

    return card;
  }
}

class ScrollMenu {
  constructor(containerId) {
    this.container = document.getElementById(containerId);
    this.setupScrollBehavior();
  }

  setupScrollBehavior() {
    this.container.addEventListener('wheel', (e) => {
      if (e.deltaY !== 0) {
        e.preventDefault();
        this.container.scrollLeft += e.deltaY * 3;
      }
    });
  }

  addCard(cardElement) {
    this.container.appendChild(cardElement);
  }

  addMultipleCards(count = 3) {
    for (let i = 0; i < count; i++) {
      const card = new ProductCard('Title', 'Description', 'proto-assets/smiley-test.png');
      this.addCard(card.render());
    }
  }
}

const scrollMenu = new ScrollMenu('scrollmenu');
scrollMenu.addMultipleCards();

document.getElementById('addCardBtn').addEventListener('click', () => {
  const title = prompt("Enter title:");
  const desc = prompt("Enter description:");
  const image = prompt("Enter image URL (leave blank for default):") || 'proto-assets/smiley-test.png';

  const card = new ProductCard(title, desc, image);
  scrollMenu.addCard(card.render());
});
