const createAlertElement = (type, message) => {
  const div = document.createElement(`div`);
  div.className = `alert alert-dismissible alert-${type}`;
  div.setAttribute(`role`, `alert`);
  div.innerHTML = `<button type="button" class="close" data-dismiss="alert" aria-label="Закрыть"><span aria-hidden="true">&times;</span></button>
    ${message}`;

  setTimeout(() => {
    div.remove();
  }, 2000);

  return div;
}

export function alertSuccess(message) {
  return createAlertElement(`success`, message);
}

export function alertError(message) {
  return createAlertElement(`danger`, message);
}
