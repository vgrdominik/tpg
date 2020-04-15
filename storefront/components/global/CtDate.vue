<template>
  <v-date-picker
    v-if="ctType === 'outlined'"
    :dense="!withoutDense"
    outlined
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-date-picker>
  <v-date-picker
    v-else-if="ctType === 'box'"
    :dense="!withoutDense"
    filled
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-date-picker>
  <v-date-picker v-else v-bind="$attrs" v-on="$listeners">
    <slot />
  </v-date-picker>
</template>

<script type="application/javascript">
export default {
  name: 'CtDate',

  props: {
    ctType: {
      type: String,
      default: 'outlined',
      validator(value) {
        // The value must match one of these strings
        return ['outlined', 'box', 'empty', '', null].includes(value)
      }
    },
    withoutDense: {
      type: Boolean,
      default: false
    }
  }
}
</script>
