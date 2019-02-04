export default function kasirPricePatterns() {
  (() => {
    if(!document.querySelector(`#price-table`)) return false;
    const clearMessage = function () {
              [...document.querySelectorAll(`.alert`)].forEach((item) => item.style = `display: none`);
          },
          changeTitle = function(id, title) {
            [...document.querySelectorAll(`.global__table tbody tr`)].forEach((item) => {
              if (item.children[0].textContent === id){
                item.children[1].textContent = title;
              }
            })
          }


    $('[data-form-price-patterns="create"]').on('submit', function(e){
        e.preventDefault();
        const form = this;
        function message(flag, data){
            const alert = document.querySelector('#create .alert'),
                alertContent = alert.querySelector('.alert-content');

            alert.classList.remove(`alert-success`);
            alert.classList.remove(`alert-danger`);
            alertContent.innerHTML = "";

            if (flag) {
                alert.classList.add(`alert-success`);
                alertContent.textContent = `Ціновий шаблон ${data} створено`
            } else {
                alert.classList.add(`alert-danger`);
                const ul = document.createElement(`ul`);
                ul.style="margin:0;padding:0;list-style:none";
                for (const key in data.responseJSON.errors) {
                    ul.insertAdjacentHTML(`beforeEnd`, '<li>' + key + ': ' + data.responseJSON.errors[key] + '</li>');
                }
                alertContent.appendChild(ul);
            }

            $(alert).fadeIn();
        };

        $.ajax({
            url: this.action,
            method: 'POST',
            data: $(this).serialize(),
            success: function(dataServer) {
                const data = dataServer.data;
              // console.log(dataServer);


                const template = document.querySelector(`#template-create`).content.querySelector(`[data-tr-template]`).cloneNode(true);
                $(template).find('[data-td]').each(function(index, item){
                    const itemAttribute = item.getAttribute(`data-td`);
                        // console.log(itemAttribute);

                    if (itemAttribute === `color_code`) {
                      item.style.backgroundColor = data.color_code;
                        // console.log(data.color_code);
                    }
                    else if (itemAttribute === `edit`) {
                        item.setAttribute(`href`, item.getAttribute(`href`).replace(`current-id`, data.id));
                        // console.log(data.id);
                    } else if (itemAttribute === `delete`) {
                        item.setAttribute(`action`, item.getAttribute(`action`).replace(`current-id`, data.id));
                    } else if (itemAttribute === `settings`){
                        item.setAttribute(`href`, item.getAttribute(`href`).replace(`current-id`, data.id));
                    } else {
                        item.textContent = data[itemAttribute];
                    }
                });

                $('.global__table tbody').prepend(template);

                message(`success`, data.title);
                const input = form.querySelector(`#title`);

                input.value = ``;
                input.focus();
            },
            error: function(data){
                message(false, data);
            }
        })
    });
    $('#create').on('hidden.bs.modal', function (e) {
        clearMessage();
    });

    document.querySelector(`.global__table tbody`).addEventListener(`click`, (e) => {
      const target = e.target.closest(`[data-td="edit"]`),
            targetDelete = e.target.closest(`[data-td="delete"]`),
            targetTitle = $(target).closest(`tr`).find(`td`)[1];

      // console.log(targetTitle);

      if (target) {
        // console.log(`target`);
        e.preventDefault();
        const edit = $('#edit'),
              editForm = edit.find($(`form`)),
              editUrl = $(target).attr(`href`).slice(0, $(target).attr(`href`).lastIndexOf(`/`));

        editForm.attr(`action`, editUrl);
        editForm.attr(`method`, `PATCH`);


        edit.modal('show');

        $.ajax({
            // url:  $(target).attr(`href`).slice(0, $(target).attr(`href`).lastIndexOf(`/`)),
            url: target.getAttribute('href'),
            method: 'GET',
            success: function(dataServer) {
              const data = dataServer.data;
              // console.log("get data");
              // console.log(dataServer);

              for (const key in data) {
                const element = document.querySelector(`#edit .modal-content [name=${key}]`);

                if (element) {
                  element.value = data[key];
                }
              }

            },
            error: function(data){
                alert(`Обновіть сторінку`)
            }
        })
      }

      if (targetDelete) {
        $(targetDelete).on('submit', function(e){
          // console.log(`edit submit`);
            e.preventDefault();
            // console.log(`delete`);
            const form = this,
                  row = form.closest(`tr`);

            $.ajax({
              url: this.action,
              method: 'POST',
              data: $(this).serialize(),
              success: function(dataServer) {
                  const data = dataServer.data;
                  // console.log(dataServer);
                  row.remove();
              },
              error: function(data){
                  console.log(false, data);
              }
            })
        });
      }
    })

    $(`[data-form-price-patterns="edit"]`).on('submit', function(e){
      e.preventDefault();
      const form = this;
      function message(flag, data){
        const alert = document.querySelector('#edit .alert'),
              alertContent = alert.querySelector('.alert-content');

        alert.classList.remove(`alert-success`);
        alert.classList.remove(`alert-danger`);
        alertContent.innerHTML = "";

        if (flag) {
          alert.classList.add(`alert-success`);
          alertContent.textContent = `Ціновий шаблон ${data} змінено`;

          $(edit).modal('hide');
          $(edit).on('hidden.bs.modal', function (e) {
            clearMessage();
          });

        } else {
          alert.classList.add(`alert-danger`);
          const ul = document.createElement(`ul`);
          ul.style="margin:0;padding:0;list-style:none";
          for (const key in data.responseJSON.errors) {
              ul.insertAdjacentHTML(`beforeEnd`, '<li>' + key + ': ' + data.responseJSON.errors[key] + '</li>');
          }
          alertContent.appendChild(ul);
        }

        $(alert).fadeIn();
      };

      $.ajax({
        url: this.action,
        method: 'PATCH',
        data: $(this).serialize(),
        success: function(dataServer) {
          const data = dataServer.data;
          // console.log("set data");
          // console.log(dataServer);

          message(`success`, data.title);
          const input = form.querySelector(`#title`);

          input.value = ``;
          input.focus();

          changeTitle(this.url.slice(this.url.lastIndexOf(`/`) + 1), data.title);
        },
        error: function(data){
            message(false, data);
        }
      })
    });
  })();
}
