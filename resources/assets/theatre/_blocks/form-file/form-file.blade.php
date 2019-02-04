{{ Form::open( ['method' => 'PUT', 'url' => 'send-profile', 'files'=>true, 'class' => 'form', 'name'=> 'contact', 'data-form-validate']) }}
  <label class="form__label">
    <input class="form__input" type="text" minlength="2" name="name" pattern="^([A-Za-zА-Яа-яЁё\s]{2,})*$" required>
    <span class="form__input-text">Имя*</span>
  </label>
  <label class="form__label">
    <input class="form__input" type="email" pattern="^[a-zA-Z0-9.!#$%&’*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$" name="email" required>
    <span class="form__input-text">Email*</span>
  </label>
  <label class="form__label">
    <input class="form__input" type="tel" name="phone" minlength="5" pattern="(\+38)\s(\([0-9]{3}\))\s([0-9]{3})\s([0-9]{2})\s([0-9]{2})$" required>
    <span class="form__input-text">Тел*</span>
  </label>
  <div class="form__field">
    <label class="form__label form__label--file">
      <input type="file" name="file" class="form__input-file" accept="application/pdf">
      <span type="button" class="form__btn-file">Загрузить резюме</span>
    </label>
  </div>
  <button type="submit" class="btn-more btn-more--long btn-more--uppercase btn-more--gold">Отправить сообщение</button>
</form>
