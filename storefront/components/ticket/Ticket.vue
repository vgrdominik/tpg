<template>
  <div v-if="$store.state.ticket.current_ticket">
    <!-- LIST -->
    <CtCard
      :type="stored_config.branding.style.card"
      fluid
      :title="'Tíquet ' + $store.state.ticket.current_ticket"
      dense
    >
      <template v-slot:leftTitleContent>
        <!-- BACK TO LIST -->
        <CtBtn
          type="icon"
          :icon="['fas', 'chevron-left']"
          small
          class="ml-3"
          color="white"
          @click="$store.state.ticket.current_ticket = 0"
        />
      </template>
      <template v-slot:rightTitleContent>
        <!-- SHOW SWITCH TO MOBILE -->
        <v-switch
          v-if="$vuetify.breakpoint.smAndDown"
          v-model="showListMobile"
          class="mt-5"
          color="secondary"
        />
      </template>

      <!-- LIST -->
      <v-card-text class="pr-0 pl-0">
        <v-row class="pt-0 pb-2">
          <!-- TICKET ACTIONS -->
          <v-col
            v-for="action in actions"
            :key="action.label"
            class="text-center pt-0 pb-0"
            @click="executeTicketAction(action.action)"
          >
            <CtBtn
              :type="stored_config.branding.style.button"
              block
              :color="stored_config.branding.color_palette.primary"
            >
              {{ action.label }}
            </CtBtn>
          </v-col>
        </v-row>

        <v-divider />

        <!-- TOTAL LINE -->
        <v-row class="pt-0 pb-2 primary">
          <v-col
            cols="5"
            class="text-center pt-0 pb-0 mt-4 body-4 white--text text-uppercase"
          >
            TOTAL:
          </v-col>
          <v-col
            cols="5"
            class="text-center pt-0 pb-0 mt-4 body-4 white--text text-uppercase"
            @click="updateCustomer()"
          >
            <span v-html="totalPriceTicketWithIva(current_ticket)" />
          </v-col>
          <v-col
            cols="2"
            class="text-center pt-0 pb-0 mt-2 body-4 white--text text-uppercase"
            @click="updateCustomer()"
          >
            <CtBtn
              type="icon"
              :icon="['fas', 'paper-plane']"
              color="white"
              @click="sendAllTicketLines()"
            />
          </v-col>
        </v-row>

        <v-divider />

        <div class="ct-card-content-ticket-list">
          <!-- TICKET LIST -->
          <v-data-table
            v-model="selectedTicketLines"
            :headers="headers"
            :sort-by="sortBy"
            :sort-desc="sortDesc"
            :items="current_ticket.lines"
            :items-per-page.sync="ticketLinesPerPage"
            :page="page"
            :single-select="false"
            item-key="id"
            show-select
            hide-default-footer
            hide-default-header
            class="elevation-1"
          >
            <template v-slot:header="{ props: { headers } }">
              <thead>
                <tr>
                  <th
                    v-for="header in headers"
                    :key="'header-' + header.value"
                    :class="header.class"
                    :width="header.width"
                  >
                    <span v-if="header.text" v-html="header.text" />
                    <span v-else>
                      <CtBtn
                        v-if="header.value === 'id_ticket_line'"
                        type="icon"
                        :icon="['fas', 'paper-plane']"
                        color="primary"
                        @click="sendCheckedTicketLines()"
                      />
                      <v-checkbox
                        v-else
                        v-model="allTicketLinesChecked"
                        class="pa-0"
                        height="0"
                      />
                    </span>
                  </th>
                </tr>
              </thead>
            </template>
            <template v-slot:item="{ item }">
              <tr>
                <td>
                  <v-checkbox
                    v-if="item.id_ticket_line"
                    v-model="
                      ticketLinesChecked['ticketLine' + item.id_ticket_line]
                    "
                    class="pa-0"
                    height="0"
                  />
                </td>
                <td class="pr-0 pl-0 text-center">
                  <v-btn
                    v-if="!current_ticket.state"
                    icon
                    color="primary"
                    @click="
                      currentTicketLineToQuantityModify = item.id_ticket_line
                    "
                  >
                    <span v-html="item.quantity.toString()" />
                  </v-btn>
                  <span v-else v-html="item.quantity.toString()" />
                </td>
                <td class="pr-0 pl-0 text-center" v-html="item.description" />
                <td
                  class="pr-0 pl-0 text-center"
                  v-html="item.price ? linePrice(item) : '-'"
                />
                <td
                  class="pr-0 pl-0 text-center"
                  v-html="item.price && item.quantity ? lineTotal(item) : '-'"
                />
                <td v-if="!current_ticket.state" class="pl-0 pr-0 text-center">
                  <CtBtn
                    type="icon"
                    :icon="['fas', 'times']"
                    color="error"
                    @click="lineRemove(item)"
                  />
                </td>
              </tr>
              <template v-if="item.ticket_complements">
                <tr
                  v-for="ticketComplement in item.ticket_complements"
                  :key="'ticketComplement' + ticketComplement.id_complement"
                >
                  <td>
                    <v-checkbox
                      v-if="
                        item.id_ticket_line && ticketComplement.id_complement
                      "
                      v-model="
                        ticketLinesChecked[
                          'ticketLine' +
                            ticketComplement.id_ticket_line +
                            '-' +
                            ticketComplement.id_complement
                        ]
                      "
                      class="pa-0"
                      height="0"
                    />
                  </td>
                  <td class="pr-0 pl-0 text-center">
                    <v-btn
                      v-if="!current_ticket.state"
                      icon
                      color="primary"
                      @click="
                        currentTicketLineToQuantityModify =
                          item.id_ticket_line +
                          '-' +
                          ticketComplement.id_complement
                      "
                    >
                      <span v-html="ticketComplement.quantity.toString()" />
                    </v-btn>
                    <span
                      v-else
                      v-html="ticketComplement.quantity.toString()"
                    />
                  </td>
                  <td
                    class="pr-0 pl-0 text-center"
                    v-html="'- ' + ticketComplement.description"
                  />
                  <td
                    class="pr-0 pl-0 text-center"
                    v-html="
                      ticketComplement.price ? linePrice(ticketComplement) : '-'
                    "
                  />
                  <td
                    class="pr-0 pl-0 text-center"
                    v-html="
                      ticketComplement.price && ticketComplement.quantity
                        ? lineTotal(ticketComplement)
                        : '-'
                    "
                  />
                  <td
                    v-if="!current_ticket.state"
                    class="pl-0 pr-0 text-center"
                  >
                    <CtBtn
                      type="icon"
                      :icon="['fas', 'times']"
                      color="error"
                      @click="lineRemove(ticketComplement)"
                    />
                  </td>
                </tr>
              </template>
            </template>
          </v-data-table>
          <CtDialog
            v-if="currentTicketLineToQuantityModify"
            v-model="currentTicketLineToQuantityModify"
            max-width="500"
            :type="stored_config.branding.style.card"
            fluid
            :title="'Modificar cantidad de ' + current_ticket_line.description"
            dense
          >
            <v-row dense>
              <v-col cols="4" class="mt-4 text-center">
                <CtBtn
                  type="icon"
                  :icon="['fas', 'minus']"
                  color="primary"
                  @click="lineQuantitySubtract(current_ticket_line)"
                />
              </v-col>
              <v-col cols="4">
                <CtTextField
                  v-model="quantityModify"
                  :ct-type="stored_config.branding.style.form"
                  class="ma-4"
                  label="Cantidad"
                />
              </v-col>
              <v-col cols="4" class="mt-4 text-center">
                <CtBtn
                  type="icon"
                  :icon="['fas', 'plus']"
                  color="primary"
                  @click="lineQuantityAdd(current_ticket_line)"
                />
              </v-col>
            </v-row>
          </CtDialog>
        </div>
      </v-card-text>
      <template v-slot:actions>
        <v-divider v-if="$vuetify.breakpoint.mdAndUp || showListMobile" />
        <!-- PAGINATION -->
        <v-row
          v-if="$vuetify.breakpoint.mdAndUp || showListMobile"
          dense
          class="body-2"
        >
          <v-spacer />
          <span class="ml-1 mr-4 mt-3 primary--text">
            Página {{ page }} de {{ numberOfPages }}
          </span>
          <v-btn fab small color="secondary" class="mr-1" @click="formerPage">
            <v-icon>mdi-chevron-left</v-icon>
          </v-btn>
          <v-btn fab small color="secondary" class="ml-1" @click="nextPage">
            <v-icon>mdi-chevron-right</v-icon>
          </v-btn>
          <v-spacer />
        </v-row>
      </template>
    </CtCard>
  </div>
