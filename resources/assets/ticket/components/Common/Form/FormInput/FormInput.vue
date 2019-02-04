<template>
  <div class="form__group">
    <label class="form__label">
      <span class="form__group-text">
        <slot></slot>
        <i
          data-required
          v-if="obj.required"
        >*</i>
      </span>
      <span
        class="form__group-required"
        v-if="obj.required"
      >{{ translation.required[documentLang] }}</span>

      <template v-if="obj.type == `tel`">
        <MaskedInput
          class="form__input"
          :class="[validField]"
          :type="obj.type"
          :name="obj.name"
          :required="obj.required"
          :placeholder="obj.placeholder"
          @input="onInput(arguments[1])"
          mask="\+\38 (111) 11-11-11-11"
          autocomplete="nope"
        />
      </template>

      <template v-else>
        <input
          class="form__input"
          :class="[validField]"
          :type="obj.type"
          :name="obj.name"
          :required="obj.required"
          :placeholder="obj.placeholder"
          :value="obj.value"
          @input.trim="onInput"
          autocomplete="nope"
        >
      </template>
    </label>
    <div class="form__group-error" v-if="showErrorMessage || showBackendErrorMessage">
      <slot name="error" v-if="showBackendErrorMessage"></slot>
      <p class="form__group-error" v-if="showErrorMessage">{{ translation.invalidData[documentLang] }}</p>
    </div>

    <button
      class="form__group-link form__text"
      type="button"
      v-if="obj.type == 'email'"
      @click="modalOpen(modalEmail)"
    >
      {{ translation.maiRu[documentLang] }}
    </button>
    <slot name="add"></slot>

    <Popup
      class="popup--full"
      v-if="modalEmail.open"
      :open="modalEmail.open"
      @popup-close="modalEmail.open = false"
    >
      <template slot="title">{{modalEmail.title}}</template>
      <template>
        <div class="popup__content" v-html="modalEmail.content"></div>
      </template>
    </Popup>
  </div>
</template>

<script>
  import Popup from "../../Popup/Popup"
  import MaskedInput from "vue-masked-input"

  export default {
    props: {
      obj: {
        type: Object,
        required: true
      }
    },
    components: {
      Popup,
      MaskedInput
    },
    created() {
      if (this.obj.value.length) {
        this.$emit("update", Object.assign({}, this.obj, {
          value: this.obj.value,
          valid: this.obj.regExp.test(this.obj.value)
        }))
      }
    },
    data() {
      return {
        componentError: ``,
        modalEmail: {
          open: false,
          content: ``,
          title: ``,
          action: `/api/v1/pages/where-are-we`
        },
        translation: {
          required: {
            ru: `Обязательно`,
            en: `Required`,
            ua: `Обов'язково`
          },
          invalidData: {
            ru: `Некорректные данные`,
            en: `Incorrect data`,
            ua: `Некоректні дані`
          },
          maiRu: {
            ru: `Владельцам ящиков яндекс и mail.ru`,
            en: `Yandex and mail.ru emails owners`,
            ua: `Власникам ящиків яндекс і mail.ru`
          }
        }
      }
    },
    computed: {
      showBackendErrorMessage() {
        return this.obj.validate && this.obj.valid && this.obj.error
      },
      showErrorMessage() {
        return this.obj.validate && !this.obj.valid && this.obj.required
      },
      validField() {
        if (this.obj.validate) {
          return {
            "form__input--error": !this.obj.regExp.test(this.obj.value)
          }
        }
      },
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      onInput(e) {
        if (this.obj.type == `tel`) {
          this.$emit("update", Object.assign({}, this.obj, {
            value: e,
            valid: this.obj.regExp.test(e)
          }))
        } else {
          this.$emit("update", Object.assign({}, this.obj, {
            value: e.target.value,
            valid: this.obj.regExp.test(e.target.value)
          }))
        }
      },
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
          .catch(err => console.log(err))
      }
    },
    watch: {

    }
  }
</script>
