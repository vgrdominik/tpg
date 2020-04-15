<template>
  <div>

    <!-- Color Palette -->
    <v-row dense :class="{ 'mt-1': $vuetify.breakpoint.smAndUp }">
      <v-col cols="12" lg="8" class="body-2 justify-center">
        <CtBtn :type="stored_config.branding.style.button" color="secondary" @click="show_color_palette = ! show_color_palette">Paleta de colores</CtBtn> (Click para mostrar/ocultar)
      </v-col>
      <v-col cols="12" lg="4" v-if="show_color_palette">
        <v-row dense class="body-1">
          <v-spacer />
          Primario
          <v-spacer />
        </v-row>
        <v-row dense>
          <v-spacer />
          <v-color-picker v-model="model.color_palette.primary" mode="hexa" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_color_palette">
      <v-col cols="12" lg="4">
        <v-row dense class="body-1">
          <v-spacer />
          Secundario
          <v-spacer />
        </v-row>
        <v-row dense>
          <v-spacer />
          <v-color-picker v-model="model.color_palette.secondary" mode="hexa" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" lg="4">
        <v-row dense class="body-1">
          <v-spacer />
          Destacado
          <v-spacer />
        </v-row>
        <v-row dense>
          <v-spacer />
          <v-color-picker v-model="model.color_palette.accent" mode="hexa" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" lg="4">
        <v-row dense class="body-1">
          <v-spacer />
          Información
          <v-spacer />
        </v-row>
        <v-row dense>
          <v-spacer />
          <v-color-picker v-model="model.color_palette.info" mode="hexa" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_color_palette">
      <v-col cols="12" lg="4">
        <v-row dense class="body-1">
          <v-spacer />
          Validación
          <v-spacer />
        </v-row>
        <v-row dense>
          <v-spacer />
          <v-color-picker v-model="model.color_palette.success" mode="hexa" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" lg="4">
        <v-row dense class="body-1">
          <v-spacer />
          Error
          <v-spacer />
        </v-row>
        <v-row dense>
          <v-spacer />
          <v-color-picker v-model="model.color_palette.error" mode="hexa" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" lg="4">
        <v-row dense class="body-1">
          <v-spacer />
          Alerta
          <v-spacer />
        </v-row>
        <v-row dense>
          <v-spacer />
          <v-color-picker v-model="model.color_palette.warning" mode="hexa" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>

    <!-- Styles -->
    <v-row dense :class="{ 'mt-5': $vuetify.breakpoint.smAndUp }">
      <v-col cols="12" sm="8" class="body-2 justify-center">
        <CtBtn :type="stored_config.branding.style.button" color="secondary" @click="show_style = ! show_style">Estilos</CtBtn> (Click para mostrar/ocultar)
      </v-col>
    </v-row>

    <!-- Styles Buttons -->
    <v-row dense v-if="show_style">
      <v-col cols="12" sm="3">
        <v-row dense class="body-1">
          <v-spacer />
          Botones
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleButtonText" class="ma-4" label="Text" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtBtn type="text" color="primary" v-html="'Primario'" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtBtn type="text" color="secondary" v-html="'Secundario'" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_style">
      <v-spacer />
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleButtonRounded" class="ma-4" label="Redondeado" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtBtn type="rounded" color="primary" v-html="'Primario'" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtBtn type="rounded" color="secondary" v-html="'Secundario'" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_style">
      <v-spacer />
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleButtonOutlined" class="ma-4" label="Línea" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtBtn type="outlined" color="primary" v-html="'Primario'" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtBtn type="outlined" color="secondary" v-html="'Secundario'" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>

    <!-- Styles Forms -->
    <v-row dense v-if="show_style">
      <v-col cols="12" sm="3">
        <v-row dense class="body-1">
          <v-spacer />
          Formularios
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleFormOutlined" class="ma-4" label="Línea" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtTextField ctType="outlined" color="primary" label="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtTextField ctType="outlined" color="secondary" label="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_style">
      <v-spacer />
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleFormBox" class="ma-4" label="Caja" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtTextField ctType="box" color="primary" label="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtTextField ctType="box" color="secondary" label="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>

    <!-- Styles Cards -->
    <v-row dense v-if="show_style">
      <v-col cols="12" sm="3">
        <v-row dense class="body-1">
          <v-spacer />
          Tarjetas
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleCardRounded" class="ma-4" label="Redondeado" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="rounded" title-color="primary" title="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="rounded" title-color="secondary" title="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_style">
      <v-spacer />
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleCardBox" class="ma-4" label="Caja" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="box" title-color="primary" title="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="box" title-color="secondary" title="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_style">
      <v-spacer />
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleCardShaped" class="ma-4" label="Forma" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="shaped" title-color="primary" title="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="shaped" title-color="secondary" title="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>

    <!-- Styles Dialogs -->
    <v-row dense v-if="show_style">
      <v-col cols="12" sm="3">
        <v-row dense class="body-1">
          <v-spacer />
          Pop Ups
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleDialogRounded" class="ma-4" label="Redondeado" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="rounded" title-color="primary" title="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="rounded" title-color="secondary" title="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_style">
      <v-spacer />
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleDialogBox" class="ma-4" label="Caja" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="box" title-color="primary" title="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="box" title-color="secondary" title="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
    <v-row dense v-if="show_style">
      <v-spacer />
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <v-switch v-model="styleDialogShaped" class="ma-4" label="Forma" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="shaped" title-color="primary" title="Primario" />
          <v-spacer />
        </v-row>
      </v-col>
      <v-col cols="12" sm="3">
        <v-row dense>
          <v-spacer />
          <CtCard type="shaped" title-color="secondary" title="Secundario" />
          <v-spacer />
        </v-row>
      </v-col>
    </v-row>
  </div>
