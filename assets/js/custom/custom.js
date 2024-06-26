/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 04.04.2024
 */


jQuery(document).ready(function ($) {

  let dateNow = new Date();
  let month = dateNow.getMonth()+1;
  let day = dateNow.getDate();
  let year = dateNow.getFullYear();
  let monthName = dateNow.toLocaleString('default', { month: 'long' });
  let currentDate = monthName + ' ' + day + ', ' + year;

  // if( $('.events-content-block .simcal-day-label').length ) {
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

  if( $('.repeatable.has-paper-edge').length ) {
    $('.repeatable.has-paper-edge').each(function(){
      $(this).prev().addClass('adjust-padding-bottom');
    });
  }

  $(window).on('load resize', function(){
    verticalGalleryColumn();
  });

  function verticalGalleryColumn() {
    if( $('.two_column_icons_and_gallery').length ) {
      $('.two_column_icons_and_gallery').each(function(){
        if( $(this).find('.flexwrap.half').length ) {
          var iconsDivHeight = $(this).find('.textcol .inside').outerHeight() + 160;
          if( $(this).find('.imagecol').length ) {
            $(this).find('.imagecol').css('height',iconsDivHeight+'px');
            var countImages = $(this).find('.imagecol').find('img').length;
            if( countImages > 1 ) {
              var imageHeight = 100/countImages;
              $(this).find('.imagecol').find('figure').each(function(){
                var parent = $(this).parent();
                parent.addClass('multiple-images');
                $(this).css({
                  'width':'auto',
                  'height':imageHeight+'%'
                });
              });
            }
            $(this).find('.imagecol').addClass('show');
          }
        }
      });
    }
  }
  

  if( $('.events-content-block .simcal-events li').length ) {
    var upcomingEvents = '';
    var ctr = 1;
    var maxDisplay = $('#gCalendarList').attr('data-show');
        maxDisplay = parseInt(maxDisplay);
    $('.events-content-block .simcal-events li').each(function(){
      var target = $(this);
      var date = $(this).find('.simcal-event-start-date').text().trim();
      var parts = date.split(' ');
      var sMonth = parts[0];
      var sDay =  parts[1].replace(/[^0-9]/g, '');
          sDay = parseInt(sDay);
      var eventTitle = target.find('span.simcal-event-title').eq(0).text().trim();
      var startDate = target.find('.simcal-event-start-date').text().trim();
      var eventDetails = ( target.find('.simcal-event-description').length && target.find('.simcal-event-description').text().trim()  ) ? target.find('.simcal-event-description').html() : '';
      var eventLink  = '';
      // if( target.find('a').length ) {
      //   target.find('a').each(function(){
      //     if( $(this).text().trim().toLowerCase() == 'see more details' ) {
      //       eventLink = $(this).attr('href');
      //     }
      //   });
      // }

      if(sMonth==monthName) {
        if(sDay >= day) {
          var content = $(this).html();
          if(ctr <= maxDisplay) {
            upcomingEvents += '<li class="event-item" data-event-date="'+date+'">';
              if(eventLink) {
                upcomingEvents += '<a href="'+eventLink+'" target="_blank" class="details-link">';
              }
              upcomingEvents += '<div class="event-title">'+eventTitle+'</div>';
              upcomingEvents += '<div class="event-start-date">'+startDate+'</div>';
              if(eventDetails) {
                upcomingEvents += '<div class="event-details">'+eventDetails+'</div>';
              }
              if(eventLink) {
                upcomingEvents += '</a>';
              }
            upcomingEvents += '</li>';
          }
          ctr++;
        }        
      }
    });
    if(upcomingEvents) {
      $('#gCalendarList').html('<ul class="calendarItems">'+upcomingEvents+'</ul>');
      $('#gCalendarList').addClass('animated fadeIn');
      $('.events-content-block .simcal-calendar').hide();
    } else {
      $('.events-content-block .flexcol.left').addClass('fullwidth');
      $('.events-content-block .flexcol.right').hide();
    }
  }

  $('.numbers-content').on('inview', function(event, isInView) {
    if (isInView) {
      $('.numbers-content .number span.count').each(function(){
        $(this).rCounter({
          'duration':35
        });
      });
    } else {
      //console.log('has gone out of viewport');
    }
  });

  $(document).on('click','#menu-toggle', function(e){
    e.preventDefault();
    $(this).toggleClass('active');
    $('.site-header').toggleClass('nav-open');
  });
  $(document).on('click','.navOverlay', function(e){
    e.preventDefault();
    $(this).toggleClass('active');
    $('#menu-toggle').trigger('click');
  });

  function getUnique(value, index, array) {
    return array.indexOf(value) === index;
  }

  function toFindDuplicates(arry) {
    const uniqueElements = new Set(arry);
    const filteredElements = arry.filter(item => {
        if (uniqueElements.has(item)) {
            uniqueElements.delete(item);
        } else {
            return item;
        }
    });

    return [...new Set(uniqueElements)]
  }

}); 



