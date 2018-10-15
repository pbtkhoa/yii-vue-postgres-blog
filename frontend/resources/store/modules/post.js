import apiUrl from '~/config/api';

export const state = () => {
    return {
        post: null
    }
};

export const actions = {
    async getPost({commit}, payload) {
        const post = await payload.vm.$axios.get(`${apiUrl.post}/${payload.slug}`)
            .then(resp => resp.data);
        if (post) {
            commit("setPost", post);
        }

        return new Promise((resolve) =>{
            resolve(post);
        });
    },
};

export const mutations = {
    setPost(state, payload) {
        state.post = payload;
    },
};
