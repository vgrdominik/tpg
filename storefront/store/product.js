export const state = () => ({
  units: 1,
  product_to_show: null,

  // Contain all products
  products: [
    {
      id: null,
      id_taxonomy: null,
      iva: null,
      ids_send_to: null,
      name: null,
      cost: null,
      base: null,
      total: null,
      reference: null,

      // Properties to determine product with complements
      complement_unique: null,
      complement_show: null,
      complement_ids_available: null,
      /*
      Next implementation to complement_ids_available (To accept quantity per product):
      [{
        quantity: null,
        id_product_associated: null,
      }],
      */

      // Properties to determine behavior as complement
      complement_price: null,
      /*
      Next implementation to complement_price (To accept price per product):
      [{
        total: null,
        id_product_associated: null,
      }],
      */
      complement_text_tpv: null,
      complement_taxonomy: null,
      complement_enabled: null,

      enabled: null,
      img: null,
      text_tpv: null,
    },
  ]
})

export const actions = {
  setProducts(state, payload) {
    state.commit('updateProducts', payload)
  },
  setProductToShow(state, payload) {
    state.commit('updateProductToShow', payload)
  },
  setUnits(state, payload) {
    state.commit('updateUnits', payload)
  },
}

export const mutations = {
  updateProducts (state, products) {
    state.products = products
  },
  updateProductToShow (state, productToShow) {
    state.product_to_show = productToShow
  },
  updateUnits (state, units) {
    state.units = units
  },
}
