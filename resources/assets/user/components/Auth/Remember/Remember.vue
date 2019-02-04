<template>
  <div class="wrap">
    <div class="wrap-user">
      <h1 class="title-main">{{ translation.forgotYourLoginOrPassword[documentLang] }}</h1>
      <div class="text">
        <p>{{ translation.forgotYourLoginOrPasswordText[documentLang] }}</p>
      </div>

      <form action="" class="form" @submit.prevent="sendData">
        <div class="form__fields">
          <app-input
            v-for="(field, index) in userRememberFields"
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
    </div>
  </div>
</template>

<script>
  import translation from "../../../mixins/translation"
  import AppInput from "../../Input/Input"
  import ButtonLoader from "../../ButtonLoader/ButtonLoader"

  export default {
    mixins: [translation],
    created(){
      this.userRememberFields[0].label = `${this.translation.your[this.documentLang]} email *`
    },
    data() {
      return {
        userRememberFields: [
          {
            fieldName: `userLoginLogin`,
            value: ``,
            valid: false,
            validate: false,
            label: `Ваш email *`,
            type: `text`,
            name: `login`,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА-Яа-яЁё0-9@\._]{2,})+$/
          }
        ]
      }
    },
    methods: {
      sendData() {
        if (this.userRememberFields.every(field => {
            field.validate = true;

            return field.valid ? true : false;
          })) {
          const data = {
            email: this.userRememberFields[0].value
          };

          this.$store.dispatch(`forgotPassword`, data)
          .then((obj) => this.$router.push({name: `PasswordRecovery`}))
          .catch((err) => this.userRememberFields.forEach(item => item.error = err.message))
        } else {
          console.log(`Не верно заполнены данные`);
        }
      },
      updateField(i, event) {
        this.userRememberFields.splice(i, 1, event);
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
