<template>
  <!-- PRODUCT CARD -->
  <v-row
          dense
          v-if="! loading"
          class="mx-auto my-1"
  >
    <v-col cols="4">
      <v-img
        v-if="productImg"
        :src="productImg"
        @error="productImg = $global_utilities.default_img()"
        width="100"
        height="100" />
    </v-col>
    <v-col cols="8">
      <v-row dense>
        <v-col cols="6">
          <v-rating
            :value="4.5"
            color="amber"
            dense
            half-increments
            readonly
            size="14" />
        </v-col>
        <v-col cols="6">
          <div class="grey--text ml-4">4.5 (413)</div>
        </v-col>
        <v-col cols="12">
          <div class="my-4 subtitle-1">
            {{ totalPriceWithIva(product.total, product.iva) }} • Referencia: {{ product.reference }}
          </div>
        </v-col>
      </v-row>
    </v-col>

    <v-card-text v-if="product.name">
      <div v-html="product.name" />
    </v-card-text>

    <v-col cols="12">
      <v-divider class="mx-4" />
    </v-col>

    <v-col cols="12" v-if="selectionComplements">
      <v-row
              dense
              v-for="(productComplements, group) in current_product_to_show_complements_by_group"
              :key="'group' + group">

        <v-card-title v-html="group" />

        <v-card-text>
          <v-chip-group
                  v-model="selectionComplements[group]"
                  active-class="primary accent-4 white--text"
                  column
          >
            <v-chip
                    v-for="productComplement in productComplements"
                    :key="'complement' + productComplement"
                    v-html="productComplement.complement_text_tpv + ((productComplement.complement_price) ? ' - ' + totalPriceWithIva(productComplement.complement_price, productComplement.iva) : '')" />
          </v-chip-group>
        </v-card-text>
      </v-row>
    </v-col>

    <v-btn
            color="deep-purple lighten-2"
            text
            @click="addProductToTicket(product, null, selectionComplements)"
    >
      Añadir
    </v-btn>
  </v-row>
</template>

<script type="application/javascript">
import price from '../../mixins/price'
import ticket from '../../mixins/ticket'
export default {
  name: "Product",

  mixins: [price, ticket],

  props: {
    'product': {
      type: Object,
      required: true,
    },
  },

  data: () => {
    return {
      loading: false,
      selectionComplements: {},
      productImg: null,
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    },
  },

  mounted() {
    if (this.current_product_to_show_complements_groups) {
      this.current_product_to_show_complements_groups.forEach(group => this.selectionComplements[group] = null)
    }

    this.productImg = this.$global_utilities.require_img_product(this.product.img)
  },
}
</script>
