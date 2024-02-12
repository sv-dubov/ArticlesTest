"use strict";

var header = document.querySelector('header');
var recalcAccordionHeight;
window.addEventListener('load', function () {
  // Custom VH
  var vh = window.innerHeight * 0.01;
  var vw = document.documentElement.clientWidth;
  document.documentElement.style.setProperty('--vh', "".concat(vh, "px"));
  document.documentElement.style.setProperty('--vw', "".concat(vw, "px"));
  window.addEventListener('resize', function () {
    var vh = window.innerHeight * 0.01;
    document.documentElement.style.setProperty('--vh', "".concat(vh, "px"));
    var vw = document.documentElement.clientWidth;
    document.documentElement.style.setProperty('--vw', "".concat(vw, "px"));
  });
  document.documentElement.style.setProperty('--header-height', "".concat(header.getBoundingClientRect().height, "px"));

  // Accordion height
  var accordion_items = document.querySelectorAll('.js-accordion');
  if (accordion_items.length > 0) {
    accordion_items.forEach(function (item) {
      var btn = item.querySelector('.js-accordion-btn'),
        content = item.querySelector('.js-accordion-content');
      if (btn) {
        btn.addEventListener('click', function () {
          item.classList.toggle('active');
        });
      }
      if (content) {
        item.style.setProperty('--height', "".concat(content.clientHeight, "px"));
        item.classList.add('_init');
      }
    });
  }
  recalcAccordionHeight = function recalcAccordionHeight(accordion) {
    console.log(accordion);
    var content_wrapper = accordion.querySelector('.js-accordion-content .accordion-content__wrapper');
    if (content_wrapper) {
      accordion.style.setProperty('--height', "".concat(content_wrapper.clientHeight, "px"));
      accordion.classList.add('_init');
    }
  };

  // Position card hover
  var position_cards = document.querySelectorAll('.position-card');
  if (position_cards.length) {
    position_cards.forEach(function (card) {
      var top_block = card.querySelector('.position-card__top'),
        holder = card.querySelector('.position-card__holder'),
        holder_wrapper = card.querySelector('.position-card__holder-wrapper');
      if (supportsTouch) {
        top_block.addEventListener('click', function () {
          removeClass(document.querySelectorAll('.position-card .position-card__top'), 'active');
          top_block.classList.add('active');
        });
      } else {
        top_block.addEventListener('mouseenter', function () {
          top_block.classList.add('active');
        });
        top_block.addEventListener('mouseleave', function () {
          top_block.classList.remove('active');
        });
      }
      if (top_block.getBoundingClientRect().height < holder_wrapper.getBoundingClientRect().height) {
        top_block.style.height = holder_wrapper.getBoundingClientRect().height + 'px';
      }
    });
  }
});

// Remove class
function removeClass(nodes, className) {
  nodes.forEach(function (node) {
    node.classList.remove(className);
  });
}
function addClass(nodes, className) {
  nodes.forEach(function (node) {
    node.classList.add(className);
  });
}
var supportsTouch = 'ontouchstart' in window || navigator.msMaxTouchPoints;
var btns_anchor = document.querySelectorAll('._js-anchor');
btns_anchor.forEach(function (btn) {
  btn.addEventListener('click', function (e) {
    e.preventDefault();
    var href = btn.dataset.anchor;
    var target = document.querySelector("#".concat(href));
    var topOffset = target.offsetTop - document.querySelector('nav').clientHeight - 20;
    window.scrollTo({
      top: topOffset,
      behavior: "smooth"
    });
    if (btn.closest('.nav') && btn.closest('.nav').classList.contains('active')) {
      btn.closest('.nav').classList.remove('active');
    }
  });
});
if (document.querySelector('.scroll-top')) {
  document.querySelector('.scroll-top').addEventListener('click', function () {
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
  });
}

// Header dropdown
var headerDropdown = document.querySelectorAll('header .dropdown');
if (headerDropdown.length) {
  headerDropdown.forEach(function (item) {
    var target = item.querySelector('.dropdown-current');
    if (supportsTouch) {
      target.addEventListener('click', function () {
        item.classList.toggle('active');
      });
    } else {
      item.addEventListener('mouseenter', function () {
        item.classList.add('active');
      });
      item.addEventListener('mouseleave', function (e) {
        item.classList.remove('active');
      });
    }
  });
}

// Menu
var menu_items = document.querySelectorAll('footer .footer-main .menu-item');
if (menu_items.length > 0) {
  menu_items.forEach(function (item) {
    if (item.classList.contains('footer-dropdown')) {
      var submenu = item.querySelector('ul'),
        btn = item.querySelector('.menu-title');
      if (supportsTouch) {
        btn.addEventListener('click', function () {
          item.classList.toggle('active');
          menu_items.forEach(function (item2) {
            if (item2 !== item) {
              item2.classList.remove('active');
            }
          });
        });
      } else {
        btn.addEventListener('mouseenter', function () {
          // item.classList.add('active');
        });
        item.addEventListener('mouseleave', function () {
          var activeSubmenu = document.querySelectorAll('.hidden-menu .have-submenu.active');
          activeSubmenu.forEach(function (sub) {
            if (sub !== item) {}
          });
        });
      }
      submenu.style.setProperty('--height', "".concat(submenu.getBoundingClientRect().height, "px"));
      submenu.classList.add('_init');
    }
  });
}
var burger = document.querySelector('.burger'),
  header_overflow = document.querySelector('.header-overflow');
