"use strict";

(function () {
  tinymce.PluginManager.add('checklistbutton', function (editor, url) {
    //console.log(url);
    var parts = url.split('assets');
    var themeURL = parts[0]; // Add Button to Visual Editor Toolbar

    editor.addButton('custom_class', {
      title: 'Checklist',
      cmd: 'custom_class',
      image: themeURL + 'assets/img/checklist.png'
    }); // Add Command when Button Clicked

    editor.addCommand('custom_class', function () {
      //alert('Button clicked!');
      // var selected_text = editor.selection.getContent({
      //   'format': 'html'
      // });
      var selected_text = editor.selection.getContent();

      if (selected_text.length === 0) {
        alert('Please select some text.');
        return;
      }

      var open_column = '<div class="ChecklistWrap">';
      var close_column = '</div>';
      var return_text = '';
      return_text = open_column + selected_text + close_column;
      editor.execCommand('mceReplaceContent', false, return_text);
      return; //var selected_text = editor.selection.getContent();
      // var selected_text = editor.selection.getContent({
      //   'format': 'html'
      // });
      // var return_text = '';
      // return_text = '<span class="dropcap">' + selected_text + '</span>';
      // editor.execCommand('mceInsertContent', 0, return_text);
    });
  });
})();
"use strict";

function _toConsumableArray(arr) { return _arrayWithoutHoles(arr) || _iterableToArray(arr) || _unsupportedIterableToArray(arr) || _nonIterableSpread(); }

function _nonIterableSpread() { throw new TypeError("Invalid attempt to spread non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method."); }

function _unsupportedIterableToArray(o, minLen) { if (!o) return; if (typeof o === "string") return _arrayLikeToArray(o, minLen); var n = Object.prototype.toString.call(o).slice(8, -1); if (n === "Object" && o.constructor) n = o.constructor.name; if (n === "Map" || n === "Set") return Array.from(o); if (n === "Arguments" || /^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(n)) return _arrayLikeToArray(o, minLen); }

function _iterableToArray(iter) { if (typeof Symbol !== "undefined" && iter[Symbol.iterator] != null || iter["@@iterator"] != null) return Array.from(iter); }

function _arrayWithoutHoles(arr) { if (Array.isArray(arr)) return _arrayLikeToArray(arr); }

function _arrayLikeToArray(arr, len) { if (len == null || len > arr.length) len = arr.length; for (var i = 0, arr2 = new Array(len); i < len; i++) { arr2[i] = arr[i]; } return arr2; }

/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 04.04.2024
 */
