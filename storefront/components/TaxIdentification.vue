<template>
  <div>
    <v-row dense>
      <v-col cols="12" sm="6">
        <CtTextField v-model="model.tax_name" :ctType="stored_config.branding.style.form" label="Nombre fiscal" />
      </v-col>
      <v-col cols="12" sm="6">
        <CtTextField v-model="model.tax_identification" :ctType="stored_config.branding.style.form" label="Identificación fiscal (NIF o DNI)" />
      </v-col>
    </v-row>
    <v-row dense>
      <v-col cols="12" sm="6">
        <CtTextField v-model="model.address" :ctType="stored_config.branding.style.form" label="Dirección" />
      </v-col>
      <v-col cols="12" sm="6">
        <CtTextField v-model="model.postal_code" :ctType="stored_config.branding.style.form" label="Código postal" />
      </v-col>
    </v-row>
    <v-row dense>
      <v-col cols="12" sm="6">
        <CtTextField v-model="model.city" :ctType="stored_config.branding.style.form" label="Poblacion" />
      </v-col>
      <v-col cols="12" sm="6">
        <CtTextField v-model="model.province" :ctType="stored_config.branding.style.form" label="Provincia" />
      </v-col>
    </v-row>
  </div>
</template>

<script type="application/javascript">
export default {
  name: "TaxIdentification",

  props: {
    'model': {
      type: Object,
      required: true,
    },
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    }
  },
}
</script>
