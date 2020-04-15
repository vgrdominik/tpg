export const state = () => ({
  serverMessage: '',
  serverMessageTimeout: null,
})

export const actions = {
  setServerMessage(state, serverMessage) {
    state.commit('updateServerMessage', serverMessage)
    state.serverMessageTimeout = setTimeout(() => { state.commit('updateServerMessage', '') }, 5000)
  },
}

export const mutations = {
  updateServerMessage (state, serverMessageUpdated) {
    state.serverMessage = serverMessageUpdated
  },
  removeServerMessage (state) {
    state.serverMessage = ''
  },
}