burger.addEventListener('click', function () {
  header.classList.toggle('active');
  closeAllModal();
  bodyLockToggle();
});
header_overflow.addEventListener('click', function () {
  header.classList.remove('active');
  bodyUnlock();
});

// Tabs
var tabBlocks = document.querySelectorAll('._js-tab');
if (tabBlocks.length > 0) {
  var buttonsOffset = function buttonsOffset(tabBlock, btn, center) {
    var _window$getComputedSt, _window$getComputedSt2;
    var block_wrapper = tabBlock.querySelector('.tabs-buttons .tabs-buttons__wrapper');
    var paddingLeft = (_window$getComputedSt = window.getComputedStyle(block_wrapper, null).getPropertyValue('padding-left')) !== null && _window$getComputedSt !== void 0 ? _window$getComputedSt : 0;
    var paddingRight = (_window$getComputedSt2 = window.getComputedStyle(block_wrapper, null).getPropertyValue('padding-right')) !== null && _window$getComputedSt2 !== void 0 ? _window$getComputedSt2 : 0;
    if (paddingLeft !== '') {
      paddingLeft = +paddingLeft.replace('px', '') * 3;
    }
    if (paddingRight !== '') {
      paddingRight = +paddingRight.replace('px', '') * 3;
    }
    var btn_pos = btn.getBoundingClientRect(),
      block_wrapper_pos = block_wrapper.getBoundingClientRect();
    var need_scroll = false;
    var scroll = 0;
    if (!center) {
      // Виходе за правий край екрану
      if (btn_pos.right > block_wrapper_pos.right) {
        scroll = block_wrapper.scrollLeft + (btn_pos.right - block_wrapper_pos.right);

        // У випадку якщо таб більший ніж розмір екрану і якщо він після скролу буде виходити за лівий край
        if (btn_pos.width > block_wrapper_pos.width && btn_pos.left - scroll < block_wrapper_pos.left) {
          scroll = scroll - (btn_pos.left - scroll - block_wrapper_pos.left) * -1;
        }
        scroll = scroll + paddingRight;
        need_scroll = true;
      }

      // Виходе за лівий край екрану
      if (btn_pos.left < block_wrapper_pos.left) {
        scroll = block_wrapper.scrollLeft - (btn_pos.left * -1 + block_wrapper_pos.left);
        need_scroll = true;
        scroll = scroll - paddingLeft;
      }
    } else if (center) {
      // console.log(btn_pos.left, block_wrapper_pos.left);
      scroll = block_wrapper.scrollLeft + btn_pos.left - (375 - btn_pos.width) / 2;

      // console.log(scroll);
      console.log(block_wrapper.scrollLeft);
      need_scroll = true;
    }
    if (need_scroll) {
      block_wrapper.scrollTo({
        left: scroll,
        top: 0,
        behavior: 'smooth'
      });
    }
  };
  tabBlocks.forEach(function (tabBlock) {
    var btns = tabBlock.querySelectorAll('._js-tab-btn'),
      tabItems = tabBlock.querySelectorAll('._js-tab-item'),
      btnNext = tabBlock.querySelector('.btn-pagin__next'),
      btnPrev = tabBlock.querySelector('.btn-pagin__prev');
    var activeIndex = 1;
    if (btns.length > 1) {
      if (tabBlock.classList.contains('animation')) {
        var activeBlock = tabBlock.querySelector('._js-tab-item.active .tab-item__wrapper');
        tabBlock.querySelector('.tab-content').style.height = "".concat(activeBlock.clientHeight, "px");
      }
      btns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          var activeBlock = tabBlock.querySelector("._js-tab-item[data-id='".concat(btn.dataset.id, "']"));
          removeClass(btns, 'active');
          removeClass(tabItems, 'active');
          btn.classList.add('active');
          activeBlock.classList.add('active');

          // If block have animation
          if (tabBlock.classList.contains('animation')) {
            var _activeBlock = tabBlock.querySelector('._js-tab-item.active .tab-item__wrapper');
            tabBlock.querySelector('.tab-content').style.height = "".concat(_activeBlock.clientHeight, "px");
          } else {
            // If block have swiper
            // if (tabBlock.querySelector('.swiper-tabs')) {
            // initSwiperTabs();
            // }
          }

          // Скролл якщо елемент виходе за рамки екрану
          buttonsOffset(tabBlock, btn, false);
          activeIndex = +btn.dataset.id;
        });
      });
    } else {
      tabBlock.classList.add('inactive');
    }
    if (btnNext) {
      btnNext.addEventListener('click', function () {
        var nextIndex = activeIndex + 1;
        if (nextIndex <= +btns[btns.length - 1].dataset.id) {
          var btn = tabBlock.querySelector("._js-tab-btn[data-id='".concat(nextIndex, "']"));
          var _activeBlock2 = tabBlock.querySelector("._js-tab-item[data-id='".concat(nextIndex, "']"));
          removeClass(btns, 'active');
          removeClass(tabItems, 'active');
          btn.classList.add('active');
          _activeBlock2.classList.add('active');
          buttonsOffset(tabBlock, btn, true);
          activeIndex = +btn.dataset.id;
          if (nextIndex > 1) {
            btnNext.classList.remove('_hide');
            btnPrev.classList.remove('_hide');
          }
          if (nextIndex === +btns[btns.length - 1].dataset.id) {
            btnNext.classList.add('_hide');
            btnPrev.classList.remove('_hide');
          }
        }
      });
    }
    if (btnPrev) {
      btnPrev.addEventListener('click', function () {
        var nextIndex = activeIndex - 1;
        console.log(nextIndex);
        if (nextIndex >= 0) {
          var btn = tabBlock.querySelector("._js-tab-btn[data-id='".concat(nextIndex, "']"));
          var _activeBlock3 = tabBlock.querySelector("._js-tab-item[data-id='".concat(nextIndex, "']"));
          removeClass(btns, 'active');
          removeClass(tabItems, 'active');
          btn.classList.add('active');
          _activeBlock3.classList.add('active');
          buttonsOffset(tabBlock, btn, true);
          activeIndex = nextIndex;
          if (nextIndex <= +btns[btns.length - 1].dataset.id) {
            btnNext.classList.remove('_hide');
            btnPrev.classList.remove('_hide');
          }
          if (nextIndex === 1) {
            btnNext.classList.remove('_hide');
            btnPrev.classList.add('_hide');
          }
        } else {}
      });
    }
  });
}
function fadeToggle(elem) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
  console.log('fade toggle');
  elem.classList.remove('fade-in');
  elem.classList.remove('fade-out');
  if (elem.classList.contains('active')) {
    elem.classList.add('fade-out');
    setTimeout(function () {
      elem.classList.remove('active');
    }, speed);
  } else {
    elem.classList.add('active');
    elem.classList.add('fade-in');
  }
}

