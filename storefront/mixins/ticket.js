import {mapActions} from "vuex";

export default {
    data() {
        return {
            currentTicketLineToQuantityModify: 0,
            quantityModify: 0,
        }
    },

    computed: {
        current_product_to_show: {
            get() {
                if (this.$store.state.product.product_to_show === null) {
                    return null
                }

                return this.$store.state.product.product_to_show
            },
            set(newValue) {
                return newValue
            },
        },

        current_product_to_show_complements: {
            get() {
                if (this.current_product_to_show === null || ! this.current_product_to_show.complement_ids_available || this.current_product_to_show.complement_ids_available.length === 0) {
                    return null
                }

                return this.$store.state.product.products.filter(product => this.current_product_to_show.complement_ids_available.includes(product.id))
            },
            set(newValue) {
                return newValue
            },
        },

        current_product_to_show_complements_groups: {
            get() {
                if (! this.current_product_to_show_complements) {
                    return null
                }
                let current_product_to_show_complements_groups = []
                this.current_product_to_show_complements.forEach(product => (! current_product_to_show_complements_groups.includes(product.complement_taxonomy)) ? current_product_to_show_complements_groups.push(product.complement_taxonomy) : null)

                return current_product_to_show_complements_groups
            },
            set(newValue) {
                return newValue
            },
        },

        current_product_to_show_complements_by_group: {
            get() {
                if (! this.current_product_to_show_complements_groups) {
                    return
                }

                let productComplementsByGroup = {}
                this.current_product_to_show_complements_groups.forEach(group => {
                    productComplementsByGroup[group] = this.current_product_to_show_complements.filter(product => product.complement_taxonomy === group)
                })

                return productComplementsByGroup
            },
            set(newValue) {
                return newValue
            },
        },

        current_ticket () {
            if (this.$store.state.ticket.current_ticket === 0) {
                return null
            }

            return this.$store.state.ticket.tickets.filter(ticket => ticket.id === this.$store.state.ticket.current_ticket)[0]
        },

        current_ticket_line () {
            let ticketLineOrTicketLineComplement = this.currentTicketLineToQuantityModify.toString().split('-')

            if (ticketLineOrTicketLineComplement && ticketLineOrTicketLineComplement.length === 1) {
                // It's a product
                return this.current_ticket.lines.filter(ticketLine => ticketLine.id_ticket_line === this.currentTicketLineToQuantityModify)[0]
            } else {
                // It's a complement
                let current_ticket_line = this.current_ticket.lines.filter(ticketLine => parseInt(ticketLine.id_ticket_line) === parseInt(ticketLineOrTicketLineComplement[0]))[0]
                if (current_ticket_line) {
                    return current_ticket_line.ticket_complements.filter(ticketLineComplement => parseInt(ticketLineComplement.id_complement) === parseInt(ticketLineOrTicketLineComplement[1]))[0]
                }
            }

            return null
        },

        current_customer: {
            get() {
                if (! this.current_ticket) {
                    return null
                }
                let current_customer = this.$store.state.customer.customers.filter(customer => customer.id === this.current_ticket.id_customer)
                if (!current_customer || !current_customer.length) {
                    return null
                }

                return current_customer[0]
            },
            set(newValue) {
                return newValue
            },
        },
    },

    methods: {
        addOrShowProductToTicket(product = null, customerId = null) {
            if (product.complement_show && product.complement_show !== "0") {
                this.setProductToShow(product)
                return true
            }

            this.addProductToTicket(product, customerId)
        },

        addProductToTicket(product = null, customerId = null, complementsSelection = null) {
            // Define current customer
            let current_customer = this.current_customer

            if (! current_customer && ! customerId) {
                current_customer = this.$store.state.customer.customers.filter(customer => customer.name.toLowerCase() === 'ventas contado' || customer.name.toLowerCase() === 'vendes comptat')[0]
            }
            if (! current_customer) {
                current_customer = this.$store.state.customer.customers.filter(customer => customer.id === customerId || (! customerId && (customer.id === 1 || customer.id === '1')))[0]
            }
            if (! current_customer) {
                return false
            }

            // Set new ticket if have not current selected
            let currentTicketId = 0
            if (! this.current_ticket && this.$store.state.ticket.tickets) {
                let lastTicket = this.$store.state.ticket.tickets[this.$store.state.ticket.tickets.length - 1]
                currentTicketId = parseInt(lastTicket.id) + 1
                this.$store.state.ticket.current_ticket = currentTicketId
                this.addTicket({
                    id: currentTicketId,
                    id_customer: current_customer.id,
                    id_user: null,
                    id_terminal: null,
                    id_turn: null,

                    // Payment parameters
                    number: currentTicketId, // TODO
                    irpf: current_customer.irpf,
                    method_payment: current_customer.payment_method,
                    discount_prompt_payment: current_customer.discount_prompt_payment,
                    discount_customer: current_customer.discount_document,
                    total: 0,

                    // Number of customers related with ticket
                    diners: current_customer.diners,

                    // pending (0), paid_check (2), paid (1)
                    state: 0,

                    // CSV sample: id_document,descripcio_article,grup,element,quantitat,numero_serie,lot,caducitat,preu,descompte,tipo_article,preu_fixe,referencia_article,referencia_client,formato,iva,ordre_entrada,recarrec,fecha,usuari,venedor,compta
                    lines: [],

                    // CSV Sample: codi,codi_factura,empresa,import,fecha,venciment,client,cobrat,fecha_cobro,codi_compte_ingres,modalitat_cobro,numero_efecte,usuari,tancat,caixa,id_torn
                    receipt: [],

                    create_date: new Date('now'),
                    update_date: new Date('now'),
                })
            } else {
                // Reset pipe to others components when current ticket it's set
                currentTicketId = this.current_ticket.id
                this.$store.state.ticket.current_ticket = 0
            }

            this.$nextTick(() => {
                // It's reset pipe to update all components with current ticket dependency
                this.$store.state.ticket.current_ticket = currentTicketId
                if (! this.current_ticket || this.current_ticket.state || ! product || ! this.current_ticket.lines) {
                    return false
                }

                let currentTicketLineId = 1
                if (this.current_ticket.lines[this.current_ticket.lines.length - 1]) {
                    currentTicketLineId = parseInt(this.current_ticket.lines[this.current_ticket.lines.length - 1].id_ticket_line) + 1
                }

                // Set new current ticket line
                this.current_ticket.lines.push({
                    id_ticket_line: currentTicketLineId,
                    id_attribute: null,
                    id_user: null,

                    // Used to determine with fields and how show
                    type: null,

                    description: product.text_tpv,
                    quantity: this.$store.state.product.units,
                    serial_number: null, // Technological identifier
                    lot: null, // Nutrition identifier
                    expiration: null, // It's a informative date
                    cost: product.cost,
                    price: product.total,
                    iva: product.iva,
                    surcharge: null,
                    discount: current_customer.discount_product,

                    reference: product.reference,
                    reference_customer: null,

                    ticket_complements: [], // TODO

                    create_date: new Date('now'),
                    update_date: new Date('now'),
                })
                // Add complements selected
                if (complementsSelection) {
                    Object.entries(complementsSelection).forEach(complementSelection => {
                        // complementSelection[0] -> Complement group
                        // complementSelection[1] -> Complement selection index
                        if (complementSelection[1] === null || ! this.current_ticket || ! this.current_ticket.lines) {
                            return
                        }
                        let productComplement = this.current_product_to_show_complements_by_group[complementSelection[0]][complementSelection[1]]
                        let currentTicketLine = this.current_ticket.lines[this.current_ticket.lines.length - 1]

                        if (! currentTicketLine.ticket_complements) {
                            return
                        }

                        let currentTicketLineComplementId = 1
                        if (currentTicketLine.ticket_complements[currentTicketLine.ticket_complements.length - 1]) {
                            currentTicketLineComplementId = parseInt(currentTicketLine.id_complement) + 1
                        }
                        // Set new current ticket line with complement
                        currentTicketLine.ticket_complements.push({
                            id_ticket_line: currentTicketLine.id_ticket_line,

                            id_complement: currentTicketLineComplementId,

                            // Used to determine with fields and how show
                            type: null,

                            description: complementSelection[0] + ': ' + productComplement.complement_text_tpv,
                            quantity: 1,
                            serial_number: null, // Technological identifier
                            lot: null, // Nutrition identifier
                            expiration: null, // It's a informative date
                            cost: productComplement.cost,
                            price: (productComplement.complement_price) ? productComplement.complement_price : productComplement.total,
                            iva: productComplement.iva,
                            surcharge: null,
                            discount: current_customer.discount_product,

                            reference: productComplement.reference,
                            reference_customer: null,
                        })
                    })
                }

                // Set current ticket total
                this.current_ticket.total = this.totalTicketWithIva(this.current_ticket)

                // Set current units to one
                this.setUnits(1)
                this.setProductToShow(null)
            })
        },

        payDirectTicket() {
            if (this.current_ticket.state || ! this.current_ticket.receipt) {
                return false
            }
            let currentTicketReceiptId = 1
            if (this.current_ticket.receipt[this.current_ticket.receipt.length - 1]) {
                currentTicketReceiptId = parseInt(this.current_ticket.receipt[this.current_ticket.receipt.length - 1].id) + 1
            }

            this.current_ticket.receipt.push({
                id_ticket: this.current_ticket.id,

                id: currentTicketReceiptId,
                id_invoice: null,
                id_user: this.current_customer.seller_user_id,
                id_income_account: this.current_customer.account_charge,

                number: null, // TODO
                collection_method: this.current_customer.payment_method, // cash, card, transfer, paypal, bizum, other
                paid: 1, // Float/Boolean
                total: this.current_ticket.total,

                paid_date: new Date('now'),
                expiration_date: new Date('now'),
                create_date: new Date('now'),
                update_date: new Date('now'),
            })

            this.current_ticket.state = 1
            this.$store.state.ticket.current_ticket = 0
        },

        ...mapActions('ticket', [
            'addTicket',
            'setTickets',
        ]),

        ...mapActions('product', [
            'setUnits',
            'setProductToShow',
        ]),
    }
}