jQuery(document).ready(function ($) {
  AOS.init();
  var params = {};
  location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (s, k, v) {
    params[k] = v;
  });
  var dateNow = new Date();
  var month = dateNow.getMonth() + 1;
  var day = dateNow.getDate();
  var year = dateNow.getFullYear();
  var monthName = dateNow.toLocaleString('default', {
    month: 'long'
  });
  var currentDate = monthName + ' ' + day + ', ' + year; // if( $('.events-content-block .simcal-day-label').length ) {
  //   $('.events-content-block .simcal-day-label .simcal-date-format').each(function(){
  //     var parent = $(this).parents('dt.simcal-day-label');
  //     var date = $(this).text().trim();
  //     var parts = date.split(' ');
  //     var sMonth = parts[0];
  //     var sDay =  parts[1].replace(/[^0-9]/g, '');
  //         sDay = parseInt(sDay);
  //     if(sMonth==monthName) {
  //       if(sDay >= day) {
  //         console.log(date);
  //       }        
  //     }
  //   });
  // }

  if ($('.repeatable.has-paper-edge').length) {
    $('.repeatable.has-paper-edge').each(function () {
      $(this).prev().addClass('adjust-padding-bottom');
    });
  }

  $(window).on('load resize', function () {
    verticalGalleryColumn();
  });

  function verticalGalleryColumn() {
    if ($('.two_column_icons_and_gallery').length) {
      $('.two_column_icons_and_gallery').each(function () {
        if ($(this).find('.flexwrap.half').length) {
          var iconsDivHeight = $(this).find('.textcol .inside').outerHeight() + 160;

          if ($(this).find('.imagecol').length) {
            $(this).find('.imagecol').css('height', iconsDivHeight + 'px');
            var countImages = $(this).find('.imagecol').find('img').length;

            if (countImages > 1) {
              var imageHeight = 100 / countImages;
              $(this).find('.imagecol').find('figure').each(function () {
                var parent = $(this).parent();
                parent.addClass('multiple-images');
                $(this).css({
                  'width': 'auto',
                  'height': imageHeight + '%'
                });
              });
            }

            $(this).find('.imagecol').addClass('show');
          }
        }
      });
    }
  }

  if ($('.events-content-block .simcal-events li').length) {
    var maxList = 4;
    var eventDataList = '';
    var eventDataArr = [];
    $('.events-content-block .simcal-events li').each(function (k) {
      eventDataArr.push($(this).html().trim());
    });

    if (eventDataArr.length) {
      //Remove duplicates
      uniqueArray = eventDataArr.filter(function (item, pos, self) {
        return self.indexOf(item) == pos;
      });
      $(uniqueArray).each(function (k, val) {
        var i = k + 1;

        if (i <= maxList) {
          eventDataList += val;
        }
      });
    }

    $('#eventCalendarList').html(eventDataList);
    $('#gcalendarData, #gCalendarList').hide();
  } else {
    $('.events-content-block .flexcol.right').hide();
  }

  if ($('ul.menu-wrapper li.menu-item-has-children').length) {
    $('ul.menu-wrapper li.menu-item-has-children').each(function () {
      $(this).prepend('<button class="dropdownListBtn"><span></span></button>');
    });
  }

  $(document).on('click', 'ul.menu-wrapper .dropdownListBtn', function () {
    $(this).parent().find('ul.sub-menu').slideToggle();
  }); // $('.numbers-content').on('inview', function(event, isInView) {
  //   if (isInView) {
  //     // $('.numbers-content .number span.count').each(function(){
  //     //   $(this).rCounter({
  //     //     'duration':50
  //     //   });
  //     // });
  //     $('.numbers-content .number span.count').each(function () {
  //       var $this = $(this);
  //       var actualNumber = $this.attr('data-number').trim();
  //       var number = actualNumber.replace(/\D/g,'');
  //       jQuery({
  //           Counter: 0
  //       }).animate({
  //           Counter: number
  //       }, {
  //           duration: 1000,
  //           easing: 'swing',
  //           step: function () {
  //               $this.text(Math.ceil(this.Counter));
  //           },
  //           complete: function() {
  //             $this.text(actualNumber);
  //           }
  //       });
  //     });
  //   } 
  // });

  $(document).on('click', '#menu-toggle', function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $('.site-header').toggleClass('nav-open');
  });
  $(document).on('click', '.navOverlay', function (e) {
    e.preventDefault();
    $(this).toggleClass('active');
    $('#menu-toggle').trigger('click');
  });

  function getUnique(value, index, array) {
    return array.indexOf(value) === index;
  }

  function toFindDuplicates(arry) {
    var uniqueElements = new Set(arry);
    var filteredElements = arry.filter(function (item) {
      if (uniqueElements.has(item)) {
        uniqueElements.delete(item);
      } else {
        return item;
      }
    });
    return _toConsumableArray(new Set(uniqueElements));
  } //CUSTOM MODAL


  $(document).on('click', '.popupinfo', function (e) {
    e.preventDefault();
    var d = new Date();
    $('.modalWrapper').addClass('show');
    var pageinfo = $(this).attr('data-href') + '?t=' + d.getTime();
    $('.modalContent').load(pageinfo + ' .teamInfo', function () {});
  });
  $(document).on('click', '.modalCloseBtn', function (e) {
    e.preventDefault();
    $('.modalWrapper').removeClass('show');
    setTimeout(function () {
      $('.modalContent').html("");
    }, 200);
  });

  if (typeof params.pid != "undefined") {
    var pid = params.pid;
    var selector = '#post-item-' + pid;
    setTimeout(function () {
      smoothScrollTo(selector);
    }, 100);
  }

  function smoothScrollTo(selector) {
    var target = $(selector);

    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000, function () {
        var $target = target;
        $target.focus();

        if ($target.is(":focus")) {
          return false;
        } else {
          $target.attr('tabindex', '-1');
          $target.focus();
        }

        ;
      });
    }
  }
});