<template>
  <div>
    <div class="text-authorization">
      <slot></slot>

      <p>{{ translation.clickOnButton[documentLang] }} <slot name="buttonName"></slot> {{ translation.youAgree[documentLang] }}
        <button
          type="button"
          class="text-authorization__link link"
          @click="modalOpen(modalConditions)"
        >{{ translation.conditions[documentLang] }}</button> {{ translation.and[documentLang] }}
        <button
          type="button"
          class="text-authorization__link link"
          @click="modalOpen(modalPolitic)"
        >{{ translation.politic[documentLang] }}</button>
      </p>
    </div>
    <popup
      v-if="modalConditions.open"
      :open="modalConditions.open"
      @popup-close="modalConditions.open = false"
    >
      <template slot="title">{{modalConditions.title}}</template>
      <template>
        <div class="popup__content" v-html="modalConditions.content"></div>
      </template>
    </popup>
    <popup
      v-if="modalPolitic.open"
      :open="modalPolitic.open"
      @popup-close="modalPolitic.open = false"
    >
      <template slot="title">{{modalPolitic.title}}</template>
      <template>
        <div class="popup__content" v-html="modalPolitic.content"></div>
      </template>
    </popup>
  </div>
</template>

<script>
  import translation from "../../mixins/translation"
  import Popup from "../Popup/Popup"

  export default {
    mixins: [translation],
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
        }
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
          .catch((err) => {
            console.log(err);
          })
      }
    },
    components: {
      Popup
    }
  }
</script>
