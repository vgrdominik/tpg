import {ipcRenderer} from "electron";
<template>
  <div>
    <!-- Config TPV -->
    <v-row dense>
      <v-col cols="12" sm="8" class="body-2 justify-center">
        <CtBtn :type="stored_config.branding.style.button" color="secondary" @click="show_config_tpv = ! show_config_tpv">Configuración Importaciones</CtBtn> (Click para mostrar/ocultar)
      </v-col>
    </v-row>

    <v-row dense v-if="show_config_tpv">
      <v-col cols="12">
        La carpeta seleccionada en el anterior apartado, "Directorio de importación", determina donde se deben poner los ficheros a importar. Estos son product.csv, family.csv y ticket.csv (Productos, familias y tíquets respectivamente).<br>
        Al poner los ficheros a importar en dicha carpeta se recopilan sus cabeceras y se exponen en el siguiente apartado para que especifiques a qué campos corresponden.
      </v-col>
    </v-row>

    <!-- Config TPV Actions -->
    <template v-if="show_config_tpv">
      <template v-for="(domain, domain_name) in model.domain">
        <v-row dense :key="domain.title">
          <v-row dense>
            <v-spacer />
            <v-col cols="12" lg="3">
              <v-row dense class="body-1 text-uppercase">
                <v-spacer />
                {{ domain.title }}
                <v-spacer />
              </v-row>
            </v-col>
            <v-spacer />
          </v-row>
        </v-row>
        <v-row dense :key="domain.title + '-refresh'">
          <v-col cols="12" class="text-center">
            <CtBtn :type="stored_config.branding.style.button" color="primary" @click="headersSync(domain_name)">
              <font-awesome-icon :icon="['fas', 'sync-alt']"/>
              <span class="ml-3">Actualizar cabeceras</span>
            </CtBtn>
          </v-col>
        </v-row>
        <v-row dense :key="domain.title + '-titles'">
          <v-col cols="12" lg="4" class="text-center body-2 text-uppercase">
            Campo
          </v-col>
          <v-col cols="12" lg="4" class="text-center body-2 text-uppercase">
            Columna del fichero
          </v-col>
          <v-col cols="12" lg="4" class="text-center body-2 text-uppercase">
            Descripción
          </v-col>
        </v-row>
        <v-row dense v-for="field in domain.fields" :key="domain.title + field.label">
          <v-col cols="12" lg="4">
            <v-row dense>
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
              <CtTextField v-model="field.name" readonly :ctType="stored_config.branding.style.form" class="ma-4" :label="field.label + '(' + field.type + ')'" />
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
            </v-row>
          </v-col>
          <v-col cols="12" lg="4">
            <v-row dense>
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
              <CtSelect v-model="domain.fields_columns[field.name]" :ctType="stored_config.branding.style.form" class="ma-4" :items="domain.columns" label="Columna del fichero" />
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
            </v-row>
          </v-col>
          <v-col cols="12" lg="4" :class="{ 'body-2': true, 'mt-4': $vuetify.breakpoint.smAndUp }">
            <v-row dense>
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
              {{ field.description }}
              <v-spacer v-if="$vuetify.breakpoint.mdAndDown" />
            </v-row>
          </v-col>
        </v-row>
      </template>
    </template>
  </div>
</template>

<script type="application/javascript">
import { ipcRenderer } from 'electron'
import { mapActions } from 'vuex'
export default {
  name: "ConfigImportation",
  props: {
    'model': {
      type: Object,
      required: true,
    },
  },

  data: () => {
    return {
      show_config_tpv: false,

      get_headers_main_event: null,
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    }
  },

  mounted() {
    // Get headers from domain file to import
    this.get_headers_main_event = (event, domain, headers) => {
      // Set global config value used in config importation only
      this.setConfig({ path: 'import>domain>' + domain + '>columns', value:  headers })

      // Set model used in current component
      this.model.domain[domain].columns = headers
    }
    ipcRenderer.on('get_headers', this.get_headers_main_event)
    this.headersSync('product')
    this.headersSync('family')
  },

  beforeDestroy() {
    // Destroy listener to get_headers event from main process
    ipcRenderer.removeListener('get_headers', this.get_headers_main_event)
  },

  methods: {
    headersSync(domain) {
      // this.stored_config.import.domain[domain]
      ipcRenderer.send('get_headers', domain, this.stored_config.import.type)
    },

    ...mapActions('global', [
      'setConfig',
    ]),
  }
}
</script>
