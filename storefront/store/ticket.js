export const state = () => ({
  current_ticket: 0,

  // Contain all tickets
  // CSV sample: id,client,fecha,numero_document,irpf,forma_pagament,total,descompte_pp,descompte_client,estat,usuari,comensales,hora,id_terminal,id_turno
  tickets: [
    {
      id: null,
      id_customer: null,
      id_user: null,
      id_terminal: null,
      id_turn: null,

      // Payment parameters
      number: null,
      irpf: null,
      method_payment: null,
      discount_prompt_payment: null,
      discount_customer: null,
      total: null,

      // Number of customers related with ticket
      diners: null,

      // pending (0), paid_check(2), paid (1)
      state: null,

      // CSV sample: id_document,descripcio_article,grup,element,quantitat,numero_serie,lot,caducitat,preu,descompte,tipo_article,preu_fixe,referencia_article,referencia_client,formato,iva,ordre_entrada,recarrec,fecha,usuari,venedor,compta
      lines: [
        {
          id_ticket_line: null,
          id_attribute: null,
          id_user: null,

          // Used to determine with fields and how show
          type: null,

          description: null,
          quantity: null,
          serial_number: null, // Technological identifier
          lot: null, // Nutrition identifier
          expiration: null, // It's a informative date
          cost: null,
          price: null,
          iva: null,
          surcharge: null,
          discount: null,

          reference: null,
          reference_customer: null,

          // CSV Sample: id,id_linea (ordre_entrada de Tiquets2),quantitat,complemento,iva,import
          ticket_complements: [
            {
              id_ticket_line: null,

              id_complement: null,

              // Same structure as ticket_line
              description: null,
              quantity: null,
              serial_number: null, // Technological identifier
              lot: null, // Nutrition identifier
              expiration: null, // It's a informative date
              cost: null,
              price: null,
              iva: null,
              surcharge: null,
              discount: null,

              reference: null,
              reference_customer: null
            }
          ],

          create_date: new Date('now'),
          update_date: new Date('now')
        }
      ],

      // CSV Sample: codi,codi_factura,empresa,import,fecha,venciment,client,cobrat,fecha_cobro,codi_compte_ingres,modalitat_cobro,numero_efecte,usuari,tancat,caixa,id_torn
      receipt: [
        {
          id_ticket: null,

          id: null,
          id_invoice: null,
          id_user: null,
          id_income_account: null,

          number: null,
          collection_method: null, // cash, card, transfer, paypal, bizum, other
          paid: null, // Float/Boolean
          total: null,

          paid_date: new Date('now'),
          expiration_date: new Date('now'),
          create_date: new Date('now'),
          update_date: new Date('now')
        }
      ],

      create_date: new Date('now'),
      update_date: new Date('now')
    }
  ]
})

