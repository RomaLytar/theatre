import Vue from "vue"
import VueRouter from "vue-router"
import {store} from './store'

Vue.use(VueRouter)

import Authorization from "./components/Auth/Authorization/Authorization"
import Registration from "./components/Auth/Registration/Registration"
import Remember from "./components/Auth/Remember/Remember"
import PasswordRecovery from "./components/Auth/PasswordRecovery/PasswordRecovery"
import PasswordReset from "./components/Auth/PasswordReset/PasswordReset"
import PasswordResetSuccess from "./components/Auth/PasswordReset/PasswordResetSuccess"
import AccountActivate from "./components/Auth/AccountActivate/AccountActivate"
import AccountActivateSuccess from "./components/Auth/AccountActivate/AccountActivateSuccess"
import Account from "./components/Account/Account"
import Orders from "./components/Orders/Orders"
import Archive from "./components/Archive/Archive"
import Tickets from "./components/Tickets/Tickets"

const path = `/user`;

export const router = new VueRouter({
  mode: `history`,
  routes: [
    {
      path: `${path}/auth`,
      name: `Authorization`,
      component: Authorization
    },
    {
      path: `${path}/reg`,
      name: `Registration`,
      component: Registration
    },
    {
      path: `${path}/remember`,
      name: `Remember`,
      component: Remember
    },
    {
      path: `${path}/passwordRecovery`,
      name: `PasswordRecovery`,
      component: PasswordRecovery
    },
    {
      path: `${path}/passwordReset/:token`,
      name: `PasswordReset`,
      component: PasswordReset
    },
    {
      path: `${path}/passwordResetSuccess`,
      name: `PasswordResetSuccess`,
      component: PasswordResetSuccess
    },
    {
      path: `${path}/accountActivate`,
      name: `AccountActivate`,
      component: AccountActivate
    },
    {
      path: `${path}/accountActivate/:id/:token`,
      name: `AccountActivateSuccess`,
      component: AccountActivateSuccess
    },
    {
      path: `${path}/account`,
      name: `Account`,
      component: Account,
      beforeEnter: (to, from, next) => {
        if (!store.getters.user) {
          next({name: `Authorization`})
          return
        }

        next()
      }
    },
    {
      path: `${path}/orders`,
      name: `Orders`,
      component: Orders,
      beforeEnter: (to, from, next) => {
        if (!store.getters.user) {
          next({name: `Authorization`})
          return
        }

        next()
      }
    },
    {
      path: `${path}/archive`,
      name: `Archive`,
      component: Archive,
      beforeEnter: (to, from, next) => {
        if (!store.getters.user) {
          next({name: `Authorization`})
          return
        }

        next()
      }
    },
    {
      path: `${path}/tickets/:id`,
      name: `Tickets`,
      component: Tickets,
      beforeEnter: (to, from, next) => {
        if (!store.getters.user) {
          next({name: `Authorization`})
          return
        }

        next()
      }
    },
    {
      path: `*`,
      redirect: { name: `Authorization` }
    }
  ]
})
