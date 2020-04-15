<template>
  <v-select v-if="ctType==='outlined'" :dense="! withoutDense" outlined v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-select>
  <v-select v-else-if="ctType==='box'" :dense="! withoutDense" filled v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-select>
  <v-select v-else v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-select>
</template>

<script type="application/javascript">
export default {
  name: "CtSelect",

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
