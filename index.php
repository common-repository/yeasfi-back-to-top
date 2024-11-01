<?php
/**
 * 
 * 
 * Plugin Name: Yeasfi Back to Top
 * Plugin URI: https://github.com/Yeashir/ybtb
 * Description: Back to Top button 
 * Version: 1.0
 * Author: Md Yeashir Arafat
 * Author URI:https://www.linkedin.com/in/yeashirarafat/
 * 
 * 
 * */
require_once dirname(__FILE__) . '/option.php';
// add required js/css files
add_action('wp_enqueue_scripts', 'ybtb_enqueue_scripts');
function ybtb_enqueue_scripts() {
    wp_enqueue_style('ybtb.css', plugins_url('/css/ybtb.css', __FILE__));   
}
add_action('wp_footer', 'ybtb_button', 100);
function ybtb_button() {
    $options = get_option('ybtb_settings');
    ?>
    <a href="#0" class="ybt-top js-ybt-top">Top</a>
    <script>
        (function () {
            // Back to Top - by CodyHouse.co
            var backTop = document.getElementsByClassName('js-ybt-top')[0],
                    // browser window scroll (in pixels) after which the "back to top" link is shown
                    offset = 300,
                    //browser window scroll (in pixels) after which the "back to top" link opacity is reduced
                    offsetOpacity = 1200,
                    scrollDuration = 700,
                    scrolling = false;
            if (backTop) {
                //update back to top visibility on scrolling
                window.addEventListener("scroll", function (event) {
                    if (!scrolling) {
                        scrolling = true;
                        (!window.requestAnimationFrame) ? setTimeout(checkBackToTop, 250) : window.requestAnimationFrame(checkBackToTop);
                    }
                });
                //smooth scroll to top
                backTop.addEventListener('click', function (event) {
                    event.preventDefault();
                    (!window.requestAnimationFrame) ? window.scrollTo(0, 0) : scrollTop(scrollDuration);
                });
            }
            function checkBackToTop() {
                var windowTop = window.scrollY || document.documentElement.scrollTop;
                (windowTop > offset) ? addClass(backTop, 'ybt-top--show') : removeClass(backTop, 'ybt-top--show', 'ybt-top--fade-out');
                (windowTop > offsetOpacity) && addClass(backTop, 'ybt-top--fade-out');
                scrolling = false;
            }
            function scrollTop(duration) {
                var start = window.scrollY || document.documentElement.scrollTop,
                        currentTime = null;
                var animateScroll = function (timestamp) {
                    if (!currentTime)
                        currentTime = timestamp;
                    var progress = timestamp - currentTime;
                    var val = Math.max(Math.easeInOutQuad(progress, start, -start, duration), 0);
                    window.scrollTo(0, val);
                    if (progress < duration) {
                        window.requestAnimationFrame(animateScroll);
                    }
                };
                window.requestAnimationFrame(animateScroll);
            }
            Math.easeInOutQuad = function (t, b, c, d) {
                t /= d / 2;
                if (t < 1)
                    return c / 2 * t * t + b;
                t--;
                return -c / 2 * (t * (t - 2) - 1) + b;
            };
            //class manipulations - needed if classList is not supported
            function hasClass(el, className) {
                if (el.classList)
                    return el.classList.contains(className);
                else
                    return !!el.className.match(new RegExp('(\\s|^)' + className + '(\\s|$)'));
            }
            function addClass(el, className) {
                var classList = className.split(' ');
                if (el.classList)
                    el.classList.add(classList[0]);
                else if (!hasClass(el, classList[0]))
                    el.className += " " + classList[0];
                if (classList.length > 1)
                    addClass(el, classList.slice(1).join(' '));
            }
            function removeClass(el, className) {
                var classList = className.split(' ');
                if (el.classList)
                    el.classList.remove(classList[0]);
                else if (hasClass(el, classList[0])) {
                    var reg = new RegExp('(\\s|^)' + classList[0] + '(\\s|$)');
                    el.className = el.className.replace(reg, ' ');
                }
                if (classList.length > 1)
                    removeClass(el, classList.slice(1).join(' '));
            }
        })();
    </script>
    <style>
        .ybt-top {           
            <?php echo $options['ybtb_select_field_1']; ?>: 30px;
            bottom: 30px;
            background-color: <?php echo $options['ybtb_text_field_0']; ?>;
        }

    </style>
    <?php
}