</template>

<script type="application/javascript">
import price from '../../mixins/price'
import ticket from '../../mixins/ticket'
// import Customer from '../customer/Customer'

export default {
  name: 'Ticket',
  // components: { Customer },
  mixins: [price, ticket],

  data: () => {
    return {
      actions: [
        {
          label: 'Pagar',
          action: 'pay' // Method included in this component
        },
        {
          label: 'Pagar directo',
          action: 'payDirect' // Method included in this component
        }
      ],

      selectedTicketLines: [],
      headers: [
        {
          text: 'Qty.',
          align: 'start',
          class: 'pr-0 pl-0 text-center',
          sortable: false,
          value: 'quantity',
          width: 'auto'
        },
        {
          text: 'Descr.',
          class: 'pr-0 pl-0 text-center',
          sortable: false,
          value: 'description',
          width: 'auto'
        },
        {
          text: 'Precio',
          class: 'text--warning pr-0 pl-0 text-center',
          sortable: false,
          value: 'price',
          width: 'auto'
        },
        {
          text: 'Total',
          class: 'pl-0 pr-0 text-center',
          sortable: false,
          value: 'price*quantity',
          width: 'auto'
        },
        {
          text: '',
          class: 'pr-0 pl-0 text-center',
          sortable: false,
          value: 'id_ticket_line',
          width: 1
        }
      ],

      sortDesc: true,
      page: 1,
      sortBy: 'id',
      showListMobile: false,

      allTicketLinesChecked: false,
      ticketLinesChecked: {},

      currentCustomerToTemporaryModify: 0
    }
  },

  computed: {
    stored_config() {
      return this.$store.state.global.config
    },

    numberOfPages() {
      return Math.ceil(
        this.current_ticket.lines.length / this.ticketLinesPerPage
      )
    },

    ticketLinesAddedToResolution() {
      return window.innerHeight > 750 ? (window.innerHeight > 1000 ? 5 : 2) : 0
    },
    ticketLinesPerPage: {
      get() {
        return (
          (this.$vuetify.breakpoint.smAndDown
            ? 5
            : this.$vuetify.breakpoint.lgAndUp
            ? 7
            : 4) + this.ticketLinesAddedToResolution
        )
      },
      set(newValue) {
        return newValue
      }
    },

    lastTicketLine() {
      const ticket_lines = this.current_ticket.lines
      if (!ticket_lines.length) {
        return null
      }

      return [ticket_lines[ticket_lines.length - 1]]
    }
  },

  watch: {
    allTicketLinesChecked(newValue) {
      if (!this.current_ticket.lines) {
        return
      }

      let checkTo = false
      if (newValue) {
        checkTo = true
      }

      for (let i = 0; i < this.current_ticket.lines.length; i++) {
        this.ticketLinesChecked[
          'ticketLine' + this.current_ticket.lines[i].id_ticket_line
        ] = checkTo
        if (this.current_ticket.lines[i].ticket_complements) {
          this.current_ticket.lines[i].ticket_complements.forEach(
            (ticketComplement) => {
              this.ticketLinesChecked[
                'ticketLine' +
                  this.current_ticket.lines[i].id_ticket_line +
                  '-' +
                  ticketComplement.id_complement
              ] = checkTo
            }
          )
        }
      }
    },

    currentTicketLineToQuantityModify(newValue) {
      const ticketLineOrTicketLineComplement = newValue.toString().split('-')
      if (ticketLineOrTicketLineComplement.length === 1) {
        // It's a product
        const current_ticket_line = this.current_ticket.lines.filter(
          (ticketLine) => ticketLine.id_ticket_line === newValue
        )[0]
        if (current_ticket_line) {
          this.quantityModify = current_ticket_line.quantity
        }
      } else {
        // It's a complement
        const current_ticket_line = this.current_ticket.lines.filter(
          (ticketLine) =>
            parseInt(ticketLine.id_ticket_line) ===
            parseInt(ticketLineOrTicketLineComplement[0])
        )[0]
        if (current_ticket_line) {
          const current_ticket_line_complement = current_ticket_line.ticket_complements.filter(
            (ticketLineComplement) =>
              parseInt(ticketLineComplement.id_complement) ===
              parseInt(ticketLineOrTicketLineComplement[1])
          )[0]
          if (current_ticket_line_complement) {
            this.quantityModify = current_ticket_line_complement.quantity
          }
        }
      }
    },

    quantityModify(newValue, oldValue) {
      if (newValue !== oldValue) {
        this.quantityModify = parseFloat(this.quantityModify)
      }
      if (newValue !== oldValue && oldValue) {
        const ticketLineOrTicketLineComplement = this.currentTicketLineToQuantityModify
          .toString()
          .split('-')
        if (ticketLineOrTicketLineComplement.length === 1) {
          // It's a product
          const current_ticket_line = this.current_ticket.lines.filter(
            (ticketLine) =>
              ticketLine.id_ticket_line ===
              this.currentTicketLineToQuantityModify
          )[0]
          if (current_ticket_line) {
            current_ticket_line.quantity = this.quantityModify
            this.$forceUpdate()
          }
        } else {
          // It's a complement
          const current_ticket_line = this.current_ticket.lines.filter(
            (ticketLine) =>
              parseInt(ticketLine.id_ticket_line) ===
              parseInt(ticketLineOrTicketLineComplement[0])
          )[0]
          if (current_ticket_line) {
            const current_ticket_line_complement = current_ticket_line.ticket_complements.filter(
              (ticketLineComplement) =>
                parseInt(ticketLineComplement.id_complement) ===
                parseInt(ticketLineOrTicketLineComplement[1])
            )[0]
            if (current_ticket_line_complement) {
              current_ticket_line_complement.quantity = this.quantityModify
              this.$forceUpdate()
            }
          }
        }
      }
    },

    '$store.state.ticket.current_ticket': {
      deep: true,
      handler(newValue, oldValue) {
        if (newValue && oldValue && newValue.total !== oldValue.total) {
          this.$forceUpdate()
        }
      }
    }
  },

  mounted() {
    // Set mobile and desktop heights
    const mobileContentTicketListElements = document.getElementsByClassName(
      'ct-card-content-ticket-list'
    )
    const mobileCardContentElements = document.getElementsByClassName(
      'ct-card-content'
    )
    if (this.$vuetify.breakpoint.smAndDown) {
      for (let i = 0; i < mobileContentTicketListElements.length; i++) {
        mobileContentTicketListElements[i].style.maxHeight = '44vh'
        mobileCardContentElements[i].style.maxHeight = '72vh'
      }
    } else {
      for (let i = 0; i < mobileContentTicketListElements.length; i++) {
        mobileContentTicketListElements[i].style.height = '64vh'
        mobileCardContentElements[i].style.maxHeight = '85vh'
      }
    }
  },

  methods: {
    // Add ticket actions
    executeTicketAction(action) {
      this[action]()
    },
    pay() {
      console.log('pay: test')
    },
    payDirect() {
      this.payDirectTicket()
    },

    // Update customer action
    updateCustomer() {
      // console.log(this.stored_config.import.domain.customer.fields)
      this.currentCustomerToTemporaryModify = this.current_customer.id
    },

    // Tickets header
    sendCheckedTicketLines() {
      console.log(this.ticketLinesChecked)
    },
    sendAllTicketLines() {
      console.log('send all')
      console.log(this.ticketLinesChecked)
    },

    // Ticket
    linePrice(ticketLine) {
      return this.totalPriceWithIva(ticketLine.price, ticketLine.iva)
    },
    lineTotal(ticketLine) {
      return this.price(
        this.totalWithIva(ticketLine.price, ticketLine.iva) *
          ticketLine.quantity
      )
    },
    lineRemove(ticketLineOrComplementToRemove) {
      if (ticketLineOrComplementToRemove.id_complement === undefined) {
        // It's a product
        this.current_ticket.lines = this.current_ticket.lines.filter(
          (ticketLine) =>
            ticketLine.id_ticket_line !==
            ticketLineOrComplementToRemove.id_ticket_line
        )
      } else {
        // It's a complement
        this.current_ticket.lines.filter(
          (ticket_line) =>
            ticket_line.id_ticket_line ===
            ticketLineOrComplementToRemove.id_ticket_line
        )[0].ticket_complements = this.current_ticket.lines
          .filter(
            (ticket_line) =>
              ticket_line.id_ticket_line ===
              ticketLineOrComplementToRemove.id_ticket_line
          )[0]
          .ticket_complements.filter(
            (ticket_complement) =>
              ticket_complement.id_complement !==
              ticketLineOrComplementToRemove.id_complement
          )
      }

      this.current_ticket.total = this.totalTicketWithIva(this.current_ticket)

      const currentTicketTotal = this.current_ticket.total
      const currentTicketId = this.$store.state.ticket.current_ticket
      this.$store.state.ticket.current_ticket = 0

      // Set current ticket total
      this.$nextTick(() => {
        if (currentTicketTotal <= 0) {
          this.setTickets(
            this.$store.state.ticket.tickets.filter(
              (ticket) => ticket.id !== currentTicketId
            )
          )
        } else {
          this.$store.state.ticket.current_ticket = currentTicketId
        }
      })
    },
    lineQuantitySubtract() {
      this.quantityModify = this.quantityModify - 1.0
    },
    lineQuantityAdd() {
      this.quantityModify = this.quantityModify + 1.0
    },

    // Pagination
    nextPage() {
      if (this.page + 1 <= this.numberOfPages) this.page += 1
    },
    formerPage() {
      if (this.page - 1 >= 1) this.page -= 1
    }
  }
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
