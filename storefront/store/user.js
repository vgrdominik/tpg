import axios from 'axios'

export const state = () => ({
  token: '',
  user: null,
})

export const actions = {
  setToken(store, token) {
    window.document.cookie = 'token=' + token
    store.commit('updateToken', token)
  },

  fetchUser (store) {
    if (store.state.token) {
      axios.get('http://api-radge.valentigamez.com/api/user', {
        headers: { Authorization: 'Bearer ' + store.state.token }
      })
        .then((response) => {
          if (response.data && response.data.data) {
            window.document.cookie = 'user=' + JSON.stringify(response.data.data)
            store.commit('updateUser', response.data.data)
          } else {
            store.commit('removeUser')
          }
        })
        .catch(() => store.state.user = null)
    }
  },
}

export const mutations = {
  updateToken (state, tokenUpdated) {
    state.token = tokenUpdated
  },
  updateUser (state, userUpdated) {
    state.user = userUpdated
  },
  removeUser (state) {
    state.user = null
  },
}
