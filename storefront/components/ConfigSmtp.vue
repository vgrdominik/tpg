<template>
  <div>
    <!-- Config TPV -->
    <v-row dense>
      <v-col cols="12" sm="8" class="body-2 justify-center">
        <CtBtn :type="stored_config.branding.style.button" color="secondary" @click="show_config_tpv = ! show_config_tpv">Configuración SMTP</CtBtn> (Click para mostrar/ocultar)
      </v-col>
    </v-row>

    <v-row dense v-if="show_config_tpv">
      <v-col cols="12">
        Estos datos solo son necesarios en caso de que tu sistema de exportación no soporte el envío de correos. Por ejemplo el software Olimpo de cicloTIC si soporta el envío y no haría falta configurar estos datos. El sistema siempre va a priorizar el envío por exportación si los dos están configurados.
      </v-col>
    </v-row>

    <!-- Config TPV Actions -->
    <template v-if="show_config_tpv">
      <v-row dense v-for="config in model.values" :key="model.title + config.label">
        <v-spacer />
        <v-col cols="12" lg="3">
          <v-row dense>
            <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
            <CtTextField v-model="config.value" :ctType="stored_config.branding.style.form" class="ma-4" :label="config.label" type="number" v-if="config.type === 'number'" />
            <CtTextField v-model="config.value" :ctType="stored_config.branding.style.form" class="ma-4" :label="config.label" v-else-if="config.type === 'text-field'" />
            <CtTextField v-model="config.value" :ctType="stored_config.branding.style.form" class="ma-4" :label="config.label" type="password" v-else-if="config.type === 'password'" />
            <CtSelect v-model="config.value" :ctType="stored_config.branding.style.form" class="ma-4" :items="config.options" :label="config.label" v-else-if="config.type === 'select'" />
            <v-switch v-model="config.value" class="ma-4" :label="config.label" v-else />
            <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
          </v-row>
        </v-col>
        <v-col cols="12" lg="6" :class="{ 'body-2': true, 'mt-6': $vuetify.breakpoint.smAndUp }">
          <v-row dense>
            <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
            {{ config.description }}
            <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
          </v-row>
        </v-col>
      </v-row>
    </template>
  </div>
</template>

<script type="application/javascript">
export default {
  name: "ConfigSmtp",

  props: {
    'model': {
      type: Object,
      required: true,
    },
  },

  data: () => {
    return {
      show_config_tpv: false,
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    }
  },
}
</script>
