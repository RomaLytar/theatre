<template>
  <div class="wrap">
    <div class="wrap-user">
      <h1 class="title-main">
        {{ translation.registration[documentLang] }}
        <router-link :to="{name: 'Authorization'}" class="text-link">{{ translation.alreadyRegistered[documentLang] }}</router-link>
      </h1>
      <div class="text text--reg">
        <p>{{ translation.createAccountPlease[documentLang] }}</p>
        <p>{{ translation.ifYouAlreadyRegistered[documentLang] }} <router-link :to="{name: 'Authorization'}" class="link">{{ translation.formEnter[documentLang] }}</router-link></p>
      </div>
      <form action="" class="form" @submit.prevent="sendData">
        <div class="form__fields">
          <component
            v-for="(field, index) in userRegFields"
            :is="field.component"
            :obj="field"
            @update="updateField(index, $event)"
            :key="index"
          >
            {{ field.label }}
            <p slot="error" v-if="field.error">{{field.error[0]}}</p>
          </component>
        </div>

        <app-checkbox v-model="subscribe">
          {{ translation.subscribe[documentLang] }}
        </app-checkbox>

        <conditions>
          <span slot="buttonName">{{ translation.createAccount[documentLang] }}</span>
        </conditions>

        <button-loader
          type="submit"
          class="btn btn--full"
          :disabled="$store.getters.loading"
        >
          {{ translation.registrate[documentLang] }}
        </button-loader>
      </form>
    </div>
  </div>
</template>

<script>
  import translation from "../../../mixins/translation"
  import AppInput from "../../Input/Input"
  import AppCheckbox from "../../Checkbox/Checkbox"
  import ButtonLoader from "../../ButtonLoader/ButtonLoader"
  import Conditions from "../../Conditions/Conditions"
  import Country from "../../Country/Country"

  export default {
    mixins: [translation],
    created() {
      this.userRegFields.forEach(field => {
        const value = sessionStorage.getItem(field.fieldName);

        field.value = value ? value : ``;
      });

      this.userRegFields[0].label = `${this.translation.firstName[this.documentLang]}*`;
      this.userRegFields[1].label = `${this.translation.lastName[this.documentLang]}*`;
      this.userRegFields[2].label = `${this.translation.lastName[this.documentLang]} email* (example@email.ua)`;
      this.userRegFields[3].label = `${this.translation.password[this.documentLang]}*`;
      this.userRegFields[4].label = this.translation.phoneNumber[this.documentLang];
      this.userRegFields[5].label = this.translation.country[this.documentLang];
      this.userRegFields[6].label = this.translation.city[this.documentLang];
      this.userRegFields[7].label = this.translation.street[this.documentLang];
      this.userRegFields[8].label = this.translation.houseNumber[this.documentLang];
    },
    data() {
      return {
        userRegFields: [
          {
            fieldName: `userRegName`,
            value: ``,
            valid: false,
            validate: false,
            label: `Имя*`,
            type: `text`,
            name: `firstName`,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА-Яа-яЁё@\.]{2,50})+$/,
            component: `AppInput`
          },
          {
            fieldName: `userRegSurname`,
            value: ``,
            valid: false,
            validate: false,
            label: `Фамилия*`,
            type: `text`,
            name: `lastName`,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА-Яа-яЁё@\.]{2,50})+$/,
            component: `AppInput`
          },
          {
            fieldName: `userRegEmail`,
            value: ``,
            valid: false,
            validate: false,
            emailLinkVisible: true,
            label: `Ваш email* (example@email.ua)`,
            type: `email`,
            name: `email`,
            required: true,
            error: ``,
            regExp: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/,
            component: `AppInput`
          },
          {
            fieldName: `userRegPassword`,
            value: ``,
            valid: false,
            validate: false,
            label: `Пароль*`,
            type: `password`,
            name: `password`,
            required: true,
            eyeVisiblity: true,
            lineField: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/,
            component: `AppInput`
          },
          {
            fieldName: `userRegPhone`,
            value: ``,
            valid: false,
            validate: false,
            label: `№ телефона*`,
            type: `tel`,
            name: `phone`,
            required: true,
            mask: ``,
            error: ``,
            regExp: /^([0-9]{6,15})+$/,
            component: `AppInput`
          },
          {
            fieldName: `userRegCountry`,
            value: ``,
            valid: false,
            label: `Страна`,
            type: `text`,
            name: `country_id`,
            error: ``,
            component: `Country`,
            regExp: /./,
          },
          {
            fieldName: `userRegCity`,
            value: ``,
            valid: false,
            label: `Город`,
            type: `text`,
            name: `city`,
            error: ``,
            regExp: /./,
            component: `AppInput`
          },
          {
            fieldName: `userRegStreet`,
            value: ``,
            valid: false,
            label: `Улица`,
            type: `text`,
            name: `street`,
            error: ``,
            regExp: /./,
            component: `AppInput`
          },
          {
            fieldName: `userRegHouse`,
            value: ``,
            valid: false,
            label: `№ дома`,
            type: `text`,
            name: `houseNumber`,
            error: ``,
            regExp: /./,
            component: `AppInput`
          }
        ],
        subscribe: false
      }
    },
    methods: {
      sendData() {
        if (this.userRegFields.every(field => {
            if (field.required) field.validate = true;
            if (!field.required) return true;

            if (field.required && field.valid) {
              return true
            } else {
              return false
            }
          })) {
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

          this.userRegFields.forEach(field => user[field.name] = field.value);

          this.$store.dispatch(`registrationUser`, user)
          .then(() => this.$router.push({name: `AccountActivate`}))
          .catch((err) => {
            for (const key in err.errors) {
              this.userRegFields.find(item => item.name === key).error = err.errors[key]
            }
          })
        } else {
          console.log(`Не верно заполнены данные`);
        }
      },
      updateField(i, event) {
        this.userRegFields.splice(i, 1, event);
        this.writeToSessionStorage(i, event);
      },
      writeToSessionStorage(i, event) {
        const key = this.userRegFields[i].fieldName,
              value = event.value;

        sessionStorage.setItem(key, value)
      }
    },
    components: {
      AppInput,
      AppCheckbox,
      ButtonLoader,
      Conditions,
      Country
    }
  }
</script>
