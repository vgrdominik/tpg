<template>
  <v-card v-if="type !== 'empty'" :shaped="type === 'shaped'" :rounded="type === 'rounded'" :tile="type === 'box'" v-on="$listeners" v-bind="$attrs">
    <v-toolbar flat :dense="dense" :color="titleColor">
      <slot name="leftTitleContent" />

      <v-spacer />
      <slot name="centerTitleContent">
        <v-toolbar-title style="color: white;" v-html="title" />
      </slot>
      <v-spacer />

      <slot name="rightTitleContent" />
    </v-toolbar>
    <v-content class="ct-card-content">
      <slot v-if="fluid" />
      <v-container v-else>
        <slot />
      </v-container>
    </v-content>
    <slot name="actions"/>
  </v-card>
  <v-card v-else v-on="$listeners" v-bind="$attrs">
    <slot />
  </v-card>
</template>

<script type="application/javascript">
export default {
  name: "CtCard",

  props: {
    'type': {
      type: String,
      default: 'shaped',
      validator: function (value) {
        // The value must match one of these strings
        return ['shaped', 'rounded', 'box', 'empty', '', null].indexOf(value) !== -1
      }
    },
    'title': {
      type: String,
      default: '',
    },
    'title-color': {
      type: String,
      default: 'primary',
    },
    'fluid': {
      type: Boolean,
      default: false,
    },
    'dense': {
      type: Boolean,
      default: false,
    },
  },
}
</script>
<style>
  .ct-card-content {
    padding: 0 0 0 0 !important;
    overflow: auto;
    max-height: 72vh;
  }
</style>
