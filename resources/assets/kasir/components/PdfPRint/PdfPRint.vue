<template>
  <div class="pdf-print" id="pdf-print">
    <header class="header">
      <div class="logo">
        <img src="/design/img/logo/logo.svg" width="200" height="" alt="CXID OPERA">
        Електронний квиток
      </div>
      <div class="barcode"></div>
    </header>
    <div class="info-wrap">
      <section class="info">
        <h2 class="info-title">Роздрукуйте і пред'явіть весь лист на вході</h2>
        <p>Данный штрих-ко может быть использован только один раз.</p>
        <p>Не передавайте содержимое данного билета третьим лицам.</p>
        <p>Это может стать причиной того, что Вы не сможете осуществить вход на мероприятие.</p>
        <p>За сохранность данных продавец ответственности не несет.</p>
      </section>
      <section class="contacts">
        <h2 class="contacts-title">Контакты:</h2>
        <p>097 000 70 40</p>
      </section>
    </div>
    <section class="rules">
      <header class="rules-header">
        <p>Данный билет является входным и не подлежит обмену</p>
        <small>Обмен: Электронный билет является входным</small>
      </header>
      <p class="rules-title">Правила пребывания на мероприятии:</p>
      <ol class="rules-list">
        <li>Входной билет установленного вида является гарантией Вашего входа на мероприятие.</li>
        <li>Деньги за билет могут быть возвращены организатором лишь при условии наличия билета и только в случае отмены мероприятия. При осуществлении возврата билета, организатором производится возврат номинальной стоимости возвращаемого билета, комиссионный сбор возврата не подлежит.</li>
        <li>Посетители, которые нарушают данные Правила и не подчиняются требованиям официальных лиц, будут выведены за территорию проведения мероприятия без компенсации стоимости билета.</li>
      </ol>
    </section>

    <section class="ticket">
      <div class="ticket-main">
        <header>
          <div class="logo"><img src="/design/img/logo/logo.svg" width="200" alt="CXID OPERA"></div>
          <div class="barcode"></div>
        </header>
        <div class="ticket-info">
          <div class="ticket-left">
            <h2 class="ticket-name">Наталка-Полтавка</h2>
            <time class="ticket-date">15 января 2019 18:30</time>
            <p class="ticket-hall">Большой зал</p>
            <p class="ticket-place">Балкон II-го яруса, ряд: 10, место: 20</p>
          </div>
          <div class="ticket-right">
            <p class="ticket-cost">Стоимость билета: <span>200 грн</span></p>
            <p class="ticket-buyer">Покупатель: <span>B_E_A_R@ukr.net</span></p>
          </div>
        </div>
        <footer>
          <div class="ticket-number">
            Номер билета: <span>418808-447500</span>
          </div>
          <small class="ticket-site">theatre.loc</small>
        </footer>
      </div>
      <div class="ticket-spine">
        <div class="barcode"></div>
        <div class="ticket-number">
          Номер билета: <span>418808-447500</span>
        </div>
      </div>
    </section>
    <p class="copyright">&copy; 2019-2019 "CXID OPERA". Все права защищены</p>
  </div>
</template>

<style>
  .pdf-print {
    margin: 20px;
    border: 1px solid #666;
    padding: 15px 15px 0;
    font: 18px/24px "Times New Roman", serif;
    -webkit-print-color-adjust:exact;
  }

  .pdf-print .barcode {
    margin: 0 0 0 30px;
    background: #ccc;
    height: 50px;
    width: 300px;
  }

  .header {
    display: flex;
    align-items: flex-start;
    justify-content: space-around;
    margin: 0 0 30px;
  }

  .header .logo {
    width: 200px;
    height: auto;
    text-align: center;
    font-size: 16px;
    font-weight: 500;
  }

  .header img {
    width: 100%;
    height: auto;
    display: block;
    margin: 0 0 10px;
  }

  .info-wrap {
    display: flex;
    margin: 0 0 20px;
  }

  .info {
    flex-grow: 1;
    padding: 0 0 0 10px;
  }

  .info p {
    margin: 0;
  }

  .info-title {
    font-size: 22px;
    line-height: 30px;
    background: #333;
    color: #fff;
    margin: 0 0 10px -10px;
    font-weight: 400;
    padding: 10px 20px;
  }

  .contacts {
    flex-shrink: 0;
    font-size: 24px;
    line-height: 30px;
    color: #000;
    font-weight: 700;
    min-width: 250px;
  }

  .contacts p {
    margin: 0;
    padding: 0 30px;
    height: 100px;
    display: flex;
    align-items: center;
  }

  .contacts-title {
    padding: 10px 30px;
    line-height: 29px;
    margin: 0;
    font-size: 100%;
    font-weight: 700;
    border-bottom: 1px solid #333;
  }

  .rules {
    padding: 0 0 0 10px;
    margin: 0 0 100px;
  }

  .rules-header {
    color: #999;
    padding: 0 0 0 10px;
    font-size: 22px;
    margin: 0 0 10px;
  }

  .rules-header p {
    margin: 0;
  }

  .rules-header small {
    display: block;
    font-size: 70%;
  }

  .rules-title {
    margin: 0 0 10px;
    font-weight: 700;
    font-size: 22px;
  }

  .rules-list {
    list-style-position: inside;
    padding: 0;
  }

  .ticket {

  }

  .ticket-main {
    border: 1px solid #000;
    border-bottom-style: dashed;
    padding: 10px 10px 20px;
  }

  .ticket-main header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0 0 30px;
  }

  .ticket-main .logo {
    width: 150px;
    margin-right: auto;
  }

  .ticket-main .logo img {
    width: 100%;
    height: auto;
    display: block;
  }

  .ticket-info {
    display: flex;
    align-items: flex-start;
    margin: 0 0 40px;
  }

  .ticket-left {
    width: 50%;
  }

  .ticket-name {
    font-size: 24px;
    line-height: 1.4;
    font-weight: 700;
    margin: 0 0 10px;
  }

  .ticket-date {
    display: block;
    font-style: italic;
    margin: 0 0 10px;
  }

  .ticket-hall {
    font-size: 20px;
    font-weight: 700;
    margin: 0 0 5px;
  }

  .ticket-place {
    font-weight: 700;
    margin: 0;
  }

  .ticket-right {
    width: 50%;
    font-size: 20px;
  }

  .ticket-right span {
    font-weight: 700;
  }

  .ticket-cost {
    margin: 0 0 10px;
  }

  .ticket-buyer {
    margin: 0;
  }

  .ticket-main footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    font-size: 20px;
  }

  .ticket-number {
    margin: 0;
  }

  .ticket-number span {
    font-size: 24px;
    font-weight: 700;
    color: #666;
  }

  .ticket-site {
    text-decoration: underline;
    font-size: 100%;
  }

  .ticket-spine {
    border: 1px solid #000;
    border-top: none;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 30px;
  }

  .ticket-spine .barcode {
    margin: 0 30px 0 0;
  }

  .copyright {
    margin: 30px 0;
    text-align: center;
  }
</style>
