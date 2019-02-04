export default {
  state: {
    documentLang: document.documentElement.getAttribute(`lang`),
    windowWidth: window.innerWidth,
    translation: {
      row: {
        ru: `Ряд`,
        en: `Row`,
        ua: `Ряд`
      },
      seat: {
        ru: `Место`,
        en: `Place`,
        ua: `Місце`
      },
      ticket: {
        ru: `Билет`,
        en: `Ticket`,
        ua: `Квиток`
      },
      download: {
        ru: `Скачать`,
        en: `Download`,
        ua: `Завантажити`
      },
      close: {
        ru: `Закрыть`,
        en: `Close`,
        ua: `Закрити`
      },
      back: {
        ru: `Вернуться назад`,
        en: `Go back`,
        ua: `Повернутися назад`
      },
      ordersHistory: {
        ru: `История заказов`,
        en: `Orders history`,
        ua: `Історія замовлень`
      },
      ordersHistoryText: [
        {
          ru: `Вы можете просмотреть свои билеты на активные события ниже.`,
          en: `You can view your tickets for active events below.`,
          ua: `Ви можете переглянути свої квитки на активні події нижче.`
        },
        {
          ru: `Если Вы желаете просмотреть историю заказов билетов на прошедшие события нажмите кнопку Архив.`,
          en: `If you want to view the history of orders for tickets to past events, click the Archive button.`,
          ua: `Якщо Ви бажаєте переглянути історію замовлень квитків на минулі події натисніть кнопку Архів.`
        }
      ],
      notActiveOrders: {
        ru: `Для вашего аккаунта нет активных заказов`,
        en: `There are no active orders for your account.`,
        ua: `Для вашого облікового запису немає активних замовлень`
      },
      archive: {
        ru: `Архив`,
        en: `Archive`,
        ua: `Архів`
      },
      ordersArchive: {
        ru: `Архив заказов`,
        en: `Orders archive`,
        ua: `Архів замовлень`
      },
      archiveEmpty: {
        ru: `В вашем архиве пусто`,
        en: `Your archive is empty`,
        ua: `У вашому архіві порожньо`
      },
      toOrdersHistory: {
        ru: `К истории заказов`,
        en: `To order history`,
        ua: `До історії замовлень`
      },
      clearArchive: {
        ru: `Очистить архив`,
        en: `Clear archive`,
        ua: `Очистити архів`
      },
      instructionAccountActivate: {
        ru: `Инструкция по активации аккаунта`,
        en: `Account activation instructions`,
        ua: `Інструкція по активації облікового запису`
      },
      instructionRecoveryPassword: {
        ru: `Инструкция по восстановлению пароля`,
        en: `Password Recovery Instructions`,
        ua: `Інструкція по відновленню пароля`
      },
      instructionAccountActivateText: [
        {
          ru: `На указанный адрес электронной почты будет отправлено электронное письмо с защищенной ссылкой.`,
          en: `An email will be sent to the specified email address with a secure link.`,
          ua: `На вказану адресу електронної пошти буде надіслано повідомлення електронної пошти з захищеної посиланням.`
        },
        {
          ru: `Проверьте свой электронный почтовый ящик и пройдите по ссылке.`,
          en: `Check your email inbox and follow the link.`,
          ua: `Перевірте свою електронну поштову скриньку і перейдіть по посиланню.`
        },
        {
          ru: `Если вы не получили это письмо, проверьте папку с нежелательной почтой.`,
          en: `If you have not received this email, check your junk mail folder.`,
          ua: `Якщо ви не отримали цей лист, перевірте папку з небажаною поштою.`
        },
        {
          ru: `Обратитесь за помощью в службу поддержки по телефону ХХХХХХХХХХХХ.`,
          en: `Contact the support service by calling XXXXXXXXXXX.`,
          ua: `Зверніться по допомогу в службу підтримки по телефону ХХХХХХХХХХХХ.`
        }
      ],
      yourAccountIsActivated: {
        ru: `Ваш аккаунт активирован`,
        en: `Your account is activated.`,
        ua: `Ваш аккаунт активований`
      },
      nowYouCan: {
        ru: `Теперь вы можете`,
        en: `Now you can`,
        ua: `Тепер ви можете`
      },
      authorizate: {
        ru: `авторизоваться`,
        en: `log in`,
        ua: `авторизуватись`
      },
      authorizateBig: {
        ru: `Авторизоваться`,
        en: `Log in`,
        ua: `Авторизуватись`
      },
      yourAccountWasActivatedEarly: {
        ru: `Ваш аккаунт был активирован ранее`,
        en: `Your account has been activated before.`,
        ua: `Ваш аккаунт був активований раніше`
      },
      please: {
        ru: `Пожалуйста`,
        en: `Please`,
        ua: `Будь ласка`
      },
      pleaseAuthorizate: {
        ru: `авторизуйтесь`,
        en: `log in`,
        ua: `авторизуйтесь`
      },
      yourDataIsInvalid: {
        ru: `Ваш данные для активации не действительны`,
        en: `Your activation data is not valid.`,
        ua: `Ваш дані для активації не дійсні`
      },
      pleaseRegistration: {
        ru: `зарегистрируйтесь`,
        en: `register`,
        ua: `зареєструйтеся`
      },
      clickOnButton: {
        ru: `Нажимая на кнопку`,
        en: `Pushing a button`,
        ua: `Натискаючи на кнопку`
      },
      youAgree: {
        ru: `Вы соглашаетесь с`,
        en: `You agree with`,
        ua: `Ви погоджуєтеся з`
      },
      conditions: {
        ru: `"Условиями обслуживания"`,
        en: `"Terms of service"`,
        ua: `"Умовами обслуговування"`
      },
      and: {
        ru: `и`,
        en: `and`,
        ua: `та`
      },
      politic: {
        ru: `"Политикой конфиденциальности"`,
        en: `"Privacy Policy"`,
        ua: `"Політикою конфіденційності"`
      },
      optional: {
        ru: `Опционно`,
        en: `Optional`,
        ua: `Опційно`
      },
      required: {
        ru: `Обязательно`,
        en: `Required`,
        ua: `Обов'язково`
      },
      chooseCountry: {
        ru: `Выбор страны`,
        en: `Country selection`,
        ua: `Вибір країни`
      },
      startEnter: {
        ru: `Начните ввод`,
        en: `Start typing`,
        ua: `Почніть вводити`
      },
      notFoundResults: {
        ru: `Не найдено результатов по`,
        en: `No results found for`,
        ua: `Не знайдено результатів за`
      },
      myAccount: {
        ru: `Мой аккаунт`,
        en: `My account`,
        ua: `Мій аккаунт`
      },
      logout: {
        ru: `Выйти`,
        en: `Log out`,
        ua: `Вийти`
      },
      myOrders: {
        ru: `Мои заказы`,
        en: `My orders`,
        ua: `Мої замовлення`
      },
      hereYouSeeYourOrders: {
        ru: `Здесь отображаются Ваши заказы`,
        en: `Your orders are displayed here.`,
        ua: `Тут відображаються Ваші замовлення`
      },
      seeOrders: {
        ru: `Посмотреть заказы`,
        en: `View orders`,
        ua: `Подивитися замовлення`
      },
      myProfile: {
        ru: `Мой профиль`,
        en: `My profile`,
        ua: `Мій профіль`
      },
      changeProfile: {
        ru: `Изменить профиль`,
        en: `Edit Profile`,
        ua: `Змінити профіль`
      },
      save: {
        ru: `Сохранить`,
        en: `Save`,
        ua: `Зберегти`
      },
      cancel: {
        ru: `Отмена`,
        en: `Cancel`,
        ua: `Скасувати`
      },
      dataForAuth: {
        ru: `Данные для авторизации`,
        en: `Data for authorization`,
        ua: `Дані для авторизації`
      },
      changeData: {
        ru: `Изменить данные`,
        en: `To change the data`,
        ua: `Змінити дані`
      },
      password: {
        ru: `Пароль`,
        en: `Password`,
        ua: `Пароль`
      },
      changePassword: {
        ru: `Изменить пароль`,
        en: `Change password`,
        ua: `Змінити пароль`
      },
      address: {
        ru: `адрес`,
        en: `address`,
        ua: `адреса`
      },
      change: {
        ru: `Изменить`,
        en: `Change`,
        ua: `Змінити`
      },

      // Data for fields
      fullName: {
        ru: `Имя Фамилия`,
        en: `Full Name`,
        ua: `Ім'я прізвище`
      },
      firstName: {
        ru: `Имя`,
        en: `Name`,
        ua: `Ім'я`
      },
      lastName: {
        ru: `Фамилия`,
        en: `Surname`,
        ua: `Прізвище`
      },
      street: {
        ru: `Улица`,
        en: `Street`,
        ua: `Вулиця`
      },
      houseNumber: {
        ru: `№ дома`,
        en: `№ house`,
        ua: `№ будинку`
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
      },
      phoneNumber: {
        ru: `№ телефона*`,
        en: `№ phone`,
        ua: `№ телефону*`
      },
      userName:  {
        ru: `Имя пользователя`,
        en: `Username`,
        ua: `Ім'я користувача`
      },
      currentPassword:  {
        ru: `Текущий пароль*`,
        en: `Current password*`,
        ua: `Поточний пароль*`
      },
      newPassword:  {
        ru: `Новый пароль*`,
        en: `New password*`,
        ua: `Новий пароль*`
      },
      newPasswordConfirm:  {
        ru: `Новый пароль (подтверждение)*`,
        en: `New password (confirmation) *`,
        ua: `Новий пароль (підтвердження) *`
      },
      newEmail:  {
        ru: `Введите новый email*`,
        en: `Enter new email *`,
        ua: `Введіть новий email *`
      },
      passwordNotEqual: {
        ru: `Пароли не равны`,
        en: `Passwords are not equal`,
        ua: `Паролі не рівні`
      },
      yandexAndMail:  {
        ru: `Владельцам ящиков яндекс и mail.ru`,
        en: `Yandex and mail.ru box owners`,
        ua: `Власникам ящиків яндекс і mail.ru`
      },
      notCorrectData:  {
        ru: `Некорректные данные`,
        en: `Incorrect data`,
        ua: `Некоректні дані`
      },
      forgotYourLoginOrPassword:  {
        ru: `Забыли ваш логин или пароль?`,
        en: `Forgot your username or password?`,
        ua: `Забули ваш логін або пароль?`
      },
      forgotYourLoginOrPasswordText:  {
        ru: `На указанный ниже адрес электронного почтового ящика будет выслана ссылка. Пожалуйста, проверьте Вашу почту и следуйте инструкциям для сброса пароля.`,
        en: `A link will be sent to the email address below. Please check your email and follow the instructions to reset your password.`,
        ua: `На вказаний нижче адресу електронної поштової скриньки буде вислано посилання. Будь ласка, перевірте Вашу пошту та дотримуйтесь інструкцій для скидання пароля.`
      },
      send: {
        ru: `Отправить`,
        en: `Send`,
        ua: `Надіслати`
      },
      your: {
        ru: `Ваш`,
        en: `Your`,
        ua: `Ваш`
      },
      registration: {
        ru: `Регистрация`,
        en: `Registration`,
        ua: `Реєстрація`
      },
      registrate: {
        ru: `Зарегистрироваться`,
        en: `Register`,
        ua: `зареєструватися`
      },
      alreadyRegistered: {
        ru: `Уже зарегистрированы?`,
        en: `Already a member?`,
        ua: `Вже зареєстровані?`
      },
      createAccount: {
        ru: `"Создать аккаунт"`,
        en: `"Create an account"`,
        ua: `"Створити аккаунт"`
      },
      createAccountPlease: {
        ru: `Создайте аккаунт на сайте CxidOpera чтобы удобным способом формировать Ваши заказы.`,
        en: `Create an account on the site CxidOpera to conveniently form your orders.`,
        ua: `Створіть акаунт на сайті CxidOpera щоб зручним способом формувати Ваші замовлення.`
      },
      ifYouAlreadyRegistered: {
        ru: `Если вы уже зарегистрированы, воспользуйтесь`,
        en: `If you are already registered, use`,
        ua: `Якщо ви вже зареєстровані, скористайтеся`
      },
      formEnter: {
        ru: `формой входа`,
        en: `login form`,
        ua: `формою входу`
      },
      subscribe: {
        ru: `Подписаться на получение информации о предстоящих событиях в CxidOpera`,
        en: `Subscribe to receive information about upcoming events at CxidOpera`,
        ua: `Підписатися на отримання інформації про майбутні події в CxidOpera`
      },
      yourPasswordChanged: {
        ru: `Ваш пароль изменен`,
        en: `Your password has been changed`,
        ua: `Ваш пароль змінено`
      },
      authorization: {
        ru: `Авторизация`,
        en: `Authorization`,
        ua: `Авторизація`
      },
      passwordRecoveryText: [
        {
          ru: `На указанный адрес электронной почты будет отправлено электронное письмо с защищенной ссылкой.`,
          en: `An email will be sent to the specified email address with a secure link.`,
          ua: `На вказану адресу електронної пошти буде надіслано повідомлення електронної пошти з захищеної посиланням.`
        },
        {
          ru: `Проверьте свой адрес электронной почты и следуйте инструкциям по сбросу пароля.`,
          en: `Check your email address and follow the instructions to reset your password.`,
          ua: `Перевірте свою адресу електронної пошти і дотримуйтесь інструкцій по скиданню пароля.`
        },
        {
          ru: `Если вы не получили это письмо, проверьте папку с нежелательной почтой.`,
          en: `If you have not received this email, check your junk mail folder.`,
          ua: `Якщо ви не отримали цей лист, перевірте папку з небажаною поштою.`
        },
        {
          ru: `Также проверьте, что введенный адрес электронной почты связан с Вашей учетной записью в CxidOpera.`,
          en: `Also verify that the entered email address is associated with your CxidOpera account.`,
          ua: `Також перевірте, що зазначену адресу електронної пошти пов'язаний з вашим профілем в CxidOpera.`
        },
        {
          ru: `Обратитесь за помощью в службу поддержки по телефону ХХХХХХХХХХХХ.`,
          en: `Contact the support service by calling XXXXXXXXXXX.`,
          ua: `Зверніться по допомогу в службу підтримки по телефону ХХХХХХХХХХХХ.`
        }
      ],
      authorizationText: {
        ru: `Пожалуйста, введите свои учётные данные для авторизации на сайте CxidOpera`,
        en: `Please enter your credentials for authorization on the CxidOpera website`,
        ua: `Будь ласка, введіть свої облікові дані для авторизації на сайті CxidOpera`
      },
      notRegistered: {
        ru: `Еще не зарегистрированы?`,
        en: `Not a member yet?`,
        ua: `Ще не зареєстровані?`
      },
      tokenNotValid: {
        ru: `Действие вашего токена закончилось. Отправьте форму смены пароля снова!`,
        en: `Your token has expired. Send the password change form again!`,
        ua: `Дія вашого токена закінчилося. Надішліть форму зміни пароля знову!`
      },
      passwordReset: {
        ru: `Сброс пароля`,
        en: `Password reset`,
        ua: `Скидання пароля`
      },
      savePassword: {
        ru: `Безопасный пароль соответствует следующим условиям:`,
        en: `A secure password meets the following conditions:`,
        ua: `Безпечний пароль відповідає таким умовам:`
      },
      savePasswordText: [
        {
          ru: `используйте как минимум 6 символов, лучше всего сочетать цифры и буквы.`,
          en: `use at least 6 characters, it is best to combine numbers and letters.`,
          ua: `використовуйте як мінімум 6 символів, найкраще поєднувати цифри та літери.`
        },
        {
          ru: `не используйте тот же пароль, который вы использовали ранее.`,
          en: `do not use the same password that you used before.`,
          ua: `не використовуйте той же пароль, який ви використовували раніше.`
        },
        {
          ru: `не используйте свое имя, адрес электронной почты или другую личную информацию, которую можно легко получить.`,
          en: `do not use your name, email address or other personal information that you can easily get.`,
          ua: `не використовуйте своє ім'я, адресу електронної пошти або іншу особисту інформацію, яку можна легко отримати.`
        },
        {
          ru: `не используйте один и тот же пароль для нескольких учетных записей онлайн.`,
          en: `do not use the same password for multiple online accounts.`,
          ua: `не використовуйте один і той же пароль для кількох облікових записів онлайн.`
        }
      ],
      exit: {
        ru: `Выйти`,
        en: `Logout`,
        ua: `Вийти`
      },
      enter: {
        ru: `Войти`,
        en: `Enter`,
        ua: `Ввiйти`
      }
    }
  },
  getters: {
    documentLang(state) {
      return state.documentLang
    },
    windowWidth(state) {
      return state.windowWidth
    },
    translation(state) {
      return state.translation
    }
  }
}
