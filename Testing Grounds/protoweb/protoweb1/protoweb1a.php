<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroll Menu OOP</title>
    <style>
        body {
            font-family: courier, sans-serif;
            color: white;
            background-color: rgb(0, 0, 0);
            margin: 0;
            padding: 20px;
        }

        .scrollmenu {
            width: 100%;
            height: fit-content;
            background-color: rgba(60, 60, 60, 1);
            overflow-x: scroll;
            overflow-y: hidden;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
            scroll-behavior: smooth;
            padding: 10px 0;
        }

        .product-card {
            background-color: rgba(100, 100, 100, 1);
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            width: 225px;
            height: 300px;
            display: inline-block;
            margin: 0 5px;
        }

        ::-webkit-scrollbar {
            display: none;
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
                    <h1>${this.title}</h1>
                    <p>[ ${this.description} ]</p>
                    <img src="${this.image}" alt="Product Image" style="width: 80%; height: auto; margin-left: 10%;">
                    <br>
                    <button style="margin-top: 10px;">Add to Cart</button>
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
            const card = new ProductCard(title, desc, 'proto-assets/smiley-test.png');
            scrollMenu.addCard(card.render());
        });
    </script>
</body>
</html>
