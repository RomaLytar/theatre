(() => {
  window.CONSTANT = {
    LANG: document.documentElement.lang.toLowerCase(),
    FORM: {
      MESSAGE: {
        ERROR: {
          EMAIL: {
            ru: `Пожалуйста, введите правильную почту`,
            en: `Please, enter a correct email address`,
            ua: `Будь ласка, введіть правильну пошту`
          },
          NAME: {
            ru: `Пожалуйста, введите правильное имя`,
            en: `Please, enter a correct name`,
            ua: `Будь ласка, введіть правильне ім'я`
          },
          NAME_LENGTH: {
            ru: `Имя должно быть минимум 2 символа!`,
            en: `Name must be at least 2 symbols!`,
            ua: `Iм'я повинно бути минімум 2 символа!`
          },
          TEL: {
            ru: `Пожалуйста, введите правильный телефон`,
            en: `Please, enter a correct phone number`,
            ua: `Будь ласка, введіть правильний телефон`
          }
        }
      },
      FEEDBACK: {
        ERROR: {
          ru: `Ваши данные не были переданы. Пожалуйста, попробуйте снова`,
          en: `Your data wasn't received. Please try again`,
          ua: `Ваші дані не були передані. Будь ласка, спробуйте знову`
        },
        OK: {
          ru: `Спасибо. Мы свяжемся с Вами в ближайшее время`,
          en: `Thank you. We will contact you shortly`,
          ua: `Дякуємо. Ми зв'яжемось з вами в найближчий час`
        }
      }
    },
    SEARCH: {
      DEFAULT: {
        ru: `Поиск`,
        en: `Search`,
        ua: `Пошук`
      },
      EMPTY: {
        ru: `По вашему запросу ничего не найдено`,
        en: `Nothing found on your request`,
        ua: `За вашим запитом нiчого не знайдено`
      },
      RESULT: {
        ru: `Результат поиска`,
        en: `Search results`,
        ua: `Результат пошуку`
      }
    },
    RESET_DATA: {
      ru: `Сбросить дату`,
      en: `Reset date`,
      ua: `Скасувати дату`
    },
    DAY: {
      0: {
        ru: `Воскресенье`,
        en: `Sunday`,
        ua: `Неділя`
      },
      1: {
        ru: `Понедельник`,
        en: `Monday`,
        ua: `Понеділок`
      },
      2: {
        ru: `Вторник`,
        en: `Tuesday`,
        ua: `Вівторок`
      },
      3: {
        ru: `Среда`,
        en: `Wednesday`,
        ua: `Середа`
      },
      4: {
        ru: `Четверг`,
        en: `Thursday`,
        ua: `Четвер`
      },
      5: {
        ru: `Пятница`,
        en: `Friday`,
        ua: `П'ятниця`
      },
      6: {
        ru: `Суббота`,
        en: `Saturday`,
        ua: `Субота`
      }
    },
    MONTH: {
      0: {
        ru: `Январь`,
        en: `January`,
        ua: `Січень`
      },
      1: {
        ru: `Февраль"`,
        en: `February`,
        ua: `Лютий`
      },
      2: {
        ru: `Март`,
        en: `March`,
        ua: `Березень`
      },
      3: {
        ru: `Апрель`,
        en: `April`,
        ua: `Квітень`
      },
      4: {
        ru: `Май`,
        en: `May`,
        ua: `Травень`
      },
      5: {
        ru: `Июнь`,
        en: `June`,
        ua: `Червень`
      },
      6: {
        ru: `Июль`,
        en: `July`,
        ua: `Липень`
      },
      7: {
        ru: `Август`,
        en: `August`,
        ua: `Серпень`
      },
      8: {
        ru: `Сентябрь`,
        en: `September`,
        ua: `Вересень`
      },
      9: {
        ru: `Октябрь`,
        en: `October`,
        ua: `Жовтень`
      },
      10: {
        ru: `Ноябрь`,
        en: `November`,
        ua: `Листопад`
      },
      11: {
        ru: `Декабрь`,
        en: `December`,
        ua: `Грудень`
      }
    },
    MONTH_GENITIVE: {
      0: {
        ru: `Января`,
        en: `January`,
        ua: `Січня`
      },
      1: {
        ru: `Февраля`,
        en: `February`,
        ua: `Лютого`
      },
      2: {
        ru: `Марта`,
        en: `March`,
        ua: `Березня`
      },
      3: {
        ru: `Апреля`,
        en: `April`,
        ua: `Квітня`
      },
      4: {
        ru: `Мая`,
        en: `May`,
        ua: `Травня`
      },
      5: {
        ru: `Июня`,
        en: `June`,
        ua: `Червня`
      },
      6: {
        ru: `Июля`,
        en: `July`,
        ua: `Липня`
      },
      7: {
        ru: `Августа`,
        en: `August`,
        ua: `Серпня`
      },
      8: {
        ru: `Сентября`,
        en: `September`,
        ua: `Вересня`
      },
      9: {
        ru: `Октября`,
        en: `October`,
        ua: `Жовтня`
      },
      10: {
        ru: `Ноября`,
        en: `November`,
        ua: `Листопада`
      },
      11: {
        ru: `Декабря`,
        en: `December`,
        ua: `Грудня`
      }
    },
    EVENT_TYPE: {
      opera: {
        ru: `Опера`,
        en: `Opera`,
        ua: `Опера`
      },
      ballet: {
        ru: `Балет`,
        en: `Ballet`,
        ua: `Балет`
      },
      concert: {
        ru: `Концерт`,
        en: `Concert`,
        ua: `Концерт`
      },
      children: {
        ru: `Детский спектакль`,
        en: `Children play`,
        ua: `Дитячий спектакль`
      },
      tour: {
        ru: `Гастроли на сцене`,
        en: `Touring on stage`,
        ua: `Гастролі на сцені`
      },
      festival: {
        ru: `Фестивальное событие`,
        en: `Festival event`,
        ua: `Фестивальна подія`
      },
      muzhab: {
        ru: `Молодежный музыкальный хаб`,
        en: `Youth musical hub`,
        ua: `Молодіжний музичний хаб`
      }
    },
    EVENT_TIME: {
      daytime: {
        ru: `Дневное`,
        en: `Morning`,
        ua: `Денне`
      },
      night: {
        ru: `Ночное`,
        en: `Evening`,
        ua: `Вечірнє`
      }
    },
    EVENT_SCENE: {
      big: {
        ru: `Большая сцена`,
        en: `Big scene`,
        ua: `Велика сцена`
      },
      small: {
        ru: `Малая сцена`,
        en: `Small scene`,
        ua: `Мала сцена`
      },
      open: {
        ru: `Открытая сцена`,
        en: `Open scene`,
        ua: `Відкрита сцена`
      },
      chamber: {
        ru: `Камерная сцена`,
        en: `Chamber scene`,
        ua: `Камерна сцена`
      },
      loft: {
        ru: `Loft сцена`,
        en: `Loft scene`,
        ua: `LOFT сцена`
      }
    },
    BUY_TICKET: {
      ru: `Купить билет`,
      en: `Buy ticket`,
      ua: `Купити квиток`
    },
    TICKETS_SOLD: {
      ru: `Билеты проданы`,
      en: `Tickets sold`,
      ua: `Квитки проданi`
    },
    TICKETS: {
      ru: `Билеты`,
      en: `Tickets`,
      ua: `Квитки`
    },
    UAH: {
      ru: `грн`,
      en: `uah`,
      ua: `грн`
    },
    FROM: {
      ru: `от`,
      en: `from`,
      ua: `вiд`
    },
    TO: {
      ru: `до`,
      en: `to`,
      ua: `до`
    },
    DAY_SPLIT: 10,
    EXIT: {
      ru: `Выйти`,
      en: `Logout`,
      ua: `Вийти`
    },
    ENTER: {
      ru: `Войти`,
      en: `Enter`,
      ua: `Ввiйти`
    }
  }
})();
