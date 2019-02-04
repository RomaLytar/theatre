import Vue from "vue"
import VueRouter from "vue-router"
import {store} from "./store"

Vue.use(VueRouter)

import Poster from "./components/Poster/Poster"
import Hall from "./components/Hall/Hall"
import Booking from "./components/Booking/Booking"
import Tickets from "./components/Tickets/Tickets"

import PdfPRint from "./components/PdfPRint/PdfPRint"

const path = `/admin/cash-box`;

export const router = new VueRouter({
  mode: `history`,
  routes: [
    {
      path: `${path}/`,
      name: `Poster`,
      component: Poster
    },
    {
      path: `${path}/pdf-print`,
      name: `PdfPRint`,
      component: PdfPRint
    },
    {
      path: `${path}/booking`,
      name: `Booking`,
      component: Booking
    },
    {
      path: `${path}/tickets`,
      name: `Tickets`,
      component: Tickets
    },
    {
      path: `${path}/hall/:id`,
      name: `Hall`,
      component: Hall,
      beforeEnter(to, from, next){
        const id = to.params.id;

        if (!store.getters.events.length) {
          next({name: `Poster`});
        } else {
          const item = store.getters.events.find(item => item.data.findIndex(event => event.id == id) != -1 ? true : false);
          item ? next() : next({name: `Poster`});
        }
      }
    },
    {
      path: `/admin/dashboard`,
      beforeEnter(to, from, next) {
        window.location = `/admin/dashboard`;
      }
    }
  ]
})

