<template>
  <v-btn v-if="type === 'outlined'" outlined v-bind="$attrs" v-on="$listeners">
    <slot />
  </v-btn>
  <v-btn
    v-else-if="type === 'rounded'"
    rounded
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-btn>
  <v-btn
    v-else-if="type === 'primary'"
    color="primary"
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-btn>
  <v-btn
    v-else-if="type === 'accent'"
    color="accent"
    class="primary--text"
    v-bind="$attrs"
    v-on="$listeners"
  >
    <slot />
  </v-btn>
  <v-btn v-else-if="type === 'text'" text v-bind="$attrs" v-on="$listeners">
    <slot />
  </v-btn>
  <v-btn v-else-if="type === 'icon'" icon v-bind="$attrs" v-on="$listeners">
    <slot name="icon">
      <font-awesome-icon :icon="icon" />
    </slot>
    <slot />
  </v-btn>
  <v-btn v-else v-bind="$attrs" v-on="$listeners">
    <slot />
  </v-btn>
</template>

<script type="application/javascript">
export default {
  name: 'CtBtn',

  props: {
    type: {
      type: String,
      default: 'outlined',
      validator(value) {
        // The value must match one of these strings
        return [
          'text',
          'outlined',
          'rounded',
          'primary',
          'accent',
          'icon',
          'empty',
          '',
          null
        ].includes(value)
      }
    },
    icon: {
      type: Array,
      default: () => []
    }
  }
}
</script>
