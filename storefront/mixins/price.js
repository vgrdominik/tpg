export default {
    methods: {
        totalTicketWithIva(ticket) {
            if (! ticket.lines) {
                return 0
            }

            let total = 0
            for (let i = 0; i < ticket.lines.length; i++) {
                if (ticket.lines[i].price) {
                    total += this.totalWithIva(ticket.lines[i].price, ticket.lines[i].iva) * ticket.lines[i].quantity
                }
                if (ticket.lines[i].ticket_complements && ticket.lines[i].ticket_complements.length > 0) {
                    ticket.lines[i].ticket_complements.forEach(ticketComplement => total += this.totalWithIva(ticketComplement.price, ticket.lines[i].iva) * ticketComplement.quantity)
                }
            }
            return total
        },
        totalPriceTicketWithIva(ticket) {
            return this.price(this.totalTicketWithIva(ticket))
        },
        totalWithIva(price, iva) {
            return parseFloat(price.toString().replace(',', '.')) + parseFloat(price.toString().replace(',', '.')) * (iva / 100)
        },
        totalPriceWithIva(price, iva) {
            return this.price(this.totalWithIva(price, iva))
        },
        price(price) {
            return new Intl.NumberFormat('es-ES', { style: 'currency', currency: 'EUR' }).format(price)
        }
    }
}
