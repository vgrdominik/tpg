<template>
    <CtCard :type="stored_config.branding.style.card" dense title="Modificar password" width="300" class="mx-auto">
      <v-row dense>
        <v-col cols="12" class="mt-5">
          <CtTextField :ctType="stored_config.branding.style.form" append-icon="mdi-email" label="Email" v-model="forgotData.email"/>
        </v-col>
        <v-col cols="12">
          <CtTextField :ctType="stored_config.branding.style.form" type="password" append-icon="mdi-lock" label="Password" v-model="forgotData.password"/>
        </v-col>
        <v-col cols="12">
          <CtTextField :ctType="stored_config.branding.style.form" type="password" append-icon="mdi-lock" label="Confirmación password" v-model="forgotData.password_confirmation"/>
        </v-col>
        <v-col cols="12" v-if="serverMessage" v-html="serverMessage" class="error--text" />
        <v-col cols="12">
          <CtBtn @click="forgot()" :type="stored_config.branding.style.button" color="primary" block>
            Enviar
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
        password: '',
        password_confirmation: '',
        token: '',
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

    if (this.$router.currentRoute.query.token) {
      this.forgotData.token = this.$router.currentRoute.query.token
    } else {
      this.$router.push('/login')
    }
  },

  methods: {
    forgot(){
      this.$axios.post('/api/forgotReset', this.forgotData)
        .then((response) => (response.data === 'Password reset') ? this.$router.push('/login') : this.setServerMessage(response.data))
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
