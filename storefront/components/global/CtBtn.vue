<template>
  <v-btn v-if="type==='outlined'" outlined v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-btn>
  <v-btn v-else-if="type==='rounded'" rounded v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-btn>
  <v-btn v-else-if="type==='primary'" color="primary" v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-btn>
  <v-btn v-else-if="type==='accent'" color="accent" class="primary--text" v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-btn>
  <v-btn v-else-if="type === 'text'" text v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-btn>
  <v-btn v-else-if="type === 'icon'" icon v-on="$listeners" v-bind="$attrs">
    <slot name="icon">
      <font-awesome-icon :icon="icon" />
    </slot>
    <slot />
  </v-btn>
  <v-btn v-else v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-btn>
</template>

<script type="application/javascript">
export default {
  name: "CtBtn",

  props: {
    'type': {
      type: String,
      default: 'outlined',
      validator: function (value) {
        // The value must match one of these strings
        return ['text', 'outlined', 'rounded', 'primary', 'accent', 'icon', 'empty', '', null].indexOf(value) !== -1
      }
    },
    'icon': {
      type: Array,
      default: () => [],
    },
  },
}
</script>
