<template>
    <CtCard :type="stored_config.branding.style.card" dense title="Recordar password" width="300" class="mx-auto">
      <v-row dense>
        <v-col cols="12" class="mt-5">
          <CtTextField :ctType="stored_config.branding.style.form" append-icon="mdi-email" label="Email" v-model="forgotData.email"/>
        </v-col>
        <v-col cols="12" v-if="serverMessage" v-html="serverMessage" class="error--text" />
        <v-col cols="12">
          <CtBtn @click="forgot()" :type="stored_config.branding.style.button" color="primary" block>
            Enviar
          </CtBtn>
        </v-col>
        <v-col cols="12" class="my-5">
          <CtBtn to="/login" :type="stored_config.branding.style.button" color="secondary" block>
            Volver
          </CtBtn>
        </v-col>
      </v-row>
    </CtCard>
</template>

<script>
import { mapActions } from 'vuex'

export default {
  data(){
    return {
      forgotData: {
        email: '',
      },
    }
  },

  computed: {
    serverMessage () {
      return this.$store.state.serverMessage.serverMessage
    },
    stored_config () {
      return this.$store.state.global.config
    },
  },

  mounted() {
    this.setIsContainerNeeded(true)
  },

  methods: {
    forgot(){
      this.$axios.post('/api/forgotSendResetLinkEmail', this.forgotData)
        .then((response) => (response.data === 'Reset link sent') ? this.$router.push('/recordar-password-fin') : this.setServerMessage(response.data))
        .catch((error) => (error.response.data.message) ? (error.response.data.message === 'The given data was invalid.') ? this.setServerMessage('Datos inválidos.') : this.setServerMessage(error.response.data.message) : this.setServerMessage('Error.'))
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
