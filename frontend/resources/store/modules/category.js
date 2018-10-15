import apiUrl from "~/config/api";

export const state = () => {
    return {
        items: [],
        item: null,
        mostRead: null
    }
};

export const actions = {
    async getCategories({commit}, payload) {
        const categories = await payload.vm.$axios.get(`${apiUrl.category}`)
            .then(resp => resp.data);
        if (categories) {
            commit("setItems", categories);
        }

        return new Promise((resolve) =>{
            resolve(categories);
        });
    },
    async getCategory({commit}, payload) {
        const category = await payload.vm.$axios.get(`${apiUrl.category}/${payload.slug}`, {
            params: {
                created_at: payload.created_at,
                page: payload.page
            }
        }).then(resp => resp.data);
        if (category) {
            commit("setItem", category);
        }

        return new Promise((resolve) =>{
            resolve(category);
        });
    },

    async getMostReadCategory({commit}, payload) {
        const category = await payload.vm.$axios.get(`${apiUrl.category}/${payload.slug}`, {
            params: {
                created_at: payload.created_at,
                limit: payload.limit,
                page: payload.page
            }
        }).then(resp => resp.data);
        if (category) {
            commit("setMostRead", category);
        }

        return new Promise((resolve) =>{
            resolve(category);
        });
    },
};

export const mutations = {
    setItems(state, payload) {
        state.items = payload;
    },
    setItem(state, payload) {
        state.item = payload;
    },
    setMostRead(state, payload) {
        state.mostRead = payload;
    },
};
