<section class="form-contact">
  {{-- Вроди бы нигде не используется --}}
  <h2 class="form-contact__title">Вроди бы нигде не используется. Проверка</h2>
  <form class="form-contact__form" action="" method="POST" name="contact" data-form-validate>
    <label class="form-contact__label">
      <span class="form-contact__input-text">Имя</span>
      <input class="form-contact__input" type="text" minlength="2" pattern="^[A-Za-zА-Яа-яЁё]{2,}$" name="name" title="" required>
    </label>
    <label class="form-contact__label">
      <span class="form-contact__input-text">Email</span>
      <input class="form-contact__input" type="email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" name="email" required>
    </label>
    <label class="form-contact__label">
      <span class="form-contact__input-text">Телефон></span>
      <input class="form-contact__input" type="tel" name="tel" minlength="5" pattern="(\+[0-9])\s(\([0-9]{3}\))\s([0-9]{3})\s([0-9]{2})\s([0-9]{2})$" title="" required>
    </label>
    <label class="form-contact__label form-contact__label--full">
      <span class="form-contact__input-text">Текст сообщения</span>
      <textarea class="form-contact__textarea" type="text" name="message" title=""></textarea>
    </label>
    <button type="submit" class="btn">Отправить сообщение</button>
  </form>
</section>
