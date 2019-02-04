<template>
  <div class="wrap">
    <div class="wrap-user">
      <template v-if="tokenInvalid === true">
        <h1 class="title-main" style="color: red">{{ translation.tokenNotValid[documentLang] }}</h1>
      </template>
      <template v-else-if="tokenInvalid === false">
        <h1 class="title-main">{{ translation.passwordReset[documentLang] }}</h1>
        <div class="text text--no-centered text--margin-big">
          <p>{{ translation.savePassword[documentLang] }}</p>
          <ul class="text__list">
            <li v-for="text in translation.savePasswordText">{{ text[documentLang] }}</li>
          </ul>
        </div>

        <form action="" class="form" @submit.prevent="sendData">
          <div class="form__fields">
            <app-input
              v-for="(field, index) in userFields"
              :obj="field"
              @update="updateField(index, $event)"
              :key="index">
              {{ field.label }}
              <p slot="error" v-if="field.error">{{field.error}}</p>
            </app-input>
          </div>

          <button-loader
            type="submit"
            class="btn btn--full"
            :disabled="$store.getters.loading"
          >
            {{ translation.send[documentLang] }}
          </button-loader>
        </form>
      </template>
    </div>
  </div>
</template>

<script>
  import translation from "../../../mixins/translation"
  import AppInput from "../../Input/Input"
  import ButtonLoader from "../../ButtonLoader/ButtonLoader"

  export default {
    mixins: [translation],
    created() {
      this.$store.dispatch(`checkResetPasswordToken`, {token: this.token})
      .then((data) => {
        this.userFields[0].value = data.email;
        this.tokenInvalid = false
      })
      .catch((err) => this.tokenInvalid = true);

      this.userFields[0].label = this.translation.userName[this.documentLang];
      this.userFields[1].label = this.translation.newPassword[this.documentLang];
    },
    data() {
      return {
        userFields: [
          {
            fieldName: `userLoginLogin`,
            value: ``,
            valid: false,
            validate: false,
            label: `Имя пользователя`,
            type: `email`,
            name: `email`,
            disabled: true,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА-Яа-яЁё0-9@\._]{2,})+$/
          },
          {
            fieldName: `userLoginPassword`,
            value: ``,
            valid: false,
            validate: false,
            label: `Новый пароль*`,
            type: `password`,
            name: `password`,
            required: true,
            eyeVisiblity: true,
            lineField: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/
          }
        ],
        token: this.$route.params.token,
        tokenInvalid: `indeterminate`
      }
    },
    methods: {
      sendData() {
        if (this.userFields.every(field => {
            field.validate = true;

            return field.valid ? true : false;
          })) {
          const data = {
            email: this.userFields[0].value,
            password: this.userFields[1].value,
            token: this.token
          };

          this.$store.dispatch(`resetPassword`, data)
          .then(() => this.$router.push({name: `PasswordResetSuccess`}))
          .catch((err) => {
            this.userFields.forEach(item => item.error = err.message)
          })
        } else {
          console.log(`Не верно заполнены данные`);
        }
      },
      updateField(i, event) {
        this.userFields.splice(i, 1, event);
        this.writeToSessionStorage(i, event);
      },
      writeToSessionStorage(i, event) {
        const key = this.userFields[i].fieldName,
              value = event.value;

        sessionStorage.setItem(key, value)
      }
    },
    components: {
      AppInput,
      ButtonLoader
    }
  }
</script>

<style>
</style>
