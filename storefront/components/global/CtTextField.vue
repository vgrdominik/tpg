<template>
  <v-text-field
    v-if="ctType === 'outlined'"
    :dense="!withoutDense"
    outlined
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-text-field>
  <v-text-field
    v-else-if="ctType === 'box'"
    :dense="!withoutDense"
    filled
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-text-field>
  <v-text-field v-else v-bind="$attrs" v-on="$listeners">
    <slot />
  </v-text-field>
</template>

<script type="application/javascript">
export default {
  name: 'CtTextField',

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
