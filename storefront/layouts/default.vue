<template>
  <v-app id="inspire">
    <v-navigation-drawer
      v-model="drawer"
      :clipped="$vuetify.breakpoint.lgAndUp"
      app
    >
      <v-list dense>
        <template v-for="item in items">
          <v-row
            v-if="item.heading"
            :key="item.heading"
            align="center"
          >
            <v-col cols="12">
              <v-subheader v-if="item.heading">
                {{ item.heading }}
              </v-subheader>
            </v-col>
          </v-row>
          <v-list-group
            v-else-if="item.children"
            :key="item.text"
            v-model="item.model"
            append-icon=""
          >
            <template v-slot:activator>
              <v-list-item-content @click="$router.push({ path: item.path })">
                <v-list-item-title class="primary--text">
                  {{ item.text }}
                </v-list-item-title>
              </v-list-item-content>
            </template>
            <v-list-item
              v-for="(child, i) in item.children"
              :key="i"
              link
            >
              <v-list-item-action v-if="child.icon" @click="$router.push({ path: child.path })">
                <CtIcon :icon="child.icon" class="primary--text" />
              </v-list-item-action>
              <v-list-item-content @click="$router.push({ path: child.path })">
                <v-list-item-title class="primary--text">
                  {{ child.text }}
                </v-list-item-title>
              </v-list-item-content>
            </v-list-item>
          </v-list-group>
          <v-list-item
            v-else
            :key="item.text"
            link
          >
            <v-list-item-action @click="$router.push({ path: item.path })">
              <CtIcon :icon="item.icon" class="primary--text" />
            </v-list-item-action>
            <v-list-item-content @click="$router.push({ path: item.path })">
              <v-list-item-title class="primary--text">
                {{ item.text }}
              </v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </template>

        <!-- Exit -->
        <v-list-item link>
          <v-list-item-action @click="exit()">
            <CtIcon :icon="['fas', 'sign-out-alt']" class="primary--text" />
          </v-list-item-action>
          <v-list-item-content @click="exit()">
            <v-list-item-title class="primary--text">
              Salir
            </v-list-item-title>
          </v-list-item-content>
        </v-list-item>
      </v-list>
    </v-navigation-drawer>

    <v-app-bar
      :clipped-left="$vuetify.breakpoint.lgAndUp"
      app
      dark
      color="primary"
      height="42"
    >
      <CtBtn type="icon" :icon="['fas', 'chevron-left']" small @click="$router.go(-1)" class="mr-3" />

      <v-app-bar-nav-icon small @click.stop="drawer = !drawer" />
      <v-toolbar-title
        style="width: 300px"
        class="ml-0 pl-4"
      >
        <CtBtn type="text" color="white" to="/">TPV</CtBtn>
      </v-toolbar-title>
      <v-spacer />

      <template v-if="user">
        <CtBtn type="text" color="white" @click="logout()">
          Salir
        </CtBtn>
      </template>
      <template v-else>
        <CtBtn type="text" color="white" to="/login">
          Login
        </CtBtn>
        |
        <CtBtn type="text" color="white" to="/registro">
          Registro gratuito
        </CtBtn>
      </template>
      <CtBtn type="icon" :icon="['fas', 'bell']" small to="/notificaciones" />
    </v-app-bar>
    <v-content id="maincontent" class="pt-8">
      <router-view v-if="! isContainerNeeded" />
      <v-container
        class="fill-height"
        fluid
        v-else
      >
        <router-view />
      </v-container>
    </v-content>

    <CtBtn
      fab
      dark
      type="rounded"
      :color="stateColor"
      bottom
      right
      fixed
      @click="synchronization()"
    >
      <v-icon>mdi-cached</v-icon>
    </CtBtn>

    <v-footer padless fixed v-if="$router.currentRoute.path !== '/'">
      <CtCard type="empty" fluid flat tile width="100%" class="primary text-center">
        <v-card-text class="pa-0">
          <v-row dense>
            <v-col cols="12" sm="4" v-if="$vuetify.breakpoint.smAndUp">
              <CtBtn v-for="footerItem in footerItems" :key="footerItem.title" type="icon" target="_blank" :title="footerItem.title" :href="footerItem.href" :icon="footerItem.icon" class="mx-4 white--text" />
            </v-col>
            <v-col cols="12" sm="4" class="white--text pt-3" v-if="$vuetify.breakpoint.smAndUp">
              Recuerda pensar en tu producto y tus clientes!
            </v-col>
            <v-col cols="12" sm="4">
              <CtBtn type="text" color="white">Condiciones</CtBtn>
              <CtBtn type="text" color="white">{{ new Date().getFullYear() }} — Ryu</CtBtn>
            </v-col>
          </v-row>
        </v-card-text>
      </CtCard>
    </v-footer>
  </v-app>
