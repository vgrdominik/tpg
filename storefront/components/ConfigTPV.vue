<template>
  <div>
    <!-- Config TPV -->
    <v-row dense>
      <v-col cols="12" sm="8" class="body-2 justify-center">
        <CtBtn
          :type="stored_config.branding.style.button"
          color="secondary"
          @click="show_config_tpv = !show_config_tpv"
          >Configuración TPV</CtBtn
        >
        (Click para mostrar/ocultar)
      </v-col>
    </v-row>

    <!-- Config TPV Actions -->
    <template v-if="show_config_tpv">
      <template v-for="element in model">
        <v-row :key="element.title" dense>
          <v-row dense>
            <v-spacer />
            <v-col cols="12" lg="3">
              <v-row dense class="body-1 text-uppercase">
                <v-spacer />
                {{ element.title }}
                <v-spacer />
              </v-row>
            </v-col>
            <v-spacer />
          </v-row>
        </v-row>
        <v-row
          v-for="config in element.values"
          :key="element.title + config.label"
          dense
        >
          <v-spacer />
          <v-col cols="12" lg="3">
            <v-row dense>
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
              <CtTextField
                v-if="config.type === 'number'"
                v-model="config.value"
                :ct-type="stored_config.branding.style.form"
                class="ma-4"
                :label="config.label"
                type="number"
              />
              <CtSelect
                v-else-if="config.type === 'select'"
                v-model="config.value"
                :ct-type="stored_config.branding.style.form"
                class="ma-4"
                :items="config.options"
                :label="config.label"
              />
              <v-switch
                v-else
                v-model="config.value"
                class="ma-4"
                :label="config.label"
              />
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
            </v-row>
          </v-col>
          <v-col
            cols="12"
            lg="6"
            :class="{ 'body-2': true, 'mt-6': $vuetify.breakpoint.smAndUp }"
          >
            <v-row dense>
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
              {{ config.description }}
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
            </v-row>
          </v-col>
        </v-row>
      </template>
    </template>
  </div>
</template>

<script type="application/javascript">
export default {
  name: 'ConfigTPV',
  props: {
    model: {
      type: Object,
      required: true
    }
  },

  data: () => {
    return {
      show_config_tpv: false
    }
  },

  computed: {
    stored_config() {
      return this.$store.state.global.config
    }
  }
}
</script>