export const actions = {
  setTickets(state, payload) {
    state.commit('updateTickets', payload)
  },

  setTicket(state, payload) {
    state.commit('updateTicketValue', payload)
  },

  setCurrentTicket(state, payload) {
    state.commit('updateCurrentTicket', payload)
  },

  setCurrentTicketTotal(state, payload) {
    state.commit('updateCurrentTicketTotal', payload)
  },

  pushCurrentTicketLine(state, payload) {
    state.commit('pushCurrentTicketLine', payload)
  },

  pushCurrentTicketComplement(state, payload) {
    state.commit('pushCurrentTicketComplement', payload)
  },

  pushCurrentTicketReceipt(state, payload) {
    state.commit('pushCurrentTicketReceipt', payload)
  },

  addTicket(state, payload) {
    state.commit('addTicket', payload)
  },

  setTicketsLines(state, payload) {
    // Save ticket collection to assign
    const assignedTicketsWithLines = []

    if (!state.getters.tickets || !payload.length) {
      return
    }

    // Loop all tickets
    for (let i = 0; i < state.getters.tickets.length; i++) {
      // Save temporal ticket to modify
      const assignedTicketWithLines = state.getters.tickets[i]
      // Reset lines
      assignedTicketWithLines.lines = []

      // Loop all lines
      for (let z = 0; z < payload.length; z++) {
        if (assignedTicketWithLines.id === payload[z].id_ticket) {
          // Push line
          assignedTicketWithLines.lines.push(payload[z])
        }
      }

      // Reassign temporal ticket updated to tickets collection
      assignedTicketsWithLines.push(assignedTicketWithLines)
    }

    state.commit('updateTickets', assignedTicketsWithLines)
  },

  setTicketsLinesComplements(state, payload) {
    // Save ticket collection to assign
    const assignedTicketsWithLinesAndComplements = []

    if (!state.getters.tickets || !payload.length) {
      return
    }

    // Loop all tickets
    for (let i = 0; i < state.getters.tickets.length; i++) {
      // Save temporal ticket to modify
      const assignedTicketWithLinesAndComplements = state.getters.tickets[i]

      if (!assignedTicketWithLinesAndComplements.lines) {
        continue
      }

      // Loop all lines
      for (
        let y = 0;
        y < assignedTicketWithLinesAndComplements.lines.length;
        y++
      ) {
        // Save temporal ticket line to modify
        const assignedTicketLineWithComplements =
          assignedTicketWithLinesAndComplements.lines[y]
        // Reset complements
        assignedTicketLineWithComplements.complements = []

        // Loop all components
        for (let z = 0; z < payload.length; z++) {
          if (
            assignedTicketLineWithComplements.id_ticket_line ===
            payload[z].id_ticket_line
          ) {
            // Push complement
            assignedTicketLineWithComplements.complements.push(payload[z])
          }
        }

        // Reassign temporal ticket line updated to temporal ticket
        assignedTicketWithLinesAndComplements.lines[
          y
        ] = assignedTicketLineWithComplements
      }

      // Reassign temporal ticket to tickets collection
      assignedTicketsWithLinesAndComplements.push(
        assignedTicketWithLinesAndComplements
      )
    }

    state.commit('updateTickets', assignedTicketsWithLinesAndComplements)
  },

  setTicketsReceipts(state, payload) {
    // Save ticket collection to assign
    const assignedTicketsWithReceipt = []

    if (!state.getters.tickets || !payload.length) {
      return
    }

    // Loop all tickets
    for (let i = 0; i < state.getters.tickets.length; i++) {
      // Save temporal ticket to modify
      const assignedTicketWithReceipt = state.getters.tickets[i]
      assignedTicketWithReceipt.receipt = []

      // Loop all receipts
      for (let z = 0; z < payload.length; z++) {
        if (assignedTicketWithReceipt.id === payload[z].id_ticket) {
          // Reassign ticket receipt
          assignedTicketWithReceipt.receipt.push(payload[z])
        }
      }

      // Reassign temporal ticket updated to tickets collection
      assignedTicketsWithReceipt.push(assignedTicketWithReceipt)
    }

    state.commit('updateTickets', assignedTicketsWithReceipt)
  }
}

export const getters = {
  tickets: (state) => {
    return state.tickets
  }
}

export const mutations = {
  addTicket(state, ticket) {
    state.tickets.push(ticket)
  },

  updateTickets(state, tickets) {
    state.tickets = tickets
  },

  updateCurrentTicket(state, currentTicket) {
    state.current_ticket = currentTicket
  },

  updateCurrentTicketTotal(state, total) {
    if (state.current_ticket === 0) {
      return
    }

    state.tickets.filter(
      (ticket) => ticket.id === state.current_ticket
    )[0].total = total
  },

  pushCurrentTicketLine(state, line) {
    if (state.current_ticket === 0) {
      return
    }

    state.tickets
      .filter((ticket) => ticket.id === state.current_ticket)[0]
      .lines.push(line)
  },

  pushCurrentTicketComplement(state, complement) {
    if (state.current_ticket === 0) {
      return
    }

    const current_ticket = state.tickets.filter(
      (ticket) => ticket.id === state.current_ticket
    )[0]

    const current_ticket_line =
      current_ticket.lines[current_ticket.lines.length - 1]

    if (current_ticket_line === undefined) {
      return
    }

    current_ticket_line.ticket_complements.push(complement)
  },

  pushCurrentTicketReceipt(state, receipt) {
    if (state.current_ticket === 0) {
      return
    }

    state.tickets
      .filter((ticket) => ticket.id === state.current_ticket)[0]
      .receipt.push(receipt)
  },

  updateTicketValue(state, { path, value }) {
    const pathStack = path.split('>')
    let stateConfig = state.config

    while (pathStack.length > 1) {
      stateConfig = stateConfig[pathStack.shift()]
    }

    const elementToUpdate = pathStack.shift()
    stateConfig[elementToUpdate] = value
  }
}
