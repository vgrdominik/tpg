<template>
  <font-awesome-icon v-if="type==='icon'" :icon="icon" v-on="$listeners" v-bind="$attrs" />
</template>

<script type="application/javascript">
export default {
  name: "CtIcon",

  props: {
    'type': {
      type: String,
      default: 'icon',
      validator: function (value) {
        // The value must match one of these strings
        return ['icon'].indexOf(value) !== -1
      }
    },
    'icon': {
      type: Array,
      required: true,
    },
  },
}
</script>
