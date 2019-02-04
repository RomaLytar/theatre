<template>
  <form
    action=""
    method="post"
    autocomplete="off"
    @submit.prevent="submitForm"
    class="form"
  >
    <template v-if="authType == 'new' && !createAccount">
      <component
        v-for="(field, index) in userGuestFields"
        :is="field.component"
        :obj="field"
        @update="updateField(userGuestFields, index, $event)"
        :key="field.fieldName"
      >
        {{ field.label }}
        <p slot="error" v-if="field.error">{{field.error[0]}}</p>
        <p class="form__text" slot="add">{{ translation.youCanCreateAccount[documentLang] }}</p>
      </component>

      <div class="form__btn-wrap">
        <button
          type="button"
          class="form__btn btn btn--red btn--lower"
          @click="createAccountMethod"
        >{{ translation.createAccount[documentLang] }}</button>
        <button
          type="button"
          class="form__btn form__link btn btn--link btn--lower"
          @click="continueAsGuest"
        >{{ translation.continueAsGuest[documentLang] }}</button>
      </div>
    </template>

    <template v-if="authType == 'reg'">
      <component
        v-for="(field, index) in userAuthFields"
        :is="field.component"
        :obj="field"
        @update="updateField(userAuthFields, index, $event)"
        :key="field.fieldName"
      >
        {{ field.label }}
        <p slot="error" v-if="field.error">{{field.error[0]}}</p>
      </component>

      <div class="form__btn-wrap">
        <button
          type="button"
          class="form__btn btn btn--red btn--lower"
          @click="continueAsAuth"
        >{{ translation.continue[documentLang] }}</button>
      </div>
    </template>

    <template v-if="authType == 'new' && createAccount">
      <component
        v-for="(field, index) in userRegFields"
        :is="field.component"
        :obj="field"
        @update="updateField(userRegFields, index, $event)"
        :key="field.fieldName"
      >
        {{ field.label }}
        <p slot="error" v-if="field.error">{{field.error[0]}}</p>
      </component>

      <FormCheckbox
        :checked="subscribe"
        @change="subscribeChanges"
        :size="14"
        class="checkbox--big checkbox--gray"
      >
        {{ translation.subscribe[documentLang] }}
      </FormCheckbox>

      <Conditions>
        <span slot="buttonName">"{{ translation.createAccount[documentLang] }}"</span>
      </Conditions>

      <div class="form__btn-wrap">
        <button
          type="button"
          class="form__btn btn btn--red btn--lower"
          @click="continueAsReg"
        >{{ translation.confirm[documentLang] }}</button>
        <button
          type="button"
          class="form__btn form__link btn btn--link btn--lower"
          @click="createAccount = false"
        >{{ translation.cancel[documentLang] }}</button>
      </div>
    </template>
  </form>
</template>

