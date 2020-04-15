export const state = () => ({
  // Contain all customers related with tickets
  customers: [
    {
      id: null,

      // Tax information
      iva: null,
      irpf: null,

      // Basic data
      corporation_name: null,
      name: null,
      taxonomy_name: null,
      taxonomy_identification: null,
      observations: null,

      // Location data - CAUTION lvl 3
      address: null,
      postal_code: null,
      town: null,
      state: null,

      // Contact data - CAUTION lvl 1
      contact_name: null,
      phone: null,
      phone2: null,
      fax: null,
      mobile: null,
      email: null,
      notifications_enabled: null,
      notifications_basic_enabled: null,
      notifications_publicity_enabled: null,
      notifications_others_enabled: null,

      // Categorization communications
      taxonomy_sms: null,
      taxonomy_email: null,

      // Discount data
      discount_prompt_payment: null,
      discount_product: null,
      discount_document: null,

      // Payment Data - CAUTION lvl 2
      payment_method: null,
      payment_account: null,
      payment_bank: null,
      payment_entity: null,
      payment_agency: null,
      payment_control_digit: null,
      payment_day: null,
      payment_day2: null,
      countable_code: null,
      surcharge: null,
      rate: null,
      account_charge: null,
      periodicity: null,

      // Hospitality industry
      diners: null,
      table_id: null,
      dinning_room_id: null,
      table_in_use: null,
      origin: null,

      // Sensible data - CAUTION lvl 4
      gender: null,
      social_security_card: null,
      pension_amount: null,
      birthday_date: null,

      // Internal data - CAUTION lvl 1
      reference: null,
      creator_user_id: null,
      update_user_id: null,
      seller_user_id: null,

      img: null,
      img_secondary: null,
      text_tpv: null,

      // Internal data - CAUTION lvl 1
      points: null,
      level: null,

      enabled: null,

      create_date: new Date('now'),
      drop_date: new Date('now'),
      update_date: new Date('now'),
    },
  ],

  // Contain all customers
  customers_search: [
    {
      id_customer: null,
      corporation_name: null,
      name: null,
      taxonomy_name: null,
      taxonomy_identification: null,
      reference: null,
    }
  ]
})

export const actions = {
  setCustomers(state, payload) {
    state.commit('updateCustomers', payload)
  },
  setCustomersSearch(state, payload) {
    state.commit('updateCustomersSearch', payload)
  },
}

export const getters = {
  customers: state => {
    return state.customers
  }
}

export const mutations = {
  updateCustomers (state, customers) {
    state.customers = customers
  },
  updateCustomersSearch (state, customers_search) {
    state.customers_search = customers_search
  },
}
