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

  if ($('.events-content-block .simcal-events li').length) {
    var upcomingEvents = '';
    var ctr = 1;
    var maxDisplay = $('#gCalendarList').attr('data-show');
    maxDisplay = parseInt(maxDisplay);
    $('.events-content-block .simcal-events li').each(function () {
      var target = $(this);
      var date = $(this).find('.simcal-event-start-date').text().trim();
      var parts = date.split(' ');
      var sMonth = parts[0];
      var sDay = parts[1].replace(/[^0-9]/g, '');
      sDay = parseInt(sDay);
      var eventTitle = target.find('span.simcal-event-title').eq(0).text().trim();
      var startDate = target.find('.simcal-event-start-date').text().trim();
      var eventDetails = target.find('.simcal-event-description').length && target.find('.simcal-event-description').text().trim() ? target.find('.simcal-event-description').html() : '';
      var eventLink = ''; // if( target.find('a').length ) {
      //   target.find('a').each(function(){
      //     if( $(this).text().trim().toLowerCase() == 'see more details' ) {
      //       eventLink = $(this).attr('href');
      //     }
      //   });
      // }

      if (sMonth == monthName) {
        if (sDay >= day) {
          var content = $(this).html();

          if (ctr <= maxDisplay) {
            upcomingEvents += '<li class="event-item" data-event-date="' + date + '">';

            if (eventLink) {
              upcomingEvents += '<a href="' + eventLink + '" target="_blank" class="details-link">';
            }

            upcomingEvents += '<div class="event-title">' + eventTitle + '</div>';
            upcomingEvents += '<div class="event-start-date">' + startDate + '</div>';

            if (eventDetails) {
              upcomingEvents += '<div class="event-details">' + eventDetails + '</div>';
            }

            if (eventLink) {
              upcomingEvents += '</a>';
            }

            upcomingEvents += '</li>';
          }

          ctr++;
        }
      }
    });

    if (upcomingEvents) {
      $('#gCalendarList').html('<ul class="calendarItems">' + upcomingEvents + '</ul>');
      $('#gCalendarList').addClass('animated fadeIn');
      $('.events-content-block .simcal-calendar').hide();
    }
  }

  $('.numbers-content').on('inview', function (event, isInView) {
    if (isInView) {
      $('.numbers-content .number span.count').each(function () {
        $(this).rCounter({
          'duration': 35
        });
      });
    } else {//console.log('has gone out of viewport');
    }
  });
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
  }
});