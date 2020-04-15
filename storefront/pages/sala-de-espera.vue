<template>
    <CtCard :type="stored_config.branding.style.card" dense title="Sala de espera" width="300" class="mx-auto">
      <v-row dense>
        <v-col cols="12" class="mt-5">
          En breves momentos serás redirigido hacia la página de notificaciones.
        </v-col>
        <v-col cols="12" class="mt-5">
          <v-row>
            <v-spacer />
            <v-subheader v-html="'¿Ha pasado más de 5 segundos?'" />
            <v-spacer />
          </v-row>
        </v-col>
        <v-col cols="12" class="my-5">
          <CtBtn to="/notificaciones" :type="stored_config.branding.style.button" color="secondary" block>
            Ir a notificaciones
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
    setTimeout(() => this.$router.push({ path: '/notificaciones' }), 3000)
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