// Find last block in editor
var editor_blocks = document.querySelectorAll('.editor');
if (editor_blocks.length) {
  editor_blocks.forEach(function (block) {
    var children = block.children;
    if (children) {
      children[0].style.marginTop = '0px';
      children[children.length - 1].style.marginBottom = '0px';
    }
  });
}
function fadeIn(elem) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
  console.log('fade in');
  elem.classList.remove('fade-in');
  elem.classList.remove('fade-out');
  elem.classList.add('active');
  elem.classList.add('fade-in');
}
function fadeOut(elem) {
  var speed = arguments.length > 1 && arguments[1] !== undefined ? arguments[1] : 500;
  console.log('fade out');
  elem.classList.remove('fade-in');
  elem.classList.remove('fade-out');
  elem.classList.add('fade-out');
  setTimeout(function () {
    elem.classList.remove('active');
  }, speed);
}

// Заблокувати крол та прибрати стрибок
var bodyLockStatus = true;
function bodyLockToggle() {
  var delay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 500;
  if (document.documentElement.classList.contains('lock')) {
    bodyUnlock(delay);
  } else {
    bodyLock(delay);
  }
}
function bodyUnlock() {
  var delay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
  console.log('body unlock');
  var body = document.querySelector("body");
  if (bodyLockStatus) {
    var lock_padding = document.querySelectorAll("[data-lp]");
    setTimeout(function () {
      for (var index = 0; index < lock_padding.length; index++) {
        var el = lock_padding[index];
        el.style.paddingRight = '0px';
      }
      body.style.paddingRight = '0px';
      document.documentElement.classList.remove("lock");
    }, delay);
    bodyLockStatus = false;
    setTimeout(function () {
      bodyLockStatus = true;
    }, delay);
  }
}
function bodyLock() {
  var delay = arguments.length > 0 && arguments[0] !== undefined ? arguments[0] : 0;
  var body = document.querySelector("body");
  if (bodyLockStatus) {
    var lock_padding = document.querySelectorAll("[data-lp]");
    for (var index = 0; index < lock_padding.length; index++) {
      var el = lock_padding[index];
      el.style.paddingRight = window.innerWidth - document.querySelector('.main').offsetWidth + 'px';
    }
    body.style.paddingRight = window.innerWidth - document.querySelector('.main').offsetWidth + 'px';
    document.documentElement.classList.add("lock");
    bodyLockStatus = false;
    setTimeout(function () {
      bodyLockStatus = true;
    }, delay);
  }
}
var overlayModal = document.querySelector('.overlay-modal');
if (overlayModal) {
  overlayModal.addEventListener('click', function () {
    closeAllModal();
    bodyUnlock();
  });
}
function closeAllModal() {
  //fadeOut(overlayModal);
  // bodyUnlock();
  overlayModal.classList.remove('active');
  document.querySelectorAll('._js-modal').forEach(function (modal) {
    modal.classList.remove('active');
  });
}

