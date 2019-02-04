<template>
  <div class="constructor-fields">
    <p>Поля для відображення:</p>
    <div class="constructor-fields__wrap mb-3">
      <ConstructorFieldsList
        class="mb-3"
        v-if="ticketFieldsLength"
      ></ConstructorFieldsList>
      <button
        type="button"
        class="btn btn-primary"
        @click="addField"
      >Додати поле</button>
    </div>
    <div class="d-flex justify-content-between">
      <ButtonLoader
        class="btn btn-success"
        @click="saveTicket"
        :load="saveTicketLoad"
      >Зберегти</ButtonLoader>
      <ButtonLoader
        class="btn btn-danger"
        @click="resetTicket"
        :load="saveTicketLoad"
      >Відмінити</ButtonLoader>
    </div>
  </div>
</template>

<script>
import ConstructorFieldsList from "./ConstructorFieldsList"
import ButtonLoader from "../../../kasir/components/Common/ButtonLoader/ButtonLoader"

export default {
  components: {
    ConstructorFieldsList,
    ButtonLoader
  },
  created() {
    if (this.$route.params.id) {
      if (this.ticketFieldsLength) {
        this.id = this.ticketFields[this.ticketFieldsLength - 1].id + 1;
      }

      this.edit = true;
    }
  },
  data() {
    return {
      id: 0,
      saveTicketLoad: false,
      edit: false
    }
  },
  computed: {
    ticketFields() {
      return this.$store.getters.getTicketFields
    },
    ticketFieldsLength() {
      return this.ticketFields.length
    }
  },
  methods: {
    saveTicket() {
      this.saveTicketLoad = true;

      const data = new FormData(document.forms.ticket);

      data.append(`title`, this.$store.getters.getName);
      data.append(`json_code`, JSON.stringify(this.$store.getters.getTicketFields));
      data.append(`width`, this.$store.getters.getWidth);
      data.append(`height`, this.$store.getters.getHeight);
      data.append(`is_active_cash_box`, 1);
      data.append(`is_active_online`, 0);

      if (this.edit) {
        data.append("_method", "PUT");

        this.$store.dispatch(`updateTicket`, {id: this.$route.params.id, data: data})
        .then(data => this.saveTicketLoad = false)
        .catch(err => {
          console.warn(err);
          this.saveTicketLoad = false;
        })
      } else {
        this.$store.dispatch(`saveTicket`, data)
        .then(data => {
          this.saveTicketLoad = false;
          this.$router.push({name: `TicketsList`})
        })
        .catch(err => {
          console.warn(err);
          this.saveTicketLoad = false;
        })
      }
    },
    resetTicket() {
      this.$store.commit(`resetTicket`);
    },
    addField() {
      const ticket = {
        text: `Текст`,
        type: `name`,
        id: this.id,
        posX: 20,
        posY: 20,
        angle: 0,
        fontFamily: `Arial`,
        fontSize: `5`,
        fontWeight: false,
        textDecoration: false,
        width: 100,
        height: 30,
        lineHeight: 1.5
      };

      this.$store.commit(`addTicketField`, ticket);
      this.id++;
    }
  }
}
</script>
