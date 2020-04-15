<template>
  <!-- LIST -->
  <CtCard :type="stored_config.branding.style.card" fluid title="Tíquets" dense>
    <template v-slot:rightTitleContent>
      <!-- SHOW SWITCH TO MOBILE -->
      <v-switch v-model="showListMobile" v-if="$vuetify.breakpoint.smAndDown" class="mt-5" color="secondary" />
    </template>

    <!-- LIST -->
    <v-card-text class="pr-0 pl-0">
      <v-row class="pt-0 pb-2">
        <!-- CUSTOMER TYPES TO INIT NEW TICKET -->
        <v-col
                v-for="customerType in customerTypes"
                :key="customerType.label"
                class="text-center pt-0 pb-0"
                @click="executeCustomerType(customerType.action)"
        >
          <CtBtn :type="stored_config.branding.style.button" block :color="stored_config.branding.color_palette.primary">
            {{ customerType.label }}
          </CtBtn>
        </v-col>
      </v-row>

      <v-divider />

      <div class="ct-card-content-ticket-list">
        <!-- TICKET LIST -->
        <v-data-table
                v-model="selectedTickets"
                :headers="headers"
                :sort-by="sortBy"
                :sort-desc="sortDesc"
                :items="tickets"
                :items-per-page.sync="ticketsPerPage"
                :page="page"
                :single-select="false"
                item-key="id"
                show-select
                hide-default-footer
                hide-default-header
                class="elevation-1">
          <template v-slot:header="{ props: { headers } }">
            <thead>
              <tr>
                <th v-for="header in headers" :key="'header-' + header.value" :class="header.class" :width="header.width">
                  <span v-html="header.text" v-if="header.text" />
                  <span v-else>
                    <CtBtn type="icon" :icon="['fas', 'paper-plane']" color="primary" v-if="header.value === 'id'" @click="sendCheckedTickets()" />
                    <v-checkbox v-model="allTicketsChecked" class="pa-0" height="0" v-else />
                  </span>
                </th>
              </tr>
            </thead>
          </template>
          <template v-slot:item="{ item }">
            <tr>
              <td>
                <v-checkbox v-model="ticketsChecked['ticket' + item.id]" class="pa-0" height="0" v-if="item.id" />
              </td>
              <td v-html="item.id_customer" class="pr-0 pl-0 text-center" />
              <td v-html="(item.receipt ? paid(item) : 0)" class="pr-0 pl-0 text-center" />
              <td
                v-html="item.receipt && pending(item) ? pending(item) : '-'"
                :class="{ 'warning--text': item.receipt && pending(item), 'pr-0': true, 'pl-0': true, 'text-center': true }" />
              <td v-html="item.total ? totalPriceTicketWithIva(item) : 0" class="pr-0 pl-0 text-center" />
              <td class="pl-0 pr-0 text-center">
                <CtBtn type="icon" :icon="['fas', 'edit']" color="primary" @click="$store.state.ticket.current_ticket = item.id" />
              </td>
            </tr>
          </template>
        </v-data-table>
      </div>
    </v-card-text>
    <template v-slot:actions>
      <v-divider v-if="$vuetify.breakpoint.mdAndUp || showListMobile" />
      <!-- PAGINATION -->
      <v-row dense class="body-2" v-if="$vuetify.breakpoint.mdAndUp || showListMobile">
        <v-spacer />
        <span class="ml-1 mr-4 mt-3 primary--text">
            Página {{ page }} de {{ numberOfPages }}
          </span>
        <v-btn
                fab
                small
                color="secondary"
                class="mr-1"
                @click="formerPage"
        >
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
        <v-btn
                fab
                small
                color="secondary"
                class="ml-1"
                @click="nextPage"
        >
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
        <v-spacer />
      </v-row>
    </template>

    <CtDialog v-model="customerToCreateTicket" maxWidth="500" :type="stored_config.branding.style.card" fluid :title="'Elegir cliente para crear un nuevo tíquet'" dense>
      <v-row dense>
        <v-spacer />
        <v-col cols="10">
          <CtSelect v-model="customerToCreateTicket" :items="$store.state.customer.customers_search" item-text="name" item-value="id_customer" class="ma-4" label="Cliente" />
        </v-col>
        <v-spacer />
      </v-row>
    </CtDialog>
  </CtCard>
</template>