// Show modal
var btnsOpenModal = document.querySelectorAll('._js-btn-show-modal'),
  btnsCloseModal = document.querySelectorAll('._js-btn-close-modal');
if (btnsOpenModal.length) {
  btnsOpenModal.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var modal = btn.dataset.modal;
      if (modal !== '' && modal !== undefined) {
        var modal_node = document.querySelector(".js-modal-".concat(modal));
        if (modal_node) {
          // Якщо необхідно кліком на одну й ту ж саму кнопку показувати/ховати модалку
          if (modal_node.dataset.toggle === '') {
            document.querySelectorAll('._js-modal').forEach(function (modal1) {
              if (modal1 !== modal_node) {
                modal1.classList.remove('active');
              }
            });
            if (modal_node.classList.contains('active')) {
              modal_node.classList.remove('active');
              bodyUnlock();

              // If need show blur overlay
              if (modal_node.dataset.overlay === '') {
                console.log(3);
                overlayModal.classList.remove('active');
                //fadeOut(overlayModal);
              }
            } else {
              modal_node.classList.add('active');
              bodyLock();

              // If need show blur overlay
              if (modal_node.dataset.overlay === '') {
                console.log(4);
                overlayModal.classList.add('active');
                //fadeIn(overlayModal);
              }
            }
          } else {
            closeAllModal();
            modal_node.classList.add('active');
            bodyLock();

            // If need show blur overlay

            if (modal_node.dataset.overlay === '') {
              console.log(1);
              overlayModal.classList.add('active');
              //fadeIn(overlayModal);
            }
          }
          if (modal === 'filters') {
            eventOpenFilters();
          }
        }
      }
    });
  });
}
if (btnsCloseModal.length > 0) {
  btnsCloseModal.forEach(function (btn) {
    btn.addEventListener('click', function () {
      var modal = btn.closest('._js-modal');
      console.log(modal);
      if (modal) {
        modal.classList.remove('active');
      }
      bodyUnlock();
      // If need show blur overlay
      if (modal.dataset.overlay === '') {
        console.log(2);
        overlayModal.classList.remove('active');
        //fadeOut(overlayModal);
      }
    });
  });
}
function eventOpenFilters() {
  if (window.matchMedia("(min-width: 1024px)").matches) {
    document.documentElement.classList.remove('lock');
    bodyUnlock();
  }
}
document.querySelector('.button[type="submit"].active');
// Related blocks
var related_blocks = document.querySelectorAll('.js-related-block');
if (related_blocks.length > 0) {
  related_blocks.forEach(function (block) {
    block.addEventListener('change', function () {
      var id = block.dataset.relatedId;
      var child = document.querySelectorAll(".js-related-block[data-related-id='".concat(id, "__child']"));
      if (block.checked && child.length > 0) {
        addClass(child, 'active');
      } else {
        removeClass(child, 'active');
      }
    });
  });
}

// Init custom select
var defaultCustomSelects = document.querySelectorAll('._js-custom-select[data-default]');
if (defaultCustomSelects.length) {
  defaultCustomSelects.forEach(function (selectNode) {
    var select = new CustomSelect(selectNode, {});
  });
}

// Product btn scroll size block
var prodSizeScroll = document.querySelectorAll('._js-have-btn-scroll');
if (prodSizeScroll.length) {
  prodSizeScroll.forEach(function (block) {
    var btn_scroll_right = block.querySelector('._js-btn-scroll_right'),
      btn_scroll_left = block.querySelector('._js-btn-scroll_left'),
      scroll_wrapper = block.querySelector('._js-scroll-wrapper'),
      scroll_elem = block.querySelectorAll('._js-scroll-elem'),
      block__coord = block.getBoundingClientRect();
    btn_scroll_right.addEventListener('click', function () {
      for (var i = 0; i < scroll_elem.length; i++) {
        var elem = scroll_elem[i];
        if (elem.getBoundingClientRect().right > block__coord.right) {
          scroll_wrapper.scrollTo({
            left: scroll_wrapper.scrollLeft + elem.clientWidth + 2,
            top: 0,
            behavior: 'smooth'
          });
          if (scroll_elem[i + 1] === undefined) {
            btn_scroll_right.classList.remove('show');
            btn_scroll_left.classList.add('show');
          }
          break;
        }
      }
    });
    btn_scroll_left.addEventListener('click', function () {
      for (var i = 0; i < scroll_elem.length; i++) {
        var elem = scroll_elem[i];
        if (elem.getBoundingClientRect().left > block__coord.left) {
          var prev_elem = elem.previousElementSibling;
          if (prev_elem) {
            scroll_wrapper.scrollTo({
              left: scroll_wrapper.scrollLeft - prev_elem.clientWidth,
              top: 0,
              behavior: 'smooth'
            });
          }
          if (scroll_elem[i - 2] === undefined) {
            btn_scroll_right.classList.add('show');
            btn_scroll_left.classList.remove('show');
          }
          break;
        }
      }
    });
    if (scroll_elem[scroll_elem.length - 1].getBoundingClientRect().right <= block__coord.right) {
      block.classList.add('_hide-scroll');
    } else {
      btn_scroll_right.classList.add('show');
    }
  });
}

