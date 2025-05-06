<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Scroll Menu OOP - Improved</title>
  <style>
    body {
      font-family: courier, sans-serif;
      color: white;
      background-color: #000;
      margin: 0;
      padding: 20px;
    }

    .scrollmenu {
      width: 100%;
      background-color: #3c3c3c;
      overflow-x: auto;
      white-space: nowrap;
      padding: 10px 0;
      scroll-behavior: smooth;
      -webkit-overflow-scrolling: touch;
    }

    .product-card {
      display: inline-block;
      width: 225px;
      height: 300px;
      background-color: #666;
      border-radius: 10px;
      margin: 0 5px;
      padding: 10px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.3);
      text-align: center;
    }

    .product-card h2 {
      font-size: 18px;
      margin: 10px 0 5px;
    }

    .product-card p {
      font-size: 14px;
      margin: 5px 0 10px;
    }

    .product-card img {
      width: 80%;
      height: auto;
      margin: 0 auto;
      display: block;
      border-radius: 5px;
    }

    .product-card button {
      margin-top: 10px;
      padding: 6px 12px;
      background-color: #000;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }

    .product-card button:hover {
      background-color: #333;
    }

    ::-webkit-scrollbar {
      display: none;
    }

    #addCardBtn {
      margin-top: 20px;
      padding: 10px 20px;
      font-family: inherit;
    }
  </style>
</head>
<body>

  <div class="scrollmenu" id="scrollmenu"></div>

  <div>
    <button id="addCardBtn">Add Card</button>
  </div>

  <script>
    class ProductCard {
      constructor(title, description, image) {
        this.title = title || 'No Title';
        this.description = description || 'No Description';
        this.image = image || 'https://via.placeholder.com/150';
      }

      getRandomColor() {
        // Ensure readable background
        const r = Math.floor(Math.random() * 100 + 100); // 100-200
        const g = Math.floor(Math.random() * 100 + 100);
        const b = Math.floor(Math.random() * 100 + 100);
        return `rgba(${r}, ${g}, ${b}, 1)`;
      }

      render() {
        const card = document.createElement('div');
        card.className = 'product-card';
        card.style.backgroundColor = this.getRandomColor();
        card.innerHTML = `
          <h2>${this.title}</h2>
          <p>${this.description}</p>
          <img src="${this.image}" alt="Product Image" onerror="this.src='https://via.placeholder.com/150';"/>
          <button>Add to Cart</button>
        `;
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
        }, { passive: false });
      }

      addCard(cardElement) {
        this.container.appendChild(cardElement);
      }

      addMultipleCards(count = 3) {
        for (let i = 0; i < count; i++) {
          const card = new ProductCard(`Title ${i+1}`, 'Sample description.', 'proto-assets/smiley-test.png');
          this.addCard(card.render());
        }
      }
    }

    const scrollMenu = new ScrollMenu('scrollmenu');
    scrollMenu.addMultipleCards();

    document.getElementById('addCardBtn').addEventListener('click', () => {
      const title = prompt("Enter title:") || "Untitled";
      const desc = prompt("Enter description:") || "No description provided.";
      const card = new ProductCard(title, desc, 'proto-assets/smiley-test.png');
      scrollMenu.addCard(card.render());
    });
  </script>
</body>
</html>
