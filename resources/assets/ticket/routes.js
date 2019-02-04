import Vue from "vue"
import VueRouter from "vue-router"
import {store} from "./store"

Vue.use(VueRouter)

import Perfomance from "./components/Perfomance/Perfomance"
import Entry from "./components/Entry/Entry"
import ProstoNeba from "./components/ProstoNeba/ProstoNeba"
import Seatmap from "./components/Seatmap/Seatmap"
import Cart from "./components/Cart/Cart"
import Authorization from "./components/Authorization/Authorization"
import Payment from "./components/Payment/Payment"
import PaymentSuccess from "./components/Payment/PaymentSuccess"
import PaymentCheck from "./components/Payment/PaymentCheck"

const path = `/ticket`;

export const router = new VueRouter({
  mode: `history`,
  routes: [
    {
      path: `*`,
      redirect: { name: `Cart` }
    },
    {
      path: `${path}/perfomance/:id`,
      name: `Entry`,
      component: Entry
    },
    {
      path: `${path}/perfomance/:id/big`,
      name: `Perfomance`,
      component: Perfomance,
      meta: {
        perfomanceId: true
      }
    },
    {
      path: `${path}/:id/prosto-neba`,
      name: `ProstoNeba`,
      component: ProstoNeba,
      meta: {
        perfomanceId: true
      }
    },
    {
      path: `${path}/:id/seatmap`,
      name: `Seatmap`,
      component: Seatmap,
      meta: {
        perfomanceId: true
      }
    },
    {
      path: `${path}/cart`,
      name: `Cart`,
      component: Cart
    },
    {
      path: `${path}/authorization`,
      name: `Authorization`,
      component: Authorization,
      meta: {
        cart: true
      },
      beforeEnter(to, from, next){
        window.localStorageCart.perfomances ? next() : next({ name: `Cart`});
      }
    },
    {
      path: `${path}/payment`,
      name: `Payment`,
      component: Payment,
      meta: {
        cart: true
      },
      beforeEnter(to, from, next){
        if (window.localStorageCart.perfomances && store.getters.user.email || window.localStorageCart.perfomances && localStorage.getItem(`paymentAuthUserEmail`)) {
          next();
        } else {
          next({ name: `Authorization`})
        }
      }
    },
    {
      path: `${path}/payment-check`,
      name: `PaymentCheck`,
      component: PaymentCheck
    },
    {
      path: `${path}/payment-success`,
      name: `PaymentSuccess`,
      component: PaymentSuccess,
      beforeEnter(to, from, next){
        if (localStorage.getItem(`ticketsSuccess`) || store.getters.ticketsSuccess.length) {
          next();
        } else {
          next({ name: `Cart`})
        }
      }
    }
  ]
})

router.beforeEach((to, from, next) => {
  const meta = to.meta;
  if (meta) {
    if (meta.perfomanceId) {
      store.getters.perfomanceInfo.id ? next() : next({ path: `${path}/perfomance/${to.params.id}` });
    } else {
      next();
    }
  } else {
    next();
  }
})
