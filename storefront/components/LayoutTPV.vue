<template>
  <div>
    <!-- Layout TPV -->
    <v-radio-group v-model="distribution">
      <v-row dense>
        <v-col cols="12" lg="8" class="body-2 justify-center">
          <CtBtn :type="stored_config.branding.style.button" color="secondary" @click="show_layout_tpv = ! show_layout_tpv">Distribución TPV</CtBtn> (Click para mostrar/ocultar)
        </v-col>
        <v-col cols="12" lg="4" v-if="show_layout_tpv">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna - 1 Columna grande con 2 filas
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="1-2x2" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution1-2x2.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
      </v-row>
      <v-row dense v-if="show_layout_tpv">
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna - 1 Columna - 1 Columna
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="1-1-1" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution1-1-1.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna - 1 Columna grande
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="1-1x2" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution1-1x2.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna - 1 Columna con 2 filas - 1 Columna
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="1-2-1" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution1-2-1.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
      </v-row>
      <v-row dense v-if="show_layout_tpv">
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna - 1 Columna con 3 filas - 1 Columna
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="1-3-1" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution1-3-1.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna - 1 Columna grande con 3 filas
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="1-3x2" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution1-3x2.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna grande - 1 Columna
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="1x2-1" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution1x2-1.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
      </v-row>
      <v-row dense v-if="show_layout_tpv">
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna grande con 2 filas - 1 Columna
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="2x2-1" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution2x2-1.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
        <v-col cols="12" lg="4">
          <v-row dense class="body-2">
            <v-spacer />
            1 Columna grande con 3 filas - 1 Columna
            <v-spacer />
          </v-row>
          <v-row dense class="justify-center">
            <v-radio value="3x2-1" />
          </v-row>
          <v-row dense>
            <v-spacer />
            <v-img
                    :src="$global_utilities.require_img('distribution3x2-1.svg')"
                    class="my-3"
                    contain
                    width="220"
            />
            <v-spacer />
          </v-row>
        </v-col>
      </v-row>
    </v-radio-group>
  </div>
</template>

<script type="application/javascript">
export default {
  name: "LayoutTPV",
  props: {
    'model': {
      type: Object,
      required: true,
    },
  },

  data: () => {
    return {
      show_layout_tpv: false,
      distribution: null,
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    }
  },

  watch: {
    distribution(newValue) {
      if (newValue) {
        this.model.distribution = newValue
      }
    },
    show_layout_tpv() {
      this.distribution = this.model.distribution
    },
  },
}
</script>
