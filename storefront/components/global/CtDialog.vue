<template>
  <v-dialog
    :rounded="type === 'rounded'"
    :tile="type === 'box'"
    v-bind="$attrs"
    v-on="$listeners"
  >
    <template v-slot:activator="{ on }">
      <slot name="activator" v-on="on" />
    </template>
    <v-card v-if="type !== 'empty'" :shaped="type === 'shaped'">
      <v-toolbar v-if="title" flat :dense="dense" :color="titleColor">
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
      <slot name="actions" />
    </v-card>
    <v-card v-else v-bind="$attrs" v-on="$listeners">
      <slot />
    </v-card>
  </v-dialog>
</template>

<script type="application/javascript">
export default {
  name: 'CtDialog',

  props: {
    type: {
      type: String,
      default: 'shaped',
      validator(value) {
        // The value must match one of these strings
        return ['shaped', 'rounded', 'box', 'empty', '', null].includes(value)
      }
    },
    title: {
      type: String,
      default: ''
    },
    'title-color': {
      type: String,
      default: 'primary'
    },
    fluid: {
      type: Boolean,
      default: false
    },
    dense: {
      type: Boolean,
      default: false
    }
  }
}
</script>
<style>
.ct-card-content {
  padding: 0 0 0 0 !important;
  overflow: auto;
  max-height: 72vh;
}
</style>
