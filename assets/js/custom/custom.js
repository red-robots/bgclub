/**
 *	Custom jQuery Scripts
 *	Developed by: Lisa DeBona
 *  Date Modified: 04.04.2024
 */


jQuery(document).ready(function ($) {

  AOS.init();
  
  var params = {}; location.search.replace(/[?&]+([^=&]+)=([^&]*)/gi, function (s, k, v) { params[k] = v });
  let dateNow = new Date();
  let month = dateNow.getMonth()+1;
  let day = dateNow.getDate();
  let year = dateNow.getFullYear();
  let monthName = dateNow.toLocaleString('default', { month: 'long' });
  let currentDate = monthName + ' ' + day + ', ' + year;

  scrolling_screen();
  $(window).on('scroll', function(){
    scrolling_screen();
  });
  
  function scrolling_screen() {
    var adminBarHeight = 0;
    var announcementHeight = 0;
    var headerHeight = $('.site-header').height();
    if( $('body').hasClass('admin-bar') ) {
      if( $('.announcement.show').length ) {
        adminBarHeight = $('#wpadminbar').height();
        announcementHeight = $('.announcement.show').height();
      }
    } 
    var totalHeight = adminBarHeight+announcementHeight+headerHeight;
    if ($(window).scrollTop() > 200) {
      $('body').addClass('scrolling');
      $('.site-header').css('margin-top', adminBarHeight+'px');
    } else {
      $('body').removeClass('scrolling');
      $('.site-header').removeAttr('style');
    }
  }

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

  if( $('.repeatable--donors_content').length ) {
    $('.repeatable--donors_content').eq(0).addClass('first');
    $('.repeatable--donors_content').last().addClass('last');
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
    var maxList = 4;
    var eventDataList = '';
    var eventDataArr = [];
    $('.events-content-block .simcal-events li').each(function(k){
      eventDataArr.push( $(this).html().trim() );
    });

    if(eventDataArr.length) {
      //Remove duplicates
      uniqueArray = eventDataArr.filter(function(item, pos, self) {
        return self.indexOf(item) == pos;
      });

      $(uniqueArray).each(function(k,val){
        var i = k+1;
        if( i<=maxList ) {
          eventDataList += val;
        }
      });
    }

    $('#eventCalendarList').html(eventDataList);
    $('#gcalendarData, #gCalendarList').hide();
  } else {
    $('.events-content-block .flexcol.right').hide();
  }

  if( $('ul.menu-wrapper li.menu-item-has-children').length ) {
    $('ul.menu-wrapper li.menu-item-has-children').each(function(){
      $(this).prepend('<button class="dropdownListBtn"><span></span></button>');
    }); 
  }

  $(document).on('click','ul.menu-wrapper .dropdownListBtn', function(){
    $(this).parent().find('ul.sub-menu').slideToggle();
  });

  // $('.numbers-content').on('inview', function(event, isInView) {
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

  var s=2;
  $(document).on("click","#sbloadmore",function(e){
    e.preventDefault();
    var target = $(this);
    var maxpageNum = $(this).data("maxpagenum");
    var currentPage = $(this).data("nextpage");
    var end = s+1;
    var currentURL = window.location.href;
    if(s<=maxpageNum) {
      var baseURL = '';
      if( $("#pagination a.page-numbers").length > 0 ) {
        $("#pagination a.page-numbers").each(function(k){
          if(k==0) {
            var link = $(this).attr("href");
            var parts = link.split("pg=");
            baseURL = parts[0];
          }
        });
      }
      if(baseURL) {
        var new_base_url = baseURL + 'pg=' + s;
        $.get(new_base_url,function(data){
          var output = $.parseHTML(data);
          var items = $(data).find(".recent-posts").html();
          $(".recent-posts").append(items);
          $("#widget-articles").addClass('addedNewItems');
          var container = $('#recentPosts'),
              scrollTo = $('.morediv');
          container.animate({
              scrollTop: scrollTo.offset().top - container.offset().top + container.scrollTop()
          });
        });
      }
    }
    if(end>maxpageNum) {
      $(".morediv").html('<span class="end">No more posts to load.</span>');
    }
    s++;
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

  //CUSTOM MODAL
  $(document).on('click','.popupinfo', function(e){
    e.preventDefault();
    var d = new Date();
    $('.modalWrapper').addClass('show');
    var pageinfo = $(this).attr('data-href') + '?t=' + d.getTime();
    $('.modalContent').load(pageinfo + ' .teamInfo', function(){

    });
  });
  $(document).on('click','.modalCloseBtn', function(e){
    e.preventDefault();
    $('.modalWrapper').removeClass('show');
    setTimeout(function(){
      $('.modalContent').html("");
    },200);
  });

  if( typeof params.pid!="undefined" ) {
    var pid = params.pid;
    var selector = '#post-item-' + pid;
    setTimeout(function(){
      smoothScrollTo(selector);
    },100);
  }

  function smoothScrollTo(selector) {
    var target = $(selector);
    if (target.length) {
      $('html, body').animate({
        scrollTop: target.offset().top
      }, 1000, function() {
        var $target = target;
        $target.focus();
        if ($target.is(":focus")) {
          return false;
        } else {
          $target.attr('tabindex','-1'); 
          $target.focus();
        };
      });
    }
  }

  // Top Supporters - Homepage
  if ($('.support-slider').length) {
    $('.support-slider').slick({
      dots: false,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      prevArrow:'<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
      nextArrow:'<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
      responsive: [{
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      }, {
        breakpoint: 880,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }, {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });
    AOS.init();
  }

  //Donors page
  if ( $('.gallery-slider').length ) {

    $('.gallery-slider').each(function(){
      var indicators = $(this).attr('data-has-indicators');
      var showIndicator = (indicators) ? true : false;
      carousel_slick( $(this), showIndicator );
    });

    // $('.gallery-slider').slick({
    //   dots: true,
    //   infinite: true,
    //   speed: 300,
    //   slidesToShow: 5,
    //   slidesToScroll: 1,
    //   prevArrow:'<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
    //   nextArrow:'<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
    //   responsive: [{
    //     breakpoint: 1200,
    //     settings: {
    //       slidesToShow: 3,
    //       slidesToScroll: 3
    //     }
    //   }, {
    //     breakpoint: 880,
    //     settings: {
    //       slidesToShow: 2,
    //       slidesToScroll: 2
    //     }
    //   }, {
    //     breakpoint: 768,
    //     settings: {
    //       slidesToShow: 1,
    //       slidesToScroll: 1
    //     }
    //   }]
    // });

    AOS.init();
  }

  function carousel_slick(carouselSelector, showDots) {
    carouselSelector.slick({
      dots: showDots,
      infinite: true,
      speed: 300,
      slidesToShow: 5,
      slidesToScroll: 1,
      prevArrow:'<button type="button" class="slick-prev"><i class="fa-solid fa-chevron-left"></i></button>',
      nextArrow:'<button type="button" class="slick-next"><i class="fa-solid fa-chevron-right"></i></button>',
      responsive: [{
        breakpoint: 1200,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3
        }
      }, {
        breakpoint: 880,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }, {
        breakpoint: 768,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }]
    });
  }
}); 



