export default {
  methods: {
    fetchUser() {
      // Try to get token cookie if token isn't set
      if (! this.$store.state.user.token || ! this.$store.state.user.user) {
        let token = document.cookie.match(new RegExp('(^| )token=([^;]+)'))
        if (token) {
          this.$store.dispatch('user/setToken', token[2])

          let user = document.cookie.match(new RegExp('(^| )user=([^;]+)'))
          if (user) {
            this.$store.commit('user/updateUser', JSON.parse(user[2]))
          } else {
            this.$store.dispatch('user/fetchUser')
          }
        }
      }

      // If the user is not authenticated
      if (! this.$store.state.user.token || ! this.$store.state.user.user) {
        return this.$router.push({ path: '/login' })
      }
    },
  },
}
