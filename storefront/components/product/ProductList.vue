<template>
  <v-content class="pa-0">
    <v-row class="ml-2 mr-2" align="center" justify="center">
      <v-col dense class="body-1 text-uppercase pb-0 pt-2" v-if="$vuetify.breakpoint.smAndUp">
        <UnitList />
      </v-col>
    </v-row>
    <CtCard
            :type="stored_config.branding.style.card"
            fluid
            :title="currentFamily ? $store.state.family.families.filter((family) => family.id === currentFamily)[0].text_tpv : 'Todos'"
            dense
            class="mt-2">
      <!-- HEADER -->
      <template v-slot:leftTitleContent>
        <CtTextField
                v-model="search"
                :ctType="stored_config.branding.style.form"
                clearable
                dark
                flat
                solo-inverted
                hide-details
                class="ml-3"
                label="Buscador" />
        <v-spacer />
      </template>
      <template v-slot:rightTitleContent>
        <CtTooltip left btn btn-type="icon" btn-color="white" :btn-icon="['fas', 'times']" @click="$store.state.family.current_family = 0" v-if="currentFamily !== 0">
          Eliminar filtro de familia
        </CtTooltip>
        <v-spacer />

        <span class="mr-4 white--text" v-if="$vuetify.breakpoint.mdAndUp">
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
      </template>

      <!-- LIST -->
      <v-card-text class="ct-card-content-product-list pt-0 pb-3">
        <v-data-iterator
                :items="products"
                :items-per-page.sync="productsPerPage"
                :page="page"
                :search="search"
                :sort-by="sortBy"
                :sort-desc="sortDesc"
                hide-default-footer
        >
          <template v-slot:no-data>
            <v-col cols="12" class="text-center">
              <span class="primary--text body-2">No hay productos</span>
            </v-col>
          </template>
          <template v-slot:default="props">
            <v-row>
              <v-col
                      v-for="item in props.items"
                      :key="item.name"
                      cols="4"
                      sm="4"
                      md="3"
                      lg="2"
                      class="pt-3 pb-0"
              >
                <v-card @click="addOrShowProductToTicket(item)" style="cursor: pointer">
                  <v-row dense class="pt-4">
                    <v-spacer />
                    <v-avatar v-if="item.img" :width="$vuetify.breakpoint.smAndDown? 50 : '7vh'" :height="$vuetify.breakpoint.smAndDown? 50 : '7vh'">
                      <v-img
                              :src="productImg['product' + item.id]"
                              v-on:error="productImg['product' + item.id] = $global_utilities.default_img()"
                              class="my-3"
                      />
                    </v-avatar>
                    <v-avatar v-else color="secondary" :width="$vuetify.breakpoint.smAndDown? 50 : '7vh'" :height="$vuetify.breakpoint.smAndDown? 50 : '7vh'">
                      <span class="white--text headline" v-html="item.text_tpv ? item.text_tpv.charAt(0).toUpperCase() + item.text_tpv.charAt(1) : 'Ar'" />
                    </v-avatar>
                    <v-spacer />
                  </v-row>
                  <v-row dense class="pb-4">
                    <v-spacer />
                    <span class="body-2 text-uppercase product-text-tpv pb-4 primary--text" v-html="item.text_tpv" />
                    <v-spacer />
                  </v-row>
                </v-card>
              </v-col>
            </v-row>
          </template>
        </v-data-iterator>
      </v-card-text>
    </CtCard>
    <CtDialog v-model="current_product_to_show" maxWidth="374" :type="stored_config.branding.style.card" :title="current_product_to_show.text_tpv" fluid dense v-if="current_product_to_show" @click:outside="$store.state.product.product_to_show = null">
      <Product :product="current_product_to_show" />
    </CtDialog>
  </v-content>
</template>

<script type="application/javascript">
import UnitList from "./UnitList"
import price from '../../mixins/price'
import ticket from '../../mixins/ticket'
import Product from "./Product"

export default {
  name: "ProductList",
  components: {Product, UnitList},
  mixins: [price, ticket],
  data: () => {
    return {
      search: '',
      filter: {},
      sortDesc: false,
      page: 1,
      sortBy: 'text_tpv',
      productImg: {},
    }
  },

  computed: {
    products () {
      if (this.currentFamily) {
        return this.$store.state.product.products.filter((product) => product.id_taxonomy === this.$store.state.family.current_family)
      }

      return this.$store.state.product.products
    },

    stored_config () {
      return this.$store.state.global.config
    },

    currentFamily () {
      return this.$store.state.family.current_family
    },

    numberOfPages () {
      return Math.ceil(this.products.length / this.productsPerPage)
    },

    productsAddedToResolution () {
      return window.innerHeight > 750 ? window.innerHeight > 1000 ? 12 : 6 : 0
    },

    productsPerPage: {
      get() {
        return (this.$vuetify.breakpoint.smAndDown ? 6 : this.$vuetify.breakpoint.lgAndUp ? 18 : 12) + this.productsAddedToResolution
      },
      set(newValue) {
        return newValue
      },
    },
  },

  watch: {
    currentFamily() {
      this.page = 1
    },
    products(newValue) {
      if (newValue && newValue.length > 0) {
        newValue.forEach(product => this.productImg['product' + product.id] = this.$global_utilities.require_img_product(product.img))
      }
    },
  },

  mounted() {
    if (this.$vuetify.breakpoint.smAndDown) {
      document.getElementsByClassName('ct-card-content-product-list')[0].style.maxHeight = '52vh'
    } else {
      document.getElementsByClassName('ct-card-content-product-list')[0].style.maxHeight = '65vh'
    }
  },

  methods: {
    nextPage () {
      if (this.page + 1 <= this.numberOfPages) this.page += 1
    },
    formerPage () {
      if (this.page - 1 >= 1) this.page -= 1
    },
    updateproductsPerPage (number) {
      this.productsPerPage = number
    },
  },
}
</script>
<style>
  .product-text-tpv {
    max-height: 15px;
  }
</style>
