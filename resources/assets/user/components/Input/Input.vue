<template>
  <div class="form__field">
    <div class="form__field-left">
      <label class="form__label">
        <input
          class="form__input"
          :class="[fieldFull, validField]"
          :type="obj.type"
          :name="obj.name"
          :required="obj.required"
          :disabled="obj.disabled"
          :value="obj.value"
          @input.trim="onInput"
        >
        <span class="form__label-text">
          <slot></slot>
        </span>
      </label>
      <div
        v-if="obj.lineField"
        class="form-field__password-line"
        :style="lineField"
      ></div>
      <p v-if="obj.emailLinkVisible === true" class="form__field-link">
        <button type="button" class="link" @click="modalOpen(modalEmail)">{{ translation.yandexAndMail[documentLang] }}</button>
      </p>
      <div class="form__field-error" v-if="showErrorMessage || showBackendErrorMessage">
        <slot name="error" v-if="showBackendErrorMessage"></slot>
        <p class="form__field-error" v-if="showErrorMessage">{{ translation.notCorrectData[documentLang] }}</p>
      </div>
    </div>
    <div class="form__field-right">
      <button
        type="button"
        class="form-field__eye"
        :class="crossEye"
        v-if="obj.eyeVisiblity"
        @click="seenPassword"
      >
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 456.8 456.8" width="20" height="20" fill="#666666">
          <path d="M448.9,218.5c-0.9-1.2-23.1-28.9-61-56.8c-50.7-37.3-105.9-56.9-159.6-56.9c-53.7,0-108.8,19.7-159.6,56.9
            c-37.9,27.9-60.1,55.6-61,56.8L0,228.4l7.8,9.9c0.9,1.2,23.1,28.9,61,56.8c50.7,37.3,105.9,56.9,159.6,56.9
            c53.7,0,108.8-19.7,159.6-56.9c37.9-27.9,60.1-55.6,61-56.8l7.8-9.9L448.9,218.5z M368.3,269.9c-31.4,22.9-81.1,50.2-139.9,50.2
            s-108.5-27.3-139.9-50.2c-21.5-15.7-37.6-31.6-46.8-41.5c9.2-9.9,25.3-25.8,46.8-41.5c31.4-22.9,81.1-50.2,139.9-50.2
            c58.8,0,108.5,27.3,139.9,50.2c21.5,15.7,37.6,31.6,46.8,41.5C405.9,238.3,389.8,254.2,368.3,269.9z"/>
          <path d="M228.4,160.7c-16.4,0-31.5,5.8-43.2,15.6c9.3,2.7,16,11.3,16,21.4c0,12.3-10,22.3-22.3,22.3c-6.5,0-12.3-2.8-16.4-7.2
              c-1.2,5-1.8,10.2-1.8,15.5c0,37.4,30.3,67.7,67.7,67.7c37.4,0,67.7-30.3,67.7-67.7S265.8,160.7,228.4,160.7z"/>
          <rect x="-20" y="221.8" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -94.6053 228.3966)" width="496.7" height="13.2"/>
        </svg>
      </button>
      <span class="form-field__required" v-if="!obj.disabled">
        {{ textRequired }}
      </span>
    </div>

    <popup
      v-if="modalEmail.open"
      :open="modalEmail.open"
      @popup-close="modalEmail.open = false"
    >
      <template slot="title">{{modalEmail.title}}</template>
      <template>
        <div class="popup__content" v-html="modalEmail.content"></div>
      </template>
    </popup>
  </div>
</template>

<script>
  import translation from "../../mixins/translation"
  import Popup from "../Popup/Popup"

  export default {
    props: [`obj`],
    mixins: [translation],
    data() {
      return {
        componentError: ``,
        modalEmail: {
          open: false,
          content: ``,
          title: ``,
          action: `/api/v1/pages/where-are-we`
        }
      }
    },
    mounted() {
      this.$emit("update", Object.assign({}, this.obj, {
        valid: this.obj.regExp.test(this.obj.value)
      }))
    },
    computed: {
      showBackendErrorMessage() {
        return this.obj.validate && this.obj.valid && this.obj.error
      },
      showErrorMessage() {
        return this.obj.validate && !this.obj.valid && this.obj.required
      },
      fieldFull() {
        return {
          "form__input--value": this.obj.value
        }
      },
      crossEye() {
        return {
          "form-field__eye--cross": this.obj.type === `text` ? true : false
        }
      },
      textRequired() {
        return this.obj.required ? `*${this.translation.required[this.documentLang]}` : this.translation.optional[this.documentLang]
      },
      validField() {
        if (this.obj.validate) {
          return {
            "form__input--error": !this.obj.regExp.test(this.obj.value)
          }
        }
      },
      lineField() {
        let value = this.obj.value.length,
            background = ``,
            width = ``,
            protect = 0,
            REGEXP = {
              slow: /^((?=.*[0-9])|(?=.*[a-z])|(?=.*[A-Z]))[0-9a-zA-Z]{6,}$/,
              normal: /^((?=.*[0-9])(?=.*[a-z])|(?=.*[0-9])(?=.*[A-Z]))[0-9a-zA-Z]{6,}$/,
              good: /^(?=.*[0-9])(?=.*[a-z])(?=.*[A-Z])[0-9a-zA-Z]{6,}$/
            },
            fieldStyleObj = [
              {
                background: `#cc0000`,
                width: `33%`
              },
              {
                background: `#f07023`,
                width: `50%`
              },
              {
                background: `#f1d729`,
                width: `75%`
              },
              {
                background: `#5f9012`,
                width: `100%`
              }
            ];

        if (value < 6) {
          return fieldStyleObj[protect]
        }

        REGEXP.slow.test(this.obj.value) ? protect++ : null;
        REGEXP.normal.test(this.obj.value) ? protect++ : null;
        REGEXP.good.test(this.obj.value) ? protect++ : null;

        return fieldStyleObj[protect]
      }
    },
    methods: {
      onInput(e) {
        this.$emit("update", Object.assign({}, this.obj, {
          value: e.target.value,
          valid: this.obj.regExp.test(e.target.value)
        }))
      },
      seenPassword() {
        const type = this.obj.type === `password` ? `text` : `password`;

        this.$emit("update", Object.assign({}, this.obj, {type: type}))
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
