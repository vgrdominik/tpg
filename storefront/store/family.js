export const state = () => ({
  current_family: 0,

  // Contain all families
  families: [
    {
      id: null,
      img: null,
      text_tpv: null
    }
  ]
})

export const actions = {
  setFamilies(state, payload) {
    state.commit('updateFamilies', payload)
  },
  setCurrentFamily(state, payload) {
    state.commit('updateCurrentFamily', payload)
  }
}

export const mutations = {
  updateFamilies(state, families) {
    state.families = families
  },
  updateCurrentFamily(state, family) {
    state.current_family = family
  }
}
