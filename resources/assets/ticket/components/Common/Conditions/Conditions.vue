<template>
  <div>
    <div class="conditions">
      <slot></slot>

      <p>{{ translation.clickOnButton[documentLang] }} <slot name="buttonName"></slot> {{ translation.youAgree[documentLang] }}
        <button
          type="button"
          class="conditions__link"
          @click="modalOpen(modalConditions)"
        >{{ translation.conditions[documentLang] }}</button> {{ translation.and[documentLang] }}
        <button
          type="button"
          class="conditions__link"
          @click="modalOpen(modalPolitic)"
        >{{ translation.politic[documentLang] }}</button>
      </p>
    </div>
    <Popup
      class="popup--full"
      v-if="modalConditions.open"
      :open="modalConditions.open"
      @popup-close="modalConditions.open = false"
    >
      <template slot="title">{{modalConditions.title}}</template>
      <template>
        <div class="popup__content" v-html="modalConditions.content"></div>
      </template>
    </Popup>
    <Popup
      class="popup--full"
      v-if="modalPolitic.open"
      :open="modalPolitic.open"
      @popup-close="modalPolitic.open = false"
    >
      <template slot="title">{{modalPolitic.title}}</template>
      <template>
        <div class="popup__content" v-html="modalPolitic.content"></div>
      </template>
    </Popup>
  </div>
</template>

<script>
  import Popup from "../Popup/Popup"

  export default {
    components: {
      Popup
    },
    data() {
      return {
        modalConditions: {
          open: false,
          content: ``,
          title: ``,
          action: `/api/v1/pages/where-are-we`
        },
        modalPolitic: {
          open: false,
          content: ``,
          title: ``,
          action: `/api/v1/pages/where-are-we`
        },
        translation: {
          clickOnButton: {
            ru: `Нажимая на кнопку`,
            en: `By clicking on the button`,
            ua: `Натискаючи на кнопку`
          },
          youAgree: {
            ru: `Вы соглашаетесь с`,
            en: `You agree to the`,
            ua: `Ви погоджуєтеся з`
          },
          conditions: {
            ru: `"Условиями обслуживания"`,
            en: `"Terms of Service"`,
            ua: `"Умовами обслуговування"`
          },
          and: {
            ru: `и`,
            en: `and`,
            ua: `та`
          },
          politic: {
            ru: `"Политикой конфиденциальности"`,
            en: `"Privacy Policy"`,
            ua: `"Політикою конфіденційності"`
          }
        }
      }
    },
    computed: {
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      modalOpen(item) {
        if (item.content) {
          item.open = true;
        } else {
          this.getTextData(item.action).
          then((data) => {
            item.title = data.title;
            item.content = data.descriptions;
            item.open = true;
          });
        }
      },
      getTextData(action) {
        return this.$store.dispatch(`getTextData`, action)
          .catch(err => console.log(err));
      }
    }
  }
</script>
