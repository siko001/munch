fetch('/menu/api')
	.then((response) => response.json())
	.then((data) => {
		// Perform a check if the menuContainer exists on the current page
		const menuContainer = document.getElementById('menuContainer');
		if (menuContainer) {
			generateMenuCards(data); // Only execute the function if the container exists
			scrollToProduct();
		}
	})
	.catch((error) => console.error('Error:', error));

// Function to generate menu cards
function generateMenuCards(products) {
	const menuContainer = document.getElementById('menuContainer');

	// Loop through the products array
	products.forEach((product) => {
		// Create a card element
		const card = document.createElement('div');
		card.classList.add('col-sm-6', 'col-lg-4', 'all', product.category);
		card.id = product.id;
		card.setAttribute('data-id', product.id);
		card.classList.add('product-box');

		const box = document.createElement('div');
		box.classList.add('box');

		const boxWithId = document.createElement('div');
		boxWithId.classList.add(product.id);

		const imgbox = document.createElement('div');
		imgbox.classList.add('img-box');

		// Append `box` and `imgbox` to `card`
		card.appendChild(box);
		box.appendChild(imgbox);

		const img = document.createElement('img');
		img.src = '/storage/' + product.image;
		imgbox.appendChild(img);

		const detailbox = document.createElement('div');
		detailbox.classList.add('detail-box');
		box.appendChild(detailbox);

		// Create and append the card content
		const name = document.createElement('h5');
		name.textContent = product.name;
		detailbox.appendChild(name);

		const description = document.createElement('p');
		description.textContent = product.description;
		detailbox.appendChild(description);

		const options = document.createElement('div');
		options.classList.add('options');
		detailbox.appendChild(options);

		const price = document.createElement('h6');
		price.textContent = product.price + '€';
		options.appendChild(price);

		const grouptogether = document.createElement('div');
		grouptogether.classList.add('group-together');
		options.appendChild(grouptogether);

		const blink = document.createElement('div');
		const blinktext = document.createElement('p');

		blinktext.style.display = 'inline';

		if (product.avaliable == '1') {
			blinktext.textContent = 'Avaliable';
		} else {
			blinktext.textContent = 'Sorry! Out of Stock';
		}

		if (blinktext.textContent == 'Avaliable') {
			blink.classList.add('circle', 'green');
		} else {
			blink.classList.add('circle', 'red');
		}

		grouptogether.appendChild(blink);
		grouptogether.appendChild(blinktext);
		if (blinktext.textContent != 'Sorry! Out of Stock') {
			const cart = document.createElement('a');
			cart.href = '/add-to-cart/' + product.id;

			const svg = document.createElementNS('http://www.w3.org/2000/svg', 'svg');
			svg.setAttribute('version', '1.1');
			svg.setAttribute('id', 'Capa_1');
			svg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
			svg.setAttribute('xmlns:xlink', 'http://www.w3.org/1999/xlink');
			svg.setAttribute('x', '0px');
			svg.setAttribute('y', '0px');
			svg.setAttribute('viewBox', '0 0 456.029 456.029');
			svg.setAttribute('style', 'enable-background:new 0 0 456.029 456.029;');
			svg.setAttribute('xml:space', 'preserve');

			const group1 = document.createElementNS('http://www.w3.org/2000/svg', 'g');
			const group2 = document.createElementNS('http://www.w3.org/2000/svg', 'g');
			const path1 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
			const path2 = document.createElementNS('http://www.w3.org/2000/svg', 'path');
			const group3 = document.createElementNS('http://www.w3.org/2000/svg', 'g');
			const group4 = document.createElementNS('http://www.w3.org/2000/svg', 'g');
			const path3 = document.createElementNS('http://www.w3.org/2000/svg', 'path');

			path1.setAttribute(
				'd',
				'M345.6,338.862c-29.184,0-53.248,23.552-53.248,53.248c0,29.184,23.552,53.248,53.248,53.248 c29.184,0,53.248-23.552,53.248-53.248C398.336,362.926,374.784,338.862,345.6,338.862z'
			);
			path2.setAttribute(
				'd',
				'M439.296,84.91c-1.024,0-2.56-0.512-4.096-0.512H112.64l-5.12-34.304C104.448,27.566,84.992,10.67,61.952,10.67H20.48 C9.216,10.67,0,19.886,0,31.15c0,11.264,9.216,20.48,20.48,20.48h41.472c2.56,0,4.608,2.048,5.12,4.608l31.744,216.064 c4.096,27.136,27.648,47.616,55.296,47.616h212.992c26.624,0,49.664-18.944,55.296-45.056l33.28-166.4 C457.728,97.71,450.56,86.958,439.296,84.91z'
			);
			path3.setAttribute(
				'd',
				'M215.04,389.55c-1.024-28.16-24.576-50.688-52.736-50.688c-29.696,1.536-52.224,26.112-51.2,55.296 c1.024,28.16,24.064,50.688,52.224,50.688h1.024C193.536,443.31,216.576,418.734,215.04,389.55z'
			);

			group2.appendChild(path1);
			group3.appendChild(path2);
			group4.appendChild(path3);
			group1.appendChild(group2);
			group1.appendChild(group3);
			group1.appendChild(group4);
			svg.appendChild(group1);

			cart.appendChild(svg);
			options.appendChild(cart);
		}

		// Append the card to the menu container
		menuContainer.appendChild(card);
	});
}

// Function to scroll to the product based on the anchor
function scrollToProduct() {
	// Get the product ID from the URL anchor
	var productId = window.location.hash.substring(1);
	var scrollPosition = window.scrollY;

	window.addEventListener('load', function () {
		// Restore the scroll position once the page has fully loaded
		window.scrollTo(0, scrollPosition);
	});

	// Scroll to the element with the corresponding ID
	if (productId) {
		const targetElement = document.querySelector('.product-box[data-id="' + productId + '"]');
		if (targetElement) {
			targetElement.scrollIntoView({ behavior: 'smooth' });
		}
	}
}

// Scroll to the product after a short delay to ensure the page has finished loading
setTimeout(function () {
	scrollToProduct();
}, 2086);