</template>

<script>
import { ipcRenderer, remote } from 'electron'
import { mapMutations, mapActions } from 'vuex'
import _ from "underscore"

export default {
  props: {
    source: String,
  },

  data: () => ({
    // CONFIG SETTINGS
    // Get config event to listen main process state
    get_config_main_event: null,
    // END CONFIG SETTINGS

    // DOMAIN CONTENT
    get_content_main_event: null,
    // END CONTENT

    dialog: false,
    drawer: false,
    stateColor: 'primary', // primary = synchronized, secondary = not_synchronized, error = synchronized_error
    state: 'synchronized', // not_synchronized, synchronized_error
    items: [
      { icon: ['fas', 'heart'], text: 'TPV', path: '/' },
      { icon: ['fas', 'cogs'], text: 'Configuración', path: '/configuracion' },
    ],
    footerItems: [
      {
        href: 'https://www.facebook.com/iamvalentigamez',
        icon: ['fab', 'facebook'],
        title: 'Página de Facebook',
      },
      {
        href: 'https://twitter.com/iamvalentigamez',
        icon: ['fab', 'twitter'],
        title: 'Pperfil de Twitter',
      },
      {
        href: 'https://www.instagram.com/iamvalentigamez/',
        icon: ['fab', 'instagram'],
        title: 'Perfil de Instagram',
      },
      {
        href: 'https://www.youtube.com/vgrdominik',
        icon: ['fab', 'youtube'],
        title: 'Canal de programación',
      },
    ],
  }),

  computed: {
    isContainerNeeded () {
      return this.$store.state.global.is_container_needed
    },

    user () {
      return this.$store.state.user.user
    },

    stored_config () {
      return this.$store.state.global.config
    }
  },

  watch: {
    state(newValue) {
      // primary = synchronized, secondary = not_synchronized, error = synchronized_error
      if (newValue === 'synchronized') {
        this.stateColor = 'primary'
      }
      if (newValue === 'not_synchronized') {
        this.stateColor = 'secondary'
      }
      if (newValue === 'synchronized_error') {
        this.stateColor = 'error'
      }
    },
  },

  mounted() {
    //console.log(this.stored_config)
    // console.log(JSON.stringify(this.stored_config))
    // Get current config
    this.get_config_main_event = (event, configData) => {
      this.setConfig({ path: 'initialized', value: false })
      this.setConfigComplete(configData)
      this.$vuetify.theme.themes.light.primary = configData.branding.color_palette.primary
      this.$vuetify.theme.themes.light.secondary = configData.branding.color_palette.secondary
      this.$vuetify.theme.themes.light.accent = configData.branding.color_palette.accent
      this.$vuetify.theme.themes.light.success = configData.branding.color_palette.success
      this.$vuetify.theme.themes.light.error = configData.branding.color_palette.error
      this.$vuetify.theme.themes.light.warning = configData.branding.color_palette.warning
      this.$vuetify.theme.themes.light.info = configData.branding.color_palette.info
      this.setConfig({ path: 'initialized', value: true })

      this.synchronization()
    }

    // Get and transform content from domain file to import
    this.get_content_main_event = (event, domain, content) => {
      // Transform domain content to app structure defined at global config
      let contentTransformed = []

      for (let i = 0; i < content.length; i++) {
        let contentTransformedElement = this.domainRowTransformerToAppStructure(domain, content[i])
        contentTransformed.push(contentTransformedElement)
      }

      // Set transformed content to use globally
      if (domain === 'product') {
        contentTransformed = this.domainRowProductTransformerToAppStructure(contentTransformed)
        this.setProducts(contentTransformed)
      }
      if (domain === 'family') {
        this.setFamilies(contentTransformed)
      }
      if (domain === 'ticket') {
        contentTransformed = this.domainRowTicketTransformerToAppStructure(contentTransformed)
        this.setTickets(contentTransformed)
        ipcRenderer.send('get_content', 'ticket_line', this.stored_config.import.type)
      }
      if (domain === 'ticket_line') {
        contentTransformed = this.domainRowTicketLineTransformerToAppStructure(contentTransformed)
        this.setTicketsLines(contentTransformed)
        ipcRenderer.send('get_content', 'ticket_complement', this.stored_config.import.type)
      }
      if (domain === 'ticket_complement') {
        contentTransformed = this.domainRowTicketComplementTransformerToAppStructure(contentTransformed)
        this.setTicketsLinesComplements(contentTransformed)
        ipcRenderer.send('get_content', 'ticket_receipt', this.stored_config.import.type)
      }
      if (domain === 'ticket_receipt') {
        contentTransformed = this.domainRowReceiptTransformerToAppStructure(contentTransformed)
        this.setTicketsReceipts(contentTransformed)
      }
      if (domain === 'customer') {
        contentTransformed = this.domainRowCustomerTransformerToAppStructure(contentTransformed)
        this.setCustomers(contentTransformed)
        ipcRenderer.send('get_content', 'customer_search', this.stored_config.import.type)
      }
      if (domain === 'customer_search') {
        this.setCustomersSearch(contentTransformed)
      }
    }

    ipcRenderer.on('get_config', this.get_config_main_event)
    ipcRenderer.on('get_content', this.get_content_main_event)
    ipcRenderer.send('get_config')

    setTimeout(() => this.update_time_to_sync(), 1000)

    // In development mode
    document.addEventListener("keydown", function (e) {
      if (e.which === 123) {
        remote.getCurrentWindow().toggleDevTools()
      } else if (e.which === 116) {
        location.reload()
      }
    })
    // End in development mode
  },

  beforeDestroy() {
    // Destroy listener to get_config and get_content event from main process
    ipcRenderer.removeListener('get_config', this.get_config_main_event)
    ipcRenderer.removeListener('get_content', this.get_content_main_event)
  },

  methods: {
    update_time_to_sync() {
      if (this.$store.state.global.time_to_sync <= 0) {
        // this.synchronization() TODO
        this.setTimeToSync(this.$store.state.global.default_time_to_sync)
      } else {
        this.setTimeToSync(this.$store.state.global.time_to_sync - 1000)
      }

      setTimeout(() => this.update_time_to_sync(), 1000)
    },

    exit() {
      remote.getCurrentWindow().close()
    },

    afterLogout(){
      this.setToken('')
      this.removeUser()
      setTimeout(() => this.$router.push({ path: '/' }), 2000)
    },

    logout () {
      this.$axios.post('/api/logout', {},{
        headers: { Authorization: 'Bearer ' + this.$store.state.user.token }
      }).then(() => this.afterLogout())
    },

    synchronization () {
      ipcRenderer.send('get_content', 'product', this.stored_config.import.type)
      ipcRenderer.send('get_content', 'family', this.stored_config.import.type)
      ipcRenderer.send('get_content', 'ticket', this.stored_config.import.type)
      ipcRenderer.send('get_content', 'customer', this.stored_config.import.type)
    },


    // START Import methods

    domainRowTransformerToAppStructure(domain, contentRow) {
      // Convert columns to fields
      let rowContentTransformed = contentRow.map((contentToTransform) => {
        let contentTransformed = {}

        // contentToTransform[z] is { column: 'example', content: 'example' } ====> column = Column/Field of type, csv by default
        // (_.invert(this.stored_config.import.domain[domain].fields_columns))[contentToTransform.column] ====> get key (domain field) from column content (domain column in type, csv by default) ====> gets domain field
        let domainField = (_.invert(this.stored_config.import.domain[domain].fields_columns))[contentToTransform.column]
        if (domainField === undefined) {
          // To columns not defined in global config
          contentTransformed.control = null
          return contentTransformed
        }
        contentTransformed[domainField] = contentToTransform.content

        return contentTransformed
      })

      // Convert array to unique object
      let normalizedContentTransformed = {}
      for (let z = 0; z < rowContentTransformed.length; z++) {
        let contentKey = Object.keys(rowContentTransformed[z])[0]
        // To columns defined in global config
        if (contentKey !== 'control') {
          // Insert content to normalized object with domain key field
          normalizedContentTransformed[contentKey] = rowContentTransformed[z][contentKey]
        }
      }

      return normalizedContentTransformed
    },

    domainRowProductTransformerToAppStructure(contentPreTransformed) {
      let contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        if (contentPreTransformed[i].complement_ids_available) {
          contentPreTransformed[i].complement_ids_available = contentPreTransformed[i].complement_ids_available.split(',')
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowTicketTransformerToAppStructure(contentPreTransformed) {
      let contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {


        // State TODO

        // Dates transformer
        if (contentPreTransformed[i].create_date && contentPreTransformed[i].create_date !== '0000-00-00') {
          contentPreTransformed[i].create_date = new Date(contentPreTransformed[i].create_date)
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (contentPreTransformed[i].update_date && contentPreTransformed[i].update_date !== '0000-00-00') {
          contentPreTransformed[i].update_date = new Date(contentPreTransformed[i].update_date)
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowTicketLineTransformerToAppStructure(contentPreTransformed) {
      let contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        if (contentPreTransformed[i].quantity && typeof contentPreTransformed[i].quantity === 'string') {
          contentPreTransformed[i].quantity = parseFloat(contentPreTransformed[i].quantity.replace(',', '.'))
        } else {
          contentPreTransformed[i].quantity = 0
        }
        if (contentPreTransformed[i].iva && typeof contentPreTransformed[i].iva === 'string') {
          contentPreTransformed[i].iva = parseFloat(contentPreTransformed[i].iva.replace(',', '.'))
        } else {
          contentPreTransformed[i].iva = 0
        }
        // Dates transformer
        if (contentPreTransformed[i].create_date && contentPreTransformed[i].create_date !== '0000-00-00') {
          contentPreTransformed[i].create_date = new Date(contentPreTransformed[i].create_date)
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (contentPreTransformed[i].update_date && contentPreTransformed[i].update_date !== '0000-00-00') {
          contentPreTransformed[i].update_date = new Date(contentPreTransformed[i].update_date)
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowTicketComplementTransformerToAppStructure(contentPreTransformed) {
      let contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        // Dates transformer
        if (contentPreTransformed[i].create_date && contentPreTransformed[i].create_date !== '0000-00-00') {
          contentPreTransformed[i].create_date = new Date(contentPreTransformed[i].create_date)
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (contentPreTransformed[i].update_date && contentPreTransformed[i].update_date !== '0000-00-00') {
          contentPreTransformed[i].update_date = new Date(contentPreTransformed[i].update_date)
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowReceiptTransformerToAppStructure(contentPreTransformed) {
      let contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        // Dates transformer
        if (contentPreTransformed[i].paid_date && contentPreTransformed[i].paid_date !== '0000-00-00') {
          contentPreTransformed[i].paid_date = new Date(contentPreTransformed[i].paid_date)
        } else {
          contentPreTransformed[i].paid_date = null
        }
        if (contentPreTransformed[i].expiration_date && contentPreTransformed[i].expiration_date !== '0000-00-00') {
          contentPreTransformed[i].expiration_date = new Date(contentPreTransformed[i].expiration_date)
        } else {
          contentPreTransformed[i].expiration_date = null
        }
        if (contentPreTransformed[i].create_date && contentPreTransformed[i].create_date !== '0000-00-00') {
          contentPreTransformed[i].create_date = new Date(contentPreTransformed[i].create_date)
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (contentPreTransformed[i].update_date && contentPreTransformed[i].update_date !== '0000-00-00') {
          contentPreTransformed[i].update_date = new Date(contentPreTransformed[i].update_date)
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowCustomerTransformerToAppStructure(contentPreTransformed) {
      let contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        // Dates transformer
        if (contentPreTransformed[i].create_date && contentPreTransformed[i].create_date !== '0000-00-00') {
          contentPreTransformed[i].create_date = new Date(contentPreTransformed[i].create_date)
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (contentPreTransformed[i].birthday_date && contentPreTransformed[i].birthday_date !== '0000-00-00') {
          contentPreTransformed[i].birthday_date = new Date(contentPreTransformed[i].birthday_date)
        } else {
          contentPreTransformed[i].birthday_date = null
        }
        if (contentPreTransformed[i].drop_date && contentPreTransformed[i].drop_date !== '0000-00-00') {
          contentPreTransformed[i].drop_date = new Date(contentPreTransformed[i].drop_date)
        } else {
          contentPreTransformed[i].drop_date = null
        }
        if (contentPreTransformed[i].update_date && contentPreTransformed[i].update_date !== '0000-00-00') {
          contentPreTransformed[i].update_date = new Date(contentPreTransformed[i].update_date)
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    // END Import methods

    ...mapActions({
      setToken: 'user/setToken',
    }),

    ...mapActions('global', [
      'setConfig',
      'setConfigComplete',
      'setTimeToSync',
    ]),

    ...mapActions('ticket', [
      'setTickets',
      'setTicketsLines',
      'setTicketsLinesComplements',
      'setTicketsReceipts',
    ]),

    ...mapActions('customer', [
      'setCustomers',
      'setCustomersSearch',
    ]),

    ...mapActions('product', [
      'setProducts',
    ]),

    ...mapActions('family', [
      'setFamilies',
    ]),

    ...mapMutations({
      removeUser: 'user/removeUser',
    }),
  },
}
</script>