<script>
  import FormInput from "./FormInput/FormInput"
  import FormCheckbox from "../Checkbox/Checkbox"
  import Conditions from "../Conditions/Conditions"
  import Country from "../Country/Country"

  export default {
    props: {
      authType: {
        type: String,
        required: true
      }
    },
    components: {
      FormInput,
      FormCheckbox,
      Conditions,
      Country
    },
    created(){
      this.userGuestFields[0].label = `${this.translation.your[this.documentLang]} e-mail (example@email.ru)`;

      this.userAuthFields[0].label = `${this.translation.your[this.documentLang]} e-mail`;
      this.userAuthFields[1].label = this.translation.password[this.documentLang];
      this.userAuthFields[1].placeholder = this.translation.password[this.documentLang];

      this.userRegFields[0].label = `${this.translation.your[this.documentLang]} e-mail`;
      this.userRegFields[1].label = this.translation.name[this.documentLang];
      this.userRegFields[1].placeholder = this.translation.name[this.documentLang];
      this.userRegFields[2].label = this.translation.lastName[this.documentLang];
      this.userRegFields[2].placeholder = this.translation.lastName[this.documentLang];
      this.userRegFields[3].label = this.translation.password[this.documentLang];
      this.userRegFields[3].placeholder = this.translation.password[this.documentLang];
      this.userRegFields[4].label = this.translation.phone[this.documentLang];
      this.userRegFields[4].placeholder = this.translation.phone[this.documentLang];

      this.userRegFields[5].label = this.translation.city[this.documentLang];
      this.userRegFields[5].placeholder = this.translation.city[this.documentLang];
      this.userRegFields[6].label = this.translation.country[this.documentLang];
      this.userRegFields[6].placeholder = this.translation.country[this.documentLang];

      const authUserEmail = localStorage.getItem(`paymentAuthUserEmail`);

      if (authUserEmail) {
        this.userGuestFields[0].value = authUserEmail;
      }

    },
    data() {
      return {
        phone: ``,
        translation: {
          youCanCreateAccount: {
            ru: `Вы можете создать аккаунт и покупать билеты быстрее`,
            en: `You can create an account and buy tickets faster`,
            ua: `Ви можете створити аккаунт і купувати квитки швидше`
          },
          createAccount: {
            ru: `Создать аккаунт`,
            en: `Create an account`,
            ua: `Створити аккаунт`
          },
          continueAsGuest: {
            ru: `Продолжить как гость`,
            en: `Continue as guest`,
            ua: `Продовжити як гість`
          },
          continue: {
            ru: `Продолжить`,
            en: `Continue`,
            ua: `Продовжити`
          },
          subscribe: {
            ru: `Подписаться на получение информации о предстоящих событиях в Cxid Opera`,
            en: `Subscribe to receive information about upcoming events at Cxid Opera`,
            ua: `Підписатися на отримання інформації про майбутні події в Cxid Opera`
          },
          confirm: {
            ru: `Подтвердить`,
            en: `Confirm`,
            ua: `Підтвердити`
          },
          cancel: {
            ru: `Отмена`,
            en: `Cancel`,
            ua: `Скасувати`
          },
          your: {
            ru: `Ваш`,
            en: `Your`,
            ua: `Ваш`
          },
          password: {
            ru: `Пароль`,
            en: `Password`,
            ua: `Пароль`
          },
          name: {
            ru: `Имя`,
            en: `First name`,
            ua: `Ім'я`
          },
          lastName: {
            ru: `Фамилия`,
            en: `Surname`,
            ua: `Прізвище`
          },
          phone: {
            ru: `Телефон`,
            en: `Phone`,
            ua: `Телефон`
          },
          city: {
            ru: `Город`,
            en: `City`,
            ua: `Місто`
          },
          country: {
            ru: `Страна`,
            en: `Country`,
            ua: `Країна`
          }
        },
        createAccount: false,
        subscribe: true,
        userGuestFields: [
          {
            fieldName: `userGuestEmail`,
            value: ``,
            valid: false,
            validate: false,
            emailLinkVisible: true,
            label: ``,
            type: `email`,
            name: `email`,
            placeholder: `E-mail`,
            required: true,
            error: ``,
            regExp: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/,
            component: `FormInput`
          }
        ],
        userAuthFields: [
          {
            fieldName: `userAuthEmail`,
            value: ``,
            valid: false,
            validate: false,
            emailLinkVisible: true,
            label: ``,
            type: `email`,
            name: `email`,
            placeholder: `E-mail`,
            required: true,
            error: ``,
            regExp: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/,
            component: `FormInput`
          },
          {
            fieldName: `userAuthPassword`,
            value: ``,
            valid: false,
            validate: false,
            label: ``,
            type: `password`,
            name: `password`,
            placeholder: ``,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/,
            component: `FormInput`
          }
        ],
        userRegFields: [
          {
            fieldName: `userRegEmail`,
            value: ``,
            valid: false,
            validate: false,
            emailLinkVisible: true,
            label: ``,
            type: `email`,
            name: `email`,
            placeholder: `E-mail`,
            required: true,
            error: ``,
            regExp: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/,
            component: `FormInput`
          },
          {
            fieldName: `userRegName`,
            value: ``,
            valid: false,
            validate: false,
            label: `Имя`,
            type: `text`,
            name: `firstName`,
            placeholder: `Имя`,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА-Яа-яЁё@\.]{2,50})+$/,
            component: `FormInput`
          },
          {
            fieldName: `userRegSurname`,
            value: ``,
            valid: false,
            validate: false,
            label: ``,
            type: `text`,
            name: `lastName`,
            placeholder: ``,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА-Яа-яЁё@\.]{2,50})+$/,
            component: `FormInput`
          },
          {
            fieldName: `userRegPassword`,
            value: ``,
            valid: false,
            validate: false,
            label: ``,
            type: `password`,
            name: `password`,
            placeholder: ``,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/,
            component: `FormInput`
          },
          {
            fieldName: `userRegPhone`,
            value: ``,
            valid: false,
            validate: false,
            label: ``,
            type: `tel`,
            name: `phone`,
            placeholder: ``,
            required: true,
            mask: ``,
            error: ``,
            regExp: /^([0-9]{6,15})+$/,
            component: `FormInput`
          },
          {
            fieldName: `userRegCity`,
            value: ``,
            valid: false,
            label: ``,
            type: `text`,
            name: `city`,
            placeholder: ``,
            error: ``,
            regExp: /./,
            component: `FormInput`
          },
          {
            fieldName: `userRegCountry`,
            value: ``,
            valid: false,
            label: ``,
            type: `text`,
            name: `country_id`,
            placeholder: ``,
            error: ``,
            component: `Country`,
            regExp: /./,
          }
        ]
      }
    },
    computed: {
      documentLang() {
        return this.$store.getters.documentLang
      }
    },
    methods: {
      createAccountMethod() {
        this.createAccount = true;
      },
      subscribeChanges(e) {
        this.subscribe = e;
      },
      updateField(field, i, event) {
        if (field == this.userGuestFields) {
          localStorage.setItem(`paymentAuthUserEmail`, event.value)
        }

        field.splice(i, 1, event);
      },
      continueAsGuest() {
        this.sendData(this.userGuestFields);
      },
      continueAsAuth() {
        this.sendData(this.userAuthFields);
      },
      continueAsReg() {
        this.sendData(this.userRegFields);
      },
      sendData(type) {
        type.forEach(field => field.required ? field.validate = true : null);

        if (type.every(field => !field.required ? true : field.required && field.valid ? true : false)) {
          if (this.authType == `new`) {
            if (this.createAccount == true) {
              const user = {
                email: ``,
                password: ``,
                firstName: ``,
                lastName: ``,
                phone: ``,
                country_id: ``,
                city: ``,
                street: ``,
                houseNumber: ``,
                subscription_status: this.subscribe
              };

              type.forEach(field => user[field.name] = field.value);

              this.$store.dispatch(`registrationUser`, user)
                .then(() => {
                  const user = {
                    email: type[0].value,
                    password: type[3].value
                  };

                  this.$store.dispatch(`getToken`, user)
                      .then(() => this.$store.getters.token)
                      .then((token) => this.$store.dispatch(`getUserByToken`, token))
                      .then(() => this.$router.push({name: `Payment`}))
                })
                .catch((err) => {
                  for (const key in err.errors) {
                    const findItem = type.find(item => item.name === key);

                    if (findItem) findItem.error = err.errors[key]
                  }
                })
            } else {
              const user = {
                email: type[0].value
              };

              this.$store.commit(`setUserByToken`, user)
              this.$router.push({name: `Payment`})
            }
          } else if (this.authType == `reg`) {
            const user = {
              email: type[0].value,
              password: type[1].value
            };

            this.$store.dispatch(`getToken`, user)
                .then(() => this.$store.getters.token)
                .then((token) => this.$store.dispatch(`getUserByToken`, token))
                .then(() => this.$router.push({name: `Payment`}))
            .catch((err) => {
              type.forEach(item => (item.error = err.message))
            })
          }
        } else {
          console.log(`Не верно заполнены данные`);
        }
      },
      submitForm() {
        console.log(`Submit`)
      }
    }
  }
</script>
