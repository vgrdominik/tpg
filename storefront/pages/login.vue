<template>
    <CtCard :type="stored_config.branding.style.card" dense title="Login" width="300" class="mx-auto">
      <v-row dense>
        <v-col cols="12" class="mt-5">
          <CtTextField :ctType="stored_config.branding.style.form" append-icon="mdi-email" label="Email" v-model="signInData.email"/>
        </v-col>
        <v-col cols="12">
          <CtTextField type="password" :ctType="stored_config.branding.style.form" append-icon="mdi-lock" label="Password" v-model="signInData.password"/>
        </v-col>
        <v-col cols="12" v-if="serverMessage" v-html="serverMessage" class="error--text" />
        <v-col cols="12">
          <CtBtn @click="login()" :type="stored_config.branding.style.button" color="primary" block>
            Entrar
          </CtBtn>
        </v-col>
        <v-col cols="12" class="mt-5">
          <v-row>
            <v-spacer />
            <router-link to="/recordar-password">
              ¿Has olvidado el password?
            </router-link>
            <v-spacer />
          </v-row>
        </v-col>
        <v-col cols="12" class="my-5">
          <CtBtn to="/registro" :type="stored_config.branding.style.button" color="secondary" block>
            Registro
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
      signInData: {
        email: '',
        password: '',
        device_name: 'website',
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
    afterLogin(response){
      this.setToken(response.data.token)
      this.fetchUser()
      this.$router.push('/sala-de-espera')
    },

    login(){
      this.$axios.post('/api/login', this.signInData)
        .then((response) => (response.data.token) ? this.afterLogin(response) : this.setServerMessage(response.data))
        .catch((error) => console.log(error))
  //(error.response.data.message) ? (error.response.data.message === 'The given data was invalid.') ? this.setServerMessage('Datos inválidos.') : this.setServerMessage(error.response.data.message) : this.setServerMessage('Error.'))
    },

    ...mapActions('user', [
      'setToken',
      'fetchUser',
    ]),

    ...mapActions('serverMessage', [
      'setServerMessage',
    ]),

    ...mapActions('global', [
      'setIsContainerNeeded',
    ]),
  }
}
</script>