</template>

<script type="application/javascript">
export default {
  name: "Branding",
  props: {
    'model': {
      type: Object,
      required: true,
    },
  },

  data: () => {
    return {
      show_color_palette: false,
      show_style: false,

      styleButtonRounded: false,
      styleButtonOutlined: false,
      styleButtonText: false,

      styleFormOutlined: false,
      styleFormBox: false,

      styleCardRounded: false,
      styleCardBox: false,
      styleCardShaped: false,

      styleDialogRounded: false,
      styleDialogBox: false,
      styleDialogShaped: false,
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    }
  },

  watch: {
    styleButtonRounded(newValue) {
      if (newValue === true) {
        this.styleButtonOutlined = false
        this.styleButtonText = false
        this.model.style.button = 'rounded'
      }
    },
    styleButtonOutlined(newValue) {
      if (newValue === true) {
        this.styleButtonRounded = false
        this.styleButtonText = false
        this.model.style.button = 'outlined'
      }
    },
    styleButtonText(newValue) {
      if (newValue === true) {
        this.styleButtonOutlined = false
        this.styleButtonRounded = false
        this.model.style.button = 'text'
      }
    },

    styleFormOutlined(newValue) {
      if (newValue === true) {
        this.styleFormBox = false
        this.model.style.form = 'outlined'
      }
    },
    styleFormBox(newValue) {
      if (newValue === true) {
        this.styleFormOutlined = false
        this.model.style.form = 'box'
      }
    },

    styleCardRounded(newValue) {
      if (newValue === true) {
        this.styleCardBox = false
        this.styleCardShaped = false
        this.model.style.card = 'rounded'
      }
    },
    styleCardBox(newValue) {
      if (newValue === true) {
        this.styleCardShaped = false
        this.styleCardRounded = false
        this.model.style.card = 'box'
      }
    },
    styleCardShaped(newValue) {
      if (newValue === true) {
        this.styleCardRounded = false
        this.styleCardBox = false
        this.model.style.card = 'shaped'
      }
    },

    styleDialogRounded(newValue) {
      if (newValue === true) {
        this.styleDialogBox = false
        this.styleDialogShaped = false
        this.model.style.dialog_card = 'rounded'
      }
    },
    styleDialogBox(newValue) {
      if (newValue === true) {
        this.styleDialogShaped = false
        this.styleDialogRounded = false
        this.model.style.dialog_card = 'box'
      }
    },
    styleDialogShaped(newValue) {
      if (newValue === true) {
        this.styleDialogRounded = false
        this.styleDialogBox = false
        this.model.style.dialog_card = 'shaped'
      }
    },
  },

  mounted() {
    if (this.model.style.button === 'rounded') {
      this.styleButtonRounded = true
    }
    if (this.model.style.button === 'outlined') {
      this.styleButtonOutlined = true
    }
    if (this.model.style.button === 'text') {
      this.styleButtonText = true
    }

    if (this.model.style.form === 'outlined') {
      this.styleFormOutlined = true
    }
    if (this.model.style.form === 'box') {
      this.styleFormBox = true
    }

    if (this.model.style.card === 'rounded') {
      this.styleCardRounded = true
    }
    if (this.model.style.card === 'box') {
      this.styleCardBox = true
    }
    if (this.model.style.card === 'shaped') {
      this.styleCardShaped = true
    }

    if (this.model.style.dialog_card === 'rounded') {
      this.styleDialogRounded = true
    }
    if (this.model.style.dialog_card === 'box') {
      this.styleDialogBox = true
    }
    if (this.model.style.dialog_card === 'shaped') {
      this.styleDialogShaped = true
    }
  },
}
</script>
