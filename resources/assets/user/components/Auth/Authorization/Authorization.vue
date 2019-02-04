<template>
  <div class="wrap">
    <template v-if="userToken">
      <cross-back></cross-back>
      <div class="wrap-user">
        <h1 class="title-main">{{ translation.authorization[documentLang] }}</h1>
        <div class="text">
          <p>{{ translation.authorizationText[documentLang] }}</p>
        </div>

        <form action="" class="form" @submit.prevent="sendData">
          <div class="form__fields">
            <app-input
              v-for="(field, index) in userLoginFields"
              :obj="field"
              @update="updateField(index, $event)"
              :key="index">
              {{ field.label }}
              <p slot="error" v-if="field.error">{{field.error}}</p>
            </app-input>
          </div>

          <conditions>
            <p><router-link :to="{name: 'Remember'}">{{ translation.forgotYourLoginOrPassword[documentLang] }}</router-link></p>
            <span slot="buttonName">{{ translation.authorizateBig[documentLang] }}</span>
          </conditions>
          <button-loader
            type="submit"
            class="btn btn--full"
            :disabled="$store.getters.loading"
          >
            {{ translation.authorizateBig[documentLang] }}
          </button-loader>
        </form>
        <router-link :to="{name: 'Registration'}" class="text-link">{{ translation.notRegistered[documentLang] }}</router-link></p>
      </div>
    </template>
  </div>
</template>

<script>
  import translation from "../../../mixins/translation"
  import AppInput from "../../Input/Input"
  import CrossBack from "../../CrossBack/CrossBack"
  import ButtonLoader from "../../ButtonLoader/ButtonLoader"
  import Conditions from "../../Conditions/Conditions"

  export default {
    mixins: [translation],
    created() {
      this.userLoginFields.forEach(field => {
        const value = sessionStorage.getItem(field.fieldName);

        field.value = value ? value : ``;
      });

      const token = this.$store.getters.token || localStorage.getItem(`token`);

      if (token) {
        this.$store.dispatch(`getUserByToken`, token).then(() => {
          this.$router.push({name: `Account`})
        })
        .catch((err) => this.userToken = true)
      } else {
        this.userToken = true;
      }

      this.userLoginFields[0].label = `${this.translation.your[this.documentLang]} email*`;
      this.userLoginFields[1].label = `${this.translation.password[this.documentLang]}*`;
    },
    data() {
      return {
        userLoginFields: [
          {
            fieldName: `userLoginLogin`,
            value: ``,
            valid: false,
            validate: false,
            label: `Ваш email*`,
            type: `email`,
            name: `login`,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА-Яа-яЁё0-9@\._]{2,})+$/
          },
          {
            fieldName: `userLoginPassword`,
            value: ``,
            valid: false,
            validate: false,
            label: `Пароль*`,
            type: `password`,
            name: `password`,
            required: true,
            eyeVisiblity: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/
          }
        ],
        userToken: false
      }
    },
    methods: {
      sendData() {
        if (this.userLoginFields.every(field => {
            field.validate = true;

            return field.valid ? true : false;
          })) {
          const data = {
            email: this.userLoginFields[0].value,
            password: this.userLoginFields[1].value
          };

          this.$store.dispatch(`getToken`, data)
          .then(() => this.$store.getters.token)
          .then((token) => this.$store.dispatch(`getUserByToken`, token))
          .then(() => {
            this.$router.push({name: `Account`})
          })
          .catch((err) => {
            this.userLoginFields.forEach(item => (item.error = err.message))
          })
        } else {
          console.log(`Не верно заполнены данные`);
        }
      },
      updateField(i, event) {
        this.userLoginFields.splice(i, 1, event);
        this.writeToSessionStorage(i, event);
      },
      writeToSessionStorage(i, event) {
        const key = this.userLoginFields[i].fieldName,
              value = event.value;

        sessionStorage.setItem(key, value)
      }
    },
    components: {
      AppInput,
      CrossBack,
      ButtonLoader,
      Conditions
    }
  }
</script>
