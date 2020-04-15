<template>
  <font-awesome-icon
    v-if="type === 'icon'"
    :icon="icon"
    v-bind="$attrs"
    v-on="$listeners"
  />
</template>

<script type="application/javascript">
export default {
  name: 'CtIcon',

  props: {
    type: {
      type: String,
      default: 'icon',
      validator(value) {
        // The value must match one of these strings
        return ['icon'].includes(value)
      }
    },
    icon: {
      type: Array,
      required: true
    }
  }
}
</script>
