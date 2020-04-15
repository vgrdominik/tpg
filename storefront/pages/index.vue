<template>
  <v-container fluid id="main-content">
    <v-row dense>
      <v-col cols="12" md="3">
        <ActionList />
        <TicketList v-if="current_ticket === 0" />
        <Ticket v-else />
      </v-col>
      <v-col cols="12" md="9">
        <v-expansion-panels v-model="panel" accordion>
          <v-expansion-panel>
            <v-expansion-panel-header class="primary--text pt-0 pb-0">Familias</v-expansion-panel-header>
            <v-expansion-panel-content>
              <FamilyList />
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
        <ProductList />
      </v-col>
    </v-row>
  </v-container>
</template>

<script>
import { mapActions } from 'vuex'
import FamilyList from "../components/family/FamilyList";
import ProductList from "../components/product/ProductList";
import ActionList from "../components/ticket/ActionList";
import TicketList from "../components/ticket/TicketList";
import Ticket from "../components/ticket/Ticket";

export default {
  components: {Ticket, TicketList, ActionList, FamilyList, ProductList},
  data() {
    return {
      panel: 0,
    }
  },

  computed: {
    stored_config () {
      return this.$store.state.global.config
    },
    current_ticket () {
      return this.$store.state.ticket.current_ticket
    },
  },

  mounted() {
    if (this.$vuetify.breakpoint.smAndDown) {
      this.panel = false
    }
    document.getElementById('maincontent').style.bottom = '0'
    this.setIsContainerNeeded(false)
  },

  methods: {
    ...mapActions('global', [
      'setIsContainerNeeded',
    ]),
  },
}
</script>
<style>
#main-content .v-expansion-panel-header {
  height: 35px;
  max-height: 35px;
  min-height: 35px;
}
#main-content .v-expansion-panel--active > .v-expansion-panel-header {
  height: 35px;
  max-height: 35px;
  min-height: 35px;
}
</style>
