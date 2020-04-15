<template>
  <CtCard :type="stored_config.branding.style.card" dense title="Registro" width="300" class="mx-auto">
    <v-row dense>
      <v-col cols="12" class="mt-5">
        <CtTextField :ctType="stored_config.branding.style.form" append-icon="mdi-account" label="Nombre" v-model="signUpData.name"/>
      </v-col>
      <v-col cols="12">
        <CtTextField :ctType="stored_config.branding.style.form" append-icon="mdi-email" label="Email" v-model="signUpData.email"/>
      </v-col>
      <v-col cols="12">
        <CtTextField :ctType="stored_config.branding.style.form" type="password" append-icon="mdi-lock" label="Password" v-model="signUpData.password"/>
      </v-col>
      <v-col cols="12" v-if="serverMessage" v-html="serverMessage" class="error--text" />
      <v-col cols="12">
        <CtBtn @click="signUp()" :type="stored_config.branding.style.button" color="primary" block>
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
      signUpData: {
        name: '',
        email: '',
        password: '',
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
    signUp(){
      this.$axios.post('/api/register', this.signUpData)
        .then((response) => (response.data === 'User registered') ? this.$router.push({ path: '/' }) : this.setServerMessage(response.data))
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
