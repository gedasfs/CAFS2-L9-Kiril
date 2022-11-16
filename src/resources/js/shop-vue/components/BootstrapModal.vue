<script setup>
import * as bootstrap from 'bootstrap';

import { watch, nextTick } from 'vue';

const props = defineProps({
	showModal: Boolean
});

const emit = defineEmits(['onBootstrapModalClose']);

const randomId = (Math.random() + 1).toString(36).substring(7);

nextTick(() => {
	const myModalEl = document.getElementById(randomId);

	const myModal = new bootstrap.Modal(myModalEl, {
		keyboard: false
	});

	myModalEl.addEventListener('hidden.bs.modal', function () {
		emit('onBootstrapModalClose');
	});

	watch(() => props.showModal, (state) => {
		if (state) {
			myModal.show();
		}
	});
});
</script>
<template>
  <div
    :id="randomId"
    class="modal fade"
    tabindex="-1"
    aria-labelledby="exampleModalLabel"
    aria-hidden="true"
  >
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <slot name="header" />
          <button
            type="button"
            class="btn-close"
            data-bs-dismiss="modal"
            aria-label="Close"
          />
        </div>
        <div class="modal-body">
          <slot />
        </div>
        <div class="modal-footer">
          <button
            type="button"
            class="btn btn-secondary"
            data-bs-dismiss="modal"
          >
            Close
          </button>
          <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
        </div>
      </div>
    </div>
  </div>
</template>