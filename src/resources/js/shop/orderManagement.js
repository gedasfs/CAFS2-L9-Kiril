import axios from 'axios';
import toastr from 'toastr';
import * as bootstrap from 'bootstrap';

let LOADED_ORDER_ID = null;

const orderModal = document.querySelector('#orderManagement') ? new bootstrap.Modal('#orderManagement') : null;

const productList = document.querySelector('#product-select');
const productCount = document.querySelector('#product-count');
const productsSelectedContainer = document.querySelector('#products-selected');
const userSelect = document.querySelector('#user-select');

if (orderModal) {
	document.querySelector('#orderManagement').addEventListener('hidden.bs.modal', () => {
		userSelect.selectedIndex = 0;
		productList.selectedIndex = 0;
		productCount.value = null;
		productsSelectedContainer.innerHTML = '';

		LOADED_ORDER_ID = null;
	});
}

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

function addProductLine(id, name, count) {
	let productInContainer = productsSelectedContainer.querySelector(`[data-product-id="${id}"]`);

	if (productInContainer) {
		let newCount = parseInt(count) + parseInt(productInContainer.getAttribute('data-product-count'));

		productInContainer.setAttribute('data-product-count', newCount);

		productInContainer.querySelector('input:nth-of-type(2)').value = newCount;

		return;
	}

	let productToAddContainer = document.createElement('div');

	productToAddContainer.setAttribute('data-product-id', id);
	productToAddContainer.setAttribute('data-product-count', count);

	productToAddContainer.classList.add('input-group', 'mb-3', 'input-group-sm');

	productToAddContainer.appendChild(createProductAddonElement('Name'));
	productToAddContainer.appendChild(createProductTextElement(name));

	productToAddContainer.appendChild(createProductAddonElement('Count'));

	let productCountInput = createProductTextElement(count);

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
}

document.addEventListener('DOMContentLoaded', () => {
	document.querySelectorAll('[data-route-edit]').forEach(el => {
		el.addEventListener('click', function() {
			axios.get(this.getAttribute('data-route-edit')).then(response => {
				console.log(response.data.data.user.id);

				LOADED_ORDER_ID = response.data.data.id;

				let userSelectedOption = userSelect.querySelector(`option[value="${response.data.data.user.id}"]`);

				if (userSelectedOption) {
					userSelectedOption.selected = true;
				}

				for (let product of response.data.data.products) {
					addProductLine(product.id, product.name, product.count);
				}

				orderModal.show();
			});
		});
	});
	
	document.querySelector('#product-add')?.addEventListener('click', function() {
		addProductLine(
			// id
			productList.value,
			// name
			productList.options[productList.selectedIndex].textContent,
			// count
			productCount.value
		);
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

		let url = '/orders/v2/save';

		if (LOADED_ORDER_ID) {
			url = url + '/' + LOADED_ORDER_ID;
		}

		axios.post(url, data).then(() => {
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