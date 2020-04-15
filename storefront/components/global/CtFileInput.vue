<template>
  <v-file-input v-if="ctType==='outlined'" :dense="! withoutDense" outlined v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-file-input>
  <v-file-input v-else-if="ctType==='box'" :dense="! withoutDense" filled v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-file-input>
  <v-file-input v-else v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-file-input>
</template>

<script type="application/javascript">
export default {
  name: "CtFileInput",

  props: {
    'ctType': {
      type: String,
      default: 'outlined',
      validator: function (value) {
        // The value must match one of these strings
        return ['outlined', 'box', 'empty', '', null].indexOf(value) !== -1
      }
    },
    'withoutDense': {
      type: Boolean,
      default: false,
    },
  },
}
</script>
