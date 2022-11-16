import { defineStore } from 'pinia'
import axios from 'axios';

export const useProductStore = defineStore('product', {
    state: () => ({
        id: null,
        name: null,
        description: null,
        category: {
            id: null
        },
        identifier: null
    }),

    getters: {
        rawData(state) {
            return {
               name: state.name, 
               description: state.description, 
               category_id: state.category?.id, 
               identifier: state.identifier, 
            }
        }
    },

    actions: {
        find(productId) {
            const url = '/api/v1/products/' + productId;

            return axios.get(url).then(response => {
                Object.assign(this, response.data.data);
            });
        },

        save() {
            let url = '/api/v1/products';

            if (this.id) {
                url += '/' + this.id;
            }

            return axios({
                method: this.id ? 'patch' : 'post',
                url: url,
                data: this.rawData
            }).then(response => {
                Object.assign(this, response.data.data);
            });
        }
    }
});