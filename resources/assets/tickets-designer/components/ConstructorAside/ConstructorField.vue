<template>
  <li
    class="constructor-field"
    @mouseenter="mouseEnter"
    @mouseleave="mouseLeave"
  >
    <div class="form-row">
      <div class="ml-auto" style="padding-right: 5px; line-height: 0">
        <CrossButton
          class="w-auto"
          @click="removeField"
          title="Видалити квиток"
        ></CrossButton>
      </div>
    </div>
    <div class="form-row align-items-end">
      <label class="form-group mb-0 col-12">
        <span>Поля</span>
        <select
          class="form-control form-control-sm"
          v-model="type"
        >
          <option value="name">Назва подии</option>
          <option value="date">Дата початку</option>
          <option value="time">Час початку</option>
          <option value="hall">Зала</option>
          <option value="sector">Сектор</option>
          <option value="row">Ряд</option>
          <option value="seat">Мисце</option>
          <option value="cost">Вартисть</option>
          <option value="barcode">Штрих-код</option>
          <option value="titcket-id">№ квитка</option>
        </select>
      </label>
      <label class="form-group mb-0 col-3">
        <span>Розмір</span>
        <input
          type="number"
          step="0.1"
          class="form-control form-control-sm"
          v-model.number="fontSize"
        >
      </label>
      <label class="form-group mb-0 col-5">
        <span>Тип шрифта</span>
        <select
          class="form-control form-control-sm"
          v-model="fontFamily"
        >
          <option value="Arial">Arial</option>
          <option value="Times New Roman">Times New Roman</option>
        </select>
      </label>
      <label class="form-group mb-0 col-2 constructor-field__label">
        <input
          type="checkbox"
          class="form-control form-control-sm"
          v-model="fontWeight"
        >
        <span class="constructor-field__text-icon">B</span>
      </label>
      <label class="form-group mb-0 col-2 constructor-field__label">
        <input
          type="checkbox"
          class="form-control form-control-sm"
          v-model="textDecoration"
        >
        <span class="constructor-field__text-icon">U</span>
      </label>

      <label class="form-group col-3 mb-0">
        <span>X</span>
        <input
          type="number"
          class="form-control form-control-sm"
          v-model.number="posX"
        >
      </label>
      <label class="form-group col-3 mb-0">
        <span>Y</span>
        <input
          type="number"
          class="form-control form-control-sm"
          v-model.number="posY"
        >
      </label>
      <label class="form-group col-3 mb-0">
        <span>Кут</span>
        <input
          type="number"
          class="form-control form-control-sm"
          v-model.number="angle"
        >
      </label>
      <label class="form-group col-3 mb-0">
        <span>Строка</span>
        <input
          type="number"
          step="0.1"
          class="form-control form-control-sm"
          v-model.number="lineHeight"
        >
      </label>

      <label class="form-group col-12 mb-0">
        <span>Текст</span>
        <textarea
          type="text"
          class="form-control form-control-sm"
          v-model="text"
        ></textarea>
      </label>
    </div>
  </li>
</template>

<script>
  import CrossButton from "../common/CrossButton"

  export default {
    components: {
      CrossButton
    },
    props: {
      field: {
        type: Object,
        required: true
      }
    },
    computed: {
      text: {
        get() {
          return this.field.text
        },
        set(value) {
          this.changeField(`text`, value);
        }
      },
      posX: {
        get() {
          return this.field.posX
        },
        set(value) {
          this.changeField(`posX`, value);
        }
      },
      posY: {
        get() {
          return this.field.posY
        },
        set(value) {
          this.changeField(`posY`, value);
        }
      },
      angle: {
        get() {
          return this.field.angle
        },
        set(value) {
          this.changeField(`angle`, value);
        }
      },
      type: {
        get() {
          return this.field.type
        },
        set(value) {
          this.changeField(`type`, value);
        }
      },
      fontFamily: {
        get() {
          return this.field.fontFamily
        },
        set(value) {
          this.changeField(`fontFamily`, value);
        }
      },
      fontSize: {
        get() {
          return this.field.fontSize
        },
        set(value) {
          this.changeField(`fontSize`, value);
        }
      },
      fontWeight: {
        get() {
          return this.field.fontWeight
        },
        set(value) {
          this.changeField(`fontWeight`, value);
        }
      },
      lineHeight: {
        get() {
          return this.field.lineHeight
        },
        set(value) {
          this.changeField(`lineHeight`, value);
        }
      },
      textDecoration: {
        get() {
          return this.field.textDecoration
        },
        set(value) {
          this.changeField(`textDecoration`, value);
        }
      }
    },
    methods: {
      removeField() {
        this.$store.commit(`removeTicketField`, this.field.id)
      },
      changeField(type, value) {
        this.$store.commit(`changeTicketField`, {
          field: this.field,
          type,
          value
        })
      },
      mouseEnter() {
        this.$store.commit(`setActiveId`, this.field.id)
      },
      mouseLeave() {
        this.$store.commit(`setActiveId`, null)
      }
    }
  }
</script>
