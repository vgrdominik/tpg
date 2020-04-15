export const state = () => ({
  current_family: 0,

  // Contain all families
  families: [
    {
      id: null,
      img: null,
      text_tpv: null,
    },
  ]
})

export const actions = {
  setFamilies(state, payload) {
    state.commit('updateFamilies', payload)
  },
}

export const mutations = {
  updateFamilies (state, families) {
    state.families = families
  },
}
