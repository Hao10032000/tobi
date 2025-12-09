(function ($) {
    "use strict";
  
    // Handle modal menu open/close
    function initModalMenu() {
      $('#modal-menu').on("click", function () {
        $('.modal-menu').toggleClass('active');
      });
  
      $(".modal-menu .overlay, .modal-menu .close-menu").on("click", function () {
        $('.modal-menu').removeClass('active');
      });
    }
  
    // Handle animated wave effect
    function initWaveAnimation() {
      const $wave = $('.wave');
      const config = {
        baseAmplitude: 60,
        amplitudeVariation: 20,
        frequency: 0.0035,
        smoothness: 3500,
        width: 1500,
        noiseIntensity: 0.1,
      };
  
      let offset = 0;
      const noise = Array.from({ length: config.smoothness + 1 }, () => 0);
  
      function updateNoise() {
        for (let i = 0; i < noise.length; i++) {
          noise[i] += (Math.random() * 2 - 1) * 0.02;
          noise[i] = Math.max(-1, Math.min(1, noise[i]));
        }
      }
  
      function generateWavePath(offset, amplitude) {
        let path = `M0 100`;
  
        for (let i = 0; i <= config.smoothness; i++) {
          const x = (i / config.smoothness) * config.width;
          const y =
            100 +
            Math.sin(i * config.frequency + offset) * amplitude +
            Math.sin(i * config.frequency * 1.5 + offset * 2) * (amplitude * 0.25) +
            noise[i] * config.noiseIntensity;
  
          if (i > 0) {
            const prevX = ((i - 1) / config.smoothness) * config.width;
            const prevY =
              100 +
              Math.sin((i - 1) * config.frequency + offset) * amplitude +
              Math.sin((i - 1) * config.frequency * 1.5 + offset * 2) * (amplitude * 0.25) +
              noise[i - 1] * config.noiseIntensity;
  
            const ctrlX1 = prevX + (x - prevX) / 2;
            const ctrlY1 = prevY;
            const ctrlX2 = x - (x - prevX) / 2;
            const ctrlY2 = y;
  
            path += ` C${ctrlX1} ${ctrlY1}, ${ctrlX2} ${ctrlY2}, ${x} ${y}`;
          } else {
            path += ` L${x} ${y}`;
          }
        }
  
        return path;
      }
  
      function animate() {
        offset += 0.005 + Math.abs(Math.sin(offset * 0.2)) * 0.008;
  
        const dynamicAmplitude =
          config.baseAmplitude +
          Math.sin(offset * 0.5) * config.amplitudeVariation +
          Math.sin(offset * 1.2) * (config.amplitudeVariation * 0.5);
  
        updateNoise();
        $wave.attr('d', generateWavePath(offset, dynamicAmplitude));
        requestAnimationFrame(animate);
      }
  
      animate();
    }

    var textShowMore = function () {
      if ($('.tf-description.show-more').length) {
        $(document).ready(function($) {
          function applyTextShortener() {
              $('.tf-description').each(function() {
                  var $container = $(this);
                  var $p = $container.find('p');
                  var fullText = $p.data('original-text');
      
                  if (!fullText) {
                      fullText = $p.text().trim();
                      $p.data('original-text', fullText);
                  }
      
                  if (window.innerWidth <= 767) {
                      if (!$p.hasClass('shortened')) {
                          var halfLength = Math.floor(fullText.length / 3);
                          var shortText = fullText.substring(0, halfLength) + '...';
                          $p.text(shortText).addClass('shortened');
                          $container.find('.btn-show').show();
                      }
                  } else {
                      $p.text(fullText).removeClass('shortened');
                      $container.find('.btn-show').hide();
                  }
              });
          }
      
          applyTextShortener();
      
          $(window).on('resize', function() {
              applyTextShortener();
          });
      
          $('.tf-description .btn-show').on('click', function() {
              var $container = $(this).closest('.tf-description');
              var $p = $container.find('p');
              var fullText = $p.data('original-text');
              $p.text(fullText).removeClass('shortened');
              $(this).hide();
          });
      });

      }

    }

    var animationLogo = function () {
      $(document).ready(function ($) {

        if ($('.wrap-list-logo-animation').length) {
          var hasAnimated = false;
      
          function isElementInViewport(el) {
              var rect = el.getBoundingClientRect();
              return (
                  rect.top <= (window.innerHeight || document.documentElement.clientHeight)
              );
          }
      
          $(window).on('scroll', function () {
              if (!hasAnimated && isElementInViewport(document.querySelector('.wrap-list-logo-animation'))) {
                  hasAnimated = true;
                  $('.wrap-list-logo-animation .item-logo').each(function (index) {
                      var $this = $(this);
                      setTimeout(function () {
                          $this.addClass('active');
                      }, index * 300); 
                  });
              }
          });

        }


    });
    }

    $(document).ready(function () {
      function checkSectionInView() {
        $('.animation-up').each(function () {
          var sectionTop = $(this).offset().top;
          var sectionHeight = $(this).outerHeight();
          var scrollTop = $(window).scrollTop();
          var windowHeight = $(window).height();
    
          if (scrollTop + windowHeight > sectionTop + 100) {
            $(this).addClass('active');
          }
        });
      }

      $(window).on('scroll', checkSectionInView);
      checkSectionInView(); 
    });

    var headerSticky = function () {
      if (window.location.href.indexOf('/wp-admin') !== -1) return;
    
      let lastScrollTop = 0;
      let delta = 5;
      let adminBarHeight = $('#wpadminbar').length ? $('#wpadminbar').outerHeight() : 0;
      let navbarHeight = $(".tf-custom-header").outerHeight();
      let didScroll = false;
    
      $(window).scroll(function () {
        didScroll = true;
      });
    
      setInterval(function () {
        if (didScroll) {
          let st = $(window).scrollTop();
          navbarHeight = $(".tf-custom-header").outerHeight();
    
          if (st > navbarHeight) {
            if (st > lastScrollTop + delta) {
              $(".tf-custom-header").css("top", `-${navbarHeight}px`);
              $(".sticky-top").css("top", `${15 + adminBarHeight}px`);
            } else if (st < lastScrollTop - delta) {
              $(".tf-custom-header").css("top", `${adminBarHeight}px`);
              $(".tf-custom-header").addClass("tf-custom-header-bg");
              $(".sticky-top").css("top", `${15 + navbarHeight + adminBarHeight}px`);
            }
          } else {
            $(".tf-custom-header").css("top", "unset");
            $(".tf-custom-header").removeClass("tf-custom-header-bg");
            $(".sticky-top").css("top", `${15 + adminBarHeight}px`);
          }
          lastScrollTop = st;
          didScroll = false;
        }
      }, 250);
    };
    

    var goTop = function () {
      $(window).scroll(function () {
          if ($(this).scrollTop() > 500) {
              $(".go-top").addClass("show");
          } else {
              $(".go-top").removeClass("show");
          }
      });
      $(".go-top").on("click", function (event) {
          event.preventDefault();
          $("html, body").animate({ scrollTop: 0 }, 0);
      });
  };
  
  $(document).ready(function () {
      if ($('.single-feature').length) {
      function updateBackgroundPosition() {
          let scrollTop = $(window).scrollTop();
          $('.single-feature').css({
              'background-position': `center ${scrollTop * 0.5}px`
          });
      }
      updateBackgroundPosition();

      $(window).on('scroll', updateBackgroundPosition);
    }
    });

    var removePreloader = function () {
      $("#preloader").fadeOut("slow", function () {
          setTimeout(function () {
              $("#preloader").remove();
          }, 1000);
      });
  };
  
    // DOM ready
    $(function () {
      initModalMenu();
      goTop();
      initWaveAnimation();
      headerSticky();
      removePreloader();
    });

    $(window).on('elementor/frontend/init', function() {
      elementorFrontend.hooks.addAction( 'frontend/element_ready/tf-description.default', textShowMore );
      elementorFrontend.hooks.addAction( 'frontend/element_ready/tf-list-career.default', animationLogo );
  });
  
  })(jQuery);
  