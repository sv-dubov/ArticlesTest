"use strict";

// Step switcher
var current_step = 0;
var nextStepBtns = document.querySelectorAll('.next-step'),
  prevStepBtns = document.querySelectorAll('.prev-step'),
  btnsEditStep = document.querySelectorAll('.btn-edit-step'),
  stepBlocks = document.querySelectorAll('.checkout-steps .step'),
  totalStep = stepBlocks.length,
  form = document.querySelector('#form-checkout');
form.addEventListener('submit', function (e) {
  e.preventDefault();
});
if (nextStepBtns.length > 0) {
  nextStepBtns.forEach(function (btn_next) {
    btn_next.addEventListener('click', function () {
      console.log(btn_next.type);
      if (btn_next.type === 'submit') {
        btn_next.classList.add('disabled');
        // Відпарвка форми
        if (validateForm(form)) {
          setTimeout(function () {
            btn_next.classList.remove('disabled');
            form.submit();
          }, 1000);
        }
        return;
      }
      if (!validateForm(stepBlocks[current_step])) return;
      removeClass(stepBlocks, 'active');
      stepBlocks[current_step + 1].classList.add('active');
      switch (current_step) {
        case 0:
          generatePreviewContact(current_step);
          stepBlocks[current_step].classList.add('show-preview');
          break;
        case 1:
          generatePreviewDelivery(current_step);
          stepBlocks[current_step].classList.add('show-preview');
          break;
        case 2:
          break;
      }
      current_step += 1;
    });
  });
}
if (prevStepBtns.length > 0) {
  prevStepBtns.forEach(function (btn_prev) {
    btn_prev.addEventListener('click', function () {
      removeClass(stepBlocks, 'active');
      stepBlocks[current_step - 1].classList.add('active');
      stepBlocks[current_step].classList.remove('show-preview');
      stepBlocks[current_step - 1].classList.remove('show-preview');
      current_step -= 1;
    });
  });
}
if (btnsEditStep.length > 0) {
  btnsEditStep.forEach(function (btn_edit) {
    btn_edit.addEventListener('click', function () {
      var thisStep = +btn_edit.closest('.step').dataset.id;
      removeClass(stepBlocks, 'active');
      stepBlocks[thisStep].classList.add('active');
      for (var i = thisStep; i < totalStep; i++) {
        stepBlocks[i].classList.remove('show-preview');
      }
      current_step = thisStep;
    });
  });
}
function generatePreviewContact() {
  var step = document.querySelectorAll('.checkout-steps .step')[0],
    name = step.querySelector('input[name="user-name"]').value,
    lastname = step.querySelector('input[name="user-lastname"]').value,
    phone = step.querySelector('input[name="user-phone"]').value,
    email = step.querySelector('input[name="user-email"]').value;
  step.querySelector('.preview').innerHTML = "".concat(name, " ").concat(lastname, ", ").concat(phone, ", ").concat(email);
}
function generatePreviewDelivery() {
  var step = document.querySelectorAll('.checkout-steps .step')[1];
  step.querySelector('.preview').innerHTML = "\u0422\u0443\u0442 \u0431\u0443\u0434\u0443\u0442\u044C \u0434\u0430\u043D\u0456 \u0434\u043B\u044F \u0434\u043E\u0441\u0442\u0430\u0432\u043A\u0438";
}

// Recipient
var recipient_checkbox = document.querySelector('input[name="recipient"]'),
  recipient_fields = document.querySelector('.recipient-fields');
recipient_checkbox.addEventListener('change', function () {
  if (recipient_checkbox.checked) {
    recipient_fields.classList.add('active');
    toggleRequired(recipient_fields, 'add');
  } else {
    recipient_fields.classList.remove('active');
    toggleRequired(recipient_fields, 'remove');
  }
  recalcAccordionHeight(recipient_checkbox.closest('.step'));
});

// Select carrier type
var carrier_type = document.querySelectorAll('input[name="carrier"]'),
  carrier_fields = document.querySelectorAll('.carrier-field');
carrier_type.forEach(function (input) {
  input.addEventListener('change', function () {
    if (input.checked) {
      var active = document.querySelector(".carrier-field.active");
      toggleRequired(active, 'remove');
      removeClass(carrier_fields, 'active');
      document.querySelector(".carrier-field[data-carrier='".concat(input.value, "']")).classList.add('active');
      toggleRequired(document.querySelector(".carrier-field[data-carrier='".concat(input.value, "']")), 'add');
      recalcAccordionHeight(recipient_checkbox.closest('.step'));
    }
  });
});

// Вибір способу доставки для нової пошти
var delivery_type_np = document.querySelectorAll('input[name="delivery-method__np"]'),
  delivery_type_np_fields = document.querySelectorAll('.delivery-field._np');
delivery_type_np.forEach(function (input) {
  input.addEventListener('change', function () {
    if (input.checked) {
      var active = document.querySelector(".delivery-field._np.active");
      toggleRequired(active, 'remove');
      removeClass(delivery_type_np_fields, 'active');
      document.querySelector(".delivery-field._np[data-delivery-method='".concat(input.value, "']")).classList.add('active');
      toggleRequired(document.querySelector(".delivery-field._np[data-delivery-method='".concat(input.value, "']")), 'add');
      recalcAccordionHeight(recipient_checkbox.closest('.step'));
    }
  });
});

// Вибір країни, Нова пошта
var select_country_np__node = document.querySelector('#country-np');
var country_np = new CustomSelect(select_country_np__node, {
  required: true
});

// Вибір міста, Нова пошта
var select_city_np__node = document.querySelector('#city-np');
var city_np = new CustomSelect(select_city_np__node, {
  name: 'city_np',
  search: true,
  options: [['kyiv', 'Київ'], ['lviv', 'Львів'], ['odesa', 'Одеса'], ['dnipro', 'Дніпро'], ['harkiv', 'Харків'], ['cherkasi', 'Черкаси']],
  // опции
  placeholder: select_city_np__node.dataset.placeholder,
  required: true
});

// Вибір відділення, Нова пошта
var select_department_np__node = document.querySelector('#department-np');
var department_np = new CustomSelect(select_department_np__node, {
  name: 'department-np',
  search: true,
  options: [['1', 'Department - 1'], ['2', 'Department - 2'], ['3', 'Department - 3'], ['4', 'Department - 4'], ['5', 'Department - 5'], ['6', 'Department - 6']],
  // опции
  placeholder: select_department_np__node.dataset.placeholder,
  required: true
});

// Вибір поштомату, Нова пошта
var select_postOffice_np__node = document.querySelector('#post-office-np');
var postOffice_np = new CustomSelect(select_postOffice_np__node, {
  name: 'post-office-np',
  search: true,
  options: [['1', 'Поштомат - 1'], ['2', 'Поштомат - 2'], ['3', 'Поштомат - 3'], ['4', 'Поштомат - 4'], ['5', 'Поштомат - 5'], ['6', 'Поштомат - 6']],
  // опции
  placeholder: select_postOffice_np__node.dataset.placeholder,
  required: true
});

// Вибір міста, Укрпошта
var select_city_ukrpost__node = document.querySelector('#city-ukrpost');
var city_ukrpost = new CustomSelect(select_city_ukrpost__node, {
  name: 'city_ukrpost',
  search: true,
  options: [['kyiv', 'Київ'], ['lviv', 'Львів'], ['odesa', 'Одеса'], ['dnipro', 'Дніпро'], ['harkiv', 'Харків'], ['cherkasi', 'Черкаси']],
  // опции
  placeholder: select_city_ukrpost__node.dataset.placeholder,
  required: true
});