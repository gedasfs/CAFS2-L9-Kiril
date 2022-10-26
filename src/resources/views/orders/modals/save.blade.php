<div class="modal fade" id="orderManagement" tabindex="-1" aria-labelledby="orderManagementLabel" aria-hidden="true">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="orderManagementLabel">Order Management</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<div class="row mb-4">
					<label for="user-select" class="col-sm-3 col-form-label">User</label>
					<div class="col-sm-9">
						<select class="form-select" id="user-select" name="user_id">
							<option selected disabled>Choose...</option>
							@foreach($users as $user)
							<option value="{{ $user->id }}">{{ $user->name }}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="row mb-4">
					<label for="product-select" class="col-sm-3 col-form-label">Product</label>
					<div class="col-sm-9">
						<div class="input-group mb-3">
							<select class="form-select" id="product-select">
								<option selected disabled>Choose...</option>
								@foreach($products as $product)
								<option value="{{ $product->id }}">{{ $product->name }}</option>
								@endforeach
							</select>
							<input type="number" min="1" class="form-control" id="product-count" placeholder="Count">
							<button class="btn btn-outline-secondary" type="button" id="product-add">Add</button>
						</div>
					</div>
				</div>
				<div id="products-selected"></div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary" id="order-save">Save changes</button>
			</div>
		</div>
	</div>
</div>