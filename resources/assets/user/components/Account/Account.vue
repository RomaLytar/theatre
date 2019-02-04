<template>
  <div class="wrap">
    <div class="wrap-user user" v-if="user">
      <h1 class="title-main">{{ translation.myAccount[documentLang] }}</h1>

      <div class="user__block-border">
        <button
          type="button"
          class="btn btn--full btn--account"
          @click="logout"
          :disabled="$store.getters.loading"
        >{{ translation.logout[documentLang] }}</button>
      </div>

      <div class="user__block-border user__block-text">
        <h2 class="title">{{ translation.myOrders[documentLang] }}</h2>
        <p>{{ translation.hereYouSeeYourOrders[documentLang] }}</p>
        <router-link
          class="btn btn--full btn--account"
          :to="{ name: 'Orders'}"
        >{{ translation.seeOrders[documentLang] }}</router-link>
      </div>

      <div class="user__block-border">
        <h2 class="title">{{ translation.myProfile[documentLang] }}</h2>
        <div class="form" @submit.prevent="sendData">
          <div class="form__fields form__fields--account">
            <app-input-disabled :obj="userFullName">
              {{ userFullName.label }}
            </app-input-disabled>

            <div v-if="!changeProfile">
              <app-input-disabled
                v-for="(field, index) in userProfileFields"
                :obj="field"
                :key="field.label">
                {{ field.label }}
              </app-input-disabled>
              <button
                type="button"
                class="btn btn--full btn--account"
                @click="changeProfile = !changeProfile"
              >{{ translation.changeProfile[documentLang] }}</button>
            </div>

            <div v-else>
              <component
                v-for="(field, index) in userProfileFields"
                :is="field.component"
                :obj="field"
                @update="updateField('userProfileFields', index, $event)"
                :key="field.label"
              >
                {{ field.label }}
                <p slot="error" v-if="field.error">{{field.error[0]}}</p>
              </component>

              <div class="user__btns">
                <button-loader
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @send-data="sendData(userProfileFields, 'changeProfile')"
                >
                  {{ translation.save[documentLang] }}
                </button-loader>
                <button
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @click="resetData(userProfileFields, 'changeProfile')"
                >{{ translation.cancel[documentLang] }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="user__block-border">
        <h2 class="title">{{ translation.dataForAuth[documentLang] }}</h2>
        <div class="form" @submit.prevent="sendData">
          <div class="form__fields form__fields--account">
            <app-input-disabled :obj="userEmail">
              {{ userEmail.label }}
            </app-input-disabled>

            <div v-if="!changeAuth">
              <app-input-disabled
                v-for="(field, index) in userAuthFields"
                :obj="field"
                :key="field.label">
                {{ field.label }}
              </app-input-disabled>
              <button
                type="button"
                class="btn btn--full btn--account"
                @click="changeAuth = !changeAuth"
              >{{ translation.changeData[documentLang] }}</button>
            </div>

            <div v-else>
              <app-input
                v-for="(field, index) in userAuthFields"
                :obj="field"
                @update="updateField('userAuthFields', index, $event)"
                :key="field.label">
                {{ field.label }}
                <p slot="error" v-if="field.error">{{field.error[0]}}</p>
              </app-input>
              <div class="user__btns">
                <button-loader
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @send-data="sendData(userAuthFields, 'changeAuth')"
                >
                  {{ translation.save[documentLang] }}
                </button-loader>
                <button
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @click="resetData(userAuthFields, 'changeAuth')"
                >{{ translation.cancel[documentLang] }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="user__block-border">
        <h2 class="title">{{ translation.password[documentLang] }}</h2>
        <div class="form" @submit.prevent="sendData">
          <div class="form__fields form__fields--account">
            <div v-if="!changePassword">
              <button
                type="button"
                class="btn btn--full btn--account"
                @click="changePassword = !changePassword"
              >{{ translation.changePassword[documentLang] }}</button>
            </div>

            <div v-else>
              <app-input
                v-for="(field, index) in userPasswordFields"
                :obj="field"
                @update="updateField('userPasswordFields', index, $event)"
                :key="field.label">
                {{ field.label }}
                <p slot="error" v-if="field.error">{{field.error}}</p>
              </app-input>
              <div class="user__btns">
                <button-loader
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @send-data="sendData(userPasswordFields, 'changePassword')"
                >
                  {{ translation.save[documentLang] }}
                </button-loader>
                <button
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @click="changePassword = !changePassword"
                >{{ translation.cancel[documentLang] }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="user__block-border">
        <h2 class="title">Email {{ translation.address[documentLang] }}</h2>
        <div class="form" @submit.prevent="sendData">
          <div class="form__fields">
            <app-input-disabled :obj="userEmail">
              {{ userEmail.label }}
            </app-input-disabled>
            <div v-if="!changeEmail">
              <button
                type="button"
                class="btn btn--full btn--account"
                @click="changeEmail = !changeEmail"
              >{{ translation.change[documentLang] }}</button>
            </div>

            <div v-else>
              <app-input
                v-for="(field, index) in userEmailFields"
                :obj="field"
                @update="updateField('userEmailFields', index, $event)"
                :key="field.label">
                {{ field.label }}
                <p slot="error" v-if="field.error">{{field.error[0]}}</p>
              </app-input>
              <div class="user__btns">
                <button-loader
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @send-data="sendData(userEmailFields, 'changeEmail')"
                >
                  {{ translation.change[documentLang] }}
                </button-loader>

                <button
                  type="submit"
                  class="btn btn--full btn--account"
                  :disabled="$store.getters.loading"
                  @click="changeEmail = !changeEmail"
                >{{ translation.cancel[documentLang] }}</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import translation from "../../mixins/translation"
  import AppInput from "../Input/Input"
  import ButtonLoader from "../ButtonLoader/ButtonLoader"
  import AppInputDisabled from "../Input/InputDisabled"
  import Country from "../Country/Country"

  export default {
    mixins: [translation],
    created() {
      // Profile fields
      this.userFullName.value = `${this.user.firstName} ${this.user.lastName}`;

      this.userProfileFields.forEach(item => {
        const userValue = this.user[item.name];

        item.value = userValue;
        item.valueOld = userValue;
      });

      // Auth fields
      this.userEmail.value = this.user.email;

      this.userAuthFields.forEach(item => {
        const userValue = this.user[item.name]

        item.value = userValue;
        item.valueOld = userValue;
      });

      if (!this.$store.getters.countries.length) {
        this.$store.dispatch(`getCountries`)
        .then(() => {
          this.setCountryName();
        })
        .catch((err) => console.log(err))
      } else {
        this.setCountryName();
      }

      this.userFullName.label = this.translation.fullName[this.documentLang];
      this.userProfileFields[0].label = this.translation.street[this.documentLang];
      this.userProfileFields[1].label = this.translation.houseNumber[this.documentLang];
      this.userProfileFields[2].label = this.translation.city[this.documentLang];
      this.userProfileFields[3].label = this.translation.country[this.documentLang];
      this.userProfileFields[4].label = this.translation.phoneNumber[this.documentLang];

      this.userAuthFields[0].label = this.translation.userName[this.documentLang];

      this.userPasswordFields[0].label = this.translation.currentPassword[this.documentLang];
      this.userPasswordFields[1].label = this.translation.newPassword[this.documentLang];
      this.userPasswordFields[2].label = this.translation.newPasswordConfirm[this.documentLang];

      this.userEmailFields[0].label = this.translation.newEmail[this.documentLang];
    },
    data() {
      return {
        changeProfile: false,
        changeAuth: false,
        changePassword: false,
        changeEmail: false,
        userFullName: {
          value: ``,
          label: `Имя Фамилия`
        },
        userProfileFields: [
          {
            value: ``,
            valueOld: ``,
            valid: false,
            label: `Улица`,
            type: `text`,
            name: `street`,
            error: ``,
            component: `AppInput`,
            regExp: /./,
          },
          {
            value: ``,
            valueOld: ``,
            valid: false,
            label: `№ дома`,
            type: `text`,
            name: `houseNumber`,
            error: ``,
            component: `AppInput`,
            regExp: /./,
          },
          {
            value: ``,
            valueOld: ``,
            valid: false,
            label: `Город`,
            type: `text`,
            name: `city`,
            error: ``,
            component: `AppInput`,
            regExp: /./,
          },
          {
            value: ``,
            valueOld: ``,
            valid: false,
            label: `Страна`,
            textName: ``,
            type: `text`,
            name: `country_id`,
            component: `Country`,
            error: ``,
            regExp: /./,
          },
          {
            value: ``,
            valueOld: ``,
            valid: false,
            validate: false,
            label: `№ телефона*`,
            type: `tel`,
            name: `phone`,
            required: true,
            mask: ``,
            error: ``,
            component: `AppInput`,
            regExp: /^([0-9]{6,15})+$/,
          }
        ],
        userAuthFields: [
          {
            value: ``,
            valueOld: ``,
            valid: false,
            validate: false,
            label: `Имя пользователя`,
            type: `text`,
            name: `login`,
            required: true,
            error: ``,
            regExp: /./
          }
        ],
        userPasswordFields: [
          {
            value: ``,
            valid: false,
            validate: false,
            label: `Текущий пароль*`,
            type: `password`,
            name: `password`,
            required: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/
          },
          {
            value: ``,
            valid: false,
            validate: false,
            label: `Новый пароль*`,
            type: `password`,
            name: `password_new`,
            required: true,
            eyeVisiblity: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/
          },
          {
            value: ``,
            valid: false,
            validate: false,
            label: `Новый пароль (подтверждение)*`,
            type: `password`,
            name: `password_new_confirmation`,
            required: true,
            eyeVisiblity: true,
            error: ``,
            regExp: /^([A-Za-zА0-9]{6,50})+$/
          }
        ],
        userEmailFields: [
          {
            value: ``,
            valid: false,
            validate: false,
            emailLinkVisible: true,
            label: `Введите новый email*`,
            type: `email`,
            name: `email`,
            required: true,
            error: ``,
            regExp: /^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)+$/
          }
        ],
      }
    },
    computed: {
      user() {
        return this.$store.getters.user
      },
      userEmail() {
        return {
          value: this.user.email,
          label: `Email`
        }
      }
    },
    methods: {
      updateField(fieldsArr, i, event) {
        this[fieldsArr].splice(i, 1, event);
        this[fieldsArr][i].error = ``;
      },
      sendData(fieldsArr, typeFlag) {
        if (fieldsArr.every(field => {
            if (field.required) field.validate = true;
            if (!field.required) return true;

            if (field.required && field.valid) {
              return true
            } else {
              return false
            }
          })) {

          const user = {
            data: {
              login: this.user.login,
              email: this.user.email,
              firstName: this.user.firstName,
              lastName: this.user.lastName,
              phone: this.user.phone,
              country_id: this.user.country_id,
              city: this.user.city,
              street: this.user.street,
              houseNumber: this.user.houseNumber
            },
            token: this.$store.getters.token
          };

          if (fieldsArr === this.userPasswordFields) {
            if (this.userPasswordFields[1].value !== this.userPasswordFields[2].value) {
              this.userPasswordFields[1].error = this.translation.passwordNotEqual[this.documentLang];
              this.userPasswordFields[2].error = this.translation.passwordNotEqual[this.documentLang];

              return false;
            }
          }

          fieldsArr.forEach(field => user.data[field.name] = field.value);

          this.$store.dispatch(`updateProfile`, user)
          .then(() => {
            this[typeFlag] = !this[typeFlag];

            fieldsArr.forEach(field => {
              const userValue = this.$store.getters.user[field.name];

              field.value = userValue;
              field.valueOld = userValue;

              if (field.name === `country_id`) this.setCountryName();
            });
          })
          .catch((err) => {
            if (err.errors) {
              for (const key in err.errors) {
                fieldsArr.find(item => item.name === key).error = err.errors[key]
              }
            } else if (err.status === false) {
              fieldsArr[0].error = err.message;
            }
          })
        } else {
          console.log(`Не верно заполнены данные`);
        }
      },
      resetData(fieldsArr, typeFlag) {
        fieldsArr.forEach(item => item.value = item.valueOld);

        this[typeFlag] = !this[typeFlag];
      },
      logout() {
        this.$store.dispatch(`logoutUser`)
        .then(() => this.$router.push({name: `Authorization`}))
        .catch((err) => {
          console.dir(err)
        });
      },
      setCountryName() {
        const countryObj = this.userProfileFields.find(item => item.name === `country_id`);

        countryObj.textName = this.$store.getters.countries.find(item => item.id == countryObj.value).country_name;
      }
    },
    components: {
      AppInput,
      AppInputDisabled,
      ButtonLoader,
      Country
    }
  }
</script>

