<template>
  <v-app id="inspire">
    <v-content id="maincontent" class="pt-2">
      <h1 class="display-2 white--text text-center">Buscador rápido</h1>
      <router-view v-if="!isContainerNeeded" />
      <v-container v-else class="fill-height" fluid>
        <router-view />
      </v-container>
    </v-content>
  </v-app>
</template>

<script>
import { mapMutations, mapActions } from 'vuex'
import _ from 'underscore'

export default {
  props: {
    source: String
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
    stateColor: 'primary', // primary = synchronized, secondary = not_synchronized, error = synchronized_error
    state: 'synchronized' // not_synchronized, synchronized_error
  }),

  computed: {
    isContainerNeeded() {
      return this.$store.state.global.is_container_needed
    },

    user() {
      return this.$store.state.user.user
    },

    stored_config() {
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
    }
  },

  mounted() {
    // console.log(this.stored_config)
    // console.log(JSON.stringify(this.stored_config))
    // Get current config
    this.get_config_main_event = (event, configData) => {
      // Added to api
      configData = this.configDataTransformerToAppStructure(configData)
      // END Added to api

      this.setConfig({ path: 'initialized', value: false })
      this.setConfigComplete(configData)
      this.$vuetify.theme.themes.light.primary =
        configData.branding.color_palette.primary
      this.$vuetify.theme.themes.light.secondary =
        configData.branding.color_palette.secondary
      this.$vuetify.theme.themes.light.accent =
        configData.branding.color_palette.accent
      this.$vuetify.theme.themes.light.success =
        configData.branding.color_palette.success
      this.$vuetify.theme.themes.light.error =
        configData.branding.color_palette.error
      this.$vuetify.theme.themes.light.warning =
        configData.branding.color_palette.warning
      this.$vuetify.theme.themes.light.info =
        configData.branding.color_palette.info

      this.$vuetify.theme.themes.dark.primary =
        configData.branding.color_palette.primary
      this.$vuetify.theme.themes.dark.secondary =
        configData.branding.color_palette.secondary
      this.$vuetify.theme.themes.dark.accent =
        configData.branding.color_palette.accent
      this.$vuetify.theme.themes.dark.success =
        configData.branding.color_palette.success
      this.$vuetify.theme.themes.dark.error =
        configData.branding.color_palette.error
      this.$vuetify.theme.themes.dark.warning =
        configData.branding.color_palette.warning
      this.$vuetify.theme.themes.dark.info =
        configData.branding.color_palette.info
      this.setConfig({ path: 'initialized', value: true })

      this.synchronization()
    }

    // Get and transform content from domain file to import
    this.get_content_main_event = (event, domain, content) => {
      // Transform domain content to app structure defined at global config

      const contentTransformed = this.domainRowTransformerToAppStructure(
        domain,
        content
      )

      // Set transformed content to use globally
      if (domain === 'product' || domain === 'all') {
        // console.log(contentTransformed.product)
        contentTransformed.product = this.domainRowProductTransformerToAppStructure(
          contentTransformed.product
        )
        if (contentTransformed.product === undefined) {
          this.setProducts(contentTransformed)
        } else {
          this.setProducts(contentTransformed.product)
        }
      }

      if (domain === 'family' || domain === 'all') {
        // console.log(contentTransformed.family)
        if (contentTransformed.family === undefined) {
          this.setFamilies(contentTransformed)
        } else {
          this.setFamilies(contentTransformed.family)
        }
      }
      if (domain === 'ticket' || domain === 'all') {
        // console.log(contentTransformed.family)
        if (contentTransformed.ticket === undefined) {
          this.setTickets(contentTransformed)
        } else {
          this.setTickets(contentTransformed.ticket)
        }
      }
      // if (domain === 'ticket_line' || domain === 'all') {
      //   contentTransformed = this.domainRowTicketLineTransformerToAppStructure(
      //     contentTransformed
      //   )
      //   this.setTicketsLines(contentTransformed)
      //   console.log('TODO get ticket complement from api')
      // }
      // if (domain === 'ticket_complement' || domain === 'all') {
      //   contentTransformed = this.domainRowTicketComplementTransformerToAppStructure(
      //     contentTransformed
      //   )
      //   this.setTicketsLinesComplements(contentTransformed)
      //   console.log('TODO get ticket receipt from api')
      // }
      // if (domain === 'ticket_receipt' || domain === 'all') {
      //   contentTransformed = this.domainRowReceiptTransformerToAppStructure(
      //     contentTransformed
      //   )
      //   this.setTicketsReceipts(contentTransformed)
      // }
      if (domain === 'customer' || domain === 'all') {
        // console.log(contentTransformed.customer)
        if (contentTransformed.customer === undefined) {
          this.setCustomers(contentTransformed)
        } else {
          this.setCustomers(contentTransformed.customer)
        }
      }
      // if (domain === 'customer_search' || domain === 'all') {
      //   // console.log(contentTransformed.customer_search)
      //   if (contentTransformed.customer_search === undefined) {
      //     this.setCustomersSearch(contentTransformed)
      //   } else {
      //     this.setCustomersSearch(contentTransformed.customer_search)
      //   }
      // }
    }

    this.$axios
      .get('http://localhost:8000/shop-api/configuration?channelCode=default')
      .then((response) => {
        this.get_config_main_event({}, response.data.data)
      })
    this.$axios
      .get(
        'http://localhost:8000/shop-api/content?channelCode=default&locale=es'
      )
      .then((response) => {
        this.get_content_main_event({}, 'all', response.data.data)
      })

    // setTimeout(() => this.update_time_to_sync(), 1000)
  },

  beforeDestroy() {
    // Destroy listener to get_config and get_content event from main process

    console.log('TODO remove listener to get config from api')
    console.log('TODO remove listener to get content from api')
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
      console.log('exit - TO REMOVE')
    },

    afterLogout() {
      this.setToken('')
      this.removeUser()
      setTimeout(() => this.$router.push({ path: '/' }), 2000)
    },

    logout() {
      this.$axios
        .post(
          '/api/logout',
          {},
          {
            headers: { Authorization: 'Bearer ' + this.$store.state.user.token }
          }
        )
        .then(() => this.afterLogout())
    },

    synchronization() {
      console.log('TODO get content product from api')
      console.log('TODO get content family from api')
      console.log('TODO get content ticket from api')
      console.log('TODO get content customer from api')
    },

    // START Import methods

    // Used only in webapp
    configDataTransformerToAppStructure(configData) {
      this.setConfig({
        path: 'branding>color_palette>primary',
        value: configData.branding.colorPrimary
      })
      this.setConfig({
        path: 'branding>color_palette>secondary',
        value: configData.branding.colorSecondary
      })
      this.setConfig({
        path: 'branding>color_palette>accent',
        value: configData.branding.colorAccent
      })
      this.setConfig({
        path: 'branding>color_palette>success',
        value: configData.branding.colorSuccess
      })
      this.setConfig({
        path: 'branding>color_palette>error',
        value: configData.branding.colorError
      })
      this.setConfig({
        path: 'branding>color_palette>warning',
        value: configData.branding.colorWarning
      })
      this.setConfig({
        path: 'branding>color_palette>info',
        value: configData.branding.colorInfo
      })

      this.setConfig({
        path: 'branding>style>button',
        value: configData.branding.styleButton
      })
      this.setConfig({
        path: 'branding>style>form',
        value: configData.branding.styleForm
      })
      this.setConfig({
        path: 'branding>style>card',
        value: configData.branding.styleCard
      })
      this.setConfig({
        path: 'branding>style>dialog_card',
        value: configData.branding.styleDialogCard
      })

      return this.$store.state.global.config
    },
    // END Used only in webapp

    domainRowTransformerToAppStructure(domain, contentRow) {
      // Convert columns to fields
      let domains = [domain]
      if (domain === 'all') {
        domains = ['product', 'family', 'customer', 'ticket']
      }

      const rowContentTransformed = {}
      for (let i = 0; i < domains.length; i++) {
        let currentDomain = domains[i]

        if (domains[i] === 'product') {
          currentDomain = 'product.items'
        }
        if (domains[i] === 'family') {
          currentDomain = 'family[0].children'
        }
        if (domains[i] === 'customer') {
          currentDomain = 'customer'
        }
        if (domains[i] === 'ticket') {
          currentDomain = 'ticket'
        }
        if (
          domains[i] !== 'product' &&
          domains[i] !== 'family' &&
          domains[i] !== 'ticket' &&
          domains[i] !== 'customer'
        ) {
          continue // TO remove when domains be made
        }

        rowContentTransformed[domains[i]] = Object.byString(
          contentRow,
          currentDomain
        ).map((contentToTransform) => {
          const contentTransformed = {}

          // contentToTransform[z] is { column: 'example', content: 'example' } ====> column = Column/Field of type, csv by default
          // (_.invert(this.stored_config.import.domain[domain].fields_columns))[contentToTransform.column] ====> get key (domain field) from column content (domain column in type, csv by default) ====> gets domain field
          const domainFields = _.invert(
            this.stored_config.import.domain[domains[i]].fields_columns
          )
          if (domainFields === undefined) {
            // To columns not defined in global config
            contentTransformed.control = null
            return contentTransformed
          }
          Object.entries(domainFields).forEach((element) => {
            const externalField = element[0]
            const domainField = element[1]
            if (externalField === 'null') {
              contentTransformed[domainField] = null
              return
            }

            contentTransformed[domainField] = Object.byString(
              contentToTransform,
              externalField.replace('[id]', '.' + contentTransformed.id)
            )
          })

          return contentTransformed
        })
      }

      return rowContentTransformed
    },

    domainRowProductTransformerToAppStructure(contentPreTransformed) {
      const contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        if (contentPreTransformed[i].cost) {
          contentPreTransformed[i].cost = contentPreTransformed[i].cost / 100
        }
        if (contentPreTransformed[i].total) {
          contentPreTransformed[i].total = contentPreTransformed[i].total / 100
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowTicketTransformerToAppStructure(contentPreTransformed) {
      const contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        // State TODO

        // Dates transformer
        if (
          contentPreTransformed[i].create_date &&
          contentPreTransformed[i].create_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].create_date = new Date(
            contentPreTransformed[i].create_date
          )
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (
          contentPreTransformed[i].update_date &&
          contentPreTransformed[i].update_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].update_date = new Date(
            contentPreTransformed[i].update_date
          )
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowTicketLineTransformerToAppStructure(contentPreTransformed) {
      const contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        if (
          contentPreTransformed[i].quantity &&
          typeof contentPreTransformed[i].quantity === 'string'
        ) {
          contentPreTransformed[i].quantity = parseFloat(
            contentPreTransformed[i].quantity.replace(',', '.')
          )
        } else {
          contentPreTransformed[i].quantity = 0
        }
        if (
          contentPreTransformed[i].iva &&
          typeof contentPreTransformed[i].iva === 'string'
        ) {
          contentPreTransformed[i].iva = parseFloat(
            contentPreTransformed[i].iva.replace(',', '.')
          )
        } else {
          contentPreTransformed[i].iva = 0
        }
        // Dates transformer
        if (
          contentPreTransformed[i].create_date &&
          contentPreTransformed[i].create_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].create_date = new Date(
            contentPreTransformed[i].create_date
          )
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (
          contentPreTransformed[i].update_date &&
          contentPreTransformed[i].update_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].update_date = new Date(
            contentPreTransformed[i].update_date
          )
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowTicketComplementTransformerToAppStructure(contentPreTransformed) {
      const contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        // Dates transformer
        if (
          contentPreTransformed[i].create_date &&
          contentPreTransformed[i].create_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].create_date = new Date(
            contentPreTransformed[i].create_date
          )
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (
          contentPreTransformed[i].update_date &&
          contentPreTransformed[i].update_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].update_date = new Date(
            contentPreTransformed[i].update_date
          )
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowReceiptTransformerToAppStructure(contentPreTransformed) {
      const contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        // Dates transformer
        if (
          contentPreTransformed[i].paid_date &&
          contentPreTransformed[i].paid_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].paid_date = new Date(
            contentPreTransformed[i].paid_date
          )
        } else {
          contentPreTransformed[i].paid_date = null
        }
        if (
          contentPreTransformed[i].expiration_date &&
          contentPreTransformed[i].expiration_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].expiration_date = new Date(
            contentPreTransformed[i].expiration_date
          )
        } else {
          contentPreTransformed[i].expiration_date = null
        }
        if (
          contentPreTransformed[i].create_date &&
          contentPreTransformed[i].create_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].create_date = new Date(
            contentPreTransformed[i].create_date
          )
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (
          contentPreTransformed[i].update_date &&
          contentPreTransformed[i].update_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].update_date = new Date(
            contentPreTransformed[i].update_date
          )
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    domainRowCustomerTransformerToAppStructure(contentPreTransformed) {
      const contentTransformed = []

      for (let i = 0; i < contentPreTransformed.length; i++) {
        // Dates transformer
        if (
          contentPreTransformed[i].create_date &&
          contentPreTransformed[i].create_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].create_date = new Date(
            contentPreTransformed[i].create_date
          )
        } else {
          contentPreTransformed[i].create_date = new Date()
        }
        if (
          contentPreTransformed[i].birthday_date &&
          contentPreTransformed[i].birthday_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].birthday_date = new Date(
            contentPreTransformed[i].birthday_date
          )
        } else {
          contentPreTransformed[i].birthday_date = null
        }
        if (
          contentPreTransformed[i].drop_date &&
          contentPreTransformed[i].drop_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].drop_date = new Date(
            contentPreTransformed[i].drop_date
          )
        } else {
          contentPreTransformed[i].drop_date = null
        }
        if (
          contentPreTransformed[i].update_date &&
          contentPreTransformed[i].update_date !== '0000-00-00'
        ) {
          contentPreTransformed[i].update_date = new Date(
            contentPreTransformed[i].update_date
          )
        } else {
          contentPreTransformed[i].update_date = new Date()
        }

        contentTransformed.push(contentPreTransformed[i])
      }

      return contentTransformed
    },

    // END Import methods

    ...mapActions({
      setToken: 'user/setToken'
    }),

    ...mapActions({
      setConfig: 'global/setConfig',
      setConfigComplete: 'global/setConfigComplete',
      setTimeToSync: 'global/setTimeToSync'
    }),

    ...mapActions({
      setTickets: 'ticket/setTickets',
      setTicketsLines: 'ticket/setTicketsLines',
      setTicketsLinesComplements: 'ticket/setTicketsLinesComplements',
      setTicketsReceipts: 'ticket/setTicketsReceipts'
    }),

    ...mapActions({
      setCustomers: 'customer/setCustomers',
      setCustomersSearch: 'customer/setCustomers'
    }),

    ...mapActions({
      setProducts: 'product/setProducts'
    }),

    ...mapActions({
      setFamilies: 'family/setFamilies'
    }),

    ...mapMutations({
      removeUser: 'user/removeUser'
    })
  }
}
</script>
<style>
@media (min-width: 600px) {
  body,
  html {
    overflow: hidden;
  }
}
</style>
