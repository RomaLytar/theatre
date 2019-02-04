(() => {
  const enter = document.querySelector(`[data-header-enter]`);

  if (!enter) return false;

  const token = localStorage.getItem(`token`);

  if (!token) return false;

  fetch(`/api/profile`, {
    method: `GET`,
    headers: {
      "Content-Type": `application/json`,
      "Accept": `application/json`,
      "Authorization": `Bearer ${token}`
    },
  })
  .then(response => response.json())
  .then(data => {
    if (!data.data) {
      throw data;
    }

    return data.data
  })
  .then(data => {
    const template = `
        <a href="#" class="header__exit" data-header-exit>
          <svg width="10" height="10">
            <use xlink:href="#icon-exit" />
          </svg>
          <span>${CONSTANT.EXIT[CONSTANT.LANG]}</span>
        </a>`;

    enter.querySelector(`span`).textContent = data.email;
    enter.insertAdjacentHTML(`afterEnd`, template);
  })
  .then(() => {
    const parent = document.querySelector(`[data-header-link]`);

    if (!parent) return false;

    parent.addEventListener(`click`, (e) => {
      const target = e.target.closest(`[data-header-exit]`);

      if (target) {
        e.preventDefault();

        fetch(`/api/logout`, {
          method: `POST`,
          headers: {
            "Content-Type": `application/json`,
            "Accept": `application/json`,
            "Authorization": `Bearer ${token}`
          }
        })
        .then(() => {
          localStorage.removeItem(`token`);

          parent.querySelector(`[data-header-exit]`).remove();
          enter.querySelector(`span`).textContent = CONSTANT.ENTER[CONSTANT.LANG];
        })
        .catch(error => console.log(error))
      }
    })
  })
  .catch(error => console.warn(`Your token is invalid`));
})();