<script type="application/javascript">
import price from '../../mixins/price'
import ticket from '../../mixins/ticket'
export default {
  name: "TicketList",

  mixins: [price, ticket],

  data: () => {
    return {
      customerTypes: [
        {
          label: 'Ventas contado',
          action: 'cashSales', // Method included in this component
        },
        {
          label: 'Clientes',
          action: 'customers', // Method included in this component
        },
      ],

      selectedTickets: [],
      headers: [
        { text: 'Cliente', align: 'start', class: 'pr-0 pl-0 text-center', sortable: false, value: 'id_customer', width: 'auto' },
        { text: 'Pago', class: 'pr-0 pl-0 text-center', sortable: false, value: 'receipt.paid', width: 'auto' },
        { text: 'Pend.', class: 'text--warning pr-0 pl-0 text-center', sortable: false, value: 'total-receipt.paid', width: 'auto' },
        { text: 'Total', class: 'pl-0 pr-0 text-center', sortable: false, value: 'total', width: 'auto' },
        { text: '', class: 'pr-0 pl-0 text-center', sortable: false, value: 'id', width: 1 },
      ],

      sortDesc: true,
      page: 1,
      sortBy: 'id',
      showListMobile: false,

      customerToCreateTicket: 0,

      allTicketsChecked: false,
      ticketsChecked: {},
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    },
    tickets () {
      return (this.$vuetify.breakpoint.mdAndUp || this.showListMobile) ? this.$store.state.ticket.tickets : this.lastTicket
    },

    numberOfPages () {
      return Math.ceil(this.tickets.length / this.ticketsPerPage)
    },

    ticketsAddedToResolution () {
      return window.innerHeight > 750 ? window.innerHeight > 1000 ? 5 : 2 : 0
    },
    ticketsPerPage: {
      get() {
        return (this.$vuetify.breakpoint.smAndDown ? 6 : this.$vuetify.breakpoint.lgAndUp ? 10 : 5) + this.ticketsAddedToResolution
      },
      set(newValue) {
        return newValue
      },
    },

    lastTicket () {
      let tickets = this.$store.state.ticket.tickets
      if (! tickets.length) {
        return null
      }

      return [tickets[tickets.length - 1]]
    }
  },

  watch: {
    allTicketsChecked(newValue) {
      if (! this.tickets) {
        return
      }

      let checkTo = false
      if (newValue) {
        checkTo = true
      }

      for(let i = 0; i < this.tickets.length; i++) {
        this.ticketsChecked['ticket' + this.tickets[i].id] = checkTo
      }
    },

    customerToCreateTicket(newValue, oldValue) {
      if (oldValue && typeof newValue !== 'boolean') {
        this.executeCustomerType('customer', newValue)
      }
    },

    '$store.state.ticket.current_ticket': {
      deep: true,
      handler(newValue, oldValue) {
        if(newValue && oldValue && newValue.total !== oldValue.total) {
          this.$forceUpdate()
        }
      }
    }
  },

  mounted() {
    // Set mobile and desktop heights
    let mobileContentTicketListElements = document.getElementsByClassName('ct-card-content-ticket-list')
    let mobileCardContentElements = document.getElementsByClassName('ct-card-content')
    if (this.$vuetify.breakpoint.smAndDown) {
      for (let i = 0; i < mobileContentTicketListElements.length; i++) {
        mobileContentTicketListElements[i].style.maxHeight = '52vh'
        mobileCardContentElements[i].style.maxHeight = '72vh'
      }
    } else {
      for (let i = 0; i < mobileContentTicketListElements.length; i++) {
        mobileContentTicketListElements[i].style.height = '74vh'
        mobileCardContentElements[i].style.maxHeight = '85vh'
      }
    }
  },

  methods: {
    // Add ticket actions
    executeCustomerType(action, parameter = null) {
      if (! parameter) {
        this[action]()
      } else {
        this[action](parameter)
      }
    },
    cashSales() {
      this.addProductToTicket()
    },
    customers() {
      this.customerToCreateTicket = 1
    },
    customer(customerId) {
      console.log(customerId)
      this.addProductToTicket(null, customerId)
    },

    // Ticket list
    paidWithoutFormatting(ticket) {
      let totalPaid = 0

      if (! ticket.receipt) {
        return totalPaid
      }

      for (let i = 0; i < ticket.receipt.length; i++) {
        if (ticket.receipt[i].total) {
          totalPaid += parseFloat(ticket.receipt[i].total.toString().replace(',', '.'))
        }
      }
      return totalPaid

    },

    paid(ticket) {
      return this.price(this.paidWithoutFormatting(ticket))
    },

    pending(ticket) {
      if (! ticket.total) {
        return 0
      }

      let totalPending = parseFloat(ticket.total.toString().replace(',', '.')) - this.paidWithoutFormatting(ticket)
      if (! totalPending) {
        return 0
      }

      return this.price(totalPending)
    },

    // Tickets header
    sendCheckedTickets() {
      console.log(this.ticketsChecked)
    },

    // Pagination
    nextPage () {
      if (this.page + 1 <= this.numberOfPages) this.page += 1
    },
    formerPage () {
      if (this.page - 1 >= 1) this.page -= 1
    },
  },
}
</script>
<style>
  .ct-card-content {
    overflow-x: hidden !important;
  }
  .ct-card-content-ticket-list {
    overflow-x: hidden;
  }
</style>
