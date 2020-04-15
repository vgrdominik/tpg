<template>
  <v-tooltip v-if="btn" v-on="$listeners" v-bind="$attrs">
    <template v-slot:activator="{ on }">
      <CtBtn :type="btnType" :color="btnColor" :icon="btnIcon" v-on="on" @click="$listeners.click()">{{ btnText }}</CtBtn>
    </template>
    <slot />
  </v-tooltip>
  <v-tooltip v-else v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-tooltip>
</template>

<script type="application/javascript">
export default {
  name: "CtTooltip",
  props: {
    'btn': {
      type: Boolean,
      default: false,
    },
    'btn-type': {
      type: String,
      default: 'outlined',
      validator: function (value) {
        // The value must match one of these strings
        return ['text', 'outlined', 'rounded', 'primary', 'accent', 'icon', 'empty', '', null].indexOf(value) !== -1
      }
    },
    'btn-icon': {
      type: Array,
      default: () => [],
    },
    'btn-text': {
      type: String,
      default: '',
    },
    'btn-color': {
      type: String,
      default: '',
    },
  },
}
</script>
