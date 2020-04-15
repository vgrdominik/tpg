<template>
  <!-- LIST -->
  <v-row class="ct-card-content-family-list pt-0 pb-0">
    <v-col cols="12" sm="8" md="9" lg="10" class="pt-0 pb-0">
      <v-data-iterator
              :items="families"
              :items-per-page.sync="familiesPerPageFiltered"
              :page="page"
              :search="search"
              :sort-by="sortBy"
              :sort-desc="sortDesc"
              hide-default-footer
      >
        <template v-slot:no-data>
          <v-col cols="12" class="text-center">
            <span class="primary--text body-2">No hay familias</span>
          </v-col>
        </template>
        <template v-slot:default="props">
          <v-row>
            <v-col
                    v-for="item in props.items"
                    :key="item.name"
                    cols="4"
                    sm="3"
                    md="3"
                    lg="2"
            >
              <v-card
                      style="cursor: pointer"
                      :elevation="item.id === $store.state.family.current_family ? 5 : 1"
                      @click="$store.state.family.current_family === item.id ? $store.state.family.current_family = 0 : $store.state.family.current_family = item.id">
                <v-row class="pt-4">
                  <v-spacer />
                  <v-avatar v-if="item.img" :width="$vuetify.breakpoint.smAndDown? 50 : '7vh'" :height="$vuetify.breakpoint.smAndDown? 50 : '7vh'">
                    <v-img
                      :src="familyImg['family' + item.id]"
                      @error="familyImg['family' + item.id] = $global_utilities.default_img()"
                      class="my-3" />
                  </v-avatar>
                  <v-avatar v-else color="secondary" :width="$vuetify.breakpoint.smAndDown? 50 : '7vh'" :height="$vuetify.breakpoint.smAndDown? 50 : '7vh'">
                    <span class="white--text headline" v-html="item.text_tpv ? item.text_tpv.charAt(0).toUpperCase() + item.text_tpv.charAt(1) : 'Ar'" />
                  </v-avatar>
                  <v-spacer />
                </v-row>
                <v-row dense class="pb-4">
                  <v-spacer />
                  <span class="body-2 text-uppercase primary--text" v-html="item.text_tpv" />
                  <v-spacer />
                </v-row>
              </v-card>
            </v-col>
          </v-row>
        </template>
      </v-data-iterator>
    </v-col>
    <v-col cols="12" sm="3" md="3" lg="2" :class="{ 'mt-6': $vuetify.breakpoint.mdAndUp }">
      <v-row dense>
        <v-spacer v-if="$vuetify.breakpoint.smAndDown" />
        <v-btn
                fab
                dark
                color="secondary"
                class="mr-1"
                @click="formerPage"
        >
          <v-icon>mdi-chevron-left</v-icon>
        </v-btn>
        <v-btn
                fab
                dark
                color="secondary"
                class="ml-1"
                @click="nextPage"
        >
          <v-icon>mdi-chevron-right</v-icon>
        </v-btn>
        <v-spacer v-if="$vuetify.breakpoint.smAndDown" />
      </v-row>
    </v-col>
  </v-row>
</template>

<script type="application/javascript">
export default {
  name: "FamilyList",
  data: () => {
    return {
      search: '',
      filter: {},
      sortDesc: false,
      page: 1,
      familiesPerPage: 6,
      sortBy: 'text_tpv',
      keys: [
        { name: 'Nombre', value: 'text_tpv' },
        { name: 'Precio', value: 'pvp' },
      ],
      familyImg: {},
    }
  },

  computed: {
    families () {
      return this.$store.state.family.families
    },

    stored_config () {
      return this.$store.state.global.config
    },

    familiesPerPageFiltered: {
      get() {
        return this.$vuetify.breakpoint.smAndDown ? this.familiesPerPage - 3 : this.$vuetify.breakpoint.lgAndUp ? this.familiesPerPage : this.familiesPerPage - 2
      },
      set(newValue) {
        return newValue
      },
    },
    numberOfPages () {
      return Math.ceil(this.families.length / this.familiesPerPageFiltered)
    },
  },

  watch: {
    families(newValue) {
      if (newValue && newValue.length > 0) {
        newValue.forEach(family => this.familyImg['family' + family.id] = this.$global_utilities.require_img('family/barRestaurant/' + family.img))
      }
    },
  },

  methods: {
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
  .ct-card-content-family-list {
    max-height: 59vh;
  }
</style>
