import axios from 'axios';
import toastr from 'toastr';

const productList = document.querySelector('#product-select');
const productCount = document.querySelector('#product-count');
const productsSelectedContainer = document.querySelector('#products-selected');
const userSelect = document.querySelector('#user-select');

function createProductAddonElement(text,) {
	let spanName = document.createElement('span');
	
	spanName.classList.add('input-group-text');

	let spanNameText = document.createTextNode(text);

	spanName.appendChild(spanNameText);

	return spanName;
}

function createProductTextElement(text) {
	let inputTitle = document.createElement('input');

	inputTitle.classList.add('form-control');
	inputTitle.setAttribute('type', 'text');
	inputTitle.readOnly = true;
	inputTitle.value = text;

	return inputTitle;
}

document.addEventListener('DOMContentLoaded', () => {
	document.querySelector('#product-add')?.addEventListener('click', function() {
		console.log(productList.value, productList.selectedIndex, productCount.value);

		let productInContainer = productsSelectedContainer.querySelector(`[data-product-id="${productList.value}"]`);

		if (productInContainer) {
			let count = parseInt(productCount.value) + parseInt(productInContainer.getAttribute('data-product-count'));

			productInContainer.setAttribute('data-product-count', count);

			productInContainer.querySelector('input:nth-of-type(2)').value = count;
			return;
		}

		let productToAddContainer = document.createElement('div');

		productToAddContainer.setAttribute('data-product-id', productList.value);
		productToAddContainer.setAttribute('data-product-count', productCount.value);

		productToAddContainer.classList.add('input-group', 'mb-3', 'input-group-sm');

		productToAddContainer.appendChild(createProductAddonElement('Name'));
		productToAddContainer.appendChild(createProductTextElement(productList.options[productList.selectedIndex].textContent));

		productToAddContainer.appendChild(createProductAddonElement('Count'));

		let productCountInput = createProductTextElement(productCount.value);

		productCountInput.type = 'number';
		productCountInput.min = 1;
		productCountInput.readOnly = false;

		productToAddContainer.appendChild(productCountInput);

		let buttonRemove = document.createElement('button');

		buttonRemove.setAttribute('type', 'button');
		buttonRemove.setAttribute('class', 'btn btn-outline-secondary');

		buttonRemove.addEventListener('click', function () {
			this.closest('div.input-group').remove();
		});

		let buttonText = document.createTextNode('Remove');

		buttonRemove.appendChild(buttonText);

		productToAddContainer.appendChild(buttonRemove);

		productsSelectedContainer.appendChild(productToAddContainer);
	});

	document.querySelector('#order-save')?.addEventListener('click', function() {
		let data = {
			products: [...productsSelectedContainer.children].map((p) => {
			    return {
			    	id: +(p.getAttribute('data-product-id')),
			    	count: +(p.getAttribute('data-product-count')),
			    }
			}),
			user_id: +(userSelect.value)
		};

		document.querySelectorAll('.is-invalid').forEach((el) => {
			el.classList.remove('is-invalid');
			el.nextElementSibling.remove();
		});

		axios.post('/orders/save', data).then(response => {
			window.location.reload();
		}).catch(err => {
			if (err.response.status == 422) {
				for (let errKey in err.response.data.errors) {
					let el = document.querySelector(`[name="${errKey}"]`);

					if (el) {
						el.classList.add('is-invalid');

						let span = document.createElement('span');

						span.setAttribute('class', 'invalid-feedback');
						span.setAttribute('role', 'alert');

						span.innerText = err.response.data.errors[errKey][0];

						el.after(span);
					} else {
						toastr.error(err.response.data.errors[errKey][0], 'Inconceivable!')
					}
				}
			} else {
				toastr.error(err.response.message, 'Inconceivable!')
			}
		});
	});
});