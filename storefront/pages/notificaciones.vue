<template>
  <v-container>
    <CtCard :type="stored_config.branding.style.card" dense title="Notificaciones" width="500" class="mx-auto" v-if="user">
      <v-row dense>
        <v-col cols="12" class="mt-5" v-for="calendarEvent in events" :key="calendarEvent.id">
          <v-card color="primary" dark>
            <v-card-title class="headline" v-html="calendarEvent.description" />
            <v-card-subtitle v-html="(new Date(calendarEvent.reservated_at)).toString()" />
            <v-container>
              <span v-html="calendarEvent.details" />
            </v-container>
          </v-card>
        </v-col>
      </v-row>
    </CtCard>
    <CtCard title="No estás autenticado" dense width="500" class="mx-auto" v-else>
      <v-row dense>
        <v-spacer />
        <CtBtn to="/login" :type="stored_config.branding.style.button" class="mx-auto">
          Login
        </CtBtn>
        <v-spacer />
      </v-row>
    </CtCard>
  </v-container>
</template>

<script>
import { mapActions } from 'vuex'
import fetchUsers from '../mixins/fetch-user'

export default {
  mixins: [fetchUsers],

  data() {
    return {
      events: [],
    }
  },

  computed: {
    user () {
      return this.$store.state.user.user
    },
    serverMessage () {
      return this.$store.state.serverMessage.serverMessage
    },
    stored_config () {
      return this.$store.state.global.config
    },
  },

  mounted() {
    this.setIsContainerNeeded(true)

    this.fetchUser()

    if (this.user) {
      this.fetch()
    }
  },

  methods: {
    fetch() {
      this.$axios.get('/api/event',{
        headers: { Authorization: 'Bearer ' + this.$store.state.user.token }
      })
        .then((response) => (response.data) ? this.events = response.data : '')
        .catch((error) => (error.response.data.message) ? this.setServerMessage(error.response.data.message) : this.setServerMessage('Error.'))
    },

    ...mapActions('serverMessage', [
      'setServerMessage',
    ]),
    ...mapActions('global', [
      'setIsContainerNeeded',
    ]),
  }
}
</script>