// Mask Phone
function initMaskPhone() {
  var mask_phones = document.querySelectorAll('._js-mask-phone');
  if (mask_phones.length !== 0) {
    mask_phones.forEach(function (phone) {
      var mask = new Inputmask({
        showMaskOnHover: false,
        regex: '^\\+380[35-9][0-9]{8}$',
        placeholder: " ",
        onBeforeMask: function onBeforeMask(value, opts) {
          return value.replace(/^(0|\+?380)/, "");
        }
      });
      mask.mask(phone);
    });
  }
}
var maskPhoneSelect = document.querySelectorAll(".mask-phone-select");
if (maskPhoneSelect.length) {
  maskPhoneSelect.forEach(function (formGroup) {
    var input = formGroup.querySelector('input');
    input.addEventListener('input', function () {
      // Перевірка, чи + є на початку рядка, а решта - цифри
      var inputValue = input.value;
      if (/^[0-9]*$/.test(inputValue)) {
        // Введення допустиме
        console.log('Допустиме введення');
      } else {
        // Видалення останнього символу, який не є допустимим
        event.target.value = inputValue.slice(0, -1);
      }
    });
    window.intlTelInput(input, {
      utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.2.1/build/js/utils.js",
      initialCountry: 'ua',
      separateDialCode: true,
      autoInsertDialCode: true,
      nationalMode: false,
      preferredCountries: ['ua', 'pl']
    });
  });
}

// Mask Email
function initMaskEmail() {
  var mask_email = document.querySelectorAll('._js-mask-email');
  if (mask_email.length !== 0) {
    mask_email.forEach(function (email) {
      var mask = new Inputmask({
        showMaskOnHover: false,
        mask: "*{1,100}[.*{1,100}][.*{1,100}][.*{1,100}]@*{1,50}[.*{2,20}][.*{1,20}]",
        placeholder: " ",
        greedy: false,
        onBeforePaste: function onBeforePaste(pastedValue, opts) {
          pastedValue = pastedValue.toLowerCase();
          return pastedValue.replace("mailto:", "");
        },
        definitions: {
          '*': {
            validator: "[0-9A-Za-z!#$%&'*+/=?^_`{|}~\-]",
            casing: "lower"
          }
        }
      });
      mask.mask(email);
    });
  }
}
if (document.querySelector('#maskinput-script')) {
  document.querySelector('#maskinput-script').addEventListener('load', function () {
    initMaskPhone();
    initMaskEmail();
  });
}

