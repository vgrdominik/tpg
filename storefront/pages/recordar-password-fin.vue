<template>
    <CtCard :type="stored_config.branding.style.card" dense title="Recordar password" width="300" class="mx-auto">
      <v-row dense>
        <v-col cols="12" class="mt-5">
          En unos momentos recibirás un correo con las instrucciones para modificar el password.
        </v-col>
        <v-col cols="12">
          <CtBtn to="/" :type="stored_config.branding.style.button" color="primary" block>
            Home
          </CtBtn>
        </v-col>
        <v-col cols="12" class="my-5">
          <CtBtn to="/login" :type="stored_config.branding.style.button" color="secondary" block>
            Login
          </CtBtn>
        </v-col>
      </v-row>
    </CtCard>
</template>

<script>
import { mapActions } from 'vuex'

export default {

  mounted() {
    this.setIsContainerNeeded(true)
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    },
  },

  methods: {
    ...mapActions('global', [
      'setIsContainerNeeded',
    ]),
  },
}
</script>
