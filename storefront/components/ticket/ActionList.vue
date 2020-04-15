<template>
  <!-- LIST -->
  <v-row class="ct-card-content-action-list pt-0 pb-2">
    <v-spacer />
    <v-col
            v-for="action in actions"
            :key="action.label"
            cols="3"
            class="text-center pt-0 pb-0"
            @click="executeAction(action.action)"
    >
      <v-card style="cursor: pointer">
        <CtBtn type="icon" :icon="action.icon" :title="action.label" class="primary--text body-2" />
      </v-card>
    </v-col>
    <v-spacer />
  </v-row>
</template>

<script type="application/javascript">
export default {
  name: "ActionList",
  data: () => {
    return {
      actions: [
        {
          label: 'Movimiento de caja',
          icon: ['fas', 'money-bill-wave'],
          action: 'movementBox', // Method included in this component
        },
        {
          label: 'Cerrar turno',
          icon: ['fas', 'sign-out-alt'],
          action: 'closeTurn', // Method included in this component
        },
        {
          label: 'Abrir cajón',
          icon: ['fas', 'inbox'],
          action: 'openBox', // Method included in this component
        },
        {
          label: 'Maximizar',
          icon: ['fas', 'window-maximize'],
          action: 'maximize', // Method included in this component
        },
      ],
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    },
  },

  methods: {
    executeAction(action) {
      this[action]()
    },
    movementBox() {
      console.log('movement box: test')
    },
    closeTurn() {
      console.log('close turn: test')
    },
    openBox() {
      console.log('open box: test')
    },
    maximize() {
      let doc = document.documentElement
      if(!window.screenTop && !window.screenY) {
        document.webkitExitFullscreen()
        return
      }

      doc.webkitRequestFullscreen()
    },
  },
}
</script>
<style>
  .ct-card-content-action-list {
    max-height: 5vh;
  }
</style>
