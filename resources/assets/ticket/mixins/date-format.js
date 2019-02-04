export default {
  computed: {
    getWeekday() {
      const formatter = new Intl.DateTimeFormat(this.documentLangForDate, {
        weekday: `long`
      });

      return formatter.format(new Date(this.dateForFormat)).charAt(0).toUpperCase() + formatter.format(new Date(this.dateForFormat)).slice(1);
    },
    getDate() {
      if (this.documentLangForDate == `en-US`) {
        const formatterMonth = new Intl.DateTimeFormat(this.documentLangForDate, {
                month: `long`
              }),
              formatterDay = new Intl.DateTimeFormat(this.documentLangForDate, {
                day: `numeric`
              });

        return `${formatterDay.format(new Date(this.dateForFormat))} ${formatterMonth.format(new Date(this.dateForFormat))}`;
      } else {
        const formatter = new Intl.DateTimeFormat(this.documentLangForDate, {
          month: `long`,
          day: `numeric`
        });

        return formatter.format(new Date(this.dateForFormat));
      }

    },
    getHours() {
      const formatter = new Intl.DateTimeFormat(this.documentLangForDate, {
        hour: `numeric`,
        hour12: false
      });

      return formatter.format(new Date(this.dateForFormat));
    },
    getMinutes() {
      const formatter = new Intl.DateTimeFormat(this.documentLangForDate, {
        minute: `numeric`
      });

      return formatter.format(new Date(this.dateForFormat));
    },
    documentLangForDate() {
      if (this.documentLang == `ua`) {
        return `uk`
      } else if (this.documentLang == `en`) {
        return `en-US`
      }

      return this.documentLang
    },
    documentLang() {
      return this.$store.getters.documentLang
    }
  }
}