// Validate inputs
var form_groups_required = document.querySelectorAll('.form-group.required, .form-group.valid-not-required');
form_groups_required.forEach(function (form_group) {
  return validate(form_group);
});
var formGroups = document.querySelectorAll('.form-group');
if (formGroups.length) {
  formGroups.forEach(function (formGroup) {
    var btnClear = formGroup.querySelector('.btn-clear'),
      input = formGroup.querySelector('.form-input');
    if (btnClear) {
      input.addEventListener('input', function () {
        if (input.value.trim() !== '' && !formGroup.classList.contains('_show-btn-clear') && !formGroup.classList.contains('has-error')) {
          formGroup.classList.add('_show-btn-clear');
        } else if (input.value.trim() === '') {
          formGroup.classList.remove('_show-btn-clear');
        }
      });
      input.addEventListener('blur', function () {
        setTimeout(function () {
          formGroup.classList.remove('_show-btn-clear');
        }, 100);
      });
      btnClear.addEventListener('click', function () {
        input.value = '';
        formGroup.classList.remove('_show-btn-clear');
      });
    }
  });
}
function validate(form_group) {
  var valid_type_arr = form_group.dataset.valid.split(',');
  if (valid_type_arr.length > 0) {
    var error_count = 0;
    var _loop = function _loop(i) {
      var valid_type = valid_type_arr[i];
      if (valid_type_arr[i].indexOf('maxlength') !== -1) {
        valid_type = 'maxlength';
      }
      switch (valid_type) {
        case 'empty':
          {
            form_group.querySelector('input, textarea').addEventListener('blur', function () {
              if (form_group.classList.contains('required')) {
                if (i === 0) {
                  error_count = +!validateField(form_group, valid_type);
                } else {
                  if (error_count === 0) {
                    error_count = +!validateField(form_group, valid_type);
                  }
                }
              }
            });
            break;
          }
        case 'mask':
          {
            form_group.querySelector('input').addEventListener('blur', function () {
              if (form_group.classList.contains('required')) {
                if (i === 0) {
                  error_count = +!validateField(form_group, valid_type);
                } else {
                  if (error_count === 0) {
                    error_count = +!validateField(form_group, valid_type);
                  }
                }
              }
            });
            break;
          }
        case 'checkbox':
          {
            form_group.querySelector('input').addEventListener('change', function () {
              if (form_group.classList.contains('required')) {
                if (i === 0) {
                  error_count = +!validateField(form_group, valid_type);
                } else {
                  if (error_count === 0) {
                    error_count = +!validateField(form_group, valid_type);
                  }
                }
              }
            });
            break;
          }
        case 'maxlength':
          {
            form_group.querySelector('input, textarea').addEventListener('blur', function () {
              if (i === 0) {
                error_count = +!validateField(form_group, valid_type_arr[i]);
              } else {
                if (error_count === 0) {
                  error_count = +!validateField(form_group, valid_type_arr[i]);
                }
              }
            });
            break;
          }
        case 'cyrillic':
          {
            form_group.querySelector('input, textarea').addEventListener('blur', function () {
              if (i === 0) {
                error_count = +!validateField(form_group, valid_type);
              } else {
                if (error_count === 0) {
                  error_count = +!validateField(form_group, valid_type);
                }
              }
            });
            break;
          }
        case 'number':
          {
            form_group.querySelector('input, textarea').addEventListener('blur', function () {
              if (i === 0) {
                error_count = +!validateField(form_group, valid_type);
              } else {
                if (error_count === 0) {
                  error_count = +!validateField(form_group, valid_type);
                }
              }
            });
            break;
          }
      }
    };
    for (var i = 0; i < valid_type_arr.length; i++) {
      _loop(i);
    }
  }
}
function validateField(form_group, valid_type) {
  var maxlength;
  if (valid_type.indexOf('maxlength') !== -1) {
    maxlength = valid_type.split('-')[1];
    valid_type = 'maxlength';
  }
  switch (valid_type) {
    case 'empty':
      {
        var input = form_group.querySelector('input, textarea');
        if (input.value.trim() === "") {
          form_group.classList.add('has-error');
          form_group.querySelector('.help-block').innerHTML = form_group.querySelector('.help-block').dataset.empty;
          return false;
        } else {
          form_group.classList.remove('has-error');
        }
        return true;
      }
    case 'mask':
      {
        var _input = form_group.querySelector('input');
        if (_input.inputmask.isComplete()) {
          form_group.classList.remove('has-error');
        } else {
          form_group.classList.add('has-error');
          form_group.querySelector('.help-block').innerHTML = form_group.querySelector('.help-block').dataset.empty;
          return false;
        }
        return true;
      }
    case 'checkbox':
      {
        var _input2 = form_group.querySelector('input');
        if (_input2.checked) {
          form_group.classList.remove('has-error');
        } else {
          form_group.classList.add('has-error');
          form_group.querySelector('.help-block').innerHTML = form_group.querySelector('.help-block').dataset.empty;
          return false;
        }
        return true;
      }
    case 'select':
      {
        var select_target = form_group.querySelector('[data-select]');
        var val = '';
        if (select_target.dataset.type === 'button') {
          val = form_group.querySelector('button').value.trim();
        } else {
          val = form_group.querySelector('input[type="hidden"]').value.trim();
        }
        if (val === '') {
          form_group.classList.add('has-error');
          return false;
        } else {
          form_group.classList.remove('has-error');
        }
        return true;
      }
    case 'maxlength':
      {
        var _input3 = form_group.querySelector('input, textarea');
        if (_input3.value.length > maxlength) {
          form_group.classList.add('has-error');
          form_group.querySelector('.help-block').innerHTML = form_group.querySelector('.help-block').dataset.maxlength;
          return false;
        } else {
          form_group.classList.remove('has-error');
        }
        return true;
      }
    case 'cyrillic':
      {
        var _input4 = form_group.querySelector('input, textarea');
        // let regex = /^[а-яіїє' -]+$/gi;
        var regex = /^([а-яіїє' -]+)?$/gi;
        if (!regex.test(_input4.value)) {
          form_group.classList.add('has-error');
          form_group.querySelector('.help-block').innerHTML = form_group.querySelector('.help-block').dataset.cyrillic;
          return false;
        } else {
          form_group.classList.remove('has-error');
        }
        return true;
      }
    case 'number':
      {
        var _input5 = form_group.querySelector('input, textarea');
        // let regex = /^[а-яіїє' -]+$/gi;
        var _regex = /^\d+$/;
        if (!_regex.test(_input5.value)) {
          form_group.classList.add('has-error');
          form_group.querySelector('.help-block').innerHTML = form_group.querySelector('.help-block').dataset.number;
          return false;
        } else {
          form_group.classList.remove('has-error');
        }
        return true;
      }
  }
}
function validateForm(form) {
  var required_fields = form.querySelectorAll('.required');
  var errors = 0;
  var errors_fields = [];
  required_fields.forEach(function (form_group) {
    var valid_type_arr = form_group.dataset.valid.split(',');
    var error_valid_count = 0;
    for (var i = 0; i < valid_type_arr.length; i++) {
      var valid_type = valid_type_arr[i];
      if (valid_type_arr[i].indexOf('maxlength') !== -1) {
        valid_type = 'maxlength';
      }
      if (i === 0) {
        // error_valid_count = ;
        if (!validateField(form_group, valid_type_arr[i])) {
          error_valid_count = 1;
          errors += 1;
          errors_fields.push(form_group);
        } else {
          error_valid_count = 0;
        }
      } else {
        if (error_valid_count === 0) {
          if (!validateField(form_group, valid_type_arr[i])) {
            error_valid_count = 1;
            errors += 1;
            errors_fields.push(form_group);
          } else {
            error_valid_count = 0;
          }
        }
      }

      // if (!validateField(form_group, valid_type_arr[i])) {
      //     errors += 1;
      // }
    }
  });
  if (errors === 0) {
    return true;
  } else {
    errors_fields[0].scrollIntoView({
      behavior: 'smooth',
      block: "center"
    });
    return false;
  }
}
function resetForm(form) {
  form.reset();
  var form_groups = form.querySelectorAll('.form-group');
  form_groups.forEach(function (form_group) {
    form_group.classList.remove('focus');
  });
}
function toggleRequired(block, action) {
  var requiredElems = block.querySelectorAll('[data-required]');
  if (action === 'add') {
    requiredElems.forEach(function (item) {
      item.classList.add('required');
      validate(item);
    });
  } else {
    requiredElems.forEach(function (item) {
      item.classList.remove('required');
      item.classList.remove('has-error');
    });
  }
}

// donate form
var formDonation = document.querySelectorAll('.js-form-donation');
var amountSelect = document.querySelectorAll('.select-amount');
if (amountSelect.length) {
  amountSelect.forEach(function (node) {
    new CustomSelect(node, {
      onSelected: function onSelected(select, option) {
        var optionText = option.textContent;
        // let stock_list_items = document.querySelectorAll('.stock-list');

        if (node.closest('.js-form-donation')) {
          var amountPickerRadios = node.closest('.js-form-donation').querySelectorAll('input[name="default-amount"]');
          if (amountPickerRadios.length) {
            amountPickerRadios.forEach(function (amountRadio) {
              amountRadio.closest('.form-group').querySelector('label').innerHTML = "".concat(amountRadio.value, " ").concat(optionText);
            });
          }
          console.log(amountPickerRadios);
        }
      }
    });
  });
}

// Project img swiper
if (document.querySelector('.project-card__swiper')) {
  new Swiper('.project-card__swiper', {
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.btn-next-project',
      prevEl: '.btn-prev-project'
    }
  });
}

// Souvenir swiper
if (document.querySelector('.souvenir-swiper')) {
  new Swiper('.souvenir-swiper', {
    spaceBetween: 20,
    pagination: {
      el: '.swiper-pagination',
      clickable: true
    },
    navigation: {
      nextEl: '.btn-next-souvenir',
      prevEl: '.btn-prev-souvenir'
    },
    breakpoints: {
      768: {
        slidesPerView: 2
      },
      1440: {
        slidesPerView: 3,
        spaceBetween: 25
      }
    },
    on: {
      slideChangeTransitionStart: function slideChangeTransitionStart() {
        // document.querySelector('.souvenir-swiper').style.overflow = 'hidden';
      },
      slideChangeTransitionEnd: function slideChangeTransitionEnd() {
        // document.querySelector('.souvenir-swiper').style.overflow = 'visible';
      }
    }
  });
}
if (document.querySelector('.gallery-swiper')) {
  var galleryZoom;
  var swiperGalleryThumbs = new Swiper('.gallery-swiper', {
    pagination: {
      el: '.swiper-pagination__gallery',
      clickable: true
    },
    navigation: {
      nextEl: '.btn-next-gallery',
      prevEl: '.btn-prev-gallery'
    },
    breakpoints: {
      320: {
        slidesPerView: 2,
        spaceBetween: 10
      },
      768: {
        slidesPerView: 4,
        spaceBetween: 16,
        grid: {
          rows: 2,
          fill: 'row'
        }
      },
      1440: {
        slidesPerView: 4,
        spaceBetween: 25,
        grid: {
          rows: 2,
          fill: 'row'
        }
      }
    },
    on: {
      init: function init(swiper) {
        var slides = swiper.slides;
        slides.forEach(function (slide) {
          slide.addEventListener('click', function () {
            if (galleryZoom) {
              var index = +slide.getAttribute('aria-label').split('/')[0];
              galleryZoom.slideTo(index, 0);
            }
          });
        });
      }
    }
  });
  if (document.querySelector('.gallery-zoom__swiper')) {
    galleryZoom = new Swiper('.gallery-zoom__swiper', {
      spaceBetween: 20,
      speed: 700,
      pagination: {
        el: '.swiper-pagination__zoom-gallery',
        clickable: true,
        type: 'fraction'
      },
      navigation: {
        nextEl: '.btn-next-zoom',
        prevEl: '.btn-prev-zoom'
      }
    });

    // swiperGalleryThumbs.controller.control = galleryZoom;
    // thumbs.controller.control = slider;
  }
}

// Souvenir show holder
var souvenirInfoBlock = document.querySelectorAll('.souvenir-info');
if (souvenirInfoBlock.length) {
  souvenirInfoBlock.forEach(function (block) {
    var btn = block.querySelector('.btn-detail');
    btn.addEventListener('click', function () {
      block.classList.toggle('active');
    });
  });
}
window.addEventListener('click', function (e) {
  var tg = e.target;
  if (!tg.closest('.souvenir-info')) {
    removeClass(document.querySelectorAll('.souvenir-info'), 'active');
  }
  if (!tg.closest('.position-card__top')) {
    removeClass(document.querySelectorAll('.position-card .position-card__top'), 'active');
  }
});
if (formDonation.length) {
  formDonation.forEach(function (form) {
    var amountInput = form.querySelector('#amount-input'),
      amountPickerRadios = form.querySelectorAll('input[name="default-amount"]'),
      paymentTypeRadio = form.querySelectorAll('input[name="payment-type"]');
    if (paymentTypeRadio.length) {
      paymentTypeRadio.forEach(function (radioPaymentType) {
        radioPaymentType.addEventListener('change', function () {
          if (radioPaymentType.value === 'one-time') {
            form.querySelector('.period').classList.remove('active');
          } else {
            form.querySelector('.period').classList.add('active');
          }
        });
      });
    }
    if (amountPickerRadios.length) {
      amountPickerRadios.forEach(function (amountRadio) {
        amountRadio.addEventListener('change', function () {
          amountInput.value = amountRadio.value;
          var eventBlur = new Event('blur');
          amountInput.dispatchEvent(eventBlur);
        });
      });
    }
  });
}
if (document.querySelector('.msg-widget')) {
  document.querySelector('.msg-widget').addEventListener('click', function (e) {
    e.target.closest('.msg-widget').classList.toggle('active');
  });
}

// Анимация при скроле
function animation() {
  var animItems = document.querySelectorAll('._anim-items');
  if (animItems.length > 0) {
    var animScroll = function animScroll() {
      for (var index = 0; index < animItems.length; index++) {
        var animItem = animItems[index],
          animItemHeight = animItem.offsetHeight,
          animItemOffset = offset(animItem).top,
          animStart = animItem.dataset.start !== undefined ? +animItem.dataset.start : 2;
        var animItemPoint = window.innerHeight - animItemHeight / animStart;
        if (animItemHeight > window.innerHeight) {
          animItemPoint = window.innerHeight - window.innerHeight / animStart;
        }
        if (pageYOffset > animItemOffset - animItemPoint && pageYOffset < animItemOffset + animItemHeight) {
          animItem.classList.add('_active');
        } else {
          if (!animItem.classList.contains('_anim-no-hide')) {
            animItem.classList.remove('_active');
          }
        }
      }
    };
    var offset = function offset(el) {
      var rect = el.getBoundingClientRect(),
        scrollLeft = window.pageXOffset || document.documentElement.scrollLeft,
        scrollTop = window.pageYOffset || document.documentElement.scrollTop;
      return {
        top: rect.top + scrollTop,
        left: rect.left + scrollLeft
      };
    };
    window.addEventListener('scroll', animScroll);
    animScroll();
  }
}
animation();
function hideHeader() {
  var last_scroll = 0;
  var header = document.querySelector('header'),
    defaultOffset = 100;
  var scrollPosition = function scrollPosition() {
    return window.pageYOffset || document.documentElement.scrollTop;
  };
  var containHide = function containHide() {
    return header.classList.contains('hold');
  };
  window.addEventListener('scroll', function () {
    if (scrollPosition() > last_scroll && !containHide() && scrollPosition() > defaultOffset) {
      header.classList.add('hold');
    } else if (scrollPosition() < last_scroll && containHide()) {
      header.classList.remove('hold');
    }
    last_scroll = scrollPosition();
  });
}
hideHeader();

// List set marker
var lists = document.querySelectorAll('.editor ul, .editor ol');
console.log(lists);
if (lists.length) {
  lists.forEach(function (list) {
    var li = list.querySelectorAll('li');
    if (li.length) {
      li.forEach(function (li_item, index) {
        var span = document.createElement('span');
        span.className = '_marker';
        if (list.tagName === 'OL') {
          span.textContent = "".concat(index + 1, ".");
        } else {
          span.textContent = '-';
        }
        li_item.insertAdjacentElement('afterbegin', span);
      });
    }
  });
}