<template>
  <v-select
    v-if="ctType === 'outlined'"
    :dense="!withoutDense"
    outlined
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-select>
  <v-select
    v-else-if="ctType === 'box'"
    :dense="!withoutDense"
    filled
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-select>
  <v-select v-else v-bind="$attrs" v-on="$listeners">
    <slot />
  </v-select>
</template>

<script type="application/javascript">
export default {
  name: 'CtSelect',

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
