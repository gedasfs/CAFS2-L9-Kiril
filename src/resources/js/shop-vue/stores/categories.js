import { defineStore } from 'pinia'
import axios from 'axios';

export const useCategoriesStore = defineStore('categories', {
    state: () => ({
        categories: [],
    }),

    actions: {
        load() {
            return axios.get('/api/v1/categories').then(response => this.categories = response.data.data);
        }
    }
});