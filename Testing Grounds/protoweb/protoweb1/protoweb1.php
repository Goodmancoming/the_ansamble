<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scroll Menu Fix</title>
    <style>
        body {
            font-family: courier, sans-serif;
            color: white;
            background-color:rgb(0, 0, 0);
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
    <div class="scrollmenu" id="scrollmenu">
        <!-- kards -->
    </div>

    <div>
        <button onclick="addSingleCard()">Add Card</button>
    </div>

    <script>
        const scrollMenu = document.getElementById('scrollmenu');

        scrollMenu.addEventListener('wheel', function (e) {
            if (e.deltaY !== 0) {
                e.preventDefault();
                scrollMenu.scrollLeft += e.deltaY * 3;
            }
        });

        function createProductCard(title, desc, image) {
            const card = document.createElement('div');
            card.className = 'product-card';
            let color = `rgba(${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, ${Math.floor(Math.random() * 256)}, 1)`
            card.style.backgroundColor = color;
            card.innerHTML = `
                <h1>${title}</h1>
                <p>[ ${desc} ]</p>
                <img src="${image}" alt="Product Image" style="width: 80%; height: auto; margin-left: 10%;">
                <br>
                <button style="margin-top: 10px;">Add to Cart</button>
            `;
            return card;
        }

        function addProductCards() {
            for (let i = 0; i < 3; i++) {
                const card = createProductCard('Title', 'Description', 'proto-assets/smiley-test.png');
                scrollMenu.appendChild(card);
            }
        }

        function addSingleCard() {
            const title = prompt("Enter title:");
            const desc = prompt("Enter description:");
            const card = createProductCard(title, desc, 'proto-assets/smiley-test.png');
            scrollMenu.appendChild(card);
        }

        window.onload = addProductCards;
    </script>
</body>
</html>